<?php
use App\Http\Controllers\brokerController;
use App\Http\Controllers\companyController;

?>
 @extends('layouts.app')
 @section('content')
    <!-- Main content -->
     <section class="content">
      <form role="form" action="update_bilty_submit" method="POST">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Loading Point Detail</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                <div class="form-group">
                  <input type="hidden" name="buid" value="{{$bilty['buid']}}">
                  <label for="exampleInput">Bilty Number</label>
                  <input type="text" class="form-control" name="builty_no" placeholder="Enter weight" id="weight" name="builty_no" value="{{$bilty['builty_no']}}">
                </div>
                   <?php
                         
                         $brokers = new brokerController;
                         $broker=$brokers->return_broker($bilty['bid']);
                         $companies = new companyController;
                         $company=$companies->return_company($bilty['cid']);

                      ?>
                 <div class="form-group">
                  <label>Company Name</label>
                  <select class="form-control" name="cid">
                      <option selected="selected" value="{{$bilty['cid']}}">{{$company['name']}}</option>
                  </select>
                  <a href="create_company_form">create new</a>
                </div>
                <div class="form-group">
                  <label for="exampleInput">Weight</label>
                  <input type="text" class="form-control" name="weight" placeholder="Enter weight" id="weight" 
                  value="{{$bilty['c_weight']}}">
                </div>
                
                <div class="form-group">
                  <label for="exampleInput">Company Rate</label>
                  <input type="text" class="form-control" name="c_rate" placeholder="Enter Company rate" id="c_rate" onkeypress="Company_rate()" value="{{$bilty['b_rate']}}">
                </div>
                <div class="form-group">
                  <label for="exampleInput">Receiver's Name</label>
                  <input type="text" class="form-control" name="receiving_company" placeholder="Enter Receiver name" value="{{$bilty['receiving_company']}}">
                </div>
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Broker Detail</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
                          <div class="box-body" >
                            @csrf
                <div class="form-group">
                  <label>Broker Name</label>
                  <select class="form-control" name="bid">
                      <option selected="selected" value="{{$bilty['cid']}}">{{$broker['name']}}</option>
                  </select>
                   <a href="create_broker_form">Create New</a>
                </div>
                 <div class="row">
                  <!-- left column -->
                 <div class="col-md-4">
<div class="box-body">
                <div class="form-group">
                  <label for="exampleInput">Vehicle Number</label>
                  <input type="text" class="form-control" name="car_no" placeholder="car no" value="{{$bilty['car_no']}}">
                </div>
                 </div>
                 </div>
                 <div class="col-md-4">
<div class="box-body">
                <div class="form-group">
                  <label for="exampleInput">Driver Name</label>
                  <input type="text" class="form-control" name="driver_name" placeholder="Driver name" value="{{$bilty['driver_name']}}">
                </div>
                 </div>
                 </div>
                 <div class="col-md-4">
<div class="box-body">
                <div class="form-group">
                  <label for="exampleInput">CNIC</label>
                  <input type="text" data-inputmask="'mask': '99999-9999999-9'" class="form-control" name="cnic" placeholder="CNIC" value="{{$bilty['cnic']}}">
                </div>
                 </div>
                 </div>
               </div>
               <div class="form-group">
                  <label for="exampleInput">Broker Rate</label>
                  <input type="text" class="form-control" name="b_rate" placeholder="Broker rate" value="{{$bilty['b_rate']}}">
                </div>
                <div class="form-group">
                  <label for="exampleInput">Departure Place</label>
                  <input type="text" class="form-control" name="departure" placeholder="Enter Departure place" value="{{$bilty['departure']}}">
                </div>
                 <div class="form-group">
                  <label for="exampleInput">Destination Place</label>
                  <input type="text" class="form-control" name="destination" placeholder="Enter Destination place" value="{{$bilty['destination']}}">
                </div>
                 <div class="form-group">
                  <label for="exampleInput">Received Wight</label>
                  <input type="text" class="form-control" name="r_weight" placeholder="Enter Destination place" value="{{$bilty['r_weight']}}">
                </div>
                 <div class="box-footer">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-info pull-right">Save</button>
              </div>

              </div>

          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
          <!-- /.box -->
        </div>

      </div>
      <!-- /.row -->
       </form>
    </section>

    <!--main content-->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Soft Links</a>.</strong> All rights
    reserved.
  </footer>

  
<!-- ./wrapper -->
<script src="vendor/mckenziearts/laravel-notify/public/js/notify.js"></script>
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
  <script type="text/javascript">
            function Company_rate(){
            var first_number = parseInt(document.getElementsById("weight").value);
            var second_number = parseInt(document.getElementsById("c_rate").value);
            var result = first_number * second_number;
            document.getElementById("company_rate").innerHTML = result;    
            }
        </script>
</body>
</html>
@endsection