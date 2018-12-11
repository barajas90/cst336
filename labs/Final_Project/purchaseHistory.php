<?php
    include'dbConnection.php';
    
    $conn= getDatabaseConnection('ottermart');
    
    $productId= $_GET['productId'];
    
    $sql = "SELECT *
            FROM videos
            NATURAL JOIN genre_movie
            WHERE movieId = :mId";
            
    $np = array();
    $np[":mId"] = $movieId;
    
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo $records[0]['movieName'] . "<br/>";
    echo"<img src='" . $records[0]['picture'] . "'width='200'/><br/>";
    
    foreach($records as $record){
        
        echo"Purchase Date: " . $record["purchaseDate"] . "<br/>";
        echo"Unit Price: " . $record["unitPrice"] ."<br/>";
        echo"Qunatity: " . $record["quantity"] . "<br/>";
    }
?>
