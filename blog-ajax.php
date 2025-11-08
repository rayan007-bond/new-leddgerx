<?php
include 'config/database.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

switch($action) {
    case 'get_posts':
        getPosts();
        break;
    case 'get_popular_posts':
        getPopularPosts();
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}

function getPosts() {
    global $conn;
    
    // Pagination setup
    $posts_per_page = 6;
    $current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $offset = ($current_page - 1) * $posts_per_page;
    
    // Build SQL query based on filters
    $where_conditions = ["bp.status = 'published'"];
    $params = [];
    
    // Category filter
    if (isset($_GET['category']) && $_GET['category'] > 0) {
        $where_conditions[] = "bp.category_id = ?";
        $params[] = intval($_GET['category']);
    }
    
    // Search filter
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search_term = '%' . $_GET['search'] . '%';
        $where_conditions[] = "(bp.title LIKE ? OR bp.content LIKE ? OR bp.excerpt LIKE ?)";
        $params[] = $search_term;
        $params[] = $search_term;
        $params[] = $search_term;
    }
    
    $where_clause = implode(' AND ', $where_conditions);
    
    // Get posts for current page
    $posts_sql = "SELECT bp.*, c.name as category_name, u.username as author_name 
                 FROM blog_posts bp 
                 LEFT JOIN categories c ON bp.category_id = c.id 
                 LEFT JOIN users u ON bp.author_id = u.id 
                 WHERE $where_clause 
                 ORDER BY bp.published_at DESC 
                 LIMIT $offset, $posts_per_page";
    
    $stmt = $conn->prepare($posts_sql);
    if (!empty($params)) {
        $types = str_repeat('s', count($params));
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $posts_result = $stmt->get_result();
    
    $posts = [];
    while($post = $posts_result->fetch_assoc()) {
        $posts[] = $post;
    }
    
    // Get total count for pagination
    $count_sql = "SELECT COUNT(*) as total 
                 FROM blog_posts bp 
                 WHERE $where_clause";
    
    $stmt = $conn->prepare($count_sql);
    if (!empty($params)) {
        $types = str_repeat('s', count($params));
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $count_result = $stmt->get_result();
    $total_posts = $count_result->fetch_assoc()['total'];
    $total_pages = ceil($total_posts / $posts_per_page);
    
    echo json_encode([
        'success' => true,
        'posts' => $posts,
        'totalPosts' => $total_posts,
        'totalPages' => $total_pages,
        'currentPage' => $current_page
    ]);
}

function getPopularPosts() {
    global $conn;
    
    $sql = "SELECT bp.*, c.name as category_name 
           FROM blog_posts bp 
           LEFT JOIN categories c ON bp.category_id = c.id 
           WHERE bp.status = 'published' 
           ORDER BY bp.published_at DESC 
           LIMIT 3";
    
    $result = $conn->query($sql);
    $posts = [];
    
    while($post = $result->fetch_assoc()) {
        $posts[] = $post;
    }
    
    echo json_encode([
        'success' => true,
        'posts' => $posts
    ]);
}
?>