<?php $__env->startSection('content'); ?>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Suppliers
                        <a href="suppliers/create"><span class="glyphicon glyphicon-plus pull-right"></span></a>
                    </div>

                    <div class="panel-body">
                        <?php if(Session::has('message')): ?>
                            <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
                        <?php endif; ?>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Supplier</th>
                                    <th>Address</th>
                                    <th>Image</th>
                                    <th>Phone</th>
                                    <th>User</th>
                                    <?php if($user == "admin"): ?>
                                    <th colspan="2">Actions</th>
                                        <?php else: ?>
                                        <th>Actions</th>
                                        <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($supplier->id); ?></td>
                                    <td><a href="suppliers/<?php echo e($supplier->id); ?>"><?php echo e($supplier->supplier_name); ?></a></td>
                                    <td><?php echo e($supplier->address); ?></td>
                                    <td><img class="img-responsive img-small" src="<?php echo e($supplier->image); ?>" alt=""></td>
                                    <td><?php echo e($supplier->phone); ?></td>
                                    <td><?php echo e($supplier->user->name); ?></td>


                                    <td>
                                        <a href="suppliers/<?php echo e($supplier->id); ?>/edit"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                    <?php if($user == "admin"): ?>
                                    <td><a href="#" onclick="return confirm('are you sure?')">
                                        <?php echo Form::open(['method'=> 'DELETE', 'route'=>['suppliers.destroy', $supplier->id]]); ?>

                                        <?php echo Form::submit('X', ['class'=> 'btn btn-danger btn-small']); ?>

                                        <?php echo Form::close(); ?></a>
                                    </td>
                                        <?php endif; ?>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class="paginatios col-lg-12">
                            <?php echo $suppliers->render(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>