<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>CS 4400 - Add Data Point</title>  
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="form">

    <form action = "addDataPoint.php" method = "get">
      <h1>ADD NEW DATA POINT </h1>
      POI location name 
      <select name="locationname">
          <?php
            $i = 0;
            $num = 10;
            while ($i < $num) {
              //put queries from database here
            
          ?>
          
              <option value= "<?php echo $i ?> IS THE NUMBER" >NUMBER <?php echo $i ?></option>
          
          

          <?php
          $i++;
            }
          ?>
      </select>


        <a href= "addDataPOI.php"> add new location</a>
      <br>

      <h4>DATE AND TIME HERE</h4>


        Data Type <select name="datatype">
          <option value="Mold">Mold - Hardcode</option>
          <option value="Air">Air - Hardcode</option>
          <?php
            $i = 1;
            $num = 3;
            while ($i < $num) {
              //put queries from database here
            
          ?>
          
              <option value= "nothardcode<?php echo $i ?>" >datatype <?php echo $i ?></option>
          
          

          <?php
          $i++;
            }
          ?>
        </select>
        <br><br>
      
      <input type="number" name="datavalue" placeholder="data value"/>
      
      <button>
        <a href="index.php">
          Log Out 
        </a>        
      </button>
      <button input type="submit">
        <a href="#">
          Submit
        </a>
      </button>
    </form>

  </div>
POI location: <?php echo $_GET["locationname"]; ?> <br>
Data Type: <?php echo $_GET["datatype"]; ?> <br> 
Data Value: <?php echo $_GET["datavalue"]; ?> <br>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>
</body>
