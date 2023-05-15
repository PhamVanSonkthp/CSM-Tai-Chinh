@extends('administrator.layouts.master')

@include('administrator.lend.header')

@section('css')

@endsection

@section('content')
    <div class="col-md-12">

        <div class="card">

            <div class="card-header">
                <div>
                    <label>
                        Tùy chọn
                    </label>
                </div>

                @foreach(\App\Models\LendStatus::all() as $itemLendStatus)
                    <div class="form-check form-check-inline mt-3">
                        <label class="form-check-label" for="inlineCheckbox{{$itemLendStatus->id}}">{{$itemLendStatus->name}}</label>
                        <input name="lend_status_id_{{$itemLendStatus->id}}" class="form-check-input" type="checkbox" id="inlineCheckbox{{$itemLendStatus->id}}"
                                {{request('lend_status_id_' . $itemLendStatus->id) == 'true' ? 'checked' : ''}}>
                    </div>
                @endforeach


                <div class="row mt-3">
                    <div class="col-md-3">
                        <div id="datatable_filter" class="dataTables_filter row" style="align-items: flex-end;">
                            <div class="col-9">
                                <input id="input_search" type="search" class="form-control form-control-sm"
                                       placeholder="Số điện thoại hoặc CMND" aria-controls="datatable"
                                       onkeydown="search(this)">
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-primary waves-effect waves-light"
                                        onclick="searchButton()">Tìm
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <th style="width: 50px;">Tùy chọn</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            @include('administrator.lend.row' , ['item' => $item])
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

    <script>

        function onApprove(id) {

            $.ajax({
                type: 'PUT',
                url: "{{route('administrator.lends.approve')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                },
                success: function (response) {

                    console.log(response)
                    $('#container_row_id_' + id).html(response.data_html)
                },
                error: function (err) {
                    console.log(err)
                },
            })
        }

        function onReject(id) {
            $.ajax({
                type: 'PUT',
                url: "{{route('administrator.lends.reject')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                },
                success: function (response) {
                    $('#container_row_id_' + id).html(response.data_html)
                },
                error: function (err) {
                    console.log(err)
                },
            })
        }
    </script>
@endsection
