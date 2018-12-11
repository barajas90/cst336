<?php
    session_start();
    
    include 'inc/dbConnection.php';
    
    $conn = getDatabaseConnection("VSE_rentals");
    
    if(isset($_GET['idVid']))
    {
        $product = getProductInfo();
    }
    
    function getProductInfo()
    {
        global $conn;
        $sql = "SELECT * 
                FROM videos
                WHERE idVid = " . $_GET['idVid'];
                
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $record;
    }
    
    function getCategories($genreId)
    {
        global $conn;
        
        $sql = "SELECT genreId, genre 
                FROM genre
                ORDER BY genre";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($records as $record)
        {
            echo "<option ";
            echo($record['genreId'] ==$genreId)? "selected": "";
            echo " value='" .$record['genreId'] . "'>". $record['genre'] . "</option>";
        }
        
        if(isset($_GET['updateProduct']))
        {
            $sql = "UPDATE videos
                    SET name = :name,
                        rating = :rating,
                        description = :description,
                        picture = :picture,
                        price = :price,
                        trailer = :trailer
                    WHERE idVid = :idVid";
            
            $np = array();
            $np[':name'] = $_GET['name']; 
            $np[':rating'] = $_GET['rating']; 
            $np[':description'] = $_GET['description']; 
            $np[':picture'] = $_GET['picture']; 
            $np[':price'] = $_GET['price']; 
            $np[':trailer'] = $_GET['trailer']; 
            $np[':idVid'] = $_GET['idVid'];
            
            $stmt = $conn->prepare($sql);
            $stmt->execute($np);
            echo "Product has been updated!";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Update Movie</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    
    <body>
        <form method="GET">
            <input type="hidden" name="idVid" value=<?=$product['idVid']?> >
            <strong>Name of Movie</strong> <input type="text" class="form-control" name="name" value =<?=$product['name']?> ><br>
            <strong>Rating</strong> <input type="text" class="form-control" name="rating" value = <?=$product['rating']?> ><br>
            <strong>Description</strong> <textarea name="description" class="form-control" cols = 50 rows = 4><?=$product['description']?></textarea><br>
            <strong>Category</strong> <select name="genreId" class="form-control">
                    <option value="">Select One</option>
                    <?php getCategories($product['genreId']); ?>
            </select><br>
            <strong>Set Image URL</strong> <input type="text" name="picture" class="form-control" value=<?=$product['picture']?>><br>
            <strong>Price</strong> <input type="text" class="form-control" value=<?=$product['price']?> name="price"/><br>
            <strong>Set Trailer URL</strong> <input type="text" name="trailer" class="form-control" value=<?=$product['trailer']?>><br>
            <input type="submit" name="updateProduct" class='btn btn-primary' value="Update Product"/>
        </form>
    </body>
</html>