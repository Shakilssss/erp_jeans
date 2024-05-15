
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Daily EOT Report</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />

</head>

<body>

<div style=" margin:0 auto;  width:900px;">
<?php 
	$this->load->view("head_english"); 
?>
<!--Report title goes here-->
<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;"><span style="font-size:12px; font-weight:bold;">
Ifter Report of <?php echo $first_date." to ". $second_date; ?></span>
<br />
<br />


	<table border="1" cellpadding="0" cellspacing="0" align="center" style="font-size:12px;width: 100%">
	<th style="padding:10px">SL</th>
	<th style="padding:10px">Emp ID</th>
	<th>Employee Name</th> 
	<th style="padding:10px">Designation</th> 
	<th style="padding:10px;white-space: nowrap;">Line No. </th> 
	<th style="padding:10px;white-space: nowrap;">Out Evinig</th>
	<th style="padding:10px;white-space: nowrap;">Out Night</th>
	<th>Total</th>
	<th style="padding:10px">Rate</th>
	<th style="padding:10px">Amount</th>
	<th style='width: 120px;padding:10px'>Signature</th> 	

	<?php
		$key = 0;
		$limit= 20;
		$evening = 0;
		$night = 0;
		$total = 0;
		$total_ot_amount = 0;		
		$grand_evening = 0;
		$grand_night = 0;
		$grand_total = 0;
		$grand_total_ot_amount = 0;
		$count = count($values); $i=1;
		foreach($values as $row){
		$grand_evening += $row->evening;
		$grand_night +=$row->night;


		if($row->evening == 0 && $row->night ==0){
			continue;
		}

			
			echo "<tr>";
			
			echo "<td style='text-align:center'>";
			echo $i++;
			echo "</td>";
			
			echo "<td  style='text-align:center'>";
			echo $row->emp_id;
			echo "</td>";
			
			echo "<td   style='text-align:center;' >";
			echo $row->emp_full_name;
			echo "</td>";

			echo "<td  style='text-align:center;'>";
			echo $row->desig_name;
			echo "</td>";
			
			echo "<td  style='text-align:center;'>";
			echo $row->line_name;
			echo "</td>";

			
			echo "<td  style='text-align:center;' >";

			$a = $row->evening;
			$evening = $evening + $a;
			echo $a;
			echo "</td>";

			echo "<td  style='text-align:center;' >";

			$b = $row->night;
			$night = $night + $b;
			echo $b;
			echo "</td>";

			echo "<td  style='text-align:center;' >";

			$c = $a+$b;
			$total = $total + $c;
			echo $c;
			$grand_total += $c;
			echo "</td>";

			echo "<td  style='text-align:center;' >";

			echo 30;
			echo "</td>";

			echo "<td  style='text-align:center;' >";
			$d = 30*$c;
			$total_ot_amount =$total_ot_amount + $d;
			echo $d;
			$grand_total_ot_amount += $d;

			echo "</td>";

			echo "<td  style='text-align:center;padding: 40px 0px 5px 0px' >";
			echo "</td>";
			
			echo "</tr>";
			if($limit == $i){

			?>
			<tr>
				<td  colspan="5" style="text-align:center; font-weight:bold;padding:10px" >Total per page</td>
				<td colspan="1" style="text-align:center; font-weight:bold;padding:10px" ><?php echo $evening; ?></td>
				<td colspan="1" style="text-align:center; font-weight:bold;padding:10px" ><?php echo $night; ?></td>
				<td colspan="1" style="text-align:center; font-weight:bold;padding:10px" ><?php echo $total; ?></td>
				<td colspan="2" style="text-align:center; font-weight:bold;padding:10px" ><?php echo $total_ot_amount; ?></td>
				<td></td>
			</tr>
			<table width="100%" height="80px" border="0" align="center" style="margin-bottom:50px; font-family:Arial, Helvetica, sans-serif; font-size:14px;">
				<tr height="80%" >
				<td colspan="28"></td>
				</tr>
				<tr height="20%">
				<td style="font-size: 10px" align="center">Prepared By (HRM Dept.)</td>
				<td style="font-size: 10px" align="center">Checked BY (Account Dept.)</td>
				<td style="font-size: 10px" align="center">Auditor</td>
				<td style="font-size: 10px" align="center">AGM (Production)</td>
				<td style="font-size: 10px" align="center">Manager(Admin & HRM)</td>
				<td style="font-size: 10px" align="center">Authorized By</td>
				</tr>	
			</table>

		</table>
	<div style="page-break-after: always;"></div>
		<div style=" margin:0 auto;  width:900px;">
		<?php 
			$this->load->view("head_english"); 
				$evening = 0;
						$night = 0;
						$total = 0;
						$total_ot_amount = 0;
		?>
	<!--Report title goes here-->
	<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
		<span style="font-size:12px; font-weight:bold;">Ifter Report of <?php echo $first_date." to ". $second_date; ?></span><br /><br />
	<table class="sal" border="1" cellpadding="0" cellspacing="0" align="center" style="font-size:12px;width: 100%;">
		<th style="padding:10px">SL</th><th style="padding:10px">Emp ID</th><!-- <th>Punch Card No.</th> -->
		<th>Employee Name</th> 
		<th style="padding:10px">Designation</th> 
		<th style="padding:10px;white-space: nowrap;">Line No. </th> 
		<th style="padding:10px;white-space: nowrap;">Out Evinig</th>
		<th style="padding:10px;white-space: nowrap;">Out Night</th>
		<th>Total</th>
		<th style="padding:10px">Rate</th>
		<th style="padding:10px">Amount</th>
		<th style='width: 120px;padding:10px'>Signature</th>	

		<?php $limit+=20; } }?>
		<tr>
			<td colspan="5" style="text-align:center;font-weight:bold;padding:10px">Total per page</td>
			<td colspan="1" style="text-align:center;font-weight:bold;padding:10px"><?php echo $evening;?></td>
			<td colspan="1" style="text-align:center;font-weight:bold;padding:10px"><?php echo $night;?></td>
			<td colspan="1" style="text-align:center;font-weight:bold;padding:10px"><?php echo $total;?></td>
			<td colspan="2" style="text-align:center;font-weight:bold;padding:10px"><?php echo $total_ot_amount; ?></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="5" style="text-align:center; font-weight:bold;padding:10px" >Grand Total</td>
			<td colspan="1" style="text-align:center; font-weight:bold;padding:10px" ><?php echo $grand_evening; ?></td>
			<td colspan="1" style="text-align:center; font-weight:bold;padding:10px" ><?php echo $grand_night; ?></td>
			<td colspan="1" style="text-align:center; font-weight:bold;padding:10px" ><?php echo $grand_total; ?></td>
			<td colspan="2" style="text-align:center; font-weight:bold;padding:10px" ><?php echo $grand_total_ot_amount; ?></td>
			<td></td>
		</tr>
		<table width="100%" height="80px" border="0" align="center" style="margin-bottom:50px; font-family:Arial, Helvetica, sans-serif; font-size:14px;">
				<tr height="80%" >
				<td colspan="28"></td>
				</tr>
				<tr height="20%">
				<td style="font-size: 10px" align="center">Prepared By (HRM Dept.)</td>
				<td style="font-size: 10px" align="center">Checked BY (Account Dept.)</td>
				<td style="font-size: 10px" align="center">Auditor</td>
				<td style="font-size: 10px" align="center">AGM(Production)</td>
				<td style="font-size: 10px" align="center">Manager(Admin & HRM)</td>
				<td style="font-size: 10px" align="center">Authorized By</td>
				</tr>	
			</table>
	</table>
</div>
</div>
</body>
</html>
