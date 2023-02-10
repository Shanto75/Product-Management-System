@extends('admin.header-footer')
@section('admin_content')
    <div class="row">
        <div class="col-sm-12">
            <h2 class="text-center"> <u>Product List</u></h2>
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
                    @if (session()->has('error'))
                        <div class="bg-danger alert alert-dismissible fade show" role="alert">
                            <h6 class="text-center text-white"><strong>{{ session()->get('error') }}</strong>
                            </h6>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="table" class="table table-center table-hover table-bordered table-sm">
                            <thead class="table-light text-center">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Seller</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex ">
                                                <img class="avatar-xl me-2"
                                                    src="{{ !empty($product->image) ? asset('images/product/' . $product->image) : '' }}"
                                                    alt="">
                                                <div class=" d-flex flex-column">
                                                    <span>{{ $product->product_name }} ({{ $product->quantity }}) ID: {{ $product->product_id }}</span>
                                                    <span>Details: {{ $product->details }}</span>
                                                    <span>Price Range: {{ $product->price_start.' - '.$product->price_end }} TK</span>
                                                    <span>
                                                        Status: <b class="text-{{ $product->status ? 'success' : 'danger' }}">{{ $product->status ? 'Active' : 'Inactive' }}</b>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex ">
                                                <img class="avatar-xl me-2"
                                                    src="{{ !empty($product->user->user_details->img) ? asset('images/user/' . $product->user->user_details->img) : '' }}"
                                                    alt="">
                                                <div class=" d-flex flex-column">
                                                    <span>{{ $product->user->first_name.' '.$product->user->last_name }} ID: {{ $product->user->user_id }}</span>
                                                    <span>Contact: {{ $product->user->phone }}</span>
                                                    <span>Email: {{ $product->user->email }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="">
                                            <a href="{{ url('/seller/edit-product/' . $product->id) }}"
                                                class="btn btn-info far fa-edit text-white"></a>
                                            <button onclick="deleteproduct(this.id, this.name)"
                                                name="{{ $product->product_name }}" id="{{ $product->id }}"
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

        function deleteproduct(id, name) {
            Swal.fire({
                title: 'Are you sure? You want to delete - ' + name,
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = `/seller/delete-product/${id}`
                }
            })
        }

    </script>
@endsection
