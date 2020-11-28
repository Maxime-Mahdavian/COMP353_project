<?php
/*
 * This file adds a post to the database, takes all the information from $_POST from the file
 * post.php, parses them and adds them to the db.
 */

//We need to include config.php for the database connection
//session_start to pull session variables
//We need to make sure we have a logged in user to display this page
include ("config.php");
session_start();
if(!isset($_SESSION['username'])){
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post submission</title>
</head>
<body>
<?php
//We need to keep track of whether all information for the post have been posted, and whether
//the file with the image has been uploaded to the img/ folder
$isFormSet = false;
$hasFileBeenUploaded = false;

//Simple function to dtermine whether a string is empty or null
function isNullOrEmpty($str){
    return (!isset($str) || trim($str) === '');
}

//Set variables with every element of the post form
$target = "../img/";
$target = $target . basename($_FILES['img']['name']);


$title = mysqli_real_escape_string($db, $_POST['title']);
$body = mysqli_real_escape_string($db, $_POST['body']);
$target = mysqli_real_escape_string($db, $target);
$perm = mysqli_real_escape_string($db, $_POST['perm']);


$result = null;
$sql = '';
if(isNullOrEmpty($title) || isNullOrEmpty($body))
    $isFormSet = false;
else {
    $isFormSet = true;
    //If $perm is a number, then it means that the permission is for a group, so the sql query changes slightly
    if(is_numeric($perm)){
        $sql = "INSERT INTO post (userID,groupID,img, title, body, perm) VALUES(". $_SESSION['ID'] .",'$perm', '$target', '$title','$body','group')";
        $result = mysqli_query($db, $sql);
    }
    else{
        $sql = "INSERT INTO post (userID, img, title, body, perm) VALUES (" . $_SESSION['ID'] . ",'$target','$title', '$body','$perm')";
        $result = mysqli_query($db, $sql);
    }
}

?>
<h1>Submission</h1>
<?php
//A post does not need an image, so if it is empty we can continue
if(empty($_FILES['img']['tmp_name'])){
    $hasFileBeenUploaded = true;
}
else{
    $hasFileBeenUploaded = move_uploaded_file($_FILES['img']['tmp_name'],$target);
}

//Display success or error message depending on result
if($hasFileBeenUploaded and $result and $isFormSet)
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

<a href="view_post.php">You can view post here</a><br>
<a href="post.php">Go back</a>
</body>
</html>
<?php

?>



