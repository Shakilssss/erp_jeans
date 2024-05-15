<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/SingleRow.css" />

</head>

<body>
	<div style=" margin:0 auto;  width:800px;">
		<div id="no_print" style="float:right;"> </div>
		<?php  $this->load->view("head_english");  ?>

		<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
			<span style="font-size:13px; font-weight:bold;"><?php echo $title; ?> of <?php echo $report_date; ?></span>
			<br /> <br />

			<table class="sal" border="1" cellpadding="0" cellspacing="0" align="center" style="font-size:12px;">
				<tr>
					<th style="padding: 5px">SL</th>
					<th style="padding: 5px"><?php echo $category; ?> Name</th>
					<th style="padding: 5px">Total Employee</th>
					<th style="padding: 5px">Salary</th>
					<th style="padding: 5px">OT MP</th>
					<th style="padding: 5px">OT Hour</th>
					<th style="padding: 5px">OT Amt</th>
					<th style="padding: 5px">EOT MP</th>
					<th style="padding: 5px">EOT Hour</th>
					<th style="padding: 5px">EOT Amt</th>
					<th style="padding: 5px">Ot & Eot</th>
					<th style="padding: 5px">Total Amt</th>
				</tr>
				<?php
					$all_emp 	= 0;
					$all_salary = 0;

					$tot_mp  	= 0;
					$ot_total	= 0;
					$ot_amt  	= 0;
					$tot_amt  	= 0;


					$teot     	= 0;
					$eot_total	= 0;
					$eot_amt 	= 0;
					$teot_amt 	= 0;

					$tot_ot_eot = 0;
					$total_amt  = 0;

					foreach ($values as $key => $r) { ?>
						<tr> 
							<?php  
								if ($r->total_emp != 0) {
									$allow = (750 + 450 + 1250) * $r->ot_emp;
									$salary = round((($r->total_salary) / date('t')), 2); 
								} else {
									$salary = 0;
								}	

								if ($r->ot_emp != 0) {
									$allow = (750 + 450 + 1250) * $r->ot_emp;
									$basic_salary = ((($r->ot_salary - $allow) / 1.5) / $r->ot_emp); 
									$ot_rate = round(($basic_salary * 2  / 208),2); 
								} else {
									$ot_rate = 0;
								}								

								if ($r->eot_emp != 0) {
									$allows = (750 + 450 + 1250) * $r->eot_emp;
									$ebasic_salary = ((($r->eot_salary - $allows) / 1.5) / $r->eot_emp); 
									$eot_rate = round(($ebasic_salary * 2  / 208),2); 
								} else {
									$eot_rate = 0;
								}

							?>

							<td style="padding: 5px" ><?php echo $key+1; ?></td>
							<td style="padding: 5px" ><?php echo $r->line_name; ?></td>
							<td style="padding: 5px" ><?php echo $r->total_emp; ?></td>
							<td style="padding: 5px" ><?php echo $salary; ?></td>
							<td style="padding: 5px" ><?php echo $r->ot_emp; ?></td>
							<td style="padding: 5px" ><?php echo $r->total_ot; ?></td>
							<td style="padding: 5px" ><?php echo $ot_amt = ($r->total_ot * $ot_rate); ?></td>

							<td style="padding: 5px" ><?php echo $r->eot_emp; ?></td>
							<td style="padding: 5px" ><?php echo $r->total_eot; ?></td>
							<td style="padding: 5px" ><?php echo $eot_amt = ($r->total_eot * $eot_rate); ?></td>

							<td style="padding: 5px" ><?php echo $r->total_ot + $r->total_eot; ?></td>
							<td style="padding: 5px" ><?php echo $ot_amt + $eot_amt + $salary; ?></td>

							<?php 
								$all_emp = $all_emp + $r->total_emp;
								$all_salary = $all_salary + $salary;
								$tot_mp = $tot_mp + $r->ot_emp; 
								$ot_total = $ot_total + $r->total_ot; 
								$tot_amt = $tot_amt + $ot_amt; 

								$teot = $teot + $r->eot_emp; 
								$eot_total = $eot_total + $r->total_eot; 
								$teot_amt = $teot_amt + $eot_amt; 

								$tot_ot_eot = $tot_ot_eot + $r->total_ot + $r->total_eot; 
								$total_amt = $total_amt + $all_salary + $ot_amt + $eot_amt; 
							?>

						</tr>

				<?php } ?>

				<tr style="font-weight:bold; text-align:center;">
					<td colspan="2">Total</td>
					<td style="padding: 5px" ><?php echo $all_emp; ?></td>
					<td style="padding: 5px" ><?php echo $all_salary; ?></td>

					<td style="padding: 5px" ><?php echo $tot_mp; ?></td>
					<td style="padding: 5px" ><?php echo $ot_total; ?></td>
					<td style="padding: 5px" ><?php echo $tot_amt; ?></td>


					<td style="padding: 5px" ><?php echo $teot; ?></td>
					<td style="padding: 5px" ><?php echo $eot_total; ?></td>
					<td style="padding: 5px" ><?php echo $teot_amt; ?></td>

					<td style="padding: 5px" ><?php echo $tot_ot_eot; ?></td>
					<td style="padding: 5px" ><?php echo $total_amt; ?></td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>
