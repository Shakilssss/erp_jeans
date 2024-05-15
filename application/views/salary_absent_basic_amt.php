<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Mismatch Amt. Sheet of <?=date("F-Y", strtotime($salary_month))?></title>
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/SingleRow.css" />
</head>

<body style="width:800px;">

<?php 
$row_count=count($value);
if($row_count > 20){
	$page = ceil($row_count/20);
}else{
	$page=1;
}

$k = 0;
			$basic = 0;
			$house_rent = 0;
			$medical_all = 0;
			$gross_sal = 0;
			$abs_deduct = 0;
			$payable_basic = 0;
			$payable_house_rent =0;
			$payable_madical_allo =0;
			$pay_wages = 0;
			$grand_total_att_bonus =0;
			$grand_total_net_wages_after_deduction = 0;
			$grand_total_net_wages_with_ot = 0;
			$trans_allaw = 0;
			$lunch_allaw =0;
			$others_allaw = 0;
			$total_allaw =0;
			$ot_hour =0;
			$ot_rate =0;
			$ot_amount =0;
			$gross_pay =0;
			$adv_deduct =0;
			$provident_fund =0;
			$others_deduct =0;
			$total_deduct =0;
			$pbt =0;
			$tax =0;
			$net_pay =0;
			
			$stam_value = 10;
			$total_stam_value = 0;
			$grand_total_advance_salary = 0;
			$grand_total_lunch_deduction_hour = 0;
			$grand_total_lunch_deduction_amount = 0;
			$grand_total_absent_deduction = 0;
			$grand_total_stamp_deduction = 0;
			$grand_total_net_wages_without_ot = 0;
			$grand_total_ot_hour = 0;
			$grand_total_ot_amount = 0;
			
			
			?>
			
			<?php
for ( $counter = 1; $counter <= $page; $counter ++)
{
?>

<table align="center" height="auto"  class="sal" border="1" cellspacing="0" cellpadding="0" style="font-size:12px; width:auto;">

<tr height="85px">
<td colspan="17" align="center">

<div style="text-align:right; position:relative; top:20px; padding-left:10px;font-weight:bold;">
<?php
$line_name = $this->db->where("line_id",$grid_line)->get('pr_line_num')->row()->line_name;
echo "Line Name: ".$line_name.", "; 
?>
<?="Page No # $counter of $page"?>
</div>
 
<?php $this->load->view("head_english"); ?>
Mismatch Amt. Sheet of 
<?= date("F-Y", strtotime($salary_month))?>

</td>
</tr>
        <th rowspan="2" width="15" height="20px"><div align="center"><strong>	SI. No				</strong></div></td>
        <th rowspan="2" width="30" height="20px"><div align="center"><strong>	Name of Employee	</strong></div></td>
        <th rowspan="2" width="14" height="20px"><div align="center"><strong>	Card No				</strong></div></td>
        <th rowspan="2" width="25" height="20px"><div align="center"><strong>	Designation			</strong></div></td>
        <th rowspan="2" width="25" height="20px"><div align="center"><strong>	Section				</strong></div></td>
        <th rowspan="2" width="25" height="20px"><div align="center"><strong>	Joining Date		</strong></div></td>
        <th rowspan="2" width="25" height="20px"><div align="center"><strong>	Grade				</strong></div></td>
        <th rowspan="2" width="20" height="20px"><div align="center"><strong>	Basic				</strong></div></td>
        <th rowspan="2" width="17" height="20px"><div align="center"><strong>	H/Rent				</strong></div></td>
        <th rowspan="2" width="15" height="20px"><div align="center"><strong>	Medical				</strong></div></td>
        <th rowspan="2" width="15" height="20px"><div align="center"><strong>	Trans.				</strong></div></td>
        <th rowspan="2" width="15" height="20px"><div align="center"><strong>	Food				</strong></div></td>
        <th rowspan="2" width="35" height="20px"><div align="center"><strong>	Gross Salary		</strong></div></td>
        <th rowspan="2" width="35" height="20px"><div align="center"><strong>General<br>Absent</strong></div></td>
        <th rowspan="2" width="35" height="20px"><div align="center"><strong>Mismatch<br>Payable Amt</strong></div></td>
        <th rowspan="2" width="100" height="20px"><div align="center"><strong>	Signature			</strong></div></td>
        <tr></tr>
<?php
			
	if($counter == $page){
   		$modulus = ($row_count-1) % 20;
    	$per_page_row=$modulus;
	}else{
    	$per_page_row=19;
   	}
  	
   	$total_pay_wages	= 0;
	$total_ot_hours   	= 0;
	$total_ot_amount  	= 0;
	$total_att_bonus	= 0;
	$total_gross_pays	= 0;
	$total_net_pays		= 0;
	$total_net_wages_after_deduction = 0;
	$total_net_wages_with_ot = 0;
	
	$total_gross_sal_per_page = 0;
	$total_advance_per_page = 0;
	$lunch_deduction_hour_per_page = 0;
	$lunch_deduction_amount_per_page = 0;
	$total_absent_deduction_per_page = 0;
	$total_stamp_deduction_per_page = 0;
	$total_net_wages_without_ot_per_page = 0;
	$total_ot_hour_per_page = 0;
	$total_ot_amount_per_page = 0;
	
	for($p=0; $p<=$per_page_row;$p++){
		echo "<tr height='45' style='text-align:center;' >";
		echo "<td >";
		echo $k+1;
		echo "</td>";
		
		echo "<td style='width:100px;'>";
		print_r($value[$k]->emp_full_name);
		echo "</td>"; 
				
		echo "<td>";
		print_r($value[$k]->emp_id);
		echo "</td>";
				
		echo "<td>";
		print_r($value[$k]->desig_name);
		echo "</td>";
		
		echo "<td>";
		print_r($value[$k]->sec_name);
		echo "</td>";
				
		echo "<td>";
		echo date("d-M-y",strtotime($value[$k]->emp_join_date));
		echo "</td>";
			
		echo "<td>";
		print_r ($value[$k]->gr_name);
		echo "</td>";
			
		echo "<td>";
		print_r ($value[$k]->basic_sal);
		$basic = $basic + $value[$k]->basic_sal;
		echo "</td>";
			
		echo "<td>";
		print_r ($value[$k]->house_r);
		$house_rent = $house_rent + $value[$k]->house_r;
		echo "</td>";
			
		echo "<td>";
		print_r ($value[$k]->medical_a);
		$medical_all = $medical_all + $value[$k]->medical_a;
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->trans_allow);
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->food_allow);
		echo "</td>";
				 
		echo "<td style='font-weight:bold;'>";
		print_r ($value[$k]->gross_sal);
		$gross_sal = $gross_sal + $value[$k]->gross_sal;
		$total_gross_sal_per_page = $total_gross_sal_per_page + $value[$k]->gross_sal;
		echo "</td>";
		
		echo "<td>";
		echo $value[$k]->absent_days;
		echo "</td>";
		$monthDay = date('t',strtotime($salary_month));
		$absAmtG = round(($value[$k]->gross_sal/$monthDay)*$value[$k]->absent_days);
		$absAmtB = round(($value[$k]->basic_sal/$monthDay)*$value[$k]->absent_days);
				
		echo "<td>";
		echo $eot_amount = $absAmtG-$absAmtB;
		echo "</td>";
		
		$total_ot_amount_per_page = $total_ot_amount_per_page + $eot_amount;
		$grand_total_ot_amount = $grand_total_ot_amount + $eot_amount;
		
		echo "<td>";
		echo "&nbsp;";
		echo "</td>";
			
		echo "</tr>"; 
		$k++;
	}
	?>
	<tr>
		<td align="center" colspan="14"><strong>Total Per Page</strong></td>
		<td align="right"><strong><?=number_format($total_ot_amount_per_page);?></strong></td>
		<td></td>
	</tr>
	<?php
	if($counter == $page)
   		{?>
			<tr height="10">
			<td colspan="14" align="center"><strong>Grand Total Amount Tk</strong></td>
            <td align="right"><strong><?= number_format($grand_total_ot_amount);?></strong></td>
			<td></td>
			</tr>
			<?php } ?>
			
			<table width="100%" height="80px" border="0" align="center" style="margin-bottom:50px; font-family:Arial, Helvetica, sans-serif; font-size:14px;">
			<tr height="80%" >
			<td colspan="28"></td>
			</tr>
			<tr height="20%">
			<td  align="center">Prepared By (HRM Dept.)</td>
			<td align="center">Checked BY (Account Dept.)</td>
			<td  align="center">Manager(Admin & HRM)</td>
			<td  align="center">Authorized By</td>
			</tr>
			
			</table>
			</table>
			<div style="page-break-after: always;"></div>
			<?php
		}
?>
</body>
</html>