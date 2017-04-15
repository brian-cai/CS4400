<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>CS 4400 - Add Data POI</title>  
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="form">
    <form action = "addDataPOI.php" method = "get">
      <h1>ADD A NEW LOCATION </h1>
      <input type="text" name="poiname" placeholder="poi location name"/>

      <select name="City">
          <option value="city1">city1</option>
          <option value="city2">city2</option>
          <option value="city3">city3</option>
        </select>
      <br>
      <select name="State">
          <option value="state1">state1</option>
          <option value="state2">state2</option>
          <option value="state3">state3</option>
        </select>
      <br>

        <input type="number" name="zcode" placeholder="zip code"/>
      
      <button input type="submit">        
          <submitted href="#" >Submit
        </submitted>
      </button>
    </form>

      <br>
      <button href="#">
        <a >
          Back 
        </a>        
      </button>

      <br>
      
  </div>

POI name <?php echo $_GET["poiname"]; ?> <br>
City: <?php echo $_GET["City"]; ?> <br> 
      State: <?php echo $_GET["State"]; ?> <br>
      Zip Code: <?php echo $_GET["zcode"]; ?> <br>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>
</body>
