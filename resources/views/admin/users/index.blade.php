{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Admin Users')

@section('admin_content')
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Admin Users</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Admin Users</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Category Table Section -->
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title flex-grow-1 mb-0">All Admin Users</h3>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-success ms-3">
                                <i class="bi bi-plus-lg"></i> Create Admin Users
                            </a>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th style="width: 150px">Actions</th> <!-- New Actions column -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $key => $admin)
                                        <tr>
                                            <td>{{ $key + $admins->firstItem() }}</td>
                                            <td>{{ $admin->first_name }}</td>
                                            <td>{{ $admin->last_name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->phone }}</td>

                                            <td>
                                                <!-- Edit Button -->
                                                <a href="{{ route('admin.categories.edit', $admin->id) }}"
                                                    class="btn btn-sm btn-primary" title="Edit admin">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <!-- Delete Button -->
                                                <form action="{{ route('admin.categories.destroy', $admin->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        title="Delete Category"
                                                        onclick="return confirm('Are you sure you want to delete this admin?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <div class="float-end">
                                {!! $admins->links('pagination::bootstrap-5') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->

            </div>

        </div>
    </div>
@endsection
