<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>New Join Report</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />

</head>

<body>
<div style="margin:0 auto;">
<?php 
$this->load->view("head_english"); 
?>
<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;"><span style="font-size:13px; font-weight:bold;">
New Employee Join Report from 
<?php 
	$year= trim(substr($start_date,0,4));
	$month = trim(substr($start_date,5,2));
	$tarik = trim(substr($start_date,8,2));
	$date_format = date("d-M-Y", mktime(0, 0, 0, $month, $tarik, $year));
	echo $date_format;
	
	echo " - TO - ";
	
	$year= trim(substr($end_date,0,4));
	$month = trim(substr($end_date,5,2));
	$tarik = trim(substr($end_date,8,2));
	$date_format = date("d-M-Y", mktime(0, 0, 0, $month, $tarik, $year));
	echo $date_format;
	
?></span>
<br />
<br />
<table class="sal" border="1" cellpadding="0" cellspacing="0" align="center" style="font-size:13px;">
<th>SL</th><th>Emp ID</th><th>Name</th><th>Punch Card No.</th>  <th>Department</th> <th>Section</th> <th>Line</th> <th>Designation</th> <th>S.Grade</th><th>Gross Salary</th><th>DOJ</th><th>Birth Day</th>

<?php
$count = count($values["emp_id"]);
for($i=0; $i<$count; $i++ )
{
	echo "<tr>";
	
	echo "<td>";
	echo $k = $i+1;
	echo "</td>";
	
	echo "<td>";
	echo $values["emp_id"][$i];
	echo "</td>";
	
	echo "<td >";
	echo $values["emp_name"][$i];
	echo "</td>";
	
	echo "<td>";
	echo "&nbsp;";
	echo $values["proxi_id"][$i];
	echo "</td>";
	
	
	
	echo "<td >";
	echo $values["dept_name"][$i];
	echo "</td>";
	
	echo "<td >";
	echo $values["sec_name"][$i];
	echo "</td>";
	
	echo "<td >";
	echo $values["line_name"][$i];
	echo "</td>";
	
	echo "<td >";
	echo $values["desig_name"][$i];
	echo "</td>";
	
	echo "<td style='text-align:center'>";
	$grade = $values["emp_sal_gra_id"][$i];
	echo $grade_name = $this->db->select('gr_name')->where('gr_id', $grade)->get('pr_grade')->row()->gr_name;
	echo "</td>";
	
	echo "<td style='text-align:right;'>";
	echo number_format($values["gross_sal"][$i]);
	echo "</td>";
	
	echo "<td  style='text-align:center; width:70px;'>";
	$year= trim(substr($values["doj"][$i],0,4));
	$month = trim(substr($values["doj"][$i],5,2));
	$tarik = trim(substr($values["doj"][$i],8,2));
	$date_format = date("d-M-y", mktime(0, 0, 0, $month, $tarik, $year));
	echo $date_format;
	echo "</td>";
	
	echo "<td   style='text-align:center; width:70px;'>";
	$year= trim(substr($values["emp_dob"][$i],0,4));
	$month = trim(substr($values["emp_dob"][$i],5,2));
	$tarik = trim(substr($values["emp_dob"][$i],8,2));
	$date_format = date("d-M-y", mktime(0, 0, 0, $month, $tarik, $year));
	echo $date_format;
	echo "</td>";

	echo "</tr>";
}

?>

</table>
</div>
</div>
</body>
</html>
