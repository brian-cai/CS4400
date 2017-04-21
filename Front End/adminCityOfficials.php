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
  <title>Admin - City Officials</title>  
  <link rel="stylesheet" href="css/style.css">
</head>

<!-- SQL QUERIES-->
<?php 
$sql = "SELECT U.username, U.email, C.city, C.state, C.approved, C.title
FROM USER AS U
INNER JOIN CITY_OFFICIAL AS C ON U.username = C.username
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
    <form action="adminCityOfficials.php" method="post">

      <h1>Pending City Official Accounts</h1>
      <table border="1" cellspacing="2" cellpadding="2">
      <tr>
            <th>Select </th>
            <th>Username </th>
            <th>Email </th>
            <th>City </th>
            <th>State </th>
            <th>Title </th>
      </tr>

      <?php
        $i = 0;
        $num = $count;
        while ($i < $num) {
          //put queries from database here
         if($row=$result->fetch_assoc()) {
           $username = $row['username'];  
           $email = $row['email'];  
           $city = $row['city'];  
           $state = $row['state'];  
           $title = $row['title'];  
    // This gets you one row at a time, use a while if there are multiple rows
    // while($row = mysqli_fetch_assoc($query_run)){}
        }
      ?>

      
      <tr>
            <!--checkbox-->
            <td><input type="checkbox" name="samebox[]" value="<?php echo $i ?>"   </td>
            <!--queries-->
            <td><?php echo $username ?></td>
            <td><?php echo $email ?></td>
            <td><?php echo $city ?></td>
            <td><?php echo $state ?></td>
            <td><?php echo $title ?></td>
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
<!-- <?php 
//if (isset($_POST['check1'])) {
//if (true) {
  //echo "lol";
//}
foreach($_POST['samebox'] as $checkbox) {
   // do something
  echo $checkbox;
}
?> -->

<?php
foreach ($_POST['samebox'] as $value) {

  $sql = "SELECT U.username, U.email, C.city, C.state, C.approved, C.title
FROM USER AS U
INNER JOIN CITY_OFFICIAL AS C ON U.username = C.username
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
             echo $row['username'];
             echo "<br>";
             echo $row['email'];
             echo "<br>";
             echo $row['city'];
             echo "<br>";
             echo $row['state'];
             echo "<br>";
             echo $row['title'];
             echo "<br>";
             echo "<br>";          

             }
           }
           $i++;
       }
    
   }
?>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>
</body>
