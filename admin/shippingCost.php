<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Shipping Costs</title>
<!-- Style CSS -->
<link href="../media/assets/bootstrap-3.3.6/css/bootstrap.min.css" media="screen" rel="stylesheet">
<link href="../media/assets/font-awesome/css/font-awesome.min.css" media="screen" rel="stylesheet">
<link href="../media/media/css/custom.css" rel="stylesheet">
<script src="../media/js/jquery-1.12.1.min.js"></script>
<script src="../media/assets/bootstrap-3.3.6/js/bootstrap.min.js"></script>
</head>
<body >
    <div class="wrapper" >
        <div> 
<div class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">
        <span class="navbar-brand">
            <img style="width: 40px; height: 40px; margin-top: -5px; margin-right: 3px; float: left; display:none;" src="">
            Administrator
            <span class="hidden-sm text-muted" style="font-size:13px;"></span>
        </span>
      <button data-target="#navbar-main" data-toggle="collapse" type="button" class="navbar-toggle">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div id="navbar-main" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a class="bg-hover-color" href="index.php">Orders</a></li>
        <li><a class="bg-hover-color" href="#">Shipping Costs </a></li>
        <li class="dropdown"><a class="bg-hover-color dropdown-toggle" href="#" data-toggle="dropdown">Search By <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a class="bg-hover-color" href="index.php">Date</a></li>
            <li><a class="bg-hover-color" href="searchPrice.php">Price</a></li>
            <li><a class="bg-hover-color" href="searchStatus.php">Status</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
<input type='hidden' id='bhb-navbar-scrollspy' value ='1'>
</div> 
<div > 
<div class='container'> 
<div class='row'> 
<div class="col-sm-12">
<h1 style="text-align:left;"> 
Shipping Costs
</h1> 
<div class='row'>
<div class='col-md-3'></div>
<div class='col-md-6'>
<?php
  require('../db.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
   if (isset($_POST['create']))
   {
    $sql = sprintf("INSERT INTO ShippingCost (Weight, Cost) VALUES ('%s','%s')",
             @mysql_escape_string($_POST["WEIGHT"]),
             @mysql_escape_string($_POST["COST"]));
    $stmt = $db->query($sql);

    if (!$stmt)
     die("Database query failed.");

   }

   elseif (isset($_POST['delete']))
   {
    $sql = sprintf("DELETE FROM ShippingCost WHERE Weight='%s'",
                @mysql_escape_string($_POST["WEIGHT"]));
    $stmt = $db->query($sql);

    if (!$stmt)
     die("Database query failed.");
   }
  }

  $sql = "select Weight, Cost from ShippingCost Order By Weight;";
  $stmt = $db->query($sql);

  if (!$stmt)
    die("Database query failed.");

  echo '<table class="table">';
  echo '<thead><tr><th>Weight</th><th>Cost</th></tr></thead>';

  echo '<tbody>';
  while($row = $stmt->fetch()) {
    echo '<tr><td>'.$row['Weight'].'</td><td>'.$row['Cost'].'</td></tr>';
  }
  echo '</tbody>';
  echo '</table>';
 ?> 
</div>
<div class='col-md-3'></div>
</div>
<form action="#" method="post" onsubmit="window.location.reload();"> 
<h4 style="text-align:center;"> 
Always include cost when adding a weight bracket.
</h4> 
<div  style="padding-bottom:50px;"> 
<div class='container-fluid'> 
<div class='row'> 
<div class="col-sm-6">
<div class="form-group"><label>Lower Weight*</label><input  name="WEIGHT" placeholder="Enter Weight" class=" form-control" required> 
</div>
<div > 
<div class='container-fluid'> 
<div class='row'> 
<div class="col-sm-6">
<div class=" text-center" > 
<input type="submit" class="btn btn-success btn-md btn-block" name="create" value="Add Bracket">
</div> 
</div>
<div class="col-sm-6">
<div class=" text-center" > 
<input type="submit" class="btn btn-danger btn-md btn-block" name="delete" value="Delete Bracket">
</div> 
</div>
</div> 
</div> 
</div>
</div>
<div class="col-sm-6">
<div class="form-group"><label>Cost</label><input  name="COST" placeholder="Enter Cost" class=" form-control"> 
</div>
</div>
</div> 
</div> 
</div>
</form>
</div>
</div> 
</div> 
</div>
<div  style="background-color:#262626;padding-top:5px;border-style:none;"> 
<div class='container'> 
<div class='row'> 
<div class="col-sm-12">
<p style="text-align:center;color:#e5e5e5;border-style:none;"> 
Copyright ©2017 Group 8  all rights reserved.
</p> 
</div>
</div> 
</div> 
</div>

    </div>
<link href="../media/media/css/animate.min.css" rel="stylesheet">
<script src="../media/media/assets/wow-1.1.0/dist/wow.min.js"></script>
<script src="../media/media/assets/wow-1.1.0/wow-init.js"></script>
<script src="../media/plugins/navbar/assets/js/navbar-portlet.js"></script>
<script src="../media/plugins/navbar/assets/sticky-1.0.3/jquery.sticky.min.js"></script>
<script src="../media/plugins/navbar/assets/js/jquery.easing.1.3.min.js"></script>
<script src="../media/plugins/navbar/assets/js/anchor-scroll.js"></script>
<script src="../media/plugins/row/assets/parallax.js-1.4.2/parallax.min.js"></script>
    
 
</body>
</html>
