<!-- Items Id Field -->
<div class="form-group col-sm-4">
        {!! Form::label('item_id', 'Item:') !!}
        {!! Form::select('item_id',  $items, null, ['class' => 'form-control select2']) !!}
    </div>
    <!-- Description Field -->
<div class="form-group col-sm-4">
    {!! Form::label('remark', 'Description:') !!}
    {!! Form::text('remark', null, ['class' => 'form-control']) !!}
</div>
<!-- Qty Field -->
      <div class="form-group col-sm-4">
            {!! Form::label('qty', 'Qty :') !!}
      <div class="input-group ">
            <!-- /btn-group -->
            {!! Form::text('qty', null, ['class' => 'form-control']) !!}
                      {{-- <input type="text" class="form-control "> --}}
                      <div class="input-group-btn input-xsmall">
                        <button type="button" onclick="getitem();" class="btn btn-success"><i class="fa fa-plus"></i> Go!</button>
                      </div>
                    
                    </div>
                      </div>
                      <h4 class="form-section">Invoice Details</h4>
                                                        <hr/>
                      <!-- tems Table Field -->
                     <!-- Submit Field -->
<div class="form-group col-sm-12">
                            <table class="table table-responsive table-bordered table-striped" id="tbl_invoiceDetails">
                                <thead>
                                <tr>
                                    <th >Item Name</th>
                                    <th>Unit</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                    <th>Remark</th>
                                    <th width="5%">Tools</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-xs-9">

                            </div>
                            <!-- /.col -->
                            <div class="col-xs-3">
                              <div class="table-responsive">
                                <table class="table">
                                  <tbody><tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td id=lblsubtotal>0</td>
                                  </tr>
                                  <tr>
                                    <th>Total:</th>
                                    <td id="lbltotal">0</td>
                                  </tr>
                                </tbody></table>
                              </div>
                            </div>
                            <!-- /.col -->
                          </div>

