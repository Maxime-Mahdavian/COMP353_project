<?php
include('config.php'); 
session_start();
?>

<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>

<body>
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br>
<br>
<a style="margin:30px; font-size: 40px;" class="item">
    Profile<i class="address card outline icon"></i>
</a>
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

		//echo "Profile<br><br>";

		echo '<form action="profile.php" method="post">
		<div style="margin:30px;" class="ui two column middle aligned relaxed grid basic segment">
                        <div class="column">
                            <div class="ui form segment AVAST_PAM_loginform">
                                <div class="field">
                                    <label>Name</label>
                                    <div class="ui left labeled icon input">
                                        <input type="text" placeholder="Name" name = "name" value="'.$name.'">
                                        <i class="user icon"></i>
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Password</label>
                                    <div class="ui left labeled icon input">
                                        <input type="password" name = "password" value="'.$password.'">
                                        <i class="lock icon"></i>
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Email</label>
                                    <div class="ui left labeled icon input">
                                        <input type="text" placeholder="email" name = "email" value="'.$email.'">
                                        <i class="at icon"></i>
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Address</label>
                                    <div class="ui left labeled icon input">
                                        <input type="text" placeholder="Address" name = "address" value="'.$address.'">
                                        <i class="building icon"></i>
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Status</label>
                                    <div class="ui left labeled icon input">
                                        <input type="text" placeholder="Status" name = "status" value="'.$status.'">
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Condo Classification</label>
                                    <div class="ui left labeled icon input">
                                        <input type="text" placeholder="condoClassification" name = "condoClassification" value="'.$condoClass.'">
                                        <i class="building outline icon"></i>
                                    </div>
                                </div>
                                <br>
                                <br>
                                
                                <input class="ui positive button" type="submit" name="confirm" value="confirm">  
                                <input class="ui black button" type="submit" name="cancel" value="cancel">
                                
            </div>
                                <!--
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
            
            -->
	</form>';
	
	}

?>

</body>
</html>

