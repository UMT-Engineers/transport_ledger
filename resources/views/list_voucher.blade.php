<?php
use App\Http\Controllers\brokerController;
use App\Http\Controllers\companyController;
use App\Http\Controllers\employeeController;
use App\Http\Controllers\invoiceController;

$total_companies=0;
$total_brokers=0;
?>
 @extends('layouts.app')
 @section('content')

      <!-- Main content -->
      <section class="content">
    <!-- /.row -->
    <!-- main row -->
    <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Create Invoice</h3>
                <a href="{{ url('create_voucher'.$type)}}"><button type="" class="btn btn-info pull-right" id="sbtbtn" name="Company" value="Company invoice">Create <?php
                     echo $type;
                ?> Voucher</button></a>

              </div>
              <!-- /.box-header -->
              <div class="box-body">
                
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

            
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              <?php

             if ($type=='cpv') {
               echo "Cash payment vouchers";
             }
             elseif ($type=='crv') {
              echo "Cash Receipt vouchers";

             }
             elseif ($type=='pcv') {
               echo "Journal vouchers";
             }
             else{
               echo "Commission voucher vouchers";
             }
              
              ?>
              
            </h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example2" class="table table-bordered table-hover" class="col-xs-12">
              <thead>

                <tr>
                  <th>Voucher No:</th>
                  <th>Amount</th>
                  @if($type=='crv')
                  <th>Invoice I'D:</th>
                  @else
                  <th>Broker Name:</th>
                  @endif
                  <th>View</th>
                  <th>Employee I'D:</th>
                  <th>Account No:</th>
                  <th>Cheque No:</th>
                  <th>Payee:</th>
                  <th>Created At:</th>
                </tr>
              </thead>
              <tbody>
                <?php
      $total_vouchers=0;
      $total_amount=0;
                ?>
                @foreach ($Vouchers as $Voucher)
                <tr>
                  <td>{{$Voucher['vid']}}</td>
                  <td>{{$Voucher['Amount']}}</td>
                  <?php
                  $total_amount=$total_amount+$Voucher['Amount'];
                  ?>
                   @if($type=='crv')
                  <td><a href="{{ url('view_invoice'.$Voucher['iid'])}}"> {{$Voucher['iid']}}</a></td>
                  @else
                  <td>
                    <?php
                    
                    if ($Voucher['bid']!=0) {
                        $brokers = new brokerController;
                  $broker=$brokers->return_broker($Voucher['bid']);
                  echo $broker['name'];
                    }
                  
                  ?>
                   </td>
                  @endif
                  
                    <td><a href="{{ url('view_voucher'.$Voucher['id'])}}">View</a></td>
                  <td>

                  <?php
                
                  $total_vouchers++;
                  if ($Voucher['eid']!=0) {
                      $employees = new employeeController;
                      $employee=$employees->return_employee($Voucher['eid']);
                      echo $employee['employee_name'];
                  }
                 

                  ?></td>
                  
                  <td>{{$Voucher['aid']}}</td>
                  <td >{{$Voucher['cheque_no']}}</td>
                   <td>{{$Voucher['payee']}}</td>
                  <td >{{$Voucher['created_at']}}</td>
                </tr>
                @endforeach
              </tbody>
              <tfoot >
               <tr>
                <th>Voucher No:</th>
                  <th>Amount:</th>
                   @if($type=='crv')
                  <th>invoice id</th>
                  @else
                  <th>Broker Name:</th>
                  @endif
                                    <th>View</th>

                  <th>Employee I'D:</th>
                  <th>Account No:</th>
                  <th>Cheque No:</th>
                  <th>Payee</th>
                  <th>Created At:</th>
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

        //  $total_cost=0;
        //  foreach ($biltys as $bilty)
        //  {
        //   $total_cost=$total_cost+$bilty['total_cost'];
        // }
        ?> 

        <h3>
          <?php
           echo $total_vouchers;
          ?>
        </h3>

        <p>Total Vouchers:</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="#" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
       <?php

      //  $total_debit=0;
      //  foreach ($biltys as $bilty)
      //  {
      //   $total_debit=$total_debit+$bilty['debit_cost'];
      // }
      ?> 

      <h3>
        <?php
        echo $total_amount;
        ?>
      </h3>
      <p>Total Amount:</p>
    </div>
    <div class="icon">
      <i class="ion ion-stats-bars"></i>
    </div>
    <a href="#" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-yellow">
    <div class="inner">

      <h3>
        <?php
       // echo $total_companies;
        ?>
      </h3>

      <p>Companies</p>
    </div>
    <div class="icon">
      <i class="ion ion-person-add"></i>
    </div>
    <a href="#" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-red">
    <div class="inner">
      <h3><?php
     // echo $total_brokers;
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
<!-- jQuery 3 -->

<script src="public/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="public/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="vendor/mckenziearts/laravel-notify/public/js/notify.js"></script>
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