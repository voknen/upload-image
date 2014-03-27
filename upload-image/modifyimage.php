<?php
$link=  mysql_connect("localhost","root","ivan")
        or die("Could not connect: " . mysql_error());
mysql_select_db("moviesite",$link)
        or die(mysql_error());

$id=$_POST['id'];
if(isset($_POST['bw'])){
    $bw=$_POST['bw'];
            
}else{
    $bw='';
}
$action=$_POST['action'];
if(isset($_POST['text'])){
    $text=$_POST['text'];
}else{
    $text='';
}
if(isset($_POST['watermark'])){
    $watermark=$_POST['watermark'];
}else{
    $watermark='';
}
$getpic=  mysql_query("SELECT * FROM images WHERE image_id='$id'")
        or die(mysql_error());
$rows=  mysql_fetch_array($getpic);
extract($rows);
$image_filename="http://localhost:88/website/images/" . $image_id . ".jpg";

list($width,$height,$type,$attr)=
        getimagesize($image_filename);
$image=  imagecreatefromjpeg("$image_filename");
if($bw=='on'){
 
    imagefilter($image, IMG_FILTER_GRAYSCALE);
}
if($text=='on'){
    imagettftext($image, 12, 0, 20,20, 0, "../arial.ttf",$image_caption);
    
}
if($watermark=='on'){
    $image2=  imagecreatefromgif("../logo.gif");
    imagecopymerge($image, $image2, 0, 0, 0, 0, $width, $height, 15);
}
if($action=="preview"){
    header("Content-type:image/jpeg");
    
    imagejpeg($image);
}
if($action=="save"){
    imagejpeg($image,$image_filename);
    $url="location:showimage.php?id=" . $id . "$mode=change";
    header($url);
}
?>
