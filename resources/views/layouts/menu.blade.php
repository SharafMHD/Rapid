
<li class="{{ Request::is('countries*') ? 'active' : '' }}">
    <a href="{!! route('countries.index') !!}"><i class="fa fa-globe-asia"></i><span>Countries</span></a>
</li>
<li class="{{ Request::is('cities*') ? 'active' : '' }}">
    <a href="{!! route('cities.index') !!}"><i class="fa fa-edit"></i><span>Cities</span></a>
</li>
<li class="{{ Request::is('units*') ? 'active' : '' }}">
    <a href="{!! route('units.index') !!}"><i class="fa fa-edit"></i><span>Units</span></a>
</li>

<li class="{{ Request::is('shippers*') ? 'active' : '' }}">
    <a href="{!! route('shippers.index') !!}"><i class="fa fa-edit"></i><span>Shippers</span></a>
</li>

<li class="{{ Request::is('customers*') ? 'active' : '' }}">
    <a href="{!! route('customers.index') !!}"><i class="fa fa-edit"></i><span>Customers</span></a>
</li>

<li class="{{ Request::is('itemsCategories*') ? 'active' : '' }}">
    <a href="{!! route('itemsCategories.index') !!}"><i class="fa fa-edit"></i><span>Items Categories</span></a>
</li>

<li class="{{ Request::is('items*') ? 'active' : '' }}">
    <a href="{!! route('items.index') !!}"><i class="fa fa-edit"></i><span>Items</span></a>
</li>

