<?php
$link=  mysql_connect("localhost","root","ivan")
        or die("Could not connect: " . mysql_error());
mysql_select_db("moviesite",$link)
        or die(mysql_error());

$image_caption=$_POST['image_caption'];
$image_username=$_POST['image_username'];
$image_tempname=$_FILES['image_filename']['name'];
$today=date("Y-m-d");
// 
$ImageDir="c:/xampp/htdocs/website/images/";
$ImageThumb=$ImageDir . "thumbs/";
$ImageName=$ImageDir.$image_tempname;

if(move_uploaded_file($_FILES['image_filename']['tmp_name'],$ImageName)){
    echo 1;
    list($width,$height,$type,$attr)=  getimagesize($ImageName);
    if($type>3){
        echo 2;
        echo "Sorry,but the file you uploaded was not a GIF,JPG, or PNG file.<br>";
        echo "Please hit your browser's 'back' button and try again.";
    }else{
        echo 3;
    $insert="INSERT INTO images
        (image_caption,image_username,image_date)
        VALUES
        ('$image_caption','$image_username','$today')";
    $insertresults=  mysql_query($insert)
            or die(mysql_error());
    $lastpicid=  mysql_insert_id();
    $newfilename=$ImageDir.$lastpicid.".jpg";
    if($type==2){
    rename($ImageName, $newfilename);
    }else{
        if($type==1){
            $image_old=  imagecreatefromgif($ImageName);
        }elseif($type==3){
            $image_old=  imagecreatefrompng($ImageName);
        }
        $image_jpg=  imagecreatetruecolor($width, $height);
        imagecopyresampled($image_jpg, $image_old,0, 0, 0, 0, $width, $height, $width, $height);
        imagejpeg($image_jpg, $newfilename);
        imagedestroy($image_old);
        imagedestroy($image_jpg);
    }
    $newthumbname=$ImageThumb . $lastpicid . ".jpg";
    $thumb_width=$width *0.10;
    $thumb_height=$height *0.10;
    $largeimage=  imagecreatefromjpeg($newfilename);
    $thumb=  imagecreatetruecolor($thumb_width, $thumb_height);
    imagecopyresampled($thumb, $largeimage, 0, 0, 0,0, $thumb_width, $thumb_height, $width, $height);
    imagejpeg($thumb,$newthumbname);
    imagedestroy($largeimage);
    imagedestroy($thumb);
}$url="location: showimage.php?id=" . $lastpicid."&w=".$width."&h=".$height;
header($url);
}
?>
