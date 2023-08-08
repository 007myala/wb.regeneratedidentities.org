<?php
try{
ini_set('memory_limit', '102400M');
$fname=$_GET['fname'];
//$fname='data/IMG_0001.JPG';

//ini_set(“memory_limit”,"512M");
 //the image to be rotated
 $image = $fname;

 //rotation angle
 $degrees = -90;

 //load the image
 $source = imagecreatefromjpeg($image);

 //rotate the image
 $rotate = imagerotate($source, $degrees, 0);

 //set the Content type
 header('Content-type: image/jpeg');

 //display the rotated image on the browser
 imagejpeg($rotate, $fname);

 //free the memory
 imagedestroy($source);
 imagedestroy($rotate);
}
catch (Exception $e) {
    print "something went wrong, caught yah! n";
}
finally{

 //header back
header("Location: ".$_SERVER['HTTP_REFERER']);
}

 ?>
