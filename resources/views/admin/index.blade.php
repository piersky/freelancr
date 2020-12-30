@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card col-sm-6">
                <div class="card-header">
                    <h4>{{__('Jobs Due')}}</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{__('Jobs for')}} {{Auth::user()->name}}</h5>
                    <table>
                    @foreach($jobs as $job)
                        <tr>
                            <td class="text-left px-3">{{date('d/m/Y H:i', strtotime($job->deadline))}}</td>
                            <td class="text-left text-uppercase">{{$job->description}}</td>
                            <td class="text-leftr px-3">{{$job->customer_name}}</td>
                        </tr>
                    @endforeach
                    </table>
                </div>
                <div class="card-footer bg-transparent border-success">Footer</div>
            </div>
            <div class="card col-sm-6">
                <div class="card-header">
                    <h4>{{__('Last activities')}}</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{__('Jobs for')}} {{Auth::user()->name}}</h5>
                    <table>
                        @foreach($jobs as $job)
                            <tr>
                                <td class="text-left px-3">{{date('d/m/Y H:i', strtotime($job->deadline))}}</td>
                                <td class="text-left text-uppercase">{{$job->description}}</td>
                                <td class="text-leftr px-3">{{$job->customer_name}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="card-footer bg-transparent border-success">Footer</div>
            </div>
        </div>
    </div>
@endsection
