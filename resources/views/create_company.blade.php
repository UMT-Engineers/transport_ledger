 @extends('layouts.app')
 @section('content')
           @if (session()->has('alert-success'))
             <script language="javascript">       
            alert("{{session()->get('alert-success')}}");          
            </script>
            @endif
             @if (session()->has('alert-danger'))
             <script language="javascript">       
            alert("{{session()->get('alert-danger')}}");          
            </script>
            @endif
    <!-- Main content -->
     <section class="content">
      <form role="form" action="create_company_submit" method="POST">
      <div class="row">
        <!-- left column -->
        <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Company Detail</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInput">Company Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter name" id="weight">
                </div>
                <div class="form-group">
                  <label for="exampleInput">Phone</label>
                  <input type="text" class="form-control" name="phone" placeholder="Enter phone" id="weight">
                </div>
                 @csrf
                <div class="form-group">
                  <label for="exampleInput">Address</label>
                  <input type="text" class="form-control" name="address" placeholder="Enter Address " id="c_rate" >
                </div>
                <div class="form-group">
                  <label for="exampleInput">PTN</label>
                  <input type="text" class="form-control" name="PTN" placeholder="Enter PTN " id="c_rate" >
                </div>
                <div class="form-group">
                  <label for="exampleInput">NTN</label>
                  <input type="text" class="form-control" name="NTN" placeholder="Enter NTN " id="c_rate" >
                </div>
              </div>
                 <div class="box-footer">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-info pull-right">Save</button>
              </div>
          </div>
          <!-- /.box -->
        </div>
 
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
       </form>
    </section>

    <!--main content-->
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
