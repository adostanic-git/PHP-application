<?php 
require_once "../auth.php";
require_once "../../db.php";

$stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
$stmt->execute([$_GET['id']]);

header("Location: ../proizvodi.php");