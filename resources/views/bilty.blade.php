<!DOCTYPE html>
<html>
<head>
	<title>Builty</title>
	<script>
function goBack() {
  window.history.back();
}
</script>
</head>
<body>
<table  width="100%" align="center" style="border-collapse: collapse;">
		<tr>
			<th colspan="3" style="border: 1px solid; padding:12px;">
				<img style="margin-left: 25%" src= "{{ url('public/dist/img/Logo LCG.jpg') }}">
			</th>
			<th colspan="6" style="border: 1px solid; padding:12px;text-align: center;">
				Land Connect Cargo (PVT) LTD
			</th>
		</tr>
		<tr>
			<th style="border: 1px solid; padding:12px;text-align: center;">builty no</th>
			<td colspan="2" style="border: 1px solid; padding:12px;text-align: center;">  <?php
                 echo "<pre>";
  print_r($bilty['builty_no']);
               ?> </td>
			<th style="border: 1px solid; padding:12px;text-align: center;">From</th>
			<td colspan="2" style="border: 1px solid; padding:12px;text-align: center;"> 
				<?php 
  echo $bilty['departure'];
               ?></td>
			<th style="border: 1px solid; padding:12px;text-align: center;">to</th>
			<td colspan="2" style="border: 1px solid; padding:12px;text-align: center;"> <?php 
  echo $bilty['destination'];
               ?> </td>
		</tr>
		<tr>
			<th style="border: 1px solid; padding:12px;text-align: center;">Date</th>
			<td colspan="2" style="border: 1px solid; padding:12px;text-align: center;"> <?php 
  echo $bilty['created_at'];
               ?>  </td>
			<th style="border: 1px solid; padding:12px;text-align: center;">Car number</th>
			<td colspan="2" style="border: 1px solid; padding:12px;text-align: center;"> <?php 
  echo $bilty['car_no'];
               ?> </td>
			<th style="border: 1px solid; padding:12px;text-align: center;">Driver name</th>
			<td colspan="2" style="border: 1px solid; padding:12px;text-align: center;"> <?php 
  echo $bilty['driver_name'];
               ?> </td>
		</tr>
<!-- 		<tr>
			<th style="border: 1px solid; padding:12px;text-align: center;">Sender</th>
			<td colspan="3" style="border: 1px solid; padding:12px;text-align: center;"> <?php 
   
               ?> </td>
			<th style="border: 1px solid; padding:12px;text-align: center;">Driver number</th>
			<td colspan="3" style="border: 1px solid; padding:12px;text-align: center;"> <?php 
  
               ?> </td>
	   </tr> -->
	        <tr>
			<th style="border: 1px solid; padding:12px;text-align: center;">Receiver</th>
			<td colspan="3" style="border: 1px solid; padding:12px;text-align: center;"> <?php 
  echo $bilty['receiving_company'];
               ?> 
           </td>
			<th style="border: 1px solid; padding:12px;text-align: center;">Driver cnic</th>
			<td colspan="3" style="border: 1px solid; padding:12px;text-align: center;"> <?php 
  echo $bilty['cnic'];
               ?>
                </td>
	             </tr>
		<tr>
			<th colspan="3" style="border: 1px solid; padding:12px;text-align: center;">Description</th>
            <th colspan="3" style="border: 1px solid; padding:12px;text-align: center;">Weight</th>
            <th colspan="3" style="border: 1px solid; padding:12px;text-align: center;">Rate</th>  
		</tr>
			<tr>
			<th colspan="3" style="border: 1px solid; padding:12px;text-align: center; height: 150px">
				
			</th>
            <th colspan="3" style="border: 1px solid; padding:12px;text-align: center; height: 15%"><?php 
  echo "company weight".$bilty['c_weight']."<br><br>";

       if ($bilty['r_weight']!='0.00') {
       	echo "receiving weight".$bilty['r_weight'];
       }
               ?></th>
            <th colspan="3" style="border: 1px solid; padding:12px;text-align: center; height: 15%"><?php 
  echo $bilty['c_rate'];
               ?></th>  
		</tr>
	</table>

	<br>
	<a href="{{ url('print_bilty'.$bilty['buid'])}}"><button>print</button></a>

<button onclick="goBack()">back</button>
</body>
</html>