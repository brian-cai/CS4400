<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>City Official - View POI</title>  
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="form">

    <form action="cityOffView.php" method="get">

      <h1>View POIs</h1>

      POI Location Name
      <select name="location">
          <option value="location1">location1</option>
          <option value="location2">location2</option>
          <option value="location3">location3</option>
          <?php
            $i = 4;
            $num = 10;
            while ($i < $num) {
              //put queries from database here
            
          ?>
          
              <option value= "location<?php echo $i ?>" > location<?php echo $i ?></option>
          
          

          <?php
          $i++;
            }
          ?>
        
        </select>
      <br>
      
      City
      <select name="City">
          <option value="city1">city1</option>
          <option value="city2">city2</option>
          <option value="city3">city3</option>
          <?php
            $i = 4;
            $num = 10;
            while ($i < $num) {
              //put queries from database here
            
          ?>
          
              <option value= "city<?php echo $i ?>" > city<?php echo $i ?></option>
          
          

          <?php
          $i++;
            }
          ?>
        
        </select>
      <br>
      State
      <select name="State">
          <option value="state1">state1</option>
          <option value="state2">state2</option>
          <option value="state3">state3</option>
          <?php
            $i = 4;
            $num = 10;
            while ($i < $num) {
              //put queries from database here
            
          ?>
          
              <option value= "state<?php echo $i ?>" > state<?php echo $i ?></option>
          
          

          <?php
          $i++;
            }
          ?>
        
        </select>
      <br>

        <input type="number" name="zcode" placeholder="zip code"/>
      
      <br>
 <input type="checkbox" name="flagged"  value="checkifflagged"> Flagged <br>      
 insert date flagged option here
      <br>
      <button>
        <a href="#">
          Apply Filter 
        </a>        
      </button>

      <button>
        <a href="cityOffView.php">
          Reset Filter 
        </a>        
      </button>


      <br>

      <br>
      <button href="#" input type = "submit">
          Temporary Query Button
      </button>

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
      
 </form>
 <br>
      <button>
        <a href="cityOffFunction.php">
          Back 
        </a>        
      </button>
  <br>
<button> 
  <a href="cityOffPOIDetail.php">
      Need to make it linkable to details
  </a>
</button>
      
      
</div>

location <?php echo $_GET["location"]; ?> <br>
City: <?php echo $_GET["City"]; ?> <br> 
State: <?php echo $_GET["State"]; ?> <br>
Zip Code: <?php echo $_GET["zcode"]; ?> <br>

isflagged? :  <?php 
if (isset($_GET["flagged"])) {
   // do something
  echo "yes";
} else {
  echo "no";
}
?> 

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>
</body>
