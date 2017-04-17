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
            <th>Head1 </th>
            <th>Head2 </th>
      </tr>

      <?php
        $i = 0;
        $num = 10;
        while ($i < $num) {
          //put queries from database here
        
      ?>

      <tr>
            <td><?php echo $i ?></td>
            <td>placeholder xd <?php echo $i ?></td>
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
