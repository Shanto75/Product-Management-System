@extends('admin.header-footer')
@section('admin_content')
    <div class="card row mt-5">
        <div class="col-lg-12 py-5">

            <div class="text-center mb-5">
                <label class="avatar avatar-xxl profile-cover-avatar bg-light" for="avatar_upload">
                    <img class="avatar-img" src="{{ asset('images/user/' . $admins->user_details->img) }}" alt="">
                </label>
                <h2>{{ $admins->first_name . ' ' . $admins->last_name }}</h2>
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <i class="far fa-building"></i> <span>User Type: {{ $admins->type }}</span>
                    </li>
                    <li class="list-inline-item">
                        <i class="fas fa-map-marker-alt"></i> Address: {{ $admins->user_details->division }}
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-lg-12">

                    <div class="">
                        <div class="card-header">
                            <h5 class="card-title d-flex justify-content-between">
                                <span>Profile Information</span>
                                <a class="btn btn-primary" href="edituser/{{$admins->id}}">Edit Profile</a>
                            </h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    Name: {{ $admins->first_name . ' ' . $admins->last_name }}
                                </li>
                                <li>
                                    Email Address: {{ $admins->email }}
                                </li>
                                <li>
                                    Phone: {{ $admins->phone }}
                                </li>
                                <li>
                                    Gender: {{ $admins->user_details->gender }}
                                </li>
                                <li>
                                    Address: Division: {{ $admins->user_details->division }}, District:
                                    {{ $admins->user_details->district }}
                                    , Thana/Upazila: {{ $admins->user_details->thana_upazila }}
                                    , Detail Address:{{ $admins->user_details->address }}
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
