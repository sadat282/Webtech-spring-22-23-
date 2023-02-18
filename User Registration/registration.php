<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
	<style>
	.error {color: #FF0000;}
	</style>
</head>
<body>
<div align="center">

<?php
// define variables and set to empty values
$nameErr = $emailErr = $passwordErr = $confirmPasswordErr = $genderErr = $dobErr = "";
$name = $email = $password = $confirmPassword = $gender = $dob = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
    
  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
    // check if password is at least 8 characters long and contains at least one uppercase letter, one lowercase letter, and one number
    if (strlen($password) < 8 || !preg_match("/[a-z]/", $password) || !preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password)) {
      $passwordErr = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number";
    }
  }
  
  if (empty($_POST["confirmPassword"])) {
    $confirmPasswordErr = "Please confirm password";
  } else {
    $confirmPassword = test_input($_POST["confirmPassword"]);
    // check if confirm password matches password
    if ($confirmPassword !== $password) {
      $confirmPasswordErr = "Passwords do not match";
    }
  }
  
  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
  
  if (empty($_POST["dob"])) {
    $dobErr = "Date of birth is required";
  } else {
    $dob = test_input($_POST["dob"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>User Registration</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Email: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Password: <input type="password" name="password" value="<?php echo $password;?>">
  <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
  Confirm Password: <input type="password" name="confirmPassword" value="<?php echo $confirmPassword;?>">
  <span class="error">* <?php echo $confirmPasswordErr;?></span>
  <br><br>
  Gender: <input type="radio" id="gender" name="gendr" value="Male">
  <label for="gender">Male</label>
  <input type="radio" id="gender" name="gendr" value="Female">
  <label for="gender">Female</label>
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  Date of Birth:<label for="birthday"></label>
  <input type="date" id="birthday" name="birthday">
 <span class="error">* <?php echo $dobErr;?></span>
  <br><br>
   <input type="submit" name="submit" value="Submit">  
</form>
</div>

</body>
</html>

