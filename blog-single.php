<?php
include 'config/database.php';

$post_id = $_GET['id'] ?? 0;

$sql = "SELECT bp.*, c.name as category_name, u.username as author_name 
        FROM blog_posts bp 
        LEFT JOIN categories c ON bp.category_id = c.id 
        LEFT JOIN users u ON bp.author_id = u.id 
        WHERE bp.id = ? AND bp.status = 'published'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    header("Location: blog.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo $post['title']; ?> - Ledger X</title>
  <meta name="description" content="<?php echo $post['excerpt'] ?: substr($post['content'], 0, 160); ?>">
  <meta name="keywords" content="accounting, finance, <?php echo $post['category_name']; ?>, <?php echo $post['meta_keywords'] ?? ''; ?>">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="assets/css/blog.css" rel="stylesheet">
  
  <style>
    .blog-single-page {
      background: #f8f9fa;
    }
    
    .single-post-header {
      background: linear-gradient(135deg, #065f46 0%, #047857 100%);
      color: white;
      padding: 150px 0 60px 0;
    }
    
    .post-meta-single {
      display: flex;
      align-items: center;
      gap: 20px;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }
    
    .post-category-single {
      background: rgba(255, 255, 255, 0.2);
      color: white;
      padding: 6px 16px;
      border-radius: 20px;
      font-size: 14px;
      font-weight: 600;
    }
    
    .post-date-single, .post-read-time-single {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 14px;
      opacity: 0.9;
    }
    
    .author-info-single {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-top: 30px;
      padding-top: 20px;
      border-top: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .author-avatar-single {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
    }
    
    .post-content-single {
      background: white;
      border-radius: 16px;
      padding: 50px;
      margin-top: -50px;
      position: relative;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }
    
    .post-content-single h2 {
      color: #065f46;
      margin: 30px 0 20px 0;
      font-weight: 700;
    }
    
    .post-content-single h3 {
      color: #047857;
      margin: 25px 0 15px 0;
      font-weight: 600;
    }
    
    .post-content-single p {
      line-height: 1.8;
      margin-bottom: 20px;
      color: #4a5568;
    }
    
    .post-content-single ul, .post-content-single ol {
      margin: 20px 0;
      padding-left: 20px;
    }
    
    .post-content-single li {
      margin-bottom: 10px;
      line-height: 1.6;
    }
    
    .featured-image-single {
      border-radius: 12px;
      overflow: hidden;
      margin-bottom: 30px;
    }
    
    .featured-image-single img {
      width: 100%;
      height: 400px;
      object-fit: cover;
    }
    
    .post-navigation {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 50px;
      padding-top: 30px;
      border-top: 1px solid #e2e8f0;
    }
    
    .nav-btn {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px 24px;
      border: 2px solid #065f46;
      border-radius: 8px;
      color: #065f46;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .nav-btn:hover {
      background: #065f46;
      color: white;
    }
    
    .related-posts {
      margin-top: 80px;
    }
    
    .related-post-card {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      height: 100%;
    }
    
    .related-post-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }
    
    .related-post-image {
      height: 200px;
      overflow: hidden;
    }
    
    .related-post-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }
    
    .related-post-card:hover .related-post-image img {
      transform: scale(1.05);
    }
    
    .related-post-content {
      padding: 20px;
    }
    
    @media (max-width: 768px) {
      .post-content-single {
        padding: 30px 20px;
        margin-top: -30px;
      }
      
      .single-post-header {
        padding: 80px 0 40px 0;
      }
      
      .post-navigation {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
      }
      
      .nav-btn {
        justify-content: center;
      }
    }
  </style>
</head>

<body class="blog-single-page">

  <header id="header" class="header fixed-top">
    <div class="topbar d-flex align-items-center ">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
     </div><!-- End Top Bar -->

     <div class="branding d-flex align-items-center">
      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
          <h1 class="sitename">Ledger X</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="server.html">Services</a></li>
            <li><a href="pricing.html">Pricing</a></li>
            <li><a href="blog.php">Blogs</a></li>
            <li><a href="contact.html">Contact</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </div>
  </header>

  <main class="main">
    <!-- Single Post Header -->
    <section class="single-post-header">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="post-meta-single">
              <span class="post-category-single"><?php echo $post['category_name']; ?></span>
              <span class="post-date-single">
                <i class="bi bi-calendar"></i> 
                <?php echo date('F j, Y', strtotime($post['published_at'])); ?>
              </span>
              <span class="post-read-time-single">
                <i class="bi bi-clock"></i> 
                <?php echo $post['read_time']; ?> min read
              </span>
            </div>
            
            <h1 class="display-4 fw-bold mb-4" style="color: white;">
                <?php echo $post['title']; ?>
                </h1>

            <p class="lead mb-4 opacity-90"><?php echo $post['excerpt']; ?></p>
            
            <div class="author-info-single">
              <img src="assets/img/about/me.jpeg" alt="Author" class="author-avatar-single">
              <div>
                <div class="fw-semibold">By <?php echo $post['author_name']; ?></div>
                <small class="opacity-80">Financial Expert</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Post Content -->
    <section class="single-post-content section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="post-content-single">
              <?php if ($post['featured_image']): ?>
              <div class="featured-image-single">
                <img src="<?php echo $post['featured_image']; ?>" alt="<?php echo $post['title']; ?>" class="img-fluid">
              </div>
              <?php endif; ?>
              
              <div class="content">
                <?php 
                // Convert line breaks to paragraphs and preserve HTML formatting
                $content = $post['content'];
                
                // If content doesn't have HTML tags, format it properly
                if (strip_tags($content) === $content) {
                    // Convert line breaks to paragraphs
                    $paragraphs = preg_split('/\n\s*\n/', $content);
                    foreach ($paragraphs as $paragraph) {
                        $paragraph = trim($paragraph);
                        if (!empty($paragraph)) {
                            echo '<p>' . nl2br(htmlspecialchars($paragraph)) . '</p>';
                        }
                    }
                } else {
                    // Content already has HTML, just output it
                    echo $content;
                }
                ?>
              </div>
              
              <!-- Post Navigation -->
              <div class="post-navigation">
                <a href="blog.php" class="nav-btn">
                  <i class="bi bi-arrow-left"></i> Back to All Posts
                </a>
                <a href="contact.html" class="nav-btn">
                  Get Professional Advice <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Related Posts -->
    <section class="related-posts section light-background">
      <div class="container">
        <div class="section-title text-center">
          <h2>Related Articles</h2>
          <p>Continue reading more accounting insights</p>
        </div>
        
        <div class="row">
          <?php
          // Get related posts (same category, excluding current post)
          $related_sql = "SELECT bp.*, c.name as category_name 
                         FROM blog_posts bp 
                         LEFT JOIN categories c ON bp.category_id = c.id 
                         WHERE bp.status = 'published' 
                         AND bp.category_id = ? 
                         AND bp.id != ? 
                         ORDER BY bp.published_at DESC 
                         LIMIT 3";
          $stmt = $conn->prepare($related_sql);
          $stmt->bind_param("ii", $post['category_id'], $post_id);
          $stmt->execute();
          $related_result = $stmt->get_result();
          
          if ($related_result->num_rows > 0) {
              while($related_post = $related_result->fetch_assoc()) {
                  ?>
                  <div class="col-lg-4 col-md-6">
                    <div class="related-post-card">
                      <div class="related-post-image">
                        <img src="<?php echo $related_post['featured_image'] ?: 'assets/img/1.jpg'; ?>" alt="<?php echo $related_post['title']; ?>">
                      </div>
                      <div class="related-post-content">
                        <span class="post-category"><?php echo $related_post['category_name']; ?></span>
                        <h4 class="mt-2 mb-3">
                          <a href="blog-single.php?id=<?php echo $related_post['id']; ?>" class="text-decoration-none">
                            <?php echo $related_post['title']; ?>
                          </a>
                        </h4>
                        <div class="post-meta">
                          <small class="text-muted">
                            <i class="bi bi-calendar"></i> 
                            <?php echo date('M j, Y', strtotime($related_post['published_at'])); ?>
                          </small>
                          <small class="text-muted ms-3">
                            <i class="bi bi-clock"></i> 
                            <?php echo $related_post['read_time']; ?> min read
                          </small>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
              }
          } else {
              // If no related posts, show latest posts
              $latest_sql = "SELECT bp.*, c.name as category_name 
                            FROM blog_posts bp 
                            LEFT JOIN categories c ON bp.category_id = c.id 
                            WHERE bp.status = 'published' 
                            AND bp.id != ? 
                            ORDER BY bp.published_at DESC 
                            LIMIT 3";
              $stmt = $conn->prepare($latest_sql);
              $stmt->bind_param("i", $post_id);
              $stmt->execute();
              $latest_result = $stmt->get_result();
              
              while($latest_post = $latest_result->fetch_assoc()) {
                  ?>
                  <div class="col-lg-4 col-md-6">
                    <div class="related-post-card">
                      <div class="related-post-image">
                        <img src="<?php echo $latest_post['featured_image'] ?: 'assets/img/1.jpg'; ?>" alt="<?php echo $latest_post['title']; ?>">
                      </div>
                      <div class="related-post-content">
                        <span class="post-category"><?php echo $latest_post['category_name']; ?></span>
                        <h4 class="mt-2 mb-3">
                          <a href="blog-single.php?id=<?php echo $latest_post['id']; ?>" class="text-decoration-none">
                            <?php echo $latest_post['title']; ?>
                          </a>
                        </h4>
                        <div class="post-meta">
                          <small class="text-muted">
                            <i class="bi bi-calendar"></i> 
                            <?php echo date('M j, Y', strtotime($latest_post['published_at'])); ?>
                          </small>
                          <small class="text-muted ms-3">
                            <i class="bi bi-clock"></i> 
                            <?php echo $latest_post['read_time']; ?> min read
                          </small>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
              }
          }
          ?>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="blog-cta section dark-background">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-8">
            <h2>Need Professional Accounting Advice?</h2>
            <p>Our team of experts is ready to help you navigate complex financial challenges and optimize your business performance.</p>
          </div>
          <div class="col-lg-4 text-lg-end">
            <div class="cta-buttons">
              <a href="contact.html" class="btn-primary">Schedule Consultation</a>
              <a href="tel:+155895548855" class="btn-secondary">
                <i class="bi bi-telephone"></i>
                Call Now
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer id="footer" class="footer position-relative dark-background">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Ledger X</span>
          </a>
          <p>Professional accounting services for SMEs in UAE and US. 12+ years of experience helping businesses achieve financial clarity and growth.</p>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About us</a></li>
            <li><a href="server.html">Services</a></li>
            <li><a href="pricing.html">Pricing</a></li>
            <li><a href="blog.php">Blog</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="server.html">Accounting</a></li>
            <li><a href="server.html">Tax Services</a></li>
            <li><a href="server.html">Payroll</a></li>
            <li><a href="server.html">Consulting</a></li>
            <li><a href="server.html">Audit</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>Business Bay</p>
          <p>Dubai, UAE</p>
          <p class="mt-4"><strong>Phone:</strong> <span>+971 800 534337</span></p>
          <p><strong>Email:</strong> <span>info@ledgerx.com</span></p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  
  <script>
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });
    
    // Add loading animation for images
    const images = document.querySelectorAll('img');
    images.forEach(img => {
      img.addEventListener('load', function() {
        this.style.opacity = '1';
      });
      
      if (img.complete) {
        img.style.opacity = '1';
      } else {
        img.style.opacity = '0';
        img.style.transition = 'opacity 0.3s ease';
      }
    });
  </script>
</body>
</html>
<?php $conn->close(); ?>