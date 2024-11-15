<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset(config('app.companyInfo.logo')) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <title>{{ config('app.companyInfo.name') }}</title>
    <script src="{{asset('js/time.js')}}"></script>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Luckiest+Guy");

        /* BODY */
        body {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            background-image: -webkit-linear-gradient(90deg, #ffffff 0%, #ffffff 100%);
            background-attachment: fixed;
            background-size: 100% 100%;
            overflow: hidden;
            font-family: "Poppins", cursive;
            -webkit-font-smoothing: antialiased;
        }

        ::selection {
            background: transparent;
        }

        /* CLOUDS */
        body:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            width: 0;
            height: 0;
            margin: auto;
            border-radius: 100%;
            background: transparent;
            display: block;
            box-shadow: 0 0 150px 100px rgba(255, 255, 255, 0.6),
                200px 0 200px 150px rgba(255, 255, 255, 0.6),
                -250px 0 300px 150px rgba(255, 255, 255, 0.6),
                550px 0 300px 200px rgba(255, 255, 255, 0.6),
                -550px 0 300px 200px rgba(255, 255, 255, 0.6);
        }

        /* JUMP */
        h1 {
            cursor: default;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100px;
            margin: auto;
            display: block;
            text-align: center;
        }

        h1 span {
            position: relative;
            top: 20px;
            display: inline-block;
            /* -webkit-animation: preAnimation 1.5s ease infinite alternate; */
            font-size: 80px;
            color: #000;
            text-shadow: 0 1px 0 #ccc, 0 2px 0 #ccc, 0 3px 0 #ccc, 0 4px 0 #ccc,
                0 5px 0 #ccc, 0 6px 0 transparent, 0 7px 0 transparent, 0 8px 0 transparent,
                0 9px 0 transparent, 0 10px 10px rgba(0, 0, 0, 0.2);
        }

        /* ANIMATION */
        @-webkit-keyframes preAnimation {
            100% {
                top: -20px;
                text-shadow: 0 1px 0 #ccc, 0 2px 0 #ccc, 0 3px 0 #ccc, 0 4px 0 #ccc,
                    0 5px 0 #ccc, 0 6px 0 #ccc, 0 7px 0 #ccc, 0 8px 0 #ccc, 0 9px 0 #ccc,
                    0 50px 25px rgba(0, 0, 0, 0.2);
            }
        }

        .privacy-link {
            position: fixed;
            bottom: 5%;
            text-align: center;
            left: 5%;
            letter-spacing: 1.5px;
            word-spacing: 3px;
            color: #000;
            font-weight: bold;
            text-decoration: none;
            text-underline: none;
            padding: 5px 20px;
            background-color: #fff;
            border-radius: 10px;
            cursor: pointer !important;
            transition: .3 linear;
        }

        .privacy-link:hover {
            box-shadow: 1px 3px 20px #fff;
            color: #405188;
            transition: .3 linear;

        }

        .cursor {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            z-index: 9999;
            pointer-events: none;
            transition: all .3s ease-out;
            /* transition-property: transform ; */

        }

        .cursor-outer {
            width: 50px;
            height: 50px;
            border: 1px solid #0c5700;
        }

        .cursor-inner {
            width: 7px;
            height: 7px;
            background: #004f25;
        }

        .cursorHover {
            width: 70px;
            height: 70px;
            border-color: transparent;
            border-radius: 5px;
            background: #fff;
            mix-blend-mode: difference;
        }

        .bounce {
            /* cursor: pointer !important; */
            /* text-shadow: 1px 10px 5px #000; */
            text-shadow: 0 1px 0 #ccc, 0 2px 0 #ccc, 0 3px 0 #ccc, 0 4px 0 #ccc,
                0 5px 0 #ccc, 0 6px 0 #ccc, 0 7px 0 #ccc, 0 8px 0 #ccc, 0 9px 0 #ccc,
                0 50px 25px rgba(0, 0, 0, 0.2);

            /* color: var(--bs-primary); */
            animation-name: bounce;
            animation-duration: 1s;
            animation-timing-function: linear;
            animation-iteration-count: 1;
            /* animation: animate 1s;  */
            transition: .3s linear;
        }

        @keyframes bounce {

            20%,
            50%,
            80%,
            to {
                transform: scale(1, 1);
            }

            40% {
                transform: scale(1.75, 0.65);
            }

            45% {
                transform: scale(1.75, 0.65);
            }

            70% {
                transform: scale(1.25, 0.75);
            }

            90% {
                transform: scale(1.15, 0.85);
            }
        }

        @keyframes animate {
            25% {
                transform: scale(0.8, 1.3);
            }

            50% {
                transform: scale(1.1, 0.8);

            }

            75% {
                transform: scale(0.7, 1.2);
            }
        }

        .cursorHoverNav {
            width: 100px;
            height: 100px;
            /* border-color: transparent; */
            border-radius: 5px;
            background: #ffffff30;
            /* mix-blend-mode:difference; */
        }

        .hoverColor {
            transition: .3s linear;
        }
    </style>
</head>

<body id="tsparticles">
    @if (Route::has('login'))
    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
        @auth
        <a href="{{ url('/dashboard') }}"
            class="bg-blue-600 rounded p-3 font-semibold text-white hover:bg-blue-500 focus:outline-2 focus:rounded-sm">Dashboard</a>
        @else
        <a href="{{ route('register') }}"
            class="bg-green-600 rounded p-2 px-6 font-semibold text-white hover:bg-green-500 focus:outline-2 focus:rounded-sm">Register</a>
            <a href="{{ route('login') }}"
            class="bg-green-600 rounded p-2 px-6 font-semibold text-white hover:bg-green-500 focus:outline-2 focus:rounded-sm">Login</a>
        @endauth
    </div>
    @endif
    <div class="cursor cursor-inner d-flex align-items-center justify-content-center">
    </div>
    <div class="cursor cursor-outer"></div>
    <h1>
        <span class="banner-text text-red-500">M</span>
        <span class="banner-text text-orange-500">M</span>
        <span class="banner-text text-yellow-800">S</span>
        <span class="banner-text text-green-500">C</span>
        <span class="banner-text text-blue-500">H</span>
        <span class="banner-text text-indigo-500">O</span>
        <span class="banner-text text-violet-500">O</span>
        <span class="banner-text text-red-500">L</span>
        {{-- <span class="banner-text text-orange-500">Y</span>
        <span class="banner-text text-yellow-500">A</span>
        <span class="banner-text text-green-500">E</span> --}}
    </h1>
    <div class="clockStyle fixed left-1 bottom-1 font-bold" id="clock"></div>
</body>
<script>
    const cursor = document.querySelector(".cursor-inner");
        const cursor2 = document.querySelector(".cursor-outer");

        let bannerTexts = document.querySelectorAll('.banner-text');
        let navLinks = document.querySelectorAll('.nav-link');


        window.addEventListener("mousemove", event => {
            cursor.style.top = event.pageY + "px";
            cursor.style.left = event.pageX + "px";

            cursor2.style.top = event.pageY + "px";
            cursor2.style.left = event.pageX + "px";

        })

        bannerTexts.forEach(bannerText => {
            bannerText.addEventListener("mouseover", () => {
                cursor2.classList.add("cursorHoverNav");
                bannerText.classList.add("bounce");
                bannerText.classList.add("hoverColor");
                setTimeout(function(){
                    bannerText.classList.remove("bounce");
                }.bind(bannerText),1000)
            });
            bannerText.addEventListener("mouseleave", () => {
                cursor2.classList.remove("cursorHoverNav");
                bannerText.classList.remove("hoverColor");
            })
        });
</script>

</html>
