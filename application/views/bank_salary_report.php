<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>

			<?php 
				if($grid_status == 1)
				{ echo 'Reguler Employee '; }
				elseif($grid_status == 2)
				{ echo 'New Employee '; }
				elseif($grid_status == 3)
				{ echo 'Left Employee '; }
				elseif($grid_status == 4)
				{ echo 'Resign Employee '; }
				elseif($grid_status == 6)
				{ echo 'Promoted Employee '; }
			?>Monthly Salary Sheet of 
			<?php	echo $date_format = date("F-Y", strtotime($salary_month)); ?>
		</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />
	</head>
	<body>

		<?php $row_count=count($value);
			if($row_count >20)
			{
				$page=ceil($row_count/20);
			}
			else
			{
				$page=1;
			}

			$k = 0;

			$grand_total_net_wages		= 0;
		?>
			<table align="center"  height="auto"  class="sal" border="1" cellspacing="0" cellpadding="0" style="font-size:12px; width:auto;">
				<tr height="85px">
					<?php if($deduct_status == "Yes"){?> 
						<td colspan="37" align="center">
					<?php }else{ ?>
						<td colspan="36" align="center">
					<?php } ?>

					<div style="text-align: right; position: relative; top: 33px; padding-left: 10px; font-weight: bold; padding-right: 10px;">
					<?php // echo "Page No # $counter of $page"; ?>
					</div>
					 
					<?php $this->load->view("head_english"); ?>
					<?php 
						if($grid_status == 1)
						{ echo 'Reguler Employee '; }
						elseif($grid_status == 2)
						{ echo 'New Employee '; }
						elseif($grid_status == 3)
						{ echo 'Left Employee '; }
						elseif($grid_status == 4)
						{ echo 'Resign Employee '; }
						elseif($grid_status == 6)
						{ echo 'Promoted Employee '; }
					?>Monthly Salary Sheet of 
					<?php echo $date_format = date("F-Y", strtotime($salary_month)); ?>
					</td>
				</tr>

			  <tr height="20px">
			    <td  width="25" ><div align="center"><strong>SI. No</strong></div></td>
				<td width="80" ><div align="center"><strong>Card No</strong></div></td>
			    <td width="240" ><div align="center"><strong>Name of Employee</strong></div></td>
				<td width="120" ><div align="center"><strong>Line</strong></div></td>
			    <td width="120" ><div align="center"><strong>Designation</strong></div></td>
			    <td width="100" ><div align="center"><strong>Joining Date</strong></div></td>
			    <td width="80" ><div align="center"><strong>Account</strong></div></td>
			    <td width="60" ><div align="center"><strong>Pay Amount</strong></div></td>
				<td width="200"><div align="center"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></div></td>
			  </tr>
			<?php for ( $counter = 1; $counter <= $page; $counter ++) { ?>

				<?php
					if($counter == $page)
				  	{
				   		$modulus = ($row_count-1) % 20;
				    	$per_page_row=$modulus;
					}
			   	else
			   	{
			    	$per_page_row=19;
			   	}
			  	
	 		   	$total_net_wages	= 0;
				
					for($p=0; $p<=$per_page_row;$p++)
					{
						echo "<tr height='40' style='text-align:center;' >";
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

						$ot_amount = round($value[$k]->ot_hour * $value[$k]->ot_rate);
						$pay_wages 			= $value[$k]->pay_wages; 
						$att_bonus 			= $value[$k]->att_bonus; 
						$adv_deduct 		= $value[$k]->adv_deduct; 
						$deduct_amount 	= $value[$k]->deduct_amount; 


						$net_wages = $pay_wages + $att_bonus - $adv_deduct - $deduct_amount + $ot_amount;
						$total_net_wages = $total_net_wages + $net_wages;
						$grand_total_net_wages = $grand_total_net_wages + $net_wages;
												

						echo "<td>";
						print_r($net_wages);
						echo "</td>";

						echo "<td>";
						echo "&nbsp;";
						echo "</td>";
							
						echo "</tr>"; 
						$k++;
					} 
				?>
				<!-- <tr>
					<td align="center" colspan="7"><strong>Total Per Page</strong></td>
	        		<td colspan="2" align="left"><strong><?php echo number_format($total_net_wages);?></strong></td>
				</tr> -->

				<?php if($counter == $page) {?>
					<!-- <tr height="10">
						<td colspan="7" align="center"><strong>Grand Total Amount Tk</strong></td>
			      <td colspan="2" align="left"><strong><?php echo number_format($grand_total_net_wages);?></strong></td>
					</tr> -->
				<?php } ?>
				<!-- <table width="100%" height="80px" border="0" align="center" style="margin-bottom:50px; font-family:Arial, Helvetica, sans-serif; font-size:14px;"> -->
				<!-- <tr height="80%" >
				<td colspan="28"></td>
				</tr>
				<tr height="20%">
				<td style="font-size: 10px" align="center">Prepared By (HRM Dept.)</td>
				<td style="font-size: 10px" align="center">Checked BY (Account Dept.)</td>
				<td style="font-size: 10px" align="center">Auditor</td>
				<td style="font-size: 10px" align="center">GM (Production)</td>
				<td style="font-size: 10px" align="center">Manager(Admin & HRM)</td>
				<td style="font-size: 10px" align="center">Authorized By</td>
				</tr> -->
				<!-- </table> -->
		<?php } ?>
				<tr height="10">
					<td colspan="7" align="center"><strong>Grand Total Amount Tk</strong></td>
			      	<td colspan="2" align="left"><strong><?php echo number_format($grand_total_net_wages);?></strong></td>
				</tr>
			</table>
		<div>
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
		</div>
	</body>
</html>