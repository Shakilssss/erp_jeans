<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Monthly EOT Summary Report</title>
<link rel="stylesheet" type="text/css" href="../../../../../../css/print.css" media="print" />

<style type="text/css">
.sal tr td{
border:1px #000000 solid;
border-top-style:none;
border-left-style:none;
padding-right:2px;

}
.sal{
border:1px #000000 solid;
   border-bottom-style: none;
   border-right-style: none;
   }
   
.det tr td{
border:1px #000000 solid;
border-top-style:none;
border-left-style:none;

}
.det{
border:1px #000000 solid;
   border-bottom-style: none;
   border-right-style: none;
   }
</style>
</head>

<body>
<div style="width:auto; ">
<?php 
$this->load->view("head_english"); 
?>


<div style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif; width:100%; ">
	<div  style="font-size:13px; font-weight:bold; text-align:center; width:100%;">
	<?php 
	if($grid_status == 1)
	{ echo 'Reguler Employee '; }
	elseif($grid_status == 2)
	{ echo 'New Employee '; }
	elseif($grid_status == 3)
	{ echo 'Left Employee '; }
	elseif($grid_status == 4)
	{ echo 'Resign Employee '; }
	elseif($grid_status == 6)
	{ echo 'Promoted Employee '; }
	?>
	Monthly EOT Summary of 
	<?php 
	$date = $salary_month;
	$year=trim(substr($date,0,4));
	$month=trim(substr($date,5,2));
	$date_format = date("F-Y", mktime(0, 0, 0, $month, 1, $year));
	echo $date_format;
	
	?></div>
	<br />
	
	<table class="sal" border="1" cellspacing="0" cellpadding="0" style="font-size:12px; margin:0 auto; width:68%;">
  <tr height="20" align="center" style="font-weight:bold;">
    <td rowspan="2" height="60" width="150">Section</td>
    <td colspan="3" width="85">Total M.Power</td>
    <td colspan="3" width="85">EOT Hour</td>
    <td colspan="3" width="85">Amount</td>
  </tr>
 
  <tr height="20" align="center" style="font-weight:bold;">
    <td height="20" width="50">Cash</td>
    <td width="50">Bank</td>
    <td width="50">Total</td>
    <td width="50">Cash</td>
    <td width="50">Bank</td>
    <td width="50">Total</td>
    <td width="50">Cash</td>
    <td width="50">Bank</td>
    <td width="50">Total</td>
  </tr>
		
		<?php
		$total_cash_emp = 0;
		$total_bank_emp = 0;
		$total_cash_eot_hour = 0;
		$total_bank_eot_hour = 0;
		$total_cash_eot_amount = 0;
		$total_bank_eot_amount = 0;
		$total_emp_cash_bank =0;
		$total_cash_bank_eot_hour =0;
		$total_cash_bank_eot_amount = 0;
		
		
		$count = count($values["dept"]);
		for($i=0; $i < $count; $i++)
		{
			echo "<tr>";
			
			echo "<td align='center'>";
			echo $values["dept"][$i];
			echo "</td>";
			 
			echo "<td align='center'>";
			echo $values["emp_cash"][$i];
			echo "</td>";
			
			$total_cash_emp = $total_cash_emp + $values["emp_cash"][$i];
			
			echo "<td align='center'>";
			echo $values["emp_bank"][$i];
			echo "</td>";
			
			$total_bank_emp = $total_bank_emp + $values["emp_bank"][$i];
			
			
			echo "<td align='center'>";
			echo $values["emp_cash_bank"][$i];
			echo "</td>";
			
			$total_emp_cash_bank = $total_emp_cash_bank + $values["emp_cash_bank"][$i];
			
			//======================================================
			
			echo "<td align='right'>";
			echo number_format($values["eot_cash_sum"][$i]);
			echo "</td>";
			
			$total_cash_eot_hour = $total_cash_eot_hour + $values["eot_cash_sum"][$i];
			
			echo "<td align='right'>";
			echo number_format($values["eot_bank_sum"][$i]);
			echo "</td>";
			
			$total_bank_eot_hour = $total_bank_eot_hour + $values["eot_bank_sum"][$i];
			
			
			echo "<td align='right'>";
			echo number_format($values["eot_cash_bank_hour"][$i]);
			echo "</td>";
			$total_cash_bank_eot_hour = $total_cash_bank_eot_hour + $values["eot_cash_bank_hour"][$i];
			
			//======================================================
			echo "<td align='right'>";
			echo number_format($values["eot_amount_cash_sum"][$i]);
			echo "</td>";
			
			$total_cash_eot_amount = $total_cash_eot_amount + $values["eot_amount_cash_sum"][$i];
			
			echo "<td align='right'>";
			echo number_format($values["eot_amount_bank_sum"][$i]);
			echo "</td>";
			
			$total_bank_eot_amount = $total_bank_eot_amount + $values["eot_amount_bank_sum"][$i];
			
			
			echo "<td align='right'>";
			echo number_format($values["eot_cash_bank_amount"][$i]);
			echo "</td>";
			
			$total_cash_bank_eot_amount = $total_cash_bank_eot_amount + $values["eot_cash_bank_amount"][$i];
			echo "</tr>";
		}
		echo "<tr style='font-weight:bold;'>";
		
		echo "<td align='center'>";
		echo "Total";
		echo "</td>";
		
		echo "<td align='center'>";
		echo $total_cash_emp;
		echo "</td>";
		
		echo "<td align='center'>";
		echo $total_bank_emp;
		echo "</td>";
		
		echo "<td align='center'>";
		echo $total_emp_cash_bank;
		echo "</td>";
		
		echo "<td align='right'>";
		echo number_format($total_cash_eot_hour);
		echo "</td>";
		
		echo "<td align='right'>";
		echo number_format($total_bank_eot_hour);
		echo "</td>";
		
		
		echo "<td align='right'>";
		echo number_format($total_cash_bank_eot_hour);
		echo "</td>";
		
		echo "<td align='right'>";
		echo number_format($total_cash_eot_amount);
		echo "</td>";
		
		echo "<td align='right'>";
		echo number_format($total_bank_eot_amount);
		echo "</td>";
		
		
		echo "<td align='right'>";
		echo number_format($total_cash_bank_eot_amount);
		echo "</td>";
		echo "</tr>";
	?>
	</table>
<table width="70%" height="80px" border="0" align="center" style="margin-bottom:75px; font-family:Arial, Helvetica, sans-serif;">
			<tr height="80%" >
			<td colspan="28"></td>
			</tr>
			<tr height="20%">
			<td  align="center">Prepared By (HRM Dept.)</td>
			<td align="center">Checked BY (Account Dept.)</td>
			<td  align="center">Asst. Manager(Admin & HRM)</td>
			<!--<td  align="center">Factory Manager</td>-->
			<td  align="center">Authorized By</td>
			</tr>
			
			</table></div>
</div>
</body>
</html>