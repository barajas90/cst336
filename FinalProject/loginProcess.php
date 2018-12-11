<?php

    session_start();

    include 'inc/dbConnection.php';
    $conn = getDatabaseConnection('VSE_rentals');
    
    
    $adminName = $_POST['adminName'];
    $password = sha1($_POST['password']);
    
    $sql = "SELECT * 
            FROM admin
            WHERE adminName =:adminName
            AND password =:password";
    
    
    
    $np=array();
    $np[":adminName"] =$adminName;
    $np[":password"] =$password;
    
    $stmt=$conn->prepare($sql);
    $stmt->execute($np);
    $record=$stmt->fetch(PDO::FETCH_ASSOC);//expecting one single record
    
    if (empty($record)) {
        $_SESSION['incorrect']=true;
        header("Location:login.php");
        
    } else {
        $_SESSION['incorrect']=false;
        $_SESSION['adminName']=$record['firstName'] . " " . $record['lastName'];
        header("Location:admin.php");
        }
?>
<html>

</html>



