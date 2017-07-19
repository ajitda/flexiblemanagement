<?php $__env->startSection('content'); ?>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Expense Categories</div>
                    <div class="panel-body">
                        <?php if(Session::has('message')): ?>
                            <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
                        <?php endif; ?>
                        <ul class="list-inline">
                            <?php $__currentLoopData = $expense_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item list-group-item-info"><a href="<?php echo e(route('expensecategory.show', $category->id)); ?>"><?php echo e($category->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="#modal-id" data-toggle="modal">Add New Expense Category</a></li>
                        </ul>
                        <div class="modal fade" id="modal-id">
                            <div class="modal-dialog">
                                <?php echo Form::open(['route' => 'expensecategory.store', 'method' => 'post']); ?>

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Add A Expense Category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <?php echo e(Form::label('name', 'Name')); ?>

                                            <?php echo e(Form::text('name', null, array('class' => 'form-control'))); ?>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                                <?php echo Form::close(); ?>

                            </div>
                        </div>

                        <div>
                            <?php if(!empty($expensecategoryitem)): ?>
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Qty</th>
                                            <th>Unit Amount</th>
                                            <th>Total Amount</th>
                                            <th>Created By</th>
                                            <th colspan="2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $expensecategoryitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                        <tr>
                                            <td><?php echo e($single->id); ?></td>
                                            <td><?php echo e($single->expense_category->name); ?></td>
                                            <td><?php echo e($single->description); ?></td>
                                            <td><?php echo e($single->qty); ?></td>
                                            <td><?php echo e($single->unit_expense); ?></td>
                                            <td><?php echo e($single->total); ?></td>
                                            <td><?php echo e($single->user->name); ?></td>

                                            <td>
                                                <a href="../expenses/<?php echo e($single->id); ?>/edit"><span class="glyphicon glyphicon-edit"></span></a>
                                            </td>
                                            <td>
                                                <?php echo Form::open(['method'=> 'DELETE', 'route'=>['expenses.destroy', $single->id]]); ?>

                                                <?php echo Form::submit('X', ['class'=> 'btn btn-danger btn-small']); ?>

                                                <?php echo Form::close(); ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr><td>No Data</td></tr>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>