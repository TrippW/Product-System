<?php
  $host = "courses";
  $user = "z1730089";
  $password = "1996Jun18";
  $db = "z1730089";

  $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
  $partsdb = new PDO("mysql:host=$host;dbname=$db",$user,$password);
  try {
    $partsdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $partsdb->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }
  catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }
?>
