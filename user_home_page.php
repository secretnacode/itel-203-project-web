<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./design.css">

    <style>

        /* message style */
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
            z-index: 11;
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
    </style>

</head>
<body>
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

    <!-- included admin navbar in admin house page -->
    <?php include("./included_files/user_homes_navbar.php")?>


    <!-- sliding images for the back ground in landing page -->
    <?php include("./included_files/home_page_bgslidding.php")?>
    
    <!-- main content of the web page -->
    <?php include("./included_files/homes.php")?> 

    <script>
        // nav bar visibility function
        window.addEventListener("scroll", function(){
            var navbar = document.getElementById("header");
             
            if(window.scrollY > 300){
                navbar.classList.add("scrolled");
            }
            else{
                navbar.classList.remove("scrolled");
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