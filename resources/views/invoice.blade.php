<?php
use App\Http\Controllers\brokerController;
use App\Http\Controllers\companyController;
$biltys=$data['biltys'];
	$company=$data['company'];
	$tax=$data['tax'];
	$invoice_no=$data['invoice_no'];

                         
                         $companies = new companyController;
                         $company=$companies->return_company($biltys[0]['cid']);
    
                         $total_c=0;
                         foreach ($biltys as $bilty)
                         {
                        $total_c=$total_c+$bilty['total_cost'];
                         }



                      ?>

	<div  style="padding: 3%">
		<h1 style="text-align: center;"> Sales Tax Invoice</h1>
		<input type="hidden" name="invoice_no" value="<?php echo $invoice_no;?>">

		<table border="solid" style="border-collapse: collapse;margin-top: 2%;margin-left: 5%;">
			<tr>
				<th style="border: 1px solid; padding:6px;text-align: center;">Invoice</th>
                <td style="border: 1px solid; padding:6px;text-align: center;">
                   <?php
				echo $invoice_no;
                $today = date("m.d.y"); 
                      ?>
                </td>
			</tr>
			<tr>
				<th style="border: 1px solid; padding:6px;text-align: center;">Date </th>
                <td style="border: 1px solid; padding:6px;text-align: center;"><?php
               echo $today;

                ?>
                	
                </td>
			</tr>
			<tr>
				<th style="border: 1px solid; padding:6px;text-align: center;">Time</th>
                <td style="border: 1px solid; padding:6px;text-align: center;"><?php
                  echo $time = date("h:i:s"); 
                ?></td>
			</tr>
		</table>

     <div style="margin-top: 5%">
			<table width="100%" style="border-collapse: collapse;">
              <tr>
              	<th style="border: 1px solid; padding:6px;text-align: center;">
              		Company Name:
              	</th>
              	<td colspan="2"  style="border: 1px solid; padding:6px;text-align: center;">
              		<?php
					echo $company['name'];
					?>
              	</td>
              	<td>
              		
              	</td>
              	<th  style="border: 1px solid; padding:6px;text-align: center;">
              		Company Name
              	</th>
              	<td colspan="2"  style="border: 1px solid; padding:6px;text-align: center;">
              		<?php
					echo $company['name'];
					?>
              	</td>
              </tr>
              <tr>
              	<th style="border: 1px solid; padding:6px;text-align: center;">
              		Head Office
              	</th>
              	<td colspan="2" style="border: 1px solid; padding:6px;text-align: center;">
              		<?php
					echo $company['address'];
					?>
              	</td>
              	<td>
              		
              	</td>
              		<th  style="border: 1px solid; padding:6px;text-align: center;">
              		Head Office
              	</th>
              	<td colspan="2"  style="border: 1px solid; padding:6px;text-align: center;">
              		<?php
					echo $company['address'];
					?>
              	</td>
              </tr>
              <tr>
              	<th  style="border: 1px solid; padding:6px;text-align: center;">
              		Telephone
              	</th>
              	<td colspan="2"  style="border: 1px solid; padding:6px;text-align: center;">
              		<?php
					echo $company['phone'];
					?>
              	</td>
              	<td>
              		
              	</td>
              		<th  style="border: 1px solid; padding:6px;text-align: center;">
              		Telephone
              	</th>
              	<td colspan="2"  style="border: 1px solid; padding:6px;text-align: center;">
              		<?php
					echo $company['phone'];
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
					<th  style="border: 1px solid; padding:6px;text-align: center;">Value Exclusive of Sales Tax</th>
					<th style="border: 1px solid; padding:6px;text-align: center;">Sales Tax</th>
					<th style="border: 1px solid; padding:6px;text-align: center;">Asdas</th>
					<th style="border: 1px solid; padding:6px;text-align: center;">Total Sales Tax Payable</th>
					<th style="border: 1px solid; padding:6px;text-align: center;">Value Inclusive of Sales Tax</th>
				</tr>
				<tr>
					<td colspan="7">
						
					</td>
				</tr>
				<tr style="height: 500px">
					<td style="border: 1px solid; padding:6px;text-align: center;"><?php
                     echo count($biltys);
					?></td>
					<td style="border: 1px solid; padding:6px;text-align: center;">Transport</td>
					<td style="border: 1px solid; padding:6px;text-align: center;"><?php
                      echo $total_c;
                      $tax_value = ($total_c/100)*$tax;
					?>
						<input type="hidden" name="tax" value="{{$tax}}">
					</td>
					<td style="border: 1px solid; padding:6px;text-align: center;">{{$tax}}</td>
					<td style="border: 1px solid; padding:6px;text-align: center;"></td>

					<td style="border: 1px solid; padding:6px;text-align: center;">{{$tax_value}}</td>
					<td style="border: 1px solid; padding:6px;text-align: center;">{{$tax_value+$total_c}}</td>
				</tr>
				<tr>
					<th style="border: 1px solid; padding:6px;text-align: center;"><?php
                     echo count($biltys);
					?></th>
					<th colspan="4" style="border: 1px solid; padding:6px;text-align: center;">Total</th>
				<td style="border: 1px solid; padding:6px;text-align: center;">{{$tax_value}}</td>
					<td style="border: 1px solid; padding:6px;text-align: center;">{{$tax_value+$total_c}}</td>
				</tr>
			</table>
		</div>
	</div>
		<div>
		<input type="submit" name="pdf"  value="Print_invoice">
	</div>

<!-- main div -->