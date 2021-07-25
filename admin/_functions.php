<?php

 // this function can be called many times to create several different sizes of each uploaded image.
 // Perhaps one thumbnail (150px) and one display size image (800px)
 // Each will have it's own size and a different dest folder, but share the same filename.
 function createJPGThumbnail($file, $folder, $uniqueName, $newwidth) {

	list($width, $height) = getimagesize($file);
	$imgRatio = $width/$height;
	$newheight = $newwidth / $imgRatio;
	//echo "<p>". $newwidth. " | " .$newheight;
	//exit();
	// Load
	$thumb = imagecreatetruecolor($newwidth, $newheight);
	$source = imagecreatefromjpeg($file);
	
	// Resize
	imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	
	// Output
	
	$newFileName = $folder .  basename($uniqueName);// get original filename for dest filename

	imagejpeg($thumb,$newFileName,80);
	imagedestroy($thumb); 
	imagedestroy($source); 

// 	echo "<p><img src=\"$newFileName\" />";
}

 function createPNGThumbnail($file, $folder, $uniqueName, $newwidth) {

	list($width, $height) = getimagesize($file);
	$imgRatio = $width/$height;
	$newheight = $newwidth / $imgRatio;
	//echo "<p>". $newwidth. " | " .$newheight;
	//exit();
	// Load
	$thumb = imagecreatetruecolor($newwidth, $newheight);
	$source = imagecreatefrompng($file);
	
	// Resize
	imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	
	// Output
	
	$newFileName = $folder .  basename( $uniqueName);// get original filename for dest filename

	imagepng($thumb,$newFileName, 0);
	imagedestroy($thumb); 
	imagedestroy($source); 

// 	echo "<p><img src=\"$newFileName\" />";
}

?>