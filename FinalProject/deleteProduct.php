<?php
    
    session_start();
    
    include 'inc/dbConnection.php';
    
    $conn = getDatabaseConnection('VSE_rentals');
    
    $sql = "DELETE
            FROM videos
            WHERE idVid = ". $_GET['productId'];
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    header("Location:admin.php")
    
?>