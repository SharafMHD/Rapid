@extends('layouts.app')

@section('content')
<section class="content-header">
        <h1>
          Dashboard
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="/home"><i class="fa fa-database"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>

<section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3>{!! $Pendingorders !!}</h3>
  
                <p>Pending Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/orders" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>{!! $completedorders !!}</h3>
                <p>Completed orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/orders" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>{!! $shippers !!}</h3>
  
                <p>Shippers</p>
              </div>
              <div class="icon">
                <i class="fa fa-shipping-fast"></i>
              </div>
              <a href="/shippers" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>{!! $customers !!}</h3>
  
                <p>customers</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-circle"></i>
              </div>
              <a href="/customers" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="col-md-8">
        <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Orders</h3>
    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                      <tr>
                        <th>Order code</th>
                        <th>Customer</th>
                        <th>Status</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach($recentOrders as $orders)
                        <tr>
                            <td><a target="_blank" href="/orders/Print/{!! $orders->id !!}">{!! $orders->order_code !!}</a></td>
                            <td>{!! $orders->bills->customers->name !!}</td>
                            @if($orders->status =='Pending')         
                            <td width="8%">
                                    <span class="label label-danger"><i class="fa fa-clock-o"></i> {{ $orders->status }}</span>
                                </td>  
                                  @elseif($orders->status =='Delivered')  
                                  <td width="8%">
                                        <span class="label label-success"><i class="fa fa-clock-o"></i> {{ $orders->status }}</span>
                                    </td>      
                                    @else 
                                  <td width="8%">
                                        <span class="label label-info"><i class="fa fa-clock-o"></i> {{ $orders->status }}</span>
                                    </td>     
                      @endif
                    </tr>
                    @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                  <a href="/bills/create" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                  <a href="/orders" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                </div>
                <!-- /.box-footer -->
              </div>
            </div>
            <div class="col-md-4">
                    <div class="box box-primary">
                            <div class="box-header with-border">
                              <h3 class="box-title">Recently Added customers</h3>
                
                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                              </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <ul class="products-list product-list-in-box">
                                    @foreach($recentcustomers as $customer)
                                    <li class="item">
                                         
                                            <div class="product-info">
                                              <a href="/customers/{!! $customer->id !!}" class="product-title">{!! $customer->name !!}
                                                <span class="label label-warning pull-right">{!! $customer->phone !!}</span></a>
                                              <span class="product-description">
                                                    {!! $customer->address !!}
                                                  </span>
                                            </div>
                                          </li>
                                     
                                @endforeach
                                

                                <!-- /.item -->
                              </ul>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer text-center">
                              <a href="/customers" class="uppercase">View All customers</a>
                            </div>
                            <!-- /.box-footer -->
                          </div>
                </div>
            </section>
@endsection
