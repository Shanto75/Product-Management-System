@extends('admin.header-footer')
@section('admin_content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Add New User</h5>
                </div>
                @if (session()->has('success'))
                    <div class="bg-success alert alert-dismissible fade show" role="alert">
                        <h6 class="text-center text-white"><strong>{{ session()->get('success') }}</strong>
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{ url('/admin/addseller') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h5 class="card-title">Personal Information</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Type</label>
                                    <select name="type" class="select">
                                        <option selected disabled>--Select User Type--</option>
                                        <option value="seller">Seller</option>
                                        <option value="buyer">Buyer</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="d-block">Gender:</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="Male">
                                        <label class="form-check-label" for="gender_male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="Female">
                                        <label class="form-check-label" for="gender_female">Female</label>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <label>Personal Image</label>
                                    <input type="file" name="img" class="form-control">
                                </div> --}}
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <h5 class="card-title">Address</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Division</label>
                                    <input type="text" name="division" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>District</label>
                                    <input type="text" name="district" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Sub District/City Corporation</label>
                                    <input type="text" name="sdcc" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Union/Police Sation</label>
                                    <input type="text" name="ups" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ward</label>
                                    <input type="text" name="ward" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Village/Para/Mahalla</label>
                                    <input type="text" name="village" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input type="text" name="pc" class="form-control">
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
