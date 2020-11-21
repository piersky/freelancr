@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{__('customers.Edit Customer')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <form action="{{route('admin.customers.update', ['id' => $customer->id])}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @method('PATCH')
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="name"><strong>{{__('customers.Name')}}*</strong></label>
                            <input type="text" required name="name" id="name" class="form-control" value="{{$customer->name}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="address"><strong>{{__('customers.Address')}}</strong></label>
                            <input type="text" name="address" id="address" class="form-control" value="{{$customer->address}}" placeholder="{{__('customers.Address')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="vat_number"><strong>{{__('customers.VAT Number')}}</strong></label>
                            <input type="text" name="vat_number" id="vat_number" class="form-control" value="{{$customer->vat_number}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="fiscal_code"><strong>{{__('customers.Fiscal Code')}}</strong></label>
                            <input type="text" name="fiscal_code" id="fiscal_code" class="form-control" value="{{$customer->fiscal_code}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="email"><strong>{{__('customers.Email')}}</strong></label>
                            <input type="email" name="email" id="email" class="form-control" value="{{$customer->email}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="phone"><strong>{{__('customers.Phone')}}</strong></label>
                            <input type="tel" name="phone" id="phone" class="form-control" value="{{$customer->phone}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-1">
                            <label for="is_active"><strong>{{__('customers.Is active')}}</strong></label>
                            <input type="checkbox" name="is_active" id="is_active" class="form-control" {{$customer->is_active?"checked":""}}>
                        </div>
                    </div>
                    <a href="/admin/customers" class="btn btn-danger">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
