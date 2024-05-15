<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>
			<?php if($grid_status == 1)
			{ echo 'Reguler Employee '; }
			elseif($grid_status == 2)
			{ echo 'New Employee '; }
			elseif($grid_status == 3)
			{ echo 'Left Employee '; }
			elseif($grid_status == 4)
			{ echo 'Resign Employee '; }
			elseif($grid_status == 6)
			{ echo 'Promoted Employee '; }
			?>Monthly EOT Sheet of 
			<?php echo date("F-Y", strtotime($salary_month)); ?>
		</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />
	</head>

	<body style="width:800px;">
		<?php $row_count=count($value);
			if($row_count > 20) {
				$page = ceil($row_count/20);
			} else {
				$page=1;
			}

			$k = 0;
			$grant_ot_rate = 0;
			$grand_total_ot_hour = 0;
			$grand_total_ot = 0;

		?>

			<table align="center" height="auto"  class="sal" border="1" cellspacing="0" cellpadding="0" style="font-size:12px; width:auto;">
				<tr height="85px">
					<td colspan="11" align="center">
						<div style="text-align:right; position:relative; top:20px; padding-left:10px;font-weight:bold;">
							<?php echo "Page No # 1 of 1"; ?>
						</div>
					 
						<?php $this->load->view("head_english"); ?>
						<?php if($grid_status == 1)
						{ echo 'Reguler Employee '; }
						elseif($grid_status == 2)
						{ echo 'New Employee '; }
						elseif($grid_status == 3)
						{ echo 'Left Employee '; }
						elseif($grid_status == 4)
						{ echo 'Resign Employee '; }
						elseif($grid_status == 6)
						{ echo 'Promoted Employee '; }
						?>Monthly EOT Sheet of 
						<?php echo date("F-Y", strtotime($salary_month)); ?>
					</td>
				</tr>
				<tr height="20px">
				    <th  width="25" ><div align="center"><strong>SI. No</strong></div></th>
					<th width="80" ><div align="center"><strong>Card No</strong></div></th>
				    <th width="240" ><div align="center"><strong>Name of Employee</strong></div></th>
					<th width="120" ><div align="center"><strong>Line</strong></div></th>
				    <th width="120" ><div align="center"><strong>Designation</strong></div></th>
				    <th width="100" ><div align="center"><strong>Joining Date</strong></div></th>
				    <th width="80" ><div align="center"><strong>Account</strong></div></th>
				    <th width="60" ><div align="center"><strong>EOT Hrs</strong></div></th>
				    <th width="60" ><div align="center"><strong>EOT Rate</strong></div></th>
				    <th width="60" ><div align="center"><strong>EOT Amt</strong></div></th>
		        	<th width="200" height="20px"><div align="center"><strong>Signature</strong></div></th>
		        </tr>
				<?php 
				for ( $counter = 1; $counter <= $page; $counter ++) {

				if($counter == $page)
			  	{
			   		$modulus = ($row_count-1) % 20;
			    	$per_page_row=$modulus;
				} else {
			    	$per_page_row=19;
			   	}
	  	
				$total_ot_hour = 0;
				$per_page_ot_rate = 0;
				$per_page_number = 0;
				$total_ot_amount = 0;
		
				for($p=0; $p<=$per_page_row;$p++)
				{
					echo "<tr height='45' style='text-align:center;' >";
						echo "<td >";
						echo $k+1;
						echo "</td>";

						echo "<td>";
						echo $value[$k]->emp_id;
						echo "</td>";
						
						echo "<td>";
						echo $value[$k]->emp_full_name;
						echo '<br>';
						if($grid_status == 4)
						{
							$resign_date = $this->grid_model->get_resign_date_by_empid($value[$k]->emp_id);
							if($resign_date != false){
							echo $resign_date = date('d-M-y', strtotime($resign_date));}
						}
						elseif($grid_status == 3)
						{
							$left_date = $this->grid_model->get_left_date_by_empid($value[$k]->emp_id);
							if($left_date != false){
							echo $left_date = date('d-M-y', strtotime($left_date));}
						}
						echo "</td>"; 

						echo "<td>";
						echo $value[$k]->line_name;
						echo "</td>";
								
						echo "<td>";
						echo $value[$k]->desig_name;
						echo "</td>";
						
						echo "<td>";
						echo date("d-M-y", strtotime($value[$k]->emp_join_date));
						echo "</td>";

						echo "<td>";
						echo $value[$k]->mobile;
						echo "</td>";
	
						echo "<td>";
						echo $value[$k]->eot_hour;
						echo "</td>";
						
						$total_ot_hour = $total_ot_hour + $value[$k]->eot_hour; 
						$grand_total_ot_hour = $grand_total_ot_hour + $value[$k]->eot_hour; 
						
						echo "<td>";
						echo $value[$k]->ot_rate;
						echo "</td>";
						
						echo "<td>";
						echo $eot_amount = round($value[$k]->eot_hour * $value[$k]->ot_rate);
						echo "</td>";

						$per_page_ot_rate = $value[$k]->ot_rate + $per_page_ot_rate;
						$grant_ot_rate = $grant_ot_rate + $value[$k]->ot_rate;
						
						$total_ot_amount = $total_ot_amount + $eot_amount;
						$grand_total_ot = $grand_total_ot + $eot_amount;
						
						echo "<td>";
						echo "&nbsp;";
						echo "</td>";
							
					echo "</tr>"; 
					$k++;
					$per_page_number++;
				} ?>
				<!-- <tr>
					<td align="center" colspan="7"><strong>Total Per Page</strong></td>
					<td align="left"><strong><?php echo number_format($total_ot_hour);?></strong></td>
			        <td><?= round($per_page_ot_rate / $per_page_number, 2)?></td>
					<td colspan="2" align="left"><strong><?php echo number_format($total_ot_amount);?></strong></td>
				</tr> -->
				<?php // if($counter == $page) { ?>
					<!-- <tr height="10">
						<td colspan="7" align="center"><strong>Grand Total Amount Tk</strong></td>
			            <td align="left"><strong><?php echo number_format($grand_total_ot_hour);?></strong></td>
			            <td><?= round($grant_ot_rate / $k, 2) ?></td>
			            <td colspan="2" align="left"><strong><?php echo number_format($grand_total_ot);?></strong></td>
					</tr> -->
				<?php // } ?>

		<?php } ?>
			<tr height="10">
				<td colspan="7" align="center"><strong>Grand Total Amount Tk</strong></td>
	            <td align="left"><strong><?php echo number_format($grand_total_ot_hour);?></strong></td>
	            <td><?= round($grant_ot_rate / $k, 2) ?></td>
	            <td colspan="2" align="left"><strong><?php echo number_format($grand_total_ot);?></strong></td>
			</tr>
			</table>

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
					<td style="font-size: 10px" align="center">Authorized By </td>
				</tr>
			</table>
	</body>
</html>