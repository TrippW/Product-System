<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


<!--view and edit weight brackets-->
<section id="weights">
 <?php

  require('../db.php');
  echo '<br><br><br><br>';

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
   if (isset($_POST['create']))
   {
//breaks when inserting a duplicate weight (since it's a primary key.
//insert check if weight exists
    $sql = sprintf("INSERT INTO ShippingCost (Weight, Cost) VALUES ('%s','%s');",
             @mysql_escape_string($_POST["WEIGHT"]),
             @mysql_escape_string($_POST["COST"]));
    $stmt = $weightdb->query($sql);

    if (!$stmt)
     die("Database query failed.");

   }
   elseif (isset($_POST['delete']))
   {
    $sql = sprintf("DELETE FROM ShippingCost WHERE Weight='%s';",
                @mysql_escape_string($_POST["WEIGHT"]));
    $stmt = $weightdb->query($sql);

    if (!$stmt)
     die("Database query failed.");

   }
  }

  $sql = "select Weight, Cost from ShippingCost Order By Weight;";
  $stmt = $weightdb->query($sql);

  if (!$stmt)
   die("Database query failed.");

  $i = 0;  // Counter
  echo '<div class="container">';
  printf("%10s &nbsp;&nbsp;&nbsp;&nbsp; %10s<br>",'Weight','Cost');

  while($row = $stmt->fetch())
   printf("%.02f &nbsp;&nbsp;&nbsp;&nbsp; $%.02f<br>", $row['Weight'], $row['Cost']);

  echo '</div>';
 ?>

 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <br><br>
  Lower Weight*: <input type="text" name="WEIGHT" value="<?php echo $name;?>">
  <br><br>
  If adding a weight bracket, please include a cost.
  <br><br>
  Cost: <input type="text" name="COST" value="<?php echo $email;?>">
  <br><br>
  <input type="submit" name="create" value="Add Weight Bracket">
  <br><br>
  <input type="submit" name="delete" value="Delete Weight Bracket">
 </form>
</section>


<!--Viewing Orders-->

<section id="AllOrders">
 <?php

  require('../db.php');
  echo '<br><br><br><br>';


  $sql = "SELECT a.Date, sum(b.CostPerItem*b.Quantity) AS Cost, a.Status FROM OrderSlip a INNER JOIN OrderItem b ON a.OrderID = b.OrderID ".
         "GROUP BY a.OrderID;";
  $stmt = $weightdb->query($sql);

  if (!$stmt)
   die("Database query failed.");

  $i = 0;  // Counter
  echo '<div class="container">';
  printf("%10s &nbsp;&nbsp;&nbsp;&nbsp; %10s<br>",'Weight','Cost');

  while($row = $stmt->fetch())
   printf("%10s &nbsp;&nbsp;&nbsp;&nbsp; $%.02f &nbsp;&nbsp;&nbsp;&nbsp; %8s<br>", $row['Date'], $row['Cost'], $row['Status']);

  echo '</div>';
 ?>
</section>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.js"></script>
  </body>
</html>
