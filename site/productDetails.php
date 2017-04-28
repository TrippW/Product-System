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
          <a class="navbar-brand em-text" href="index.php">Auto Parts</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
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
          $sql = "select * from parts where number = '$partNum'";
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
            echo '<h4>Price: $'.$row["price"].'</h4>';
            echo '<h4>'.$row["description"].'</h4>';
          echo '</div>';
          echo '<div class="col-md-4">';
          echo '</div>';
        ?>
        </div>

        <hr>

        <div class="row">
          <div class="col-md-4">
          </div>
          <div class="form-group">
            <div class="col-md-2">
              <h4>Quantity:</h4>
            </div>
            <div class="col-md-2">
              <select class="form-control">
                <?php
                  for ($i = 1; $i <= 20; $i++) {
                    echo '<option>'.$i.'</option>';
                  }
                ?>
              </select>
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
              <form action="#" method="POST">
                <input type="submit" class="btn btn-primary" name="add" value="Add to cart">
              </form>
            </div>
          </div>
          <div class="col-md-4">
          </div>
        </div>

        <?php
          if (isset($_POST['add'])) {
            // insert product into cart
            echo 'Success';
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
