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
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Vai trò</th>
                            <th>Ngày tạo</th>
                            <th>Tổng hoa hồng</th>
                            <th class="text-center" style="width: 100px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $userItem)
                            <tr>
                                <td>{{$userItem->name}}</td>
                                <td>{{$userItem->email}}</td>
                                <td>{{$userItem->phone}}</td>
                                <td>
                                    @foreach($userItem->roles as $role)
                                        <span>{{$role->name}}</span>
                                    @endforeach
                                </td>
                                <td>{{$userItem->created_at}}</td>
                                <td>

                                    <a href="{{route('administrator.employees.detail' , ['id'=> $userItem->id,'start' => request()->query('start'), 'end' => request()->query('end')])}}"
                                       class="btn btn-outline-secondary btn-sm edit" title="View">
                                        <i class="ion ion-md-eye"></i>
                                    </a>

                                    <a href="{{route('administrator.employees.edit' , ['id'=> $userItem->id ])}}"
                                       class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
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
@endsection
