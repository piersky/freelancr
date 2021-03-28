@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-2">
                <a class="btn btn-success text-uppercase" href="{{ route("admin.posts.create") }}">
                    {{__('posts.Add new post')}}
                </a>
            </div>
            <div class="col-sm-4">
                <h1 class="text-uppercase">{{__('posts.Posts')}}</h1>
            </div>
            @if(session()->has('message'))
                @component('layouts.alert-info')
                    {{session()->get('message')}}
                @endcomponent
            @endif
            <div class="col-sm-6">
                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    {{-- TODO: change view with a more similar wiki page --}}
                    <table class="table table-striped">
                        @if($posts ?? '')
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-center text-uppercase">{{__('posts.Title')}}</th>
                                <th class="text-center text-uppercase">{{__('posts.Excerpt')}}</th>
                                <th class="text-center text-uppercase">{{__('posts.Author')}}</th>
                                <th class="text-center text-uppercase">{{__('posts.Last update')}}</th>
                                <th class="text-center text-uppercase">
                                    <select id="category_id" name="category_id" class="form-control">
                                        <option>{{__('posts.Category')}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr id="tr-{{$post->id}}" class="{{(!$post->is_published?"bg-secondary":"")}}" onclick="location.href='/admin/posts/{{$post->id}}';">
                                    <td class="text-center text-uppercase"><strong>{{substr($post->title, 0, 30)}}...</strong></td>
                                    <td class="text-center">{{substr($post->content, 0, 50)}}...</td>
                                    <td class="text-center text-uppercase">{{$post->author_name}}</td>
                                    <td class="text-center">{{date('d/m/Y H:i:s', strtotime($post->updated_at))}}</td>
                                    <td class="text-center">{{$post->category_name}}</td>
                                </tr>
                            @endforeach
                            @else
                                <tr><td><h2>{{__('posts.No posts yet.')}}</h2></td></tr>
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            $('div.alert').fadeOut(5000);

            $('#category_id').change(function(){
                location.href = "/admin/posts/"+$(this).val()+"/filter";
            })
        })
    </script>
@endsection
