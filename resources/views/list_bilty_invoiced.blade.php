<?php
use App\Http\Controllers\brokerController;
use App\Http\Controllers\companyController;

$total_companies=0;
$total_brokers=0;
?>
 @extends('layouts.app')
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">
  </script>
  <script src="jquery-1.8.3.js"></script>
  <script>       
    function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        alert("Please Enter number "); 
        return false;
      }
      return true;
    }       
  </script>  
  <script>
   $(document).ready(function() {

    $(function() {
      $('#sbtbtn').attr('disabled', 'disabled');
    });

    $('input[type=text],input[type=password]').keyup(function() {

      if ($('#r_weight').val() !='') {

        $('#sbtbtn').removeAttr('disabled');
      } else {
        $('#sbtbtn').attr('disabled', 'disabled');
      }
    });
  });
</script>   

@section('content')
      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
          <!-- Small boxes (Stat box) -->
        <div class="row">
          <form action="search" method="post" class="">
            <input type="hidden" value="list_bilty_invoiced" name="page">
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="box-body">
                <div class="form-group">
                  <label>Company</label>
                  <select class="form-control select2" style="width: 100%;" name="cid">
                   <option selected="selected" value="0">All</option>
                   @foreach ($companies as $company)
                   <option  value="{{$company['cid']}}">{{$company['name']}}</option>
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
                <label>Broker</label>
                <select class="form-control select2" style="width: 100%;" name="bid">
                  <option selected="selected" value="0">All</option>
                  @foreach ($brokers as $broker)
                  <option value="{{$broker['bid']}}">{{$broker['name']}}</option>
                  <?php
                  $total_brokers++;
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
                <label>Bilty</label>
                <select class="form-control select2" style="width: 100%;" name="buid">
                 <option selected="selected" value="0">All</option>
                 @foreach ($biltys as $bilty)
                 
                 <option value="{{$bilty['builty_no']}}">{{$bilty['builty_no']}}</option>
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
                <h3 class="box-title">Invoiced Bilties</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    
                    <tr>
                        <th>Builty No:</th>
                      <th>Company Name:</th>
                      <th>Broker Name:</th>
                      <th>Weight:</th>
                      <th>Total Cost:</th>
                      <th>Pay To Broker:</th>
                      <th>Invoice No:</th>
                      <th>View:</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($biltys as $bilty)
                    <tr>
                      <td>{{$bilty['builty_no']}}</td>
                      <?php
                         
                         $brokers = new brokerController;
                         $broker=$brokers->return_broker($bilty['bid']);
                         $companies = new companyController;
                         $company=$companies->return_company($bilty['cid']);

                      ?>
                    <td>{{$company['name']}}</td>
                      <td>{{$broker['name']}}</td>
                      <td> {{$bilty['c_weight']}}</td>
                      <th>{{$bilty['total_cost']}}</th>
                      <th>{{$bilty['pay_to_broker']}}</th>
                     
                     <td><a href="{{ url('view_invoice'.$bilty['iid'])}}"> <button>View</button>
                      <td> <a href="{{ url('view_bilty'.$bilty['buid'])}}"> View</a></td>
                    </tr>
                     @endforeach

                  </tbody>
                  <tfoot>
                     <tr>
               
                        <th>Builty No</th>
                      <th>Company Name</th>
                      <th>Broker Name</th>
                      <th>Weight</th>
                      <th>Total Cost</th>
                      <th>Pay To Broker</th>
                      <th>Invoice No</th>
                      <th>View</th> 
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
               foreach ($biltys as $bilty)
               {
                $total_cost=$total_cost+$bilty['total_cost'];
               }
              ?> 

              <h3>
              <?php
                echo $total_cost;
              ?>
              </h3>

              <p>Total Revenue</p>
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

             $total_debit=0;
               foreach ($biltys as $bilty)
               {
                $total_debit=$total_debit+$bilty['debit_cost'];
               }
              ?> 
              
              <h3>
              <?php
                echo $total_debit;
              ?>
              </h3>
              <p>Total Debit</p>
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
                echo $total_companies;
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
@include('layouts.footer')


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