<table class="table table-bordered table-striped table-hover">
    <thead>
    <tr>
        <th>Income Source</th>
        <th>Expense Source</th>
        <th>Debit</th>
        <th>Credit</th>
        <th>Balance</th>
    </tr>
    </thead>
    <tbody>
<?php if(count($balance)): ?>
    <tr>
        <td>Previous Balance</td>
        <td></td>
        <td></td>
        <td></td>
        <td>
            <?php echo e(number_format($balance-(DB::table('sales')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') +
            DB::table('chick_sales')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') +
            DB::table('feed_sales')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment')-
            DB::table('purchases')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') -
            DB::table('chick_purchases')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') -
            DB::table('feed_purchases')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') -
            DB::table('expenses')->whereDate('updated_at', '=', $request->DateCreated)->sum('total')))); ?>

        </td>
        </tr>
        

        <?php $__currentLoopData = $birdsales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $birdsale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($birdsale->payment > '0.00'): ?>
                <tr>
                    <td><?php echo e($birdsale->customer->name); ?></td>
                    <td></td>
                    <td><?php echo e($birdsale->payment); ?></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        <?php $__currentLoopData = $feedsales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedsale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($feedsale->payment > '0.00'): ?>
                <tr>
                    <td><?php echo e($feedsale->feed_customer->name); ?></td>
                    <td></td>
                    <td><?php echo e($feedsale->payment); ?></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        <?php $__currentLoopData = $chicksales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chicksale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($chicksale->payment > '0.00'): ?>
                <tr>
                    <td><?php echo e($chicksale->chick_customer->name); ?></td>
                    <td></td>
                    <td><?php echo e(number_format($chicksale->payment)); ?></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        <?php $__currentLoopData = $birdpurchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $birdpurchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($birdpurchase->payment > '0.00'): ?>
                <tr>
                    <td></td>
                    <td><?php echo e($birdpurchase->supplier->supplier_name); ?></td>
                    <td></td>
                    <td><?php echo e(number_format($birdpurchase->payment)); ?></td>
                    <td></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        <?php $__currentLoopData = $chickpurchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chickpurchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($chickpurchase->payment > '0.00'): ?>
                <tr>
                    <td></td>
                    <td><?php echo e($chickpurchase->chick_supplier->supplier_name); ?></td>
                    <td></td>
                    <td><?php echo e(number_format($chickpurchase->payment)); ?></td>
                    <td></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        <?php $__currentLoopData = $feedpurchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedpurchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($feedpurchase->payment > '0.00'): ?>
                <tr>
                    <td></td>
                    <td><?php echo e($feedpurchase->feed_supplier->supplier_name); ?></td>
                    <td></td>
                    <td><?php echo e(number_format($feedpurchase->payment)); ?></td>
                    <td></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td></td>
                <td><?php echo e($expense->description.' - '.$expense->expense_category->name); ?></td>
                <td></td>
                <td><?php echo e(number_format($expense->total)); ?></td>
                <td></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
        <td>Total</td>
        <td></td>
        <td>
            <?php echo e(number_format(DB::table('sales')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') +
            DB::table('chick_sales')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') +
            DB::table('feed_sales')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment'))); ?>

        </td>
        <td>
            <?php echo e(number_format(DB::table('purchases')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') +
            DB::table('chick_purchases')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') +
            DB::table('feed_purchases')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') +
            DB::table('expenses')->whereDate('updated_at', '=', $request->DateCreated)->sum('total'))); ?>

        </td>
        <td>
            <?php echo e(number_format($balance)); ?>

        </td>
    </tr>
        <?php endif; ?>
    </tbody>
</table>

