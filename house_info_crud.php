<?php

    // adding house in data base
    if(isset($_POST["submit"])){

        if($_POST["submit"] == "Add House"){
            add_house();
        }
        else if($_POST["submit"] == "Edit House"){
            edit_house();
        }
        else if($_POST["submit"] == "Delete House"){
            delete_house();
        }
        else if($_POST["submit"] == "Add Description"){
            add_edit_description();
            header('location: ../admin_house_info.php?good_msg=House description has been ADDED SUCCESSFULLY');
        }
        else if($_POST["submit"] == "Edit Description"){
            add_edit_description();
            header('location: ../admin_house_info.php?good_msg=House description has been EDITED SUCCESSFULLY');
        }
    }

    // a function for adding a house data in the database
    function add_house(){
        include "../included_files/connfigure.php";
        
        $house_num = filter_input(INPUT_POST, "house_num", FILTER_SANITIZE_NUMBER_INT);
        $house_type = filter_input(INPUT_POST, "house_type", FILTER_SANITIZE_SPECIAL_CHARS);
        $site_name = filter_input(INPUT_POST, "site_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $house_price = filter_input(INPUT_POST, "house_price", FILTER_SANITIZE_NUMBER_INT);
        $house_monthly_price = filter_input(INPUT_POST, "house_monthly_price", FILTER_SANITIZE_NUMBER_INT);
        $house_description = filter_input(INPUT_POST, "house_description", FILTER_SANITIZE_SPECIAL_CHARS);

        $pic_temp = $_FILES["file"]["tmp_name"];
        $new_pic_name = "{$site_name} {$house_type}";   //new name of the picture
        $new_pic_path = uniqid() . "{$new_pic_name}.jpg";  //new name of the picture but with the concatinated picture type
        $path = "../pictures/" . $new_pic_path;         //path of the picture

        $query = "INSERT INTO `house_info_table`(`house_num`, `house_type`, `house_site`, `house_price`, `monthly_price`, `picture_path`, `picture_name`, `house_description`) 
        VALUES ('$house_num','$house_type','$site_name','$house_price','$house_monthly_price','$new_pic_path', '$new_pic_name', '$house_description')";

        if(move_uploaded_file($pic_temp, $path)){
            if($conn->query($query) === true){

                $house_id = $conn->insert_id;

                $table_pics = array("living_room", "dinning_room", "master_bedroom", "bedroom", "cr", "other");
                foreach($table_pics as $delete_pics){
                    $done_query = false;

                    $add_query = "INSERT INTO $delete_pics(house_design_id) VALUES ('$house_id')";
                    
                    if($conn->query($add_query)){
                        $done_query = true;
                    }
                }

                if($done_query){
                    header('location: ../admin_house_info.php?good_msg=The house has been ADDEDD SUCCESSFULLY');
                }
                
                
            }
            else{
                error_log(mysqli_error($conn));
            }
        }
        else{
            header('location: ../admin_house_info.php?bad_msg=There seems to be a problem uploading the image in the database');
        }
        

        $conn -> close();
    }

    // a function for the selected id to be edited
    function edit_house(){
        $id = $_POST["id"];

        include "../included_files/connfigure.php";
        
        $house_num = filter_input(INPUT_POST, "house_num", FILTER_SANITIZE_NUMBER_INT);
        $house_type = filter_input(INPUT_POST, "house_type", FILTER_SANITIZE_SPECIAL_CHARS);
        $site_name = filter_input(INPUT_POST, "site_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $house_price = filter_input(INPUT_POST, "house_price", FILTER_SANITIZE_NUMBER_INT);
        $house_monthly_price = filter_input(INPUT_POST, "house_monthly_price", FILTER_SANITIZE_NUMBER_INT);
        $house_description = filter_input(INPUT_POST, "house_description", FILTER_SANITIZE_SPECIAL_CHARS);
        
        $pic_temp = $_FILES["file"]["tmp_name"];
        $new_pic_name = "{$site_name} {$house_type}";   //new name of the picture
        $new_pic_path = uniqid() . "{$new_pic_name}.jpg";  //new name of the picture but with the concatinated picture type
        $path = "../pictures/" . $new_pic_path;
        
        if(!empty($_FILES['file']['tmp_name'])){
            if(move_uploaded_file($pic_temp, $path)){
                $query = "UPDATE `house_info_table` SET `house_num`='$house_num',`house_type`='$house_type',`house_site`='$site_name',`house_price`='$house_price',`monthly_price`='$house_monthly_price',`picture_path`='$new_pic_path', `picture_name`='$new_pic_name', `house_description`='$house_description' WHERE id = $id";
                $insert = mysqli_query($conn, $query);
                $success = ($insert) ? header('location: ../admin_house_info.php?good_msg=The house has been UPDATED SUCCESSFULLY') : error_log(mysqli_error($conn));
            }
            else{
                header('location: ../admin_house_info.php?bad_msg=There seems to be a problem updating the image in the database');
            }
        }
        else{
            $query = "UPDATE `house_info_table` SET `house_num`='$house_num',`house_type`='$house_type',`house_site`='$site_name',`house_price`='$house_price',`monthly_price`='$house_monthly_price', `house_description`='$house_description' WHERE id = $id";
            $insert = mysqli_query($conn, $query);
            $success = ($insert) ? header('location: ../admin_house_info.php?good_msg=The house has been UPDATED SUCCESSFULLY') : error_log(mysqli_error($conn)); 
        }

        $conn -> close();
    }

    // a function for adding house description in the database
    function add_edit_description(){
        include "../included_files/connfigure.php";
        $id = $_POST["id"];
        $house_description = $conn->real_escape_string($_POST["house_description"]);

        $query = "UPDATE `house_info_table` SET `house_description`='$house_description' WHERE id = $id";

        if($conn->query($query) === false){
            error_log(mysqli_error($conn));
        }

        $conn -> close();
    }

    // a function for the selected house to be deleted
    function delete_house(){
        $id = $_POST["id"];

        include "../included_files/connfigure.php";

        $table_pics = array("living_room", "dinning_room", "master_bedroom", "bedroom", "cr", "other");
        foreach($table_pics as $delete_pics){
            $done_query = false;
            $delete_query = "DELETE FROM `$delete_pics` WHERE house_design_id = $id";

            if($conn->query($delete_query)){
                $done_query = true;
            }
        }

        if($done_query){
            $query_house_info = "DELETE FROM `house_info_table` WHERE id = $id";

            if($conn->query($query_house_info) === true){
                header('location: ../admin_house_info.php?good_msg=The house data hase been DELETED SUCCESSFULLY');
            }
            else{
                error_log(mysqli_error($conn));
            }
        }
        

        $conn -> close();
    }

?>