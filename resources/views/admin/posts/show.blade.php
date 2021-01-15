@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-uppercase">{{$post->title}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="form-group col-sm-12">
                        <p>{!! $post->content !!}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group col-sm-12 mb-3">
                        <a href="{{$post->link}}">{{$post->link}}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-3">
                        <label for="author"><strong>{{__('posts.Author')}}</strong></label>
                        <input type="text" readonly name="author" id="author" class="form-control" value="{{$post->author_name}}">
                    </div>
                    <div class="form-group col-6">
                        <label for="category"><strong>{{__('posts.Category')}}</strong></label>
                        <input type="text" readonly name="category" id="category" class="form-control" value="{{$post->category_name}}">
                    </div>
                    <div class="form-group col-1">
                        <label for="is_published"><strong>{{__('posts.Is published')}}</strong></label>
                        <input type="checkbox" {{$post->is_published?"checked":""}} name="is_published" id="is_published" class="form-control">
                    </div>
                </div>

                <a href="/admin/posts" class="btn btn-danger mr-3">{{__('Cancel')}}</a>
                <a href="/admin/posts/{{$post->id}}/edit" class="btn btn-info ml-1"><span class="fa fa-pencil-alt"></span></a>
            </div>
        </div>
    </div>
@stop
