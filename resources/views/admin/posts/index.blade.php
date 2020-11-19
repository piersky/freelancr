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
                                <th class="text-center text-uppercase">{{__('posts.Category')}}</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr id="tr-{{$post->id}}" class="{{(!$post->is_published?"bg-secondary":"")}}">
                                    <td class="text-center text-uppercase"><strong>{{substr($post->title, 0, 30)}}...</strong></td>
                                    <td class="text-center">{{substr($post->content, 0, 30)}}...</td>
                                    <td class="text-center text-uppercase">{{$post->author_name}}</td>
                                    <td class="text-center">{{date('m/d/Y H:m:s', strtotime($post->updated_at))}}</td>
                                    <td class="text-center">{{$post->category_name}}</td>
                                    <td class="d-flex justify-content-end">
                                        <a href="/admin/posts/{{$post->id}}" class="btn btn-success mr-1"><span class="fa fa-eye"></span></a>
                                        <a href="/admin/posts/{{$post->id}}/edit" class="btn btn-info ml-1"><span class="fa fa-pencil-alt"></span></a>
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
            $('.job-toggle').on('click', function (evt){
                var url = $(this).children().data('url');
                var id = this.id.replace('td-', '');
                $.ajax(
                    {
                        url: url,
                        method: 'PATCH',
                        data: {
                            '_token': '{{csrf_token()}}'
                        },
                        complete: function(resp){
                            console.log(url);
                            console.log(resp);
                        }
                    })
            })
        })
    </script>
@endsection
