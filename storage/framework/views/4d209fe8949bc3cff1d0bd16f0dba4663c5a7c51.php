<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    
                    <h3 class="panel-title">Statistics</h3>
                    <br>
                    <?php if($user == 'admin'): ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="purple well"><i class="fa fa-shopping-cart" aria-hidden="true"></i><br>

                                <span><strong><?php echo e(trans('dashboard.total_earnings')); ?> : <?php echo e(number_format($total_earning, 2)); ?></strong></span></div>
                        </div>
                        <div class="col-md-4">
                            <div class="chocolate well"><i class="fa fa-sitemap" aria-hidden="true"></i><br>

                                <span><strong><?php echo e(trans('dashboard.total_cost')); ?> : <?php echo e(number_format($total_cost, 2)); ?></strong></span></div>
                        </div>
                        <div class="col-md-4">
                            <div class="well yellow"><i class="fa fa-cubes" aria-hidden="true"></i><br>
                                <span><strong><?php echo e(trans('dashboard.total_profit')); ?> : <?php echo e(number_format($total_earning - $total_cost, 2)); ?></strong></span></div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="well green"><i class="fa fa-bars" aria-hidden="true"></i><br>
                                <span><strong><?php echo e(trans('dashboard.total_purchases')); ?> : <?php echo e($purchases); ?></strong></span></div>
                        </div>
                        <div class="col-md-3">
                            <div class="well blue"><i class="fa fa-list" aria-hidden="true"></i><br>
                                <span><strong><?php echo e(trans('dashboard.total_sales')); ?> : <?php echo e($sales); ?></strong></span></div>
                        </div>
                        <div class="col-md-3">
                            <div class="violet well"><i class="fa fa-users" aria-hidden="true"></i><br>
                                <span><strong><?php echo e(trans('dashboard.total_customers')); ?> : <?php echo e($customers); ?></strong></span></div>
                        </div>
                        <div class="col-md-3">
                            <div class="brown well"><i class="fa fa-user" aria-hidden="true"></i><br>
                                <span><strong><?php echo e(trans('dashboard.total_suppliers')); ?> : <?php echo e($suppliers); ?></strong></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>