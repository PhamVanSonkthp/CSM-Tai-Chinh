@extends('user.layouts.master')

@php
    $title = config('app.name', 'Laravel');
@endphp

@section('title')
    <title>{{$title}}</title>

@endsection

@section('name')
    <h4 class="page-title">{{$title}}</h4>
@endsection

@section('css')
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')

    <div class=""
         style="opacity: 1; transform: none; width: 100%; padding: 10px 20px; display: flex; justify-content: center; align-items: center; flex-direction: column;">
        <div class="ant-image"><img src="{{asset('/assets/images/success.9ecb81807c34f122fc93.jpg')}}"
                                    class="ant-image-img"></div>
        <div>
            <div class="ant-image"><img style="height: 120px;" src="{{asset('/assets/images/Yes_Check_Circle.svg.png')}}"
                                        class="ant-image-img"></div>
        </div>
        <span class="ant-typography mt-3" style="font-size: 17px; text-align: center;">Chúc mừng</span><span
            class="ant-typography mt-3" style="font-size: 17px; text-align: center;">Hoàn thành xác minh danh tính. Vui lòng tiếp tục</span>
        <div class="mt-5"
            style="background: rgb(0, 45, 191); width: 70%; display: flex; justify-content: center; align-items: center; margin: 20px; border-radius: 10px; padding: 5px;">
            <a href="{{\App\Models\Setting::first()->url_support}}" class="ant-typography"
                  style="color: rgb(255, 255, 255); background: rgba(0, 45, 191, 0.86); font-weight: 700; font-size: 17px;">Liên hệ CSKH</a>
        </div>

        <div class="mt-5"
             style="background: rgb(0 1 6); width: 70%; display: flex; justify-content: center; align-items: center; margin: 20px; border-radius: 10px; padding: 5px;">
            <a href="{{route('welcome.index')}}" class="ant-typography"
               style="color: rgb(255, 255, 255); font-weight: 700; font-size: 17px;">Trở về trang chủ</a>
        </div>
    </div>

@endsection

@section('js')

@endsection
