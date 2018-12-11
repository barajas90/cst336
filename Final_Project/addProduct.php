<?php
    session_start();
    
   
    include 'inc/dbConnection.php';
    
    $conn = getDatabaseConnection("VSE_rentals");
    
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    function displayCartCount() {
        echo count($_SESSION['cart']);
    }
    
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
        <link href="./css/styles.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    </head>
    
    <body>
        <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-primary rounded">
            <a class="navbar-brand" href="http://csumb.edu" target="_blank">CSUMB</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample09">
            <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php" id="home">
                    <i class="fp-home"></i>Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin.php" id = 'login'>
                <i class="adminLogin"></i>Admin Login</a>
            </li>
                <li class="nav-item">
                <a class="nav-link" href="about.php" id = 'about'>
                <i class="about-us"></i>About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="scart.php" id = 'cart'>
                <i class="videoCart"></i>Cart: <?php displayCartCount();?></a>
            </li>
          </ul>
        </div>
    </nav>
    <br/>
        <form action="addProduct.php" method="post">
            <strong>Name of Movie</strong> <input type="text" class="form-control" name="name"/><br>
            <strong>Rating</strong> <input type="text" class="form-control" name="rating"/><br>
            <strong>Description</strong> <textarea name="description" class="form-control" cols = 50 rows = 4></textarea><br>
            <strong>Category</strong> <select name="genreId" class="form-control">
                    <option value="">Select One</option>
                    <?php getCategories(); ?>
            </select><br>
            <strong>Set Image URL</strong><input type="text" name="picture" class="form-control"><br>
            <strong>Price</strong> <input type="text" class="form-control" name="price"/><br>
            <strong>Set Trailer URL</strong> <input type="text" name="trailer" class="form-control"><br>
            <input type="submit" name="submitProduct" class='btn btn-primary' value="Add Product"/>
        </form>
    </body>
</html>