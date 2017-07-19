<table class="table table-bordered table-striped table-hover">
    <thead>
    <tr>
        <th>Date</th>
        <th>Purchase</th>
        <th>Expense</th>
        <th>Less</th>
        <th>Cost</th>
        <th>Total Sale</th>
        <th>Cheque Sale & Others</th>
        <th>Cash Sale</th>
        <th>Collection</th>
        <th>Balance</th>
        <th>Profit</th>
    </tr>
    </thead>
    <?php if(count($reportsummarys)): ?>
    <tbody>
    <?php $__currentLoopData = $reportsummarys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reportsummary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($reportsummary->created_at->format('Y-m-d')); ?></td>
            <td><?php echo e($reportsummary->total_purchase); ?></td>
            <td><?php echo e($reportsummary->total_expense); ?></td>
            <td><?php echo e($reportsummary->total_less); ?></td>
            <td><?php echo e($reportsummary->total_cost); ?></td>
            <td><?php echo e($reportsummary->total_sale); ?></td>
            <td><?php echo e($reportsummary->cheque_sale_others); ?></td>
            <td><?php echo e($reportsummary->cash_sale); ?></td>
            <td><?php echo e($reportsummary->collection); ?></td>
            <td><?php echo e($reportsummary->balance); ?></td>
            <td><?php echo e($reportsummary->profit); ?></td>

            
            
            
            
            
            
            
            
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>Total</td>
                <td><?php echo e(DB::table('bird_reports')->whereBetween('created_at', [$request->DateCreated.' 00.00.00', $request->EndDate.' 23.59.59'])->sum('total_purchase')); ?></td>
                <td><?php echo e(DB::table('bird_reports')->whereBetween('created_at', [$request->DateCreated.' 00.00.00', $request->EndDate.' 23.59.59'])->sum('total_expense')); ?></td>
                <td><?php echo e(DB::table('bird_reports')->whereBetween('created_at', [$request->DateCreated.' 00.00.00', $request->EndDate.' 23.59.59'])->sum('total_less')); ?></td>
                <td><?php echo e(DB::table('bird_reports')->whereBetween('created_at', [$request->DateCreated.' 00.00.00', $request->EndDate.' 23.59.59'])->sum('total_cost')); ?></td>
                <td><?php echo e(DB::table('bird_reports')->whereBetween('created_at', [$request->DateCreated.' 00.00.00', $request->EndDate.' 23.59.59'])->sum('total_sale')); ?></td>
                <td><?php echo e(DB::table('bird_reports')->whereBetween('created_at', [$request->DateCreated.' 00.00.00', $request->EndDate.' 23.59.59'])->sum('cheque_sale_others')); ?></td>
                <td><?php echo e(DB::table('bird_reports')->whereBetween('created_at', [$request->DateCreated.' 00.00.00', $request->EndDate.' 23.59.59'])->sum('cash_sale')); ?></td>
                <td><?php echo e(DB::table('bird_reports')->whereBetween('created_at', [$request->DateCreated.' 00.00.00', $request->EndDate.' 23.59.59'])->sum('collection')); ?></td>
                <td><?php echo e(DB::table('bird_reports')->whereBetween('created_at', [$request->DateCreated.' 00.00.00', $request->EndDate.' 23.59.59'])->sum('balance')); ?></td>
                <td><?php echo e(DB::table('bird_reports')->whereBetween('created_at', [$request->DateCreated.' 00.00.00', $request->EndDate.' 23.59.59'])->sum('profit')); ?></td>
            </tr>
    </tbody>
        <?php endif; ?>
</table>