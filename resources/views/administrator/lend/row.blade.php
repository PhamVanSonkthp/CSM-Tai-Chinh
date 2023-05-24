@if(!isset($isEdit) || !$isEdit)
    <tr id="container_row_id_{{$item->id}}" data-url="{{route('administrator.lends.update', ['id' => $item->id])}}">
        @endif
        <td>{{$item->id}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->phone}}</td>
        <td>{{number_format($item->lend_money)}} VNĐ</td>
        <td>{{number_format($item->interval)}}</td>
{{--        <td>--}}
{{--            <select data-field="admin_id" class="note form-select">--}}
{{--                <option value="0">Chọn nhân viên</option>--}}
{{--                @foreach(\App\Models\User::where('is_admin', '!=' , 0)->get() as $userItem)--}}
{{--                    <option--}}
{{--                        value="{{$userItem->id}}" {{$item->admin_id == $userItem->id ? 'selected' : ''}}>{{$userItem->telegram_support}}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </td>--}}
        <td>
            <img style="width: 130px;" src="{{$item->sign_image_path}}">
        </td>
        <td>
                                    <span class="lend-status-{{$item->lend_status_id}}">
                                        {{ optional($item->lendStatus)->name}}
                                    </span>
        </td>
        <td>{{ $item->created_at }}</td>
        <td>
            <a href="{{route('administrator.lends.detail' , ['id' => $item->id])}}" style="cursor: pointer;"
               class="ms-2 text-primary"><i class="fa-solid fa-pen" title="Chỉnh sửa"></i></a>

            @if($item->lend_status_id == 1)
                <a title="Duyệt" style="cursor: pointer;" onclick="onApprove({{$item->id}})"
                   class="ms-2 text-success"><i class="fa-regular fa-circle-check"></i></a>
                <a title="Từ chối" style="cursor: pointer;" onclick="onReject({{$item->id}})" class="ms-2 text-warning"><i class="fa-solid fa-xmark"></i></a>
            @endif
            <a title="Chi tiết" style="cursor: pointer;" class="ms-2" data-bs-toggle="modal" data-bs-target="#detailModal" onclick="onDetail({{$item->id}})"><i class="fa-regular fa-eye"></i></a>
        </td>
        @if(!isset($isEdit) || !$isEdit)
    </tr>
@endif

