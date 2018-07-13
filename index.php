<?php
//<!--website, user, pass, db-->
$mysqli = new mysqli('sql9.freemysqlhosting.net', 'sql9247411', 'LevNSgPW8m', 'sql9247411');
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
      <input type="text" name="username" placeholder="username" pattern="[a-zA-Z][a-zA-Z0-9-_\.]*"/>
      <input type="password" name="password" placeholder="password" pattern="[a-zA-Z][a-zA-Z0-9-_\.]*"/>

      <button href="#" name="loginB" input type="submit" value=1> Login </a> </button>
      <p class="message">Not registered? <a href="register.php">Register</a></p>
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



<!--LOGIC FOR LOGGING IN-->
<?php
$lPressed = $_POST['loginB'];
if ($lPressed == 1) {
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
  } else if (($lPressed == 1)) {?> <script> alert("Login Failure: improper credentials"); </script> <?php }


  echo "Login Results: $count <br>";
  $result = $mysqli->query($sql);
  while($row=$result->fetch_assoc()) {
  printf("email: %s<br>type: %s", $row['email'], $row['user_type']);
  }
}
?>

</script>
</body>
