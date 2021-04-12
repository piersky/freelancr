@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{__('settings.Settings')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('admin.user_settings')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-sm-8">
                            <h3>{{__('settings.Langauge of the application')}}</h3>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radioLang" value="en" id="radioLangEN" {{$lang_id=="en"?"checked":""}}>
                                <label class="form-check-label" for="radioLangEN">
                                    English
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radioLang" value="it" id="radioLangIT" {{$lang_id=="it"?"checked":""}}>
                                <label class="form-check-label" for="radioLangEN">
                                    Italiano
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <h3>{{__('settings.Standard pagination')}}</h3>
                            <div class="form-group col-sm-1">
                                <label for="pagination"><strong>{{__('settings.Pagination')}}</strong></label>
                            </div>
                            <div class="form-group col-sm-4">
                                <input type="number" name="pagination" id="pagination" class="form-control" value="{{$pagination}}">
                            </div>
                        </div>
                    </div>

                    <a href="/admin/user_settings" class="btn btn-danger">{{__('Cancel')}}</a>
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
            $('div.alert').fadeOut(5000);
        });
    </script>
@endsection
