<table class="table table-responsive table-bordered table-striped DataTable" id="cities-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Country</th>
            <th colspan="1">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($cities as $cities)
        <tr>
            <td>{!! $cities->name !!}</td>
            <td>{!! $cities->countries->name !!}</td>
            <td width="8%">
                {!! Form::open(['route' => ['cities.destroy', $cities->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('cities.show', [$cities->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('cities.edit', [$cities->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>