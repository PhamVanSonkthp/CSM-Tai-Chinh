@extends('layouts.app')

@section('content')
    <div class="accountbg"
         style="background: url({{asset('user/assets/images/banner2000x1333.jpg')}});background-size: cover;background-position: center;z-index: -1;left: 370px;position: fixed;"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="">
                                <div class="card-block">

                                    <div class="account-box">

                                        <div class="card-box shadow-none p-4">
                                            <div class="p-2">
                                                <div class="text-center mt-4">
                                                    <a href="{{ route('welcome.index') }}"><img src="{{asset(optional(\App\Models\Logo::first())->image_path)}}" height="150"
                                                                                                alt="logo"></a>
                                                </div>

                                                <h4 class="font-size-18 mt-5 text-center">Đăng nhập</h4>

                                                @if(Session::has('error'))
                                                    <p class="alert alert-info">{{ Session::get('error') }}</p>
                                                @endif

                                                <form class="mt-4" action="#">

                                                    <div class="mb-3">
                                                        <label for="phone"
                                                               class="col-form-label text-md-end">Số điện thoại</label>

                                                        <div>
                                                            <input id="phone" type="text"
                                                                   class="form-control @error('phone') is-invalid @enderror"
                                                                   name="phone" value="{{ old('phone') }}" required autocomplete="phone"
                                                                   autofocus>
                                                            @error('phone')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>
                                            Tài khoản không chính xác
                                        </strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="password" class="col-form-label text-md-end">Mật khẩu</label>

                                                        <div>
                                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                            @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="mb-0">
                                                        <div>
                                                            <button type="submit" class="btn text-white" style="background-color: #D3AB56;">
                                                                Đăng nhập
                                                            </button>

                                                        </div>
                                                    </div>

                                                </form>

                                                <div class="mt-5 pt-4 text-center position-relative">

                                                    @guest
                                                        @if (Route::has('register'))
                                                            <div>Bạn chưa có tài khoản ?</div>
                                                            <a href="{{ route('register') }}"
                                                               class=" mt-2 mb-2 btn fw-medium text-white" style="background-color: #D3AB56;"> Đăng ký ngay </a>
                                                        @endif

                                                    @endguest
                                                    <p>
                                                        <script>document.write(new Date().getFullYear())</script>
                                                        © {{ config('app.name', 'Laravel') }}.
                                                    </p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
