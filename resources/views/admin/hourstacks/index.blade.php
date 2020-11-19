@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-2">
                <a class="btn btn-success text-uppercase" href="{{ route("admin.hourstacks.create") }}">
                    {{__('hourstacks.Add new hour stack')}}
                </a>
            </div>
            <div class="col-sm-4">
                <h1 class="text-uppercase">{{__('hourstacks.Hour stacks')}}</h1>
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
            <div class="col-sm-8">
                <div class="table-responsive">
                    <table class="table table-striped">
                        @if($hourstacks ?? '')
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-center text-uppercase">{{__('hourstacks.Name')}}</th>
                                <th class="text-center text-uppercase">{{__('hourstacks.Customer')}}</th>
                                <th class="text-center text-uppercase">{{__('hourstacks.Hours')}}</th>
                                <th class="text-center text-uppercase">{{__('hourstacks.Used')}}</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($hourstacks as $hourstack)
                                <tr id="tr-{{$hourstack->id}}" class="{{(!$hourstack->is_active?"bg-secondary":"")}}">
                                    <td class="text-center">{{$hourstack->name}}</td>
                                    <td class="text-center">{{$hourstack->customer_name}}</td>
                                    <td class="text-left">{{$hourstack->qty}}</td>
                                    <td class="text-center">{{$hourstack->used_hours}}</td>
                                    <td class="d-flex justify-content-end">
                                        <a href="/admin/activities/{{$hourstack->id}}/filter" class="btn btn-success mr-1"><span class="fa fa-eye"></span></a>
                                        <a href="/admin/hourstacks/{{$hourstack->id}}/edit" class="btn btn-info ml-1"><span class="fa fa-pencil-alt"></span></a>
                                </tr>
                            @endforeach
                            @else
                                <tr><td><h2>{{__('hourstacks.No hour stacks yet.')}}</h2></td></tr>
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
