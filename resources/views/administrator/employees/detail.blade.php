@extends('administrator.layouts.master')

@include('administrator.employees.header')

@section('css')

@endsection

@section('content')


    <div class="col-12">
        <div class="col-md-3">
            <label>Tổng kết ngày bán khóa học</label>
            <span>
                            <input type="text" id="config-demo" class="form-control">
                        </span>
        </div>
    </div>

    <div class="col-12 mt-3">

        <div class="card">

            <div class="card-header">
                Danh sách hóa đơn
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-editable table-nowrap align-middle table-edits">
                        <thead>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Khách hàng</th>
                            <th>Giá</th>
                            <th>Chi tiết</th>
                            <th>Ngày tạo</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoiceProducts as $item)
                            <tr>
                                <td>{{ $item->id}}</td>
                                <td>{{ optional($item->user)->name}}</td>
                                <td>${{ number_format($item->price,2)}}</td>
                                <td>
                                    <ul>
                                        <li>
                                            Khóa học: ${{($item->priceProduct($item->id))}}
                                        </li>
                                        <li>
                                            Combo: ${{($item->priceCombo($item->id))}}
                                        </li>
                                        <li>
                                            Trading: ${{($item->pricetrading($item->id))}}
                                        </li>
                                    </ul>
                                </td>

                                <td>{{ $item->created_at}}</td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

    <div>
        {{ $invoiceProducts->links('pagination::bootstrap-4') }}
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
