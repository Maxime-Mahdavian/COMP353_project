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

if(isset($_POST['deleteNum'])) {

	$deleteID = $_POST['deleteNum'];
	$sql = "DELETE FROM Users WHERE userID=$deleteID";
	
	if (mysqli_query($db, $sql)) echo "User deleted successfully<br>";
	else echo "Error deleting User: " . mysqli_error($db);
	
	//header("Location: " . $_SERVER['PHP_SELF']);

}

if( !isset($_POST['name']) || !isset($_POST['password']) ) {
	//do nothing
} else if(empty( $_POST['name']) || empty($_POST['password']) ) {
	echo "please enter both name and password";
	echo "<br><br>";
} else {
	$name = $_POST['name']; $password = $_POST['password'];
	$email = $_POST['email']; $address = $_POST['address'];
	
	if(isset($_POST['admin']) && $_POST['admin'] == 'on') $admin=1;
	else $admin=0;
	
	$sql = "INSERT INTO Users (name, password, email, primary_address, administrator) VALUES ('$name', '$password', '$email', '$address', '$admin')";
	if (mysqli_query($db, $sql)) echo "new user created"."<br><br>";
	else echo "failed to create new user<br><br>";

	//this is to prevent more accounts being made on page
	//refresh after successfully creating an account
	//works because it clears $_post
	header("Location: " . $_SERVER['PHP_SELF']);
	
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
		<label for="admin">administrator </label>
		<input type="checkbox" id="admin" name="admin">
		<br>
		<br>
		<input type="submit" value="submit">
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
  		echo '<td><form action="manage_users.php" method="post">';
  		echo '<input type="hidden" id="deleteNum" name="deleteNum" value="'.$user['userID'].'">';
  		echo '<input type="submit" name="delete" value="delete">';
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
