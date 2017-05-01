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
    <link href="style.css" rel="stylesheet">
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
          <a class="navbar-brand" href="#">Project name</a>
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


<!--view and edit weight brackets-->
<section id="Orders">
<br><br><br><br>

 <?php
  require('../db.php');

  $id = $_GET['id'];//@mysql_escape_string($_GET['id']);

  $sql = "SELECT a.*, b.* FROM OrderSlip a INNER JOIN OrderItem b ON a.OrderID = b.OrderID ".
         "WHERE a.OrderID='$id';";
  $stmt = $weightdb->query($sql);

  if (!$stmt)
   die("Database query failed.");

  $i = 0;  // Counter
  echo '<div class="container">';
  //printf("%10s &nbsp;&nbsp;&nbsp;&nbsp; %10s<br>",'Weight','Cost');

  $row = $stmt->fetch();

  if($row['StreetAddress'] == '')
  {
   echo "User does not exist";
  }
  else
  {
//print customer information
   printf("Name:%s<br>",$row['Name']);
   printf("Address:%s<br>%s, %s %s<br>", $row['StreetAddress'], $row['City'], $row['State'], $row['Zip']);
   printf("Date: %s <br>", $row[Date]);
   printf("Status: %s <br><br>", $row['Status']);

//print order information
   echo '<table width = 100% align="center">';
   printf("<tr><th>%s</th><th> %8s </th><th> %8s</th></tr>", 'Cost Per Item', 'Quantity', 'Product ID');
   printf("<tr align='center'><td>$%.02f</td><td> %8s </td><td> %8s</td></tr>", $row['CostPerItem'], $row['Quantity'], $row['ProductID']);

   while($row = $stmt->fetch())
    printf("<tr align='center'><td>$%.02f</td><td> %8s </td><td> %8s</td></tr>", $row['CostPerItem'], $row['Quantity'], $row['ProductID']);
   echo '</table>';
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
