@extends('administrator.layouts.master')

@include('administrator.lend.header')

@section('css')

@endsection

@section('content')
    <div class="col-md-9">

        <div class="card">

            <div class="card-header">
                Danh sách hợp đồng
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-editable table-nowrap align-middle table-edits">
                        <thead>
                        <tr>
                            <th>Số điện thoại</th>
                            <th>NV hỗ trợ</th>
                            <th>Tên</th>
                            <th>Trạng thái hồ sơ</th>
                            <th>Khởi tạo lúc</th>
                            <th>Tùy chọn</th>
                            <th>Tùy chọn</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->phone}}</td>
                                <td>{{ optional($item->admin)->name}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{optional($item->status)->name}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <a>Xem chi tiết</a>
                                </td>
                                <td>
                                    <a>Đặt lại mật khẩu</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

    <div class="col-md-3">
        <form action="{{route('administrator.users.status.update' , ['id' => $user->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="bg-white p-3">
                <div class="d-flex mt-4 align-items-center">
                    <div class="flex-1">
                        Gói dịch vụ:
                    </div>
                    <div class="flex-1 text-end">
                        <select name="package_service_id" class="form-select">
                            <option value="0">Chưa có dịch vụ</option>
                            @foreach(\App\Models\PackageService::all() as $item)
                                <option value="{{$item->id}}" {{optional($user->packageService)->id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex mt-3">
                    <div class="flex-1">
                        Thời gian bắt đầu dịch vụ:
                    </div>
                    <div class="flex-1 text-end">
                        <strong>{{ \App\Models\Formatter::getOnlyDate($user->date_use_package_service)}}</strong>
                    </div>
                </div>

                <div class="d-flex mt-3">
                    <div class="flex-1">
                        Thời gian kết thúc dịch vụ:
                    </div>
                    <div class="flex-1 text-end">
                        <strong>{{ $user->dateExpiredPackageService($user->id)}}</strong>
                    </div>
                </div>

                <div class="d-flex mt-3">
                    <div class="flex-1">
                        Số Pair có:
                    </div>
                    <div class="flex-1 text-end">
                        <strong>{{ $user->number_pair}}</strong>
                    </div>
                </div>

                <div class="d-flex mt-3">
                    <div class="flex-1">
                        Số Date đã đồng ý:
                    </div>
                    <div class="flex-1 text-end">
                        <strong>{{ $user->number_date_accept}}</strong>
                    </div>
                </div>

                <div class="d-flex mt-3">
                    <div class="flex-1">
                        Số Date đã thực hiện:
                    </div>
                    <div class="flex-1 text-end">
                        <strong>{{ $user->number_date}}</strong>
                    </div>
                </div>

                <div class="d-flex mt-3">
                    <div class="flex-1">
                        <strong>Trạng thái duyệt hồ sơ:</strong>
                    </div>
                    <div class="flex-1 text-center">
                        <div class="form-check form-switch d-flex justify-content-center">
                            <input name="user_status_id" class="form-check-input"
                                   type="checkbox" {{$user->isActive($user->id) ? 'checked' : ''}}>
                        </div>
                        <p>Thay đổi sẽ khiến tài khoản trở về trạng thái chưa duyệt, không thể sử dụng dịch vụ</p>
                    </div>
                </div>

                <div class="d-flex mt-3">
                    <div class="flex-1">
                        <strong>Thêm vào danh sách gợi ý cho Agent:</strong>
                    </div>
                    <div class="flex-1 text-center">
                        <div class="form-check form-switch d-flex justify-content-center">
                            <input name="user_suggestion_id" class="form-check-input"
                                   type="checkbox" {{$user->isSuggestion($user->id) ? 'checked' : ''}}>
                        </div>
                        <p>Giúp Finder xuất hiện trong danh sách gợi ý trên trang chính của Agent</p>
                    </div>
                </div>

                <div class="d-flex mt-3">
                    <div class="flex-1">
                        <strong>Không xuất hiện trên trang tìm kiếm của Agent:</strong>
                    </div>
                    <div class="flex-1 text-center">
                        <div class="form-check form-switch d-flex justify-content-center">
                            <input name="user_agent_find_id" class="form-check-input"
                                   type="checkbox" {{!$user->isAgentFind($user->id) ? 'checked' : ''}}>
                        </div>
                        <p>Agent không thể tìm kiếm thấy Finder này</p>
                    </div>
                </div>

                <div class="text-end mt-3 container-save">
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>

                <div class="text-center mt-3">
                    <a href="{{route('administrator.chats.index' , ['user_id' => $user->id])}}" class="w-50 btn btn-outline-secondary btn-lg rounded-pill">Chat</a>
                </div>
            </div>

        </form>
    </div>
@endsection

@section('js')

    <script>

        $('.container-save').hide()

        $('select').on('change', function () {
            $('.container-save').show()
        })

        $('input').on('change', function () {
            $('.container-save').show()
        })
    </script>
@endsection
