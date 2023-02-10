@extends('admin.header-footer')
@section('admin_content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Basic information</h5>
                </div>
                {{-- <h4 id="msg"></h4> --}}
                <div class="card-body">
                    <!-- Form -->
                    <form id="form">
                        @csrf
                        <div class="row form-group">
                            <label for="name" class="col-sm-3 col-form-label input-label">Image</label>
                            <div class="col-sm-9">
                                <div class="d-flex align-items-center">
                                    <label class="avatar avatar-xxl profile-cover-avatar m-0" for="edit_img">
                                        <img id="avatarImg" class="avatar-img"
                                            src="{{ asset('/admin-assets/img/profile.png') }}" alt="Profile Image">
                                        <input type="file" id="edit_img">
                                        <span class="avatar-edit">
                                            <i data-feather="edit-2" class="avatar-uploader-icon shadow-soft"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="first_name" class="col-sm-3 col-form-label input-label">First Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    value="{{ $admins->first_name }}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="last_name" class="col-sm-3 col-form-label input-label">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    value="{{ $admins->last_name }}">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label for="email" class="col-sm-3 col-form-label input-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                    value="{{ $admins->email }}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="phone" class="col-sm-3 col-form-label input-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="+x(xxx)xxx-xx-xx" value="{{ $admins->phone }}">
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

    {{-- <script>
        $('#form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ url('/admin/updateProfile') }}",
                type: "POST",
                method: "POST",
                data: $('#form').serialize(),
                success: function(result) {
                    // $('#msg').html(result.msg);
                    if (result.msg) {
                        toastr.success('Updated Successfully.', 'Success!!', {
                            timeOut: 2000
                        });
                    } else {
                        toastr.error('Failed to Updated.', 'Failed!!', {
                            timeOut: 2000
                        });
                    }
                    setTimeout(function() {
                        location.href = '/admin/profile';
                    }, 2000);
                }
            });
        });
    </script> --}}
@endsection
