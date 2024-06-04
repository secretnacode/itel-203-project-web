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
            color: rgba(0, 0, 0, 0.6);
            border-bottom: 1px solid rgba(0, 0, 0, 0.3);
        }

        .modal_content h1{
            font-size: 25px;
            text-align: center;
            margin-left: 10px;
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

        .forms div.picture label{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            position: relative;
        }

        .forms div.picture div.clue_button{
            padding: 0;
            margin: 0 5px 0 0;
            width: 20px;
            height: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: absolute; 
            right: 0;
        }
        
        .forms div.picture div.clue_button span{
            padding: 1px;
            font-size: 15px;
            width: 17px;
            height: auto;
            text-align: center;
            border: 1px solid rgba(0, 0, 0, 0.7);
            border-radius: 50%;
            cursor: pointer;
        }

        .forms div.picture div.clue_button span:hover{
            box-shadow: 0 0 8px rgba(0, 115, 255, 1),
                0 0 6px rgba(89, 164, 255, 1);
            font-weight: bolder;
            transform: scale(1.1);
            z-index: 1;
            background-color: white;
        }

        .forms div.picture div.clue_button{
            transition: display 0.3s linear;
        }

        .forms div.picture div.clue_button:hover #clue{
            display: block;
        }

        #description_textarea{
            width: 100%;
            height: 20%;
            resize: none;
            padding: 10px;
            color: rgba(0, 0, 0, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.2);
        }

        #clue{
            display: none;
            width: 100px;
            font-size: 15px;
            padding: 10px;
            border-top-right-radius: 20px;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
            background-color: white;
            position: absolute;
            top: -163px;
            right: 10px;
            z-index: 0;
        }

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
        <div class="modal_content">
            
            <!-- query for selecting all the data base on the given id -->
            <?php
                $query = "SELECT * FROM `house_info_table` WHERE id = '$id'";
                $select = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($select);
            ?>
        
            <div class="modal_header">
                <h1>Edit <?php echo $row["house_type"]?></h1>
                <div class="close_container">
                    <span class="close">&times;</span>
                </div>
            </div>

            <div class="forms">
                <form action="./cruds_functions/house_info_crud.php" method="post" enctype="multipart/form-data">
                    <div class="inputs">

                        <div class="type ">
                            <label for="house_type">House Type:</label>
                            <input type="text" name="house_type" placeholder="house type" value="<?php echo $row["house_type"] ;?>" required>
                        </div>

                        <div class="site">
                            <label for="site_name">Name of the site:</label>
                            <input type="text" name="site_name" placeholder="site name" value="<?php echo $row["house_site"] ;?>" required>
                        </div>

                        <div class="price">
                            <label for="house_price">Price of the House:</label>
                            <input type="number" name="house_price" placeholder="house price" value="<?php echo $row["house_price"] ;?>" required>
                        </div>

                        <div class="monthly_price">
                            <label for="house_monthly_price">Monthly Price of the House:</label>
                            <input type="number" name="house_monthly_price" placeholder="monthly price" value="<?php echo $row["monthly_price"] ;?>" required>
                        </div>
                        
                        <div class="num">
                            <label for="house_num">Floor Area(sqm):</label>
                            <input type="number" name="house_num" placeholder="house number" value="<?php echo $row["house_num"]?>" required>
                        </div>

                        <div class="picture">
                            <label for="house_picture">
                                <p>Picture of the House:</p>
                                    
                                <div class="clue_button">
                                    <span>&quest;</span>
                                    <div id="clue">
                                        <p>This part is not recquired if you dont want to change the picture of your <?php echo $row["house_type"]?></p>
                                    </div>
                                </div>
                            </label>
                            <input type="file" name="file">
                        </div>

                        <div class="description">
                            <label for="about_house">Description of the House:</label>
                            <textarea name="house_description" id="description_textarea" cols="30" rows="10"><?php echo $row["house_description"]?></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="picture" value="<?php echo $row["picture_name"]; ?>">

                    <div class="add_houses_cancel">
                        <input type="submit" name="submit" class="add" value="Edit House">
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
            if(event.target == modal){
                modal.style.display = 'none';
            }
        });

        
    </script>
</body>
</html>