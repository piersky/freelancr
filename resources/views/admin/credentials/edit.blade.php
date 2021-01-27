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
                <form action="{{route('admin.credentials.update', ['id' => $credential->id])}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @method('PATCH')
                    <div class="row">
                        <div class="form-group col-sm-1">
                            <label for="credential_category_id"><strong>{{__('credentials.Category')}}*</strong></label>
                        </div>
                        <div class="form-group col-sm-4">
                            <select id="credential_category_id" name="credential_category_id" class="form-control">
                                <option value="">{{__('Select...')}}</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{$credential->credential_category_id==$category->id?"selected":""}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-1">
                            <label for="name"><strong>{{__('credentials.Name')}}*</strong></label>
                        </div>
                        <div class="form-group col-sm-4">
                            <input type="text" required name="name" id="name" class="form-control" value="{{$credential->name}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-1">
                            <label for="host_name"><strong>{{__('credentials.Host')}}</strong></label>
                        </div>
                        <div class="form-group col-sm-4">
                            <input type="text"  name="host_name" id="host_name" class="form-control" value="{{$credential->host_name}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-1">
                            <label for="user_name"><strong>{{__('credentials.User name')}}</strong></label>
                        </div>
                        <div class="form-group col-sm-4">
                            <input type="text"  name="user_name" id="user_name" class="form-control" value="{{$credential->user_name}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-1">
                            <label for="password"><strong>{{__('credentials.Password')}}</strong></label>
                        </div>
                        <div class="form-group col-sm-4">
                            <input type="text"  name="password" id="password" class="form-control" value="{{$credential->password}}">
                        </div>
                        <div class="form-group col-sm-1">
                            <a class="btn btn-warning text-uppercase" id="generate_password">{{__('credentials.Generate')}}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-1">
                            <label for="description"><strong>{{__('credentials.Description')}}</strong></label>
                        </div>
                        <div class="form-group col-sm-4">
                            <input type="text" name="description" id="description" class="form-control" value="{{$credential->description}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-1">
                            <label for="customer_id"><strong>{{__('credentials.Customer')}}</strong></label>
                        </div>
                        <div class="form-group col-sm-4">
                            <select id="customer_id" name="customer_id" class="form-control">
                                <option value="">{{__('Select...')}}</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}" {{$credential->customer_id==$customer->id?"selected":""}}>{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <a href="/admin/credentials" class="btn btn-danger">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @parent
    <script>
        function randPassword(letters, numbers, either) {
            var chars = [
                "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz", // letters
                "0123456789", // numbers
                "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_%#@!£&" // either
            ];

            return [letters, numbers, either].map(function(len, i) {
                return Array(len).fill(chars[i]).map(function(x) {
                    return x[Math.floor(Math.random() * x.length)];
                }).join('');
            }).concat().join('').split('').sort(function(){
                return 0.5-Math.random();
            }).join('')
        }

        $('document').ready(function () {
            $('div.alert').fadeOut(5000);

            $('#generate_password').on('click', function (){
                var newPass = randPassword(5,3,2);

                $('#password').val(newPass);
            });
        })
    </script>
@endsection
