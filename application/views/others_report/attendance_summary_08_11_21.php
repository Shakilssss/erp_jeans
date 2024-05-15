<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/print.css" media="print" />

<style type="text/css">

	.sal {
    border: 2px solid #CCCCCC;
    border-collapse: collapse;
}
.sal td, .sal th {
    border: 1px solid #CCC;
}
.sal tr:nth-of-type(odd) {
    background-color: #FBFDFF;
}
.total_style
{
	background:#C1E0FF;
	
}
.total_style1
{
	background:#C1E0FF;
	width: 85px;
}
.total_style2
{
	background:white;
	width: 85px;
}

</style>
</head>

<body>
<?php //print_r($values); ?>
<div style=" margin:0 auto;  width:1800px;">
  <div id="no_print" style="float:right;"> </div>
  <?php 

$this->load->view("head_english"); 

?>
  
  <!--Report title goes here-->
  
  <div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;"><span style="font-size:13px; font-weight:bold;"> <?php echo $title; ?> of <?php echo $report_date; ?></span> <br />
    <br />
    <table class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:12px; width:99%;">
      <tr style="font-weight:bold;text-align:center; background:#C1E0FF;">
        <td rowspan="2">SL</td>
        <td rowspan="2" style="width:120px;"><?php echo $category; ?> Name</td>
        <td rowspan="2">Total Employee</td>
        <td rowspan="2">Total Present</td>
        <td rowspan="2">Total Absent</td>
        <td colspan="3">Operator</td>
        <td colspan="3">Helper</td>
        <td colspan="3">Ironman</td>
        <td colspan="3">FoldingMan</td>
        <td colspan="3">IronMan(Finishing)</td>
        <td colspan="3">Jr.Packer</td>
        <td colspan="3">PolyMan</td>
        <td colspan="3">Loader</td>
        <td colspan="3">Supervisor</td>
        <td colspan="3">Staff</td>
        <td colspan="3">QC</td>
        <td colspan="3">Cleaner</td>
      </tr>
      <tr style="font-weight:bold; text-align:center;background:#C1E0FF;">
       
        <td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Present</td>
        <td style="width:40px">Absent</td>
        
        <td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Present</td>
        <td style="width:40px">Absent</td>
        
		<td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Present</td>
        <td style="width:40px">Absent</td>
        
        <td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Present</td>
        <td style="width:40px">Absent</td>
        
        <td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Present</td>
        <td style="width:40px">Absent</td>
        
        <td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Present</td>
        <td style="width:40px">Absent</td>
        
        <td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Present</td>
        <td style="width:40px">Absent</td>
        
        <td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Present</td>
        <td style="width:40px">Absent</td>
        
        <td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Present</td>
        <td style="width:40px">Absent</td>
        
        <td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Present</td>
        <td style="width:40px">Absent</td>
        
        <td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Present</td>
        <td style="width:40px">Absent</td>
        
        <td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Present</td>
        <td style="width:40px">Absent</td>
      </tr>
      <?php

$all_emp_male 	 = 0;
$all_emp_female 	 = 0;
$all_emp_male_female 	 = 0;
$all_prev_emp_male_female 	 = 0;

$all_present_male = 0;
$all_present_female = 0;
$all_present_male_female = 0;
$all_prev_present_male_female = 0;

$all_absent_male  = 0;
$all_absent_female  = 0;
$all_absent_male_female  = 0;
$all_prev_absent_male_female  = 0;

$operator_present_male  = 0;
$operator_present_female  = 0;
$all_operator_present_male_female  = 0;


$helper_present_male  = 0;
$helper_present_female  = 0;
$all_helper_present_male_female  = 0;


$ironman_present_male  = 0;
$ironman_present_female  = 0;
$all_ironman_present_male_female  = 0;

$inputman_present_male  = 0;
$inputman_present_female  = 0;
$all_inputman_present_male_female  = 0;

$quality_present_male  = 0;
$quality_present_female  = 0;
$all_quality_present_male_female  = 0;

$packer_present_male  = 0;
$packer_present_female  = 0;
$all_packer_present_male_female  = 0;

$polyman_present_male  = 0;
$polyman_present_female  = 0;
$all_polyman_present_male_female  = 0;

$loader_present_male  = 0;
$loader_present_female  = 0;
$all_loader_present_male_female  = 0;

$driver_present_male  = 0;
$driver_present_female  = 0;
$all_driver_present_male_female  = 0;

$staff_present_male  = 0;
$staff_present_female  = 0;
$all_staff_present_male_female  = 0;

$qc_present_male  = 0;
$qc_present_female  = 0;
$all_qc_present_male_female  = 0;

$cleaner_present_male  = 0;
$cleaner_present_female  = 0;
$all_cleaner_present_male_female  = 0;

$all_line_operator_present_male_female = 0;
$total_line_operator_present_male_female = 0;

$all_line_helper_present_male_female = 0;
$total_line_helper_present_male_female = 0;

$all_line_staff_present_male_female = 0;
$total_line_staff_present_male_female = 0;

$all_line_qc_present_male_female = 0;
$total_line_qc_present_male_female = 0;

$total_line_operator_male_female = 0;
$total_line_helper_male_female = 0;
$total_line_staff_male_female = 0;
$total_line_qc_male_female = 0;

$all_operator_absent_male_female = 0;
$all_helper_absent_male_female = 0;
$all_ironman_absent_male_female = 0;
$all_inputman_absent_male_female = 0;
$all_quality_absent_male_female = 0;
$all_packer_absent_male_female = 0;
$all_polyman_absent_male_female = 0;
$all_loader_absent_male_female = 0;
$all_driver_absent_male_female = 0;
$all_staff_absent_male_female = 0;
$all_qc_absent_male_female = 0;
$all_cleaner_absent_male_female = 0;

$all_operator_male_female = 0;
$all_helper_male_female = 0;
$all_ironman_male_female = 0;
$all_inputman_male_female = 0;
$all_quality_male_female = 0;
$all_packer_male_female = 0;
$all_polyman_male_female = 0;
$all_loader_male_female = 0;
$all_driver_male_female = 0;
$all_staff_male_female = 0;
$all_qc_male_female = 0;
$all_cleaner_male_female = 0;

$count = count($values["cat_name"]);

for($i=0; $i<$count; $i++ )

{

	echo "<tr style='text-align:center;'>";

	

	echo "<td class='total_style1'>";

	echo $k = $i+1;

	echo "</td>";

	

	echo "<td align='left'>";

	echo $values["cat_name"][$i];

	echo "</td>";

	echo "<td class='total_style1'>";
	$total_male_female = $values["daily_att_sum_male"][$i]['all_emp'] + $values["daily_att_sum_female"][$i]['all_emp'];
	$total_prev_male_female = $prev_values["daily_att_sum_male"][$i]['all_emp'] + $prev_values["daily_att_sum_female"][$i]['all_emp'];
	echo $total_male_female;
	$all_emp_male_female 	 = $all_emp_male_female + $values["daily_att_sum_male"][$i]['all_emp'] + $values["daily_att_sum_female"][$i]['all_emp'];
	$all_prev_emp_male_female 	 = $all_prev_emp_male_female + $total_prev_male_female;
	echo "</td>";
	
	echo "<td class='total_style2'>";
	$total_present_male_female = $values["daily_att_sum_male"][$i]['all_present'] + $values["daily_att_sum_female"][$i]['all_present'];
	$total_prev_present_male_female = $prev_values["daily_att_sum_male"][$i]['all_present'] + $prev_values["daily_att_sum_female"][$i]['all_present'];
	echo $total_present_male_female;
	echo "</td>";
	
	$all_present_male_female 	 = $all_present_male_female + $total_present_male_female;
	$all_prev_present_male_female 	 = $all_prev_present_male_female + $total_prev_present_male_female;

	
	echo "<td class='total_style1'>";
	$total_absent_male_female = $values["daily_att_sum_male"][$i]['all_absent'] + $values["daily_att_sum_female"][$i]['all_absent'];
	$total_prev_absent_male_female = $prev_values["daily_att_sum_male"][$i]['all_absent'] + $prev_values["daily_att_sum_female"][$i]['all_absent'];
	echo $total_absent_male_female;
	echo "</td>";
	$all_absent_male_female 	 = $all_absent_male_female + $total_absent_male_female;
	$all_prev_absent_male_female 	 = $all_prev_absent_male_female + $total_prev_absent_male_female;
	
	
	//=============================OPERATOR======================
	
	echo "<td class='total_style2'>";
	$total_operator_male_female = $values["remarks_daily_att_sum_male"][0][$i]['all_present'] + $values["remarks_daily_att_sum_female"][0][$i]['all_present'] + $values["remarks_daily_att_sum_male"][0][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][0][$i]['all_absent'];
	echo $total_operator_male_female;
	echo "</td>";
	$all_operator_male_female 	 = $all_operator_male_female + $total_operator_male_female;


	echo "<td class='total_style2'>";
	$total_operator_present_male_female = $values["remarks_daily_att_sum_male"][0][$i]['all_present'] + $values["remarks_daily_att_sum_female"][0][$i]['all_present'];
	echo $total_operator_present_male_female;
	echo "</td>";
	$all_operator_present_male_female 	 = $all_operator_present_male_female + $total_operator_present_male_female;
	
	

 	if($values["cat_name"][$i] == "Line No 01" or $values["cat_name"][$i] == "Line No 02" or $values["cat_name"][$i] == "Line No 03" or $values["cat_name"][$i] == "Line No 04" or $values["cat_name"][$i] == "Line No 05" or $values["cat_name"][$i] == "Line No 06" or $values["cat_name"][$i] == "Line No 07" or $values["cat_name"][$i] == "Line No 08")
 	{
	$total_line_operator_present_male_female = $values["remarks_daily_att_sum_male"][0][$i]['all_present'] + $values["remarks_daily_att_sum_female"][0][$i]['all_present'];
	$all_line_operator_present_male_female 	 = $all_line_operator_present_male_female + $values["remarks_daily_att_sum_male"][0][$i]['all_present'] + $values["remarks_daily_att_sum_female"][0][$i]['all_present'];
	
	//$total_line_operator_male_female = $total_line_operator_male_female + $values["daily_att_sum_male"][$i]['all_emp'] + $values["daily_att_sum_female"][$i]['all_emp'];
	
	$total_line_operator_male_female = $total_line_operator_male_female + $values["remarks_daily_att_sum_male"][0][$i]['all_present'] + $values["remarks_daily_att_sum_female"][0][$i]['all_present'] + $values["remarks_daily_att_sum_male"][0][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][0][$i]['all_absent'];
	}
 
 	
	
	echo "<td class='total_style2'>";
	$total_operator_absent_male_female = $values["remarks_daily_att_sum_male"][0][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][0][$i]['all_absent'];
	echo $total_operator_absent_male_female;
	echo "</td>";
	$all_operator_absent_male_female 	 = $all_operator_absent_male_female + $total_operator_absent_male_female;
	
	//=========================END OPERATOE========================
	
	
	//=============================Helper======================
	
	echo "<td class='total_style1'>";
	$total_helper_male_female = $values["remarks_daily_att_sum_male"][1][$i]['all_present'] + $values["remarks_daily_att_sum_female"][1][$i]['all_present'] + $values["remarks_daily_att_sum_male"][1][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][1][$i]['all_absent'];
	echo $total_helper_male_female;
	echo "</td>";
	$all_helper_male_female 	 = $all_helper_male_female + $total_helper_male_female;
	

	echo "<td class='total_style1'>";
	$total_helper_present_male_female = $values["remarks_daily_att_sum_male"][1][$i]['all_present'] + $values["remarks_daily_att_sum_female"][1][$i]['all_present'];
	echo $total_helper_present_male_female;
	echo "</td>";
	$all_helper_present_male_female 	 = $all_helper_present_male_female + $total_helper_present_male_female;
	
	if($values["cat_name"][$i] == "Line No 01" or $values["cat_name"][$i] == "Line No 02" or $values["cat_name"][$i] == "Line No 03" or $values["cat_name"][$i] == "Line No 04" or $values["cat_name"][$i] == "Line No 05" or $values["cat_name"][$i] == "Line No 06" or $values["cat_name"][$i] == "Line No 07" or $values["cat_name"][$i] == "Line No 08")
 	{
	$total_line_helper_present_male_female = $values["remarks_daily_att_sum_male"][1][$i]['all_present'] + $values["remarks_daily_att_sum_female"][1][$i]['all_present'];
	$all_line_helper_present_male_female 	 = $all_line_helper_present_male_female + $values["remarks_daily_att_sum_male"][1][$i]['all_present'] + $values["remarks_daily_att_sum_female"][1][$i]['all_present'];
	
	$total_line_helper_male_female = $total_line_helper_male_female + $values["remarks_daily_att_sum_male"][1][$i]['all_present'] + $values["remarks_daily_att_sum_female"][1][$i]['all_present'] + $values["remarks_daily_att_sum_male"][1][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][1][$i]['all_absent'];
	}
	
	echo "<td class='total_style1'>";
	$total_helper_absent_male_female = $values["remarks_daily_att_sum_male"][1][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][1][$i]['all_absent'];
	echo $total_helper_absent_male_female;
	echo "</td>";
	$all_helper_absent_male_female 	 = $all_helper_absent_male_female + $total_helper_absent_male_female;
	
	//=========================END Helper========================
	
	
	//=============================Ironman======================
	
	echo "<td class='total_style2'>";
	$total_ironman_male_female = $values["remarks_daily_att_sum_male"][2][$i]['all_present'] + $values["remarks_daily_att_sum_female"][2][$i]['all_present'] + $values["remarks_daily_att_sum_male"][2][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][2][$i]['all_absent'];
	echo $total_ironman_male_female;
	echo "</td>";
	$all_ironman_male_female 	 = $all_ironman_male_female + $total_ironman_male_female;
	
	echo "<td class='total_style2'>";
	$total_ironman_present_male_female = $values["remarks_daily_att_sum_male"][2][$i]['all_present'] + $values["remarks_daily_att_sum_female"][2][$i]['all_present'];
	echo $total_ironman_present_male_female;
	echo "</td>";
	$all_ironman_present_male_female 	 = $all_ironman_present_male_female + $total_ironman_present_male_female;
	
	echo "<td class='total_style2'>";
	$total_ironman_absent_male_female = $values["remarks_daily_att_sum_male"][2][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][2][$i]['all_absent'];
	echo $total_ironman_absent_male_female;
	echo "</td>";
	$all_ironman_absent_male_female 	 = $all_ironman_absent_male_female + $total_ironman_absent_male_female;
	//=========================END Ironman========================
	
	//=============================Jr.FoldingMan======================
	
	echo "<td class='total_style1'>";
	$total_inputman_male_female = $values["remarks_daily_att_sum_male"][3][$i]['all_present'] + $values["remarks_daily_att_sum_female"][3][$i]['all_present'] + $values["remarks_daily_att_sum_male"][3][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][3][$i]['all_absent'];
	echo $total_inputman_male_female;
	echo "</td>";
	$all_inputman_male_female 	 = $all_inputman_male_female + $total_present_male_female;
	
	
	echo "<td class='total_style1'>";
	$total_inputman_present_male_female = $values["remarks_daily_att_sum_male"][3][$i]['all_present'] + $values["remarks_daily_att_sum_female"][3][$i]['all_present'];
	echo $total_inputman_present_male_female;
	echo "</td>";
	$all_inputman_present_male_female 	 = $all_inputman_present_male_female + $total_inputman_present_male_female;
	
	echo "<td class='total_style1'>";
	$total_inputman_absent_male_female = $values["remarks_daily_att_sum_male"][3][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][3][$i]['all_absent'];
	echo $total_inputman_absent_male_female;
	echo "</td>";
	$all_inputman_absent_male_female 	 = $all_inputman_absent_male_female + $total_inputman_absent_male_female;
	
	//=========================END FoldingMan========================
	
	
	//=============================Jr.Iron======================

	echo "<td class='total_style2'>";
	$total_quality_male_female = $values["remarks_daily_att_sum_male"][4][$i]['all_present'] + $values["remarks_daily_att_sum_female"][4][$i]['all_present'] + $values["remarks_daily_att_sum_male"][4][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][4][$i]['all_absent'];
	echo $total_quality_male_female;
	echo "</td>";
	$all_quality_male_female 	 = $all_quality_male_female + $total_quality_male_female;
	
	echo "<td class='total_style2'>";
	$total_quality_present_male_female = $values["remarks_daily_att_sum_male"][4][$i]['all_present'] + $values["remarks_daily_att_sum_female"][4][$i]['all_present'];
	echo $total_quality_present_male_female;
	echo "</td>";
	$all_quality_present_male_female 	 = $all_quality_present_male_female + $total_quality_present_male_female;
	
	echo "<td class='total_style2'>";
	$total_quality_absent_male_female = $values["remarks_daily_att_sum_male"][4][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][4][$i]['all_absent'];
	echo $total_quality_absent_male_female;
	echo "</td>";
	$all_quality_absent_male_female 	 = $all_quality_absent_male_female + $total_quality_absent_male_female;
	
	//=========================END Iron========================
	
	//=============================Jr.Packer======================
	
	echo "<td class='total_style1'>";
	$total_packer_male_female = $values["remarks_daily_att_sum_male"][5][$i]['all_present'] + $values["remarks_daily_att_sum_female"][5][$i]['all_present'] + $values["remarks_daily_att_sum_male"][5][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][5][$i]['all_absent'];
	echo $total_packer_male_female;
	echo "</td>";
	$all_packer_male_female 	 = $all_packer_male_female + $total_packer_male_female;
	
	
	echo "<td class='total_style1'>";
	$total_packer_present_male_female = $values["remarks_daily_att_sum_male"][5][$i]['all_present'] + $values["remarks_daily_att_sum_female"][5][$i]['all_present'];
	echo $total_packer_present_male_female;
	echo "</td>";
	$all_packer_present_male_female 	 = $all_packer_present_male_female + $total_packer_present_male_female;
	
	
	echo "<td class='total_style1'>";
	$total_packer_absent_male_female = $values["remarks_daily_att_sum_male"][5][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][5][$i]['all_absent'];
	echo $total_packer_absent_male_female;
	echo "</td>";
	$all_packer_absent_male_female 	 = $all_packer_absent_male_female + $total_packer_absent_male_female;
	//=========================END Packer========================
	
	//=============================Polyman======================
	
	echo "<td class='total_style2'>";
	$total_polyman_male_female = $values["remarks_daily_att_sum_male"][6][$i]['all_present'] + $values["remarks_daily_att_sum_female"][6][$i]['all_present'] + $values["remarks_daily_att_sum_male"][6][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][6][$i]['all_absent'];
	echo $total_polyman_male_female;
	echo "</td>";
	$all_polyman_male_female 	 = $all_polyman_male_female + $total_polyman_male_female;
	
	echo "<td class='total_style2'>";
	$total_polyman_present_male_female = $values["remarks_daily_att_sum_male"][6][$i]['all_present'] + $values["remarks_daily_att_sum_female"][6][$i]['all_present'];
	echo $total_polyman_present_male_female;
	echo "</td>";
	$all_polyman_present_male_female 	 = $all_polyman_present_male_female + $total_polyman_present_male_female;
	
	echo "<td class='total_style2'>";
	$total_polyman_absent_male_female = $values["remarks_daily_att_sum_male"][6][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][6][$i]['all_absent'];
	echo $total_polyman_absent_male_female;
	echo "</td>";
	$all_polyman_absent_male_female 	 = $all_polyman_absent_male_female + $total_polyman_absent_male_female;
	//=========================Polyman========================
	
	//=============================Loader======================
	
	echo "<td class='total_style1'>";
	$total_loader_male_female = $values["remarks_daily_att_sum_male"][7][$i]['all_present'] + $values["remarks_daily_att_sum_female"][7][$i]['all_present'] + $values["remarks_daily_att_sum_male"][7][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][7][$i]['all_absent'];
	echo $total_loader_male_female;
	echo "</td>";
	$all_loader_male_female 	 = $all_loader_male_female + $total_loader_male_female;
	
	
	echo "<td class='total_style1'>";
	$total_loader_present_male_female = $values["remarks_daily_att_sum_male"][7][$i]['all_present'] + $values["remarks_daily_att_sum_female"][7][$i]['all_present'];
	echo $total_loader_present_male_female;
	echo "</td>";
	$all_loader_present_male_female 	 = $all_loader_present_male_female + $total_loader_present_male_female;
	
	echo "<td class='total_style1'>";
	$total_loader_absent_male_female = $values["remarks_daily_att_sum_male"][7][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][7][$i]['all_absent'];
	echo $total_loader_absent_male_female;
	echo "</td>";
	$all_loader_absent_male_female 	 = $all_loader_absent_male_female + $total_loader_absent_male_female;
	//=========================Loader========================
	
	//=============================Driver======================
	
	echo "<td class='total_style2'>";
	$total_driver_male_female = $values["remarks_daily_att_sum_male"][8][$i]['all_present'] + $values["remarks_daily_att_sum_female"][8][$i]['all_present'] + $values["remarks_daily_att_sum_male"][8][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][8][$i]['all_absent'];
	echo $total_driver_male_female;
	echo "</td>";
	$all_driver_male_female 	 = $all_driver_male_female + $total_driver_male_female;
	
	echo "<td class='total_style2'>";
	$total_driver_present_male_female = $values["remarks_daily_att_sum_male"][8][$i]['all_present'] + $values["remarks_daily_att_sum_female"][8][$i]['all_present'];
	echo $total_driver_present_male_female;
	echo "</td>";
	$all_driver_present_male_female 	 = $all_driver_present_male_female + $total_driver_present_male_female;
	
	echo "<td class='total_style2'>";
	$total_driver_absent_male_female = $values["remarks_daily_att_sum_male"][8][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][8][$i]['all_absent'];
	echo $total_driver_absent_male_female;
	echo "</td>";
	$all_driver_absent_male_female 	 = $all_driver_absent_male_female + $total_driver_absent_male_female;
	//=========================Driver========================
	
	//=============================Staff======================
	
	echo "<td class='total_style1'>";
	$total_staff_male_female = $values["remarks_daily_att_sum_male"][9][$i]['all_present'] + $values["remarks_daily_att_sum_female"][9][$i]['all_present'] + $values["remarks_daily_att_sum_male"][9][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][9][$i]['all_absent'];
	echo $total_staff_male_female;
	echo "</td>";
	$all_staff_male_female 	 = $all_staff_male_female + $total_staff_male_female;
	
	
	echo "<td class='total_style1'>";
	$total_staff_present_male_female = $values["remarks_daily_att_sum_male"][9][$i]['all_present'] + $values["remarks_daily_att_sum_female"][9][$i]['all_present'];
	echo $total_staff_present_male_female;
	echo "</td>";
	$all_staff_present_male_female 	 = $all_staff_present_male_female + $total_staff_present_male_female;
	
	echo "<td class='total_style1'>";
	$total_staff_absent_male_female = $values["remarks_daily_att_sum_male"][9][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][9][$i]['all_absent'];
	echo $total_staff_absent_male_female;
	echo "</td>";
	$all_staff_absent_male_female 	 = $all_staff_absent_male_female + $total_staff_absent_male_female;
	
	if($values["cat_name"][$i] == "Line No 01" or $values["cat_name"][$i] == "Line No 02" or $values["cat_name"][$i] == "Line No 03" or $values["cat_name"][$i] == "Line No 04" or $values["cat_name"][$i] == "Line No 05" or $values["cat_name"][$i] == "Line No 06" or $values["cat_name"][$i] == "Line No 07" or $values["cat_name"][$i] == "Line No 08")
 	{
	$total_line_staff_present_male_female = $values["remarks_daily_att_sum_male"][9][$i]['all_present'] + $values["remarks_daily_att_sum_female"][9][$i]['all_present'];
	$all_line_staff_present_male_female 	 = $all_line_staff_present_male_female + $values["remarks_daily_att_sum_male"][9][$i]['all_present'] + $values["remarks_daily_att_sum_female"][9][$i]['all_present'];
	
	$total_line_staff_male_female = $total_line_staff_male_female + $values["remarks_daily_att_sum_male"][9][$i]['all_present'] + $values["remarks_daily_att_sum_female"][9][$i]['all_present'] + $values["remarks_daily_att_sum_male"][9][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][9][$i]['all_absent'];
	}
	//=========================Staff========================
	
	//=============================QC======================
	
	echo "<td class='total_style2'>";
	$total_qc_male_female = $values["remarks_daily_att_sum_male"][10][$i]['all_present'] + $values["remarks_daily_att_sum_female"][10][$i]['all_present'] + $values["remarks_daily_att_sum_male"][10][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][10][$i]['all_absent'];
	echo $total_qc_male_female;
	echo "</td>";
	$all_qc_male_female 	 = $all_qc_male_female + $total_qc_male_female;
	
	echo "<td class='total_style2'>";
	$total_qc_present_male_female = $values["remarks_daily_att_sum_male"][10][$i]['all_present'] + $values["remarks_daily_att_sum_female"][10][$i]['all_present'];
	echo $total_qc_present_male_female;
	echo "</td>";
	$all_qc_present_male_female 	 = $all_qc_present_male_female + $total_qc_present_male_female;
	
	echo "<td class='total_style2'>";
	$total_qc_absent_male_female = $values["remarks_daily_att_sum_male"][10][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][10][$i]['all_absent'];
	echo $total_qc_absent_male_female;
	echo "</td>";
	$all_qc_absent_male_female 	 = $all_qc_absent_male_female + $total_qc_absent_male_female;
	
	if($values["cat_name"][$i] == "Line No 01" or $values["cat_name"][$i] == "Line No 02" or $values["cat_name"][$i] == "Line No 03" or $values["cat_name"][$i] == "Line No 04" or $values["cat_name"][$i] == "Line No 05" or $values["cat_name"][$i] == "Line No 06" or $values["cat_name"][$i] == "Line No 07" or $values["cat_name"][$i] == "Line No 08")
 	{
	$total_line_qc_present_male_female   = $values["remarks_daily_att_sum_male"][10][$i]['all_present'] + $values["remarks_daily_att_sum_female"][10][$i]['all_present'];
	$all_line_qc_present_male_female 	 = $all_line_qc_present_male_female + $values["remarks_daily_att_sum_male"][10][$i]['all_present'] + $values["remarks_daily_att_sum_female"][10][$i]['all_present'];
	
	$total_line_qc_male_female = $total_line_qc_male_female + $values["remarks_daily_att_sum_male"][10][$i]['all_present'] + $values["remarks_daily_att_sum_female"][10][$i]['all_present'] + $values["remarks_daily_att_sum_male"][10][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][10][$i]['all_absent'];
	}
	//=========================END QC========================
	
	//=============================Cleaner======================
	
	echo "<td class='total_style1'>";
	$total_cleaner_male_female = $values["remarks_daily_att_sum_male"][11][$i]['all_present'] + $values["remarks_daily_att_sum_female"][11][$i]['all_present'] + $values["remarks_daily_att_sum_male"][11][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][11][$i]['all_absent'];
	echo $total_cleaner_male_female;
	echo "</td>";
	$all_cleaner_male_female 	 = $all_cleaner_male_female + $total_cleaner_male_female;
	
	echo "<td class='total_style1'>";
	$total_cleaner_present_male_female = $values["remarks_daily_att_sum_male"][11][$i]['all_present'] + $values["remarks_daily_att_sum_female"][11][$i]['all_present'];
	echo $total_cleaner_present_male_female;
	echo "</td>";
	$all_cleaner_present_male_female 	 = $all_cleaner_present_male_female + $total_cleaner_present_male_female;
	
	echo "<td class='total_style1'>";
	$total_cleaner_absent_male_female = $values["remarks_daily_att_sum_male"][11][$i]['all_absent'] + $values["remarks_daily_att_sum_female"][11][$i]['all_absent'];
	echo $total_cleaner_absent_male_female;
	echo "</td>";
	$all_cleaner_absent_male_female 	 = $all_cleaner_absent_male_female + $total_cleaner_absent_male_female;
	//=========================Cleaner========================
	
	echo "</tr>";

}

?>
      <tr style="font-weight:bold; text-align:center;">
        <td colspan="2">Total</td>

        <td class="total_style"><?php echo $all_emp_male_female; ?></td>
        
        <td class="total_style2"><?php echo $all_present_male_female; ?></td>
        
        <td class="total_style"><?php echo $all_absent_male_female; ?></td>
        
        <td><?php echo $all_operator_male_female; ?></td>
        <td class="total_style2"><?php echo $all_operator_present_male_female; ?></td>
        <td><?php echo $all_operator_absent_male_female; ?></td>
        
        <td class="total_style"><?php echo $all_helper_male_female; ?></td>
        <td class="total_style"><?php echo $all_helper_present_male_female; ?></td>
        <td class="total_style"><?php echo $all_helper_absent_male_female; ?></td>
        
        <td><?php echo $all_ironman_male_female; ?></td>
        <td><?php echo $all_ironman_present_male_female; ?></td>
        <td class="total_style2"><?php echo $all_ironman_absent_male_female; ?></td>
        
        <td class="total_style1"><?php echo $all_inputman_present_male_female + $all_inputman_absent_male_female; ?></td>
        <td class="total_style1"><?php echo $all_inputman_present_male_female; ?></td>
        <td class="total_style"><?php echo $all_inputman_absent_male_female; ?></td>
        
        <td><?php echo $all_quality_male_female; ?></td>
        <td><?php echo $all_quality_present_male_female; ?></td>
        <td class="total_style2"><?php echo $all_quality_absent_male_female; ?></td>
        
        <td class="total_style"><?php echo $all_packer_male_female; ?></td>
        <td class="total_style"><?php echo $all_packer_present_male_female; ?></td>
        <td class="total_style"><?php echo $all_packer_absent_male_female; ?></td>
        
        <td><?php echo $all_polyman_male_female; ?></td>
        <td><?php echo $all_polyman_present_male_female; ?></td>
        <td class="total_style2"><?php echo $all_polyman_absent_male_female; ?></td>
        
        <td class="total_style"><?php echo $all_loader_male_female; ?></td>
        <td class="total_style"><?php echo $all_loader_present_male_female; ?></td>
        <td class="total_style"><?php echo $all_loader_absent_male_female; ?></td>
        
        <td><?php echo $all_driver_male_female; ?></td>
        <td><?php echo $all_driver_present_male_female; ?></td>
        <td class="total_style2"><?php echo $all_driver_absent_male_female; ?></td>
        
        <td class="total_style"><?php echo $all_staff_male_female; ?></td>
        <td class="total_style"><?php echo $all_staff_present_male_female; ?></td>
        <td class="total_style"><?php echo $all_staff_absent_male_female; ?></td>
        
       <td><?php echo $all_qc_male_female; ?></td>
        <td><?php echo $all_qc_present_male_female; ?></td>
        <td class="total_style2"><?php echo $all_qc_absent_male_female; ?></td>
        
        <td class="total_style"><?php echo $all_cleaner_male_female; ?></td>
        <td class="total_style"><?php echo $all_cleaner_present_male_female; ?></td>
        <td class="total_style"><?php echo $all_cleaner_absent_male_female; ?></td>
    
    </table>
  </div>
 <br />
 <?php 
 
 ?>
 <div style="margin-left: 320px;">
  <table class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:15px;margin-left: 20px; float: left;">
  	<thead>
  		<tr style="font-weight:bold;text-align:center; background:#C1E0FF;">
  			<th colspan="3">Average(1-8 Lines)</th>
  				
  		</tr>
  	</thead>
  	<tbody>
  		<tr style="font-weight:bold; text-align:center;">
  			<td></td>
  			<td>Total</td>
  			<td>Present(Avg) </td>
  		</tr>
  		<tr>
  			<td>Operator</td>
  			<td align="right"><?php echo round($total_line_operator_male_female/8,2)?></td>
  			<td align="right"><?php echo round($all_line_operator_present_male_female/8,2);?></td>
  		</tr>
  		<tr>
  			<td>Helper</td>
  			<td align="right"><?php echo round($total_line_helper_male_female/8,2)?></td>
  			<td align="right"><?php echo round($all_line_helper_present_male_female/8,2);?></td>
  		</tr>
  		<tr>
  			<td>QC</td>
  			<td align="right"><?php echo round($total_line_qc_male_female/8,2)?></td>
  			<td align="right"><?php echo round($all_line_qc_present_male_female/8,2);?></td>
  		</tr>
  		<tr>
  			<td>Staff</td>
  			<td align="right"><?php echo round($total_line_staff_male_female/8,2);?></td>
  			<td align="right"><?php echo round($all_line_staff_present_male_female/8,2);?></td>
  		</tr>
  	</tbody>
  </table>
  <table class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:15px;margin-left: 50px; float: left;">
  	<thead>
  		<tr class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:15px;margin-left: 12px;background: rgb(193, 224, 255) none repeat scroll 0% 0%;">
  		<th colspan="4">Previous Day's Employees</th>
  		</tr>
  	</thead>
  	<tbody>
  		<tr style="font-weight:bold; text-align:center;">
  			<td rowspan="2">Grand Total</td>
  			<td>Present</td>
  			<td>Absent</td>
  			<td>Total</td>
  		</tr>
  		<tr>
  			<td><?php echo $all_prev_present_male_female;?></td>
  			<td><?php echo $all_prev_absent_male_female;?></td>
  			<td><?php echo $all_prev_emp_male_female;?></td>
  		</tr>
  	</tbody>
  </table>
  <table class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:15px;margin-left: 50px; float: left;">
  	<thead>
  		<tr class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:15px;margin-left: 12px;background: rgb(193, 224, 255) none repeat scroll 0% 0%;">
  		<th colspan="4">Today's Total Employees</th>
  		</tr>
  	</thead>
  	<tbody>
  		<tr style="font-weight:bold; text-align:center;">
  			<td rowspan="2">Grand Total</td>
  			<td>Present</td>
  			<td>Absent</td>
  			<td>Total</td>
  		</tr>
  		<tr>
  			<td align="right"><?php echo $all_present_male_female;?></td>
  			<td align="right"><?php echo $all_absent_male_female;?></td>
  			<td align="right"><?php echo $all_emp_male_female/*$ttl_present_emp = $all_present_male_female + $all_absent_male_female*/;?></td>
  		</tr>
  	</tbody>
  </table>
  <table class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:15px;margin-left: 50px; float: left;">
  	<thead>
  		<tr class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:15px;margin-left: 12px;background: rgb(193, 224, 255) none repeat scroll 0% 0%;">
  			<th colspan="3">Attendance Percentage</th>
  		</tr>
  	</thead>
  	<tbody>
  		<tr>
  			<td>Present</td>
  			<td>
  				<?php $percent_present_emp = ($all_present_male_female/$all_emp_male_female)*100;
  				echo round($percent_present_emp)."%";
  				?>	
  			</td>
  			<td align="right"><?php echo $all_present_male_female;?></td>
  		</tr>
  		<tr>
  			<td>Absent</td>
			<td><?php $percent_absent_emp = ($all_absent_male_female/$all_emp_male_female)*100; echo round($percent_absent_emp)."%";?></td>
  			<td align="right"><?php echo $all_absent_male_female;?></td>
  		</tr>
  	</tbody>
  </table>
  <table class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:15px;margin-left: 50px; float: left;">
  	<thead>
  		<tr class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:15px;margin-left: 12px;background: rgb(193, 224, 255) none repeat scroll 0% 0%;">
  			<th colspan="2">Maternity</th>
  		</tr>
  		<tr >
  			<th>Line</th>
  			<th>Employee</th>
  		</tr>
  	</thead>
  	<tbody>
  		<?php 
  			$lines = $this->mars_model->get_lines(); 
  			foreach($lines as $line){
  				$line_no = $line->line_id;
				$maternity = $this->mars_model->get_maternity_info($report_date,$line_no); 
				foreach($maternity->result() as $m_info){ 
  		?>
  		<?php } ?>
	  		
	  		<?php if($m_info->emp > 0 ) { ?>
	  		<tr>
	  			<td><?php echo $m_info->line_name;?></td>
	  			<td align="center"><?php echo $m_info->emp;?></td>
	  		</tr>
	  			<?php } ?>
  		<?php }	?>
  		
  	</tbody>
  </table>
  </div>
</div>
</body>
</html>
