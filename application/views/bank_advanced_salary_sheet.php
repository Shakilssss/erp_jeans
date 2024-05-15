<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Advance Salary Sheet</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />


</head>

<body>
<table height="auto"  class="sal" border="1" cellspacing="0" cellpadding="0" style="font-size:13px; width:100%;">

<tr height="85px">
<td colspan="22" align="center">

<div style="text-align:right; position:relative; top:20px; padding-left:10px; font-weight:bold;">
<?php 
$date = date('d-m-Y');
	$line_name = $this->db->where("line_id",$grid_line)->get('pr_line_num')->row();
if (!empty($line_name)) {
	echo "Line Name: ".$line_name->line_name;
}

// echo "Page No # $counter of $page";
if($grid_section != "Select")
{
	$sec_name = $this->db->where("sec_id",$grid_section)->get('pr_section')->row();
	if (!empty($sec_name)) {
		echo "<span style='float: left;'>SECTION:  $sec_name->sec_name</span>";
	}
}
//echo "Payment Date : $date"; ?>
</div>
 
<?php $this->load->view("head_english"); ?>
<?php if($grid_status == 4){ echo 'Resign '; }?>Advance Salary Sheet of 
<?php 

$sstartDate = date("d-M-Y", strtotime($salary_date1));
$sEndDate = date("d-M-Y", strtotime($salary_date2));
echo "&nbsp;$sstartDate To $sEndDate";//$date_format;
$sEndDate = date("d-M-Y", strtotime($salary_date2));
//MANUALLY DEFINE SALARY DAYS
$start = strtotime($salary_date1);
$end = strtotime($salary_date2);

$total_days = (ceil(abs($end - $start) / 86400)+1);

//$total_days = (strtotime($end) - strtotime($start)) / (60 * 60 * 24);
//$payable_salary_days = 15;



?>

</td>


  <tr height="20px">
    <td  width="25" ><div align="center"><strong>SI. No</strong></div></td>
	<td width="80" ><div align="center"><strong>Card No</strong></div></td>
    <td width="240" ><div align="center"><strong>Name of Employee</strong></div></td>
	<td width="120" ><div align="center"><strong>Line</strong></div></td>
    <td width="120" ><div align="center"><strong>Designation</strong></div></td>
    <td width="100" ><div align="center"><strong>Joining Date</strong></div></td>
    <td width="80" ><div align="center"><strong>Account</strong></div></td>
    <td width="60" ><div align="center"><strong>Pay Amount</strong></div></td>
	<td width="200"><div align="center"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></div></td>
  </tr>
  
<?php
			
	// if($counter == $page)
 //  	{
 //   		$modulus = ($row_count-1) % 7;
 //    	$per_page_row=$modulus;
	// }
 //   	else
 //   	{
 //    	$per_page_row=6;
 //   	}
  	
 //   	$total_advance_salary = 0;
	// $total_ot_amount = 0;
	$k=1;	
	foreach($value as $row)
	{
		$start = strtotime($salary_date1);
		$end = strtotime($salary_date2);
		$total_days = (ceil(abs($end - $start) / 86400)+1);

		echo "<tr height='70' style='text-align:center;' >";
		echo "<td >";
		echo $k++;
		echo "</td>";

		echo "<td>";
		$emp_id = $row->emp_id;
		print_r($row->emp_id);
		//echo $row->emp_id;
		echo "</td>";
		
		
		echo "<td style='width:100px;'>";
		print_r($row->emp_full_name);
		echo '<br>';
		if($grid_status == 4)
		{
			$resign_date = $this->grid_model->get_resign_date_by_empid($row->emp_id);
			if($resign_date != false){
				echo date('d-M-y', strtotime($resign_date));

				if (strtotime($resign_date) < strtotime($salary_date2)) {
					$start = strtotime($resign_date);
					$end = strtotime($salary_date2);
					$left_day = (ceil(abs($end - $start) / 86400)+1);
					$total_days = $total_days - $left_day;
				}
			}
		}

		if($grid_status == 3)
		{
			$left_check = $this->grid_model->get_left_date_by_empid($row->emp_id);
			if($left_check != false){
				echo date('d-M-y', strtotime($left_check));

				if (strtotime($left_check) < strtotime($salary_date2)) {
					$start = strtotime($left_check);
					$end = strtotime($salary_date2);
					$left_day = (ceil(abs($end - $start) / 86400)+1);
					$total_days = $total_days - $left_day;
				}
			}
		}
		echo "</td>"; 
		
				

		
		
		
		//Calaculate payable Days
		//echo $total_days;
		$attend = "P";
		$attend = $this->salary_process_model->attendance_check($emp_id,$attend,$total_days, $salary_date1);
		
		$absent = "A";
		$absent = $this->salary_process_model->attendance_check($emp_id,$absent,$total_days, $salary_date1);
		
		$weeked = "W";
		$weeked = $this->salary_process_model->attendance_check($emp_id,$weeked,$total_days, $salary_date1);
		
		$holiday = "H";
		$holiday = $this->salary_process_model->attendance_check($emp_id,$holiday,$total_days, $salary_date1);
		$total_holiday = $weeked + $holiday;
		$holiday_or_weeked = $total_holiday;
				
		$leave = "L";
		$total_leave = $this->salary_process_model->attendance_check($emp_id,$leave,$total_days, $salary_date1);
		
		$payable_salary_days = $attend + $total_holiday + $total_leave;
				
		echo "<td>";
		print_r($row->line_name);
		//echo $row->desig_name;
		echo "</td>";
		
		echo "<td>";
		print_r($row->desig_name);
		//echo $row->desig_name;
		echo "</td>";
				
				
		echo "<td>";
		$date = $row->emp_join_date;
		//print_r($row->emp_join_date);
		$year=trim(substr($date,0,4));
		$month=trim(substr($date,5,2));
		$day=trim(substr($date,8,2));
		$date_format = date("d-M-y", mktime(0, 0, 0, $month, $day, $year));
		echo $date_format;
		echo "</td>";

		echo "<td>";
		print_r ($row->mobile);
		echo "</td>";

		
		echo "<td>";
		$gross_sal = $row->gross_sal;
		$last_day=30;
		$payable_amount = round(($gross_sal / $last_day * $payable_salary_days));
		echo $amount = floor($payable_amount/100)*100;
		echo "</td>";
		$net_pay = floor($amount/100)*100;
		@$grnd_total_advance_salary= @$grnd_total_advance_salary +$net_pay;
		
		

	
		echo "<td>";
		echo "&nbsp;";
		echo "</td>";
		echo "</tr>"; 
		
	}
	?>

	<?php
	// if($counter == $page)
   		{?>
			<tr height="10">
            <td colspan="7" align="center">
			<strong>Grand Total Amount Tk</strong></td>
			<td align="right">
			   <strong><?php echo $grnd_total_advance_salary = number_format($grnd_total_advance_salary);?></strong>
		    </td>
			</tr>
			<?php } ?>
			
			<table width="100%" height="80px" border="0" align="center" style="margin-bottom:85px; font-family:Arial, Helvetica, sans-serif;">
			<tr height="80%" >
			<td colspan="9"></td>
			</tr>
			<tr height="20%">
			<td  align="center">Prepared By (HRM Dept.)</td>
			<td align="center">Checked BY (Account Dept.)</td>
			<td  align="center">Auditor</td>
			<td  align="center">GM (Production) </td>
			<td  align="center">Manager(Admin & HRM)</td>
			<td  align="center">Authorized By</td>
			</tr>
			
			</table>
			</table>
			  
			<?php

		

?>
</table>

</body>
</html>