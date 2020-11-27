<?php
include ("config.php");
session_start();
//$connect = mysqli_connect("localhost", "root", "", "testing");
if(isset($_POST["query"]))
{
    $output = '';
    $query = "SELECT * FROM Users WHERE name LIKE '%".$_POST["query"]."%'";
    $result = mysqli_query($db, $query);
    $output = '<ul class="list-unstyled">';
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $output .= '<li>'.$row["name"].'</li>';
        }
    }
    else
    {
        $output .= '<li>Name Not Found</li>';
    }
    $output .= '</ul>';
    echo $output;
}
?>