<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>EOT Summary||MSHL</title>
<link rel="stylesheet" type="text/css" href="../../../../../../css/print.css" media="print" />

<style type="text/css">
.sal tr td{
border:1px #000000 solid;
border-top-style:none;
border-left-style:none;
padding-right:2px;

}
.sal{
border:1px #000000 solid;
   border-bottom-style: none;
   border-right-style: none;
   }
   
.det tr td{
border:1px #000000 solid;
border-top-style:none;
border-left-style:none;

}
.det{
border:1px #000000 solid;
   border-bottom-style: none;
   border-right-style: none;
   }
</style>
</head>

<body>
<div style="width:auto; ">
<?php 
$this->load->view("head_english"); 

$this->load->model('grid_model');



?>
<div style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif; width:100%; ">
	<div  style="font-size:13px; font-weight:bold; text-align:center; width:100%;">
		Monthly Salary Summary with OT and EOT of 
		<?php 
			// $date = $first_date;
			// $year=trim(substr($date,0,4));
			// $month=trim(substr($date,5,2));
			// $date_format = date("F-Y", mktime(0, 0, 0, $month, 1, $year));
			echo date('d M Y',strtotime($first_date)).' to '.date('d M Y',strtotime($second_date));

		?>
	</div>
	<br/>
<table class="sal" border="1" cellspacing="0" cellpadding="0" style="font-size:12px; width: 900px; margin: 0 auto;">

  <tr align="center" style="font-weight:bold;">
    <td>SI</td>
    <td>Line No</td>
    <td>M.Power</td>
    <td>Wages</td>
    <!-- <td>Attn. Bonus</td> -->
    <td>5 to 7 OT Hours</td>
    <td>5 to 7 OT Amount</td>
    <td>7 to Above EOT Hours</td>
    <td>7 to Above EOT Amount</td>
    <td>Total OT and EOT Amount</td>
    <td>Total Deduct</td>
    <td>Grand Total</td>
  </tr>
 	<?php
		$s_total = 0;
		$g_total_emp = 0;
		$g_total_wgs = 0;
		$g_total_bns = 0;
		$g_total_ot_hr = 0;
		$g_total_ot_amt = 0;
		$g_total_eot_hr = 0;
		$g_total_eot_amt = 0;
		$g_total_ot_eot_amt = 0;
		$g_total_deduct_amt = 0;
		$g_total_amt = 0;
		$ot_eot_amt=0;
		$g_total=0;
		$abs_deduction_cash=0;
		$i = 1;
        // echo "<pre>";print_r($values);exit;
		//  [line_id] => 17
        //     [line_name] => Cutting
        //     [t_wages] => 1074899
        //     [t_emp] => 68
		foreach ($values as $row){
			$data =$this->grid_model->summary_date_between($first_date,$second_date,$row->line_id);
			// echo "<pre>"; print_r($data); exit();


			if(isset($row->t_emp) == 0 || $row->line_name == "Line No- 09" || $row->line_name == "Store Loder" || $row->line_name=="Wash Loder" ){
				continue;
			}
			// echo "<pre>"; print_r($data); exit();

			
			?>
			</tr>

			<td align='right'><?php echo $i++; ?></td>

			<td align='center'><?php echo $row->line_name; ?></td>

			<td align='center'><?php echo isset($row->t_emp) ? $row->t_emp : 0; ?></td>

			<?php 
			$per_day_sal = isset($row->t_wages) ? $row->t_wages / date('t', strtotime($second_date)) : 0;

			$first_date_obj = new DateTime($first_date);
			$second_date_obj = new DateTime($second_date);
			$date_diff = $second_date_obj->diff($first_date_obj);
			$total_day = $date_diff->format("%a") + 1;
			?>

			<td align='center'>
				<?php 
					$wages = isset($row->t_wages) ? $row->t_wages : 0; 
					$g_total_wgs = $g_total_wgs + $wages;
					echo $wages;
				?>
			</td>

			<!-- <td align='right'></td> -->

			<td align='right'>
				<?php 
					$ot = isset($data->t_ot) ? $data->t_ot : 0; 
					$g_total_ot_hr = $g_total_ot_hr + $ot;
					echo $ot;
				?>
			</td>

			<td align='right'>
				<?php 
					$ot_amount = round((($row->t_wages - ($row->t_emp * 2450)) / 1.5 / 104)/$row->t_emp, 2); 
					$ot		   = isset($data->t_ot) ? round($ot_amount*$data->t_ot,2) : 0; 
					$g_total_ot_amt = $g_total_ot_amt + $ot;
					echo $ot;
				?>
			</td>

			<td align='right'>
				<?php 
					$eot = isset($data->t_eot) ? $data->t_eot : 0; 
					$g_total_eot_hr = $g_total_eot_hr + $eot;
					echo $eot;
				?>
			</td>

			<td align='right'>
				<?php 
					$eot_amount	= round((($row->t_wages - ($row->t_emp * 2450)) / 1.5 / 104)/$row->t_emp, 2);
					$eot= isset($data->t_eot) ? round($eot_amount*$data->t_eot,2): 0;
					$g_total_eot_amt = $g_total_eot_amt + $eot; 
					echo $eot;
				?>
			</td>

			<td align='right'>
				<?php
					$total = $g_total_ot_amt + $g_total_eot_amt;
					$g_total = $g_total + $total;
					echo $total;
				?>	
			</td>

			<td align='right'>
				<?php 
					$deduction = isset($data->deduction) ? $data->deduction : 0; 
					$g_total_deduct_amt = $g_total_deduct_amt + $deduction;
					echo $deduction;
				?>
			</td>
			<td align='right'>
				<?php 
					// echo isset($data->t_wages) ? $data->t_wages : 0; 
					$total = $g_total_ot_amt + $g_total_eot_amt;
					$g_total_amt = $g_total_amt + $total;
					echo $total;
				?>
			</td>
			</tr>
		<?php } ?>	
		<tr style='font-weight:bold;'>
			<td colspan='2' align='center'>Total</td>
			<td align='center'><?php echo number_format($g_total_emp); ?></td>
			<td align='center'><?php echo number_format($g_total_wgs); ?></td>
			<!-- <td align='right'>< ?php echo number_format($g_total_bns); ?></td> -->
			<td align='right'><?php echo number_format($g_total_ot_hr); ?></td>
			<td align='right'><?php echo number_format($g_total_ot_amt); ?></td>
			<td align='right'><?php echo number_format($g_total_eot_hr); ?></td>
			<td align='right'><?php echo number_format($g_total_eot_amt); ?></td>
			<td align='right'><?php echo number_format($g_total); ?></td>
			<td align='right'><?php echo number_format($g_total_deduct_amt); ?></td>
			<td align='right'><?php echo number_format($g_total_amt); ?></td>
		</tr>
	</table>
	<br>
</div>
</div>
</body>
</html>

