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
    <link href="../theme.css" rel="stylesheet">
    <script src="../comments.js"></script>
</head>
<body>
<?php
//$db = mysqli_connect('localhost', 'dummy', 'something', 'post_test') or die("Cannot connect to db");
$sql = "SELECT * FROM post WHERE ((perm='public') or(perm='private' and userID=" . $_SESSION['ID'] . ") or".
        "(perm='group' and groupID in(select gID from group_membership where uID=".$_SESSION['ID'] ."))) ORDER BY timestamp DESC;";
$result = mysqli_query($db, $sql);


while($temp = mysqli_fetch_array($result)){
    /*if($_SESSION['groupID'] != $temp['groupID'])
        continue;*/
    $sql = "SELECT name FROM Users x WHERE x.userID =" . $temp['userID'];
    $x = mysqli_query($db,$sql);
    $poster = mysqli_fetch_array($x);
    $sql = "SELECT name FROM `groups` g, post p WHERE (p.postID =". $temp['postID'] . " and p.groupID = g.groupID)";
    $y = mysqli_query($db, $sql);
    $nameOfGroup = mysqli_fetch_array($y);
    echo "<h1>" . $temp['title']."</h1><br>";
    echo "<h2> Posted on: " . $temp['timestamp'] ." By " . $poster['name'] . "</h2>";

    if($temp['perm'] == "public"){
        echo "<h2>Public</h2>";
    }
    elseif ($temp['perm'] == "private"){
        echo "<h2>Private</h2>";
    }
    else{
        echo "<h2> Group: " . $nameOfGroup['name'] . "</h2>";
    }
    echo "<p>" . $temp['body'] . "</p><br>";
    echo "<img src=". $temp['img'] . " onerror='this.onerror=null; this.remove();' height='200px'; width='400px'><br>";
    echo "<h3>Leave a comment:</h3>";
    echo "<form action='../comment_page.php' method='post' id='commentForm'>";
    echo "<input type='hidden' name='postid' value='". $temp['postID']."' />";
    echo "<input type='submit' name='comment'value='Comment'/>";
    echo "</form>";
    echo "<hr>";
}

?>
</body>
</html>
