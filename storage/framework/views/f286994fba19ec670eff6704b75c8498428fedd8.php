<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row sales_heading">
                            <div class="col-md-2">
                                Chicks Purchases
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
                                <a href="chickpurchases/create" class="pull-right"><span class="glyphicon glyphicon-plus pull-right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body" id="purchase-list">
                        <?php if(Session::has('message')): ?>
                            <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
                        <?php endif; ?>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Created at</th>
                                    <th>Suppliers</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Subtotal</th>
                                    <th>Costing</th>
                                    <th>Total</th>
                                    <th>Less</th>
                                    <th>Payment</th>
                                    <th>Dues</th>
                                    <?php if($user == 'admin'): ?>
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
                                    <td><?php echo e($purchase->created_at->format('Y-m-d')); ?></td>
                                    <td><?php echo e($purchase->chick_supplier->supplier_name); ?></td>
                                    <td><?php echo e($purchase->qty); ?></td>
                                    <td><?php echo e($purchase->unit_price); ?></td>
                                    <td><?php echo e($purchase->sub_total); ?></td>
                                    <td><?php echo e($purchase->costing); ?></td>
                                    <td><?php echo e($purchase->total); ?></td>
                                    <td><?php echo e($purchase->less); ?></td>
                                    <td><?php echo e($purchase->payment); ?></td>
                                    <td><?php echo e($purchase->dues); ?></td>
                                    <td>
                                        <a href="chickpurchases/<?php echo e($purchase->id); ?>/edit"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                    <?php if($user == 'admin'): ?>
                                    <td><a href="#" onclick="return confirm('are you sure?')">
                                        <?php echo Form::open(['method'=> 'DELETE', 'route'=>['chickpurchases.destroy', $purchase->id]]); ?>

                                        <?php echo Form::submit('X', ['class'=> 'btn btn-danger btn-small']); ?>

                                        <?php echo Form::close(); ?></a>
                                    </td>
                                        <?php endif; ?>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class="paginatios col-lg-12">
                            <?php echo $purchases->render(); ?>

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
                url : "<?php echo url('/chicks/purchases/getpurchaselist'); ?>",
                data : {DateCreated:criteria1,EndDate:criteria2},
                success:function(data)
                {
                    $('#purchase-list').empty().html(data);
                }
            })
        }

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>