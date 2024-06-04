<?php
    include_once "./included_files/connfigure.php";

    $id = $_POST["house_id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./design.css">
    
    <style>
        /* navigation bar style */
        #header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            height: 40px;
            padding: 20px;
            background-color: rgba(41, 41, 41, 1); 
            color: white;
            position: fixed;
            width: 100%;
            z-index: 10;
            transition: background-color 0.40s linear;
        }

        #header h1 a{
            color: white;
            text-decoration: none;
        }

        #header nav {
            display: flex;
        }
            

        #header nav ul {
            display: flex;
            flex-direction: row;
            list-style: none;
            justify-content: flex-end;
            margin-right: 25px;
        }

        #header nav ul li a {
            margin: 10px;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 1.7px;
            text-decoration: none;
            color: white;
            padding-bottom: 5px;
        }

        #header nav ul li a:hover{
            border-bottom: 1px solid white;
        }

        #admin{
            margin: 0 10px;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 1.7px;
            padding-bottom: 5px;
            cursor: pointer;
        } 
    </style>

</head>
<body>
    <!-- for navigation bar -->
    <div id="header">
    <h1><a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">Houses.com</a></h1>
        <!-- for the shortcuts/links -->
        <nav>
            <ul>
                <li><a href="./admin_home_page.php">Homes</a></li>
                <li><a href="./admin_contact_page.php">Contacts</a></li>
                <li><a href="./admin_house_info.php">Admin</a></li>
            </ul>
        </nav>
    </div>
    <?php echo $id?>

</body>
</html>