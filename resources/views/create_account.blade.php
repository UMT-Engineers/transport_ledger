 @extends('layouts.app')
 @section('content')

    <!-- Main content -->
     <section class="content">
      <form role="form" action="create_account_submit" method="POST">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Account Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInput" class="col-sm-3 control-label"> Account No </label>
                  <div class="col-sm-3">
                  <input type="text" class="form-control" name="AccountNo" placeholder="Enter Account no" id="weight">
                  </div>
                  <label for="exampleInput"class="col-sm-3 control-label">Holder Name</label>
                   <div class="col-sm-3">
                  <input type="text" class="form-control" name="holder_name" placeholder="Enter Holder name" id="weight">
                  </div>
                  
                </div>
              </div>
              <div class="box-body">
                @csrf
                <div class="form-group">
                  
                  <label for="exampleInput"class="col-sm-3 control-label">Bank Name</label>
                   <div class="col-sm-3">
                  <input type="text" class="form-control" name="bank_name" placeholder="Enter bank name" id="weight">
                  </div>
                  <label for="exampleInput" class="col-sm-3 control-label">Branch</label>
                  <div class="col-sm-3">
                  <input type="text" class="form-control" name="branch" placeholder="Enter Branch name" id="weight">
                  </div>
                
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
       <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Accounts Details</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>Account I;D</th>
                      <th>Account No</th>
                      <th>Holder Name</th>
                      <th>Bank Name</th>
                      <th>Branch Name</th>
                      <th>Balance</th>
                      
                      <th><a href=""> Update</a></th>
                    <!--   <th><a href=""> Delete</a></th> -->
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($accounts as $account)

                    <tr>
                      <td>{{$account['aid']}}</td>
                      <td>{{$account['AccountNo']}}</td>
                      <td>{{$account['holder_name']}}
                      </td>
                      <td>{{$account['bank_name']}}</td>
                      <td>{{$account['branch']}}</td>
                      <td>{{$account['balance']}}</td>
                      
                      <th><a href="{{ url('update_account'.$account['aid'])}}"> Update</a></th>
                      <!-- <th><a href=" {{ url('delete_account'.$account['aid'])}}"> Delete</a></th> -->
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

            
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
    </section>

    <!--main content-->
    @include('layouts.footer')
<!-- jQuery 3 -->
<script src="public/bower_components/jquery/dist/jquery.min.js"></script>
<script src="vendor/mckenziearts/laravel-notify/public/js/notify.js"></script>
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
