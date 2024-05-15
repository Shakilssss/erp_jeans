<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Monthly Salary Summary Report</title>
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
<?php //print_r($values); 
//echo $daily_status;
/*<!--$base_url = base_url();
$url = $base_url."index.php/payroll_con/monthly_salary_sheet_export/$salary_month/$col_desig/$col_line/$col_dept/$col_all";
?>
<div>
<div id="no_print" style="float:right;">
<a href="<?php echo $url ?>"><img height="30px" width="30px" src="<?php echo $base_url.'images/xls.jpg'; ?>" align="" /></a>
</div>-->*/
?>
<div style="width:auto; ">
<?php 
$this->load->view("head_english"); 
?>


<div style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif; width:100%; ">
	<div  style="font-size:13px; font-weight:bold; text-align:center; width:100%;">
	Monthly Salary Summary of 
	<?php 
	$date = $salary_month;
	$year=trim(substr($date,0,4));
	$month=trim(substr($date,5,2));
	$date_format = date("F-Y", mktime(0, 0, 0, $month, 1, $year));
	echo $date_format;
	
	?></div>
	<br />
	
	<table class="sal" border="1" cellspacing="0" cellpadding="0" style="font-size:12px;">
  <col width="78" />
  <col width="35" />
  <col width="50" />
  <col width="35" />
  <col width="37" />
  <col width="35" />
  <col width="37" />
  <col width="35" />
  <col width="37" />
  <col width="35" />
  <col width="37" />
  <col width="82" />
  <col width="35" />
  <col width="48" />
  <col width="35" />
  <col width="37" />
  <col width="35" />
  <col width="37" />
  <col width="35" />
  <col width="37" />
  <col width="35" />
  <col width="37" />
  <col width="83" />
  <tr height="20" align="center" style="font-weight:bold;">
    <td rowspan="3" height="60" width="150">Section</td>
    <td colspan="2" width="85">Total M.Power</td>
    <td colspan="9" width="370">Payable Summary</td>
    <td colspan="4" width="299">Deduction Summary</td>
    <td colspan="3" rowspan="2" width="155">Net Payable</td>
  </tr>
  <tr height="20" align="center" style="font-weight:bold;">
    <td rowspan="2" height="40" width="35">Cash</td>
    <td rowspan="2" width="35">Bank</td>
    <td colspan="2">Salry</td>
    <td colspan="2">Attn. Bonus</td>
    <td colspan="2">Overtime</td>
    <td colspan="3">Total</td>
    <td colspan="2">G. &amp; CMS Adv.</td>
    <td colspan="2">Absent</td>
    <!--<td colspan="2">Stam</td>-->
   <!-- <td colspan="2">Tax</td>-->
  </tr>
  <tr height="20" align="center" style="font-weight:bold;">
    <td height="20" width="50">Cash</td>
    <td width="50">Bank</td>
    <td width="50">Cash</td>
    <td width="50">Bank</td>
    <td width="50">Cash</td>
    <td width="50">Bank</td>
    <td width="50">Cash</td>
    <td width="50">Bank</td>
    <td width="82">Cash &amp; Bank</td>
    <td width="50">Cash</td>
    <td width="50">Bank</td>
    <!--<td width="50">Cash</td>
    <td width="50">Bank</td>-->
    <!--<td width="50">Cash</td>
    <td width="50">Bank</td>-->
    <td width="50">Cash</td>
    <td width="50">Bank</td>
    <td width="50">Cash</td>
    <td width="50">Bank</td>
    <td width="83">Cash &amp; Bank</td>
  </tr>
		
		<?php
		$total_cash_emp = 0;
		$total_bank_emp = 0;
		$total_cash_salary = 0;
		$total_bank_salary = 0;
		$total_cash_attn_bouns = 0;
		$total_bank_attn_bouns = 0;
		$cash_ot_amount = 0;
		$bank_ot_amount = 0;
		$cash_total = 0;
		$bank_total = 0;
		$total_cash_and_bank = 0;
		$adv_deduct_cash = 0;
		$adv_deduct_bank = 0;
		$abs_deduction_cash = 0;
		$abs_deduction_bank = 0;
		$total_cash_stam_deduct = 0;
		$total_bank_stam_deduct = 0;
		$tax_cash = 0;
		$tax_bank = 0;
		$total_cash_after_deduct = 0;
		$total_bank_after_deduct = 0;
		$sub_total = 0;
		
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
			
			echo "<td align='right'>";
			echo number_format($values["cash_sum"][$i]);
			echo "</td>";
			
			$total_cash_salary = $total_cash_salary + $values["cash_sum"][$i];
			
			echo "<td align='right'>";
			echo number_format($values["bank_sum"][$i]);
			echo "</td>";
			
			$total_bank_salary = $total_bank_salary + $values["bank_sum"][$i];
			
			echo "<td align='right'>";
			echo number_format($values["cash_att_bonus"][$i]);
			echo "</td>";
			
			$total_cash_attn_bouns = $total_cash_attn_bouns + $values["cash_att_bonus"][$i];
			
			echo "<td align='right'>";
			echo number_format($values["bank_att_bonus"][$i]);
			echo "</td>";
			
			$total_bank_attn_bouns = $total_bank_attn_bouns + $values["bank_att_bonus"][$i];
			
			echo "<td align='right'>";
			echo number_format($values["cash_ot_amount"][$i]);
			echo "</td>";
			
			$cash_ot_amount = $cash_ot_amount + $values["cash_ot_amount"][$i];
			
			echo "<td align='right'>";
			echo number_format($values["bank_ot_amount"][$i]);
			echo "</td>";
			
			$bank_ot_amount = $bank_ot_amount + $values["bank_ot_amount"][$i];
			
			echo "<td align='right'>";			
			echo number_format($values["cash_total"][$i]);
			echo "</td>";
			
			$cash_total = $cash_total + $values["cash_total"][$i];
			
			echo "<td align='right'>";			
			echo number_format($values["bank_total"][$i]);
			echo "</td>";
			
			$bank_total = $bank_total + $values["bank_total"][$i];
			
			echo "<td align='right'>";			
			echo number_format($values["total_cash_and_bank"][$i]);
			echo "</td>";
			
			$total_cash_and_bank = $total_cash_and_bank + $values["total_cash_and_bank"][$i];
			
			echo "<td align='right'>";
			echo number_format($values["adv_deduct_cash"][$i]);
			echo "</td>";
			
			$adv_deduct_cash = $adv_deduct_cash + $values["adv_deduct_cash"][$i];
			
			echo "<td align='right'>";
			echo number_format($values["adv_deduct_bank"][$i]);
			echo "</td>";
			
			$adv_deduct_bank = $adv_deduct_bank + $values["adv_deduct_bank"][$i];
			
			echo "<td align='right'>";
			echo number_format($values["abs_deduction_cash"][$i]);
			echo "</td>";
			
			$abs_deduction_cash = $abs_deduction_cash + $values["abs_deduction_cash"][$i];
			
			echo "<td align='right'>";
			echo number_format($values["abs_deduction_bank"][$i]);
			echo "</td>";
			
			$abs_deduction_bank = $abs_deduction_bank + $values["abs_deduction_bank"][$i];
			
			/*echo "<td align='right'>";			
			echo number_format($values["total_cash_stam_deduct"][$i]);
			echo "</td>";
			
			$total_cash_stam_deduct = $total_cash_stam_deduct + $values["total_cash_stam_deduct"][$i];
			
			echo "<td align='right'>";			
			echo number_format($values["total_bank_stam_deduct"][$i]);
			echo "</td>";
			
			$total_bank_stam_deduct = $total_bank_stam_deduct + $values["total_bank_stam_deduct"][$i];*/
			
			/*echo "<td align='right'>";
			echo number_format($values["tax_cash"][$i]);
			echo "</td>";
			
			$tax_cash = $tax_cash + $values["tax_cash"][$i];
			
			echo "<td align='right'>";
			echo number_format($values["tax_bank"][$i]);
			echo "</td>";
			
			$tax_bank = $tax_bank + $values["tax_bank"][$i];*/

			echo "<td align='right'>";			
			echo number_format($values["total_cash_after_deduct"][$i]);
			echo "</td>";
			
			$total_cash_after_deduct = $total_cash_after_deduct + $values["total_cash_after_deduct"][$i];
			
			echo "<td align='right'>";			
			echo number_format($values["total_bank_after_deduct"][$i]);
			echo "</td>";
			
			$total_bank_after_deduct = $total_bank_after_deduct + $values["total_bank_after_deduct"][$i];
			
			//$values["sub_total"][$i] = number_format($values["sub_total"][$i]);
			echo "<td align='right'>";			
			echo number_format($values["sub_total"][$i]);
			echo "</td>";
			
			$sub_total = $sub_total + $values["sub_total"][$i];
			
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
		
		echo "<td align='right'>";
		echo number_format($total_cash_salary);
		echo "</td>";
		
		echo "<td align='right'>";
		echo number_format($total_bank_salary);
		echo "</td>";
		
		echo "<td align='right'>";
		echo number_format($total_cash_attn_bouns);
		echo "</td>";
		
		echo "<td align='right'>";
		echo number_format($total_bank_attn_bouns );
		echo "</td>";

		echo "<td align='right'>";
		echo number_format($cash_ot_amount );
		echo "</td>";

		echo "<td align='right'>";
		echo number_format($bank_ot_amount) ;
		echo "</td>";

		echo "<td align='right'>";
		echo number_format($cash_total );
		echo "</td>";

		echo "<td align='right'>";
		echo number_format($bank_total );
		echo "</td>";

		echo "<td align='right'>";
		echo number_format($total_cash_and_bank);
		echo "</td>";

		echo "<td align='right'>";
		echo number_format($adv_deduct_cash );
		echo "</td>";

		echo "<td align='right'>";
		echo number_format($adv_deduct_bank );
		echo "</td>";

		echo "<td align='right'>";
		echo number_format($abs_deduction_cash );
		echo "</td>";

		echo "<td align='right'>";
		echo number_format($abs_deduction_bank );
		echo "</td>";

		/*echo "<td align='right'>";
		echo number_format($total_cash_stam_deduct) ;
		echo "</td>";

		echo "<td align='right'>";
		echo number_format($total_bank_stam_deduct) ;
		echo "</td>";*/

		/*echo "<td align='right'>";
		echo number_format($tax_cash );
		echo "</td>";

		echo "<td align='right'>";
		echo number_format($tax_bank );
		echo "</td>";*/

		echo "<td align='right'>";
		echo number_format($total_cash_after_deduct) ;
		echo "</td>";

		echo "<td align='right'>";
		echo number_format($total_bank_after_deduct) ;
		echo "</td>";

		echo "<td align='right'>";
		echo number_format($sub_total) ;
		echo "</td>";

		
		
		echo "</tr>";
	?>
	</table>
	<div style="margin:0 auto; width:100%; ">
	<div style="margin:0 auto; width:100%; font-size:12px; padding-top:10px; padding-bottom:10px; overflow:hidden;">
		<div style=" width:30%;float:left; padding-top:40px;">
		Manager-Finance & Accounts Name <br />
		Manager-Finance & Accounts
		</div>
		
		<div style=" width:30%; float:left;">
		<div style="width:50%; float:left;">
		Salaries Payable <br />
		OT Payable <br />
		Attn. Bonus Payable <br /><br />
		<strong>Total Payable</strong> <br />
		</div>
		
		<div style="width:48%; float:left; text-align:right;">
		<?php
		$salary_payable = $total_cash_salary + $total_bank_salary;
		echo number_format($salary_payable);
		?>
		<br />
		<?php
		$ot_payable = $cash_ot_amount + $bank_ot_amount;
		echo number_format($ot_payable) ;
		?>
		<br />
		<?php
		$attn_bonus_payable = $total_cash_attn_bouns + $total_bank_attn_bouns;
		echo number_format($attn_bonus_payable) ;
		?>
		<br />
		<hr />
		<strong>
		<?php
		echo number_format($total_cash_and_bank) ;
		?>
		</strong>
		</div>
		
		</div>
		
	</div>
	<div style="margin:0 auto; width:100%;">
	<table class="det" border="1" cellspacing="0" cellpadding="0" width="100%" style="font-weight:bold; font-size:12px;">
  <col width="78" />
  <col width="35" />
  <col width="50" />
  <col width="35" />
  <col width="37" />
  <col width="35" />
  <col width="37" />
  <col width="35" />
  <col width="37" />
  <col width="35" />
  <col width="37" />
  <col width="82" />
  <col width="35" />
  <col width="48" />
  <col width="35" />
  <col width="37" />
  <col width="35" />
  <col width="37" />
  <col width="35" />
  <col width="37" />
  <col width="35" />
  <col width="37" />
  <col width="83" />
  <tr height="20" align="center">
    <td colspan="8" height="20" width="342">Agreed</td>
    <td colspan="8" width="346">Agreed</td>
    <td colspan="7" width="299">Agreed</td>
  </tr>
  <tr height="56" align="center">
    <td colspan="8" height="56">&nbsp;</td>
    <td colspan="8">&nbsp;</td>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr height="31" align="center">
    <td colspan="8" height="31"><span style="float:left; padding-left:10px;">Director Name</span>  <span style="float:right; padding-right:10px;">Director</span></td>
    <td colspan="8">Managing Director Name <br /> Managing Director</td>
    <td colspan="7"><span style="float:left; padding-left:10px;">Chairman Name</span> <span style="float:right; padding-right:10px;">Chairman</span></td>
  </tr>
</table>
	</div>
	</div>
</div>
</div>
</body>
</html>