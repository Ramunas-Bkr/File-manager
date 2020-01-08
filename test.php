<?php
$dirFiles = array();
// opens images folder
if ($handle = opendir('Failai')) {
    while (false !== ($file = readdir($handle))) {

        // strips files extensions      
        $crap   = array(".jpg", ".jpeg", ".JPG", ".JPEG", ".png", ".PNG", ".gif", ".GIF", ".bmp", ".BMP", "_", "-");    

        $newstring = str_replace($crap, " ", $file );   

        //asort($file, SORT_NUMERIC); - doesnt work :(

        // hides folders, writes out ul of images and thumbnails from two folders

        if ($file != "." && $file != ".." && $file != "index.php" && $file != "Thumbnails") {
            $dirFiles[] = $file;
        }
    }
    closedir($handle);
}

sort($dirFiles);
foreach($dirFiles as $file)
{
    echo "<li><a href=\"/Failai/$file\" class=\"thickbox\" rel=\"gallery\" title=\"$newstring\"><img src=\"Images/Thumbnails/$file\" alt=\"$newstring\" width=\"300\"  </a></li>\n";
}