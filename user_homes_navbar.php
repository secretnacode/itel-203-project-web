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
            background-color: transparent;
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

        #header.scrolled{
            background-color: rgba(41, 41, 41, 1);
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
            letter-spacing: 1.5px;
            text-decoration: none;
            color: white;
            padding-bottom: 5px;
        }

        #header nav ul li a:hover{
            border-bottom: 1px solid white;
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
                <li><a href="./user_home_page.php">Homes</a></li>
                <li><a href="./user_contact_page.php">Contacts</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>