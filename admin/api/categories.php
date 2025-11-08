<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../../config/database.php';
require_once '../auth.php';

// Manually call authentication check
requireAdminAuth();

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    getCategories();
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}

function getCategories() {
    global $conn;
    
    $sql = "SELECT c.*, COUNT(bp.id) as post_count 
            FROM categories c 
            LEFT JOIN blog_posts bp ON c.id = bp.category_id 
            GROUP BY c.id 
            ORDER BY c.name";
    
    $result = $conn->query($sql);
    $categories = [];
    
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    
    echo json_encode(['success' => true, 'data' => $categories]);
}
?>