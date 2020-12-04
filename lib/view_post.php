<?php
require("config.php");
session_start() or die("Something went wrong");
if(!isset($_SESSION['username']))
    header("location: login.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <script src="../comments.js"></script>
</head>
<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br>
<br>
<button style="margin-left:1320px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='welcome.php';">
    <i class="left arrow icon"></i>
    Back to Main Page
</button>
<a style="margin:30px; font-size: 40px; color:black;" class="item">
    Posts <i class="globe icon"></i>
</a>
<br><br><br>
<div >
    <?php
    //$db = mysqli_connect('localhost', 'dummy', 'something', 'post_test') or die("Cannot connect to db");

    if(isset($_POST['post_group'])){
        $sql = "SELECT * FROM post WHERE groupID=" .$_POST['post_group'] . " ORDER BY timestamp DESC;";
        $result = mysqli_query($db, $sql);
    }
    else {
        $sql = "SELECT * FROM post WHERE ((perm='public') or (perm='Ad') or(perm='private' and userID=" . $_SESSION['ID'] . ") or" .
            "(perm='group' and groupID in(select gID from group_membership where uID=" . $_SESSION['ID'] . "))) ORDER BY timestamp DESC;";
        $result = mysqli_query($db, $sql);
    }

    if(mysqli_num_rows($result) == 0){
        echo "<h1 style='margin-left:40px;'>THERE ARE NO POST</h1>";
    }

    while($temp = mysqli_fetch_array($result)){
        echo "<div style=' background-color: white; margin-left:40px; border: solid; border-radius: 7px; width:80%;'>";
            /*if($_SESSION['groupID'] != $temp['groupID'])
                continue;*/
            $sql = "SELECT name FROM Users x WHERE x.userID =" . $temp['userID'];
            $x = mysqli_query($db,$sql);
            $poster = mysqli_fetch_array($x);
            $sql = "SELECT name FROM `groups` g, post p WHERE (p.postID =". $temp['postID'] . " and p.groupID = g.groupID)";
            $y = mysqli_query($db, $sql);
            $nameOfGroup = mysqli_fetch_array($y);
            echo "<div><p style='font-size: xx-large; font-weight: bold'>" . $temp['title']."</p>";
            echo "<p> Posted on: " . $temp['timestamp'] ." By " . $poster['name'] . "</p></div>";

            if($temp['perm'] == "public"){
                echo "<h2>Public</h2>";
            }
            elseif ($temp['perm'] == "private"){
                echo "<h2>Private</h2>";
            }
            elseif($temp['perm'] == "Ad"){
                echo "<h2>Ad</h2>";
            }
            else{
                echo "<h2> Group: " . $nameOfGroup['name'] . "</h2>";
            }
            echo "<p>" . $temp['body'] . "</p><br>";
            echo "<img src=". $temp['img'] . " onerror='this.onerror=null; this.remove();' height='200px'; width='400px'><br><br>";
            echo "<form action='../comment_page.php' method='post' id='commentForm'>";
            echo "<input type='hidden' name='postid' value='". $temp['postID']."' />";
            echo "<input style='left-margin:1000px;' class='ui blue button' type='submit' name='comment'value='Comment'/>";
            echo "</form>";
            echo "<hr>";
        echo "</div><br>";
    }
    ?>
</div>
</body>
</html>
