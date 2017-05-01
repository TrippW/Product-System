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
          <a class="navbar-brand em-text" href="index.php">Update Inventory</a>
        </div>
      </div>
    </nav>

    <section>
      <div class="container">
        <div class="row">
        <?php
          // Create connection to parts database
          require('partsdb.php');

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
            <div class="col-md-2">
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
            <div class="col-md-2">
            </div>
            <div class="col-md-2 text-right">
                <input type="submit" class="btn btn-primary" name="add" value="Update Inventory">
            </div>
          </div>
          <div class="col-md-4">
          </div>
        </div>
        </form>

        <?php
          require('orderdb.php');

          if (isset($_POST['add'])) {
            $sql = "SELECT * FROM Inventory WHERE PartNum='$partNum'";
            $stmt = $orderdb->query($sql);

            if (!$stmt) {
              die("Database query failed.");
            }

            // If product not in inventory, create new inventory item
            if ($stmt->rowCount() == 0) {
              $insert = $orderdb->prepare("INSERT into Inventory (PartNum, Quantity) values (:partNum, :quantity)");
              $insert->bindParam(":partNum", $partNum);
              $insert->bindParam(":quantity", $_POST['quantity']);

              $insert->execute();
              $insert->closeCursor();
            }
            else {
              $row = $stmt->fetch();

              $updateQ = $row['Quantity'] + $_POST["quantity"];

              $insert = $orderdb->query("UPDATE Inventory SET Quantity='$updateQ' WHERE PartNum='$partNum'");
            }

            $sql = "SELECT * FROM Inventory WHERE PartNum='$partNum'";
            $stmt = $orderdb->query($sql);

            if (!$stmt) {
              die("Database query failed.");
            }

            $row = $stmt->fetch();

            echo '<br><br>';
            echo '<div class="row text-center">';
              echo '<h4>Inventory successfully updated. '.$row["Quantity"].' items in stock.</h4>';
            echo '</div>';
          }
        ?>

      </div>
    </section>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
  </body>
</html>


