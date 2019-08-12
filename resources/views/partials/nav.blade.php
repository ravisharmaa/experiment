<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <h1 class="sitetitle">Javra System Monitoring Tool</h1>
    <ul class="nav navbar-right navbar-top-links">
        <li>
            <a href="#">
                <i class="fa fa-user fa-fw"></i> {{Auth::user()->name}}
            </a>
        </li>
        <li>
            <a href="{{route('logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
        </li>
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <br><br><br>
                <li>
                    <a href="{{route('dashboard')}}" class="{{Route::is('dashboard')?'active':''}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
            @if(request()->user()->isAdmin())
                    <li>
                    <a href="{{route('customers.index')}}" class="{{request()->is('/company')?'active':''}}"><i class="fa fa-users fa-fw"></i>
                    Customers Management</a>
                    </li>
                @endif
                <li>
                    <a href="{{route('servers.index')}}" class="{{request()->is('/servers')?'active':''}}"><i class="fa fa-server fa-fw"></i> Servers
                        Management</a>
                </li>
            @if(request()->user()->isAdmin())
                    <li>
                    <a href="{{route('users.index')}}" class="{{request()->is('/users')?'active':''}}"><i class="fa fa-user fa-fw"></i> Users
                    Management</a>
                        </li>
                @endif


                <li>
                <a href="{{route('servicetypes.index')}}" class="{{request()->is('/servicetypes')?'active':''}}"><i class="fa fa-gear fa-fw"></i>
                    Services Management</a>
                </li>
            </ul>
        </div>
    </div>
</nav>