<?php
  $host = "courses";
  $user = "z1736289";
  $password = "1995Dec07";
  $db = "z1736289";

  $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
  $partsdb = new PDO("mysql:host=$host;dbname=$db",$user,$password);
  try {
    $partsdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $partsdb->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }
  catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }

// Tables:
//  OrderSlip - OrderID, Name, Email, StreetAddress, City, State, Zip, Status
//  OrderItem - OrderID, ProductID, Quantity, CostPerItem
//  Inventory - PartNum, Quantity
//  ShippingCost - Weight, Cost
?>

