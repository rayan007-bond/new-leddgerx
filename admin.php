<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Admin Panel - Ledger X</title>
  
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  
  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  
  <style>
    :root {
      --primary: #065f46;
      --primary-light: #047857;
      --primary-dark: #064e3b;
      --primary-gradient: linear-gradient(135deg, #065f46 0%, #047857 100%);
      --secondary: #f8fafc;
      --accent: #10b981;
      --accent-light: #34d399;
      --text-dark: #1e293b;
      --text-light: #64748b;
      --text-lighter: #94a3b8;
      --border: #e2e8f0;
      --border-light: #f1f5f9;
      --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      --radius: 12px;
      --radius-lg: 16px;
      --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    * {
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      color: var(--text-dark);
      line-height: 1.6;
    }
    
    .admin-sidebar {
      background: var(--primary-gradient);
      color: white;
      min-height: 100vh;
      position: fixed;
      width: 280px;
      box-shadow: var(--shadow-xl);
      z-index: 1000;
      transition: var(--transition);
      backdrop-filter: blur(10px);
    }
    
    .admin-main {
      margin-left: 280px;
      background: transparent;
      min-height: 100vh;
      transition: var(--transition);
    }
    
    .sidebar-brand {
      padding: 30px 25px;
      border-bottom: 1px solid rgba(255,255,255,0.1);
      background: rgba(255,255,255,0.05);
      backdrop-filter: blur(10px);
    }
    
    .sidebar-brand h4 {
      font-weight: 700;
      letter-spacing: -0.5px;
      margin-bottom: 5px;
      font-size: 1.5rem;
    }
    
    .sidebar-brand small {
      font-size: 0.85rem;
      opacity: 0.9;
      font-weight: 400;
    }
    
    .sidebar-nav {
      padding: 25px 0;
    }
    
    .nav-link {
      color: rgba(255,255,255,0.85);
      padding: 16px 25px;
      border-left: 4px solid transparent;
      margin: 6px 15px;
      border-radius: 10px;
      font-weight: 500;
      transition: var(--transition);
      display: flex;
      align-items: center;
      position: relative;
      overflow: hidden;
    }
    
    .nav-link:before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
      transition: left 0.5s;
    }
    
    .nav-link:hover:before {
      left: 100%;
    }
    
    .nav-link:hover, .nav-link.active {
      color: white;
      background: rgba(255,255,255,0.12);
      border-left-color: var(--accent-light);
      transform: translateX(8px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    .nav-link i {
      margin-right: 15px;
      font-size: 1.2rem;
      width: 24px;
      text-align: center;
      transition: var(--transition);
    }
    
    .nav-link.active i {
      transform: scale(1.1);
    }
    
    .admin-header {
      background: rgba(255,255,255,0.95);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid var(--border-light);
      padding: 20px 35px;
      box-shadow: 0 2px 20px rgba(0,0,0,0.08);
      position: sticky;
      top: 0;
      z-index: 100;
    }
    
    .admin-content {
      padding: 35px;
    }
    
    .stats-card {
      background: white;
      border-radius: var(--radius-lg);
      padding: 30px;
      box-shadow: var(--shadow);
      border: 1px solid var(--border-light);
      transition: var(--transition);
      height: 100%;
      position: relative;
      overflow: hidden;
    }
    
    .stats-card:before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: var(--primary-gradient);
    }
    
    .stats-card:hover {
      transform: translateY(-8px);
      box-shadow: var(--shadow-xl);
    }
    
    .stats-card h3 {
      font-size: 2.75rem;
      font-weight: 800;
      background: var(--primary-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 8px;
      line-height: 1;
    }
    
    .stats-card p {
      color: var(--text-light);
      font-size: 0.95rem;
      font-weight: 500;
    }
    
    .stats-card .icon-wrapper {
      width: 60px;
      height: 60px;
      border-radius: 12px;
      background: rgba(6, 95, 70, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.75rem;
      color: var(--primary);
    }
    
    .post-card {
      background: white;
      border-radius: var(--radius-lg);
      padding: 30px;
      margin-bottom: 25px;
      box-shadow: var(--shadow);
      transition: var(--transition);
      border: 1px solid var(--border-light);
      position: relative;
    }
    
    .post-card:before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 1px;
      background: var(--primary-gradient);
      opacity: 0;
      transition: opacity 0.3s;
    }
    
    .post-card:hover {
      box-shadow: var(--shadow-xl);
      transform: translateY(-2px);
    }
    
    .post-card:hover:before {
      opacity: 1;
    }
    
    .post-card h5, .post-card h6 {
      color: var(--text-dark);
      font-weight: 700;
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 2px solid var(--border-light);
    }
    
    .btn-admin {
      background: var(--primary-gradient);
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 10px;
      font-weight: 600;
      transition: var(--transition);
      display: inline-flex;
      align-items: center;
      gap: 10px;
      position: relative;
      overflow: hidden;
    }
    
    .btn-admin:before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s;
    }
    
    .btn-admin:hover:before {
      left: 100%;
    }
    
    .btn-admin:hover {
      transform: translateY(-3px);
      box-shadow: var(--shadow-lg);
    }
    
    .btn-admin-outline {
      background: transparent;
      color: var(--primary);
      border: 2px solid var(--primary);
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: 600;
      transition: var(--transition);
    }
    
    .btn-admin-outline:hover {
      background: var(--primary);
      color: white;
      transform: translateY(-2px);
      box-shadow: var(--shadow);
    }
    
    .form-control, .form-select {
      border-radius: 10px;
      border: 2px solid var(--border);
      padding: 12px 18px;
      transition: var(--transition);
      font-size: 0.95rem;
    }
    
    .form-control:focus, .form-select:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(6, 95, 70, 0.1);
      transform: translateY(-2px);
    }
    
    .form-label {
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 10px;
      font-size: 0.95rem;
    }
    
    .dropdown-menu {
      border-radius: 12px;
      border: 1px solid var(--border-light);
      box-shadow: var(--shadow-xl);
      padding: 8px;
    }
    
    .dropdown-item {
      padding: 10px 16px;
      transition: var(--transition);
      border-radius: 8px;
      font-weight: 500;
    }
    
    .dropdown-item:hover {
      background-color: rgba(6, 95, 70, 0.08);
      transform: translateX(5px);
    }
    
    .badge-status {
      padding: 8px 16px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .badge-published {
      background: rgba(16, 185, 129, 0.15);
      color: #065f46;
      border: 1px solid rgba(16, 185, 129, 0.3);
    }
    
    .badge-draft {
      background: rgba(100, 116, 139, 0.15);
      color: #475569;
      border: 1px solid rgba(100, 116, 139, 0.3);
    }
    
    .post-item {
      padding: 24px;
      border-bottom: 1px solid var(--border-light);
      transition: var(--transition);
      border-radius: 8px;
      margin-bottom: 8px;
    }
    
    .post-item:hover {
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      transform: translateX(5px);
      box-shadow: var(--shadow);
    }
    
    .post-item:last-child {
      border-bottom: none;
    }
    
    .post-title {
      font-weight: 700;
      color: var(--text-dark);
      margin-bottom: 10px;
      font-size: 1.1rem;
    }
    
    .post-meta {
      font-size: 0.85rem;
      color: var(--text-light);
      display: flex;
      gap: 20px;
      align-items: center;
    }
    
    .post-meta span {
      display: flex;
      align-items: center;
      gap: 5px;
    }
    
    .category-item {
      padding: 20px;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      border-radius: 12px;
      margin-bottom: 16px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: var(--transition);
      border: 1px solid var(--border-light);
    }
    
    .category-item:hover {
      transform: translateY(-3px);
      box-shadow: var(--shadow);
    }
    
    .category-name {
      font-weight: 600;
      color: var(--text-dark);
      font-size: 1.05rem;
    }
    
    .category-count {
      background: var(--primary-gradient);
      color: white;
      border-radius: 50%;
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.85rem;
      font-weight: 700;
      box-shadow: var(--shadow);
    }
    
    .section-title {
      font-weight: 800;
      color: var(--text-dark);
      margin-bottom: 30px;
      position: relative;
      padding-bottom: 15px;
      font-size: 1.75rem;
    }
    
    .section-title:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 4px;
      background: var(--primary-gradient);
      border-radius: 2px;
    }
    
    .content-section {
      animation: fadeIn 0.5s ease-in-out;
    }
    
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    /* Loading animation */
    .loading-spinner {
      display: inline-block;
      width: 20px;
      height: 20px;
      border: 3px solid rgba(255,255,255,.3);
      border-radius: 50%;
      border-top-color: #fff;
      animation: spin 1s ease-in-out infinite;
    }
    
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
    
    /* Notification style */
    .notification {
      position: fixed;
      top: 20px;
      right: 20px;
      padding: 16px 24px;
      border-radius: 12px;
      background: white;
      box-shadow: var(--shadow-xl);
      border-left: 4px solid var(--accent);
      transform: translateX(400px);
      transition: transform 0.3s ease;
      z-index: 9999;
    }
    
    .notification.show {
      transform: translateX(0);
    }
    
    /* Responsive adjustments */
    @media (max-width: 1200px) {
      .admin-content {
        padding: 25px;
      }
      
      .stats-card {
        padding: 25px;
      }
    }
    
    @media (max-width: 992px) {
      .admin-sidebar {
        width: 80px;
        overflow: hidden;
      }
      
      .admin-sidebar:hover {
        width: 280px;
      }
      
      .admin-main {
        margin-left: 80px;
      }
      
      .sidebar-brand h4, .sidebar-brand small, .nav-link span {
        opacity: 0;
        transition: opacity 0.3s ease;
      }
      
      .admin-sidebar:hover .sidebar-brand h4,
      .admin-sidebar:hover .sidebar-brand small,
      .admin-sidebar:hover .nav-link span {
        opacity: 1;
      }
    }
    
    @media (max-width: 768px) {
      .admin-sidebar {
        width: 100%;
        height: auto;
        min-height: auto;
        position: relative;
      }
      
      .admin-main {
        margin-left: 0;
      }
      
      .admin-content {
        padding: 20px;
      }
      
      .sidebar-nav {
        display: flex;
        overflow-x: auto;
        padding: 15px 10px;
        gap: 5px;
      }
      
      .nav-item {
        flex-shrink: 0;
      }
      
      .nav-link {
        border-left: none;
        border-bottom: 3px solid transparent;
        margin: 0;
        padding: 12px 16px;
        min-width: 120px;
        justify-content: center;
        text-align: center;
        flex-direction: column;
        gap: 5px;
      }
      
      .nav-link i {
        margin-right: 0;
        font-size: 1.3rem;
      }
      
      .nav-link span {
        font-size: 0.8rem;
      }
      
      .nav-link:hover, .nav-link.active {
        border-left-color: transparent;
        border-bottom-color: var(--accent);
        transform: translateY(-5px);
      }
      
      .stats-card h3 {
        font-size: 2.25rem;
      }
    }
    
    @media (max-width: 576px) {
      .admin-header {
        padding: 15px 20px;
      }
      
      .admin-content {
        padding: 15px;
      }
      
      .post-card {
        padding: 20px;
      }
      
      .stats-card {
        padding: 20px;
      }
    }
  </style>
</head>

<body>
  <!-- Notification Area -->
  <div id="notificationArea"></div>
  
  <!-- Sidebar -->
  <div class="admin-sidebar">
    <div class="sidebar-brand">
      <h4 class="mb-0 text-white">Ledger X Admin</h4>
      <small class="text-white">Blog Management</small>
    </div>
    
    <nav class="sidebar-nav">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="#dashboard" data-section="dashboard">
            <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#posts" data-section="posts">
            <i class="bi bi-file-text"></i> <span>Blog Posts</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#add-post" data-section="add-post">
            <i class="bi bi-plus-circle"></i> <span>Add New Post</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#categories" data-section="categories">
            <i class="bi bi-tags"></i> <span>Categories</span>
          </a>
        </li>
        <li class="nav-item mt-4">
          <a class="nav-link" href="#" id="logoutBtn">
            <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
  
  <!-- Main Content -->
  <div class="admin-main">
    <!-- Header -->
    <div class="admin-header">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold" id="pageTitle">Dashboard Overview</h5>
        <div class="d-flex align-items-center">
          <span class="me-3 text-muted">Welcome, <span class="fw-semibold text-dark"><?php echo isset($_SESSION['admin_username']) ? htmlspecialchars($_SESSION['admin_username']) : 'Admin'; ?></span></span>
          <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle me-2"></i> Account
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#" id="logoutBtn2"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Content Sections -->
    <div class="admin-content">
      
      <!-- Dashboard Section -->
      <div id="dashboard-section" class="content-section">
        
        <div class="row mb-5">
          <div class="col-md-3 mb-4">
            <div class="stats-card">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                  <h3 id="totalPosts">12</h3>
                  <p class="text-muted mb-0">Total Posts</p>
                </div>
                <div class="ms-3">
                  <div class="icon-wrapper">
                    <i class="bi bi-file-text"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="stats-card">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                  <h3 id="totalCategories">6</h3>
                  <p class="text-muted mb-0">Categories</p>
                </div>
                <div class="ms-3">
                  <div class="icon-wrapper">
                    <i class="bi bi-tags"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="stats-card">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                  <h3 id="publishedPosts">8</h3>
                  <p class="text-muted mb-0">Published</p>
                </div>
                <div class="ms-3">
                  <div class="icon-wrapper">
                    <i class="bi bi-check-circle"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="stats-card">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                  <h3 id="draftPosts">4</h3>
                  <p class="text-muted mb-0">Drafts</p>
                </div>
                <div class="ms-3">
                  <div class="icon-wrapper">
                    <i class="bi bi-pencil-square"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-12">
            <div class="post-card">
              <h5>Recent Posts</h5>
              <div id="recentPosts">
                <!-- Recent posts will be loaded here -->
                <div class="text-center py-4">
                  <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                  <p class="text-muted mt-2">Loading recent posts...</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Posts Section -->
      <div id="posts-section" class="content-section d-none">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="section-title">All Blog Posts</h3>
          <button class="btn btn-admin" onclick="showSection('add-post')">
            <i class="bi bi-plus"></i> Add New Post
          </button>
        </div>
        <div id="postsList">
          <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
            <p class="text-muted mt-2">Loading posts...</p>
          </div>
        </div>
      </div>
      
      <!-- Add Post Section -->
      <div id="add-post-section" class="content-section d-none">
        <!-- <h3 class="section-title">Add New Blog Post</h3> -->
        <form id="postForm">
          <div class="row">
            <div class="col-md-8">
              <div class="post-card">
                <div class="mb-4">
                  <label for="postTitle" class="form-label">Post Title</label>
                  <input type="text" class="form-control" id="postTitle" name="title" placeholder="Enter a compelling title" required>
                </div>
                
                <div class="mb-4">
                  <label for="postExcerpt" class="form-label">Excerpt</label>
                  <textarea class="form-control" id="postExcerpt" name="excerpt" rows="3" placeholder="Brief description of your post"></textarea>
                  <div class="form-text">A short summary that will appear in blog listings.</div>
                </div>
                
                <div class="mb-0">
                  <label for="postContent" class="form-label">Content</label>
                  <textarea class="form-control" id="postContent" name="content" rows="12" placeholder="Write your post content here..."></textarea>
                </div>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="post-card mb-4">
                <h6>Publish</h6>
                <div class="mb-3">
                  <label for="postStatus" class="form-label">Status</label>
                  <select class="form-select" id="postStatus" name="status">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                  </select>
                </div>
                
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-admin">
                    <i class="bi bi-save"></i> Save Post
                  </button>
                </div>
              </div>
              
              <div class="post-card mb-4">
                <h6>Categories</h6>
                <div class="mb-3">
                  <label for="postCategory" class="form-label">Category</label>
                  <select class="form-select" id="postCategory" name="category_id" required>
                    <option value="">Select Category</option>
                    <option value="1">Investing</option>
                    <option value="2">Trading</option>
                    <option value="3">Cryptocurrency</option>
                    <option value="4">Personal Finance</option>
                  </select>
                </div>
              </div>
              
              <div class="post-card">
                <h6>Post Settings</h6>
                <div class="mb-3">
                  <label for="postReadTime" class="form-label">Read Time (minutes)</label>
                  <input type="number" class="form-control" id="postReadTime" name="read_time" value="5" min="1">
                </div>
                
                <div class="mb-0">
                  <label for="featuredImage" class="form-label">Featured Image URL</label>
                  <input type="url" class="form-control" id="featuredImage" name="featured_image" placeholder="https://example.com/image.jpg">
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      
      <!-- Categories Section -->
      <div id="categories-section" class="content-section d-none">
        <!-- <h3 class="section-title">Categories</h3> -->
        <div class="row">
          <div class="col-md-6">
            <div class="post-card">
              <h6>Add New Category</h6>
              <form id="categoryForm">
                <div class="mb-3">
                  <label for="categoryName" class="form-label">Category Name</label>
                  <input type="text" class="form-control" id="categoryName" name="name" placeholder="Enter category name" required>
                </div>
                <div class="mb-4">
                  <label for="categoryDescription" class="form-label">Description</label>
                  <textarea class="form-control" id="categoryDescription" name="description" rows="3" placeholder="Brief description of this category"></textarea>
                </div>
                <button type="submit" class="btn btn-admin">Add Category</button>
              </form>
            </div>
          </div>
          <div class="col-md-6">
            <div class="post-card">
              <h6>Existing Categories</h6>
              <div id="categoriesList">
                <div class="text-center py-4">
                  <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                  <p class="text-muted mt-2">Loading categories...</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  <script src="admin/js/admin.js"></script>
</body>
</html>