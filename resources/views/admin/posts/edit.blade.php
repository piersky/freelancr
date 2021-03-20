@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{__('posts.Edit post')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('admin.posts.update', ['id' => $post->id])}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @method('PATCH')
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="title"><strong>{{__('posts.Title')}}*</strong></label>
                            <input type="text" required name="title" id="title" class="form-control" value="{{old('title', $post->title)}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="content"><strong>{{__('posts.Content')}}*</strong></label>
                            <textarea required name="content" id="content" class="form-control content" cols="80">{{$post->content}}</textarea>
                            <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
                            <script>
                                tinymce.init({
                                    selector:'textarea.content',
                                    height: 500,
                                    plugins: 'code',
                                    menubar: 'file edit insert view format table tools code help'
                                });
                            </script>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12 mb-3">
                            <label for="link"><strong>{{__('posts.Link')}}</strong></label>
                            <input type="text" name="link" id="link" class="form-control" value="{{old('link', $post->link)}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label for="author_id"><strong>{{__('posts.Author')}}*</strong></label>
                            <select id="author_id" name="author_id" class="form-control">
                                <option {{$post->author_id==""?"selected":""}}>{{__('Select...')}}</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" {{$post->author_id==$user->id?"selected":""}}>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="category_id"><strong>{{__('posts.Category')}}</strong></label>
                            <select id="category_id" name="category_id" class="form-control">
                                <option>{{__('Select...')}}</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{$post->category_id==$category->id?"selected":""}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-1">
                            <label for="is_published"><strong>{{__('posts.Is published')}}</strong></label>
                            <input type="checkbox" {{$post->is_published?"checked":""}} name="is_published" id="is_published" class="form-control">
                        </div>
                    </div>

                    <a href="/admin/posts" class="btn btn-danger">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@stop
