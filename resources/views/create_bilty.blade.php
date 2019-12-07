 @extends('layouts.app')
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">
</script>
<script src="jquery-1.8.3.js"></script>
<script>       
function isNumber_bilty(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode != 46 || $(this).val().indexOf('.') != -1) && (charCode < 48 || charCode > 57) || (charCode == 46 && $(this).caret().start == 0)) {
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
        
    if ($('#bi_no').val() !=''&&
    $('#weight').val() != '' &&
    $('#c_rate').val() != ''&&
    $('#car_no').val() != ''&& 
    $('#d_name').val() != '' &&
    $('#cnic').val() != ''&&
    $('#b_rate').val() != ''&& 
    $('#d_place').val() != '' &&
    $('#a_place').val() != '') {
      
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
      <form role="form" action="create_bilty_submit" method="POST" id="Once">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Loading Point Details</h3>
            </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInput">Bilty Number:</label>
                  <input type="text" class="form-control" name="builty_no" placeholder="Enter weight" id="bi_no">
                </div>
                 <div class="form-group">
                  <label>Company Name:</label>
                  <select class="form-control" name="cid">
                      @foreach ($companies as $company)
                      <option selected="selected" value="{{$company['cid']}}">{{$company['name']}}</option>
                  @endforeach
                  </select>
                  <a href="create_company_form">Create New:</a>
                </div>
                <div class="form-group">
                  <label for="exampleInput">Weight:</label>
                  <input type="text" class="form-control" name="c_weight" placeholder="Enter weight" id="weight"  onkeypress="return isNumber_bilty(event)">
                </div>
                
                <div class="form-group">
                  <label for="exampleInput">Company Rate:</label>
                  <input type="text" class="form-control" name="c_rate" placeholder="Enter Company rate" id="c_rate"  onkeypress="return isNumber_bilty(event)">
                </div>
                <div class="form-group">
                  <label for="exampleInput">Receiver Name:</label>
                  <input type="text" class="form-control" name="receiving_company" placeholder="Enter Receiver name">
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
              <h3 class="box-title">Broker Details:</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
                          <div class="box-body" >
                            @csrf
                <div class="form-group">
                  <label>Broker Name:</label>
                  <select class="form-control" name="bid">
                     @foreach ($brokers as $broker)
                      <option selected="selected" value="{{$broker['bid']}}">{{$broker['name']}}</option>
                  @endforeach
                  </select>
                   <a href="create_broker_form">Create New:</a>
                </div>
                 <div class="row">
                  <!-- left column -->
                 <div class="col-md-4">
<div class="box-body">
                <div class="form-group">
                  <label for="exampleInput">Car Number:</label>
                  <input type="text" class="form-control" name="car_no" placeholder="car no" id="car_no">
                </div>
                 </div>
                 </div>
                 <div class="col-md-4">
<div class="box-body">
                <div class="form-group">
                  <label for="exampleInput">Driver Name:</label>
                  <input type="text" class="form-control" name="driver_name" placeholder="Driver name" id="d_name">
                </div>
                 </div>
                 </div>
                 <div class="col-md-4">
<div class="box-body">
                <div class="form-group">
                  <label for="exampleInput">CNIC:</label>
                  <input type="text" data-inputmask="'mask': '99999-9999999-9'" class="form-control" name="cnic" placeholder="CNIC" id="cnic">
                </div>
                 </div>
                 </div>
               </div>
               <div class="form-group">
                  <label for="exampleInput">Broker Rate:</label>
                  <input type="text" class="form-control" name="b_rate" placeholder="Broker rate"  onkeypress="return isNumber_bilty(event)" id="b_rate">
                </div>
                <div class="form-group">
                  <label for="exampleInput">Departure Place:</label>
                  <input type="text" class="form-control" name="departure" placeholder="Enter Departure place" id="d_place">
                </div>
                 <div class="form-group">
                  <label for="exampleInput">Destination Place</label>
                  <input type="text" class="form-control" name="destination" placeholder="Enter Destination place" id="a_place">
                </div>
                 <div class="box-footer">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-info pull-right" id="sbtbtn">Save</button>
              </div>

              </div>

          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
       </form>
    </section>

    <!--main content-->
    @include('layouts.footer')

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
<script src="vendor/mckenziearts/laravel-notify/public/js/notify.js"></script>
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
