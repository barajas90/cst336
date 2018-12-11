<?php
    session_start();
    
    include 'inc/dbConnection.php';
    $conn = getDatabaseConnection();
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    $sql = "INSERT INTO rented
                (name, email) 
                VALUES(:name, :email)";
    
    $data = array(":name" => $name,":email" => $email);
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
    
?>