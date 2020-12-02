<?php
include('config.php'); 
session_start();
?>


<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>
<body>

<br>
<br>

<?php
	
	//save condo owner id so it can be reused on next form submission
	$condoID = $_POST['condoNum'];
	echo "condo Number: $condoID <br>";		//display condo number for user

	if(isset($_POST['userSelected'])) { //handle set owner button press
		
		$userID = $_POST['userID'];	//get user id from post
		//update sql tables
		$sql = "UPDATE condos SET ownerID=$userID WHERE condoID=$condoID";
		if(mysqli_query($db, $sql)) $_SESSION['message'] ="condo owner has been set";
		else $_SESSION['message'] = mysqli_error($db);
		
		//set session variable saying theres a message to print, then reload page
		$_SESSION['print_message'] = true;
		header("Location: manage_condos.php");
		
	}
	
?>

<br>
<br>

<form action="manage_condos.php" method="post">
	<input type="submit" name="back" value="back">
</form>

<br>

<table class="ui selectable inverted table">
	<thead>
    <tr>
        <th></th>
        <th> Name </th>
        <th> Address </th>
        <th> Admin </th>
		</tr>
	</thead
<?php

	//list all users from database in an html table
  $user_query = mysqli_query($db, "SELECT * FROM Users");
  while($user = mysqli_fetch_array($user_query)){
  		echo "<tr>";
  		echo '<td><form action="assign_condo_owner.php" method="post">';
  		echo '<input type="hidden" name="userID" value="'.$user['userID'].'">';	//post userID so we know which one was selected
  		echo '<input type="hidden" name="condoNum" value="'.$condoID.'">';			//re-post condoID
  		echo '<input type="submit" name="userSelected" value="Assign">';
  		echo "</form></td>";
      echo "<td>".$user['name']."</td>";
      echo "<td>".$user['primary_address']."</td>";
      echo "<td>".$user['administrator']."</td>";
      echo "</tr>";
  }	
  
?>
</table>



</body>
</html>
