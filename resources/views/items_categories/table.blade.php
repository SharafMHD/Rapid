<table class="table table-responsive table-bordered table-striped DataTable" id="itemsCategories-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Description</th>
            <th colspan="1">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($itemsCategories as $itemsCategory)
        <tr>
            <td>{!! $itemsCategory->name !!}</td>
            <td>{!! $itemsCategory->description !!}</td>
            <td width="8%">
                {!! Form::open(['route' => ['itemsCategories.destroy', $itemsCategory->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('itemsCategories.show', [$itemsCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('itemsCategories.edit', [$itemsCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>