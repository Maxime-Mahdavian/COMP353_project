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
        Manage Users  <i class="wrench icon"></i>
    </a>

    <table class="ui selectable inverted table">
        <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th> password </th>
            <th> email </th>
            <th> address </th>
            <th> admin </th>
            <th> status </th>
            <th> condoClass </th>
        </tr>

        </thead>
        <?php
				
				//list all users from database in a table, with attributes
        $user_query = mysqli_query($db, "SELECT * FROM Users");
        while($user = mysqli_fetch_array($user_query)){		//iterate through every user
            echo "<tr>";
            echo '<td><form action="edit_user.php" method="post">';		//goto edit_user.php on edit button press
            echo '<input type="hidden" id="editNum" name="editNum" value="'.$user['userID'].'">';	//also send userID
            echo '<input class="ui button" type="submit" name="edit" value="edit">';
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
    </table>

    <br>
    <a style="margin:30px; font-size: 40px; color:black;" class="item">
        Create Profile  <i class="user icon"></i>
    </a>
    <?php

		//print debug messages if there are any
		if($_SESSION['print_message']) {
			echo $_SESSION['message']."<br><br>";
			$_SESSION['print_message'] = false;		//reset boolean tellin us theres a message to print
		}

    if(isset($_POST['create_user'])) {	//handle create user button press

        //validate form
        $valid = true;
        if( !isset($_POST['name']) || empty($_POST['name']) ) $valid = false;
        if(!$valid) echo "name";
        if( !isset($_POST['password']) || empty($_POST['password']) ) $valid = false;
        if(!$valid) echo "pass";
        if( !isset($_POST['email']) || empty($_POST['email']) ) $valid = false;
        if(!$valid) echo "email";
        if( !isset($_POST['address']) || empty($_POST['address']) ) $valid = false;
        if(!$valid) echo "address";
        if( !isset($_POST['status']) || empty($_POST['status']) ) $valid = false;
        if(!$valid) echo "status";
        if( !isset($_POST['condoClass']) || empty($_POST['condoClass']) ) $valid = false;
        if(!$valid) echo "condoClass";

        if($valid) {
						
						//assign post variables to regular variables for easy of string insertion
            $name = $_POST['name']; $password = $_POST['password'];
            $email = $_POST['email']; $address = $_POST['address'];
            $status = $_POST['status']; $condoClass = $_POST['condoClass'];

						//handle html checkbox value, convert to boolean
            if(isset($_POST['admin']) && $_POST['admin'] == 'on') $admin=1;
            else $admin=0;
						
						//set condo association id to that of current user
            //admins for this condo association can only add users to this condo association
            $condoAssociationID = $_SESSION['condoAssociationID'];

						//insert user into database
            $sql = "INSERT INTO Users (name, password, email, primary_address, administrator, status, condoAssociationID, condoClassification) VALUES ('$name', '$password', '$email', '$address', $admin, '$status', $condoAssociationID, '$condoClass')";
            if (mysqli_query($db, $sql)) $_SESSION['message'] = "new user created"."<br><br>";
            else $_SESSION['message'] = "failed to create new user<br><br>";

        } else $_SESSION['message'] = "please fill out all input fields to create a user<br><br>";
        
        //set session variable saying theres a message to print, then reload page
				$_SESSION['print_message'] = true;
        header("Location: " . $_SERVER['PHP_SELF']);

    }
    ?>
<form action="manage_users.php" method="post">
    <div style="margin:40px;" class="ui two column middle aligned relaxed grid basic segment">
        <div class="column">
            <div style=" background-color: #c9d3d8;" class="ui form segment AVAST_PAM_loginform">
                <div class="field">
                    <label>Name</label>
                    <div class="ui left labeled icon input">
                        <input style=" border: solid;" type="text" placeholder="Name" name = "name">
                        <i class="user icon"></i>
                    </div>
                </div>
                <div class="field">
                    <label>Password</label>
                    <div class="ui left labeled icon input">
                        <input style=" border: solid;" type="password" name = "password">
                        <i class="lock icon"></i>
                    </div>
                </div>
                <div class="field">
                    <label>Email</label>
                    <div class="ui left labeled icon input">
                        <input style=" border: solid;" type="text" placeholder="email" name = "email">
                        <i class="at icon"></i>
                    </div>
                </div>
                <div class="field">
                    <label>Address</label>
                    <div class="ui left labeled icon input">
                        <input style=" border: solid;" type="text" placeholder="Address" name = "address">
                        <i class="building icon"></i>
                    </div>
                    </div>
                <div class="field">
                    <label>Status</label>
                    <div class="ui left labeled icon input">
                        <input style=" border: solid;" type="text" placeholder="Status" name = "status">
                    </div>
                </div>
                <div class="field">
                    <label>Condo Classification</label>
                    <div class="ui left labeled icon input">
                        <input style=" border: solid;" type="text" placeholder="condoClassification" name = "condoClass">
                        <i class="building outline icon"></i>
                    </div>
                </div>
                <div class="ui checkbox">
                    <input type="checkbox" id="admin" name="admin" >
                    <label for="admin">Administrator </label>
                </div>
                <br>
                <br>
                <input class="ui positive button" type="submit" name="create_user" value="confirm">
            </div>
        </div>
    </div>
</form>

<form action="../admin_page.html" method="post">
    <button style="margin:30px;" class="ui blue left labeled icon button" type="submit" name="back" >
        <i class="left arrow icon"></i>
        Back to Administrator Options
    </button>
</form>

</body>
</html>
