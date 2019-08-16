<div class="sidenav sidebar-panel">
    <ul class="sidebar__nav">
        <li class="sidebar__navlist">
            <a class="sidebar__navlink" href="<?php echo e(route('dashboard')); ?>" title="Main Menu">
                <img src="<?php echo e(asset('images/j-dashboard-icon.png')); ?>">
                <span>Dashboard</span>
            </a>
        </li>

        <?php if(request()->user()->isAdmin()): ?>
            <li class="sidebar__navlist">
                <a class="sidebar__navlink" title="BILLING REPORT" href="<?php echo e(route('customers.index')); ?>">
                    <img src="<?php echo e(asset('images/j-customers-icon.png')); ?>">
                    <span>Customers management</span>
                </a>
            <?php endif; ?>
            <!-- For more sub-menu goes here -->
                
            </li>
            <?php if( request()->user()->isAdmin() || request()->user()->role=='admin'): ?>
                <li class="sidebar__navlist">
                    <a class="sidebar__navlink" title="BILLING REPORT" href="<?php echo e(route('servers.index')); ?>">
                        <img src="<?php echo e(asset('images/j-servers-icon.png')); ?>">
                        <span>Servers management</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(request()->user()->isAdmin()): ?>
                <li class="sidebar__navlist">
                    <a class="sidebar__navlink" title="BILLING REPORT" href="<?php echo e(route('users.index')); ?>">
                        <img src="<?php echo e(asset('images/j-users-icon.png')); ?>">
                        <span>Users management</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(request()->user()->isAdmin()): ?>
                <li class="sidebar__navlist">
                    <a class="sidebar__navlink" title="BILLING REPORT" href="<?php echo e(route('servicetypes.index')); ?>">
                        <img src="<?php echo e(asset('images/j-services-icon.png')); ?>">
                        <span>Services management</span>
                    </a>
                </li>
            <?php endif; ?>
    </ul>
</div>