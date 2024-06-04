<?php
    if(isset($_POST["submit"])){

        if($_POST["submit"] === "Add Images"){
            add_image();
            header("location: ../admin_interior_design_page.php?good_msg=The image has been ADDED SUCCESSFULLY");
        } 
        else if($_POST["submit"] === "Remove Image/s"){
            delete_image();
            header("location: ../admin_interior_design_page.php?good_msg=The image that was selected has been DELETED SUCCESSFULY");
        }
    }
    else{
        header("location: ../admin_interior_design_page.php?bad_msg=ADD AN IMAGE FIRST");
    }
        
    function add_image(){
        include "../included_files/connfigure.php";
        $id = $_POST["id"];
        $house_type = $_POST['house_type'];

        foreach($_FILES as $input_files => $about_files){
            
            if(isset($about_files["tmp_name"]) && !empty($about_files["tmp_name"])){
                foreach($about_files["tmp_name"] as $index => $index_tmp_name_value){
                    if(!empty($index_tmp_name_value)){ 
                        if($input_files === "living_room_pic_file"){

                            $new_pic_name = "living room";
                            $new_pic_path_name = uniqid() . "{$house_type}-{$new_pic_name}.jpg";
                            $path = "../pictures/{$new_pic_path_name}";

                            if(move_uploaded_file($index_tmp_name_value, $path)){

                                $query_check = "SELECT living_room_pic, living_room_path FROM living_room WHERE house_design_id = $id";
                                $result = $conn->query($query_check);
                                if($result){
                                    $check_row = mysqli_fetch_assoc($result);

                                    if(empty($check_row["living_room_pic"]) && empty($check_row["living_room_path"])){
                                        $query = "UPDATE `living_room` SET `living_room_pic`='$new_pic_name', `living_room_path`='$new_pic_path_name' 
                                        WHERE house_design_id = $id";
                                    }
                                    else{
                                        $query = "INSERT INTO living_room(house_design_id, living_room_pic, living_room_path) 
                                        VALUES ('$id', '$new_pic_name', '$new_pic_path_name')";
                                    }
                                }
                                

                                if($conn->query($query) === false){
                                    header("location: ../admin_interior_design_page.php?bad_msg=Theres some error while uploading the images");
                                }
                            }
                        }
                        else if($input_files === "dinning_room_pic_file"){
                            $new_pic_name = "dinning room";
                            $new_pic_path_name = uniqid() . "{$house_type}-{$new_pic_name}.jpg";
                            $path = "../pictures/{$new_pic_path_name}";

                            if(move_uploaded_file($index_tmp_name_value, $path)){

                                $query_check = "SELECT dinning_room_pic, dinning_room_path FROM dinning_room WHERE house_design_id = $id";
                                $result = $conn->query($query_check);
                                if($result){
                                    $check_row = mysqli_fetch_assoc($result);

                                    if(empty($check_row["dinning_room_pic"]) && empty($check_row["dinning_room_path"])){
                                        $query = "UPDATE `dinning_room` SET `dinning_room_pic`='$new_pic_name', `dinning_room_path`='$new_pic_path_name' 
                                        WHERE house_design_id = $id";
                                    }
                                    else{
                                        $query = "INSERT INTO dinning_room(house_design_id, dinning_room_pic, dinning_room_path) 
                                        VALUES ('$id', '$new_pic_name', '$new_pic_path_name')";
                                    }
                                }

                                if($conn->query($query) === false){
                                    header("location: ../admin_interior_design_page.php?bad_msg=Theres some error while uploading the images");
                                }
                            }
                        }
                        else if($input_files === "master_bedroom_pic_file"){
                            $new_pic_name = "master bedroom";
                            $new_pic_path_name = uniqid() . "{$house_type}-{$new_pic_name}.jpg";
                            $path = "../pictures/{$new_pic_path_name}";

                            if(move_uploaded_file($index_tmp_name_value, $path)){
                                
                                $query_check = "SELECT master_bedroom_pic, master_bedroom_path FROM master_bedroom WHERE house_design_id = $id";
                                $result = $conn->query($query_check);
                                if($result){
                                    $check_row = mysqli_fetch_assoc($result);

                                    if(empty($check_row["master_bedroom_pic"]) && empty($check_row["master_bedroom_path"])){
                                        $query = "UPDATE `master_bedroom` SET `master_bedroom_pic`='$new_pic_name', `master_bedroom_path`='$new_pic_path_name' 
                                        WHERE house_design_id = $id";
                                    }
                                    else{
                                        $query = "INSERT INTO master_bedroom(house_design_id, master_bedroom_pic, master_bedroom_path) 
                                        VALUES ('$id', '$new_pic_name', '$new_pic_path_name')";
                                    }
                                }

                                if($conn->query($query) === false){
                                    header("location: ../admin_interior_design_page.php?bad_msg=Theres some error while uploading the images");
                                }
                            }
                        }
                        else if($input_files === "bedroom_pic_file"){
                            $new_pic_name = "bedroom";
                            $new_pic_path_name = uniqid() . "{$house_type}-{$new_pic_name}.jpg";
                            $path = "../pictures/{$new_pic_path_name}";

                            if(move_uploaded_file($index_tmp_name_value, $path)){
                                
                                $query_check = "SELECT bedroom_pic, bedroom_path FROM bedroom WHERE house_design_id = $id";
                                $result = $conn->query($query_check);
                                if($result){
                                    $check_row = mysqli_fetch_assoc($result);

                                    if(empty($check_row["bedroom_pic"]) && empty($check_row["bedroom_path"])){
                                        $query = "UPDATE `bedroom` SET `bedroom_pic`='$new_pic_name', `bedroom_path`='$new_pic_path_name' 
                                        WHERE house_design_id = $id";
                                    }
                                    else{
                                        $query = "INSERT INTO bedroom(house_design_id, bedroom_pic, bedroom_path) 
                                        VALUES ('$id', '$new_pic_name', '$new_pic_path_name')";
                                    }
                                }

                                if($conn->query($query) === false){
                                    header("location: ../admin_interior_design_page.php?bad_msg=Theres some error while uploading the images");
                                }
                            }
                        }
                        else if($input_files === "cr_pic_file"){
                            $new_pic_name = "cr";
                            $new_pic_path_name = uniqid() . "{$house_type}-{$new_pic_name}.jpg";
                            $path = "../pictures/{$new_pic_path_name}";

                            if(move_uploaded_file($index_tmp_name_value, $path)){
                                
                                $query_check = "SELECT cr_pic, cr_path FROM cr WHERE house_design_id = $id";
                                $result = $conn->query($query_check);
                                if($result){
                                    $check_row = mysqli_fetch_assoc($result);

                                    if(empty($check_row["cr_pic"]) && empty($check_row["cr_path"])){
                                        $query = "UPDATE `cr` SET `cr_pic`='$new_pic_name', `cr_path`='$new_pic_path_name' 
                                        WHERE house_design_id = $id";
                                    }
                                    else{
                                        $query = "INSERT INTO cr(house_design_id, cr_pic, cr_path) 
                                        VALUES ('$id', '$new_pic_name', '$new_pic_path_name')";
                                    }
                                }

                                if($conn->query($query) === false){
                                    header("location: ../admin_interior_design_page.php?bad_msg=Theres some error while uploading the images");
                                }
                            }
                        }
                        else if($input_files === "other_pic_file"){
                            $new_pic_name = "other";
                            $new_pic_path_name = uniqid() . "{$house_type}-{$new_pic_name}.jpg";
                            $path = "../pictures/{$new_pic_path_name}";

                            if(move_uploaded_file($index_tmp_name_value, $path)){
                                
                                $query_check = "SELECT other_pic, other_path FROM other WHERE house_design_id = $id";
                                $result = $conn->query($query_check);
                                if($result){
                                    $check_row = mysqli_fetch_assoc($result);

                                    if(empty($check_row["other_pic"]) && empty($check_row["other_path"])){
                                        $query = "UPDATE `other` SET `other_pic`='$new_pic_name', `other_path`='$new_pic_path_name' 
                                        WHERE house_design_id = $id";
                                    }
                                    else{
                                        $query = "INSERT INTO other(house_design_id, other_pic, other_path) 
                                        VALUES ('$id', '$new_pic_name', '$new_pic_path_name')";
                                    }
                                }

                                if($conn->query($query) === false){
                                    header("location: ../admin_interior_design_page.php?bad_msg=Theres some error while uploading the images");
                                }
                            }
                        }
                    }
                }
            }
        }

        $conn -> close();
    }

    function delete_image(){
        include "../included_files/connfigure.php";

        foreach(["living_room", "dinning_room", "master_bedroom", "bedroom", "cr", "other"] as $check_box){
            $id = "{$check_box}_id";

            if(isset($_POST[$check_box])){
                foreach($_POST[$check_box] as $id_val){

                    $pic_name = "{$check_box}_pic";
                    $pic_path = "{$check_box}_path";
                    $query_update = "UPDATE $check_box SET `$pic_name`=NULL, `$pic_path`=NULL WHERE $id = $id_val";
                    $conn->query($query_update);
                }
            }

            $query_row_check = "SELECT $id FROM $check_box LIMIT 10 OFFSET 1";
            $select_row_check = $conn->query($query_row_check);
            $select_row_value = $select_row_check->fetch_assoc();
        
            if($select_row_check->num_rows > 0){

                while($select_row_value){
                    $id_row = $select_row_value[$id];

                    $query_delete = "DELETE FROM $check_box WHERE $id = $id_row";
                    $conn->query($query_delete);
                }
            }
        }

        $conn->close();
    }

?>