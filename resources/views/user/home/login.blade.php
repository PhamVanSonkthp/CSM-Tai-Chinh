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

@endsection

@section('content')
    <div class="login-container"
         style="background-image: linear-gradient(rgb(255, 255, 255) 0%, rgba(255, 255, 255, 0.9) 100%), url(&quot;/static/media/buildings.84b891d601335be42f55.jpg&quot;); min-height: 100vh; background-repeat: no-repeat; background-size: cover;">
        <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
            <div class="ant-image" style="width: 40%;"><img class="ant-image-img"
                                                            src="https://mafc.com.vn/wp-content/uploads/2020/02/logomia-1.png">
            </div>
            <h5 class="ant-typography" style="text-align: center; font-size: 20px; margin-top: 20px; font-weight: 700;">
                Đăng nhập</h5></div>
        <div
            style="padding: 50px 0px; display: flex; justify-content: center; align-items: center; flex-direction: column;">
            <input placeholder="Số điện thoại của bạn" type="text" class="ant-input ant-input-lg" value="0378115211"
                   style="border-radius: 5px; padding: 7px; font-size: 18px; margin: 10px 0px; background: rgba(0, 86, 143, 0.1);"><input
                placeholder="Mật khẩu" type="password" class="ant-input ant-input-lg"
                style="border-radius: 5px; padding: 7px; font-size: 18px; margin: 10px 0px; background: rgba(0, 86, 143, 0.1);">
            <button type="button" class="ant-btn ant-btn-default ant-btn-lg"
                    style="margin-top: 20px; border-radius: 5px; min-width: 100%; display: flex; justify-content: center; align-items: center; background: rgb(230, 107, 0);">
                <span class="ant-typography" style="color: rgb(255, 255, 255); font-weight: bold;">Đăng nhập ngay</span>
            </button>
            <div style="margin-top: 20px; padding: 10px 20px;"><a class="ant-typography" style="font-size: 17px;">Đăng
                    ký tài khoản mới.</a></div>
        </div>
    </div>
@endsection

@section('js')

@endsection
