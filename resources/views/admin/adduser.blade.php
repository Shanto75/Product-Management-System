@extends('admin.header-footer')
@section('admin_content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-center">User Registration</h5>
                </div>
                @if (session()->has('success'))
                    <div class="bg-success alert alert-dismissible fade show" role="alert">
                        <h6 class="text-center text-white"><strong>{{ session()->get('success') }}</strong>
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="bg-danger alert alert-dismissible fade show" role="alert">
                        <h6 class="text-center text-white"><strong>{{ session()->get('error') }}</strong>
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{ url('/admin/adduser') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h5 class="card-title">Personal Details (Required)</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Type</label>
                                    <select name="type" class="select">
                                        <option selected disabled>--Select User Type--</option>
                                        <option value="admin">Admin</option>
                                        <option value="seller">Seller</option>
                                        <option value="buyer">Buyer</option>
                                        <option value="rider">Rider</option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="text-danger">{{ $errors->first('type') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" class="form-control">
                                    @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" class="form-control">
                                    @if ($errors->has('last_name'))
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="number" name="phone" class="form-control">
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Optional Contact</label>
                                    <input type="number" name="optional_phone" class="form-control">
                                    @if ($errors->has('optional_phone'))
                                        <span class="text-danger">{{ $errors->first('optional_phone') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Password (Min 6 - Max 12)</label>
                                    <input type="password" name="password" class="form-control">
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <h5 class="card-title">Other Details (Optional)</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-block">Gender</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="Male">
                                        <label class="form-check-label" for="gender_male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="Female">
                                        <label class="form-check-label" for="gender_female">Female</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Personal Image</label>
                                    <input type="file" name="img" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Division</label>
                                    <input type="text" name="division" class="form-control">
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>District</label>
                                    <input type="text" name="district" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Thana/Upazila</label>
                                    <input type="text" name="thana_upazila" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Detail Address</label>
                                    <input type="text" name="address" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
