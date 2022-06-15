@extends('administrator.layouts.master')

@include('administrator.lend.header')

@section('css')
    <style>
        label {
            padding: 10px;
        }
    </style>

    <!-- Swiper Css -->
    <link rel="stylesheet" href="{{asset('vendor/swiper/swiper-bundle.min.css')}}">
    /*<!-- Bootstrap Css -->*/
    /*
    <link rel="stylesheet" type="text/css" href="./bootstrap.min.css">*/

    <style>
        .banner__slide {
            position: relative;
        }

        img {
            height: 500px;
            width: 100%;
        }

        .swiper-button-next,
        .swiper-button-prev {
            position: relative;
            display: flex;
            margin-top: 30px;
            color: #000;

            background-color: #fff;
            padding: 4px 20px;
            border: 1px solid rgb(180, 180, 180);
            width: auto;
            border-radius: 4px;
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            display: none;
        }

        .banner__slide-wrapper {
            margin: 20px 0px 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .banner__slide-title {
            position: absolute;
            bottom: -28px;
            left: 50%;
            transform: translateX(-50%)
        }

        .card {
            height: 100%;
        }

        img {
            max-height: 350px;
        }
    </style>

@endsection

@section('content')
    <div class="col-lg-9">
        <div class="card">
            <form action="{{route('administrator.lends.update', ['id' => $item->id ])}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="row pb-4 pt-4">
                <div class="col-md-3">
                    <img src="{{$item->feature_image_path}}" style="object-fit: cover;">
                    <div class="text-center">
                        <label>{{$item->phone}}</label>
                    </div>
                    <div class="text-center">
                        <label>{{$item->name}}</label>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Số CMND
                            </label>
                        </div>

                        <div class="flex-1">
                            <input name="identity_card_number" type="text"
                                   class="form-control @error('identity_card_number') is-invalid @enderror"
                                   value="{{$item->identity_card_number}}">
                            @error('identity_card_number')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Địa chỉ
                            </label>
                        </div>

                        <div class="flex-1">
                            <input name="address" type="text"
                                   class="form-control @error('address') is-invalid @enderror"
                                   value="{{$item->address}}">
                            @error('address')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Nghề nghiệp
                            </label>
                        </div>

                        <div class="flex-1">
                            <input name="work" type="text" class="form-control @error('work') is-invalid @enderror"
                                   value="{{$item->work}}">
                            @error('work')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Tình trạng hôn nhân
                            </label>
                        </div>

                        <div class="flex-1">
                            <select name="married_status_id"
                                    class="form-select @error('married_status_id') is-invalid @enderror">
                                @foreach(\App\Models\MarriedStatus::all() as $marriedStatusItem)
                                    <option
                                        value="{{$marriedStatusItem->id}}" {{$item->married_status_id == $marriedStatusItem->id ? 'selected' : ''}}>{{$marriedStatusItem->name}}</option>
                                @endforeach
                            </select>
                            @error('married_status_id')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Học vấn
                            </label>
                        </div>

                        <div class="flex-1">
                            <select name="education_level_id"
                                    class="form-select @error('education_level_id') is-invalid @enderror">
                                @foreach(\App\Models\EducationLevel::all() as $educationLevelItem)
                                    <option
                                        value="{{$educationLevelItem->id}}" {{$item->education_level_id == $educationLevelItem->id ? 'selected' : ''}}>{{$educationLevelItem->name}}</option>
                                @endforeach
                            </select>
                            @error('education_level_id')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Thu nhập
                            </label>
                        </div>

                        <div class="flex-1">
                            <select name="middle_income_id"
                                    class="form-select @error('middle_income_id') is-invalid @enderror">
                                @foreach(\App\Models\MiddleIncome::all() as $middleIncomeItem)
                                    <option
                                        value="{{$middleIncomeItem->id}}" {{$item->middle_income_id == $middleIncomeItem->id ? 'selected' : ''}}>{{$middleIncomeItem->name}}</option>
                                @endforeach
                                @error('middle_income_id')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </select>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Mục đích vay
                            </label>
                        </div>

                        <div class="flex-1">
                            <label>
                                {{$item->purpose}}
                            </label>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Số người thân
                            </label>
                        </div>

                        <div class="flex-1">
                            <label>
                                {{$item->phone_friend}}
                            </label>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Tên người thân
                            </label>
                        </div>

                        <div class="flex-1">
                            <label>
                                {{$item->name_friend}}
                            </label>
                        </div>
                    </div>

                    <input style="display: none" name="lend_status_id" value="2">

                    @if($item->lend_status_id == 1)
                        <label class="w-100">
                            <div class="d-grid">
                                <button class="btn btn-primary lend-status-{{$item->lend_status_id}}" type="submit">Xác
                                    minh khách hàng
                                </button>
                            </div>
                        </label>

                    @else
                        <label class="w-100">
                            <div class="d-grid">
                                <button class="btn btn-primary lend-status-{{$item->lend_status_id}}" type="button">Đã
                                    tạo hồ sơ
                                </button>
                            </div>
                        </label>

                    @endif

                </div>

                <div class="col-md-4">
                    <div class="p-3">
                        <label>
                            <strong>
                                Thông tin tài khoản thụ hưởng
                            </strong>
                        </label>
                        <div class="d-flex">
                            <div class="flex-1">
                                <label>
                                    Ngân hàng
                                </label>
                            </div>

                            <div class="flex-1">
                                <select name="bank_id" class="form-select @error('bank_id') is-invalid @enderror">
                                    @foreach(\App\Models\Bank::orderBy('name')->get() as $bankItem)
                                        <option
                                            value="{{$bankItem->id}}" {{$item->bank_id == $bankItem->id ? 'selected' : ''}}>{{$bankItem->name}}</option>
                                    @endforeach
                                </select>
                                @error('bank_id')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="flex-1">
                                <label>
                                    Tên người thụ hưởng
                                </label>
                            </div>

                            <div class="flex-1">
                                <input name="bank_name" type="text"
                                       class="form-control @error('bank_name') is-invalid @enderror"
                                       value="{{$item->bank_name}}">
                                @error('bank_name')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="flex-1">
                                <label>
                                    Số tài khoản
                                </label>
                            </div>

                            <div class="flex-1">
                                <input name="bank_number" type="text"
                                       class="form-control @error('bank_number') is-invalid @enderror"
                                       value="{{$item->bank_number}}">
                                @error('bank_number')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <label class="w-100">
                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit">Lưu thay đổi</button>
                            </div>
                        </label>
                    </div>

                </div>
            </div>

            </form>
        </div>

    </div>

    <div class="col-lg-3">
        <div class="card pb-4">

            <div class="contianer-xl">
                <div class="col-lg-12">
                    <div class="swiper mySwiper banner__slide">
                        <div class="swiper-wrapper">
                            <!-- slider image -->
                            @foreach($item->lendImages as $lendImagesItem)
                                <div class="swiper-slide banner__slide-item">
                                    <img style="object-fit: cover;" src="{{$lendImagesItem->image_path}}"
                                         alt="{{$lendImagesItem->image_name}}" class="banner__slide-img"></img>
                                    <span class="banner__slide-title">{{$lendImagesItem->image_name}}</span>
                                </div>
                            @endforeach
                        </div>
                        <!-- <div class="swiper-pagination"></div> -->
                        <div class="banner__slide-wrapper">
                            <div class="swiper-button-prev">Trước</div>
                            <div class="swiper-button-next">Sau</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">

            <form action="{{route('administrator.lends.update', ['id' => $item->id ])}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="d-flex">
                    <div class="flex-1">
                        <label>
                            Số tiền:
                        </label>
                    </div>

                    <div class="flex-1">
                        <label>
                            {{ number_format($item->lend_money) }}
                        </label>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="flex-1">
                        <label>
                            Trạng thái:
                        </label>
                    </div>

                    <div class="flex-1">
                        <label class="lend-status-{{$item->lend_status_id}}">
                            {{ optional($item->lendStatus)->name}}
                        </label>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="flex-1">
                        <label>
                            Thời hạn:
                        </label>
                    </div>

                    <div class="flex-1">
                        <label>
                            {{$item->interval}}
                        </label>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="flex-1">
                        <label>
                            Mã hợp đồng:
                        </label>
                    </div>

                    <div class="flex-1">
                        <label>
                            {{$item->IDLend()}}
                        </label>
                    </div>
                </div>

                @if($item->lend_status_id == 2)
                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Rút tiền:
                            </label>
                        </div>

                        <div class="flex-1">
                            <label>
                                <div class="form-check form-switch">
                                    <input name="payment_status_id" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{$item->user->payment_status_id == 2 ? 'checked' : ''}}>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Lí do từ chối:
                            </label>
                        </div>

                        <div class="flex-1">
                            <label>
                                <div class="d-flex">
                                    <div style="flex: 3">
                                        <select name="purpose_reject_id" class="form-select @error('purpose_reject_id') is-invalid @enderror">
                                            <option value="" disabled selected>Chọn lý do</option>
                                            @foreach(\App\Models\PurposeReject::orderBy('name')->get() as $purposeRejectItem)
                                                <option value="{{$purposeRejectItem->id}}" {{$item->purpose_reject_id == $purposeRejectItem->id ? 'selected' : ''}}>{{$purposeRejectItem->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('purpose_reject_id')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div style="flex: 1">
                                        <input name="purpose_reject" type="text"
                                               class="form-control @error('purpose_reject') is-invalid @enderror"
                                               value="{{ optional($item->purposeReject)->name ?? $item->purpose_reject}}" placeholder="Khác">
                                        @error('purpose_reject')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </label>

                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                <button class="btn btn-primary" type="button">Xem hợp đồng</button>
                            </label>
                        </div>

                        <div class="flex-1">
                            <label>
                                <button class="btn btn-primary" type="submit">Cập nhật</button>
                            </label>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card">
            <div>
                <label>
                    Hiện không có yêu cầu
                </label>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card">
            <div>
                <label>
                    Ví người dùng
                </label>
            </div>

            <div>
                <label>
                    Số dư:
                </label>

                <label>
                    <strong>
                        {{number_format($item->user->wallet)}} VNĐ
                    </strong>
                </label>
            </div>

            <div class="d-flex">
                <div class="flex-1 text-center">
                    <button type="button" class="btn btn-danger">Trừ ví</button>
                </div>

                <div class="flex-1 text-center">
                    <button type="button" class="btn btn-success">Cộng ví</button>
                </div>
            </div>

            <div>
                <label>
                    Lịch sử
                </label>

                <div class="ps-4">
                    @foreach($item->user->walletHistories as $walletHistoriesItem)
                        <div class="d-flex">
                            <div class="flex-1">
                                <label>
                                    {{$walletHistoriesItem->name}}
                                </label>
                            </div>

                            <div class="flex-1">
                                @if($walletHistoriesItem->money > 0)
                                    <label class="text-success">
                                        +{{number_format($walletHistoriesItem->money)}}
                                    </label>
                                @else
                                    <label class="text-danger">
                                        {{number_format($walletHistoriesItem->money)}}
                                    </label>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>

        </div>
    </div>

@endsection

@section('js')

    <script>

        function getFormattedDate(date) {
            var year = date.getFullYear();

            var month = (1 + date.getMonth()).toString();
            month = month.length > 1 ? month : '0' + month;

            var day = date.getDate().toString();
            day = day.length > 1 ? day : '0' + day;

            return month + '/' + day + '/' + year;
        }

        function updateConfig() {
            const url = new URL(decodeURIComponent(window.location.href));

            $('#select_gender').val(url.searchParams.get("gender")).change();

            const options = {}
            options.autoApply = false;

            if (url.searchParams.get("start")) {
                options.startDate = getFormattedDate(new Date(url.searchParams.get("start")))
            }

            if (url.searchParams.get("end")) {
                options.endDate = getFormattedDate(new Date(url.searchParams.get("end")))
            }

            $('#config-demo').daterangepicker(options, function (start, end, label) {
                addUrlParameterObjects([{name: "start", value: start.format('YYYY-MM-DD')}, {
                    name: "end",
                    value: end.format('YYYY-MM-DD')
                }])
            });
        }

        updateConfig()

        function viewBirthOfDay() {
            // addUrlParameterObjects([{name: "start", value: new Date().toISOString().slice(0, 10)}, {
            //     name: "end",
            //     value: new Date().toISOString().slice(0, 10)
            // }])

            const searchParams = new URLSearchParams(window.location.search)
            searchParams.set('date_of_birth', new Date().toISOString().slice(0, 10))
            window.location.search = searchParams.toString()
        }
    </script>

    <script>
        function addUrlParameterObjects($params) {
            const searchParams = new URLSearchParams(window.location.search)

            for (let i = 0; i < $params.length; i++) {
                searchParams.set($params[i].name, $params[i].value)
            }

            searchButton(searchParams)
        }

        function search(ele) {
            if (event.key === 'Enter') {
                searchButton()
            }
        }

        function searchButton(searchParams) {
            if (!searchParams) {
                searchParams = new URLSearchParams(window.location.search)
            }
            searchParams.set('search_query', $('#input_search').val())
            searchParams.set('lend_status_id_1', $('input[name="lend_status_id_1"]').is(':checked'))
            searchParams.set('lend_status_id_2', $('input[name="lend_status_id_2"]').is(':checked'))
            searchParams.set('lend_status_id_3', $('input[name="lend_status_id_3"]').is(':checked'))
            window.location.search = searchParams.toString()

        }

        function exportExcel() {
            window.location.href = "{{route('administrator.users.export')}}" + window.location.search
        }

    </script>

    <!-- Jquery JS -->
    {{--    <script type="text/javascript" src="./jquery.min.js"></script>--}}
    {{--    <!-- Script Bootstrap -->--}}
    {{--    <script type="text/javascript" src="./bootstrap.bundle.min.js"></script>--}}
    <!-- Swiper JS -->
    <script type="text/javascript" src="{{asset('vendor/swiper/swiper-bundle.min.js')}}"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10,
            // loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            direction: 'horizontal',
            autoplay: {
                delay: 5000,
            },
        });
    </script>

@endsection
