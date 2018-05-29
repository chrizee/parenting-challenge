@extends('public.layouts.app')

@section('content')

    <div id="fh5co-blog">

        <div class="container">
            <div class="row">
                <div class="col-md-11 animate-box" data-animate-effect="fadeIn">
                    <div class="fh5co-entry" style="width:100%;">
                        <div class="fh5co-copy">
                            {!! Form::open(['action' => 'Visitors\ParentingQuizController@mark', 'method' => "POST", 'id' => 'test']) !!}
                                <legend>Parenting Quiz <span class=" pull-right"><i class="fa fa-clock-o text-danger"></i>
                                    <span id="counter" class="text text-danger text-center" style="font-size:1.2em"></span></span>
                                </legend>
                                <div class='row' style="background: white;">
                                    @foreach ($parentingQuiz as $key => $value)
                                        @php
                                            $color = $progressBarColors[rand(0, count($progressBarColors) -1 )];
                                            $percent = 0;
                                            $total = $value->right + $value->wrong;
                                            if($total != 0) {
                                                $percent = round( ($value->right/$total) * 100);
                                            }
                                        @endphp
                                        <div class="ques @if(!$loop->first) hidden @endif ">
                                            <div class="visible-xs">
                                                <figure>
                                                    <picture>
                                                        <source srcset="/storage/quiz/parent/{{ $value->image }}" type="image/webp">
                                                        <source srcset="/storage/quiz/parent/{{ explode('.', $value->image)[0].'.jpg' }}" type="image/jpeg">
                                                        <img src="/storage/quiz/parent/{{ explode('.', $value->image)[0].'.jpg' }}" class="img-responsive" alt="question image" />
                                                    </picture>
                                                </figure>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="text text-center no-margin">{{ ($key+1)." of ".count($parentingQuiz) }}</p>
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
                                                        <p class="text text-info">Tip: {!! $value->tip !!}</p>
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
                                                    <p class="text">{{ trim($value->description) }}</p>
                                                    @if($loop->last)
                                                        {{ Form::submit('Finish', ['class' => "pull-right btn btn-$color btn-sm"]) }}
                                                    @else
                                                        <button class="continue btn btn-sm btn-{{ $color }} pull-right">Next <i class="fa fa-angle-double-right"></i> </button>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 hidden-xs">
                                                <figure>
                                                    <picture>
                                                        <source srcset="/storage/quiz/parent/{{ $value->image }}" type="image/webp">
                                                        <source srcset="/storage/quiz/parent/{{ explode('.', $value->image)[0].'.jpg' }}" type="image/jpeg">
                                                        <img src="/storage/quiz/parent/{{ explode('.', $value->image)[0].'.jpg' }}" class="img-responsive" alt="question image" />
                                                    </picture>
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
    <script type="text/javascript">
        $(document).ready(function () {
            var $play = true;
            $(document).on('click', "input[type=radio]", function() {
                var $ans = $(this).val();
                var $id = $(this).attr('name');
                $(this).parents('.options').slideUp('slow');    //hide the options after selecting an answer
                $("div.description_"+$id).removeClass('hidden');    //show description after selecting an answer
                $play = false;
            }).on('click', 'button.continue', function(e) {
                e.preventDefault();
                $parent = $(this).parents('div.ques');
                $($parent).slideUp('slow');     //hide question div after clicking continue
                $($parent).next().removeClass('hidden').fadeIn();   //show next question after clicking continue
                $('html, body').animate({ scrollTop: 50 }, 'slow');
                $play = true;
            });
            var $counter = {{ $duration }} * 60 ;
            function secondsToHms(d) {
                d = Number(d);
                var h = Math.floor(d / 3600);
                var m = Math.floor(d % 3600 / 60);
                var s = Math.floor(d % 3600 % 60);

                var hDisplay = h > 0 ? h + (h == 1 ? " hour: " : " hours: ") : "";
                var mDisplay = m >= 0 ? m + (m == 1 ? " min: " : " mins: ") : "";
                var sDisplay = s >= 0 ? s + (s == 1 ? " sec" : " secs") : "";
                return hDisplay + mDisplay + sDisplay;
            }
            var $interval = setInterval(function() {
                if($counter <= 0) {
                    $('input[type=radio]').removeAttr('required');
                    $('form#test').submit();
                    clearInterval($interval);
                }
                if($play) $counter--;
                $('input[name=time]').val($counter);
                $('span#counter').text(secondsToHms($counter));	//process the timer to HH:MM:SS using javascript

            }, 1000);
        })
    </script>
@endsection
