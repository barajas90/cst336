<?php
session_start();

include 'inc/dbConnection.php';

$conn = getDatabaseConnection();

if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
}
if(isset($_POST['idVid'])) {
    $newVideo = array();
    $newVideo['idVid'] = $_POST['idVid'];
    $newVideo['name'] = $_POST['name'];
    $newVideo['picture'] = $_POST['picture'];
    $newVideo['price'] = $_POST['price'];
    
    foreach($_SESSION['cart'] as $vid) {
        if($newVideo['idVid'] == $vid['idVid']) {
            $found = true;
        }
    }
    
    if($found != true) {
        array_push($_SESSION['cart'], $newVideo);
    }
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
            $sql = "SELECT DISTINCT * FROM videos WHERE 1 AND name Like'%".$_GET['product']."%'";
            echo "<option value='".$record["genre"]."'>".$record["genre"]."</option>";
        }
    }
function displayCart() {
        global $records;
        if(isset($_SESSION['cart'])) {
            echo "<table class='table'>";
            echo "<thead>
                    <tr>
                        <th scope='col'>Picture</th>
                        <th scope='col'>Name</th>
                        <th scope='col'>Price</th>
                    </tr>
                    </thead>";
            echo "<tbody>";
        foreach($_SESSION['cart'] as $item) {
            $name = $item['name'];
            $price = $item['price'];
            $picture = $item['picture'];
            $idVid = $item['idVid'];
                
            echo "<tr>";
            
            echo "<td><img src='img/$picture'></td>";
            echo "<td><h4>$name</h4></td>";
            echo "<td><h4>$$price</h4></td>";
                
            // Hidden input element containing the item name
            echo "<form method='post'>";
            echo "<input type='hidden' name='removeVid' value='$idVid'>";
            echo "<td><button class='btn btn-danger'>Remove</button></td>";
            echo "</form>";
                
            echo "</tr>";
        }
    echo"</tbody>";
    echo "</table>";
    }
}

if(isset($_POST['removeVid'])) {
    foreach($_SESSION['cart'] as $itemKey => $item) {
        if($item['idVid']==$_POST['removeVid']) {
            unset($_SESSION['cart'][$itemKey]);
        }
    }
}

function displaySearchResults(){
        global $conn;
        global $records;
        if(isset($_GET['searchForm'])){ //checks whether user has submitted the form
            
            echo "<h3>Products Found: </h3>";
             //Query below prevents SQL Injection
             $namedParameters = array();
             
             $sql = "SELECT DISTINCT idVid, name, description, rating, price, picture, trailer FROM videos 
                     INNER JOIN genre_movie 
                     ON genre_movie.movieId = videos.idVid 
                     INNER JOIN genre 
                     ON genre.genreId = genre_movie.genreId WHERE 1";

            //filters the videos according to the form fields
            if (!empty($_GET['product'])){  //checks whether user has typed something in the "Product" text box
                $sql .= " AND (name LIKE :name)";
                $namedParameters[":name"] = $_GET["product"]."%";
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

            //displays the database feed with rent button
            foreach($records as $record){
                echo "<div id='border'> <br/>";
                echo '<span id="results">'."<strong>"."<h2>".$record['name']."</h2>" . "  " . "</strong>" ;
                echo imageSrc($record['picture']) . "<br/>". "Rating: " . $record["rating"] .  "<br/> " . "<strong>" 
                        . " $" . $record["price"] . "<br />"; 
                echo "<form method='POST'>";
                echo "<input type='hidden' name='idVid' value=" . $record['idVid'] . ">";
                echo "<input type='hidden' name='name' value=" . $record['name'] .">";
                echo "<input type='hidden' name='price' value=" .$record['price'] .">";
                echo "<input type='hidden' name='picture' value=".$record['picture'].">";
                if($_POST['idVid'] == $record['idVid']){
                echo 
                    "<td><button class='btn btn-success'>Rented</button></td>";
                    } else {
                        echo "<td><button class='btn btn-warning'>Rent</button></td>";
                        }
                echo "</form>";
                echo "<strong><i>" . $record["description"] . "</i></strong>" . "<br/><br/>";
                echo convertYoutube($record['trailer']) . "<br/><br/></div>";
                echo "<span />";
                echo "</div>";
                 
            }
        } 
    }
?>
