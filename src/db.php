<?php
$host = 'localhost';
$db   = 'loja_pratica-7';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die('Connection error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

?>