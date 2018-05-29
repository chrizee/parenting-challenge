@extends('public.layouts.app')

@section('content')
    <div class="fh5co-section-with-image">

        <img src="{{ asset('/storage/images/image_1.jpg') }}" alt="" class="img-responsive">
        <div class="fh5co-box animate-box">
            @include('public.layouts.message')
            <h2>Quiz Complete</h2>
            <p>{{ $score.'/'.$total }}</p>
            <div class="text-center">
                <input type="text" class="knob" value="{{ $percent }}" data-width="90" data-height="90" data-fgColor="#00a65a">
                <div class="knob-label">Your score is {{ $percent }}%.</div>
            </div>
            @if($percent >= 70)
                {!! Form::open(['action' => "Visitors\BabyQuizController@sendEbook", 'method' => "POST"]) !!}
                <p>Enter your e-mail to recieve a free E-book for scoring up to 70%</p>
                <div class="form-group">
                    {{ method_field('PUT') }}
                    {{ Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email', 'required' => 'required']) }}
                </div>
                {{ Form::submit('Submit', ['class' => 'btn btn-primary btn-outline with-arrow']) }}
                {{ Form::close() }}
            @else
                <p class="text text-sm text-warning">Recieve a free e-book on parenting when you score above 70%. Try again.</p>
                <p><a href="{{ route('babyquiz') }}" class="btn btn-primary btn-outline with-arrow">Take quiz again<i class="icon-arrow-right"></i></a></p>
            @endif
        </div>

    </div>
    <script type="text/javascript" src="{{ asset('plugins/knob/jquery.knob.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".knob").knob({
                'min': 0,
                'max' : 100
            });
        })
    </script>

@endsection