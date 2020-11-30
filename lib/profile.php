<?php
include('config.php'); 
session_start();
?>

<head>
    <title>My Profile </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>

<body>
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<div style="background-color: #d5e2ff; width:100%; height:100%; background-size: cover; ">
    <br>
    <br>
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

            echo '<a style="margin:30px; font-size: 40px; color:black;" class="item">
                    Edit Profile  <i class="edit icon"></i>
                    </a>';

            echo '<form action="profile.php" method="post">
             <div style="margin:30px;" class="ui two column middle aligned relaxed grid basic segment">
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
                                <br>
                                <br>
                                
                                <input class="ui positive button" type="submit" name="confirm" value="confirm">  
                                <input class="ui black button" type="submit" name="cancel" value="cancel">
                            </div>
                        </div>
            </div>
    </form>';

        } else {
            //
            echo '<a style="margin:30px; font-size: 40px; color:black;" class="item">
                    Profile  <i class="address card outline icon"></i>
                   </a>';

            echo '<form action="profile.php" method="post">
            <div style="margin:30px;" class="ui two column middle aligned relaxed grid basic segment">
                        <div class="column">
                            <div style=" background-color: #c9d3d8;" class="ui form segment AVAST_PAM_loginform">
                                <div class="field">
                                    <label for="name">Name: '.$name.'</label>
                                </div>
                                <div class="field">
                                    <label for="Password:">Password: '.$password.'</label>
                                </div>
                                <div class="field">
                                    <label for="Email">Email: '.$email.'</label>
                                </div>
                                <div class="field">
                                    <label for="Address">Address: '.$address.'</label>
                                </div>
                                <div class="field">
                                    <label for="Status">Status: '.$status.'</label>
                                </div>
                                <div class="field">
                                    <label for="CondoClass">Condo Classification: '.$condoClass.'</label>
                                </div>
                                <div class="field">
                                    <label for="Admin">Administrator: '.$admin.'</label>
                                </div>
                                <br>
                                <br>
                                
                                <input class="ui black button" type="submit" name="editProfile" value="edit">
                                <button class="ui labeled icon blue button" type="submit" name="back" value="back">
                                    <i class="left chevron icon"></i>
                                    Back
                                </button>
                            </div>
                        </div>     
            </div>
        </form>';

        }

    ?>
</div>
</body>

</html>

