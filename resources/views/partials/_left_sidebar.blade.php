<div class="sidenav sidebar-panel">
    <ul class="sidebar__nav">
        <li class="sidebar__navlist">
            <a class="sidebar__navlink" href="{{route('dashboard')}}" title="Main Menu">
                <img src="{{asset('images/j-dashboard-icon.png')}}">
                <span>Dashboard</span>
            </a>
        </li>

        @if(request()->user()->isAdmin())
            <li class="sidebar__navlist">
                <a class="sidebar__navlink" title="BILLING REPORT" href="{{route('customers.index')}}">
                    <img src="{{asset('images/j-customers-icon.png')}}">
                    <span>Customers management</span>
                </a>
            @endif
            <!-- For more sub-menu goes here -->
                {{--<div class="collapsible-panel">
                    <ul>
                        <li><a href="">One menu</a></li>
                        <li><a href="">Two menu</a></li>
                        <li><a href="">Three menu</a></li>
                    </ul>
                </div>--}}
            </li>
            @if( request()->user()->isAdmin() || request()->user()->role=='admin')
                <li class="sidebar__navlist">
                    <a class="sidebar__navlink" title="BILLING REPORT" href="{{route('servers.index')}}">
                        <img src="{{asset('images/j-servers-icon.png')}}">
                        <span>Servers management</span>
                    </a>
                </li>
            @endif
            @if(request()->user()->isAdmin())
                <li class="sidebar__navlist">
                    <a class="sidebar__navlink" title="BILLING REPORT" href="{{route('users.index')}}">
                        <img src="{{asset('images/j-users-icon.png')}}">
                        <span>Users management</span>
                    </a>
                </li>
            @endif
            @if(request()->user()->isAdmin())
                <li class="sidebar__navlist">
                    <a class="sidebar__navlink" title="BILLING REPORT" href="{{route('servicetypes.index')}}">
                        <img src="{{asset('images/j-services-icon.png')}}">
                        <span>Services management</span>
                    </a>
                </li>
            @endif
    </ul>
</div>