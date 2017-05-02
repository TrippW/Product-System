<!DOCTYPE html>
<?php

  $dbhost = "blitz.cs.niu.edu";
  $dbuser = "student";
  $dbpass = "student";
  $dbname = "csci467";

  $dbh = "courses";
  $dbu = "z1736289";
  $dbp = "1995Dec07";
  $dbn = "z1736289";
  
  $partsdb = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  $db = mysqli_connect($dbh, $dbu, $dbp, $dbn);

  if(mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
  }
  
  $total = $_POST['totalval'];
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Checkout</title>
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
Checkout
</h1> 
<form  action="checkout.php" method="POST" name="checkout"  style="border-style:solid;border-color:#000000;"> 
<div  style="padding-top:50px;padding-bottom:50px;border-style:none;"> 
<div class='container-fluid'> 
<div class='row'> 
<div class="col-sm-12">
<h3 style="text-align:left;border-style:none;"> 
Shipping Information 
</h3> 
<div > 
<div class='container-fluid'> 
<div class='row'> 
<div class="col-sm-8">
<div class="form-group"><label>Name*</label><input  name="name" placeholder="Enter Name" class=" form-control" required> 
</div>
<div class="form-group"><label>Email Address*</label><input  name="email " placeholder="Enter Email" class=" form-control" required> 
</div>
<div class="form-group"><label>Address Line 1*</label><input  name="shippingaddress" placeholder="Shipping Address Line 1" class=" form-control" required> 
</div>
<div class='row'> 
<div class="col-sm-4">
<div class="form-group"><label>City*</label><input  name="city" placeholder="Enter State" class=" form-control" required> 
</div>
</div>
<div class="col-sm-4">
<div class="form-group"><label>State*</label><input  name="state" placeholder="State" class=" form-control" required> 
</div>
</div>
<div class="col-sm-4">
<div class="form-group"><label>Zip Code*</label><input  name="zip" placeholder="Zip" class=" form-control" required> 
</div>
</div>
</div> 
<div > 
<div class='container-fluid'> 
<div class='row'> 
<div class="col-sm-6">
<div class="form-group"><label>Credit Card Number*</label><input  name="creditcard" placeholder="Enter Credit Card Number" class=" form-control" required> 
</div>
</div>
<div class="col-sm-6">
<div class="form-group"><label>Expiration Date*</label><input  name="expiration" placeholder="MM/YYYY" class=" form-control" required> 
</div>
</div>
</div> 
</div> 
</div>
</div>
<div class="col-sm-4">
<h3 style="text-align:left;"> 
Please enter all information as accurately as possible. 
</h3>
<h2> TOTAL: $<?php echo $total; ?> </h2>
</div>
</div> 
</div> 
</div>
<div  style="border-style:none;"> 
<div class='container-fluid'> 
<div class='row'> 
<div class="col-sm-8">
<div class=" text-right"  style="border-style:none;"> 
<input type="submit" class="btn btn-primary btn-md btn-block" name="submitOrder" value="Checkout and Pay">
</div> 
</div>
<div class="col-sm-4">
</div>
</div> 
</div> 
</div>
</div>
</div> 
</div> 
</div>
</form>
<?php
   $total = number_format($total, 2, '.', '');
   if(isset($_POST['submitOrder']))
   {
    $name = $_POST['name'];
    $cc = $_POST['creditcard'];
    $expire = $_POST['expiration'];

    echo $total;

    $url = 'http://blitz.cs.niu.edu/CreditCard/';
    $data = array('vendor' => 'VE001-99', 'trans' => mt_rand(1000000,9999999), 'cc' => $cc, 'name' => $name, 'exp' => $expire, 'amount' => $total);
    $options = array('http' => array('header'  => array ('Content-type: application/json', 'Accept: application/json'), 'method'  => 'POST', 'content' => json_encode($data)));
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    
    echo $result;
    $result = strpos($result, "authorization");
   
    if ($result) {
      echo '<h1 class="text-center" style="font-weight: bold;">Order Received Successfully ',printf($total),'</h1>';
       
//      $date = date("Y-m-d");
//      $totalItems = mysqli_query($db, "SELECT COUNT(*) as count FROM Card");
      if(mysqli_query($db, "SELECT Count(*) as count FROM Cart")->fetch_assoc()['count'] == 0)
       die("No Items Selected");

      $stmt = "INSERT INTO OrderSlip (Name, Email, StreetAddress, City, State, Zip, Status, Date) VALUES ('".$_POST['name']."','".$_POST['email']."','".$_POST['shippingaddress']."','".$_POST['city']."','".$_POST['state']."','".$_POST['zip']."', 'Unshipped', NOW())";
echo $stmt;
      if(!mysqli_query($db, $stmt)) die ("Did not place data");

//      $orderID = mysqli_insert_id($db);
      $stmt = mysqli_query($db,"SELECT * FROM OrderSlip ORDER BY OrderID DESC LIMIT 1");
      if(!$stmt) die(" Query Failed");
      $row = $stmt->fetch_assoc();
      $orderID = $row['OrderID'];
      echo "Order ID: '$orderID'";
      $stmt2 = mysqli_query($db,"SELECT * FROM Cart");
  //    $products = $db->query($stmt2);
//      $i = $db->query("SELECT COUNT(Quantity) as TotalProducts FROM Cart")->fetch()['TotalProducts'];


      while ($item = $stmt2->fetch_assoc()) {
        // Loop through shopping cart and add products to orders table
        $partNum = $item['ProductID'];
        echo "PartNum: '$partNum'";
        $stmt3 = "SELECT * FROM parts WHERE number='$partNum'";
        $part = mysqli_query($partsdb,$stmt3)->fetch_assoc();
	echo $item;
	echo $part;
	$sql = sprintf("INSERT INTO OrderItem (OrderID, ProductID, Quantity, CostPerItem) VALUES ('%s','%s','%s','%s')",
             $orderID, $item[ProductID], $item[Quantity], $part[price]);
        $stmt4 = $db->query($sql);
        //$stmt4 = "INSERT INTO OrderItem (OrderID, ProductID, Quantity, CostPerItem) VALUES ('".$orderID."', '".$item[ProductID]."', '".$item[Quantity]."', '".$part[price]."')";
        //mysqli_query($db, $stmt4);
      }

      $stmt5 = "DELETE FROM Cart";
      mysqli_query($db, $stmt5);

    }
    else {
      echo '<h1 class="text-center" style="font-weight: bold; color: #e22b2b;">Failed to Authorize Credit Card Info</h1>';
    }
	}
  ?>
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
