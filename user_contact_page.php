<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./design.css">
    <title>Contacts</title>

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
    </style>
</head>
<body>
    <!--for the nav-->
    <div id="header">
        <h1>Houses.com</h1>

        <!--for the shortcuts/links-->
        <nav>
            <ul>
                <li><a href="./user_home_page.php">Homes</a></li>
                <li><a href="./user_contact_page.php">Contacts</a></li>
            </ul>
        </nav>
    </div>

    
    <?php include("./included_files/contact.php")?>
    
    <script src="contactFunction.js"></script>
</body>
</html>