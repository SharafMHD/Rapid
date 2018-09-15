<!-- Billdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('billdate', 'Bill date:') !!}
    {!! Form::date('billdate', null, ['class' => 'form-control']) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control','readonly']) !!}
</div>
<!-- Shipper Id Field -->
<div class="form-group col-sm-6">
        {!! Form::label('shipper_id', 'Shipper:') !!}
        {!! Form::select('shipper_id',  $shippers, null, ['class' => 'form-control select2']) !!}
    </div>
    <!-- Shipper Id Field -->
<div class="form-group col-sm-6">
        {!! Form::label('customer_id', 'Customer:') !!}
        {!! Form::select('customer_id',  $customers, null, ['class' => 'form-control select2']) !!}
    </div>
    <!-- shippingDate Field -->
<div class="form-group col-sm-6">
        {!! Form::label('shipping_date', 'Shipping date:') !!}
        {!! Form::date('shipping_date', null, ['class' => 'form-control']) !!}
    </div>
    <!-- DeliveryDAte Field -->
<div class="form-group col-sm-6">
        {!! Form::label('delivery_date', 'Delivery date:') !!}
        {!! Form::date('delivery_date', null, ['class' => 'form-control']) !!}
    </div>
    <!-- Isrecipient Field -->
<div class="form-group col-sm-2">
        {!! Form::label('isrecipient', 'Is Recipient:') !!}
        {!! Form::checkbox('isrecipient', null, ['class' => 'form-control '],['onClick' => 'GetRecpient();']) !!}
    </div>
    <!-- RecipientName Field -->
<div class="form-group col-sm-2">
        {!! Form::label('recipient', 'Recipient Name :') !!}
        {!! Form::text('recipient', null, ['class' => 'form-control']) !!}
    </div>
<!-- RecipientPhone Field -->
<div class="form-group col-sm-2">
    {!! Form::label('recipient_phone', 'Recipient Phone:') !!}
    {!! Form::text('recipient_phone', null, ['class' => 'form-control']) !!}
</div>
<!-- Recipient_address Field -->
<div class="form-group col-sm-6">
        {!! Form::label('Recipient_address', 'Recipient Address:') !!}
        {!! Form::text('Recipient_address', null, ['class' => 'form-control']) !!}
    </div>
    <!-- Pikup Field -->
<div class="form-group col-sm-6">
        {!! Form::label('pickup_location', 'Pick up :') !!}
        {!! Form::text('pickup_location', null, ['class' => 'form-control']) !!}
    </div>
        <!-- Pikup Field -->
<div class="form-group col-sm-6">
        {!! Form::label('drop_location', 'Drop off Location :') !!}
        {!! Form::text('drop_location', null, ['class' => 'form-control']) !!}
    </div>



