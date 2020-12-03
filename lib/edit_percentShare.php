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

<h1> Edit Percent Share </h1>

<?php

	//parse username and building number
	$input = explode(",",$_POST['editNum']);
	$username = $input[0];
	$buildingID = $input[1];
	$percentShare = $input[2];

	echo "User: ".$username."<br>";
	echo "building: ".$buildingID."<br><br>";
	
	if(isset($_POST['confirm'])) {
		
		if(empty($_POST['new_percentShare'])) {
			$_SESSION['message'] = "did not update, field was empty";
		}else {
			//update table
			$sql = "UPDATE percentShare SET percentShare=".$_POST['new_percentShare']." WHERE buildingID=$buildingID AND userID=(Select userID FROM Users WHERE name='$username')";
			if(mysqli_query($db,$sql)) $_SESSION['message'] = "record succesfully updated";
			else $_SESSION['message'] = mysqli_error($db);
		}
		
		//return to condoAssociation.php
		$_SESSION['print_message'] = true;
		header("Location: condoAssociation.php");
	
	} else if(isset($_POST['cancel'])) {
		
		header("Location: condoAssociation.php");
	
	}
	
?>

<form action="edit_percentShare.php" method="post">
	<label for="percentShare">Percent Share:</label>
	<br>
	<?php echo '<input type="text" name="new_percentShare" value="'.$percentShare.'">'; ?>
	<br><br>
	<?php echo '<input type="hidden" name="editNum" value="'.$_POST['editNum'].'">'; ?>
	<input type="submit" name="confirm" value="confirm">
	<input type="submit" name="cancel" value="cancel">
	<br>
</form>



</body>
</html>
