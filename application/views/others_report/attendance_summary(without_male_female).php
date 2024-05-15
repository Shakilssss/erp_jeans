<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><?php echo $title; ?></title>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/print.css" media="print" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/SingleRow.css" />



</head>



<body>

<?php //print_r($values); ?>

<div style=" margin:0 auto;  width:800px;">

<div id="no_print" style="float:right;">

</div>

<?php 

$this->load->view("head_english"); 

?>

<!--Report title goes here-->

<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;"><span style="font-size:13px; font-weight:bold;">

<?php echo $title; ?> of <?php echo $report_date; ?></span>

<br />

<br />





<table class="sal" border="1" cellpadding="0" cellspacing="0" align="center" style="font-size:12px;">

<tr style="font-weight:bold;text-align:center""><td rowspan="2">SL</td><td rowspan="2"><?php echo $category; ?> Name</td><td colspan="3">Total Employee</td><td rowspan="2">Attended</td> <td colspan="2">Absent</td> <td colspan="2">Leave</td> <td>Total</td><td>Total</td></tr>

<tr style="font-weight:bold; text-align:center">
<td>Male</td><td>Female</td><td>Total</td>
<td>No.</td><td>Percent (%)</td>
<td>No.</td><td>Percent (%)</td>
<td>Leave & Absent(%)</td>
<td>Present(%)</td>
</tr>

<?php

$all_emp_male 	 = 0;
$all_emp_female 	 = 0;

$all_present_male = 0;
$all_present_female = 0;
$all_present = 0;

$all_absent_male  = 0;
$all_absent_female  = 0;
$all_absent =0;

$all_leave_male   = 0;
$all_leave_female   = 0;
$all_leave =0;

$all_late_male    = 0;
$all_late_female    = 0;

$count = count($values["cat_name"]);

for($i=0; $i<$count; $i++ )

{

	echo "<tr>";

	

	echo "<td>";

	echo $k = $i+1;

	echo "</td>";

	

	echo "<td>";

	echo $values["cat_name"][$i];

	echo "</td>";

	

	echo "<td style='text-align:center;'>";

	if($values["daily_att_sum_male"][$i]){

	echo $values["daily_att_sum_male"][$i]['all_emp'];

	$all_emp_male = $all_emp_male + $values["daily_att_sum_male"][$i]['all_emp'];}

	else{

	echo '--';}

	echo "</td>";
	
	echo "<td style='text-align:center;'>";

	if($values["daily_att_sum_female"][$i]){

	echo $values["daily_att_sum_female"][$i]['all_emp'];

	$all_emp_female = $all_emp_female + $values["daily_att_sum_female"][$i]['all_emp'];}

	else{

	echo '--';}

	echo "</td>";
	
	echo "<td style='text-align:center;'>";
	$all_emp = $values["daily_att_sum_male"][$i]['all_emp'] + $values["daily_att_sum_female"][$i]['all_emp'];
	echo $all_emp;

	echo "</td>";
	

	

	echo "<td style='text-align:center;'>";
	$daily_att_sum_present = $values["daily_att_sum_male"][$i]['all_present'] +  $values["daily_att_sum_female"][$i]['all_present'];
	echo $daily_att_sum_present;
	$all_present = $all_present + $daily_att_sum_present;
	echo "</td>";
	

	echo "<td style='text-align:center;'>";
	$daily_att_sum_absent = $values["daily_att_sum_male"][$i]['all_absent'] +  $values["daily_att_sum_female"][$i]['all_absent'];
	echo $daily_att_sum_absent;
	$all_absent = $all_absent + $daily_att_sum_absent;
	echo "</td>";
	
	echo "<td style='text-align:center;'>";
	if($all_emp == 0)
	{
		$daily_att_sum_absent_percent = 0; 	
	}else
	{
		$daily_att_sum_absent_percent = round((100 * $daily_att_sum_absent)/$all_emp,2);
	}

	echo $daily_att_sum_absent_percent;
	echo "</td>";
	
	
	echo "<td style='text-align:center;'>";
	$daily_att_sum_leave = $values["daily_att_sum_male"][$i]['all_leave'] +  $values["daily_att_sum_female"][$i]['all_leave'];
	echo $daily_att_sum_leave;
	$all_leave = $all_leave + $daily_att_sum_leave;
	echo "</td>";
	
	echo "<td style='text-align:center;'>";
	if($all_emp == 0)
	{
		$daily_att_sum_leave_percent = 0; 	
	}else
	{
	$daily_att_sum_leave_percent = round((100 * $daily_att_sum_leave)/$all_emp ,2);
	}
	echo $daily_att_sum_leave_percent;
	echo "</td>";

	
	
	
	
	echo "<td style='text-align:center;'>";
	echo  $daily_att_sum_absent_percent + $daily_att_sum_leave_percent;
	echo "</td>";

	echo "<td style='text-align:center;'>";
	if($all_emp == 0)
	{
		$daily_att_sum_present_percent = 0; 	
	}else
	{
	$daily_att_sum_present_percent = round((100 * $daily_att_sum_present)/$all_emp ,2);
	}
	echo $daily_att_sum_present_percent;	echo "</td>";

	

	echo "</tr>";

}

?>

<tr style="font-weight:bold; text-align:center;">

<td colspan="2">Total</td>
<td><?php echo $all_emp_male; ?></td>

<td><?php echo $all_emp_female; ?></td>
<td><?php echo $all_emp_total = $all_emp_female + $all_emp_male; ?></td>

<td><?php echo $all_present; ?></td>

<td><?php echo $all_absent; ?></td>
<td>
<?php
if($all_absent == 0)
{
	$all_absent_total_percent = 0; 	
}
else
{
	$all_absent_total_percent = round((100 * $all_absent)/$all_emp_total,2);
}
echo $all_absent_total_percent."%";
?>
</td>

<td><?php echo $all_leave; ?></td>
<td><?php
if($all_leave == 0)
{
	$all_leave_total_percent = 0; 	
}
else
{
	$all_leave_total_percent = round((100 * $all_leave)/$all_emp_total,2);
}
echo $all_leave_total_percent."%";
?></td>
<td><?php echo $all_absent_total_percent+ $all_leave_total_percent."%";?></td>
<td>
<?php
if($all_present == 0)
{
	$all_present_total_percent = 0; 	
}
else
{
	$all_present_total_percent = round((100 * $all_present)/$all_emp_total,2);
}
echo $all_present_total_percent."%";
?>
</td>


</table>

</div>

</div>

</body>

</html>

