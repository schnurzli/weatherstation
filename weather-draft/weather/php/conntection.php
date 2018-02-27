<?php

try {
   $host = 'localhost';
   $port = 1433;
   $name = 'weatherdata';
   $user = 'root';
   $pass = '';

    $mydbc = new PDO ("dblib:host=$host:$port;dbname=$name",$user,$pass);
   
   
} catch (PDOException $e) {
   
    echo 'MSSQL Connection failed: ' . $e->getMessage();
   
}