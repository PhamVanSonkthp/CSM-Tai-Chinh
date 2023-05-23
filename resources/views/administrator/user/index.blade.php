@extends('administrator.layouts.master')

@include('administrator.user.header')

@section('css')

@endsection

@section('content')
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">

                <div class="row align-items-end">
                    <div class="col-md-3">
                        <div id="datatable_filter" class="dataTables_filter row" style="align-items: flex-end;">
                            <div class="col-9">
                                <label>Search:</label>
                                <input id="input_search" type="search" class="form-control form-control-sm"
                                       placeholder="Entering..." aria-controls="datatable" onkeydown="search(this)">
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="searchButton()">Tìm</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3" style="display: none">
                        <label>Ngày tạo</label>
                        <span>
                            <input type="text" id="config-demo" class="form-control">
                        </span>
                    </div>

                    <div class="col-md-2" style="display: none">
                        <label>Giới tính</label>
                        <select id="select_gender" class="form-control select2_init" style="width: 100px;">
                            <option value="">Giới tính</option>
                            @foreach(\App\Models\GenderUser::all() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2" style="display: none">
                        <p style="cursor: pointer;" onclick="viewBirthOfDay()">Có <span class="text-danger">{{\App\Models\User::whereMonth('date_of_birth',now()->month)->whereDay('date_of_birth',now()->day)->where('is_admin' , 0)->count()}}</span> khách hàng sinh nhật hôm nay</p>
                    </div>

                    <div class="col-md-2 text-end" style="display: none">
                        <a href="{{route('administrator.users.create')}}" class="btn btn-success float-end m-2">Add</a>
                        <button onclick="exportExcel()" class="btn btn-success float-end m-2">Export</button>
                    </div>
                </div>


                <div class="table-responsive">
                    <table class="table table-editable table-nowrap align-middle table-edits">
                        <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Số điện thoại</th>
                            <th>Ngày sinh</th>
                            <th>Trạng thái rút tiền</th>
                            <th>Trạng thái tài khoản</th>
                            <th style="width: 50px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr data-url="{{route('administrator.users.update' , ['id'=> $item->id])}}">
                                <td>{{$item->name}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->date_of_birth}}</td>
                                <td>
                                    <select data-field="payment_status_id" class="note form-select @error('payment_status_id') is-invalid @enderror">
                                        <option value="" disabled selected>Chọn</option>
                                        @foreach(\App\Models\PaymentStatus::orderBy('name')->get() as $PaymentStatusItem)
                                            <option value="{{$PaymentStatusItem->id}}" {{$item->payment_status_id == $PaymentStatusItem->id ? 'selected' : ''}}>{{$PaymentStatusItem->name}}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <select data-field="user_status_id" class="note form-select @error('user_status_id') is-invalid @enderror">
                                        <option value="" disabled selected>Chọn</option>
                                        @foreach(\App\Models\UserStatus::orderBy('name')->get() as $UserStatusItem)
                                            <option value="{{$UserStatusItem->id}}" {{$item->user_status_id == $UserStatusItem->id ? 'selected' : ''}}>{{$UserStatusItem->name}}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <a href="{{route('administrator.users.delete' , ['id'=> $item->id])}}"
                                       data-url="{{route('administrator.users.delete' , ['id'=> $item->id])}}"
                                       class="btn btn-danger btn-sm delete action_delete" title="Delete">
                                        <i class="mdi mdi-close"></i>
                                    </a>
                                    <a style="cursor: pointer;" class="m-3" data-bs-toggle="modal" data-bs-target="#editModal" onclick="onDetailUser({{$item->id}})">Xem
                                        chi tiết</a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div>
            {{ $items->links('pagination::bootstrap-4') }}
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Thông tin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal_detail">

                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>

        let user_id

        function onDetailUser(id) {
            user_id = id

            $.ajax({
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    id : user_id
                },
                url: "{{route('administrator.users.get')}}",
                success: function (response) {
                    $('#modal_detail').html(response.html)
                },
                error: function (err) {
                    console.log(response)
                },
            });

        }

        function onSubmitUpdateUser() {

            $.ajax({
                type: "PUT",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    id : user_id,
                    identity_card_number : $('input[name="identity_card_number"]').val(),
                    address : $('input[name="address"]').val(),
                    work : $('input[name="work"]').val(),
                    married_status_id : $('select[name="married_status_id"]').val(),
                    education_level_id : $('select[name="education_level_id"]').val(),
                    middle_income_id : $('select[name="middle_income_id"]').val(),
                    bank_id : $('select[name="bank_id"]').val(),
                    bank_name : $('input[name="bank_name"]').val(),
                    bank_number : $('input[name="bank_number"]').val(),
                },
                url: "{{route('administrator.users.update')}}",
                success: function (response) {
                    alert("Đã lưu")
                },
                error: function (err) {
                    console.log(response)
                },
            });

        }
    </script>

@endsection
