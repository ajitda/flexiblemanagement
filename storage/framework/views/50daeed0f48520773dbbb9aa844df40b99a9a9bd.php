<?php $__env->startSection("content"); ?>
<div class="panel panel-default">
    <div class="panel-heading">Add New Customer</div>
    <div class="panel-body">
    <?php echo Form::open(['route'=>'customers.store', 'files'=>true]); ?>

    <div class="form-group col-md-4">
        <?php echo Form::text('name', null, array('required', 'class'=> 'form-control', 'placeholder'=> 'Enter Customer Name')); ?>

    </div>
    <div class="form-group col-md-4">
        <?php echo Form::text('phone', null, array('required', 'class' => 'form-control', 'placeholder' =>'Phone No')); ?>

    </div>
    <div class="form-group col-md-4">
        <?php echo Form::file('image', null, array('required', 'class'=>'form-control')); ?>

    </div>
    <div class="form-group col-md-12">
        <?php echo Form::textarea('address', null, array('required', 'class'=>'form-control', 'placeholder'=> 'Enter Customer Address here')); ?>

    </div>
    <div class="form-group col-md-4">
        <label for="balance">Previous Balance</label>
        <?php echo Form::number('balance', null, array('required', 'step'=>'any', 'class'=>'form-control', 'id'=>'balance', 'placeholder'=> 'Tk. 0.00')); ?>

    </div>
    <div class="form-group col-md-4">
        <label for="payment">Payment</label>
        <?php echo Form::number('payment', null, array('required', 'step'=>'any', 'class'=>'form-control', 'id'=>'payment', 'placeholder'=> 'Tk. 0.00')); ?>

    </div>

    <div class="col-md-2 form-group complete-btn">
        <?php echo Form::submit('Add Bird Customer', array('class'=> 'btn btn-primary')); ?>

    </div>
    <?php echo Form::close(); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>