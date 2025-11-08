<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Blogs - Ledger X</title>
  <meta name="description" content="Expert accounting insights, tax tips, and business advice from Ledger X professionals. Stay updated with UAE and US accounting regulations.">
  <meta name="keywords" content="accounting blog, tax tips, business advice, UAE accounting, US accounting, financial insights">

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
  <link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="assets/css/blog.css" rel="stylesheet">
  
  <style>
:root {
  --accent-color: #065f46;
  --contrast-color: #ffffff;
  --surface-color: #f9fafb;
  --heading-color: #111827;
  --text-color: #4b5563;
}
.section-title {
  padding-top: 35px;
}



/* Grid layout */
.categories-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 30px;
  margin-top: -10px;
  margin-bottom: 30px;
}


/* Category Card */
.category-card {
  background-color: var(--surface-color);
  padding: 32px;
  border-radius: 16px;
  position: relative;
  transition: all 0.4s ease;
  overflow: hidden;
  height: 100%;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
  cursor: pointer;
  text-align: center;
}

/* Icon */
.category-card .category-icon {
  height: 70px;
  width: 70px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: var(--accent-color);
  border-radius: 50%;
  margin: 0 auto 20px auto;
  transition: all 0.4s;
}

.category-card .category-icon i {
  font-size: 30px;
  color: var(--contrast-color);
  transition: all 0.4s;
}

/* Content */
.category-card h4 {
  font-size: 22px;
  font-weight: 600;
  color: var(--heading-color);
  margin-bottom: 10px;
  transition: all 0.4s;
}

.category-card p {
  font-size: 16px;
  line-height: 1.6;
  color: var(--text-color);
  margin-bottom: 20px;
  transition: all 0.4s;
}

.category-card .post-count {
  display: inline-block;
  background: rgba(6, 95, 70, 0.1);
  padding: 8px 16px;
  border-radius: 20px;
  color: var(--accent-color);
  font-weight: 500;
  transition: all 0.4s;
}

/* Arrow link (top corner icon) */
.category-card .arrow-link {
  position: absolute;
  right: -40px;
  top: -40px;
  height: 40px;
  width: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  transform: rotate(-45deg);
  background-color: var(--surface-color);
  color: var(--accent-color);
  transition: all 0.4s;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

/* Hover effect */
.category-card:hover {
  background-color: var(--accent-color);
  transform: translateY(-5px);
}

.category-card:hover .category-icon {
  background-color: var(--contrast-color);
}

.category-card:hover .category-icon i {
  color: var(--accent-color);
}

.category-card:hover h4,
.category-card:hover p,
.category-card:hover .post-count {
  color: var(--contrast-color);
}

.category-card:hover .arrow-link {
  top: 16px;
  right: 16px;
  background-color: var(--contrast-color);
  color: var(--accent-color);
}

/* Active state (selected) */
.category-card.active {
  background: linear-gradient(135deg, var(--accent-color) 0%, #047857 100%);
  border: 2px solid var(--accent-color);
  color: var(--contrast-color);
}

.category-card.active .category-icon {
  background: rgba(255, 255, 255, 0.2);
}

.category-card.active .category-icon i {
  color: var(--contrast-color);
}

/* Make ALL text inside the active card white */
.category-card.active h4,
.category-card.active p,
.category-card.active .post-count {
  color: var(--contrast-color);
  /* background: rgba(255, 255, 255, 0.2); */
}

/* Optional: arrow link also adapts */
.category-card.active .arrow-link {
  background-color: var(--contrast-color);
  color: var(--accent-color);
  top: 16px;
  right: 16px;
}

/* ---------------------------- */
/* Filter Active Section Styles */
/* ---------------------------- */
.filter-active {
  background: linear-gradient(135deg, var(--accent-color) 0%, #047857 100%);
  color: var(--contrast-color);
  padding: 14px 24px;
  border-radius: 12px;
  margin-top: 40px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  font-size: 16px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  animation: fadeIn 0.4s ease;
}

.filter-active strong {
  font-weight: 600;
  color: var(--contrast-color);
}

.clear-filter {
  background: rgba(255, 255, 255, 0.2);
  border: none;
  color: var(--contrast-color);
  margin-left: 10px;
  cursor: pointer;
  padding: 8px 14px;
  border-radius: 8px;
  transition: all 0.3s ease;
  font-weight: 500;
}

.clear-filter:hover {
  background: var(--contrast-color);
  color: var(--accent-color);
}




/* Smooth fade-in for filter */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-5px); }
  to { opacity: 1; transform: translateY(0); }
}
   
.loading-spinner {
      display: none;
      text-align: center;
      padding: 40px;
    }
    
.loading-spinner .spinner-border {
      width: 3rem;
      height: 3rem;
    }
  .float {
  position: fixed;
  width: 60px;
  height: 60px;
  bottom: 40px;
  right: 40px;
  background-color: #25d366;
  color: #FFF;
  border-radius: 50%;
  text-align: center;
  font-size: 30px;
  box-shadow: 2px 2px 3px #999;
  z-index: 100;
  transition: all 0.3s ease;
}

.float:hover {
  background-color: #20b85a;
  transform: scale(1.1);
}

.my-float {
  margin-top: 16px;
}
  </style>
</head>

<body class="blog-page">

  <header id="header" class="header fixed-top">
    <div class="topbar d-flex align-items-center ">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">ledgerxconsultants@gmail.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+92 339 8865880</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="https://x.com/x_consultants" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="https://www.facebook.com/profile.php?id=61581501786151" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="https://www.instagram.com/ledger_x_consultants/" class="instagram"><i class="bi bi-instagram"></i></a>
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
            <li><a href="price.html">Pricing</a></li>
            <li><a href="blog.php" class="active">Blogs</a></li>
            <li><a href="contact.html">Contact</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </div>
  </header>

  <main class="main">
    <!-- WhatsApp Floating Button -->
  <a href="https://api.whatsapp.com/send?phone=923001234567&text=Hi!%20I%20want%20to%20know%20more"
     class="float"
     target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
  </a>
     <!-- Page Header -->
     <section class="page-header blog-header section ">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="page-header-content">
              <span class="page-badge">Accounting Insights</span>
              <h1>Expert Financial Guidance & Industry Updates</h1>
              <p style="color: white;" class="lead">Stay informed with the latest accounting trends, tax regulations, and business strategies from our team of financial experts.</p>
              <div class="header-actions">
                <a href="#categories" class="btn-primary">Browse Categories</a>
                <a href="#all-posts" class="btn-secondary">View All Posts</a>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="header-visual">
              <img src="assets/img/blogs header.jpg" alt="Blog Insights" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Blog Categories -->
<section id="categories" class="blog-categories section light-background">
  <div class="container">
    <div class="section-title text-center">
      <span class="subtitle">Explore Topics</span>
      <h2>Browse by Category</h2>
      <p>Find articles relevant to your business needs</p>
    </div>

    <div class="categories-grid">
      <?php
      include 'config/database.php';

      $categories_sql = "SELECT c.*, COUNT(bp.id) as post_count 
                        FROM categories c 
                        LEFT JOIN blog_posts bp 
                          ON c.id = bp.category_id AND bp.status = 'published' 
                        GROUP BY c.id 
                        ORDER BY post_count DESC";
      $categories_result = $conn->query($categories_sql);

      if ($categories_result->num_rows > 0) {
          while($category = $categories_result->fetch_assoc()) {
              ?>
              <div class="category-card" data-category-id="<?php echo $category['id']; ?>" data-category-name="<?php echo $category['name']; ?>">
                <div class="category-icon">
                  <i class="bi bi-<?php echo getCategoryIcon($category['name']); ?>"></i>
                </div>
                <h4><?php echo $category['name']; ?></h4>
                <p><?php echo $category['description']; ?></p>
                <span class="post-count"><?php echo $category['post_count']; ?> Articles</span>
                <div class="arrow-link"><i class="bi bi-arrow-up-right"></i></div>
              </div>
              <?php
          }
      }

      function getCategoryIcon($categoryName) {
          $icons = [
              'Tax Planning' => 'calculator',
              'Financial Strategy' => 'graph-up-arrow',
              'Compliance' => 'shield-check',
              'Payroll & WPS' => 'people',
              'Software & Tools' => 'cloud-arrow-up',
              'Business Tips' => 'lightbulb'
          ];
          return $icons[$categoryName] ?? 'file-text';
      }
      ?>
    </div>
  </div>
</section>

    <!-- All Blog Posts -->
    <section id="all-posts" class="all-posts section">
      <div class="container">
        <div class="section-title">
          <h2 id="posts-title">All Articles</h2>
          <p id="posts-subtitle">Browse our complete collection of accounting insights</p>
          <div id="filter-indicator"></div>
        </div>

        <div class="row">
          <!-- Blog Posts Column -->
          <div class="col-lg-8">
            <div id="posts-container">
              <!-- Posts will be loaded dynamically here -->
            </div>

            <!-- Pagination will be loaded dynamically here -->
            <div id="pagination-container"></div>
          </div>

          <!-- Sidebar -->
          <div class="col-lg-4">
            <div class="blog-sidebar">
              <!-- Search Widget -->
              <div class="sidebar-widget search-widget">
                <h4>Search Articles</h4>
                <form id="search-form" class="search-form">
                  <input type="text" id="search-input" placeholder="Search topics..." class="form-control">
                  <button type="submit" class="search-btn">
                    <i class="bi bi-search"></i>
                  </button>
                </form>
              </div>

              <!-- Categories Widget -->
              <div class="sidebar-widget categories-widget">
                <h4>Categories</h4>
                <ul class="categories-list" id="sidebar-categories">
                  <?php
                  $cat_sql = "SELECT c.*, COUNT(bp.id) as post_count 
                             FROM categories c 
                             LEFT JOIN blog_posts bp ON c.id = bp.category_id AND bp.status = 'published' 
                             GROUP BY c.id 
                             ORDER BY post_count DESC";
                  $cat_result = $conn->query($cat_sql);
                  
                  if ($cat_result->num_rows > 0) {
                      while($cat = $cat_result->fetch_assoc()) {
                          echo '<li><a href="javascript:void(0)" data-category-id="' . $cat['id'] . '">' . $cat['name'] . ' <span>' . $cat['post_count'] . '</span></a></li>';
                      }
                  }
                  ?>
                </ul>
              </div>

              <!-- Popular Posts Widget -->
              <div class="sidebar-widget popular-posts">
                <h4>Popular Articles</h4>
                <div id="popular-posts-container">
                  <!-- Popular posts will be loaded dynamically -->
                </div>
              </div>

              <!-- Newsletter Widget -->
              <div class="sidebar-widget newsletter-widget">
                <h4>Stay Updated</h4>
                <p>Get the latest accounting insights delivered to your inbox</p>
                <form class="newsletter-form">
                  <input type="email" placeholder="Your email address" class="form-control" required>
                  <button type="submit" class="btn-subscribe">Subscribe</button>
                </form>
                <p class="privacy-note">We respect your privacy. Unsubscribe at any time.</p>
              </div>

              <!-- Tags Widget -->
              <div class="sidebar-widget tags-widget">
                <h4>Popular Tags</h4>
                <div class="tags-list">
                  <a href="#" class="tag">Corporate Tax</a>
                  <a href="#" class="tag">VAT</a>
                  <a href="#" class="tag">QuickBooks</a>
                  <a href="#" class="tag">Compliance</a>
                  <a href="#" class="tag">Cash Flow</a>
                  <a href="#" class="tag">Audit</a>
                  <a href="#" class="tag">WPS</a>
                  <a href="#" class="tag">Financial Planning</a>
                </div>
              </div>
            </div>
          </div>
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
              <a href="tel:+92 339 8865880" class="btn-secondary">
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
            <span class="sitename">Ladger X</span>
          </a>
          <p>Ledger X provides reliable, transparent, and affordable accounting solutions for SMEs across the UAE and US helping businesses make confident financial decisions with clarity and precision.</p>
          <div class="social-links d-flex mt-4">
          <a href="https://x.com/x_consultants" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="https://www.facebook.com/profile.php?id=61581501786151" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="https://www.instagram.com/ledger_x_consultants/" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About us</a></li>
            <li><a href="server.html">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="server.html">Web Design</a></li>
            <li><a href="server.html">Web Development</a></li>
            <li><a href="server.html">Product Management</a></li>
            <li><a href="server.html">Marketing</a></li>
            <li><a href="server.html">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>Business Bay</p>
          <p>Dubai, UAE</p>
          <!-- <p>United States</p> -->
          <p class="mt-4"><strong>Phone:</strong> <span>+92 339-8865880</span></p>
          <p><strong>Email:</strong> <span>ledgerxconsultants@gmail.com</span></p>
        </div>

      </div>
    </div>

    <!-- <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">MyWebsite</strong> <span>All Rights Reserved</span></p>
      <div class="credits"> -->
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
          <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div> -->

  </footer>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  
  <script>
    let currentCategory = 0;
    let currentPage = 1;
    let currentSearch = '';

    // Initialize the page
    document.addEventListener('DOMContentLoaded', function() {
        loadPosts();
        loadPopularPosts();
        
        // Add event listeners to category cards
        document.querySelectorAll('.category-card').forEach(card => {
            card.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-category-id');
                const categoryName = this.getAttribute('data-category-name');
                filterByCategory(categoryId, categoryName);
            });
        });
        
        // Add event listeners to sidebar categories
        document.querySelectorAll('#sidebar-categories a').forEach(link => {
            link.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-category-id');
                const categoryName = this.textContent.split(' ')[0]; // Get category name without count
                filterByCategory(categoryId, categoryName);
            });
        });
        
        // Search form handler
        document.getElementById('search-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const searchTerm = document.getElementById('search-input').value.trim();
            searchPosts(searchTerm);
        });
    });

    function filterByCategory(categoryId, categoryName) {
        currentCategory = categoryId;
        currentPage = 1;
        currentSearch = '';
        
        // Update active states
        updateActiveCategory(categoryId);
        
        // Update filter indicator
        updateFilterIndicator(categoryName);
        
        // Load posts
        loadPosts();
        
        // Scroll to posts section
        document.getElementById('all-posts').scrollIntoView({ behavior: 'smooth' });
    }

    function clearFilter() {
        currentCategory = 0;
        currentPage = 1;
        currentSearch = '';
        
        // Update active states
        updateActiveCategory(0);
        
        // Clear filter indicator
        document.getElementById('filter-indicator').innerHTML = '';
        
        // Load posts
        loadPosts();
    }

    function updateActiveCategory(categoryId) {
        // Update category cards
        document.querySelectorAll('.category-card').forEach(card => {
            if (card.getAttribute('data-category-id') == categoryId) {
                card.classList.add('active');
            } else {
                card.classList.remove('active');
            }
        });
        
        // Update sidebar categories
        document.querySelectorAll('#sidebar-categories a').forEach(link => {
            if (link.getAttribute('data-category-id') == categoryId) {
                link.parentElement.classList.add('active');
            } else {
                link.parentElement.classList.remove('active');
            }
        });
    }

    function updateFilterIndicator(categoryName) {
        const filterIndicator = document.getElementById('filter-indicator');
        if (currentCategory > 0) {
            filterIndicator.innerHTML = `
                <div class="filter-active">
                    Showing posts in: <strong>${categoryName}</strong>
                    <button class="clear-filter" onclick="clearFilter()">× Clear</button>
                </div>`;
        } else {
            filterIndicator.innerHTML = '';
        }
    }

    function searchPosts(searchTerm) {
        currentSearch = searchTerm;
        currentCategory = 0;
        currentPage = 1;
        
        // Clear active categories
        updateActiveCategory(0);
        
        // Update filter indicator for search
        const filterIndicator = document.getElementById('filter-indicator');
        if (searchTerm) {
            filterIndicator.innerHTML = `
                <div class="filter-active">
                    Search results for: <strong>"${searchTerm}"</strong>
                    <button class="clear-filter" onclick="clearSearch()">× Clear</button>
                </div>
            `;
        } else {
            filterIndicator.innerHTML = '';
        }
        
        loadPosts();
    }

    function clearSearch() {
        document.getElementById('search-input').value = '';
        currentSearch = '';
        clearFilter();
    }

    function loadPosts() {
        const postsContainer = document.getElementById('posts-container');
        const paginationContainer = document.getElementById('pagination-container');
        
        // Show loading
        postsContainer.innerHTML = `
            <div class="loading-spinner">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Loading posts...</p>
            </div>
        `;
        
        // Build URL with parameters
        let url = `blog-ajax.php?action=get_posts&page=${currentPage}`;
        if (currentCategory > 0) {
            url += `&category=${currentCategory}`;
        }
        if (currentSearch) {
            url += `&search=${encodeURIComponent(currentSearch)}`;
        }
        
        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    renderPosts(data.posts);
                    renderPagination(data.totalPages, data.totalPosts);
                } else {
                    postsContainer.innerHTML = `<div class="alert alert-danger">Error loading posts: ${data.message}</div>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                postsContainer.innerHTML = '<div class="alert alert-danger">Error loading posts. Please try again.</div>';
            });
    }

    function renderPosts(posts) {
        const postsContainer = document.getElementById('posts-container');
        
        if (posts.length === 0) {
            let message = 'No blog posts available.';
            if (currentCategory > 0) {
                message = 'No posts found in this category.';
            } else if (currentSearch) {
                message = 'No posts found matching your search.';
            }
            
            postsContainer.innerHTML = `
                <div class="text-center py-5">
                    <h4>${message}</h4>
                    <p>Try selecting a different category or <a href="javascript:void(0)" onclick="clearFilter()">view all posts</a></p>
                </div>
            `;
            return;
        }
        
        let html = '<div class="posts-grid">';
        
        posts.forEach(post => {
            html += `
                <article class="post-card standard">
                    <div class="post-image">
                        <img src="${post.featured_image || 'assets/img/1.jpg'}" alt="${post.title}" class="img-fluid">
                        <div class="post-badge">New</div>
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span class="post-category">${post.category_name}</span>
                            <span class="post-date"><i class="bi bi-calendar"></i> ${formatDate(post.published_at)}</span>
                        </div>
                        <h3><a href="blog-single.php?id=${post.id}">${post.title}</a></h3>
                        <p>${post.excerpt || (post.content.substring(0, 150) + '...')}</p>
                        <div class="post-footer">
                            <div class="author-info">
                                <img src="assets/img/2.jpg" alt="Author" class="author-avatar">
                                <span>By ${post.author_name}</span>
                            </div>
                            <div class="post-stats">
                                <span><i class="bi bi-clock"></i> ${post.read_time} min read</span>
                                <span><i class="bi bi-chat"></i> 0 comments</span>
                            </div>
                        </div>
                    </div>
                </article>
            `;
        });
        
        html += '</div>';
        postsContainer.innerHTML = html;
    }

    function renderPagination(totalPages, totalPosts) {
        const paginationContainer = document.getElementById('pagination-container');
        
        if (totalPages <= 1) {
            paginationContainer.innerHTML = '';
            return;
        }
        
        let html = `
            <nav class="blog-pagination">
                <ul class="pagination">
        `;
        
        // Previous button
        if (currentPage > 1) {
            html += `
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" onclick="changePage(${currentPage - 1})" aria-label="Previous">
                        <span aria-hidden="true">Previous</span>
                    </a>
                </li>
            `;
        }
        
        // Page numbers
        const startPage = Math.max(1, currentPage - 2);
        const endPage = Math.min(totalPages, currentPage + 2);
        
        for (let i = startPage; i <= endPage; i++) {
            html += `
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="javascript:void(0)" onclick="changePage(${i})">${i}</a>
                </li>
            `;
        }
        
        // Next button
        if (currentPage < totalPages) {
            html += `
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" onclick="changePage(${currentPage + 1})" aria-label="Next">
                        <span aria-hidden="true">Next</span>
                    </a>
                </li>
            `;
        }
        
        html += `
                </ul>
            </nav>
            <div class="text-center text-muted mt-3">
                Showing ${Math.min(6, totalPosts)} of ${totalPosts} posts
            </div>
        `;
        
        paginationContainer.innerHTML = html;
    }

    function changePage(page) {
        currentPage = page;
        loadPosts();
        
        // Scroll to posts section
        document.getElementById('all-posts').scrollIntoView({ behavior: 'smooth' });
    }

    function loadPopularPosts() {
        fetch('blog-ajax.php?action=get_popular_posts')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    renderPopularPosts(data.posts);
                }
            })
            .catch(error => {
                console.error('Error loading popular posts:', error);
            });
    }

    function renderPopularPosts(posts) {
        const container = document.getElementById('popular-posts-container');
        let html = '';
        
        posts.forEach(post => {
            html += `
                <div class="popular-post-item">
                    <div class="post-thumb">
                        <img src="${post.featured_image || 'assets/img/blog/popular-1.webp'}" alt="Popular Post">
                    </div>
                    <div class="post-info">
                        <h5><a href="blog-single.php?id=${post.id}">${post.title}</a></h5>
                        <span><i class="bi bi-calendar"></i> ${formatDate(post.published_at, 'short')}</span>
                    </div>
                </div>
            `;
        });
        
        container.innerHTML = html;
    }

    function formatDate(dateString, format = 'long') {
        const date = new Date(dateString);
        if (format === 'short') {
            return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
        } else {
            return date.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
        }
    }
  </script>
</body>
</html>
<?php $conn->close(); ?>