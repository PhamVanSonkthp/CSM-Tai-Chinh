@extends('administrator.layouts.master')

@section('title')
    <title>Home page</title>
@endsection

@section('name')
    <h4 class="page-title">Cài đặt</h4>
@endsection
@section('css')
    <link href="{{asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{asset('admins/products/add/add.css') }}" rel="stylesheet"/>
@endsection

@include('administrator.setting.active_slidebar')

@section('content')

    <form action="{{route('administrator.setting.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-md-6">

            <div class="form-group mt-3">
                <label>Link CSKH</label>
                <input type="text" name="url_support" class="form-control @error('url_support') is-invalid @enderror" required value="{{$logo->url_support}}">
                @error('url_support')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </div>
    </form>

@endsection


@section('js')
    <script src="{{asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{asset('admins/products/add/add.js') }}"></script>

@endsection
