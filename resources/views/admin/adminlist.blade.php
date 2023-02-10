@extends('admin.header-footer')
@section('admin_content')
    <div class="row">
        <div class="col-sm-12">

            <div class="card card-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-center table-hover ">
                            <thead class=" table-light ">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Created</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile.html" class="avatar avatar-sm me-2"><img
                                                        class="avatar-img rounded-circle"
                                                        src="{{ asset('images/' . $admin->img) }}" alt="User Image"></a>
                                                <p>{{ $admin->first_name . ' ' . $admin->last_name }}</p>
                                            </h2>
                                        </td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->phone }}</td>
                                        <td>{{ $admin->gender }}</td>
                                        <td>{{ $admin->address }}</td>
                                        <td>{{ $admin->created_at }}</td>
                                        {{-- <td><span class="badge badge-pill bg-success-light">Active</span></td> --}}
                                        <td class="text-right">
                                            <a href="edit-customer.html" class="btn btn-sm btn-white text-success me-2"><i
                                                    class="far fa-edit me-1"></i> Edit</a>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white text-danger me-2"><i
                                                    class="far fa-trash-alt me-1"></i>Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
