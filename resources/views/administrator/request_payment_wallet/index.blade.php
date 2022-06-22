@extends('administrator.layouts.master')

@include('administrator.request_payment_wallet.header')

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

                <div class="form-check form-check-inline mt-3">
                    <label class="form-check-label" for="inlineCheckbox1">Chờ duyệt</label>
                    <input name="status_request_payment_wallet_id_1" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" {{request('status_request_payment_wallet_id_1') == 'true' ? 'checked' : ''}}>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="inlineCheckbox2">Đã duyệt</label>
                    <input name="status_request_payment_wallet_id_2" class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2"{{request('status_request_payment_wallet_id_2') == 'true' ? 'checked' : ''}}>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="inlineCheckbox3">Từ chối</label>
                    <input name="status_request_payment_wallet_id_3" class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3"{{request('status_request_payment_wallet_id_3') == 'true' ? 'checked' : ''}}>
                </div>


                <div class="row mt-3">
                    <div class="col-md-3">
                        <div id="datatable_filter" class="dataTables_filter row" style="align-items: flex-end;">
                            <div class="col-9">
                                <input id="input_search" type="search" class="form-control form-control-sm"
                                       placeholder="Tên khách hàng" aria-controls="datatable" onkeydown="search(this)">
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="searchButton()">Tìm</button>
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
                            <th>Tên khách hàng</th>
                            <th>Số tiền</th>
                            <th>Tên ngân hàng</th>
                            <th>Số tài khoản</th>
                            <th>Người hưởng thụ</th>
                            <th>Trạng thái</th>
                            <th>Ghi chú</th>
                            <th>Khởi tạo lúc</th>
                            <th style="width: 50px;">Tùy chọn</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr data-url="{{route('administrator.request_payment_wallet.update', ['id' => $item->id])}}">
                                <td>
                                    {{ optional($item->user)->name}}
                                </td>
                                <td>{{number_format($item->money)}}</td>
                                <td>
                                    {{ optional($item->bank)->name}}
                                </td>
                                <td>
                                    {{ $item->bank_number}}
                                </td>
                                <td>
                                    {{ $item->bank_name}}
                                </td>
                                <td>
                                    <select data-field="status_request_payment_wallet_id" class="note form-select">
                                        <option value="0" selected disabled>---Trạng thái---</option>
                                        @foreach(\App\Models\StatusRequestPaymentWallet::all() as $StatusRequestPaymentWalletItem)
                                            <option value="{{$StatusRequestPaymentWalletItem->id}}" {{$item->status_request_payment_wallet_id == $StatusRequestPaymentWalletItem->id ? 'selected' : ''}}>{{$StatusRequestPaymentWalletItem->name}}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <input data-field="note" type="text" class="note form-control @error('note') is-invalid @enderror" value="{{ $item->note }}">
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a class="ms-3 delete-status text-danger delete action_delete" data-url="{{route('administrator.request_payment_wallet.delete' , ['id'=> $item->id])}}" href="{{route('administrator.request_payment_wallet.delete', ['id' => $item->id])}}">Xóa</a>
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
            searchParams.set('status_request_payment_wallet_id_1', $('input[name="status_request_payment_wallet_id_1"]').is(':checked'))
            searchParams.set('status_request_payment_wallet_id_2', $('input[name="status_request_payment_wallet_id_2"]').is(':checked'))
            searchParams.set('status_request_payment_wallet_id_3', $('input[name="status_request_payment_wallet_id_3"]').is(':checked'))
            window.location.search = searchParams.toString()

        }

        function exportExcel(){
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
@endsection
