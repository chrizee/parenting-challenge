@extends('admin.layouts.app')

@section('content')
    <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
        <div class="col-md-12 callout callout-info">
            <button type="button" class="close" data-dismiss="callout" aria-hidden="true">&times;</button>
            <h4><i class="fa fa-exclamation-circle"></i> Notice</h4>
            <p><i class="text-yellow fa fa-asterisk"></i> Muting a suscriber temporarily stops him/her from receiving weekly questions. This action can be reversed. </p>
            <p><i class="text-red fa fa-asterisk"></i> Deleting a suscriber on the other hand permanently removes the record. This action cannot be reversed.</p>
        </div>
    </div>
    <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
        <a href="{{ route('broadcast.index') }}"><button class="btn btn-warning btn-sm ">Send Broadcast</button></a>
    </div>
    <section class="col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-users"></i>
                <h3 class="box-title">Suscribers <span class="text text-info">({{ count($suscribers) }})  </span></h3>
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
            @if(count($suscribers) > 0)
                    <div class="table">
                        <table  class="table table-bordered table-hover table-striped datatable">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Email</th>
                                    <th>Date suscribed</th>
                                    <th>Status</th>
                                    <th>Mute</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suscribers as $key => $value)
                                    <tr>
                                        <td>{{ ($key + 1) }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->created_at->toFormattedDateString() }}</td>
                                        <td>{{ ($value->status == '1') ? 'Active' : 'Unsuscribed' }}</td>
                                        <td>
                                            @if($value->mute == '1')
                                                {{ Form::open(['action' => ['Admin\SuscribersController@update', $value->id], 'method' => "POST"]) }}
                                                {{ method_field('PUT') }}
                                                {{ Form::hidden('mute', '1') }}
                                                {{ Form::submit('Mute', ['class' => 'btn btn-sm btn-info']) }}
                                                {{ Form::close() }}
                                            @else
                                                {{ Form::open(['action' => ['Admin\SuscribersController@update', $value->id], 'method' => "POST"]) }}
                                                {{ method_field('PUT') }}
                                                {{ Form::hidden('unmute', '1') }}
                                                {{ Form::submit('Unmute', ['class' => 'btn btn-sm btn-success']) }}
                                                {{ Form::close() }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ Form::open(['action' => ['Admin\SuscribersController@destroy', $value->id], 'method' => "POST"]) }}
                                            {{ method_field('DELETE') }}
                                            {{ Form::submit('Delete', ['class' => 'delete btn btn-sm btn-danger']) }}
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No Suscriber.</p>
                @endif
            </div>
        </div>

    </section>
    <script>
        $(document).ready(function() {
            $(document).on('click','input.delete', function(e) {
                $ans = confirm('Are you sure you want to permanently delete this suscriber. This action cannot be reversed. Muting suscriber will prevent them from receiving mail. ');
                if(!$ans) {
                    e.preventDefault();
                }
            }).on('click', 'button.close', function(e) {
                $(this).parent('div').slideUp('slow');
            })
        })
    </script>
@endsection()