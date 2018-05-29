@extends('public.layouts.app')

@section('content')
    <div class="fh5co-page-title" style="background-image: url({{ asset('/storage/images/slide_6.jpg') }});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 animate-box">
                    <h1><span class="colored">Parenting</span> Tip</h1>
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
                    <h2>Parenting Tips</h2>
                    <p>Tips gathered from research around the world on parenting and how best to handle the wonderful gifts of nature<em><strong> babies</strong></em>. </p>
                </div>
                @empty($parentingTip)
                    <p>Invalid Tip</p>
                    @else
                        <div class="col-md-5 col-xs-12 item-block animate-box" data-animate-effect="fadeIn">
                            <div class="fh5co-property">
                                <figure>
                                    <picture>
                                        <source srcset="{{ asset("/storage/tips/parent/$parentingTip->image") }}" type="image/webp">
                                        <source srcset="{{ asset("/storage/tips/parent/".explode('.', $parentingTip->image)[0].".jpg") }}" type="image/jpeg">
                                        <img src="{{ asset("/storage/tips/parent/".explode('.', $parentingTip->image)[0].".jpg") }}" class="img-responsive" alt="Tip Image" />
                                    </picture>
                                </figure>
                            </div>
                        </div>
                        <div class="col-md-7 col-xs-12 item-block animate-box" data-animate-effect="fadeIn">
                            <div class="fh5co-property">
                                <div class="fh5co-property-innter">
                                    <blockquote class="blockquote"><em>
                                            {!! $parentingTip->tip !!}</em>
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