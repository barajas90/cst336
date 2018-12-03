function move(){
        $("h1").css("text-align","center")
        $("h1").css("color","blue")
        $("footer").css("color","blue")
        $("#csumb").css("width", 300)
        $("#csumb").css("height", 150)
        $('#btnMoveAnimals').click(function(){
            var xCat=Math.floor(Math.random()*401);
            var yCat=Math.floor(Math.random()*201);
            var xDog=Math.floor(Math.random()*411);
            var yDog=Math.floor(Math.random()*201);
            $('#cat').css('left', xCat+ 'px');
            $('#cat').css('top', yCat+ 'px');
            $('#dog').css('left' ,xDog+ 'px');
            $('#dog').css('top', yDog+ 'px');
        });
}
  