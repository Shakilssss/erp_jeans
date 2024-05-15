<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Advance Salary Sheet</title>
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

			
			$grnd_total_advance_salary = 0;
			$grand_total_ot_amount = 0;
			?>
			<table>
			
			<?php
for ( $counter = 1; $counter <= $page; $counter ++)
{
?>

<table height="auto"  class="sal" border="1" cellspacing="0" cellpadding="0" style="font-size:13px; width:100%;">

<tr height="85px">
<td colspan="22" align="center">

<div style="text-align:right; position:relative; top:20px; padding-left:10px; font-weight:bold;">
<?php 
$date = date('d-m-Y');
	$line_name = $this->db->where("line_id",$grid_line)->get('pr_line_num')->row();
if (!empty($line_name)) {
	echo "Line Name: ".$line_name->line_name.", ";
}

echo "Page No # $counter of $page";
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
</tr>


  <tr height="20px">
    <td width="15" height="20px" rowspan="2"><div align="center"><strong>SI. No</strong></div></td>
    <td width="30" height="20px" rowspan="2"><div align="center"><strong>Name of Employee</strong></div></td>
	<td width="14" height="20px" rowspan="2"><div align="center"><strong>Card No</strong></div></td>
    <td width="25" height="20px" rowspan="2"><div align="center"><strong>Designation</strong></div></td>
	<td width="80" height="20px" rowspan="2"><div align="center"><strong>Section</strong></div></td>
    <td width="25" height="20px" rowspan="2"><div align="center"><strong>Joining Date</strong></div></td>
	<td width="25" height="20px" rowspan="2"><div align="center"><strong>Grade</strong></div></td>
    <td width="35" height="20px" rowspan="2"><div align="center"><strong>Basic Salary</strong></div></td>
    <td width="35" height="20px" rowspan="2"><div align="center"><strong>House Rent</strong></div></td>
    <td width="35" height="20px" rowspan="2"><div align="center"><strong>Medical</strong></div></td>
    <td width="45" height="20px" rowspan="2"><div align="center"><strong>Gross Salary</strong></div></td>
    
    <td width="45"  colspan="4"><div align="center"><strong>Present Status</strong></div></td>
    
    <td width="45" height="20px" rowspan="2"><div align="center"><strong>Pay Days</strong></div></td>
    <td width="35" height="20px" rowspan="2"><div align="center"><strong><?php echo $total_days; ?> Days Salary Payable Amount</strong></div></td>
    <!--<td width="35" height="20px" rowspan="2"><div align="center"><strong>OT Rate</strong></div></td>
    <td width="35" height="20px" rowspan="2"><div align="center"><strong>OT Hour</strong></div></td>
    <td width="35" height="20px" rowspan="2"><div align="center"><strong>OT Amount</strong></div></td> -->
    <td width="22" height="20px" rowspan="2"><div align="center"><strong>Net Payable</strong></div></td>
	<td width="180" rowspan="2"><div align="center"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></div></td>
  </tr>
  <tr>
  <td width="20"><div align="center"><strong>Pre.</strong></div></td>
  <td width="20"><div align="center"><strong>Abs.</strong></div></td>
  <td width="20"><div align="center"><strong>H.day</strong></div></td>
  <td width="20"><div align="center"><strong>Leave</strong></div></td>
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
  	
   	$total_advance_salary = 0;
	$total_ot_amount = 0;
		
	for($p=0; $p<=$per_page_row;$p++)
	{
		$start = strtotime($salary_date1);
		$end = strtotime($salary_date2);
		$total_days = (ceil(abs($end - $start) / 86400)+1);

		echo "<tr height='70' style='text-align:center;' >";
		echo "<td >";
		echo $k+1;
		echo "</td>";
		
		echo "<td style='width:100px;'>";
		print_r($value[$k]->emp_full_name);
		echo '<br>';
		if($grid_status == 4)
		{
			$resign_date = $this->grid_model->get_resign_date_by_empid($value[$k]->emp_id);
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
			$left_check = $this->grid_model->get_left_date_by_empid($value[$k]->emp_id);
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
		
				
		echo "<td>";
		$emp_id = $value[$k]->emp_id;
		print_r($value[$k]->emp_id);
		//echo $row->emp_id;
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
		print_r($value[$k]->desig_name);
		//echo $row->desig_name;
		echo "</td>";
		
		echo "<td>";
		print_r($value[$k]->sec_name);
		//echo $row->desig_name;
		echo "</td>";
				
				
		echo "<td>";
		$date = $value[$k]->emp_join_date;
		//print_r($value[$k]->emp_join_date);
		$year=trim(substr($date,0,4));
		$month=trim(substr($date,5,2));
		$day=trim(substr($date,8,2));
		$date_format = date("d-M-y", mktime(0, 0, 0, $month, $day, $year));
		echo $date_format;
		echo "</td>";
			
		echo "<td>";
		print_r ($value[$k]->gr_name);
		echo "</td>";
		
		$salary_structure = $this->common_model->salary_structure($value[$k]->gross_sal);
		
		echo "<td>";
		echo $basic_sal = $salary_structure['basic_sal'];
		echo "</td>";
		
		echo "<td>";
		echo $house_rent = $salary_structure['house_rent'];
		echo "</td>";
		
		echo "<td>";
		echo $medical_allow = $salary_structure['medical_allow'];
		echo "</td>";
			
		echo "<td>";
		print_r ($value[$k]->gross_sal);
		$gross_sal = $value[$k]->gross_sal;
		echo "</td>";
		
		
		echo "<td>";
		echo $attend;
		echo "</td>";
		
		echo "<td>";
		echo $absent;
		echo "</td>";
		
		echo "<td>";
		echo $total_holiday;
		echo "</td>";
		
		echo "<td>";
		echo $total_leave;
		echo "</td>";
		
		echo "<td>";
		echo $payable_salary_days;
		echo "</td>";
			
		echo "<td>";
		// $last_day = date("t", strtotime($salary_date1));
		$last_day = 30;
		echo $payable_amount = round(($gross_sal / $last_day * $payable_salary_days));
		echo "</td>";
		
		// $ot_title =$this->common_model->get_ot_title($value[$k]->emp_id);//1=stuff
			
		// echo "<td>";
		// if($ot_title=="1") 
		// echo $ot_rate = 0; 
		// else 
		// echo $ot_rate = $salary_structure['ot_rate'];
		// echo "</td>";
				 
		//CREATE START DATE AND END DATE FOR OT AND EOT HOUR
		//$year = date('Y',strtotime($salary_month));
		//$month = date('m',strtotime($salary_month));
		
		// $start_date = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
		// $end_date = date("Y-m-d", mktime(0, 0, 0, $month, $total_days, $year));
		
		
		// echo "<td>";
		// if($ot_title=="1") {$ot_hour = 0;}
		// else {
		// 	// $ot_hour = 0;
		// 	$ot_hour = $this->salary_process_model->ot_hour_between_date($emp_id, $salary_date1, $salary_date2);
		// }
		// // echo 0;
		// echo $ot_hour;
		// echo "</td>";
		
				
		// echo "<td>";
		// $ot_amount = round(($ot_hour  * $ot_rate),2);
  //       $ot_amount = round($ot_amount);
		// echo $ot_amount;
		// // echo 0;
		// $total_ot_amount = $total_ot_amount + $ot_amount;
		// $grand_total_ot_amount = $grand_total_ot_amount + $ot_amount;
		// echo "</td>";
		
		echo "<td>";
		$payable_amount  = $payable_amount;
		echo $net_pay = floor($payable_amount/100)*100;
		$total_advance_salary = $total_advance_salary + $net_pay;
		$grnd_total_advance_salary = $grnd_total_advance_salary + $net_pay;
		echo "</td>";


		// echo "<td>";
		// $payable_amount  = $payable_amount + $ot_amount;
		// echo $net_pay = floor($payable_amount/100)*100;
		// $total_advance_salary = $total_advance_salary + $net_pay;
		// $grnd_total_advance_salary = $grnd_total_advance_salary + $net_pay;
		// echo "</td>";		
						
		echo "<td>";
		echo "&nbsp;";
		echo "</td>";
			
		echo "</tr>"; 
		$k++;
		
		//ADVANCE LOAN ENTRY TO THE DATABASE
		$emp_ids = ['CU0178', 'FI0512', 'FI0576', 'FI0604', 'FI0627', 'FI0629', 
					'FI0631', 'FI0634', 'PS0717','QC0351','QC0407',
					'FI0640', 'FI0643', 'IR0184', 'PS0657', 'PS0698', 'PS0715', 
					'QC0436', 'SO2089', 'SO2206', 'SO2341', 'SO2408', 'SO2466', 
					'SO2559', 'SO2663','SO2694','SO2831', 'SO2865','SO2878',  
					'SO2713', 'SO2742', 'SO2755', 'SO2764', 'SO2800', 'SO2825', 
					'SO2923', 'SO2927', 'SO2930', 'SO2937', 'SO2954', 'PS0557', 
					'QC0356', 'SH1475','SO2967','TP0024'];
					
		if(in_array($emp_id, $emp_ids)){
			continue;
		}else{

		$data = array(
					'emp_id' 		=> $emp_id,
					'loan_amt'		=> $net_pay,
					'pay_amt'		=> $net_pay,
					'loan_date'		=> $salary_date1,
					'loan_status'	=> 1
					);
		
		$query = $this->db->where('emp_id', $emp_id)
						->where('loan_date', $salary_date1)
						->where('loan_status', 1)->get('pr_advance_loan');
						
		if($query->num_rows() > 0 ){
			$this->db->where('emp_id', $emp_id);
			$this->db->where('loan_date', $salary_date1);
			$this->db->where('loan_status', 1);
			$this->db->update('pr_advance_loan', $data);
		}else{
			$this->db->insert('pr_advance_loan', $data);
		}
	}}
	?>
	<tr>
		<td align="center" colspan="17"><strong>Total Per Page</strong></td>
        <!-- <td align="right"><strong><?php echo $total_ot_amount = number_format($total_ot_amount);?></strong></td> -->
		<td align="right"><strong><?php echo $total_advance_salary = number_format($total_advance_salary);?></strong></td>
	</tr>
	<?php
	if($counter == $page)
   		{?>
			<tr height="10">
            <td colspan="17" align="center">
			<strong>Grand Total Amount Tk</strong></td>
            <!-- <td align="right"><strong><?php echo $grand_total_ot_amount = number_format($grand_total_ot_amount);?></strong></td> -->
			<td align="right"><strong><?php echo $grnd_total_advance_salary = number_format($grnd_total_advance_salary);?></strong></td>
			
			</tr>
			<?php } ?>
			
			<table width="100%" height="80px" border="0" align="center" style="margin-bottom:85px; font-family:Arial, Helvetica, sans-serif;">
			<tr height="80%" >
			<td colspan="28"></td>
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

		}

?>
</table>

</body>
</html>