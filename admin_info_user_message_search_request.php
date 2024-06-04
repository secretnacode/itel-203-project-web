<?php
   include "../included_files/connfigure.php";

   $user_search = $_POST["search"];
?>
<div class="table">
    <table>
        <thead>
            <tr>
                <th>Interest</th>
                <th>User Name</th>
                <th>User Contact</th>
                <th>User Message</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $query_message = "SELECT user_name, user_contact, user_message_to_admin, interest FROM user_message WHERE user_name LIKE '%{$user_search}%' OR interest LIKE '%{$user_search}%'";
                $select_messages = $conn->query($query_message);

                if(mysqli_num_rows($select_messages) >0){
                    while($messages = mysqli_fetch_assoc($select_messages)){
                    
            ?>
                <tr>
                    <td>
                        <?php
                            if(empty($messages["interest"])){
                                echo "N/A";
                            }
                            else{
                                echo $messages["interest"];
                            }
                        ?>
                    </td>
                    <td><?php echo $messages["user_name"]?></td>
                    <td><?php echo $messages["user_contact"]?></td>
                    <td><?php echo $messages["user_message_to_admin"]?></td>
                </tr>


            <?php  
                    }
                }
            ?>
        </tbody>
    </table>
</div>