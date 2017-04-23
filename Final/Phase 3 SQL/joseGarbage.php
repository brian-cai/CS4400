<!--CREATE VARIABLES FOR Registration-->

<?php
$usernameR = $_POST["usernameR"];
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];
$email = $_POST["email"];
$UserType = $_POST["UserType"];
$City = $_POST["City"];
$State = $_POST["State"];
$Title = $_POST["Title"];
?>

<!--LOGIC FOR Registration-->
<?php
$register1 = "insert into USER values('$email', '$usernameR', '$password1', '$UserType');";

if ($password1 != $password2) {
  ?>
  <script>alert("password and confirm passsword do not match");</script>
  <?php
} else {
  if (!$result = $mysqli->query($register1)) {
      echo "Sorry, the website is experiencing problems.";
      echo "Error: Our query failed to execute and here is why: <br>";
      echo "Query: " . $sql . "<br>";
      echo "Errno: " . $mysqli->errno . "<br>";
      echo "Error: " . $mysqli->error . "<br>";
      exit;
  }
}
?>

<!--CREATE VARIABLES FOR Registration-->

<?php
$usernameR = $_POST["usernameR"];
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];
$rEmail = $_POST["email"];
$UserType = $_POST["UserType"];
$rCity = $_POST["City"];
$rState = $_POST["State"];
$rTitle = $_POST["Title"];
?>

<!--LOGIC FOR Registration-->
<?php
$register1 = "insert into USER values('$rEmail', '$usernameR', '$password1', '$UserType');";

if ($password1 != $password2) {
  ?>
  <script>alert("password and confirm passsword do not match");</script>
  <?php
} else {
  if (!$result = $mysqli->query($register1)) {
      echo "Sorry, the website is experiencing problems.";
      echo "Error: Our query failed to execute and here is why: <br>";
      echo "Query: " . $register1 . "<br>";
      echo "Errno: " . $mysqli->errno . "<br>";
      echo "Error: " . $mysqli->error . "<br>";
      exit;
  }
}
?>


select * from POI where
    (null IS NULL OR location_name = null) and
    ('Atlanta' IS NULL OR city = 'Atlanta') and
    (null IS NULL OR state = null) and
    (null IS NULL OR zip = null) and
    (null IS NULL OR flagged = null) and
    (null IS NULL OR null IS NULL OR (null >= null AND null <= null))


    insert into USER values('test@test.com', 'test', 'test', 'city_official');
insert into CITY_OFFICIAL values('test', 'tester', 'null', 'Decatur', 'Georgia')


      if (!$result = $mysqli->query($register1)) {
        echo "Sorry, the website is experiencing problems.";
        echo "Error: Our query failed to execute and here is why: <br>";
        echo "Query: " . $register1 . "<br>";
        echo "Errno: " . $mysqli->errno . "<br>";
        $eCode = $mysqli->errno;
        echo "Error: " . $mysqli->error . "<br>";
        if ($eCode == 1062) {
          ?>
          <script>alert("Error:That username is already taken")</script>
          <?php
        } else if ($eCode == 1452) {
          ?>
          <script>alert("Error:Invalid Location")</script>
          <?php
        } else {
          exit;
        }
      } else









                <a href="cityOffPOIDetail.php?passed_location = <?php echo $loc ?>">
                  <?php echo $loc ?>
                </a>
              </button>