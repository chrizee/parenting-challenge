@extends('public.layouts.app')

@section('content')
    <div class="fh5co-page-title" style="background-image: url({{ asset('/storage/images/slide_6.jpg') }});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 animate-box">
                    <h1><span class="colored">Pregnancy</span> Tips</h1>
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
                @empty($pregnancyTips)
                    <p>No tip here</p>
                    @else
                        @foreach($pregnancyTips as $key => $value)
                            @if($loop->iteration == 1 || ($loop->iteration - 1) % 3 == 0)
                                <div class="row">
                                    @endif
                                    <div class="col-md-4 col-sm-6 item-block animate-box" data-animate-effect="fadeIn">
                                        <div class="fh5co-property">
                                            <figure>
                                                <picture>
                                                    <source srcset="{{ asset("/storage/tips/pregnancy/$value->image") }}" type="image/webp">
                                                    <source srcset="{{ asset("/storage/tips/pregnancy/".explode('.', $value->image)[0].".jpg") }}" type="image/jpeg">
                                                    <img src="{{ asset("/storage/tips/pregnancy/".explode('.', $value->image)[0].".jpg") }}" class="img-responsive" alt="Quote Image" />
                                                </picture>
                                                <a href="{{ route('tip.pregnancy', encrypt($value->id)) }}" class="tag">View</a>
                                            </figure>
                                            <div class="fh5co-property-innter">
                                                {!! (strlen($value->tip) > 130) ? substr($value->tip, 0, 130)." ...</p>" : $value->tip !!}
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
                        {{ $pregnancyTips->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection