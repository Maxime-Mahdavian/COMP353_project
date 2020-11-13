<?php
include ("config.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post submission</title>
</head>
<body>
<?php
$isFormSet = false;

function isNullOrEmpty($str){
    return (!isset($str) || trim($str) === '');
}


$target = "../img/";
$target = $target . basename($_FILES['img']['name']);
//$db = mysqli_connect('localhost', 'dummy', 'something', 'post_test') or die("Cannot connect to db");

$title = mysqli_real_escape_string($db, $_POST['title']);
$body = mysqli_real_escape_string($db, $_POST['body']);
$target = mysqli_real_escape_string($db, $target);

if(isNullOrEmpty($title) || isNullOrEmpty($body))
    $isFormSet = false;
else {
    $isFormSet = true;
    $sql = "INSERT INTO post (userID, groupID, img, title, body) VALUES (" . $_SESSION['ID'] . "," . $_SESSION['groupID'] . ",'$target','$title', '$body')";
    $result = mysqli_query($db, $sql);
}

?>
<h1>Submission</h1>
<?php
if(move_uploaded_file($_FILES['img']['tmp_name'],$target) and $result and $isFormSet)
{
    echo "<h2>The file ". basename( $_FILES['uploadedfile']
        ['name']). " has been uploaded, and your information has been added to the directory</h2>";


}
else {
    echo "<p>" . $_FILES['img']['tmp_name'] . "</p>";
    if($isFormSet == false){
        echo "<h2>Error, did not complete the form</h2>";
    }
    else {
        echo "<h2>Sorry, there was a problem uploading your file.</h2>";

    }
}
?>

<a href="view_post.php">You can view post here</a>
<a href="../post.html">Go back</a>
</body>
</html>
<?php

?>



