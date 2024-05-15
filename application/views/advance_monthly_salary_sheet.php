<?php error_reporting(0);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>
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
?>Monthly Salary Sheet of asd
<?php 
$date = $salary_month;
$year=trim(substr($date,0,4));
$month=trim(substr($date,5,2));
$day=trim(substr($date,8,2));
$date_format = date("F-Y", mktime(0, 0, 0, $month, $day, $year));
echo $date_format;

?>

</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />


</head>

<body>

<?php 
$row_count=count($value);
if($row_count >7)
{
$page=ceil($row_count/7);
}
else
{
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
			$grand_pay_wages_amount = 0;
			
			
			?>
			<table >
			
			<?php
for ( $counter = 1; $counter <= $page; $counter ++)
{
?>

<table align="center" height="auto"  class="sal" border="1" cellspacing="0" cellpadding="0" style="font-size:12px; width:auto;">

<tr height="85px">

<?php if($deduct_status == "Yes"){?> 
<td colspan="35" align="center">
<?php }else{ ?>
<td colspan="33" align="center">
<?php } ?>

<div style="text-align:right; position:relative; top:20px; padding-right:10px; font-weight:bold;">
<?php 
$date = date('d-m-Y');
//echo "Payment Date : $date";
$line_name = $this->db->where("line_id",$grid_line)->get('pr_line_num')->row()->line_name;
echo "Line Name: ".$line_name.", "; 
echo "Page No # $counter of $page";
if($grid_section != "Select")
{
	$sec_name = $this->db->where("sec_id",$grid_section)->get('pr_section')->row()->sec_name;
	echo "<span style='float: left;padding-left:10px;'>SECTION:  $sec_name</span>";
	
}
?>

</div>
 
<?php $this->load->view("head_english");
//echo "Page No.: $counter";
 ?>
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
?>Monthly Salary Sheet of 
<?php 
$date = $salary_month;
$year=trim(substr($date,0,4));
$month=trim(substr($date,5,2));
$day=trim(substr($date,8,2));
$date_format = date("F-Y", mktime(0, 0, 0, $month, $day, $year));
echo $date_format;

?>

</td>
</tr>


  <tr height="20px">
    <td rowspan="2"  width="15" height="20px"><div align="center"><strong>SI. No</strong></div></td>
    <td rowspan="2" width="30" height="20px"><div align="center"><strong>Name of Employee</strong></div></td>
	<td rowspan="2" width="14" height="20px"><div align="center"><strong>Card No</strong></div></td>
    <td rowspan="2" width="25" height="20px"><div align="center"><strong>Designation</strong></div></td>
	 <td rowspan="2" width="25" height="20px"><div align="center"><strong>Section</strong></div></td>
    <td rowspan="2" width="25" height="20px"><div align="center"><strong>Joining Date</strong></div></td>
	<td rowspan="2" width="25" height="20px"><div align="center"><strong>Grade</strong></div></td>
    <td colspan="6" height="20px"><div align="center"><strong>Salary Status</strong></div></td>
    <td rowspan="2" width="31" height="20px"><div align="center"><strong>Day of Month</strong></div></td>
    <td colspan="4" width="30" height="20px"><div align="center"><strong>Present Status</strong></div></td>
	<td colspan="5" height="20px"><div align="center"><strong>Leave Status</strong></div></td>
    <td rowspan="2" width="25" height="20px"><div align="center"><strong>Pay Days</strong></div></td>
    <td rowspan="2"  width="15" height="20px" style="font-size:10px;"><div align="center"><strong>Attn. Bonus</strong></div></td>
    <?php if($deduct_status == "Yes"){?> 
     <td colspan="5" height="20px"><div align="center"><strong>Deduction</strong></div></td>
	 <?php }else{ ?>
	  <td colspan="2" height="20px"><div align="center"><strong>Deduction</strong></div></td>
	  <?php } ?> 
    <td rowspan="2" width="25" height="20px"><div align="center"><strong>Net Wages</strong></div></td>
    <td colspan="3" height="20px"><div align="center"><strong>Over Time Status</strong></div></td>
    <td rowspan="2" width="22" height="20px"><div align="center"><strong>Net Pay Amount</strong></div></td>
	<td rowspan="2"  width="180"><div align="center"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></div></td>
  </tr>
  <tr height="10px">
  <td width="15" style="font-size:8px;"><div align="center"><strong>Basic</strong></div></td>
	<td width="15" style="font-size:8px;"><div align="center"><strong>H/Rent</strong></div></td>
	<td width="15" style="font-size:8px;"><div align="center"><strong>Medical</strong></div></td>
    <td width="15" style="font-size:8px;"><div align="center"><strong>Transport</strong></div></td>
	<td width="15" style="font-size:8px;"><div align="center"><strong>Food</strong></div></td>
    <td width="15" style="font-size:8px;"><div align="center"><strong>Gross</strong></div></td>
  	<td width="15" style="font-size:8px;"><div align="center"><strong>Work Days</strong></div></td>
	<td width="15" style="font-size:8px;"><div align="center"><strong>Off Days</strong></div></td>
	<td width="15" style="font-size:8px;"><div align="center"><strong>Abs. Days</strong></div></td>
    <td width="15" style="font-size:8px;"><div align="center"><strong>B/A Abs. Days</strong></div></td>
  	<td width="15" style="font-size:8px;"><div align="center"><strong>C/L</strong></div></td>
	<td width="15" style="font-size:8px;"><div align="center"><strong>S/L</strong></div></td>
    <td width="15" style="font-size:8px;"><div align="center"><strong>F/L</strong></div></td>
	<td width="15" style="font-size:8px;"><div align="center"><strong>E/L</strong></div></td>
	<td width="15" style="font-size:8px;"><div align="center"><strong>M/L</strong></div></td>
	<td width="22" style="font-size:8px;"><div align="center"><strong>Adv.</strong></div></td>
	<?php if($deduct_status == "Yes"){?>
	<td width="37" style="font-size:8px;"><div align="center"><strong>Hour</strong></div></td>
	<td width="22" style="font-size:8px;"><div align="center"><strong>Amt.</strong></div></td>
	<?php } ?>
    <td width="37" style="font-size:8px;"><div align="center"><strong>Abs. Deduct</strong></div></td>
    <!--<td width="37" style="font-size:8px;"><div align="center"><strong>Stamp</strong></div></td>-->
    <td width="37" style="font-size:8px;"><div align="center"><strong>OT Hrs</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>OT Rate</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>OT Amt</strong></div></td>
    
   </tr>
<?php
			
	if($counter == $page)
  	{
   		$modulus = ($row_count-1) % 7;
    	$per_page_row=$modulus;
	}
   	else
   	{
    	$per_page_row=6;
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
	$total_pay_wages_per_page = 0;
	
	for($p=0; $p<=$per_page_row;$p++)
	{
		echo "<tr height='80' style='text-align:center;' >";
		echo "<td >";
		echo $k+1;
		echo "</td>";
		
		echo "<td>";
		print_r($value[$k]->emp_full_name);
		echo '<br>';
		if($grid_status == 4)
		{
			$resign_date = $this->grid_model->get_resign_date_by_empid($value[$k]->emp_id);
			if($resign_date != false){
			echo $resign_date = date('d-M-y', strtotime($resign_date));}
		}
		echo "</td>"; 
				
		echo "<td>";
		print_r($value[$k]->emp_id);
		$emp_id = $value[$k]->emp_id;
		//echo $row->emp_id;
		echo "</td>";
				
		echo "<td>";
		print_r($value[$k]->desig_name);
		//echo $row->desig_name;
		echo "</td>";
		
		echo "<td>";
		print_r($value[$k]->sec_name);
		//echo $row->desig_name;
		echo "</td>";
				
				
		echo "<td>";
		$date = $value[$k]->emp_join_date;
		
		$join_date = date("d-M-Y", strtotime($date));
		//print_r($value[$k]->emp_join_date);
		$year=trim(substr($date,0,4));
		$month=trim(substr($date,5,2));
		$day=trim(substr($date,8,2));
		$date_format = date("d-M-y", mktime(0, 0, 0, $month, $day, $year));
		echo $join_date;
		echo "</td>";
		
			
		echo "<td>";
		print_r ($value[$k]->gr_name);
		echo "</td>";
		
			
		$salary_structure = $this->common_model->salary_structure($value[$k]->gross_sal);
		echo "<td>";
		$basic_sal = $value[$k]->basic_sal;//$salary_structure['basic_sal'];
		echo $basic_sal;
		echo "</td>";
		
		echo "<td>";
		 print_r ($value[$k]->house_r);//$salary_structure['house_rent'];
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->medical_a);
		echo "</td>";
		
		echo "<td>";
		 print_r ($value[$k]->trans_allow);
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->food_allow);
		echo "</td>";
				 
		echo "<td style='font-weight:bold;'>";
		print_r ($value[$k]->gross_sal);
		
		//echo "<strong>$row->gross_sal</strong>";
		$gross_sal = $gross_sal + $value[$k]->gross_sal;
		$total_gross_sal_per_page = $total_gross_sal_per_page + $value[$k]->gross_sal;
		echo "</td>";
		
		$total_days = $value[$k]->total_days;
		
		echo "<td>";
		$num_of_days = $value[$k]->total_days;
		print_r ($value[$k]->total_days);
		//echo $row->total_days;
		echo "</td>";
		
		//Calaculate payable Days
		//echo $total_days;
		$sal_year=trim(substr($salary_month,0,4));
		$sal_month=trim(substr($salary_month,5,2));
		$start_date = "$sal_year-$sal_month-01";
		$attend = "P";
		$sal_days = $sal_month == '2' ? 28 : 30; 
		$attend = $this->salary_process_model->attendance_check($emp_id,$attend,$sal_days,$start_date);
		
		$absent = "A";
		$real_absent = $this->salary_process_model->attendance_check($emp_id,$absent,$sal_days,$start_date);
		
		
		$holiday = "H";
		$holiday = $this->common_model->holiday_attendance_check($emp_id,$holiday,$sal_days, $start_date);
		
		$weekend_total_days = $total_days;
		$weekend_start_date = $start_date;
		$join_year_month = date("m-Y", strtotime($date));
		$salary_year_month = date("m-Y", strtotime($salary_month));
		if($salary_year_month == $join_year_month)
		{
			
			$doj = $value[$k]->emp_join_date;
			$daylen = 60*60*24;
			$last_date = date('Y-m-t', strtotime($start_date));
		   	$date1 = $last_date;
		   	$date2 = $doj;
		
		   	$weekend_total_days =  (strtotime($date1)-strtotime($date2))/$daylen;
			$weekend_start_date = $doj;
		}
		
		$weekend_days = "Fri";
		$weekend_manu = $this->common_model->get_weekend_days($weekend_days,$weekend_total_days,$weekend_start_date,$emp_id);
		//print_r($weekend_manu);
		
		if(isset($holiday['h_date']))
		{
			$result = array_intersect($weekend_manu['wk_date'],$holiday['h_date']);
			$count_wk_holiday_match = count($result);
		}
		else
		{
			
			$result = 0;//$weekend_manu['wk_date'];
			$count_wk_holiday_match = 0;
		}
		
		//echo $count_wk_holiday_match;
		$weekend_manu_no_weekends = $weekend_manu['no_weekends'] - $count_wk_holiday_match;
		
		//echo $attend;
		$weeked = $value[$k]->weeked;
		$w_holiday = $value[$k]->holidy;
		$attend_days = $attend - $weekend_manu['total_weekend_present'];//($attend + $weeked) - $weekend_manu_no_weekends;
		
		
		
		

		
		$total_holiday = $weeked + $holiday['h_count'];
		$holiday_or_weeked = $total_holiday;
				
		$leave = "L";
		$total_leave = $this->salary_process_model->attendance_check($emp_id,$leave,$total_days,$start_date);
		
		$absent = $real_absent - $weekend_manu['total_weekend_absent'];
		$weekend_manu_absent = $weekend_manu['total_weekend_absent'];
		//echo "$absent = $real_absent - $weekend_manu_absent";
		$payable_salary_days = $total_days - $absent;
		echo "<td>";
		echo $attend_days;
		echo "</td>"; 
		
		echo "<td>";
		echo $weeked;// + $w_holiday;
		echo "</td>";
		
		$before_after_absent = $value[$k]->before_after_absent;
		if($before_after_absent > 0)
		{
			$absent = $absent -$before_after_absent;
		}
		
		echo "<td>";
		echo $absent;
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->before_after_absent);
		//echo "abs".$row->absent_days;
		echo "</td>";
				
				
		echo "<td>";
		print_r ($value[$k]->c_l);
		//echo "cl".$row->c_l;
		echo "</td>";
			
		echo "<td>";
		print_r ($value[$k]->s_l);
		//echo "sl".$row->s_l;
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->holidy);
		//echo "ho_day" . $row->holiday_or_weeked;
		echo "</td>"; 
				
		echo "<td>";
		print_r ($value[$k]->e_l);
		//echo "el".$row->e_l;
		echo "</td>";
				
		echo "<td>";
		print_r ($value[$k]->m_l);
		echo "</td>";
		
		echo "<td>";
		echo $payable_salary_days;
		echo "</td>";
		
		/*echo "<td>";
		print_r ($value[$k]->pay_wages);
		echo "</td>";
		
		$total_pay_wages_per_page =$total_pay_wages_per_page + $value[$k]->pay_wages;
		$grand_pay_wages_amount  = $grand_pay_wages_amount + $value[$k]->pay_wages;*/
		
		echo "<td style='font-weight:bold;'>";
		print_r ($value[$k]->att_bonus);
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->adv_deduct);
		//echo "ad".$row->adv_deduct;
		$adv_deduct = $adv_deduct + $value[$k]->adv_deduct; 
		$total_advance_per_page = $total_advance_per_page + $value[$k]->adv_deduct;
		$grand_total_advance_salary = $grand_total_advance_salary + $value[$k]->adv_deduct;
		echo "</td>";
		
		$gross_salary = $value[$k]->net_pay;
				
		if($deduct_status == "Yes")
		{
			echo "<td>";
			print_r ($value[$k]->deduct_hour);
			$lunch_deduction_hour_per_page 		= $lunch_deduction_hour_per_page + $value[$k]->deduct_hour;
			$grand_total_lunch_deduction_hour 	= $grand_total_lunch_deduction_hour + $value[$k]->deduct_hour;
			echo "</td>";
			
			echo "<td>";
			$deduct_amount = $value[$k]->deduct_amount;
			$deduct_amount = round($deduct_amount,2);
			echo $deduct_amount;
			$lunch_deduction_amount_per_page 	= $lunch_deduction_amount_per_page + $deduct_amount;
			$grand_total_lunch_deduction_amount = $grand_total_lunch_deduction_amount + $deduct_amount;
			echo "</td>";
			$gross_salary = $gross_salary -$deduct_amount;
		}
		
		
		//===================Abs deduction Cal====================
		//========================================================
		$abs_deduction_salary = $basic_sal;
		$total_absent = $absent + $before_after_absent;
		
		if($salary_year_month == $join_year_month)
		{
			$join_day = date("d", strtotime($date));
			if($join_day < 15)
			{
				$abs_deduction_salary = $basic_sal;//$value[$k]->gross_sal;
			}
			else
			{
				$abs_deduction_salary = $value[$k]->gross_sal;
			}
			
		}
		//echo $abs_deduction_salary;
		echo "<td>";
		$abs_deduction = $abs_deduction_salary / $value[$k]->total_days * $total_absent;
		$abs_deduction = round($abs_deduction);
		
		echo $abs_deduction ;
		$total_absent_deduction_per_page= $total_absent_deduction_per_page + $abs_deduction;
		$grand_total_absent_deduction 	= $grand_total_absent_deduction + $abs_deduction;
		echo "</td>";
		
		//==================================================
			
		$pay_wages 		= $value[$k]->pay_wages; 
		$adv_deduct 	= $value[$k]->adv_deduct;
		$att_bonus 		= $value[$k]->att_bonus;
		$deduct_amount 	= $value[$k]->deduct_amount;
		
		$total_att_bonus = $total_att_bonus + $att_bonus;
		$grand_total_att_bonus = $grand_total_att_bonus + $att_bonus;
		
		
		
		$net_wages_after_deduction = $value[$k]->gross_sal - $adv_deduct - $deduct_amount - $abs_deduction + $att_bonus;
		
		/*echo "<td>";
		if($value[$k]->gross_pay <= $stam_value)
		{
			echo '0';
			$total_stam_value = $total_stam_value;
		}
		else
		{
			echo $stam_value;
			$net_wages_after_deduction = $net_wages_after_deduction - $stam_value; 
			$total_stam_value = $total_stam_value + $stam_value;
		}*/
		
		$total_net_wages_without_ot_per_page= $total_net_wages_without_ot_per_page +  $net_wages_after_deduction;
		$grand_total_net_wages_without_ot 	= $grand_total_net_wages_without_ot +  $net_wages_after_deduction;
		
		//$total_stamp_deduction_per_page = $total_stamp_deduction_per_page + $stam_value;
		//$grand_total_stamp_deduction 	= $grand_total_stamp_deduction + $stam_value;
		
		$others_deduct = $others_deduct + $value[$k]->others_deduct; 
		//echo "</td>";
			
		echo "<td style='font-weight:bold;'>";
		echo $net_wages_after_deduction;
		echo "</td>";
		
		$total_net_wages_after_deduction = $total_net_wages_after_deduction + $net_wages_after_deduction;
		$grand_total_net_wages_after_deduction = $grand_total_net_wages_after_deduction + $net_wages_after_deduction;
				
		echo "<td>";
		//print_r ($value[$k]->ot_hour);
		//echo '<br>+';
		//echo '<br>';
		//echo $value[$k]->eot_hour;
		//echo '<br>=';
		//echo '<br>';
		$ot_hour = $value[$k]->ot_hour;// ktu$weekend_manu['total_weekend_ot_hour']; +  $value[$k]->eot_hour; 
		echo $ot_hour;
		echo "</td>";
		
		$total_ot_hour_per_page = $total_ot_hour_per_page + $ot_hour; 
		$grand_total_ot_hour = $grand_total_ot_hour + $ot_hour; 
		
		echo "<td>";
		print_r ($value[$k]->ot_rate);
		//echo "o_r".$row->ot_rate;
		$ot_rate = $ot_rate + $value[$k]->ot_rate; 
		echo "</td>";
		
		$ot_amount = round($ot_hour * $value[$k]->ot_rate);
				
		echo "<td>";
		echo $ot_amount;
		echo "</td>";
		
		$total_ot_amount_per_page = $total_ot_amount_per_page + $ot_amount;
		$grand_total_ot_amount = $grand_total_ot_amount + $ot_amount;
		
		$ot_amount_only = $ot_amount;
		$net_wages_with_ot = $net_wages_after_deduction + $ot_amount_only;
				
					
		echo "<td style='font-weight:bold;'>";
		echo $net_wages_with_ot;
		echo "</td>";
		
		$total_net_wages_with_ot = $total_net_wages_with_ot + $net_wages_with_ot;
		$grand_total_net_wages_with_ot = $grand_total_net_wages_with_ot + $net_wages_with_ot;
		
		
			
		echo "<td>";
		echo "&nbsp;";
		echo "</td>";
			
		echo "</tr>"; 
		$k++;
	}
	?>
	<tr>
		<td align="center" colspan="12"><strong>Total Per Page</strong></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_gross_sal_per_page);?></strong></td>
        <td colspan="11"></td>
		<td align="right"><strong><?php echo $english_format_number = number_format($total_att_bonus);?></strong></td>
        <td align="right" ><strong><?php echo $english_format_number = number_format($total_advance_per_page);?></strong></td>
		<?php if($deduct_status == "Yes"){?>
		<td align="center"><strong><?php echo $english_format_number = number_format($lunch_deduction_hour_per_page);?></strong></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($lunch_deduction_amount_per_page);?></strong></td>
        <?php }?>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_absent_deduction_per_page);?></strong></td>
        <!--<td align="right"><strong><?php echo $english_format_number = number_format($total_stamp_deduction_per_page);?></strong></td>-->
		 <td align="right"><strong><?php echo $english_format_number = number_format($total_net_wages_after_deduction);?></strong></td>
        <td align="center"><strong><?php echo $english_format_number = number_format($total_ot_hour_per_page);?></strong></td>
        <td align="right" colspan="1"></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_ot_amount_per_page);?></strong></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_net_wages_with_ot);?></strong></td>
		
	</tr>
	<?php
	if($counter == $page)
   		{?>
			<tr height="10">
			<td colspan="12" align="center"><strong>Grand Total Amount Tk</strong></td>
            <td align="right"><strong><?php echo $english_format_number = number_format($gross_sal);?></strong></td>
            <td colspan="11"></td>
            <td align="right" ><strong><?php echo $english_format_number = number_format($grand_total_att_bonus);?></strong></td>
            <td align="right" ><strong><?php echo $english_format_number = number_format($grand_total_advance_salary);?></strong></td>
            <?php if($deduct_status == "Yes"){?>
			<td align="center" ><strong><?php echo $english_format_number = number_format($grand_total_lunch_deduction_hour);?></strong></td>
            <td align="right" ><strong><?php echo $english_format_number = number_format($grand_total_lunch_deduction_amount);?></strong></td>
			 <?php }?>
            <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_absent_deduction);?></strong></td>
            <!--<td align="right"><strong><?php echo $english_format_number = number_format($grand_total_stamp_deduction);?></strong></td>-->
            <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_net_wages_after_deduction);?></strong></td>
            <td align="center"><strong><?php echo $english_format_number = number_format($grand_total_ot_hour);?></strong></td>
            <td colspan="1"></td>
            <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_ot_amount);?></strong></td>
            <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_net_wages_with_ot);?></strong></td>
			
			</tr>
			<?php } ?>
			
			<table width="100%" height="80px" border="0" align="center" style="margin-bottom:75px; font-family:Arial, Helvetica, sans-serif;">
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
			
			</table>
			</table>
			  
			<?php

		}

?>
</table>

</body>
</html>