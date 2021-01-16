@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-lg-12 mb-2">
            <a class="btn btn-success text-uppercase" href="{{ route("admin.credentials.create") }}">
                {{__('credentials.Add new credential')}}
            </a>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <h1 class="text-uppercase">{{__('credentials.Credentials')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        @if($credentials ?? '')
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-center text-uppercase">{{__('credentials.Category')}}</th>
                                <th class="text-center text-uppercase">{{__('credentials.Name')}}</th>
                                <th class="text-center text-uppercase">{{__('credentials.Host')}}</th>
                                <th class="text-center text-uppercase">{{__('credentials.User name')}}</th>
                                <th class="text-center text-uppercase">{{__('credentials.Password')}}</th>
                                <th class="text-center text-uppercase">{{__('credentials.Description')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($credentials as $credential)
                                <tr id="tr-{{$credential->id}}" onclick="location.href='/admin/credentials/{{$credential->id}}';">
                                    <td class="text-center text-uppercase"><strong>{{$credential->category}}</strong></td>
                                    <td class="text-center">{{$credential->name}}</td>
                                    <td class="text-center text-uppercase">{{$credential->host_name}}</td>
                                    <td class="text-center">{{$credential->user_name}}</td>
                                    <td class="text-center">{{$credential->password}}</td>
                                    <td class="text-center">{{$credential->description}}</td>
                                </tr>
                            @endforeach
                            @else
                                <tr><td><h2>{{__('credentials.No posts yet.')}}</h2></td></tr>
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
        })
    </script>
@endsection
