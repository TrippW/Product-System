<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Order Slip</title>
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


<!--view and edit weight brackets-->
<section id="Orders">
<center>
<h1>Order Information</h1>
</center>
 <?php
  require('../partsdb.php');
  require('../db.php');

  $id = $_GET['id'];//@mysql_escape_string($_GET['id']);

  $sql = "SELECT a.*, b.* FROM OrderSlip a INNER JOIN OrderItem b ON a.OrderID = b.OrderID ".
         "WHERE a.OrderID='$id';";
  $stmt = $db->query($sql);

  if (!$stmt)
   die("Database query failed.");

  $i = 0;  // Counter
  echo '<div class="container">';

  $row = $stmt->fetch();

  if($row['StreetAddress'] == '')
  {
   echo "User does not exist";
  }
  else
  {
//print customer information
  echo'<center>';
   printf("Name: %s<br>",$row['Name']);
   printf("Address: %s<br>%s, %s %s<br>", $row['StreetAddress'], $row['City'], $row['State'], $row['Zip']);
   printf("Date: %s <br>", $row[Date]);
   printf("Status: %s <br><br>", $row['Status']);

//print order information
   echo '<table width = "50%" align="center" style="margin-bottom:50px; border: 2px solid black;">';
   printf("<tr><th>%s</th><th> %8s </th><th> %8s</th><th>%16s</th></tr>", 'Cost Per Item', 'Quantity', 'Product ID','Description');

    $sql2 = "SELECT * FROM parts WHERE number ='".$row['ProductID']."';";
    $stmt2 = $partsdb->query($sql2);
    $product = $stmt2->fetch();

   printf("<tr><td>$%.02f</td><td> %8s </td><td> %8s</td><td> %16s</td></tr>", $row['CostPerItem'], $row['Quantity'], $row['ProductID'], $product['description']);

   while($row = $stmt->fetch())
   {
    $sql2 = "SELECT * FROM parts WHERE number ='".$row['ProductID']."';";
    $stmt2 = $partsdb->query($sql2);
    $product = $stmt2->fetch();
    printf("<tr><td>$%.02f</td><td> %8s </td><td> %8s</td><td> %16s</td></tr>", $row['CostPerItem'], $row['Quantity'], $row['ProductID'], $product['description']);
   }

  $sql = "SELECT ShippingPrice FROM OrderSlip WHERE OrderID='".$id."';";
  $stmt = $db->query($sql);

  if (!$stmt)
   die("Database query failed.");

  $row = $stmt->fetch();

   printf("<tr><td>%s</td><td> %8s </td><td> %8s</td><td> $%.02f </td></tr>", "Shipping Cost", "", "", $row['ShippingPrice']);
   echo '</table>';
  }
  echo '</center>';
  echo '</div>';
 ?>
</section>

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
