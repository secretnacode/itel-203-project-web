<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./design.css">
    
    <style>

    /* sliding background images for landing page */
    #imageFrame {
        overflow: hidden;
        width: 100%;
        z-index: -1;
        position: relative;
    }

    #imageSlides {
        animation-name: slidingImages;
        animation-duration: 30s;
        animation-iteration-count: infinite;
        animation-timing-function: ease-in-out;
        animation-delay: 1s;
        display: flex;
        flex-direction: row;
        width: 400%;
    }

    #image1 {
        background-image: url("./pictures/caliyaPic.jpeg");
    }

    #image2 {
        background-image: url("./pictures/carmelTownHouse.jpg");
    }

    #image3 {
        background-image: url("./pictures/santeviPic.jpeg");
    }

    #image4 {
        background-image: url("./pictures/savanaPic.png");
    }

    .images {
        width: 100%;
        display: flex;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    .bg {
        width: 100%;
        height: 645px;
        background-color: rgba(0, 0, 0, 0.5);
    }

    @keyframes slidingImages {
        8%, 100% {
            transform: translateX(0);
        }

        16%, 32%, 88%, 96% {
            transform: translateX(-25%);
        }

        40%, 48%, 72%, 80% {
            transform: translateX(-50%);
        }

        56%, 64% {
            transform: translateX(-75%);
        }
    }

    @media screen and (max-width: 830px) {
        .images{
            height: 600px;
        }
    }

    @media screen and (max-width: 750px) {
        .images{
            height: 550px;
        }
    }

    @media screen and (max-width: 685px) {
        .images{
            height: 500px;
        }
    }

    @media screen and (max-width: 619px) {
        .images{
            height: 475px;
        }
    }

    @media screen and (max-width: 578px) {
        .images{
            height: 450px;
        }
    }

    @media screen and (max-width: 540px) {
        .images{
            height: 400px;
        }
    }

    </style>
</head>
<body>
    <div id="imageFrame">
        <div id="imageSlides">
            
            <div id="image1" class="images">
                <div class="bg"></div>
            </div>

            <div id="image2" class="images">
                <div class="bg"></div>
            </div>

            <div id="image3" class="images">
                <div class="bg"></div>
            </div>

            <div id="image4" class="images">
                <div class="bg"></div>
            </div>
        </div>
    </div>
</body>
</html>