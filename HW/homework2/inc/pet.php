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
        <div class="pet">
            <?php>
                include 'inc/pet.php';
                choose_pet();
            ?>
            <?php
            $submit = $_post['enter'];
                function choose_pet() {
                    for ($i =1;$i<4;$i++){
                        ${"randomPet" . $i } = rand(0,9);
                        displayPet(${"randomPet" . $i}, $i);
                    }
                }
                function displayPet($randomPet, $pos){
                    switch($randomPet) {
                        case 0: ($pet= "Abyssinian");
                            break;
                        case 1:  ($pet= "bengal");
                            break;
                        case 2: ($pet= "persian");
                            break;
                        case 3: ($pet= "siamese");
                            break;
                        case 4: ($pet= "sphynx");
                            break;
                        case 5: ($pet= "beagle");
                            break;
                        case 6:  ($pet= "bulldog");
                            break;
                        case 7: ($pet= "chihuahua");
                            break;
                        case 8: ($pet= "dalmatian");
                            break;
                        case 9: ($pet= "german-shepherd");
                            break;
                        
                    }echo"<img id= 'reel$pos' src='img/$pet.jpg' alt='$pet' title= '". ucfirst($pet)."' width ='200' height='150'/>";
                }
            
            ?>
        </div>
    </body>
</html>