<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="assets/js/jquery-3.2.1.min.js"></script>
<link href='assets/css/fonts.css' rel='stylesheet' type='text/css'>
<link href="assets/css/admin.css" rel="stylesheet" type='text/css'>
<script src="assets/js/admin.js"></script> 
</head>
<body>

<?php

include('config.php');

if (isset($_GET['logout'])) {

if($_GET['logout'] == 1){
session_destroy();
?>
<meta http-equiv="refresh" content="0; url=admin.php" />
<?php
}
}

if (isset($_POST['password'])) {
if($pass == hash('sha256', $_POST['password'])){
	$_SESSION['is_logged'] = 1;
}

}

if (isset($_SESSION['is_logged'])) {
	
	
for($i = 1; $i <= 5; $i++){	
if(!isset($_POST['r'.$i.'on'])){
$_POST['r'.$i.'on'] = null;
}
}
	
include('crawldata.php');

if(isset($_POST['updatefiles'])){
	rename("storage/layouts.json","storage/style.json");
	
	//Style
	
	$arr = array("style"=>array("layouts"=>array("layouttop"=>"1","layoutbottom"=>"1"),"theme"=>"1"));
	
		$file = "storage/style.json";
		$fh = fopen($file, 'w') or die("Couldn't open File! Change the .json files (storage/.json) Permissions to 777");
		$imp = json_encode($arr);
		fwrite($fh, $imp);
		fclose($fh);
		
	//Details
	
		$arr = array("details"=>array("servername"=>$servername,"logoortitle"=>"1","description"=>$description,
		"rules"=>array(
		"1"=>array("text"=>$r_txt[1],"status"=>$r_on[1]),
		"2"=>array("text"=>$r_txt[2],"status"=>$r_on[2]),
		"3"=>array("text"=>$r_txt[3],"status"=>$r_on[3]),
		"4"=>array("text"=>$r_txt[4],"status"=>$r_on[4]),
		"5"=>array("text"=>$r_txt[5],"status"=>$r_on[5])
		),"slogan"=>$slogan));
	
		$file = "storage/details.json";
		$fh = fopen($file, 'w') or die("Couldn't open File! Change the .json files (storage/.json) Permissions to 777");
		$imp = json_encode($arr);
		fwrite($fh, $imp);
		fclose($fh);
		
		//Settings
	
		$arr = array("settings"=>array("apikey"=>$apikey,
		"backgrounds"=>array("1"=>$background[1],"2"=>$background[2],"3"=>$background[3],"4"=>$background[4]),
		"music"=>array("file"=>"https://www.youtube.com/watch?v=psFQMKcsIF8","name"=>"Give It Up - KC & The Sunshine Band","status"=>1,"volume"=>"30"),"progressbar_color"=>$progress_color));
	
		$file = "storage/settings.json";
		$fh = fopen($file, 'w') or die("Couldn't open File! Change the .json files (storage/.json) Permissions to 777");
		$imp = json_encode($arr);
		fwrite($fh, $imp);
		fclose($fh);
}


if(isset($_POST['function'])){
	
$arr = array("details"=>array("servername"=>$_POST['servername'],"logoortitle"=>$_POST['logotitle'],"description"=>$_POST['description'],
"rules"=>array(
"1"=>array("text"=>$_POST['r1txt'],"status"=>$_POST['r1on']),
"2"=>array("text"=>$_POST['r2txt'],"status"=>$_POST['r2on']),
"3"=>array("text"=>$_POST['r3txt'],"status"=>$_POST['r3on']),
"4"=>array("text"=>$_POST['r4txt'],"status"=>$_POST['r4on']),
"5"=>array("text"=>$_POST['r5txt'],"status"=>$_POST['r5on'])
),"slogan"=>$_POST['slogan']));
	
	
	$file = "storage/details.json";
$fh = fopen($file, 'w') or die("Couldn't open File! Change the .json files (storage/.json) Permissions to 777");
$imp = json_encode($arr);
fwrite($fh, $imp);
fclose($fh);
?>
<meta http-equiv="refresh" content="0">
<?php

	$apikey = preg_replace('/\s+/', '', $_POST['apikey']);
	$apikey = base64_encode($apikey);
	
	if(!isset($_POST['songnameon'])){
	$_POST['songnameon'] = null;
	}
	
	
	$arr = array("settings"=>array("apikey"=>$apikey,
	"backgrounds"=>array("1"=>$_POST['background1'],"2"=>$_POST['background2'],"3"=>$_POST['background3'],"4"=>$_POST['background4']),
	"music"=>array("file"=>$_POST['music'],"name"=>$_POST['songname'],"status"=>$_POST['songnameon'],"volume"=>$_POST['volume']),"progressbar_color"=>$_POST['color_progress_txt'],"snow"=>$_POST['snowon']));
	
	
	$file = "storage/settings.json";
$fh = fopen($file, 'w') or die("Couldn't open File! Change the .json files (storage/.json) Permissions to 777");
$imp = json_encode($arr);
fwrite($fh, $imp);
fclose($fh);
?>
<meta http-equiv="refresh" content="0">
<?php

for($i = 1; $i <= 4; $i++){	
if(!isset($_POST['staff'.$i.'on'])){
$_POST['staff'.$i.'on'] = null;
}
}


$arr = array("staff"=>array(
"1"=>array("steamid"=>$_POST['staff1steam'],"status"=>$_POST['staff1on'],"rank"=>$_POST['staff1rank'],"color"=>$_POST['color_txt_staff1']),
"2"=>array("steamid"=>$_POST['staff2steam'],"status"=>$_POST['staff2on'],"rank"=>$_POST['staff2rank'],"color"=>$_POST['color_txt_staff2']),
"3"=>array("steamid"=>$_POST['staff3steam'],"status"=>$_POST['staff3on'],"rank"=>$_POST['staff3rank'],"color"=>$_POST['color_txt_staff3']),
"4"=>array("steamid"=>$_POST['staff4steam'],"status"=>$_POST['staff4on'],"rank"=>$_POST['staff4rank'],"color"=>$_POST['color_txt_staff4'])

));

	
	$file = "storage/staff.json";
$fh = fopen($file, 'w') or die("Couldn't open File! Change the .json files (storage/.json) Permissions to 777");
$imp = json_encode($arr);
fwrite($fh, $imp);
fclose($fh);
?>
<meta http-equiv="refresh" content="0">
<?php


	
	$arr = array("style"=>array("layouts"=>array("layouttop"=>$_POST['layout_top'],"layoutbottom"=>$_POST['layout_bottom']),"theme"=>$_POST['theme']));
	
	
	$file = "storage/style.json";
$fh = fopen($file, 'w') or die("Couldn't open File! Change the .json files (storage/.json) Permissions to 777");
$imp = json_encode($arr);
fwrite($fh, $imp);
fclose($fh);
?>
<meta http-equiv="refresh" content="0">
<?php
}

$error = 0;
$errorphp = 0;
$errorfopen = 0;

?>

<div class="nav"><span class="title">split-Load </span><span class="caption">Admin Panel</span><a href="admin.php?logout=1"><div class="logout">Logout</div></a></div>
<div id="panel-body">
<h1 style="text-align: center">Information</h1>
<?php if(!isset($layout_bottom) && !isset($layout_top)){ ?>
<div class="content-box">
<div style="background: #F39C11" class="content-box-header">
IMPORTANT!
</div>
<div class="content-box-body" style="padding: 0 20px 8px 20px;">
<p style="font-size: 18px">Some of your files are outdated!<br><br>Click this button to update them (Music and Style data will be lost):</p>
<form method="post" action="admin.php"><input type="text" name="updatefiles" value="1" hidden><button type="submit" style="cursor: pointer; border: 0; background: #3297DB; color: #fff; padding: 10px 20px;margin-bottom: 10px;">Update Files</button></form>
</div>
</div>
<?php } ?>
<div class="content-box">
<div class="content-box-header">
LoadingURL
</div>
<div class="content-box-body" style="padding: 0 20px 8px 20px;">
<p style="font-size: 18px"><b style="border: 1px solid #ccc; padding: 2px;">sv_loadingurl "<?php echo "http://".$_SERVER['HTTP_HOST'].str_replace("admin.php", "index.php", $_SERVER['REQUEST_URI']);; ?>?steamid=%s"</b><br><br>To show this loading screen on your Garry's Mod Server,<br> copy this command to your server.cfg or autoexec.cfg.</p>
</div>
</div>
<div class="content-box">
<div class="content-box-header">
Demo
</div>
<div class="content-box-body" style="padding: 0 20px 16px 20px;">
<p style="font-size: 18px">Have a look at your loading screen in the browser to test your settings:</p>
<form method="get" action="index.php">
<input style="margin: -10px 0 0 0; width: 50%; height: 48px; border-radius: 5px 0 0 5px; vertical-align: bottom" type="text" name="steamid" placeholder="Run Demo with Steam User" class="input-text" value="76561198849797255"><button style="padding-left: 0; border-radius: 0 5px 5px 0; margin: 0; width: 50%;" class="update-settings">Run Demo</button>
</form>
</div>
</div>
<div class="content-box">
<div class="content-box-header">
Server Inspection
</div>
<div class="content-box-body" style="padding: 0 20px 8px 20px;">
<p style="font-size: 18px; margin-bottom: 5px;">PHP Check</p><span style="font-size: 17px;"><?php
	echo "Version : ";
if (version_compare(phpversion(), '5.0', '>')) {
	echo "<span style='color: green'>".phpversion()."</span>";
}else{
	echo "<span style='color: red'>".phpversion()."</span>";
	$error = 1;
	$errorphp = 1;
}
?></span>

<p style="font-size: 18px; margin-bottom: 5px;">allow_url_fopen</p><span style="font-size: 17px;"><?php
	echo "Status : ";
if( ini_get('allow_url_fopen') ) {
    echo "<span style='color: green'>Enabled</span>";
}else{
	$error = 1;
	$errorfopen = 1;
	echo "<span style='color: red'>Disabled</span>";
}
?></span><p></p>
<hr>
<p style="font-size: 18px; margin-bottom: 5px;"><b>Conclusion:</b>
 <?php if($error == 0){?><span style="color: green;">The loading screen should work on this server!</span><?php } ?>
 <?php if($error == 1 && $errorphp == 1){?><span style="color: red;">Please update your PHP version to 5.1.0 or higher!</span><br><?php } ?>
 <?php if($error == 1 && $errorphp == 1){?><span style="color: red;">Please enable allow_url_fopen!</span><?php } ?>
 </p>
</div>
</div>
<form method="post" action="admin.php">
<h1 style="text-align: center">Customizations</h1>
<div class="content-box">
<div class="content-box-header">
Main
</div>
<div class="content-box-body">
<p style="font-size: 18px">Servername/Logo</p>
<input style="margin: -10px 0 0 0;" type="text" name="servername" class="input-text" value="<?php echo $servername; ?>">
<p style="margin-top: 5px; margin-bottom: 0">Use as:</p><input type="radio" name="logotitle" <?php if($logotitle == 1){ echo "checked"; } ?> value="1"> Title<br>
<input type="radio" name="logotitle" <?php if($logotitle == 2){ echo "checked"; } ?> value="2"> Logo (Link to Image - e.g. images/logo/gemgaming.png)<br>
<p style="font-size: 18px">Slogan</p>
<input style="margin: -10px 0 0 0;" type="text" name="slogan" class="input-text" value="<?php echo $slogan; ?>">
<p style="font-size: 18px">Description</p>
<textarea style="margin: -10px 0 0 0;" rows="8" name="description" id="desc"><?php echo $description; ?></textarea>
</div>
</div>

<div class="content-box">
<div class="content-box-header">
Rules
</div>
<div class="content-box-body">
<p style="font-size: 16px">Rule 1</p>
<input style="margin: -10px 0 0 0; width: 90%; vertical-align: top;" type="text" class="input-text" name="r1txt" class="rule" value="<?php echo $r_txt['1']; ?>">
<label id="spanon1" name="spanon1" class="switch">
  <input name="r1on" type="checkbox" value="1"<?php if($r_on['1'] == 1){ echo 'checked';} ?>>
  <span onclick="onoff('r1on');" class="slider"></span>
</label>
<p style="font-size: 16px">Rule 2</p>
<input style="margin: -10px 0 0 0; width: 90%; vertical-align: top;" type="text" class="input-text" name="r2txt" class="rule" value="<?php echo $r_txt['2']; ?>">
<label id="spanon2" name="spanon2" class="switch">
  <input name="r2on" type="checkbox" value="1"<?php if($r_on['2'] == 1){ echo 'checked';} ?>>
  <span onclick="onoff('r2on');" class="slider"></span>
</label>
<p style="font-size: 16px">Rule 3</p>
<input style="margin: -10px 0 0 0; width: 90%; vertical-align: top;" type="text" class="input-text" name="r3txt" class="rule" value="<?php echo $r_txt['3']; ?>">
<label id="spanon3" name="spanon3" class="switch">
  <input name="r3on" type="checkbox" value="1"<?php if($r_on['3'] == 1){ echo 'checked';} ?>>
  <span onclick="onoff('r3on');" class="slider"></span>
</label>
<p style="font-size: 16px">Rule 4</p>
<input style="margin: -10px 0 0 0; width: 90%; vertical-align: top;" type="text" class="input-text" name="r4txt" class="rule" value="<?php echo $r_txt['4']; ?>">
<label id="spanon4" name="spanon4" class="switch">
  <input name="r4on" type="checkbox" value="1"<?php if($r_on['4'] == 1){ echo 'checked';} ?>>
  <span onclick="onoff('r4on');" class="slider"></span>
</label>
<p style="font-size: 16px">Rule 5</p>
<input style="margin: -10px 0 0 0; width: 90%; vertical-align: top;" type="text" class="input-text" name="r5txt" class="rule" value="<?php echo $r_txt['5']; ?>">
<label id="spanon5" name="spanon5" class="switch">
  <input name="r5on" type="checkbox" value="1"<?php if($r_on['5'] == 1){ echo 'checked';} ?>>
  <span onclick="onoff('r5on');" class="slider"></span>
</label>
</div>
</div>



<div class="content-box">
<div class="content-box-header">
Staff members
</div>
<div class="content-box-body">
<table style="width: 100%; margin-top: 22px;">
<thead>
<th style="font-weight: 300">SteamID64</th>
<th style="font-weight: 300">Rank</th>
<th style="font-weight: 300">Color</th>
<th style="font-weight: 300; text-align: left;">Status</th>
</thead>
<tbody>
<td><input type="text" placeholder="76561198249390938" name="staff1steam" class="input-text" value="<?php echo $staff['1']; ?>"></td>
<td><input type="text" placeholder="Admin" name="staff1rank" class="input-text" value="<?php echo $staff_rank['1']; ?>"></td>
<td><input type="text" placeholder="#4286f4" style="width: 65%; border-radius: 5px 0 0 5px;" onchange="updateInput(this.value, 'color_txt_tool_staff1')" class="input-text" id="color_txt_staff1" name="color_txt_staff1" value="<?php echo $staff_color['1']; ?>"><input style="width: 25%; padding: 7.5px; vertical-align: top; border-radius: 0 5px 5px 0;" type="color" value="<?php echo $staff_color['1'] ?>" name="color_txt_tool_staff1" onchange="updateInput(this.value, 'color_txt_staff1')" id="color_txt_tool_staff1"></td>
<td><label style="margin-top: 2px" id="staff1on" name="staff1on" class="switch">
  <input name="staff1on" type="checkbox" value="1"<?php if($staff_on['1'] == 1){ echo 'checked';} ?>>
  <span onclick="onoff('staff1on');" class="slider"></span>
</label></td>
</tr>
<tr>
<td><input type="text" name="staff2steam" class="input-text" value="<?php echo $staff['2']; ?>"></td>
<td><input type="text" name="staff2rank" class="input-text" value="<?php echo $staff_rank['2']; ?>"></td>
<td><input type="text" style="width: 65%; border-radius: 5px 0 0 5px;" onchange="updateInput(this.value, 'color_txt_tool_staff2')" class="input-text" id="color_txt_staff2" name="color_txt_staff2" value="<?php echo $staff_color['2']; ?>"><input style="width: 25%; padding: 7.5px; vertical-align: top; border-radius: 0 5px 5px 0;" type="color" value="<?php echo $staff_color['2'] ?>" name="color_txt_tool_staff2" onchange="updateInput(this.value, 'color_txt_staff2')" id="color_txt_tool_staff2"></td>
<td><label style="margin-top: 2px" id="staff2on" name="staff2on" class="switch">
  <input name="staff2on" type="checkbox" value="1"<?php if($staff_on['2'] == 1){ echo 'checked';} ?>>
  <span onclick="onoff('staff2on');" class="slider"></span>
</label></td>
</tr>
<tr>
<td><input type="text" name="staff3steam" class="input-text" value="<?php echo $staff['3']; ?>"></td>
<td><input type="text" name="staff3rank" class="input-text" value="<?php echo $staff_rank['3']; ?>"></td>
<td><input type="text" style="width: 65%; border-radius: 5px 0 0 5px;" onchange="updateInput(this.value, 'color_txt_tool_staff3')" class="input-text" id="color_txt_staff3" name="color_txt_staff3" value="<?php echo $staff_color['3']; ?>"><input style="width: 25%; padding: 7.5px; vertical-align: top; border-radius: 0 5px 5px 0;" type="color" value="<?php echo $staff_color['3'] ?>" name="color_txt_tool_staff3" onchange="updateInput(this.value, 'color_txt_staff3')" id="color_txt_tool_staff3"></td>
<td><label style="margin-top: 2px" id="staff3on" name="staff3on" class="switch">
  <input name="staff3on" type="checkbox" value="1"<?php if($staff_on['3'] == 1){ echo 'checked';} ?>>
  <span onclick="onoff('staff3on');" class="slider"></span>
</label></td>
</tr>
<tr>
<td><input type="text" name="staff4steam" class="input-text" value="<?php echo $staff['4']; ?>"></td>
<td><input type="text" name="staff4rank" class="input-text" value="<?php echo $staff_rank['4']; ?>"></td>
<td><input type="text" style="width: 65%; border-radius: 5px 0 0 5px;" onchange="updateInput(this.value, 'color_txt_tool_staff4')" class="input-text" id="color_txt_staff4" name="color_txt_staff4" value="<?php echo $staff_color['4']; ?>"><input style="width: 25%; padding: 7.5px; vertical-align: top; border-radius: 0 5px 5px 0;" type="color" value="<?php echo $staff_color['4'] ?>" name="color_txt_tool_staff4" onchange="updateInput(this.value, 'color_txt_staff4')" id="color_txt_tool_staff4"></td>
<td><label style="margin-top: 2px" id="staff4on" name="staff4on" class="switch">
  <input name="staff4on" type="checkbox" value="1"<?php if($staff_on['4'] == 1){ echo 'checked';} ?>>
  <span onclick="onoff('staff4on');" class="slider"></span>
</label></td>
</tr>
</tbody>
</table>
</div>
</div>





<div class="content-box">
<div class="content-box-header">
Settings
</div>
<div class="content-box-body">
<p style="font-size: 18px;">Steam API Key</p>
<input placeholder="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" style="margin: -10px 0 0 0; width: 100%;" type="text" name="apikey" class="input-text" value="<?php echo base64_decode($apikey); ?>" required>
<span style="float:right; font-size: 10px"><a style="text-decoration:none" target="_blank" href="http://steamcommunity.com/dev/apikey">(http://steamcommunity.com/dev/apikey)</a></span>
<hr style="margin: 35px 0 0 0;">
<p style="font-size: 18px">Progress Bar Color</p>
<input placeholder="#4286f4" style="width: 32%; float: left; border-radius: 5px 0px 0px 5px;" type="text" name="color_progress_txt" onchange="updateInput(this.value, 'color_progress')" id="color_progress_txt" class="input-text" value="<?php echo $progress_color; ?>"><input type="color" value="<?php echo $progress_color; ?>" style="width: 25%; padding: 7.5px; vertical-align: top; border-radius: 0 5px 5px 0;" name="color_progress" onchange="updateInput(this.value, 'color_progress_txt')" id="color_progress">
<br>
<p style="font-size: 18px">Background Images</p>
<input style="margin: -10px 0 0 0; width: 48.5%; display: inline-block;" placeholder="images/backgrounds/background.jpg" name="background1" type="text" class="input-text" value="<?php echo $background[1]; ?>">
<input style="margin: -10px 0 0 1%; width: 48.5%; display: inline-block;" placeholder="images/backgrounds/background3.jpg" name="background2" type="text" class="input-text" value="<?php echo $background[2]; ?>">
<input style="margin: 10px 0 0 0; width: 48.5%; display: inline-block;" placeholder="http://example.com/backgrounds/example.jpg" name="background3" type="text" class="input-text" value="<?php echo $background[3]; ?>">
<input style="margin: 10px 0 0 1%; width: 48.5%; display: inline-block;" name="background4" type="text" class="input-text" value="<?php echo $background[4]; ?>">
<br><br><span style="font-size: 17px; color: #2d2d2d;">- Empty Inputs will result in a black background!<br>- Repeat old images to avoid black backgrounds<br>- The Images will be choosen randomly and switch every 5 Seconds</span>
<p style="font-size: 18px">Music </p>
<input style="margin: -10px 0 0 0; width: 48.5%;" name="music" placeholder="music/song.ogg" type="text" class="input-text" value="<?php echo $music; ?>">
<br><br><span style="font-size: 17px; color: #2d2d2d">- only .ogg files <br><b>- No Youtube Videos anymore, since YouTube has killed the support for the Gmod Browser.</b><br>- For own Files use the entire URL to the File (http://example.com/split-Load/music/song.ogg)</span>

<p style="font-size: 18px">Song name</p>
<input style="margin: -10px 0 0 0; width: 48.5%; vertical-align: top;" placeholder="Darude - Sandstorm" name="songname" type="text" class="input-text" value="<?php echo $songname; ?>">
<label style="vertical-align: top;" id="songnameon" name="songnameon" class="switch">
  <input name="songnameon" type="checkbox" value="1"<?php if($songname_on == 1){ echo 'checked';} ?>>
  <span onclick="onoff('songnameon');" class="slider"></span>
</label>
<p style="font-size: 15px">Volume <span style="font-size: 12px; color: #727272">(From 0 to 100)</span></p>
<input style="margin: -10px 0 0 0; width: 50%;" name="volume" type="text" class="input-text" value="<?php echo $volume; ?>">

</div>
</div>

<div class="content-box">
<div class="content-box-header">
Style
</div>
<div class="content-box-body">
<p style="font-size: 18px">Theme</p>
<input type="radio" name="theme" <?php if($theme == 1){ echo "checked"; } ?> value="1"> Light<br>
<input type="radio" name="theme" <?php if($theme == 2){ echo "checked"; } ?> value="2"> Dark<br>
<p style="font-size: 18px">Player Info and Staff</p>
<input type="radio" name="layout_top" <?php if($layout_top == 1){ echo "checked"; } ?> value="1"> Left: Player Info <span style="position: absolute; left: 160px;">Right: Staff Info</span><br>
<input type="radio" name="layout_top" <?php if($layout_top == 2){ echo "checked"; } ?> value="2"> Left: Staff Info <span style="position: absolute; left: 160px;">Right: Player Info</span><br>
<p style="font-size: 18px">Bottom Box divison</p>
<input type="radio" name="layout_bottom" <?php if($layout_bottom == 1){ echo "checked"; } ?> value="1"> Left: Rules <span style="position: absolute; left: 160px;">Middle: Description</span> <span style="position: absolute; left: 350px;">Right: Server Info</span><br>
<input type="radio" name="layout_bottom" <?php if($layout_bottom == 2){ echo "checked"; } ?> value="2"> Left: Description <span style="position: absolute; left: 160px;">Middle: Rules</span> <span style="position: absolute; left: 350px;">Right: Server Info</span><br>
<input type="radio" name="layout_bottom" <?php if($layout_bottom == 3){ echo "checked"; } ?> value="3"> Left: Server Info <span style="position: absolute; left: 160px;">Middle: Description</span> <span style="position: absolute; left: 350px;">Right: Rules</span>
</div>
</div>

<div class="content-box">
<div class="content-box-header">
Event
</div>
<div class="content-box-body">
<p style="font-size: 23px; margin-bottom: 10px">Snow <span style="font-size: 16px; color: #2d2d2d">Have some Snowflakes flying around :)</span>
<label style="vertical-align: top; float: right;" id="snowon" name="snowon" class="switch">
  <input name="snowon" type="checkbox" value="1"<?php if($snow == 1){ echo 'checked';} ?>>
  <span onclick="onoff('snowon');" class="slider"></span>
</label></p>

</div>
</div>

<a href="admin.php" class="reset-settings">Reset</a><button class="update-settings">Submit</button>

</div>
<input name="function" value="save" hidden>
</form>
<?php
}else{
session_destroy();

	if($pass == hash('sha256', "changeme")){
	?>
	
	<div id="login-box" style="background-color: #eaedf1">
<div style="text-align: center; padding: 25px; font-size: 24px; font-weight: 300; background-color: #2E3339; color: #fff;">Admin Panel</div>
<div style="background-color: #33383E; padding: 10px 0; border: 1px solid #2C3137;">
<p id="passwd" style="padding: 0px 15px 0px 55px;">Please change the password in the config.php file!</p>
</div>
<input type="text" value="1" name="pass" hidden>
<input class="submit disabled" type="submit" value="Login">
</div>
	<?php
	}else{
?>
<div id="login-box" style="background-color: #eaedf1">
<div style="text-align: center; padding: 25px; font-size: 24px; font-weight: 300; background-color: #2E3339; color: #fff;">Admin Panel</div>
<form method="post" action="admin.php">
<div style="background-color: #33383E; padding: 10px 0; border: 1px solid #2C3137;">
<input id="passwd" placeholder="Password" type="password" name="password">
</div>
<?php if(isset($_POST['password'])){ ?>
<div style="background-color: #33383E; border: 1px solid #2C3137; border-width: 0 1px 1px 1px; padding: 5px 10px; color: #bcbcbc; height: 19px">
<img src="images/icons/error.png" height="19px"><span style="vertical-align: top;"> &nbsp;You entered a wrong password!</span>
</div>
<?php } ?>
<input type="text" value="1" name="pass" hidden>
<input class="submit" type="submit" value="Login">
</form>
</div>
<?php	
}}
?>

</body>
</html>