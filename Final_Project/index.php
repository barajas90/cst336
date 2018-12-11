<?php
session_start();
include 'functions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Be Kind, Rewind Product Search </title>
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
            <h1> Be Kind, Rewind! </h1>
            <div id="intro">
                Welcome to <i>Be Kind, Rewind!</i> The best place to rent the dopest movies. We have
                a wide range of bad-ass movies! Search through our catalog, add to your cart, and simply give your 
                confirmation number to the cashier at your local <i>Be Kind, Rewind!</i> , and you'll be watching your movies in no time! It's easy as that!
                <br/><br/>
                Search Instructions: <br/>
                To search for a movie, simply type the title of the movie or a 'keyword' to search through movie descriptions.
                You can also select a category. 
            </div>
            <br/><br/>
            <div id="vhsPhoto">
                <img id='img' src='img/vhs.jpg'width="750" height="400" >
            </div>
            <br />
            <form>
                <div id="homepage">
                <strong>Movie: </strong> <input type="text" name="product"/>
                <br />
                <strong>Genre: </strong>
                    <select name="category">
                        <option value="">Select One</option>
                        <?=displayCategories()?>
                    </select>
                    <br />
                <strong>Price:   From </strong><input type="text" name="priceFrom" size="7" />
                       <strong>To </strong><input type="text" name="priceTo" size="7" />
                <br>
                <strong>Order result by:</strong>
                <br>
                <input type="radio" name="orderBy" value="price" /> <strong>Price </strong><br>
                <input type="radio" name="orderBy" value="name" /> <strong>Name </strong>
                
                <br /><br />
                <input type='submit' value='search' name='searchForm' />
                </div>
            </form>
            <br />
        </div>
        <hr>
        <?= displaySearchResults() ?>
        <footer> 
            <hr>
            Internet Programming. 1997&copy; Team VSE <br />
            <strong>Disclaimer:</strong> The information in this webpage is fictitous. <br />
            
            It is used for academic purposes only.
            
            <figure id="logo">
                <img src="img/csumb.jpg" alt="CSUMB logo" />
            </figure>
        </footer>
        
    </body>
</html>