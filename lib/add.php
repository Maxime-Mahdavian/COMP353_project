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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <title>Post submission</title>
</head>
<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br>
<br>
<button style="margin-left:1320px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='post.php';">
    <i class="left arrow icon"></i>
    Back
</button>
<a style="margin-left:30px; font-size: 40px; color:black;" class="item">
    New Post <i class="bullhorn icon"></i>
</a>
<br>
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
<h2 style="margin-left: 30px;">Submission</h2>
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
    echo "<h3 style='margin-left: 45px;'>The file ". basename( $_FILES['uploadedfile']
        ['name']). " has been uploaded, and your information has been added to the directory</h3>";


}
else {
    echo "<p>" . $_FILES['img']['tmp_name'] . "</p>";
    if($isFormSet == false){
        echo "<h3 style='margin-left: 45px; color:red;'>Error, did not complete the form</h3>";
    }
    else {
        echo "<h3 style='margin-left: 45px; color:red;'>Sorry, there was a problem uploading your file.</h3>";

    }
}
?>

<button style="margin-left:45px" class="ui green button" type="submit" name="back" onclick="window.location.href='view_post.php';">
    Click here to view post
</button>
</body>
</html>
<?php

?>



