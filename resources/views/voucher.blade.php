<!DOCTYPE html>
<html>
<head>


  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->

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
<script type="text/javascript">
    $(function () {
        $("#chkbroker").click(function () {
            if ($(this).is(":checked")) {
                $("#dvbroker").show();
                $("#dvbroker1").show();
            } else {
                $("#dvbroker").hide();
                $("#dvbroker1").hide();
            }
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $("#chkemployee").click(function () {
            if ($(this).is(":checked")) {
                $("#dvemployee").show();
                $("#dvemployee1").show();
                $("#dvemployee2").show();
            } else {
                $("#dvemployee").hide();
                $("#dvemployee1").hide();
            }
        });
    });
</script> 
<script type="text/javascript">
    $(function () {
        $("#chkinvoice").click(function () {
            if ($(this).is(":checked")) {
                $("#dvinvoice").show();
                $("#dvinvoice1").show();
            } else {
                $("#dvinvoice").hide();
                $("#dvinvoice1").hide();
            }
        });
    });
</script> 
    <link rel="stylesheet" href="public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
 <!--  <link rel="stylesheet" href="public/bower_components/font-awesome/css/font-awesome.min.css"> -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="public/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="public/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
       <link rel="stylesheet" href="public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="public/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="public/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="public/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="public/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">

  <h1 align="center">
    LAND CONNECT PVT LTD
  </h1>
<div class="wrapper"  >



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="width: 1366px;margin-left: -0px" >
    <!-- Content Header (Page header) -->
    <section class="content-header" >
      <h1 align="center">
         <?php
          
             if ($voucher['type']=='cpv') {
               echo "Cash payment vouchers";
             }
             elseif ($voucher['type']=='crv') {
              echo "Cash Receipt vouchers";

             }
             elseif ($voucher['type']=='pcv') {
               echo "Journal vouchers";
             }
             else{
               echo "Commission voucher";
             }
              
              ?>
      </h1>
      <br>
    </section>

    <!-- Main content -->
     <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <form class="form-horizontal" action="print_voucher" method="post">
              <div class="box-body">
                <div class="form-group">
               @csrf
                  <input type="hidden" name="type" value="{{$voucher['type']}}">
                  <label for="inputEmail3" class="col-sm-2 control-label">Voucher ID</label>

                  <div class="col-sm-2">
                    <span class="form-control"><?php
                    echo $voucher['vid'];
                    ?></span>
                    <input type="hidden" name="type" value="{{$voucher['type']}}">
                   
                  </div>
                  <label for="inputPassword3" class="col-sm-2 control-label">Currency</label>

                  <div class="col-sm-2">
                    <select class="form-control">
                      <option>
                        PKR
                      </option>
                      <option>
                        Dollar
                      </option>
                    </select>
                  </div>
                  <label for="inputPassword3" class="col-sm-2 control-label">Exchange_rate</label>
                    
                  <div class="col-sm-2">
                    <input type="textbox" class="form-control" id="inputPassword3" placeholder="Exchange rate">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Date</label>

                  <div class="col-sm-2">
                   <span class="form-control"><?php
                    echo $voucher['updated_at'];
                    ?></span>
                  </div>
                  <label for="inputPassword3" class="col-sm-2 control-label">Account no</label>

                  <div class="col-sm-6">
                    <span class="form-control"><?php
                    echo " Account no :".$voucher['AccountNo']."|";
                    echo " Holder name :".$voucher['holder_name']."|";
                    echo " Balance :".$voucher['balance']."|";
                    ?></span>
                  </div>
  
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Amount</label>

                  <div class="col-sm-2">
                     <span class="form-control"><?php
                    echo $voucher['Amount'];
                    ?></span>
                  </div>
                  <label for="inputPassword3" class="col-sm-2 control-label">Amount in word</label>

                  <div class="col-sm-5">
                     <span class="form-control"><?php
                    echo $voucher['AmountInWords'];
                    ?></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Cheque no</label>

                  <div class="col-sm-2">
                    <span class="form-control"><?php
                    echo $voucher['cheque_no'];
                    ?></span>
                  </div>
                  <label for="inputPassword3" class="col-sm-2 control-label">Cheque date</label>

                  <div class="col-sm-2">
                    <span class="form-control"><?php
                    echo $voucher['cheque_date'];
                    ?></span>
                  </div>
                  <label for="inputPassword3" class="col-sm-2 control-label">Bank name(cheque)</label>
                    
                  <div class="col-sm-2">
                    <span class="form-control"><?php
                    echo $voucher['cheque_bank_name'];
                    ?></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
                   <div class="col-sm-10">
                     <span class="form-control"><?php
                    echo $voucher['Description'];
                    ?></span>
                  </div>

                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">payee</label>
                   <div class="col-sm-4">
                    <span class="form-control"><?php
                    echo $voucher['payee'];
                    ?></span>
                  </div>

                </div>
                <div class="form-group">
                  

                <div class="form-group">
                  <?php
                  if ($voucher['type']=='cpv') {
                    echo "<label class='col-sm-2 control-label' id='dvbroker' >Brokers</label>
                  <div class='col-sm-2'>
                  <span class='form-control'>
              ";
              if (!is_null($voucher['bid'])) {
                echo $voucher['bid'];
              }
              echo"
              </span>
                  </div>
                  <label class='col-sm-2 control-label' id='dvemployee' >Employee</label>
                  <div class='col-sm-2' id='dvemployee1' >
                      <span class='form-control'>
              ";
              if (!is_null($voucher['eid'])) {
                echo $voucher['eid'];
              }
              echo"
              </span>
                  </div>";

                 ?>
                   <div class="col-sm-2" id="dvemployee2" style="display: none">
                    <select class="form-control" name="e_operation">
                      <option value="salary">
                       Salary
                      </option>
                      <option value="expense">
                        Expense
                      </option>
                    </select>
                  </div>

                  <?php

                  }
                  elseif ($voucher['type']=='crv'){
                      echo "<label for='inputEmail3' class='col-sm-2 control-label' id='dvinvoice' >Invoice</label>
                  <div class='col-sm-2' id='dvinvoice1' >
                      <span class='form-control'>
              ";
              if (!is_null($voucher['iid'])) {
                echo $voucher['iid'];
              }
              echo"
              </span>
                  </div>
              ";
                  
                  }

                  ?>
                  
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <a href="{{ url('print_voucher'.$voucher['id'])}}"><button type="button" class="btn btn-info pull-right">Print</button></a>
              </div>
              <!-- /.box-footer -->
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
       </form>
    </section>

    <!--main content-->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->

</body>
</html>
