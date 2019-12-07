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
        
    if ($('#amount').val() !=''&&
    $('#amountinword').val() != '' &&
    $('#description').val() != '') {
      
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
                $("#dvemployee2").hide();
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
@section('content')

    <!-- Main content -->
     <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <form class="form-horizontal" action="create_voucher_submit" method="post">
              <div class="box-body">
                <div class="form-group">
               @csrf
                  <input type="hidden" name="type" value="{{$type}}">
                  <label for="inputEmail3" class="col-sm-2 control-label">Voucher ID</label>

                  <div class="col-sm-2">
                    <span class="form-control"><?php
                    echo $serial;
                    ?></span>
                    <input type="hidden" name="type" value="{{$type}}">
                    <input type="hidden" name="vid" value="{{$serial}}">
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
                    echo date("Y/m/d");
                    ?></span>
                  </div>
                  <label for="inputPassword3" class="col-sm-2 control-label">Account no</label>

                  <div class="col-sm-2">
                    <select class="form-control" name="aid">
                      @foreach ($accounts as $account)
                      <option value="{{$account['aid']}}">
                        <table>
            
                          <tr>
                            <td>
                              <?php echo "| Account no ".$account['AccountNo'];?>
                            </td>
                            <td>
                               <?php echo " | holder name ".$account['holder_name'];?>
                            </td>
                            <td>
                              <?php  echo " | blance ".$account['balance']." |";
                        ?>
                            </td>
                          </tr>
                        </table>
                        
                      
                      
                      </option>
                       @endforeach
                    </select>
                  </div>
  
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label" >Amount</label>

                  <div class="col-sm-2">
                    <input type="textbox" class="form-control" id="amount" placeholder="Amount" name="Amount" onkeypress="return isNumber(event)">
                  </div>
                  <label for="inputPassword3" class="col-sm-2 control-label" >Amount in word</label>

                  <div class="col-sm-5">
                    <input type="textbox" class="form-control" id="amountinword" placeholder="Amount in words" name="AmountInWord">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Cheque no</label>

                  <div class="col-sm-2">
                    <input type="textbox" class="form-control" id="inputEmail3" placeholder="1243221324" name="cheque_no">
                  </div>
                  <label for="inputPassword3" class="col-sm-2 control-label">Cheque date</label>

                  <div class="col-sm-2">
                    <input type="textbox" class="form-control" id="inputPassword3" placeholder="<?php echo date("Y/m/d"); ?>"   name="cheque_date">
                  </div>
                  <label for="inputPassword3" class="col-sm-2 control-label">Bank name(cheque)</label>
                    
                  <div class="col-sm-2">
                    <input type="textbox" class="form-control" id="inputPassword3" placeholder="Bank name" name="cheque_bank_name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
                   <div class="col-sm-10">
                    <input type="textbox" class="form-control" id="description" placeholder="Description" name="Description">
                  </div>

                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">payee</label>
                   <div class="col-sm-4">
                    <input type="textbox" class="form-control" id="inputPassword3" placeholder="payee" name="payee">
                  </div>

                </div>
                <div class="form-group">
                  

                    <?php 

                       if ($type=='cpv') {
                       echo "<div class='col-sm-offset-2 col-sm-2'>
                    <div class='checkbox'>
                      <label for='chkbroker'>
                        <input type='checkbox'  id='chkbroker' > Broker detail
                      </label>
                    </div>
                  </div>
                  <div class='col-sm-offset-2 col-sm-2'>
                    <div class='checkbox'>
                      <label for='chkemployee'>
                        <input type='checkbox' id='chkemployee'> Employee detail
                      </label>
                    </div>
                  </div>
                  ";
                       }
                       elseif ($type=='crv') {
                       echo "<div class='col-sm-offset-2 col-sm-2'>
                    <div class='checkbox'>
                      <label for='chkinvoice'>
                        <input type='checkbox' id='chkinvoice'> Invoice detail
                      </label>
                    </div>
                  </div>
                  ";

                       }

                    ?>
                  </div>
                <div class="form-group">
                  <?php
                  if ($type=='cpv') {
                    echo "<label class='col-sm-2 control-label' id='dvbroker' style='display: none'>Brokers</label>
                  <div class='col-sm-2'>
                    <select class='form-control' name='bid' id='dvbroker1' style='display: none'>";
                    echo "<option value='0'>Select </option>";
                    foreach ($brokers as $broker){
                     echo " <option value='{$broker['bid']}'>";
                       echo $broker['name']."|";
                       $remaining=$broker['total_cost']-$broker['received_cost'];
                       echo "remaining cost :".$remaining;  
                      echo "</option>
                       "; }

                    echo "</select>
                  </div>
                  <label class='col-sm-2 control-label' id='dvemployee' style='display: none'>Employee</label>
                  <div class='col-sm-2' id='dvemployee1' style='display: none'>
                    <select class='form-control' name='eid' >";
                    echo "<option value='0'>Select </option>";
                    foreach ($employees as $employee){
                      echo "<option value='{$employee['eid']}' >";
                        echo "| ".$employee['employee_name']." |";
                        echo "salary=> ".$employee['salary']." |";
                      echo "</option>";
                       }
                     echo "</select>
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
                  elseif ($type=='crv'){
                      echo "<label for='inputEmail3' class='col-sm-2 control-label' id='dvinvoice' style='display: none'>Invoice</label>
                  <div class='col-sm-2' id='dvinvoice1' style='display: none'>
                    <select class='form-control' name='iid' >";
                    echo "<option value='0'>Select </option>";
                    foreach ($invoices as $invoice){
                      if(($invoice['cost_inc_tax']-$invoice['payment_received'])!=0)
                      {
                        echo "
                       <option value='";echo $invoice['iid'];
                       echo"'>";
                        echo "invoice no:".$invoice['iid']."/";
                        echo "total_cost:".$invoice['cost_inc_tax']."/";
                         echo "company name:".$invoice['c_name']."/";
                         $remaining=$invoice['cost_inc_tax']-$invoice['payment_received'];
                         echo "remainig payment".$remaining;  
                     echo "</option>
                       ";
                      }
                      }

                    echo "</select>
                  </div>
              ";
                  
                  }

                  ?>
                  
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right" id="">Submit</button>
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
