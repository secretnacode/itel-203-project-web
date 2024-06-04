<?php
    include "../included_files/connfigure.php";

    $house_search = $_POST["search"];
?>
<div id="normal_table">
    <table>
        <!-- query for selecting all the data in the house_info_table in database -->
        <?php
            $query = " SELECT * FROM `house_info_table` 
            WHERE `house_type` LIKE '%{$house_search}%' OR `house_site` LIKE '%{$house_search}%'";
            $select = mysqli_query($conn, $query);
            $results = mysqli_num_rows($select);

            if($results > 0){
        ?>
        <thead>
            <tr>
                <th scope=col></th>
                <th scope=col>House type</th>
                <th scope=col>House Site</th>
                <th scope=col>House Price</th>
                <th scope=col>Monthly Price</th>
                <th scope=col>Floor Area</th>
                <th scope=col>House Picture</th>
                <th scope=col colspan="2">Action</th>
            </tr>
        </thead>

        <tbody>

            <?php
                while($row = mysqli_fetch_assoc($select)){
            ?>

            <tr>
                <td>
                    <form action="">
                        <input type="checkbox">
                    </form>
                </td>

                <td><?php echo $row["house_type"]?></td>

                <td><?php echo $row["house_site"]?></td>

                <td><?php echo "₱" . $row["house_price"]?></td>

                <td><?php echo "₱" . $row["monthly_price"]?></td>

                <td><?php echo $row["house_num"]?> sqm</td>

                <td>
                    <form action="./admin_house_info.php?id=<?php echo $row["id"]?>" method="post">
                        <input type="submit" name="submit" value="<?php echo $row["picture_name"]?>" class="picture_input">
                    </form>
                </td>

                <td class="action_form">
                    <form action="./admin_house_info.php?id=<?php echo $row["id"]?>" method="post">
                        <input type="submit" name="submit" value="Edit House" class="add"> 
                        <input type="submit" name="submit" value="Delete House" class="delete">
                    </form>
                </td>
            </tr>

            <?php
                    }
                }
            ?>

        </tbody>

        <?php
            if($results == 0){
        ?>
        
        <div class="no_data">
            <div class="main_alert">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><circle cx="8.5" cy="10.5" r="1.5"></circle><circle cx="15.493" cy="10.493" r="1.493"></circle><path d="M12 14c-3 0-4 3-4 3h8s-1-3-4-3z"></path></svg>

                    <p>CURRENTLY NO DATA INSERTED</p>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><circle cx="8.5" cy="10.5" r="1.5"></circle><circle cx="15.493" cy="10.493" r="1.493"></circle><path d="M12 14c-3 0-4 3-4 3h8s-1-3-4-3z"></path></svg>
            </div>

            <h2>INSERT A DATA ABOUT THE HOUSE</h2>
        </div>

        <?php
            }
        ?>
    </table>
</div>