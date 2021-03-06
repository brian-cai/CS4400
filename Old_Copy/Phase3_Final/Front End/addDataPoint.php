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
  <title>CS 4400 - Add Data Point</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<!-- SQL QUERIES for location dropdown-->
<?php
$sql = "select location_name from POI;";

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

    <form action = "addDataPoint.php" method = "post">
      <h1>ADD NEW DATA POINT </h1>
      POI location name
      <select name="locationname">
          <?php
            $i = 0;
            $num = $count;
            while ($i < $num) {
              //put queries from database here
              if($row=$result->fetch_assoc()) {
                 $loc = $row['location_name'];
              }
            ?>

              <option value= "<?php echo $loc ?>"> <?php echo $loc ?></option>



          <?php
          $i++;
            }
          ?>
        </select>
      </select>


        <a href= "addDataPOI.php"> add new location</a>
      <br>

      <br><br>
      Date and Time: <input type="datetime-local" name="time">
      <br><br>
<!-- SQL QUERIES for data type dropdown-->
<?php
$sql = "select type from DATA_TYPE;";

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

        Data Type <select name="datatype">
          <?php
            $i = 0;
            $num = $count;
            while ($i < $num) {
              //put queries from database here
              if($row=$result->fetch_assoc()) {
                 $type = $row['type'];
              }
            ?>

              <option value= "<?php echo $type ?>" > <?php echo $type ?></option>



          <?php
          $i++;
            }
          ?>
        </select>
        <br><br>
      <input type="number" name="datavalue" placeholder="data value"/>

      <button>
        <a href="index.php">
          Log Out
        </a>
      </button>
      <button href="#" input type="submit">

          Submit

      </button>
    </form>

  </div>
POI location: <?php echo $_POST["locationname"]; ?> <br>
Data Type: <?php echo $_POST["datatype"]; ?> <br>
Time: <?php echo $_POST["time"]; ?> <br>
Data Value: <?php echo $_POST["datavalue"]; ?> <br>

<?php $locc = $_POST["locationname"]; ?>
<?php $datatype = $_POST["datatype"]; ?>
<?php $time = $_POST["time"]; ?>
<?php $value = $_POST["datavalue"]; ?>
Query happens below
<?php
$sql = "INSERT INTO DATA_POINT VALUES( '$locc', '$time', '$datatype', '$value', NULL );";
echo "$sql";

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
?>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>
</body>
