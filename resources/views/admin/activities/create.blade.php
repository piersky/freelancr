@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h1 class="text-uppercase">{{__('activities.New activity')}}</h1>
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
                <form action="{{route('admin.activities')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label for="start_at"><strong>{{__('activities.Start at')}}*</strong></label>
                            <input type="datetime-local" required name="start_at" id="start_at" class="form-control" value="{{Carbon::now()->format('Y-m-d\TH:i')}}">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="stop_at"><strong>{{__('activities.End at')}}*</strong></label>
                            <input type="datetime-local" required name="stop_at" id="stop_at" class="form-control" value="{{Carbon::now()->format('Y-m-d\TH:i')}}">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="used_hours"><strong>{{__('activities.Used hours')}}</strong></label>
                            <input type="number" step="0.1" name="used_hours" id="used_hours" class="form-control" value="{{old('used_hours')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="name"><strong>{{__('activities.Name')}}*</strong></label>
                            <input type="text" required name="name" id="name" class="form-control" value="{{old('name')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="description"><strong>{{__('activities.Description')}}</strong></label>
                            <input type="text" name="description" id="description" class="form-control" value="{{old('description')}}" placeholder="{{__('activities.Description')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label for="customer_id"><strong>{{__('activities.Customer name')}}*</strong></label>
                            <select required id="customer_id" name="customer_id" class="form-control">
                                <option value="">{{__('Select...')}}</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="hourstack_id"><strong>{{__('activities.Hour stack')}}*</strong></label>
                            <select id="hourstack_id" name="hourstack_id" class="form-control">
                                <option>{{__('Select...')}}</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="projetc_id"><strong>{{__('activities.Project')}}*</strong></label>
                            <select id="project_id" name="project_id" class="form-control">
                                <option>{{__('Select...')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-3">
                            <label for="assigned_to"><strong>{{__('activities.Assigned to')}}</strong></label>
                            <select id="assigned_to" name="assigned_to" class="form-control">
                                <option>{{__('Select...')}}</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" {{Auth::user()->id==$user->id?"selected":""}}>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-1">
                            <label for="is_active"><strong>{{__('activities.Is active')}}</strong></label>
                            <input type="checkbox" checked name="is_active" id="is_active" class="form-control">
                        </div>
                    </div>

                    <a href="/admin/activities" class="btn btn-danger">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            $('#start_at').change(function (){
                console.log($(this).val());
                var d1 = new Date($(this).val());
                var d2 = new Date($('#stop_at').val());
                var diff_ms = d2 - d1;
                var diff_days = Math.floor(diff_ms / 86400000);
                var diff_hours = Math.floor((diff_ms % 86400000) / 3600000);
                var diff_mins = Math.round(((diff_ms % 86400000) % 3600000) / 60000);

                var hours = diff_days * 24 + diff_hours + Math.round(diff_mins * 10 / 60) / 10;

                $('#used_hours').val(hours.toFixed(1));
            })

            $('#stop_at').change(function (){
                console.log($(this).val());
                var d1 = new Date($('#start_at').val());
                var d2 = new Date($(this).val());
                var diff_ms = d2 - d1;
                var diff_days = Math.floor(diff_ms / 86400000);
                var diff_hours = Math.floor((diff_ms % 86400000) / 3600000);
                var diff_mins = Math.round(((diff_ms % 86400000) % 3600000) / 60000);

                var hours = diff_days * 24 + diff_hours + Math.round(diff_mins * 10 / 60) / 10;

                $('#used_hours').val(hours.toFixed(1));
            })

            $('#customer_id').change(function (){
                var customer = $('#customer_id').val();
                var url = '/admin/activities/hourstack_by_customer/' + customer;
                var hourstack = $('#hourstack_id');
                var project = $('#project_id');

                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        '_token': '{{csrf_token()}}'
                    },
                    complete: function (response){
                        hourstack.empty();
                        project.empty();

                        var data = JSON.parse(response.responseText);
                        var hourstacks = data['hourstacks'];
                        var projects = data['projects'];

                        for (var i=0; i<hourstacks.length; i++){
                            var new_option = $("<option />");
                            new_option.attr('value', hourstacks[i].id);
                            new_option.text(hourstacks[i].name);
                            hourstack.append(new_option);
                        }
                        for (var i=0; i<projects.length; i++){
                            var new_option = $("<option />");
                            new_option.attr('value', projects[i].id);
                            new_option.text(projects[i].name);
                            project.append(new_option);
                        }
                    }
                })
            })
        })
    </script>
@endsection
