<?php
    require_once "./included_files/connfigure.php";
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
            justify-content: center;
            align-items: center;
            z-index: 1;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
        }

        .modal_content{
            position: relative;
            width: 35%;
            height: 50%;
            background-color: white;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .modal_header{
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 25px 20px;
            justify-content: space-between;
            color: rgba(0, 0, 0, 0.6);
            border-bottom: 1px solid rgba(0, 0, 0, 0.3);
        }

        .close_container{
            display: flex;
            flex-direction: column;
            align-items: end;
            margin-left: 10px;
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

        .content_delete{
            padding: 20px;
        }

        .content_delete p{
            font-size: 20px;
            text-align: center;
        }

        .add_houses_cancel{
            width: 100%;
            height: 80px;
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
        <div class="modal_content">
            
            <!-- query for selecting all the data base on the given id -->
            <?php
                $query = "SELECT house_type FROM `house_info_table` WHERE id = '$id'";
                $select = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($select);
            ?>
        
            <div class="modal_header">
                <h1>Edit <?php echo $row["house_type"]?></h1>
                <div class="close_container">
                    <span class="close">&times;</span>
                </div>
            </div>

            <div class="content_delete">
                <p>Are you sure you want to delete all the data <br>that was included with the <?php echo $row["house_type"]?></p>
            </div>

            <div class="forms">
                <form action="./cruds_functions/house_info_crud.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="add_houses_cancel">
                        <input type="submit" name="submit" class="add" value="Delete House">
                        <a class="delete">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var modal = document.querySelector('.modal');
        var close_modal = document.querySelector('.close');
        var cancel = document.querySelector('a.delete');

        close_modal.onclick = function(){
            modal.style.display = "none";
        }

        cancel.onclick = function(){
            modal.style.display = "none";
        }


        window.addEventListener('click', function(event){
            if(event.target === modal){
                modal.style.display = "none";
            }
        });

        
    </script>
</body>
</html>