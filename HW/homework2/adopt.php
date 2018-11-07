<!DOCTYPE html>
<html>
   
    <head>
        <title> Homework 2: </title>
        <meta charset="utf-8"/>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    </head>
    
    <body>
        <h1 id= "title">Pet Randomizer</h1><br><br />
        <div id="randomizer">
                <p>Click the button to get random dogs or cats to adopt</p>
                <p>If you wish to change pet after press the retry button to get a different animal</p>
            
            <?php
                include 'inc/pet.php';
                choose_pet();
                
            ?>
            <form>
                <input type="submit" value="Retry"/>
            </form>
        </div>
    </body>
</html>