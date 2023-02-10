@extends('admin.header-footer')
@section('admin_content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <a class="btn btn-sm btn-primary mx-4 mt-4 float-end" href="addseller">Add New Seller</a>
                        <table id="table" class="table table-center table-hover ">
                            <thead class=" table-light ">
                                <tr>
                                    <th>S.No.</th>
                                    <th>Seller</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Joined</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($sellers as $seller)
                                    <tr>
                                        <td>{{ $i }}</td>@php $i=$i+1 @endphp
                                        <td>
                                            <h2 class="table-avatar">
                                                <div class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle"
                                                        src="" alt=""></div>
                                                <p>{{ $seller->first_name . ' ' . $seller->last_name }}</p>
                                            </h2>
                                        </td>
                                        <td>{{ $seller->email }}</td>
                                        <td>{{ $seller->phone }}</td>
                                        <td>{{ $seller->gender }}</td>
                                        <td class="text-wrap">
                                            {{ 'Division: ' . $seller->division . ', District: ' . $seller->district . ', Sub-District/City-Corporation: ' . $seller->sdcc . ', Union/Police-Sation: ' . $seller->ups . ', Ward: ' . $seller->ward . ', Village/Para/Mahalla: ' . $seller->village . ', Postal-Code: ' . $seller->pc }}
                                        </td>
                                        <td>{{ date('d/m/Y H:i:s', strtotime( $seller->created_at)) }}</td>
                                        <td class="text-right">
                                            <a href="" class="btn btn-info"><i class="far fa-edit"></i></a>
                                            <button href="" class="btn btn-danger"><i
                                                    class="far fa-trash-alt"></i></button>
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
@endsection
