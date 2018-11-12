<?php
    $backgroundImage = "img/sea.jpg";
    //API call goes here
    if(isset($_GET['keyword'])) {
        include 'api/pixabayAPI.php';
        $keyword = $_GET['keyword'];
        $imageURLs = getImageURLs('$keyword');
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    }
            
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Lab3: Image Carousel </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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
        if(!isset($imageURLs)){
            echo "<h2>Type a keyword to display a slideshow with random images from Pixabay.com </h2>";
        }else{  //display carousel here
            
        
    ?>
    <div id ="carousel-example-generic" class="carousel slide" data-ride="carousel"></div>
    <!--indicators here-->
        <ol class="carousel-indicators">
        <?php
            for($i=0;$i<5;$i++){
                echo"<li data-target='#carousel-example-generic' data-slide-to='$i'";
                echo($i == 0) ? "class='active'" : "";
                echo "></li>";
            }
        ?>
        </ol>
        <!--Wrapper for images-->
        <div class ="carousel-inner" role="listbox">
            <?php
                for($i = 0;$i<5;$i++){
                    do{
                        $randomIndex = rand(0, count($imageURLs));
                            
                        }while(!isset($imageURLs[$randomIndex]));
                        echo'<div class = "item ';
                        echo ($i == 0)?"active": "";
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
            <input type="text" name="keyword" placeholder="Keyword" value= "<?=$_GET ['keyword']?>"/>
            <input type="radio" id="lhorizontal" name="layout" value"horizontal">
            <label for = "Horizontal"><label for="lhorizontal"> Horizontal </label>
            <input type="radio" id="lvertical" name="layout" value="vertical">
            <label for="vertical"></label><label for="lvertical">Vertical</label>
            <select name= "category">
                <option value="">Select One</option>
                <option value="ocean">Sea</option>
                <option>Forest</option>
                <option>Mountain</option>
                <option>Snow</option>
            </select>
            <input type="submit" value="Submit" />
        </form>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        </body>
</html>