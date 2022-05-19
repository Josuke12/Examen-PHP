<?php

$connect = @new mysqli('localhost', 'root', 'root', 'php_site');

if($connect->connect_errno) {
    die('Error DB: ' . $connect->connect_errno);
}