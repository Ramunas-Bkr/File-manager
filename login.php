<?php
require 'bootstrap.php';
if (isset($_GET['logout'])) {
    session_unset();
}
if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
    header('Location: http://localhost/10/Work/index.php');
    die();
}
if (!empty($_POST)) {
    if (isset($logins[$_POST['vardas']])) {
        if ($logins[$_POST['vardas']] === md5($_POST['slapt'])) {
            $_SESSION['login'] = 1;
            $_SESSION['vardas'] = $_POST['vardas'];
            header('Location: http://localhost/10/Work/index.php');
            die();
        }
    }
    $klaida = 'Neteisingas slaptažodis arba vardas';
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prisijungimas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1 class="login-header">Tekstinių ir jpg failų menedžeris</h1>
<h3>Prisijunkite</h3>
<h5 style="color:red;"><?= $klaida ?? '' ?></h5>
<form class="laukai" action="" method="post">
  <div class="ivedimo-laukas">
    <div class="names">Įveskite vardą</div>
    <input class="input" type="text" name="vardas">
    <div class="names">Slaptažodis:</div>
    <input class="input" type="password" name="slapt">
  </div>
  <input class="submit" type="submit" value="Jungtis">
</form>
</body>
</html>