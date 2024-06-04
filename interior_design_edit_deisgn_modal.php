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
            min-height: 516px;
            background-color: white;
            border-radius: 5px;
        }

        .modal_header{
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 10px 15px;
            justify-content: space-between;
            color: rgba(0, 0, 0, 0.8);
            border-bottom: 1px solid rgba(0, 0, 0, 0.3);
        }

        .modal_content h1{
            font-size: 25px;
            text-align: left;
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

        .forms{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .forms form{
            width: 100%;
            height: 435px; 
        }

        /* image design */
        .inserted_images{
            width: 100%;
            height: 355px;
            overflow-y: scroll;
            background-color: rgba(235, 235, 235, 1);
        }

        .inserted_images h1{
            display: block;
            margin: 20px;
            color: rgba(0, 0, 0, 0.7);
            font-size: 18px;
            text-align: left;
        }

        .design_images{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
        }

        .design_images:not(:last-of-type){
            border-bottom: 4px solid rgba(0, 0, 0, 0.3);
        }

        .design_images img{
            height: 180px;
            border: 2px solid rgba(0, 0, 0, 0.7);
            border-radius: 5px;
            margin: 10px;
        }

        .image_container{
            margin: 20px;
        }

        .no_image_alert{
            margin: 40px;
            width: 100%;
            color: rgba(0, 0, 0, 0.9);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .no_image_alert p{
            font-size: 20px;
            text-align: center;
        }
        

        /* buttons design */
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
            
            <div class="modal_header">
                <h1>Edit images of <?php echo $house_type?></h1>

                <div class="close_container">
                    <span class="close">&times;</span>
                </div>
            </div>

            <div class="forms">
                <form action="./cruds_functions/interior_design_crud.php" method="post" enctype="multipart/form-data">
                    <div class="inserted_images">
                        <?php
                            $table_pics = array("living_room", "dinning_room", "master_bedroom", "bedroom", "cr", "other");
                            foreach($table_pics as $pics){
                                $pic_path = "{$pics}_path";
                                $pic_name = "{$pics}_pic";
                                $design_id = "{$pics}_id";
                                $query_pics = "SELECT  $design_id, $pic_path, $pic_name FROM $pics WHERE house_design_id = $id";
                                $select_query_pics = $conn->query($query_pics);
                        
                                if($pics === "living_room"){
                                    echo "<h1>Living Room:</h1>";
                                }
                                else if($pics === "dinning_room"){
                                    echo "<h1>Dinning Room:</h1>";
                                }
                                else if($pics === "master_bedroom"){
                                    echo "<h1>Master Bedroom:</h1>";
                                }
                                else if($pics === "bedroom"){
                                    echo "<h1>Bedroom:</h1>";
                                }
                                else if($pics === "cr"){
                                    echo "<h1>Cr:</h1>";
                                }
                                else if($pics === "other"){
                                    echo "<h1>Other Pics:</h1>";
                                }
                        ?>

                        <div class="design_images">
                            <?php
                                while($images = mysqli_fetch_assoc($select_query_pics)){
                                    if(isset($images[$pic_path]) && isset($images[$pic_name])){
                            ?>

                            <div class="image_container">
                                <input type="checkbox" name="<?php echo $pics?>[]" value="<?php echo $images[$design_id]?>" class="checkbox_image">
                                <img src="./pictures/<?php echo $images[$pic_path]?>" alt="picture of<?php echo "{$house_type} {$images[$pic_name]}"?>" class="output_image">
                            </div>
                            
                            <?php
                                    }
                                    else{
                            ?>

                            <div class="no_image_alert">
                                <?php
                                    if($pics === "living_room"){
                                        echo "<p>No images inserted yet in Living Room</p>";
                                    }
                                    else if($pics === "dinning_room"){
                                        echo "<p>No images inserted yet in Dinning Room</p>";
                                    }
                                    else if($pics === "master_bedroom"){
                                        echo "<p>No images inserted yet in Master Bedroom</p>";
                                    }
                                    else if($pics === "bedroom"){
                                        echo "<p>No images inserted yet in Bedroom</p>";
                                    }
                                    else if($pics === "cr"){
                                        echo "<p>No images inserted yet in Cr</p>";
                                    }
                                    else if($pics === "other"){
                                        echo "<p>No additional images has been inserted yet</p>";
                                    }
                                ?>
                            </div>
                                        
                            <?php
                                    }
                                }
                            ?>
                        </div>

                        <?php
                            }
                        ?>
                    </div>

                    <div class="add_houses_cancel">
                        <input type="submit" name="submit" class="add" value="Remove Image/s">
                        <a class="delete">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // for removing the modal
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

        // for the checkbox button functionality
        const checkbox = document.querySelectorAll('.checkbox_image');
        const images = document.querySelectorAll('.output_image');

        images.forEach((img, index) =>{
            img.addEventListener('click', function(){
                checkbox[index].checked = !checkbox[index].checked;
            });
        });

    </script>
</body>
</html>