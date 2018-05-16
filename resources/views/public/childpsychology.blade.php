@extends('public.layouts.app')

@section('content')
    <div class="fh5co-page-title" style="background-image: url({{ asset('/storage/images/slide_6.jpg') }});">
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
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box" data-animate-effect="fadeIn">
                    <h2>We are Offering the Best Real Estate Deals</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                </div>
                @empty($childPsychology)
                    <p>Invalid quote</p>
                    @else
                        <div class="col-md-6 item-block animate-box" data-animate-effect="fadeIn">
                            <div class="fh5co-property">
                                <figure>
                                    <img src="{{ asset("/storage/psychology/child/$childPsychology->image") }}" alt="Quote Image" class="img-responsive">
                                </figure>
                            </div>
                        </div>
                        <div class="col-md-6 item-block animate-box" data-animate-effect="fadeIn">
                            <div class="fh5co-property">
                                <div class="fh5co-property-innter">
                                    <blockquote class="blockquote">
                                        {!! $childPsychology->quote !!}
                                    </blockquote>
                                </div>
                                <p class="fh5co-property-specification">
                                    <span><strong>Share</strong> facebook</span>
                                </p>
                            </div>
                        </div>
                @endempty
            </div>
        </div>
    </div>

@endsection