<?php
require_once '../config/Db.php';
header('Content-Type: application/json');

// Fetching posts
$stmt = $pdo->query("SELECT * FROM posts order by Id desc");
$posts = $stmt->fetchAll();

echo json_encode($posts);
