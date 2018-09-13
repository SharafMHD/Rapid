<table class="table table-responsive table-bordered table-striped DataTable" id="customers-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Shipper</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Remark</th>
            <th colspan="1">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($customers as $customers)
        <tr>
            <td>{!! $customers->name !!}</td>
            <td>{!! $customers->shippers->name !!}</td>
            <td>{!! $customers->phone !!}</td>
            <td>{!! $customers->address !!}</td>
            <td>{!! $customers->remark !!}</td>
            <td width="8%">
                {!! Form::open(['route' => ['customers.destroy', $customers->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('customers.show', [$customers->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('customers.edit', [$customers->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>