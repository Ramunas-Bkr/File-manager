<?php
define('DIR', __DIR__);

// include_path = "DIR/includes";

// if (isset($_POST['save'])) {
//     file_put_contents(DIR.'/Failai/text.txt', $_POST['writetext']);
// }

// $edit = '';

// if (isset($_POST['koreguoti'])) {
//     $edit = file_get_contents(DIR.'/Failai/text.txt');
// }

$edit = '';
$negerai = '';
$negerai2 = '';
$itsOpen = '';
$jpg = 'style="display: grid"';
$txt = 'style="display: grid"';



if (isset($_POST['open'])) {
    if(!empty($_POST['filename'])) {
        if(!file_exists(DIR.'/Failai/'.$_POST['filename'].'.txt')) {
        file_put_contents(DIR.'/Failai/'.$_POST['filename'].'.txt', '');
    } else {
        $negerai = 'KLAIDA: Toks failas jau egzistuoja';
        // $edit = file_get_contents(DIR.'/Failai/'.$_POST['filename'].'.txt');
        // $itsOpen = 'Atidarytas failas '.$_POST['filename'].'.txt';
        // $_SESSION['filename'] = $_POST['filename'];
        }
    } else {
    $negerai = 'KLAIDA: Reikia įvesti failo pavadinimą';
    } 
} 

if (isset($_POST['createDir'])) {
    if(!empty($_POST['dir'])) {
        mkdir(DIR.'/Failai/'.$_POST['dir'].'/');
        } else {
    $negerai = 'KLAIDA: Reikia įvesti katalogo pavadinimą';
    } 
} 

if (isset($_POST['delete'])) {
    if (file_exists(DIR.'/Failai/'.$_SESSION['filename'])) {
        unlink(DIR.'/Failai/'.$_SESSION['filename']);
        unset ($_SESSION['filename']);
        unset ($_GET['edit']);
        $edit = '';
        $jpg = 'style="display: none"';
        $txt = 'style="display: grid"';
    } 
}

if (isset($_POST['saugoti'])) {
    if (empty($_SESSION['filename'])) {
        $itsOpen = 'KLAIDA: Nepasirinktas joks failas';
    } else {
        file_put_contents(DIR.'/Failai/'.$_SESSION['filename'], $_POST['writetext']);
        unset ($_SESSION['filename']);
        unset ($_GET['edit']);
        $edit = '';
    }}

if (isset($_GET['edit'])) {
    $edit = file_get_contents(DIR.'/Failai/'.$_GET['edit']);
    $itsOpen = 'Atidarytas failas '.$_GET['edit'];
    $_SESSION['filename'] = $_GET['edit'];
}

if (isset($_POST['submit-ph'])) {
    $message = '';
    $dir = DIR.'\Failai\\';
    $uploadOk = 1;
    $target_file = $dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST['submit-ph'])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $message = "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $message = "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        $message = "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $message = "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && 
        $imageFileType != "jpeg") {
            $message = "Sorry, only JPG, JPEG files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message.="<br>Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $_SESSION['filename'] = $_FILES["fileToUpload"]["name"];
            $message = "<br>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            $itsOpen = $_FILES["fileToUpload"]["name"];
        } else {
            $message = "<br>Sorry, there was an error uploading your file.";
        }
    }    
} else {
    $message = '<br>Please select file.';
}
if (!empty ($_SESSION['filename'])) {
if (strstr($_SESSION['filename'], '.txt', true)) {
    $jpg = 'style="display: none"';
    // unset ($_SESSION['filename']);
} elseif (strstr($_SESSION['filename'], '.jp', true)) {
    $txt = 'style="display: none"';
}}