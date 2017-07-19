<?php $__env->startSection("content"); ?>
    <?php echo Html::script('js/angular.min.js', array('type' => 'text/javascript')); ?>

    <?php echo Html::script('js/purchase.js', array('type' => 'text/javascript')); ?>

<div class="panel panel-default" ng-app="purchaseApp">
    <div class="panel-heading">Add New Expense</div>
    <div class="panel-body" ng-controller="purchaseController">
    <?php echo Form::open(['route'=>'expenses.store', 'files'=>true]); ?>


    <div class="form-group col-md-4">
        <label for="expense_category">Select a Expense Category : </label>
        <?php echo Form::select('expense_category_id', $expense_categories, null, array('required', 'class'=> 'form-control', 'id'=> 'expense_category', 'placeholder'=>'Select a supplier')); ?>

    </div>
    <div class="form-group col-md-12">
        <?php echo Form::textarea('description', null, array('required', 'class'=>'form-control', 'placeholder'=> 'Enter Expense Description here')); ?>

    </div>
    <div class="form-group col-md-3">
        <label for="qty" >Enter Quantity : </label>
        <?php echo Form::number('qty', null, array('required', 'id'=> 'qty', 'class' => 'form-control', 'ng-model'=>'exqty')); ?>

    </div>
    <div class="form-group col-md-3">
        <label for="unit_expense" >Unit Expense : </label>
        <?php echo Form::number('unit_expense', null, array('required', 'step' => 'any', 'id'=> 'unit_expense', 'class' => 'form-control', 'ng-model'=>'unitExpense')); ?>

    </div>
    <div class="form-group col-md-2">
        <label for="sub_total">Total : </label>
        <div class="sub_total_text"><span data-ng-bind="exqty * unitExpense | currency"></span></div>
    </div>

        <div class="col-md-2 form-group">
            <?php echo Form::submit('Add Expense', array('class'=> 'btn btn-primary complete-btn')); ?>

        </div>
    <?php echo Form::close(); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>