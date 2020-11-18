<?php
include('config.php'); 
session_start();
?>


<html>

<head>
<style>

table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

th, td {
  padding: 5px;
}

th {
  text-align: left;
}

</style>
</head>


<body>

Create user: 
<br>
<br>

<?php

if(isset($_POST['create_user'])) {	//handle create user button press
	
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
		
		//admins for this condo association can only add users to this condo association
		$condoAssociationID = $_SESSION['condoAssociationID'];
		
		
		$sql = "INSERT INTO Users (name, password, email, primary_address, administrator, status, condoAssociationID, condoClassification) VALUES ('$name', '$password', '$email', '$address', $admin, '$status', $condoAssociationID, '$condoClass')";
		if (mysqli_query($db, $sql)) echo "new user created"."<br><br>";
		else echo "failed to create new user<br><br>";
		
		//this is to prevent more accounts being made on page
		//refresh after successfully creating an account
		//works because it clears $_post
		header("Location: " . $_SERVER['PHP_SELF']);
	
	} else echo "please fill out all input fields to create a user<br><br>";
	
}



?>

<form action="manage_users.php" method="post">
		<label for="name">Name:</label>
		<br>
		<input type="text" name="name">
		<br>
		<label for="password:">password:</label>
		<br>
		<input type="text" id="password" name="password">
		<br>
		<label for="email">email:</label>
		<br>
		<input type="text" id="email" name="email">
		<br>
		<label for="address">address:</label>
		<br>
		<input type="text" id="address" name="address">
		<br>
		<label for="status">status:</label>
		<br>
		<input type="text" id="status" name="status">
		<br>
		<label for="condoClass">condo Classification:</label>
		<br>
		<input type="text" id="condoClass" name="condoClass">
		<br>
		<label for="admin">administrator </label>
		<input type="checkbox" id="admin" name="admin">
		<br>
		<br>
		<input type="submit" name="create_user" value="submit">
</form>

<form action="../admin_page.html" method="post">
		<input type="submit" name="back" value="return to admin page">
</form>
	
<table style = "width:100%">
	<tr>
		<th></th>
		<th> name </th>
		<th> password </th>
		<th> email </th>
		<th> address </th>
		<th> admin </th>
		<th> status </th>
		<th> condoClass </th>
	</tr>
	
	
<?php

  $user_query = mysqli_query($db, "SELECT * FROM Users");
  while($user = mysqli_fetch_array($user_query)){
  		echo "<tr>";
  		echo '<td><form action="edit_user.php" method="post">';
  		echo '<input type="hidden" id="editNum" name="editNum" value="'.$user['userID'].'">';
  		echo '<input type="submit" name="edit" value="edit">';
  		echo "</form></td>";
      echo "<td>".$user['name']."</td>";
      echo "<td>".$user['password']."</td>";
      echo "<td>".$user['email']."</td>";
      echo "<td>".$user['primary_address']."</td>";
      echo "<td>".$user['administrator']."</td>";
      echo "<td>".$user['status']."</td>";
      echo "<td>".$user['condoClassification']."</td>";
      echo "</tr>";
  }
	
?>

</body>
</html>
