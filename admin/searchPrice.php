<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Product System</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
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
          <a class="navbar-brand em-text" href="#">Administrator</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Orders</a></li>
            <li><a href="shippingCosts.php">Shipping Costs</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Search by: <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="index.php">Date Range</a></li>
              <li><a href="#">Price Range</a></li>
              <li><a href="searchStatus.php">Status</a></li>
            </ul>
          </li>
          </ul>
          <form action="#" class="navbar-form pull-right" method="POST">
            <div class="form-group">
              <input type="text" class="form-control" name="valueLow" placeholder="Start Price">
              <input type="text" class="form-control" name="valueHigh" placeholder="End Price">
            </div>
            <button type="submit" class="btn btn-default" name="search" value=Filter>Submit</button>
          </form>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<section>
 <?php

  require('weightdb.php');
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
