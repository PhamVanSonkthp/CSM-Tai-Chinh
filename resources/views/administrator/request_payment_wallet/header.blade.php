@php
    $title = "Yêu cầu rút tiền";
@endphp
@section('title')
    <title>{{$title}}</title>
@endsection

@section('name')
    <h4 class="page-title">{{$title}}</h4>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('request_payment_wallet')
    class="mm-active"
@endsection
