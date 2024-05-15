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
				.sal tr.line td {
				    text-align:  center;
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
		<div style=" margin:0 auto;  width:1300px;">
			<div id="no_print" style="float:right;"> </div>
		    <?php  $this->load->view("head_english");  ?>

		    <div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
			  	<span style="font-size:13px; font-weight:bold;"> <?php echo $title; ?> of <?php echo $report_date; ?></span>
			  	<br />
			    <br />
			    <table class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:12px; width:99%;">
				    <tr style="font-weight:bold;text-align:center; background:#C1E0FF;">
				        <td rowspan="2">SL</td>
				        <td rowspan="2" style="width:120px;"><?php echo $category; ?> Name</td>
				        <td rowspan="2">Total Employee</td>
				        <td rowspan="2">Total Present</td>
				        <td rowspan="2">Total Absent</td>
				        <td rowspan="2">Total Leave</td>
				        <td colspan="3">Operator</td>
				        <td colspan="3">Helper</td>
				        <td colspan="3">QC</td>
				        <td colspan="3">Ironman</td>
				        <td colspan="3">Finishing Packing</td>
				        <td colspan="3">Staff</td>
				        <td colspan="3">Dsigner</td>
				    </tr>
				    <tr style="font-weight:bold; text-align:center;background:#e6ccf1;">
				        <td style="width:40px;background:#C1E0FF">Total</td>
				        <td style="width:40px;background:#C1E0FF">Present</td>
				        <td style="width:40px;background:#C1E0FF">Absent</td>
				        
				        <td style="width:40px">Total</td>
				        <td style="width:40px">Present</td>
				        <td style="width:40px">Absent</td>
				        
						<td style="width:40px; background:#C1E0FF">Total</td>
				        <td style="width:40px; background:#C1E0FF">Present</td>
				        <td style="width:40px; background:#C1E0FF">Absent</td>
				        
				        <td style="width:40px">Total</td>
				        <td style="width:40px">Present</td>
				        <td style="width:40px">Absent</td>
				        
				        <td style="width:40px; background:#C1E0FF">Total</td>
				        <td style="width:40px; background:#C1E0FF">Present</td>
				        <td style="width:40px; background:#C1E0FF">Absent</td>
				        
				        <td style="width:40px">Total</td>
				        <td style="width:40px">Present</td>
				        <td style="width:40px">Absent</td>
				        
				        <td style="width:40px; background:#C1E0FF">Total</td>
				        <td style="width:40px; background:#C1E0FF">Present</td>
				        <td style="width:40px; background:#C1E0FF">Absent</td>
				    </tr>
			        <?php
						$total_emp 	 = 0;
						$total_prev  = 0;

						$total_present = 0;
						$total_prev_present = 0;

						$total_absent = 0;
						$total_prev_absent  = 0;

						$total_leave = 0;
						$total_leave_prev = 0;

						$staff  = 0;
						$operator  = 0;
						$helper  = 0;
						$ironman  = 0;
						$qc  = 0;
						$designer  = 0;
						$finishing_packing  = 0;

						$staff_p  = 0;
						$operator_p  = 0;
						$helper_p  = 0;
						$ironman_p  = 0;
						$qc_p  = 0;
						$designer_p  = 0;
						$finishing_packing_p  = 0;

						$staff_a  = 0;
						$operator_a  = 0;
						$helper_a  = 0;
						$ironman_a  = 0;
						$qc_a  = 0;
						$designer_a  = 0;
						$finishing_packing_a  = 0;

						$line_array = array(1,2,3,5,6,7,8,9,10,20,23,33,36,37,19);
						$line_emp = 0;
						$line_operator = 0;
						$line_helper = 0;
						$line_qc = 0;
						$line_ironman = 0;
						$line_staff = 0;						

						$line_number = 0;
						$line_operator_p = 0;
						$line_helper_p = 0;
						$line_qc_p = 0;
						$line_ironman_p = 0;
						$line_staff_p = 0;

						$line_operator_a = 0;
						$line_helper_a = 0;
						$line_qc_a = 0;
						$line_ironman_a = 0;
						$line_staff_a = 0;
					?>
					<?php foreach ($values as $key => $row) {  $row = (object) $row; ?>
						<?php 
							if (in_array($row->line_id, $line_array)) {
								$line_number = $line_number + 1;
								$line_emp = $row->total_emp + $line_emp;

								$line_operator = $line_operator + $row->operator;
								$line_operator_p = $line_operator_p + $row->operator_p;
								$line_operator_a = $row->operator - $row->operator_p - $row->operator_l + $line_operator_a;

								$line_helper = $line_helper + $row->helper;
								$line_helper_p = $line_helper_p + $row->helper_p;
								$line_helper_a = $row->helper - $row->helper_p - $row->helper_l + $line_helper_a;

								$line_qc = $line_qc + $row->qc;
								$line_qc_p = $line_qc_p + $row->qc_p;
								$line_qc_a = $row->qc - $row->qc_p - $row->qc_l + $line_qc_a;

								$line_ironman = $line_ironman + $row->ironman;
								$line_ironman_p = $line_ironman_p + $row->ironman_p;
								$line_ironman_a = $row->ironman - $row->ironman_p - $row->ironman_l + $line_ironman_a;

								$line_staff = $line_staff + $row->staff;
								$line_staff_p = $line_staff_p + $row->staff_p;
								$line_staff_a = $row->staff - $row->staff_p - $row->staff_l + $line_staff_a;
							}
						?>
					    <tr class="line">
					        <td style="background:#C1E0FF"><?php echo $key; ?></td>
					        <td>
					        	<?php echo $row->line_name; ?>
				        	</td>

					        <td style="background:#C1E0FF">
					        	<?php 
					        		echo $row->total_emp; 
					        		$total_emp = $total_emp + $row->total_emp;
					        	?>
				        	</td>
					        <td>
					        	<?php 
					        		echo $row->total_present; 
					        		$total_present = $total_present + $row->total_present;
					        	?>
					        </td>
					        <td style="background:#C1E0FF">
					        	<?php 
					        		echo $row->total_absent;
					        		$total_absent = $row->total_absent + $total_absent; 
					        	?>
					        </td>
					        <td>
					        	<?php 
					        		echo $row->total_leave;
					        		$total_leave = $total_leave + $row->total_leave; 
					        	?>
					        </td>

					        <td style="background:#C1E0FF">
					        	<?php 
					        		echo $row->operator;
					        		$operator = $row->operator + $operator; 
					        	?>
					        </td>
					        <td style="background:#C1E0FF">
					        	<?php 
					        		echo $row->operator_p; 
					        		$operator_p = $row->operator_p + $operator_p;
					        	?>
					        </td>
					        <td style="background:#C1E0FF">
					        	<?php 
					        		echo $row->operator - $row->operator_p - $row->operator_l;
					        		$operator_a = $row->operator - $row->operator_p - $row->operator_l + $operator_a;
					        	?>
					        </td>

					        <td>
					        	<?php 
					        		echo $row->helper; 
					        		$helper = $row->helper + $helper;
					        	?>
					        </td>
					        <td>
					        	<?php 
					        		echo $row->helper_p; 
					        		$helper_p = $row->helper_p + $helper_p;
					        	?>
					        </td>
					        <td>
					        	<?php 
					        		echo $row->helper - $row->helper_p - $row->helper_l;
					        		$helper_a = $row->helper- $row->helper_p - $row->helper_l + $helper_a;
					        	?>
					        </td>

					        <td style="background:#C1E0FF">
					        	<?php 
					        		echo $row->qc; 
					        		$qc = $row->qc + $qc; 
					        	?>
					        </td>
					        <td style="background:#C1E0FF">
					        	<?php 
					        		echo $row->qc_p; 
					        		$qc_p = $row->qc_p + $qc_p;
					        	?>
					        </td>
					        <td style="background:#C1E0FF">
					        	<?php 
					        		echo $row->qc - $row->qc_p - $row->qc_l;
					        		$qc_a = $row->qc- $row->qc_p - $row->qc_l + $qc_a;
					        	?>
					        </td>

					        <td>
					        	<?php 
					        		echo $row->ironman; 
					        		$ironman = $row->ironman + $ironman; 
					        	?>
					        </td>
					        <td>
					        	<?php 
					        		echo $row->ironman_p; 
					        		$ironman_p = $row->ironman_p + $ironman_p;
					        	?>
					        </td>
					        <td>
					        	<?php 
					        		echo $row->ironman - $row->ironman_p - $row->ironman_l;
					        		$ironman_a = $row->ironman- $row->ironman_p - $row->ironman_l + $ironman_a;
					        	?>
					        </td>


					        <td style="background:#C1E0FF">
					        	<?php 
					        		echo $row->finishing_packing;
					        		$finishing_packing = $row->finishing_packing + $finishing_packing;  
					        	?>
					        </td>
					        <td style="background:#C1E0FF">
					        	<?php 
					        		echo $row->finishing_packing_p; 
					        		$finishing_packing_p = $row->finishing_packing_p + $finishing_packing_p;
					        	?>
					        </td>
					        <td style="background:#C1E0FF">
					        	<?php 
					        		echo $row->finishing_packing - $row->finishing_packing_p - $row->finishing_packing_l;
					        		$finishing_packing_a = $row->finishing_packing- $row->finishing_packing_p - $row->finishing_packing_l + $finishing_packing_a;
					        	?>
					        </td>


					        <td>
					        	<?php 
					        		echo $row->staff; 
					        		$staff = $row->staff + $staff;
					        	?>
					        </td>
					        <td>
					        	<?php 
					        		echo $row->staff_p; 
					        		$staff_p = $row->staff_p + $staff_p;
					        	?>
					        </td>
					        <td>
					        	<?php 
					        		echo $row->staff - $row->staff_p - $row->staff_l;
					        		$staff_a = $staff_a + $row->staff - $row->staff_p - $row->staff_l;
					        	?>
					        </td>


					        <td style="background:#C1E0FF">
					        	<?php 
					        		echo $row->designer; 
					        		$designer = $row->designer + $designer; 
					        	?>
					        </td>
					        <td style="background:#C1E0FF">
					        	<?php 
					        		echo $row->designer_p; 
					        		$designer_p = $row->designer_p + $designer_p;
					        	?>
					        </td>
					        <td style="background:#C1E0FF">
					        	<?php 
					        		echo $row->designer - $row->designer_p - $row->designer_l;
					        		$designer_a = $row->designer- $row->designer_p - $row->designer_l + $designer_a;
					        	?>
					        </td>
					    </tr>
					<?php } ?>
					<tr style="font-weight:bold;text-align:center;">
						<td colspan="2">Total Line</td>
						<td style="background:#C1E0FF;"><?php echo $total_emp; ?></td>
						<td><?php echo $total_present; ?></td>
						<td style="background:#C1E0FF;"><?php echo $total_absent; ?></td>
						<td><?php echo $total_leave; ?></td>

						<td style="background:#C1E0FF;"><?php echo $operator; ?></td>
						<td style="background:#C1E0FF;"><?php echo $operator_p; ?></td>
						<td style="background:#C1E0FF;"><?php echo $operator_a; ?></td>

						<td><?php echo $helper; ?></td>
						<td><?php echo $helper_p; ?></td>
						<td><?php echo $helper_a; ?></td>

						<td style="background:#C1E0FF;"><?php echo $qc; ?></td>
						<td style="background:#C1E0FF;"><?php echo $qc_p; ?></td>
						<td style="background:#C1E0FF;"><?php echo $qc_a; ?></td>

						<td><?php echo $ironman; ?></td>
						<td><?php echo $ironman_p; ?></td>
						<td><?php echo $ironman_a; ?></td>

						<td style="background:#C1E0FF;"><?php echo $finishing_packing; ?></td>
						<td style="background:#C1E0FF;"><?php echo $finishing_packing_p; ?></td>
						<td style="background:#C1E0FF;"><?php echo $finishing_packing_a; ?></td>

						<td><?php echo $staff; ?></td>
						<td><?php echo $staff_p; ?></td>
						<td><?php echo $staff_a; ?></td>

						<td style="background:#C1E0FF;"><?php echo $designer; ?></td>
						<td style="background:#C1E0FF;"><?php echo $designer_p; ?></td>
						<td style="background:#C1E0FF;"><?php echo $designer_a; ?></td>
					</tr>
		    	</table>
		  	</div>
		  	<?php //echo "<pre>"; print_r($prev_values); die; ?>

		  	<br>
			<div style="">
				<table class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:15px;margin-left: 60px; float: left;">
				  	<thead>
				  		<tr style="font-weight:bold;text-align:center; background:#C1E0FF;">
				  			<th colspan="5" style="padding: 2px 3px;">Average(1-<?= $line_number ?> Lines)</th>
				  		</tr>
				  	</thead>
				  	<tbody>
				  		<tr style="font-weight:bold; text-align:center;">
				  			<td style="padding: 2px 3px;">Name</td>
				  			<td style="padding: 2px 3px;">Total</td>
				  			<td style="padding: 2px 3px;">Present</td>
				  			<td style="padding: 2px 3px;">Absent</td>
				  			<td style="padding: 2px 3px;">Avg</td>
				  		</tr>


				  		<tr>
				  			<?php $line_number = (int)$line_number;?>
				  			<td style="padding: 2px 3px;">Operator</td>
				  			<td style="padding: 2px 3px;"><?php echo $line_operator; ?></td>
				  			<td style="padding: 2px 3px;"><?php echo $line_operator_p; ?></td>
				  			<td style="padding: 2px 3px;"><?php echo $line_operator_a; ?></td>
				  			<td style="padding: 2px 3px;"><?php echo round($line_operator_p/$line_number,2);?></td>
				  		</tr>
				  		<tr>
				  			<td style="padding: 2px 3px;">Helper</td>
				  			<td style="padding: 2px 3px;"><?php echo $line_helper; ?></td>
				  			<td style="padding: 2px 3px;"><?php echo $line_helper_p; ?></td>
				  			<td style="padding: 2px 3px;"><?php echo $line_helper_a; ?></td>
				  			<td style="padding: 2px 3px;"><?php echo round($line_helper_p/$line_number,2);?></td>
				  		</tr>
				  		<tr>
				  			<td style="padding: 2px 3px;">QC</td>
				  			<td style="padding: 2px 3px;"><?php echo $line_qc; ?></td>
				  			<td style="padding: 2px 3px;"><?php echo $line_qc_p; ?></td>
				  			<td style="padding: 2px 3px;"><?php echo $line_qc_a; ?></td>
				  			<td style="padding: 2px 3px;"><?php echo round($line_qc_p/$line_number,2);?></td>
				  		</tr>
				  		<tr>
				  			<td style="padding: 2px 3px;">Ironman</td>
				  			<td style="padding: 2px 3px;"><?php echo $line_ironman; ?></td>
				  			<td style="padding: 2px 3px;"><?php echo $line_ironman_p; ?></td>
				  			<td style="padding: 2px 3px;"><?php echo $line_ironman_a; ?></td>
				  			<td style="padding: 2px 3px;"><?php echo round($line_ironman_p/$line_number,2);?></td>
				  		</tr>
				  		<tr>
				  			<td style="padding: 2px 3px;">Staff</td>
				  			<td style="padding: 2px 3px;"><?php echo $line_staff;?></td>
				  			<td style="padding: 2px 3px;"><?php echo $line_staff_p;?></td>
				  			<td style="padding: 2px 3px;"><?php echo $line_staff_a;?></td>
				  			<td style="padding: 2px 3px;"><?php echo round($line_staff_p/$line_number,2);?></td>
				  		</tr>
				  	</tbody>
				</table>

				<table class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:15px;margin-left: 40px; float: left;">
				  	<thead>
				  		<tr class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:15px;background: rgb(193, 224, 255) none repeat scroll 0% 0%;">
				  		<th colspan="5" style="padding: 2px 3px;">Previous Day's Employees</th>
				  		</tr>
				  	</thead>
				  	<tbody>
				  		<tr style="font-weight:bold; text-align:center;">
				  			<td rowspan="2" style="padding: 2px 3px;">Grand Total</td>
				  			<td style="padding: 2px 3px;">Present</td>
				  			<td style="padding: 2px 3px;">Absent</td>
				  			<td style="padding: 2px 3px;">Leave</td>
				  			<td style="padding: 2px 3px;">Total</td>
				  		</tr>
				  		<tr>
				  			<td style="padding: 2px 3px;"><?php echo $prev_values['total_prev_p'];?></td>
				  			<td style="padding: 2px 3px;"><?php echo $prev_values['total_prev_a'];?></td>
				  			<td style="padding: 2px 3px;"><?php echo $prev_values['total_leave'];?></td>
				  			<td style="padding: 2px 3px;"><?php echo $prev_values['total_prev_emp'];?></td>
				  		</tr>
				  	</tbody>
				</table>

				<table class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:15px;margin-left: 40px; float: left;">
				  	<thead>
				  		<tr class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:15px;background: rgb(193, 224, 255) none repeat scroll 0% 0%;">
				  		<th colspan="5" style="padding: 2px 3px;">Today's Total Employees</th>
				  		</tr>
				  	</thead>
				  	<tbody>
				  		<tr style="font-weight:bold; text-align:center;">
				  			<td rowspan="2" style="padding: 2px 3px;">Grand Total</td>
				  			<td style="padding: 2px 3px;">Present</td>
				  			<td style="padding: 2px 3px;">Absent</td>
				  			<td style="padding: 2px 3px;">Leave</td>
				  			<td style="padding: 2px 3px;">Total</td>
				  		</tr>
				  		<tr>
				  			<td style="padding: 2px 3px;"><?php echo $total_present;?></td>
				  			<td style="padding: 2px 3px;"><?php echo $total_absent;?></td>
				  			<td style="padding: 2px 3px;"><?php echo $total_leave; ?></td>
				  			<td style="padding: 2px 3px;"><?php echo $total_emp;?></td>
				  		</tr>
				  	</tbody>
				</table>

				<table class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:15px;margin-left: 40px; float: left;">
				  	<thead>
				  		<tr class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:15px;background: rgb(193, 224, 255) none repeat scroll 0% 0%;">
				  			<th colspan="3" style="padding: 2px 3px;">Attendance Percentage</th>
				  		</tr>
				  	</thead>
				  	<tbody>
				  		<tr>
				  			<td style="padding: 2px 3px;">Present</td>
				  			<td style="padding: 2px 3px;">
				  				<?php 
				  					$percent_present_emp = ($total_present/$total_emp)*100;
				  					echo round($percent_present_emp)."%";
				  				?>	
				  			</td>
				  			<td style="padding: 2px 3px;"><?php echo $total_present;?></td>
				  		</tr>
				  		<tr>
				  			<td style="padding: 2px 3px;">Absent</td>
							<td style="padding: 2px 3px;">
								<?php 
									$percent_absent_emp = ($total_absent/$total_emp)*100; 
									echo round($percent_absent_emp)."%";
								?>
							</td>
				  			<td style="padding: 2px 3px;"><?php echo $total_absent;?></td>
				  		</tr>
				  		<tr>
				  			<td style="padding: 2px 3px;">Leave</td>
							<td style="padding: 2px 3px;">
								<?php 
									$percent_leave = ($total_leave/$total_emp)*100; 
									echo round($percent_leave)."%";
								?>
							</td>
				  			<td style="padding: 2px 3px;"><?php echo $total_leave;?></td>
				  		</tr>
				  	</tbody>
				</table>

				<table class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:15px;margin-left: 40px; float: left;">
				  	<thead>
				  		<tr class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:15px;background: rgb(193, 224, 255) none repeat scroll 0% 0%;">
				  			<th colspan="2" style="padding: 2px 3px;">Maternity</th>
				  		</tr>
				  		<tr >
				  			<th style="padding: 2px 3px;">Line</th>
				  			<th style="padding: 2px 3px;">Employee</th>
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
					  			<td align="center" style="padding: 2px 3px;"><?php echo $m_info->emp;?></td>
					  		</tr>
					  			<?php } ?>
				  		<?php }	?>
				  		
				  	</tbody>
				</table>
			</div>
			<br><br>
			<br><br>
		</div>
		<br><br>
		<br><br>
		<br><br>
	</body>
</html>
