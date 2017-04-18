  <!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>City Official - POI Report</title>  
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="form">
      <h1> POI Report</h1>
      <br><br>
      <table border="1" cellspacing="2" cellpadding="2">
      <tr>
            <th>POI Location</th>
            <th>City</th>
            <th>State</th>
            <th>Mold Min</th>
            <th>Mold Max</th>
            <th>Mold Avg</th>
            <th>AQ Min</th>
            <th>AQ Max</th>
            <th>AQ AVG</th>
            <th># of pts</th>
            <th>flagged</th>

      </tr>

      <?php
        $i = 0;
        $num = 10;
        while ($i < $num) {
          //put queries from database here
        
      ?>

      <tr>
            <td>loc<?php echo $i ?></td>
            <td>city <?php echo $i ?></td>
            <td>state <?php echo $i ?></td>
            <td>moldmin <?php echo $i ?></td>
            <td>moldmax<?php echo $i ?></td>
            <td>moldavg <?php echo $i ?></td>
            <td>aqmin<?php echo $i ?></td>
            <td>aqmax <?php echo $i ?></td>
            <td>aqavg<?php echo $i ?></td>
            <td>#ofpts <?php echo $i ?></td>
            <td>flagged<?php echo $i ?></td>
            
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
