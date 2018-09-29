<table class="table table-responsive table-bordered table-striped DataTable" id="orders-table">
    <thead>
        <tr>
            <th>Order Code</th>
        <th>Order Date</th>
        <th>Shipping Date</th>
        <th>Delivery Date</th>
        <th>Recipient</th>
        <th>Recipient Phone</th>
        <th>Recipient Address</th>
        <th>Pickup Location</th>
        <th>Drop Location</th>
        <th>Bill code</th>
        <th>Status</th>
            <th colspan="1">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orders as $orders)
        <tr>
            <td>{!! $orders->order_code !!}</td>
            <td>{!! $orders->order_date !!}</td>
            <td>{!! $orders->shipping_date !!}</td>
            <td>{!! $orders->delivery_date !!}</td>
            <td>{!! $orders->recipient !!}</td>
            <td>{!! $orders->recipient_phone !!}</td>
            <td>{!! $orders->recipient_address !!}</td>
            <td>{!! $orders->pickup_location !!}</td>
            <td>{!! $orders->drop_location !!}</td>
            <td>{!! $orders->bills->code !!}</td>
            @if($orders->status =='Pending')         
            <td>
                    <span class="label label-danger"><i class="fa fa-clock-o"></i> {{ $orders->status }}</span>
                </td>  
                  @elseif($orders->status =='Delivered')  
                  <td>
                        <span class="label label-success"><i class="fa fa-clock-o"></i> {{ $orders->status }}</span>
                    </td>      
                    @else 
                  <td>
                        <span class="label label-info"><i class="fa fa-clock-o"></i> {{ $orders->status }}</span>
                    </td>     
      @endif
            <td width="8%">
                {!! Form::open() !!}
                <div class='btn-group'>
                    <a  target="_blank" href="/orders/Print/{!! $orders->id !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                    {{-- <a href="{!! route('orders.edit', [$orders->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a> --}}
                    {{-- {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} --}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>