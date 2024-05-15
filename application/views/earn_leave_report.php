<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>MSHL||Earn Leave</title>
<link rel="stylesheet" type="text/css" href="../../../../../css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />

</head>

<body>

<div style=" margin:0 auto;  width:800px;">
<?php 
$this->load->view("head_english"); 
?>
<!--Report title goes here-->
<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;"><span style="font-size:12px; font-weight:bold;">
Earn Leave Payment Sheet <?php echo date('F-Y',strtotime($salary_month)); ?></span>
<br />
<br />
<?php
	if ($value=="Requested list is empty!") {
		exit($value);
	}
?>

<table class="sal" border="1" cellpadding="0" cellspacing="0" align="center" style="font-size:12px;">
	<tr>
		<th> SL </th>
		<th> Card No. </th> 
		<th width="110px;">Name </th>
		<th> Designation </th> 
		<th> Section </th> 
		<th> Line </th> 
		<th width="110px;"> Join Date </th> 
		<th> Gross Salary </th> 
		<th> Total Days </th> 
		<th> Working Days </th> 
		<th> Present Days </th> 
		<th> Enjoy EL. </th> 
		<th> Leave </th>
		<th> Absent </th>
		<th> Net Earn Leave </th> 
		<th> Net Pay Amount </th> 
		<th> Signature </th> 
	</tr>
<?php
	$total_net_pay = 0;
	$k=0;
	foreach ($value as $row) {
	echo "<tr style='height: 50px;'>";
	echo "<td>". $k = $k+1 ."</td>";
	
	echo "<td style='text-align:center'>";
	echo $row["emp_id"];
	echo "</td>";
	
	echo "<td style='text-align:center'>";
	echo $row["emp_full_name"];
	echo "</td>";
	
	echo "<td style='text-align:center'>";
	echo $row["desig_name"];
	echo "</td>";
	
	echo "<td style='text-align:center'>";
	echo $row["sec_name"];
	echo "</td>";
	
	echo "<td style='text-align:center'>";
	echo $row["line_name"];
	echo "</td>";
	
	echo "<td style='text-align:center'>";
	echo date("d-M-y",strtotime($row["jod"]));
	echo "</td>";
	
	echo "<td style='text-align:center'>";
	echo $row["gross_sal"];
	echo "</td>";
	
	echo "<td style='text-align:center'>";
	echo $row["t_days"];
	echo "</td>";
	
	echo "<td style='text-align:center'>";
	echo $row["w_days"];
	echo "</td>";
	
	echo "<td style='text-align:center'>";
	echo $row["P"];
	echo "</td>";
	
	echo "<td style='text-align:center'>";
	echo $row["el"];
	echo "</td>";
	
	echo "<td style='text-align:center'>";
	$tleave = $row["cl"] + $row["sl"] + $row["ml"];
	echo $tleave;
	echo "</td>";
	
	echo "<td style='text-align:center'>";
	echo $row["A"];
	echo "</td>";
	
	echo "<td style='text-align:center'>";
	echo $row["earn_leave"];
	echo "</td>";
	
	echo "<td style='text-align:center'>";
	echo round($row["net_pay"]);
	echo "</td>";
	
	echo "<td >";
	echo "&nbsp;";
	echo "</td>";
	
	echo "</tr>";

	$total_net_pay = $total_net_pay + round($row["net_pay"]);
}
?>

<tr>
	<td  colspan="15" style="text-align:center; font-weight:bold;" > Total Net Pay</td>
	<td style="text-align:right; font-weight:bold;" ><?php echo number_format($total_net_pay); ?>/=</td>
	<td> </td>
</tr>
</table>
</div>
</div>
</body>
</html>
