<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8" />
        <title>Homework 3: Marvel Quiz<title>  </title>
        <style>
            @import url("css/styles.css");
        </style>
    </head>
        <header>
            <h1> <strong>How well do you know Marvel? </strong></h1>
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <style>
            @import url("css/styles.css");
            body{
                background-image: url("img/marvel.jpg");
            }
        </style>
        </header>
        
<!-- Question 1 radio -->   
        <div class="container">

        <br /><br />
            <form class="questionForm" action="index.php" method="GET" >
            <fieldset>
                <label for="q1"><strong>1. Which Movie isn't from Marvel?</strong></label> 
            <br />
                <input class= "radio" type="radio" name="q1" value="captainAmerica">
                <label for= "captainAmerica">Captain America</label><br>
                
                <input type="radio" name="q1" value="ironMan">                       
                <label for="ironMan">Iron Man</label><br>
                
                <input type="radio" style="vertical-align: middle" name="q1" value="thor">                        
                <label for="thor">Thor</label><br>
                
                <input type="radio" name="q1" value="spawn">                        
                <label for="spawn">Spawn</label><br>
                
            </fieldset>  
<!-- Question 2 dropdown -->  
        <br />
            <fieldset><label for="Question2"><strong>2. Who created the Super Heroes from Marvel?</strong></label>
            <br />
                <select name="q2" required="required" placeholder="">
                    <option  value ="">Select One</option>
                    <option  value="warnerBros">Warner Bros.</option>
                        
                    <option  value="waltDisney">Walt Disney</option>
                    
                    <option value= "stanLee">Stan Lee</option>
                        
                </select>
                <br />
            </fieldset>        
<!-- Question 3 text --> 
        <br />
            <fieldset >
                <label for="Question3"><strong>3. How many claws does Wolverine have in one hand? 1-5</strong></label>
            <br />
                <input type="number" name="q3" min="1" max="5" placeholder="claws" value="<?=$_GET['claws']?>" />
                <br>
                <br />
            </fieldset> 

<!-- Question 4 checkboxes -->  
        <br />
            <fieldset> <label for="Question4"><strong>4. Who is the Hulk? </strong></label>
            <br />
                <label for="q4">Select the correct name: </label><br>
                
                <input id="bruceLee" type="checkbox" name="q4a" value="bruceLee">
                <label for="bruceLee">Bruce Lee</label><br>
                
                <input id="bruceBanner" type="checkbox" name="q4b" value="bruceBanner">
                <label for="bruceBanner">Bruce Banner</label><br>
                
                <input id="tonyStark" type="checkbox" name="q4c" value="tonyStark">
                <label for="tonyStark">Tony Stark</label><br>
                
                <input id="steveRogers" type="checkbox" name="q4d" value="steveRogers">
                <label for="steveRogers">Steve Rogers </label>
                <br />
            </fieldset>        
        
<!-- Question 5 radio  -->
        </br>
        <fieldset>
                <label for="q5"><strong>5. What is Spider Man's Secret Identity? </strong></label> 
            <br />
                <input type="radio" name="q5" value="lukeCage">
                <label for="lukeCage">Luke Cage</label><br>
                
                <input type="radio" name="q5" value="jonahJameson">                      
                <label for="jonahJameson">Jonah Jameson</label><br>
                
                <input type="radio" name="q5" value="steveRogers">                      
                <label for="steveRogers">Steve Rogers</label><br>
                 
                <input type="radio" name="q5" value="peterParker">                       
                <label for="peterParker">Peter Parker</label><br>
                
        </fieldset>  
        </br>
<!-- Question 6 dropdown -->  
        <br />
            <fieldset><label for="Question6"><strong>6. Who uses the Infinity Gauntlet?</strong></label>
            <br />
                <select name="q6" required="required" placeholder="">
                    <option  value ="">Select One</option>
                    <option  value="thanos">Thanos</option>
                        
                    <option  value="blackPanther">Black Panther</option>
                    
                    <option value= "stanLee">Stan Lee</option>
                    
                    <option value= "loki">Loki</option>
                        
                </select>
                <br />
            </fieldset> 
    
        </div>
            <div class="button">
            <input id="submit" name="submit" type="submit" value="Submit"/>
            </div>
    </form>
    <?php
        $totalScore=0;
        $answer1=$_GET['q1'];
        $answer2=$_GET['q2'];
        $answer3=$_GET['q3'];
        $answer4=$_GET['q4'];
        $answer5=$_GET['q5'];
        $answer6=$_GET['q6'];
    
        if(isset($_GET['submit'])){
            if($answer1=="spawn"){
                $totalScore++;
            }if($answer2=="stanLee"){
                $totalScore++;
            }if($answer3=="3"){
                $totalScore++;
            }if($answer4=="bruceBanner"){
                $totalScore++;
            }if($answer5=="peterParker"){
                $totalScore++;
            }if($answer6=="thanos"){
                $totalScore++;
            echo"<div id='results'>$totalScore / 6 correct</div>";
            }
        }
    
    ?>
    <footer id=info>
            <hr>
            CST 336 Internet Programming: 2018&copy; Barajas <br />
            <strong>Disclaimer:</strong> The information in this webpage is 
            fictitous. <br />
            It is used for academic purposes only.
            <figure>
            <img src="img/csumb.png" alt="csumb logo"/>
            </figure>
    </footer>
</html>