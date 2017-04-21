<?php
$mysqli = new mysqli('academic-mysql.cc.gatech.edu', 'cs4400_37', 'g_N9Gblm', 'cs4400_37');
if ($mysqli->connect_errno) {
  echo "website error";
  exit;
}

?>
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
      <input type="text" name="usernameR" placeholder="username"/>
      <input type="email" name="email" placeholder="email address"/>
      <input type="password" name="password1" placeholder="password"/>
      <input type="password" name="password2" placeholder="confirm password">
      <!-- dropdown  city officials-->

<!--    <form action="/action_page.php"> -->
        <select name="UserType">
          <option value="city_official">City Official</option>
          <option value="city_scientist">City Scientist</option>
        </select>


        TODO: If selected official, you must fill in city and state
        <br>

        <br><br>
<!-- SQL QUERIES for city dropdown-->
<?php
$sql = "SELECT DISTINCT city FROM LOCATION ORDER BY city";

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

      City
      <select name="City">
          <?php
            $i = 0;
            $num = $count;
            while ($i < $num) {
              //put queries from database here
              if($row=$result->fetch_assoc()) {
                 $city = $row['city'];
              }
            ?>

              <option value= "$city" > <?php echo $city ?></option>



          <?php
          $i++;
            }
          ?>
        </select>
      <br>
<!-- SQL QUERIES for state dropdown-->
<?php
$sql = "SELECT DISTINCT state FROM LOCATION ORDER BY state";

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
      State
      <select name="State">
            <?php
            $i = 0;
            $num = $count;
            while ($i < $num) {
              //put queries from database here
              if($row=$result->fetch_assoc()) {
                 $state = $row['state'];
              }
            ?>

              <option value= "$state" > <?php echo $state ?></option>



          <?php
          $i++;
            }
          ?>
        </select>
      <br>

        </select>
        <input type="text" name="Title" placeholder="Title"/>


        <br><br>
      <!--</form>-->
      <button href="#" name = "register" input type="submit" value = 1><d>Create</d></button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>


  </div>
LOGIN QUERY DATA <br>
    username: <?php echo $_POST["username"]; ?> <br>
    password: <?php echo $_POST["password"]; ?> <br>
    <?php
    $username = $_POST["username"];
    $password = $_POST["password"];
    ?>

<br>
REGISTER QUERY DATA <br>
    username: <?php echo $_POST["usernameR"]; ?> <br>
    password: <?php echo $_POST["password1"]; ?> <br>
    password confirmation: <?php echo $_POST["password2"]; ?> <br>
    email: <?php echo $_POST["email"]; ?> <br>
    user type: <?php echo $_POST["UserType"]; ?> <br>
    city: <?php echo $_POST["City"]; ?> <br>
    state: <?php echo $_POST["State"]; ?> <br>
    title: <?php echo $_POST["Title"]; ?> <br>
<br>

<!-- // CREATE VARIABLES FOR Registration -->
<?php
$usernameR = $_POST["usernameR"];
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];
$rEmail = $_POST["email"];
$UserType = $_POST["UserType"];
$rCity = $_POST["City"];
$rState = $_POST["State"];
$rTitle = $_POST["Title"];

echo $_POST["UserType"];
?>


<!--LOGIC FOR Registration-->
<?php
$rPressed = $_POST['register'];
if ($rPressed == 1) {
  if ($password1 != $password2) {
    ?>
    <script>alert("password and confirm passsword do not match");</script>

    <?php } else {

    if ($UserType == 'city_scientist') {
      $register1 = "insert into USER values('$rEmail', '$usernameR', '$password1', '$UserType');";
      if (!$result = $mysqli->query($register1)) {
          echo "Sorry, the website is experiencing problems.";
          echo "Error: Our query failed to execute and here is why: <br>";
          echo "Query: " . $register1 . "<br>";
          echo "Errno: " . $mysqli->errno . "<br>";
          echo "Error: " . $mysqli->error . "<br>";
          exit;
      }
    }
  }
}
?>

<!--LOGIC FOR LOGGING IN-->
<?php
$sql = "select email,username,user_type from USER where( USER.username = '$username'  and USER.password = '$password');";


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

//prints out successful logins
$count=$result->num_rows;
$result = $mysqli->query($sql);
while($row=$result->fetch_assoc()) {
  $usertype = $row['user_type'];
}
echo $usertype;
echo "<br>";

//LOGIC FOR LANDING PAGE FOR USERNAME AND PASSWORD
if ($count == 1) {
  if ($usertype == "admin") {
        echo '<script type="text/javascript" language="javascript">
    window.open("adminFunction.php","_self");
    </script>';
  }
  else if ($usertype == "city_scientist") {
        echo '<script type="text/javascript" language="javascript">
    window.open("addDataPoint.php","_self");
    </script>';
  }
  else if ($usertype == "city_official") {
//  Logic for checking if a city official has been approved before loging them in
    $sql = "select username,approved from CITY_OFFICIAL where (username = '$username' and approved = 1);";
    if (!$result = $mysqli->query($sql)) {
        echo "Sorry, the website is experiencing problems.";
        echo "Error: Our query failed to execute and here is why: <br>";
        echo "Query: " . $sql . "<br>";
        echo "Errno: " . $mysqli->errno . "<br>";
        echo "Error: " . $mysqli->error . "<br>";
        exit;
    }
        $count=$result->num_rows;

    if ($count == 1) {
        echo '<script type="text/javascript" language="javascript">
    window.open("cityOffFunction.php","_self");
    </script>';
    } else { ?><script> alert("Login Failure: City Official has not been approved by Admin"); </script> <?php }
  }
} else {?> <script> alert("Login Failure: improper credentials"); </script> <?php }


echo "Login Results: $count <br>";
$result = $mysqli->query($sql);
while($row=$result->fetch_assoc()) {
printf("email: %s<br>type: %s", $row['email'], $row['user_type']);
}
?>


<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>
</body>
