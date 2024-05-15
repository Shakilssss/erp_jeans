<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Tiffin Report</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />
</head>

	<body>
		<?php  
			$row_count=count($values);
			if($row_count > 20)
			{
				$page = ceil($row_count/20);
			} else {
				$page=1;
			}
			$k = 0; 
			$grand_total_night = 0;
			$grand_total_amount = 0;
		?>
				
		<?php for ( $counter = 1; $counter <= $page; $counter ++) { ?>

			<div style=" margin:0 auto;  width:900px;">
				<?php  $this->load->view("head_english");  ?>
				<!--Report title goes here-->
				<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
					<span style="font-size:12px; font-weight:bold;">Tiffin Report of <?php echo "$start_date to $end_date"; ?></span>
					<br />
					<br />

					<style type="text/css">
						.sal tr th {
							padding: 4px;
						}
						.sal tr td {
							padding: 20px 5px;
						}
					</style>

					<table width="100%" class="sal" border="1" cellpadding="0" cellspacing="0" align="center" style="font-size:12px;">
						<tr>
							<th>SL</th>
							<th>Emp ID</th>
							<th>Employee Name</th>
							<th>Designation</th> 
							<th>line</th> 
							<th>Total Night</th> 
							<th>Rate</th> 
							<th>Amount</th> 
							<th style='width: 120px'>Signature</th> 
						</tr>

						<?php if($counter == $page)
					  	{
					   		$modulus = ($row_count-1) % 20;
					    	$per_page_row=$modulus;
						}
					   	else
					   	{
					    	$per_page_row=19;
					   	}
						$total_night = 0;
						$total_amount = 0;
						$rate = 0;
						$amount = 0;

						for($p=0; $p<=$per_page_row;$p++) { ?> 
		 					<tr>
								<td><?= $k+1 ?></td>
								<td style='text-align:left;'> <?= $values[$k]->emp_id ?></td>
								<td style='text-align:left;'><?= $values[$k]->emp_full_name ?></td>
								<td style='text-align:left;'><?= $values[$k]->desig_name ?></td>
								<td style='text-align:left;'><?= $values[$k]->line_name ?></td>
								<?php 
									$check_id = substr($values[$k]->emp_id, 0, 2);
									if ($check_id == "PS") {
										$rate = 150;
									} else {
										$rate = 40;
									}
									$total_night = $total_night + $values[$k]->total_night;
									$total_amount = $total_amount + ($rate * $values[$k]->total_night);
								?>
								<td style='text-align:center;'><?= $values[$k]->total_night ?></td>
								<td style='text-align:center;'><?= $rate ?></td>
								<td style='text-align:center;'><?= ($rate * $values[$k]->total_night) ?></td>
								<td  style='width: 120px'></td>
							</tr>
						<?php $k++; } ?>
						<?php 
							$grand_total_night = $grand_total_night + $total_night;
							$grand_total_amount = $grand_total_amount + $total_amount;
						?>
						<tr>
							<th  colspan="5" style="text-align:right; font-weight:bold;" >Total Per Page</th>
							<th style="text-align:center; font-weight:bold;" ><?php echo $total_night; ?></th>
							<th colspan="2" style="text-align:center; font-weight:bold;" ><?php echo number_format($total_amount); ?></th>
							<th></th>
						</tr>
						<?php if($counter == $page) {?>
						<tr>
							<th  colspan="5" style="text-align:right; font-weight:bold;" >Grand Total</th>
							<th style="text-align:center; font-weight:bold;" ><?php echo $grand_total_night; ?></th>
							<th colspan="2" style="text-align:center; font-weight:bold;" ><?php echo number_format($grand_total_amount); ?></th>
							<th></th>
						</tr>
						<?php } ?>
					<table width="100%" height="80px" border="0" align="center" style="margin-bottom:50px; font-family:Arial, Helvetica, sans-serif; font-size:14px;">
						<tr height="80%" >
						<td colspan="28"></td>
						</tr>
						<tr height="20%">
						<td style="font-size: 10px" align="center">Prepared By (HRM Dept.)</td>
						<td style="font-size: 10px" align="center">Checked BY (Account Dept.)</td>
						<td style="font-size: 10px" align="center">Auditor</td>
						<td style="font-size: 10px" align="center">GM (Production)</td>
						<td style="font-size: 10px" align="center">Manager(Admin & HRM)</td>
						<td style="font-size: 10px" align="center">Authorized By</td>
						</tr>
						
						</table>
					</table>
				</div>
			</div>
		<?php } ?>
	</body>
</html>