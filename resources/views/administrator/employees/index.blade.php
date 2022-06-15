@extends('administrator.layouts.master')

@include('administrator.employees.header')

@section('css')

@endsection

@section('content')
    <div class="col-12">

        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-editable table-nowrap align-middle table-edits">
                        <thead>
                        <tr>
                            <th>FB ID</th>
                            <th>Tên nhân viên</th>
                            <th>Trạng thái</th>
                            <th>Số khách hàng đã qua FB ID</th>
                            <th>Tổng số khách hàng được hệ thống phân chọn</th>
                            <th>Giới hạn trong ngày</th>
                            <th class="text-center" style="width: 50px;">Tùy chọn</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $userItem)
                            <tr data-url="{{route('administrator.employees.update' , ['id'=> $userItem->id])}}">
                                <td>{{$userItem->fb_id}}</td>
                                <td>
                                    <input data-field="telegram_support" type="text"
                                           class="note @error('telegram_support') is-invalid @enderror"
                                           value="{{$userItem->telegram_support}}">
                                </td>
                                <td>{{ optional($userItem->status)->name}}</td>
                                <td>
                                    {{$userItem->clients->count()}} khách
                                </td>
                                <td>
                                    {{$userItem->clients->count()}} khách
                                </td>
                                <td><input data-field="max_client_day" type="text"
                                           class="note @error('max_client_day') is-invalid @enderror"
                                           value="{{$userItem->max_client_day}}"></td>
                                <td>
                                    <a href="{{route('administrator.employees.updateStatus' , ['id'=> $userItem->id ])}}"
                                       class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                        @if($userItem->user_status_id == 1)
                                            Khóa
                                        @else
                                            Mở khóa
                                        @endif
                                    </a>

                                    <a href="{{route('administrator.employees.delete' , ['id'=> $userItem->id])}}"
                                       data-url="{{route('administrator.employees.delete' , ['id'=> $userItem->id])}}"
                                       class="btn btn-danger btn-sm delete action_delete" title="Delete">
                                        <i class="mdi mdi-close"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

    <div class="col-md-12">
        {{ $users->links('pagination::bootstrap-4') }}
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

            if (url.searchParams.get("start")){
                options.startDate = getFormattedDate(new Date(url.searchParams.get("start")))
            }else{
                options.startDate = getFormattedDate(new Date("{{date('Y-m-01')}}"))
            }

            if (url.searchParams.get("end")){
                options.endDate = getFormattedDate(new Date(url.searchParams.get("end")))
            }else{
                options.endDate = getFormattedDate(new Date("{{ date("Y-m-t", strtotime(date("Y-m-d"))) }}"))
                //options.endDate = getFormattedDate("")
            }

            $('#config-demo').daterangepicker(options, function (start, end, label) {
                addUrlParameterObjects([{name: "start", value: start.format('YYYY-MM-DD')}, {
                    name: "end",
                    value: end.format('YYYY-MM-DD')
                }])
            });
        }

        updateConfig()

    </script>

    <script>
        $('.note').on('change', function () {

            const value = this.value
            const field = $(this).data('field')
            const urlRequest = $(this).parent().parent().data('url')

            $.ajax({
                type: 'PUT',
                url: urlRequest,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    [field]: value,
                },
                success: function (response) {
                    console.log(response)
                },
                error: function (err) {
                    console.log(err)
                },
            })
        })
    </script>

@endsection
