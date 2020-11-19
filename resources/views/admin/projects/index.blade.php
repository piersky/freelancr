@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-2">
                <a class="btn btn-success text-uppercase" href="{{ route("admin.projects.create") }}">
                    {{__('projects.Add new project')}}
                </a>
            </div>
            <div class="col-sm-4">
                <h1 class="text-uppercase">{{__('projects.Projects')}}</h1>
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
                        @if($projects ?? '')
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-center text-uppercase">{{__('projects.Name')}}</th>
                                <th class="text-center text-uppercase">{{__('projects.Deadline')}}</th>
                                <th class="text-center text-uppercase">{{__('projects.Description')}}</th>
                                <th class="text-center text-uppercase">{{__('projects.Customer')}}</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projects as $project)
                                <tr id="tr-{{$project->id}}" class="{{(!$project->is_active?"bg-secondary":"")}}">
                                    <td class="text-center text-uppercase"><strong>{{$project->name}}</strong></td>
                                    <td class="text-center">{{$project->deadline_date!=""?date('m/d/Y H:m:s', strtotime($project->deadline_date)):""}}</td>
                                    <td class="text-center">{{$project->description}}</td>
                                    <td class="text-center">{{$project->customer_name}}</td>
                                    <td class="d-flex justify-content-end">
                                        <a href="/admin/projects/{{$project->id}}/edit" class="btn btn-info"><span class="fa fa-pencil-alt"></span></a>
                                </tr>
                            @endforeach
                            @else
                                <tr><td><h2>{{__('projects.No projects yet.')}}</h2></td></tr>
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
