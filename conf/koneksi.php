<?php
    $host       = 'localhost'; //nama Host
    $username   = 'root';
    $password   = '';
    $database   = 'crud_ajax';

    $pdo = new pdo('mysql:host='.$host.';dbname='.$database,$username,$password);
?>