<?php
    session_start();
   
       
    function confirmationNum() {
        $confirmNum = rand(1000000,2000000);
        echo $confirmNum;
    }
    
     
    function displaySummary() {
        if(isset($_SESSION['cart'])) {
            foreach($_SESSION['cart'] as $vid) {
                $sum = $sum + $vid['price'];
            }
            $taxRate = 0.0725;
            $tax = $sum * $taxRate;
            
            echo "Number of Videos Being Rented: ".count($_SESSION['cart'])."<br>";
            echo "Subtotal: $".number_format($sum, 2)."<br>";
            
            echo "Tax: $".number_format($tax, 2)."<br>";
            
            echo "Total: $".number_format($sum + $tax, 2) . "<br/>";
            
            echo "You're Confirmation Number is: ";
            echo confirmationNum();
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Summary Page</title>
        <link href="./css/styles.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){
                $("#submit").click(function(){
                    var name=$("#name").val();
                    var email=$("#email").val();
                    var dataString = 'name='+ name + '&email=' + email;
                if(name==''||email==''){
                    alert("Please fill out all fields.");
                }else{
                $.ajax({
                   url:'submitForm.php',
                   method:'POST',
                   data: dataString,
				   cache: false,
				   success: function(result){
				    alert(result);
				    alert("Submission Successful!")
                    }
                });
                }
                return false;
                });
            });
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
          </ul>
        </div>
    </nav>
    <br/>
        <h2>Summary of Rentals</h2>
        <?php displaySummary();?>
        <br>
        </br>
        <form method='post' action="" onSubmit="return post();">
        <h1>Who's taking our babies home? Curfew is 9PM</h1>
        <div class="form-control">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-control">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-control">
            <input type="submit" id= "submit" name="submit" class='btn btn-primary' value="Rent Now!">
            <a class="btn btn-outline-primary" href="scart.php" role="button">Go Back to Cart</a>
        </div>
        </form>
        </div>
    </body>
</html>