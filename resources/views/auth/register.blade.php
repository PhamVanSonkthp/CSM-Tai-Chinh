@extends('layouts.app')

@section('content')
    <div class="accountbg"
         style="background: url({{asset('user/assets/images/banner2000x1333.jpg')}});background-size: cover;background-position: center;z-index: -1;"></div>

    <div class="account-pages mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mt-4">
                                <div class="mb-3">
                                    <a href="{{ route('welcome.index') }}"><img
                                            src="{{asset(optional(\App\Models\Logo::first())->image_path)}}" height="150"
                                            alt="logo"></a>
                                </div>
                            </div>
                            <div class="p-3">
                                <h4 class="font-size-18 mt-2 text-center">Đăng ký</h4>

                                <form method="POST" action="{{ route('register') }}" class="form-horizontal">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="phone"
                                               class="col-form-label text-md-end">Số điện thoại <span class="text-danger">*</span></label>

                                        <div>
                                            <input id="phone" type="text"
                                                   class="form-control @error('phone') is-invalid @enderror"
                                                   name="phone" value="{{ old('phone') }}"
                                                   autocomplete="phone">

                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password"
                                               class="col-form-label text-md-end">Mật khẩu <span class="text-danger">*</span></label>

                                        <div>
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" required autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password-confirm"
                                               class="col-form-label text-md-end">Nhập lại mật khẩu <span class="text-danger">*</span></label>

                                        <div>
                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="text-end">
                                            <button
                                                class="btn btn-primary w-md waves-effect waves-light button-register"
                                                type="submit">Đăng ký
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center position-relative">
                        <p class="text-dark">Bạn đã có tài khoản ? <a href="{{ route('login') }}"
                                                                           class="font-weight-bold text-primary">
                                Login </a></p>
                        <p class="text-dark">
                            <script>document.write(new Date().getFullYear())</script>
                            © {{ config('app.name', 'Laravel') }}.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
