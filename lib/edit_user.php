<?php
	include('config.php'); 
	session_start();
?>

<html>
<body>

Edit User:
<br>
<br>

<?php

	$editID = $_POST['editNum'];

	if(isset($_POST['cancel'])) {
		
		header("Location: " . "manage_users.php");
		
	} else if(isset($_POST['confirm'])) {
	
	
	
		//validate form
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
			
			if(isset($_POST['admin']) && $_POST['admin'] == 'on') $admin=1;
			else $admin=0;

			$sql = "UPDATE Users SET name='$name', password='$password', email='$email', primary_address='$address', administrator=$admin, status='$status', condoClassification='$condoClass' WHERE userID = $editID;";
			if (mysqli_query($db, $sql)) echo "user successfully updated"."<br><br>";
			else echo "error: ".mysqli_error($db);
			
			header("Location: " . "manage_users.php");
		
		} else echo "please fill out all input fields to create a user<br><br>";
	
	} else if(isset($_POST['delete'])) {
	
		$deleteID = $_POST['editNum'];
		$sql = "DELETE FROM Users WHERE userID=$deleteID";
	
		if (mysqli_query($db, $sql)) echo "User deleted successfully<br>";
		else echo "Error deleting User: " . mysqli_error($db);
		
		header("Location: " . "manage_users.php");
	
	}


	$user_query = mysqli_query($db, "SELECT * FROM Users WHERE userID = $editID");
	$user = mysqli_fetch_array($user_query);

	$name = $user['name']; $password = $user['password'];
	$email = $user['email']; $address = $user['primary_address'];
	$status = $user['status']; $condoClass = $user['condoClassification'];
	if($user['administrator']==1) $admin = "checked";
	else $admin = "";
	
	echo $admin;

echo '<form action="edit_user.php" method="post">
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
		<label for="admin">administrator </label>
		<input type="checkbox" id="admin" name="admin" '.$admin.'>
		<br>
		<br>
		<input type="hidden" id="editNum" name="editNum" value="'.$editID.'">
		<input type="submit" name="confirm" value="confirm">  
		<input type="submit" name="delete" value="delete">  
		<input type="submit" name="cancel" value="cancel">
</form>'

?>

</html>
</body>
