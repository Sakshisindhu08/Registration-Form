<?php include("connection.php"); 

$id =  $_GET['id'];

$query="SELECT * FROM FORM where id= '$id'";
$data= mysqli_query($connection, $query);

$total= mysqli_num_rows($data);
$result= mysqli_fetch_assoc($data);


?>



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
			Update Student Details
		</div>

		<div class="form">
			<div class="input_field">
				<label>First Name</label>
				<input type="text"  value=" <?php echo $result['fname']; ?>" class="input" name="fname" required>
			</div>

			<div class="input_field">
				<label>Last Name</label>
				<input type="text" value=" <?php echo $result['lname']; ?>" class="input" name="lname" required>
			</div>

			<div class="input_field">
				<label>Password</label>
				<input type="password" value=" <?php echo $result['password']; ?>" class="input" name="password" required>
			</div>

			<div class="input_field">
				<label>Confirm Password</label>
				<input type="password" value=" <?php echo $result['conpassword']; ?>" class="input" name="conpassword" required>
			</div>

			<div class="input_field">
				<label>Gender</label>
				<select class="selectbox" name="gender" required>
					<option value="Not Selected">Select</option>

					<option value="male"
					  <?php if($result['gender'] == 'male') echo "selected"; ?>


					   	   
					>
					Male</option>
					<option value="female"
					 

					   	<?php if($result['gender'] == 'female') echo "selected"; ?>
   

					>
				Female</option>
				</select>
			</div>

			<div class="input_field">
				<label>Email Address</label>
				<input type="text" value=" <?php echo $result['email']; ?>" class="input" name="email" required>
			</div>

			<div class="input_field">
				<label>Phone Number</label>
				<input type="text" value=" <?php echo $result['phone']; ?>" class="input" name="phone" required>
			</div>

			<div class="input_field">
				<label>Address</label>
				<textarea class="textarea" name="address" required><?php echo $result['address']; ?></textarea>
			</div>

            <div class="input_field terms">
            <label class="check">
            <input type="checkbox"> <!-- ✅ Removed 'required' -->
            <span class="checkmark"></span>
            </label>
            <p>Agree to terms and conditions</p>
            </div>


			<div class="input_field">
				<button type="submit" name="update" >Update Details</button>


		</div>

	</div>
	</form>
	<!-- jQuery (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- AJAX script -->
<script>
$(document).ready(function () {
    $("#updateForm").on("submit", function (e) {
        e.preventDefault(); // Prevent normal form submission

        $.ajax({
            type: "POST",
            url: "update_handler.php", // your PHP handler
            data: $(this).serialize(),
            success: function (response) {
                alert(response); // or use a div to show response message

                // Optional: refresh part of the page or redirect if needed
                if (response.includes("✅")) {
                    // Example: location.href = "display.php";
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: ", status, error);
                alert("❌ Failed to update data.");
            }
        });
    });
});
</script>

</body>

</html>

<?php
include("connection.php");

if (isset($_POST['update'])) {
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

     $query = "UPDATE form SET 
    fname='$fname',
    lname='$lname',
    password='$pwd',
    conpassword='$cpwd',
    gender='$gender',
    email='$email',
    phone='$phone',
    address='$address' 
    WHERE id='$id'";


    $data = mysqli_query($connection, $query);

    if ($data) {
        echo " <script>alert('Record Updated')</script>";
        ?>
        <meta http-equiv="refresh" content="0; url=http://localhost:8080/studentform/display.php">

        <?php 

    } else {
        echo "<p style='color:red;'>❌ Update failed: " . mysqli_error($connection) . "</p>";
    }
}
?>
