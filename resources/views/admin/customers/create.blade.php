@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{__('customers.New customer')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <form action="{{route('admin.customers')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="name"><strong>{{__('customers.Name')}}*</strong></label>
                            <input type="text" required name="name" id="name" class="form-control" value="{{old('name')}}" placeholder="{{__('customers.Name')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="address"><strong>{{__('customers.Address')}}</strong></label>
                            <input type="text" name="address" id="address" class="form-control" value="{{old('address')}}" placeholder="{{__('customers.Address')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="vat_number"><strong>{{__('customers.VAT Number')}}</strong></label>
                            <input type="text" name="vat_number" id="vat_number" class="form-control" value="{{old('vat_number')}}">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="fiscal_code"><strong>{{__('customers.Fiscal Code')}}</strong></label>
                            <input type="text" name="fiscal_code" id="fiscal_code" class="form-control" value="{{old('fiscal_code')}}">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="unique_code"><strong>{{__('customers.Unique Code')}}</strong></label>
                            <input type="text" name="unique_code" id="unique_code" class="form-control" value="{{old('unique_code')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="email"><strong>{{__('customers.Email')}}</strong></label>
                            <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="phone"><strong>{{__('customers.Phone')}}</strong></label>
                            <input type="tel" name="phone" id="phone" class="form-control" value="{{old('phone')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-1">
                            <label for="is_active"><strong>{{__('customers.Is active')}}</strong></label>
                            <input type="checkbox" checked name="is_active" id="is_active" class="form-control">
                        </div>
                    </div>
                    <a href="/admin/customers" class="btn btn-danger">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
