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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')

    <form action="{{route('welcome.information')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Information Register -->
        <div class="info">
            <h3 class="info-heading">
                @if(auth()->user()->isConfirm())
                    <strong>Cập nhật</strong>
                @else
                    <strong>Xác minh</strong>
                @endif
            </h3>
            <h4 class="info-title">
                Chụp ảnh định danh
            </h4>

            <div class="info-front">
                <div class="info-front__img">
                    <div class="info-front__cover">
                        <p>Mặt trước CMND/CCCD</p>
                        <svg viewBox="64 64 896 896" focusable="false" data-icon="camera" width="30" height="30"
                             fill="#FFF"
                             aria-hidden="true">
                            <path
                                d="M864 248H728l-32.4-90.8a32.07 32.07 0 00-30.2-21.2H358.6c-13.5 0-25.6 8.5-30.1 21.2L296 248H160c-44.2 0-80 35.8-80 80v456c0 44.2 35.8 80 80 80h704c44.2 0 80-35.8 80-80V328c0-44.2-35.8-80-80-80zm8 536c0 4.4-3.6 8-8 8H160c-4.4 0-8-3.6-8-8V328c0-4.4 3.6-8 8-8h186.7l17.1-47.8 22.9-64.2h250.5l22.9 64.2 17.1 47.8H864c4.4 0 8 3.6 8 8v456zM512 384c-88.4 0-160 71.6-160 160s71.6 160 160 160 160-71.6 160-160-71.6-160-160-160zm0 256c-53 0-96-43-96-96s43-96 96-96 96 43 96 96-43 96-96 96z">
                            </path>
                        </svg>
                    </div>

                    <input name="feature_image_1" type='file' class="info-front__input" accept="image/*"/>
                </div>

                <div class="info-front__img">
                    <div class="info-front__cover">
                        <p>Mặt sau CMND/CCCD</p>
                        <svg viewBox="64 64 896 896" focusable="false" data-icon="camera" width="30" height="30"
                             fill="#FFF"
                             aria-hidden="true">
                            <path
                                d="M864 248H728l-32.4-90.8a32.07 32.07 0 00-30.2-21.2H358.6c-13.5 0-25.6 8.5-30.1 21.2L296 248H160c-44.2 0-80 35.8-80 80v456c0 44.2 35.8 80 80 80h704c44.2 0 80-35.8 80-80V328c0-44.2-35.8-80-80-80zm8 536c0 4.4-3.6 8-8 8H160c-4.4 0-8-3.6-8-8V328c0-4.4 3.6-8 8-8h186.7l17.1-47.8 22.9-64.2h250.5l22.9 64.2 17.1 47.8H864c4.4 0 8 3.6 8 8v456zM512 384c-88.4 0-160 71.6-160 160s71.6 160 160 160 160-71.6 160-160-71.6-160-160-160zm0 256c-53 0-96-43-96-96s43-96 96-96 96 43 96 96-43 96-96 96z">
                            </path>
                        </svg>
                    </div>

                    <input name="feature_image_2" type='file' class="info-front__input" accept="image/*"/>
                </div>

                <div class="info-front__img">
                    <div class="info-front__cover">
                        <p>Ảnh chân dung</p>
                        <svg viewBox="64 64 896 896" focusable="false" data-icon="camera" width="30" height="30"
                             fill="#FFF"
                             aria-hidden="true">
                            <path
                                d="M864 248H728l-32.4-90.8a32.07 32.07 0 00-30.2-21.2H358.6c-13.5 0-25.6 8.5-30.1 21.2L296 248H160c-44.2 0-80 35.8-80 80v456c0 44.2 35.8 80 80 80h704c44.2 0 80-35.8 80-80V328c0-44.2-35.8-80-80-80zm8 536c0 4.4-3.6 8-8 8H160c-4.4 0-8-3.6-8-8V328c0-4.4 3.6-8 8-8h186.7l17.1-47.8 22.9-64.2h250.5l22.9 64.2 17.1 47.8H864c4.4 0 8 3.6 8 8v456zM512 384c-88.4 0-160 71.6-160 160s71.6 160 160 160 160-71.6 160-160-71.6-160-160-160zm0 256c-53 0-96-43-96-96s43-96 96-96 96 43 96 96-43 96-96 96z">
                            </path>
                        </svg>
                    </div>

                    <input name="feature_image_3" type='file' class="info-front__input" accept="image/*"/>
                </div>

                <button class="btn btn-primary btn-link info-front__btn" disabled type="button">Tiếp tục</button>
            </div>
        </div>

        <!-- Offcanvas Information -->
        <div class="offcanvas header-modal info-offcanvas" data-bs-backdrop="false" tabindex="-1" id="offcanvasInfo"
             aria-labelledby="headerNotifyLabel">
            <div class="offcanvas-header">
                <!-- <button type="button" class="btn header-modal-close" data-bs-dismiss="offcanvas" aria-label="Close">

                </button> -->
                <h5 class="offcanvas-title" style="margin-right: 0px !important;" id="offcanvasInfoLabel">Xác minh</h5>
            </div>
            <div class="offcanvas-body">
                <div class="header-modal__noNotify">
                    <h4 class="info-title">
                        Thông tin cá nhân
                    </h4>

                    <div class="info-form">
                        <div class="input-group">
                            <input id="name" name="name" type="text" class="form-control" placeholder="Họ tên" required>
                            <span class="input-group-text">
                            <svg viewBox="64 64 896 896" focusable="false" data-icon="idcard" width="25" height="25"
                                 fill="rgb(119, 119, 119)" aria-hidden="true">
                                <path
                                    d="M928 160H96c-17.7 0-32 14.3-32 32v640c0 17.7 14.3 32 32 32h832c17.7 0 32-14.3 32-32V192c0-17.7-14.3-32-32-32zm-40 632H136V232h752v560zM610.3 476h123.4c1.3 0 2.3-3.6 2.3-8v-48c0-4.4-1-8-2.3-8H610.3c-1.3 0-2.3 3.6-2.3 8v48c0 4.4 1 8 2.3 8zm4.8 144h185.7c3.9 0 7.1-3.6 7.1-8v-48c0-4.4-3.2-8-7.1-8H615.1c-3.9 0-7.1 3.6-7.1 8v48c0 4.4 3.2 8 7.1 8zM224 673h43.9c4.2 0 7.6-3.3 7.9-7.5 3.8-50.5 46-90.5 97.2-90.5s93.4 40 97.2 90.5c.3 4.2 3.7 7.5 7.9 7.5H522a8 8 0 008-8.4c-2.8-53.3-32-99.7-74.6-126.1a111.8 111.8 0 0029.1-75.5c0-61.9-49.9-112-111.4-112s-111.4 50.1-111.4 112c0 29.1 11 55.5 29.1 75.5a158.09 158.09 0 00-74.6 126.1c-.4 4.6 3.2 8.4 7.8 8.4zm149-262c28.5 0 51.7 23.3 51.7 52s-23.2 52-51.7 52-51.7-23.3-51.7-52 23.2-52 51.7-52z">
                                </path>
                            </svg>
                        </span>
                        </div>

                        <div class="input-group">
                            <input id="identity_card_number" name="identity_card_number" type="text" class="form-control" placeholder="Số CMND/CCCD" required>

                            <span class="input-group-text">
                            <svg viewBox="64 64 896 896" focusable="false" data-icon="pic-right" width="25" height="25"
                                 fill="rgb(119, 119, 119)" aria-hidden="true">
                                <path
                                    d="M952 792H72c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h880c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8zm0-632H72c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h880c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8zm-24 500c8.8 0 16-7.2 16-16V380c0-8.8-7.2-16-16-16H416c-8.8 0-16 7.2-16 16v264c0 8.8 7.2 16 16 16h512zM472 436h400v152H472V436zM80 646c0 4.4 3.6 8 8 8h224c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8H88c-4.4 0-8 3.6-8 8v56zm8-204h224c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8H88c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8z">
                                </path>
                            </svg>
                        </span>
                        </div>

                        <div class="input-group">
                            <input id="date_of_birth" name="date_of_birth" type="text" class="form-control date" maskplaceholder="dd/mm/yyyy"
                                   placeholder="Ngày / Tháng / Năm ( ngày sinh của bạn )"
                                   style="border-radius: 5px; padding: 7px; font-size: 16px; width: 100%; border: 1px solid rgb(234, 234, 234);" required>
                        </div>

                        <select name="education_level_id" class="form-select" aria-label="Default select example" required>
                            @foreach(\App\Models\EducationLevel::all() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>

                        <div class="input-group">
                            <input id="purpose" name="purpose" type="text" class="form-control" placeholder="Mục đích khoản vay" required>
                            <span class="input-group-text">
                            <svg viewBox="64 64 896 896" focusable="false" data-icon="file-add" width="25" height="25"
                                 fill="rgb(119, 119, 119)" aria-hidden="true">
                                <path
                                    d="M854.6 288.6L639.4 73.4c-6-6-14.1-9.4-22.6-9.4H192c-17.7 0-32 14.3-32 32v832c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V311.3c0-8.5-3.4-16.7-9.4-22.7zM790.2 326H602V137.8L790.2 326zm1.8 562H232V136h302v216a42 42 0 0042 42h216v494zM544 472c0-4.4-3.6-8-8-8h-48c-4.4 0-8 3.6-8 8v108H372c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h108v108c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V644h108c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8H544V472z">
                                </path>
                            </svg>
                        </span>
                        </div>

                        <div class="input-group full">
                            <input id="name_friend" name="name_friend" type="text" class="form-control" placeholder="Tên người thân" required>
                        </div>

                        <div class="input-group full">
                            <input id="phone_friend" name="phone_friend" type="text" class="form-control" placeholder="Số điện thoại người thân" required>
                        </div>

                        <select id="middle_income_id" name="middle_income_id" class="form-select" aria-label="Default select example" required>
                            @foreach(\App\Models\MiddleIncome::all() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>

                        <select id="married_status_id" name="married_status_id" class="form-select" aria-label="Default select example" required>
                            @foreach(\App\Models\MarriedStatus::all() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>

                        <div class="input-group mb-3">
                            <input id="work" name="work" type="text" class="form-control" placeholder="Công việc hiện tại" required>
                            <div class="input-group-text">
                                <svg viewBox="64 64 896 896" focusable="false" data-icon="schedule" width="25"
                                     height="25"
                                     fill="rgb(119, 119, 119)" aria-hidden="true">
                                    <path
                                        d="M928 224H768v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H548v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H328v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H96c-17.7 0-32 14.3-32 32v576c0 17.7 14.3 32 32 32h832c17.7 0 32-14.3 32-32V256c0-17.7-14.3-32-32-32zm-40 568H136V296h120v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h148v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h148v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h120v496zM416 496H232c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm0 136H232c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm308.2-177.4L620.6 598.3l-52.8-73.1c-3-4.2-7.8-6.6-12.9-6.6H500c-6.5 0-10.3 7.4-6.5 12.7l114.1 158.2a15.9 15.9 0 0025.8 0l165-228.7c3.8-5.3 0-12.7-6.5-12.7H737c-5-.1-9.8 2.4-12.8 6.5z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <button class="btn btn-link info-offcanvas__btn" type="submit">
                            Tiếp tục
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Offcanvas Bank -->
        <div class="offcanvas header-modal info-bank" data-bs-backdrop="false" tabindex="-1" id="offcanvasBank"
             aria-labelledby="headerNotifyLabel">
            <div class="offcanvas-header">
                <!-- <button type="button" class="btn header-modal-close" data-bs-dismiss="offcanvas" aria-label="Close">

             </button> -->
                <h5 class="offcanvas-title" style="margin-right: 0px !important;"id="offcanvasInfoLabel">Xác minh</h5>
            </div>
            <div class="offcanvas-body">

                <div class="header-modal__noNotify">
                    <h4 class="info-title">
                        Thông tin ngân hàng thụ hưởng
                    </h4>

                    <div class="info-bank__card"
                         style="background-image: url({{asset('assets/user/assets/images/Card.jpg')}})">
                        <div class="info-bank__card-info">
                            <img src="{{asset('assets/user/assets/images/VIETBANK-logo.webp')}}" alt="Image Brand">
                            <div class="info-bank__card-text">
                            <span class="CardNumber">
                                •••••••••
                            </span>

                                <span class="NameNumber">
                                *********
                            </span>
                            </div>
                        </div>
                    </div>

                    <div class="info-bank__form">
                        <!--Style 2-->
                        <select name="bank_id" class="selectpicker">
                            @foreach(\App\Models\Bank::orderBy('name')->get() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>

                        <div class="input-group">
                        <span class="input-group-text">
                            <svg viewBox="64 64 896 896" focusable="false" data-icon="global" width="25" height="25"
                                 fill="rgb(119, 119, 119)" aria-hidden="true">
                                <path
                                    d="M854.4 800.9c.2-.3.5-.6.7-.9C920.6 722.1 960 621.7 960 512s-39.4-210.1-104.8-288c-.2-.3-.5-.5-.7-.8-1.1-1.3-2.1-2.5-3.2-3.7-.4-.5-.8-.9-1.2-1.4l-4.1-4.7-.1-.1c-1.5-1.7-3.1-3.4-4.6-5.1l-.1-.1c-3.2-3.4-6.4-6.8-9.7-10.1l-.1-.1-4.8-4.8-.3-.3c-1.5-1.5-3-2.9-4.5-4.3-.5-.5-1-1-1.6-1.5-1-1-2-1.9-3-2.8-.3-.3-.7-.6-1-1C736.4 109.2 629.5 64 512 64s-224.4 45.2-304.3 119.2c-.3.3-.7.6-1 1-1 .9-2 1.9-3 2.9-.5.5-1 1-1.6 1.5-1.5 1.4-3 2.9-4.5 4.3l-.3.3-4.8 4.8-.1.1c-3.3 3.3-6.5 6.7-9.7 10.1l-.1.1c-1.6 1.7-3.1 3.4-4.6 5.1l-.1.1c-1.4 1.5-2.8 3.1-4.1 4.7-.4.5-.8.9-1.2 1.4-1.1 1.2-2.1 2.5-3.2 3.7-.2.3-.5.5-.7.8C103.4 301.9 64 402.3 64 512s39.4 210.1 104.8 288c.2.3.5.6.7.9l3.1 3.7c.4.5.8.9 1.2 1.4l4.1 4.7c0 .1.1.1.1.2 1.5 1.7 3 3.4 4.6 5l.1.1c3.2 3.4 6.4 6.8 9.6 10.1l.1.1c1.6 1.6 3.1 3.2 4.7 4.7l.3.3c3.3 3.3 6.7 6.5 10.1 9.6 80.1 74 187 119.2 304.5 119.2s224.4-45.2 304.3-119.2a300 300 0 0010-9.6l.3-.3c1.6-1.6 3.2-3.1 4.7-4.7l.1-.1c3.3-3.3 6.5-6.7 9.6-10.1l.1-.1c1.5-1.7 3.1-3.3 4.6-5 0-.1.1-.1.1-.2 1.4-1.5 2.8-3.1 4.1-4.7.4-.5.8-.9 1.2-1.4a99 99 0 003.3-3.7zm4.1-142.6c-13.8 32.6-32 62.8-54.2 90.2a444.07 444.07 0 00-81.5-55.9c11.6-46.9 18.8-98.4 20.7-152.6H887c-3 40.9-12.6 80.6-28.5 118.3zM887 484H743.5c-1.9-54.2-9.1-105.7-20.7-152.6 29.3-15.6 56.6-34.4 81.5-55.9A373.86 373.86 0 01887 484zM658.3 165.5c39.7 16.8 75.8 40 107.6 69.2a394.72 394.72 0 01-59.4 41.8c-15.7-45-35.8-84.1-59.2-115.4 3.7 1.4 7.4 2.9 11 4.4zm-90.6 700.6c-9.2 7.2-18.4 12.7-27.7 16.4V697a389.1 389.1 0 01115.7 26.2c-8.3 24.6-17.9 47.3-29 67.8-17.4 32.4-37.8 58.3-59 75.1zm59-633.1c11 20.6 20.7 43.3 29 67.8A389.1 389.1 0 01540 327V141.6c9.2 3.7 18.5 9.1 27.7 16.4 21.2 16.7 41.6 42.6 59 75zM540 640.9V540h147.5c-1.6 44.2-7.1 87.1-16.3 127.8l-.3 1.2A445.02 445.02 0 00540 640.9zm0-156.9V383.1c45.8-2.8 89.8-12.5 130.9-28.1l.3 1.2c9.2 40.7 14.7 83.5 16.3 127.8H540zm-56 56v100.9c-45.8 2.8-89.8 12.5-130.9 28.1l-.3-1.2c-9.2-40.7-14.7-83.5-16.3-127.8H484zm-147.5-56c1.6-44.2 7.1-87.1 16.3-127.8l.3-1.2c41.1 15.6 85 25.3 130.9 28.1V484H336.5zM484 697v185.4c-9.2-3.7-18.5-9.1-27.7-16.4-21.2-16.7-41.7-42.7-59.1-75.1-11-20.6-20.7-43.3-29-67.8 37.2-14.6 75.9-23.3 115.8-26.1zm0-370a389.1 389.1 0 01-115.7-26.2c8.3-24.6 17.9-47.3 29-67.8 17.4-32.4 37.8-58.4 59.1-75.1 9.2-7.2 18.4-12.7 27.7-16.4V327zM365.7 165.5c3.7-1.5 7.3-3 11-4.4-23.4 31.3-43.5 70.4-59.2 115.4-21-12-40.9-26-59.4-41.8 31.8-29.2 67.9-52.4 107.6-69.2zM165.5 365.7c13.8-32.6 32-62.8 54.2-90.2 24.9 21.5 52.2 40.3 81.5 55.9-11.6 46.9-18.8 98.4-20.7 152.6H137c3-40.9 12.6-80.6 28.5-118.3zM137 540h143.5c1.9 54.2 9.1 105.7 20.7 152.6a444.07 444.07 0 00-81.5 55.9A373.86 373.86 0 01137 540zm228.7 318.5c-39.7-16.8-75.8-40-107.6-69.2 18.5-15.8 38.4-29.7 59.4-41.8 15.7 45 35.8 84.1 59.2 115.4-3.7-1.4-7.4-2.9-11-4.4zm292.6 0c-3.7 1.5-7.3 3-11 4.4 23.4-31.3 43.5-70.4 59.2-115.4 21 12 40.9 26 59.4 41.8a373.81 373.81 0 01-107.6 69.2z">
                                </path>
                            </svg>
                        </span>
                            <input id="bank_number" name="bank_number" type="text" class="form-control bankNumber" placeholder="Nhập số tài khỏan"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1')" required
                                   maxlength="19">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <svg viewBox="64 64 896 896" focusable="false" data-icon="user" width="25" height="25"
                                     fill="rgb(119, 119, 119)" aria-hidden="true">
                                    <path
                                        d="M858.5 763.6a374 374 0 00-80.6-119.5 375.63 375.63 0 00-119.5-80.6c-.4-.2-.8-.3-1.2-.5C719.5 518 760 444.7 760 362c0-137-111-248-248-248S264 225 264 362c0 82.7 40.5 156 102.8 201.1-.4.2-.8.3-1.2.5-44.8 18.9-85 46-119.5 80.6a375.63 375.63 0 00-80.6 119.5A371.7 371.7 0 00136 901.8a8 8 0 008 8.2h60c4.4 0 7.9-3.5 8-7.8 2-77.2 33-149.5 87.8-204.3 56.7-56.7 132-87.9 212.2-87.9s155.5 31.2 212.2 87.9C779 752.7 810 825 812 902.2c.1 4.4 3.6 7.8 8 7.8h60a8 8 0 008-8.2c-1-47.8-10.9-94.3-29.5-138.2zM512 534c-45.9 0-89.1-17.9-121.6-50.4S340 407.9 340 362c0-45.9 17.9-89.1 50.4-121.6S466.1 190 512 190s89.1 17.9 121.6 50.4S684 316.1 684 362c0 45.9-17.9 89.1-50.4 121.6S557.9 534 512 534z">
                                    </path>
                                </svg>
                            </div>
                            <input id="bank_name" name="bank_name" type="text" class="form-control bankName" placeholder="Tên người thụ hưởng" required>
                        </div>

                        <button class="btn btn-link info-bank__btn" type="submit">
                            Hoàn tất
                        </button>


                    </div>
                </div>
            </div>

        </div>

        <!-- Offcanvas Success -->
        <div class="offcanvas header-modal info-done" data-bs-backdrop="false" tabindex="-1" id="offcanvasDone"
             aria-labelledby="headerNotifyLabel">
            <div class="offcanvas-header">
                <!-- <button type="button" class="btn header-modal-close" data-bs-dismiss="offcanvas" aria-label="Close">

             </button> -->
                <h5 class="offcanvas-title" style="margin-right: 0px !important;" id="offcanvasInfoLabel">Xác minh</h5>
            </div>
            <div class="offcanvas-body">
                <img src="{{asset('assets/user/assets/images/succes.jpg')}}" alt="Image Done">

                <div class="info-done__icon">
                    <svg class="ant-progress-circle" viewBox="0 0 100 100">
                        <path class="ant-progress-circle-trail" d="M 50,50 m 0,-47
                    a 47,47 0 1 1 0,94
                    a 47,47 0 1 1 0,-94" stroke="#52c41a" stroke-linecap="round" stroke-width="6" fill-opacity="0"
                              style="stroke-dasharray: 295.31px, 295.31px; stroke-dashoffset: 0px; transition: stroke-dashoffset 0.3s ease 0s, stroke-dasharray 0.3s ease 0s, stroke 0.3s ease 0s, stroke-width 0.06s ease 0.3s, opacity 0.3s ease 0s;">
                        </path>
                        <path class="ant-progress-circle-path" d="M 50,50 m 0,-47
                    a 47,47 0 1 1 0,94
                    a 47,47 0 1 1 0,-94" stroke="" stroke-linecap="round" stroke-width="6" opacity="1" fill-opacity="0"
                              style="stroke-dasharray: 295.31px, 295.31px; stroke-dashoffset: 0px; transition: stroke-dashoffset 0s ease 0s, stroke-dasharray 0s ease 0s, stroke ease 0s, stroke-width ease 0.3s, opacity ease 0s;">
                        </path>
                        <path class="ant-progress-circle-path" d="M 50,50 m 0,-47
                    a 47,47 0 1 1 0,94
                    a 47,47 0 1 1 0,-94" stroke="" stroke-linecap="round" stroke-width="6" opacity="0" fill-opacity="0"
                              style="stroke: rgb(82, 196, 26); stroke-dasharray: 0px, 295.31px; stroke-dashoffset: 0px; transition: stroke-dashoffset 0s ease 0s, stroke-dasharray 0s ease 0s, stroke ease 0s, stroke-width ease 0.3s, opacity ease 0s;">
                        </path>
                    </svg>

                    <span class="info-done__icon-logo">
                    <svg viewBox="64 64 896 896" focusable="false" data-icon="check" width="28px" height="28px"
                         fill="#52c41a" aria-hidden="true">
                        <path
                            d="M912 190h-69.9c-9.8 0-19.1 4.5-25.1 12.2L404.7 724.5 207 474a32 32 0 00-25.1-12.2H112c-6.7 0-10.4 7.7-6.3 12.9l273.9 347c12.8 16.2 37.4 16.2 50.3 0l488.4-618.9c4.1-5.1.4-12.8-6.3-12.8z">
                        </path>
                    </svg>
                </span>
                </div>

                <p class="info-done__text">Chúc mừng</p>
                <p class="info-done__text">Hoàn thành xác minh danh tính. Vui lòng tiếp tục</p>

                <button class="btn btn-link info-done__btn">
                    Tiếp tục
                </button>
            </div>


        </div>

        <!-- Offcanvas Confirm -->
        <div class="offcanvas header-modal info-confirm" data-bs-backdrop="false" tabindex="-1" id="infoConfirm"
             aria-labelledby="infoConfirmLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn header-modal-close" data-bs-dismiss="offcanvas" aria-label="Close">
                    <svg viewBox="64 64 896 896" focusable="false" data-icon="left" width="22" height="22"
                         fill="currentColor" aria-hidden="true">
                        <path
                            d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z">
                        </path>
                    </svg>
                </button>
                <h5 class="offcanvas-title" style="margin-right: 0px !important;" id="staticBackdropLabel">Đăng ký khoản vay</h5>
            </div>
            <div class="offcanvas-body">
                <h4 class="info-confirm__text">Hãy kiểm tra lại khoản vay bạn đăng ký</h4>

                <div class="info-confirm__term">
                    <p>Khoản tiền vay:</p>&ensp;
                    <span><strong>200,000,000</strong> VND</span>
                </div>

                <div class="info-confirm__term">
                    <p>Thời hạn thanh toán:</p>&ensp;
                    <span><strong>6</strong> tháng</span>
                </div>
                <a href="javascript:void(0)" class="info-confirm__link" data-bs-toggle="modal"
                   data-bs-target="#ContractModal">
                    Xem hợp đồng
                </a>


                <div id="signature-pad" class="info-signature signature-pad">
                    <div class="signature-pad-body">
                        <canvas width="535" style="touch-action: none; user-select: none;" height="537"></canvas>
                    </div>
                    <div class="signature-pad-actions">
                        <button type="button" class="btn clear" data-action="clear">Làm mới</button>
                        <!-- <div> -->
                        <!-- <button type="button" class="button save" data-action="save-png">Save as PNG</button> -->
                        <!-- <button type="button" class="button save" data-action="save-jpg">Save as JPG</button> -->
                        <!-- <button type="button" class="button save" data-action="save-svg">Save as SVG</button> -->
                        <!-- </div> -->
                    </div>
                </div>

                <img src="" class="info-signature__img">

                <button class="btn btn-link info-contract__btn" data-action="save-png">
                    Ký xác nhận
                </button>
                <button class="btn btn-link info-contract__btn-confirm">Xác nhận</button>
                <button class="btn btn-link info-contract__btn-create">Tạo hợp đồng</button>
            </div>
        </div>

        <!-- Modal Contract -->
        <div class="modal fade info-contract" id="ContractModal" tabindex="-1" aria-labelledby="ContractModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ContractModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>
                            <center>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</center>
                        </h5>
                        <h5>
                            <center>ĐỘC LẬP - TỰ DO - HANH PHÚC</center>
                        </h5>
                        <br>
                        <h5>
                            <center>HỢP ĐỒNG VAY TIỀN</center>
                        </h5>
                        <br>
                        <h5>Thông tin cơ bản về khoản vay</h5>
                        <p>Bên A (Bên cho vay) Tập đoàn Tài chính MIRAE ASSET</p>
                        <p>Bên B (Bên vay) Ông / Bà :Cập nhật khi hoàn thành</p>
                        <p> Số CMT / CCCD :Cập nhật khi hoàn thành</p>
                        <p>Ngày ký : 04:13 PM 17/06/2022</p>
                        <p>Số tiền khoản vay : 200,000,000 VNĐ</p>
                        <p>Mã hợp đồng : </p>
                        <p>Thời gian vay : 6 tháng</p>
                        <p>lãi suất cho vay là 01% mỗi tháng</p>
                        <p>Hợp đồng nêu rõ các bên đã đặt được thỏa thuận vay sau khi thương lượng và trên cơ sở bình
                            đẳng , tự nguyện và nhất trí . Tất cả các bên cần đọc kỹ tất cả các điều khoản trong thỏa
                            thuận này, sau khi ký vào thỏa thuận này coi như các bên đã hiểu đầy đủ và đồng ý hoàn toàn
                            với tất cả các điều khoản và nội dung trong thỏa thuân này.</p>
                        <p>1.Phù hợp với các nguyên tắc bình đẳng , tự nguyện , trung thực và uy tín , hai bên thống
                            nhất ký kết hợp đồng vay sau khi thương lượng và cùng cam kết thực hiện.</p>
                        <p>2.Bên B cung cấp tài liệu đính kèm của hợp đồng vay và có hiệu lực pháp lý như hợp đồng vay
                            này.</p>
                        <p>3.Bên B sẽ tạo lệnh tính tiền gốc và lãi dựa trên số tiền vay từ ví ứng dụng do bên A cung
                            cấp.</p>
                        <p>4.Điều khoản đảm bảo.</p>
                        <p>- Bên vay không được sử dụng tiền vay để thực hiện các hoạt động bất hợp pháp .Nếu không ,
                            bên A có quyền yêu cầu bên B hoàn trả ngay tiền gốc và lãi , bên B phải chịu các trách nhiêm
                            pháp lý phát sinh từ đó.</p>
                        <p>- Bên vay phải trả nợ gốc và lãi trong thời gian quy định hợp đồng. Đối với phần quá hạn ,
                            người cho vay có quyền thu hồi nơ trong thời hạn và thu ( lãi quá hạn ) % trên tổng số tiền
                            vay trong ngày.</p>
                        <p>- Gốc và lãi của mỗi lần trả nợ sẽ được hệ thống tự động chuyển từ tài khoản ngân hàng do bên
                            B bảo lưu sang tài khoản ngân hàng của bên A . Bên B phải đảm bảo có đủ tiền trong tài khoản
                            ngân hàng trước ngày trả nợ hàng tháng.</p>
                        <p>5.Chịu trách nhiệm do vi pham hợp đồng</p>
                        <p>- Nếu bên B không trả được khoản vay theo quy định trong hợp đồng. Bên B phải chịu các khoản
                            bồi thường thiệt hại đã thanh lý và phí luật sư, phí kiện tụng, chi phí đi lại và các chi
                            phí khác phát sinh do kiện tụng.</p>
                        <p>- Khi bên A cho rẳng bên B đã hoặc có thể xảy ra tình huống ảnh hưởng đến khoản vay thì bên A
                            có quyền yêu cầu bên B phải trả lại kịp thời trược thời hạn.</p>
                        <p>- Người vay và người bảo lãnh không được vi phạm điều lệ hợp đồng vì bất kỳ lý do gì</p>
                        <p>6.Phương thức giải quyết tranh chấp hợp đồng. <br>Tranh chấp phát sinh trong quá trình thực
                            hiện hợp đồng này sẽ được giải quyết thông qua thương lượng thân thiện giữa các bên hoặc có
                            thể nhờ bên thứ ba làm trung gian hòa giải .Nếu thương lượng hoặc hòa giải không thành , có
                            thể khởi kiện ra tòa án nhân dân nơi bên A có trụ sở.</p>
                        <p>7.Khi người vay trong quá trình xét duyệt khoản vay không thành công do nhiều yếu tố khác
                            nhau như chứng minh thư sai, thẻ ngân hàng sai , danh bạ sai. Việc thông tin sai lệch này sẽ
                            khiến hệ thống phát hiện nghi ngờ gian lận hoặc giả mạo khoản vay và bên vay phải chủ động
                            hợp tác với bên A để xử lý.</p>
                        <p>8.Nếu không hợp tác. Bên A có quyền khởi kiện ra Tòa án nhân dân và trình báo lên Trung tâm
                            Báo cáo tín dụng của Ngân hàng nhà nước Việt Nam , hồ sơ nợ xấu sẽ được phản ánh trong báo
                            cáo tín dụng , ảnh hưởng đến tín dụng sau này của người vay , vay vốn ngân hàng và hạn chế
                            tiều dùng của người thân , con cái người vay ...</p><br>
                        <p>Người vay ký</p>
                        <h5></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')

@endsection
