<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pay Slip</title>
<style type="text/css">
<!--
.style1 {font-size: 15px}
-->
</style>
</head>
<body style="line-height:12px;">
<table align="left" border="0" cellpadding="0" cellspacing="0">
<tr>
<?php

foreach($values as $rows)
{
	//if($i % 2 == 0)
	//{
		
	echo "<tr>";
	//}?>
	<?php echo "<td height='500;' width='450' valign='top' align='center'>"; ?>  
  	<div style="width:100%; height:auto; ">
<div style="width:305px; height:auto; overflow:hidden; font-size:8px; font-family: SolaimanLipi;margin-bottom:70px;">
 <div style="width:280px; height:auto; margin:0 auto; text-align:center;">
 <?php $this->load->view('head_bangla'); ?>
   	 
	 
	 
   <span style="font-size:15px; font-weight:bold;">&#2474;&#2503; - &#2488;&#2509;&#2482;&#2495;&#2474;-<span style="font-family:'Times New Roman', Times, serif;">
   <?php
	$first= $rows["salary_month"];
	$first_y=trim(substr($first,0,4));
	$first_m=trim(substr($first,5,2));
	$first_d=trim(substr($first,8,2));
	$month_format = date("F", mktime(0, 0, 0, $first_m, 1, $first_y));
	echo "$month_format, $first_y";
	$start_date = "$first_y-$first_m-01"
   ?>
   </span>
 </div>
  <div style="width:300px; height:auto; overflow:hidden; border:1px solid #000000;">
  
  
	<div style="width:100%; border-bottom:1px solid #000000; height:auto; overflow:hidden;">
	<table width="300" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="76">নাম </td>
			<td width="96"><font style="font-family:'Times New Roman', Times, serif;">: <strong><?php echo $rows["emp_full_name"];   ?></strong> </font></td>
			<td width="72"></td>
			<td width="75"></td>
		</tr>
		
		<tr> 
			<td width="76">পদবী;</td>
			<td width="96"><font style="font-family:'Times New Roman', Times, serif;">: <?php echo $rows["desig_name"];   ?> </font></td>
			<td width="72">ডিপার্টমেন্ট </td>
			<td width="75"><font style="font-family:'Times New Roman', Times, serif;">: <?php echo $rows["dept_name"];   ?> </font></td>
		</tr>
		<?php $emp_id = $rows["emp_id"]; ?>
		<tr>
			<td width="76">কার্ড </td>
			<td width="96"><font style="font-family:'Times New Roman', Times, serif;">: <?php echo $rows["emp_id"];   ?></font></td>
			<td width="72">সেকশন</td> 
			<td width="75"><font style="font-family:'Times New Roman', Times, serif;">: <?php echo $rows["sec_name"];   ?></font></td>
		</tr>
		<tr>
			<td width="76">যোগদানের তারিখ</td>
			<td width="96"><font style="font-family:'Times New Roman', Times, serif;">: 
			<?php 
			$date =  $rows["emp_join_date"];  
			$year=trim(substr($date,0,4));
			$month=trim(substr($date,5,2));
			$day=trim(substr($date,8,2));
			$date_format = date("d-M-y", mktime(0, 0, 0, $month, $day, $year));
			echo $date_format; 
			?>
			</font></td>
			<td width="72">লাইন</td>
			<td width="75"><font style="font-family:'Times New Roman', Times, serif;">: <?php echo $rows["line_name"];   ?> </font></td>
		</tr>
		<tr> 
			<td width="76">মোট দিন</td>
			<td width="96"><font style="font-family: SutonnyMJ;">: <?php echo $total_days = $rows["total_days"];   ?> </font></td>
			<td width="72">পজিশন </td>
			<td width="75"><font style="font-family:'Times New Roman', Times, serif;">: <?php echo $rows["posi_name"];   ?> </font></td>
		</tr>
		<?php
		/*$attend  	= $rows["att_days"];
		$weekend_days = "Fri";
		$weekend_manu = $this->common_model->get_weekend_days($weekend_days,$total_days,$start_date);
		$weeked = $rows["weeked"];
		$attend_days = ($attend + $weeked) - $weekend_manu;*/

		$sal_days = $first_m == '02' ? 28 : 30;
		//$absent = "A";
		//$absent = $this->salary_process_model->attendance_check($emp_id,$absent,$total_days,$start_date);
		$attend = "P";
		$attend = $this->salary_process_model->attendance_check($emp_id,$attend,$sal_days,$start_date);
		
		$absent = "A";
		$real_absent = $this->salary_process_model->attendance_check($emp_id,$absent,$sal_days,$start_date);
		
		
		$holiday = "H";
		$holiday = $this->common_model->holiday_attendance_check($emp_id,$holiday,$sal_days, $start_date);
		
		
		$weekend_total_days = $total_days;
		$weekend_start_date = $start_date;
		$join_year_month = date("m-Y", strtotime($date));
		$salary_year_month = date("m-Y", strtotime($start_date));
		if($salary_year_month == $join_year_month)
		{
			
			$doj = $rows["emp_join_date"];
			$daylen = 60*60*24;
			$last_date = date('Y-m-t', strtotime($start_date));
		   	$date1 = $last_date;
		   	$date2 = $doj;
		
		   	$weekend_total_days =  (strtotime($date1)-strtotime($date2))/$daylen;
			$weekend_start_date = $doj;
		}
		
		
		
		$weekend_days = "Fri";
		$weekend_manu = $this->common_model->get_weekend_days($weekend_days,$weekend_total_days,$weekend_start_date,$emp_id);
		//print_r($weekend_manu);
		if(isset($holiday['h_date']))
		{
			$result = array_intersect($weekend_manu['wk_date'],$holiday['h_date']);
			$count_wk_holiday_match = count($result);
		}
		else
		{
			
			$result = 0;//$weekend_manu['wk_date'];
			$count_wk_holiday_match = 0;
		}
		$weekend_manu_no_weekends = $rows["weeked"];//$weekend_manu['no_weekends'] - $count_wk_holiday_match;
		
		
		$weeked = $rows['weeked'];
		$attend_days = $attend - $weekend_manu['total_weekend_present'];//($attend + $weeked) - $weekend_manu_no_weekends;
		$absent = $real_absent - $weekend_manu['total_weekend_absent'];
		
		$weekend_manu_absent = $weekend_manu['total_weekend_absent'];
		//echo "$absent = $real_absent - $weekend_manu_absent";
		
		$num_of_workday = $rows["total_days"] - $weekend_manu_no_weekends
		?>
		<tr>
			<td width="76">মোট কর্ম দিবস </td>
			<td width="96"><font style="font-family: SutonnyMJ;">: 
			<?php 
			$holidy_or_weeked = $rows["holiday_or_weeked"];   
			echo $num_of_workday;
			?> 
			</font></td>
			<td width="72">মোট ছুটি</td>
			<td width="75">
			<font style="font-family: SutonnyMJ;">: 
			<?php 
			$c_l = $rows["c_l"];  
			$s_l = $rows["s_l"];  
			$e_l = $rows["e_l"];   
			echo $total_leave = $c_l + $s_l + $e_l;
			?> 
			</font>
			</td>
		</tr>
		<?php
		//$absent = $rows["absent_days"]; 
		$before_after_absent = $rows["before_after_absent"];//$value[$k]->before_after_absent;
		if($before_after_absent > 0)
		{
			$absent = $absent -$before_after_absent;
		}
		$total_absent = $absent + $before_after_absent;
		?>
		
		<tr>
			<td width="76">মোট অনুপস্থিতি</td>
			<td width="96"> <font style="font-family: SutonnyMJ;">: <?php echo $total_absent;  ?> </font>    </td>
			<td width="72">উপস্থিতি</td>
			<td width="75"><font style="font-family: SutonnyMJ;">: <?php echo $attend_days;   ?> </font>  </td>
		</tr>
		
		<tr>
			<td width="76">সাপ্তাহিক ছুটি</td>
			<td width="96"> <font style="font-family: SutonnyMJ;">: <?php echo $weekend_manu_no_weekends;   ?> </font>  </td>
			<td width="72">ওটি ঘণ্টা</td>
			<td width="75"><font style="font-family: SutonnyMJ;">: <?php echo $ot_hour = $rows["ot_hour"];   ?> </font> </td>
		</tr>
		<tr>
			<td width="76" height="14">অন্যান্য ছুটি</td>
			<td width="96"><font style="font-family: SutonnyMJ;">: <?php echo $holidy = $rows["holidy"];   ?> </font> </td>
			<td width="72">ওটি রেট</td>
			<td width="75"><font style="font-family: SutonnyMJ;">: <?php echo $ot_rate = $rows["ot_rate"];   ?> </font></td>
		</tr>
		
	</table> 
	</div>
	<div style="width:100%; border-bottom:1px solid #000000; height:auto; overflow:hidden;">
	
	<div style="float:left; width:55px; height: auto; position:relative; left:5px; top:18px; font-weight:bold;">  <!--position: relative; top: 18px; left: 5px;-->
	
	(ক) বেতন;
	</div>
	<div style="float: left; width:240px; border-left:1px solid #000000;" > 
	  <table width="239" cellspacing="0" cellpadding="0">
	  <tr>
	  	<td width="160">মুল বেতন </td>
		<td>:</td>
	  	<td width="70" align="center"><font style="font-family: SutonnyMJ;"><?php echo $basic_sal = $rows["basic_sal"];   ?> </font></td>
	</tr>
	<tr>
	  	<td width="160">বাড়ি ভাড়া</td>
	  	<td>:</td>
		<td width="12" align="center">  <font style="font-family: SutonnyMJ;"><?php echo $house_r = $rows["house_r"];   ?> </font></td>
	</tr>
	  
	  <tr>
	  	<td width="160">চিকিৎসা ভাতা</td>
	  	<td>:</td>
		<td width="12" align="center"><font style="font-family: SutonnyMJ;"><?php echo $medical_a = $rows["medical_a"];   ?> </font> </td>
	</tr>
    
      <tr>
	  	<td width="160">যাতায়াত ভাতা</td>
	  	<td>:</td>
		<td width="12" align="center"><font style="font-family: SutonnyMJ;"><?php echo $trans_allow = $rows["trans_allow"];   ?> </font> </td>
	</tr>
    
      <tr>
	  	<td width="160">খাদ্য ভাতা</td>
	  	<td>:</td>
		<td width="12" align="center"><font style="font-family: SutonnyMJ;"><?php echo $food_allow = $rows["food_allow"];   ?> </font> </td>
	</tr>
	  
	  <tr>
	  	<td width="160" height="14">মোট</td>
	  	<td>:</td>
		<td width="12" align="center">  <font style="font-family: SutonnyMJ;"><?php echo $gross_sal = $rows["gross_sal"];   ?> </font></td>
	</tr>
  </table>
	
	</div>
	</div>
   <?php 
   //===================Abs deduction Cal====================
	//========================================================
		$abs_deduction_salary = $basic_sal;
		
		$join_year_month = date("m-Y", strtotime($rows["emp_join_date"]));
		$salary_year_month = date("m-Y", strtotime($rows["salary_month"]));
		if($salary_year_month == $join_year_month)
		{
			$join_day = date("d", strtotime($date));
			if($join_day < 15)
			{
				$abs_deduction_salary = $basic_sal;
			}
			else{
				$abs_deduction_salary = $rows["gross_sal"];
			}
			
		}
   //echo $abs_deduction_salary;
  	$abs_deduction = $abs_deduction_salary / 30 * $total_absent;
		$abs_deduction = round($abs_deduction); ?>
   <div style="border-bottom:1px solid #000000;"><table width="295" cellspacing="0" cellpadding="0">
    <tr>
      <td width="239"><span style="position:relative; left:5px; font-weight:bold;"> (খ) অনুপস্থিতি কর্তন</span>
      <td width="38"><font style="font-family: SutonnyMJ;"><?php echo $abs_deduction; ?> </font></td>
    </tr></table></div>
		
  <div style="border-bottom:1px solid #000000;"><table width="295" cellspacing="0" cellpadding="0">
    <tr>
      <td width="239"><span style="position:relative; left:5px; font-weight:bold;"> (গ) প্রদেয় বেতন</span>
	  <?php $pay_wages = $gross_sal -$abs_deduction;?>
      <td width="38">  <font style="font-family: SutonnyMJ;"><?php echo $pay_wages; ?> </font>                   </td>
    </tr></table></div>
  <div style="width:100%; border-bottom:1px solid #000000; height:auto; overflow:hidden;">
	
	<div style="float:left; width:55px; height: auto; position:relative; left:5px; top:30px; font-weight:bold;"> (ঘ) ভাতা</div>
	<div style="float: left; width:240px; border-left:1px solid #000000;" > 
	  <table width="240">
	 <!-- <tr>
	  	<td width="154">যাতায়াত</td>
	  	<td>:</td>
		<td width="70" align="center">  <font style="font-family: SutonnyMJ;"><?php echo $trans_allaw = $rows["trans_allaw"];   ?></font> </td>
	</tr>-->
	<tr>
	  	<td width="154">হাজিরা বোনাস</td>
	  	<td>:</td>
		<td width="70" align="center"> <font style="font-family: SutonnyMJ;"><?php echo $att_bonus = $rows["att_bonus"];   ?></font> </td>
	</tr>
	
	<!--<tr>
	  	<td width="154">লাঞ্চ</td>
	  	<td>:</td>
		<td width="70" align="center"> <font style="font-family: SutonnyMJ;"><?php echo $lunch_allaw = $rows["lunch_allaw"];   ?></font> </td>
	</tr>-->
	  
	  <tr>
	  	<td width="154">অন্যান্য</td>
	  	<td>:</td>
		<td width="70" align="center"> <font style="font-family: SutonnyMJ;" > <?php echo $others_allaw = $rows["others_allaw"];   ?> </font>  </td>
	</tr>
	  
	  
	 <tr>
	  	<td width="154">মোট ভাতা </td>
	  	<td>:</td>
		<td width="70" align="center"> <font style="font-family: SutonnyMJ;"><?php echo $total_allaw = $rows["total_allaw"];   ?> </td>
	</tr>
	
  </table>
	
	</div>
	</div>
	
	<div style="border-bottom:1px solid #000000;"><table width="298" cellspacing="0" cellpadding="0">
    <tr>
      <td width="239"><span style="position:relative; left:5px; font-weight:bold;"> (ঙ) ওভার টাইম</span> 
      </td><td width="38"> 
	  <span style="font-family: SutonnyMJ; " > <?php echo $ot_amount = $rows["ot_amount"];   ?> </span>
	  </td>
    </tr></table></div>
	<?php $gross_pay = $pay_wages + $ot_amount + $att_bonus  ; ?>
	<div style="border-bottom:1px solid #000000;"><table width="298">
    <tr>
      <td width="243"><span style="position:relative; left:2px; font-weight:bold;"> (চ) মোট বেতন</span> &nbsp;(&#2455; + &#2456; + &#2457; ) 
      <td width="43"><font style="font-family: SutonnyMJ;" > <?php echo $gross_pay;   ?> </font></td>
    </tr></table></div>
	
	<div style="width:100%; border-bottom:1px solid #000000; height:auto; overflow:hidden;">
	
	<div style="float:left; width:53px; position:relative; left:5px; top:25px; font-weight:bold;">(ছ) &#2453;&#2480;&#2509;&#2468;&#2472; </div>
	<div style="float: left; width:240px; border-left:1px solid #000000;" > 
	  <table width="237">
	  
	<tr> 
	  	<td width="152">অগ্রিম কর্তন </td>
	  	<td >:</td>
		<td width="59" align="center"> <font style="font-family: SutonnyMJ;" > <?php echo $adv_deduct = $rows["adv_deduct"];   ?> </font></td>
	</tr>
	  
	  <tr>
	  	<td width="152">&#2437;&#2472;&#2509;&#2479;&#2494;&#2472;&#2509;&#2479;</td>
	  	<td >:</td>
		<td width="59" align="center"> <font style="font-family: SutonnyMJ;" > <?php echo $total_days = $rows["others_deduct"];   ?> </font></td>
	</tr>
	  
	  <tr>
	  	<td width="152">&#2474;&#2509;&#2480;&#2477;&#2495;&#2465;&#2503;&#2472;&#2509;&#2463; &#2475;&#2494;&#2472;&#2509;&#2465; </td>
	  	<td >:</td>
		<td width="59" align="center"> <font style="font-family: SutonnyMJ;" > <?php echo $total_days = $rows["provident_fund"];   ?> </font></td>
	</tr>
	
	 <tr>
	  	<td width="152">&#2478;&#2507;&#2463; &#2453;&#2480;&#2509;&#2468;&#2472; </td>
	  	<td >:</td>
		<td width="59" align="center"> <font style="font-family: SutonnyMJ;" > <?php echo $total_days = $rows["total_deduct"];   ?> </font></td>
	</tr>
	
  </table>
	
	</div>
	</div>
	<?php $net_pay = $gross_pay - $adv_deduct; ?>
	<div><table width="295" height="17" cellspacing="0" cellpadding="0">
    <tr>
      <td width="215">&#2488;&#2480;&#2509;&#2476;&#2478;&#2507;&#2463; &#2474;&#2509;&#2480;&#2470;&#2503;&#2527;  (&#2458;- &#2459; ) 
      <td >:</td>
	  <td width="78" align="center"> <font style="font-family: SutonnyMJ;" > <?php echo $net_pay;   ?> </font></td>
    </tr></table></div>
  </div>
  <div style="text-align:left; font-size:14px; padding-top:5px;">
  	Authority Signature : <span><img src="<?php echo base_url();?>images/signature.png" width="100" height="auto" /></span>
  </div>
</div>
</div>
	<?php echo "</td>"; ?>
    
    <?php echo "<td height='500;' width='450' valign='top' align='center'>"; ?>  
  	<div style="width:100%; height:auto; ">
<div style="width:305px; height:auto; overflow:hidden; font-size:8px; font-family: SolaimanLipi;margin-bottom:70px;">
 <div style="width:280px; height:auto; margin:0 auto; text-align:center;">
 <?php $this->load->view('head_bangla'); ?>
   	 
	 
	 
   <span style="font-size:15px; font-weight:bold;">&#2474;&#2503; - &#2488;&#2509;&#2482;&#2495;&#2474;-<span style="font-family:'Times New Roman', Times, serif;">
   <?php
	$first= $rows["salary_month"];
	$first_y=trim(substr($first,0,4));
	$first_m=trim(substr($first,5,2));
	$first_d=trim(substr($first,8,2));
	$month_format = date("F", mktime(0, 0, 0, $first_m, 1, $first_y));
	echo "$month_format, $first_y";
   ?>
   </span>
 </div>
  <div style="width:300px; height:auto; overflow:hidden; border:1px solid #000000;">
  
  
	<div style="width:100%; border-bottom:1px solid #000000; height:auto; overflow:hidden;">
	<table width="300" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="76">নাম </td>
			<td width="96"><font style="font-family:'Times New Roman', Times, serif;">: <strong><?php echo $rows["emp_full_name"];   ?></strong> </font></td>
			<td width="72"></td>
			<td width="75"></td>
		</tr>
		
		<tr> 
			<td width="76">পদবী;</td>
			<td width="96"><font style="font-family:'Times New Roman', Times, serif;">: <?php echo $rows["desig_name"];   ?> </font></td>
			<td width="72">ডিপার্টমেন্ট </td>
			<td width="75"><font style="font-family:'Times New Roman', Times, serif;">: <?php echo $rows["dept_name"];   ?> </font></td>
		</tr>
		<?php $emp_id = $rows["emp_id"]; ?>
		<tr>
			<td width="76">কার্ড </td>
			<td width="96"><font style="font-family:'Times New Roman', Times, serif;">: <?php echo $rows["emp_id"];   ?></font></td>
			<td width="72">সেকশন</td> 
			<td width="75"><font style="font-family:'Times New Roman', Times, serif;">: <?php echo $rows["sec_name"];   ?></font></td>
		</tr>
		<tr>
			<td width="76">যোগদানের তারিখ</td>
			<td width="96"><font style="font-family:'Times New Roman', Times, serif;">: 
			<?php 
			$date =  $rows["emp_join_date"];  
			$year=trim(substr($date,0,4));
			$month=trim(substr($date,5,2));
			$day=trim(substr($date,8,2));
			$date_format = date("d-M-y", mktime(0, 0, 0, $month, $day, $year));
			echo $date_format; 
			?>
			</font></td>
			<td width="72">লাইন</td>
			<td width="75"><font style="font-family:'Times New Roman', Times, serif;">: <?php echo $rows["line_name"];   ?> </font></td>
		</tr>
		<tr> 
			<td width="76">মোট দিন</td>
			<td width="96"><font style="font-family: SutonnyMJ;">: <?php echo $total_days = $rows["total_days"];   ?> </font></td>
			<td width="72">পজিশন </td>
			<td width="75"><font style="font-family:'Times New Roman', Times, serif;">: <?php echo $rows["posi_name"];   ?> </font></td>
		</tr>
		<tr>
			<td width="76">মোট কর্ম দিবস </td>
			<td width="96"><font style="font-family: SutonnyMJ;">: 
			<?php 
			//$holidy_or_weeked = $rows["holiday_or_weeked"];   
			echo $num_of_workday;
			?> 
			</font></td>
			<td width="72">মোট ছুটি</td>
			<td width="75">
			<font style="font-family: SutonnyMJ;">: 
			<?php 
			$c_l = $rows["c_l"];  
			$s_l = $rows["s_l"];  
			$e_l = $rows["e_l"];   
			echo $total_leave = $c_l + $s_l + $e_l;
			?> 
			</font>
			</td>
		</tr>
		
		<tr>
			<td width="76">মোট অনুপস্থিতি</td>
			<td width="96"> <font style="font-family: SutonnyMJ;">: <?php echo $total_absent;  ?> </font>    </td>
			<td width="72">উপস্থিতি</td>
			<td width="75"><font style="font-family: SutonnyMJ;">: <?php echo $attend_days;   ?> </font>  </td>
		</tr>
		
		<tr>
			<td width="76">সাপ্তাহিক ছুটি</td>
			<td width="96"><font style="font-family: SutonnyMJ;">: <?php echo $weekend_manu_no_weekends ;   ?> </font>  </td>
			<td width="72">ওটি ঘণ্টা</td>
			<td width="75"><font style="font-family: SutonnyMJ;">: <?php echo $ot_hour = $rows["ot_hour"];   ?> </font> </td>
		</tr>
		<tr>
			<td width="76" height="14">অন্যান্য ছুটি</td>
			<td width="96"><font style="font-family: SutonnyMJ;">: <?php echo $holidy = $rows["holidy"];   ?> </font> </td>
			<td width="72">ওটি রেট</td>
			<td width="75"><font style="font-family: SutonnyMJ;">: <?php echo $ot_rate = $rows["ot_rate"];   ?> </font></td>
		</tr>
		
	</table>  
	</div>
	<div style="width:100%; border-bottom:1px solid #000000; height:auto; overflow:hidden;">
	
	<div style="float:left; width:55px; height: auto; position:relative; left:5px; top:18px; font-weight:bold;">  <!--position: relative; top: 18px; left: 5px;-->
	
	(ক) বেতন;
	</div>
	<div style="float: left; width:240px; border-left:1px solid #000000;" > 
	  <table width="239" cellspacing="0" cellpadding="0">
	  <tr>
	  	<td width="160">মুল বেতন </td>
		<td>:</td>
	  	<td width="70" align="center"><font style="font-family: SutonnyMJ;"><?php echo $basic_sal = $rows["basic_sal"];   ?> </font></td>
	</tr>
	<tr>
	  	<td width="160">বাড়ি ভাড়া</td>
	  	<td>:</td>
		<td width="12" align="center">  <font style="font-family: SutonnyMJ;"><?php echo $house_r = $rows["house_r"];   ?> </font></td>
	</tr>
	  
	  <tr>
	  	<td width="160">চিকিৎসা ভাতা</td>
	  	<td>:</td>
		<td width="12" align="center"><font style="font-family: SutonnyMJ;"><?php echo $medical_a = $rows["medical_a"];   ?> </font> </td>
	</tr>
	   <tr>
	  	<td width="160">যাতায়াত ভাতা</td>
	  	<td>:</td>
		<td width="12" align="center"><font style="font-family: SutonnyMJ;"><?php echo $trans_allow = $rows["trans_allow"];   ?> </font> </td>
	</tr>
    
      <tr>
	  	<td width="160">খাদ্য ভাতা</td>
	  	<td>:</td>
		<td width="12" align="center"><font style="font-family: SutonnyMJ;"><?php echo $food_allow = $rows["food_allow"];   ?> </font> </td>
	</tr>
	  <tr>
	  	<td width="160" height="14">মোট</td>
	  	<td>:</td>
		<td width="12" align="center">  <font style="font-family: SutonnyMJ;"><?php echo $gross_sal = $rows["gross_sal"];   ?> </font></td>
	</tr>
  </table>
	
	</div>
	</div>
   
 <?php 
   //===================Abs deduction Cal====================
	//========================================================
		$abs_deduction_salary = $basic_sal;
		$total_absent = $absent + $before_after_absent;
		$join_year_month = date("m-Y", strtotime($rows["emp_join_date"]));
		$salary_year_month = date("m-Y", strtotime($rows["salary_month"]));
		if($salary_year_month == $join_year_month)
		{
			$join_day = date("d", strtotime($date));
			if($join_day < 15)
			{
				$abs_deduction_salary = $basic_sal;
			}
			else{
				$abs_deduction_salary = $rows["gross_sal"];
			}
			
		}
   
   $abs_deduction = $abs_deduction_salary / $total_days * $total_absent;
		$abs_deduction = round($abs_deduction); ?>
   <div style="border-bottom:1px solid #000000;"><table width="295" cellspacing="0" cellpadding="0">
    <tr>
      <td width="239"><span style="position:relative; left:5px; font-weight:bold;"> (খ) অনুপস্থিতি কর্তন</span>
      <td width="38"><font style="font-family: SutonnyMJ;"><?php echo $abs_deduction; ?> </font></td>
    </tr></table></div>
		
  <div style="border-bottom:1px solid #000000;"><table width="295" cellspacing="0" cellpadding="0">
    <tr>
      <td width="239"><span style="position:relative; left:5px; font-weight:bold;"> (গ) প্রদেয় বেতন</span>
	  <?php $pay_wages = $gross_sal -$abs_deduction;?>
      <td width="38">  <font style="font-family: SutonnyMJ;"><?php echo $pay_wages; ?> </font>                   </td>
    </tr></table></div>
  <div style="width:100%; border-bottom:1px solid #000000; height:auto; overflow:hidden;">
	
	<div style="float:left; width:55px; height: auto; position:relative; left:5px; top:30px; font-weight:bold;"> (ঘ) ভাতা</div>
	<div style="float: left; width:240px; border-left:1px solid #000000;" > 
	  <table width="240">
	 
	<tr>
	  	<td width="154">হাজিরা বোনাস</td>
	  	<td>:</td>
		<td width="70" align="center"> <font style="font-family: SutonnyMJ;"><?php echo $att_bonus = $rows["att_bonus"];   ?></font> </td>
	</tr>
	

	  
	  <tr>
	  	<td width="154">অন্যান্য</td>
	  	<td>:</td>
		<td width="70" align="center"> <font style="font-family: SutonnyMJ;" > <?php echo $others_allaw = $rows["others_allaw"];   ?> </font>  </td>
	</tr>
	  
	  
	 <tr>
	  	<td width="154">মোট ভাতা </td>
	  	<td>:</td>
		<td width="70" align="center"> <font style="font-family: SutonnyMJ;"><?php echo $total_allaw = $rows["total_allaw"];   ?> </td>
	</tr>
	
  </table>
	
	</div>
	</div>
	
	<div style="border-bottom:1px solid #000000;"><table width="298" cellspacing="0" cellpadding="0">
    <tr>
      <td width="239"><span style="position:relative; left:5px; font-weight:bold;"> (ঙ) ওভার টাইম</span> 
      </td><td width="38"> 
	  <span style="font-family: SutonnyMJ; " > <?php echo $ot_amount = $rows["ot_amount"];   ?> </span>
	  </td>
    </tr></table></div>
	<?php $gross_pay = $pay_wages + $ot_amount + $att_bonus  ; ?>
	<div style="border-bottom:1px solid #000000;"><table width="298">
    <tr>
      <td width="243"><span style="position:relative; left:2px; font-weight:bold;"> (চ) মোট বেতন</span> &nbsp;(&#2455; + &#2456; + &#2457; ) 
      <td width="43"><font style="font-family: SutonnyMJ;" > <?php echo $gross_pay;   ?> </font></td>
    </tr></table></div>
	
	<div style="width:100%; border-bottom:1px solid #000000; height:auto; overflow:hidden;">
	
	<div style="float:left; width:53px; position:relative; left:5px; top:25px; font-weight:bold;">(&#2459;) &#2453;&#2480;&#2509;&#2468;&#2472; </div>
	<div style="float: left; width:240px; border-left:1px solid #000000;" > 
	  <table width="237">
	  
	<tr> 
	  	<td width="152"> &#2437;&#2455;&#2509;&#2480;&#2496;&#2478; </td>
	  	<td >:</td>
		<td width="59" align="center"> <font style="font-family: SutonnyMJ;" > <?php echo $adv_deduct = $rows["adv_deduct"];   ?> </font></td>
	</tr>
	  
	  <tr>
	  	<td width="152">&#2437;&#2472;&#2509;&#2479;&#2494;&#2472;&#2509;&#2479;</td>
	  	<td >:</td>
		<td width="59" align="center"> <font style="font-family: SutonnyMJ;" > <?php echo $others_deduct = $rows["others_deduct"];   ?> </font></td>
	</tr>
	  
	  <tr>
	  	<td width="152">&#2474;&#2509;&#2480;&#2477;&#2495;&#2465;&#2503;&#2472;&#2509;&#2463; &#2475;&#2494;&#2472;&#2509;&#2465; </td>
	  	<td >:</td>
		<td width="59" align="center"> <font style="font-family: SutonnyMJ;" > <?php echo $provident_fund = $rows["provident_fund"];   ?> </font></td>
	</tr>
	
	 <tr>
	  	<td width="152">&#2478;&#2507;&#2463; &#2453;&#2480;&#2509;&#2468;&#2472; </td>
	  	<td >:</td>
		<td width="59" align="center"> <font style="font-family: SutonnyMJ;" > <?php echo $total_deduct = $rows["total_deduct"];   ?> </font></td>
	</tr>
	
  </table>
	
	</div>
	</div>
	<?php $net_pay = $gross_pay - $adv_deduct; ?>
	
	<div><table width="295" height="17" cellspacing="0" cellpadding="0">
    <tr>
      <td width="215">&#2488;&#2480;&#2509;&#2476;&#2478;&#2507;&#2463; &#2474;&#2509;&#2480;&#2470;&#2503;&#2527;  (&#2458;- &#2459; ) 
      <td >:</td>
	  <td width="78" align="center"> <font style="font-family: SutonnyMJ;" > <?php echo $net_pay;   ?> </font></td>
    </tr></table></div>
  </div>
  <div style="text-align:left; font-size:14px; padding-top:15px;">Employee Signature :</div>
</div>
</div>
	<?php echo "</td>"; ?>


<?php
	echo "</tr>";
}
?>
</tr>
</table>

</body>
</html>
