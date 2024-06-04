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

        .modal_wrapper{
            width: 90%;
            height: 100%;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .modal_content{
            position: relative;
            width: 37%;
            height: 80%;
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

        .forms{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .forms form{
            width: 100%;
        }

        .forms form .inputs{
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .inputs div{
            width: 80%;
            margin-top: 40px;
        }

        .forms div label{
            display: block;
            margin-bottom: 15px;
            color: rgba(0, 0, 0, 0.7);
            font-size: 18px;
        }

        .forms div input{
            width: 100%;
            height: 20%;
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

        #description_textarea{
            width: 100%;
            height: 20%;
            resize: none;
            padding: 10px;
            color: rgba(0, 0, 0, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.2);
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

        .add_houses_cancel a, .forms .add_houses_cancel input.add{
            text-decoration: none;
            color: white;
            margin: 20px 10px;
            padding: 10px 15px;
            border: none;
            border-radius: 10px;
            width: auto;
            height: auto;
        }

        .delete{
            background: rgba(255, 52, 52, 1);
            transition: transform 0.1s linear, 
                box-shadow 0.1s linear;
        }

        .add{
            background: rgba(94, 77, 255, 1);
            transition: transform 0.1s linear, 
                box-shadow 0.1s linear;
        }

        .delete:hover, .add:hover{
            transform: translateY(-5px);
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.7);
        }

    </style>
</head>
<body>
    <!-- modal form for add info -->
    <div class="modal">
        <div class="modal_wrapper">
            <div class="modal_content"> 
                <div class="modal_header">
                    <h1>Edit Contacts</h1>

                    <div class="close_container">
                        <span class="close">&times;</span>
                    </div>
                </div>

                <div class="forms">
                    <form action="./cruds_functions/admin_info_crud.php" method="post" enctype="multipart/form-data">
                        <div class="inputs">
                            <div class="fb">
                                <label for="admin_fb">Facebook:</label>
                                <input type="text" name="admin_fb" placeholder="Facebook" value="<?php  echo contact_val("facebook")?>">
                            </div>
                            
                            <div class="insta">
                                <label for="admin_insta">Instagram:</label>
                                <input type="text" name="admin_insta" placeholder="Instagram" value="<?php  echo contact_val("instagram")?>">
                            </div>
                            
                            <div class="twitter">
                                <label for="admin_tweeter">Twitter:</label>
                                <input type="text" name="admin_tweeter" placeholder="Twitter" value="<?php  echo contact_val("twitter")?>">
                            </div>
                            
                            <div class="tiktok">
                                <label for="admin_tiktok">TikTok:</label>
                                <input type="text" name="admin_tiktok" placeholder="TikTok" value="<?php  echo contact_val("tiktok")?>">
                            </div>
                            
                            <div class="location">
                                <label for="admin_location">Location:</label>
                                <input type="text" name="admin_location" placeholder="Location" value="<?php  echo contact_val("location")?>">
                            </div>
                            
                            <div class="fullname">
                                <label for="admin_fullname">Full Name:</label>
                                <input type="text" name="admin_fullname" placeholder="Full Name" value="<?php echo admin_info("fullname")?>">
                            </div>
                            
                            <div class="nickname">
                                <label for="admin_nickname">Nick Name:</label>
                                <input type="text" name="admin_nickname" placeholder="Nick Name" value="<?php echo admin_info("nickname")?>">
                            </div>
                            
                            <div class="gmail">
                                <label for="admin_gmail">Gmail:</label>
                                <input type="text" name="admin_gmail" placeholder="Gmail" value="<?php echo admin_info("gmail")?>">
                            </div>
                            
                            <div class="phone">
                                <label for="admin_phone">Phone:</label>
                                <input type="text" name="admin_phone" placeholder="Phone" value="<?php echo admin_info("phone")?>">
                            </div>
                            
                            <div class="telephone">
                                <label for="admin_telephone">Telephone:</label>
                                <input type="text" name="admin_telephone" placeholder="Telephone" value="<?php echo admin_info("telephone")?>">
                            </div>

                            <div class="picture">
                                <label for="admin_picture">Admin Picture:</label>
                                <input type="file" name="admin_picture">
                            </div>
                        </div>

                        <div class="add_houses_cancel">
                            <input type="submit" name="submit" class="add" value="Add Contacts">
                            <a class="delete">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
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
    </script>
</body>
</html> 