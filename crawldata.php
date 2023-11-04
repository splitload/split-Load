<?php
// Get JSON File Information(Settings)
$file = file_get_contents('storage/settings.json');
$json = json_decode($file, true);

$apikey = $json['settings']['apikey'];

$music = $json['settings']['music']['file'];
$songname = $json['settings']['music']['name'];
$songname_on = $json['settings']['music']['status'];
$volume = $json['settings']['music']['volume'];
$progress_color = $json['settings']['progressbar_color'];


//Event
if(isset($json['settings']['snow'])){
$snow = $json['settings']['snow'];
}else{
$snow = null;	
}


for($i = 1; $i <= 4; $i++){

$background[$i] = $json['settings']['backgrounds'][$i];
}

// Get JSON File Information(Staff)
$file = file_get_contents('storage/staff.json');
$json = json_decode($file, true);

$nostaff = 0;

for($i = 1; $i <= 4; $i++){
$staff[$i] = $json['staff'][$i]['steamid'];
$staff_on[$i] = $json['staff'][$i]['status'];
$staff_rank[$i] = $json['staff'][$i]['rank'];
$staff_color[$i] = $json['staff'][$i]['color'];

if(!isset($staff_on[$i])){
	$nostaff = $nostaff+1;
}
}

// Get JSON File Information(Details)
$file = file_get_contents('storage/details.json');
$json = json_decode($file, true);

$servername = $json['details']['servername'];
$logotitle = $json['details']['logoortitle'];

$slogan = $json['details']['slogan'];
$description = $json['details']['description'];


for($i = 1; $i <= 5; $i++){
$r_txt[$i] = $json['details']['rules'][$i]['text'];
$r_on[$i] = $json['details']['rules'][$i]['status'];
}

// Get JSON File Information(Layouts)
$file = file_get_contents('storage/style.json');
$json = json_decode($file, true);

$layout_bottom = $json['style']['layouts']['layoutbottom'];
$layout_top = $json['style']['layouts']['layouttop'];
$theme = $json['style']['theme'];

?>