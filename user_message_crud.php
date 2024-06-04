<?php
    if(isset($_POST["submit"])){
        if($_POST["submit"] === "Send Message"){
            send_message();
        }
    }

    // inserting the send message into the database
    function send_message(){
        include_once "../included_files/connfigure.php";

        $user_name = $_POST["user_name"];
        $user_contact = $_POST["user_contact_num"];
        $user_message = $_POST["user_message"];
        $url_name = $_POST["url_name"];

        
        $query = "INSERT INTO `user_message`(`user_name`, `user_contact`, `user_message_to_admin`) 
        VALUES ('$user_name', '$user_contact', '$user_message')";
        $insert_query = $conn->query($query);

        $success = ($insert_query) ? header("location: " . $url_name . "?good_msg=The MESSAGE has been sent successfully") : error_log(mysqli_error($conn));
        
    }
?>