<?php $__env->startSection('content'); ?>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-2">
                                List of Expenses
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
                                <a href="expenses/create"><span class="glyphicon glyphicon-plus pull-right"></span></a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body" id="list-of-expenses" >
                        <?php if(Session::has('message')): ?>
                            <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
                        <?php endif; ?>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Created At</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Unit Amount</th>
                                    <th>Total Amount</th>
                                    <th>Created By</th>
                                    <?php if($user == 'admin'): ?>
                                    <th colspan="2">Actions</th>
                                        <?php else: ?>
                                        <th>Action</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($expense->id); ?></td>
                                    <td><?php echo e($expense->created_at->format('d-m-Y')); ?></td>
                                    <td><?php echo e($expense->expense_category->name); ?></td>
                                    <td><?php echo e($expense->description); ?></td>
                                    <td><?php echo e($expense->qty); ?></td>
                                    <td><?php echo e($expense->unit_expense); ?></td>
                                    <td><?php echo e($expense->total); ?></td>
                                    <td><?php echo e($expense->user->name); ?></td>

                                    <td>
                                        <a href="expenses/<?php echo e($expense->id); ?>/edit"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                    <?php if($user == 'admin'): ?>
                                    <td><a href="#" onclick="return confirm('are you sure?')">
                                        <?php echo Form::open(['method'=> 'DELETE', 'route'=>['expenses.destroy', $expense->id]]); ?>

                                        <?php echo Form::submit('X', ['class'=> 'btn btn-danger btn-small']); ?>

                                        <?php echo Form::close(); ?></a>
                                    </td>
                                        <?php endif; ?>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class="paginatios col-lg-12">
                            <?php echo $expenses->render(); ?>

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
                url : "<?php echo url('/getexpense'); ?>",
                data : {DateCreated:criteria1,EndDate:criteria2},
                success:function(data)
                {
                    $('#list-of-expenses').empty().html(data);
                }
            })
        }

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>