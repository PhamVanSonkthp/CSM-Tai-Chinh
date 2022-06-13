@extends('administrator.layouts.master')

@include('administrator.lend.header')

@section('css')
    <style>
        label{
            padding: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="col-lg-9">

        <div class="card">
            <div class="row">
                <div class="col-md-3">
                    <img src="">
                    <div class="text-center">
                        <label>{{$item->phone}}</label>
                    </div>
                    <div class="text-center">
                        <label>{{$item->name}}</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Số CMND
                            </label>
                        </div>

                        <div class="flex-1">
                            <label>
                                {{$item->identity_card_number}}
                            </label>
                        </div>

                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Địa chỉ
                            </label>
                        </div>

                        <div class="flex-1">
                            <label>
                                {{$item->address}}
                            </label>
                        </div>

                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Nghề nghiệp
                            </label>
                        </div>

                        <div class="flex-1">
                            <label>
                                {{$item->work}}
                            </label>
                        </div>

                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Tình trạng hôn nhân
                            </label>
                        </div>

                        <div class="flex-1">
                            <label>
                                {{ optional($item->marriedStatus)->name}}
                            </label>
                        </div>

                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Học vấn
                            </label>
                        </div>

                        <div class="flex-1">
                            <label>
                                {{ optional($item->educationLevel)->name}}
                            </label>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Thu nhập
                            </label>
                        </div>

                        <div class="flex-1">
                            <label>
                                {{ optional($item->middleIncome)->name}}
                            </label>
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

                    <form action="{{route('administrator.lend.update', ['id' => $item->id ])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">Xác minh khách hàng</button>
                        </div>
                    </form>


                </div>

                <div class="col-md-3">
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
                            <label>
                                {{ optional($item->bank)->name}}
                            </label>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Tên người thụ hưởng
                            </label>
                        </div>

                        <div class="flex-1">
                            <label>
                                {{$item->bank_name}}
                            </label>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="flex-1">
                            <label>
                                Số tài khoản
                            </label>
                        </div>

                        <div class="flex-1">
                            <label>
                                {{$item->bank_number}}
                            </label>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-3">
        <div class="card">

        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
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
                    <label>
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
                        {{$item->id}}
                    </label>
                </div>
            </div>

        </div>
    </div>

    <div class="col-lg-3">
        <div class="card">
            <div>
                <label>
                    Hiện không có yêu cầu
                </label>
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
                        0 VNĐ
                    </strong>
                </label>
            </div>

            <div class="d-flex">
                <div class="flex-1">
                    <label>
                        Trừ ví
                    </label>
                </div>

                <div class="flex-1">
                    <label>
                        Cộng ví
                    </label>
                </div>

            </div>

            <div>
                <label>
                    Lịch sử
                </label>

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

            if (url.searchParams.get("start")){
                options.startDate = getFormattedDate(new Date(url.searchParams.get("start")))
            }

            if (url.searchParams.get("end")){
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

        function viewBirthOfDay(){
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

            for(let i = 0 ; i < $params.length; i++){
                searchParams.set($params[i].name, $params[i].value)
            }

            searchButton(searchParams)
        }

        function search(ele) {
            if(event.key === 'Enter') {
                searchButton()
            }
        }

        function searchButton(searchParams) {
            if(!searchParams){
                searchParams = new URLSearchParams(window.location.search)
            }
            searchParams.set('search_query', $('#input_search').val())
            searchParams.set('lend_status_id_1', $('input[name="lend_status_id_1"]').is(':checked'))
            searchParams.set('lend_status_id_2', $('input[name="lend_status_id_2"]').is(':checked'))
            searchParams.set('lend_status_id_3', $('input[name="lend_status_id_3"]').is(':checked'))
            window.location.search = searchParams.toString()

        }

        function exportExcel(){
            window.location.href = "{{route('administrator.users.export')}}" + window.location.search
        }

    </script>
@endsection
