@extends('Admin.layouts.master')
@section('content')
    <div class="container-fluid">

        {{-- <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách users</h6>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tạo mới</a>
            </div>
            <div class="card-body">
                @if (session()->has('message'))
                    <div class="alert alert-success m-2">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger m-2">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Họ</th>
                                        <th>Tên</th>
                                        <th>Ngày sinh</th>
                                        <th>Ảnh đại diện</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Họ</th>
                                        <th>Tên</th>
                                        <th>Ngày sinh</th>
                                        <th>Ảnh đại diện</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Hành động</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($data as $user)

                                        <tr>
                                            <th>{{ $user->id }}</th>
                                            <th>{{ $user->last_name }}</th>
                                            <th>{{ $user->name }}</th>
                                            <th>{{ $user->birth_date }}</th>
                                            <th>
                                                <img width="100" src="{{ asset($user->image) }}" alt="{{ $user->image }}">
                                            </th>
                                            <th>{{ $user->phone }}</th>
                                            <th>{{ $user->email }}</th>
                                            <th>
                                                <a class="btn btn-warning"
                                                    href="{{ route('admin.users.update', $user->id) }}">
                                                    Update
                                                </a>
                                                <a class="btn btn-danger"
                                                    onclick="return confirm('Có chắc chắn xóa khônng!')"
                                                    href="{{ route('admin.users.delete', $user->id) }}">
                                                    Delete
                                                </a>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script src="{{ asset('/assets/admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/assets/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/assets/admin/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('/assets/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    {{-- <script src="/assets/admin/js/demo/datatables-demo.js"></script> --}}
@endsection
