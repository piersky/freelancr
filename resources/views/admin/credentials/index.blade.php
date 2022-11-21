@extends('layouts.app')

@section('content')
    <style>
        .blurPassword{
            color: transparent;
            text-shadow: 0 0 5px rgba(0,0,0,0.5);
        } 

        .backgroundGreen{
            background-color: #90EE90;
            position: relative;
        }

        .backgroundGreen:after{
            position: absolute;
            content: "{{__('credentials.Copied')}}";
            top: -13px;
            left: 0;
            background-color: white;
            border-radius: 20px;
            color: black;
            font-weight: bold;
            padding: 1px 10px;
            border: 1px solid black;
            text-shadow: none;
        }
    </style>
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
        
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped credentials-table">
                        @if($credentials ?? '')
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-center text-uppercase">{{__('credentials.Category')}}</th>
                                <th class="text-center text-uppercase">{{__('credentials.Customer')}}</th>
                                <th class="text-center text-uppercase">{{__('credentials.Name')}}</th>
                                {{-- <th class="text-center text-uppercase">{{__('credentials.Host')}}</th> --}}
                                <th class="text-center text-uppercase">{{__('credentials.User name')}}</th>
                                <th class="text-center text-uppercase">{{__('credentials.Password')}}</th>
                                <th class="text-center text-uppercase">&nbsp;</th>
                                <th class="text-center text-uppercase">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($credentials as $credential)
                                <tr id="tr-{{$credential->id}}" class="controlVisibility"> {{--onclick="location.href='/admin/credentials/{{$credential->id}}';">--}}
                                    <td class="text-center"><strong>{{$credential->category}}</strong></td>
                                    <td class="text-center">{{$credential->customer}}</td>
                                    <td class="text-center">{{$credential->name}}</td>
                                    {{--<td class="text-center">{{$credential->host_name}}</td>--}}
                                    <td class="text-center userName">{{$credential->user_name}}</td>
                                    <td class="text-center pwrd blurPassword">{{$credential->password}}</td>
                                    <td class="text-center"><button class="btn btn-primary" onclick="location.href='{{route('admin.credentials.update', ['id' => $credential->id])}}';" ><i class="fas fa-info"></i></button></td>
                                    <td><button type="button" id="deleteCredential" class="btn btn-danger ml-1 deleteCredential" data-id="{{$credential->id}}" data-url="/admin/credentials/{{$credential->id}}"><span class="fa fa-trash"></span></button></td>
                                </tr>
                            @endforeach
                            @else
                                <tr><td><h2>{{__('credentials.No credentials yet.')}}</h2></td></tr>
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
            @php /*
            @if($credentials ?? '')
                <div class="row">
                    <div class="col-sm-4 my-2 justify-content-end">
                        {{$credentials->appends($_GET)->links()}}
                    </div>
                </div>
            @endif
            */@endphp
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
                        <form action="{{route('admin.credentials.filter')}}" method="GET">
                            
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
                    <button type="submit" class="btn btn-danger text-uppercase" id ="btn-delete">{{__('Delete')}}</button>
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

            $('.credentials-table').DataTable({
                "lengthMenu": [10, 20, 50, 100, 250, 500],
                "pageLength": 50,
                language: {
                    url: '/js/dataTables.italian.json'
                }
            });
        });

        $('#btn-filter').on('click', function (evt) {
            evt.preventDefault();
            var url = '/admin/credentials/filter';

            $('#filterModal').modal('show');
        });

        $('#btn-reset').on('click', function (evt) {
            evt.preventDefault();
            $.ajax({
                url: '/admin/credentials/reset-filter',
                method: 'post',
                data: {
                    '_token': '{{csrf_token()}}'
                },
                complete: function (resp) {
                    if (resp.responseText == 1) {
                        console.log('OK');
                        window.location.href = '/admin/credentials';
                    } else {
                        console.log('Problem contacting the server');
                    }
                }
            });
        });

        $('.deleteCredential').on('click', function (evt) {
            evt.preventDefault();

            var url = $(this).data('url');
            var id = $(this).data('id');
            var tr = $('#tr-'+id);

            $('#deleteModal').modal('show');

            $('#btn-delete').on('click', function () {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    data: {
                        '_token': '{{csrf_token()}}'
                    },
                    complete: function(resp){
                        if (resp.responseText == 1) {
                            tr.remove();
                            $('#deleteModal').modal('hide');
                        } else {
                            console.log('Problem contacting the server');
                        }
                    }
                })
            });
        });

        $(".userName").on("click", function(){
            var username = $(this);
            copyElementText(this);
            $("*").removeClass("backgroundGreen");
            username.addClass("backgroundGreen");
        });

        $(".pwrd").on("click", function(){
            var lucchetto = $(this);
            if (!lucchetto.hasClass("blurPassword")){
                copyElementText(this);
                $("*").removeClass("backgroundGreen");
                lucchetto.addClass("backgroundGreen");
            } 
        });
            $(".pwrd").on({
            mouseenter : function(){ $(this).removeClass("blurPassword") },
            mouseout: function(){  $(this).addClass("blurPassword")  }
        });

        function copyElementText(tag) {
            var text = $(tag).text();
            var elem = document.createElement("textarea");
            document.body.appendChild(elem);
            elem.value = text;
            elem.select();
            document.execCommand("copy");
            document.body.removeChild(elem);
        }
    </script>
@endsection
