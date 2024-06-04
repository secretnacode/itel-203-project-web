<?php
     require_once "./included_files/connfigure.php";

    // checking if you already logged in, if not youll go back to log in page
    session_start();
    if(empty($_SESSION["username"]) && empty($_SESSION["password"])){
        header("location: ./admin_log_in_form.php?bad_msg=You need to log in FIRST!!");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interior Design</title>
    <link rel="stylesheet" href="./design.css">

    <style>
        .content{
            width: 100%;
        }

        /* table content */
        .table_content{
            width: 100%;
            display: flex;
            justify-content: end;
        }

        .values{
            width: 85%;
        }

        /* style for the alerts*/
        .msg{
            position: fixed;
            width: fit-content;
            height: 80px;
            font-size: 15px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin: 10px 0;
            z-index: 4;
            right: 50%;
            transform: translateX(50%);
        }

        .msg .msg_content{
            padding: 0 20px;
            color: rgba(252, 252, 252, 1);
        }

        .msg span{
            right: 0;
            padding: 5px;
            margin: 10px;
            font-size: 15px;
            width: 17px;
            height: auto;
            text-align: center;
            border: 1px solid rgba(0, 0, 0, 0.7);
            border-radius: 50%;
            cursor: pointer;
        }

        .msg span:hover{
            font-weight: bolder;
        }

        #bad_msg{
            background-color: rgba(219, 64, 53, 1);
        }

        #good_msg{
            background-color: rgba(59, 217, 66, 1);
        }

        /* tables designs */
        .data_table{
            display: flex;
            width: 100%;
            justify-content: center;
            margin-top: 30px;
            z-index: 3;
        }

        #table_container{
            border: 1px solid black;
            width: 95%;
            border-radius: 5px;
        }

        .table_header{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            height: 80px;
            background-color: rgba(0, 0, 0, 0.7);
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
            border-bottom: 1px solid black;
        }

        .table_header h1{
            padding: 20px;
            justify-content: center;
            color: white;
        }

        .action_form input{
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 12px;
        }

        .edit{
            background: rgba(247, 164, 92, 1);
            transition: transform 0.1s linear, 
                box-shadow 0.1s linear;
            cursor: pointer;
        }

        .add{
            background: rgba(94, 77, 255, 1);
            transition: transform 0.1s linear, 
                box-shadow 0.1s linear;
            cursor: pointer;
        }

        .edit:hover, .add:hover{
            transform: translateY(-5px);
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.7);
        }

        #table_content{
            padding: 5px 20px 20px 20px;
            background-color: white;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        #table_search form{
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 50px;
        }

        #table_search form label{
            color: rgba(0, 0, 0, 0.7);
        }


        #table_search form input{
            display: flex;
            justify-content: end;
            align-items: end;
            height: 25px;
            font-size: 15px;
            padding: 3px;
            border-radius: 8px;
            border: 1.5px solid rgba(0, 0, 0, 0.7);
        }

        #table_search form input:focus{
            box-shadow: 0 0 8px rgba(0, 115, 255, 1),
                0 0 6px rgba(89, 164, 255, 1);
        }   

        #table{
            border: 1px solid rgba(0, 0, 0, 0.4);
            padding: 20px 30px;
            margin-top: 15px;
            width: inherit;
        }

        table{
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td{
            text-align: left;
        } 

        th{
            padding: 0 8px;
            font-size: 18px;
            letter-spacing: 0.5px;
            border-bottom: 3px solid rgba(0, 0, 0, 0.7);
        }

        th:nth-of-type(1){
            width: 10%;
        }

        th:nth-of-type(2){
            width: 19%;
        }

        th:nth-of-type(3){
            width: 50%;
        }

        th:nth-of-type(4){
            width: 21%;
        }

        th:nth-of-type(n+2),
        td:nth-last-of-type(1){
            text-align: center;
        }
        
        td{
            padding: 20px 8px;
            font-size: 15px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            text-transform: capitalize;
        }

        td:nth-of-type(3){
            padding: 8px;
        }

        tbody tr:nth-of-type(even){
            background-color: rgba(245, 245, 245, 1);
        }

        tbody tr:nth-of-type(odd){
            background-color: rgba(250, 250, 250, 1);
        } 
        
        tbody tr:hover{
            background-color: rgba(233, 233, 233, 1);
        }

        .images{
            max-width: 500px;
        }

        .image_container{
            overflow-x: auto;
            display: flex;
            flex-direction: row;
        }

        .image_wrapper{
            display: flex;
            flex-direction: row;
            justify-content: start;

        }

        .image_wrapper .image{
            height: 200px;
            border: 2px solid rgba(0, 0, 0, 0.7);
            border-radius: 5px;
            margin:  5px 20px 10px 0;
        }
    </style>
</head>
<body>

    <!-- navigation bar -->
    <div>
        <?php require_once "./included_files/admin_navigation_bar.php"?>
    </div>

    <!-- house interior designs -->
    <div class="content">
        <?php
            if(isset($_GET["bad_msg"])){
                $bad_mesage = $_GET["bad_msg"];

                echo '
                <div id="bad_msg" class="msg">
                    <div class="msg_content">' .$bad_mesage. '</div>
                    <span class="close_button">&times;</span>
                </div> 
                ';
            }
            else if(isset($_GET["good_msg"])){
                $good_mesage = $_GET["good_msg"];
                
                echo '
                <div id="good_msg" class="msg">
                    <div class="msg_content">' .$good_mesage. '</div>
                    <span class="close_button">&times;</span>
                </div> 
                ';
            }
        ?>
        </div>

        <div>
            <?php require_once "./included_files/admin_navigation_bar.php"?>
        </div>

        <!-- houses status -->
        <div class="table_content">
            <div class="values">

                <!-- tables --> 
                <div class="data_table">
                    <div id="table_container">
                        <div class="table_header">
                            <h1>Houses Interior Design</h1>
                        </div>
                        
                        <div id="table_content">
                            <div id="table_search">
                                <form action="" method="">
                                    <div class="limit_input">    
                                        <label for="limit">show:</label>
                                        <input type="number" name="limit" value="0">
                                    </div>

                                    <div class="search_input">    
                                        <label for="search">search:</label>
                                        <input type="text" name="search" id="search_design">
                                    </div>
                                </form>
                            </div>

                            <div id="search_result"></div>

                            <div id="normal_output">
                                <div id="table">
                                    <table>
                                        <?php
                                            // query for the interior design table
                                            $query = "SELECT id, house_type, house_site FROM house_info_table";

                                            $select = $conn->query($query);
                                            $result = mysqli_num_rows($select);

                                            if($result > 0){
                                        ?>
                                        <thead>
                                            <tr>
                                                <th scope="col">House Site</th>
                                                <th scope="col">House Type</th>
                                                <th scope="col">House Interior designs</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                                while($rows = mysqli_fetch_assoc($select)){
                                                    $id = $rows["id"];
                                            ?>

                                                <tr>
                                                    <td><?php echo $rows['house_site']?></td>

                                                    <td><?php echo $rows['house_type']?></td>
                                                    
                                                    <!-- pictures outputs -->
                                                    <td class="images">
                                                        <div class="image_view">
                                                        <div class="image_container">
                                                                <?php
                                                                    $table_pics = array("living_room", "dinning_room", "master_bedroom", "bedroom", "cr", "other");
                                                                    foreach($table_pics as $pics){
                                                                        $pic = "{$pics}_pic";
                                                                        $path = "{$pics}_path";

                                                                        $select_pics_query = "SELECT $pic, $path FROM $pics WHERE house_design_id = $id";
                                                                        $table_pics_query = $conn->query($select_pics_query);
                                                                        $table_pics_result = mysqli_num_rows($table_pics_query);
                                                                ?> 

                                                                <div class="image_wrapper">
                                                                    <?php
                                                                        if($table_pics_result > 0){
                                                                            while($table_pic_row = mysqli_fetch_assoc($table_pics_query)){
                                                                                if(isset($table_pic_row[$pic]) && isset($table_pic_row[$path])){
                                                                    ?>
                                                                    
                                                                    <img src="./pictures/<?php echo $table_pic_row[$path]?>" alt="<?php echo "{$pic} of {$rows['house_site']} {$rows['house_type']}"?>" class="image">

                                                                    <?php    
                                                                                }
                                                                            }
                                                                        }
                                                                    ?>
                                                                </div>

                                                                <?php
                                                                    }
                                                                ?>
                                                        </div> 
                                                        </div>
                                                    </td>

                                                    <?php
                                                        $row_id = $rows["id"];

                                                        $check_row = "SELECT living_room_pic, living_room_path FROM living_room 
                                                                      WHERE house_design_id = $row_id 
                                                                      AND living_room_pic IS NOT NULL AND living_room_pic != ''
                                                                      AND living_room_path IS NOT NULL AND living_room_path != ''
                                                                      
                                                                      UNION
                                                                      
                                                                      SELECT dinning_room_pic, dinning_room_path FROM dinning_room 
                                                                      WHERE house_design_id = $row_id
                                                                      AND dinning_room_pic IS NOT NULL AND dinning_room_pic != ''
                                                                      AND dinning_room_path IS NOT NULL AND dinning_room_path != ''
                                                                      
                                                                      UNION 
                                                                      
                                                                      SELECT master_bedroom_pic, master_bedroom_path FROM master_bedroom 
                                                                      WHERE house_design_id = $row_id
                                                                      AND master_bedroom_pic IS NOT NULL AND master_bedroom_pic != ''
                                                                      AND master_bedroom_path IS NOT NULL AND master_bedroom_path != ''
                                                                      
                                                                      UNION 
                                                                      
                                                                      SELECT bedroom_pic, bedroom_path FROM bedroom 
                                                                      WHERE house_design_id = $row_id
                                                                      AND bedroom_pic IS NOT NULL AND bedroom_pic != ''
                                                                      AND bedroom_path IS NOT NULL AND bedroom_path != ''
                                                                      
                                                                      UNION 
                                                                      
                                                                      SELECT cr_pic, cr_path FROM cr 
                                                                      WHERE house_design_id = $row_id
                                                                      AND cr_pic IS NOT NULL AND cr_pic != ''
                                                                      AND cr_path IS NOT NULL AND cr_path != ''
                                                                      
                                                                      UNION 
                                                                      
                                                                      SELECT other_pic, other_path FROM other 
                                                                      WHERE house_design_id = $row_id
                                                                      AND other_pic IS NOT NULL AND other_pic != ''
                                                                      AND other_path IS NOT NULL AND other_path != ''";
                                                        $check_row_query = $conn->query($check_row);
                                                        $check_row_result = mysqli_fetch_assoc($check_row_query);
                                                    ?>
                                                    
                                                    <td>
                                                        <form action="./admin_interior_design_page.php?house_type=<?php echo "{$rows['house_site']} {$rows['house_type']}"?>&id=<?php echo $rows["id"]?>" method="post" class="action_form">
                                                            <?php
                                                                if(mysqli_num_rows($check_row_query) > 0){
                                                            ?>
                                                            
                                                                    <input type="submit" name="submit" value="Add Image" class="add">
                                                                    <input type="submit" name="submit" value="Edit Image" class="edit">
                                                            
                                                            <?php
                                                                }
                                                                else{
                                                            ?>
                                                                
                                                                    <input type="submit" name="submit" value="Add Image" class="add">

                                                            <?php
                                                                }
                                                            ?>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>

                                        <?php
                                            }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // asych search function(ajax)
        var search_design = document.getElementById("search_design");
        var result_table = document.getElementById("search_result");
        var normal_table = document.getElementById("normal_output");

        search_design.addEventListener("input", function(){
            var search = search_design.value.trim();

            if(search !== ""){
                normal_table.style.display = "none";

                var xhr = new XMLHttpRequest();

                xhr.open("POST", "./search_requests/admin_interior_design_search.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("search=" + encodeURIComponent(search));

                xhr.onreadystatechange = function(){
                    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
                        result_table.innerHTML = xhr.responseText;
                    }
                };

            }
            else{
                result_table.innerHTML = search_design.value;
                normal_table.style.display = "block";
            }
        });

        // visibility allert function
        var msg = document.querySelector(".msg");
        var close_msg = document.querySelector(".close_button");
        var allert = document.querySelector(".allert");
            
        close_msg.onclick= function(){
            msg.style.display = "none"; 
            allert.style.display = "none";
        }

        setTimeout(function() {
            msg.style.display = "none";
            allert.style.display = "none"; 
        }, 4000);
    </script>
</body>
</html>
<?php
    if(isset($_POST["submit"])){
        if($_POST["submit"] === "Add Image"){
            include_once "./modals/interior_design_add_design_modal.php";
        }
        else if($_POST["submit"] === "Edit Image"){
            include_once "./modals/interior_design_edit_deisgn_modal.php";
        }
    }

    $conn->close();
?>