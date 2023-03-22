<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$name = $email = $phone = "";
$id = $update_id = 0;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['add'])) {
        
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }
        
    
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
           
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }
    
        if (empty($_POST["phone"])) {
            $phoneErr = "Phone number is required";
        } else {
            $phone = test_input($_POST["phone"]);
      
            if (!preg_match("/^[0-9]{10}$/",$phone)) {
                $phoneErr = "Invalid phone number format";
            }
        }

    
        if (empty($nameErr) && empty($emailErr) && empty($phoneErr)) {
            $sql = "INSERT INTO sellers (name, email, phone) VALUES ('$name', '$email', '$phone')";
            
            if (mysqli_query($conn, $sql)) {
                echo "Seller added successfully.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
</head>
<body>
	<h1>Add Seller</h1>
	<form method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
		<label for="name">Name:</label><br>
		<input type="text" id="name" name="name" required><br>
		<label for="email">Email:</label><br>
		<input type="email" id="email" name="email" required><br>
		<label for="phone">Phone:</label><br>
		<input type="tel" id="phone" name="phone" required><br><br>
		<input type="submit" name="add" value="Add Seller">
	</form>
	<hr>

	<h1>Remove Seller</h1>
	<form method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
		<label for="id">Seller ID:</label><br>
		<input type="number" id="id" name="id" required><br><br>
		<input type="submit" name="remove" value="Remove Seller">
	</form>
	<hr>

	<h1>Update Seller</h1>
	<form method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
		<label for="update_id">Seller ID:</label><br>
		<input type="number" id="update_id" name="update_id" required><br>
		<label for="name">Name:</label><br>
		<input type="text" id="name" name="name" required><br>
		<label for="email">Email:</label><br>
		<input type="email" id="email" name="email" required><br>
		<label for="phone">Phone:</label><br>
		<input type="tel" id="phone" name="phone" required><br><br>
		<input type="submit" name="update" value="Update Seller">
	</form>
</body>
</html>
