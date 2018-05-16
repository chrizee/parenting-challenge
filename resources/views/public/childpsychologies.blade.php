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
                @empty($childPsychologies)
                    <p>No Quotes here</p>
                @else
                    @foreach($childPsychologies as $key => $value)
                        @if($loop->iteration == 1 || $loop->iteration % 4 == 0)
                            <div class="row">
                        @endif
                        <div class="col-md-4 item-block animate-box" data-animate-effect="fadeIn">
                            <div class="fh5co-property">
                                <figure>
                                    <img src="{{ asset("/storage/psychology/child/$value->image") }}" alt="Quote Image" class="img-responsive">
                                    <a href="{{ route('psychology.child', $value->id) }}" class="tag">View</a>
                                </figure>
                                <div class="fh5co-property-innter">
                                    {!! (strlen($value->quote) > 130) ? substr($value->quote, 0, 130)." ...</p>" : $value->quote !!}
                                </div>
                                <p class="fh5co-property-specification">
                                    <span><strong>Share</strong> facebook</span>
                                </p>
                            </div>
                        </div>
                        @if($loop->iteration % 3 == 0)
                            </div>
                        @endif
                    @endforeach
                @endempty
            </div>
            <div class="row">
                <div class="col-md-12 text-center animate-box" data-animate-effect="fadeIn">
                    <nav>
                        {{ $childPsychologies->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection