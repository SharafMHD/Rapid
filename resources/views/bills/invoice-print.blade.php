<html>
<head>
  <meta charset="UTF-8">
  <title>RAPID || LOGISTICS</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
        <div class="wrapper">
          <!-- Main content -->
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
                <table class="table table-striped table-bordered">
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
        
         </div>
          </section>
        
        </body>

    </html>
    