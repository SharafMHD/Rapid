@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Bills
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="row">
                <div class="col-md-12">
                    
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                          <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Invoice Info</a></li>
                            <li><a href="#tab_2" data-toggle="tab">Invoice Details</a></li>

                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                          </ul>
                          <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                    <div class="box box-success">

                                            <div class="box-body">
                                                <div class="row">
                                                    {!! Form::open(['route' => 'bills.store']) !!}
                                                        @include('bills.fields')
                                
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                    <div class="box box-danger">
                                            <div class="box-body">
                                                <div class="row">
                                                        <h4 class="form-section">Add Items</h4>
                                                        <hr/>
                   <!-- Submit Field -->
<div class="form-group col-sm-12">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('bills.index') !!}" class="btn btn-default">Cancel</a>
    </div>
</div>
</div>
</div>
                            </div>
                       
                          </div>
                          <!-- /.tab-content -->
                        </div>
                        <!-- nav-tabs-custom -->
                    
                    </div>
        </div>

    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript">
    </script>
    <script type="text/javascript">
        //this will fail
        $(document).ready( function() { 
            GenerateID('code');
         } );
        </script>
@endsection

