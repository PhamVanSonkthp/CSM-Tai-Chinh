@extends('administrator.layouts.master')

@include('administrator.employees.header')

@section('css')

@endsection

@section('content')

    <form action="{{route('administrator.employees.update', ['id'=> $user->id]) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="col-md-6">

            <div class="form-group">
                <label>Tên</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên" value="{{$user->name}}">
                @error('name')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label>Email</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Nhập email" value="{{$user->email}}">
                @error('email')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label>Password</label>
                <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Nhập mật khẩu">
                @error('password')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label>Chọn vai trò</label>
                <select name="role_id[]" class="form-control select2_init" multiple>
                    <option value=""></option>
                    @foreach($roles as $roleItem)
                        <option
                            {{$rolesOfUser->contains($roleItem->id) ? 'selected' : ''}}
                            value="{{$roleItem->id}}">{{$roleItem->name}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>

        </div>
    </form>

@endsection

@section('js')

@endsection
