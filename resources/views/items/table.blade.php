<table class="table table-responsive table-bordered table-striped DataTable" id="items-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Category Id</th>
        <th>Unit Id</th>
        <th>Size</th>
        <th>Code</th>
        <th>Type</th>
        <th>Description</th>
            <th colspan="1">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($items as $items)
        <tr>
            <td>{!! $items->name !!}</td>
            <td>{!! $items->itemsCategory->name !!}</td>
            <td>{!! $items->units->name !!}</td>
            <td>{!! $items->size !!}</td>
            <td>{!! $items->code !!}</td>
            <td>{!! $items->type !!}</td>
            <td>{!! $items->description !!}</td>
            <td width="8%">
                {!! Form::open(['route' => ['items.destroy', $items->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('items.show', [$items->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('items.edit', [$items->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>