<?php
    include "../included_files/connfigure.php";

    $house_search = $_POST["search"];

    $query_house = "SELECT * FROM house_info_table WHERE house_type LIKE '%{$house_search}%' OR house_site LIKE'%{$house_search}%'";
    $select_house = $conn->query($query_house);
    
    if(mysqli_num_rows($select_house) > 0){
        while($house_row = mysqli_fetch_assoc($select_house)){
        ?>

            <div id="about_house_wrapper">
                <div class="about_house_container" id="house_container">
                    <form action="house_interior_design.php" method="post">
                        <input type="submit" name="house_info">
                        <input type="hidden" name="house_id" value="<?php echo $house_row['id']?>">
                    </form>

                    <div class="house">
                        <div class="house_image_container">
                            <img src="./pictures/<?php echo $house_row['picture_path']?>" alt="pic of <?php echo $house_row['picture_name']?>">
                        </div>

                        <div class="about_house">
                            <div class="house_name">
                                <p>Name: <?php echo $house_row['house_site'] . " " . $house_row['house_type']?></p>
                            </div>

                            <div class="house_price">
                                <p>Price: ₱<?php echo $house_row['house_price']?></p>
                            </div>

                            <div class="monthly_price">
                                <p>As low as ₱<?php echo $house_row['monthly_price']?> per month</p>
                            </div>

                            <?php
                                $id = $house_row['id'];
                                
                                $bedroom_query = "SELECT COUNT(bedroom_pic) AS bedroom_count FROM bedroom WHERE house_design_id = $id";
                                $bedroom_count = $conn->query($bedroom_query);
                                $bedroom_amount = mysqli_fetch_assoc($bedroom_count);

                                $cr_query = "SELECT COUNT(cr_pic) AS cr_count FROM cr WHERE house_design_id = $id";
                                $cr_count = $conn->query($cr_query);
                                $cr_amount = mysqli_fetch_assoc($cr_count);
                            ?>

                            <div class="description">
                                <?php
                                    $description_query = "SELECT house_description FROM house_info_table WHERE $id";
                                    $select_description = $conn->query($description_query);
                                    $description_output = mysqli_fetch_assoc($select_description);
                                ?>
                                <p>Description:</p>
                                <p><?php echo $description_output['house_description']?></p>
                            </div>

                            <div class="amaneties">

                                <div class="bedroom">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M20 9.557V3h-2v2H6V3H4v6.557C2.81 10.25 2 11.525 2 13v4a1 1 0 0 0 1 1h1v4h2v-4h12v4h2v-4h1a1 1 0 0 0 1-1v-4c0-1.475-.811-2.75-2-3.443zM18 7v2h-5V7h5zM6 7h5v2H6V7zm14 9H4v-3c0-1.103.897-2 2-2h12c1.103 0 2 .897 2 2v3z"></path></svg>
                                    <span class="floorsLogo">Bedroom:</span>
                                    <span class="value"><?php echo $bedroom_amount['bedroom_count']?></span>
                                </div>

                                <div class="bathroom">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M21 10H7V7c0-1.103.897-2 2-2s2 .897 2 2h2c0-2.206-1.794-4-4-4S5 4.794 5 7v3H3a1 1 0 0 0-1 1v2c0 2.606 1.674 4.823 4 5.65V22h2v-3h8v3h2v-3.35c2.326-.827 4-3.044 4-5.65v-2a1 1 0 0 0-1-1zm-1 3c0 2.206-1.794 4-4 4H8c-2.206 0-4-1.794-4-4v-1h16v1z"></path></svg>
                                    <span class="floorsLogo">Bathroom:</span>
                                    <span class="value"><?php echo $cr_amount['cr_count']?></span>
                                </div>

                                <div class="measurments">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M20.875 7H3.125C1.953 7 1 7.897 1 9v6c0 1.103.953 2 2.125 2h17.75C22.047 17 23 16.103 23 15V9c0-1.103-.953-2-2.125-2zm0 8H3.125c-.057 0-.096-.016-.113-.016-.007 0-.011.002-.012.008l-.012-5.946c.007-.01.052-.046.137-.046H5v3h2V9h2v4h2V9h2v3h2V9h2v4h2V9h1.875c.079.001.122.028.125.008l.012 5.946c-.007.01-.052.046-.137.046z"></path></svg>
                                    <span class="floorsLogo">Area:</span>
                                    <span class="value"><?php echo $house_row['house_num']?> sqm</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }
?>