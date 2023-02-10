@extends('admin.header-footer')
@section('admin_content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Add New Admin</h5>
                </div>
                <div class="card-body">
                    <!-- Form -->
                    <form id="form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row form-group">
                            <label for="first_name" class="col-sm-3 col-form-label input-label">First Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="first_name" name="first_name">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="last_name" class="col-sm-3 col-form-label input-label">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="last_name" name="last_name">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label for="email" class="col-sm-3 col-form-label input-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="phone" class="col-sm-3 col-form-label input-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>
                        </div>

                        {{-- <div class="row form-group">
                            <label for="gender" class="col-sm-3 col-form-label input-label">Gender</label>
                            <div class="col-sm-9">
                                <select id="gender" name="gender" class="select">
                                    <option selected disabled>--Select Gender--</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="img" class="col-sm-3 col-form-label input-label">Profile Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="img" name="img">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="address" class="col-sm-3 col-form-label input-label">Address</label>
                            <div class="col-sm-9">
                                <textarea rows="3" id="address" name="address" class="form-control"></textarea>
                            </div>
                        </div> --}}
                        <div class="row form-group">
                            <label for="password" class="col-sm-3 col-form-label input-label"> Password </label>
                            <div class="col-sm-9 pass-group">
                                <input type="password" class="form-control pass-input" id="password" name="password">
                                <span class="fas fa-eye toggle-password"></span>
                            </div>
                        </div>
                        <div class="text-end">
                            <button form="form" type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                    <!-- /Form -->
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#form').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: "POST",
                method: "POST",
                url: "{{ url('/admin/addAdmin') }}",
                // data: $('#form').serialize(),
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    console.log(result.msg);
                    if (result.msg) {
                        $('#form')['0'].reset();
                        toastr.success('Successfully Added.', 'Success!!', {
                            timeOut: 2000
                        });
                    } else {
                        toastr.error('Failed to Add.', 'Failed!!', {
                            timeOut: 2000
                        });
                    }
                    // setTimeout(function(){
                    //     location.href = '/admin/profile';
                    // }, 2000);
                },
                error: function(result) {
                    toastr.error('Failed to Add.', 'Failed!!', {
                        timeOut: 2000
                    });
                }
            });
        });
    </script>
@endsection
