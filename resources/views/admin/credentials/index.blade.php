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
            <div class="col-sm-2">
                <button type="button" class="btn btn-danger" id="btn-reset">
                    <span class="fa fa-times"></span>
                </button>
                <button type="button" class="btn btn-success" id="btn-filter">
                    <span class="fa fa-filter"></span>
                </button>
            </div>
        </div>
        @if($credentials ?? '')
            <div class="row">
                <div class="col-sm-4 my-2 justify-content-end">
                    {{$credentials->links()}}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        @if($credentials ?? '')
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-center text-uppercase">{{__('credentials.Category')}}</th>
                                <th class="text-center text-uppercase">{{__('credentials.Customer')}}</th>
                                <th class="text-center text-uppercase">{{__('credentials.Name')}}</th>
                                <th class="text-center text-uppercase">{{__('credentials.Host')}}</th>
                                <th class="text-center text-uppercase">{{__('credentials.User name')}}</th>
                                <th class="text-center text-uppercase">{{__('credentials.Password')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($credentials as $credential)
                                <tr id="tr-{{$credential->id}}" onclick="location.href='/admin/credentials/{{$credential->id}}';">
                                    <td class="text-center"><strong>{{$credential->category}}</strong></td>
                                    <td class="text-center">{{$credential->customer}}</td>
                                    <td class="text-center">{{$credential->name}}</td>
                                    <td class="text-center">{{$credential->host_name}}</td>
                                    <td class="text-center">{{$credential->user_name}}</td>
                                    <td class="text-center">{{$credential->password}}</td>
                                </tr>
                            @endforeach
                            @else
                                <tr><td><h2>{{__('credentials.No posts yet.')}}</h2></td></tr>
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
            @if($credentials ?? '')
                <div class="row">
                    <div class="col-sm-4 my-2 justify-content-end">
                        {{$credentials->links()}}
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
                <div class="modal-body">
                    {{__('Please filter.')}}
                    <div class="row align-content-center">
                        <form action="{{route('admin.credentials.filter')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="container">
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label for="credential_category_id"><strong>{{__('credentials.Category')}}*</strong></label>
                                    </div>
                                    <div class="form-group col-sm-8">
                                        <select id="credential_category_id" name="credential_category_id" class="form-control">
                                            <option value="">{{__('Select...')}}</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label for="name"><strong>{{__('credentials.Name')}}*</strong></label>
                                    </div>
                                    <div class="form-group col-sm-8">
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label for="host_name"><strong>{{__('credentials.Host')}}</strong></label>
                                    </div>
                                    <div class="form-group col-sm-8">
                                        <input type="text"  name="host_name" id="host_name" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label for="user_name"><strong>{{__('credentials.User name')}}</strong></label>
                                    </div>
                                    <div class="form-group col-sm-8">
                                        <input type="text"  name="user_name" id="user_name" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label for="description"><strong>{{__('credentials.Description')}}</strong></label>
                                    </div>
                                    <div class="form-group col-sm-8">
                                        <input type="text" name="description" id="description" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label for="customer_id"><strong>{{__('credentials.Customer')}}</strong></label>
                                    </div>
                                    <div class="form-group col-sm-8">
                                        <select id="customer_id" name="customer_id" class="form-control">
                                            <option value="">{{__('Select...')}}</option>
                                            @foreach($customers as $customer)
                                                <option value="{{$customer->id}}" {{$customer->id==$customer_id?"selected":""}}>{{$customer->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <a href="/admin/credentials" class="btn btn-danger">{{__('Cancel')}}</a>
                                <button type="submit" class="btn btn-primary text-uppercase">{{__('Find')}}</button>
                            </div>
                        </form>
                    </div>
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

        $('#btn-filter').on('click', function (evt) {
            evt.preventDefault();
            var url = '/admin/credentials/filter';

            $('#filterModal').modal('show');

            $('#btn-elimina').on('click', function () {
                $.ajax({
                    url: url,
                    method: 'post',
                    data: {
                        '_token': '{{csrf_token()}}'
                    },
                    complete: function (resp) {
                        if (resp.responseText == 1) {
                            tr.remove();
                            $('#filterModal').modal('hide');
                        } else {
                            console.log('Problem contacting the server');
                        }
                    }
                });
            });
        });
        $('#btn-reset').on('click', function (evt) {
            evt.preventDefault();
            var url = '/admin/credentials/reset-filter';
            $.ajax({
                url: url,
                method: 'post',
                data: {
                    '_token': '{{csrf_token()}}'
                },
                complete: function (resp) {
                    if (resp.responseText == 1) {
                        console.log('OK');
                    } else {
                        console.log('Problem contacting the server');
                    }
                }
            });
        });
    </script>
@endsection
