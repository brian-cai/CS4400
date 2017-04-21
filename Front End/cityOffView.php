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
  <title>City Official - View POI</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="form">
<!-- SQL QUERIES for location dropdown-->
<?php
$sql = "SELECT location_name FROM POI ORDER BY location_name";

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

    <form action="cityOffView.php" method="get">

      <h1>View POIs</h1>

      POI Location Name
      <select name="location">
          <option value= "null" >---</option>

          <?php
            $i = 0;
            $num = $count;
            while ($i < $num) {
              //put queries from database here
              if($row=$result->fetch_assoc()) {
                 $loc = $row['location_name'];
              }
            ?>

              <option value= "$loc" > <?php echo $loc ?></option>



          <?php
          $i++;
            }
          ?>
        </select>
        </select>
      <br>
<!-- SQL QUERIES for state dropdown-->
<?php
$sql = "SELECT DISTINCT city FROM LOCATION ORDER BY city";

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

      City
      <select name="City">
          <option value= "null" >---</option>

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
      <br>
<!-- SQL QUERIES for state dropdown-->
<?php
$sql = "SELECT DISTINCT state FROM LOCATION ORDER BY state";

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
      State
      <select name="State">
          <option value= "null" >---</option>

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

      <br>
 <input type="checkbox" name="flagged"  value="checkifflagged"> Flagged <br>
      <br></br>
      Time and Date
      <input type="date" name="lowend">
      to
      <input type="date" name="highend">

      <br>
      <button>
        <a href="#">
          Apply Filter
        </a>
      </button>

      <button>
        <a href="cityOffView.php">
          Reset Filter
        </a>
      </button>


      <br>

      <br>
      <button href="#" input type = "submit">
          Temporary Query Button
      </button>


<!--TABLE STARTS HERE -->
<?php
$sql = "SELECT *
FROM POI;";

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

      <br><br>
      <table border="1" cellspacing="2" cellpadding="2">
      <tr>
            <th>POI Location Name </th>
            <th>City </th>
            <th>State </th>
            <th>Zip code </th>
            <th>Flagged? </th>
            <th>Date Flagged </th>
      </tr>

      <?php
        $i = 0;
        $num = $count;
        while ($i < $num) {
          //put queries from database here
         if($row=$result->fetch_assoc()) {
           $loc = $row['location_name'];
           $city = $row['city'];
           $state =  $row['state'];
           $zip =  $row['zip'];
           $flagged =  $row['flagged'];
           $date_flagged =  $row['date_flagged'];

}

      ?>

      <tr>
            <!--queries-->
            <td><?php echo $loc ?></td>
            <td><?php echo $city ?></td>
            <td><?php echo $state ?></td>
            <td><?php echo $zip ?></td>
            <td><?php echo (($flagged)? 'yes' : 'no'); ?></td>
            <td><?php echo $date_flagged ?></td>


      </tr>

      <?php
      $i++;
        }
      ?>
    </table>

 </form>
 <br>
      <button>
        <a href="cityOffFunction.php">
          Back
        </a>
      </button>
  <br>
<button>
  <a href="cityOffPOIDetail.php">
      Need to make it linkable to details
  </a>
</button>


</div>

location <?php echo $_GET["location"]; ?> <br>
City: <?php echo $_GET["City"]; ?> <br>
State: <?php echo $_GET["State"]; ?> <br>
Zip Code: <?php echo $_GET["zcode"]; ?> <br>
low: <?php echo $_GET["lowend"]; ?> <br>
high: <?php echo $_GET["highend"]; ?> <br>

isflagged? :  <?php
if (isset($_GET["flagged"])) {
   // do something
  echo "yes";
} else {
  echo "no";
}
?>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>
</body>
