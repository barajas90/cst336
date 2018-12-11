<?php
session_start();

include 'inc/dbConnection.php';

$conn = getDatabaseConnection();

if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
}
function displayCartCount() {
      echo count($_SESSION['cart']);
    }
function imageSrc($img) {
    echo "<img id='img' src='img/".$img."' width='100px' >";
}

function convertYoutube($string) {
	return preg_replace(
		"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
		"<iframe width=\"420\" height=\"315\" src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
		$string
	);
}

function displayCategories(){
        global $conn;
        $sql = "SELECT genre FROM genre ORDER BY genre";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($records); //can be used to view results
        
        foreach ($records as $record){
            echo "<option value='".$record["genre"]."'>".$record["genre"]."</option>";
            $sql = "SELECT DISTINCT * FROM videos WHERE 1 AND name Like '%" .$_GET['product']."%'";
        }
    }
    
function displaySearchResults(){
    global $conn;
        
        if(isset($_GET['searchForm'])){ //checks whether user has submitted the form
            
            echo "<h3>Products Found: </h3>";
             //Query below prevents SQL Injection
            $namedParameters = array();
            
            $sql = "SELECT DISTINCT idVid, name, description, rating, price, picture, trailer FROM videos 
                        INNER JOIN genre_movie 
                        ON genre_movie.movieId = videos.idVid 
                        INNER JOIN genre 
                        ON genre.genreId = genre_movie.genreId WHERE 1";
            /*
                OLD CODE:
                
            $sql = "SELECT * FROM videos
                    INNER JOIN genre_movie 
                        
                        ON genre_movie.id = videos.idVid
                    INNER JOIN  genre 
                        ON genre.genreId = genre_movie.genreId WHERE 1";
            */
            if (!empty($_GET['product'])){  //checks whether user has typed something in the "Product" text box
                $sql .= " AND (name LIKE :name OR description LIKE :name)";
                $namedParameters[":name"] = "%" . $_GET["product"] . "%";
            }
            
            if (!empty($_GET["category"])){  //checks whether user has selected a category
                $sql .= " AND genre = :genre";
                $namedParameters[":genre"] = $_GET["category"];
            }
            
            if (!empty($_GET["priceFrom"])){  //checks whether user has typed somthing in the "price From" text box
                $sql .= " AND price >= :priceFrom";
                $namedParameters[":priceFrom"] = $_GET["priceFrom"];
            }
            
            if (!empty($_GET['priceTo'])){
                $sql .= " AND price <= :priceTo";
                $namedParameters[":priceTo"] = $_GET["priceTo"];
            }
            
            if(isset($_GET["orderBy"])){
                if($_GET["orderBy"] == "price"){
                    $sql .= " ORDER BY price";
                } else {
                    $sql .= " ORDER BY name";
                }
            }
            
            $stmt = $conn->prepare($sql);
            $stmt->execute($namedParameters);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
            foreach($records as $record){
                //echo "<div id='results'><a href=\"purchaseHistory.php?productId=".$record["idVid"]. "\"> History </a>";
                echo "<div id='border'> <br/>";
                echo '<span id="results">'. "<strong>" ."<h2>" .  $record["name"] . "</h2>" . "  " . "</strong>" ;
                echo imageSrc($record['picture']) . "<br/>". "Rating: " . $record["rating"] .  "<br/> " . "<strong>" . " $" . $record["price"] . "</strong><br/><br/>" 
                        ."<strong><i>" . $record["description"] . "</i></strong>" . "<br/><br/>";
                echo convertYoutube($record['trailer']) . "<br/><br/></div>";
                echo "<span />";
                echo "</div>";
                 
            }
        } 
    }
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
                <strong>Movie: </strong> <input type="text" name="product" />
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
        <div>
<p><strong>Minimum requirements:</strong></p>
<p><strong>There is no partial credit</strong>&nbsp;for the minimum requirements. If any of the following elements is missing, you won't get the 10pts.</p>
<table border="1" cellpadding="3">
<tbody>
<tr>
<td>Documentation must include&nbsp;<strong>User Story, Mockup,</strong>&nbsp;<strong>Database Design</strong>&nbsp;(E/R Diagram) and&nbsp;<strong>Screenshots</strong></td>
<td rowspan="5">10pts</td>
</tr>
<tr>
<td style="background-color:#99E999">Project must use&nbsp;<strong>at least four database tables</strong></td>
</tr>
<tr>
<td style="background-color:#99E999">The combined database tables must have&nbsp;<strong>at least ten fields</strong></td>
</tr>
<tr>
<td style="background-color:#99E999"><span data-mce-mark="1"><span data-mce-mark="1">One of the database table must have&nbsp;</span><strong>at least 20 records</strong></span></td>
</tr>
</tbody>
</table>
<p></p>
<p><strong> Feature requirements:</strong></p>
<table border="1" cellpadding="3">
<tbody>
<tr>
<td style="background-color:#99E999">There is a "user" section in which users can search and filter data using at least three fields</td>
<td><br>&nbsp;5pts</td>
</tr>
<tr>
<td><span data-mce-mark="1">Users can add items to a shopping cart&nbsp;</span></td>
<td>&nbsp; 10pts</td>
</tr>
<tr>
<td>Users can see all items in their cart</td>
<td>&nbsp; 5pts</td>
</tr>
<tr>
<td><span data-mce-mark="1">Users can delete items from the shopping cart</span></td>
<td>&nbsp; 5pts</td>
</tr>
<tr>
<td><span data-mce-mark="1">A "Checkout" or "Summary" page displays the total cost of items (including tax and shipping)</span></td>
<td>&nbsp; 10pts</td>
</tr>
<tr>
<td><span data-mce-mark="1">Administrators can login and logout from the system</span></td>
<td>&nbsp; 5pts</td>
</tr>
<tr>
<td>Administrators can update content of at least one table&nbsp;(using pre-populated data in the form)</td>
<td>10pts</td>
</tr>
<tr>
<td>Administrators can insert new records in at least one table</td>
<td>10pts</td>
</tr>
<tr>
<td>Administrators can delete records</td>
<td>10pts</td>
</tr>
<tr>
<td>Administrators can generate at least three reports, which use aggregate functions (e.g., average price of all products in the table)</td>
<td>&nbsp;5pts</td>
</tr>
<tr>
<td>Project uses at least one AJAX call</td>
<td>10pts</td>
</tr>
<tr>
<td style="background-color:#99E999">Project has a nice and consistent design (preferably, use Bootstrap)</td>
<td>&nbsp;5pts</td>
</tr>
</tbody>
</table>
</div>
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