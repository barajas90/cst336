<?php

    include 'dbConnection.php';
    $conn = getDatabaseConnection("ottermart");
    
    function displayCategories(){
        global $conn;
        
        $sql= "SELECT catID, catName from om_category ORDER BY catName";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($records); //Can be used to view results
        
        foreach($records as $record){
            echo"<option value='".$record["catId"]."' >" . $record["catName"] . "</option>";
        }
    }
    function displaySearchResults(){

    global $conn;
    if(isset($_GET['searchForm'])){ //checks wether user has submitted form
        echo"<h3>Products Found: </h3>";
        //Querry below prevents SQL injection
        $namedParameters = array();
        
        $sql = "SELECT * FROM om_product WHERE 1";
        
        if(!empty($_GET['product'])){//checks whether user has typed something in the "Product" text box
            $sql .=" AND productName LIKE :productName";
            $namedParameters[":productName"] = "%" . $_GET['product'] . "%";
        }
        
        if(!empty($_GET['product'])){//checks whether user has typed something in the "Product" text box
            $sql .=" or productDescription LIKE :productDescription";//looks through description as well and not only for productName
            $namedParameters[":productDescription"] = "%" . $_GET['product'] . "%";
        }
        
        if(!empty($_GET['category'])){ //checks whether the user has selected a category
            $sql .= " AND catId LIKE :categoryId";
            $namedParameters[":categoryId"] = $_GET['category'];
        }
        if(!empty($_GET['priceFrom'])){ //checks whether the user has typed something in the "price from" text box
            $sql .= "AND price >= :priceFrom";
            $namedParameters[":priceFrom"] = $_GET['priceFrom'];
        }
        if(!empty($_GET['priceTo'])){ //checks whether the user has typed something in the "Price To "text box
            $sql .= "AND price <= :priceTo";
            $namedParameters[":priceTo"] = $_GET['priceTo'];
        }
        if(isset($_GET['orderBy'])){
            if($_GET['orderBy'] == "price"){
                $sql .= "ORDER BY price";
            }else{
                $sql .= "ORDER BY productName";
            }
        }
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($records as $record){
            
            echo "<a href=\"purchaseHistory.php?productId=".$record["productId"]. "\">History</a>";
            echo $record["productName"]." " . $record["productDescription"] . " $" . $record["price"] . "<br /><br />";
        }
    }
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
            <br>
            Category: 
                <select name="category">
                    <option value=""> Select One </option>
                    <?= displayCategories()?>
                    </select>
            <br />
            Price: From <input type="text" name="priceFrom" size="7" />
                   To <input type="text" name="priceTo" size="7" />
                   
            <br />
            
            Order result by: 
            <br />
            
            <input type="radio" name="orderBy" value="price"/> Price <br/>
            <input type="radio" name="orderBy" value="name"/> Name
            
            <br /><br/>
            <input type="submit" value="Search" name="searchForm" />
            
        </form>
        
        <br />
            
        </div>
        
        <hr>
        <?=displaySearchResults()?>
    </body>
</html>