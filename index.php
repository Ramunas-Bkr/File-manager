<?php
require 'bootstrap.php';
require 'uploader.php';

if (isset($_SESSION['login']) || $_SESSION['login'] == 1) {
} else {
    header('Location: http://localhost/10/Work/login.php');
    die();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>File Manager</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="wrapper aligned">
        <header class="box item1">  
            <h1 class="index-header">Tekstinių ir jpg failų menedžeris</h1>
            <div class="login-info">  
                <div class="user-name">Dabar prisijungęs <?= $_SESSION['vardas'] ?></div><br>
                <a class="logout" href="http://localhost/10/Work/login.php?logout=1">Atsijungti</a>
             </div>
        </header>
        <div class="box item2">
            <form method="post" action="">
                <!-- <input type="text" placeholder="Failo pavadinimas" name="filename" value=""> -->
                <textarea <?php echo $txt ?> name="writetext" placeholder=""><?php echo $edit ?></textarea>
                <img <?php echo $jpg ?> src="<?php echo 'Failai/'.$_SESSION['filename'] ?>" alt="">
                <div class="atidaryta"> <?php echo $itsOpen ?> </div>
                <input <?php echo $txt ?> class="save" name="saugoti" type="submit" value="Saugoti">
                <input class="save" type="submit" name="delete" value="Ištrinti">
                <!-- <input class="submit" name="koreguoti" type="submit" value="Koreguoti"> -->
            </form>
        </div>
        <div class="box item3">
            <div class="antraste">
                Įkelti failai:
            </div>
            <form action="">
                <?php 
                    if ( $handle = opendir (DIR.'/Failai/')) {
                        while ( false !== ( $entry = readdir ( $handle ))) {
                            if ($entry == '.' || $entry == '..') {
                                continue;
                            }
                                echo '<input class="file-list" type="submit" name="edit" id="subject" value="'.$entry.'"<br>';
                            }
                            closedir ( $handle );
                            }
                ?>
            </form>
        </div>
        <div class="box item4">
            <form name="openfile" method="post" action="">
                <div class="text-area">Sukurti naują tekstinį failą:</div>
                <div class="txt">
                    <input class="open" type="text" name="filename" value="">.txt
                </div>
                <input class="submit" type="submit" name="open" value="Patvirtinti"><br>
                <div class="klaida"><?php echo $negerai ?> </div>
            </form>
        </div>
        <div style="margin-top: -50px;" class=" dir box item4">
            <form name="openfile" method="post" action="">
                <div class="text-area">Sukurti naują katalogą:</div>
                <div class="txt">
                    <input class="open" type="text" name="dir" value="">
                </div>
                <input class="submit" type="submit" name="createDir" value="Patvirtinti"><br>
                <div class="klaida"><?php echo $negerai ?> </div>
            </form>
        </div>
        <div style="margin-top: 20px;" class="box item4">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="photo-txt"> Pasirinkite jpg failą įkėlimui: </div>
                <input class="pasirinkt" type="file" name="fileToUpload" id="fileToUpload">
                <input class="submit" type="submit" value="Įkelti" name="submit-ph">
            </form>
            <div class="klaida"><?php echo $negerai2 ?> </div>
        </div>
            
    </div>
</body>
</html>

