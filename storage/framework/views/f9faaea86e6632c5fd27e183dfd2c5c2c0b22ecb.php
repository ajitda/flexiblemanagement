<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <h3 class="text-center visible-print">All Customer Daily Balance Sheet</h3>
                    <div class="text-center visible-print">Date : <?php echo e(\Carbon\Carbon::today()); ?></div>
                    <div class="panel-heading hidden-print">Customers
                        <a href="customers/create"><span class="glyphicon glyphicon-plus pull-right"></span></a>
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
                                    <th class="hidden-print">Address</th>
                                    <th class="hidden-print">Image</th>
                                    <th class="hidden-print">Phone</th>
                                    <th class="hidden-print">created By</th>
                                    <th>Prvious Balance</th>
                                    <th>Daily Sale</th>
                                    <th>Daily Payment</th>
                                    <th>Net Balance</th>
                                    <?php if($user == 'admin'): ?>
                                    <th colspan="3" class="hidden-print">Actions</th>
                                        <?php else: ?>
                                        <th class="hidden-print">Actions</th>
                                        <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($customer->id); ?></td>
                                    <td><a href="customers/<?php echo e($customer->id); ?>"><?php echo e($customer->name); ?></a></td>
                                    <td class="hidden-print"><?php echo e($customer->address); ?></td>
                                    <td class="hidden-print"><img class="img-responsive img-small" src="<?php echo e($customer->image); ?>" alt=""></td>
                                    <td class="hidden-print"><?php echo e($customer->phone); ?></td>
                                    <td class="hidden-print"><?php echo e($customer->user->name); ?></td>
                                    <td><?php echo e(number_format(DB::table('sales')->whereDate('created_at', '<=', \Carbon\Carbon::yesterday())->where('customer_id', $customer->id)->sum('dues') + $customer->balance - $customer->payment, 2)); ?></td>
                                    <td><?php echo e(number_format(DB::table('sales')->whereDate('created_at', '=', \Carbon\Carbon::today())->where('customer_id', $customer->id)->sum('total') , 2)); ?></td>
                                    <td><?php echo e(round(DB::table('sales')->whereDate('created_at', '=', \Carbon\Carbon::today())->where('customer_id', $customer->id)->sum('payment'), 2)); ?></td>
                                    <td><?php echo e(round(DB::table('sales')->where('customer_id', $customer->id)->sum('dues') + $customer->balance - $customer->payment, 2)); ?></td>


                                    <td class="hidden-print">
                                        <a href="customers/<?php echo e($customer->id); ?>/edit"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                    <?php if($user=='admin'): ?>
                                    <td class="hidden-print"><a href="#" onclick="return confirm('are you sure?')">
                                        <?php echo Form::open(['method'=> 'DELETE', 'route'=>['customers.destroy', $customer->id]]); ?>

                                        <?php echo Form::submit('X', ['class'=> 'btn btn-danger btn-small']); ?>

                                        <?php echo Form::close(); ?></a>
                                    </td>
                                        <?php endif; ?>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class="paginatios col-md-12 hidden-print">
                            <?php echo $customers->render(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>