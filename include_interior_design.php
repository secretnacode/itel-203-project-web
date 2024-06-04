<?php
    include "../included_files/connfigure.php";
    
    $id = $_POST["house_id"];
    $house_type = $_POST["house_type"];
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
            z-index: 11;
            background-color: rgba(0, 0, 0,0.5);
            display: flex;
        }

        .modal_content{
            position: relative;
            width: 40%;
            overflow: hidden;
            background-color: white;
            border-radius: 5px;
        }

        .modal_header{
            height: 40px;
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 20px 15px;
            justify-content: space-between;
            color: rgba(0, 0, 0, 0.8);
            border-bottom: 1px solid rgba(0, 0, 0, 0.3);
        }

        .modal_content h1{
            font-size: 23px;
            text-align: center;
            color: rgba(0, 0, 0, 0.7);
            text-transform: capitalize;
        }

        .close{
            display: inline-block;
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

        /* images desing style */
        .forms{
            position: relative;
        }

        .pictures_design{
            height: 310px;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding : 50px 0 25px 0;
            background-color: rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .image_container img{
            height: 300px;
            display: none;
            border: 1px solid black;
            border-radius: 10px;
            position: relative;
        }

        /* right to middle animation of the picture */
        @keyframes right_to_middle{
            from{
                right: -500px;
            }
            to{
                right: 0;
            }
        }

        .right_to_middle{
            animation: right_to_middle .4s linear;
        }

        /* middle to left animation of the picture */
        @keyframes middle_to_left {
            from{
                right: 0;
            }
            to{
                right: 500px;
            }
        }

        .middle_to_left{
            animation: middle_to_left .4s linear;
        }

        /* left to middle animation of the picture */
        @keyframes left_to_middle{
            from{
                left: -500px;
            }
            to{
                left: 0;
            }
        }

        .left_to_middle{
            animation: left_to_middle .4s linear;
        }

        /* middle to left animation of the picture */
        @keyframes middle_to_right {
            from{
                left: 0;
            }
            to{
                left: 500px;
            }
        }

        .middle_to_right{
            animation: middle_to_right .4s linear;
        }

        .image_container h1{
            position: absolute;
            top: 0;
            left: 0;
            margin: 10px;
            color: rgba(0, 0, 0, 0.7);
            font-size: 20px;
            display: none;
        }

        .image_container h1.appear{
            display: block;
        }

        .image_container img.center{
            display: block;
        }

        /* buttons design */
        .add_houses_cancel{
            width: 100%;
            height: 15%;
            display: flex;
            justify-content: end;
            align-items: center;
            border-top: 1px solid rgba(0, 0, 0, 0.3);
        }

        .previous_button, .next_button{
            text-decoration: none;
            color: white;
            margin: 15px 10px;
            padding: 10px;
            border: none;
            border-radius: 10px;
            width: 100px;
            cursor: pointer;
        }

        .previous_button{
            background: rgba(255, 52, 52, 1);
            transition: box-shadow 0.1s linear;
        }

        .next_button{
            background: rgba(94, 77, 255, 1);
            transition: box-shadow 0.1s linear;
        }

        .previous_button:hover{
            background-color: rgba(252, 33, 33, 1);
        }

        .next_button:hover{
            background-color: rgba(78, 60, 250, 1);
        }

    </style>
</head>
<body>
    <!-- modal form for add info -->
    <div class="modal">
        <div class="modal_content">

            <div class="modal_header">
                <h1><?php echo $house_type?></h1>

                <div class="close_container">
                    <span class="close">&times;</span>
                </div>
            </div>

            <div class="forms">
                <div class="pictures_design">
                    <?php
                        $picture_array = array("living_room",
                                                "dinning_room",
                                                "master_bedroom",
                                                "bedroom",
                                                "cr",
                                                "other");

                        foreach($picture_array as $interior_design){
                            
                            $picture = "{$interior_design}_pic";
                            $path = "{$interior_design}_path";

                            $query_pictures = "SELECT $picture, $path FROM $interior_design WHERE house_design_id = $id";
                            $select_pictures = $conn->query($query_pictures);

                            if(mysqli_num_rows($select_pictures) > 0){
                                while($interior_pictures = mysqli_fetch_assoc($select_pictures)){
                    ?> 

                                    <div class="image_container">
                                        <div class="image_label">
                                            <h1><?php echo $interior_pictures[$picture]?></h1>
                                        </div>

                                        <?php
                                            if(isset($interior_pictures[$picture]) && isset($interior_pictures[$path])){
                                        ?>
                                            <div class="images">
                                                <img src="./pictures/<?php echo $interior_pictures[$path]?>" alt="<?php echo "{$house_type} {$interior_pictures[$picture]} picture"?>">
                                            </div>
                                        <?php
                                            }
                                        ?>
                                    </div>

                    <?php
                               }
                            }
                        }
                    ?>
                    
                </div>
            </div>
                
            <div class="add_houses_cancel">
                <button class="previous_button">previous</button>
                <button class="next_button">next</button>
            </div>
        </div>
    </div>
</body>
</html>