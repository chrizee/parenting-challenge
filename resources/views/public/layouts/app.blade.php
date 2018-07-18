<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name', 'parenting quiz')}}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Learn about parenting, babies, pregnancy and also take parenting quizzes and baby quizzes" />
    <meta name="keywords" content="parenting, learn parenting, parenting psychology, parenting tips, parenting quiz, pregnancy tips, babies, learn about babies, baby quiz, baby tips, baby quotes, baby facts, child psychology, baby psychology" />
    <meta name="author" content="{{ config('app.author', 'Baby Doctor') }}" />


    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link rel="shortcut icon" type="image/png" href="{{asset('icon.png')}}">
    <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700' rel='stylesheet' type='text/css'> -->

    <!-- Animate.css -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}" >
    <!-- Flexslider  -->
    <link rel="stylesheet" href="{{ asset('css/flexslider.css') }}">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <!-- Theme style  -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Modernizr JS -->
    <script src="{{ asset('js/modernizr-2.6.2.min.js') }}"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->
    <style type="text/css">
        div.ques, div.ques2 {
            text-align: justify;
        }
        div.ques2 {
            border-bottom: 1px dotted brown;
            margin-top: 20px;
        }
        @media (min-width: 992px) {
            div.answer-with-description {
                margin-top:9em;
            }
        }
        input[type="radio"] {
            vertical-align: middle;
            width: 20px;
            height: 20px;
            margin-top: -5px ;
            margin-left: 5px !important;
            margin-right: 5px;
            position: relative !important;
        }
        @if($show)
            .fh5co-property-innter {
                min-height: 180px;
                max-height: 200px;
            }
        @endif
        #fh5co-header nav ul li ul li a, #fh5co-offcanvas ul li ul li a {
            color: #000;
        }
        #fh5co-header nav ul li ul li a:hover, #fh5co-offcanvas ul li ul li a {
            color: #000;
        }
        #fh5co-header nav ul li ul, #fh5co-offcanvas ul li ul li a {
            background-color: azure;
            opacity: 0.9;
        }
        @media (min-width: 386px) {
            small.under {
                position: relative;
                top: 17px;
                left: -220px;
                font-size: 16px;
                color: #F1A5F0;
                font-style: italic;
                font-weight: bold;
                font-family: serif;
            }
        }
        @media (max-width: 447px) {
            small.under span {
                display: none;
            }
        }
        @media (max-width: 385px) {
            small.under {
                display: none;
            }
        }
        span.brown, span.bisque, span.aqua {
            font-size: 50px;
            line-height: 1px;
        }
        span.brown {
            color: brown;
        }
        span.bisque {
            color: bisque;
        }
        span.aqua {
            color: aqua;
        }
        .background1 {
            background: white;
            color: #118DF0 !important;
        }
        .background2 {
            background: #118DF0;
            color: white !important;
        }
        #fh5co-header nav ul li a.quiz {
            transition: backgroundColor 0.05s ease-in-out, color 0.05s ease-in-out;
        }
        #fh5co-header nav ul li a.quiz:hover {
            transform: scale(1.5);
        }
        div.android {
            background: whitesmoke;
            position: fixed;
            bottom: 0;
            margin: 0 auto;
        }
        div.android p {
            vertical-align: middle;
        }
        .fh5co-property .fh5co-property-innter p {
            color: grey;
            font-weight: bold;
            text-align: justify;
        }
        .fh5co-property .fh5co-property-innter p::first-letter {
            font-size: 200%;
        }
        #fh5co-testimonial .item-block blockquote .fh5co-author {
            color: coral;
        }
    </style>
</head>
<body>


<div id="fh5co-page">
    <header id="fh5co-header" role="banner">
        <div class="hidden row android">
            <div style="margin:.5em" class="col-sm-12">
                <i class="close-android pull-right fa fa-times text-danger"></i>
                <p class="text text-center">
                    @if($publicPath == 'babyquiz')
                        <a href="https://play.google.com/store/apps/details?id=com.babyparentingquiz.android" target="_blank">
                            <button style="border-radius: 0px" class="btn btn-info"><i class="fa fa-download"></i> Download</button>
                        </a>
                    @else
                        <a href="https://play.google.com/store/apps/details?id=com.ellalan.certifiedparent" target="_blank">
                            <button style="border-radius: 0px" class="btn btn-info"><i class="fa fa-download"></i> Download</button>
                        </a>
                    @endif
                    our FREE
                    @if($publicPath == "babyquiz")
                        Baby Quiz app to try this quiz offline.
                    @elseif($publicPath == "parentingquiz")
                        Parenting Quiz app to try this quiz offline.
                    @else
                    app to try our quiz offline.
                    @endif
                </p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="header-inner">
                    <h1 style="position: absolute;"><a href="{{ route('index') }}">Improve<span>Parenting.</span><small class="under">Take quiz  <span class="brown">.</span><span class="bisque">.</span><span class="aqua">.</span> <span>Learn parenting</span></small></a></h1>
                    <nav role="navigation">
                        <ul>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Psychology</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('psychologies.child') }}">Child psychology</a></li>
                                    <li><a href="{{ route('psychologies.parent') }}">Parent psychology</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Tips</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('tips.parent') }}">Parenting Tips</a></li>
                                    <li><a href="{{ route('tips.pregnancy') }}">Pregnancy Tips</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('facts.baby') }}">Baby Facts</a></li>
                            <li class="dropdown" title="Take this awesome quiz on parenting"><a href="#" class="quiz dropdown-toggle" data-toggle="dropdown">Quiz</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('startbabyquiz') }}">Baby Quiz</a></li>
                                    <li><a href="{{ route('startparentingquiz') }}">Parenting Quiz</a></li>
                                </ul>
                            </li>
                            <li class="cta"><a href="{{ route('contact') }}">Contact us</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <div class="fh5co-cta" style="background-image: url({{ asset("/storage/images/slide_4.jpg") }});">
        <div class="overlay"></div>
        <div class="container">
            <div class="col-md-12 text-center animate-box" data-animate-effect="fadeIn">
                <h3>Want us to send weekly parenting quiz for FREE?</h3>
                {!! Form::open(['action' => "Visitors\PublicController@subscribe", 'method' => "POST"]) !!}
                <div class="form-group row">
                    {{ Form::email('email', '', ['class' => 'col-md-6 col-md-offset-3', 'placeholder' => 'Enter your Email', 'required' => 'required']) }}
                </div>
                {{ Form::submit('Subscribe', ['class' => 'btn btn-primary btn-outline with-arrow']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>


    <footer id="fh5co-footer" role="contentinfo">

        <div class="container">
            <div class="col-md-8 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
                <h3>About Us</h3>
                {!! $pages->about !!}
                <p><a href="{{ route('contact') }}" class="btn btn-primary btn-outline with-arrow btn-sm">Contact us <i class="icon-arrow-right"></i></a></p>
            </div>
            <!--<div class="col-md-6 col-md-push-1 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
                <h3>Our Services</h3>
                <ul class="float">
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">Branding &amp; Identity</a></li>
                    <li><a href="#">Free HTML5</a></li>
                    <li><a href="#">HandCrafted Templates</a></li>
                </ul>
                <ul class="float">
                    <li><a href="#">Free Bootstrap Template</a></li>
                    <li><a href="#">Free HTML5 Template</a></li>
                    <li><a href="#">Free HTML5 &amp; CSS3 Template</a></li>
                    <li><a href="#">HandCrafted Templates</a></li>
                </ul>

            </div>-->

            <div class="col-md-2 col-md-push-1 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
                <h3>Follow Us</h3>
                <ul class="fh5co-social">
                    @empty(!$pages->twitter)
                        <li><a href="{{ $pages->twitter }}"><i class="icon-twitter"></i></a></li>
                    @endempty
                    @empty(!$pages->facebook)
                        <li><a href="{{ $pages->facebook }}"><i class="icon-facebook"></i></a></li>
                    @endempty
                    @empty(!$pages->googleplus)
                        <li><a href="{{ $pages->googleplus }}"><i class="icon-google-plus"></i></a></li>
                    @endempty
                    @empty(!$pages->instagram)
                        <li><a href="{{ $pages->instagram }}"><i class="icon-instagram"></i></a></li>
                    @endempty
                </ul>
            </div>


            <div class="col-md-12 fh5co-copyright text-center">
                <p>&copy; 2018. All Rights Reserved. <span>Designed with <i class="icon-heart"></i> by <a href="" target="_blank">Valence web.</a> Images by <a href="www.stocksnap.io" target="_blank">stocksnap.io</a></span></p>
            </div>

        </div>
    </footer>
</div>


<!-- jQuery Easing -->
<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- Waypoints -->
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<!-- Flexslider -->
<script src="{{ asset('js/jquery.flexslider-min.js') }}"></script>

<!-- MAIN JS -->
<script src="{{ asset('js/main.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var agent = navigator.userAgent;
        var lastScrollTop = window.pageYOffset || document.documentElement.scrollTop;
        var android = agent.search("Android");
        var cookie = checkCookie("android");        //boolean value to check if the cookie is set
        if(cookie) {        //if cookie is set hide the link
            $("div.android").addClass("hidden");
        }
        if(android !== -1 && !cookie) {     //if its android and the cookie is not set show the download link
            $("div.android").removeClass("hidden");
        }
        $(document).on('click', "i.close-android ", function() {        //on clicking of the close button, setcookie for 1day to hide download link
            $("div.android").slideUp('slow');
            setCookie("android","1",1);
        });
        $(window).scroll(function() {       //show or hide link depending on the direction of scroll and the android and cookie state
            var st = window.pageYOffset || document.documentElement.scrollTop;
            if(android !== -1 && !cookie) {
                if (st > lastScrollTop) {
                    $("div.android").slideUp("slow");
                } else {
                    $("div.android").slideDown("slow");
                }
            }
            lastScrollTop = st <= 0 ? 0 : st;
        });
        if(android == -1) {
            var div = $("#fh5co-header nav ul li a.quiz");
            var counter = 0;
            back = setInterval(function () {
                ++counter;
                if (counter === 1) {
                    div.toggleClass("background1");
                }
                if (counter === 2) {
                    div.toggleClass("background2");
                }
                if (counter >= 2) counter = 0;
            }, 500);
        }
        function setCookie(name, value, expires) {
            var d = new Date();
            d.setTime(d.getTime() + (expires * 24 * 3600 * 1000));
            var expire = "expires=" + d.toUTCString();
            document.cookie = name + "=" + value + ";"+ expire + ";path=/";
        }
        function getCookie(cname) {
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(";");
            for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                str = c.split("=");
                if(str[0].trim() === cname) return str[1];
            }
            return "";
        }
        function checkCookie(cname) {
            var value = getCookie(cname);
            if(value !== "") {
                return true;
            }
            return false;
        }
    })
</script>

</body>
</html>

