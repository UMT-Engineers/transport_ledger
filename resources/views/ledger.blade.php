<!DOCTYPE html>
<html>
<head>
	<title>Customer ledger</title>
	<style type="text/css">
		
		td {
        text-align: center;
      }
	</style>
</head>
<body>

    <h1 style="text-align: center;"> LAND CONNECT</h1>
    <h2 style="text-align: center;">Customer ledger</h2>
    <table width="40%">
    	<tr>
    		<?php
             $size=count($ledger);

    		?>
    		<th style="text-align: left;">
    			Date from
    		</th>
    		<td>
    			<?php
                 echo $ledger[0]['updated_at'];
    			?>
    		</td>
    		<th style="text-align: left;">
    			To
    		</th>
    		<td>
    			<?php
                 echo $ledger[$size-1]['updated_at'];
    			?>
    		</td>
    	</tr>
    	  	<tr>
    		<th style="text-align: left;">
    			Customer from
    		</th>
    		<td>
    			<?php
 
                          if ($ledger[0]['type']=='cpv') {
                          if (!is_null($ledger[0]['bid'])) {
                            echo $ledger[0]['name'];
                          }
                          else{
                            echo $ledger[0]['employee_name'];
                          }
                      }
                      elseif ($ledger[0]['type']=='crv') {
                        if (!is_null($ledger[0]['iid'])) {
                            echo $ledger[0]['c_name'];
                          }
                      }
                     
                    ?>
    		</td>
    		
    	</tr>
    	<tr>
    		<th style="text-align: left;">
    			Transiction from
    		</th>
    		<td>
    			
    		</td>
    		<th style="text-align: left;">
    			to
    		</th>
    		<td>
    			
    		</td>
    	</tr>
    </table>
    <br>
	<table width="100%">
		<tr >
			<th style="border-top-style: solid;border-bottom-style: solid;border-left-style: solid;">Customer ID</th>
			<th style="border-top-style: solid;border-bottom-style: solid;"><?php
 
                     if ($ledger[0]['type']=='cpv') {
                          if (!is_null($ledger[0]['bid'])) {
                            echo $ledger[0]['bid'];
                          }
                          else{
                            echo $ledger[0]['employee_name'];
                          }
                      }
                      elseif ($ledger[0]['type']=='crv') {
                        if (!is_null($ledger[0]['iid'])) {
                            echo $ledger[0]['iid'];
                          }
                      }
                    ?></th>
			<th style="border-top-style: solid;border-bottom-style: solid;"> Name</th>
			<th style="border-top-style: solid;border-bottom-style: solid;"><?php
 
                          if ($ledger[0]['type']=='cpv') {
                          if (!is_null($ledger[0]['bid'])) {
                            echo $ledger[0]['name'];
                          }
                          else{
                            echo $ledger[0]['employee_name'];
                          }
                      }
                      elseif ($ledger[0]['type']=='crv') {
                        if (!is_null($ledger[0]['iid'])) {
                            echo $ledger[0]['c_name'];
                          }
                      }
                     
                    ?>
</th>
			<th style="border-top-style: solid;border-bottom-style: solid;">Conatct no</th>
			<th style="border-top-style: solid;border-bottom-style: solid;"><?php
 
                          if ($ledger[0]['type']=='cpv') {
                          if (!is_null($ledger[0]['bid'])) {
                            echo $ledger[0]['phone'];
                          }
                          else{
                            echo $ledger[0]['employee_name'];
                          }
                      }
                      elseif ($ledger[0]['type']=='crv') {
                        if (!is_null($ledger[0]['iid'])) {
                            echo $ledger[0]['phone'];
                          }
                      }
                     
                    ?></th>
			<th style="border-top-style: solid;border-bottom-style: solid;">NTN</th>
			<th style="border-top-style: solid;border-bottom-style: solid; border-right-style: solid;"><?php
 
                          if ($ledger[0]['type']=='cpv') {
                          if (!is_null($ledger[0]['bid'])) {
                            echo $ledger[0]['NTN'];
                          }
                          else{
                            echo $ledger[0]['employee_name'];
                          }
                      }
                      elseif ($ledger[0]['type']=='crv') {
                        if (!is_null($ledger[0]['iid'])) {
                            echo $ledger[0]['NTN'];
                          }
                      }
                     
                    ?></th>
		</tr>
	</table>
	<table width="100%" >
		<tr style="border-style: solid;">
			<th>
				No
			</th>
			<th>
				Inv No
			</th>
			<th>
				Type
			</th>
			<th>
				Date
			</th>
			<th>
				Ref:
			</th>
			<th>
				Details
			</th>
			<th>
				Debit
			</th>
			<th>
				Credit
			</th>
			<th>
				Blance
			</th>
		</tr>
		<tr>
			<th colspan="9"> <hr style="border-top: dotted 1px;" ></th>
		</tr>
		<?php
           $Total_debit=0;
           $Total_credit=0;
			?>
		@foreach ($ledger as $led)
		<tr >
			<td >
				{{$led['lid']}}
			</td>
			<td>
				<?php
				if (!empty($led['iid'])) {
					echo $led['iid'];
				}
				?>	
			</td>
			<td>
				Type
			</td>
			<td>
				{{$led['updated_at']}}
			</td>
			<td>
			    {{$led['vid']}}
			</td>
			<td>
			{{$led['Description']}}
			</td>
			<td>
				{{$led['debit']}}
				<?php
                  $Total_credit=$Total_credit+$led['credit'];
                  $Total_debit=$Total_debit+$led['debit'];
				?>
			</td>
			<td>
				{{$led['credit']}}
			</td>
			<td>
				<?php
                   echo $led['debit']-$led['credit'];
				?>
			</td>
		</tr>
		@endforeach
		<tr >
			<th colspan="6" style="border-top-style: solid;border-bottom-style: solid;border-left-style: solid;">Total</th>
			<th style="border-top-style: solid;border-bottom-style: solid;">{{$Total_debit}}</th>
			<th style="border-top-style: solid;border-bottom-style: solid;">{{$Total_credit}}</th>
			<th style="border-top-style: solid;border-bottom-style: solid; border-right-style: solid;">{{$Total_debit-$Total_credit}}</th>
		</tr>
	</table>
	 <table width="25%">
    	<tr>
    		<th style="text-align: left;">
    			Mount Paid in this Period
    		</th>
    		<td>
    			{{$Total_credit}}
    		</td>
    	</tr>
    	
    	  	<tr>
    		<th style="text-align: left;">
    		Amount Receive in this Period
    		</th>
    		<td>
    			{{$Total_debit}}
    		</td>
    	</tr>
    </table>

</body>
</html>