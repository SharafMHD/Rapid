<table class="table table-responsive table-bordered table-striped DataTable" id="bills-table">
    <thead>
        <tr>
                <th>Code</th>
       <th>Bill date</th>
        <th>Customer name</th>
        <th>Shipper </th>
        <th>User name</th>
        <th>Amount</th>
        <th>paid</th>
        <th>remaining</th>
        <th>Discount</th>
        <th>Status</th>
            <th colspan="1">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($bills as $bills)
        <tr>
          <td>{!! $bills->code !!}</td>
            <td>{!! $bills->bill_date !!}</td>
            <td>{!! $bills->customers->name !!}</td>
            <td>{!! $bills->shippers->name !!}</td>
            <td>{!! $bills->users->name !!}</td>
            <td>{!! $bills->amount !!}</td>
            <td>{!! $bills->payed !!}</td>
            <td>{!! $bills->remainig !!}</td>
            <td>{!! $bills->discount !!}</td>
            @if($bills->status =='Pending')         
            <td>
                    <span class="label label-danger"><i class="fa fa-clock-o"></i> {{ $bills->status }}</span>
                </td>  
                  @elseif($bills->status =='Delivered')  
                  <td>
                        <span class="label label-success"><i class="fa fa-clock-o"></i> {{ $bills->status }}</span>
                    </td>      
                    @else 
                  <td>
                        <span class="label label-info"><i class="fa fa-clock-o"></i> {{ $bills->status }}</span>
                    </td>     
      @endif

         
            <td width="8%">
                {!! Form::open(['route' => ['bills.destroy', $bills->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('bills.show', [$bills->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('bills.edit', [$bills->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>