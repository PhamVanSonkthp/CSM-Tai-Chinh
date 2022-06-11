<div>
    <div class="text-center">
        <p>Kết quả đang hiển thị:</p>
        <p>{{count($users)}}</p>

        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="searchButton()">Tìm kiếm</button>
    </div>

    <div class="mt-3">
        <select name="package_service_id" class="form-control select2_init" data-placeholder="Chọn gói dịch vụ">
            <option value="">Chọn gói dịch vụ</option>
            @foreach(\App\Models\PackageService::all() as $item)
                <option value="{{$item->id}}" {{request('package_service_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="border-search mt-3">
        <p>Khoảng thời gian trả kết</p>
        <div>
            <label>Từ ngày</label>
            <span>
                    <input name="start" type="date" class="form-control" value="{{request('start')}}">
                </span>

            <label>Đến ngày</label>
            <span>
                    <input name="end" type="date" class="form-control" value="{{request('end')}}">
                </span>

        </div>
    </div>

    <div class="border-search mt-3">
        <p>Tìm theo hồ sơ</p>
        <div>
            <label>Tên hiển thị trên App</label>
            <input name="display_name" type="text" class="form-control" value="{{request('display_name')}}">
        </div>

        <div>
            <label>Số điện thoại</label>
            <input name="phone" type="text" class="form-control" value="{{request('phone')}}">
        </div>

        <div>
            <label>Quê</label>
            <select name="address_born_id" class="form-control select2_init">
                <option value=""></option>
                @foreach(\App\Models\AddressBornUser::all() as $item)
                    <option value="{{$item->id}}" {{request('address_born_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Nơi sống và làm việc</label>
            <input name="address_working" type="text" class="form-control" value="{{request('address_working')}}">
        </div>

        <div>
            <label>Giới tính</label>
            <select name="gender_id" class="form-control select2_init" data-placeholder="Chọn giới tính">
                <option value="">Giới tính</option>
                @foreach(\App\Models\GenderUser::all() as $item)
                    <option value="{{$item->id}}" {{request('gender_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Tình trạng hôn nhân</label>
            <select class="form-control select2_init" data-placeholder="Chọn giới tính">
                <option value=""></option>
                @foreach(\App\Models\GenderUser::all() as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Năm sinh</label>
            <input name="date_of_birth" type="text" class="form-control" value="{{request('date_of_birth')}}">
        </div>
    </div>

    <div class="border-search mt-3 mb-3">
        <p>Tìm theo hiệu quả</p>
        <div>
            <label>Số pair có</label>
            <span>
                    <input name="number_pair" type="number" class="form-control" value="{{request('number_pair')}}">
                </span>

            <label>Số Date đồng ý</label>
            <span>
                    <input name="number_date_accept" type="number" class="form-control" value="{{request('number_date_accept')}}">
                </span>

            <label>Số Date đã thực hiện</label>
            <span>
                    <input name="number_date" type="number" class="form-control" value="{{request('number_date')}}">
                </span>

            <div class="mt-3 text-center">
                <div class="form-check">
                    <label class="form-check-label" for="flexCheckChecked">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        Thi đỗ (Lover)
                    </label>
                </div>

            </div>
        </div>
    </div>
</div>


<script>
    function searchButton(searchParams) {
        if(!searchParams){
            searchParams = new URLSearchParams(window.location.search)
        }

        searchParams.set('display_name', $('input[name="display_name"]').val())
        searchParams.set('phone', $('input[name="phone"]').val())
        searchParams.set('address_born_id', $('select[name="address_born_id"]').val())
        searchParams.set('address_working', $('input[name="address_working"]').val())
        searchParams.set('gender_id', $('select[name="gender_id"]').val())
        searchParams.set('package_service_id', $('select[name="package_service_id"]').val())
        // searchParams.set('gender_id', $('select[name="gender_id"]').val())
        searchParams.set('date_of_birth', $('input[name="date_of_birth"]').val())
        searchParams.set('start', $('input[name="start"]').val())
        searchParams.set('end', $('input[name="end"]').val())
        searchParams.set('number_pair', $('input[name="number_pair"]').val())
        searchParams.set('number_date_accept', $('input[name="number_date_accept"]').val())
        searchParams.set('number_date', $('input[name="number_date"]').val())
        window.location.search = searchParams.toString()
    }
</script>
