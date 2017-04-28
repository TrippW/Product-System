
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
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <section id="products">
      <?php
        // Create connection to parts database
        require('partsdb.php');

        // Select information from database
        $sql = "select * from parts";
        $stmt = $partsdb->query($sql);

        if (!$stmt) {
          die("Database query failed.");
        }

        echo '<div class="container">';
          echo '<div class="row">';
            // Display parts
            while ($row = $stmt->fetch()) {
              echo '<form action="#" method="POST">';
                echo '<div class="col-md-3">';
                echo '<div class="thumbnail">';
                  echo '<img src="'.$row["pictureURL"].'">';
                  echo '<div class="caption">';
                    echo '<p>'.$row["description"];
                    echo '<br>Price: $'.$row["price"].'</p>';
                  echo '</div>';
                echo '</div>';
                echo '</div>';
              echo '</form>';
            }
          echo '</div>';
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
