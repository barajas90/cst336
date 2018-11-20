<?php

include 'dbConnection.php';
$conn = getDatabaseConnection("ottermart");

?>
<?php
function displayCategories(){
    global $conn;
    
    $sql= "SELECT catID, catName from one om_category ORDER BY catName";
    
    $stmt = $conn = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getDatabaseConnection($dbname= 'ottermart'){
    
    $host = 'localhost';//cloud9
    //username = 'tcp';
    $username = 'root';
    $password = '';
    
    //creates db connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    //display errors when accessing tables
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $dbConn;
    
    
}
?>
<!DOCTYPE html>
<html>
    
    <head>
        <title> OtterMart Product Search </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        
        <div>
            <h1> OtterMart Product Search </h1>
        
        <form>
            
            Product: <input type="text" name="product" />
            <br />
            Product: <input type="text" name="product" />
            <br />
            Category: 
                <select name="category">
                    <option value=""> Select One </option>
                    <?=displayCategories()?>
                    </select>
                </br>
            
            Price: From <input type="text" name="priceFrom" size="7" />
                   To   <input type="text" name="priceTo" size="7" />
                   
            <br />
            
            Order result by: 
            <br />
            
            <input type="radio" name="orderBy" value="price"/> Price <br />
            <input type="radio" name="orderBy" value="name"/> Name
            
            <br /><br/>
            <input type="submit" value="Search" name="searchForm" />
            
        </form>
        
        <br />
            
        </div>
        
        <hr>
        
            </body>
</html>