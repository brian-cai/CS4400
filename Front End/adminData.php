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
  <title>Admin - Data Points</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<!-- SQL QUERIES-->
<?php
$sql = "SELECT location_name, date_time, type, data_value
FROM DATA_POINT
WHERE approved IS NULL;";

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
    <form action="adminData.php" method="post">

      <h1>Pending Data Points </h1>

      <table border="1" cellspacing="2" cellpadding="2">
      <tr>

            <th>Select </th>
            <th>POI Location </th>
            <th>Data Type </th>
            <th>Data Value </th>
            <th>Time and Date of Reading </th>
      </tr>

      <?php
        $i = 0;
        $num = $count;
        while ($i < $num) {
          //put queries from database here
         if($row=$result->fetch_assoc()) {
           //$testing = $row;
           $loc = $row['location_name'];
           $type = $row['type'];
           $value = $row['data_value'];
           $date = $row['date_time'];


}

      ?>

      <tr>
            <!--checkbox-->
            <td><input type="checkbox" name="samebox[]" value="<?php echo $i?>">   </td>
            <!--queries-->
            <td><?php echo $loc ?></td>
            <td><?php echo $type ?></td>
            <td><?php echo $value ?></td>
            <td><?php echo $date ?></td>


      </tr>

      <?php
      $i++;
        }
      ?>

     </table>
      <br><br>

      <br><br>

      <button>
        <a href="adminFunction.php">
          Back
        </a>
      </button>
      <button>
        <a href="#">
          Reject
        </a>
      </button>
      <button>
        <a href="#">
          Accept
        </a>
      </button>
<br><br>


      <button href="#" input type = "submit">
          Temporary Query Button
      </button>
    </form>
  </div>
checkboxes:

<?php
foreach ($_POST['samebox'] as $value) {

  $sql = "SELECT location_name, date_time, type, data_value
  FROM DATA_POINT
  WHERE approved IS NULL;";

  $count=$result->num_rows;
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

        $i = 0;
        $num = $count;
        while ($i < $num) {
          //put queries from database here
         if($row=$result->fetch_assoc()) {

             if ($i == $value) {
             echo $row['location_name'];
             echo "<br>";
             echo $row['type'];
             echo "<br>";
             echo $row['data_value'];
             echo "<br>";
             echo $row['date_time'];
             echo "<br>";
             echo "<br>";           
             }
           }
           $i++;
       }
    
   }
?>

<br>
<!--old loop-->
<?php
// foreach ($_POST['samebox'] as $value) {
//   echo $value;
//   echo "<br>";
// }
?>


<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>


</body>
