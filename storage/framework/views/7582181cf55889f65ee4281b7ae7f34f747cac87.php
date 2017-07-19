<table class="table table-bordered table-striped table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Created at</th>
        <th>Suppliers</th>
        <th>Qty</th>
        <th>Weight</th>
        <th>Total Weight</th>
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
        <?php if($user=='admin'): ?>
            <th colspan="2">Actions</th>
        <?php else: ?>
            <th>Actions</th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($purchase->id); ?></td>
            <td><?php echo e($purchase->created_at->format('d-m-Y')); ?></td>
            <td><?php echo e($purchase->supplier->supplier_name); ?></td>
            <td><?php echo e($purchase->qty); ?></td>
            <td><?php echo e($purchase->weight); ?></td>
            <td><?php echo e($purchase->tweight); ?></td>
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
                <a href="purchases/<?php echo e($purchase->id); ?>/edit"><span class="glyphicon glyphicon-edit"></span></a>
            </td>
            <?php if($user=='admin'): ?>
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