@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Shippers
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($shippers, ['route' => ['shippers.update', $shippers->id], 'method' => 'patch']) !!}

                        @include('shippers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection