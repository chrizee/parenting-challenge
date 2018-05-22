@extends('public.layouts.app')

@section('content')
    <div id="fh5co-blog">
        <div class="container">
            <div class="row">
                <div class="col-md-11 animate-box" data-animate-effect="fadeIn">
                    <div class="fh5co-entry" style="width:100%;">
                        <div class="fh5co-copy">
                            {!! Form::open(['action' => 'Visitors\BabyQuizController@mark', 'method' => "POST"]) !!}
                            <legend>Baby Quiz</legend>
                            <div class='row' style="background: white;">
                                @foreach ($babyQuiz as $key => $value)
                                    @php
                                        $color = $progressBarColors[rand(0, count($progressBarColors) -1 )];
                                        $percent = 0;
                                        $total = $value->right + $value->wrong;
                                        if($total != 0) {
                                            $percent = round( ($value->right/$total) * 100);
                                        }
                                    @endphp
                                    <div class="ques @if(!$loop->first) hidden @endif ">
                                        <div class="col-md-6">
                                            <p class="text text-center no-margin">{{ ($key+1)." of ".count($babyQuiz) }}</p>
                                            <div class="form-group">
                                                <label>{!! $value->question !!}</label>
                                                <div class="options">
                                                    <div class="radio">
                                                        <label>
                                                            <span>A .</span> <input type="radio" class="flat-gree" name="{{ $value->id }}" value="A" /> {{ $value->optionA }}
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <span>B .</span> <input type="radio" class="flat-gree" name="{{ $value->id }}" value="B" /> {{ $value->optionB }}
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <span>C .</span> <input type="radio" class="flat-gree" name="{{ $value->id }}" value="C" /> {{ $value->optionC }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hidden description_{{ $value->id }}">
                                                @if($percent != 0)
                                                    <div class="progress progress-sm active">
                                                        <div class="progress-bar progress-bar-{{ $color }} progress-bar-striped" role="progressbar" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $percent }}%">
                                                            <span>{{ $percent }}% of parents got this right</span>
                                                            <span class="sr-only">{{ $percent }}% Complete</span>
                                                        </div>
                                                    </div>
                                                @endif
                                                <p class="text">{{ trim($value->tip) }}</p>
                                                @if($loop->last)
                                                    {{ Form::submit('Finish', ['class' => "pull-right btn btn-$color btn-sm"]) }}
                                                @else
                                                    <button class="continue btn btn-sm btn-{{ $color }} pull-right">Next <i class="fa fa-angle-double-right"></i> </button>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <figure>
                                                <img src="/storage/quiz/baby/{{ $value->image }}" class="img-responsive" alt="question image" />
                                            </figure>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $data = JSON.parse( {!! json_encode($answer) !!} );
            var $correct = 0;
            $(document).on('click', "input[type=radio]", function() {
                var $ans = $(this).val();
                var $id = $(this).attr('name');
                $(this).parents('.options').slideUp('slow');    //hide the options after selecting an answer
                $("div.description_"+$id).removeClass('hidden');    //show description after selecting an answer
                if($ans == $data[$id]) {
                    $correct += 1;

                    //send ajax to update the correct column in the database with the question id
                }else {
                    //console.log($correct);
                    //send ajax to update worng column in the database
                }console.log($correct);
            }).on('click', 'button.continue', function(e) {
                e.preventDefault();
                $parent = $(this).parents('div.ques');
                $($parent).slideUp('slow');     //hide question div after clicking continue
                $($parent).next().removeClass('hidden').fadeIn();   //show next question after clicking continue
            });
        })
    </script>
@endsection
