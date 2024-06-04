<?php
    include_once "./included_files/connfigure.php";

    $query = "SELECT * FROM `admin_info` WHERE id = 1";
    $select = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($select);

    session_start();

    if(isset($_POST["log_out"])){   // if logout
        session_destroy();
    }
    else if(isset($_POST["submit"])){
        
        $username_input = $_POST["username"];
        $password_input = $_POST["password"];

        if(password_verify($username_input, $row["username"]) && password_verify($password_input, $row["password"])){

            $_SESSION["username"] = $username_input;
            $_SESSION["password"] = $password_input;

            header("location: ./admin_home_page.php?good_msg=Welcome ". $_SESSION["username"]);
        }
        else{
            header("location: ./admin_log_in_form.php?bad_msg=The username/password is incorrect");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link rel="stylesheet" href="design.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background-image: url("./pictures/savanaPic.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
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
            color: white;
        }

        .msg span{
            right: 0;
            padding: 1px;
            margin: 10px;
            font-size: 15px;
            width: 20px;
            height: auto;
            text-align: center;
            border: 1px solid rgba(0, 0, 0, 0.7);
            border-radius: 100%;
            cursor: pointer;
        }

        .msg span:hover{
            transform: scale(1.1);
        }

        #bad_msg{
            background-color: rgba(219, 64, 53, 1);
        }

        #good_msg{
            background-color: rgba(59, 217, 66, 1);
        }

        .wrapper{
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 8;
        }

        .login_box{
            width: 30%;
            height: 65%;
            border: 2px solid rgba(0, 0, 0, 0.5);
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            backdrop-filter: blur(5px);

        }

        .login_header{
            font-weight: bold;
            font-size: 40px;
            margin: 10px;
        }

        form{
            width: 90%;
            height: auto;
        }

        form div{
            margin: 20px;
        }

        div input{
            width: 100%;
            height: 50px;
            font-size: 15px;
            background: transparent;
            color: white;
            padding: 0 20px;
            border: 2px solid rgba(0, 0, 0, 0.7);
            border-radius: 25px;
            outline: none;
        }

        div input:focus{
            background-color: rgba(0, 0, 0, 0.5);
            box-shadow: 0 5px 10px rgba(255, 255, 255, 1),
                0 5px 8px rgba(255, 255, 255, 1),
                0 5px 5px rgba(255, 255, 255, 1);
        }

        div label{
            margin: 10px 0;
            display: block;
            font-size: 17px;
            color: black;
            
        }

        .submit_button{
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }

        .submit_button input{
            width: 60%;
            height: auto;
            padding: 10px;
        }

        .submit_button a{
            color: white;
            text-decoration: none;
            margin: 5px;
        }

        .submit_button a:hover{
            font-weight: bolder;
        }

        .login{
            cursor: pointer;
        }

        .login:hover{
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
        }

    </style>
</head>
<body>
    <div class="allert">
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
        ?>
    </div>

    <div class="wrapper">
        
        <div class="login_box">
            <div class="login_header">
                <span>Login</span>
            </div>

            <form action="./admin_log_in_form.php" method="post">
                <div class="username">
                    <label for="userame">Enter a Username:</label>
                    <input type="text" name="username" required>
                </div>

                <div class="password">
                    <label for="password">Enter a Password:</label>
                    <input type="password" name="password" required>
                </div>

                <div class="submit_button">
                    <input type="submit" name="submit" value="Log In" class="login">
                    <a href="#">forget password?</a>
                </div>

            </form>
        </div>
    </div>

    <script>
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
        }, 5000);

    </script>
</body>
</html>