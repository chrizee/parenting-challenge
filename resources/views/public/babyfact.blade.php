@extends('public.layouts.app')

@section('content')
    <div class="fh5co-page-title" style="background-image: url({{ asset('/storage/images/slide_6.jpg') }});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 animate-box">
                    <h1><span class="colored">Baby</span> Fact</h1>
                </div>
            </div>
        </div>
    </div>
    <div id="best-deal">
        <div class="container">
            <div class="row">
                @include('public.layouts.message')
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box" data-animate-effect="fadeIn">
                    <h2>Baby <em>facts</em></h2>
                    <p>Facts gathered from research over the years about babies and their development. </p>
                </div>
                @empty($babyFact)
                    <p>Invalid Fact</p>
                @else
                    <div class="col-md-7 col-xs-12 item-block animate-box" data-animate-effect="fadeIn">
                        <div class="fh5co-property">
                            <div class="fh5co-property-innter">
                                <blockquote class="blockquote"><em>
                                        {!! $babyFact->fact !!}</em>
                                </blockquote>
                            </div>
                            <p class="fh5co-property-specification">
                            </p>
                        </div>
                    </div>
                    <div class="col-md-5 col-xs-12 item-block animate-box" data-animate-effect="fadeIn">
                        <div class="fh5co-property">
                            <figure>
                                <img src="{{ asset("/storage/baby_facts/$babyFact->image") }}" alt="Tip Image" class="center-block img-responsive">
                            </figure>
                        </div>
                    </div>
                @endempty
            </div>
        </div>
    </div>

@endsection