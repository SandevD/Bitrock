<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap4.min.css" />

    <!--Aos Css-->
    <link href="/assets/css/aos.css" rel="stylesheet">

    <link rel="icon" href="/assets/img/arrow.png">

    <link rel="stylesheet" href="/assets/css/bitrock.css" />
    <link rel="stylesheet" href="/assets/css/fonts.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="/assets/js/bitrock.js" />
    <script src="/assets/js/3.6.0.jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Handjet:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">

    <title>BITROCK</title>
</head>

<body>
    <!--Navbar-->
    <section id="navbar">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-around p-2" id="navbarNavAltMarkup">
                    <div class="navbar-nav sticky" style="font-weight: 500;">
                        <a class="nav-link text-light" style="margin-right: 100px;" href="#aboutus">ABOUT US</a>
                        <a class="nav-link text-light" style="margin-right: 100px;" href="#portfolio">PORTFOLIO</a>
                        <a class="nav-link text-light" style="margin-right: 100px;" href="#main">HOME</a>
                        <a class="nav-link text-light" style="margin-right: 100px;" href="#bulletin">BULLETIN</a>
                        <a class="nav-link text-light" href="#contactus">CONTACT US</a>
                    </div>
                </div>
                @if (auth()->check())
                    <!--<a class="nav-link float-right" style="font-size:13px;" id="logbtn" href="{{ route('login') }}">
                    //{{ auth()->user()->fname }}
                    <i class="bi bi-person-circle" style="font-size:15px;"></i>
                    <i class="bi bi-chevron-double-right"></i>
                    </a>-->
                    <div class="btn-group" style="">
                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-person-lines-fill px-2 "></i>
                            <span class="text-secondary">{{ auth()->user()->email }}</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('admin.index') }}" style="text-decoration:none;" class="">
                                <button class="dropdown-item text-secondary" style="cursor:pointer;" type="button">
                                    Dashboard
                                </button>
                            </a>
                            <a href="{{ route('changepassword') }}" style="text-decoration:none;"
                                class="text-secondary">
                                <button class="dropdown-item text-secondary" style="cursor:pointer;" type="button">
                                    Reset Password
                                </button>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" style="text-decoration:none;" onclick="logoutForm.submit()">
                                <button class="dropdown-item text-dark" type="button" style="cursor:pointer;">
                                    Logout
                                    <i class="bi bi-arrow-up-right-circle-fill text-dark"></i>
                                </button>
                            </a>
                            <form action="{{ route('logout') }}" id="logoutForm" method="POST">
                                @csrf
                            </form>
                        </div>
                    </div>
                @else
                    <a class="nav-link float-right" id="logbtn" href="{{ route('login') }}">LOGIN</a>
                @endif
            </div>
        </nav>
    </section>

    @if ($countdown == 1)
        <style>
            #countdown {
                position: relative;
                height: 100vh;
                overflow: hidden;
            }

            #countdown video {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                z-index: -1;
            }

            .content {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
                color: white;
                font-size: 30px;
                z-index: 1;
            }

            .content img {
                max-width: 450px;
                /* Adjust the size of the logo as needed */
                display: block;
                margin: 0 auto 20px;
            }

            @media (max-width: 768px) {
                .content {
                    font-size: 20px;
                }

                .content img {
                    max-width: 300px;
                }
            }

            .clock {
                height: 200px;
                width: 900px;
                text-align: center;
            }

            .digit {
                width: 85px;
                height: 150px;
                margin: 0 5px;
                position: relative;
                display: inline-block;
            }

            .digit .segment {
                background: #fff;
                border-radius: 5px;
                position: absolute;
                opacity: 0.05;
                transition: opacity 0.2s;
                -webkit-transition: opacity 0.2s;
                -ms-transition: opacity 0.2s;
                -moz-transition: opacity 0.2s;
                -o-transition: opacity 0.2s;
            }

            .digit .segment.on,
            .separator {
                opacity: 1;
                box-shadow: 0 0 50px #ffffff;
                transition: opacity 0s;
                -webkit-transition: opacity 0s;
                -ms-transition: opacity 0s;
                -moz-transition: opacity 0s;
                -o-transition: opacity 0s;
            }

            .separator {
                width: 12px;
                height: 12px;
                background: #ffffff;
                border-radius: 50%;
                display: inline-block;
                position: relative;
                top: -70px;
            }

            .digit .segment:nth-child(1) {
                top: 10px;
                left: 20px;
                right: 20px;
                height: 10px;
            }

            .digit .segment:nth-child(2) {
                top: 20px;
                right: 10px;
                width: 10px;
                height: 75px;
                height: calc(50% - 25px);
            }

            .digit .segment:nth-child(3) {
                bottom: 20px;
                right: 10px;
                width: 10px;
                height: 75px;
                height: calc(50% - 25px);
            }

            .digit .segment:nth-child(4) {
                bottom: 10px;
                right: 20px;
                height: 10px;
                left: 20px;
            }

            .digit .segment:nth-child(5) {
                bottom: 20px;
                left: 10px;
                width: 10px;
                height: 75px;
                height: calc(50% - 25px);
            }

            .digit .segment:nth-child(6) {
                top: 20px;
                left: 10px;
                width: 10px;
                height: 75px;
                height: calc(50% - 25px);
            }

            .digit .segment:nth-child(7) {
                bottom: 95px;
                bottom: calc(50% - 5px);
                right: 20px;
                left: 20px;
                height: 10px;
            }

            .stay-tuned {
                margin-top: 5rem;
                font-family: 'Ubuntu', sans-serif;
                font-size: 3.5rem;
            }

            #laptop-count {
                display: block;
            }

            #mobile-count {
                display: none;
            }

            @media (max-width: 500px) {

                #laptop-count {
                    display: none;
                }

                #mobile-count {
                    display: block;
                }

                .clock {
                    height: 200px;
                    width: 300px;
                    text-align: center;
                }

                .digit {
                    width: 64px;
                    height: 90px;
                    margin: 0;
                    position: relative;
                    display: inline-block;
                }

                .digit .segment {
                    opacity: 0.1;
                }

                .separator {
                    width: 4px;
                    height: 4px;
                    top: -45px;
                }

                .digit .segment:nth-child(1) {
                    height: 6px;
                }

                .digit .segment:nth-child(2) {
                    width: 6px;
                }

                .digit .segment:nth-child(3) {
                    width: 6px;
                }

                .digit .segment:nth-child(4) {
                    height: 6px;
                }

                .digit .segment:nth-child(5) {
                    width: 6px;
                }

                .digit .segment:nth-child(6) {
                    width: 6px;
                }

                .digit .segment:nth-child(7) {
                    height: 6px;
                }

                #clock-time {
                    display: none;
                }

                .stay-tuned {
                    font-size: 2rem;
                }
            }
        </style>
        <section id="countdown">
            <video autoplay loop>
                <source src="assets/img/fire.mp4" type="video/mp4">
            </video>
            <div class="content">
                <!-- Your content goes here -->
                <img src="{{ asset('assets/img/Logo.png') }}" alt="Logo">
                <div id="laptop-count" class="clock">
                    <div class="digit days">
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                    </div>

                    <div class="digit days">
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>

                    </div>

                    <div class="separator"></div>

                    <div class="digit hours">
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                    </div>

                    <div class="digit hours">
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                    </div>

                    <div class="separator"></div>

                    <div class="digit minutes">
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                    </div>

                    <div class="digit minutes">
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                    </div>

                    <div class="separator"></div>

                    <div class="digit seconds">
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                    </div>

                    <div class="digit seconds">
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                        <div class="segment"></div>
                    </div>
                </div>
                <div id="mobile-count" class="clock">
                    <div>
                        <div>
                            <div class="digit days-m">
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                            </div>

                            <div class="digit days-m">
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>

                            </div>

                            <div class="separator"></div>

                            <div class="digit hours-m">
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                            </div>

                            <div class="digit hours-m">
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                            </div>
                        </div>
                        <div class="row" style="font-family: 'Handjet', cursive;">
                            <div class="col">DAYS</div>
                            <div class="col">HOURS</div>
                        </div>
                    </div>
                    <div>
                        <div>
                            <div class="digit minutes-m">
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                            </div>

                            <div class="digit minutes-m">
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                            </div>

                            <div class="separator"></div>

                            <div class="digit seconds-m">
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                            </div>

                            <div class="digit seconds-m">
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                                <div class="segment"></div>
                            </div>
                        </div>
                        <div class="row" style="font-family: 'Handjet', cursive;">
                            <div class="col">MINUTES</div>
                            <div class="col">SECONDS</div>
                        </div>
                    </div>
                </div>
                <div id="clock-time" class="row mx-2" style="font-family: 'Handjet', cursive;">
                    <div class="col">DAYS</div>
                    <div class="col">HOURS</div>
                    <div class="col">MINUTES</div>
                    <div class="col">SECONDS</div>
                </div>
                <div class="stay-tuned">
                    STAY TUNED!
                </div>
            </div>
        </section>
        <script>
            var digitSegments = [
                [1, 2, 3, 4, 5, 6],
                [2, 3],
                [1, 2, 7, 5, 4],
                [1, 2, 7, 3, 4],
                [6, 7, 2, 3],
                [1, 6, 7, 3, 4],
                [1, 6, 5, 4, 3, 7],
                [1, 2, 3],
                [1, 2, 3, 4, 5, 6, 7],
                [1, 2, 7, 3, 6, 4],
            ]

            document.addEventListener('DOMContentLoaded', function() {
                var _days = document.querySelectorAll('.days');
                var _hours = document.querySelectorAll('.hours');
                var _minutes = document.querySelectorAll('.minutes');
                var _seconds = document.querySelectorAll('.seconds');

                //Mobile
                var _days_m = document.querySelectorAll('.days-m');
                var _hours_m = document.querySelectorAll('.hours-m');
                var _minutes_m = document.querySelectorAll('.minutes-m');
                var _seconds_m = document.querySelectorAll('.seconds-m');

                function updateCountdown() {
                    var targetDate = new Date(2023, 7, 27, 12, 0,
                    0); // August is 7 (zero-indexed), 13th, 2023, 12:00 PM
                    var currentDate = new Date();
                    var timeDifference = targetDate - currentDate;

                    if (timeDifference <= 0) {
                        // If the target date has passed, you may choose to handle it here
                        // For example, display a message or take any action you need.
                        return;
                    }

                    var days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

                    setNumber(_days[0], Math.floor(days / 10), 1);
                    setNumber(_days[1], days % 10, 1);

                    setNumber(_hours[0], Math.floor(hours / 10), 1);
                    setNumber(_hours[1], hours % 10, 1);

                    setNumber(_minutes[0], Math.floor(minutes / 10), 1);
                    setNumber(_minutes[1], minutes % 10, 1);

                    setNumber(_seconds[0], Math.floor(seconds / 10), 1);
                    setNumber(_seconds[1], seconds % 10, 1);
                }

                setInterval(updateCountdown, 1000);
                updateCountdown();

                function updateCountdownMobile() {
                    var targetDate = new Date(2023, 7, 27, 12, 0,
                        0); // August is 7 (zero-indexed), 13th, 2023, 12:00 PM
                    var currentDate = new Date();
                    var timeDifference = targetDate - currentDate;

                    if (timeDifference <= 0) {
                        // If the target date has passed, you may choose to handle it here
                        // For example, display a message or take any action you need.
                        return;
                    }

                    var days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

                    setNumberM(_days_m[0], Math.floor(days / 10), 1);
                    setNumberM(_days_m[1], days % 10, 1);

                    setNumberM(_hours_m[0], Math.floor(hours / 10), 1);
                    setNumberM(_hours_m[1], hours % 10, 1);

                    setNumberM(_minutes_m[0], Math.floor(minutes / 10), 1);
                    setNumberM(_minutes_m[1], minutes % 10, 1);

                    setNumberM(_seconds_m[0], Math.floor(seconds / 10), 1);
                    setNumberM(_seconds_m[1], seconds % 10, 1);
                }

                setInterval(updateCountdownMobile, 1000);
                updateCountdownMobile();
            });

            var setNumber = function(digit, number, on) {
                var segments = digit.querySelectorAll('.segment')
                var current = parseInt(digit.getAttribute('data-value'))

                // only switch if number has changed or wasn't set
                if (!isNaN(current) && current != number) {
                    // unset previous number
                    digitSegments[current].forEach(function(digitSegment, index) {
                        setTimeout(function() {
                            segments[digitSegment - 1].classList.remove('on')
                        }, index * 45)
                    })
                }

                if (isNaN(current) || current != number) {
                    // set new number after
                    setTimeout(function() {
                        digitSegments[number].forEach(function(digitSegment, index) {
                            setTimeout(function() {
                                segments[digitSegment - 1].classList.add('on')
                            }, index * 45)
                        })
                    }, 250)
                    digit.setAttribute('data-value', number)
                }
            }


            var setNumberM = function(digit, number, on) {
                var segments = digit.querySelectorAll('.segment')
                var current = parseInt(digit.getAttribute('data-value'))

                // only switch if number has changed or wasn't set
                if (!isNaN(current) && current != number) {
                    // unset previous number
                    digitSegments[current].forEach(function(digitSegment, index) {
                        setTimeout(function() {
                            segments[digitSegment - 1].classList.remove('on')
                        }, index * 45)
                    })
                }

                if (isNaN(current) || current != number) {
                    // set new number after
                    setTimeout(function() {
                        digitSegments[number].forEach(function(digitSegment, index) {
                            setTimeout(function() {
                                segments[digitSegment - 1].classList.add('on')
                            }, index * 45)
                        })
                    }, 250)
                    digit.setAttribute('data-value', number)
                }
            }
        </script>
    @else
        <section id="main" class="bg-dark">
            <div id="block2" style="width: 100%;">
                <div class="wclb">
                    <div class="text-light text-center d-flex justify-content-center ">
                        <img id="main-logo" src="{{ asset('assets/img/Logob.png') }}" alt="">
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section id="aboutus">
        <div class="container-fluid">
            <div class="row">
                <div id="colab" class="col-md" data-aos="fade-up" data-aos-duration="800" align="right"
                    style="margin:auto; font-size: 36px;">
                    <p class="about p-xl-5 p-lg-4 p-md-3 p-sm-2 m-xl-5 text-center text-md-right">
                        @if ($contents->where('type', 'about')?->first()?->value)
                            {!! sprintf(
                                '%1$s <span style="color: #f0870e;">%2$s</span> %3$s <span style="color: #f0870e;">%4$s</span>',
                                $contents->where('type', 'about')?->first()?->value?->section_one,
                                $contents->where('type', 'about')?->first()?->value?->section_two,
                                $contents->where('type', 'about')?->first()?->value?->section_three,
                                $contents->where('type', 'about')?->first()?->value?->section_four,
                            ) !!}
                    </p>
                @else
                    (no content yet)
                    @endif
                </div>
                <div id="colab" class="col-md text-light " align="left" style=" background-color: #000;">
                    <p
                        class="aboutpara p-xl-5 p-lg-4 p-md-3 p-sm-2 m-xl-5 d-flex flex-column text-center text-md-left">
                        <span class="abouthead mb-3">ABOUT US</span>
                        <span
                            class="aboutp p-0">{{ $contents->where('type', 'about')?->first()?->value?->description ?? '(no about us yet)' }}</span>
                    </p>
                </div>
            </div>
        </div>
        </div>
    </section>

    <section id="portfolio" class="bg-light"><br />
        <p align="center" class="porttitle"><span
                style="background-color:#000; padding: 1rem; border-radius: 20px; opacity: 0.9;">PORTFOLIO</span></p>
        <div class="container-fluid" style="padding:1rem; ">
            <div class="row port1">
                <div class="col-md p1col1" align="right" id="card">
                    <div class="top" style="display:block;  font-family: Poppins-SemiBold;">
                        <p>
                            {{ $contents->where('type', 'portfolio')?->first()?->value?->title1 ?? '(no portfolio yet)' }}
                        </p>
                    </div>
                    <div class="under" style="display: none; ">
                        <p class="cardpara p-4">
                            {{ $contents->where('type', 'portfolio')?->first()?->value?->description1 ?? '(no portfolio yet)' }}
                        </p>
                    </div>
                </div>
                <div class="col-md p1col2" id="card1">
                    <div class="top1" style="display:block;  font-family: Poppins-SemiBold;">
                        <p>
                            {{ $contents->where('type', 'portfolio')?->first()?->value?->title2 ?? '(no portfolio yet)' }}
                        </p>
                    </div>
                    <div class="under1" style="display: none;  ">
                        <p class="cardpara p-4">
                            {{ $contents->where('type', 'portfolio')?->first()?->value?->description2 ?? '(no portfolio yet)' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row port2">
                <div class="col-md p2col1" align="right" id="card2">
                    <div class="top2" style="display:block;  font-family: Poppins-SemiBold;">
                        <p>
                            {{ $contents->where('type', 'portfolio')?->first()?->value?->title3 ?? '(no portfolio yet)' }}
                        </p>
                    </div>
                    <div class="under2" style="display: none;  ">
                        <p class="cardpara p-4">
                            {{ $contents->where('type', 'portfolio')?->first()?->value?->description3 ?? '(no portfolio yet)' }}
                        </p>
                    </div>
                </div>
                <div class="col-md p2col2" id="card3">
                    <div class="top3" style="display:block;  font-family: Poppins-SemiBold;">
                        <p>
                            {{ $contents->where('type', 'portfolio')?->first()?->value?->title4 ?? '(no portfolio yet)' }}
                        </p>
                    </div>
                    <div class="under3" style="display: none; ">
                        <p class="cardpara p-4">
                            {{ $contents->where('type', 'portfolio')?->first()?->value?->description4 ?? '(no portfolio yet)' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $("#card").mouseenter(function() {
                $(".under").show();
                $(".top").hide();
            }).mouseleave(function() {
                $(".under").hide();
                $(".top").show();
            });
            $("#card1").mouseenter(function() {
                $(".under1").show();
                $(".top1").hide();
            }).mouseleave(function() {
                $(".under1").hide();
                $(".top1").show();
            });
            $("#card2").mouseenter(function() {
                $(".under2").show();
                $(".top2").hide();
            }).mouseleave(function() {
                $(".under2").hide();
                $(".top2").show();
            });
            $("#card3").mouseenter(function() {
                $(".under3").show();
                $(".top3").hide();
            }).mouseleave(function() {
                $(".under3").hide();
                $(".top3").show();
            });
        </script>
    </section>

    <section id="whyus">
        <div class="container-fluid">
            <div class="row">

                <div id="colab" class="col-md text-light " align="right"
                    style=" background-color: #000; font-size:35px;">
                    <p class="whyuspara p-xl-5 py-lg-4 py-md-3 p-sm-2 m-xl-5">
                        <span class="whyushead">WHY US </span>
                        <br /><br />
                        <span class="whyusp">
                            {{ $contents->where('type', 'whyus')?->first()?->value?->description ?? '(no content yet)' }}
                        </span>

                    </p>
                </div>
                <div id="colab" class="col-md " data-aos="fade-up" data-aos-duration="800"
                    style="margin:auto; font-size: 36px;">
                    <p class="whyus p-xl-5 p-lg-4 p-md-3 p-sm-2 m-xl-5">
                        @if ($contents->where('type', 'whyus')?->first()?->value)
                            {!! sprintf(
                                '%1$s <span style="color: #f0870e;">%2$s</span> %3$s <span style="color: #f0870e;">%4$s</span>',
                                $contents->where('type', 'whyus')?->first()?->value?->section_one,
                                $contents->where('type', 'whyus')?->first()?->value?->section_two,
                                $contents->where('type', 'whyus')?->first()?->value?->section_three,
                                $contents->where('type', 'whyus')?->first()?->value?->section_four,
                            ) !!}
                    </p>
                @else
                    (no content yet)
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section id="social" class="bg-dark">
        <div id="block4" class="p-5">
            <div>
                <div class="elfsight-app-77f2d792-1632-4982-a4bb-f5d9ce36898a"></div>
            </div>
        </div>
    </section>

    <section id="bulletin" class="pt-5"
        style="width: 100%;background-color: #000;color: #fff; font-family: 'Montserrat'; font-weight: 400;">
        <style>
            strong {
                font-weight: 700;
            }

            .subtitle {
                font-size: 0.85rem;
                font-weight: 700;
                margin: 0;
                color: #1792d2;
                letter-spacing: 0.05em;
                font-family: "Montserrat";
                font-weight: 400;
            }

            .article-title {
                font-size: 1.5rem;
                font-family: "Montserrat";
                font-weight: 400;
            }

            .article-read-more,
            .article-info {
                font-size: .875rem;
            }

            .article-read-more {
                color: #1792d2;
                text-decoration: none;
                font-weight: 700;
            }

            .article-read-more:hover,
            .article-read-more:focus {
                color: #143774;
                text-decoration: underline;
            }

            .article-info {
                margin: 2em 0;
            }

            .container-flex {
                max-width: 90vw;
                margin: 0 auto;
                display: flex;
                justify-content: space-between;
            }

            img {
                max-width: 60%;
                display: block;
            }

            main {
                max-width: 75%;
            }

            .article-body {
                width: 100%;
                text-align: justify;
                font-family: "Montserrat";
                font-weight: 400;
            }

            .sidebar {
                max-width: 23%;
            }

            footer a {
                text-decoration: none;
                color: white;
            }

            footer a:hover {
                text-decoration: underline;
                color: white;
            }

            @media (max-width:1050px) {
                .container-flex {
                    flex-direction: column;
                }

                .site-title,
                .subtitle {
                    width: 100%;
                }

                main {
                    max-width: 100%;
                }

                .sidebar {
                    max-width: 100%;
                }

            }

            /* articles */
            .article-featured {
                border-bottom: #707070 1px solid;
                padding-bottom: 2em;
                margin-bottom: 2em;
                font-family: "Montserrat";
                font-weight: 400;
            }

            .article-recent {
                display: flex;
                flex-direction: column;
                margin-bottom: 2em;
            }

            .article-recent-main {
                order: 2;
            }

            .article-recent-secondary {
                order: 1;
            }

            .bit-img {
                width: 100%;
            }

            .newsl__img {
                display: flex;
                justify-content: center;
            }

            @media (min-width: 675px) {
                .article-recent {
                    flex-direction: row;
                    justify-content: space-between;
                }

                .article-recent-main {
                    width: 68%;
                }

                .article-recent-secondary {
                    width: 30%;
                }

                .bit-img {
                    width: 35%;
                }
            }
        </style>
        <div class="container container-flex flex-column justify-content-center align-items-center">
            <img src="{{ asset('assets/img/btr.png') }}" alt="the bitrock bulletin" class="bit-img">

            <p class="article-info">Since 2022 | By Bitrock</p>
        </div>
        <style>
            body {
                --text-color: #eee;
                --secondary-color: #f0870e;
                --bkg-color: #121212;
            }

            .newsl {
                font-family: "Montserrat";
                margin: 40px auto;
                text-align: left;
                width: 90vw;
                max-width: 88vw;
                height: auto;
                padding: 10px;
                border-radius: 1.5em;
                border: 2px solid var(--text-color);
                display: flex;
                align-items: center;
                flex-wrap: wrap;
            }

            .newsl__img {
                width: 40%;
                padding: 10px;
            }

            .newsl__content {
                width: 60%;
                padding: 10px;
            }

            .newsl__img--dark {
                display: inline;
                width: 100%;
                vertical-align: top;
            }

            .newsl__title {
                font-size: 1.5em;
                font-weight: 500;
                line-height: 32px;
                margin: 5px 0;
            }

            .newsl__text {
                margin: 20px 0;
            }

            .newsl__input {
                border: 2px solid #969696;
                width: 80%;
                margin-bottom: 10px;
                font-family: "Poppins", sans-serif;
                padding: 6px;
                border-radius: 0.4em;
                outline: none;
            }

            .newsl__btn {
                width: 80%;
                background-color: var(--secondary-color);
                border: none;
                border-radius: 0.4em;
                padding: 10px;
                font-weight: 500;
                font-size: 1em;
                color: #fbfbfb;
                font-family: "Poppins", sans-serif;
            }

            @media screen and (max-width: 600px) {

                .newsl__img,
                .newsl__content,
                .newsl__input,
                .newsl__btn {
                    width: 100%;
                }
            }
        </style>
        <div class="newsl">
            <div class="newsl__img">
                <img id="normal" class="newsl__img--dark" src="{{ asset('assets/img/subscribe.png') }}"
                    alt="">
                <img id="cry" class="newsl__img--dark" src="{{ asset('assets/img/cry.png') }}" alt=""
                    style="display: none;">
            </div>

            <div id="subsDiv" class="newsl__content">
                <h2 class="newsl__title"><span style="color:#FF8201;">Subscribe</span> to our Bitrock Bulletin!</h2>
                <p class="newsl__text">
                    Ready to level up your financial game? Subscribe to our weekly Telegram newsletter, the "Bitrock
                    Bulletin."
                </p>
                <p class="newsl__text">
                    Get exclusive insights by subscribing to our convenient weekly digest, packed with valuable
                    educational content on stocks, crypto, investing, and personal development.
                </p>
                <p class="newsl__text">
                    At only <span style="color:#FF8201;">LKR 399</span> per month, you don’t want to miss out!
                </p>
                <form action='{{ route('newsletter.subscribe') }}' method='GET'>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="first_name" class="form-control" placeholder="First Name"
                                name="first_name" required><br />
                        </div>
                        <div class="col">
                            <input type="text" id="last_name" class="form-control" placeholder="Last Name"
                                name="last_name" required><br />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="email" id="dp_email" class="form-control" placeholder="Email"
                                name="dp_email" required><br />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="dp_telegram" class="form-control"
                                placeholder="Telegram Number" name="dp_telegram" required><br />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-block" id="cbtn">Submit</button>

                    <br />
                    <span>
                        Already Subcribed ? <span style="color:#FF8201; cursor: pointer;" onclick="showUnSubscribe()"
                            onmouseover="this.style.textDecoration = 'underline';"
                            onmouseout="this.style.textDecoration = 'none';">Unsubscribe</span>
                    </span>
                </form>
            </div>

            <div id="unsubsDiv" class="newsl__content" style="display: none;">
                <h2 class="newsl__title"><span style="color:#FF8201;">Unsubscribe</span> from Bitrock Bulletin</h2>
                <p class="newsl__text">
                    To unsubscribe from Bitrock Bulletin please fill the below details and submit a request, our team
                    will contact you and do the needfull through telegram.
                </p>
                <p class="newsl__text">
                    It’s not all bad news though - there’s still time to <span style="color:#FF8201;">reconsider</span>
                    your decision.
                </p>
                <form action='{{ route('newsletter.unsubscribe') }}' method='GET'>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="first_name" class="form-control" placeholder="First Name"
                                name="first_name" required><br />
                        </div>
                        <div class="col">
                            <input type="text" id="last_name" class="form-control" placeholder="Last Name"
                                name="last_name" required><br />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="email" id="dp_email" class="form-control" placeholder="Email"
                                name="dp_email" required><br />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="dp_telegram" class="form-control"
                                placeholder="Telegram Number" name="dp_telegram" required><br />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="transaction_no" class="form-control"
                                placeholder="Transaction No" name="transaction_no" required><br />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-block" id="cbtn">Unsubscribe</button>

                    <br />
                    <span>
                        Not subscribed yet ? Hurry Now, <span style="color:#FF8201; cursor: pointer;"
                            onclick="showSubscribe()" onmouseover="this.style.textDecoration = 'underline';"
                            onmouseout="this.style.textDecoration = 'none';">Subscribe</span>
                    </span>
                </form>
            </div>
        </div>
        <script>
            function showUnSubscribe() {
                const subscribe = document.getElementById('subsDiv');
                subscribe.style.display = 'none';
                const s_img = document.getElementById('normal');
                s_img.style.display = 'none';
                const unsubscribe = document.getElementById('unsubsDiv');
                unsubscribe.style.display = 'block';
                const u_img = document.getElementById('cry');
                u_img.style.display = 'block';
            }

            function showSubscribe() {
                const unsubscribe = document.getElementById('unsubsDiv');
                unsubscribe.style.display = 'none';
                const u_img = document.getElementById('cry');
                u_img.style.display = 'none';
                const subscribe = document.getElementById('subsDiv');
                subscribe.style.display = 'block';
                const s_img = document.getElementById('normal');
                s_img.style.display = 'block';
            }
        </script>

        <div class="container container-flex">
            <main role="main">
                <article class="article-featured">
                    <p class="article-body">The Bitrock Bulletin is a weekly newsletter about stocks, crypto and
                        investing brought to you by Bitrock.

                        Every week, we'll be doing a complete rundown on what's trending in the world of stocks and
                        crypto—and how you can take advantage of it. It'll include tips and tricks for making better
                        investment decisions, as well as information about the latest trends in the world of finance and
                        Bitcoin.</p>
                    <p class="article-read-more">DISCLAIMER</p>
                    <p class="article-body">This is not financial advice and BITROCK is not a registered financial
                        advisor. Our content is intended to be used and must be used for informational purposes only and
                        shall not be construed as a recommendation to buy or sell any security or financial product, or
                        to participate in any particular trading or investment strategy.</p>
                </article>

                <article class="article-recent">
                    <div class="article-recent-main">
                        <h2 class="article-title">Refund/Cancellation Policy</h2>
                        <p class="article-body font-italic">Customers are eligibile for cancellation of their
                            subscription at any time via customer service contact information. Cancellation will come
                            into effect from the next month onwards and there will be no full or partial refunds after
                            the month has commenced. </p>
                    </div>
                    <div class="article-recent-secondary">
                        <p class="article-info">April 01, 2023 | Latest Release</p>
                    </div>
                </article>

                <article class="article-recent">
                    <div class="article-recent-main">
                        <h2 class="article-title">Delivery Policy</h2>
                        <p class="article-body font-italic">Bitrock uses a private telegram channel to manage the newsletter delivery.  After subscribing to our newsletter, you will promptly gain access to the Telegram group within a single business day</p>
                    </div>
                    <div class="article-recent-secondary">
                        <p class="article-info">April 01, 2023 | Latest Release</p>
                    </div>
                </article>
            </main>
            <aside class="sidebar">
                <div class="sidebar-widget">
                    <img src="{{ asset('assets/img/c.jpg') }}"
                        alt="a green plant in a clear, round vase with water in it" class="widget-image">
                    <h5 class="article-read-more" style="padding-top: 2rem;">CONTACT INFORMATION</h5>
                    <div class="widget-recent-post">
                        <p class="widget-body">If you have any questions, concerns, or requests regarding this Data
                            Privacy Policy or the handling of your personal data, please contact us at - </p>
                        <p class="widget-body">damiru@thisisbitrock.com <br /> +94 76 600 1064 </p>
                    </div>
                    <div class="widget-recent-post">
                        <p class="widget-body ">By subscribing to our newsletter, you acknowledge that you have read
                            and
                            understood this Data Privacy Policy and agree to the collection, use, and disclosure of your
                            personal data as described herein.</p>
                    </div>
                </div>

                <div class="sidebar-widget">
                    <h5 class="article-read-more">TRANSACTION CURRENCY</h5>
                    <p class="widget-body">Sri Lankan Ruppee (Rs.)</p>
                </div>
            </aside>
        </div>

        <div class="container container-flex">
            <main role="main">
                <article class="article-featured">
                    <h5 class="article-read-more">DATA PRIVACY POLICY</h5>
                    <p class="article-body">At Bitrock, we take your privacy and the security of your personal
                        information seriously. This Data Privacy Policy explains how we collect, use, disclose, and
                        protect the personal data you provide to us when subscribing to our newsletter through our
                        website. By subscribing to our newsletter, you consent to the practices outlined in this policy.
                    </p>
                </article>

                <article class="article-recent">
                    <div class="article-recent-main">
                        <h2 class="article-title">Information We Collect</h2>
                        <p class="article-body font-italic">
                            When you subscribe to our newsletter, we collect the following
                            information:<br />
                            Full name<br />
                            Email address<br />
                            residential address<br />
                            Contact number</p>
                    </div>
                    <div class="article-recent-secondary">
                        <p class="article-info">April 01, 2023 | Latest Release</p>
                    </div>
                </article>

                <article class="article-recent">
                    <div class="article-recent-main">
                        <h2 class="article-title">Use of Personal Data</h2>
                        <p class="article-body font-italic">
                            We use the personal data you provide to:<br />
                            Send you our newsletter and updates on financial market-related topics.
                            Communicate with you regarding your subscription and any changes or updates related to our
                            newsletter.
                            Improve our newsletter content, delivery, and overall user experience.</p>
                    </div>
                    <div class="article-recent-secondary">
                        <p class="article-info">April 01, 2023 | Latest Release</p>
                    </div>
                </article>

                <article class="article-recent">
                    <div class="article-recent-main">
                        <h2 class="article-title">Data Disclosure</h2>
                        <p class="article-body font-italic">
                            We do not sell, trade, or otherwise transfer your personal data to outside parties without
                            your explicit consent, except in the following circumstances:<br />
                            When required by law or in response to a valid legal request.<br />
                            To protect our rights, property, or safety, or the rights, property, or safety of
                            others.<br />
                            In connection with a merger, acquisition, or sale of all or a portion of our business.</p>
                    </div>
                    <div class="article-recent-secondary">
                        <p class="article-info">April 01, 2023 | Latest Release</p>
                    </div>
                </article>

                <article class="article-recent">
                    <div class="article-recent-main">
                        <h2 class="article-title">You Have The Right To</h2>
                        <p class="article-body font-italic">
                            Access and review the personal data we hold about you.<br />
                            Request correction of any inaccurate or incomplete personal data.<br />
                            Request deletion of your personal data from our records.<br />
                            Object to the processing of your personal data for specific purposes.<br />
                            Withdraw your consent for the processing of your personal data.</p>
                    </div>
                    <div class="article-recent-secondary">
                        <p class="article-info">April 01, 2023 | Latest Release</p>
                    </div>
                </article>

                <article class="article-recent">
                    <div class="article-recent-main">
                        <h2 class="article-title">Changes To This Privacy Policy</h2>
                        <p class="article-body font-italic">
                            We reserve the right to update or modify this Data Privacy Policy at any time. Any changes
                            will be effective immediately upon posting the revised policy on our website. We encourage
                            you to review this policy periodically to stay informed about our data practices.</p>
                    </div>
                    <div class="article-recent-secondary">
                        <p class="article-info">April 01, 2023 | Latest Release</p>
                    </div>
                </article>
            </main>

            <aside class="sidebar">
                <div class="sidebar-widget">
                    <img src="{{ asset('assets/img/dp.jpg') }}"
                        alt="a green plant in a clear, round vase with water in it" class="widget-image">
                    <h5 class="article-read-more" style="padding-top: 2.5rem;">DATA RETENTION</h5>
                    <p class="widget-body">We retain your personal data for as long as necessary to fulfill the
                        purposes outlined in this policy, or as required by applicable laws and regulations. If you wish
                        to unsubscribe from our newsletter, your personal data will be promptly deleted from our records
                        upon your request.</p>
                </div>

                <div class="sidebar-widget">
                    <h5 class="article-read-more">
                        THIRD-PARTY SERVICE PROVIDEERS
                    </h5>
                    <div class="widget-recent-post">
                        <p class="widget-body">We may engage third-party service providers to assist with the delivery
                            of our newsletter or other related services. These service providers will have access to
                            your personal data only to the extent necessary to perform their functions, and they are
                            obligated to maintain the confidentiality and security of your information.</p>
                    </div>
                    <h5 class="article-read-more">
                        DATA SECURITY
                    </h5>
                    <div class="widget-recent-post">
                        <p class="widget-body">We implement appropriate technical and organizational measures to
                            protect your personal data from unauthorized access, disclosure, alteration, or destruction.
                            However, please note that no method of transmission over the internet or electronic storage
                            is completely secure, and we cannot guarantee absolute security.</p>
                    </div>
                </div>
            </aside>
        </div>
    </section>

    <section id="documents" style="width: 100%; background-color: #000;">
        <div id="block6" class="container p-5">
            <div class="row mb-4 d-flex flex-row justify-content-center">
                <span class="whyushead" style="font-family: Montserrat">DOWNLOAD DOCUMENTS </span>
            </div>
            <div class="row">
                @forelse ($documents as $document)
                    <div class="col-sm-12 col-md-4 d-flex flex-row justify-content-center"
                        style="width:100%; margin-top: 1rem;">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                <div class="row d-flex justify-content-between mx-1">
                                    <h6 class="card-title"><mark class="mr-1 px-2 rounded text-white"
                                            style="font-size: 14px; background-color:#f0870e; opacity: 0.8; text-transform: uppercase;">{{ $document->category }}</mark>
                                    </h6>
                                    <h6 class="card-title d-flex justify-content-center">{{ $document->name }}</h6>
                                </div>
                                <div class="row d-flex justify-content-between mx-1">
                                    <iframe src="/assets/docs/{{ $document->file }}" width="100%"
                                        height="180"></iframe>
                                </div>
                                <div class="row d-flex justify-content-between mx-1">
                                    <a href="/assets/docs/{{ $document->file }}" class="card-link">View Online</a>
                                    <a href="/assets/docs/{{ $document->file }}" class="card-link"
                                        download>Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col d-flex flex-row justify-content-center text-light">No Documents Yet</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="contactus" class="bg-dark">
        <div id="block5" class="container-fluid" style="width: 100%; background-color: #000;">
            <div class="row">
                <div id="colab" class="col-md text-light" style=" background-color: #000; margin: auto;"
                    style="font-size: 15px; font-family: Montserrat" align="center">
                    <p>
                        <b>
                            <img src="/assets/img/mail2.gif" height="100px" width="100px"><br />
                            <span
                                style="color: #f0870e; font-size: 35px;
                            font-family: Montserrat">CONTACT
                                US</span><br /><br />
                            <span>{{ $contents->where('type', 'contactus')?->first()?->value?->address ?? '(no address yet)' }}</span><br /><br />
                            <span>{{ $contents->where('type', 'contactus')?->first()?->value?->contact ?? '(no contact no. yet)' }}</span><br />

                        </b>
                    </p>
                </div>
                <div id="colab" class="col-md text-light "
                    style=" background-color: #000; font-size:35px; margin: auto;"><br /><br />
                    <div class="container-fluid">
                        <h4 class="sent-notification"></h4>
                        <form action="{{ route('send.email') }}" method="POST" class="contactform">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <input type="text" id="name" class="form-control" placeholder="Name"
                                        name="name" required>
                                </div>
                                <div class="col">
                                    <input type="email" id="email" class="form-control"
                                        id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email"
                                        name="email" required>
                                </div>
                            </div><br />
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Phone" name="phone">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Address" name="address"
                                        required>
                                </div>
                            </div><br />
                            <div class="row">
                                <div class="col">
                                    <input type="text" id="subject" class="form-control" placeholder="Subject"
                                        name="subject" required>
                                </div>
                            </div><br />
                            <div class="row">
                                <div class="col">
                                    <textarea class="form-control" id="body" rows="3" placeholer="Type your message here..." name="message"
                                        required></textarea>
                                </div>
                            </div><br />
                            <div class="row" align="center">
                                <div class="col">
                                    <button type="submit" class="btn btn-block" id="cbtn">Submit</button>
                                </div>
                            </div><br /><br />

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footerdata"
            style="display:flex;align-content:center;justify-content:space-between; padding-left: 2rem; padding-right: 2rem;font-family: Montserrat">
            <div>
                <span>{{ $contents->where('type', 'footer')?->first()?->value?->section_one ?? '(no content yet)' }}
                    <a href="{{ route('welcome.index') }}" style="color:#f0870e;">
                        {{ $contents->where('type', 'footer')?->first()?->value?->section_two ?? '(no content yet)' }}
                    </a>
                </span>
            </div>
            <div>
                <a href="#bulletin" style="color:#f0870e; font-family: Montserrat; ">
                    The Bitrock Bulletin
                </a>
            </div>
        </div>
    </footer>

    <div id="cookie_alert" class="card cookie-alert">
        <div class="card-body">
            <h5 class="card-title">&#x1F36A; Manage Cookie Consent</h5>
            <p class="card-text">We may use cookies and similar tracking technologies to enhance your browsing
                experience and collect information about how you interact with our website. For more information, please
                refer to our Cookie Policy.</p>
            <div class="btn-toolbar justify-content-end">
                <a href="#bulletin" class="btn btn-link" style="font-size: 0.8rem; color: #cc6600;">Bitrock
                    Bulletin</a>
                <a href="#" class="btn btn-primary accept-cookies"
                    style="font-size: 0.8rem; background-color: #ff8201; border: none;">Accept</a>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>-->
    <script src="/assets/js/bootstrap4.min.js"></script>
    <script src="/assets/js/popper2.min.js"></script>

    <!--InstagramWidget-->
    <script src="/assets/js/elfsightinstagram.js" defer></script>

    <!--Aos Js-->
    <script src="/assets/js/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!--freeinstragram label remover (!caution)-->
    <!--<script>
        setTimeout(function() {
            document.getElementsByClassName('eapps-link')[0].style.display = 'none';
        }, 1000);
    </script>-->

    <script>
        (function() {
            "use strict";

            var cookieAlert = document.querySelector(".cookie-alert");
            var acceptCookies = document.querySelector(".accept-cookies");
            var bulletin = document.querySelector(".bulletin");

            cookieAlert.offsetHeight;

            if (!getCookie("acceptCookies")) {
                cookieAlert.classList.add("show");
            } else {
                bulletin.classList.add("show");
            }

            acceptCookies.addEventListener("click", function() {
                setCookie("acceptCookies", true, 60);
                cookieAlert.classList.remove("show");
                bulletin.classList.remove("show");
            });
        })();

        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) === ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) === 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
    </script>


    @include('partials.notify')
</body>

</html>
