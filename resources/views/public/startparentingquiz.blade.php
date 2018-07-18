@extends("public.layouts.app")

@section('content')
    <div style="background: url('{{asset('/storage/images/start.jpg')}}');" id="best-deal">
        <div class="container">
            <div class="row">
                @include('public.layouts.message')
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box" data-animate-effect="fadeIn">
                    <h2 style="background: rgb(206,206,206); opacity: 0.9; color: blue; border-radius: 15px;" class="text text-primary">Parenting Quiz</h2>
                </div>
                @empty($pages)
                    <p>Invalid data</p>
                @else
                    <div class="col-md-8 col-md-offset-2 col-xs-12 item-block animate-box" data-animate-effect="fadeIn">
                        <div class="fh5co-property" style="background: rgb(235,235,235);opacity: 0.9; border-radius: 15px">
                            <div class="fh5co-property-innter">
                                {!! $pages->parentingquizstart !!}
                            </div>
                            <a href="{{route('parentingquiz')}}"><button class="btn btn-primary pull-right">Start Quiz</button></a>
                        </div>
                    </div>
                @endempty
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $("div.fh5co-cta").addClass("hidden");
        })
    </script>
@endsection