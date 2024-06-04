<?php
    require_once "./included_files/connfigure.php";
    $house_type = $_GET["house_type"];
    $id = $_GET["id"];
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

        .modal_content{
            position: relative;
            width: 35%;
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
            margin-left: 10px;
        }

        .close:hover{
            box-shadow: 0 0 10px rgba(255, 17, 0, 1),
                0 0 15px rgba(255, 46, 31, 1),
                0 0 20px rgba(255, 84, 71, 1);
        }

        /* form design */
        .table_pics{
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%
        }

        .forms{
            width: 100%;
        }

        .input_pics{
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .input_pics div{
            width: 80%;
            margin-top: 40px;
        }

        .input_pics div label{
            display: block;
            margin-bottom: 15px;
            color: rgba(0, 0, 0, 0.7);
            font-size: 18px;
        }

        .input_pics div input{
            width: 100%;
            height: 20%;
            font-size: 15px;
            color: rgba(0, 0, 0, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.2);
            letter-spacing: 0.7px;
            padding: 10px;
            border-radius: 3px;
        }

        .input_pics div input:focus{
            box-shadow: 0 0 8px rgba(0, 115, 255, 1),
                0 0 6px rgba(89, 164, 255, 1);
        }

        /* buttons designs */
        .add_pic_cancel{
            width: 100%;
            height: 80px;
            margin-top: 30px;
            display: flex;
            justify-content: end;
            align-items: center;
            border-top: 1px solid rgba(0, 0, 0, 0.3);
        }

        .add_pic_cancel a, .add_pic_cancel .add{
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
        <div class="modal_content">
            
            <div class="modal_header">
                <h1>Add Interior design of <?php echo $_GET["house_type"]?></h1>

                <div class="close_container">
                    <span class="close">&times;</span>
                </div>
            </div>

            <div class="table_pics">
                <form action="./cruds_functions/interior_design_crud.php" method="post" enctype="multipart/form-data" class="forms">
                    <div class="input_pics">
                        <div class="living_room">
                            <label for="living_room_pic_file">Living Room:</label>
                            <input type="file" name="living_room_pic_file[]" multiple>
                        </div>

                        <div class="dinning_room">
                            <label for="dinning_room_pic">Dinning Room:</label>
                            <input type="file" name="dinning_room_pic_file[]" multiple>
                        </div>

                        <div class="master_bedroom">
                            <label for="master_bedroom_pic">Master Bedroom:</label>
                            <input type="file" name="master_bedroom_pic_file[]" multiple>
                        </div>

                        <div class="bedroom">
                            <label for="bedroom_pic">Bedroom:</label>
                            <input type="file" name="bedroom_pic_file[]" multiple>
                        </div>

                        <div class="cr">
                            <label for="cr_pic">Cr:</label>
                            <input type="file" name="cr_pic_file[]" multiple>
                        </div>

                        <div class="other">
                            <label for="other_pic">Others:</label>
                            <input type="file" name="other_pic_file[]" multiple>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="hidden" name="house_type" value="<?php echo $house_type?>">
                    </div>

                    <div class="add_pic_cancel">
                        <input type="submit" name="submit" class="add" value="Add Images">
                        <a class="delete">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var modal = document.querySelector('.modal');
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
        });
    </script>
</body>
</html>