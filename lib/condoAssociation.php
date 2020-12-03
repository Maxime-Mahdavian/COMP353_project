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

<h1> Condo Association Info </h1>

<?php

	//print debug messages if there are any
	if($_SESSION['print_message']) {
		echo $_SESSION['message']."<br><br>";
		$_SESSION['message'] = "";
		$_SESSION['print_message'] = false;		//reset boolean tellin us theres a message to print
	}

	//get current users condo association ID
	$caID = $_SESSION['condoAssociationID'];

	//get and print budget and financial status
	$ca_query = mysqli_query($db,"SELECT budget,financialStatus FROM condoAssociations WHERE condoAssociationID=$caID");
	$ca = mysqli_fetch_array($ca_query);
	echo "budget: " . $ca['budget'] . "$<br>";
	echo "financial status: " . $ca['financialStatus'];
	echo "<br><br>";
	
	//handle admin delete button press
	if(isset($_POST['delete'])) {
		
		//parse username and building number
		$input = explode(",",$_POST['deleteNum']);
		$username = $input[0];
		$buildingID = $input[1];
		//remove from table
		$sql = "DELETE FROM percentShare WHERE buildingID=$buildingID AND percentShare.userID=(Select userID FROM Users WHERE name='$username')";
		if(mysqli_query($db,$sql)) $_SESSION['message'] = "record deleted";
		else $_SESSION['message'] = mysqli_error($db);
		//set session variable saying theres a message to print, then reload page
		$_SESSION['print_message'] = true;
		header("Location: " . $_SERVER['PHP_SELF']);
	
	} else if(isset($_POST['add_record'])) {	//handle create record
	
		//make sure all fields are filled in
		$valid = true;
		if(empty($_POST['username'])) $valid = false;
		else $username = $_POST['username'];
		if(empty($_POST['buildingNum'])) $valid = false;
		else $buildingNum = $_POST['buildingNum'];
		if(empty($_POST['percentShare'])) $valid = false;
		else $percentShare = $_POST['percentShare'];
		
		if($valid) {
			//make sure user exists
			$sql = "select * from Users WHERE name='$username'";
			$result = mysqli_query($db,$sql);
    	$row = mysqli_fetch_array($result);
    	if(mysqli_num_rows($result)==0) {
    		$_SESSION['message'] = "record not added, no user with that name exists";
    		$_SESSION['print_message'] = true;
				header("Location: " . $_SERVER['PHP_SELF']);
    	}
    	
			//make sure building exists
			$sql = "select * from buildings WHERE buildingID=$buildingNum";
			$result = mysqli_query($db,$sql);
    	$row = mysqli_fetch_array($result);
    	if(mysqli_num_rows($result)==0) {
    		$_SESSION['message'] = "record not added, no building with that number exists";
    		$_SESSION['print_message'] = true;
				header("Location: " . $_SERVER['PHP_SELF']);
    	}
		
			//insert into table
			$sql = "select userID from Users WHERE name='$username'";
			$result = mysqli_query($db,$sql);
			$user = mysqli_fetch_array($result);
			$sql = " insert into percentShare (userID,buildingID,percentShare) VALUES (".$user['userID'].",$buildingNum,$percentShare)";
			if(mysqli_query($db,$sql)) { $_SESSION['message'] = "record added"; }
			else { $_SESSION['message'] = mysqli_error($db); }
			
		} else { $_SESSION['message'] = "could not create record, please fill out all fields"; }
	
		$_SESSION['print_message'] = true;
		header("Location: " . $_SERVER['PHP_SELF']);
	
	}

	//get all users names in condoassociation with a percent share in any building
	$sql = "SELECT  name as username, buildingID, percentShare FROM Users,percentShare WHERE condoAssociationID=$caID AND percentShare.userID=Users.userID;";
	$user_query = mysqli_query($db,$sql);
	echo mysqli_error($db)."<br><br>";
	
	if($_SESSION['admin'] == 1) {
		echo '<form action="condoAssociation.php" method="post">';
    echo '	<label for="username">Username:</label>';
		echo '	<br>';
		echo '	<input type="text" name="username">';
		echo '	<br>';
    echo '	<label for="BuildingNum">Building Number:</label>';
		echo '	<br>';
		echo '	<input type="text" name="buildingNum">';
		echo '	<br>';
    echo '	<label for="percentShare">Percent Share:</label>';
		echo '	<br>';
		echo '	<input type="text" name="percentShare">';
		echo '	<br><br>';
		echo '	<input type="submit" name="add_record" value="add">';
		echo '	<br>';
		echo '</form>';
	}
	
	echo '<br><form action="welcome.php" method="post">';
	echo '	<input type="submit" name="back" value="back">';
	echo '</form><br>';
	
	//list buildings with users percent share
	$buildingIDs = array();
	$users = array();
	while($user = mysqli_fetch_array($user_query)) {
		//save user objects
		array_push($users, $user);
		//compile list of building numbers
		if(!in_array($user['buildingID'], $buildingIDs))
			array_push($buildingIDs, $user['buildingID']);
	}
	
	foreach($buildingIDs as $b) {
		
		//create a table for each building
		echo "<h1> Building $b </h1>";
		echo "<table><thead><tr>";
		if($_SESSION['admin'] == 1) //allow only admins to edit/delete 
			echo "<th></th><th></th>";
		echo "<th> Username </th>";
		echo "<th> Percent Share </th></tr>";
		
		foreach($users as $user) {
			if($user['buildingID']==$b) {
				echo "<tr>";
				if($_SESSION['admin'] == 1) { //allow only admins to edit/delete
					echo '<td><form action="edit_percentShare.php" method="post">';
					echo '<input type="hidden" name="editNum" value="'.$user['username'].",".$b.",".$user['percentShare'].'">';
					echo '<input type="submit" name="edit" value="edit">';
					echo '</form></td>';
					echo '<td><form action="condoAssociation.php" method="post">';
					echo '<input type="hidden" name="deleteNum" value="'.$user['username'].",".$b.'">';
					echo '<input type="submit" name="delete" value="delete">';
					echo '</form></td>';
				}
				echo "<td>".$user['username']."</td>";
				echo "<td>".$user['percentShare']."</td>";
				echo "</tr>";
			}
		}
		
		echo "</table><br>";
	
	}

?>






</body>
</html>
