<?php
include("lib/config.php");
session_start();
?>

<!DOCTYYPE html>
<html>
<head>
    <title>
        Comments Example Page
    </title>
    <script src="comments.js"></script>
    <link href="theme.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>
<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br><br>
<button style="margin-left:1325px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='lib/view_post.php';">
    <i class="left arrow icon"></i>
    Back to Posts
</button>
<?php
/*include("lib/config.php");
session_start();*/
$post = $_POST['postid'];
$sql = "SELECT * FROM post WHERE postID=" . $post;
$result = mysqli_query($db, $sql);

while($temp = mysqli_fetch_array($result)){
    echo "<div style=' background-color: white; margin-left:40px; border: solid; border-radius: 7px; width:50%;'>";
    echo "<table style='width: 100%'><tr><td><h1 style='margin-left:5px; font-weight: bold'>" . $temp['title']."</p></td>";
    echo "<td><p align='right'> Posted on: " . $temp['timestamp']. "</p></td></tr></table>";
echo "<p>" . $temp['body'] . "</p><br>";
$prefix = '../';
$img = preg_replace('/^' . preg_quote($prefix, '/') . '/','', $temp['img']);
    echo "<tr><img style='margin-left: 20px;' onerror='this.onerror=null; this.remove();' src=". $img . " height='200px'; width='400px'></tr></table><br>";
    echo "<br></div>";
}

?>

<!--<p>Hello world! This is a comments demo.</p>
<p>This should be your blog post, product page, or whichever that you want to add comments.</p>
-->
<!-- GIVE YOUR PAGE OR PRODUCT A POST ID -->
<input type="hidden" id="post_id" value="<?php echo $post;?>"/>

<!-- CREATE A CONTAINER TO LOAD COMMENTS -->
<div id="comments"></div>

<!-- CREATE A CONTAINER TO LOAD REPLY DOCKET -->
<div style="background-color: #d5e2ff" id="reply-main"></div>
</body>
</html>