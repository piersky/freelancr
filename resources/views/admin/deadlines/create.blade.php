@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{__('deadlines.New deadline')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('admin.deadlines')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-sm-1">
                            <label for="deadline_category_id"><strong>{{__('deadlines.Category')}}*</strong></label>
                        </div>
                        <div class="form-group col-sm-4">
                            <select id="deadline_category_id" name="deadline_category_id" class="form-control">
                                <option value="">{{__('Select...')}}</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-1">
                            <label for="name"><strong>{{__('deadlines.Name')}}*</strong></label>
                        </div>
                        <div class="form-group col-sm-4">
                            <input type="text" required name="name" id="name" class="form-control" value="{{old('name')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-1">
                            <label for="description"><strong>{{__('deadlines.Description')}}</strong></label>
                        </div>
                        <div class="form-group col-sm-4">
                            <input type="text"  name="description" id="description" class="form-control" value="{{old('description')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-1">
                            <label for="deadline_at"><strong>{{__('deadlines.Deadline date')}}</strong></label>
                        </div>
                        <div class="form-group col-sm-4">
                            <input type="date"  name="deadline_at" id="deadline_at" class="form-control" value="{{old('deadline_at')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-1">
                            <label for="customer_id"><strong>{{__('deadlines.Customer')}}*</strong></label>
                        </div>
                        <div class="form-group col-sm-4">
                            <select id="customer_id" name="customer_id" class="form-control">
                                <option value="">{{__('Select...')}}</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <a href="/admin/deadlines" class="btn btn-danger">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            $('div.alert').fadeOut(5000);
        })
    </script>
@endsection
