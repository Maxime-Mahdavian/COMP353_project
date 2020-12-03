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

<?php

	//print debug messages if there are any
	if($_SESSION['print_message']) {
			echo $_SESSION['message']."<br><br>";
			$_SESSION['print_message'] = false;		//reset boolean tellin us theres a message to print
	}

	if(isset($_POST['create_fee'])) {	//handle create group button press
		
		//get all condos this user is the owner of
		$condoFound = false;
		$condo_query = mysqli_query($db, "SELECT condoID FROM condos WHERE ownerID=".$_SESSION['ID'].";");
  	while($condo = mysqli_fetch_array($condo_query)) { //iterate through list
  		if(isset($_POST['condo'.$condo['condoID']])) {
  			$condoID = $condo['condoID'];	//save condoID
  			$condoFound = true;
  			break;
  		}
  	}
  	
  	if(!$condoFound) $_SESSION['message'] = "please select a condo";	//check that a condo was selected
  	else if(empty($_POST['amount'])) {	//check that we have an amount
			$_SESSION['message'] = "please enter an amount";
			$_SESSION['print_message'] = true;
			header("Location: " . $_SERVER['PHP_SELF']);
		} else {
			$sql = "INSERT INTO fees(condoID, amountPaid) VALUES ($condoID, ".$_POST['amount'].")";
			if( mysqli_query($db, $sql) ) $_SESSION['message'] = "fee payment has been recorded";
			else $_SESSION['message'] = mysqli_error($db);
			$_SESSION['message'] = "fee payment has been recorded";
		}
		
		//redirect to main page
		$_SESSION['print_message'] = true;
		header("Location: " . $_SERVER['PHP_SELF']);
	
	} if(isset($_POST['cancel'])) {	//handle cancel button press
		//redirect to main page
		header("Location: welcome.php");
	}

?>

<form action="pay_fee.php" method="post">
		
		<table style = "width:100%">
			<tr>
				<th></th>
				<th> condo Number </th>
			</tr>
		
			<?php
			  $condo_query = mysqli_query($db, "SELECT condoID FROM condos WHERE ownerID=".$_SESSION['ID'].";");
  			while($condo = mysqli_fetch_array($condo_query)){
  				echo '<td><input type="checkbox" name="condo'.$condo['condoID'].'"></td>';
    	  	echo "<td>".$condo['condoID']."</td>";
    	  	echo "</tr>";
  			}
			?>
		</table>
		<br>
		<label for="amount">amount</label>
		<br>
		<input type="text" name="amount">
		<br>
		<br>
		<input type="submit" name="create_fee" value="confirm">
		<input type="submit" name="cancel" value="cancel">
</form>



</body>
</html>
