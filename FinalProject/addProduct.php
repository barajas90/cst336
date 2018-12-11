<?php
    session_start();
    
    include 'inc/dbConnection.php';
    
    $conn = getDatabaseConnection("VSE_rentals");
    
    function getCategories()
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
            echo "<option value='".$record['genreId'] . "'>". $record['genre'] . "</option>";
        }
    }
    
    if(isset($_GET['submitProduct']))
    {
        $name = $_GET['name'];
        $rating = $_GET['rating'];
        $description = $_GET['description'];
        $picture = $_GET['picture'];
        $price = $_GET['price'];
        $trailer = $_GET['trailer'];
        
        $sql = "INSERT INTO videos
                (name,rating,description,picture,price,trailer)
                VALUES (:name,:rating,:description,:picture,:price,:trailer)";
        
        $np = array();
        $np[':name'] = $name; 
        $np[':rating'] = $rating; 
        $np[':description'] = $description; 
        $np[':picture'] = $picture; 
        $np[':price'] = $price; 
        $np[':trailer'] = $trailer; 
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
        
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Movie</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    
    <body>
        <form>
            <strong>Name of Movie</strong> <input type="text" class="form-control" name="productName"/><br>
            <strong>Rating</strong> <input type="text" class="form-control" name="productRating"/><br>
            <strong>Description</strong> <textarea name="description" class="form-control" cols = 50 rows = 4></textarea><br>
            <strong>Category</strong> <select name="genreId" class="form-control">
                    <option value="">Select One</option>
                    <?php getCategories(); ?>
            </select><br>
            <strong>Set Image URL</strong> <input type="text" name="productImage" class="form-control"><br>
            <strong>Price</strong> <input type="text" class="form-control" name="productPrice"/><br>
            <strong>Set Trailer URL</strong> <input type="text" name="productTrailer" class="form-control"><br>
            <input type="submit" name="submitProduct" class='btn btn-primary' value="Add Product"/>
        </form>
    </body>
</html>