<?php
    require_once "./included_files/connfigure.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../design.css">

    <style>
        /* modal design */
        .modal{
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: fixed;
            overflow: hidden;
            justify-content: center;
            align-items: center;
            z-index: 1;
            background-color: rgba(0, 0, 0,0.5);
            display: flex;
        }

        .notice_wrapper{
            width: fit-content;
            height: 80px;
            font-size: 15px;
            font-weight: bold;
            display: none;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin: 10px 0;
            z-index: 4;
            color: white;
            position: absolute;
            top: 0;
            right: 50%;
            transform: translateX(50%);
            background-color: rgba(219, 64, 53, 1);
        }

        .notice{
            padding: 0 20px;
            color: rgba(252, 252, 252, 1);
        }

        .close_notice_button{
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

        .modal_wrapper{
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .modal_content{
            position: relative;
            width: 50%;
            height: fit-content;
            overflow-y: scroll;
            background-color: white;
            border-radius: 5px;
        }

        .modal_header{
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 25px 20px;
            justify-content: space-between;
            color: rgba(0, 0, 0, 0.8);
            border-bottom: 1px solid rgba(0, 0, 0, 0.3);
        }

        .modal_content h1{
            font-size: 25px;
            text-align: center;
        }

        .close_container{
            display: flex;
            flex-direction: column;
            align-items: end;
        }

        .close{
            right: 0;
            padding: 3px;
            font-size: 14px;
            font-weight: bold;
            width: 17px;
            height: auto;
            text-align: center;
            border: 1px solid rgba(0, 0, 0, 1);
            border-radius: 50%;
            cursor: pointer;
            transition: box-shadow 0.1s linear;
        }

        .close:hover{
            box-shadow: 0 0 10px rgba(255, 17, 0, 1),
                0 0 15px rgba(255, 46, 31, 1),
                0 0 20px rgba(255, 84, 71, 1);
        }

        /* form design */
        .forms{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .forms form{
            width: 100%;
        }

        .forms form .inputs{
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 20px;
        }

        .inputs div{
            width: 100%;
            margin: 20px 0;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        
        .forms div label{
            display: block;
            color: rgba(0, 0, 0, 0.7);
            font-size: 18px;
        }

        .forms div input{
            width: 300px;
            height: 10%;
            font-size: 15px;
            color: rgba(0, 0, 0, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.2);
            letter-spacing: 0.7px;
            padding: 10px;
            border-radius: 3px;
        }

        .forms div input:focus{
            box-shadow: 0 0 8px rgba(0, 115, 255, 1),
                0 0 6px rgba(89, 164, 255, 1);
        }

        /* buttons design */
        .add_houses_cancel{
            width: 100%;
            height: 80px;
            margin-top: 30px;
            display: flex;
            justify-content: end;
            align-items: center;
            border-top: 1px solid rgba(0, 0, 0, 0.3);
        }

        .add_houses_cancel a, .forms .add_houses_cancel input{
            text-decoration: none;
            color: white;
            margin: 20px 10px;
            padding: 10px 15px;
            border: none;
            border-radius: 10px;
            width: auto;
            height: auto;
        }

        .disable{
            background: rgba(158, 148, 255, 1);
            cursor: not-allowed;
        }

        .delete{
            cursor: pointer;
            background: rgba(255, 52, 52, 1);
            transition: transform 0.1s linear, 
                box-shadow 0.1s linear;
        }

        .enable{
            background: rgba(94, 77, 255, 1);
            transition: transform 0.1s linear, 
                box-shadow 0.1s linear;
        }

        .delete:hover, .enable:hover{
            transform: translateY(-5px);
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.7);
        }

    </style>
</head>
<body>
    <!-- modal form for add info -->
    <div class="modal">
        <div class="warning">
            <div class="notice_wrapper">
                <p class="notice">the password confirmation is wrong</p>
                <span class="close_notice_button">&times;</span>
            </div>
        </div>

        <div class="modal_wrapper">
            <div class="modal_content"> 
                <div class="modal_header">
                    <h1>Change Username</h1>

                    <div class="close_container">
                        <span class="close">&times;</span>
                    </div>
                </div>

                <div class="forms">
                    <form action="./cruds_functions/admin_info_crud.php" method="post">
                        <div class="inputs">
                            <div>
                                <label for="old_username">Old Username:</label>
                                <input type="text" name="old_username" autocomplete="off">
                            </div>

                            <div>
                                <label for="new_username">New Username:</label>
                                <input type="text" name="new_username" autocomplete="off" id="new_username_input">
                            </div>

                            <div>
                                <label for="confirm_username">Confirm New Username:</label>
                                <input type="text" name="confirm_username" autocomplete="off" id="confirm_new_username_input"> 
                            </div>
                        </div>

                        <div class="add_houses_cancel">
                            <input type="submit" name="submit" class="disable" value="Edit Username">
                            <a class="delete">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // close modal function
        var modal = document.querySelector('.modal');
        var also_modal = document.querySelector('.modal_wrapper');
        var close_modal = document.querySelector('.close');
        var cancel = document.querySelector('.delete');

        close_modal.onclick = function(){
            modal.style.display = "none";
        }

        cancel.onclick = function(){
            modal.style.display = "none";
        }


        window.addEventListener('click', function(event){
            if(event.target == modal){
                modal.style.display = 'none';
            }

            if(event.target == also_modal){
                modal.style.display = 'none';
            }
        });

        // notice function
        var warning = document.querySelector(".warning");
        var close_notice_button = document.querySelector(".close_notice_button");
            
        close_notice_button.onclick= function(){
            warning.style.display = "none";
        }

        setTimeout(function() {
            warning.style.display = "none";
        }, 4000);

        // new username verification
        var edit_username_button = document.querySelector("div input[value='Edit Username']");
        var new_username_value = document.getElementById("new_username_input");
        var confirm_username_value = document.getElementById("confirm_new_username_input");
        
        function check_similarities(){
            if(this.value.trim() !== ""){
                if(new_username_value.value === confirm_username_value.value){
                    edit_username_button.classList.remove("disable");
                    edit_username_button.classList.add("enable");
                }
                else{
                    edit_username_button.classList.remove("enable");
                    edit_username_button.classList.add("disable");
                }
            }
            else{
                edit_username_button.classList.remove("enable");
                edit_username_button.classList.add("disable");
            }
        }

        new_username_value.addEventListener("input", check_similarities);
        confirm_username_value.addEventListener("input", check_similarities);

    </script>
</body>
</html> 