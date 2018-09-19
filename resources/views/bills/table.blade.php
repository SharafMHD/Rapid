<table class="table table-responsive table-bordered table-striped DataTable" id="bills-table">
    <thead>
        <tr>
            <th>Billdate</th>
        <th>Code</th>
        <th>Customer Id</th>
        <th>Shipper Id</th>
        <th>User Id</th>
        <th>Status</th>
        <th>Discount</th>
            <th colspan="1">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($bills as $bills)
        <tr>
            <td>{!! $bills->billdate !!}</td>
            <td>{!! $bills->code !!}</td>
            <td>{!! $bills->customers->name !!}</td>
            <td>{!! $bills->shippers->name !!}</td>
            <td>{!! $bills->user->name !!}</td>
            <td>{!! $bills->status !!}</td>
            <td>{!! $bills->discount !!}</td>
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