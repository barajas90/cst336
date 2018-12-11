
<?php
session_start();

session_destroy();

include 'dbConnection.php';

$conn = getDatabaseConnection();

function imageSrc($img) {
    echo "<img id='img' src='$img' width='100px' >";
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
            $sql = "SELECT * FROM videos WHERE 1 AND name Like '%" .$_GET['product']."%'";
        }
    }
    
    /*add sql code:$sql = "SELECT * FROM videos INNER JOIN genre_movie ON genre_movie.movieId = videos.idVid
        INNER JOIN  genre ON genre.genreId = genre_movie.genreId WHERE 1";
    
    
    
    */
    
    function displaySearchResults(){
        global $conn;
        
        if(isset($_GET['searchForm'])){ //checks whether user has submitted the form
            
            echo "<h3>Products Found: </h3>";
             //Query below prevents SQL Injection
            
            $namedParameters = array();
            $sql = "SELECT DISTINCT * FROM videos INNER JOIN genre_movie ON genre_movie.movieId = videos.idVid
                    INNER JOIN  genre ON genre.genreId = genre_movie.genreId WHERE 1";
            
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
                echo '<span id="results">' . $record["name"] . "  " . $record["rating"] . " $" . $record["price"] . "<br/>";
                echo imageSrc($record['picture']) . "<br/><br/> " . $record["description"] . "<br/><br/>";
                echo convertYoutube($record['trailer']) . "<br/><br/></div>";
                echo "<span />";
               
            }
        } 
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Be Kind, Rewind Product Search </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
        <div>
            <h1> Be Kind, Rewind! Video Rental </h1>
            <form>
                <div id="homepage">
                <strong>Product: </strong> <input type="text" name="product" />
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
    </body>
</html>
            
