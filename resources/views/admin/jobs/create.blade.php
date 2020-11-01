@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{__('jobs.New Job')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('admin.jobs')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="description"><strong>{{__('jobs.Description')}}*</strong></label>
                            <input type="text" required name="description" id="description" class="form-control" value="{{old('description')}}" placeholder="{{__('jobs.Description')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label for="deadline"><strong>{{__('jobs.Deadline')}}*</strong></label>
                            <input type="datetime-local" required name="deadline" id="deadline" class="form-control" value="{{old('deadline')}}">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="belongs_to_id"><strong>{{__('jobs.Belongs to user')}}</strong></label>
                            <select id="belongs_to_id" name="belongs_to_id" class="form-control">
                                <option>{{__('Select...')}}</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="customer_id"><strong>{{__('jobs.Customer')}}</strong></label>
                            <select id="customer_id" name="customer_id" class="form-control">
                                <option>{{__('Select...')}}</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-1">
                            <label for="is_done"><strong>{{__('jobs.Completed')}}</strong></label>
                            <input type="checkbox" name="is_done" id="is_done" class="form-control">
                        </div>
                    </div>

                    <a href="/admin/jobs" class="btn btn-danger">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@stop
