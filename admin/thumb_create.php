<?php
$starting_image = imagecreatefromjpeg("img2.jpg");
$width = imagesx($starting_image);
$height = imagesy($starting_image);

$thumb_width = 146;
$constant = $width/$thumb_width;
$thumb_height = round($height/$constant, 0);/*
$thumb_height = 110;*/

$thumb_image = imagecreatetruecolor($thumb_width, $thumb_height);
imagecopyresampled($thumb_image, $starting_image, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
imagejpeg($thumb_image, "thumb2.jpg");
?>