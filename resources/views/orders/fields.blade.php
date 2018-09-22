<!-- Order Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_code', 'Order Code:') !!}
    {!! Form::text('order_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_date', 'Order Date:') !!}
    {!! Form::date('order_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Shipping Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shipping_date', 'Shipping Date:') !!}
    {!! Form::date('shipping_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Delivery Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('delivery_date', 'Delivery Date:') !!}
    {!! Form::date('delivery_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Recipient Field -->
<div class="form-group col-sm-6">
    {!! Form::label('recipient', 'Recipient:') !!}
    {!! Form::text('recipient', null, ['class' => 'form-control']) !!}
</div>

<!-- Recipient Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('recipient_address', 'Recipient Address:') !!}
    {!! Form::text('recipient_address', null, ['class' => 'form-control']) !!}
</div>

<!-- Pickup Location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pickup_location', 'Pickup Location:') !!}
    {!! Form::text('pickup_location', null, ['class' => 'form-control']) !!}
</div>

<!-- Drop Location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('drop_location', 'Drop Location:') !!}
    {!! Form::text('drop_location', null, ['class' => 'form-control']) !!}
</div>

<!-- Bill Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bill_id', 'Bill Id:') !!}
    {!! Form::text('bill_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('orders.index') !!}" class="btn btn-default">Cancel</a>
</div>
