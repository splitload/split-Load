
var images = [
  background1,
  background2,
  background3,
  background4
];

var $body = $("body"),
    $bg = $("#bg"),
    n = images.length,
    c = 0; // Loop Counter

// Preload Array of images...
for(var i=0; i<n; i++){
  var tImg = new Image();
  tImg.src = images[i];
}

$body.css({backgroundImage : "url("+images[Math.floor((Math.random() * 3) + 0)]+")"}); 
$body.css({backgroundRepeat : "no-repeat"}); 
$body.css({backgroundSize : "cover"}); 


(function loopBg(){
	var rand = Math.floor((Math.random() * 3) + 0);
  $bg.hide().css({backgroundImage : "url("+images[++rand%n]+")"}).delay(5000).fadeTo(1200, 1, function(){
    $body.css({backgroundImage : "url("+images[rand%n]+")"}); 
	$body.css({backgroundRepeat : "no-repeat"}); 
	$body.css({backgroundSize : "cover"}); 
    loopBg();
  });
}());