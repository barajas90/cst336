<!DOCTYPE html>
<html>
   
    <head>
        <title> Homework 2: </title>
        <meta charset="utf-8"/>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
        <style tyype="text/css">
            body{
                margin: 0 auto;
                text-align: center;
                background-color: black;
                background-image:url("../img/background.png");
                color: white;
            }
        </style>
    </head>
    
    <body>
        <h1 id= "title">Guess That Number</h1><br><br />
        <div class="game">
            <?php
                $random = rand(0,5); 
                $guess = $_post['pguess'];
                $submit = $_post['enter'];
                $guesses = 10;
                if(isset($submit)){
                    if($guess==$random){
                        echo'<img class="winner" src="../img/win.jpg" alt="pic of Congrats" style="width=300px;height:100px;"></img>';
                        echo"<br>You win!<br>";
                        echo"Try again?<br>";
                        echo "<a href=../guessGame.html>Yes </a>";
                        echo "<a href=../noGame.html> No</a>";
                    }else{
                        echo"Sorry, you were wrong<br>Try again?<br>";
                        echo "<a href=../guessGame.html>Yes </a>";
                        echo "<a href=../noGame.html> No</a>";
                }
                }else{
                    header("location: ../guessGame.html");
                }
            ?>
        </div>
    </body>
</html>
