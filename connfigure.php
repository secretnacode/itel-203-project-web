<?php
    $conn = mysqli_connect("localhost", "root", "", "finalproj_itel203db");

    if(!$conn){
        die("Connection Failed ". mysqli_connect_error());
    }
    // else{
    //     echo "your connected";
    // }
?>