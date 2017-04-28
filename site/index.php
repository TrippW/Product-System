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
          <a class="navbar-brand em-text" href="#">Auto Parts</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <section id="products" style="padding-top: 30px;">
      <?php
        // Create connection to parts database
        require('partsdb.php');

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
                echo '<div class="thumbnail">';
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


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.js"></script>
  </body>
</html>
