@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{substr($activity->name, 0, 30)}}...</h1>
            </div>
            <div class="col-sm-2">
                <a href="/admin/activities/{{$activity->id}}/edit" class="btn btn-success"><span class="fa fa-pencil-alt"></span></a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="form-group col-sm-3">
                        <label for="start_at"><strong>{{__('activities.Start at')}}</strong></label>
                        <input type="datetime-local" readonly name="start_at" id="start_at" class="form-control" value="{{Carbon::parse($activity->start_at)->toDateTimeLocalString()}}">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="stop_at"><strong>{{__('activities.End at')}}</strong></label>
                        <input type="datetime-local" readonly name="stop_at" id="stop_at" class="form-control" value="{{Carbon::parse($activity->stop_at)->toDateTimeLocalString()}}">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="used_hours"><strong>{{__('activities.Used hours')}}</strong></label>
                        <input type="number" readonly name="used_hours" id="used_hours" class="form-control" value="{{$activity->used_hours}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="name"><strong>{{__('activities.Name')}}</strong></label>
                        <input type="text" readonly name="name" id="name" class="form-control" value="{{$activity->name}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="description"><strong>{{__('activities.Description')}}</strong></label>
                        <input type="text" readonly name="description" id="description" class="form-control" value="{{$activity->description}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="project"><strong>{{__('activities.Project')}}</strong></label>
                        <input type="text" readonly name="project" id="project" class="form-control" value="{{$activity->customer_name}} -> {{$activity->project_name}}">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="hourstack"><strong>{{__('activities.Hour stack')}}</strong></label>
                        <input id="hourstack_" readonly name="hourstack" class="form-control" value="{{$activity->hour_stack_name}}">
                    </div>
                    <div class="form-group col-3">
                        <label for="assigned_to"><strong>{{__('activities.Assigned to')}}</strong></label>
                        <input id="assigned_to" readonly name="assigned_to" class="form-control" value="{{$activity->user_name}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-1">
                        <label for="is_active"><strong>{{__('activities.Is active')}}</strong></label>
                        <input onclick="return false;" type="checkbox" {{$activity->is_active?"checked":""}} name="is_active" id="is_active" class="form-control">
                    </div>
                </div>

                <a href="/admin/activities" class="btn btn-danger">{{__('Cancel')}}</a>
            </div>
        </div>
    </div>
@endsection
