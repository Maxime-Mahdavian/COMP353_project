<?php
/* [INIT] */
session_start();

if(isset($_SESSION['username']) and $_SESSION['administrator'] ==1) {


// LIBRARIES
    require __DIR__ . DIRECTORY_SEPARATOR . "config.php";
    require PATH_LIB . "Comment.php";
    $pdo = new Comments();

    /* [HANDLE AJAX REQUESTS] */
    switch ($_POST['req']) {
        /* [INVALID REQUEST] */
        default:
            echo "ERR";
            break;

        /* [EDIT COMMENT] */
        case "edit":
            echo $pdo->edit($_POST['comment_id'], $_POST['name'], $_POST['message']) ? "OK" : "ERR";
            break;

        /* [DELETE COMMENT] */
        case "del":
            echo $pdo->delete($_POST['comment_id']) ? "OK" : "ERR";
            break;
    }
    header("location: ../admin_page.html");
}
else{
    header("location: login.php");
}
?>