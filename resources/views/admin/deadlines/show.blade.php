@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{__('deadlines.Deadline')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="form-group col-sm-1">
                        <label for="deadline_category"><strong>{{__('deadlines.Category')}}</strong></label>
                    </div>
                    <div class="form-group col-sm-4">
                        <input type="text" readonly name="deadline_category" id="deadline_category" class="form-control" value="{{$deadline->category_name}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-1">
                        <label for="name"><strong>{{__('deadlines.Name')}}</strong></label>
                    </div>
                    <div class="form-group col-sm-4">
                        <input type="text" readonly name="name" id="name" class="form-control" value="{{$deadline->name}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-1">
                        <label for="description"><strong>{{__('deadlines.Description')}}</strong></label>
                    </div>
                    <div class="form-group col-sm-4">
                        <input type="text" readonly name="description" id="description" class="form-control" value="{{$deadline->description}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-1">
                        <label for="deadline_at"><strong>{{__('deadlines.Deadline date')}}</strong></label>
                    </div>
                    <div class="form-group col-sm-4">
                        <input type="date" readonly name="deadline_at" id="deadline_at" class="form-control" value="{{$deadline->deadline_at}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-1">
                        <label for="customer"><strong>{{__('deadlines.Customer')}}</strong></label>
                    </div>
                    <div class="form-group col-sm-4">
                        <input type="text" readonly name="customer" id="customer" class="form-control" value="{{$deadline->customer_name}}">
                    </div>
                </div>
                <a href="/admin/deadlines" class="btn btn-danger">{{__('Cancel')}}</a>
                <a href="/admin/deadlines/{{$deadline->id}}/edit" class="btn btn-primary"><span class="fa fa-pencil-alt"></span></a>
            </div>
        </div>
    </div>
@endsection
