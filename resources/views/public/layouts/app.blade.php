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
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
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
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">
    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Modernizr JS -->
    <script src="{{ asset('js/modernizr-2.6.2.min.js') }}"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->
    <style type="text/css">
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
    </style>
</head>
<body>


<div id="fh5co-page">
    <header id="fh5co-header" role="banner">
        <div class="container">
            <div class="row">
                <div class="header-inner">
                    <h1><a href="{{ route('index') }}">Improve<span>Parenting.</span></a></h1>
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
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Quiz</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('babyquiz') }}">Baby Quiz</a></li>
                                    <li><a href="{{ route('parentingquiz') }}">Parenting Quiz</a></li>
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

    <div class="fh5co-cta" style="background-image: url(images/slide_4.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="col-md-12 text-center animate-box" data-animate-effect="fadeIn">
                <h3>Suscribe to recieve our weekly parenting tip and baby facts. </h3>
                {!! Form::open(['action' => "Visitors\PublicController@suscribe", 'method' => "POST"]) !!}
                <div class="form-group row">
                    {{ Form::email('email', '', ['class' => 'col-md-6 col-md-offset-3', 'placeholder' => 'Email', 'required' => 'required']) }}
                </div>
                {{ Form::submit('Submit', ['class' => 'btn btn-primary btn-outline with-arrow']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>


    <footer id="fh5co-footer" role="contentinfo">

        <div class="container">
            <div class="col-md-3 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
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

</body>
</html>

