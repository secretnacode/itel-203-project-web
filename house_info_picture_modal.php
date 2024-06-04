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
            width: fit-content;
            height: fit-content;
            background-color: white;
            border-radius: 5px;
            background-color: rgba(245, 245, 245, 1);
        }

        .modal_header{
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 25px 20px;
            justify-content: space-between;
            color: rgba(0, 0, 0, 0.8);
            border-bottom: 2px solid rgba(0, 0, 0, 0.7);
        }

        .modal_content h1{
            font-size: 25px;
            text-align: center;
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

        .picture_container{
            display: flex;
            flex-direction: row;
            padding: 20px;
        }


        img{
            height: 300px;
            border: 2px solid rgba(0, 0, 0, 0.7);
            border-radius: 5px;
        }

        .interactable_part{
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            padding-left: 20px;
            position: relative;
        }
        
        .input_description{
            display: flex;
            flex-direction: column;
        }

        .input_description label{  
            margin-bottom: 10px;
        }

        #house_description_textarea{
            height: 200px;
            resize: none;
            background-color: rgba(237, 237, 237, 1);
            padding: 5px;
        }

        #house_description_textarea:focus + .no_description_value{
            display: none;
        }

        .no_description_value{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 40%;
            left: 53%;
            transform: translate(-50%, -50%);
            width: 170px;
        }
        
        .buttons{
            height: auto;
            display: flex;
            flex-direction: row;
            justify-content: end;
            align-items: center;
            gap: 10px;
        }

        .buttons a, .buttons input{
            text-decoration: none;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 10px;
            width: auto;
            height: auto;
        }

        .cancel{
            background: rgba(255, 52, 52, 1);
            transition: transform 0.1s linear, 
                box-shadow 0.1s linear;
            
        }

        .cancel:hover{
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
                <h1>Picture of <?php echo $row["house_type"]?></h1>
                <div class="close_container">
                    <span class="close">&times;</span>
                </div>
            </div>

            <div class="picture_container">
                <img src="./pictures/<?php echo $row["picture_path"];?>" alt="Picture of <?php echo $row["picture_name"]?>">

              
                <form action="./cruds_functions/house_info_crud.php" method="post">
                    <div class="interactable_part">
                        <div class="input_description">
                            <label for="input_text">Enter a discription about the house:</label>

                            <?php
                                if($row["house_description"] == null){

                            ?>
                                <textarea name="house_description" id="house_description_textarea" cols="30" rows="10"></textarea>

                                <div class="no_description_value">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><path d="M10.707 12.293 9.414 11l1.293-1.293-1.414-1.414L8 9.586 6.707 8.293 5.293 9.707 6.586 11l-1.293 1.293 1.414 1.414L8 12.414l1.293 1.293zm6.586-4L16 9.586l-1.293-1.293-1.414 1.414L14.586 11l-1.293 1.293 1.414 1.414L16 12.414l1.293 1.293 1.414-1.414L17.414 11l1.293-1.293zM10 16h4v2h-4z"></path></svg>
                                    <p>No description yet</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><path d="M10.707 12.293 9.414 11l1.293-1.293-1.414-1.414L8 9.586 6.707 8.293 5.293 9.707 6.586 11l-1.293 1.293 1.414 1.414L8 12.414l1.293 1.293zm6.586-4L16 9.586l-1.293-1.293-1.414 1.414L14.586 11l-1.293 1.293 1.414 1.414L16 12.414l1.293 1.293 1.414-1.414L17.414 11l1.293-1.293zM10 16h4v2h-4z"></path></svg>
                                </div>
                            <?php
                                }
                                else{
                            ?>
                                <textarea name="house_description" id="house_description_textarea" cols="30" rows="10"><?php echo $row["house_description"];?></textarea>
                            <?php
                                }
                            ?>

                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                        </div>

                        <div class="buttons">
                            <?php
                                if($row["house_description"] == null){
                                    echo 
                                    '
                                        <input type="submit" name="submit" value="Add Description" class="add">
                                    ';
                                } 
                                else{
                                    echo
                                    '
                                        <input type="submit" name="submit" value="Edit Description" class="add">
                                    ';
                                }
                            ?>     

                            <a class="cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        // for closing the modal
        var modal = document.querySelector('.modal');
        var close_modal = document.querySelector('.close');
        var cancel = document.querySelector('.cancel');

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

        // for the no description text

        var enter_text = document.getElementById("house_description_textarea");
        var no_description_text = document.querySelector(".no_description_value");
        
        enter_text.addEventListener("focus", function(){
            no_description_text.style.display = "none";
        });

        enter_text.addEventListener("blur", function(){
            if(enter_text.value.trim() === ""){
                no_description_text.style.display = "flex";
            }
        });

    </script>
</body>
</html>