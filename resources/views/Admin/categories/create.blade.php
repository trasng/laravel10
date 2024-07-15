@extends('Admin.layouts.master')
@section('content')
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thêm mới category:</h6>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Tên danh mục:</label>
                        <input type="text" class="form-control" id="name" value="{{ old('name') }}" placeholder="Enter name" name="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Ảnh danh mục:</label>
                        <input type="file" class="form-control" id="image" placeholder="Choose image" value="{{ old('image') }}" name="image">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
            </div>
        </div>

@endsection
