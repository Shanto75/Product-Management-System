@extends('seller.header-footer')
@section('seller_content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center"> <u>Add New Product</u></h4>
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
                    <form action="{{ url('/seller/add-product') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h5 class="card-title"> <u> Product Details</u></h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" name="product_name" class="form-control">
                                    @if ($errors->has('product_name'))
                                        <span class="text-danger">{{ $errors->first('product_name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Product Details</label>
                                    <textarea name="details" class="form-control" rows="5"></textarea>
                                    @if ($errors->has('details'))
                                        <span class="text-danger">{{ $errors->first('details') }}</span>
                                    @endif
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quantity (kg/ton)</label>
                                    <input type="text" name="quantity" class="form-control">
                                    @if ($errors->has('quantity'))
                                        <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Starting Price</label>
                                    <input type="number" name="price_start" class="form-control">
                                    @if ($errors->has('price_start'))
                                        <span class="text-danger">{{ $errors->first('price_start') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Ending Price</label>
                                    <input type="number" name="price_end" class="form-control">
                                    @if ($errors->has('price_end'))
                                        <span class="text-danger">{{ $errors->first('price_end') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <h5 class="card-title"><u>Other Details (Optional)</u></h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Production Start</label>
                                    <input type="date" name="production_start" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Production End</label>
                                    <input type="date" name="production_end" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Product Image (Max 2mb)</label>
                                    <input type="file" name="image" class="form-control">
                                    @if ($errors->has('image'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Total product produced</label>
                                    <input type="text" name="total_produced" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Production Cost</label>
                                    <input type="text" name="production_cost" class="form-control">
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
