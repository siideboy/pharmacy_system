<?php
require_once '../config/database.php';
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) { echo json_encode(['error'=>'Unauthorized']); exit; }
$response = ['success'=>false];
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $action = $_POST['action']??'';
    if ($action=='create') {
        $name = $conn->real_escape_string($_POST['name']);
        $desc = $conn->real_escape_string($_POST['description']);
        $status = isset($_POST['status'])?1:0;
        $conn->query("INSERT INTO categories (category_name, description, is_active) VALUES ('$name','$desc',$status)");
        $response = ['success'=>true, 'message'=>'Added'];
    } elseif ($action=='update') {
        $id = intval($_POST['id']);
        $name = $conn->real_escape_string($_POST['name']);
        $desc = $conn->real_escape_string($_POST['description']);
        $status = isset($_POST['status'])?1:0;
        $conn->query("UPDATE categories SET category_name='$name', description='$desc', is_active=$status WHERE category_id=$id");
        $response = ['success'=>true];
    } elseif ($action=='delete') {
        $id = intval($_POST['id']);
        $conn->query("DELETE FROM categories WHERE category_id=$id");
        $response = ['success'=>true];
    }
}
echo json_encode($response);
?>