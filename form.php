<?php include("connection.php"); ?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title> PHP STUDENTFORM Operation</title>
</head>

<body>
	<div class="container">
	<form action="#" method="POST">
		<div class="title">
			Registration Form
		</div>

		<div class="form">
			<div class="input_field">
				<label>First Name</label>
				<input type="text" class="input" name="fname" required>
			</div>

			<div class="input_field">
				<label>Last Name</label>
				<input type="text" class="input" name="lname" required>
			</div>

			<div class="input_field">
				<label>Password</label>
				<input type="password" class="input" name="password" required>
			</div>

			<div class="input_field">
				<label>Confirm Password</label>
				<input type="password" class="input" name="conpassword" required>
			</div>

			<div class="input_field">
				<label>Gender</label>
				<select class="selectbox" name="gender" required>
					<option value="Not Selected">Select</option>
					<option value="male">Male</option>
					<option value="female">Female</option>
				</select>
			</div>

			<div class="input_field">
				<label>Email Address</label>
				<input type="text" class="input" name="email" required>
			</div>

			<div class="input_field">
				<label>Phone Number</label>
				<input type="text" class="input" name="phone" required>
			</div>

			<div class="input_field">
				<label>Address</label>
				<textarea class="textarea" name="address" required></textarea>
			</div>

			<div class="input_field terms">
				<label class="check">
				<input type="checkbox" required>
				<span class="checkmark"></span>
			</label>
			<p>Agree to terms and conditions</p>
			</div>

			<div class="input_field">
				<button type="submit" name="register">Register</button>


		</div>

	</div>
	</form>
</body>

</html>

<?php
include("connection.php");

if (isset($_POST['register'])) {
    $fname   = $_POST['fname'];
    $lname   = $_POST['lname'];
    $pwd     = $_POST['password'];
    $cpwd    = $_POST['conpassword'];
    $gender  = $_POST['gender'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $address = $_POST['address'];



    // Optional: check if passwords match
    if ($pwd !== $cpwd) {
        echo "<p style='color:red;'>❌ Passwords do not match.</p>";
        exit();
    }

    $query = "INSERT INTO form (fname, lname, password, conpassword, gender, email, phone, address)
              VALUES ('$fname', '$lname', '$pwd', '$cpwd', '$gender', '$email', '$phone', '$address')";

    $data = mysqli_query($connection, $query);

    if ($data) {
        echo "<p style='color:green;'>✅ Data inserted successfully.</p>";
    } else {
        echo "<p style='color:red;'>❌ Insert failed: " . mysqli_error($connection) . "</p>";
    }
}
?>
