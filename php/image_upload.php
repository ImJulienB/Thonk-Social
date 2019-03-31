<?php

// Setting what content will transit
header('Content-Type: image/jpeg');

// Setting where the image will be saved
$target_dir = "uploads/images/";
// Grabbing the image's name and setting up the definitive path to save the image
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// Image's width, declared here so I can change it easily rather than replacing the value on multiple places
$width = 512;

// This will serve to check if everything went right and the image can be uplaoded
// If it changes to 0 then nothing will be uploaded
$uploadOk = 1;
// Grabbing the image's file type
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
    $uploadOk = 0;
}

// Allow certain file formats
// Only jpg, png, and gif allowed
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uploadOk = 0;
}

// If everything is ok, try to upload file
if ($uploadOk != 0) {
	
	$src_img = imagecreatefromjpeg($target_file);

	$size = getimagesize($target_file);
	$w = $size[0];
	$h = $size[1];

	$height = round(($width / $w) * $h);
	$dest_img = imagecreatetruecolor($width, $height);

	imagecopyresampled($dest_img, $src_img, 0, 0, 0, 0, $width, $height, $w, $h);

	imagejpeg($dest_img);
	imagedestroy($dest_img);
	imageDestroy($src_img);

    header("Location: ..");
}

?>