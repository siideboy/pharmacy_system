<?php
$host = 'localhost';
$dbname = 'qan_medics';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) die("Connection failed");
session_start();
function isLoggedIn() { return isset($_SESSION['user_id']); }
?>