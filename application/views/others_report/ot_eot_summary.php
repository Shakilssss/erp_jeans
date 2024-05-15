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
<th>SL</th><th><?php echo $category; ?> Name</th><th>Total Employee</th><th>OT MP</th><th>Total OT Hour</th><th>EOT MP</th><th>Total EOT Hour</th>
<?php
$all_emp 	 = 0;
$tot_mp = 0;
$teot_mp = 0;
$ot_hour = 0;
$all_absent  = 0;
$extra_ot_hour   = 0;
$all_late    = 0;
$count = count($values);
// exit($count . 'ali');
for($i=0; $i<$count; $i++ )
{
	echo "<tr>";
	
	echo "<td>";
	echo $k = $i+1;
	echo "</td>";
	
	echo "<td>";
	echo $values[$i]["line_name"];
	echo "</td>";
	
	echo "<td style='text-align:center;'>";
	if($values[$i]["daily_ot_eot"][0]["totalemp"]){
	echo $values[$i]['daily_ot_eot'][0]["totalemp"];
	$all_emp = $all_emp + $values[$i]["daily_ot_eot"][0]['totalemp'];
	}else{
	echo '--';}
	echo "</td>";
	
	echo "<td style='text-align:center;'>";
		// print_r($ot_mp);exit;
	if($ot_mp[$i]["ot_mp"][0]["ot_mp"]){
	echo $ot_mp[$i]['ot_mp'][0]["ot_mp"];
	$tot_mp = $tot_mp + $ot_mp[$i]["ot_mp"][0]['ot_mp'];
	}else{
	echo '--';}
	echo "</td>";
	
	
	echo "<td style='text-align:center;'>";
	if($values[$i]["daily_ot_eot"][0]["ot_hour"]){
	echo $values[$i]['daily_ot_eot'][0]["ot_hour"];
	$ot_hour = $ot_hour + $values[$i]["daily_ot_eot"][0]['ot_hour'];
	}else{
	echo '--';}
	echo "</td>";
	
	
	echo "<td style='text-align:center;'>";
	if($eot_mp[$i]["eot_mp"][0]["eot_mp"]){
	echo $eot_mp[$i]['eot_mp'][0]["eot_mp"];
	$teot_mp = $teot_mp + $eot_mp[$i]["eot_mp"][0]['eot_mp'];
	}else{
	echo '--';}
	echo "</td>";
	
	
	
	echo "<td style='text-align:center;'>";
	if($values[$i]["daily_ot_eot"][0]['extra_ot_hour']){
	echo $values[$i]['daily_ot_eot'][0]['extra_ot_hour'];
	$extra_ot_hour = $extra_ot_hour + $values[$i]["daily_ot_eot"][0]['extra_ot_hour'];
	}else{
	echo '--';}
	echo "</td>";
	
	echo "</tr>";
}
?>
<tr style="font-weight:bold; text-align:center;">
<td colspan="2">Total</td>
<td><?php echo $all_emp; ?></td>
<td><?php echo $tot_mp; ?></td>
<td><?php echo $ot_hour; ?></td>
<td><?php echo $teot_mp; ?></td>
<td><?php echo $extra_ot_hour; ?></td>

</table>
</div>
</div>
</body>
</html>
