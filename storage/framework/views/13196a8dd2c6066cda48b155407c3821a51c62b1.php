<?php $__env->startSection('content'); ?>
    <div class="content__topPanel">
        <div class="content__topPanel-left">
            <h2 class="content__topPanel-title">Dashboard</h2>
        </div>
    </div>
    <div class="content__body container-fluid control-container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <!-- Accordion html structure -->
                <?php ($count = 1); ?>

                <?php $__currentLoopData = $servers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <!-- Each accordion item -->
                        <div class="dashboard_graph x_panel panel panel-default">
                            <div class="panel-heading row x_title x_flat_title" role="tab">
                                <h3 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapse_<?php echo e($server->hostname); ?>" aria-expanded="true"
                                       aria-controls="collapseOne">
                                        <?php echo e($count++); ?> . <?php echo e(ucfirst($server->hostname)); ?>

                                    </a>
                                    -
                                    <small><?php echo e($server->customer->name); ?></small>
                                    -
                                    <small><?php echo e($server->ipaddress); ?></small>
                                </h3>
                            </div>
                            <div id="collapse_<?php echo e($server->hostname); ?>"
                                 class="grid--equal-height x_content panel-collapse collapse in"
                                 role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class="row flexPanel flexPanel--equalHeiight">
                                        <?php $__currentLoopData = $server->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($attributes->name == 'CPU' ): ?>
                                                <cpu-component
                                                        :loadaverage="'<?php echo e($server->latestValue['loadaverage']); ?>'"
                                                        :attribute="'<?php echo e($attributes->pivot); ?>'">
                                                </cpu-component>
                                            <?php elseif($attributes->name == 'Memory' ): ?>
                                                <memory-component
                                                        :free-memory="'<?php echo e($server->latestValue['memtotal']); ?>'"
                                                        :used-memory="'<?php echo e($server->latestValue['memfree']); ?>'"
                                                        :attribute="'<?php echo e($attributes->pivot); ?>'"
                                                >
                                                </memory-component>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-3">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2 data-v-19640bc4="">Storage</h2>
                                                </div>
                                                <div class="x_content expandedDom">
                                                    <div class="graph_grid">
                                                        <div class="graph_grid__body">
                                                            <?php $__currentLoopData = $server->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                
                                                                <?php if(collect($server->latestValue['diskused'])->count() > 0): ?>
                                                                    <?php ($diskTotal = $attribute->pivot->disk_name . '_disktotal'); ?>
                                                                    <?php ($diskUsed = $attribute->pivot->disk_name . '_diskused'); ?>

                                                                    <?php if(property_exists($server->latestValue['diskused'], $diskUsed)): ?>
                                                                        <div class="graph_grid__top">
                                                                            <div class="graph_grid__top__left diskHolder">
                                                                                <div class="diskPanel">
                                                                                    <div class="diskInfo">
                                                                                        <div>
                                                                                            <strong>Disk</strong>: <?php echo e($attribute->pivot->disk_location); ?>

                                                                                        </div>
                                                                                        <div>
                                                                                            <strong>Total
                                                                                                Disk</strong>: <?php echo e($server->latestValue['disktotal']->$diskTotal); ?>

                                                                                            Gb
                                                                                        </div>
                                                                                    </div>

                                                                                    <?php if(($server->latestValue['disktotal']->$diskTotal != "") && ($server->latestValue['diskused']->$diskUsed != "")): ?>
                                                                                        <?php ($cal = (($server->latestValue['diskused']->$diskUsed) / ($server->latestValue['disktotal']->$diskTotal)) * 100); ?>
                                                                                    <?php else: ?>
                                                                                        <?php ($cal = '0'); ?>
                                                                                    <?php endif; ?>

                                                                                    <?php if((($server->latestValue['disktotal']->$diskTotal != ""))): ?>
                                                                                        <?php ($cal = (($server->latestValue['diskused']->$diskUsed)/($server->latestValue['disktotal']->$diskTotal)) *100); ?>

                                                                                        <div class="progress">
                                                                                            <div class="progress-bar"
                                                                                                 role="progressbar"
                                                                                                 aria-valuenow="<?php echo e($cal); ?>"
                                                                                                 aria-valuemin="0"
                                                                                                 aria-valuemax="100"
                                                                                                 style="width: <?php echo e($cal); ?>%;"
                                                                                            >
                                                                                                <?php echo e($server->latestValue['diskused']->$diskUsed); ?>

                                                                                                Gb
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php else: ?>
                                                                                        <?php ($cal = (($server->latestValue['diskused']->$diskUsed)/($server->latestValue['disktotal']->$diskTotal)) *100); ?>
                                                                                        <div class="progress">
                                                                                            <div class="progress-bar"
                                                                                                 role="progressbar"
                                                                                                 aria-valuenow="<?php echo e($cal); ?>"
                                                                                                 aria-valuemin="0"
                                                                                                 aria-valuemax="100"
                                                                                                 style="width: <?php echo e($cal); ?>%;"
                                                                                            ><?php echo e($server->latestValue['diskused']->$diskUsed); ?>

                                                                                                Gb
                                                                                            </div>
                                                                                            <small>
                                                                                                There
                                                                                                is
                                                                                                somthing
                                                                                                problem
                                                                                                in
                                                                                                disk
                                                                                            </small>
                                                                                        </div>

                                                                                    <?php endif; ?>
                                                                                    <div class="progressBar__info">
                                                                                        <div class="progressBar__info__left">
                                                                                            <span class="symbolAlerts symbolAlerts--warning"></span>
                                                                                            <span>
Warning Threshold : <?php echo e($attribute->pivot->warning_threshold); ?>

%
</span>
                                                                                        </div>
                                                                                        <div class="progressBar__info__right">
                                                                                            <span class="symbolAlerts symbolAlerts--danger"></span>
                                                                                            <span>
Critical Threshold : <?php echo e($attribute->pivot->critical_threshold); ?>

%
</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(collect($server->latestValue['diskused'])->count() > 2): ?>
                                                                <a href="javascript:void(0)"
                                                                   id="disk-<?php echo e($server->id); ?>"
                                                                   class="expanderDom">View
                                                                    more</a>

                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                        
                                        <?php if($server->latestValue['additional_attributes']): ?>
                                            <div class="col-md-3">
                                                <div class="x_panel">
                                                    <div class="x_content expandedDom">
                                                        <div class="x_title">
                                                            <h2>Services</h2>
                                                        </div>

                                                        <div class="graph_grid">
                                                            <div class="graph_grid__body">
                                                                <?php $__currentLoopData = $server->latestValue['additional_attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additional_attributes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <div class="graph_grid__top">
                                                                        <div class="graph_grid__top__left">
                                                                            <?php echo e($additional_attributes->name); ?>

                                                                        </div>
                                                                        <div class="graph_grid__top__right">
<span
        class="label label-default label--<?php echo e(($additional_attributes->status)?'active':'danger'); ?>">
<?php echo e(($additional_attributes->status)?'Running':'Stopped'); ?>

</span>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                                <?php if($server->latestValue['custom_field'] && $server->latestValue['custom_field']!='[]'): ?>
                                                                    <div class="x_title">
                                                                        <h2>Custom Scripts</h2>
                                                                    </div>

                                                                    <?php $__currentLoopData = json_decode($server->latestValue['custom_field']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $custom_fields): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <div class="graph_grid__top">
                                                                            <div class="customResult"> <?php echo e(($custom_fields->field_value)); ?></div>
                                                                        </div>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                                <?php if(collect(($server->latestValue['additional_attributes']))->count() > 5 || collect(json_decode($server->latestValue['custom_field']))->count() >0): ?>
                                                                    <a href="javascript:void(0)"
                                                                       id="service-<?php echo e($server->id); ?>"
                                                                       class="expanderDom">View
                                                                        more</a>
                                                                <?php endif; ?>
                                                                <div>
                                                                    <a href="<?php echo e(route('customs.show',['server' => $server->hostname])); ?>">View
                                                                        Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard_graph--foot">
                                <a class="btn btn--primary"
                                   href="<?php echo e(url("values/show/{$server->hostname}?period=last_hour")); ?>">View
                                    on
                                    charts</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>