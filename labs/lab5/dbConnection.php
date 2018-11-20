<?php
function displaySearchResults(){

    global $conn;
    if(isset($_GET['searchForm'])){ //checks wether user has submitted form
        echo"<h3>Products Found: </h3>";
        //Querry below prevents SQL injection
        $namedParamaters = array();
        
        $SQL = "Select * FROM om_product where 1";
        
        if(!empty($_GET['product'])){//checks whether user has typed something in the "Product" text box
            $sql .=" AND productName LIKE productName";
            $namedParameters[":productName"] = "%" . $_GET['product'] . "%";
        }
    }
}
?>
