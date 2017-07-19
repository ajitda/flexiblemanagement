<table class="table table-bordered table-striped table-hover" id="list-of-expenses">
    <thead>
    <tr>
        <th>ID</th>
        <th>Created At</th>
        <th>Category</th>
        <th>Description</th>
        <th>Qty</th>
        <th>Unit Amount</th>
        <th>Total Amount</th>
        <th>Created By</th>
        <?php if($user == 'admin'): ?>
            <th colspan="2">Actions</th>
        <?php else: ?>
            <th>Action</th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php if(count($expenses)): ?>
    <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($expense->id); ?></td>
            <td><?php echo e($expense->created_at->format('d-m-Y')); ?></td>
            <td><?php echo e($expense->expense_category->name); ?></td>
            <td><?php echo e($expense->description); ?></td>
            <td><?php echo e($expense->qty); ?></td>
            <td><?php echo e($expense->unit_expense); ?></td>
            <td><?php echo e($expense->total); ?></td>
            <td><?php echo e($expense->user->name); ?></td>

            <td>
                <a href="expenses/<?php echo e($expense->id); ?>/edit"><span class="glyphicon glyphicon-edit"></span></a>
            </td>
            <?php if($user == 'admin'): ?>
                <td><a href="#" onclick="return confirm('are you sure?')">
                        <?php echo Form::open(['method'=> 'DELETE', 'route'=>['expenses.destroy', $expense->id]]); ?>

                        <?php echo Form::submit('X', ['class'=> 'btn btn-danger btn-small']); ?>

                        <?php echo Form::close(); ?></a>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </tbody>
</table>