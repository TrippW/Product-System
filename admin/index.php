<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Administrator</title>
<!-- Style CSS -->
<link href="../media/assets/bootstrap-3.3.6/css/bootstrap.min.css" media="screen" rel="stylesheet">
<link href="../media/assets/font-awesome/css/font-awesome.min.css" media="screen" rel="stylesheet">
<link href="../media/media/css/custom.css" rel="stylesheet">
<script src="../media/js/jquery-1.12.1.min.js"></script>
<script src="../media/assets/bootstrap-3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function($) {
    $(".table-row").click(function() {
        window.document.location = $(this).data("href");
    });
});
</script>
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

<section>
<div class='container'>
<div class='row'>
<div class='col-md-1'></div>
<div class='col-md-10'>
 <?php

  require('../db.php');

  $sql = "SELECT a.OrderID, a.Date, sum(b.CostPerItem*b.Quantity)+a.ShippingPrice AS Cost, a.Status FROM OrderSlip a INNER JOIN OrderItem b ON a.OrderID = b.OrderID GROUP BY a.OrderID";
  if(isset($_POST['search'])) 
        $sql = $sql." HAVING a.Date>'".$_POST['valueLow']."' and a.Date < '".$_POST['valueHigh']."'";
  $sql = $sql.";";
  $stmt = $db->query($sql);

  if (!$stmt)
   die("Database query failed.");

  echo '<table class="table table-hover">';
  echo '<thead><tr><th><h3>Date</h3></th><th><h3>Total</h3></th><th><h3>Status</h3></th></tr></thead>';
  echo '<tbody>';
  while($row = $stmt->fetch())
  {
     echo '<tr class="table-row" data-href="orderSlip.php?id=',$row['OrderID'],'"><td>',$row['Date'],'</td><td>',printf("$%.1f",$row['Cost']),'</td><td>',$row['Status'],'</td></tr>';
  }
  echo '</tbody>';
  echo '</table>';
 ?>
</div>
<div class='col-md-1'></div>
</div>
</div>
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
