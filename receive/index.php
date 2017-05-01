
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Starter Template for Bootstrap</title>

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
          <a class="navbar-brand em-text" href="#">Update Inventory</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Inventory Search</a></li>
          </ul>
          <form action="index.php" class="navbar-form" method="POST">
            <div class="form-group">
              <input type="text" class="form-control" name="value" placeholder="Part Number or Description">
            </div>
            <button type="submit" class="btn btn-default" name="search" value=Filter>Submit</button>
          </form>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <section id="products" style="padding-top:30px">
      <?php
        // Create connection to parts database
        require('partsdb.php');

        // Select information from database
        if (isset($_POST['search'])) {
          $search = $_POST['value'];
          $sql = "SELECT * FROM parts WHERE number='$search' OR (description LIKE '%$search%')";
          $stmt = $partsdb->query($sql);
        }
        else {
          $sql = "select * from parts";
          $stmt = $partsdb->query($sql);
        }

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
                  echo '<a class="center-block" href=updateInventory.php?num='.$row["number"].' class="btn btn-default">';
                  echo '<img style="width:120px;height:90px;" src="'.$row["pictureURL"].'">';
                  // Display part caption and price
                  echo '<div class="caption">';
                    echo '<p>Part Number: '.$row["number"].'</p>';
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
