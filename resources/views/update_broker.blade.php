 @extends('layouts.app')
 @section('content')
    <!-- Main content -->
     <section class="content">
      <form role="form" action="update_broker_submit" method="POST">
      <div class="row">

        <!-- left column -->
       <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">broker Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <input type="hidden" name="bid" value="{{$broker['bid']}}">
            
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInput" class="col-sm-3" >broker Name</label>
                  <div class="col-md-3">
                  <input type="text" class="form-control" name="name" placeholder="Enter name" id="weight" value="{{$broker['name']}}">
                  </div>
                  <label for="exampleInput" class="col-sm-3">Phone</label>
                  <div class="col-md-3">
                  <input type="text" class="form-control" name="phone" placeholder="Enter phone" id="weight" value="{{$broker['phone']}}">
                </div>
                </div>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInput" class="col-sm-3" >Address</label>
                  <div class="col-md-3">
                  <input type="text" class="form-control" name="address" placeholder="Enter address" id="weight" value="{{$broker['address']}}">
                  </div>
                  <label for="exampleInput" class="col-sm-3">PTN</label>
                  <div class="col-md-3">
                  <input type="text" class="form-control" name="PTN" placeholder="Enter PTN" id="weight" value="{{$broker['PTN']}}">
                </div>
                </div>
              </div>
              <div class="box-body">
                 @csrf
                <div class="form-group">
                  <label for="exampleInput" class="col-sm-3">NTN</label>
                  <div class="col-md-3">
                  <input type="text" class="form-control" name="NTN" placeholder="Enter NTN" id="c_rate" value="{{$broker['NTN']}}" >
                
                </div>

                </div>
                </div>
              </div>
            <div class="box-footer">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-info pull-right">Save</button>
              </div>
              <!-- /.box-body -->
          </div>
        <!--/.col (right) -->
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
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
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
