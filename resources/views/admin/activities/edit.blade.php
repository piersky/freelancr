@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h1 class="text-uppercase">{{__('activities.New activity')}}</h1>
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
            <div class="col-sm-12">
                <form action="{{route('admin.activities')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label for="start_at"><strong>{{__('activities.Start at')}}</strong></label>
                            <input type="datetime-local" required name="start_at" id="start_at" class="form-control" value="{{old('start_at')}}">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="stop_at"><strong>{{__('activities.End at')}}</strong></label>
                            <input type="datetime-local" required name="stop_at" id="stop_at" class="form-control" value="{{old('stop_at')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="name"><strong>{{__('activities.Name')}}*</strong></label>
                            <input type="text" required name="name" id="name" class="form-control" value="{{old('name')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="description"><strong>{{__('activities.Description')}}*</strong></label>
                            <input type="text" required name="description" id="description" class="form-control" value="{{old('description')}}" placeholder="{{__('activities.Description')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label for="projetc_id"><strong>{{__('activities.Project')}}*</strong></label>
                            <select id="project_id" name="project_id" class="form-control">
                                <option>{{__('Select...')}}</option>
                                @foreach($projects as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="hourstack_id"><strong>{{__('activities.Hour stack')}}*</strong></label>
                            <select id="hourstack_id" name="hourstack_id" class="form-control">
                                <option>{{__('Select...')}}</option>
                                @foreach($hour_stacks as $hour_stack)
                                    <option value="{{$hour_stack->id}}">{{$hour_stack->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="assigned_to"><strong>{{__('activities.Assigned to')}}</strong></label>
                            <select id="assigned_to" name="assigned_to" class="form-control">
                                <option>{{__('Select...')}}</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-1">
                            <label for="is_active"><strong>{{__('activities.Is active')}}</strong></label>
                            <input type="checkbox" checked name="is_active" id="is_active" class="form-control">
                        </div>
                    </div>

                    <a href="/admin/activities" class="btn btn-danger">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
