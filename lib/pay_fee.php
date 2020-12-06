<?php
include('config.php'); 
session_start();
?>

<html>

<head>
    <title>Pay Fee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>

<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br><br>
<button style="margin-left:1320px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='welcome.php';">
    <i class="left arrow icon"></i>
    Back to Main Page
</button>
<a style="margin-left:30px; font-size: 40px; color:black;" class="item">
    Pay Fee <i class="file alternate icon"></i>
</a>
<br>
<br>
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
			//header("Location: " . $_SERVER['PHP_SELF']);

			$URL="pay_fee.php";
            		echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
            		echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
		} else {
			$sql = "INSERT INTO fees(payee, condoID, amountPaid) VALUES (".$_SESSION['ID'].", $condoID, ".$_POST['amount'].")";
			if( mysqli_query($db, $sql) ) { $_SESSION['message'] = "fee payment has been recorded"; }
			else { $_SESSION['message'] = mysqli_error($db); }
		}
		
		//redirect to main page
		$_SESSION['print_message'] = true;
		//header("Location: " . $_SERVER['PHP_SELF']);
		
		$URL="pay_fee.php";
            	echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
            	echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
	
	} if(isset($_POST['cancel'])) {	//handle cancel button press
		//redirect to main page
		//header("Location: welcome.php");
		
		$URL="welcome.php";
            	echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
            	echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
	}

?>

<form action="pay_fee.php" method="post">
    <div style="margin:30px;" class="ui two column middle aligned relaxed grid basic segment">
        <div class="column">
            <div style=" background-color: #c9d3d8;" class="ui form segment AVAST_PAM_loginform">
                <div class="field">
                    <label style="font-size: 20px;">Select a condo Number:</label>
                    <table>
                        <tr>
                            <?php
                            $condo_query = mysqli_query($db, "SELECT condoID FROM condos WHERE ownerID=".$_SESSION['ID'].";");
                            while($condo = mysqli_fetch_array($condo_query)){
                                echo '<td><input class="checkbox" type="checkbox" name="condo'.$condo['condoID'].'"> '.$condo['condoID'].'</td>';
                                echo "</tr>";} ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div style="margin:30px;" class="ui two column middle aligned relaxed grid basic segment">
        <div class="column">
            <div style=" background-color: #c9d3d8;" class="ui form segment AVAST_PAM_loginform">
                <div class="field">
                    <h2 for="amount"> Amount: </h2>
                    <div class="ui left labeled icon input">
                        <input style=" border: solid;" type="text" placeholder="Amount" name="amount" >
                        <i class="dollar sign icon"></i>
                    </div>
                </div>
                <input style="margin-left:570px;" class="ui positive button" type="submit" name="create_fee" value="confirm">
            </div>
        </div>
    </div>
</form>

<br>

<table style = "width:46%; margin-left:50px" class="ui inverted table">
	<thead>
  	<tr>
      <th>Condo Number</th>
      <th> Amount Paid </th>
      <th> Date </th>
    </tr>
	</thead>
  <?php		
	//fees from the database
  $fee_query = mysqli_query($db, "SELECT * FROM fees ORDER BY date DESC");
  if($_SESSION['admin'] == 1) {
  	while($fee = mysqli_fetch_array($fee_query)){		//iterate through every user
  		echo "<tr>";
  	  echo "<td>".$fee['condoID']."</td>";
  	  echo "<td>".$fee['amountPaid']."</td>";
  	  echo "<td>".$fee['date']."</td>";
  	  echo "</tr>";
  	}
  } else {
  	while($fee = mysqli_fetch_array($fee_query)){		//iterate through every user
  		if($fee['payee']==$_SESSION['ID']) {
  			echo "<tr>";
  	  	echo "<td>".$fee['condoID']."</td>";
  	  	echo "<td>".$fee['amountPaid']."</td>";
  	  	echo "<td>".$fee['date']."</td>";
  	  	echo "</tr>";
  	  }
  	}
  }
  ?>
</table>

</body>
</html>
