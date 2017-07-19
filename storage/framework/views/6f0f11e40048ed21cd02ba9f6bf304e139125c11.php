<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading hidden-print">Daily Report</div>

                <div class="panel-body">
                    
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group form-inline hidden-print">
                                <label for="StartDate">Select Date</label>
                                <input type="text" name="StartDate" id="StartDate" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h3 class="panel-title text-left" style="margin-left: 50px;">DAILY INCOME AND EXPENSE</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" id="daily-report">
                            <h4 class="text-center"> Date : <?php echo e(\Carbon\Carbon::today()->format('Y-m-d')); ?></h4>
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

                                <tr>
                                    <td>Previous Balance</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <?php echo e(number_format($latest_report->previous_balance)); ?>

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
                                            <?php echo e(number_format(DB::table('sales')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') +
                                            DB::table('chick_sales')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') +
                                            DB::table('feed_sales')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment'))); ?>

                                        </td>
                                        <td>
                                            <?php echo e(number_format(DB::table('purchases')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') +
                                            DB::table('chick_purchases')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') +
                                            DB::table('feed_purchases')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') +
                                            DB::table('expenses')->whereDate('created_at', '=', date('Y-m-d'))->sum('total'))); ?>

                                        </td>
                                        <td>
                                            <?php echo e(number_format($latest_report->previous_balance  +
                                            DB::table('sales')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') +
                                            DB::table('chick_sales')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') +
                                            DB::table('feed_sales')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment')-
                                            DB::table('purchases')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') -
                                            DB::table('chick_purchases')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') -
                                            DB::table('feed_purchases')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') -
                                            DB::table('expenses')->whereDate('created_at', '=', date('Y-m-d'))->sum('total'))); ?>


                                        </td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        $("#StartDate").datepicker({
            changeDate:true,
            changeMonth:true,
            changeYear:true,
            yearRange:'1970:+0',
            dateFormat:'yy-mm-dd',
            onSelect:function(dateText){
                var DateCreated = $('#StartDate').val();
                listSales(DateCreated);
            }
        });
        function listSales(criteria1)
        {
            $.ajax({
                type : 'get',
                url : "<?php echo url('/getdailyreport'); ?>",
                data : {DateCreated:criteria1},
                success:function(data)
                {
                    $('#daily-report').empty().html(data);
                }
            })
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>