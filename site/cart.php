<?php
$cookie_name = "ProductSystemCart";
if(!isset($_COOKIE[$cookie_name])) {
 $cookie_value = time();
 setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/~z1736289/467/","students.cs.niu.edu",0);
 echo "SET COOKIE";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Cart</title>
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
            Auto Parts
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
        <li><a class="bg-hover-color" href="index.php">Home</a></li>
        <li><a class="bg-hover-color" href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
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
<h1 style="text-align:center;"> 
Cart
</h1> 
<form  action="checkout.php" method="POST" style="border-style:solid;border-color:#000000;"> 
<div > 
<div class='container-fluid' style="padding-top:30px; padding-bottom:30px;"> 
<div class='row'>
<div class='col-sm-12'>
<?php
  require('../partsdb.php');
  require('../db.php');

  $sql = "SELECT * FROM Cart Where CartID = '".$_COOKIE[$cookie_name]."'";
  $stmt = $db->query($sql);

  if (!$stmt) {
    die("Database query failed.");
  } 
  
  $total = 0;
  $weight1 = 0;
  
  while ($row = $stmt->fetch()) {
    $partNum = $row["ProductID"];
    $sql2 = "SELECT * FROM parts WHERE number='$partNum'";
    $stmt2 = $partsdb->query($sql2);

    if (!$stmt2) {
      die("Database query failed.");
    }     
    
    $row2 = $stmt2->fetch();
    
    echo '<div class="row">';
    echo '<div class="col-md-2"> </div>';
    echo '<div class="col-md-8">';
    echo '<div class="thumbnail">';
    echo '<img style="padding-top:10px;width=240px;height=180px;" src="' . $row2[pictureURL] . '">';
    echo '<div class="caption">';
    echo '<h4 class="pull-right">';
    echo '$', $row2[price];
    echo '</h4>';
    echo '<p>', $row2[description], '</p>';
    echo '<p>Quantity: ', $row[Quantity], '</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
#    echo '<a href="cart.php?number=' . $row[number] . '">Remove</a>';
    echo '</div>';
    $weight = $row2[weight] * $row[Quantity];
    $times = $row2[price] * $row[Quantity];
    $weight1 = $weight1 + $weight;
    $total = $total + $times;
  }
  $sql3 = "SELECT Cost FROM ShippingCost WHERE Weight < '$weight1' ORDER BY Weight DESC";
  $stmt3 = $db->query($sql3);
  
  if ($stmt3->rowCount() == 0) {
    $shipping = 0;
  }
  else {
    $row3 = $stmt3->fetch();
    $shipping = $row3['Cost'];    
  }
    
  $total = $total + $shipping;
  echo '<input type="hidden" name="totalval" value='.$total.'>'; //sending total to checkout.php
  echo '<input type="hidden" name="shippingval" value='.$shipping.'>'; //sending shipping to checkout.php
?>
</div>
</div
<div class='row'> 
<div class="col-sm-6">
</div>
<div class="col-sm-6">
<h3 style="text-align:left;"> 
TOTAL: $ <?php printf("%.2f", $total); ?>
</h3> 
<h4 style="text-align:left;"> 
Shipping Cost: $ <?php printf("%.2f", $shipping); ?>
</h4>
</div>
</div> 
</div> 
</div>
<div > 
<div class='container-fluid'> 
<div class='row'> 
<div class="col-sm-3">
</div>
<div class="col-sm-6">
<div class="text-center" style="padding-bottom: 10px;"> 
<input type="submit" class="btn btn-warning btn-md btn-block" value="Proceed to Checkout">
</div> 
</div>
<div class="col-sm-3">
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
Copyright ©2017 Group 8 all rights reserved.
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
