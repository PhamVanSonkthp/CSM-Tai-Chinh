@if(!isset($isEdit) || !$isEdit)
    <tr id="container_row_id_{{$item->id}}" data-url="{{route('administrator.lends.update', ['id' => $item->id])}}">
        @endif

        <td>{{$item->phone}}</td>
        <td>
            <select data-field="admin_id" class="note form-select">
                <option value="0">Chọn nhân viên</option>
                @foreach(\App\Models\User::where('is_admin', '!=' , 0)->get() as $userItem)
                    <option
                        value="{{$userItem->id}}" {{$item->admin_id == $userItem->id ? 'selected' : ''}}>{{$userItem->telegram_support}}</option>
                @endforeach
            </select>
        </td>
        <td>{{$item->name}}</td>
        <td>
                                    <span class="lend-status-{{$item->lend_status_id}}">
                                        {{ optional($item->lendStatus)->name}}
                                    </span>
        </td>
        <td>{{ $item->created_at }}</td>
        <td>
            @if($item->lend_status_id == 1)
                <a style="cursor: pointer;" onclick="onApprove({{$item->id}})"
                   class="m-3 lend-status-2 text-success">Duyệt</a>
                <a style="cursor: pointer;" onclick="onReject({{$item->id}})" class="m-3 lend-status-1 text-warning">Từ
                    chối</a>
            @elseif($item->lend_status_id == 2)
                <a style="cursor: pointer;" onclick="onApprove({{$item->id}})"
                   class="m-3 lend-status-2 text-success">Duyệt</a>
            @elseif($item->lend_status_id == 3)
                <a style="cursor: pointer;" onclick="onReject({{$item->id}})" class="m-3 lend-status-1 text-warning">Từ
                    chối</a>
            @endif
            <a style="cursor: pointer;" class="m-3 delete-status text-danger delete action_delete"
               data-url="{{route('administrator.lends.delete' , ['id'=> $item->id])}}"
               href="{{route('administrator.lends.delete', ['id' => $item->id])}}">Xóa</a>
            <a style="cursor: pointer;" class="m-3" href="{{route('administrator.lends.detail', ['id' => $item->id])}}">Xem
                chi tiết</a>
        </td>
        @if(!isset($isEdit) || !$isEdit)
    </tr>
@endif

