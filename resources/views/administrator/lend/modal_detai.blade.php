
<style>


    .d-flex {
        align-items: baseline;
    }
</style>
<div class="col-lg-12">

    <div class="card">

        <div class="p-3">
            <h4>
                Thông tin hợp đồng
            </h4>
        </div>

        <div class="row pb-4 pt-4">
            <div class="col-md-3 text-center">
                <label>
                    Ảnh chân dung
                </label>
                <img class="p-3 image_modal image_detail"
                     src="{{ optional(optional($item->user)->userIdentityImage(3))->image_path}}"
                     style="object-fit: cover;">
            </div>

            <div class="col-md-5">

                <div class="d-flex">
                    <div class="flex-1">
                        <label>
                            Họ và tên
                        </label>
                    </div>

                    <div class="flex-1">
                        <strong>
                            {{$item->name}}
                        </strong>
                    </div>

                </div>

                <div class="d-flex">
                    <div class="flex-1">
                        <label>
                            Số điện thoại
                        </label>
                    </div>

                    <div class="flex-1">
                        <strong>
                            {{$item->phone}}
                        </strong>
                    </div>

                </div>


                <div class="d-flex">
                    <div class="flex-1">
                        <label>
                            Số CMND
                        </label>
                    </div>

                    <div class="flex-1">
                        <strong>
                            {{$item->identity_card_number}}
                        </strong>
                    </div>

                </div>

                <div class="d-flex">
                    <div class="flex-1">
                        <label>
                            Địa chỉ
                        </label>
                    </div>

                    <div class="flex-1">
                        <strong>
                            {{$item->address}}
                        </strong>
                    </div>

                </div>

                <div class="d-flex">
                    <div class="flex-1">
                        <label>
                            Nghề nghiệp
                        </label>
                    </div>

                    <div class="flex-1">
                        <strong>
                            {{$item->work}}
                        </strong>
                    </div>

                </div>

                <div class="d-flex">
                    <div class="flex-1">
                        <label>
                            Tình trạng hôn nhân
                        </label>
                    </div>

                    <div class="flex-1">
                        @foreach(\App\Models\MarriedStatus::all() as $marriedStatusItem)
                            @if($item->married_status_id == $marriedStatusItem->id)
                                <strong>
                                    {{$marriedStatusItem->name}}
                                </strong>
                            @endif
                        @endforeach
                    </div>

                </div>

                <div class="d-flex">
                    <div class="flex-1">
                        <label>
                            Học vấn
                        </label>
                    </div>

                    <div class="flex-1">
                        @foreach(\App\Models\EducationLevel::all() as $educationLevelItem)
                            @if($item->education_level_id == $educationLevelItem->id)
                                <strong>
                                    {{$educationLevelItem->name}}
                                </strong>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="d-flex">
                    <div class="flex-1">
                        <label>
                            Thu nhập
                        </label>
                    </div>

                    <div class="flex-1">
                        @foreach(\App\Models\MiddleIncome::all() as $middleIncomeItem)
                            @if($item->middle_income_id == $middleIncomeItem->id)
                                <strong>
                                    {{$middleIncomeItem->name}}
                                </strong>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="d-flex">
                    <div class="flex-1">
                        <label>
                            Mục đích vay
                        </label>
                    </div>

                    <div class="flex-1">
                        <strong>
                            {{$item->purpose}}
                        </strong>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="flex-1">
                        <label>
                            Số người thân
                        </label>
                    </div>

                    <div class="flex-1">
                        <strong>
                            {{$item->phone_friend}}
                        </strong>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="flex-1">
                        <label>
                            Tên người thân
                        </label>
                    </div>

                    <div class="flex-1">
                        <strong>
                            {{$item->name_friend}}
                        </strong>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="flex-1">
                        <label>
                            Chữ ký
                        </label>
                    </div>

                    <div class="flex-1">
                        <img src="{{$item->sign_image_path}}" style="width: 200px;">
                    </div>
                </div>

                <input style="display: none" name="lend_status_id" value="2">

                <label class="w-100">
                    <div class="d-grid">
                        <button class="btn btn-primary lend-status-{{$item->lend_status_id}}"
                                type="button">{{$item->lendStatus->name}}
                        </button>
                    </div>
                </label>

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
                            @foreach(\App\Models\Bank::orderBy('name')->get() as $bankItem)
                                @if($item->bank_id == $bankItem->id)
                                    <strong>
                                        {{$bankItem->name}}
                                    </strong>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Tên người thụ hưởng
                            </label>
                        </div>

                        <div class="flex-1">
                            <strong>
                                {{$item->bank_name}}
                            </strong>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Số tài khoản
                            </label>
                        </div>

                        <div class="flex-1">
                            <strong>
                                {{$item->bank_number}}
                            </strong>
                        </div>
                    </div>
                </div>

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
                                Bên B ( Bên vay ) Ông / Bà : {{optional($item->user)->name}}
                            </p>
                        </div>

                        <div>
                            <p>
                                Số CMT / CCCD : {{optional($item->user)->identity_card_number}}
                            </p>
                        </div>

                        <div>
                            <p>
                                Ngày ký
                                : {{$item->created_at->format('h:i A' )}} {{\App\Models\Formatter::getOnlyDate($item->created_at)}}
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
                                Hợp đồng nêu rõ các bên đã đặt được thỏa thuận vay sau khi thương lượng và trên cơ sở
                                bình đẳng , tự nguyện và nhất trí . Tất cả các bên cần đọc kỹ tất cả các điều khoản
                                trong thỏa thuận này, sau khi ký vào thỏa thuận này coi như các bên đã hiểu đầy đủ và
                                đồng ý hoàn toàn với tất cả các điều khoản và nội dung trong thỏa thuân này.
                            </p>
                        </div>

                        <div>
                            <p>
                                1.Phù hợp với các nguyên tắc bình đẳng , tự nguyện , trung thực và uy tín , hai bên
                                thống nhất ký kết hợp đồng vay sau khi thương lượng và cùng cam kết thực hiện.
                            </p>
                        </div>

                        <div>
                            <p>
                                2.Bên B cung cấp tài liệu đính kèm của hợp đồng vay và có hiệu lực pháp lý như hợp đồng
                                vay này.
                            </p>
                        </div>

                        <div>
                            <p>
                                3.Bên B sẽ tạo lệnh tính tiền gốc và lãi dựa trên số tiền vay từ ví ứng dụng do bên A
                                cung cấp.
                            </p>
                        </div>

                        <div>
                            <p>
                                4.Điều khoản đảm bảo.
                            </p>
                        </div>

                        <div>
                            <p>
                                - Bên vay không được sử dụng tiền vay để thực hiện các hoạt động bất hợp pháp .Nếu không
                                , bên A có quyền yêu cầu bên B hoàn trả ngay tiền gốc và lãi , bên B phải chịu các trách
                                nhiêm pháp lý phát sinh từ đó.
                            </p>
                        </div>

                        <div>
                            <p>
                                - Bên vay phải trả nợ gốc và lãi trong thời gian quy định hợp đồng. Đối với phần quá hạn
                                , người cho vay có quyền thu hồi nơ trong thời hạn và thu ( lãi quá hạn ) % trên tổng số
                                tiền vay trong ngày.
                            </p>
                        </div>

                        <div>
                            <p>
                                - Gốc và lãi của mỗi lần trả nợ sẽ được hệ thống tự động chuyển từ tài khoản ngân hàng
                                do bên B bảo lưu sang tài khoản ngân hàng của bên A . Bên B phải đảm bảo có đủ tiền
                                trong tài khoản ngân hàng trước ngày trả nợ hàng tháng.
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
                                - Nếu bên B không trả được khoản vay theo quy định trong hợp đồng. Bên B phải chịu các
                                khoản bồi thường thiệt hại đã thanh lý và phí luật sư, phí kiện tụng, chi phí đi lại và
                                các chi phí khác phát sinh do kiện tụng.
                            </p>
                        </div>

                        <div>
                            <p>
                                - Khi bên A cho rẳng bên B đã hoặc có thể xảy ra tình huống ảnh hưởng đến khoản vay thì
                                bên A có quyền yêu cầu bên B phải trả lại kịp thời trược thời hạn.
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
                                Tranh chấp phát sinh trong quá trình thực hiện hợp đồng này sẽ được giải quyết thông qua
                                thương lượng thân thiện giữa các bên hoặc có thể nhờ bên thứ ba làm trung gian hòa giải
                                .Nếu thương lượng hoặc hòa giải không thành , có thể khởi kiện ra tòa án nhân dân nơi
                                bên A có trụ sở.
                            </p>
                        </div>

                        <div>
                            <p>
                                7.Khi người vay trong quá trình xét duyệt khoản vay không thành công do nhiều yếu tố
                                khác nhau như chứng minh thư sai, thẻ ngân hàng sai , danh bạ sai. Việc thông tin sai
                                lệch này sẽ khiến hệ thống phát hiện nghi ngờ gian lận hoặc giả mạo khoản vay và bên vay
                                phải chủ động hợp tác với bên A để xử lý.
                            </p>
                        </div>

                        <div>
                            <p>
                                8.Nếu không hợp tác. Bên A có quyền khởi kiện ra Tòa án nhân dân và trình báo lên Trung
                                tâm Báo cáo tín dụng của Ngân hàng nhà nước Việt Nam , hồ sơ nợ xấu sẽ được phản ánh
                                trong báo cáo tín dụng , ảnh hưởng đến tín dụng sau này của người vay , vay vốn ngân
                                hàng và hạn chế tiều dùng của người thân , con cái người vay ...
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
                                        {{optional($item->user)->name}}
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
                                    <img style="max-height: 150px;width: auto;"
                                         src="{{asset('assets/images/Capture.PNG')}}">
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
        <div class="modal-content" style="pointer-events: none;">
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
