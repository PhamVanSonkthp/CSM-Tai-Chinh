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

        .swiper-slide {
            text-align: center;
        }

        .card {
            height: 100%;
        }

        .image_detail {
            max-height: 350px;
        }

        .lend-status-3 {
            border-radius: 10px;
            border: 1px solid #ff0000;
            background: #ffe9e9;
            color: #ff0000;
            padding: 5px;
        }

    </style>

    <script>
        var swiper
    </script>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <div>
                                <strong>
                                    Tổng số khoản vay
                                </strong>
                            </div>
                            <div>
                                {{\App\Models\Lend::where('status',1)->count()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <div>
                                <strong>
                                    Khoản vay chờ duyệt
                                </strong>
                            </div>
                            <div>
                                {{\App\Models\Lend::where('status',1)->where('lend_status_id', 1)->count()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <div>
                                <strong>
                                    Khoản vay đã duyệt
                                </strong>
                            </div>
                            <div>
                                {{\App\Models\Lend::where('status',1)->where('lend_status_id', 2)->count()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <div>
                                <strong>
                                    Khoản vay từ chối
                                </strong>
                            </div>
                            <div>
                                {{\App\Models\Lend::where('status',1)->where('lend_status_id', 3)->count()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">

            <div class="card-header">
                <div>
                    <label>
                        Tùy chọn
                    </label>
                </div>

                @foreach(\App\Models\LendStatus::all() as $itemLendStatus)
                    <div class="form-check form-check-inline mt-3">
                        <label class="p-0 form-check-label" for="inlineCheckbox{{$itemLendStatus->id}}">{{$itemLendStatus->name}}</label>
                        <input name="lend_status_id_{{$itemLendStatus->id}}" class="form-check-input" type="checkbox" id="inlineCheckbox{{$itemLendStatus->id}}"
                                {{request('lend_status_id_' . $itemLendStatus->id) == 'true' ? 'checked' : ''}}>
                    </div>
                @endforeach


                <div class="row mt-3">
                    <div class="col-md-3">
                        <div id="datatable_filter" class="dataTables_filter row" style="align-items: flex-end;">
                            <div class="col-9">
                                <input id="input_search" type="search" class="form-control form-control-sm"
                                       placeholder="SĐT, tên mã HĐ" aria-controls="datatable"
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
                    <table class="table table-editable table-nowrap align-middle table-edits table-bordered">
                        <thead>
                        <tr>
                            <th>Mã HĐ</th>
                            <th>Họ & Tên</th>
                            <th>Số điện thoại</th>
                            <th>Số tiền vay</th>
                            <th>Số tháng</th>
                            <th>Chữ ký</th>
                            <th>Trạng thái</th>
                            <th>Thời gian</th>
                            <th style="width: 50px;">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $index =>  $item)
                            @include('administrator.lend.row' , ['item' => $item,'index' => $index])
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
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Thông tin hồ sơ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal_detail">

                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')

    <!-- Jquery JS -->
    {{--    <script type="text/javascript" src="./jquery.min.js"></script>--}}
    {{--    <!-- Script Bootstrap -->--}}
    {{--    <script type="text/javascript" src="./bootstrap.bundle.min.js"></script>--}}
    <!-- Swiper JS -->
    <script type="text/javascript" src="{{asset('vendor/swiper/swiper-bundle.min.js')}}"></script>

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

        function onDetail(id) {
            $.ajax({
                type: 'GET',
                url: "{{route('administrator.lends.get')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                },
                success: function (response) {
                    console.log(response)
                    $('#modal_detail').html(response.html)

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

                },
                error: function (err) {
                    console.log(err)
                },
            })
        }
    </script>
@endsection
