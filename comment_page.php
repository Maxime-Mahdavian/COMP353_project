<!DOCTYYPE html>
<html>
<head>
    <title>
        Comments Example Page
    </title>
    <script src="comments.js"></script>
    <link href="theme.css" rel="stylesheet">
</head>
<body>
<?php
include("lib/config.php");
session_start();
$post = $_POST['postid'];
$sql = "SELECT * FROM post WHERE postID=" . $post;
$result = mysqli_query($db, $sql);

while($temp = mysqli_fetch_array($result)){
    echo "<h1>" . $temp['title']."</h1><br>";
    echo "<h2> Posted on: " . $temp['timestamp']. "</h2>";
    echo "<p>" . $temp['body'] . "</p><br>";
    $prefix = '../';
    $img = preg_replace('/^' . preg_quote($prefix, '/') . '/','', $temp['img']);
    echo "<img src=". $img . " height='200px'; width='400px'><br>";
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
<div id="reply-main"></div>
</body>
</html>