<?php $__env->startSection('content'); ?>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Chick Customers
                        <a href="chickcustomers/create"><span class="glyphicon glyphicon-plus pull-right"></span></a>
                    </div>
                    <div class="panel-body">
                        <?php if(Session::has('message')): ?>
                            <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
                        <?php endif; ?>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Address</th>
                                    <th>Image</th>
                                    <th>Phone</th>
                                    <th>created By</th>
                                    <th>Balance</th>
                                    <th>Payment</th>
                                    <th>Dues</th>
                                    <?php if($user=='admin'): ?>
                                    <th colspan="3">Actions</th>
                                        <?php else: ?>
                                    <th>Actions</th>
                                        <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($customer->id); ?></td>
                                    <td><a href="chickcustomers/<?php echo e($customer->id); ?>"><?php echo e($customer->name); ?></a></td>
                                    <td><?php echo e($customer->address); ?></td>
                                    <td><img class="img-responsive img-small" src="<?php echo e($customer->image); ?>" alt=""></td>
                                    <td><?php echo e($customer->phone); ?></td>
                                    <td><?php echo e($customer->user->name); ?></td>
                                    <td><?php echo e(number_format(DB::table('chick_sales')->where('chick_customer_id', $customer->id)->sum('total') + $customer->balance, 2)); ?></td>
                                    <td><?php echo e(number_format(DB::table('chick_sales')->where('chick_customer_id', $customer->id)->sum('payment') + $customer->payment, 2)); ?></td>
                                    <td><?php echo e(round(DB::table('chick_sales')->where('chick_customer_id', $customer->id)->sum('total') + $customer->balance -DB::table('chick_sales')->where('chick_customer_id', $customer->id)->sum('payment') - $customer->payment, 2)); ?></td>


                                    <td>
                                        <a href="chickcustomers/<?php echo e($customer->id); ?>/edit"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                    <?php if($user=='admin'): ?>
                                    <td>
                                        <?php echo Form::open(['method'=> 'DELETE', 'route'=>['chickcustomers.destroy', $customer->id]]); ?>

                                        <?php echo Form::submit('X', ['class'=> 'btn btn-danger btn-small']); ?>

                                        <?php echo Form::close(); ?>

                                    </td>
                                    <?php endif; ?>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class="paginatios col-lg-12">
                            <?php echo $customers->render(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>