@extends('public.layouts.app')

@section('content')
    <div class="fh5co-page-title" style="background-image: url({{ asset('/storage/images/slide_6.jpg') }});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 animate-box">
                    <h1><span class="colored">Q</span>uotes</h1>
                </div>
            </div>
        </div>
    </div>
    <div id="fh5co-testimonial">
        <div class="container">
            <div class="row">
                @include('public.layouts.message')
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center fh5co-heading animate-box" data-animate-effect="fadeIn">
                    <h2>Quotes</h2>
                    <p>Wise sayings from notable men and women around the world. </p>
                </div>
                @empty($quotes)
                    <p>No Quote here</p>
                @else
                    @foreach($quotes as $key => $value)
                        @if($loop->iteration == 1 || ($loop->iteration - 1) % 3 == 0)
                            <div class="row">
                                @endif
                                <div class="col-md-4 text-center item-block animate-box" data-animate-effect="fadeIn">
                                    <blockquote>
                                        {!! $value->quote !!}
                                        <p><span class="text fh5co-author" style="color: #118DF0"><cite>{{ $value->person }}</cite></span></p>
                                    </blockquote>
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
                        {{ $quotes->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection