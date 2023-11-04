<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>split-Load</title>
<script src="assets/js/jquery-3.2.1.min.js"></script>
 <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<link href='assets/css/fonts.css' rel='stylesheet' type='text/css'>
 <link href="assets/css/main.css" rel="stylesheet" type='text/css'>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <style>
 html{
	 height: 100%;
 }
 
 body{
	 height: 100%;
 }
 </style>
</head>

<?php
include('crawldata.php');


$steamusers['response']['players'][0]['steamid'] = 0;
$steamusers['response']['players'][1]['steamid'] = 0;
$steamusers['response']['players'][2]['steamid'] = 0;
$steamusers['response']['players'][3]['steamid'] = 0;

$apikey = base64_decode($apikey);

if($volume == ""){
	$volume = 0.5;
}


//Different Layouts
if($layout_top == 2){
	?>
	<style>
.staff-info{
	left: 10px;
	
}
#player-info{
	left: auto;
	right: 10px;
}
	</style>
	<?php
}

if($layout_bottom == 2){
	?>
	<style>
#server-desc{
	left: 0;
}
#rule-info{
	left: 42%;
}
	</style>
	<?php
}
if($layout_bottom == 3){
	?>
	<style>

#rule-info{
	left: auto;
	right: 5px;
	width: 26%;
}
#server-info{
	left: 15px;
}
	</style>
	<?php
}

$vol = $volume / 100;

?>
<body style="margin: 0; width: 100%;">

<script>

 function GameDetails( servername, serverurl, mapname, maxplayers, steamid, gamemode ) {
	 document.getElementById("Map").innerHTML = mapname;
	 document.getElementById("Gamemode").innerHTML = gamemode;
	 document.getElementById("Slots").innerHTML = maxplayers;
	 }
	 document.getElementById("FilePercent").innerHTML = "5%";
	 function SetStatusChanged( status ) { document.getElementById("FileStatus").innerHTML = status;
			if(status == 'Retrieving server info...') {
				$('#loadingbar').css({ "width" : "10%"});
				document.getElementById("FilePercent").innerHTML = "5%";
			} else if(status == 'Mounting Addons') {
				$('#loadingbar').css({ "width" : "55%"});
				document.getElementById("FilePercent").innerHTML = "55%";
			} else if(status == 'Workshop Complete') {
				$('#loadingbar').css({ "width" : "89%"});
				document.getElementById("FilePercent").innerHTML = "89%";
			} else if(status == 'Sending client info...') {
				$('#loadingbar').css({"width" : "99%"});
				document.getElementById("FilePercent").innerHTML = "99%";
			} else {
				$('#loadingbar').css({"width" : "35%"});
				document.getElementById("FilePercent").innerHTML = "35%";
			}
		}
</script>

<?php

// Get Player/Staff Information from Steam API
 $map = "mapname";
 $intt = 0;
 if(isset($_GET["steamid"])){
 $id = $_GET["steamid"];
 }else{
 $id = 0;
 }
 if(isset($_GET["mapname"])){
 $map = $_GET["mapname"];
 }
 $id_str = $id.",";
 for($i = 1; $i <= 4; $i++){
	 if($staff_on[$i] == 1){
		 $id_str = $id_str.",".$staff[$i];
		 $intt++;
	 }
 }
 if($apikey != "ChangeMe"){
 $link = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='.$apikey.'&steamids=' . $id_str . '&format=json');
 $steamusers = json_decode($link, true);
 $working = 0;
 }
 if($apikey == "ChangeMe"){
	 include("assets/content/installation.html");
	 die();
 }else{
	 $working = 1;
 }
 
 if(!isset($steamusers['response']['players'][0]['steamid']) && $nostaff != 4){
	 ?>
	 <div style="width: 100%; height: 100%; z-index: 9999999; position: absolute; left: 0; top: 0; background-color: #fff; text-align: center;"><h1>
	 <?php if( ini_get('allow_url_fopen') ) {
		 ?>
		 '<?php echo $apikey; ?>' isn't a valid Steam API-Key, please enter a working one!
		 <?php
}else{
	?>
	allow_url_fopen is disabled on this server!<br>In order to make the loading screen work, you have to enable it, ask your host to enable it or do it yourself in the PHP Settings.
	<?php
} ?></h1></div>
	 <?php
	 die();
 }else{
	 $working = 1;
 }
 if(isset($steamusers['response']['players'][0]['steamid'])){
if($steamusers['response']['players'][0]['steamid'] == $id){
	 $joining_name = $steamusers['response']['players'][0]['personaname'];
	 $joining_avatar = str_replace( 'https://', 'http://', $steamusers['response']['players'][0]['avatarfull']);
 }
 }
 
 if(isset($steamusers['response']['players'][1]['steamid'])){
 if($steamusers['response']['players'][1]['steamid'] == $id){
	 $joining_name = $steamusers['response']['players'][1]['personaname'];
	 $joining_avatar = str_replace( 'https://', 'http://', $steamusers['response']['players'][1]['avatarfull']);
 }
 }
 
  if(isset($steamusers['response']['players'][2]['steamid'])){
 if($steamusers['response']['players'][2]['steamid'] == $id){
	 $joining_name = $steamusers['response']['players'][2]['personaname'];
	 $joining_avatar = str_replace( 'https://', 'http://', $steamusers['response']['players'][2]['avatarfull']);
 }
 }
 
  if(isset($steamusers['response']['players'][3]['steamid'])){
 if($steamusers['response']['players'][3]['steamid'] == $id){
	 $joining_name = $steamusers['response']['players'][3]['personaname'];
	 $joining_avatar = str_replace( 'https://', 'http://', $steamusers['response']['players'][3]['avatarfull']);
 }
 }
 
 if(!isset($joining_name)){
	 
	 include("assets/content/browser.html");
	 die();
 }
	 
 
 
 for($int = 1; $int <= 5; $int++){
	 if(isset($staff_on[$int])){
		 for($intz = 0; $intz <= 5; $intz++){
			 if(isset($steamusers['response']['players'][$intz]['steamid'])){
			 if($steamusers['response']['players'][$intz]['steamid'] == $staff[$int]){
	 			$staff_name[$int] = $steamusers['response']['players'][$intz]['personaname'];
	 			$staff_avatar[$int] = $steamusers['response']['players'][$intz]['avatarmedium'];
				$staff_avatar[$int] = str_replace( 'https://', 'http://', $staff_avatar[$int]);
		}
		 }
		 }
		 
	 }
 }






// Get SteamID through SteamID 64
function parseInt($string) {
    if(preg_match('/(\d+)/', $string, $array)) {
        return $array[1];
    } else {
        return 0;
    }}


$steamY = parseInt($id);
$steamY = $steamY - 76561197960265728;
$steamX = 0;

if ($steamY%2 == 1){
$steamX = 1;
} else {
$steamX = 0;
}

$steamY = (($steamY - $steamX) / 2);
$steamID = "STEAM_0:" . (string)$steamX . ":" . (string)$steamY;

//Checking if there is only one Staff Box
//to move it to the right later on(Screen-width max: 1025px)

$n_int = 0;
for($int = 1; $int <= 4; $int++){
	
	if($staff_on[$int] == 1){
		$n_int++;
	}
}

if($working == 1){
	$type_m = 0;
if (strpos($music, 'youtube') == true || strpos($music, 'youtu.be') == true) {
	
	if(strpos($music, 'youtu.be') == true){
			$music = strstr($music, 'be/');;
	$music = str_replace('be/', '', $music);
	$musica = explode('&',$music);
	$music = $musica[0];
	$type_m = 1;
		}
	if (strpos($music, 'watch?v=') == true) {
		if (strpos($music, '&list=') == true){
			$music = strstr($music, 'watch?v=');;
	$music = str_replace('watch?v=', '', $music);
	$musica = explode('&list=',$music);
	$music = $musica[1];
	$musica = explode('&',$music);
	$music = $musica[0];
	$type_m = 2;
		}else{
	$music = strstr($music, 'watch?v=');;
	$music = str_replace('watch?v=', '', $music);
	$musica = explode('&',$music);
	$music = $musica[0];
	$type_m = 1;
		}	
	}
	if (strpos($music, 'playlist?list=') == true) {
	$music = strstr($music, 'playlist?list=');;
	$music = str_replace('playlist?list=', '', $music);
	$musica = explode('&',$music);
	$music = $musica[0];
	$type_m = 2;
	}
	
	
	?>
<div id="player" style="visibility: hidden"></div>

<script>
		var volume = <?php echo $volume; ?>;
		var songid = <?php echo json_encode($music); ?>;
		var typem = <?php echo $type_m; ?>;
		
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      
      var player;
      function onYouTubeIframeAPIReady() {
		  if(typem == 1){
        player = new YT.Player('player', {
          height: '100',
          width: '100',
          videoId: songid,
		  playerVars: { 'autoplay': 1, 'loop': 1, 'playlist': songid},
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }else{
		player = new YT.Player('player', {
			
          height: '100',
          width: '100',
          videoId: 'Wch3gJG2GJ4',
		  playerVars: { 'autoplay': 1, 'loop': 1,
		  listType:'playlist',
          list: songid
		  },
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });  
	  }
	  }
      
      function onPlayerReady(event) {
		  event.target.setVolume(volume);
        event.target.playVideo();
      }

      
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
        }
      }
      function stopVideo() {
        player.stopVideo();
      }
    </script>


	<?php
    
	}else{
	?>
	
	<script>
	$(function() {
	var volume = <?php echo json_encode($vol); ?>;
    $("audio").each(function(){ this.volume = volume; });
});
	</script>

	<audio controls autoplay loop hidden>
<source src="<?php echo $music; ?>" type="audio/ogg">
</audio>

<?php }} ?>

<?php if($snow == 1){ ?>
<canvas id="canvas"></canvas>
<script>
window.onload = function(){
	//canvas init
	var canvas = document.getElementById("canvas");
	var ctx = canvas.getContext("2d");
	
	//canvas dimensions
	var W = window.innerWidth;
	var H = window.innerHeight;
	canvas.width = W;
	canvas.height = H;
	
	//snowflake particles
	var mp = 25; //max particles
	var particles = [];
	for(var i = 0; i < mp; i++)
	{
		particles.push({
			x: Math.random()*W, //x-coordinate
			y: Math.random()*H, //y-coordinate
			r: Math.random()*4+1, //radius
			d: Math.random()*mp //density
		})
	}
	
	//Lets draw the flakes
	function draw()
	{
		ctx.clearRect(0, 0, W, H);
		
		ctx.fillStyle = "rgba(255, 255, 255, 0.8)";
		ctx.beginPath();
		for(var i = 0; i < mp; i++)
		{
			var p = particles[i];
			ctx.moveTo(p.x, p.y);
			ctx.arc(p.x, p.y, p.r, 0, Math.PI*2, true);
		}
		ctx.fill();
		update();
	}
	
	//Function to move the snowflakes
	//angle will be an ongoing incremental flag. Sin and Cos functions will be applied to it to create vertical and horizontal movements of the flakes
	var angle = 0;
	function update()
	{
		angle += 0.01;
		for(var i = 0; i < mp; i++)
		{
			var p = particles[i];
			//Updating X and Y coordinates
			//We will add 1 to the cos function to prevent negative values which will lead flakes to move upwards
			//Every particle has its own density which can be used to make the downward movement different for each flake
			//Lets make it more random by adding in the radius
			p.y += Math.cos(angle+p.d) + 1 + p.r/2;
			p.x += Math.sin(angle) * 2;
			
			//Sending flakes back from the top when it exits
			//Lets make it a bit more organic and let flakes enter from the left and right also.
			if(p.x > W+5 || p.x < -5 || p.y > H)
			{
				if(i%3 > 0) //66.67% of the flakes
				{
					particles[i] = {x: Math.random()*W, y: -10, r: p.r, d: p.d};
				}
				else
				{
					//If the flake is exitting from the right
					if(Math.sin(angle) > 0)
					{
						//Enter from the left
						particles[i] = {x: -5, y: Math.random()*H, r: p.r, d: p.d};
					}
					else
					{
						//Enter from the right
						particles[i] = {x: W+5, y: Math.random()*H, r: p.r, d: p.d};
					}
				}
			}
		}
	}
	
	//animation loop
	setInterval(draw, 33);
}
</script>
<?php } ?>

<?php if(isset($songname_on)){?><div class="songname" <?php if($theme == 2){ echo 'style="background: #141414; color: #c1c1c1"'; } ?>><img height="42px" src="images/icons/music<?php if($theme == 2){ echo '-white'; } ?>.png"><div style="vertical-align: top; display: inline-block; padding-left: 4px; line-height: 18px; margin-top: -2px"><span style="font-size: 12px">Now playing:</span><br><?php echo $songname; ?></div></div><?php } ?>
 

 <div class="staff-info" <?php if($n_int <= 1 && $layout_top != 2){ echo 'id="one-staff"'; } ?>>
<?php for($int = 1; $int <= 4; $int++){
	if($staff_on[$int] == 1){
		?>
		<div id="staff-box" <?php if($theme == 2){ echo 'style="background: #1e1e1e; color: #a8a8a8;"'; } ?>><div id="color-box" style="background-color: <?php echo $staff_color[$int]; ?>"><p style="color: #ffffff; white-space: nowrap;overflow: hidden;text-overflow: ellipsis; margin-left: 75px; margin-top: 16px; font-size: 18px;"><?php echo $staff_rank[$int]; ?></p>
		</div><div style="width: 60px; height: 60px; border-width: 3px; top: 6px; border-radius: 50%; border-style: solid; <?php if($theme == 2){ echo 'border-color: #161616;'; }else{ echo 'border-color: #f2f2f2;'; } ?> position: absolute; z-index: 999999;"></div><img height="60px" style="z-index: 1; position: relative; border-width: 3px; top: 4px; border-radius: 50%; border-style: solid; <?php if($theme == 2){ echo 'border-color: #161616;'; }else{ echo 'border-color: #f2f2f2;'; } ?>" width="auto" src="<?php echo $staff_avatar[$int]; ?>">
		<div id="staff-name">
		<span style="font-weight: 400; position: relative; font-size: 18px;"><?php echo $staff_name[$int]; ?></span></div></div>

		<?php
	}
} ?>


</div>
<?php 
$mainColor = "36ab98";
  // Getting the main color in the avatar
  $image=imagecreatefromjpeg($joining_avatar);
  $thumb=imagecreatetruecolor(1,1); imagecopyresampled($thumb,$image,0,0,0,0,1,1,imagesx($image),imagesy($image));
    $mainColor=strtoupper(dechex(imagecolorat($thumb,0,0)));
?>
<div id="player-info" <?php if($theme == 2){ echo 'style="background: #1e1e1e; color: #c1c1c1;"'; } ?>><div id="strip" style="top: 5px; background-color: #<?php echo $mainColor; ?>;"></div><img style="position: absolute; display: inline-block; top: 0;" class="avatar" id="img-avatar" src="<?php echo $joining_avatar;?>" />
<p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 300;" id="username">Welcome, <?php echo $joining_name; ?>!</p>
<p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 300;" id="steamid"><?php echo $steamID; ?></p>
<div id="strip" style="bottom: 5px; background-color: #<?php echo $mainColor; ?>;"></div></div>
 <div id="bottom-bar" <?php if($theme == 2){ echo 'style="background: #1e1e1e; color: #c1c1c1;"'; } ?>>

<?php

// Rule counter

$int_count = 0;
 for($int = 1; $int <= 5; $int++){
	 if($r_on[$int] == 1){
		 $int_count++;
	 }
 }

 if($int_count != 0){
 ?>

<div id="rule-info"><div style="margin: 0px 0 0 0px; width: 100%; padding: 0 0 5px 0; width: 100%; font-size: 28px; font-weight: 300; text-align: left;">Rules</div>
<?php
 }
 
$int_conf = 1;
 for($int = 1; $int <= 5; $int++){
	 if($r_on[$int] == 1){
		 if($int_conf % 2 == 0){
			?>
		   <div id="rule-box" style=""><div id="rule-box-value"><?php echo $int_conf; ?>.</div><p style="margin-left: 42px; margin-top: 0; width: 89%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $r_txt[$int]; ?></p></div>
		   <?php 
			 
		 }else{
			 if($int_conf == 1){
				?>
				 <div id="rule-box" style="margin: 0px 0 0 0;"><div id="rule-box-value"><?php echo $int_conf; ?>.</div><p style="margin-left: 42px; margin-top: 0; width: 89%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $r_txt[$int]; ?></p></div>
				<?php				
			 }else{
			 ?>
		  <div id="rule-box" ><div id="rule-box-value"><?php echo $int_conf; ?>.</div><p style="margin-left: 42px; margin-top: 0; width: 89%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $r_txt[$int]; ?></p></div>
		  <?php
		  }
		 }
		 $int_conf++;
	 }
 }

 if($int_count != 0){
 ?>
 </div>
 <?php } ?>
 <div style="<?php if($int_count == 0){ ?>width: 65%;<?php } if($layout_bottom == 1 && $int_count == 0){ ?> left: 0; <?php } ?>"id="server-desc"><div style="margin: 0px 0 0 0px; width: 100%; padding: 0 0 5px 0; font-size: 28px; font-weight: 300; text-align: left;">Description</div><?php echo $description; ?>
</div>
 <div id="server-info">
 <div style="margin: 0px 0 0 0px; width: 100%; padding: 0 0 5px 0; width: 100%; font-size: 28px; font-weight: 300; text-align: left;">Server Info</div>
 
 <p id="info-txt" style="font-weight: 300; margin: 0;">Map: <span id="Map" style="position: absolute; left: 180px; font-weight: 400;">mapname</span></p>
 <p id="info-txt" style="font-weight: 300; margin: 8px 0 0 0;">Gamemode: <span id="Gamemode" style="position: absolute; left: 180px; font-weight: 400;">gamemode</span></p>
 <p id="info-txt" style="font-weight: 300; margin: 8px 0 0 0;">Maxplayers: <span id="Slots" style="position: absolute; left: 180px; font-weight: 400;">maxplayers</span></p>
 </div>
 </div>
 <div id="title-bar"><?php if($logotitle == 1){ echo $servername; }else{ ?> <img style="max-height: 140px; max-width: 70%;" src="<?php echo $servername; ?>" alt="Logo not found."> <?php } ?><br><span style="font-size: 30px"><?php echo $slogan; ?><span></div>


<div id="bar" <?php if($theme == 2){ echo 'style="background: #141414;"'; } ?>>
<div id="FileStatus" style="border-radius: 25px; <?php if($theme == 2){ echo 'background: #0c0c0c; color: #adadad;'; }else{ echo 'background-color: #cccccc;'; } ?> padding: 5px; padding-left: 20px; padding-right: 20px; top: 5px; right: 65px; text-align: center; position: absolute; height: 20px;">Retrieving server info...</div>
<div id="FilePercent" style="border-radius: 25px; <?php if($theme == 2){ echo 'background: #0c0c0c; color: #adadad;'; }else{ echo 'background-color: #cccccc;'; } ?> padding: 5px; top: 5px; right: 10px; text-align: center; width: 40px; position: absolute; height: 20px;">0%</div>
  <div id="loadingbar" style="background-color: <?php echo $progress_color; ?>; width: 1%;"></div>
</div>

<div style="z-index: -5; background-size:100%; background-size: cover;" id="bg">
 </div> 


<script type="text/javascript">
var background1 = <?php echo json_encode($background[1]); ?>;
var background2 = <?php echo json_encode($background[2]); ?>;
var background3 = <?php echo json_encode($background[3]); ?>;
var background4 = <?php echo json_encode($background[4]); ?>;

</script>
<script src="assets/js/background-cycle.js"></script>

</body>
</html> 