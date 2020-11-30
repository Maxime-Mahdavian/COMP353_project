<?php
include("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form



    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db,$_POST['password']);

    $sql = "SELECT * FROM Users WHERE name = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($count == 1) {
        $_SESSION['username'] = $myusername;
        $_SESSION['admin'] = $row['administrator'];
        $_SESSION['ID'] = $row['userID'];
        $_SESSION['condoAssociationID'] = $row['condoAssociationID'];

        $sql = "SELECT groupID FROM groups g, group_membership m WHERE g.groupID = m.gID AND m.uID=". $_SESSION['ID'];
        $result2 = mysqli_query($db,$sql);
        $listofGroups = [];
        while($answer = mysqli_fetch_array($result2)){
            array_push($listofGroups,$answer['groupID']);
        }
        $_SESSION['groupID'] = $listofGroups;

        header("location: welcome.php");

    }else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>
<html>

<head>
    <title>Login Page</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">

    </style>
</head>

<body >
<div style="background-color: #d5e2ff; width:100%; height:100%; background-size: cover; ">

<div align = "center" >
    <div style = "width:400px; border: transparent 1px ; " align = "middle center">
<!--        <div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge building icon"></i></b></div>-->
<!---->
<!--        <div style = "background-color:#aca3ec; color:#4D39D6; padding:3px;"><b>Login</b></div>-->


            <br><br><br><br><br><br><br><br>

            <form action = "login.php" method = "post">
                <div  class="ui middle aligned center aligned grid">
                    <div class="column">
                        <h2 class="ui purple image header">
                            <i class="huge building icon"></i>
                            <div class="content">
                                Log-in
                            </div>
                        </h2>
                        <form class="ui large form AVAST_PAM_loginform" >
                            <div style=" background-color: #c9d3d8;" class="ui stacked segment">
                                <div class="field">
                                    <label>Username</label>
                                    <div style=" background-color: #d5e2ff;" class="ui left labeled icon input">
                                        <input style=" background-color: #a0a8ac;" type="text" placeholder="Username" name = "username" class = "box">
                                        <i class="user icon"></i>
                                    </div>
                                </div>
                                <br>
                                <div class="field">
                                    <label>Password</label>
                                    <div style=" background-color: #d5e2ff;" class="ui left labeled icon input">
                                        <input style=" background-color: #a0a8ac;" type="password" name = "password" class = "box" >
                                        <i class="lock icon"></i>
                                    </div>
                                </div>
                                <br>
                                <input class="ui fluid large blue submit button" type = "submit" value = " Login "/>
                            </div>

                            <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

                        </form>
                    </div>
                </div>
<!--                <div class="ui two column middle aligned relaxed grid basic segment">-->
<!--                    <div class="column">-->
<!--                        <div class="ui form segment AVAST_PAM_loginform">-->
<!--                            <div class="field">-->
<!--                                <label>Username</label>-->
<!--                                <div class="ui left labeled icon input">-->
<!--                                    <input type="text" placeholder="Username" name = "username" class = "box">-->
<!--                                    <i class="user icon"></i>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="field">-->
<!--                                <label>Password</label>-->
<!--                                <div class="ui left labeled icon input">-->
<!--                                    <input type="password" name = "password" class = "box" >-->
<!--                                    <i class="lock icon"></i>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <input class="ui blue submit button" type = "submit" value = " Login "/><br />-->
<!--                        </div>-->
<!--                    </div>-->
            </form>


        </div>

    </div>

</div>>
</div>
</body>
</html>
