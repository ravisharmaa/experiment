@extends('main')

@section('content')

    <div class="content__topPanel">
        <div class="content__topPanel-left">
            <h2 class="content__topPanel-title">Customers Management</h2>
        </div>
        @if(session('message'))
            {{session('message')}}
        @endif
        <div class="content__topPanel-right">
            <button type="button" class="btn btn--primary right-sidebar-toggler">Add Customer</button>
        </div>
    </div>
    <div class="right-sidebarPanel" id="right-sidebar">
        <div class="right-sidebarPanel__header">Customer Register</div>
        <div class="right-sidebarPanel__body">
            <customer-form-component></customer-form-component>
        </div>
    </div>
    <div class="content__body container-fluid control-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="tablePanel--wrapper dashboard_graph x_panel table-responsive">
                    <div class="row x_title x_flat_title">
                        <div class="col-md-6">
                            <h3>Customers list </h3>
                        </div>
                    </div>
                    <table class="tablePanel tblCustomer table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Company Name</th>
                            <th>Contact</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($count = 1)
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->contact_person}}</td>
                                <td>{{$customer->phone}}</td>
                                <td>{{$customer->email}}</td>
                                <td>{{$customer->address}}</td>
                                <td>
                                    <a href="#" data-toggle="tooltip"
                                       title="Edit"><i class="btn--plainText fa fa-edit"></i></a>
                                    {{Form::open(['route'=>['customers.destroy', $customer->slug,],'method'=>'DELETE'])}}
                                    <button type="submit" data-toggle="tooltip" title="Delete"
                                            class="btn--plainText text--danger fa fa-trash"></button>
                                    {{Form::close()}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection