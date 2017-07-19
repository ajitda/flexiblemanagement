<table class="table table-bordered table-striped table-hover" id="list-sale-report">
    <thead>
    <tr>
        <th>ID</th>
        <th>Customers</th>
        <th>Suppliers</th>
        <th>Qty</th>
        <th>Unit Price</th>
        <th>Subtotal</th>
        <th>Costing</th>
        <th>Total</th>
        <th>Payment</th>
        <th>Dues</th>
        <?php if($user == 'admin'): ?>
            <th colspan="2">Actions</th>
        <?php else: ?>
            <th>Action</th>
        <?php endif; ?>
    </tr></tr>
    </thead>
    <?php if(count($sales)): ?>
    <tbody class="list-sale-report">
    <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($sale->id); ?></td>
            <td><?php echo e($sale->feed_customer->name); ?></td>
            <td><?php echo e($sale->feed_supplier->supplier_name); ?></td>
            <td><?php echo e($sale->qty); ?></td>
            <td><?php echo e($sale->unit_price); ?></td>
            <td><?php echo e($sale->sub_total); ?></td>
            <td><?php echo e($sale->costing); ?></td>

            <td><?php echo e($sale->total); ?></td>
            <td><?php echo e($sale->payment); ?></td>
            <td><?php echo e($sale->dues); ?></td>

            <td>
                <a href="feedsales/<?php echo e($sale->id); ?>/edit"><span class="glyphicon glyphicon-edit"></span></a>
            </td>
            <?php if($user == 'admin'): ?>
                <td>
                    <?php echo Form::open(['method'=> 'DELETE', 'route'=>['feedsales.destroy', $sale->id]]); ?>

                    <?php echo Form::submit('X', ['class'=> 'btn btn-danger btn-small']); ?>

                    <?php echo Form::close(); ?>

                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
        <?php endif; ?>
</table>