<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Festival Bonus</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />


</head>

<body>

<?php 
// echo "<pre>";print_r($value); exit;

$basic = 0;
$house_rent = 0;
$medical_all = 0;
$gross_sal = 0;
$abs_deduct = 0;
$payable_basic = 0;
$payable_house_rent =0;
$payable_madical_allo =0;
$pay_wages = 0;
$att_bonus =0;
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
?>
<table>
			
<table height="auto"  class="sal" border="1" cellspacing="0" cellpadding="0" style="font-size:13px; width:100%;">

<tr height="85px">
<td colspan="17" align="center">

<div style="text-align:right; position:relative; top:20px; padding-left:10px; padding-right:10px;">
<?php 
	$date = date('d-m-Y');
	$line_name = $this->db->where("line_id",$grid_line)->get('pr_line_num')->row();
	if (!empty($line_name)) {
		echo "Line Name: ".$line_name->line_name.", ";
	}
	//echo "Page No # $counter of $page";
?>
</div>
 
<?php $this->load->view("head_english"); ?>
<?php if($grid_status == 4){ echo 'Resign '; }?>Festival Bonus of 
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
   	$total_pay_wages	= 0;
	$total_ot_hours   	= 0;
	$total_ot_amount  	= 0;
	$total_att_bonus	= 0;
	$total_gross_pays	= 0;
	$total_net_pays		= 0;
	$total_festival_bonus = 0;
	$i=1;
	foreach($value as $row)
	{
		echo "<tr height='70' style='text-align:center;' >";
		echo "<td >";
		echo $i++;
		echo "</td>";

		echo "<td>";
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
			echo $resign_date = date('d-M-y', strtotime($resign_date));}
		}
		echo "</td>"; 
				

				
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
		print_r ($row->festival_bonus);
		$total_festival_bonus = $total_festival_bonus + $row->festival_bonus;
		$net_pay = $net_pay + $row->festival_bonus;
		echo "</td>";
				
		echo "<td>";
		echo "&nbsp;";
		echo "</td>";
			
		echo "</tr>"; 
		
	}
	?>
	<tr>
		<td align="center" colspan="7"><strong>Total Per Page</strong></td>
		<td align="right"><strong><?php echo $english_format_number = number_format($total_festival_bonus);?></strong></td>
	</tr>

			<tr height="10">
            <td colspan="7" align="center">
			<strong>Grand Total Amount Tk</strong></td>
			<td align="right"><strong><?php echo $english_format_number = number_format($net_pay);?></strong></td>
			
			</tr>
		
			
			<table width="100%" height="80px" border="0" align="center" style="margin-bottom:85px; font-family:Arial, Helvetica, sans-serif;">
			<tr height="80%" >
			<td colspan="8"></td>
			</tr>
			<tr height="20%">
			<td  align="center">Prepared By (HRM Dept.)</td>
			<td  align="center">Checked BY (Account Dept.)</td>
			<td  align="center">Auditor</td>
			<td  align="center">GM (Production) </td>
			<td  align="center">Manager(Admin & HRM)</td>
			<td  align="center">Authorized By</td>
			</tr>
			
			</table>
			</table>
			  

</table>

</body>
</html>