@extends('admin.header-footer')
@section('admin_content')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="text-center"> <u>{{$type}} List</u></h1>
            <a class="btn btn-primary mx-4 mb-4 float-end" href="{{ url('admin/adduser') }}">Add New user</a>
        </div>
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="bg-success alert alert-dismissible fade show" role="alert">
                            <h6 class="text-center text-white"><strong>{{ session()->get('success') }}</strong>
                            </h6>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="table" class="table table-center table-hover table-bordered ">
                            <thead class=" table-light ">
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>User ID</th>
                                    <th>Contacts</th>
                                    {{-- <th>Status</th> --}}
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $i }}</td>@php $i=$i+1 @endphp
                                        <td>
                                            <h2 class="table-avatar">
                                                <div class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle"
                                                        src="{{ !empty($user->user_details->img) ? asset('images/user/' . $user->user_details->img) : '' }}"
                                                        alt=""></div>
                                                <p>{{ $user->first_name . ' ' . $user->last_name }}</p>
                                            </h2>
                                        </td>
                                        <td>{{ $user->user_id }}</td>
                                        <td>Phone: {{ $user->phone }} <br> Email: {{ $user->email }}</td>
                                        {{-- <td class="text-wrap">
                                            {{ 'Division: ' .
                                                $user->user_details->division .
                                                ', District: ' .
                                                $user->user_details->division .
                                                ', Thana/Upazila: ' .
                                                $user->user_details->thana_upazila .
                                                ', Detail Address: ' .
                                                $user->user_details->address }}
                                        </td> --}}
                                        {{-- <td>{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td> --}}
                                        <td class="">
                                            <a href="{{ url('/admin/userprofile/' . $user->id) }}"
                                                class="btn btn-warning far fa-eye"></a>
                                            <a href="{{ url('/admin/edituser/' . $user->id) }}"
                                                class="btn btn-info far fa-edit text-white"></a>
                                            <button data-name="{{ $user->first_name . ' ' . $user->last_name }}"
                                                id="{{ $user->id }}"
                                                class="btn btn-danger far fa-trash-alt delete"></button>
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

    <script>
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                id = e.target.id;
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You want to delete ' + e.target.getAttribute('data-name'),
                    // text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Swal.fire(
                        //     'Deleted!',
                        //     'Your file has been deleted.',
                        //     'success',
                        // )
                        window.location = `/admin/deleteuser/${id}`
                    }
                })
            })
        })
    </script>
@endsection
