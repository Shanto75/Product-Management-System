@extends('seller.header-footer')
@section('seller_content')
    <div class="row">
        
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-1">
                            <i class="fas fa-users"></i>
                        </span>
                        <div class="dash-count">
                            <div class="dash-title">Admins</div>
                            <div class="dash-counts">
                                {{-- <p>{{$admin}}</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-2">
                            <i class="fas fa-users"></i>
                        </span>
                        <div class="dash-count">
                            <div class="dash-title">Sellers</div>
                            <div class="dash-counts">
                                {{-- <p>{{$seller}}</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-3">
                            <i class="fas fa-users"></i>
                        </span>
                        <div class="dash-count">
                            <div class="dash-title">Buyers</div>
                            <div class="dash-counts">
                                {{-- <p>{{$buyer}}</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-4">
                            <i class="fas fa-truck"></i>
                        </span>
                        <div class="dash-count">
                            <div class="dash-title">Riders</div>
                            <div class="dash-counts">
                                {{-- <p>{{$rider}}</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-5">
                            <i class="fas fa-list"></i>
                        </span>
                        <div class="dash-count">
                            <div class="dash-title">Products</div>
                            <div class="dash-counts">
                                <p>42</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-6">
                            <i class="fas fa-file"></i>
                        </span>
                        <div class="dash-count">
                            <div class="dash-title">Total bids</div>
                            <div class="dash-counts">
                                <p>64</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-7">
                            <i class="fas fa-truck"></i>
                        </span>
                        <div class="dash-count">
                            <div class="dash-title">Total Transport</div>
                            <div class="dash-counts">
                                <p>36</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
