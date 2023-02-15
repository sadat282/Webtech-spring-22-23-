<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
</head>
<body>
	<div align="center">

		<?php
			if ($_SERVER['REQUEST_METHOD'] === "POST") {	
				
				$flag = true;

				$username = sanitize($_POST['username']);
				$password = sanitize($_POST['password']);
				
				if (empty($username)) {	
					echo "Please fill up the username properly";
					echo "<br>";
					$flag = false;
				}
				if (empty($password)) {
					echo "Please fill up the password properly";	
					$flag = false;
				}
				if ($flag === true) {
					echo "Successfully Logged In";
				}
			}

			function sanitize($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
		?>
	</div>

</body>
</html>
