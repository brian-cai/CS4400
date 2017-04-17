<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Admin - Data Points</title>  
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="form">
    <form action="adminCityOfficials.php" method="post">

      <h1>Pending Data Points </h1>

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
            <td>placeholder xd <?php echo $i ?><input type="checkbox" name="samebox[]" value="<?php echo $i ?>"   </td>
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
foreach($_POST['samebox'] as $checkbox) {
   // do something
  echo $checkbox;
}
?>     
<br>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>


</body>
