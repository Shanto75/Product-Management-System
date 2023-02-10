@extends('seller.header-footer')
@section('seller_content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card pt-5 mt-5">
                <div class="text-center ">
                    <label class="avatar avatar-xxl profile-cover-avatar bg-light" for="avatar_upload">
                        <img class="avatar-img" src="{{ asset('images/user/' . $user->user_details->img) }}" alt="">
                    </label>
                    <h2>{{ $user->first_name . ' ' . $user->last_name }}</h2>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <i class="far fa-user-circle"></i> <span>User Type: {{ $user->type }}</span>
                        </li>
                        <li class="list-inline-item">
                            <i class="fas fa-map-marker-alt"></i> Address: {{ $user->user_details->division }}
                        </li>
                    </ul>
                </div>

                <div class="col-lg-12">
                    <div class="d-flex justify-content-end px-3">
                        <a class=" btn btn-primary text-white" href="{{ url('/seller/edit-profile') }}"> <i
                                class="far fa-edit"></i> Edit Profile</a>
                    </div>
                    <hr>

                    <div class="card-body">
                        <h4 class="text-center"><u> Profile Information </u></h4>
                        <ul>
                            <li>
                                <b>Name:</b> {{ $user->first_name . ' ' . $user->last_name }}
                            </li>
                            <li>
                                <b>User Type:</b> {{ $user->type }}
                            </li>
                            <li>
                                <b>User ID:</b> {{ $user->user_id }}
                            </li>
                            <li>
                                <b>Email Address:</b> {{ $user->email }}
                            </li>
                            <li>
                                <b>Phone:</b> {{ $user->phone }}
                            </li>
                            <li>
                                <b>Account Status:</b> {{ $user->status ? 'Active' : 'Inactive' }}
                            </li>
                            <li>
                                <b>Gender:</b> {{ $user->user_details->gender }}
                            </li>
                            <li>
                                <b>Address:</b>
                                Division: {{ $user->user_details->division }}, District:
                                {{ $user->user_details->district }}
                                , Thana/Upazila: {{ $user->user_details->thana_upazila }}
                                , Detail Address: {{ $user->user_details->address }}
                            </li>
                            <li>
                                <b>Joined:</b> {{ date('d/m/Y H:i:s', strtotime($user->created_at)) }}
                            </li>
                            <li>
                                <b>Profile Last Updated:</b>
                                {{ date('d/m/Y H:i:s', strtotime($user->updated_at)) }}
                            </li>

                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
