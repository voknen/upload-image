<?php
$link=  mysql_connect("localhost","root","ivan")
        or die("Could not connect: " . mysql_error());
mysql_select_db("moviesite",$link)
        or die(mysql_error());
$ImageDir="images";
$ImageThumb=$ImageDir . "/thumbs/";
?>
<html>
    <head>
        <title>Welcome to our Photo Gallery</title>
    </head>
    <body>
        <p align="center">Click on any image to see it full sized.</p>
        <table align="center">
            <tr>
                <td align="center">Image</td>
                <td align="center">Caption</td>
                <td align="center">Uploaded By</td>
                <td align="center">Date Uploaded</td>
            </tr>
            <?php
            $getpic=mysql_query("SELECT * FROM images")
                    or die(mysql_error());
            while($rows=  mysql_fetch_array($getpic)){
                extract($rows);
                echo "<tr>\n";
                echo "<td><a href=\"" . $ImageDir . $image_id . ".jpg\">";
                echo "<img src=\"" .$ImageThumb . $image_id . "jpg\" border=\"0\">";
                echo "</a></td>\n";
                echo "<td> " . $image_caption . "</td>\n";
                echo "<td> " . $image_username . "</td>\n";
                echo "<td> " . $image_date . "</td>\n";
                echo "</tr>\n";
            }
            ?>
        </table>
    </body>
</html>
