<!DOCTYPE html>
<html>
<head>
	<title>Voucher </title>
</head>
<style type="text/css">
	td{
		text-align: center;
		border: solid;
		background-color: white;
		border-radius: 5px;
		border-width: 1px;
	}
	th{
		text-align: center;
	}
	tr{
		border: solid;      
	}
	table{
		height: 400px;
	}
</style>
<body>

	<div>
		<h1 align="center">
			LAND CONNECT PVT LTD
		</h1>
		<div style="background-color: rgb(236,240,245);align-self: center;align-content: center;">
		<br>
		<h3 style="width: 100% ; text-align: center;"> <?php
          
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
              
              ?></h3>
		<br>
        
        	<table style="width: 98%">
        		<tr>
        			<th>Voucher ID</th>
        			<td><?php
                    echo $voucher['vid'];
                    ?></td>
        			<th >Currency</th>
        			<td>PK</td>
        			<th>Exchange Rate</th>
        			<td>1</td>
        		</tr>
                <tr>
                    <th colspan="6"> &nbsp;</th>
                </tr>
        		<tr>
        			<th>Date</th>
        			<td><?php
                    echo $voucher['updated_at'];
                    ?></td>
        			<th>Account No</th>
        			<td>{{$voucher['AccountNo']}}</td>
        			<th>Holder name</th>
        			<td>{{$voucher['holder_name']}}</td>
        		</tr>
        		<tr>
                    <th colspan="6"> &nbsp;</th>
                </tr>
        		<tr>
        			<th>Amount </th>
        			<td><?php
                    echo $voucher['Amount'];
                    ?></td>
        			<th> Amount in word</th>
        			<td colspan="3"><?php
                    echo $voucher['AmountInWords'];
                    ?></td>
        		</tr>
        		<tr>
                    <th colspan="6"> &nbsp;</th>
                </tr>
        		<tr>
        			<th>Cheque no</th>
        			<td><?php
                    echo $voucher['cheque_no'];
                    ?></td>
        			<th>Cheque date</th>
        			<td><?php
                    echo $voucher['cheque_date'];
                    ?></td>
        			<th>Bank name</th>
        			<td><?php
                    echo $voucher['cheque_bank_name'];
                    ?></td>
        		</tr>
        		<tr>
                    <th colspan="6"> &nbsp;</th>
                </tr>
        		<tr >
        			<th> Description</th>
        			<td colspan="5" >asd123zxcasd123zxc
        			<?php
                    echo $voucher['Description'];
                    ?></td>
        		</tr>
                <tr>
                    <th colspan="6"> &nbsp;</th>
                </tr>
        		<tr>
        			<th>Payee</th>
        			<td colspan="3"><?php
                    echo $voucher['payee'];
                    ?>123123</td>
        		</tr>
        		<tr>
                    <th colspan="6"> &nbsp;</th>
                </tr>
        		<tr>
                   <!--  @if($voucher['type']=='crv')
                      @if(!is_null($voucher['iid']))
        			<th>Invoice #</th>
        			<td></td>
                      @endif
                    @endif
                    @if($voucher['type']=='crv')
                     @if(!is_null($voucher['bid']))
        			<th>Broker #</th>
        			<td></td>
                    @endif
                    @if(!is_null($voucher['eid']))
        			<th>Employee #</th>
        			<td></td>
                    @endif
                    @endif -->
        		</tr>

        	</table>
        	<br>
            <div class="box-footer">
                
                <a href="{{ url('print_voucher'.$voucher['id'])}}"><button type="button" class="btn btn-info pull-right">Print</button></a>
              </div>
        	<br>
        </div>
	</div>

</body>
</html>