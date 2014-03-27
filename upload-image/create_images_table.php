<?php
$link=  mysql_connect("localhost","root","ivan")
        or die("Could not connect: " . mysql_error());
mysql_select_db("moviesite",$link)
        or die(mysql_error());
$sql="CREATE TABLE IF NOT EXISTS images(
    image_id INT(11) NOT NULL AUTO_INCREMENT,
    image_caption VARCHAR(255) NOT NULL,
    image_username VARCHAR(255) NOT NULL,
    image_date DATE NOT NULL,
    PRIMARY KEY(image_id))";
$results=  mysql_query($sql)
        or die("Invalid query: " . mysql_error());
echo "Image table successfully created!";
?>
