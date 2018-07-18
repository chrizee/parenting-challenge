@extends('public.layouts.app')

@section('content')
    <div class="fh5co-section-with-image">
        <img src="{{ asset('/storage/images/image_1.jpg') }}" alt="" class="img-responsive">
        <div class="fh5co-box animate-box">
            @include('public.layouts.message')
            <h2>Quiz Complete</h2>
            <p>{{ $score.'/'.$total }}</p>
            <div class="text-center">
                <input title="" type="text" class="knob" value="{{ $percent }}" data-width="90" data-height="90" data-fgColor="#00a65a">
                <div class="knob-label">Your score is {{ $percent }}%.</div>
            </div>
            @if($percent >= 70)
                {!! Form::open(['action' => "Visitors\ParentingQuizController@sendEbook", 'method' => "POST"]) !!}
                <p>Enter your e-mail to recieve a free E-book for scoring up to 70%</p>
                <div class="form-group">
                    {{ method_field('PUT') }}
                    {{ Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email', 'required' => 'required']) }}
                </div>
                {{ Form::submit('Submit', ['class' => 'btn btn-primary btn-outline with-arrow']) }}
                {{ Form::close() }}
            @else
                <p class="text text-sm text-warning">Recieve a free e-book on parenting when you score above 70%. Try again.</p>
            @endif
            <p><a href="{{ route('parentingquiz') }}" class="pull-right btn btn-primary btn-outline with-arrow">Take quiz again<i class="icon-arrow-right"></i></a></p>
        </div>
    </div>


    <div id="best-deal">
        <div class="container">
            <div class="row text-center">
                <h3 class="text text-danger">Parenting Quiz Review</h3>
                @empty(!$parentingQuiz)
                    <p class="text text-success">Below are the questions you answered along with their descriptions and answers.</p>
                @endempty
                @include('public.layouts.message')
            </div>
            <div class='row' style="background: white;">
                @empty(!$parentingQuiz)
                    @foreach ($parentingQuiz as $key => $value)
                        @php
                            $color = $progressBarColors[rand(0, count($progressBarColors) -1 )];
                            $percent = 0;
                            $total = $value->right + $value->wrong;
                            if($total != 0) {
                                $percent = round( ($value->right/$total) * 100);
                            }
                        @endphp
                        <div class="ques2 col-md-12">
                            <div class="col-md-8">
                                <p class="text text-center">{{ ($key+1)." of ".count($parentingQuiz) }}</p>
                                <div class="form-group">
                                    <label>{!! $value->question !!}</label>
                                    <ol class="list-group">
                                        <li class="list-group-item">A. {{ $value->optionA }}</li>
                                        <li class="list-group-item">B. {{ $value->optionB }}</li>
                                        <li class="list-group-item">C. {{ $value->optionC }}</li>
                                    </ol>
                                    <p class="text text-info">Tip: {!! $value->tip !!}</p>
                                </div>
                                <div class="description_{{ $value->id }}">
                                    @if($percent != 0)
                                        <div class="progress progress-sm active">
                                            <div class="progress-bar progress-bar-{{ $color }} progress-bar-striped" role="progressbar" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $percent }}%">
                                                <span>{{ $percent }}% of parents got this right</span>
                                                <span class="sr-only">{{ $percent }}% Complete</span>
                                            </div>
                                        </div>
                                    @endif
                                    <h4>Description</h4>
                                    <p class="text">{!! trim($value->description) !!}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div  class="answer-with-description text-center" style="background: bisque;">
                                    <h3 class="text-warning">Your Answer</h3>
                                    <p style="font-size: 51px; margin-top: -29px;" class="text @if($answersFromUser[$value->id] == $value->answer)text-success @else text-danger @endif text-bold">{{ $answersFromUser[$value->id] }}
                                        @if($answersFromUser[$value->id] == $value->answer)
                                            <i class="fa fa-check"></i>
                                        @else
                                            <i class="fa fa-times"></i>
                                        @endif
                                    </p>
                                </div>
                                @if($answersFromUser[$value->id] != $value->answer)
                                    <div  class="answer-with-description2 text-center" style="background: antiquewhite;">
                                        <h3 class="text-warning">Correct Answer</h3>
                                        <p style="font-size: 51px; margin-top: -29px;" class="text text-success text-bold">{{ $value->answer }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <h5 class="text text-center text-danger">You didn't answer any question. <a href="{{ route('parentingquiz') }}">Take quiz again.</a></h5>
                @endempty
            </div>
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