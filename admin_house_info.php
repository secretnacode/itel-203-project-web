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
    <title>House Information</title>
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

        /* status design */
        .status{
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
        }

        .stat{
            width: 20%;
            height: 100px;
            border: 1px solid black;
            border-radius: 10px;
            margin: 20px;
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

        .add_delete{
            display: flex;
            align-items: center;
        }

        .add_delete form input{
            text-decoration: none;
            margin: 20px 15px 20px 0;
            padding: 12px 15px;
            border: none;
            border-radius: 10px;
            color: white;
        }

        .delete{
            background: rgba(255, 52, 52, 1);
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

        .delete:hover, .add:hover, .picture_input:hover{
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
            padding: 20px;
            margin-top: 15px;
        }

        table{
            border-collapse: collapse;
            width: 100%;
            background-color: white;;
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
        
        td{
            padding: 20px 8px;
            font-size: 15px;
            border: 1px solid rgba(0, 0, 0, 0.2);
        }

        th:nth-of-type(1){
            width: 5%;
            text-transform: capitalize;
        }

        th:nth-of-type(2){
            width: 20%;
            word-wrap: break-word;
            text-transform: capitalize;
        }

        th:nth-of-type(3){
            width: 10%;
            word-wrap: break-word;
        }

        th:nth-of-type(4){
            width: 15%;
            word-wrap: break-word;
        }

        th:nth-of-type(5){
            width: 10%;
            word-wrap: break-word;
        }

        th:nth-of-type(6){
            width: 5%;
        }

        th:nth-of-type(7){
            width: 10%;
        }
        
        th:nth-of-type(8){
            width: 20%;
        }

        tbody tr:nth-of-type(even){
            background-color: rgba(242, 242, 242, 1);
        }

        tbody tr:nth-of-type(odd){
            background-color: rgba(250, 250, 250, 1);
        } 
        
        tbody tr:hover{
            background-color: rgba(233, 233, 233, 1);
            
        }

        .picture_input{
            max-width: 100px;
            cursor: pointer;
            padding: 8px 5px;
            background: rgba(3, 173, 40, 1);
            border: none;
            color: white;
            border-radius: 5px;
            transition: transform 0.1s linear, 
                box-shadow 0.1s linear;
        }

        td:nth-of-type(1),
        td:nth-of-type(n+6),
        th:nth-of-type(1),
        th:nth-of-type(n+6){
            text-align: center;
        }

        .action_form input{
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 12px;
        }

        .no_data{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 20px;
        }

        .no_data .main_alert{
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .no_data .main_alert svg{
            height: 30px;
            width: 30px;
            margin: 0 10px;
        }

        .no_data .main_alert p{
            font-weight: bolder;
            font-size: 30px;
        }

        .no_data h2{
            margin-top: 20px;
        }

    </style>
</head>
<body>

    <!-- table contents -->
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
                            <h1>Houses Info</h1>
                            
                            <div class="add_delete">
                                <form action="./admin_house_info.php" method="post">
                                    <!-- <input type="submit" name="submit" class="delete" value="Delete Houses"> -->
                                    <input type="submit" name="submit" class="add" value="Add House">
                                </form>
                            </div>
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
                                        <input type="text" id="search_house_input">
                                    </div>
                                </form>
                            </div>

                            <div id="search_result"></div>

                            <div id="normal_table">
                                <table>
                                    <!-- query for selecting all the data in the house_info_table in database -->
                                    <?php
                                        $query = " SELECT * FROM `house_info_table` WHERE 1";
                                        $select = mysqli_query($conn, $query);
                                        $results = mysqli_num_rows($select);

                                        if($results > 0){
                                    ?>
                                    <thead>
                                        <tr>
                                            <th scope=col></th>
                                            <th scope=col>House type</th>
                                            <th scope=col>House Site</th>
                                            <th scope=col>House Price</th>
                                            <th scope=col>Monthly Price</th>
                                            <th scope=col>Floor Area</th>
                                            <th scope=col>House Picture</th>
                                            <th scope=col colspan="2">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                            while($row = mysqli_fetch_assoc($select)){
                                        ?>

                                        <tr>
                                            <td>
                                                <form action="">
                                                    <input type="checkbox">
                                                </form>
                                            </td>

                                            <td><?php echo $row["house_type"]?></td>

                                            <td><?php echo $row["house_site"]?></td>

                                            <td><?php echo "₱" . $row["house_price"]?></td>

                                            <td><?php echo "₱" . $row["monthly_price"]?></td>

                                            <td><?php echo $row["house_num"]?> sqm</td>

                                            <td>
                                                <form action="./admin_house_info.php?id=<?php echo $row["id"]?>" method="post">
                                                    <input type="submit" name="submit" value="<?php echo $row["picture_name"]?>" class="picture_input">
                                                </form>
                                            </td>

                                            <td class="action_form">
                                                <form action="./admin_house_info.php?id=<?php echo $row["id"]?>" method="post">
                                                    <input type="submit" name="submit" value="Edit House" class="add"> 
                                                    <input type="submit" name="submit" value="Delete House" class="delete">
                                                </form>
                                            </td>
                                        </tr>

                                        <?php
                                                }
                                            }
                                        ?>

                                    </tbody>

                                    <?php
                                        if($results == 0){
                                    ?>
                                    
                                    <div class="no_data">
                                        <div class="main_alert">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><circle cx="8.5" cy="10.5" r="1.5"></circle><circle cx="15.493" cy="10.493" r="1.493"></circle><path d="M12 14c-3 0-4 3-4 3h8s-1-3-4-3z"></path></svg>

                                                <p>CURRENTLY NO DATA INSERTED</p>

                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><circle cx="8.5" cy="10.5" r="1.5"></circle><circle cx="15.493" cy="10.493" r="1.493"></circle><path d="M12 14c-3 0-4 3-4 3h8s-1-3-4-3z"></path></svg>
                                        </div>

                                        <h2>INSERT A DATA ABOUT THE HOUSE</h2>
                                    </div>

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

    <script>
        // async search functionality(ajax)
        var search_house_input = document.getElementById("search_house_input");
        var result_div = document.getElementById("search_result");
        var normal_output = document.getElementById("normal_table");

        search_house_input.addEventListener("input", function(){
            var search = search_house_input.value.trim();

            if(search !== ""){
                normal_output.style.display = "none"

                var xhr = new XMLHttpRequest();

                xhr.open("POST", "./search_requests/admin_house_info_search.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("search=" + encodeURIComponent(search));

                xhr.onreadystatechange = function(){
                    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
                        result_div.innerHTML = xhr.responseText;
                    }
                };
            }
            else{
                result_div.innerHTML = search_house_input.value;
                normal_output.style.display = "block"
            }
        });

        // allert/msg function
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
    // for modal file
    if(isset($_POST["submit"])){
        if(!filter_input(INPUT_POST, "house_num", FILTER_VALIDATE_INT)){
            if($_POST["submit"] == "Add House"){
                require_once "./modals/house_info_add_modal.php";
            }
            elseif($_POST["submit"] == "Edit House"){
                require_once "./modals/house_info_edit_modal.php";
            }
            else if($_POST["submit"] == "Delete House"){
                require_once "./modals/house_info_delete_modal.php";
            }
            else if($_POST["submit"] == $_POST["submit"]){
                require_once "./modals/house_info_picture_modal.php";
            }
            
        }
        else{
            header('location: ../admin_house_info.php?bad_msg=The house number is not valid');
        }
    }

    $conn->close();
?>