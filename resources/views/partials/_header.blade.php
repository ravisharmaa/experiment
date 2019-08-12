<div class="header-panel">
    <div class="brand-panel">
        <a href=#>
            <span><img src="{{asset('images/logo.png')}}"/></span>
            <span>Javra system monitoring</span>
        </a>
    </div>
    <div class="header-panel__right">
        <div class="header-panel__secondary">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<span class="userpp">
                                            {{--<img src="{{asset('images/user-profile.png')}}"/>--}}
										</span>
                        <span>{{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('logout')}}">&nbsp;Logout</a></li>

                        <li><a href="{{url('changePassword')}}">Change Password</a></li></ul>
                </li>
            </ul>
        </div>
    </div>
</div>