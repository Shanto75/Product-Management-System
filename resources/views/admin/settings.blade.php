@extends('admin.header-footer')
@section('admin_content')
    <div class="col-xl-9 col-md-8 mx-auto">

        <div class="card">
            <div class="card-header">
                <h2 class="card-title text-center">Settings Details</h2>
            </div>
            <div class="card-body">

                <!-- Form -->
                <form id="form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div id="imgdiv" class="row form-group">
                        <label for="logo" class="col-sm-3 col-form-label input-label">Logo</label>
                        <div class="col-sm-9">
                            <div class="d-flex align-items-center">
                                <label class="avatar avatar-xxl profile-cover-avatar m-0" for="logo">
                                    <img id="avatarImg" class="avatar-img" src="@isset($settings->logo ) {{ File::exists('images/settings/'.$settings->logo) ? asset('images/settings/'.$settings->logo) : '' }} @endisset" alt="Logo">
                                    <input type="file" id="logo" name="logo">
                                    <span class="avatar-edit">
                                        <i data-feather="edit-2" class="avatar-uploader-icon shadow-soft"></i>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="name" class="col-sm-3 col-form-label input-label">Application Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" value="@isset($settings->name ) {{ $settings->name }} @endisset">
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <label for="email" class="col-sm-3 col-form-label input-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email" value="@isset($settings->email ){{ $settings->email }}@endisset">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="phone" class="col-sm-3 col-form-label input-label">Phone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="phone" name="phone" value="@isset($settings->phone ){{ $settings->phone }}@endisset">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="optional_phone" class="col-sm-3 col-form-label input-label">Optional Phone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="optional_phone" name="optional_phone" value="@isset($settings->optional_phone ){{ $settings->optional_phone }}@endisset">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="address" class="col-sm-3 col-form-label input-label">Address</label>
                        <div class="col-sm-9">
                            <textarea rows="3" id="address" name="address" class="form-control" required>@isset($settings->address ){{ $settings->address }}@endisset</textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="about" class="col-sm-3 col-form-label input-label">About</label>
                        <div class="col-sm-9">
                            <textarea rows="3" id="about" name="about" class="form-control" required>@isset($settings->address ){{ $settings->about }}@endisset</textarea>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" form="form" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
                <!-- /Form -->

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
                url: "{{ url('/admin/settings') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    if (result.msg) {
                        toastr.success('Successfully Updated.', 'Success!!', {
                            timeOut: 2000
                        });
                        avatarImg.src = "@isset($settings->logo ) {{ File::exists('images/settings/'.$settings->logo) ? asset('images/settings/'.$settings->logo):''}}@endisset?t=" + new Date().getTime();
                    } else {
                        toastr.error('Failed to Update.', 'Failed!!', {
                            timeOut: 2000
                        });
                    }
                },
                error: function(result) {
                    toastr.error('Failed to Update.', 'Failed!!', {
                        timeOut: 2000
                    });
                }

            });
        });
    </script>
@endsection
