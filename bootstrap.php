<?php

session_start();

$logins = [
    'Maggie' => md5('qwerty'),
    'Marge' => md5('123456'),
    'Bart' => md5('password'),
    'Lisa' => md5('zxcv'),
    'Homer' => md5('1'),
];