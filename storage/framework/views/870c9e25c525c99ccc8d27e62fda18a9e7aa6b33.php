<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Employee</div>
                    <div class="panel-body">
                        <?php if($errors ->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <?php echo Form::model($employee,['method'=>'PATCH', 'action'=>['EmployeeController@update', $employee], 'files'=>true]); ?>


                            <div class="form-group col-md-8">
                                <?php echo Form::text('name', null, array('required', 'class'=> 'form-control', 'placeholder'=> 'Enter Employee Name')); ?>

                            </div>
                            <div class="form-group col-md-8">
                                <?php echo Form::email('email', null, array('required', 'class' => 'form-control', 'placeholder' =>'Enter Email')); ?>

                            </div>
                            <div class="form-group col-md-8">
                                <?php echo Form::select('role',  array('admin'=>'Admin', 'editor'=>'Editor', 'general'=>'General'), null, array('required', 'class'=>'form-control')); ?>

                            </div>
                            <div class="form-group col-md-8">
                                <input type="password" name="password", placeholder="Type a new password" class="form-control" required>
                            </div>
                            <div class="form-group col-md-8">
                                <input type="password" name="confirmed_password" placeholder="Confirm Password" class="form-control" required>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-3 form-group">
                                <?php echo Form::submit('Update Employee', array('class'=> 'btn btn-primary')); ?>

                            </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>