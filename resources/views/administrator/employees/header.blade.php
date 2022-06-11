@php
    $title = "Nhân viên";
@endphp
@section('title')
    <title>{{$title}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('name')
    <h4 class="page-title">{{$title}}</h4>
@endsection

@section('employee')
    class="mm-active"
@endsection

