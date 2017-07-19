<table class="table table-bordered table-striped table-hover" id="list-sale-report">
    <thead>
    <tr>
        <th>ID</th>
        <th>Created at</th>
        <th>Updated at</th>
        <th class="hidden-print">Suppliers</th>
        <th>Qty</th>
        <th>Weight</th>
        <th>Price Per Kg</th>
        <th>Subtotal</th>
        <th>Death Qty</th>
        <th>Total</th>
        <th>Less</th>
        <th>Payment</th>
        <th>Dues</th>
        <?php if($user=='admin'): ?>
        <th colspan="2" class="hidden-print">Actions</th>
        <?php else: ?>
        <th class="hidden-print">Actions</th>
        <?php endif; ?>
    </tr>
    </thead>
    <?php if(count($sales)): ?>
    <tbody class="list-sale-report">
    <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($sale->id); ?></td>
            <td><?php echo e($sale->created_at->format('Y-m-d')); ?></td>
            <td><?php echo e($sale->updated_at->format('Y-m-d')); ?></td>
            <td class="hidden-print"><?php echo e($sale->supplier->supplier_name); ?></td>
            <td><?php echo e($sale->qty); ?></td>
            <td><?php echo e($sale->weight); ?></td>
            <td><?php echo e($sale->price_per_kg); ?></td>
            <td><?php echo e($sale->sub_total); ?></td>
            <td><?php echo e($sale->death_qty); ?></td>

            <td><?php echo e($sale->total); ?></td>
            <td><?php echo e($sale->less); ?></td>
            <td><?php echo e($sale->payment); ?></td>
            <td><?php echo e($sale->dues); ?></td>

            <td class="hidden-print">
                <a href="../sales/<?php echo e($sale->id); ?>/edit"><span class="glyphicon glyphicon-edit"></span></a>
            </td>
            <?php if($user =='admin'): ?>
            <td class="hidden-print"><a href="#" onclick="return confirm('are you sure?')">
                <?php echo Form::open(['method'=> 'DELETE', 'route'=>['sales.destroy', $sale->id]]); ?>

                <?php echo Form::submit('X', ['class'=> 'btn btn-danger btn-small']); ?>

                <?php echo Form::close(); ?></a>
            </td>
                <?php endif; ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<div class="row">
    <div class="col-sm-4 col-sm-offset-8">
        <table class="table table-bordered table-hover table-striped pull-right">
            <tr>
                <td>Previous Balance :</td>
                <td><?php echo e(DB::table('sales')->where('customer_id', $customer->id)->sum('dues')- DB::table('sales')->where('customer_id', $customer->id)->whereBetween('created_at', [ $request->DateCreated.' 00:00:00', $request->EndDate.' 23:59:59'])->sum('dues') + $customer->balance); ?></td>
            </tr>
            <tr>
                <td>Total Sales :</td>
                <td><?php echo e(DB::table('sales')->where('customer_id', $customer->id)->whereBetween('created_at', [ $request->DateCreated.' 00:00:00', $request->EndDate.' 23:59:59'])->sum('dues')); ?></td>
            </tr>
            <tr>
                <td>Total Dues : </td>
                <td><?php echo e(DB::table('sales')->where('customer_id', $customer->id)->sum('dues') + $customer->balance); ?></td>
            </tr>
            <tr>
                <td>Payment : </td>
                <td></td>
            </tr>
            <tr>
                <td>Dues : </td>
                <td></td>
            </tr>
        </table>
    </div>
</div>

<?php endif; ?>