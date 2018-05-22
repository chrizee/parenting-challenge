@extends('public.layouts.app')

@section('content')
    <div class="fh5co-page-title" style="background-image: url({{ asset('/storage/images/slide_6.jpg') }});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 animate-box">
                    <h1><span class="colored">Pregnancy</span> Tip</h1>
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
                </div>
                @empty($pregnancyTip)
                    <p>Invalid Tip</p>
                    @else
                        <div class="col-md-5 col-xs-12 item-block animate-box" data-animate-effect="fadeIn">
                            <div class="fh5co-property">
                                <figure>
                                    <img src="{{ asset("/storage/tips/pregnancy/$pregnancyTip->image") }}" alt="Tip Image" class="center-block img-responsive">
                                </figure>
                            </div>
                        </div>
                        <div class="col-md-7 col-xs-12 item-block animate-box" data-animate-effect="fadeIn">
                            <div class="fh5co-property">
                                <div class="fh5co-property-innter">
                                    <blockquote class="blockquote"><em>
                                            {!! $pregnancyTip->tip !!}</em>
                                    </blockquote>
                                </div>
                                <p class="fh5co-property-specification">
                                </p>
                            </div>
                        </div>
                        @endempty
            </div>
        </div>
    </div>

@endsection