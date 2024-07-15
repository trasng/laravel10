@extends('Admin.layouts.master')
@section('content')
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thêm mới user:</h6>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="last_name" class="form-label">Họ:</label>
                        <input type="text" class="form-control" id="last_name" placeholder="Nhập họ" value="{{ old('last_name') }}" name="last_name">
                        @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Tên:</label>
                        <input type="text" class="form-control" id="name" placeholder="Nhập tên" value="{{ old('name') }}" name="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="birth_date" class="form-label">Ngày sinh:</label>
                        <input type="date" class="form-control" id="birth_date" placeholder="Nhập ngày sinh" value="{{ old('birth_date') }}" name="birth_date">
                        @error('birth_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="image" class="form-label">Ảnh đại diện:</label>
                        <input type="file" class="form-control" id="image" value="{{ old('image') }}" name="image">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="phone" class="form-label">Số điện thoại:</label>
                        <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại" value="{{ old('phone') }}" name="phone">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Nhập email" value="{{ old('email') }}" name="email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
            </div>
        </div>

@endsection
