<div class="header-panel">
    <div class="brand-panel">
        <a href=#>
            <span><img src="<?php echo e(asset('images/logo.png')); ?>"/></span>
            <span>Javra system monitoring</span>
        </a>
    </div>
    <div class="header-panel__right">
        <div class="header-panel__secondary">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<span class="userpp">
                                            
										</span>
                        <span><?php echo e(Auth::user()->name); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo e(route('logout')); ?>">&nbsp;Logout</a></li>

                        <li><a href="<?php echo e(url('changePassword')); ?>">Change Password</a></li></ul>
                </li>
            </ul>
        </div>
    </div>
</div>