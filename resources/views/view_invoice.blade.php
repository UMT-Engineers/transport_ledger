<?php
$invoices=$data['invoices'];
  $company=$data['company'];

?>

<!DOCTYPE html>
<html>
<head>
  <title>Bill</title>
  <style type="text/css">
    
    td{
          text-align: center;

    }
  </style>
    <script>
function goBack() {
  window.history.back();
}
</script>
</head>
<body>
	<div  style="padding: 3%">
		<h1 style="text-align: center;"> Sales tax invoice</h1>
		<input type="hidden" name="invoice_no" value="">

		<table border="solid" style="border-collapse: collapse;margin-top: 2%;margin-left: 5%;">
			<tr>
				<th style="border: 1px solid; padding:6px;text-align: center;">Invoice</th>
                <td style="border: 1px solid; padding:6px;text-align: center;">
               <?php
                 echo "<pre>";
  print_r($invoices['iid']);
               ?>
                </td>
			</tr>
			<tr>
				<th style="border: 1px solid; padding:6px;text-align: center;">Date </th>
                <td style="border: 1px solid; padding:6px;text-align: center;">
             <?php
                 
  echo $invoices['created_at'];
               ?>
                </td>
			</tr>
			
		</table>

     <div style="margin-top: 5%">
			<table width="100%" style="border-collapse: collapse;">
              <tr>
              	<th style="border: 1px solid; padding:6px;text-align: center;">
              		Company name
              	</th>
              	<td colspan="2"  style="border: 1px solid; padding:6px;text-align: center;">
              		<?php
                 
  echo $company['name'];
               ?>
              	</td>
              	<td>
              		
              	</td>
              	<th  style="border: 1px solid; padding:6px;text-align: center;">
              		Company name
              	</th>
              	<td colspan="2"  style="border: 1px solid; padding:6px;text-align: center;">
             
              	</td>
              </tr>
              <tr>
              	<th style="border: 1px solid; padding:6px;text-align: center;">
              		Head office
              	</th>
              	<td colspan="2" style="border: 1px solid; padding:6px;text-align: center;">
              		<?php
                 
  echo $company['address'];
               ?>
              	</td>
              	<td>
              		
              	</td>
              		<th  style="border: 1px solid; padding:6px;text-align: center;">
              		Head office
              	</th>
              	<td colspan="2"  style="border: 1px solid; padding:6px;text-align: center;">
              		<?php
					//echo $company['address'];
					?>
              	</td>
              </tr>
              <tr>
              	<th  style="border: 1px solid; padding:6px;text-align: center;">
              		telephone
              	</th>
              	<td colspan="2"  style="border: 1px solid; padding:6px;text-align: center;">
              		<?php
					echo $company['phone'];
					?>
              	</td>
              	<td>
              		
              	</td>
              		<th  style="border: 1px solid; padding:6px;text-align: center;">
              		telephone
              	</th>
              	<td colspan="2"  style="border: 1px solid; padding:6px;text-align: center;">
              		<?php
				//	echo $company['phone'];
					?>
              	</td>
              </tr>
              <tr>
              	<th  style="border: 1px solid; padding:6px;text-align: center;">
              		N.T.N
              	</th>
              	<td colspan="2"  style="border: 1px solid; padding:6px;text-align: center;">
              		<?php
					echo $company['NTN'];
					?>
              	</td>
              	<td>
              		
              	</td>
              		<th  style="border: 1px solid; padding:6px;text-align: center;">
              		N.T.N
              	</th>
              	<td colspan="2"  style="border: 1px solid; padding:6px;text-align: center;">
              	
              	</td>
              </tr>
              <tr>
              	<th  style="border: 1px solid; padding:6px;text-align: center;">
              		P.T.N
              	</th>
              	<td colspan="2"  style="border: 1px solid; padding:6px;text-align: center;">
              		<?php
					echo $company['PTN'];
					?>
              	</td>
              	<td>
              		
              	</td>
              		<th  style="border: 1px solid; padding:6px;text-align: center;">
              		P.T.N
              	</th>
              	<td colspan="2"  style="border: 1px solid; padding:6px;text-align: center;">
              		
              	</td>
              </tr>
              <tr>
              	<th colspan="7"><br></th>
              </tr>
              <tr>
              	<th colspan="7"><br></th>
              </tr>

				<tr>
					<th style="border: 1px solid; padding:6px;text-align: center;">QTY</th>
					<th  style="border: 1px solid; padding:6px;text-align: center;">Description of Goods</th>
					<th  style="border: 1px solid; padding:6px;text-align: center;">value Exclusive of sales tax</th>
					<th style="border: 1px solid; padding:6px;text-align: center;">Sales Tax</th>
					<th style="border: 1px solid; padding:6px;text-align: center;">asdas</th>
					<th style="border: 1px solid; padding:6px;text-align: center;">Total sales tax payable</th>
					<th style="border: 1px solid; padding:6px;text-align: center;">Value inclusive of sales tax</th>
				</tr>
				<tr>
					<td colspan="7">
						
					</td>
				</tr>
        <tr style="height: 500px">
          <td style="border: 1px solid; padding:6px;text-align: center;height: 400px"> <?php
                 
  echo $invoices['b_quantity'];
               ?></td>
          <td style="border: 1px solid; padding:6px;text-align: center;">Transport</td>
          <td style="border: 1px solid; padding:6px;text-align: center;"> <?php
                 
  echo $invoices['total_cost'];
               ?>
          </td>
          <td style="border: 1px solid; padding:6px;text-align: center;"> <?php
                 
  echo $invoices['sales_tax'];
               ?>%</td>
          <td style="border: 1px solid; padding:6px;text-align: center;"></td>

          <td style="border: 1px solid; padding:6px;text-align: center;"> <?php
                 
  echo $invoices['salex_tax_value'];
               ?></td>
          <td style="border: 1px solid; padding:6px;text-align: center;"> <?php
                 
  echo $invoices['cost_inc_tax'];
               ?></td>
        </tr>
        <tr>
          <th style="border: 1px solid; padding:6px;text-align: center;"> <?php
                 
  echo $invoices['b_quantity'];
               ?></th>
          <th colspan="4" style="border: 1px solid; padding:6px;text-align: center;">Total</th>
        <td style="border: 1px solid; padding:6px;text-align: center;"> <?php
                 
  echo $invoices['salex_tax_value'];
               ?></td>
          <td style="border: 1px solid; padding:6px;text-align: center;"> <?php
                 
  echo $invoices['cost_inc_tax'];
               ?></td>
        </tr>
			</table>
		</div>
	</div>
		<div>
      @csrf
		<a href="{{ url('print_invoice'.$invoices['iid'])}}"><button>Print_invoice</button></a>
    <button onclick="goBack()">back</button>
	</div>
</form>
</body>
</html>