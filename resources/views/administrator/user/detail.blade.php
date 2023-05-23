<div class="row pb-4 pt-4">
    <div class="col-md-3">
        <img class="image_modal image_detail" src="{{ optional($item->userIdentityImage(3))->image_path}}" style="object-fit: cover;width: 100%;">
        <div class="text-center">
            <label>{{$item->phone}}</label>
        </div>
        <div class="text-center">
            <label>{{$item->name}}</label>
        </div>
    </div>

    <div class="col-md-5">
        <div class="d-flex">
            <div class="flex-1">
                <label>
                    Số CMND
                </label>
            </div>

            <div class="flex-1">
                <input name="identity_card_number" type="text" class="form-control " value="{{$item->identity_card_number}}">
            </div>

        </div>

        <div class="d-flex mt-3">
            <div class="flex-1">
                <label>
                    Địa chỉ
                </label>
            </div>

            <div class="flex-1">
                <input name="address" type="text" class="form-control " value="{{$item->address}}">
            </div>

        </div>

        <div class="d-flex mt-3">
            <div class="flex-1">
                <label>
                    Nghề nghiệp
                </label>
            </div>

            <div class="flex-1">
                <input name="work" type="text" class="form-control " value="{{$item->work}}">
            </div>

        </div>

        <div class="d-flex mt-3">
            <div class="flex-1">
                <label>
                    Tình trạng hôn nhân
                </label>
            </div>

            <div class="flex-1">
                <select name="married_status_id"
                        class="form-select @error('married_status_id') is-invalid @enderror">
                    @foreach(\App\Models\MarriedStatus::all() as $marriedStatusItem)
                        <option
                            value="{{$marriedStatusItem->id}}" {{$item->married_status_id == $marriedStatusItem->id ? 'selected' : ''}}>{{$marriedStatusItem->name}}</option>
                    @endforeach
                </select>
                @error('married_status_id')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

        </div>

        <div class="d-flex mt-3">
            <div class="flex-1">
                <label>
                    Học vấn
                </label>
            </div>

            <div class="flex-1">
                <select name="education_level_id"
                        class="form-select @error('education_level_id') is-invalid @enderror">
                    @foreach(\App\Models\EducationLevel::all() as $educationLevelItem)
                        <option
                            value="{{$educationLevelItem->id}}" {{$item->education_level_id == $educationLevelItem->id ? 'selected' : ''}}>{{$educationLevelItem->name}}</option>
                    @endforeach
                </select>
                @error('education_level_id')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        </div>

        <div class="d-flex mt-3">
            <div class="flex-1">
                <label>
                    Thu nhập
                </label>
            </div>

            <div class="flex-1">
                <select name="middle_income_id"
                        class="form-select @error('middle_income_id') is-invalid @enderror">
                    @foreach(\App\Models\MiddleIncome::all() as $middleIncomeItem)
                        <option
                            value="{{$middleIncomeItem->id}}" {{$item->middle_income_id == $middleIncomeItem->id ? 'selected' : ''}}>{{$middleIncomeItem->name}}</option>
                    @endforeach
                    @error('middle_income_id')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </select>
            </div>
        </div>


    </div>

    <div class="col-md-4">
        <div class="ps-3 pe-3 pb-3">
            <label>
                <strong>
                    Thông tin tài khoản thụ hưởng
                </strong>
            </label>
            <div class="d-flex mt-3">
                <div class="flex-1">
                    <label>
                        Ngân hàng
                    </label>
                </div>

                <div class="flex-1">
                    <select name="bank_id" class="form-select @error('bank_id') is-invalid @enderror">
                        @foreach(\App\Models\Bank::orderBy('name')->get() as $bankItem)
                            <option
                                value="{{$bankItem->id}}" {{$item->bank_id == $bankItem->id ? 'selected' : ''}}>{{$bankItem->name}}</option>
                        @endforeach
                    </select>
                    @error('bank_id')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex mt-3">
                <div class="flex-1">
                    <label>
                        Tên người thụ hưởng
                    </label>
                </div>

                <div class="flex-1">
                    <input name="bank_name" type="text"
                           class="form-control @error('bank_name') is-invalid @enderror"
                           value="{{$item->bank_name}}">
                    @error('bank_name')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex mt-3">
                <div class="flex-1">
                    <label>
                        Số tài khoản
                    </label>
                </div>

                <div class="flex-1">
                    <input name="bank_number" type="text"
                           class="form-control @error('bank_number') is-invalid @enderror"
                           value="{{$item->bank_number}}">
                    @error('bank_number')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <label class="w-100 mt-3">
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit" onclick="onSubmitUpdateUser()">Lưu thay đổi</button>
                </div>
            </label>
        </div>

    </div>
</div>
