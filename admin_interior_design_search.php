<?php
    require_once "../included_files/connfigure.php";

    $search_design = $_POST["search"];
?>
<div id="table">
    <table>
        <?php
            // query for the interior design table
            $query = "SELECT id, house_type, house_site FROM house_info_table WHERE house_type LIKE '%{$search_design}%' OR house_site LIKE '%{$search_design}%'";

            $select = $conn->query($query);
            $result = mysqli_num_rows($select);

            if($result > 0){
        ?>
        <thead>
            <tr>
                <th scope="col">House Site</th>
                <th scope="col">House Type</th>
                <th scope="col">House Interior designs</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
                while($rows = mysqli_fetch_assoc($select)){
                    $id = $rows["id"];
            ?>

                <tr>
                    <td><?php echo $rows['house_site']?></td>

                    <td><?php echo $rows['house_type']?></td>
                    
                    <!-- pictures outputs -->
                    <td class="images">
                        <div class="image_view">
                        <div class="image_container">
                                <?php
                                    $table_pics = array("living_room", "dinning_room", "master_bedroom", "bedroom", "cr", "other");
                                    foreach($table_pics as $pics){
                                        $pic = "{$pics}_pic";
                                        $path = "{$pics}_path";

                                        $select_pics_query = "SELECT $pic, $path FROM $pics WHERE house_design_id = $id";
                                        $table_pics_query = $conn->query($select_pics_query);
                                        $table_pics_result = mysqli_num_rows($table_pics_query);
                                ?> 

                                <div class="image_wrapper">
                                    <?php
                                        if($table_pics_result > 0){
                                            while($table_pic_row = mysqli_fetch_assoc($table_pics_query)){
                                                if(isset($table_pic_row[$pic]) && isset($table_pic_row[$path])){
                                    ?>
                                    
                                    <img src="./pictures/<?php echo $table_pic_row[$path]?>" alt="<?php echo "{$pic} of {$rows['house_site']} {$rows['house_type']}"?>" class="image">

                                    <?php    
                                                }
                                            }
                                        }
                                    ?>
                                </div>

                                <?php
                                    }
                                ?>
                        </div> 
                        </div>
                    </td>

                    <?php
                        $row_id = $rows["id"];

                        $check_row = "SELECT living_room_pic, living_room_path FROM living_room WHERE house_design_id = $row_id";
                        $check_row_query = $conn->query($check_row);
                        $check_row_result = mysqli_fetch_assoc($check_row_query);
                    ?>
                    
                    <td>
                        <form action="./admin_interior_design_page.php?house_type=<?php echo "{$rows['house_site']} {$rows['house_type']}"?>&id=<?php echo $rows["id"]?>" method="post" class="action_form">
                            <?php
                                if(empty($check_row_result["living_room_pic"]) && empty($check_row_result["living_room_path"])){
                            ?>

                            <input type="submit" name="submit" value="Add Image" class="add">
                            
                            <?php
                                }
                                else{
                            ?>
                                    
                            <input type="submit" name="submit" value="Add Image" class="add">
                            <input type="submit" name="submit" value="Edit Image" class="edit">

                            <?php
                                }
                            ?>
                        </form>
                    </td>
                </tr>
            <?php
                }
            ?>
        </tbody>

        <?php
            }
        ?>
    </table>
</div>