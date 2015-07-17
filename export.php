<?php
//print_r($_POST);die;
$img=$_POST['canvasData'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = 'uploads/design/templates/' . uniqid() . '.png';
$success = file_put_contents($file, $data);
echo $success;
return 1;