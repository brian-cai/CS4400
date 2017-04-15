<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>City Official - View POI</title>  
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="form">
      <h1>Views POIs</h1>
      POI Location Name
      <select name="location">
          <option value="location1">location1</option>
          <option value="location2">location2</option>
          <option value="location3">location3</option>
        </select>
      <br>
      
      City
      <select name="City">
          <option value="city1">city1</option>
          <option value="city2">city2</option>
          <option value="city3">city3</option>
        </select>
      <br>
      State
      <select name="State">
          <option value="state1">state1</option>
          <option value="state2">state2</option>
          <option value="state3">state3</option>
        </select>
      <br>

        <input type="text" placeholder="zip code"/>
      
      <br>
 <input type="checkbox" name="flagged"  value="checkifflagged">Flagged <br>      
 insert date flagged option here
<br>
      <button>
        <a href="#">
          Apply Filter 
        </a>        
      </button>

      <button>
        <a href="#">
          Reset Filter 
        </a>        
      </button>


      <br><br>
      INSERT RESULTING QUERY HERE

      <br><br>
      <button>
        <a href="#">
          Back 
        </a>        
      </button>

    </form>

  </div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>
</body>
