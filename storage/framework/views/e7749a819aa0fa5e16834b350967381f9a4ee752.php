<?php $__env->startSection("content"); ?>
<div class="panel panel-default">
    <div class="panel-heading">Add New Supplier</div>
    <div class="panel-body">
        <?php if(Session::has('message')): ?>
            <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
        <?php endif; ?>
        <?php echo Form::model($supplier,['method'=>'PATCH', 'action'=>['FeedSupplierController@update', $supplier], 'files'=>true]); ?>

            <div class="form-group col-md-4">
                <?php echo Form::text('supplier_name', null, array('required', 'class'=> 'form-control', 'placeholder'=> 'Enter Supplier Name')); ?>

            </div>
            <div class="form-group col-md-4">
                <?php echo Form::text('phone', null, array('required', 'class' => 'form-control', 'placeholder' =>'Phone No')); ?>

            </div>
            <div class="form-group col-md-4">
                <?php echo Form::file('image', null, array('required', 'class'=>'form-control')); ?>

            </div>
            <div class="form-group col-md-7">
                <?php echo Form::textarea('address', null, array('required', 'class'=>'form-control', 'placeholder'=> 'Enter Supplier Address here')); ?>

            </div>
            <div class="col-md-5 editing-img">
                <img src="<?php echo e(asset($supplier->image)); ?>" class="img-responsive img-rounded img-editing" alt="">
            </div>
            <div class="clearfix"></div>
            <div class="col-md-3 form-group complete-btn">
                <?php echo Form::submit('Update Feed Supplier', array('class'=> 'btn btn-primary')); ?>

            </div>
        <?php echo Form::close(); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>