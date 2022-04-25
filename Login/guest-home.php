<!doctype html>
<html>
<head>
    <!-- Check session -->
    <?php include_once(__DIR__."/../check-session.php") ?>
    
    <title>Guest Home Page</title>
</head>
<!DOCTYPE html>
<html>
<body>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box
        }

        body {
            font-family: Verdana, sans-serif;
            margin: 0
        }

        .mySlides {
            display: none
        }

        img {
            vertical-align: middle;
        }

        .footer {
            background-color: #e8ffe3;
            color: #3a4537;
            text-align: center;
            padding: 2em;
            font-family: arial;
        }

        /* Slideshow container */
        .slideshow-container {
            max-width: 80%;
            position: relative;
            margin: auto;
            background-color: black;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: white;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #ffffff;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            font-family: arial;
            color: #212121;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;

        }

        li a:hover:not(.active) {
            color: grey;
        }

        .active {
            background-color: white;
            color: white;
        }

        .info {
            font-family: arial;
            text-align: left;
            font-size: 1em;
            margin: 3em;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-family: arial;
            font-size: 3em;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            cursor: pointer;
            height: .2em;
            width: .2em;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active,
        .dot:hover {
            background-color: #717171;
        }

        /* Fading animation */
        .fade {
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {

            .prev,
            .next,
            .text {
                font-size: 11px
            }
        }
    </style>
</head>

<body>


    <ul>
        <li><a class="active" href="#home">Home</a></li>
        <li><a href="#news">Tickets</a></li>
        <li><a href="#contact">Animals</a></li>
        <li><a href=/Login/logout.php>Logout</a><li>
    </ul>


    <div class="slideshow-container">

        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img src="https://images.pexels.com/photos/35435/pexels-photo.jpg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                style="width:100%">
            <div class="text">Grizzly Bear</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <img src="https://images.pexels.com/photos/1316297/pexels-photo-1316297.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                style="width:100%">
            <div class="text">Salvadorean Jaguar</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <img src="https://images.pexels.com/photos/1680214/pexels-photo-1680214.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                style="width:100%">
            <div class="text">Chinese Flamingoes</div>
        </div>

        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>

    </div>
    <br>

    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>
    <div class="info">
        <p>The Wildlife Carousel is a unique work of art, hand carved and painted. Many of the carousel animals are
            found in the zoo, and you can see the only armadillo known to exist as a carousel figure! Go for a spin and
            ride along to music from across the globe. </p>
        <p>
            A portion of the proceeds from the Carousel helps fund the Zoo’s ongoing conservation efforts. Riders of all
            ages can have fun taking a spin and knowing that they are bringing hope to endangered species and wild
            habitats around the world!</p>
    </div>
    <div class="footer">
        <h1>
            © 2022 Uma Zoo. All rights reserved.</h1>
    </div>
    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }
    </script>

</body>
</html>