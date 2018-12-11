<?php
    session_start();
    
    include 'inc/dbConnection.php';
    
    $conn = getDatabaseConnection("VSE_rentals");
    
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
?>

<!DOCTYPE html>
<html>
    <head>
        
        <title>Admin Main Page</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        
        <script>
            function confirmDelete()
            {
                return confirm("Are you sure you want to delete the movie?")
            }
        </script>
    </head>
    
    <body>
        <h1>Admin Main Page</h1>
        
        <h3>Welcome <?=$_SESSION['adminName']?>!</h3><br />
        
        <form action = "addProduct.php">
            <input type="submit" class='btn btn-secondary' id = "beginning" name="addproduct" value= "Add Product"/>
        </form>
        
        <br>
        
        <form action = "logout.php">
            <input type="submit" class = 'btn btn-secondary' id="beginning" value="Logout"/>
        </form>
        
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
        
    
        
        