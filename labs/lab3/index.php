<?php
    $backgroundImage = "img/sea.jpg";
    
    //API call goes here
    if(isset($_GET['keyword']) || isset($_GET['category'])){
            include 'api/pixabayAPI.php';
            $keyword = $_GET['keyword'];
            $imageURLs = getImageURLs(['$keyword'], $_GET['layout']);
            $backgroundImage = $imageURLs[array_rand($imageURLs)];
            
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Lab3: Image Carousel </title>
        <meta charset="utf-8">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <style>
            @import url("css/styles.css");
            body{
                background-image: url(<?=$backgroundImage?>);
            }
        </style>
    </head>
    <body>
    <br>
    <?php
        if(empty($keyword)){
            echo "<h2>Type a keyword to display a slideshow with random images from Pixabay.com </h2>";
            
        }else{  //display carousel here
            
            
    ?>
    
    <div id ="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!--indicators here-->
        <ol class="carousel-indicators">
        <?php
            for($i=0;$i<7;$i++){
                echo"<li data-target='#carousel-example-generic' data-slide-to='$i'";
                echo($i == 0) ? "class='active'" : "";
                echo "></li>";
            }
        ?>
        </ol>
        <!--Wrapper for images-->
        <div class ="carousel-inner" role="listbox">
            <?php
                for($i = 0;$i<7;$i++){
                    do{
                        $randomIndex = rand(0, count($imageURLs));
                    } while(!isset($imageURLs[$randomIndex]));
                    
                        echo'<div class = "carousel-item ';
                        echo ($i == 0) ? "active" : "";
                        echo '">';
                        echo '<img src="' . $imageURLs[$randomIndex] . '">';
                        echo '</div>';
                        unset($imageURLs[$randomIndex]);
                }
            ?>
        </div>
        <!-- Controls Here -->
            <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
        </div>
        <?php
            }    //endElse
        ?>
        <br>
        <form>
            <input type="text" name="keyword" placeholder="keyword" value="<?=$_GET['keyword']?>"/>
            <input type="radio"  id="lhorizontal" name="layout" value="horizontal" >
            <label for = "Horizontal"></label><label for="lhorizontal"> Horizontal </label>
            <input type="radio" id="lvertical" name="layout" value="vertical">
            <label for= "Vertical"></label><label for="lvertical"> Vertical </label>
            <select name= "category">
                <option value="">Select One </option>
                <option value="ocean" >Sea</option>
                <option value="forest" >Forest</option>
                <option value="mountain">Mountain</option>
                <option value="snow" >Snow</option>
                <option value="fire" >Fire</option>
            </select>
            <input type="submit" value="Search" />
        </form>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        </body>
</html>

<?php
    $backgroundImage = "img/sea.jpg";
    
    //API call goes here
    if(isset($_GET['keyword']) || isset($_GET['category'])) {
        include 'api/pixabayAPI.php';
         if($_GET['keyword'] != '') {
            $imageURLs = getImageURLs($_GET['keyword'], $_GET['layout']);
            $backgroundImage = $imageURLs[array_rand($imageURLs)];
        }
            elseif($_GET['category'] != "") {
        $imageURLs = getImageURLs($_GET['category'], $_GET['layout']);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    }

}
    

?>

<!DOCTYPE html>
<html>
    <head>

        <title>Image Carousel</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <style>
            @import url("css/styles.css");
            body {
                background-image: url('<?=$backgroundImage ?>');
            }
        </style>
    </head>
    <body>
        <br /><br />
        
        <form>
            <input type="text" name="keyword" placeholder="Keyword" value="<?=$_GET['keyword']?>"/>
            <input type="radio" id="lhorizontal" name="layout" value= "horizontal">
            <label for="Horizontal"></label><label for="lhorizontal"> Horizontal </label>
            <input type ="radio" id ="lvertical" name ="layout" value ="vertical">
            <label for = "Vertical"></label><label for="lvertical"> Vertical</label>
            <select name = "category">
                <option value ="">Select One</option>
                <option value="sea">Sea</option>
                <option value="forest">Forest</option> 
                <option value="mountains">Mountain</option> 
                <option value="otters">Otters</option>
                <option value="sky">Sky</option>
                <option value="dogs">Dogs</option>
            </select>
            <input type="submit" value="Submit" />
        </form>
        

        
        <?php
            if(!isset($imageURLs)) {
                echo "<h2> Type a keyword to display a slideshow <br /> with random images from Pixabay.com </h2>";
            } else { 
                //Display Carousal Here
        ?>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators Here -->
            <ol class="carousel-indicators">
                <?php
                for($i = 0; $i < 7; $i++) {
                    echo "<li data-target='#carousel-example-generic' data-slide-to='$i'";
                    echo ($i == 0)?" class='active'": "";
                    echo "></li>";
                }
                ?>
            </ol>
            
            <!-- Wrapper for Images -->
            <div class="carousal-inner" role="listbox">
                <?php
                    for($i = 0; $i < 7; $i++) {
                        do {
                            $randomIndex = rand(0,count($imageURLs));
                        }
                        while (!isset($imageURLs[$randomIndex]));
                        
                        echo '<div class="carousel-item ';
                        echo ($i == 0) ?"active" : "";
                        echo '">';
                        echo '<img src="' .$imageURLs[$randomIndex] . '">';
                        echo '</div>';
                        unset($imageURLs[$randomIndex]);
                        
                    }
                ?>
            </div>
            
            <!-- Controls Here -->
            
            <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <?php
            
            } //End of the else statement
        ?>
        <!-- HTML form goes her! -->
        
    </body>
    
</html>