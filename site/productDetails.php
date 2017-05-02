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
<div> 

    <section>
      <div class="container">
        <div class="row">
        <?php
          // Create connection to parts database
          require('../partsdb.php');
          require('../db.php');
          
          $partNum = $_GET['num'];

          // Select information from database
          $sql = "select * from parts where number = '$partNum'";
          $stmt = $partsdb->query($sql);

          if (!$stmt) {
            die("Database query failed.");
          }
          
          $sql = "select * from Inventory where PartNum = '$partNum'";
          $stmt2 = $db->query($sql);

          if (!$stmt2) {
            die("Database query failed.");
          }

          // Get specific product information
          $row = $stmt->fetch();
          
          // Display product image
          echo '<div class="col-md-12">';
            echo '<img class="main-img center-block" style="padding-top:30px;width=240px;height=180px;" src="'.$row["pictureURL"].'">';
          echo '</div>';
        echo '</div>'; // Close row

        // Display product price and description
        echo '<div class="row">';
          echo '<div class="col-md-4">';
          echo '</div>';
          echo '<div class="col-md-4">';
            echo '<h4>Price: $'.$row["price"].'</h4>';
            echo '<h4>'.$row["description"].'</h4>';
            if ($stmt2->rowCount() == 0) {
              echo '<h4>Quantity in Stock: 0</h4>';
            }
            else {
              $row2 = $stmt2->fetch();
              echo '<h4>Quantity in Stock: '.$row2["Quantity"].'</h4>';
            }
          echo '</div>';
          echo '<div class="col-md-4">';
          echo '</div>';
        ?>
        </div>

        <hr>
        <form action="#" method="POST">
        <div class="row">
          <div class="col-md-4">
          </div>
          <div class="form-group">
            <div class="col-md-2" style="padding-bottom: 5px;">
              <h4>Quantity:</h4>
            </div>
            <div class="col-md-2">
              <input type="text" id="quantity" name="quantity" required>
            </div>
          </div>
          <div class="col-md-4">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
          </div>
          <div class="form-group">
            <div class="col-md-4 text-center" style="padding-bottom: 10px;">
              <form action="#" method="POST">
                <input type="submit" class="btn btn-primary" name="add" value="Add to cart">
              </form>
            </div>
          </div>
          <div class="col-md-4">
          </div>
        </div>
        </form>
        
        <?php
          if (isset($_POST['add'])) {
            // insert product into cart
            $quantity = $_POST['quantity'];
            $sql = "SELECT * FROM Inventory WHERE PartNum='$partNum'";
            
            $stmt = $db->query($sql);

            if (!$stmt) {
              die("Database query failed.");
            }
            
            if ($stmt->rowCount() == 0) {
              echo '<br>';
              echo '<div class="row text-center">';
                echo '<h4>Unfortunately, we are out of stock.</h4>';
              echo '</div>';
            }
            else {
              $row = $stmt->fetch();
              $rowQ = $row["Quantity"];
              if ($rowQ == 0) {
                echo '<br>';
                echo '<div class="row text-center">';
                  echo '<h4>Unfortunately, we are out of stock.</h4>';
                echo '</div>';               
              }
              else if ($rowQ < $quantity) {
                echo '<br>';
                echo '<div class="row text-center">';
                  echo '<h4>Unfortunately, we do not have that much in stock.</h4>';
                echo '</div>';     
              }
              else if ($rowQ >= $quantity) {
                $insert = $db->prepare("INSERT into Cart (ProductID, Quantity) values (:partNum, :quantity)");
                $insert->bindParam(":partNum", $partNum);
                $insert->bindParam(":quantity", $_POST['quantity']);

                $insert->execute();
                $insert->closeCursor();
                
                echo '<div class="row text-center">';
                  echo '<h4>Successfully added to cart.</h4>';
                echo '</div>';   
              }
            }
          }
        ?>

      </div>
    </section>
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
