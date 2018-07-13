<?php
$mysqli = new mysqli('sql9.freemysqlhosting.net', 'sql9247411', 'LevNSgPW8m', 'sql9247411');
if ($mysqli->connect_errno) {
  echo "website error";
  exit;
}
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>City Official - POI Report</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<!-- SQL QUERIES-->
<?php
$sql = "SELECT *
FROM POI_report_view;";

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
      <h1> POI Report</h1>
      <br><br>
      <table id="report_table" border="1" cellspacing="2" cellpadding="2">
      <tr>
            <th onclick="sortTable(0)"> POI Location <b>---</b> </th>
            <th onclick="sortTable(1)"> City <b>---</b> </th>
            <th onclick="sortTable(2)"> State <b>---</b> </th>
            <th onclick="sortTable(3)"> Mold Min <b>---</b> </th>
            <th onclick="sortTable(4)"> Mold Avg <b>---</b> </th>
            <th onclick="sortTable(5)"> Mold Max <b>---</b> </th>
            <th onclick="sortTable(6)"> AQ Min <b>---</b> </th>
            <th onclick="sortTable(7)"> AQ AVG <b>---</b> </th>
            <th onclick="sortTable(8)"> AQ Max <b>---</b> </th>
            <th onclick="sortTable(9)"> num of pts <b>---</b> </th>
            <th onclick="sortTable(10)"> flagged <b>---</b> </th>

      </tr>

      <script>
      function sortTable(n) {
        var table, rows, headers, switching, i, x, y, j, k, num1, num2, q, index, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("report_table");
        switching = true;
        //Set the sorting direction to ascending:
        dir = "asc";
        /*Make a loop that will continue until
        no switching has been done:*/
        while (switching) {
          //start by saying: no switching is done:
          switching = false;
          // headers = table.getElementsByTagName("TH");
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
            if (n < 3 || n == 10) {
              if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                  //if so, mark as a switch and break the loop:
                  // j = rows[0].getElementsByTagName("b");
                  for (index = 0; index < 11; index++) {
                    q = rows[0].getElementsByTagName("b")[index];
                    q.innerHTML = "---";
                  }
                  j = rows[0].getElementsByTagName("b")[n];
                  j.innerHTML = '&#x25BC;';
                  shouldSwitch= true;
                  break;
                }
              } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                  //if so, mark as a switch and break the loop:
                  for (index = 0; index < 11; index++) {
                    q = rows[0].getElementsByTagName("b")[index];
                    q.innerHTML = "---";
                  }
                  k = rows[0].getElementsByTagName("b")[n];
                  k.innerHTML = '&#x25B2;';
                  shouldSwitch= true;
                  break;
                }
              }
            } else {

              if (isNaN(parseFloat(x.innerHTML))) {num1 = -1}
               else {num1 = parseFloat(x.innerHTML)}
              if (isNaN(parseFloat(y.innerHTML))) {num2 = -1}
               else {num2 = parseFloat(y.innerHTML)}

              if (dir == "asc") {
                if (num1 > num2) {
                  //if so, mark as a switch and break the loop:
                  // j = rows[0].getElementsByTagName("b");
                  for (index = 0; index < 11; index++) {
                    q = rows[0].getElementsByTagName("b")[index];
                    q.innerHTML = "---";
                  }
                  j = rows[0].getElementsByTagName("b")[n];
                  j.innerHTML = '&#x25BC;';
                  shouldSwitch= true;
                  break;
                }
              } else if (dir == "desc") {
                if (num1 < num2) {
                  //if so, mark as a switch and break the loop:
                  for (index = 0; index < 11; index++) {
                    q = rows[0].getElementsByTagName("b")[index];
                    q.innerHTML = "---";
                  }
                  k = rows[0].getElementsByTagName("b")[n];
                  k.innerHTML = '&#x25B2;';
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
            $POI_Location = $row['location_name'];
            $City = $row['city'];
            $State = $row['state'];
            $Mold_Min = $row['moldmin'];
            $Mold_Max = $row['moldmax'];
            $Mold_Avg = $row['moldavg'];
            $AQ_Min = $row['airmin'];
            $AQ_Max = $row['airmax'];
            $AQ_AVG = $row['airavg'];
            $num_of_pts = $row['number_points'];
            $flagged = $row['flagged'];
          }

      ?>

      <tr>
            <td><?php echo $POI_Location ?></td>
            <td><?php echo $City ?></td>
            <td><?php echo $State ?></td>
            <td><?php echo $Mold_Min ?></td>
            <td><?php echo $Mold_Avg ?></td>
            <td><?php echo $Mold_Max ?></td>
            <td><?php echo $AQ_Min ?></td>
            <td><?php echo $AQ_AVG ?></td>
            <td><?php echo $AQ_Max ?></td>
            <td><?php echo $num_of_pts ?></td>
            <td><?php echo (($flagged)? 'yes' : 'no'); ?></td>

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


    </form>

  </div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>
</body>
