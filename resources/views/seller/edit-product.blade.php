@extends('seller.header-footer')
@section('seller_content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center"> <u>Edit Product</u></h4>
                    <div class=" d-flex justify-content-between pt-4 ">
                        <a class="btn btn-primary" href="{{ URL::previous() }}"> <i class="fa fa-chevron-left"></i> Back</a>
                        <a class="btn btn-primary" href="{{ url('/seller/view-product/' . $product->id) }}"> <i class="fa fa-eye"></i> Details</a>
                    </div>
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
                    <form action="{{ url('/seller/update-product/'.$product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h5 class="card-title"> <u># Product Details</u></h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" name="product_name" value="{{$product->product_name}}" class="form-control">
                                    @if ($errors->has('product_name'))
                                        <span class="text-danger">{{ $errors->first('product_name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Product Details</label>
                                    <textarea name="details" class="form-control" rows="5">{{$product->details}}</textarea>
                                    @if ($errors->has('details'))
                                        <span class="text-danger">{{ $errors->first('details') }}</span>
                                    @endif
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quantity (kg/ton)</label>
                                    <input type="text" name="quantity" value="{{$product->quantity}}" class="form-control">
                                    @if ($errors->has('quantity'))
                                        <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Starting Price</label>
                                    <input type="number" name="price_start" value="{{$product->price_start}}" class="form-control">
                                    @if ($errors->has('price_start'))
                                        <span class="text-danger">{{ $errors->first('price_start') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Ending Price</label>
                                    <input type="number" name="price_end" value="{{$product->price_end}}" class="form-control">
                                    @if ($errors->has('price_end'))
                                        <span class="text-danger">{{ $errors->first('price_end') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <h5 class="card-title"><u># Other Details</u></h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Status</label>
                                    <select name="status" class="select">
                                        <option {{ $product->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $product->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="mb-4"> 
                                        <p>Current Image:</p>
                                        <img style="max-width: 10rem;" src="{{ File::exists('images/product/' . $product->image) ? asset('images/product/' . $product->image) : '' }}"
                                            alt="No image">
                                    </div>
                                    <label>#Leave the Image field blank if you do not want to change.</label><br>
                                    <label>Update Product Image (Max 2mb)</label>
                                    <input type="file" name="image" class="form-control">
                                    @if ($errors->has('image'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Production Start</label>
                                    <input type="date" name="production_start" value="{{$product->production_start}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Production End</label>
                                    <input type="date" name="production_end" value="{{$product->production_end}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Total product produced</label>
                                    <input type="text" name="total_produced" value="{{$product->total_produced}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Production Cost</label>
                                    <input type="text" name="production_cost" value="{{$product->production_cost}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
