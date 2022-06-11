@extends('administrator.layouts.master')

@include('administrator.lend.header')

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

                    <div class="col-md-3">
                        <label>Ngày tạo</label>
                        <span>
                            <input type="text" id="config-demo" class="form-control">
                        </span>
                    </div>

                    <div class="col-md-2">
                        <label>Giới tính</label>
                        <select id="select_gender" class="form-control select2_init" style="width: 100px;">
                            <option value="">Giới tính</option>
                            @foreach(\App\Models\GenderUser::all() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <p style="cursor: pointer;" onclick="viewBirthOfDay()">Có <span class="text-danger">{{\App\Models\User::whereMonth('date_of_birth',now()->month)->whereDay('date_of_birth',now()->day)->where('is_admin' , 0)->count()}}</span> khách hàng sinh nhật hôm nay</p>
                    </div>

                    <div class="col-md-2 text-end">
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
                            <th>Giới tính</th>
                            <th>Người giới thiệu</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->date_of_birth}}</td>
                                <td>{{ optional($item->gender)->name}}</td>
                                <td>{{ optional($item->presenter)->name}}</td>
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
            searchParams.set('gender', $('#select_gender').val())
            window.location.search = searchParams.toString()

        }

        function exportExcel(){
            window.location.href = "{{route('administrator.users.export')}}" + window.location.search
        }

    </script>
@endsection
