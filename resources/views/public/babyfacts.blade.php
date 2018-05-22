@extends('public.layouts.app')

@section('content')
    <div class="fh5co-page-title" style="background-image: url({{ asset('/storage/images/slide_6.jpg') }});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 animate-box">
                    <h1><span class="colored">Baby</span> Facts</h1>
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
                @empty($babyFacts)
                    <p>No Fact here.</p>
                    @else
                        @foreach($babyFacts as $key => $value)
                            @if($loop->iteration == 1 || ($loop->iteration - 1) % 3 == 0)
                                <div class="row">
                            @endif
                            <div class="col-md-4 col-sm-6 item-block animate-box" data-animate-effect="fadeIn">
                                <div class="fh5co-property">
                                    <figure>
                                        <img src="{{ asset("/storage/baby_facts/$value->image") }}" alt="Tip Image" class="center-block img-responsive">
                                        <a href="{{ route('fact.baby', $value->id) }}" class="tag">View</a>
                                    </figure>
                                    <div class="fh5co-property-innter">
                                        {!! (strlen($value->fact) > 130) ? substr($value->fact, 0, 130)." ...</p>" : $value->fact !!}
                                    </div>
                                    <p class="fh5co-property-specification">
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
                        {{ $babyFacts->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection