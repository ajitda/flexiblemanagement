<table class="table table-bordered table-striped table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Suppliers</th>
        <th>Qty</th>
        <th>Unit Price</th>
        <th>Subtotal</th>
        <th>Costing</th>
        <th>Total</th>
        <th>Payment</th>
        <?php if($user == 'admin'): ?>
            <th colspan="2">Actions</th>
        <?php else: ?>
            <th>Action</th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($purchase->id); ?></td>
            <td><?php echo e($purchase->feed_supplier->supplier_name); ?></td>
            <td><?php echo e($purchase->qty); ?></td>
            <td><?php echo e($purchase->unit_price); ?></td>
            <td><?php echo e($purchase->sub_total); ?></td>
            <td><?php echo e($purchase->costing); ?></td>
            <td><?php echo e($purchase->total); ?></td>
            <td><?php echo e($purchase->payment); ?></td>

            <td>
                <a href="feedpurchases/<?php echo e($purchase->id); ?>/edit"><span class="glyphicon glyphicon-edit"></span></a>
            </td>
            <?php if($user == 'admin'): ?>
                <td>
                    <?php echo Form::open(['method'=> 'DELETE', 'route'=>['feedpurchases.destroy', $purchase->id]]); ?>

                    <?php echo Form::submit('X', ['class'=> 'btn btn-danger btn-small']); ?>

                    <?php echo Form::close(); ?>

                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>