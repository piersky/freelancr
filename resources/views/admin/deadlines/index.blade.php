@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-lg-12 mb-2">
            <a class="btn btn-success text-uppercase" href="{{ route("admin.deadlines.create") }}">
                {{__('deadlines.Add new deadline')}}
            </a>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <h1 class="text-uppercase">{{__('deadlines.Deadlines')}}</h1>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-danger" id="btn-reset">
                    <span class="fa fa-times"></span>
                </button>
                <button type="button" class="btn btn-success" id="btn-filter">
                    <span class="fa fa-filter"></span>
                </button>
            </div>
        </div>
        @if($deadlines ?? '')
            <div class="row">
                <div class="col-sm-4 my-2 justify-content-end">
                    {{$deadlines->links()}}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        @if($deadlines ?? '')
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-center text-uppercase">{{__('deadlines.Deadline')}}</th>
                                <th class="text-center text-uppercase">{{__('deadlines.Category')}}</th>
                                <th class="text-center text-uppercase">{{__('deadlines.Customer')}}</th>
                                <th class="text-center text-uppercase">{{__('deadlines.Name')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($deadlines as $deadline)
                                <tr id="tr-{{$deadline->id}}" onclick="location.href='/admin/deadlines/{{$deadline->id}}';">
                                    <td class="text-center">{{$deadline->deadline_at}}</td>
                                    <td class="text-center"><strong>{{$deadline->category_name}}</strong></td>
                                    <td class="text-center">{{$deadline->customer_name}}</td>
                                    <td class="text-center">{{$deadline->name}}</td>
                                </tr>
                            @endforeach
                            @else
                                <tr><td><h2>{{__('deadlines.No deadlines yet.')}}</h2></td></tr>
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
            @if($deadlines ?? '')
                <div class="row">
                    <div class="col-sm-4 my-2 justify-content-end">
                        {{$deadlines->links()}}
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">{{__('Filter')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
