<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>CS 4400 - Home Page</title>  
  <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  <div class="form">
    
    <!--LOGIN FORM -->
    <form class="login-form" action = "index.php" method = "post">
      LOGIN
      <input type="text" name="username" placeholder="username"/>
      <input type="password" name="password" placeholder="password"/>

      <button href="#" input type="submit"> Login </a> </button>         
      <p class="message">Not registered? <a href="#">Register</a></p>
    </form>
    




    <!-- REGISTRATION FORM -->

    <form class="register-form" action = "index.php" method = "post">
      NEW USER REGISTRATION
      <input type="text" name="username" placeholder="username"/>
      <input type="text" name="email" placeholder="email address"/>
      <input type="password" name="password" placeholder="password"/>
      <input type="password" name="password2"placeholder="confirm password">
      <!-- dropdown  city officials-->

<!--    <form action="/action_page.php"> -->
        <select name="UserType">
          <option value="official">City Official</option>
          <option value="scientist">City Scientist</option>

        </select>


        TODO: If selected official, you must fill in city and state
        <br>

        <br><br>
        <select name="City">
          <option value="city1">Atlanta</option>
          <option value="city2">Atlanta 2</option>
          <option value="city3">Atlanta 3</option>
           <?php
            $i = 0;
            $num = 10;
            while ($i < $num) {
              //put queries from database here
            
          ?>
          
              <option value= "<?php echo $i ?> IS THE CITY" >CITY <?php echo $i ?></option>
          
          

          <?php
          $i++;
            }
          ?>
        </select>
        <br>
        <select name="State">
          <option value="state1">Georgia</option>
          <option value="state2">Georgia 2</option>
          <option value="state3">Georgia 3</option>
           <?php
            $j = 11;
            $num = 110;
            while ($j < $num) {
              //put queries from database here
            
          ?>
          
              <option value= "<?php echo $j ?> IS THE STATE" >STATE <?php echo $j ?></option>
          
          

          <?php
          $j+=10;
            }
          ?>
        </select>
        <input type="text" name="Title" placeholder="Title"/>

        
        <br><br>
      <!--</form>-->
      <button href="#" input type="submit">Create</button>
      <p class="message">Already registere
        d? <a href="#">Sign In</a></p>
    </form>


  </div>
LOGIN QUERY DATA <br>
    username: <?php echo $_POST["username"]; ?> <br>
    password: <?php echo $_POST["password"]; ?> <br>

<br>
REGISTER QUERY DATA <br>
username: <?php echo $_POST["username"]; ?> <br>
password: <?php echo $_POST["password1"]; ?> <br>
password confirmation: <?php echo $_POST["password2"]; ?> <br>
email: <?php echo $_POST["email"]; ?> <br>
user type: <?php echo $_POST["UserType"]; ?> <br>
city: <?php echo $_POST["City"]; ?> <br>
state: <?php echo $_POST["State"]; ?> <br>
title: <?php echo $_POST["Title"]; ?> <br>



<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>
</body>
