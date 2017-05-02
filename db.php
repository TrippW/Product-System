
<?php
//MYSQL 
  $host = "courses";
  $user = "z1736289";
  $password = "1995Dec07";
  $db = "z1736289";

  $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
  $db = new PDO("mysql:host=$host;dbname=$db",$user,$password);
  try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }
  catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }
//MYSQLi
  
  $dbh = "courses";
  $dbu = "z1736289";
  $dbp = "1995Dec07";
  $dbn = "z1736289";
  $db2 = mysqli_connect($dbh, $dbu, $dbp, $dbn);

  $query = "SELECT * FROM OrderSlip";
  $result = mysqli_query($db2, $query);
  if (!$result)
   {
      die("Database query failed Initial.");
   }

?>




