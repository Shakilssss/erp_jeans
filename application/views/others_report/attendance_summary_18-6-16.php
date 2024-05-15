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
        <td colspan="3">Total Employee</td>
        <td colspan="3">Total Present</td>
        <td colspan="3">Total Absent</td>
        <td colspan="3">Operator</td>
        <td colspan="3">Helper</td>
        <td colspan="3">Ironman</td>
        <td colspan="3">FoldingMan</td>
        <td colspan="3">IronMan(Finishing)</td>
        <td colspan="3">Jr.Packer</td>
        <td colspan="3">PolyMan</td>
        <td colspan="3">Loader</td>
        <td colspan="3">Driver</td>
        <td colspan="3">Staff</td>
        <td colspan="3">QC</td>
        <td colspan="3">Cleaner</td>
      </tr>
      <tr style="font-weight:bold; text-align:center;background:#C1E0FF;">
        <td style="width:40px">Male</td>
        <td style="width:40px">Female</td>
        <td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Male</td>
        <td style="width:40px">Female</td>
        <td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Male</td>
        <td style="width:40px">Female</td>
        <td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Male</td>
        <td style="width:40px">Female</td>
        <td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Male</td>
        <td style="width:40px">Female</td>
        <td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Male</td>
        <td style="width:40px">Female</td>
        <td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Male</td>
        <td style="width:40px">Female</td>
        <td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Male</td>
        <td style="width:40px">Female</td>
        <td class="total_style" style="width:40px">Total</td>
        <td style="width:40px">Male</td>
        <td style="width:40px">Female</td>
        <td class="total_style" style="width:40px">Total</td>
        
        <td style="width:40px">Male</td>
        <td style="width:40px">Female</td>
        <td class="total_style" style="width:40px">Total</td>
        
        <td style="width:40px">Male</td>
        <td style="width:40px">Female</td>
        <td class="total_style" style="width:40px">Total</td>
        
        <td style="width:40px">Male</td>
        <td style="width:40px">Female</td>
        <td class="total_style" style="width:40px">Total</td>
        
         <td style="width:40px">Male</td>
        <td style="width:40px">Female</td>
        <td class="total_style" style="width:40px">Total</td>
        
        <td style="width:40px">Male</td>
        <td style="width:40px">Female</td>
        <td class="total_style" style="width:40px">Total</td>
        
        <td style="width:40px">Male</td>
        <td style="width:40px">Female</td>
        <td class="total_style" style="width:40px">Total</td>
      </tr>
      <?php

$all_emp_male 	 = 0;
$all_emp_female 	 = 0;
$all_emp_male_female 	 = 0;

$all_present_male = 0;
$all_present_female = 0;
$all_present_male_female = 0;

$all_absent_male  = 0;
$all_absent_female  = 0;
$all_absent_male_female  = 0;

/*$all_leave_male   = 0;
$all_leave_female   = 0;
$all_leave_male_female   = 0;

$all_late_male    = 0;
$all_late_female    = 0;
$all_late_male_female    = 0;*/

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

$count = count($values["cat_name"]);

for($i=0; $i<$count; $i++ )

{

	echo "<tr style='text-align:center;'>";

	

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

	echo 0;}

	echo "</td>";
	
	echo "<td style='text-align:center;'>";

	if($values["daily_att_sum_female"][$i]){

	echo $values["daily_att_sum_female"][$i]['all_emp'];

	$all_emp_female = $all_emp_female + $values["daily_att_sum_female"][$i]['all_emp'];}

	else{

	echo 0;}

	echo "<td class='total_style'>";
	$total_male_female = $values["daily_att_sum_male"][$i]['all_emp'] + $values["daily_att_sum_female"][$i]['all_emp'];
	echo $total_male_female;
	$all_emp_male_female 	 = $all_emp_male_female + $total_male_female;
	echo "</td>";
	

	echo "</td>";

	echo "<td style='text-align:center;'>";

	if($values["daily_att_sum_male"][$i]){

	echo $values["daily_att_sum_male"][$i]['all_present'];

	$all_present_male = $all_present_male + $values["daily_att_sum_male"][$i]['all_present'];}

	else{

	echo 0;}

	echo "</td>";
	
	echo "<td style='text-align:center;'>";

	if($values["daily_att_sum_female"][$i]){

	echo $values["daily_att_sum_female"][$i]['all_present'];

	$all_present_female = $all_present_female + $values["daily_att_sum_female"][$i]['all_present'];}

	else{

	echo 0;}

	echo "</td>";

	
	
	echo "<td class='total_style'>";
	$total_present_male_female = $values["daily_att_sum_male"][$i]['all_present'] + $values["daily_att_sum_female"][$i]['all_present'];
	echo $total_present_male_female;
	echo "</td>";
	
	$all_present_male_female 	 = $all_present_male_female + $total_present_male_female;
	
	

	echo "<td style='text-align:center;'>";
	if($values["daily_att_sum_male"][$i]){
	echo $values["daily_att_sum_male"][$i]['all_absent'];
	$all_absent_male = $all_absent_male + $values["daily_att_sum_male"][$i]['all_absent'];}
	else{
	echo 0;}
	echo "</td>";
	echo "<td style='text-align:center;'>";
	if($values["daily_att_sum_female"][$i]){
	echo $values["daily_att_sum_female"][$i]['all_absent'];
	$all_absent_female = $all_absent_female + $values["daily_att_sum_female"][$i]['all_absent'];}
	else{
	echo 0;}
	echo "</td>";

	
	echo "<td class='total_style'>";
	$total_absent_male_female = $values["daily_att_sum_male"][$i]['all_absent'] + $values["daily_att_sum_female"][$i]['all_absent'];
	echo $total_absent_male_female;
	echo "</td>";
	$all_absent_male_female 	 = $all_absent_male_female + $total_absent_male_female;
	
	
	//=============================OPERATOR======================
	
	echo "<td style='text-align:center;'>";
	//echo $values["remarks_daily_att_sum_male"][0];
	if($values["remarks_daily_att_sum_male"][0][$i]['all_present'] != 0){
	echo $values["remarks_daily_att_sum_male"][0][$i]['all_present'];
	//echo "===";
	$operator_present_male = $operator_present_male + $values["remarks_daily_att_sum_male"][0][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_female"][0][$i]['all_present']!=0){
	echo $values["remarks_daily_att_sum_female"][0][$i]['all_present'];
	$operator_present_female = $operator_present_female + $values["remarks_daily_att_sum_female"][0][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";


	echo "<td class='total_style'>";
	$total_operator_present_male_female = $values["remarks_daily_att_sum_male"][0][$i]['all_present'] + $values["remarks_daily_att_sum_female"][0][$i]['all_present'];
	echo $total_operator_present_male_female;
	echo "</td>";
	$all_operator_present_male_female 	 = $all_operator_present_male_female + $total_operator_present_male_female;
	//=========================END OPERATOE========================
	
	
	//=============================Helper======================
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_male"][1][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_male"][1][$i]['all_present'];
	$helper_present_male = $helper_present_male + $values["remarks_daily_att_sum_male"][1][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_female"][1][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_female"][1][$i]['all_present'];
	$helper_present_female = $helper_present_female + $values["remarks_daily_att_sum_female"][1][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";


	echo "<td class='total_style'>";
	$total_helper_present_male_female = $values["remarks_daily_att_sum_male"][1][$i]['all_present'] + $values["remarks_daily_att_sum_female"][1][$i]['all_present'];
	echo $total_helper_present_male_female;
	echo "</td>";
	$all_helper_present_male_female 	 = $all_helper_present_male_female + $total_helper_present_male_female;
	//=========================END Helper========================
	
	
	//=============================Ironman======================
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_male"][2][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_male"][2][$i]['all_present'];
	$ironman_present_male = $ironman_present_male + $values["remarks_daily_att_sum_male"][2][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_female"][2][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_female"][2][$i]['all_present'];
	$ironman_present_female = $ironman_present_female + $values["remarks_daily_att_sum_female"][2][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";


	echo "<td class='total_style'>";
	$total_ironman_present_male_female = $values["remarks_daily_att_sum_male"][2][$i]['all_present'] + $values["remarks_daily_att_sum_female"][2][$i]['all_present'];
	echo $total_ironman_present_male_female;
	echo "</td>";
	$all_ironman_present_male_female 	 = $all_ironman_present_male_female + $total_ironman_present_male_female;
	//=========================END Ironman========================
	
	
	
	
	//=============================Jr.FoldingMan======================
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_male"][3][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_male"][3][$i]['all_present'];
	$inputman_present_male = $inputman_present_male + $values["remarks_daily_att_sum_male"][3][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_female"][3][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_female"][3][$i]['all_present'];
	$inputman_present_female = $inputman_present_female + $values["remarks_daily_att_sum_female"][3][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";


	echo "<td class='total_style'>";
	$total_inputman_present_male_female = $values["remarks_daily_att_sum_male"][3][$i]['all_present'] + $values["remarks_daily_att_sum_female"][3][$i]['all_present'];
	echo $total_inputman_present_male_female;
	echo "</td>";
	$all_inputman_present_male_female 	 = $all_inputman_present_male_female + $total_inputman_present_male_female;
	//=========================END FoldingMan========================
	
	
	//=============================Jr.Iron======================
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_male"][4][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_male"][4][$i]['all_present'];
	$quality_present_male = $quality_present_male + $values["remarks_daily_att_sum_male"][4][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_female"][4][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_female"][4][$i]['all_present'];
	$quality_present_female = $quality_present_female + $values["remarks_daily_att_sum_female"][4][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";

	echo "<td class='total_style'>";
	$total_quality_present_male_female = $values["remarks_daily_att_sum_male"][4][$i]['all_present'] + $values["remarks_daily_att_sum_female"][4][$i]['all_present'];
	echo $total_quality_present_male_female;
	echo "</td>";
	$all_quality_present_male_female 	 = $all_quality_present_male_female + $total_quality_present_male_female;
	//=========================END Iron========================
	
	//=============================Jr.Packer======================
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_male"][5][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_male"][5][$i]['all_present'];
	$packer_present_male = $packer_present_male + $values["remarks_daily_att_sum_male"][5][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_female"][5][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_female"][5][$i]['all_present'];
	$packer_present_female = $packer_present_female + $values["remarks_daily_att_sum_female"][5][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";

	echo "<td class='total_style'>";
	$total_packer_present_male_female = $values["remarks_daily_att_sum_male"][5][$i]['all_present'] + $values["remarks_daily_att_sum_female"][5][$i]['all_present'];
	echo $total_packer_present_male_female;
	echo "</td>";
	$all_packer_present_male_female 	 = $all_packer_present_male_female + $total_packer_present_male_female;
	//=========================END Packer========================
	
	//=============================Polyman======================
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_male"][6][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_male"][6][$i]['all_present'];
	$polyman_present_male = $polyman_present_male + $values["remarks_daily_att_sum_male"][6][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_female"][6][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_female"][6][$i]['all_present'];
	$polyman_present_female = $polyman_present_female + $values["remarks_daily_att_sum_female"][6][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";

	echo "<td class='total_style'>";
	$total_polyman_present_male_female = $values["remarks_daily_att_sum_male"][6][$i]['all_present'] + $values["remarks_daily_att_sum_female"][6][$i]['all_present'];
	echo $total_polyman_present_male_female;
	echo "</td>";
	$all_polyman_present_male_female 	 = $all_polyman_present_male_female + $total_polyman_present_male_female;
	//=========================Polyman========================
	
	//=============================Loader======================
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_male"][7][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_male"][7][$i]['all_present'];
	$loader_present_male = $loader_present_male + $values["remarks_daily_att_sum_male"][7][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_female"][7][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_female"][7][$i]['all_present'];
	$loader_present_female = $loader_present_female + $values["remarks_daily_att_sum_female"][7][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";

	echo "<td class='total_style'>";
	$total_loader_present_male_female = $values["remarks_daily_att_sum_male"][7][$i]['all_present'] + $values["remarks_daily_att_sum_female"][7][$i]['all_present'];
	echo $total_loader_present_male_female;
	echo "</td>";
	$all_loader_present_male_female 	 = $all_loader_present_male_female + $total_loader_present_male_female;
	//=========================Loader========================
	
	//=============================Driver======================
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_male"][8][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_male"][8][$i]['all_present'];
	$driver_present_male = $driver_present_male + $values["remarks_daily_att_sum_male"][8][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_female"][8][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_female"][8][$i]['all_present'];
	$driver_present_female = $driver_present_female + $values["remarks_daily_att_sum_female"][8][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";

	echo "<td class='total_style'>";
	$total_driver_present_male_female = $values["remarks_daily_att_sum_male"][8][$i]['all_present'] + $values["remarks_daily_att_sum_female"][8][$i]['all_present'];
	echo $total_driver_present_male_female;
	echo "</td>";
	$all_driver_present_male_female 	 = $all_driver_present_male_female + $total_driver_present_male_female;
	//=========================Driver========================
	
	//=============================Staff======================
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_male"][9][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_male"][9][$i]['all_present'];
	$staff_present_male = $staff_present_male + $values["remarks_daily_att_sum_male"][9][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_female"][9][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_female"][9][$i]['all_present'];
	$staff_present_female = $staff_present_female + $values["remarks_daily_att_sum_female"][9][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";

	echo "<td class='total_style'>";
	$total_staff_present_male_female = $values["remarks_daily_att_sum_male"][9][$i]['all_present'] + $values["remarks_daily_att_sum_female"][9][$i]['all_present'];
	echo $total_staff_present_male_female;
	echo "</td>";
	$all_staff_present_male_female 	 = $all_staff_present_male_female + $total_staff_present_male_female;
	//=========================Staff========================
	
	//=============================QC======================
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_male"][10][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_male"][10][$i]['all_present'];
	$qc_present_male = $qc_present_male + $values["remarks_daily_att_sum_male"][10][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_female"][10][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_female"][10][$i]['all_present'];
	$qc_present_female = $qc_present_female + $values["remarks_daily_att_sum_female"][10][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";

	echo "<td class='total_style'>";
	$total_qc_present_male_female = $values["remarks_daily_att_sum_male"][10][$i]['all_present'] + $values["remarks_daily_att_sum_female"][10][$i]['all_present'];
	echo $total_driver_present_male_female;
	echo "</td>";
	$all_qc_present_male_female 	 = $all_qc_present_male_female + $total_qc_present_male_female;
	//=========================QC========================
	
	//=============================Cleaner======================
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_male"][11][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_male"][11][$i]['all_present'];
	$cleaner_present_male = $cleaner_present_male + $values["remarks_daily_att_sum_male"][11][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";
	
	echo "<td style='text-align:center;'>";
	if($values["remarks_daily_att_sum_female"][11][$i]['all_present'] !=0){
	echo $values["remarks_daily_att_sum_female"][11][$i]['all_present'];
	$cleaner_present_female = $cleaner_present_female + $values["remarks_daily_att_sum_female"][11][$i]['all_present'];}
	else{
	echo 0;}
	echo "</td>";
	
	echo "<td class='total_style'>";
	$total_cleaner_present_male_female = $values["remarks_daily_att_sum_male"][11][$i]['all_present'] + $values["remarks_daily_att_sum_female"][11][$i]['all_present'];
	echo $total_cleaner_present_male_female;
	echo "</td>";
	$all_cleaner_present_male_female 	 = $all_cleaner_present_male_female + $total_cleaner_present_male_female;
	//=========================Cleaner========================
	
	echo "</tr>";

}

?>
      <tr style="font-weight:bold; text-align:center;">
        <td colspan="2">Total</td>
        <td><?php echo $all_emp_male; ?></td>
        <td><?php echo $all_emp_female; ?></td>
        <td class="total_style"><?php echo $all_emp_male_female; ?></td>
        
        <td><?php echo $all_present_male; ?></td>
        <td><?php echo $all_present_female; ?></td>
        <td class="total_style"><?php echo $all_present_male_female; ?></td>
        
        <td><?php echo $all_absent_male; ?></td>
        <td><?php echo $all_absent_female; ?></td>
        <td class="total_style"><?php echo $all_absent_male_female; ?></td>
        
        <td><?php echo $operator_present_male; ?></td>
        <td><?php echo $operator_present_female; ?></td>
        <td class="total_style"><?php echo $all_operator_present_male_female; ?></td>
        
        <td><?php echo $helper_present_male; ?></td>
        <td><?php echo $helper_present_female; ?></td>
        <td class="total_style"><?php echo $all_helper_present_male_female; ?></td>
        
        <td><?php echo $ironman_present_male; ?></td>
        <td><?php echo $ironman_present_female; ?></td>
        <td class="total_style"><?php echo $all_ironman_present_male_female; ?></td>
        
        <td><?php echo $inputman_present_male; ?></td>
        <td><?php echo $inputman_present_female; ?></td>
        <td class="total_style"><?php echo $all_inputman_present_male_female; ?></td>
        
        <td><?php echo $quality_present_male; ?></td>
        <td><?php echo $quality_present_female; ?></td>
        <td class="total_style"><?php echo $all_quality_present_male_female; ?></td>
        
        <td><?php echo $packer_present_male; ?></td>
        <td><?php echo $packer_present_female; ?></td>
        <td class="total_style"><?php echo $all_packer_present_male_female; ?></td>
        
        <td><?php echo $polyman_present_male; ?></td>
        <td><?php echo $polyman_present_female; ?></td>
        <td class="total_style"><?php echo $all_polyman_present_male_female; ?></td>
        
         <td><?php echo $loader_present_male; ?></td>
        <td><?php echo $loader_present_female; ?></td>
        <td class="total_style"><?php echo $all_loader_present_male_female; ?></td>
        
        <td><?php echo $driver_present_male; ?></td>
        <td><?php echo $driver_present_female; ?></td>
        <td class="total_style"><?php echo $all_driver_present_male_female; ?></td>
        
        <td><?php echo $staff_present_male; ?></td>
        <td><?php echo $staff_present_female; ?></td>
        <td class="total_style"><?php echo $all_staff_present_male_female; ?></td>
        
        <td><?php echo $qc_present_male; ?></td>
        <td><?php echo $qc_present_female; ?></td>
        <td class="total_style"><?php echo $all_qc_present_male_female; ?></td>
        
        <td><?php echo $cleaner_present_male; ?></td>
        <td><?php echo $cleaner_present_female; ?></td>
        <td class="total_style"><?php echo $all_cleaner_present_male_female; ?></td>
    
    </table>
  </div>
</div>
</body>
</html>
