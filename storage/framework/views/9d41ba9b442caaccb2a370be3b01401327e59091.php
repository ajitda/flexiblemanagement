<?php $__env->startSection('content'); ?>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong><?php echo e($supplier->supplier_name); ?></strong>
                        <a href="<?php echo e($supplier->id); ?>/edit"><span class="glyphicon glyphicon-edit pull-right"></span></a>
                    </div>
                    <div class="panel-body">
                        <?php if(Session::has('message')): ?>
                            <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
                        <?php endif; ?>
                        <div class="col-md-6 col-md-offset-2">
                            <img class="img-responsive" src="../<?php echo e($supplier->image); ?>" alt=""><br>
                        <div class="text-left">
                           <strong>Address : </strong>  <?php echo e($supplier->address); ?><br>
                            <strong>Phone : </strong> <?php echo e($supplier->phone); ?><br>
                        </div>

                        </div>
                        <div class="col-md-4">
                            <h4><strong>Total Purchased : <span class="navy">Tk.<?php echo e(number_format(DB::table('purchases')->where('supplier_id', $supplier->id)->sum('total'), 2)); ?></span></strong></h4>
                            <h4><strong>Total Payment : <span class="navy">Tk.<?php echo e(number_format(DB::table('purchases')->where('supplier_id', $supplier->id)->sum('payment'), 2)); ?></span></strong></h4>
                            <h4><strong>Total Dues : <span class="navy">Tk.<?php echo e(number_format(DB::table('purchases')->where('supplier_id', $supplier->id)->sum('dues'), 2)); ?></span></strong></h4>
                        </div>
                        <div class="clearfix"></div>
                        <h4><Strong>Purchased List:</Strong></h4>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Qty</th>
                                <th>Weight</th>
                                <th>Price Per Kg</th>
                                <th>Subtotal</th>
                                <th>Death Qty</th>
                                <th>Transport</th>
                                <th>Daily Stuff</th>
                                <th>Others</th>
                                <th>Total</th>
                                <th>Less</th>
                                <th>Payment</th>
                                <th>Dues</th>
                                <?php if($user == 'admin'): ?>
                                <th colspan="2">Actions</th>
                                    <?php else: ?>
                                    <th >Actions</th>
                                    <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $supplier->purchase; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($purchase->id); ?></td>
                                    <td><?php echo e($purchase->created_at->format('Y-m-d')); ?></td>
                                    <td><?php echo e($purchase->updated_at->format('Y-m-d')); ?></td>
                                    <td><?php echo e($purchase->qty); ?></td>
                                    <td><?php echo e($purchase->weight); ?></td>
                                    <td><?php echo e($purchase->price_per_kg); ?></td>
                                    <td><?php echo e($purchase->sub_total); ?></td>
                                    <td><?php echo e($purchase->death_qty); ?></td>
                                    <td><?php echo e($purchase->transport); ?></td>
                                    <td><?php echo e($purchase->daily_stuff_salary); ?></td>
                                    <td><?php echo e($purchase->others); ?></td>
                                    <td><?php echo e($purchase->total); ?></td>
                                    <td><?php echo e($purchase->less); ?></td>
                                    <td><?php echo e($purchase->payment); ?></td>
                                    <td><?php echo e($purchase->dues); ?></td>
                                    <td>
                                        <a href="../purchases/<?php echo e($purchase->id); ?>/edit"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                        <?php if($user == 'admin'): ?>
                                    <td><a href="#" onclick="return confirm('are you sure?')">
                                        <?php echo Form::open(['method'=> 'DELETE', 'route'=>['purchases.destroy', $purchase->id]]); ?>

                                        <?php echo Form::submit('X', ['class'=> 'btn btn-danger btn-small']); ?>

                                        <?php echo Form::close(); ?></a>
                                    </td>
                                        <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>