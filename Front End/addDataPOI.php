<?php
$mysqli = new mysqli('academic-mysql.cc.gatech.edu', 'cs4400_37', 'g_N9Gblm', 'cs4400_37');
if ($mysqli->connect_errno) {
  echo "website error";
  exit;
}
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>CS 4400 - Add Data POI</title>  
  <link rel="stylesheet" href="css/style.css">
</head>

<!-- SQL QUERIES for city dropdown-->
<?php 
$sql = "select city from LOCATION;";

if (!$result = $mysqli->query($sql)) {
    // Oh no! The query failed. 
    echo "Sorry, the website is experiencing problems.";

    // Again, do not do this on a public site, but we'll show you how
    // to get the error information
    echo "Error: Our query failed to execute and here is why: <br>";
    echo "Query: " . $sql . "<br>";
    echo "Errno: " . $mysqli->errno . "<br>";
    echo "Error: " . $mysqli->error . "<br>";
    exit;
}
$count=$result->num_rows;

?>

<body>
  <div class="form">
    <form action = "addDataPOI.php" method = "get">
      <h1>ADD A NEW LOCATION </h1>
      <input type="text" name="poiname" placeholder="poi location name"/>

      <select name="City">
          <?php
            $i = 0;
            $num = $count;
            while ($i < $num) {
              //put queries from database here
              if($row=$result->fetch_assoc()) {
                 $city = $row['city'];
              }          
            ?>
          
              <option value= "$city" > <?php echo $city ?></option>
          
          

          <?php
          $i++;
            }
          ?>
        </select>
<?php 
//query for states
$sql = "select state from LOCATION;";

if (!$result = $mysqli->query($sql)) {
    // Oh no! The query failed. 
    echo "Sorry, the website is experiencing problems.";

    // Again, do not do this on a public site, but we'll show you how
    // to get the error information
    echo "Error: Our query failed to execute and here is why: <br>";
    echo "Query: " . $sql . "<br>";
    echo "Errno: " . $mysqli->errno . "<br>";
    echo "Error: " . $mysqli->error . "<br>";
    exit;
}
$count=$result->num_rows;

?>

      <br>
      <select name="State">
          <?php
            $i = 0;
            $num = $count;
            while ($i < $num) {
              //put queries from database here
              if($row=$result->fetch_assoc()) {
                 $state = $row['state'];
              }          
            ?>
          
              <option value= "$state" > <?php echo $state ?></option>
          
          

          <?php
          $i++;
            }
          ?>
        </select>
      <br>

        <input type="number" name="zcode" placeholder="zip code"/>
      
      <button input type="submit">        
          <a href="#" >Submit
        </a>
      </button>
    </form>

      <br>
      <button>
        <a href="addDataPoint.php">
          Back 
        </a>        
      </button>

      <br>
      
  </div>

POI name <?php echo $_GET["poiname"]; ?> <br>
City: <?php echo $_GET["City"]; ?> <br> 
      State: <?php echo $_GET["State"]; ?> <br>
      Zip Code: <?php echo $_GET["zcode"]; ?> <br>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>
</body>
