<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="contactsDesign.css">

    <style>
        /* navigation design */
        #navigation {
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            background-color: #1c1c1c;
            color: white;
            width: 15%;
            height: 100%;
            position: fixed;
        }

        .navigagtion_content{
            margin: 0px 0;
            position: sticky;
            top: 0;
        }

        .navigagtion_content h1{
            margin: 20px 10px 10px 10px;
        }

        .navigagtion_content nav {
            margin-top: 20px;
        }

        .navigagtion_content nav ul {
            display: flex;
            flex-direction: column;
            list-style: none;
        }
        
        .navigagtion_content nav ul li:hover{
            background-color: #5c5c5c;
        }

        .navigagtion_content nav ul li a, .log_out{
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 1.7px;
            text-decoration: none;;
            color: white;
            padding-bottom: 5px;
            display: block;
            padding: 15px 25px;
            transition: transform 0.15s linear;
        }

        .navigagtion_content nav ul a:hover,
        .navigagtion_content nav ul form:hover{
            transform: scale(1.07);
        }

        .navigagtion_content nav ul form{
            transition: transform 0.15s linear;
        }    
            
        .log_out{
            border: none;
            background-color: transparent;
        }
    </style>
</head>
<body>
    <!-- for the navbar -->
    <div id="navigation">
            <div class="navigagtion_content">
                <h1>Houses.com</h1>

                <!-- for the shortcuts/links -->
                <nav>
                    <ul>
                        <li><a href="admin_home_page.php">Houses</a></li>
                        <li><a href="admin_house_info.php">House Info</a></li>
                        <li><a href="admin_interior_design_page.php">Interior Design</a></li>
                        <li><a href="admin_info.php">Admin</a></li>
                        <li>
                            <form action="./admin_log_in_form.php" method="post">
                                <input type="submit" name="log_out" value="Log Out" class="log_out">
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

</body>
</html>