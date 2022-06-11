@extends('administrator.layouts.master')

@include('administrator.user.header')

@section('css')

@endsection

@section('content')
    <div class="col-md-9">

        <div class="card">

            <div class="card-header">
                Danh sách Finder > {{$user->real_name}}
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-editable table-nowrap align-middle table-edits">
                        <thead>
                        <tr>
                            <th>Câu hỏi</th>
                            <th>Câu trả lời</th>
                            <th>Note</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Tên đầy đủ của bạn</td>
                            <td>{{$user->real_name}}</td>
                            <td>{{$user->note_real_name}}</td>
                        </tr>
                        <tr>
                            <td>Tên hiển thị trên App</td>
                            <td>{{$user->display_name}}</td>
                            <td>{{$user->note_display_name}}</td>
                        </tr>
                        <tr>
                            <td>Số điện thoại</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->note_phone}}</td>
                        </tr>
                        <tr>
                            <td>Giới tính</td>
                            <td>{{ optional($user->gender)->name}}</td>
                            <td>{{ $user->note_gender}}</td>
                        </tr>
                        <tr>
                            <td>Bạn có dùng Zalo với số điện thoại này không?</td>
                            <td>{{$user->phone_zalo}}</td>
                            <td>{{$user->note_phone_zalo}}</td>
                        </tr>
                        <tr>
                            <td>Email của bạn</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->note_email}}</td>
                        </tr>
                        <tr>
                            <td>Ngày sinh của bạn</td>
                            <td>{{\App\Models\Formatter::getOnlyDate($user->date_of_birth)}}</td>
                            <td>{{$user->note_date_of_birth}}</td>
                        </tr>
                        <tr>
                            <td>Quê của bạn</td>
                            <td>{{ optional($user->addressBorn)->name}}</td>
                            <td>{{ $user->note_address_born}}</td>
                        </tr>
                        <tr>
                            <td>Trường đại học của bạn</td>
                            <td>{{$user->university}}</td>
                            <td>{{$user->note_university}}</td>
                        </tr>
                        <tr>
                            <td>Nơi bạn đang sống và làm việc</td>
                            <td>{{$user->address_working}}</td>
                            <td>{{$user->note_address_working}}</td>
                        </tr>
                        <tr>
                            <td>Tôn giáo của bạn</td>
                            <td>{{ optional($user->religion)->name}}</td>
                            <td>{{ $user->note_religion}}</td>
                        </tr>
                        <tr>
                            <td>Giấy tờ tùy thân</td>
                            <td>
                                @foreach($user->identificationImages($user->id)->get() as $item)
                                    <a style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#imageModal{{$item->id}}" data-bs-whatever="@mdo">
                                        <img src="{{$item->image_path}}" alt="{{$item->image_name}}" style="height: 100px;">
                                    </a>

                                    <div class="modal fade" id="imageModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ảnh</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <img src="{{$item->image_path}}" alt="{{$item->image_name}}" style="max-height: 50vh">
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </td>
                            <td>{{ $user->note_identification_images}}</td>
                        </tr>
                        <tr>
                            <td>Liên kết tài khoản facebook</td>
                            <td><a href="{{$user->facebook_link}}">{{$user->facebook_link}}</a></td>
                            <td></td>
                        </tr>

                        @foreach(\App\Models\TopicQuestionProfileDating::all() as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>
                                    <ul>
                                        @foreach($user->topicQuestionProfileDatingUser($user->id, $item->id) as $question)
                                            <li>
                                                {{ optional($question->questionProfileDating)->name}}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td></td>
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
