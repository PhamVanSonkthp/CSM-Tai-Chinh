@extends('user.layouts.master')

@php
    $title = config('app.name', 'Laravel');
@endphp

@section('title')
    <title>{{$title}}</title>

    <meta name="keyword" content="Mau Bui Finance">
    <meta name="promotion" content="Mau Bui Finance">
    <meta name="Description" content="Mau Bui Finance - Khóa học về Crypto">

    <meta property="og:url" content="{{env('APP_URL')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Mau Bui Finance"/>
    <meta property="og:description" content="Mau Bui Finance - Khóa học về Crypto"/>
    <meta property="og:image" content="{{env('APP_URL') . optional(\App\Models\Logo::first())->image_path }}"/>

@endsection

@section('name')
    <h4 class="page-title">{{$title}}</h4>
@endsection

@section('css')

@endsection

@section('content')
    <h2 class="App-full text-center p-4 fs-1">Thiết bị không phù hợp</h2>

    <form action="{{route('welcome.loan')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="App-main">

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" tabindex="0">
                    <!-- Begin Header -->
                    <header class="header">
                        <div class="container-xl">
                            <div class="header__wrapper">
                                <div class="header-info">
                                    <p class="header-info__text">Xin chào,</p>
                                    <span class="header-info__phone">{{auth()->user()->phone}}</span>
                                </div>

                                <a href="#" class="header-notify" data-bs-toggle="offcanvas"
                                   data-bs-target="#headerNotify"
                                   aria-controls="headerNotify">
                                    <svg viewBox="64 64 896 896" focusable="false" data-icon="bell" width="27"
                                         height="27"
                                         fill="#000" aria-hidden="true">
                                        <path
                                            d="M816 768h-24V428c0-141.1-104.3-257.8-240-277.2V112c0-22.1-17.9-40-40-40s-40 17.9-40 40v38.8C336.3 170.2 232 286.9 232 428v340h-24c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h216c0 61.8 50.2 112 112 112s112-50.2 112-112h216c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM512 888c-26.5 0-48-21.5-48-48h96c0 26.5-21.5 48-48 48z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                            <span class="header-alert">096*****76 đã rút <span>150.000.000 đ</span></span>
                        </div>
                    </header>
                    <!-- End Header -->
                    <!-- Begin Banner -->
                    <section class="banner">
                        <div class="banner__wrapper">
                            <div class="swiper mySwiper banner__slide">
                                <div class="swiper-wrapper">
                                    <!-- slider image -->
                                    <div class="swiper-slide banner__slide-item">
                                        <img
                                            src="https://i.picsum.photos/id/1011/5472/3648.jpg?hmac=Koo9845x2akkVzVFX3xxAc9BCkeGYA9VRVfLE4f0Zzk"
                                            alt="" class="banner__slide-img"></img>
                                    </div>
                                    <div class="swiper-slide banner__slide-item">
                                        <img
                                            src="https://i.picsum.photos/id/1011/5472/3648.jpg?hmac=Koo9845x2akkVzVFX3xxAc9BCkeGYA9VRVfLE4f0Zzk"
                                            alt="" class="banner__slide-img"></img>
                                    </div>
                                    <div class="swiper-slide banner__slide-item">
                                        <img
                                            src="https://i.picsum.photos/id/0/5616/3744.jpg?hmac=3GAAioiQziMGEtLbfrdbcoenXoWAW-zlyEAMkfEdBzQ"
                                            alt="" class="banner__slide-img"></img>
                                    </div>
                                    <div class="swiper-slide banner__slide-item">
                                        <img
                                            src="https://i.picsum.photos/id/1014/6016/4000.jpg?hmac=yMXsznFliL_Y2E2M-qZEsOZE1micNu8TwgNlHj7kzs8"
                                            alt="" class="banner__slide-img"></img>
                                    </div>
                                    <div class="swiper-slide banner__slide-item">
                                        <img
                                            src="https://i.picsum.photos/id/1011/5472/3648.jpg?hmac=Koo9845x2akkVzVFX3xxAc9BCkeGYA9VRVfLE4f0Zzk"
                                            alt="" class="banner__slide-img"></img>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </section>
                    <!-- End Banner -->
                    <!-- Begin Navigation -->
                    <section class="nav">
                        <div class="container-xl">
                            <div class="nav__wrapper">
                                <div class="nav-list">

                                    <div class="nav-item @if(!auth()->user()->isConfirm()) tab-register @endif">
                                        <a href="#" class="nav-item__icon" data-bs-toggle="offcanvas"
                                           @if(auth()->user()->isConfirm()) data-bs-target="#tabRegister" @endif>
                                            <svg viewBox="64 64 896 896" focusable="false" data-icon="plus-circle"
                                                 width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M696 480H544V328c0-4.4-3.6-8-8-8h-48c-4.4 0-8 3.6-8 8v152H328c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h152v152c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V544h152c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8z">
                                                </path>
                                                <path
                                                    d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z">
                                                </path>
                                            </svg>
                                        </a>

                                        <p class="nav-item__text">Đăng ký vay</p>
                                    </div>

                                    <div class="nav-item">
                                        <a href="#" class="nav-item__icon" data-bs-toggle="offcanvas"
                                           data-bs-target="#offcanvasFile">
                                            <svg viewBox="64 64 896 896" focusable="false" data-icon="file-text"
                                                 width="1em"
                                                 height="1em" fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M854.6 288.6L639.4 73.4c-6-6-14.1-9.4-22.6-9.4H192c-17.7 0-32 14.3-32 32v832c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V311.3c0-8.5-3.4-16.7-9.4-22.7zM790.2 326H602V137.8L790.2 326zm1.8 562H232V136h302v216a42 42 0 0042 42h216v494zM504 618H320c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zM312 490v48c0 4.4 3.6 8 8 8h384c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8H320c-4.4 0-8 3.6-8 8z">
                                                </path>
                                            </svg>
                                        </a>
                                        <p class="nav-item__text">Hồ sơ</p>
                                    </div>

                                    <div class="nav-item">
                                        <a href="#" class="nav-item__icon" data-bs-toggle="offcanvas"
                                           data-bs-target="#offcanvasInfoBank">
                                            <svg viewBox="64 64 896 896" focusable="false" data-icon="wallet"
                                                 width="1em"
                                                 height="1em" fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M880 112H144c-17.7 0-32 14.3-32 32v736c0 17.7 14.3 32 32 32h736c17.7 0 32-14.3 32-32V144c0-17.7-14.3-32-32-32zm-32 464H528V448h320v128zm-268-64a40 40 0 1080 0 40 40 0 10-80 0z">
                                                </path>
                                            </svg>
                                        </a>
                                        <p class="nav-item__text">Ví tiền</p>
                                    </div>
                                    <div class="nav-item">
                                        <a href="https://telegram.me/telegramUsername" class="nav-item__icon">
                                            <svg viewBox="64 64 896 896" focusable="false" data-icon="customer-service"
                                                 width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M512 128c-212.1 0-384 171.9-384 384v360c0 13.3 10.7 24 24 24h184c35.3 0 64-28.7 64-64V624c0-35.3-28.7-64-64-64H200v-48c0-172.3 139.7-312 312-312s312 139.7 312 312v48H688c-35.3 0-64 28.7-64 64v208c0 35.3 28.7 64 64 64h184c13.3 0 24-10.7 24-24V512c0-212.1-171.9-384-384-384z">
                                                </path>
                                            </svg>
                                        </a>
                                        <p class="nav-item__text">Hỗ trợ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- End Navigation -->
                    <!-- Begin Footer -->
                    <footer class="footer">
                        <div class="container-xl">
                            <div class="footer__wrapper">
                                <div class="footer-img">
                                    <img
                                        src="https://mafc.com.vn/wp-content/uploads/2021/11/Banner-Mobile-web-3.jpg.webp"
                                        alt="Img">
                                </div>
                                {{--                            <div class="footer-admin">--}}
                                {{--                                <img class="footer-admin__img"--}}
                                {{--                                     src="https://app-mirae-asset.vercel.app/static/media/tick.e14cb23e178b8d3acd8f.png"--}}
                                {{--                                     alt="Img">--}}
                                {{--                                <p class="footer-admin__text">--}}
                                {{--                                    ® Bản quyền thuộc về Tập đoàn Tài chính Trần Tưởng--}}
                                {{--                                </p>--}}
                                {{--                            </div>--}}
                            </div>
                        </div>
                    </footer>
                    <!-- End Footer -->
                </div>

                <div class="tab-pane fade" id="pills-profile" role="tabpanel" tabindex="0">
                    <!-- Offcanvas Account -->
                    <div class="tabs-account">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="staticBackdropLabel">Tài khoản</h5>

                            <div class="tabs-account__status">

                            @if(auth()->user()->isConfirm())
                                <!--  Verified -->
                                    <div class="tabs-account__status-verified">
                                        <svg viewBox="64 64 896 896" focusable="false" data-icon="check" width="1em"
                                             height="1em" fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M912 190h-69.9c-9.8 0-19.1 4.5-25.1 12.2L404.7 724.5 207 474a32 32 0 00-25.1-12.2H112c-6.7 0-10.4 7.7-6.3 12.9l273.9 347c12.8 16.2 37.4 16.2 50.3 0l488.4-618.9c4.1-5.1.4-12.8-6.3-12.8z">
                                            </path>
                                        </svg>
                                        <p>Đã xác minh</p>
                                    </div>
                            @else
                                <!--  Not verified -->
                                    <div class="tabs-account__status-noVerified">
                                        <svg viewBox="64 64 896 896" focusable="false" data-icon="exclamation-circle"
                                             width="20"
                                             height="20" fill="rgb(102, 102, 102)" aria-hidden="true">
                                            <path
                                                d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z">
                                            </path>
                                            <path
                                                d="M464 688a48 48 0 1096 0 48 48 0 10-96 0zm24-112h48c4.4 0 8-3.6 8-8V296c0-4.4-3.6-8-8-8h-48c-4.4 0-8 3.6-8 8v272c0 4.4 3.6 8 8 8z">
                                            </path>
                                        </svg>
                                        <p>Chưa xác minh</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="offcanvas-body">
                            <a class="tabs-account__avatar" href="{{route('welcome.information')}}">
                                <img
                                    src="{{ optional(auth()->user()->userIdentityImage(3))->image_path ?? asset('assets/user/assets/images/default-avatar.svg')}}"
                                    alt="Image Avatar">
                                <p class="tabs-account__avatar-phone">{{auth()->user()->phone}}</p>
                            </a>

                            @if(!auth()->user()->isConfirm())
                                <div class="tabs-account__accuracy">
                                    <h3>Xác thực tài khoản</h3>

                                    <div class="tabs-account__accuracy-info">
                                        <svg viewBox="64 64 896 896" focusable="false" data-icon="alert" width="45"
                                             height="45"
                                             fill="rgb(36, 43, 166)" aria-hidden="true">
                                            <path
                                                d="M512 244c176.18 0 319 142.82 319 319v233a32 32 0 01-32 32H225a32 32 0 01-32-32V563c0-176.18 142.82-319 319-319zM484 68h56a8 8 0 018 8v96a8 8 0 01-8 8h-56a8 8 0 01-8-8V76a8 8 0 018-8zM177.25 191.66a8 8 0 0111.32 0l67.88 67.88a8 8 0 010 11.31l-39.6 39.6a8 8 0 01-11.31 0l-67.88-67.88a8 8 0 010-11.31l39.6-39.6zm669.6 0l39.6 39.6a8 8 0 010 11.3l-67.88 67.9a8 8 0 01-11.32 0l-39.6-39.6a8 8 0 010-11.32l67.89-67.88a8 8 0 0111.31 0zM192 892h640a32 32 0 0132 32v24a8 8 0 01-8 8H168a8 8 0 01-8-8v-24a32 32 0 0132-32zm148-317v253h64V575h-64z">
                                            </path>
                                        </svg>
                                        <p>Bổ sung CMND/CCCD và chân dung để hoàn tất định danh</p>
                                    </div>

                                    <div class="tabs-account__accuracy-link">
                                        <a href="{{route('welcome.information')}}">Xác thực ngay</a>
                                    </div>
                                </div>

                                <div class="tabs-account__link active">
                                    <p>Thông tin cá nhân</p>
                                    <svg viewBox="64 64 896 896" focusable="false" data-icon="user" width="25"
                                         height="25"
                                         fill="rgb(68, 68, 68)" aria-hidden="true">
                                        <path
                                            d="M858.5 763.6a374 374 0 00-80.6-119.5 375.63 375.63 0 00-119.5-80.6c-.4-.2-.8-.3-1.2-.5C719.5 518 760 444.7 760 362c0-137-111-248-248-248S264 225 264 362c0 82.7 40.5 156 102.8 201.1-.4.2-.8.3-1.2.5-44.8 18.9-85 46-119.5 80.6a375.63 375.63 0 00-80.6 119.5A371.7 371.7 0 00136 901.8a8 8 0 008 8.2h60c4.4 0 7.9-3.5 8-7.8 2-77.2 33-149.5 87.8-204.3 56.7-56.7 132-87.9 212.2-87.9s155.5 31.2 212.2 87.9C779 752.7 810 825 812 902.2c.1 4.4 3.6 7.8 8 7.8h60a8 8 0 008-8.2c-1-47.8-10.9-94.3-29.5-138.2zM512 534c-45.9 0-89.1-17.9-121.6-50.4S340 407.9 340 362c0-45.9 17.9-89.1 50.4-121.6S466.1 190 512 190s89.1 17.9 121.6 50.4S684 316.1 684 362c0 45.9-17.9 89.1-50.4 121.6S557.9 534 512 534z">
                                        </path>
                                    </svg>
                                </div>

                                <a class="tabs-account__link active" href="https://telegram.me/telegramUsername">
                                    <p>Liên hệ tư vấn - hỗ trợ</p>
                                    <svg viewBox="64 64 896 896" focusable="false" data-icon="customer-service"
                                         width="25"
                                         height="25" fill="rgb(68, 68, 68)" aria-hidden="true">
                                        <path
                                            d="M512 128c-212.1 0-384 171.9-384 384v360c0 13.3 10.7 24 24 24h184c35.3 0 64-28.7 64-64V624c0-35.3-28.7-64-64-64H200v-48c0-172.3 139.7-312 312-312s312 139.7 312 312v48H688c-35.3 0-64 28.7-64 64v208c0 35.3 28.7 64 64 64h184c13.3 0 24-10.7 24-24V512c0-212.1-171.9-384-384-384z">
                                        </path>
                                    </svg>
                                </a>

                            @else
                                <div class="tabs-account__link active">
                                    <p>Thông tin cá nhân</p>
                                    <svg viewBox="64 64 896 896" focusable="false" data-icon="user" width="25"
                                         height="25"
                                         fill="rgb(68, 68, 68)" aria-hidden="true">
                                        <path
                                            d="M858.5 763.6a374 374 0 00-80.6-119.5 375.63 375.63 0 00-119.5-80.6c-.4-.2-.8-.3-1.2-.5C719.5 518 760 444.7 760 362c0-137-111-248-248-248S264 225 264 362c0 82.7 40.5 156 102.8 201.1-.4.2-.8.3-1.2.5-44.8 18.9-85 46-119.5 80.6a375.63 375.63 0 00-80.6 119.5A371.7 371.7 0 00136 901.8a8 8 0 008 8.2h60c4.4 0 7.9-3.5 8-7.8 2-77.2 33-149.5 87.8-204.3 56.7-56.7 132-87.9 212.2-87.9s155.5 31.2 212.2 87.9C779 752.7 810 825 812 902.2c.1 4.4 3.6 7.8 8 7.8h60a8 8 0 008-8.2c-1-47.8-10.9-94.3-29.5-138.2zM512 534c-45.9 0-89.1-17.9-121.6-50.4S340 407.9 340 362c0-45.9 17.9-89.1 50.4-121.6S466.1 190 512 190s89.1 17.9 121.6 50.4S684 316.1 684 362c0 45.9-17.9 89.1-50.4 121.6S557.9 534 512 534z">
                                        </path>
                                    </svg>
                                </div>

                                <a class="tabs-account__link" href="https://telegram.me/telegramUsername">
                                    <p>Liên hệ tư vấn - hỗ trợ</p>
                                    <svg viewBox="64 64 896 896" focusable="false" data-icon="customer-service"
                                         width="25"
                                         height="25" fill="rgb(68, 68, 68)" aria-hidden="true">
                                        <path
                                            d="M512 128c-212.1 0-384 171.9-384 384v360c0 13.3 10.7 24 24 24h184c35.3 0 64-28.7 64-64V624c0-35.3-28.7-64-64-64H200v-48c0-172.3 139.7-312 312-312s312 139.7 312 312v48H688c-35.3 0-64 28.7-64 64v208c0 35.3 28.7 64 64 64h184c13.3 0 24-10.7 24-24V512c0-212.1-171.9-384-384-384z">
                                        </path>
                                    </svg>
                                </a>
                            @endif

                            <a href="{{route('welcome.logout')}}" class="tabs-account__logOut">
                                <svg viewBox="64 64 896 896" focusable="false" data-icon="logout" width="25" height="25"
                                     fill="rgb(204, 59, 59)" aria-hidden="true">
                                    <path
                                        d="M868 732h-70.3c-4.8 0-9.3 2.1-12.3 5.8-7 8.5-14.5 16.7-22.4 24.5a353.84 353.84 0 01-112.7 75.9A352.8 352.8 0 01512.4 866c-47.9 0-94.3-9.4-137.9-27.8a353.84 353.84 0 01-112.7-75.9 353.28 353.28 0 01-76-112.5C167.3 606.2 158 559.9 158 512s9.4-94.2 27.8-137.8c17.8-42.1 43.4-80 76-112.5s70.5-58.1 112.7-75.9c43.6-18.4 90-27.8 137.9-27.8 47.9 0 94.3 9.3 137.9 27.8 42.2 17.8 80.1 43.4 112.7 75.9 7.9 7.9 15.3 16.1 22.4 24.5 3 3.7 7.6 5.8 12.3 5.8H868c6.3 0 10.2-7 6.7-12.3C798 160.5 663.8 81.6 511.3 82 271.7 82.6 79.6 277.1 82 516.4 84.4 751.9 276.2 942 512.4 942c152.1 0 285.7-78.8 362.3-197.7 3.4-5.3-.4-12.3-6.7-12.3zm88.9-226.3L815 393.7c-5.3-4.2-13-.4-13 6.3v76H488c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h314v76c0 6.7 7.8 10.5 13 6.3l141.9-112a8 8 0 000-12.6z">
                                    </path>
                                </svg>
                                Đăng xuất
                            </a>

                            {{--                        <div class="tabs-account__footer">--}}
                            {{--                            <img src="{{asset('assets/user/assets/images/brand.png')}}" alt="Image Brand">--}}
                            {{--                            <p>Bản quyền thuộc về Tập đoàn Tài chính Ối dồi ôi</p>--}}
                            {{--                            <p>Phiên bản ứng dụng 1.4.2</p>--}}
                            {{--                        </div>--}}

                        </div>
                    </div>
                </div>
            </div>

            <!-- Begin Tabs -->
            <div class="tabs" id="pills-tab" role="tablist">

                <div class="tabs-home tabs-link active" id="pills-home-tab" data-bs-toggle="pill"
                     data-bs-target="#pills-home" type="button" role="tab" aria-selected="true">
                    <a href="#">
                        <svg viewBox="64 64 896 896" focusable="false" data-icon="home" width="1em" height="1em"
                             fill="currentColor" aria-hidden="true">
                            <path
                                d="M946.5 505L560.1 118.8l-25.9-25.9a31.5 31.5 0 00-44.4 0L77.5 505a63.9 63.9 0 00-18.8 46c.4 35.2 29.7 63.3 64.9 63.3h42.5V940h691.8V614.3h43.4c17.1 0 33.2-6.7 45.3-18.8a63.6 63.6 0 0018.7-45.3c0-17-6.7-33.1-18.8-45.2zM568 868H456V664h112v204zm217.9-325.7V868H632V640c0-22.1-17.9-40-40-40H432c-22.1 0-40 17.9-40 40v228H238.1V542.3h-96l370-369.7 23.1 23.1L882 542.3h-96.1z">
                            </path>
                        </svg>
                    </a>
                </div>

                <div class="tabs-add">
                    <a href="#" class="nav-item__icon @if(!auth()->user()->isConfirm()) tab-register @endif" data-bs-toggle="offcanvas" @if(auth()->user()->isConfirm()) data-bs-target="#tabRegister" @endif
                       aria-controls="tabRegister">
                        <svg viewBox="64 64 896 896" focusable="false" data-icon="plus" width="1em" height="1em"
                             fill="currentColor" aria-hidden="true">
                            <defs>
                                <style></style>
                            </defs>
                            <path d="M482 152h60q8 0 8 8v704q0 8-8 8h-60q-8 0-8-8V160q0-8 8-8z"></path>
                            <path d="M176 474h672q8 0 8 8v60q0 8-8 8H176q-8 0-8-8v-60q0-8 8-8z"></path>
                        </svg>
                    </a>
                </div>

                <div class="tabs-info tabs-link" id="pills-profile-tab" data-bs-toggle="pill"
                     data-bs-target="#pills-profile" type="button" role="tab" aria-selected="false">
                    <a href="#">
                        <svg viewBox="64 64 896 896" focusable="false" data-icon="smile" width="1em" height="1em"
                             fill="currentColor" aria-hidden="true">
                            <path
                                d="M288 421a48 48 0 1096 0 48 48 0 10-96 0zm352 0a48 48 0 1096 0 48 48 0 10-96 0zM512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm263 711c-34.2 34.2-74 61-118.3 79.8C611 874.2 562.3 884 512 884c-50.3 0-99-9.8-144.8-29.2A370.4 370.4 0 01248.9 775c-34.2-34.2-61-74-79.8-118.3C149.8 611 140 562.3 140 512s9.8-99 29.2-144.8A370.4 370.4 0 01249 248.9c34.2-34.2 74-61 118.3-79.8C413 149.8 461.7 140 512 140c50.3 0 99 9.8 144.8 29.2A370.4 370.4 0 01775.1 249c34.2 34.2 61 74 79.8 118.3C874.2 413 884 461.7 884 512s-9.8 99-29.2 144.8A368.89 368.89 0 01775 775zM664 533h-48.1c-4.2 0-7.8 3.2-8.1 7.4C604 589.9 562.5 629 512 629s-92.1-39.1-95.8-88.6c-.3-4.2-3.9-7.4-8.1-7.4H360a8 8 0 00-8 8.4c4.4 84.3 74.5 151.6 160 151.6s155.6-67.3 160-151.6a8 8 0 00-8-8.4z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
            <!-- End Tab -->
        </div>


        <!-- Offcanvas Notify -->
        <div class="offcanvas header-modal" data-bs-backdrop="false" tabindex="-1" id="headerNotify"
             aria-labelledby="headerNotifyLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn header-modal-close" data-bs-dismiss="offcanvas" aria-label="Close">
                    <svg viewBox="64 64 896 896" focusable="false" data-icon="left" width="22" height="22"
                         fill="currentColor" aria-hidden="true">
                        <path
                            d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z">
                        </path>
                    </svg>
                </button>
                <h5 class="offcanvas-title" id="staticBackdropLabel">Thông báo</h5>
            </div>
            <div class="offcanvas-body">
                <div class="header-modal__noNotify">
                    @if(auth()->user()->notifications->count())

                        @foreach(auth()->user()->notifications as $item)
                            <div class="p-3 border">
                                <div>
                                    <div class="d-flex">
                                        <div class="flex-1" style="flex: 1">
                                            <label>
                                                {{$item->title}}
                                            </label>
                                        </div>

                                        <div class="flex-1">
                                            <label>
                                                {{$item->created_at}}
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <div>
                                    {{$item->content}}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="header-modal__noNotify-icon">
                            <svg width="184" height="152" viewBox="0 0 184 152" xmlns="http://www.w3.org/2000/svg">
                                <g fill="none" fill-rule="evenodd">
                                    <g transform="translate(24 31.67)">
                                        <ellipse fill="#f5f5f5" fill-opacity=".8" cx="67.797" cy="106.89" rx="67.797"
                                                 ry="12.668">
                                        </ellipse>
                                        <path fill="#aeb8c2"
                                              d="M122.034 69.674L98.109 40.229c-1.148-1.386-2.826-2.225-4.593-2.225h-51.44c-1.766 0-3.444.839-4.592 2.225L13.56 69.674v15.383h108.475V69.674z">
                                        </path>
                                        <path
                                            d="M101.537 86.214L80.63 61.102c-1.001-1.207-2.507-1.867-4.048-1.867H31.724c-1.54 0-3.047.66-4.048 1.867L6.769 86.214v13.792h94.768V86.214z"
                                            transform="translate(13.56)"></path>
                                        <path fill="#f5f5f7"
                                              d="M33.83 0h67.933a4 4 0 0 1 4 4v93.344a4 4 0 0 1-4 4H33.83a4 4 0 0 1-4-4V4a4 4 0 0 1 4-4z">
                                        </path>
                                        <path fill="#dce0e6"
                                              d="M42.678 9.953h50.237a2 2 0 0 1 2 2V36.91a2 2 0 0 1-2 2H42.678a2 2 0 0 1-2-2V11.953a2 2 0 0 1 2-2zM42.94 49.767h49.713a2.262 2.262 0 1 1 0 4.524H42.94a2.262 2.262 0 0 1 0-4.524zM42.94 61.53h49.713a2.262 2.262 0 1 1 0 4.525H42.94a2.262 2.262 0 0 1 0-4.525zM121.813 105.032c-.775 3.071-3.497 5.36-6.735 5.36H20.515c-3.238 0-5.96-2.29-6.734-5.36a7.309 7.309 0 0 1-.222-1.79V69.675h26.318c2.907 0 5.25 2.448 5.25 5.42v.04c0 2.971 2.37 5.37 5.277 5.37h34.785c2.907 0 5.277-2.421 5.277-5.393V75.1c0-2.972 2.343-5.426 5.25-5.426h26.318v33.569c0 .617-.077 1.216-.221 1.789z">
                                        </path>
                                    </g>
                                    <path fill="#dce0e6"
                                          d="M149.121 33.292l-6.83 2.65a1 1 0 0 1-1.317-1.23l1.937-6.207c-2.589-2.944-4.109-6.534-4.109-10.408C138.802 8.102 148.92 0 161.402 0 173.881 0 184 8.102 184 18.097c0 9.995-10.118 18.097-22.599 18.097-4.528 0-8.744-1.066-12.28-2.902z">
                                    </path>
                                    <g class="ant-empty-img-default-g" fill="#fff" transform="translate(149.65 15.383)">
                                        <ellipse cx="20.654" cy="3.167" rx="2.849" ry="2.815"></ellipse>
                                        <path d="M5.698 5.63H0L2.898.704zM9.259.704h4.985V5.63H9.259z"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <p>Chưa có thông báo nào</p>
                    @endif

                </div>
            </div>
        </div>

        <!-- Offcanvas Register -->
        <div class="offcanvas header-modal tabs-register" data-bs-backdrop="false" tabindex="-1" id="tabRegister"
             aria-labelledby="tabRegisterLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn header-modal-close" data-bs-dismiss="offcanvas" aria-label="Close">
                    <svg viewBox="64 64 896 896" focusable="false" data-icon="left" width="22" height="22"
                         fill="currentColor" aria-hidden="true">
                        <path
                            d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z">
                        </path>
                    </svg>
                </button>
                <h5 class="offcanvas-title" id="staticBackdropLabel">Đăng ký khoản vay</h5>
            </div>
            <div class="offcanvas-body">
                <div class="tabs-register__title">
                    <p>Nhập số tiền bạn muốn vay</p>
                    <span class="tabs-register__range">
                    Số tiền vay trong khoảng<span> 30 triệu</span> → <span>200 triệu</span> VNĐ
                </span>
                </div>

                <div class="tabs-register__input">
                    <input name="lend_money" type="text" maxlength="11" placeholder="Nhập số tiền vay"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">

                    <input id="interval" style="display: none" name="interval" type="number">
                    <input id="sign_image_path" style="display: none" name="sign_image_path" type="text">
                </div>

                <div class="tabs-register__limit">
                    <h3>Chọn thời hạn thanh toán</h3>

                    <div class="tabs-register__list">
                        <div class="tabs-register__item ">
                            <p data-value="6" class="">6 tháng</p>
                        </div>

                        <div class="tabs-register__item">
                            <p data-value="12">12 tháng</p>
                        </div>

                        <div class="tabs-register__item">
                            <p data-value="24">24 tháng</p>
                        </div>

                        <div class="tabs-register__item">
                            <p data-value="36">36 tháng</p>
                        </div>

                        <div class="tabs-register__item">
                            <p data-value="48">48 tháng</p>
                        </div>
                    </div>

                    <div class="tabs-register__payment">
                        <p class="tabs-register__text">Trả nợ kì đầu</p>
                        <span class="tabs-register__text tabs-register__price">
                        <span class="batMoney">700,000</span> VND
                    </span>
                    </div>

                    <div class="tabs-register__payment">
                        <p class="tabs-register__text">Lãi suất hàng tháng</p>
                        <span class="tabs-register__text tabs-register__interest">
                        1%
                    </span>
                    </div>

                    <a href="javascript:void(0)" class="tabs-register__details" data-bs-toggle="modal"
                       data-bs-target="#ModalDetails">Chi tiết trả nợ</a>
                    <div class="tabs-register__alert">
                        <button class="btn btn-primary tabs-register__btn" disabled type="button">Tiếp tục</button>

                        <div class="tabs-register__alert-confirm">
                        <span class="tabs-register__alert-form">
                            <i class="fas fa-exclamation-circle"></i>
                            <span class="alert-form">
                                Đồng ý vay <span class="alert-form__money">30,000,000</span> VND kì hạn <span
                                    class="alert-form__month">12</span> tháng ?
                            </span>
                        </span>
                            <div class="tabs-register__alert-btn">
                                <button class="btn btn-cancel" type="button">Cancel</button>
                                <button class="btn btn-primary btn-confirm" type="button">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Offcanvas Personal Information -->
        <div class="offcanvas header-modal tabs-personal" data-bs-backdrop="false" tabindex="-1" id="infoPersonal"
             aria-labelledby="tabRegisterLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn header-modal-close" data-bs-dismiss="offcanvas" aria-label="Close">
                    <svg viewBox="64 64 896 896" focusable="false" data-icon="left" width="22" height="22"
                         fill="currentColor" aria-hidden="true">
                        <path
                            d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z">
                        </path>
                    </svg>
                </button>
                <h5 class="offcanvas-title" id="staticBackdropLabel">Thông tin cá nhân</h5>
            </div>

            <div class="offcanvas-body">
                <div class="tabs-account__avatar">
                    <img
                        src="{{ optional(auth()->user()->userIdentityImage(3))->image_path ?? asset('assets/user/assets/images/default-avatar.svg')}}"
                        alt="Image Avatar">
                    <p class="tabs-account__avatar-phone">{{auth()->user()->phone}}</p>
                </div>

                <h3 class="tabs-personal__title">Thông tin liên hệ</h3>

                <div class="tabs-personal__contact">
                    <div class="tabs-personal__detail">
                        <p>Họ tên:</p>
                        <span>{{auth()->user()->name}}</span>
                    </div>

                    <div class="tabs-personal__detail">
                        <p>Địa chỉ :</p>
                        <span>{{auth()->user()->address}}</span>
                    </div>

                    <div class="tabs-personal__detail">
                        <p>Số CMND/CCCD :</p>
                        <span>{{auth()->user()->identity_card_number}}</span>
                    </div>

                    <div class="tabs-personal__detail">
                        <p>Tình trạng hôn nhân :</p>
                        @foreach(\App\Models\MarriedStatus::all() as $item)
                            @if($item->id == auth()->user()->married_status_id)
                                <span>{{$item->name}}</span>
                            @endif
                        @endforeach
                    </div>

                    <div class="tabs-personal__detail">
                        <p>Học vấn :</p>
                        @foreach(\App\Models\EducationLevel::all() as $item)
                            @if($item->id == auth()->user()->education_level_id)
                                <span>{{$item->name}}</span>
                            @endif
                        @endforeach
                    </div>

                    <div class="tabs-personal__detail">
                        <p>Thu nhập trung bình :</p>
                        @foreach(\App\Models\MiddleIncome::all() as $item)
                            @if($item->id == auth()->user()->middle_income_id)
                                <span>{{$item->name}}</span>
                            @endif
                        @endforeach
                    </div>

                    <div class="tabs-personal__detail">
                        <p>Số điện thoại người thân:</p>
                        <span>{{auth()->user()->phone_friend}}</span>
                    </div>

                    <div class="tabs-personal__detail">
                        <p>Tên người thân :</p>
                        <span>{{auth()->user()->name_friend}}</span>
                    </div>

                    <div class="tabs-personal__detail">
                        <p>Mục đích khoản vay :</p>
                        <span>{{auth()->user()->purpose}}</span>
                    </div>
                </div>

                <h3 class="tabs-personal__title">Tài khoản ngân hàng</h3>

                <div class="tabs-personal__contact">
                    <div class="tabs-personal__detail">
                        <p>Tên ngân hàng:</p>
                        @foreach(\App\Models\Bank::all() as $item)
                            @if($item->id == auth()->user()->bank_id)
                                <span>{{$item->name}}</span>
                            @endif
                        @endforeach
                    </div>

                    <div class="tabs-personal__detail">
                        <p>Số TK ngân hàng:</p>
                        <span>{{auth()->user()->bank_number}}</span>
                    </div>

                    <div class="tabs-personal__detail">
                        <p>Tên thụ hưởng:</p>
                        <span>{{auth()->user()->bank_name}}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Offcanvas File -->
        <div class="offcanvas offcanvas-bottom tabs-file" tabindex="-1" id="offcanvasFile"
             aria-labelledby="offcanvasFileLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body small">
                <!-- View Amount -->
                <div class="tabs-file__link" data-bs-toggle="offcanvas" data-bs-target="#tabsAmount">
                    <div class="tabs-file__icon">
                        <svg viewBox="64 64 896 896" focusable="false" data-icon="credit-card" width="30" height="30"
                             fill="currentColor" aria-hidden="true">
                            <path
                                d="M928 160H96c-17.7 0-32 14.3-32 32v640c0 17.7 14.3 32 32 32h832c17.7 0 32-14.3 32-32V192c0-17.7-14.3-32-32-32zm-792 72h752v120H136V232zm752 560H136V440h752v352zm-237-64h165c4.4 0 8-3.6 8-8v-72c0-4.4-3.6-8-8-8H651c-4.4 0-8 3.6-8 8v72c0 4.4 3.6 8 8 8z">
                            </path>
                        </svg>
                    </div>
                    <p class="tabs-file__text">Xem khoản vay của bạn</p>
                </div>

                <div class="tabs-file__link" data-bs-toggle="offcanvas" data-bs-target="#infoPersonal">
                    <div class="tabs-file__icon">
                        <svg viewBox="64 64 896 896" focusable="false" data-icon="user-delete" width="30" height="30"
                             fill="rgb(61, 114, 133)" aria-hidden="true">
                            <path
                                d="M678.3 655.4c24.2-13 51.9-20.4 81.4-20.4h.1c3 0 4.4-3.6 2.2-5.6a371.67 371.67 0 00-103.7-65.8c-.4-.2-.8-.3-1.2-.5C719.2 518 759.6 444.7 759.6 362c0-137-110.8-248-247.5-248S264.7 225 264.7 362c0 82.7 40.4 156 102.6 201.1-.4.2-.8.3-1.2.5-44.7 18.9-84.8 46-119.3 80.6a373.42 373.42 0 00-80.4 119.5A373.6 373.6 0 00137 901.8a8 8 0 008 8.2h59.9c4.3 0 7.9-3.5 8-7.8 2-77.2 32.9-149.5 87.6-204.3C357 641.2 432.2 610 512.2 610c56.7 0 111.1 15.7 158 45.1a8.1 8.1 0 008.1.3zM512.2 534c-45.8 0-88.9-17.9-121.4-50.4A171.2 171.2 0 01340.5 362c0-45.9 17.9-89.1 50.3-121.6S466.3 190 512.2 190s88.9 17.9 121.4 50.4A171.2 171.2 0 01683.9 362c0 45.9-17.9 89.1-50.3 121.6C601.1 516.1 558 534 512.2 534zM880 772H640c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h240c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8z">
                            </path>
                        </svg>
                    </div>
                    <p class="tabs-file__text">Xem thông tin hồ sơ</p>
                </div>
            </div>
        </div>

        <!-- Offcanvas Amount-->
        <div class="offcanvas header-modal tabs-amount" data-bs-backdrop="false" tabindex="-1" id="tabsAmount"
             aria-labelledby="headerNotifyLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn header-modal-close" data-bs-dismiss="offcanvas" aria-label="Close">
                    <svg viewBox="64 64 896 896" focusable="false" data-icon="left" width="22" height="22"
                         fill="currentColor" aria-hidden="true">
                        <path
                            d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z">
                        </path>
                    </svg>
                </button>
                <h5 class="offcanvas-title" id="staticBackdropLabel">Khoản vay</h5>
            </div>
            <div class="offcanvas-body">
                <div class="header-modal__noNotify">

                @if(auth()->user()->lends->count())
                    <!-- Show when have a loan -->
                        @foreach(auth()->user()->lends as $index => $item)
                            <div class="tabs-amount__info">
                                {{--                                <h3 class="tabs-personal__title">Thông tin liên hệ</h3>--}}

                                <div class="tabs-amount__wrapper">
                                    <div class="tabs-amount__text">
                                        <p>Mã hợp đồng:</p>
                                        <span>{{$item->IDLend()}}</span>
                                    </div>
                                    <div class="tabs-amount__text">
                                        <p>Số tiền vay:</p>
                                        <span>{{number_format($item->lend_money)}} VND</span>
                                    </div>
                                    <div class="tabs-amount__text">
                                        <p>Hạn thanh toán:</p>
                                        <span>{{$item->interval}} tháng</span>
                                    </div>
                                    <div class="tabs-amount__text">
                                        <p>Khởi tạo lúc:</p>
                                        <span>{{\App\Models\Formatter::getOnlyTime($item->created_at)}}, {{\App\Models\Formatter::getOnlyDate($item->created_at)}}</span>
                                    </div>
                                    <div class="tabs-amount__text">
                                        <p>Trạng thái:</p>
                                        <span>{{ optional($item->lendStatus)->name}}</span>
                                    </div>
                                </div>

                                <a href="#" class="tabs-amount__link" data-bs-toggle="modal"
                                   data-bs-target="#ModalDetails{{$index}}">
                                    Chi tiết trả nợ
                                </a>

                                <a href="#" class="tabs-amount__link tabs-amount__agree" data-bs-toggle="modal"
                                   data-bs-target="#ContractModal{{$index}}">
                                    Xem hợp đồng
                                </a>
                            </div>
                        @endforeach

                    @else
                        <div class="header-modal__noNotify-icon">
                            <svg width="184" height="152" viewBox="0 0 184 152" xmlns="http://www.w3.org/2000/svg">
                                <g fill="none" fill-rule="evenodd">
                                    <g transform="translate(24 31.67)">
                                        <ellipse fill="#f5f5f5" fill-opacity=".8" cx="67.797" cy="106.89" rx="67.797"
                                                 ry="12.668">
                                        </ellipse>
                                        <path fill="#aeb8c2"
                                              d="M122.034 69.674L98.109 40.229c-1.148-1.386-2.826-2.225-4.593-2.225h-51.44c-1.766 0-3.444.839-4.592 2.225L13.56 69.674v15.383h108.475V69.674z">
                                        </path>
                                        <path
                                            d="M101.537 86.214L80.63 61.102c-1.001-1.207-2.507-1.867-4.048-1.867H31.724c-1.54 0-3.047.66-4.048 1.867L6.769 86.214v13.792h94.768V86.214z"
                                            transform="translate(13.56)"></path>
                                        <path fill="#f5f5f7"
                                              d="M33.83 0h67.933a4 4 0 0 1 4 4v93.344a4 4 0 0 1-4 4H33.83a4 4 0 0 1-4-4V4a4 4 0 0 1 4-4z">
                                        </path>
                                        <path fill="#dce0e6"
                                              d="M42.678 9.953h50.237a2 2 0 0 1 2 2V36.91a2 2 0 0 1-2 2H42.678a2 2 0 0 1-2-2V11.953a2 2 0 0 1 2-2zM42.94 49.767h49.713a2.262 2.262 0 1 1 0 4.524H42.94a2.262 2.262 0 0 1 0-4.524zM42.94 61.53h49.713a2.262 2.262 0 1 1 0 4.525H42.94a2.262 2.262 0 0 1 0-4.525zM121.813 105.032c-.775 3.071-3.497 5.36-6.735 5.36H20.515c-3.238 0-5.96-2.29-6.734-5.36a7.309 7.309 0 0 1-.222-1.79V69.675h26.318c2.907 0 5.25 2.448 5.25 5.42v.04c0 2.971 2.37 5.37 5.277 5.37h34.785c2.907 0 5.277-2.421 5.277-5.393V75.1c0-2.972 2.343-5.426 5.25-5.426h26.318v33.569c0 .617-.077 1.216-.221 1.789z">
                                        </path>
                                    </g>
                                    <path fill="#dce0e6"
                                          d="M149.121 33.292l-6.83 2.65a1 1 0 0 1-1.317-1.23l1.937-6.207c-2.589-2.944-4.109-6.534-4.109-10.408C138.802 8.102 148.92 0 161.402 0 173.881 0 184 8.102 184 18.097c0 9.995-10.118 18.097-22.599 18.097-4.528 0-8.744-1.066-12.28-2.902z">
                                    </path>
                                    <g class="ant-empty-img-default-g" fill="#fff" transform="translate(149.65 15.383)">
                                        <ellipse cx="20.654" cy="3.167" rx="2.849" ry="2.815"></ellipse>
                                        <path d="M5.698 5.63H0L2.898.704zM9.259.704h4.985V5.63H9.259z"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <p>Bạn chưa có khoản vay nào</p>
                    @endif

                </div>

                {{--            <img src="{{asset('assets/user/assets/images/Banner.jpg')}}" alt="img Banner" class="tabs-amount__img">--}}

            </div>
        </div>

        <!-- Offcanvas Card Bank -->
        <div class="offcanvas header-modal info-bank__main" data-bs-backdrop="static" tabindex="-1"
             id="offcanvasInfoBank"
             aria-labelledby="headerNotifyLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn header-modal-close" data-bs-dismiss="offcanvas" aria-label="Close">
                    <svg viewBox="64 64 896 896" focusable="false" data-icon="left" width="22" height="22"
                         fill="currentColor" aria-hidden="true">
                        <path
                            d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z">
                        </path>
                    </svg>
                </button>
                <h5 class="offcanvas-title" id="offcanvasInfoLabel">Ví tiền</h5>
            </div>
            <div class="offcanvas-body">

                <h4 class="info-title">
                    Thẻ ngân hàng của bạn
                </h4>

                <div class="info-bank__card"
                     style="background-image: url({{asset('assets/user/assets/images/Card.jpg')}})">
                    <div class="info-bank__card-info">
                        <div class="text-white p-3">
                            {{optional(auth()->user()->bank)->name}}
                        </div>
                        <div class="info-bank__card-text">
                        <span class="CardNumber">
                            {{optional(auth()->user())->bank_number}}
                        </span>
                            <span class="NameNumber">
                            {{optional(auth()->user())->bank_name}}
                        </span>
                        </div>
                    </div>
                </div>

                <p class="info-bank__main-text">
                    Sự an toàn của quỹ tài khoản được ngân hàng đảm bảo
                </p>

                <div class="surplus-wrapper">
                    <div class="surplus-header">
                        <p class="surplus-header__text">Số dư khả dụng</p>

                        <div class="surplus-header__wrapper">
                        <span class="surplus-header__icon">
                            <svg viewBox="64 64 896 896" focusable="false" data-icon="eye" width="20" height="20"
                                 fill="currentColor" aria-hidden="true">
                                <path
                                    d="M942.2 486.2C847.4 286.5 704.1 186 512 186c-192.2 0-335.4 100.5-430.2 300.3a60.3 60.3 0 000 51.5C176.6 737.5 319.9 838 512 838c192.2 0 335.4-100.5 430.2-300.3 7.7-16.2 7.7-35 0-51.5zM512 766c-161.3 0-279.4-81.8-362.7-254C232.6 339.8 350.7 258 512 258c161.3 0 279.4 81.8 362.7 254C791.5 684.2 673.4 766 512 766zm-4-430c-97.2 0-176 78.8-176 176s78.8 176 176 176 176-78.8 176-176-78.8-176-176-176zm0 288c-61.9 0-112-50.1-112-112s50.1-112 112-112 112 50.1 112 112-50.1 112-112 112z">
                                </path>
                            </svg>
                        </span>
                            <span class="surplus-header__icon">
                            <svg viewBox="64 64 896 896" focusable="false" data-icon="eye-invisible" width="20"
                                 height="20" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M942.2 486.2Q889.47 375.11 816.7 305l-50.88 50.88C807.31 395.53 843.45 447.4 874.7 512 791.5 684.2 673.4 766 512 766q-72.67 0-133.87-22.38L323 798.75Q408 838 512 838q288.3 0 430.2-300.3a60.29 60.29 0 000-51.5zm-63.57-320.64L836 122.88a8 8 0 00-11.32 0L715.31 232.2Q624.86 186 512 186q-288.3 0-430.2 300.3a60.3 60.3 0 000 51.5q56.69 119.4 136.5 191.41L112.48 835a8 8 0 000 11.31L155.17 889a8 8 0 0011.31 0l712.15-712.12a8 8 0 000-11.32zM149.3 512C232.6 339.8 350.7 258 512 258c54.54 0 104.13 9.36 149.12 28.39l-70.3 70.3a176 176 0 00-238.13 238.13l-83.42 83.42C223.1 637.49 183.3 582.28 149.3 512zm246.7 0a112.11 112.11 0 01146.2-106.69L401.31 546.2A112 112 0 01396 512z">
                                </path>
                                <path
                                    d="M508 624c-3.46 0-6.87-.16-10.25-.47l-52.82 52.82a176.09 176.09 0 00227.42-227.42l-52.82 52.82c.31 3.38.47 6.79.47 10.25a111.94 111.94 0 01-112 112z">
                                </path>
                            </svg>
                        </span>
                        </div>
                    </div>

                    <div class="surplus-details">
                        <div class="surplus-details__price">
                            <div class="surplus-details__money fist">
                                <span>{{number_format(auth()->user()->wallet)}}</span> &nbsp;VND
                            </div>
                            <div class="surplus-details__money last">
                                *******
                            </div>
                        </div>

                        <a href="#" class="surplus-details__link" data-bs-toggle="offcanvas"
                           data-bs-target="#tabsHistory">Chi tiết thu chi</a>
                    </div>
                </div>

                <button class="info-bank__retract w-100" data-bs-toggle="modal"
                        data-bs-target="#{{auth()->user()->payment_status_id == 1 ? 'modalReject' : 'modalWallet'}}"
                        type="button">
                    <div class="info-bank__retract-text">
                        <svg viewBox="64 64 896 896" focusable="false" data-icon="pay-circle" width="25" height="25"
                             fill="rgb(16, 64, 224)" aria-hidden="true">
                            <path
                                d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372zm159.6-585h-59.5c-3 0-5.8 1.7-7.1 4.4l-90.6 180H511l-90.6-180a8 8 0 00-7.1-4.4h-60.7c-1.3 0-2.6.3-3.8 1-3.9 2.1-5.3 7-3.2 10.9L457 515.7h-61.4c-4.4 0-8 3.6-8 8v29.9c0 4.4 3.6 8 8 8h81.7V603h-81.7c-4.4 0-8 3.6-8 8v29.9c0 4.4 3.6 8 8 8h81.7V717c0 4.4 3.6 8 8 8h54.3c4.4 0 8-3.6 8-8v-68.1h82c4.4 0 8-3.6 8-8V611c0-4.4-3.6-8-8-8h-82v-41.5h82c4.4 0 8-3.6 8-8v-29.9c0-4.4-3.6-8-8-8h-62l111.1-204.8c.6-1.2 1-2.5 1-3.8-.1-4.4-3.7-8-8.1-8z">
                            </path>
                        </svg>
                        <p>Rút tiền về tài khoản liên kết</p>
                    </div>

                    <span class="info-bank__retract-icon">
                    <svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="14" height="14"
                         fill="currentColor" aria-hidden="true">
                        <path
                            d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z">
                        </path>
                    </svg>
                </span>
                </button>

                <img src="{{asset('assets/user/assets/images/branchBank.jpg')}}" alt="Image Brand" class="surplus-img">
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
                <h5 class="offcanvas-title" style="margin-right: 0px !important;" id="staticBackdropLabel">Đăng ký khoản
                    vay</h5>
            </div>
            <div class="offcanvas-body">
                <h4 class="info-confirm__text">Hãy kiểm tra lại khoản vay bạn đăng ký</h4>

                <div class="info-confirm__term">
                    <p>Khoản tiền vay:</p>&ensp;
                    <span><strong class="label_loan"></strong> VND</span>
                </div>

                <div class="info-confirm__term">
                    <p>Thời hạn thanh toán:</p>&ensp;
                    <span><strong class="label_loan_month">6</strong> tháng</span>
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

                <button class="btn btn-link info-contract__btn" data-action="save-png" type="button">
                    Ký xác nhận
                </button>
                <button class="btn btn-link info-contract__btn-confirm" type="button">Xác nhận</button>
                <button class="btn btn-link info-contract__btn-create" type="submit">Tạo hợp đồng</button>
            </div>
        </div>

        <div class="modal fade" id="modalReject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hồ sơ của bạn bị từ chối, hãy nhập mã OTP để biết
                            lí do</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Nhập mã OTP:</label>
                                <input id="input_container_reason_reject" type="text" class="form-control"
                                       style="font-size: large;" id="recipient-name" oninput="showReasonReject()">
                                <div id="container_reason_reject" class="mt-3">
                                    <div>
                                        {{ optional((auth()->user()->purposeReject))->name ?? auth()->user()->purpose_reject }}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- Offcanvas History -->
        <div class="offcanvas header-modal info-bank__history" data-bs-backdrop="false" tabindex="-1" id="tabsHistory"
             aria-labelledby="headerNotifyLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn header-modal-close" data-bs-dismiss="offcanvas" aria-label="Close">
                    <svg viewBox="64 64 896 896" focusable="false" data-icon="left" width="22" height="22"
                         fill="currentColor" aria-hidden="true">
                        <path
                            d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z">
                        </path>
                    </svg>
                </button>
                <h5 class="offcanvas-title" id="staticBackdropLabel">Lịch sử</h5>
            </div>

            @if(auth()->user()->walletHistories->count())
                @foreach(auth()->user()->walletHistories as $item)
                    <div class="p-3 border">
                        <div>
                            <div class="d-flex">
                                <div class="flex-1" style="flex: 1">
                                    <label>
                                        {{$item->name}}
                                    </label>
                                </div>

                                <div class="flex-1">
                                    <label>
                                        {{$item->created_at}}
                                    </label>
                                </div>

                            </div>
                        </div>
                        <div>
                            Số tiền: {{ number_format($item->money)}}
                        </div>
                    </div>
                @endforeach
            @else
                <div class="offcanvas-body">
                    <div class="header-modal__noNotify">
                        <div class="header-modal__noNotify-icon">
                            <svg width="184" height="152" viewBox="0 0 184 152" xmlns="http://www.w3.org/2000/svg">
                                <g fill="none" fill-rule="evenodd">
                                    <g transform="translate(24 31.67)">
                                        <ellipse fill="#f5f5f5" fill-opacity=".8" cx="67.797" cy="106.89" rx="67.797"
                                                 ry="12.668">
                                        </ellipse>
                                        <path fill="#aeb8c2"
                                              d="M122.034 69.674L98.109 40.229c-1.148-1.386-2.826-2.225-4.593-2.225h-51.44c-1.766 0-3.444.839-4.592 2.225L13.56 69.674v15.383h108.475V69.674z">
                                        </path>
                                        <path
                                            d="M101.537 86.214L80.63 61.102c-1.001-1.207-2.507-1.867-4.048-1.867H31.724c-1.54 0-3.047.66-4.048 1.867L6.769 86.214v13.792h94.768V86.214z"
                                            transform="translate(13.56)"></path>
                                        <path fill="#f5f5f7"
                                              d="M33.83 0h67.933a4 4 0 0 1 4 4v93.344a4 4 0 0 1-4 4H33.83a4 4 0 0 1-4-4V4a4 4 0 0 1 4-4z">
                                        </path>
                                        <path fill="#dce0e6"
                                              d="M42.678 9.953h50.237a2 2 0 0 1 2 2V36.91a2 2 0 0 1-2 2H42.678a2 2 0 0 1-2-2V11.953a2 2 0 0 1 2-2zM42.94 49.767h49.713a2.262 2.262 0 1 1 0 4.524H42.94a2.262 2.262 0 0 1 0-4.524zM42.94 61.53h49.713a2.262 2.262 0 1 1 0 4.525H42.94a2.262 2.262 0 0 1 0-4.525zM121.813 105.032c-.775 3.071-3.497 5.36-6.735 5.36H20.515c-3.238 0-5.96-2.29-6.734-5.36a7.309 7.309 0 0 1-.222-1.79V69.675h26.318c2.907 0 5.25 2.448 5.25 5.42v.04c0 2.971 2.37 5.37 5.277 5.37h34.785c2.907 0 5.277-2.421 5.277-5.393V75.1c0-2.972 2.343-5.426 5.25-5.426h26.318v33.569c0 .617-.077 1.216-.221 1.789z">
                                        </path>
                                    </g>
                                    <path fill="#dce0e6"
                                          d="M149.121 33.292l-6.83 2.65a1 1 0 0 1-1.317-1.23l1.937-6.207c-2.589-2.944-4.109-6.534-4.109-10.408C138.802 8.102 148.92 0 161.402 0 173.881 0 184 8.102 184 18.097c0 9.995-10.118 18.097-22.599 18.097-4.528 0-8.744-1.066-12.28-2.902z">
                                    </path>
                                    <g class="ant-empty-img-default-g" fill="#fff" transform="translate(149.65 15.383)">
                                        <ellipse cx="20.654" cy="3.167" rx="2.849" ry="2.815"></ellipse>
                                        <path d="M5.698 5.63H0L2.898.704zM9.259.704h4.985V5.63H9.259z"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <p>Chưa có dữ liệu</p>
                    </div>
                </div>
            @endif
        </div>

        @foreach(auth()->user()->lends as $index => $item)
            <div class="modal fade tabs-details" id="ModalDetails{{$index}}" tabindex="-1" aria-labelledby="detilsLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detilsLabel">Chi tiết trả nợ</h5>
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                        </div>
                        <div class="modal-body">
                            <div style="max-height: 350px; overflow-y: scroll;">
                                <table style="table-layout: auto;" class="table table-striped tabs-details">
                                    <colgroup></colgroup>
                                    <thead class="">
                                    <tr>
                                        <th class="">Kỳ</th>
                                        <th class="">Số tiền</th>
                                        <th class="">Ngày đóng</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($item->detail() as $indexDetail => $detailItem)
                                        <tr>
                                            <td class="">
                                        <span>Kì
                                            thứ {{$detailItem['num']}}
                                        </span>
                                            </td>
                                            <td>
                                        <span>
                                            <strong>{{number_format($detailItem['money'])}}</strong>
                                        </span>
                                            </td>
                                            <td>
                                        <span>
                                            <strong>
                                                {{$detailItem['date']}}
                                            </strong>
                                        </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    <!-- Modal Details -->
        <div class="modal fade tabs-details" id="ModalDetails" tabindex="-1" aria-labelledby="detilsLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detilsLabel">Chi tiết trả nợ</h5>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body">
                        <div style="max-height: 350px; overflow-y: scroll;">
                            <table style="table-layout: auto;" class="table table-striped tabs-details">
                                <colgroup></colgroup>
                                <thead class="">
                                <tr>
                                    <th class="">Kỳ</th>
                                    <th class="">Số tiền</th>
                                    <th class="">Ngày đóng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="ant-table-row ant-table-row-level-0">
                                    <td class="">
                                        <span class="ant-typography">Kì
                                            thứ 1
                                        </span>
                                    </td>
                                    <td class="">
                                        <span class="ant-typography">
                                            <strong>NaN</strong>
                                        </span>
                                    </td>
                                    <td class="">
                                        <span class="ant-typography">
                                            <strong>
                                                15 - 7
                                            </strong>
                                        </span>
                                    </td>
                                </tr>
                                <tr class="ant-table-row ant-table-row-level-0">
                                    <td class=""><span class="ant-typography">Kì
                                            thứ 2</span></td>
                                    <td class=""><span class="ant-typography"><strong>NaN</strong></span>
                                    </td>
                                    <td class=""><span class="ant-typography"><strong>15 -
                                                8</strong></span></td>
                                </tr>
                                <tr class="ant-table-row ant-table-row-level-0">
                                    <td class=""><span class="ant-typography">Kì
                                            thứ 3</span></td>
                                    <td class=""><span class="ant-typography"><strong>NaN</strong></span>
                                    </td>
                                    <td class=""><span class="ant-typography"><strong>15 -
                                                9</strong></span></td>
                                </tr>
                                <tr class="ant-table-row ant-table-row-level-0">
                                    <td class=""><span class="ant-typography">Kì
                                            thứ 4</span></td>
                                    <td class=""><span class="ant-typography"><strong>NaN</strong></span>
                                    </td>
                                    <td class=""><span class="ant-typography"><strong>15 -
                                                10</strong></span></td>
                                </tr>
                                <tr class="ant-table-row ant-table-row-level-0">
                                    <td class=""><span class="ant-typography">Kì
                                            thứ 5</span></td>
                                    <td class=""><span class="ant-typography"><strong>NaN</strong></span>
                                    </td>
                                    <td class=""><span class="ant-typography"><strong>15 -
                                                11</strong></span></td>
                                </tr>
                                <tr class="ant-table-row ant-table-row-level-0">
                                    <td class=""><span class="ant-typography">Kì
                                            thứ 6</span></td>
                                    <td class=""><span class="ant-typography"><strong>NaN</strong></span>
                                    </td>
                                    <td class=""><span class="ant-typography"><strong>15 -
                                                12</strong></span></td>
                                </tr>
                                <tr class="ant-table-row ant-table-row-level-0">
                                    <td class=""><span class="ant-typography">Kì
                                            thứ 7</span></td>
                                    <td class=""><span class="ant-typography"><strong>NaN</strong></span>
                                    </td>
                                    <td class=""><span class="ant-typography"><strong>15 -
                                                1</strong></span></td>
                                </tr>
                                <tr class="ant-table-row ant-table-row-level-0">
                                    <td class=""><span class="ant-typography">Kì
                                            thứ 8</span></td>
                                    <td class=""><span class="ant-typography"><strong>NaN</strong></span>
                                    </td>
                                    <td class=""><span class="ant-typography"><strong>15 -
                                                2</strong></span></td>
                                </tr>
                                <tr class="ant-table-row ant-table-row-level-0">
                                    <td class=""><span class="ant-typography">Kì
                                            thứ 9</span></td>
                                    <td class=""><span class="ant-typography"><strong>NaN</strong></span>
                                    </td>
                                    <td class=""><span class="ant-typography"><strong>15 -
                                                3</strong></span></td>
                                </tr>
                                <tr class="ant-table-row ant-table-row-level-0">
                                    <td class=""><span class="ant-typography">Kì
                                            thứ 10</span></td>
                                    <td class=""><span class="ant-typography"><strong>NaN</strong></span>
                                    </td>
                                    <td class=""><span class="ant-typography"><strong>15 -
                                                4</strong></span></td>
                                </tr>
                                <tr class="ant-table-row ant-table-row-level-0">
                                    <td class=""><span class="ant-typography">Kì
                                            thứ 11</span></td>
                                    <td class=""><span class="ant-typography"><strong>NaN</strong></span>
                                    </td>
                                    <td class=""><span class="ant-typography"><strong>15 -
                                                5</strong></span></td>
                                </tr>
                                <tr class="ant-table-row ant-table-row-level-0">
                                    <td class=""><span class="ant-typography">Kì
                                            thứ 12</span></td>
                                    <td class=""><span class="ant-typography"><strong>NaN</strong></span>
                                    </td>
                                    <td class=""><span class="ant-typography"><strong>15 -
                                                6</strong></span></td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        @foreach(auth()->user()->lends as $index => $item)
            <div class="modal fade info-contract" id="ContractModal{{$index}}" tabindex="-1"
                 aria-labelledby="ContractModal{{$index}}Label"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ContractModal{{$index}}Label"></h5>
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
                            <p>Bên B (Bên vay) Ông / Bà : {{$item->name}}</p>
                            <p> Số CMT / CCCD : {{$item->identity_card_number}}</p>
                            <p>Ngày ký : {{$item->created_at}}</p>
                            <p>Số tiền khoản vay : {{number_format($item->lend_money)}} VNĐ</p>
                            <p>Mã hợp đồng : {{$item->IDLend()}}</p>
                            <p>Thời gian vay : {{number_format($item->interval)}} tháng</p>
                            <p>lãi suất cho vay là 01% mỗi tháng</p>
                            <p>Hợp đồng nêu rõ các bên đã đặt được thỏa thuận vay sau khi thương lượng và trên cơ sở
                                bình
                                đẳng , tự nguyện và nhất trí . Tất cả các bên cần đọc kỹ tất cả các điều khoản trong
                                thỏa
                                thuận này, sau khi ký vào thỏa thuận này coi như các bên đã hiểu đầy đủ và đồng ý hoàn
                                toàn
                                với tất cả các điều khoản và nội dung trong thỏa thuân này.</p>
                            <p>1.Phù hợp với các nguyên tắc bình đẳng , tự nguyện , trung thực và uy tín , hai bên thống
                                nhất ký kết hợp đồng vay sau khi thương lượng và cùng cam kết thực hiện.</p>
                            <p>2.Bên B cung cấp tài liệu đính kèm của hợp đồng vay và có hiệu lực pháp lý như hợp đồng
                                vay
                                này.</p>
                            <p>3.Bên B sẽ tạo lệnh tính tiền gốc và lãi dựa trên số tiền vay từ ví ứng dụng do bên A
                                cung
                                cấp.</p>
                            <p>4.Điều khoản đảm bảo.</p>
                            <p>- Bên vay không được sử dụng tiền vay để thực hiện các hoạt động bất hợp pháp .Nếu không
                                ,
                                bên A có quyền yêu cầu bên B hoàn trả ngay tiền gốc và lãi , bên B phải chịu các trách
                                nhiêm
                                pháp lý phát sinh từ đó.</p>
                            <p>- Bên vay phải trả nợ gốc và lãi trong thời gian quy định hợp đồng. Đối với phần quá hạn
                                ,
                                người cho vay có quyền thu hồi nơ trong thời hạn và thu ( lãi quá hạn ) % trên tổng số
                                tiền
                                vay trong ngày.</p>
                            <p>- Gốc và lãi của mỗi lần trả nợ sẽ được hệ thống tự động chuyển từ tài khoản ngân hàng do
                                bên
                                B bảo lưu sang tài khoản ngân hàng của bên A . Bên B phải đảm bảo có đủ tiền trong tài
                                khoản
                                ngân hàng trước ngày trả nợ hàng tháng.</p>
                            <p>5.Chịu trách nhiệm do vi pham hợp đồng</p>
                            <p>- Nếu bên B không trả được khoản vay theo quy định trong hợp đồng. Bên B phải chịu các
                                khoản
                                bồi thường thiệt hại đã thanh lý và phí luật sư, phí kiện tụng, chi phí đi lại và các
                                chi
                                phí khác phát sinh do kiện tụng.</p>
                            <p>- Khi bên A cho rẳng bên B đã hoặc có thể xảy ra tình huống ảnh hưởng đến khoản vay thì
                                bên A
                                có quyền yêu cầu bên B phải trả lại kịp thời trược thời hạn.</p>
                            <p>- Người vay và người bảo lãnh không được vi phạm điều lệ hợp đồng vì bất kỳ lý do gì</p>
                            <p>6.Phương thức giải quyết tranh chấp hợp đồng. <br>Tranh chấp phát sinh trong quá trình
                                thực
                                hiện hợp đồng này sẽ được giải quyết thông qua thương lượng thân thiện giữa các bên hoặc
                                có
                                thể nhờ bên thứ ba làm trung gian hòa giải .Nếu thương lượng hoặc hòa giải không thành ,
                                có
                                thể khởi kiện ra tòa án nhân dân nơi bên A có trụ sở.</p>
                            <p>7.Khi người vay trong quá trình xét duyệt khoản vay không thành công do nhiều yếu tố khác
                                nhau như chứng minh thư sai, thẻ ngân hàng sai , danh bạ sai. Việc thông tin sai lệch
                                này sẽ
                                khiến hệ thống phát hiện nghi ngờ gian lận hoặc giả mạo khoản vay và bên vay phải chủ
                                động
                                hợp tác với bên A để xử lý.</p>
                            <p>8.Nếu không hợp tác. Bên A có quyền khởi kiện ra Tòa án nhân dân và trình báo lên Trung
                                tâm
                                Báo cáo tín dụng của Ngân hàng nhà nước Việt Nam , hồ sơ nợ xấu sẽ được phản ánh trong
                                báo
                                cáo tín dụng , ảnh hưởng đến tín dụng sau này của người vay , vay vốn ngân hàng và hạn
                                chế
                                tiều dùng của người thân , con cái người vay ...</p><br>
                            <p>Người vay ký</p>
                            <div>
                                <img src="{{$item->sign_image_path}}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach

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
                        <p>Ngày ký : Cập nhật khi hoàn thành</p>
                        <p>Số tiền khoản vay : <span class="label_loan"></span> VNĐ</p>
                        <p>Mã hợp đồng : </p>
                        <p>Thời gian vay : <span class="label_loan_month"></span> tháng</p>
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

        <!-- Toast Notify -->
        <div class="toast-container position-static tabs-toast position-fixed justify-content-center top-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </svg>
                    <p>Bạn chưa xác minh danh tính!</p>
                </div>
            </div>
        </div>

    </form>

    <div class="modal fade" id="modalWallet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rút tiền</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('welcome.wallet_out')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nhập số tiền muốn rút:</label>
                            <input name="money" type="text" class="form-control" style="font-size: large;" id="recipient-name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        if (clickAccLink) {
            clickAccLink.forEach((ItemAccLink) => {
                ItemAccLink.addEventListener("click", () => {
                    if ("{{!auth()->user()->isConfirm()}}") {
                        const toast = new bootstrap.Toast(toastLive);
                        toast.show();
                    } else {
                        $('#infoPersonal').offcanvas('show')
                    }

                });
            });
        }

        $('#container_reason_reject').hide()

        function showReasonReject() {

            if ($('#input_container_reason_reject').val() == "{{auth()->user()->otp}}") {
                $('#container_reason_reject').show()
            }
        }
    </script>
@endsection
