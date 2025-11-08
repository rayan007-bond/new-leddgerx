<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

// Include database configuration and authentication
require_once '../../config/database.php';
require_once '../auth.php';

// Manually call authentication check
requireAdminAuth();

// Get the request method
$method = $_SERVER['REQUEST_METHOD'];

// Authentication is now handled by auth.php

switch($method) {
    case 'GET':
        getPosts();
        break;
    case 'POST':
        createPost();
        break;
    case 'PUT':
        updatePost();
        break;
    case 'DELETE':
        deletePost();
        break;
    default:
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}

// ... rest of your functions remain the same
function getPosts() {
    global $conn;
    
    $sql = "SELECT bp.*, c.name as category_name, u.username as author_name 
            FROM blog_posts bp 
            LEFT JOIN categories c ON bp.category_id = c.id 
            LEFT JOIN users u ON bp.author_id = u.id 
            ORDER BY bp.created_at DESC";
    
    $result = $conn->query($sql);
    $posts = [];
    
    while($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
    
    echo json_encode(['success' => true, 'data' => $posts]);
}

function createPost() {
    global $conn;
    
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Validate required fields
    if (empty($input['title']) || empty($input['category_id'])) {
        echo json_encode(['success' => false, 'message' => 'Title and category are required']);
        return;
    }
    
    // Prepare data
    $title = $conn->real_escape_string($input['title']);
    $slug = createSlug($title);
    $excerpt = $conn->real_escape_string($input['excerpt'] ?? '');
    $content = $conn->real_escape_string($input['content'] ?? '');
    $category_id = intval($input['category_id']);
    $status = $conn->real_escape_string($input['status'] ?? 'draft');
    $read_time = intval($input['read_time'] ?? 5);
    $featured_image = $conn->real_escape_string($input['featured_image'] ?? '');
    
    // For demo - use first user as author
    $author_id = 1;
    
    // Prepare published_at date
    $published_at = ($status === 'published') ? 'NOW()' : 'NULL';
    
    $sql = "INSERT INTO blog_posts (title, slug, excerpt, content, author_id, category_id, status, read_time, featured_image, published_at) 
            VALUES ('$title', '$slug', '$excerpt', '$content', $author_id, $category_id, '$status', $read_time, '$featured_image', $published_at)";
    
    if ($conn->query($sql)) {
        echo json_encode(['success' => true, 'message' => 'Post created successfully', 'id' => $conn->insert_id]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error creating post: ' . $conn->error]);
    }
}

function updatePost() {
    global $conn;
    
    $input = json_decode(file_get_contents('php://input'), true);
    $id = intval($input['id']);
    
    // Similar to createPost but with UPDATE
    $title = $conn->real_escape_string($input['title']);
    $excerpt = $conn->real_escape_string($input['excerpt'] ?? '');
    $content = $conn->real_escape_string($input['content'] ?? '');
    $category_id = intval($input['category_id']);
    $status = $conn->real_escape_string($input['status'] ?? 'draft');
    $read_time = intval($input['read_time'] ?? 5);
    $featured_image = $conn->real_escape_string($input['featured_image'] ?? '');
    
    $sql = "UPDATE blog_posts SET 
            title = '$title',
            excerpt = '$excerpt',
            content = '$content',
            category_id = $category_id,
            status = '$status',
            read_time = $read_time,
            featured_image = '$featured_image',
            updated_at = NOW()
            WHERE id = $id";
    
    if ($conn->query($sql)) {
        echo json_encode(['success' => true, 'message' => 'Post updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating post: ' . $conn->error]);
    }
}

function deletePost() {
    global $conn;
    
    $input = json_decode(file_get_contents('php://input'), true);
    $id = intval($input['id']);
    
    $sql = "DELETE FROM blog_posts WHERE id = $id";
    
    if ($conn->query($sql)) {
        echo json_encode(['success' => true, 'message' => 'Post deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting post: ' . $conn->error]);
    }
}

function createSlug($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    
    if (empty($text)) {
        return 'n-a';
    }
    
    return $text;
}
?>