@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h1 class="text-uppercase">{{__('jobs.Jobs')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 mb-2">
                <a class="btn btn-success text-uppercase" href="{{ route("admin.jobs.create") }}">
                    {{__('jobs.Add new Job')}}
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="table-responsive">
                    <table class="table table-striped">
                        @if($jobs ?? '')
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-center text-uppercase">{{__('jobs.Done')}}</th>
                                <th class="text-left text-uppercase">{{__('jobs.Deadline')}}</th>
                                <th class="text-left text-uppercase">{{__('jobs.Description')}}</th>
                                <th class="text-left text-uppercase">{{__('jobs.Belongs to')}}</th>
                                <th class="text-left text-uppercase">{{__('jobs.Customer')}}</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jobs as $job)
                                <tr id="tr-{{$job->id}}" class="{{($job->is_done?"bg-secondary":"")}}">
                                    <td class="text-center job-toggle" id="td-{{$job->id}}"><input data-url="/admin/jobs/{{$job->id}}/toggle" type="checkbox" name="is_done" {{$job->is_done==1?"checked":""}}></td>
                                    <td class="text-center">{{date('d/m/Y H:m', strtotime($job->deadline))}}</td>
                                    <td class="text-left text-uppercase">{{$job->description}}</td>
                                    <td class="text-center">{{$job->user_name}}</td>
                                    <td class="text-center">{{$job->customer_name}}</td>
                                    <td class="d-flex justify-content-end">
                                        <a href="/admin/jobs/{{$job->id}}/edit" class="btn btn-info"><span class="fa fa-pencil-alt"></span></a>
                                </tr>
                            @endforeach
                            @else
                                <tr><td><h2>{{__('jobs.No jobs yet.')}}</h2></td></tr>
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
