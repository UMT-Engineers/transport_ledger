<?php
	$biltys=$data['biltys'];
	$company=$data['company'];
	$tax=$data['tax'];
    $invoice_no=$data['invoice_no'];
?>
<div style="height: 842px">

<?php
                         
?>

	<table  width="100%" align="center" style="border-collapse: collapse;">
		<tr>
			<th colspan="3" style="border: 1px solid; padding:12px;">
				<img style="margin-left: 25%" src= "{{ url('public/dist/img/Logo LCG.jpg') }}">
			</th>
			<th colspan="6" style="border: 1px solid; padding:12px;text-align: center;">
				<b>Land Connect Cargo (PVT) LTD</b>
			</th>
		</tr>
		<tr>
			<th colspan="3" style="border: 1px solid; padding:6px;text-align: center;">
				Invoive No:
			</th>
			<th colspan="3" style="border: 1px solid; padding:6px;text-align: center;">
				NTN:
			</th>
			<th colspan="3" style="border: 1px solid; padding:6px;text-align: center;">
				Date 
			</th>

		</tr>
		<tr>
			<td colspan="3" style="border: 1px solid; padding:6px;text-align: center;">
				<?php
				echo $invoice_no; 
                      ?>

				
			</td>
			<td colspan="3" style="border: 1px solid; padding:6px;text-align: center;">
				
			</td>
			<td colspan="3" style="border: 1px solid; padding:6px;text-align: center;">
				<?php
               $today = date("d/m/y");

				echo $today;

                      ?>

			</td>

		</tr>
		<tr>
			<th colspan="4" style="border: 1px solid; padding:6px;text-align: center;">

				Company Name:
				
			</th>
			<th colspan="5" style="border: 1px solid; padding:6px;text-align: center;">
				Company NTN:
			</th>

		</tr>
		<tr>
			<td colspan="4" style="border: 1px solid; padding:6px;text-align: center;">
				<?php
                         
                echo $company['name'];

                      ?>
			</td>
			<td colspan="5" style="border: 1px solid; padding:6px;text-align: center;">
			<?php
                         
                 echo $company['NTN'];

                      ?>
						</td>

		</tr>
		<tr>
			<td colspan="9" style="border: 1px solid">
				<br>
			</td>
		</tr>
		<tr>
			<th style="border: 1px solid; padding:6px;text-align: center;">S #</th >
             <th style="border: 1px solid; padding:6px;text-align: center;">Dispatch Date</th>
             <th style="border: 1px solid; padding:6px;text-align: center;">Vehicle No</th>
             <th style="border: 1px solid; padding:6px;text-align: center;">Bilty No</th>
             <th style="border: 1px solid; padding:6px;text-align: center;">Services</th>
             <th style="border: 1px solid; padding:6px;text-align: center;">City</th>
             <th style="border: 1px solid; padding:6px;text-align: center;">Weight </th>
             <th style="border: 1px solid; padding:6px;text-align: center;">Rate </th>
             <th style="border: 1px solid; padding:6px;text-align: center;">Amount</th>

		</tr>
		<?php
                    $total_cost_t=0;
                    $i=0;
                    
                    ?>
		@foreach ($biltys as $bilty)
         <tr>
         	
         	<td style="border: 1px solid; padding:6px;text-align: center;"><input type="hidden" name="bilty[]" value="{{$bilty['buid']}}"><?php $i++; echo $i;?></td>
            <td style="border: 1px solid; padding:6px;text-align: center;">{{ $bilty['created_at']}}</td>
            <td style="border: 1px solid; padding:6px;text-align: center;">{{ $bilty['car_no']}}</td>
            <td style="border: 1px solid; padding:6px;text-align: center;">{{$bilty['builty_no']}}</td>
            <td style="border: 1px solid; padding:6px;text-align: center;">Transport</td>
            <td style="border: 1px solid; padding:6px;text-align: center;">{{$bilty['destination']}}</td>
            <td style="border: 1px solid; padding:6px;text-align: center;">{{$bilty['c_weight']}}</td>
            <td style="border: 1px solid; padding:6px;text-align: center;">{{$bilty['c_rate']}}</td>
            <td style="border: 1px solid; padding:6px;text-align: center;">{{$bilty['total_cost']}}</td>
            <?php 
                      $total_cost_t=$total_cost_t+$bilty['total_cost'];
                      ?>

          </tr>		
           @endforeach
           <tr>
           	<td colspan="7">
           		
           	</td>
           	<th style="border: 1px solid; padding:6px;text-align: center;">
           		Total
           	</th>
           	<th style="border: 1px solid; padding:6px;text-align: center;">
           		<?php
           		echo $total_cost_t;
           		?>
           	</th>
           </tr>
	</table>
	
@csrf
	<div>
		<input type="submit" name="pdf"  value="Print_Bill">
		<button onclick="goBack()">Back</button>
	</div>

</div>