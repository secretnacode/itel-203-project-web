<?php
    // checking if you already logged in, if not youll go back to log in page
    session_start();
    if(empty($_SESSION["username"]) && empty($_SESSION["password"])){
        header("location: ./admin_log_in_form.php?bad_msg=You need to log in FIRST!!");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./design.css">

    <style>
        #header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            height: 40px;
            padding: 20px;
            background-color: transparent;
            color: white;
            z-index: 10;
            transition: background-color 0.5s linear;
        }

        #header{
            background-color: black;
        }

        #header nav {
            display: flex;
        }
            

        #header nav ul {
            display: flex;
            flex-direction: row;
            list-style: none;
            justify-content: flex-end;
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
    <div id="header">
        <h1>Houses.com</h1>

        <!-- for the shortcuts/links -->
        <nav>
            <ul>
                <li><a href="./admin_home_page.php">Homes</a></li>
                <li><a href="./admin_contact_page.php">Contacts</a></li>
                <li><a href="./admin_house_info.php">Admin</a></li>
            </ul>
        </nav>
    </div>

    <?php include("./included_files/contact.php")?>

</body>
</html>