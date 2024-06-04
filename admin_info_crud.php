<?php
    if(isset($_POST["submit"])){
        if($_POST["submit"] == "Add Contacts"){
            add_contacts();
        }
        else if($_POST["submit"] == "Edit Username"){
            edit_username();
        }
        else if($_POST["submit"] == "Edit Password"){
            edit_password();
        }
    }

    // for adding contacts
    function add_contacts(){
        include "../included_files/connfigure.php";

        $rows_contact = array("facebook" => $_POST["admin_fb"],
                      "instagram" => $_POST["admin_insta"], 
                      "twitter" => $_POST["admin_tweeter"], 
                      "tiktok" => $_POST["admin_tiktok"], 
                      "location" => $_POST["admin_location"]
                    );

        foreach($rows_contact as $contact => $value){
            $contact_value = false;

            $query_row = "UPDATE `admin_contact` SET `contact_value`='$value' WHERE contact = '$contact'";
            $insert_contact = $conn->query($query_row);

            if($insert_contact){
                $contact_value = true;
            }
        }

        $rows_info = array("fullname" => $_POST["admin_fullname"],
                     "nickname" => $_POST["admin_nickname"],    
                     "gmail" => $_POST["admin_gmail"],
                     "phone" => $_POST["admin_phone"], 
                     "telephone" => $_POST["admin_telephone"]
                    );

        foreach($rows_info as $info => $value){
            $info_value = false;

            $query_row = "UPDATE `admin_need_info` SET `admin_info_values`='$value' WHERE admin_info = '$info'";
            $insert_info = $conn->query($query_row); 

            if($insert_info){
                $info_value = false;
            }
        }

        if(isset($_FILES["admin_picture"]["tmp_name"]) && !empty($_FILES["admin_picture"]["tmp_name"])){
            $tmp_name = $_FILES['admin_picture']['tmp_name'];
            $admin_picture = uniqid() . "admin picture.jpg";
            $path = "../pictures/{$admin_picture}";

            if(move_uploaded_file($tmp_name, $path)){
                $query_pic = "UPDATE `admin_need_info` SET `admin_info_values` = '$admin_picture' WHERE admin_info = 'picture'";
                $conn->query($query_pic);
            }

        }

        if($contact_value || $info_value){

            $conn->close();
            header("location: ../admin_info.php?good_msg=The contacts has been ADDED SUCCESSFULLY");
        } 
    }

    // for changing the username
    function edit_username(){
        include "../included_files/connfigure.php";

        $old_username = $_POST["old_username"];
        $new_username = $_POST["confirm_username"];

        $query_username = "SELECT username FROM admin_info WHERE id = 1";
        $select_query = $conn->query($query_username);
        $username_row = mysqli_fetch_assoc($select_query);

        if(password_verify($old_username, $username_row["username"])){
            $hash_username = password_hash($new_username, PASSWORD_DEFAULT);

            $new_username_query = "UPDATE `admin_info` SET `username` = '$hash_username' WHERE id = 1";
            $update_username = $conn->query($new_username_query);

            if($update_username){
                $conn->close();
                header("location: ../admin_info.php?good_msg=New USERNAME has been set");
            }
        }
        else{
            $conn->close();
            header("location: ../admin_info.php?bad_msg=You inserted a wrong Username");
        }
    }

    // for changing the password
    function edit_password(){
        include "../included_files/connfigure.php";

        $old_password = $_POST["old_password"];
        $new_password = $_POST["confirmation_password"];

        $query_password = "SELECT `password` FROM admin_info WHERE id = 1";
        $select_query = $conn->query($query_password);
        $password_row = mysqli_fetch_assoc($select_query);

        if(password_verify($old_password, $password_row["password"])){
            $hash_password = password_hash($new_password, PASSWORD_DEFAULT);

            $new_password_query = "UPDATE `admin_info` SET `password` = '$hash_password' WHERE id = 1";
            $update_password = $conn->query($new_password_query);

            if($update_password){
                $conn->close();
                header("location: ../admin_info.php?good_msg=New PASSWORD has been set");
            }
        }
        else{
            $conn->close();
            header("location: ../admin_info.php?bad_msg=You inserted a wrong Password");
        }
    }
?>