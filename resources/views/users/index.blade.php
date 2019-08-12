@extends('main')

@section('content')

    <div class="content__topPanel">
        @if(session('message'))
            {{session('message')}}
        @endif
        <div class="content__topPanel-left">
            <h1 class="content__topPanel-title">Users Management</h1>
        </div>
        <div class="content__topPanel-right">
            <button type="button" class="btn btn--primary right-sidebar-toggler">Add Users</button>
        </div>
    </div>
    <!-- Right side panel to fill form -->
    <div class="right-sidebarPanel" id="right-sidebar">
        <div class="right-sidebarPanel__header">User Registration</div>
        <div class="right-sidebarPanel__body">
            <user-form-component></user-form-component>
        </div>
    </div>
    <div class="content__body container-fluid control-container">
        <div class="row">
            <!-- /.panel-heading -->
            <div class="col-lg-12">
                <div class="tablePanel--wrapper dashboard_graph x_panel table-responsive">
                    <div class="row x_title x_flat_title">
                        <div class="col-md-6">
                            <h3>Users list</h3>
                        </div>
                    </div>
                    <table class="tablePanel tblUser table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Company Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Time Zone</th>
                            <th>Created At</th>
                        </tr>

                        </thead>
                        <tbody>
                        @php($count = 1)
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>
                                    {{$user->customer['name']}}
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->role}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->timezone}}</td>
                                <td>{{$user->created_at}}</td>
                                {{--<td>--}}
                                {{-- <button type="button" class="btn btn-xs btn-success">Update</button>
                                    <button type="button" class="btn btn-xs btn-danger">Delete</button>--}}
                                {{--</td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.content__body -->

@endsection

