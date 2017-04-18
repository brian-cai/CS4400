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
  <title>City Official - POI Details</title>  
  <link rel="stylesheet" href="css/style.css">
</head>
<?php 
$sql = "SELECT type from DATA_TYPE ORDER BY type;";

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
    <form action = "cityOffPOIDetail.php" method = "get">
      <h1> POI detail</h1>
      Type
      <select name="poitype" >
          <option value= "null" >---</option>
          <?php
            $i = 0;
            $num = $count;
            while ($i < $num) {
              //put queries from database here
              if($row=$result->fetch_assoc()) {
                 $type = $row['type'];
              }          
            ?>
          
              <option value= "$city" > <?php echo $type ?></option>
          
          

          <?php
          $i++;
            }
          ?>
      </select>
      <br>
      
      Data Value
      <input type="number" width="10px" name="lowend">
      to
      <input type="number" width="10px" name="highend">
      
      <br></br>
      Time and Date
      <input type="datetime-local" name="lowend">
      to
      <input type="datetime-local" name="highend">

      <br></br>

      
      <button input type="submit">        

        <submitted href="#">
          Apply Filter 
        </submitted>

        </a>        
      </button>

      <button>
        <a href="cityOffPOIDetail.php">
          Reset Filter 
        </a>        
      </button>

<!--TABLE STARTS HERE -->
<?php
$sql = "SELECT *
FROM DATA_POINT;";

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
            <th>Data Type </th>
            <th>Data Value</th>
            <th>Time and Date</th>
            </tr>

        <?php
        $i = 0;
        $num = $count;
        while ($i < $num) {
          //put queries from database here
         if($row=$result->fetch_assoc()) {
           $type = $row['type'];
           $value =  $row['data_value'];
           $date = $row['date_time']; 

           
}

      ?>

      <tr>
            <!--queries-->
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
      <button>
        <a href="cityOffFunction.php">
          Back 
        </a>        
      </button>
  

      <button>
        <a href="#">
      Flag
        </a>        
      </button>

    </form>

  </div>
POI Name: <?php echo $_GET["poitype"]; ?> <br>
Range: <?php echo $_GET["lowend"]; ?> to <?php echo $_GET["highend"]; ?> <br> 

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>
</body>
