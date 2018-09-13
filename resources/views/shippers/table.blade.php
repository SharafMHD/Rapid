<table class="table table-responsive table-bordered table-striped DataTable" id="shippers-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Remark</th>
            <th colspan="1">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($shippers as $shippers)
        <tr>
            <td>{!! $shippers->name !!}</td>
            <td>{!! $shippers->phone !!}</td>
            <td>{!! $shippers->address !!}</td>
            <td>{!! $shippers->remark !!}</td>
            <td width="8%">
                {!! Form::open(['route' => ['shippers.destroy', $shippers->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('shippers.show', [$shippers->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('shippers.edit', [$shippers->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>