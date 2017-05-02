<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Update Inventory</title>
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
            Update Inventory
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
        <li><a class="bg-hover-color" href="index.php">Inventory Search </a></li>
      </ul>
    </div>
  </div>
</div>
<input type='hidden' id='bhb-navbar-scrollspy' value ='1'>
</div> 
    <section>
      <div class="container">
        <div class="row">
        <?php
          // Create connection to parts database
          require('../partsdb.php');

          $partNum = $_GET['num'];

          // Select information from database
          $sql = "SELECT * FROM parts WHERE number='$partNum'";
          $stmt = $partsdb->query($sql);

          if (!$stmt) {
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
            echo '<h4>Part Number: '.$row["number"].'</h4>';
            echo '<h4>'.$row["description"].'</h4>';
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
              <h4>Parts Received:</h4>
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
            <input type="submit" class="btn btn-primary" name="add" value="Update Inventory">
          </div>
          </div>
          <div class="col-md-4">
          </div>
        </div>
        </form>

        <?php
          require('../db.php');

          if (isset($_POST['add'])) {
            $sql = "SELECT * FROM Inventory WHERE PartNum='$partNum'";
            $stmt = $db->query($sql);

            if (!$stmt) {
              die("Database query failed.");
            }

            // If product not in inventory, create new inventory item
            if ($stmt->rowCount() == 0) {
              $insert = $db->prepare("INSERT into Inventory (PartNum, Quantity) values (:partNum, :quantity)");
              $insert->bindParam(":partNum", $partNum);
              $insert->bindParam(":quantity", $_POST['quantity']);

              $insert->execute();
              $insert->closeCursor();
            }
            else {
              $row = $stmt->fetch();

              $updateQ = $row['Quantity'] + $_POST["quantity"];

              $insert = $db->query("UPDATE Inventory SET Quantity='$updateQ' WHERE PartNum='$partNum'");
            }

            $sql = "SELECT * FROM Inventory WHERE PartNum='$partNum'";
            $stmt = $db->query($sql);

            if (!$stmt) {
              die("Database query failed.");
            }

            $row = $stmt->fetch();

            echo '<br>';
            echo '<div class="row text-center">';
              echo '<h4>Inventory successfully updated. '.$row["Quantity"].' items in stock.</h4>';
            echo '</div>';
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

