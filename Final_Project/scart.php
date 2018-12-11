<?php
    session_start();    
    include 'functions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Vid Cart</title>
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
        <h1>Video Cart</h1>
        <!--<button type="button" class="btn btn-lg btn-primary btn-block" data-toggle="collapse" data-target="#results" aria-expanded="false" aria-controls="results">Proceed to Summary</button>-->
        <a class="btn btn-lg btn-primary btn-outline-danger btn-block" href="saleSummary.php" role="button">Proceed to Summary</a>
        <br/>
        <!--<div id="results" class="collapse">
        </div>
        <br/>-->
        <?php displayCart(); ?>
    </body>
</html>