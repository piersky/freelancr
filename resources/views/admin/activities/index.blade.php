@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-2">
                <a class="btn btn-success text-uppercase" href="{{ route("admin.activities.create") }}">
                    {{__('activities.Add new activity')}}
                </a>
            </div>
            <div class="col-sm-4">
                <h1 class="text-uppercase">{{__('activities.Activities')}}</h1>
            </div>
            @if(session()->has('message'))
                @component('layouts.alert-info')
                    {{session()->get('message')}}
                @endcomponent
            @endif
            <div class="col-sm-6">
                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>
        </div>
        @if($activities ?? '')
            <div class="row">
                <div class="col-sm-4 my-2 justify-content-end">
                    {{$activities->links()}}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        @if($activities ?? '')
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-center text-uppercase">{{__('activities.Name')}}</th>
                                <th class="text-center text-uppercase">{{__('activities.Customer name')}}</th>
                                <th class="text-center text-uppercase">{{__('activities.Start at')}}</th>
                                <th class="text-center text-uppercase">{{__('activities.End at')}}</th>
                                <th class="text-center text-uppercase">{{__('activities.Used hours')}}</th>
                                <th class="text-center text-uppercase">{{__('activities.Hour stack')}}</th>
                                <th class="text-center text-uppercase">{{__('activities.Assigned to')}}</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($activities as $activity)
                                <tr id="tr-{{$activity->id}}" class="{{(!$activity->is_active?"bg-secondary":"")}}">
                                    <td class="text-center">{{substr($activity->name, 0, 30)}}...</td>
                                    <td class="text-center">{{$activity->customer_name}}</td>
                                    <td class="text-center">{{$activity->start_at}}</td>
                                    <td class="text-center">{{$activity->stop_at}}</td>
                                    <td class="text-center">{{$activity->used_hours}}</td>
                                    <td class="text-center">{{$activity->hour_stack_name}}</td>
                                    <td class="text-center">{{$activity->user_name}}</td>
                                    <td class="d-flex justify-content-end">
                                        <a href="/admin/activities/{{$activity->id}}" class="btn btn-success mr-1"><span class="fa fa-eye"></span></a>
                                        <a href="/admin/activities/{{$activity->id}}/edit" class="btn btn-info ml-1 mr-1"><span class="fa fa-pencil-alt"></span></a>
                                        <button type="button" class="btn btn-danger ml-1" data-id="{{$activity->id}}" data-url="/admin/activities/{{$activity->id}}"><span class="fa fa-trash"></span></button>
                                </tr>
                            @endforeach
                            @else
                                <tr><td><h2>{{__('activities.No activities yet.')}}</h2></td></tr>
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
            @if($activities ?? '')
                <div class="row">
                    <div class="col-sm-4 my-2 justify-content-end">
                        {{$activities->links()}}
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">{{__('Confirm')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{__('Please, click on DELETE to confirm the record cancellation.')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-danger text-uppercase" id ="btn-delete">{{__('Delete')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            $('.alert').fadeOut(5000);

            $('.btn.btn-danger').on('click', function (evt){
                evt.preventDefault();

                var url = $(this).data('url');
                var id = $(this).data('id');
                var tr = $('#tr-'+id);

                $('#deleteModal').modal('show');

                $('#btn-delete').on('click', function () {
                    $.ajax({
                        url: url,
                        method: 'DELETE',
                        data: {
                            '_token': '{{csrf_token()}}'
                        },
                        complete: function(resp){
                            if (resp.responseText == 1) {
                                tr.remove();
                                $('#deleteModal').modal('hide');
                            } else {
                                console.log('Problem contacting the server');
                            }
                        }
                    })
                });
            });
        });
    </script>
@endsection
