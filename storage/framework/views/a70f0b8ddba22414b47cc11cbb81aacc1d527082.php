<?php $__env->startSection("content"); ?>
<div class="panel panel-default">
    <div class="panel-heading">Edit Chicks Customer</div>
    <div class="panel-body">
        <?php if(Session::has('message')): ?>
            <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
        <?php endif; ?>
        <?php echo Form::model($customer,['method'=>'PATCH', 'action'=>['ChickCustomerController@update', $customer], 'files'=>true]); ?>

            <div class="form-group col-md-4">
                <?php echo Form::text('name', null, array('required', 'class'=> 'form-control', 'placeholder'=> 'Enter Customer Name')); ?>

            </div>
            <div class="form-group col-md-4">
                <?php echo Form::text('phone', null, array('required', 'class' => 'form-control', 'placeholder' =>'Phone No')); ?>

            </div>
            <div class="form-group col-md-4">
                <?php echo Form::file('image', null, array('required', 'class'=>'form-control')); ?>

            </div>
            <div class="form-group col-md-7">
                <?php echo Form::textarea('address', null, array('required', 'class'=>'form-control', 'placeholder'=> 'Enter Customer Address here')); ?>

            </div>
                <div class="col-md-5 editing-img">
                    <img src="<?php echo e(asset($customer->image)); ?>" class="img-responsive img-rounded img-editing" alt="">
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-md-4">
                    <label for="balance">Previous Balance</label>
                    <?php echo Form::number('balance', null, array('required', 'step'=>'any', 'class'=>'form-control', 'id'=>'balance', 'placeholder'=> 'Tk. 0.00')); ?>

                </div>
                <div class="form-group col-md-4">
                <label for="payment">Payment</label>
                <?php echo Form::number('payment', null, array('required', 'step'=>'any', 'class'=>'form-control', 'id'=>'payment', 'placeholder'=> 'Tk. 0.00')); ?>

                </div>
                <div class="col-md-2 form-group">
                    <?php echo Form::submit('Update Customer', array('class'=> 'btn btn-primary complete-btn')); ?>

                </div>
        <?php echo Form::close(); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>