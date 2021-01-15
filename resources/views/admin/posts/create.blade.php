@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{__('posts.New post')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('admin.posts')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="title"><strong>{{__('posts.Title')}}*</strong></label>
                            <input type="text" required name="title" id="title" class="form-control" value="{{old('title')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="content"><strong>{{__('posts.Content')}}*</strong></label>
                            <textarea required name="content" id="content" class="form-control" cols="80"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group col-sm-12 mb-3">
                            <input type="text" name="link" id="link" class="form-control" value="{{old('link')}}" placeholder="{{__('posts.Link')}}">
                            <span class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button">
                                    <a href="{{__('posts.Link')}}" target="_blank">
                                        <i class="fa fa-globe-europe"></i>
                                    </a>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label for="author_id"><strong>{{__('posts.Author')}}*</strong></label>
                            <select id="author_id" name="author_id" class="form-control">
                                <option>{{__('Select...')}}</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" {{Auth::user()->id==$user->id?"selected":""}}>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="category_id"><strong>{{__('posts.Category')}}</strong></label>
                            <select id="category_id" name="category_id" class="form-control">
                                <option>{{__('Select...')}}</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-1">
                            <label for="is_published"><strong>{{__('posts.Is published')}}</strong></label>
                            <input type="checkbox" name="is_published" id="is_published" class="form-control">
                        </div>
                    </div>

                    <a href="/admin/posts" class="btn btn-danger">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@stop
