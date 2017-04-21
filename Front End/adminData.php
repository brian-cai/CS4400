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
$sql = "SELECT location_name, date_time, type, data_value FROM DATA_POINT
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

      <table id = "report_table" border="1" cellspacing="2" cellpadding="2">
      <tr>

            <th> Select </th>
            <th onclick="sortTable(1)">POI Location <b>&#x21D5;</b> </th>
            <th onclick="sortTable(2)">Data Type <b>&#x21D5;</b> </th>
            <th onclick="sortTable(3)">Data Value <b>&#x21D5;</b> </th>
            <th onclick="sortTable(4)">Time and Date of Reading <b>&#x21D5;</b> </th>
      </tr>

      <script>
      function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, temp1, temp2, switchcount = 0;
        table = document.getElementById("report_table");
        switching = true;
        //Set the sorting direction to ascending:
        dir = "asc";
        /*Make a loop that will continue until
        no switching has been done:*/
        while (switching) {
          //start by saying: no switching is done:
          switching = false;
          rows = table.getElementsByTagName("TR");
          /*Loop through all table rows (except the
          first, which contains table headers):*/
          for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /*check if the two rows should switch place,
            based on the direction, asc or desc:*/
            if (n == 1 || n == 2 ) {
              if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                  //if so, mark as a switch and break the loop:
                  shouldSwitch= true;
                  break;
                }
              } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                  //if so, mark as a switch and break the loop:
                  shouldSwitch= true;
                  break;
                }
              }
            } else if (n == 3) {

              if (isNaN(parseFloat(x.innerHTML))) {num1 = -1}
               else {num1 = parseFloat(x.innerHTML)}
              if (isNaN(parseFloat(y.innerHTML))) {num2 = -1}
               else {num2 = parseFloat(y.innerHTML)}

              if (dir == "asc") {
                if (num1 > num2) {
                  //if so, mark as a switch and break the loop:
                  shouldSwitch= true;
                  break;
                }
              } else if (dir == "desc") {
                if (num1 < num2) {
                  //if so, mark as a switch and break the loop:
                  shouldSwitch= true;
                  break;
                }
              }
            } else {
              temp1 = x.innerHTML;
              temp2 = y.innerHTML;
              var date1 = new Date(temp1);
              var date2 = new Date(temp2);

              if (dir == "asc") {
                if (date1 > date2) {
                  //if so, mark as a switch and break the loop:
                  shouldSwitch= true;
                  break;
                }
              } else if (dir == "desc") {
                if (date1 < date2) {
                  //if so, mark as a switch and break the loop:
                  shouldSwitch= true;
                  break;
                }
              }
            }
          }
          if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            //Each time a switch is done, increase this count by 1:
            switchcount ++;
          } else {
            /*If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again.*/
            if (switchcount == 0 && dir == "asc") {
              dir = "desc";
              switching = true;
            }
          }
        }
      }
      </script>

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
        <a href="adminData.php">
          Back
        </a>
      </button>
      <button href = "#" name="reject" input type="submit" value=2>
          Reject
      </button>


      <button href="#" name="accept" input type="submit" value=1>
          Accept
      </button>
    </form>
  </div>
reject value:
<?php 
echo $_POST['reject'];
echo "<br>"
?>
accept value:
<?php
echo $_POST['accept'];
echo "<br>"
?>
added together:
<?php
echo $_POST['accept'] + $_POST['reject'];
$accept = $_POST['accept'] + $_POST['reject'];
echo "<br>"
?>
accept value: 
<?php
echo $accept;
echo "<br>"
?>
checkboxes:
<?php $decrementer = 0?>

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

             if ($i == $value-$decrementer) {
               echo $row['location_name'];
               echo "<br>";
               echo $row['type'];
               echo "<br>";
               echo $row['data_value'];
               echo "<br>";
               echo $row['date_time'];
               echo "<br>";
               echo "<br>";


                         $name_input = $row['location_name']; 
                         $dt_input = $row['date_time'];
                                  if ($accept == 1) {
                                    $updatesql = "UPDATE DATA_POINT
                                        SET approved = 1
                                        WHERE (location_name = '$name_input' AND date_time = '$dt_input');";
                                      //$i--;
                                      //$value--;
                                      $decrementer++;
                                  } else if ($accept == 2) {
                                     $updatesql = "UPDATE DATA_POINT
                                        SET approved = 0
                                        WHERE (location_name = '$name_input' AND date_time = '$dt_input');";
                                      //$i--;
                                      //$value--;*/
                                       $decrementer++;
                                  }

                                  if ($accept > 0) {
                                    if (!$result2 = $mysqli->query($updatesql)) {
                                        // Oh no! The query failed.
                                        echo "Sorry, the website is experiencing problems.";

                                        // Again, do not do this on a public site, but we'll show you how
                                        // to get the error information
                                        echo "Error: Our query failed to execute and here is why: <br>";
                                        echo "Query: " . $result2 . "<br>";
                                        echo "Errno: " . $mysqli->errno . "<br>";
                                        echo "Error: " . $mysqli->error . "<br>";
                                        exit;
                                    }
                                  


                                    echo '<script type="text/javascript" language="javascript"> 
                                          window.open("adminData.php","_self"); 
                                          </script>'; 

                                }
                                  
              }

           }
           $i++;
       }

   }
?>

<br>

reject value:
<?php 
echo $_POST['reject'];
echo "<br>"
?>
accept value:
<?php
echo $_POST['accept'];
echo "<br>"
?>
added together:
<?php
echo $_POST['accept'] + $_POST['reject'];
$accept = $_POST['accept'] + $_POST['reject'];
echo "<br>"
?>
accept value: 
<?php
echo $accept;
echo "<br>"
?>


<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>


</body>
