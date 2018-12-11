<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Login </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        
        <style>
            body{
                text-align: center;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>

        <h1> VS RENTALS - Admin Login</h1>
        
           <form method="POST" action="loginProcess.php">
            
                Username: <input type="text" name="adminName"/> <br /><br />
                Password: <input type="password" name="password"/> <br /><br />
            
                <input type="submit" name="submitForm" value="Login!"/>
                <br /><br />
                <?php
                    if($_SESSION['incorrect']){
                        echo "<p class = 'lead' id = 'error' style='color:red'>";
                        echo "<strong>Incorrect Username or Password!</strong></p>";
                }
                ?>
        </form>
        <br /><br />
        
        
       
    </body>
</html>