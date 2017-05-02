<?php
$cookie_name = "ProductSystemCart";
if(!isset($_COOKIE[$cookie_name])) {
 $cookie_value = time();
 setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/~z1736289/467/","students.cs.niu.edu",0);
 echo "SET COOKIE";
// setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/","students.cs.niu.edu",0);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Auto Store</title>
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
            Auto Store
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
        <li><a class="bg-hover-color" href="#">Home</a></li>
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
<div> 
  <section id="products" style="padding-top: 30px;">
      <?php
        // Create connection to parts database
        require('../partsdb.php');

        // Select information from database
        $sql = "select * from parts";
        $stmt = $partsdb->query($sql);

        if (!$stmt) {
          die("Database query failed.");
        }

        $i = 0;  // Counter

        echo '<div class="container">';
            // Display parts, 4 per row
            while ($row = $stmt->fetch()) {
              if ($i%4 == 0) {
                echo '<div class="row">';
              }

                echo '<div class="col-md-3">';
                echo '<div class="thumbnail" style="border: none;">';
                  // Display image and make it clickable
                  echo '<a class="center-block" href=productDetails.php?num='.$row["number"].' class="btn btn-default">';
                  echo '<img style="width:120px;height:90px;" src="'.$row["pictureURL"].'">';
                  // Display part caption and price
                  echo '<div class="caption">';
                    echo '<p>Price: $'.$row["price"].'</p>';
                    echo '<p>'.$row["description"].'<p>';
                  echo '</div>';
                  echo '</a>';
                echo '</div>';
                echo '</div>';

              $i++;
              if ($i%4 == 0) {
                echo '</div>';
              }
            }
        echo '</div>';
      ?>
    </section>
</div> 
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
<script src="../media/plugins/navbar/assets/js/navbar-portlet.js"></script>
<script src="../media/plugins/navbar/assets/sticky-1.0.3/jquery.sticky.min.js"></script>
<script src="../media/plugins/navbar/assets/js/jquery.easing.1.3.min.js"></script>
<script src="../media/plugins/navbar/assets/js/anchor-scroll.js"></script>
<script src="../media/plugins/row/assets/parallax.js-1.4.2/parallax.min.js"></script>
<script src="../media/media/assets/wow-1.1.0/dist/wow.min.js"></script>
<script src="../media/media/assets/wow-1.1.0/wow-init.js"></script>
    
 
</body>
</html>
