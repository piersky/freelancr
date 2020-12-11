@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{__('hourstacks.New hour stack')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('admin.hourstacks')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="name"><strong>{{__('hourstacks.Name')}}*</strong></label>
                            <input type="text" required name="name" id="name" class="form-control" value="{{old('name')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label for="qty"><strong>{{__('hourstacks.Number of hours')}}*</strong></label>
                            <input type="number" required name="qty" id="qty" class="form-control" value="{{old('qty')}}">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="customer_id"><strong>{{__('hourstacks.Customer')}}</strong></label>
                            <select id="customer_id" name="customer_id" class="form-control">
                                <option>{{__('Select...')}}</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="price"><strong>{{__('hourstacks.Price')}}*</strong></label>
                            <input type="number" required name="price" id="price" class="form-control" value="{{old('price')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-2">
                            <label for="is_active"><strong>{{__('hourstacks.Is active')}}</strong></label>
                            <input type="checkbox" checked name="is_active" id="is_active" class="form-control">
                        </div>
                        <div class="form-group col-2">
                            <label for="is_prepayed"><strong>{{__('hourstacks.Is prepayed')}}</strong></label>
                            <input type="checkbox" name="is_prepayed" id="is_prepayed" class="form-control">
                        </div>
                    </div>

                    <a href="/admin/hourstacks" class="btn btn-danger">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@stop
