  <!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>City Official - POI Details</title>  
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="form">
    <form action = "cityOffPOIDetail.php" method = "get">
      <h1> POI detail</h1>
      Type
      <select name="poitype" >
         <option value="Mold">Mold - Hardcode</option>
          <option value="Air">Air - Hardcode</option>
          <?php
            $i = 1;
            $num = 3;
            while ($i < $num) {
              //put queries from database here
            
          ?>
          
              <option value= "nothardcode<?php echo $i ?>" >poitype <?php echo $i ?></option>
          
          

          <?php
          $i++;
            }
          ?>
      </select>
      <br>
      
      Data Value
      <input type="number" width="10%" name="lowend">
      to
      <input type="number" width="10px" name="highend">
      
      <br></br>
      time and date here

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


      <br><br>
      INSERT RESULTING QUERY HERE

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
