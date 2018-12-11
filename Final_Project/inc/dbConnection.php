<?php
    function getDatabaseConnection($dbname = 'VSE_rentals') {
    
    $host = 'localhost'; 
    $username = 'root';
    $password = '';
    
    // creates db connection
    if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = $url["host"];
        $dbname = substr($url["path"], 1);
        $username = $url["user"];
        $password = $url["pass"];
    } 
    
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // display error when accessing tables
    
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $dbConn;
    
    }
?>
