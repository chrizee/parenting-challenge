@extends('public.layouts.app')

@section('content')
    <div class="fh5co-page-title" style="background-image: url({{ asset('/storage/images/slide_3.jpg') }});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 animate-box">
                    <h1><span class="colored">Child</span> Psychology</h1>
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
                @empty($childPsychology)
                    <p>Invalid quote</p>
                    @else
                        <div class="col-md-5 col-xs-12 item-block animate-box" data-animate-effect="fadeIn">
                            <div class="fh5co-property">
                                <figure>
                                    <picture>
                                        <source srcset="{{ asset("/storage/psychology/child/$childPsychology->image") }}" type="image/webp">
                                        <source srcset="{{ asset("/storage/psychology/child/".explode('.', $childPsychology->image)[0].".jpg") }}" type="image/jpeg">
                                        <img src="{{ asset("/storage/psychology/child/".explode('.', $childPsychology->image)[0].".jpg") }}" class="img-responsive" alt="quote Image" />
                                    </picture>
                                </figure>
                            </div>
                        </div>
                        <div class="col-md-7 col-xs-12 item-block animate-box" data-animate-effect="fadeIn">
                            <div class="fh5co-property">
                                <div class="fh5co-property-innter">
                                    <blockquote class="blockquote"><em>
                                            {!! $childPsychology->quote !!}</em>
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