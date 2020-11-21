@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{__('projects.Edit project')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('admin.projects.update', ['id' => $project->id])}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @method('PATCH')
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="name"><strong>{{__('projects.Name')}}*</strong></label>
                            <input type="text" required name="name" id="name" class="form-control" value="{{old('name', $project->name)}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="description"><strong>{{__('projects.Description')}}</strong></label>
                            <input type="text" name="description" id="description" class="form-control" value="{{old('description', $project->description)}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label for="deadline_date"><strong>{{__('projects.Deadline')}}</strong></label>
                            <input type="datetime-local" name="deadline_date" id="deadline_date" class="form-control" value="{{old('deadline_date', $project->deadline_date)}}">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="customer_id"><strong>{{__('projects.Customer')}}</strong></label>
                            <select id="customer_id" name="customer_id" class="form-control">
                                <option>{{__('Select...')}}</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}" {{$customer->id==$project->customer_id?"selected":""}}>{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-1">
                            <label for="is_active"><strong>{{__('projects.Is active')}}</strong></label>
                            <input type="checkbox" {{$project->is_active?"checked":""}} name="is_active" id="is_active" class="form-control">
                        </div>
                    </div>

                    <a href="/admin/projects" class="btn btn-danger">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@stop
