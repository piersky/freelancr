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
        <div class="row">
            <div class="col-sm-8">
                <div class="table-responsive">
                    <table class="table table-striped">
                        @if($activities ?? '')
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-center text-uppercase">{{__('activities.Name')}}</th>
                                <th class="text-left text-uppercase">{{__('activities.Start at')}}</th>
                                <th class="text-left text-uppercase">{{__('activities.End at')}}</th>
                                <th class="text-left text-uppercase">{{__('activities.Hour stack')}}</th>
                                <th class="text-left text-uppercase">{{__('activities.Assigned to')}}</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($activities as $activity)
                                <tr id="tr-{{$activity->id}}" class="{{(!$activity->is_active?"bg-secondary":"")}}">
                                    <td class="text-center">{{$activity->name}}</td>
                                    <td class="text-center">{{$activity->start_at}}</td>
                                    <td class="text-center">{{$activity->stop_at}}</td>
                                    <td class="text-center">{{$activity->hour_stack_name}}</td>
                                    <td class="text-center">{{$activity->user_name}}</td>
                                    <td class="d-flex justify-content-end">
                                        <a href="/admin/activities/{{$activity->id}}/edit" class="btn btn-info"><span class="fa fa-pencil-alt"></span></a>
                                </tr>
                            @endforeach
                            @else
                                <tr><td><h2>{{__('activities.No activities yet.')}}</h2></td></tr>
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            $('.job-toggle').on('click', function (evt){
                var url = $(this).children().data('url');
                var id = this.id.replace('td-', '');
                $.ajax(
                    {
                        url: url,
                        method: 'PATCH',
                        data: {
                            '_token': '{{csrf_token()}}'
                        },
                        complete: function(resp){
                            console.log(url);
                            console.log(resp);
                        }
                    })
            })
        })
    </script>
@endsection
