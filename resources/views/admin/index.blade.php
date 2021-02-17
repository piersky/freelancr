@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <canvas class="my-4 w-100 chartjs-render-monitor" id="activityChart" width="2278" height="960"
                    style="display: block; height: 480px; width: 1139px;"></canvas>
        </div>
        {{csrf_field()}}
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
                        @foreach($activities as $activity)
                            <tr>
                                <td class="text-left px-3">{{date('d/m/Y H:i', strtotime($activity->start_at))}}</td>
                                <td class="text-left text-uppercase">{{$activity->name}}</td>
                                <td class="text-leftr px-3">{{$activity->description}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="card-footer bg-transparent border-success">Footer</div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="js/dashboard.js"></script>
@endsection
