<table class="table table-bordered table-striped table-hover" id="list-sale-report">
    <thead>
    <tr>
        <th>ID</th>
        <th>Created at</th>
        <th>Suppliers</th>
        <th>Qty</th>
        <th>Weight</th>
        <th>Price Per Kg</th>
        <th>Subtotal</th>
        <th>Death Qty</th>
        <th>Total</th>
        <th>Payment</th>
        <th>Dues</th>
        <?php if($user == 'admin'): ?>
        <th colspan="2">Actions</th>
            <?php else: ?>
            <th>Actions</th>
        <?php endif; ?>
    </tr>
    </thead>
    <?php if(count($sales)): ?>
    <tbody class="list-sale-report">
    <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($sale->id); ?></td>
            <td><?php echo e($sale->chick_customer->name); ?></td>
            <td><?php echo e($sale->chick_supplier->supplier_name); ?></td>
            <td><?php echo e($sale->qty); ?></td>
            <td><?php echo e($sale->weight); ?></td>
            <td><?php echo e($sale->price_per_kg); ?></td>
            <td><?php echo e($sale->sub_total); ?></td>
            <td><?php echo e($sale->death_qty); ?></td>

            <td><?php echo e($sale->total); ?></td>
            <td><?php echo e($sale->payment); ?></td>
            <td><?php echo e($sale->dues); ?></td>

            <td>
                <a href="../chicksales/<?php echo e($sale->id); ?>/edit"><span class="glyphicon glyphicon-edit"></span></a>
            </td>
            <?php if($user=='admin'): ?>
            <td>
                <?php echo Form::open(['method'=> 'DELETE', 'route'=>['chicksales.destroy', $sale->id]]); ?>

                <?php echo Form::submit('X', ['class'=> 'btn btn-danger btn-small']); ?>

                <?php echo Form::close(); ?>

            </td>
                <?php endif; ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
        <?php endif; ?>
</table>