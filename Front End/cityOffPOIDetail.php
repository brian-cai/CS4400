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
$locationbutton = $_GET["locationbutton"];

?>

<body>
Location: <?php echo $locationbutton; ?> <br>

  <div class="form">

    <form action = "cityOffPOIDetail.php" method = "get">

      <h1> POI detail</h1>
      <!--hidden location-->
      <input id="checkBox" type="checkbox" style="display:none" value="<?php echo $locationbutton?>" name="locationbutton" checked>
      <!--visible-->
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
          
                    
              <option value= "<?php echo $type ?>" > <?php echo $type ?></option>


          <?php
          $i++;
            }
          ?>
      </select>
      <br>

      Data Value
      <input type="number" width="10px" name="lowenddata">
      to
      <input type="number" width="10px" name="highenddata">

      <br></br>
      Time and Date
      <input type="datetime-local" name="lowendtime">
      to
      <input type="datetime-local" name="highendtime">

      <br></br>

      
      <button href="#" input type="submit">        
          Apply Filter 

      </button>

      <button>
        <a href="cityOffPOIDetail.php">
          Reset Filter 
        </a>        
      </button>

<!--TABLE STARTS HERE -->
<?php
$sql = "select type, data_value, date_time from DATA_POINT where";
    //(location_input = location_name) and
    //(type_input IS NULL OR type = type_input) and
    //(lowVal_input IS NULL OR highVal_input IS NULL OR (data_value >= lowVal_input AND data_value <= highVal_input)) and
    //(lowDate_input IS NULL OR highDate_input IS NULL OR (date_time >= lowDate_input AND date_time <= highDate_input));


$poitype = $_GET["poitype"];
$lowdata = $_GET["lowenddata"]; 
$highdata = $_GET["highenddata"]; 
$lowtime = $_GET["lowendtime"]; 
$hightime = $_GET["highendtime"]; 
//$lowtime = date("Y-m-d\TH:i:s", strtotime($lowtime));
if (!empty($lowtime)) {
  $lowtime = date("Y-m-d H:i:s" , strtotime($lowtime));  
}
if (!empty($hightime)) {
  $hightime = date("Y-m-d H:i:s" , strtotime($hightime));

}

if ($locationbutton === "null") {
  $sql .= "(NULL IS NULL OR location_name = NULL) and ";
} else {  
  $sql .= "('$locationbutton' IS NULL OR location_name = '$locationbutton') and ";
}

if ($poitype === "null") {
  $sql .= "(NULL IS NULL OR type = NULL) and ";
} else {
  $sql .= "('$poitype' IS NULL OR type = '$poitype') and ";
}

if (empty($lowdata) and empty($highdata)) {
  $sql .= "(NULL IS NULL) and ";
} else if (empty($highdata)) {
  $sql .= "(data_value >= '$lowdata') and ";
} else if (empty($lowend)) {
  $sql .= "(data_value <= '$highdata') and ";
} else {
  $sql .= "(data_value >= '$lowdata' AND data_value <= '$highdata') and ";
}



if (empty($lowtime) and empty($hightime)) {
  $sql .= "(NULL IS NULL);";
} else if (empty($hightime)) {
  $sql .= "(date_time >= '$lowtime');";
} else if (empty($lowtime)) {
  $sql .= "(date_time <= '$hightime');";
} else {
  $sql .= "(date_time >= '$lowtime' AND date_time <= '$hightime');";
}



echo "<br><br>";
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
        <a href="cityOffView.php">
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
Type: <?php echo $_GET["poitype"]; ?> <br>
Data Range: <?php echo $_GET["lowenddata"]; ?> to <?php echo $_GET["highenddata"]; ?> <br> 
Time Range: <?php echo $_GET["lowendtime"]; ?> to <?php echo $_GET["highendtime"]; ?> <br> 
<?php
echo "<br>";
echo $lowtime;
echo "<br>";
echo $hightime;
echo "<br>";
echo "<br>";echo "<br>";
echo $sql;
echo "<br>";echo "<br>";
?>

Location: <?php echo $_GET["locationbutton"]; ?> <br>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>
</body>
