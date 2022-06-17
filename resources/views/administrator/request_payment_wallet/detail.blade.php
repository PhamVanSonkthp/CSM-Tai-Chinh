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
            /*height: 500px;*/
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

        .image_detail {
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
                    <img class="image_modal image_detail" src="{{$item->feature_image_path}}" style="object-fit: cover;">
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
                                    minh hồ sơ
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
                    <div class="ps-3 pe-3 pb-3">
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
                                         alt="{{$lendImagesItem->image_name}}" class="banner__slide-img image_detail image_modal"></img>
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
                                Rút tiền (Khách hàng có thể tạo yêu cầu rút tiền hay không):
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
                                Mã OTP:
                            </label>
                        </div>

                        <div class="flex-1">
                            <label class="w-100">
                                <input name="otp" type="text"
                                       class="w-100 form-control @error('otp') is-invalid @enderror"
                                       value="{{$item->otp}}" placeholder="Mật khẩu xem lý do từ chối">
                                @error('otp')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </label>

                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Xem hợp đồng</button>

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
                    Yêu cầu rút tiền:
                </label>

                @if($item->user->requestPaymentWallets->count())
                    <div class="row">
                        <div class="col-6">
                            <label>
                                <strong>Số tiền</strong>
                            </label>

                        </div>

                        <div class="col-6">
                            <label>
                                <strong>Trạng thái</strong>
                            </label>

                        </div>
                        @foreach($item->user->requestPaymentWallets as $requestPaymentWalletsItem)
                            <div class="col-6">
                                <label>
                                    {{number_format($requestPaymentWalletsItem->money)}}
                                </label>

                            </div>

                            <div class="col-6">
                                <label>
                                    {{ optional($requestPaymentWalletsItem->status)->name }}
                                </label>

                            </div>
                        @endforeach
                    </div>

                @endif
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
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_div_wallet">Trừ ví</button>
                </div>

                <div class="flex-1 text-center">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_add_wallet">Cộng ví</button>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hợp đồng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="text-center">
                                <strong>
                                    CỘNG HÒ XÃ HỘI CHỦ NGHĨA VIỆT NAM
                                </strong>
                            </div>

                            <div class="text-center">
                                <strong>
                                    ĐỘC LẬP - TỰ DO - HẠNH PHÚC
                                </strong>
                            </div>

                            <div class="text-center mt-2">
                                <strong>
                                    HỢP ĐỒNG VAY TIỀN
                                </strong>
                            </div>

                            <div>
                                <strong>
                                    Thông tin cơ bản về khoản vay
                                </strong>
                            </div>

                            <div>
                                <p>
                                    Bên A ( Bên cho vay ) CÔNG TY TÀI CHÍNH MIRAE ASSET
                                </p>
                            </div>

                            <div>
                                <p>
                                    Bên B ( Bên vay ) Ông / Bà : {{$item->user->name}}
                                </p>
                            </div>

                            <div>
                                <p>
                                    Số CMT / CCCD : {{$item->user->identity_card_number}}
                                </p>
                            </div>

                            <div>
                                <p>
                                    Ngày ký : {{$item->created_at->format('h:i A' )}} {{\App\Models\Formatter::getOnlyDate($item->created_at)}}
                                </p>
                            </div>

                            <div>
                                <p>
                                    Số tiền khoản vay : {{number_format($item->lend_money)}} VNĐ
                                </p>
                            </div>

                            <div>
                                <p>
                                    Mã hợp đồng : {{$item->IDLend()}}
                                </p>
                            </div>

                            <div>
                                <p>
                                    signature_capture
                                </p>
                            </div>

                            <div>
                                <p>
                                    Thời gian vay : {{$item->interval}} tháng
                                </p>
                            </div>

                            <div>
                                <p>
                                    Lãi suất cho vay là {{$item->interest_rate}}% mỗi tháng
                                </p>
                            </div>

                            <div>
                                <p>
                                    Hợp đồng nêu rõ các bên đã đặt được thỏa thuận vay sau khi thương lượng và trên cơ sở bình đẳng , tự nguyện và nhất trí . Tất cả các bên cần đọc kỹ tất cả các điều khoản trong thỏa thuận này, sau khi ký vào thỏa thuận này coi như các bên đã hiểu đầy đủ và đồng ý hoàn toàn với tất cả các điều khoản và nội dung trong thỏa thuân này.
                                </p>
                            </div>

                            <div>
                                <p>
                                    1.Phù hợp với các nguyên tắc bình đẳng , tự nguyện , trung thực và uy tín , hai bên thống nhất ký kết hợp đồng vay sau khi thương lượng và cùng cam kết thực hiện.
                                </p>
                            </div>

                            <div>
                                <p>
                                    2.Bên B cung cấp tài liệu đính kèm của hợp đồng vay và có hiệu lực pháp lý như hợp đồng vay này.
                                </p>
                            </div>

                            <div>
                                <p>
                                    3.Bên B sẽ tạo lệnh tính tiền gốc và lãi dựa trên số tiền vay từ ví ứng dụng do bên A cung cấp.
                                </p>
                            </div>

                            <div>
                                <p>
                                    4.Điều khoản đảm bảo.
                                </p>
                            </div>

                            <div>
                                <p>
                                    - Bên vay không được sử dụng tiền vay để thực hiện các hoạt động bất hợp pháp .Nếu không , bên A có quyền yêu cầu bên B hoàn trả ngay tiền gốc và lãi , bên B phải chịu các trách nhiêm pháp lý phát sinh từ đó.
                                </p>
                            </div>

                            <div>
                                <p>
                                    - Bên vay phải trả nợ gốc và lãi trong thời gian quy định hợp đồng. Đối với phần quá hạn , người cho vay có quyền thu hồi nơ trong thời hạn và thu ( lãi quá hạn ) % trên tổng số tiền vay trong ngày.
                                </p>
                            </div>

                            <div>
                                <p>
                                    - Gốc và lãi của mỗi lần trả nợ sẽ được hệ thống tự động chuyển từ tài khoản ngân hàng do bên B bảo lưu sang tài khoản ngân hàng của bên A . Bên B phải đảm bảo có đủ tiền trong tài khoản ngân hàng trước ngày trả nợ hàng tháng.
                                </p>
                            </div>


                        </div>

                        <div class="col-md-6">

                            <div>
                                <p>
                                    5.Chịu trách nhiệm do vi pham hợp đồng
                                </p>
                            </div>

                            <div>
                                <p>
                                    - Nếu bên B không trả được khoản vay theo quy định trong hợp đồng. Bên B phải chịu các khoản bồi thường thiệt hại đã thanh lý và phí luật sư, phí kiện tụng, chi phí đi lại và các chi phí khác phát sinh do kiện tụng.
                                </p>
                            </div>

                            <div>
                                <p>
                                    - Khi bên A cho rẳng bên B đã hoặc có thể xảy ra tình huống ảnh hưởng đến khoản vay thì bên A có quyền yêu cầu bên B phải trả lại kịp thời trược thời hạn.
                                </p>
                            </div>

                            <div>
                                <p>
                                    - Người vay và người bảo lãnh không được vi phạm điều lệ hợp đồng vì bất kỳ lý do gì
                                </p>
                            </div>

                            <div>
                                <p>
                                    6.Phương thức giải quyết tranh chấp .
                                </p>
                            </div>

                            <div>
                                <p>
                                    Tranh chấp phát sinh trong quá trình thực hiện hợp đồng này sẽ được giải quyết thông qua thương lượng thân thiện giữa các bên hoặc có thể nhờ bên thứ ba làm trung gian hòa giải .Nếu thương lượng hoặc hòa giải không thành , có thể khởi kiện ra tòa án nhân dân nơi bên A có trụ sở.
                                </p>
                            </div>

                            <div>
                                <p>
                                    7.Khi người vay trong quá trình xét duyệt khoản vay không thành công do nhiều yếu tố khác nhau như chứng minh thư sai, thẻ ngân hàng sai , danh bạ sai. Việc thông tin sai lệch này sẽ khiến hệ thống phát hiện nghi ngờ gian lận hoặc giả mạo khoản vay và bên vay phải chủ động hợp tác với bên A để xử lý.
                                </p>
                            </div>

                            <div>
                                <p>
                                    8.Nếu không hợp tác. Bên A có quyền khởi kiện ra Tòa án nhân dân và trình báo lên Trung tâm Báo cáo tín dụng của Ngân hàng nhà nước Việt Nam , hồ sơ nợ xấu sẽ được phản ánh trong báo cáo tín dụng , ảnh hưởng đến tín dụng sau này của người vay , vay vốn ngân hàng và hạn chế tiều dùng của người thân , con cái người vay ...
                                </p>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div>
                                        <p>
                                            Người vay ký
                                        </p>
                                    </div>

                                    <div>
                                        <img style="max-height: 150px;width: auto;" src="{{$item->sign_image_path}}">
                                    </div>

                                    <div>
                                        <p>
                                            {{$item->user->name}}
                                        </p>
                                    </div>

                                </div>

                                <div class="col-6">
                                    <div>
                                        <p>
                                            Người đại diện
                                        </p>
                                    </div>

                                    <div>
                                        <img style="max-height: 150px;width: auto;" src="{{asset('assets/images/Capture.PNG')}}">
                                    </div>

                                    <div>
                                        <p>
                                            Lee Yun Hyoung
                                        </p>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_div_wallet" tabindex="-1" aria-labelledby="modal_div_walletLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('administrator.lends.update', ['id' => $item->id ])}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_div_walletLabel">Trừ ví khách hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <strong>
                                Số tiền muốn trừ
                            </strong>
                            <input name="div_wallet" type="number"
                                   class="form-control @error('div_wallet') is-invalid @enderror" required>
                            @error('div_wallet')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div>
                            <strong>
                                Lý do
                            </strong>
                            <input name="div_wallet_reason" type="text"
                                   class="form-control @error('div_wallet_reason') is-invalid @enderror" required>
                            @error('div_wallet_reason')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Xác nhận trừ</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_add_wallet" tabindex="-1" aria-labelledby="modal_add_walletLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('administrator.lends.update', ['id' => $item->id ])}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_add_walletLabel">Cộng ví khách hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <strong>
                                Số tiền muốn cộng
                            </strong>
                            <input name="add_wallet" type="number"
                                   class="form-control @error('add_wallet') is-invalid @enderror" required>
                            @error('add_wallet')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div>
                            <strong>
                                Lý do
                            </strong>
                            <input name="add_wallet_reason" type="text"
                                   class="form-control @error('add_wallet_reason') is-invalid @enderror" required>
                            @error('add_wallet_reason')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Xác nhận cộng</button>
                    </div>

                </form>

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
