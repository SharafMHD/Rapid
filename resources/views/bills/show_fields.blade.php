
<section class="invoice" >
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> RAPID, Inc.
          <small class="pull-right"> {!! $bills->created_at !!}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>RAPID, Inc.</strong><br>
          Khartoum almarad street<br>
          Phone: 2397<br>
          Email: info@rapid.sd
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong>{!! $bills->customers->name !!}</strong><br>
          {!! $bills->customers->address !!}<br>
          Phone: {!! $bills->customers->phone !!}<br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice #{!! $bills->code !!}</b><br>
        <br>
        <b>Order ID:</b> #{!! $orders->order_code !!}<br>
        <b>Payment Due:</b> {!! $bills->bill_date !!}<br>

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
   
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-responsive table-bordered table-striped">
          <thead>
          <tr>
            <th>Item Code</th>
            <th>Item Name</th>
            <th>Unit</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Total Price</th>
            <th>Remark</th>
          </tr>
          </thead>
          <tbody>
                @foreach($bill_detaisl as $billdetaisl)
          <tr>
            <td>{!! $billdetaisl->items->code !!}</td>
            <td>{!! $billdetaisl->items->name !!}</td>
            <td>{!! $billdetaisl->units->name !!}</td>
            <td>{!! $billdetaisl->qty !!}</td>
            <td>{!! $billdetaisl->unit_price !!}</td>
            <td>{!! $billdetaisl->total_price !!}</td>
            <td>{!! $billdetaisl->remark !!}</td>
          </tr>
          @endforeach

          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p class="lead">Payment Methods:</p>
        <img src="https://adminlte.io/themes/AdminLTE/dist/img/credit/visa.png" alt="Visa">
        <img src="https://adminlte.io/themes/AdminLTE/dist/img/credit/mastercard.png" alt="Mastercard">
        <img src="https://adminlte.io/themes/AdminLTE/dist/img/credit/american-express.png" alt="American Express">
        <img src="https://adminlte.io/themes/AdminLTE/dist/img/credit/paypal2.png" alt="Paypal">

        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
          dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
        </p>
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="lead">Amount Due {!! $bills->bill_date !!}</p>

        <div class="table-responsive">
          <table class="table">
            <tbody><tr>
              <th style="width:50%">Subtotal:</th>
              <td>{!! $bills->amount !!}</td>
            </tr>
            <tr>
              <th>Discount</th>
              <td>{!! $bills->discount !!}</td>
            </tr>
          
            <tr>
              <th>Total:</th>
              <td>{!! $bills->amount !!}</td>
            </tr>
          </tbody></table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-xs-12">
          
        {{-- <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> --}}
        <a type="button" class="btn btn-success pull-right"  target="_blank" href="/bills/Print/{!! $bills->id !!}"><i class="fa fa-print"></i> Print
        </a>
        <a type="button" class="btn btn-primary pull-right" href="{!! route('bills.index') !!}" style="margin-right: 5px;">
          <i class="fa fa-backward"></i> Back
        </a>
      </div>
    </div>
  </section>
