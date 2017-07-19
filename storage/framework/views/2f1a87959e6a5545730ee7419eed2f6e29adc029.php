<?php $__env->startSection('content'); ?>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h2>Bird Buy/Sale/Collection & Profit</h2>
                        <div class="row hidden-print complete-btn">
                            <div class="col-md-3">
                                <div class="form-group form-inline">
                                    <label for="StartDate">From</label>
                                    <input type="text" name="StartDate" id="StartDate" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-inline">
                                    <label for="EndDate">To</label>
                                    <input type="text" name="EndDate" id="EndDate" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body" id="list-summary-report">
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
                            <tbody>
                            <?php $__currentLoopData = $birdreports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reportsummary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($reportsummary->created_at->format('d-m-Y')); ?></td>
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
                            </tbody>
                        </table>
                        
                        
                        
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
                var EndDate = $('#EndDate').val();

                listSales(DateCreated,EndDate);
            }
        });
        $("#EndDate").datepicker({
            changeDate:true,
            changeMonth:true,
            changeYear:true,
            yearRange:'1970:+0',
            dateFormat:'yy-mm-dd',
            onSelect:function(dateText){
                var DateCreated = $('#StartDate').val();
                var EndDate = $('#EndDate').val();
                listSales(DateCreated, EndDate);
            }
        });
        function listSales(criteria1, criteria2)
        {
            $.ajax({
                type : 'get',
                url : "<?php echo url('/reports/getbirdreportsummary'); ?>",
                data : {DateCreated:criteria1,EndDate:criteria2},
                success:function(data)
                {
                    $('#list-summary-report').empty().html(data);
                }
            })
        }

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>