<?php $__env->startSection("content"); ?>
    <?php echo Html::script('js/angular.min.js', array('type' => 'text/javascript')); ?>

    <?php echo Html::script('js/purchase.js', array('type' => 'text/javascript')); ?>

    <div class="panel panel-default" ng-app="purchaseApp">
        <div class="panel-heading">Edit Sale</div>
        <div class="panel-body" ng-controller="purchaseController">
            <?php if(Session::has('message')): ?>
                <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
            <?php endif; ?>
            <?php echo Form::model($sale,  ['method'=>'PATCH', 'action'=>['SaleController@update', $sale], 'files'=>true]); ?>

                <div class="form-group col-md-4">
                    <label for="customer_name">Select a Customer Name : </label>
                    <?php echo Form::select('customer_id', $customers, null, array('required', 'class'=> 'form-control', 'id'=> 'customer_name', 'placeholder'=>'Select a Customer')); ?>

                </div>
                <div class="form-group col-md-4">
                    <label for="supplier_name">Select a Supplier Name : </label>
                    <?php echo Form::select('supplier_id', $suppliers, null, array('required', 'class'=> 'form-control', 'id'=> 'supplier_name', 'placeholder'=>'Select a supplier')); ?>

                </div>
                <div class="clearfix"></div>

                <div class="form-group col-md-2">
                    <label for="qty" >Quantity : </label>
                    <?php echo Form::number('qty', null, array('required', 'id'=> 'qty', 'class' => 'form-control', 'ng-model'=>'qty','ng-init'=>"qty='$sale->qty'")); ?>

                </div>
                <div class="form-group col-md-2">
                    <label for="weight" >Weight (Kg ) : </label>
                    <?php echo Form::number('weight', null, array('required', 'step' => 'any', 'id'=> 'weight', 'class' => 'form-control', 'ng-model'=>'weight','ng-init'=>"weight='$sale->weight'")); ?>

                </div>
                <div class="form-group col-md-2">
                    <label for="tweight" >Total Weight (Kg ) : </label>
                    <?php echo Form::number('tweight', null, array('required', 'step' => 'any', 'id'=> 'tweight', 'class' => 'form-control', 'ng-model'=>'tweight','ng-init'=>"tweight='$sale->tweight'")); ?>

                </div>
                <div class="form-group col-md-2">
                    <label for="price_per_kg">Price Per Kg (Tk.): </label>
                    <?php echo Form::number('price_per_kg', null, array('required', 'step' => 'any','id'=> 'price_per_kg', 'class' => 'form-control', 'ng-model'=>'price_per_kg','ng-init'=>"price_per_kg='$sale->price_per_kg'")); ?>

                </div>
                <div class="form-group col-md-4">
                    <label for="sub_total">Subtotal : </label>
                    <div class="sub_total_text"><span data-ng-bind="tweight * price_per_kg | currency"></span></div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-md-2">
                    <label for="death_qty">Death Qty : </label>
                    <?php echo Form::number('death_qty', null, array('required', 'id'=> 'death_qty', 'class' => 'form-control', 'ng-model'=>'death_qty', 'ng-init'=>"death_qty='$sale->death_qty'")); ?>

                </div>
                <div class="form-group col-md-2">
                    <label for="payment_type">Payment Type : </label>
                    <?php echo Form::select('payment_type', array('Cheque'=>'cheque', 'Cash'=>'cash'), null, array('required', 'class'=> 'form-control', 'id'=> 'payment_type', 'placeholder'=>'Payment Type')); ?>

                </div>
                <div class="form-group col-md-2">
                    <label for="total">Total : </label>
                    <div class="sub_total_text"><span data-ng-bind="tweight * price_per_kg-(death_qty* weight * price_per_kg) | currency"></span></div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-md-2">
                    <label for="less">Less : </label>
                    <?php echo Form::number('less', null, array('required', 'id'=> 'less', 'step'=>'any', 'class' => 'form-control', 'ng-model'=>'less', 'ng-init'=>"less='$sale->less'")); ?>

                </div>
                <div class="form-group col-md-2">
                    <label for="payment">Payment : </label>
                    <?php echo Form::number('payment', null, array('required', 'step'=>'any', 'id'=> 'payment', 'class' => 'form-control', 'ng-model'=>'payment', 'ng-init'=>"payment='$sale->payment'")); ?>

                </div>
                <div class="form-group col-md-2">
                    <label for="dues">Dues : </label>
                    <div class="sub_total_text"><span data-ng-bind="tweight * price_per_kg-(death_qty* weight * price_per_kg)- payment - less | currency"></span></div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-2 form-group">

                    <?php echo Form::submit('Update', array('class'=> 'btn btn-primary complete-btn')); ?>

                </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>