<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="./design.css">

    <style>

        /* navigation bar style */
        #header {
            height: 40px;
            padding: 20px;
            background-color: transparent;
            color: white;
            position: fixed;
            width: 100%;
            z-index: 10;
            transition: background-color 0.40s linear;
        }

        #nav{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
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

        #header input, #header label{
            display: none;
        }

        @media screen and (max-width: 650px) {
            h1{
                font-size: 28px;
            }

            #header nav ul li a{
                font-size: 14px;
            }
            
        }

        @media screen and (max-width: 540px) {
            #header{
                display: flex;
                flex-direction: row;
                justify-content: end;
            }

            #header label{
                display: inline-block !important;
                fill: white;
                transition: fill 0.20s linear;
                margin-right: 45px;
            }

            #menu_button.menu_scroll{
                fill: black;
            }

            #header.scrolled{
                background-color: transparent !important;
                fill: white;
            }

            #nav{
                flex-direction: column;
                align-items: start;
                justify-content: start;
                width: 400px;
                position: absolute;
                top: 0;
                height: 100vh;
                background-color: rgba(33, 33, 33, 1);
            }

            #nav nav{
                margin-top: 20px;
                width: 100%;
            }

            #nav nav ul{ 
                width: 100%;
            }

            #nav nav ul li{
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            #nav nav ul li a{
                font-size: 15px;
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 20px 0;
            }

            #nav nav ul li a:hover{
                background-color: rgba(75, 75, 75, 1);
                border-bottom: none;
            }

            #nav nav ul{
                flex-direction: column;
            }
            
        }
    </style>

</head>
<body>
    <!-- for navigation bar -->
    
    <div id="header">
        <input type="checkbox" name="navbar" id="hidden_navbar">
        <label for="hidden_navbar" id="menu_button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path></svg>
        </label>

        <div id="nav">
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
    </div>
</body>
</html>

