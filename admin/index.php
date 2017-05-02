<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>cosmo-shipping-cost</title>
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
        <li><a class="bg-hover-color" href="shippingCost.php">Shipping Costs </a></li>
        <li class="dropdown"><a class="bg-hover-color dropdown-toggle" href="#" data-toggle="dropdown">Search By <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a class="bg-hover-color" href="#">Date</a></li>
            <li><a class="bg-hover-color" href="searchPrice.php">Price</a></li>
            <li><a class="bg-hover-color" href="searchStatus.php">Status</a></li>
          </ul>
        </li>
      </ul>
     <form action="#" class="navbar-form pull-right" method="POST">
        <div class="form-group">
          <input type="text" class="form-control" name="valueLow" placeholder="Start Date">
          <input type="text" class="form-control" name="valueHigh" placeholder="End Date">
        </div>
        <button type="submit" class="btn btn-default" name="search" value=Filter>Submit</button>
      </form> 
    </div>
  </div>
</div>
<input type='hidden' id='bhb-navbar-scrollspy' value ='1'>
</div> 

<div class="container">
<center>
  <div class="row">
   <div class="col-md-4">
      <h2>DATE</h2>
   </div>
   <div class="col-md-4">
      <h2>TOTAL</h2>
   </div>
   <div class="col-md-4">
      <h2>STATUS</h2>
   </div>
</div>
</center>

</div>

<section>
 <?php

  require('../db.php');


  $sql = "SELECT a.OrderID, a.Date, sum(b.CostPerItem*b.Quantity) AS Cost, a.Status FROM OrderSlip a INNER JOIN OrderItem b ON a.OrderID = b.OrderID ".
         "GROUP BY a.OrderID;";
  $stmt = $db->query($sql);

  if (!$stmt)
   die("Database query failed.");

 // $i = 0;  // Counter
  echo '<div class="container">';
  //printf("%10s &nbsp;&nbsp;&nbsp;&nbsp; %10s<br>",'Weight','Cost');

  while($row = $stmt->fetch())
  { 
        echo '<center>
          <div class="container-fluid">
          <div class="row">
            <div class="col-md-4">
              <h4><a href = "orderSlip.php?id=',$row['OrderID'],'">'.$row['Date'].'</a> </h4>
            </div>
            <div class="col-md-4">
              <h4><a href = "orderSlip.php?id=',$row['OrderID'],'">';
                                               printf("$%.02f",$row['Cost']);
                                               echo '</a> </h4>
            </div>
            <div class="col-md-4">
              <h4><a href = "orderSlip.php?id=',$row['OrderID'],'">',$row['Status'],'</a> </h4>
            </div>
          </div>
         </div><!--close site container-->
         </center>';

   //printf("<a href = orderSlip.php?id=%s>%10s &nbsp;&nbsp;&nbsp;&nbsp; $%.02f &nbsp;&nbsp;&nbsp;&nbsp; %8s</a><br>", $row['OrderID'], $row['Date'], $row['Cost'], $row['Status']);
  }

  echo '</div>';
 ?>
</section>


<div style="background-color:#262626;padding-top:5px;border-style:none;"> 
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
