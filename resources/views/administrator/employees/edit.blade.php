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
                <label>Tên nhân viên ( Telegram )</label>
                <input type="text" name="telegram_support" class="form-control @error('telegram_support') is-invalid @enderror" value="{{$user->telegram_support}}">
                @error('telegram_support')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label>FB ID</label>
                <input type="text" name="fb_id" class="form-control @error('fb_id') is-invalid @enderror" value="{{$user->fb_id}}">
                @error('fb_id')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label>Giới hạn trong ngày</label>
                <input type="number" name="max_client_day" class="form-control @error('max_client_day') is-invalid @enderror" value="{{$user->max_client_day}}">
                @error('max_client_day')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label>Password</label>
                <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" >
                @error('password')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>

        </div>
    </form>

@endsection

@section('js')

@endsection
