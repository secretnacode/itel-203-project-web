<?php
    include "./included_files/connfigure.php";

    // checking if you already logged in, if not youll go back to log in page
    session_start();
    if(empty($_SESSION["username"]) && empty($_SESSION["password"])){
        header("location: ./admin_log_in_form.php?bad_msg=You need to log in FIRST!!");
    }

    function contact_val($contact){
        include "./included_files/connfigure.php";

        $query_values = "SELECT contact_value FROM admin_contact WHERE contact = '$contact'";
        $select_query = $conn->query($query_values);
        $row_values = mysqli_fetch_assoc($select_query);

        $conn->close();
        return $row_values["contact_value"];
    }

    function admin_info($val){
        include "./included_files/connfigure.php";

        $query_values = "SELECT admin_info_values FROM admin_need_info WHERE admin_info = '$val'";
        $select_query = $conn->query($query_values);
        $row_values = mysqli_fetch_assoc($select_query);

        return $row_values["admin_info_values"];
    }
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="design.css">
    <title>Contact Page</title>

    <style>
        .content{
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: end;
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

        .values{
            width: 84%;
            margin-top: 25px;
            display: flex;
            flex-direction: row;
            justify-content: start;
        }

        .admin_contact_info{
            width: 30%;
            margin-left: 20px;
            height: fit-content;
            position: sticky;
            top: 25px;
        }
        
        .admin_picture{
            width: 100%;
            display: flex;
            padding-bottom: 10px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            border-radius: 3px;
            background-color: white;
            margin-bottom: 25px;
        }

        .image_wrapper{
            position: relative;
            height: 200px;
            width: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 40px;
            border: 1px solid black;
            border-radius: 50%;
            overflow: hidden;
        }

        .admin_picture img{
            width: 100%;
            position: absolute;
        }

        .change_pass{
            width: 100%;
            display: flex;
            position: relative;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .change_pass_button, .change_button{
            padding: 12px 15px;
            border: none;
            border-radius: 10px;
            color: white;
            transition: transform 0.1s linear, 
                box-shadow 0.1s linear;
            cursor: pointer;
        }

        .change_button{
            background-color: rgba(13, 212, 52, 1);
        }

        .change_pass label{
            position: absolute;
            top: -60%;
            font-size: 17px;
        }

        .change_pass label span{
            color: rgba(0, 0, 0, 0.7);
        }

        .change_pass:hover .change_input_forms{
            display: flex;
        }

        .change_pass:hover .change_pass_button{
            opacity: 0;
        }

        .change_pass_button{
            background: rgba(28, 214, 65, 1);
            transition: opacity 0.2s ease-out;
        }

        #change_username_button, #change_password_button{
            position: relative;
            animation-duration: 0.3s;
            animation-timing-function: linear;
            transition: transform 0.2s linear;
        }

        #change_username_button{
            animation-name: username;
            z-index: 0;
        }

        #change_password_button{
            animation-name: password;
            z-index: 0;
        }

        @keyframes username{
            from{
                transform: translateX(50%);
            }
            to{
                transform: translateX(0);
            }
        }

        @keyframes password{
            from{
                transform: translateX(-50%);
            }
            to{
                transform: translateX(0);
            }
        }

        .change_input_forms{
            position: absolute;
            padding: 20px;
            display: none;
            flex-direction: row;
            gap: 10px;
        }

        .contacts{
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            border-radius: 3px;
            background-color: white;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        .contacts table tr:not(:last-of-type){
            border-bottom: 1px solid rgba(0, 0, 0, 0.7);
        }

        .contacts table td{
            padding: 8px;
        }

        .contacts table td:first-of-type{
            text-align: center;
            width: 15%;
        }

        .contacts table td:last-of-type{
            text-align: right;
            color: rgba(0, 0, 0, 0.6);
            font-size: 15px;
            padding-right: 10px;
        }

        .contacts table td svg{
            width: 28px;
            height: 28px;
        }

        .admin_account{
            width: 80%;
            padding: 0 30px;
        }

        .information{
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            border-radius: 3px;
            background-color: white;
            padding: 15px;
        }

        .information table{
            border-collapse: collapse;
        }

        .information td{   
            border-bottom: 1px solid rgba(0, 0, 0, 0.2);
            padding: 10px;
            font-size: 18px;
        }

        .information td:first-of-type{
            width: 30%;
        }

        .information td:last-of-type{
            color: rgba(0, 0, 0, 0.6);
        }
        
        .button{
            width: 100%;
        }

        .edit_button{
            margin-top: 20px;
            padding: 12px 15px;
            border: none;
            border-radius: 10px;
            color: white;
            transition: transform 0.1s linear, 
                box-shadow 0.1s linear;
            cursor: pointer;
        }

        .edit_button{
            background: rgba(94, 77, 255, 1);
        }

        .edit_button:hover{
            transform: translateY(-5px);
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.7);
        }

        .users_messages{
            border: 1px solid black;
            margin-top: 30px;
            border-radius: 10px;
        }

        .header{
            height: 60px;
            background-color: rgba(0, 0, 0, 0.7);
            border-bottom: 1px solid black;
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
            display: flex;
            flex-direction: row;
            justify-content: start;
            align-items: center;
        }

        .header h1{
            padding: 10px 15px;
            font-size: 23px;
            justify-content: center;
            color: white;
        }

        .table_search_input{
            display: flex;
            flex-direction: row;
            justify-content: end;
            align-items: center;
            padding: 10px 10px 0 10px;
        }

        .search_input input{
            display: flex;
            justify-content: end;
            align-items: end;
            height: 20px;
            font-size: 15px;
            padding: 3px;
            border-radius: 8px;
            border: 1.5px solid rgba(0, 0, 0, 0.7);
        }

        .search_input input:focus{
            box-shadow: 0 0 8px rgba(0, 115, 255, 1),
                0 0 6px rgba(89, 164, 255, 1);
        }

        .table{
            padding: 20px;
        }

        .table table{
            border-collapse: collapse;
        }

        .table th, .table td{
            text-align: left;
        } 

        .table th{
            padding: 0 8px;
            font-size: 18px;
            letter-spacing: 0.5px;
            border-bottom: 3px solid rgba(0, 0, 0, 0.7);
        }
        
        .table td{
            padding: 20px 8px;
            font-size: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.2);
        }   

        .table th:nth-of-type(1){
            width: 20%;
            text-transform: capitalize;
            text-align: center;
        }

        .table td:nth-of-type(1){
            width: 20%;
            text-align: center;
        }

        .table th:nth-of-type(2){
            width: 20%;
            word-wrap: break-word;
            text-transform: capitalize;
        }

        .table th:nth-of-type(3){
            width: 20%;
            word-wrap: break-word;
        }

        .table th:nth-of-type(4){
            width: 40%;
            word-wrap: break-word;
        }

        .table tbody tr:nth-of-type(even){
            background-color: rgba(242, 242, 242, 1);
        }

        .table tbody tr:nth-of-type(odd){
            background-color: rgba(250, 250, 250, 1);
        } 
        
        .table tbody tr:hover{
            background-color: rgba(233, 233, 233, 1);
            
        }

        .table tbody tr td{
            border: 1px solid rgba(0, 0, 0, 0.2);
        }

        
    </style>
</head>
<body>

    <!-- navigation bar -->
    <div>
        <?php require_once "./included_files/admin_navigation_bar.php"?>
    </div>

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
        
        <div class="values">
            <div class="admin_contact_info">
                <div class="admin_picture">
                    <?php
                        $query_pic = "SELECT admin_info_values FROM admin_need_info WHERE admin_info = 'picture'";
                        $select_query = $conn->query($query_pic);
                        $row_pic = mysqli_fetch_assoc($select_query);
                    ?>

                    <div class="image_wrapper">
                        <img src="./pictures/<?php echo $row_pic['admin_info_values']?>" alt="admin picture">
                    </div>

                    <?php
                        $query_pic = "SELECT admin_info_values FROM admin_need_info WHERE admin_info ='nickname'";
                        $select_query = $conn->query($query_pic);
                        $row_nickname = mysqli_fetch_assoc($select_query);
                    ?>

                    <div class="change_pass">
                        <label for="Change Pass/Username">Admin: <span><?php echo $row_nickname['admin_info_values']?></span></label>
                        <p class="change_pass_button" id="button_change">Change Pass/Username</p>

                        <form action="./admin_info.php" method="post" class="change_input_forms" id="buttons_input">
                            <input type="submit" name="submit" value="Change Username" class="change_button" id="change_username_button">
                            <input type="submit" name="submit" value="Change Password" class="change_button" id="change_password_button">
                        </form>
                    </div>
                </div>

                <div class="contacts">
                    <table>
                        <tr class="facebook">
                            <td>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: blue;"><path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z"></path></svg>                            
                            </td>

                            <td><?php echo contact_val("facebook")?></td>
                        </tr>

                        <tr class="instagram">
                            <td>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: red;"><path d="M11.999 7.377a4.623 4.623 0 1 0 0 9.248 4.623 4.623 0 0 0 0-9.248zm0 7.627a3.004 3.004 0 1 1 0-6.008 3.004 3.004 0 0 1 0 6.008z"></path><circle cx="16.806" cy="7.207" r="1.078"></circle><path d="M20.533 6.111A4.605 4.605 0 0 0 17.9 3.479a6.606 6.606 0 0 0-2.186-.42c-.963-.042-1.268-.054-3.71-.054s-2.755 0-3.71.054a6.554 6.554 0 0 0-2.184.42 4.6 4.6 0 0 0-2.633 2.632 6.585 6.585 0 0 0-.419 2.186c-.043.962-.056 1.267-.056 3.71 0 2.442 0 2.753.056 3.71.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.042 1.268.055 3.71.055s2.755 0 3.71-.055a6.615 6.615 0 0 0 2.186-.419 4.613 4.613 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.186.043-.962.056-1.267.056-3.71s0-2.753-.056-3.71a6.581 6.581 0 0 0-.421-2.217zm-1.218 9.532a5.043 5.043 0 0 1-.311 1.688 2.987 2.987 0 0 1-1.712 1.711 4.985 4.985 0 0 1-1.67.311c-.95.044-1.218.055-3.654.055-2.438 0-2.687 0-3.655-.055a4.96 4.96 0 0 1-1.669-.311 2.985 2.985 0 0 1-1.719-1.711 5.08 5.08 0 0 1-.311-1.669c-.043-.95-.053-1.218-.053-3.654 0-2.437 0-2.686.053-3.655a5.038 5.038 0 0 1 .311-1.687c.305-.789.93-1.41 1.719-1.712a5.01 5.01 0 0 1 1.669-.311c.951-.043 1.218-.055 3.655-.055s2.687 0 3.654.055a4.96 4.96 0 0 1 1.67.311 2.991 2.991 0 0 1 1.712 1.712 5.08 5.08 0 0 1 .311 1.669c.043.951.054 1.218.054 3.655 0 2.436 0 2.698-.043 3.654h-.011z"></path></svg>
                            </td>

                            <td><?php echo contact_val("instagram")?></td>
                        </tr>

                        <tr class="twitter">
                            <td>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"><path d="M 6 4 C 4.895 4 4 4.895 4 6 L 4 24 C 4 25.105 4.895 26 6 26 L 24 26 C 25.105 26 26 25.105 26 24 L 26 6 C 26 4.895 25.105 4 24 4 L 6 4 z M 8.6484375 9 L 13.259766 9 L 15.951172 12.847656 L 19.28125 9 L 20.732422 9 L 16.603516 13.78125 L 21.654297 21 L 17.042969 21 L 14.056641 16.730469 L 10.369141 21 L 8.8945312 21 L 13.400391 15.794922 L 8.6484375 9 z M 10.878906 10.183594 L 17.632812 19.810547 L 19.421875 19.810547 L 12.666016 10.183594 L 10.878906 10.183594 z"></path></svg>                            
                            </td>

                            <td><?php echo contact_val("twitter")?></td>
                        </tr>

                        <tr class="tiktok">
                            <td>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path fill="#212121" fill-rule="evenodd" d="M10.904,6h26.191C39.804,6,42,8.196,42,10.904v26.191 C42,39.804,39.804,42,37.096,42H10.904C8.196,42,6,39.804,6,37.096V10.904C6,8.196,8.196,6,10.904,6z" clip-rule="evenodd"></path><path fill="#ec407a" fill-rule="evenodd" d="M29.208,20.607c1.576,1.126,3.507,1.788,5.592,1.788v-4.011 c-0.395,0-0.788-0.041-1.174-0.123v3.157c-2.085,0-4.015-0.663-5.592-1.788v8.184c0,4.094-3.321,7.413-7.417,7.413 c-1.528,0-2.949-0.462-4.129-1.254c1.347,1.376,3.225,2.23,5.303,2.23c4.096,0,7.417-3.319,7.417-7.413L29.208,20.607L29.208,20.607 z M30.657,16.561c-0.805-0.879-1.334-2.016-1.449-3.273v-0.516h-1.113C28.375,14.369,29.331,15.734,30.657,16.561L30.657,16.561z M19.079,30.832c-0.45-0.59-0.693-1.311-0.692-2.053c0-1.873,1.519-3.391,3.393-3.391c0.349,0,0.696,0.053,1.029,0.159v-4.1 c-0.389-0.053-0.781-0.076-1.174-0.068v3.191c-0.333-0.106-0.68-0.159-1.03-0.159c-1.874,0-3.393,1.518-3.393,3.391 C17.213,29.127,17.972,30.274,19.079,30.832z" clip-rule="evenodd"></path><path fill="#fff" fill-rule="evenodd" d="M28.034,19.63c1.576,1.126,3.507,1.788,5.592,1.788v-3.157 c-1.164-0.248-2.194-0.856-2.969-1.701c-1.326-0.827-2.281-2.191-2.561-3.788h-2.923v16.018c-0.007,1.867-1.523,3.379-3.393,3.379 c-1.102,0-2.081-0.525-2.701-1.338c-1.107-0.558-1.866-1.705-1.866-3.029c0-1.873,1.519-3.391,3.393-3.391 c0.359,0,0.705,0.056,1.03,0.159V21.38c-4.024,0.083-7.26,3.369-7.26,7.411c0,2.018,0.806,3.847,2.114,5.183 c1.18,0.792,2.601,1.254,4.129,1.254c4.096,0,7.417-3.319,7.417-7.413L28.034,19.63L28.034,19.63z" clip-rule="evenodd"></path><path fill="#81d4fa" fill-rule="evenodd" d="M33.626,18.262v-0.854c-1.05,0.002-2.078-0.292-2.969-0.848 C31.445,17.423,32.483,18.018,33.626,18.262z M28.095,12.772c-0.027-0.153-0.047-0.306-0.061-0.461v-0.516h-4.036v16.019 c-0.006,1.867-1.523,3.379-3.393,3.379c-0.549,0-1.067-0.13-1.526-0.362c0.62,0.813,1.599,1.338,2.701,1.338 c1.87,0,3.386-1.512,3.393-3.379V12.772H28.095z M21.635,21.38v-0.909c-0.337-0.046-0.677-0.069-1.018-0.069 c-4.097,0-7.417,3.319-7.417,7.413c0,2.567,1.305,4.829,3.288,6.159c-1.308-1.336-2.114-3.165-2.114-5.183 C14.374,24.749,17.611,21.463,21.635,21.38z" clip-rule="evenodd"></path></svg>
                            </td>

                            <td><?php echo contact_val("tiktok")?></td>
                        </tr>

                        <tr class="location">
                            <td>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: green;"><circle cx="12" cy="12" r="4"></circle><path d="M13 4.069V2h-2v2.069A8.01 8.01 0 0 0 4.069 11H2v2h2.069A8.008 8.008 0 0 0 11 19.931V22h2v-2.069A8.007 8.007 0 0 0 19.931 13H22v-2h-2.069A8.008 8.008 0 0 0 13 4.069zM12 18c-3.309 0-6-2.691-6-6s2.691-6 6-6 6 2.691 6 6-2.691 6-6 6z"></path></svg>
                            </td>

                            <td><?php echo contact_val("location")?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="admin_account">
                <div class="information">
                    <table>
                        <tr class="full_name">
                            <td>Full Name:</td>
                            <td><?php echo admin_info("fullname")?></td>
                        </tr>

                        <tr class="nick_name">
                            <td>Nick Name:</td>
                            <td><?php echo admin_info("nickname")?></td>
                        </tr>

                        <tr class="gmail">
                            <td>Gmail:</td>
                            <td><?php echo admin_info("gmail")?></td>
                        </tr>

                        <tr class="mobile">
                            <td>Phone:</td>
                            <td><?php echo admin_info("phone")?></td>
                        </tr>

                        <tr class="telephone">
                            <td>Telephone:</td>
                            <td><?php echo admin_info("telephone")?></td>
                        </tr>
                    </table>
                    
                    <div class="button">
                        <form action="./admin_info.php" method="post">
                            <input type="submit" name="submit" value="Edit Info" class="edit_button">
                        </form>
                    </div>
                </div>

                <div class="users_messages">
                     <div class="header">
                        <h1>User's Messages</h1>
                     </div>

                     <div class="table_content">
                        <div class="table_search_input">

                            <div class="search_input">
                                <label for="">search:</label>
                                <input type="text" name="search" id="search_user_message">
                            </div>
                        </div>

                        <div id="search_result"></div>

                        <div id="normal_output">
                            <div class="table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Interest</th>
                                            <th>User Name</th>
                                            <th>User Contact</th>
                                            <th>User Message</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                            $query_message = "SELECT user_name, user_contact, user_message_to_admin, interest FROM user_message WHERE 1";
                                            $select_messages = $conn->query($query_message);

                                            if(mysqli_num_rows($select_messages) >0){
                                                while($messages = mysqli_fetch_assoc($select_messages)){
                                                
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php
                                                        if(empty($messages["interest"])){
                                                            echo "N/A";
                                                        }
                                                        else{
                                                            echo $messages["interest"];
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo $messages["user_name"]?></td>
                                                <td><?php echo $messages["user_contact"]?></td>
                                                <td><?php echo $messages["user_message_to_admin"]?></td>
                                            </tr>


                                        <?php  
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // asych search function(ajax)
        var search_user_message = document.getElementById("search_user_message");
        var result_div = document.getElementById("search_result");
        var normal_output = document.getElementById("normal_output");

        search_user_message.addEventListener("input", function(){
            var search = search_user_message.value.trim();

            if(search !== ""){
                normal_output.style.display = "none";

                var xhr = new XMLHttpRequest();

                xhr.open("POST", "./search_requests/admin_info_user_message_search_request.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("search=" + encodeURIComponent(search));

                xhr.onreadystatechange = function(){
                    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
                        result_div.innerHTML = xhr.responseText;
                    }
                };
            }
            else{
                result_div.innerHTML = search_user_message.value;
                normal_output.style.display = "block"
            }
        });
        
        // close notification message
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

        if($_POST["submit"] == "Edit Info"){
            require_once "./modals/admin_info_edit_modal.php";
        }
        else if($_POST["submit"] == "Change Username"){
            require_once "./modals/admin_change_username_modal.php";
        }
        else if($_POST["submit"] == "Change Password"){
            require_once "./modals/admin_change_pass_modal.php";
        }
    }

    $conn->close();
?>