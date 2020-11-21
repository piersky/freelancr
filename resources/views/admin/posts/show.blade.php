@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{substr($post->title, 0, 30)}}...</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="title"><strong>{{__('posts.Title')}}</strong></label>
                        <input type="text" readonly name="title" id="title" class="form-control" value="{{$post->title}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="content"><strong>{{__('posts.Content')}}</strong></label>
                        <textarea readonly name="content" id="content" class="form-control" cols="5">{{$post->content}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group col-sm-12 mb-3">
                        <label for="link"><strong>{{__('posts.Link')}}</strong></label>
                        <input type="text" readonly name="link" id="link" class="form-control" value="{{$post->link}}">
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

                <a href="/admin/posts" class="btn btn-danger">{{__('Cancel')}}</a>
            </div>
        </div>
    </div>
@stop
