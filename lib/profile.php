<?php
include('config.php'); 
session_start();
?>

<html>
<body>

<?php

	$userID = $_SESSION['ID'];
	
	
	if(isset($_POST['cancel'])) header("Location: " . $_SERVER['PHP_SELF']);
	else if(isset($_POST['back'])) header("Location: " . "welcome.php");
	else if(isset($_POST['confirm'])) {
	
		$valid = true;
		if( !isset($_POST['name']) || empty($_POST['name']) ) $valid = false;
		if( !isset($_POST['password']) || empty($_POST['password']) ) $valid = false;
		if( !isset($_POST['email']) || empty($_POST['email']) ) $valid = false;
		if( !isset($_POST['address']) || empty($_POST['address']) ) $valid = false;
		if( !isset($_POST['status']) || empty($_POST['status']) ) $valid = false;
		if( !isset($_POST['condoClass']) || empty($_POST['condoClass']) ) $valid = false;
	
		if($valid) {
			
			$name = $_POST['name']; $password = $_POST['password'];
			$email = $_POST['email']; $address = $_POST['address'];
			$status = $_POST['status']; $condoClass = $_POST['condoClass'];

			$sql = "UPDATE Users SET name='$name', password='$password', email='$email', primary_address='$address', status='$status', condoClassification='$condoClass' WHERE userID = $userID;";
			if (mysqli_query($db, $sql)) echo "profile successfully updated"."<br><br>";
			else echo "error: ".mysqli_error($db);
		
		} else echo "blank fields are not allowed<br><br>";
	}
	
	
	$user_query = mysqli_query($db, "SELECT * FROM Users WHERE userID = $userID");
	$user = mysqli_fetch_array($user_query);

	$name = $user['name']; $password = $user['password'];
	$email = $user['email']; $address = $user['primary_address'];
	$status = $user['status']; $condoClass = $user['condoClassification'];
	$admin = $user['administrator'];
	
	if($admin==1) $admin=yes;
	else $admin=no;
	
	if(isset($_POST['editProfile'])) {
	
		echo "Edit Profile<br><br>";
	
		echo '<form action="profile.php" method="post">
		<label for="name">Name:</label>
		<br>
		<input type="text" name="name" value="'.$name.'">
		<br>
		<label for="password:">password:</label>
		<br>
		<input type="text" name="password" value="'.$password.'">
		<br>
		<label for="email">email:</label>
		<br>
		<input type="text" id="email" name="email" value="'.$email.'">
		<br>
		<label for="address">address:</label>
		<br>
		<input type="text" id="address" name="address" value="'.$address.'">
		<br>
		<label for="status">status:</label>
		<br>
		<input type="text" id="status" name="status" value="'.$status.'">
		<br>
		<label for="condoClass">condo Classification:</label>
		<br>
		<input type="text" id="condoClass" name="condoClass" value="'.$condoClass.'">
		<br>
		<br>
		<input type="submit" name="confirm" value="confirm">
		<input type="submit" name="cancel" value="cancel">
</form>';
		
	} else {

		echo "Profile<br><br>";

		echo '<form action="profile.php" method="post">
		<label for="name">Name: '.$name.'</label>
		<br>
		<label for="password:">password: '.$password.'</label>
		<br>
		<label for="email">email: '.$email.'</label>
		<br>
		<label for="address">address: '.$address.'</label>
		<br>
		<label for="status">status: '.$status.'</label>
		<br>
		<label for="condoClass">condo Classification: '.$condoClass.'</label>
		<br>
		<label for="admin">administrator: '.$admin.'</label>
		<br>
		<br>
		<input type="submit" name="editProfile" value="edit">
		<input type="submit" name="back" value="back">
	</form>';
	
	}

?>

</body>
</html>

