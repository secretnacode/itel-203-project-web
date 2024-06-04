<?php
include "./included_files/connfigure.php";

function contact_val($contact)
{
    include "./included_files/connfigure.php";

    $query_values = "SELECT contact_value FROM admin_contact WHERE contact = '$contact'";
    $select_query = $conn->query($query_values);
    $row_values = mysqli_fetch_assoc($select_query);

    $conn->close();
    return $row_values["contact_value"];
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
        .houses_content {
            width: 100%;
        }

        /* filter style */
        .filters_container {
            display: flex;
            flex-direction: row;
            justify-content: end;
            align-items: center;
            padding: 20px;
            gap: 30px;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            background-color: white;
        }

        .search_filters {
            display: flex;
            flex-direction: row;
            gap: 30px;
        }

        #bathroom,
        #beds {
            height: 30px;
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            align-items: center;
            margin: 10px 0;
            border: 1px solid rgba(0, 0, 0, 0.3);
            border-radius: 10px;

        }

        .radioButton label {
            margin: 5px 20px 5px 0;

        }

        .radioButton input {
            margin: 5px;
            width: 15px;
            height: 15px;
        }

        .search_input input {
            height: 35px;
            border-radius: 15px;
            border: 1px solid black;
            padding-left: 8px;
            width: 100%;
        }

        .search_input_container {
            width: 300px;
            margin-right: 20px;
        }

        .search_input {
            margin: 10px 0;
        }

        /* main content of the page style */
        .main_page_content {
            display: flex;
            flex-direction: row;
            position: relative;
        }

        /* user message and admin contact style */
        .users_message_admin_contact {
            width: 20%;
            margin: 25px 0 0 25px;
            position: sticky;
            top: 35%;
            height: fit-content;
        }

        /* admin contact style */
        .admin_contact {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            background-color: white;
        }

        .admin_contact  table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin_contact table tr:not(:last-of-type) {
            border-bottom: 1px solid rgba(0, 0, 0, 0.7);
        }

        .admin_contact table td {
            padding: 10px;
        }

        .admin_contact table td:first-of-type {
            text-align: center;
            width: 15%;
        }

        .admin_contact table td:last-of-type {
            text-align: right;
            color: rgba(0, 0, 0, 0.6);
            font-size: 15px;
            padding-right: 10px;
        }

        .admin_contact table td svg {
            width: 28px;
            height: 28px;
        }

        /* houses style */
        .house {
            display: flex;
            flex-direction: row;
            width: 100%;
        }

        .houses_available {
            width: 80%;
            
        }

        #about_house_wrapper{
            margin-top: 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        

        .about_house_container {
            display: flex;
            border: 1px solid black;
            border-radius: 20px;
            width: 95%;
            height: 315px;
            background-color: white;
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
        }

        .about_house_container form input {
            position: absolute;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 8;
            border-radius: 20px;
            opacity: 0;
        }

        .about_house_container:hover {
            box-shadow: 5px 5px 15px black;
            transform: translateY(-10px);
        }

        .house_image_container {
            height: 100%;
            width: 35%;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            border-right: 1px solid black;
            position: relative;
        }

        .house_image_container img {
            width: 100%;
        }

        /* about house style */
        .about_house {
            width: 65%;
            padding: 10px 20px;
        }

        .house_name {
            font-size: 28px;
            font-weight: bolder;
            text-transform: capitalize;
            color: rgba(0, 0, 0, 0.8);
            letter-spacing: .75px;
            margin-bottom: 5px;
        }

        .house_price {
            font-size: 23px;
            font-weight: bolder;
            color: rgba(0, 0, 0, 0.7);
            margin-bottom: 5px;
        }

        .monthly_price {
            font-size: 20px;
            font-weight: bolder;
            color: rgba(0, 0, 0, 0.7);
            margin-bottom: 20px;
        }

        .amaneties {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .bedroom,
        .bathroom,
        .measurments {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .bedroom svg,
        .bathroom svg,
        .measurments svg {
            width: 24px;
            height: 24px;
            margin-right: 5px;
        }

        .bedroom .value,
        .bathroom .value,
        .measurments .value {
            margin-left: 5px;
        }

        .description p:first-of-type {
            text-transform: capitalize;
            font-size: 20px;
            font-weight: bolder;
            margin: 3px 0;
        }

        .description p:last-of-type {
            line-height: 20px;
            margin: 10px 0;
            letter-spacing: 0.75px;
        }

        #interior_design {
            display: flex;
            border: 1px solid black;
            border-radius: 20px;
            width: 100%;
            height: 100%;
            position: absolute;
            opacity: 0;
        }

        /* user message to admin style */
        .user_message {
            margin-top: 30px;
            border-top: 1px solid black;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.4);
            display: flex;
            justify-content: center;
        }

        .user_message form {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: white;
            border: 1px solid rgba(0, 0, 0, 0.5);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 35%;
        }

        .label_message {
            font-size: 25px;
            font-weight: bold;
            color: rgba(0, 0, 0, .7);
            margin: 30px;
        }

        .input_texts {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .input_texts div {
            width: 100%;
            margin: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .input_texts div input,
        .input_texts div textarea {
            width: 90%;
            height: 30px;
            border: 1px solid rgba(0, 0, 0, 0.3);
            border-radius: 3px;
            font-size: 15px;
            padding: 5px;
        }

        .input_texts div textarea {
            resize: none;
            height: 100px;
        }

        .input_submit input {
            color: white;
            letter-spacing: 0.5px;
            padding: 10px;
            border: 1px solid rgba(0, 0, 0, 0.3);
            border-radius: 5px;
            font-size: 12px;
            background-color: rgba(20, 201, 68, 1);
            transition: transform 0.1s linear,
                box-shadow 0.1s linear;
            cursor: pointer;
            margin: 20px;
        }

        .input_submit input:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.7);
        }

        @media screen and (max-width: 1293px){
            .house_image_container img {
                height: 100% !important; 
            }
        }

        @media screen and (max-width: 1020px){
            .admin_contact table td:last-of-type{
                font-size: 14px;
            }

            .admin_contact table td svg{
                width: 26px;
                height: 26px;
            }
        }

        @media screen and (max-width: 1019px) {
            .house_name{
                font-size: 27px;
            }

            .house_price{
                font-size: 22px;
            }

            .monthly_price{
                font-size: 19px;
            }

            .description p:first-of-type{
                font-size: 19px;
            }

            .description p:nth-of-type(2){
                font-size: 14px;
            }

            .search_input_container{
                width: 225px;
            }
        }

        @media screen and (max-width: 988px){
            .admin_contact table td:last-of-type{
                font-size: 13px;
            }

            .admin_contact table td svg{
                width: 24px;
                height: 24px;
            }

            .house_name{
                font-size: 25px;
            }

            .house_price{
                font-size: 20px;
            }

            .monthly_price{
                font-size: 17px;
            }

            .description p:first-of-type{
                font-size: 17px;
            }

            .description p:nth-of-type(2){
                font-size: 13px;
            }

            .search_input_container{
                width: 225px;
            }

            .house_image_container{
                width: 37%;
            }

            .about_house{
                width: 63%;
            }

            .about_house_container{
                height: 300px;
            }
        }

        @media screen and (max-width: 951px){
            .house_name{
                font-size: 23px;
            }

            .house_price{
                font-size: 20px;
            }

            .monthly_price{
                font-size: 17px;
            }

            .description p:first-of-type{
                font-size: 17px;
            }

            .description p:nth-of-type(2){
                font-size: 13px;
            }
            
            .user_message form {
                width: 40%;
            }

            .input_texts div input, .input_texts div textarea{
                font-size: 13px;
            }

            .label_message{
                font-size: 23px;
                margin: 20px;
            }
            
            .input_submit input{
                margin: 15px;
                padding: 15px;
                font-size: 11px;
            }
        }

        @media screen and (max-width: 892px){
            .house_name{
                font-size: 22px;
            }

            .house_price{
                font-size: 19px;
            }

            .monthly_price{
                font-size: 16px;
            }
            
            .description p:first-of-type{
                font-size: 16px;
            }

            .description p:nth-of-type(2){
                font-size: 13px;
            }
        }

        @media screen and (max-width: 880px){
            .users_message_admin_contact{
                display: none;
            }

            .house_name{
                font-size: 28px;
            }

            .house_price{
                font-size: 23px;
            }

            .monthly_price{
                font-size: 20px;
            }

            .description p:first-of-type{
                font-size: 20px;
            }

            .description p:nth-of-type(2){
                font-size: 15px;
            }

            .search_input_container{
                width: 225px;
            }

            .houses_available{
                width: 100%;
            }
        }

        @media screen and (max-width: 822px){
            .house_name{
                font-size: 27px;
            }

            .house_price{
                font-size: 22px;
            }

            .monthly_price{
                font-size: 19px;
            }

            .description p:first-of-type{
                font-size: 19px;
            }

            .description p:nth-of-type(2){
                font-size: 14px;
            }
        }

        @media screen and (max-width: 796px){
            .house_name{
                font-size: 25px;
            }

            .house_price{
                font-size: 20px;
            }

            .monthly_price{
                font-size: 17px;
            }

            .description p:first-of-type{
                font-size: 17px;
            }

            .description p:nth-of-type(2){
                font-size: 13px;
            }

            .search_input_container label{
                font-size: 14px;
            }
            
            .search_input input{
                height: 30px;
                border-radius: 13px;
            }
        }

        @media screen and (max-width: 744px){
            .house_name{
                font-size: 23px;
            }

            .house_price{
                font-size: 18px;
            }

            .monthly_price{
                font-size: 16px;
            }

            .description p:first-of-type{
                font-size: 16px;
            }

            .description p:nth-of-type(2){
                font-size: 13px;
            }

            .about_house_container{
                height: auto;
            }

            .user_message form {
                width: 50%;
            }
        }

        @media screen and (max-width: 693px){
            .house_name{
                font-size: 21px;
            }

            .house_price{
                font-size: 17px;
            }

            .monthly_price{
                font-size: 15px;
            }

            .description p:first-of-type{
                font-size: 15px;
            }

            .description p:nth-of-type(2){
                font-size: 11px;
            }

            .user_message form {
                width: 50%;
            }

            .input_texts div input{
                font-size: 10px;
                height: 25px;
            }

            .input_texts div textarea{
                height: 80px;
                font-size: 10px;
            }

            .label_message{
                font-size: 20px;
                margin: 17px;
            }
            
            .input_submit input{
                margin: 12px;
                padding: 12px;
                font-size: 10px;
            }

            .bedroom svg, .bathroom svg, .measurments svg {
                width: 21px;
                height: 21px;
            }

            .bedroom svg ~ span, .bathroom svg ~ span, .measurments svg ~ span{
                font-size: 13px;
            }
        }

        @media screen and (max-width: 641px){
            .house_image_container{
                width: 40%;
            }

            .about_house{
                width: 60%;
            }

            .house_name{
                font-size: 19px;
            }

            .house_price{
                font-size: 16px;
            }

            .monthly_price{
                font-size: 14px;
            }

            .description p:first-of-type{
                font-size: 14px;
            }

            .description p:nth-of-type(2){
                font-size: 10px;
            }

            .bedroom svg, .bathroom svg, .measurments svg {
                width: 20px;
                height: 20px;
            }

            .bedroom svg ~ span, .bathroom svg ~ span, .measurments svg ~ span{
                font-size: 10px;
            }

            .label_message{
                font-size: 18px;
                margin: 15px;
            }

            .input_submit input{
                margin: 10px;
                padding: 10px;
                font-size: 10px;
            }
            
            .search_input_container label{
                font-size: 12px;
            }
            
            .search_input input{
                height: 25px;
                border-radius: 10px;
            }

            .search_input_container{
                width: 170px;
            }
        }

        @media screen and (max-width: 615px){
            .house_name{
                font-size: 18px;
            }

            .house_price{
                font-size: 15px;
            }

            .monthly_price{
                font-size: 13px;
            }

            .description p:first-of-type{
                font-size: 13px;
            }

            .description p:nth-of-type(2){
                font-size: 9px;
            }

            .bedroom svg, .bathroom svg, .measurments svg {
                width: 18px;
                height: 18px;
            }
        }

        @media screen and (max-width: 588px) {
            .house_name{
                font-size: 17px;
            }
        }

        @media screen and (max-width: 561px) {
            .house_name{
                font-size: 16px;
            }
        }

        @media screen and (max-width: 534px) {
            .house_name{
                font-size: 15px;
            }

            .house_price{
                font-size: 14px;
            }

            .monthly_price{
                font-size: 12px;
            }

            .description p:first-of-type{
                font-size: 12px;
            }
        }
    </style>
</head>

<body>

    <div class="houses_content">
        <div class="filters_container">
            <div class="search_input_container">
                <label for="search">Search:</label>

                <div class="search_input">
                    <input type="text" id="search_house_input" placeholder="search">
                </div>
            </div>
        </div>

        <div class="main_page_content">
            <div class="users_message_admin_contact">

                <div class="admin_contact">
                    <table>
                        <tr class="facebook">
                            <td>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: blue;">
                                    <path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z"></path>
                                </svg>
                            </td>

                            <td><?php echo contact_val("facebook") ?></td>
                        </tr>

                        <tr class="instagram">
                            <td>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: red;">
                                    <path d="M11.999 7.377a4.623 4.623 0 1 0 0 9.248 4.623 4.623 0 0 0 0-9.248zm0 7.627a3.004 3.004 0 1 1 0-6.008 3.004 3.004 0 0 1 0 6.008z"></path>
                                    <circle cx="16.806" cy="7.207" r="1.078"></circle>
                                    <path d="M20.533 6.111A4.605 4.605 0 0 0 17.9 3.479a6.606 6.606 0 0 0-2.186-.42c-.963-.042-1.268-.054-3.71-.054s-2.755 0-3.71.054a6.554 6.554 0 0 0-2.184.42 4.6 4.6 0 0 0-2.633 2.632 6.585 6.585 0 0 0-.419 2.186c-.043.962-.056 1.267-.056 3.71 0 2.442 0 2.753.056 3.71.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.042 1.268.055 3.71.055s2.755 0 3.71-.055a6.615 6.615 0 0 0 2.186-.419 4.613 4.613 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.186.043-.962.056-1.267.056-3.71s0-2.753-.056-3.71a6.581 6.581 0 0 0-.421-2.217zm-1.218 9.532a5.043 5.043 0 0 1-.311 1.688 2.987 2.987 0 0 1-1.712 1.711 4.985 4.985 0 0 1-1.67.311c-.95.044-1.218.055-3.654.055-2.438 0-2.687 0-3.655-.055a4.96 4.96 0 0 1-1.669-.311 2.985 2.985 0 0 1-1.719-1.711 5.08 5.08 0 0 1-.311-1.669c-.043-.95-.053-1.218-.053-3.654 0-2.437 0-2.686.053-3.655a5.038 5.038 0 0 1 .311-1.687c.305-.789.93-1.41 1.719-1.712a5.01 5.01 0 0 1 1.669-.311c.951-.043 1.218-.055 3.655-.055s2.687 0 3.654.055a4.96 4.96 0 0 1 1.67.311 2.991 2.991 0 0 1 1.712 1.712 5.08 5.08 0 0 1 .311 1.669c.043.951.054 1.218.054 3.655 0 2.436 0 2.698-.043 3.654h-.011z"></path>
                                </svg>
                            </td>

                            <td><?php echo contact_val("instagram") ?></td>
                        </tr>

                        <tr class="twitter">
                            <td>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
                                    <path d="M 6 4 C 4.895 4 4 4.895 4 6 L 4 24 C 4 25.105 4.895 26 6 26 L 24 26 C 25.105 26 26 25.105 26 24 L 26 6 C 26 4.895 25.105 4 24 4 L 6 4 z M 8.6484375 9 L 13.259766 9 L 15.951172 12.847656 L 19.28125 9 L 20.732422 9 L 16.603516 13.78125 L 21.654297 21 L 17.042969 21 L 14.056641 16.730469 L 10.369141 21 L 8.8945312 21 L 13.400391 15.794922 L 8.6484375 9 z M 10.878906 10.183594 L 17.632812 19.810547 L 19.421875 19.810547 L 12.666016 10.183594 L 10.878906 10.183594 z"></path>
                                </svg>
                            </td>

                            <td><?php echo contact_val("twitter") ?></td>
                        </tr>

                        <tr class="tiktok">
                            <td>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                    <path fill="#212121" fill-rule="evenodd" d="M10.904,6h26.191C39.804,6,42,8.196,42,10.904v26.191 C42,39.804,39.804,42,37.096,42H10.904C8.196,42,6,39.804,6,37.096V10.904C6,8.196,8.196,6,10.904,6z" clip-rule="evenodd"></path>
                                    <path fill="#ec407a" fill-rule="evenodd" d="M29.208,20.607c1.576,1.126,3.507,1.788,5.592,1.788v-4.011 c-0.395,0-0.788-0.041-1.174-0.123v3.157c-2.085,0-4.015-0.663-5.592-1.788v8.184c0,4.094-3.321,7.413-7.417,7.413 c-1.528,0-2.949-0.462-4.129-1.254c1.347,1.376,3.225,2.23,5.303,2.23c4.096,0,7.417-3.319,7.417-7.413L29.208,20.607L29.208,20.607 z M30.657,16.561c-0.805-0.879-1.334-2.016-1.449-3.273v-0.516h-1.113C28.375,14.369,29.331,15.734,30.657,16.561L30.657,16.561z M19.079,30.832c-0.45-0.59-0.693-1.311-0.692-2.053c0-1.873,1.519-3.391,3.393-3.391c0.349,0,0.696,0.053,1.029,0.159v-4.1 c-0.389-0.053-0.781-0.076-1.174-0.068v3.191c-0.333-0.106-0.68-0.159-1.03-0.159c-1.874,0-3.393,1.518-3.393,3.391 C17.213,29.127,17.972,30.274,19.079,30.832z" clip-rule="evenodd"></path>
                                    <path fill="#fff" fill-rule="evenodd" d="M28.034,19.63c1.576,1.126,3.507,1.788,5.592,1.788v-3.157 c-1.164-0.248-2.194-0.856-2.969-1.701c-1.326-0.827-2.281-2.191-2.561-3.788h-2.923v16.018c-0.007,1.867-1.523,3.379-3.393,3.379 c-1.102,0-2.081-0.525-2.701-1.338c-1.107-0.558-1.866-1.705-1.866-3.029c0-1.873,1.519-3.391,3.393-3.391 c0.359,0,0.705,0.056,1.03,0.159V21.38c-4.024,0.083-7.26,3.369-7.26,7.411c0,2.018,0.806,3.847,2.114,5.183 c1.18,0.792,2.601,1.254,4.129,1.254c4.096,0,7.417-3.319,7.417-7.413L28.034,19.63L28.034,19.63z" clip-rule="evenodd"></path>
                                    <path fill="#81d4fa" fill-rule="evenodd" d="M33.626,18.262v-0.854c-1.05,0.002-2.078-0.292-2.969-0.848 C31.445,17.423,32.483,18.018,33.626,18.262z M28.095,12.772c-0.027-0.153-0.047-0.306-0.061-0.461v-0.516h-4.036v16.019 c-0.006,1.867-1.523,3.379-3.393,3.379c-0.549,0-1.067-0.13-1.526-0.362c0.62,0.813,1.599,1.338,2.701,1.338 c1.87,0,3.386-1.512,3.393-3.379V12.772H28.095z M21.635,21.38v-0.909c-0.337-0.046-0.677-0.069-1.018-0.069 c-4.097,0-7.417,3.319-7.417,7.413c0,2.567,1.305,4.829,3.288,6.159c-1.308-1.336-2.114-3.165-2.114-5.183 C14.374,24.749,17.611,21.463,21.635,21.38z" clip-rule="evenodd"></path>
                                </svg>
                            </td>

                            <td><?php echo contact_val("tiktok") ?></td>
                        </tr>

                        <tr class="location">
                            <td>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: green;">
                                    <circle cx="12" cy="12" r="4"></circle>
                                    <path d="M13 4.069V2h-2v2.069A8.01 8.01 0 0 0 4.069 11H2v2h2.069A8.008 8.008 0 0 0 11 19.931V22h2v-2.069A8.007 8.007 0 0 0 19.931 13H22v-2h-2.069A8.008 8.008 0 0 0 13 4.069zM12 18c-3.309 0-6-2.691-6-6s2.691-6 6-6 6 2.691 6 6-2.691 6-6 6z"></path>
                                </svg>
                            </td>

                            <td><?php echo contact_val("location") ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="houses_available">
                <div id="search_house_result"></div>

                <div id="about_house_wrapper">
                    <div id="included_design"></div>

                    <?php
                    $query_house = "SELECT * FROM house_info_table WHERE 1";
                    $select_house = $conn->query($query_house);

                    if (mysqli_num_rows($select_house) > 0) {
                        while ($house_row = mysqli_fetch_assoc($select_house)) {
                    ?>

                            <div class="about_house_container" id="house_container">

                                <form class="house_design_form">
                                    <input type="submit" name="house_info">
                                    <input type="hidden" name="house_id" value="<?php echo $house_row['id'] ?>">
                                    <input type="hidden" name="house_type" value="<?php echo "{$house_row['house_site']} {$house_row['house_type']}" ?>">
                                </form>

                                <div class="house">
                                    <div class="house_image_container">
                                        <img src="./pictures/<?php echo $house_row['picture_path'] ?>" alt="pic of <?php echo $house_row['picture_name'] ?>">
                                    </div>

                                    <div class="about_house">
                                        <div class="house_name">
                                            <p>Name: <?php echo $house_row['house_site'] . " " . $house_row['house_type'] ?></p>
                                        </div>

                                        <div class="house_price">
                                            <p>Price: ₱<?php echo $house_row['house_price'] ?></p>
                                        </div>

                                        <div class="monthly_price">
                                            <p>As low as ₱<?php echo $house_row['monthly_price'] ?> per month</p>
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
                                            <p><?php echo $description_output['house_description'] ?></p>
                                        </div>

                                        <div class="amaneties">

                                            <div class="bedroom">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                                    <path d="M20 9.557V3h-2v2H6V3H4v6.557C2.81 10.25 2 11.525 2 13v4a1 1 0 0 0 1 1h1v4h2v-4h12v4h2v-4h1a1 1 0 0 0 1-1v-4c0-1.475-.811-2.75-2-3.443zM18 7v2h-5V7h5zM6 7h5v2H6V7zm14 9H4v-3c0-1.103.897-2 2-2h12c1.103 0 2 .897 2 2v3z"></path>
                                                </svg>
                                                <span class="floorsLogo">Bedroom:</span>
                                                <span class="value"><?php echo $bedroom_amount['bedroom_count'] ?></span>
                                            </div>

                                            <div class="bathroom">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                                    <path d="M21 10H7V7c0-1.103.897-2 2-2s2 .897 2 2h2c0-2.206-1.794-4-4-4S5 4.794 5 7v3H3a1 1 0 0 0-1 1v2c0 2.606 1.674 4.823 4 5.65V22h2v-3h8v3h2v-3.35c2.326-.827 4-3.044 4-5.65v-2a1 1 0 0 0-1-1zm-1 3c0 2.206-1.794 4-4 4H8c-2.206 0-4-1.794-4-4v-1h16v1z"></path>
                                                </svg>
                                                <span class="floorsLogo">Bathroom:</span>
                                                <span class="value"><?php echo $cr_amount['cr_count'] ?></span>
                                            </div>

                                            <div class="measurments">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                                    <path d="M20.875 7H3.125C1.953 7 1 7.897 1 9v6c0 1.103.953 2 2.125 2h17.75C22.047 17 23 16.103 23 15V9c0-1.103-.953-2-2.125-2zm0 8H3.125c-.057 0-.096-.016-.113-.016-.007 0-.011.002-.012.008l-.012-5.946c.007-.01.052-.046.137-.046H5v3h2V9h2v4h2V9h2v3h2V9h2v4h2V9h1.875c.079.001.122.028.125.008l.012 5.946c-.007.01-.052.046-.137.046z"></path>
                                                </svg>
                                                <span class="floorsLogo">Area:</span>
                                                <span class="value"><?php echo $house_row['house_num'] ?> sqm</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="user_message">
            <form action="./cruds_functions/user_message_crud.php" method="post">
                <div class="label_message">
                    <label for="input_texts">Leave us a message</label>
                </div>

                <div class="input_texts">
                    <div class="user_name">
                        <input type="text" name="user_name" placeholder="Enter your name" id="user_name" required>
                    </div>

                    <div class="user_contact_num">
                        <input type="text" name="user_contact_num" placeholder="Enter your phone number" id="user_contact_num" required>
                    </div>

                    <div class="user_text_message">
                        <textarea name="user_message" placeholder="Enter your message" id="user_message_to_admin" required></textarea>
                    </div>
                </div>

                <input type="hidden" name="url_name" value="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
                <div class="input_submit">
                    <input type="submit" name="submit" value="Send Message" id="submit_user_message">
                </div>
            </form>
        </div>
    </div>

    <script>
        // asych search function(ajax)
        var search_house_input = document.getElementById("search_house_input");
        var house_output_div = document.getElementById("search_house_result");
        var normal_houses_value = document.getElementById("about_house_wrapper");


        search_house_input.addEventListener("input", function() {
            var search = search_house_input.value.trim();

            if (search !== "") {
                normal_houses_value.style.display = "none";

                var xhr = new XMLHttpRequest();

                xhr.open("POST", "./search_requests/home_page_search_request.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("search=" + encodeURIComponent(search));

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        house_output_div.innerHTML = xhr.responseText;
                    }
                };
            } else {
                house_output_div.innerHTML = search_house_input.value;
                normal_houses_value.style.display = "block";
            }
        });

        // async response for the modal of every house interior design
        var house_form = document.querySelectorAll(".house_design_form");

        house_form.forEach(houses => {
            houses.addEventListener("submit", function(event) {
                event.preventDefault();

                const xhr = new XMLHttpRequest()

                xhr.open("POST", "./search_requests/include_interior_design.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                const data_form = new FormData(houses);
                const url_value = new URLSearchParams(data_form).toString();

                xhr.send(url_value);

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        document.getElementById("included_design").innerHTML = xhr.responseText;

                        closing_modal();
                        carousel_images();
                    }
                };
            });
        });

        // closing modal function of the response modal
        function closing_modal() {
            var modal = document.querySelector('.modal');
            var close_modal = document.querySelector('.close');

            close_modal.addEventListener("click", () => {
                modal.style.display = "none";
            });

            window.addEventListener('click', function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });
        }

        // image carousel function
        function carousel_images() {
            var next_image = document.querySelector(".next_button");
            var prev_image = document.querySelector(".previous_button");
            var images = document.querySelectorAll(".images img");
            var image_label = document.querySelectorAll(".image_label h1");
            var image_index = 0;

            if (images.length >= 0) {
                current_interior_design();
            }

            function current_interior_design() {
                images.forEach((img) => {
                    img.classList.remove("center");
                });

                image_label.forEach((label) => {
                    label.classList.remove("appear");
                });

                images[image_index].classList.add("center");
                image_label[image_index].classList.add("appear");

            }

            function next_img() {
                next_image.style.cursor = "not-allowed";

                images[image_index].classList.remove("left_to_middle");
                images[image_index].classList.remove("right_to_middle");
                images[image_index].classList.add("middle_to_left");

                setTimeout(() => {
                    images[image_index].classList.remove("middle_to_left");

                    image_index++;

                    if (image_index >= images.length) {
                        image_index = 0;
                    } 
                    else if (image_index < 0) {
                        image_index = images.length - 1;
                    }

                    images[image_index].classList.add("right_to_middle");

                    current_interior_design();

                    next_image.style.cursor = "pointer";
                }, 400);
                
            }

            function prev_img(){
                prev_image.style.cursor = "not-allowed";

                images[image_index].classList.remove("right_to_middle");
                images[image_index].classList.remove("left_to_middle");
                images[image_index].classList.add("middle_to_right");

                setTimeout(() => {
                    images[image_index].classList.remove("middle_to_right");

                    image_index--;

                    if (image_index >= images.length) {
                        image_index = 0;
                    } 
                    else if (image_index < 0) {
                        image_index = images.length - 1;
                    }
                    
                    images[image_index].classList.add("left_to_middle");

                    current_interior_design();

                    prev_image.style.cursor = "pointer";
                }, 400);
            }

            next_image.addEventListener("click", next_img);
            prev_image.addEventListener("click", prev_img);
        }
    </script>
</body>

</html>

<?php
if (isset($_POST["house_info"])) {
    include_once "./modals/user_page_interior_design_modal.php";
}
?>