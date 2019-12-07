<?php
use App\Http\Controllers\brokerController;
use App\Http\Controllers\companyController;

$total_companies=0;
$total_brokers=0;


?>
 @extends('layouts.app')
 @section('content')

      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
 <!-- Small boxes (Stat box) -->
        <div class="row">
          <form action="search_invoice" method="post" class="">
            <input type="hidden" value="list_invoices" name="page">
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="box-body">
                <div class="form-group">
                  <label>Company</label>
                  <select class="form-control select2" style="width: 100%;" name="c_name">
                   <option selected="selected" value="0">All</option>
                   @foreach ($companies as $company)
                   <option  value="{{$company['name']}}">{{$company['name']}}</option>
                   <?php
                   $total_companies++;
                   ?> 
                   @endforeach
                 </select>
               </div>

             </div>
           </div>
          <!-- ./col -->
          <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="box-body">
              <div class="form-group">
                <label>MONTH</label>
                <select class="form-control select2" style="width: 100%;" name="month">
                  <option selected="selected" value="0">All</option>
                  <option value="1">January</option>
                  <option value="2">February</option>
                  <option value="3">March</option>
                  <option value="4">April</option>
                  <option value="5">May</option>
                  <option value="6">June</option>
                  <option value="7">July</option>
                  <option value="8">August</option>
                  <option value="9">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
                </select>
                <br>

                
              </div>


            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="box-body">
              <div class="form-group">
                <label>Invoice</label>
                <select class="form-control select2" style="width: 100%;" name="iid">
                 <option selected="selected" value="0">All</option>
                 @foreach ($allinvoices as $allinvoice)

                 <option value="{{$allinvoice['iid']}}">{{$allinvoice['iid']}}</option>
                 @$total_brokers++
                 @endforeach
               </select>
             </div>


           </div>
         </div>
         <!-- ./col -->
         <!-- ./col -->
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="box-body">
            <div class="form-group">
              <label><br></label>
              @csrf
              <input type="submit" name="Search" class="btn btn-block btn-info" value="Search">
            </div>


          </div>
        </div>
        <!-- ./col -->
      </form>
    </div>
       <!-- /.row -->
       <!-- main row -->
       <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Invoices</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover" class="col-xs-12">
                <thead>
                  
                  <tr>
                        <th>Invoice I'D</th>
                  <th>Quatity</th>
                  <th>Total Cost</th>
                  <th>Company Name</th>
                  <th>Sales Tax</th>
                  <th>Sales Tax Value</th>
                  <th>Cost Including Sales Tax</th>
                  <th>View</th>
                  <th>Payment Received</th>
                  <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($invoices as $invoice)
                  <tr>
                    <td>{{$invoice['iid']}}</td>
                    <?php
                    
                    $brokers = new brokerController;
                        // $broker=$brokers->return_broker($bilty['bid']);
                    $companies = new companyController;
                        // $company=$companies->return_company($bilty['cid']);

                    ?>
                    <td>{{$invoice['b_quantity']}}</td>
                    <td>{{$invoice['total_cost']}}</td>
                    <td> {{$invoice['c_name']}}</td>
                    <td>{{$invoice['sales_tax']}}</td>
                    <td>{{$invoice['salex_tax_value']}}</td>
                    <td>{{$invoice['cost_inc_tax']}}</td>
                    <td><a href="{{ url('view_invoice'.$invoice['iid'])}}"> <button>view</button></a> </td>  
                    <?php 

                    

                      echo "
                
                      <th>{$invoice['payment_received']}</th>";
                  
                    ?>
                    
                    <td>{{$invoice['created_at']}}</td>
                  </tr>
                  @endforeach
         
                </tbody>
                <tfoot >
                 <tr>
                  <th>Invoice I'D</th>
                  <th>Quatity</th>
                  <th>Total Cost</th>
                  <th>Company Name</th>
                  <th>Sales Tax</th>
                  <th>Sales Tax Value</th>
                  <th>Cost Including Sales Tax</th>
                  <th>View</th>
                  <th>Payment Received</th>
                  <th>Date</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

        
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row (main row) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
           <?php

           $total_cost=0;
           foreach ($invoices as $invoice)
           {
            $total_cost=$total_cost+$invoice['cost_inc_tax'];
          }
          ?>
          <h3>
            <?php
            echo $total_cost;
            ?>
          </h3>

          <p>Total Cost</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
         <?php

         $total_debit=0;
         foreach ($invoices as $invoice)
         {
          $total_debit=$total_debit+$invoice['payment_received'];
        }
        ?> 
        
        <h3>
          <?php
          echo $total_cost-$total_debit;
          ?>
        </h3>
        <p>Payment_remaining</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">

        <h3>
          <?php
          echo $total_companies;
          ?>
        </h3>

        <p>Companies</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">

        <h3><?php
        echo $total_brokers;
        ?></h3>
        <p>Brokers</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="#" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.4.0
  </div>
  <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Soft Links</a>.</strong> All rights
  reserved.
</footer>

 </div>
 <!-- ./wrapper -->

 <!-- jQuery 3 -->
 <script src="public/bower_components/jquery/dist/jquery.min.js"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="public/bower_components/jquery-ui/jquery-ui.min.js"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="public/bower_components/raphael/raphael.min.js"></script>
<script src="public/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="public/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="public/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="public/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="public/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="public/bower_components/moment/min/moment.min.js"></script>
<script src="public/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="public/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="public/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="public/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="public/dist/js/demo.js"></script>

<script src="vendor/mckenziearts/laravel-notify/public/js/notify.js"></script>
<!-- jQuery 3 -->

<script src="public/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="public/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
@endsection