@extends('buyer.header-footer')
@section('buyer_content')
    <div class="row">
        <div class="col-sm-12">
            <h2 class="text-center"> <u> My Bidded Product List</u></h2>
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

            <a class="btn btn-primary mx-4 mb-4 float-end p-2" href="{{ url('buyer/buy-product') }}"> <i
                    class="fa fa-money-bill-wave text-white"></i> Bid Product</a>
        </div>
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table id="table" class="table table-center table-hover table-bordered table-sm">
                            <thead class="table-light text-center">
                                <tr>
                                    <th class="text-center">S.No.</th>
                                    <th class="text-center">Bided Product Details</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bid_lists as $bid_list)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>
                                            <div class="d-flex align-items-center ">
                                                {{-- <img class="avatar-sm me-2"
                                                    src="{{ !empty($product->image) ? asset('images/product/' . $product->image) : '' }}"
                                                    alt=""> --}}
                                                <div class=" d-flex flex-column text-wrap text-left">
                                                    <span>{{ $bid_list->bid->product_name }} ({{ $bid_list->bid->quantity }})</span>
                                                    <span>Price range: {{ $bid_list->bid->price_start .' - '. $bid_list->bid->price_end }} TK</span>
                                                    <span>Bid Started: {{ $bid_list->bid->bid_start }}, End: {{ $bid_list->bid->bid_end }} </span>
                                                    <span>Bided Amount: {{ $bid_list->bid_amount }} Tk</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="">
                                            {{-- <button class="btn btn-warning far fa-eye"></button> --}}
                                            <button onclick="editbid(this.id, this.name)" id="{{ $bid_list->id }}" name="{{ $bid_list->bid->product_name }}"
                                                class="btn btn-info far fa-edit text-white"></button>
                                            <button onclick="deletebid(this.id)" id="{{ $bid_list->id }}"
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

    {{-- Edit bid product --}}
    <div class="modal fade" id="bid" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form" method="post">
                    @csrf
                    <div class="modal-body mx-auto overflow-auto">
                        <h5 class="modal-title text-center mb-4" id="exampleModalLabel">Update Bid Amount for <span id="bidProductName"></span></h4>
                        <input type="hidden" name="bidId" id="bidId">
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-info text-white"> Enter Amount </span>
                            <input type="number" name="bid_amount" id="bid-amount" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary float-end">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        
        function deletebid(id) {
            Swal.fire({
                title: 'Are you sure? You want to delete.',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = `/buyer/delete-my-bid/${id}`;
                }
            })
        }

        function editbid(id, name) {
            document.getElementById('bidProductName').innerText = name;
            bidId.value = id;
            $('#bid').modal('toggle');
        }

        $('#form').on('submit', function(e) {
            $('#bid').modal('toggle');
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: "POST",
                method: "POST",
                url: '/buyer/edit-my-bid',
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    if (result.msg) {
                        // console.log(result);
                        toastr.success(result.msg, 'Success!!', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(result) {
                    toastr.error('Failed to set the bidding.', 'Failed!!', {
                        timeOut: 5000
                    });
                }

            });
        });

    </script>
@endsection
