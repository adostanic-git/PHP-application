<?php 

session_start();

if (!isset($_SESSION['user'])) {

    header("Location: login.php"); 
    die(); 
    
}

if ($_SESSION['user']['role_id'] == 1) {

} else {
    http_response_code(403);
    echo "Nemate dozvolu za pristup admin panelu!";
    die();
}