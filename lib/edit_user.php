<?php
	include('config.php'); 
	session_start();
?>

<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>
<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br>
<br>
<a style="margin:30px; font-size: 40px; color:black;" class="item">
    Edit User<i class="edit icon"></i>
</a>

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
		
		} else echo "blank fields are not allowed<br><br>";
	
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

echo '
<form action="edit_user.php" method="post">
            <div class="ui two column middle aligned relaxed grid basic segment">
                    <div class="column">
                        <div style=" background-color: #c9d3d8;" class="ui form segment AVAST_PAM_loginform">
                            <div class="field">
                                <label>Name</label>
                                <div class="ui left labeled icon input">
                                    <input style=" border: solid;" type="text" placeholder="Name" name = "name" value="'.$name.'">
                                    <i class="user icon"></i>
                                </div>
                            </div>
                            <div class="field">
                                <label>Password</label>
                                <div class="ui left labeled icon input">
                                    <input style=" border: solid;" type="password" name = "password" value="'.$password.'">
                                    <i class="lock icon"></i>
                                </div>
                            </div>
                            <div class="field">
                                <label>Email</label>
                                <div class="ui left labeled icon input">
                                    <input style=" border: solid;" type="text" placeholder="email" name = "email" value="'.$email.'">
                                    <i class="at icon"></i>
                                </div>
                            </div>
                            <div class="field">
                                <label>Address</label>
                                <div class="ui left labeled icon input">
                                    <input style=" border: solid;" type="text" placeholder="Address" name = "address" value="'.$address.'">
                                    <i class="building icon"></i>
                                </div>
                            </div>
                            <div class="field">
                                <label>Status</label>
                                <div class="ui left labeled icon input">
                                    <input style=" border: solid;" type="text" placeholder="Status" name = "status" value="'.$status.'">
                                </div>
                            </div>
                            <div class="field">
                                <label>Condo Classification</label>
                                <div class="ui left labeled icon input">
                                    <input style=" border: solid;" type="text" placeholder="condoClassification" name = "condoClass" value="'.$condoClass.'">
                                    <i class="building outline icon"></i>
                                </div>
                            </div>
                            <div class="ui checkbox">
                                <input style=" border: solid;" type="checkbox" id="admin" name="admin" value="'.$admin.'">
                                <label for="admin">Administrator </label>
                            </div>
                            <br>
		                    <br>
                            
		                    <input type="hidden" id="editNum" name="editNum" value="'.$editID.'">
		                    <input class="ui positive button" type="submit" name="confirm" value="confirm">  
		                    <input class="ui negative button" type="submit" name="delete" value="delete">  
		                    <input class="ui black button" type="submit" name="cancel" value="cancel">
                        </div>
                    </div>
            </div>
</form>'

?>

</html>
</body>
