<?php
    session_start();
    session_destroy();
    include 'inc/dbConnection.php';
    
    $conn = getDatabaseConnection("VSE_rentals");
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    function displayCartCount() {
      echo count($_SESSION['cart']);
    }
    
    if(!isset($_SESSION['adminName']))
    {
        header("Location:login.php");
    }
    
    function displayAllMovies()
    {
        global $conn;
        $sql = "SELECT * 
                FROM videos
                ORDER BY idVid";
                
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $records; 
    }
    //aggregate average
    function averagePrice() {
        global $conn;
    
        $sql = "SELECT ROUND(AVG(price),2) AS AveragePrice
                FROM videos";
    
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $record;
    }
    //aggregate number of videos
    function numVids() {
        global $conn;
    
        $sql = "SELECT COUNT(1)
                FROM videos";
    
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $record;
    }
    //aggregate Gross
    function gross() {
        global $conn;
    
        $sql = "SELECT ROUND(sum(price),2) As GrossRental
                FROM videos";
    
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $record;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        
        <title>Admin Main Page</title>
        <link href="./css/styles.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script>
            function confirmDelete()
            {
                return confirm("Are you sure you want to delete the movie?")
            }
        </script>
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
        <h1>Admin Main Page</h1>
        
        <h3>Welcome <?=$_SESSION['adminName']?>!</h3><br />
        <div class="col-md-4 col-md-offset-4">
        <form action = "addProduct.php">
            <input type="submit" class='btn btn-secondary' id = "beginning" name="addproduct" value= "Add Product"/>
        </form>
        <br>
        <form action = "logout.php">
            <input type="submit" class = 'btn btn-secondary' id="beginning" value="Logout"/>
        </form>
        </div>
        
        <?php
            $averagePrice = averagePrice();
            $videoCount = numVids();
            $gross = gross();
            
            echo "<br>There are currently <strong>".$videoCount['COUNT(1)']."</strong> videos in stock.<br><br>";
            echo "The average price is: <strong>$".$averagePrice['AveragePrice']."</strong><br><br>";
            echo "Gross Rental Amount: <strong>$".$gross['GrossRental']."</strong><br><br>";
        ?>
        <?php
            $records = displayAllMovies();
            
            echo "<table class='table table-hover'>";
            echo "<thead>
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>Name</th>
                        <th scope='col'>Rating</th>
                        <th scope='col'>Description</th>
                        <th scope='col'>Picture</th>
                        <th scope='col'>Price</th>
                        <th scope='col'>Update</th>
                        <th scope='col'>Remove</th>
                    </tr>
                </thead>";
                
            echo "<tbody>";
            foreach($records as $record)
            {
                echo "<tr>";
                echo "<td>" . $record['idVid'] . "</td>";
                echo "<td>" . $record['name'] . "</td>";
                echo "<td>" . $record['rating'] . "</td>";
                echo "<td>" . $record['description'] . "</td>";
                echo "<td>" . $record['picture'] . "</td>";
                echo "<td>" . $record['price'] . "</td>";
                
                echo "<td><a class = 'btn btn-primary' href = 'updateProduct.php?idVid=".$record['idVid']."'>Update</a></td>";
                
                echo "<form action='deleteProduct.php' onsubmit='return confirmDelete()'>";
                echo "<input type='hidden' name='idVid' value= '" .$record['idVid'] ."' />";
                echo "<td><input type='submit' class = 'btn btn-danger' value='Remove'></td>";
                echo "</form>";
            }
            echo "</tbody>";
            echo "</table>";
        ?>
    </body>
</html>
        
    
        
        