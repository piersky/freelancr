@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{$credential->name}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="form-group col-sm-1">
                        <label for="credential_category_id"><strong>{{__('credentials.Category')}}*</strong></label>
                    </div>
                    <div class="form-group col-sm-7">
                        <input type="text" readonly name="name" id="name" class="form-control" value="{{$credential->category}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-1">
                        <label for="name"><strong>{{__('credentials.Name')}}*</strong></label>
                    </div>
                    <div class="form-group col-sm-7">
                        <input type="text" readonly name="name" id="name" class="form-control" value="{{$credential->name}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-1">
                        <label for="host_name"><strong>{{__('credentials.Host')}}</strong></label>
                    </div>
                    <div class="form-group col-sm-7">
                        <input type="text" readonly name="host_name" id="host_name" class="form-control" value="{{$credential->host_name}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-1">
                        <label for="user_name"><strong>{{__('credentials.User name')}}</strong></label>
                    </div>
                    <div class="form-group col-sm-7">
                        <input type="text" readonly name="user_name" id="user_name" class="form-control" value="{{$credential->user_name}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-1">
                        <label for="password"><strong>{{__('credentials.Password')}}</strong></label>
                    </div>
                    <div class="form-group col-sm-7">
                        <input type="text" readonly name="password" id="password" class="form-control" value="{{$credential->password}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-1">
                        <label for="description"><strong>{{__('credentials.Description')}}</strong></label>
                    </div>
                    <div class="form-group col-sm-7">
                        <input type="text" readonly name="description" id="description" class="form-control" value="{{$credential->description}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-1">
                        <label for="customer_name"><strong>{{__('credentials.Customer')}}</strong></label>
                    </div>
                    <div class="form-group col-sm-7">
                        <input type="text" readonly name="customer_name" id="customer_name" class="form-control" value="{{$credential->customer}}">
                    </div>
                </div>
                <a href="/admin/credentials" class="btn btn-danger">{{__('Cancel')}}</a>
                <a href="/admin/credentials/{{$credential->id}}/edit" class="btn btn-primary"><span class="fa fa-pencil-alt"></span></a>
            </div>
        </div>
    </div>
@endsection
