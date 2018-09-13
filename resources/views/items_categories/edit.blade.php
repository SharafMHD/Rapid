@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Items Category
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($itemsCategory, ['route' => ['itemsCategories.update', $itemsCategory->id], 'method' => 'patch']) !!}

                        @include('items_categories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection