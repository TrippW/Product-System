
<?php
  $host = "courses";
  $user = "z1736289";
  $password = "1995Dec07";
  $db = "z1736289";

  $table = "ShippingCost";

  $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
  $weightdb = new PDO("mysql:host=$host;dbname=$db",$user,$password);
  try {
    $weightdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $weightdb->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }
  catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }
?>




