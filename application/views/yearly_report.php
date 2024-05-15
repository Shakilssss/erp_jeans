<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Continuous <?php echo $status; ?> Report</title>
<link rel="stylesheet" type="text/css" href="../../../../../../css/SingleRow.css" />
</head>

<body>
<div style="margin:0 auto; width:800px;">
<?php 
$this->load->view("head_english"); 
?>
<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;"><span style="font-size:13px; font-weight:bold;">
<!-- <?php echo $status; ?> Report from  -->
</span>
<br />
<br />
<table class="sal" border="1" cellpadding="0" cellspacing="0" align="center" style="font-size:13px;">
<th>SL</th><th>Emp ID</th><th>Proxi ID</th><th>Name</th><th>From</th><th>To</th><th>Dept.</th><th>Section</th><th>Line</th><th>Designation</th><th>Total <?php echo $status; ?></th>
<?php
//print_r($values);

//echo $values["result"][0]["empid"][0];

foreach ($values as $key => $value) {
		// code...
	

	echo "<tr>";
	
	echo "<td>";
	echo $key+1;
	echo "</td>";
	
	echo "<td>";
	echo $value["emp_id"];
	echo "</td>";
	
	echo "<td>";
	if($value["proxi_id"] =='')
	{
		echo "&nbsp;";
	}
	else
	{
		echo $value["proxi_id"];
	}
	echo "</td>";
	
	echo "<td>";
	echo $value["emp_full_name"];
	echo "</td>";
	
	echo "<td>";
	// $date = $valueate"][$i];
	$year=trim(substr($value["start_date"],0,4));
	$month=trim(substr($value["start_date"],5,2));
	$day=trim(substr($value["start_date"],8,2));
	$date_format = date("d-M-y", mktime(0, 0, 0, $month, $day, $year));
	echo $date_format;
	echo "</td>";
	
	
	
	echo "<td>";
	// $date = $valueate"][$i];
	$year=trim(substr($value["end_date"],0,4));
	$month=trim(substr($value["end_date"],5,2));
	$day=trim(substr($value["end_date"],8,2));
	$date_format = date("d-M-y", mktime(0, 0, 0, $month, $day, $year));
	echo $date_format;
	echo "</td>";
	
	echo "<td>";
	echo $value["dept_name"];
	echo "</td>";
	
	echo "<td>";
	echo $value["sec_name"];
	echo "</td>";
	
	echo "<td>";
	echo $value["line_name"];
	echo "</td>";
	
	echo "<td>";
	echo $value["desig_name"];
	echo "</td>";
	
	echo "<td style='text-align:center; font-weight:bold;'>";
	echo $value["leave"];
	echo "</td>";
	
	echo "<tr>";
}
?>
</table>
</div>
</body>
</html>
