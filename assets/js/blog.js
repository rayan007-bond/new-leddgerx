// Blog Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
  // Search functionality
  const searchForm = document.querySelector('.search-form');
  if (searchForm) {
    searchForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const searchInput = this.querySelector('input[type="text"]');
      const searchTerm = searchInput.value.trim();
      
      if (searchTerm) {
        // Implement search functionality here
        console.log('Searching for:', searchTerm);
        // You can redirect to search results page or filter posts
        alert(`Search functionality would show results for: ${searchTerm}`);
        searchInput.value = '';
      }
    });
  }

  // Newsletter subscription
  const newsletterForm = document.querySelector('.newsletter-form');
  if (newsletterForm) {
    newsletterForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const emailInput = this.querySelector('input[type="email"]');
      const email = emailInput.value.trim();
      
      if (email && isValidEmail(email)) {
        // Simulate subscription
        const subscribeBtn = this.querySelector('.btn-subscribe');
        const originalText = subscribeBtn.textContent;
        
        subscribeBtn.textContent = 'Subscribing...';
        subscribeBtn.disabled = true;
        
        setTimeout(() => {
          subscribeBtn.textContent = 'Subscribed!';
          subscribeBtn.style.background = '#28a745';
          emailInput.value = '';
          
          setTimeout(() => {
            subscribeBtn.textContent = originalText;
            subscribeBtn.disabled = false;
            subscribeBtn.style.background = '';
          }, 2000);
        }, 1000);
      } else {
        alert('Please enter a valid email address.');
      }
    });
  }

  // Category filter functionality
  const categoryLinks = document.querySelectorAll('.categories-list a, .category-card');
  categoryLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const category = this.textContent.split(' ')[0]; // Get category name
      
      // Highlight active category
      categoryLinks.forEach(l => l.classList.remove('active'));
      this.classList.add('active');
      
      // Filter posts by category (simulated)
      filterPostsByCategory(category);
    });
  });

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

  // Post card hover effects
  const postCards = document.querySelectorAll('.post-card');
  postCards.forEach(card => {
    card.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-8px)';
    });
    
    card.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0)';
    });
  });

  // Helper functions
  function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  function filterPostsByCategory(category) {
    // This is a simplified version - in a real implementation, 
    // you would filter the actual posts or make an API call
    console.log(`Filtering posts by category: ${category}`);
    
    const posts = document.querySelectorAll('.post-card.standard');
    posts.forEach(post => {
      const postCategory = post.querySelector('.post-category').textContent;
      if (category === 'All' || postCategory === category) {
        post.style.display = 'block';
      } else {
        post.style.display = 'none';
      }
    });
  }

  // Initialize any third-party integrations
  console.log('Blog page loaded successfully');
});