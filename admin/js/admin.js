// Admin panel functionality
document.addEventListener('DOMContentLoaded', function() {
    // Navigation
    document.querySelectorAll('.nav-link[data-section]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const section = this.getAttribute('data-section');
            showSection(section);
        });
    });
    
    // Logout functionality
document.querySelectorAll('#logoutBtn, #logoutBtn2').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        if (confirm('Are you sure you want to logout?')) {
            // Clear session and redirect
            fetch('admin/logout.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = 'login.html';
                    }
                })
                .catch(error => {
                    console.error('Logout error:', error);
                    window.location.href = 'login.html';
                });
        }
    });
});
    
    // Load initial data
    loadDashboardData();
    loadCategories();
    
    // Form submissions
    document.getElementById('postForm').addEventListener('submit', savePost);
    document.getElementById('categoryForm').addEventListener('submit', saveCategory);
});

function showSection(section) {
    // Hide all sections
    document.querySelectorAll('.content-section').forEach(sec => {
        sec.classList.add('d-none');
    });
    
    // Show selected section
    document.getElementById(`${section}-section`).classList.remove('d-none');
    
    // Update page title
    const titles = {
        'dashboard': 'Dashboard',
        'posts': 'Blog Posts',
        'add-post': 'Add New Post',
        'categories': 'Categories'
    };
    document.getElementById('pageTitle').textContent = titles[section] || 'Admin Panel';
    
    // Update active nav link
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
    });
    document.querySelector(`[data-section="${section}"]`).classList.add('active');
    
    // Load section-specific data
    if (section === 'posts') {
        loadPosts();
    }
}

async function loadDashboardData() {
    try {
        const response = await fetch('admin/api/posts.php');
        const result = await response.json();
        
        if (result.success) {
            const posts = result.data;
            
            // Update stats
            document.querySelectorAll('.stats-card h3')[0].textContent = posts.length;
            document.querySelectorAll('.stats-card h3')[1].textContent = document.querySelectorAll('#postCategory option').length - 1;
            document.querySelectorAll('.stats-card h3')[2].textContent = posts.filter(p => p.status === 'published').length;
            document.querySelectorAll('.stats-card h3')[3].textContent = posts.filter(p => p.status === 'draft').length;
            
            // Show recent posts
            let html = '';
            posts.slice(0, 3).forEach(post => {
                html += `
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                        <div>
                            <h6 class="mb-1">${post.title}</h6>
                            <small class="text-muted">${post.published_at ? new Date(post.published_at).toLocaleDateString() : 'Draft'} • ${post.status}</small>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-outline-primary me-1" onclick="editPost(${post.id})">Edit</button>
                            <button class="btn btn-sm btn-outline-danger" onclick="deletePost(${post.id})">Delete</button>
                        </div>
                    </div>
                `;
            });
            
            document.getElementById('recentPosts').innerHTML = html || '<p>No posts yet.</p>';
        }
    } catch (error) {
        console.error('Error loading dashboard data:', error);
        document.getElementById('recentPosts').innerHTML = '<p>Error loading posts.</p>';
    }
}

async function loadPosts() {
    try {
        const response = await fetch('admin/api/posts.php');
        const result = await response.json();
        
        if (result.success) {
            let html = '';
            result.data.forEach(post => {
                html += `
                    <div class="post-card">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h6 class="mb-1">${post.title}</h6>
                                <small class="text-muted">${post.category_name} • ${post.read_time} min read</small>
                            </div>
                            <div class="col-md-3">
                                <span class="badge ${post.status === 'published' ? 'bg-success' : 'bg-warning'}">
                                    ${post.status}
                                </span>
                            </div>
                            <div class="col-md-3 text-end">
                                <button class="btn btn-sm btn-outline-primary me-1" onclick="editPost(${post.id})">
                                    Edit
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="deletePost(${post.id})">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            document.getElementById('postsList').innerHTML = html || '<p>No posts found.</p>';
        }
    } catch (error) {
        console.error('Error loading posts:', error);
        document.getElementById('postsList').innerHTML = '<p>Error loading posts.</p>';
    }
}

async function loadCategories() {
    try {
        // Get categories from database
        const response = await fetch('admin/api/categories.php');
        const result = await response.json();
        
        if (result.success) {
            // Populate category dropdown
            let dropdownHtml = '<option value="">Select Category</option>';
            let listHtml = '';
            
            result.data.forEach(cat => {
                dropdownHtml += `<option value="${cat.id}">${cat.name}</option>`;
                listHtml += `
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                        <div>
                            <h6 class="mb-1">${cat.name}</h6>
                            <small class="text-muted">${cat.description}</small>
                        </div>
                        <div>
                            <span class="badge bg-secondary">${cat.post_count || 0} posts</span>
                            <button class="btn btn-sm btn-outline-danger ms-2" onclick="deleteCategory(${cat.id})">
                                Delete
                            </button>
                        </div>
                    </div>
                `;
            });
            
            document.getElementById('postCategory').innerHTML = dropdownHtml;
            document.getElementById('categoriesList').innerHTML = listHtml || '<p>No categories found.</p>';
        }
    } catch (error) {
        console.error('Error loading categories:', error);
        document.getElementById('categoriesList').innerHTML = '<p>Error loading categories.</p>';
    }
}

async function savePost(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const postData = {
        title: formData.get('title'),
        excerpt: formData.get('excerpt'),
        content: formData.get('content'),
        category_id: formData.get('category_id'),
        status: formData.get('status'),
        read_time: formData.get('read_time'),
        featured_image: formData.get('featured_image')
    };
    
    try {
        const response = await fetch('admin/api/posts.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(postData)
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('Post saved successfully!');
            e.target.reset();
            showSection('posts');
            loadPosts(); // Reload posts list
            loadDashboardData(); // Update dashboard
        } else {
            alert('Error saving post: ' + result.message);
        }
    } catch (error) {
        console.error('Error saving post:', error);
        alert('Error saving post. Please check console for details.');
    }
}

// ... rest of your existing functions