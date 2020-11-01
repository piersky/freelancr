@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h1 class="text-uppercase">{{__('customers.Customers')}}</h1>
            </div>
            @if(session()->has('message'))
                @component('components.alert-info')
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
            <div class="col-sm-3 my-2">
                <a href="{{route('admin.customers.create')}}" class="btn btn-success text-uppercase">{{__('customers.Add new customer')}}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="table-responsive">
                    <table class="table table-striped">
                        @if($customers ?? '')
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-center text-uppercase">{{__('customers.Name')}}</th>
                                <th class="text-center text-uppercase">{{__('customers.Phone')}}</th>
                                <th class="text-center text-uppercase">{{__('customers.Email')}}</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr id="tr-{{$customer->id}}" class="{{($customer->is_active?"":'bg-gradient-secondary')}}">
                                    <td class="text-center">{{$customer->name}}</td>
                                    <td class="text-center">{{$customer->phone}}</td>
                                    <td class="text-center">{{$customer->email}}</td>
                                    <td class="d-flex justify-content-end">
                                        <a href="/admin/customers/{{$customer->id}}/edit" class="btn btn-info"><span class="fa fa-pencil-alt"></span></a>
                                        <button type="button" class="btn btn-danger" data-id="{{$customer->id}}" data-url="/admin/customers/{{$customer->id}}"><span class="fa fa-trash"></span></button></td>
                                </tr>
                            @endforeach
                            @else
                                <tr><td><h2>{{__('customers.No jobs yet.')}}</h2></td></tr>
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">{{__('Confirm')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{__('Please, click on DELETE to confirm the record cancellation.')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-danger text-uppercase" id ="btn-elimina">{{__('Delete')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $('document').ready(function () {
            $('div.alert').fadeOut(5000);

            $('.btn.btn-danger').on('click', function (evt) {
                evt.preventDefault();

                var id = $(this).data('id');
                var url = $(this).data('url');
                var tr = $('#tr-'+id);

                $('#deleteModal').modal('show');

                $('#btn-elimina').on('click', function () {
                    $.ajax({
                        url: url,
                        method: 'DELETE',
                        data: {
                            '_token': '{{csrf_token()}}'
                        },
                        complete: function (resp) {
                            console.log(url);
                            if (resp.responseText == 1) {
                                tr.remove();
                                $('#deleteModal').modal('hide');
                            } else {
                                console.log('Problem contacting the server ' + resp.responseText);
                            }
                        }
                    });
                });
            });
        });
    </script>
@endsection
