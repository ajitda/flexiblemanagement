<?php $__env->startSection('content'); ?>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row sales_heading">
                            <div class="col-md-2">
                                Bird Sales List
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-inline">
                                    <label for="StartDate">From</label>
                                    <input type="text" name="StartDate" id="StartDate" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-inline">
                                    <label for="EndDate">To</label>
                                    <input type="text" name="EndDate" id="EndDate" class="form-control" required />
                                </div>
                            </div>
                           <div class="col-md-2">
                               <a href="sales/create"><span class="glyphicon glyphicon-plus pull-right"></span></a>
                           </div>
                        </div>
                    </div>
                    <?php if(count($sales)): ?>
                    <div class="panel-body" id="list-sale-report">
                        <?php if(Session::has('message')): ?>
                            <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
                        <?php endif; ?>
                        <table class="table table-bordered table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Created at</th>
                                    <th>Customers</th>
                                    <th>Suppliers</th>
                                    <th>Qty</th>
                                    <th>Weight</th>
                                    <th>Total Weight</th>
                                    <th>Price Per Kg</th>
                                    <th>Subtotal</th>
                                    <th>Death Qty</th>
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
                            <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($sale->id); ?></td>
                                    <td><?php echo e($sale->created_at->format('d-m-Y')); ?></td>
                                    <td><a href="customers/<?php echo e($sale->customer->id); ?>"><?php echo e($sale->customer->name); ?></a></td>
                                    <td><?php echo e($sale->supplier->supplier_name); ?></td>
                                    <td><?php echo e($sale->qty); ?></td>
                                    <td><?php echo e($sale->weight); ?></td>
                                    <td><?php echo e($sale->tweight); ?></td>
                                    <td><?php echo e($sale->price_per_kg); ?></td>
                                    <td><?php echo e($sale->sub_total); ?></td>
                                    <td><?php echo e($sale->death_qty); ?></td>

                                    <td><?php echo e($sale->total); ?></td>
                                    <td><?php echo e($sale->less); ?></td>
                                    <td><?php echo e($sale->payment); ?></td>
                                    <td><?php echo e($sale->dues); ?></td>

                                    <td>
                                        <a href="sales/<?php echo e($sale->id); ?>/edit"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                    <?php if($user=='admin'): ?>
                                    <td><a href="#" onclick="return confirm('are you sure?')">
                                        <?php echo Form::open(['method'=> 'DELETE', 'route'=>['sales.destroy', $sale->id]]); ?>

                                        <?php echo Form::submit('X', ['class'=> 'btn btn-danger btn-small']); ?>

                                        <?php echo Form::close(); ?></a>
                                    </td>
                                        <?php endif; ?>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class="paginatios col-lg-12">
                            <?php echo $sales->render(); ?>

                        </div>
                    </div>
                    <?php endif; ?>
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
                url : "<?php echo url('/birds/sales/getsaleslist'); ?>",
                data : {DateCreated:criteria1,EndDate:criteria2},
                success:function(data)
                {
                    $('#list-sale-report').empty().html(data);
                }
            })
        }

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>