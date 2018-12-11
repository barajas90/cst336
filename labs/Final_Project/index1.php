<?php
    include 'functions.php';
    include 'dbConnection.php';
    $conn = getDatabaseConnection("VS_RENTALS");
    //starts session in any php file where you will be using sessions
    session_start();
    
    //creates an array in the session to hold our cart items
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
    
    //checks to see if form is submitted
        if (isset($_GET['query'])){
            //get access to our api function
            include 'wmapi.php';
            $items=getProducts($_GET['query']);
            
        }
    
    if(isset($_POST['movieName'])){
    
        //Creating an array to hold an item's properties.
        $newMovie = array();
        $newMovie['name'] = $_POST['movieName'];
        $newMovie['id'] = $_POST['movieId'];
        $newMovie['price'] = $_POST['moviePrice'];
        $newMovie['image'] = $_POST['picture'];
        
        // Check to see if other items with this id are in the array   
        // If so, this item isn't new. Only update quantity
        // Must be passed by refrence so that each item can be updated!
        foreach($_SESSION['cart'] as &$item){ 
            if($newItem['id'] == $item['id']){
                $item['quantity'] += 1;
                $found = true;
            }
        }
        
        // Else add it to the array
        if($found != true){
            $newMovie['quantity'] = 1;
            array_push($_SESSION['cart'], $newMovie);
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title>VS RENTALS</title>
    </head>
    <body>
    <div class='container'>
        <div class='text-center'>
            
            <!-- Bootstrap Navagation Bar -->
            <nav class='navbar navbar-default - navbar-fixed-top'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='#'>VS RENTALS</a>
                    </div>
                    <ul class='nav navbar-nav'>
                        <li><a href='index.php'>Home</a></li>
                        <li><a href='scart.php'>
                        <span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'>
                        </span> Cart:<?php displayCartCount(); ?> </a></li>
                    </ul>
                </div>
            </nav>
            <br /> <br /> <br />
            
            <!-- Search Form -->
            <form enctype="text/plain">
                <div class="form-group"m
                    <label for="MName">Movie Name</label>
                    <input type="text" class="form-control" name="query" id="mName" placeholder="Name" >
                </div>
                <input type="submit" value="Submit" class="btn btn-default">
                <br /><br />
            </form>
            
            <!-- Display Search Results -->
            <?php displayResults(); ?>
        </div>
    </div>
    </body>
</html>