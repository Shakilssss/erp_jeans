<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Job Card</title>
		<link rel="stylesheet" type="text/css" href="../../../../../css/SingleRow.css" />
	</head>

	<body>
		<div align="center" style="height:100%; width:100%; overflow:hidden;" >
			<?php $this->load->model('job_card_model');

			foreach ($values as $key => $value) { 
				echo "<div style='min-height:1000px; overflow:hidden;'>";
					$present_count = 0;
					$absent_count = 0;
					$leave_count = 0;
					$ot_count = 0;
					$late_count = 0;
					$wk_off_count = 0;
					$holiday_count = 0;
					$perror_count = 0;
					$total_ot = 0;

					$this->load->view('head_english');
					echo "<span style='font-size:13px; font-weight:bold;'>";
					echo "Job Card Report from  $grid_firstdate -TO- $grid_seconddate";
					echo "</span>";
					echo "<br /><br />";
					
					echo "<table border='0' style='font-size:13px;' width='480'>";
						echo "<tr>";
						echo "<td width='70'>";
						echo "<strong>Emp ID:</strong>";
						echo "</td>";
						echo "<td width='200'>";
						echo $value->emp_id;
						echo "</td>";
						
						echo "<td width='55'>";
						echo "<strong>Name :</strong>";
						echo "</td>";
						echo "<td width='150'>";
						echo $value->emp_full_name;
						echo "</td>";
						echo "</tr>";
						
						echo "<tr>";
						echo "<td >";
						echo "<strong>Proxi NO. :</strong>";
						echo "</td>";
						echo "<td >";
						echo $value->proxi_id;
						echo "</td>";
						
						echo "<td style:width:20px'>";
						echo "<strong>Section :</strong>";
						echo "</td>";
						echo "<td width='30px'>";
						echo $value->sec_name;
						echo "</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>";
						echo "<strong>Line :</strong>";
						echo "</td>";
						echo "<td>";
						echo $value->line_name;
						echo "</td>";
						echo "<td>";
						echo "<strong>Desig :</strong>";
						echo "</td>";
						echo "<td>";
						echo $value->desig_name;
						echo "</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>";
						echo "<strong>DOJ :</strong>";
						echo "</td>";
						echo "<td>";
						echo date("d-M-Y", strtotime($value->emp_join_date));
						echo "</td>";
						
						echo "<td >";
						echo "<strong>Dept :</strong>";
						echo "</td>";
						echo "<td >";
						echo $value->dept_name;
						echo "</td>";
						echo "</tr>";
					echo "<table>";
					
					$emp_data = $this->job_card_model->emp_job_card($grid_firstdate,$grid_seconddate, $value->emp_id);
					
					echo "<table class='sal' border='1' bordercolor='#000000' cellspacing='0' cellpadding='0' style='text-align:center; font-size:13px; '> 
							<th>Date</th>
							<th>In Time</th>
							<th>Out Time</th>
							<th>Attn.Status</th>
							<th>OT Hour</th>
							<th>Shift</th>
							<th>Remarks</th>";

						foreach ($emp_data['emp_data'] as $key => $row) {

							if(in_array($row->shift_log_date,$emp_data['leave']))
							{
								$leave_type = $this->job_card_model->get_leave_type($row->shift_log_date,$value->emp_id);
								$att_status_count = "Leave";
								$att_status = $leave_type;
								$row->in_time = "00:00:00";
								$row->out_time = "00:00:00";
							}
							elseif(in_array($row->shift_log_date,$emp_data['holiday']))
							{
								$att_status = "Holiday";
								$att_status_count = "Holiday";
								$row->in_time = "00:00:00";
								$row->out_time = "00:00:00";
								$row->ot_hour ="";
							} 
							elseif(in_array($row->shift_log_date,$emp_data['weekend'])) 
							{
								$att_status = "Work Off";
								$att_status_count = "Work Off";
								$row->in_time = "00:00:00";
								$row->out_time = "00:00:00";
								$row->ot_hour ="";
							}
							elseif($row->in_time !='00:00:00' and $row->out_time !='00:00:00')
							{
								$att_status = "P";
								$att_status_count = "P";
							}
							elseif($row->in_time !='00:00:00' or $row->out_time !='00:00:00')
							{
								$att_status = "P(Error)";
								$att_status_count = "P(Error)";
							}
							else
							{
								$att_status = "A";
								$att_status_count = "A";
							}

							$schedule = $this->job_card_model->get_emp_shift_schedule($value->emp_id, $row->shift_log_date);

							$shift_log_date = $row->shift_log_date;
							$year=trim(substr($shift_log_date,0,4));
							$month=trim(substr($shift_log_date,5,2));
							$date=trim(substr($shift_log_date,8,2));
							$shift_log_date = date("d-M-y", mktime(0, 0, 0, $month, $date, $year));
							$deduction_hour = $row->deduction_hour;
							if($row->in_time != "00:00:00")
							{
								$in_time = $row->in_time;
								$in_time = $this->job_card_model->time_am_pm_format($in_time);	
							}
							else
							{
								$in_time = "00:00:00";
							}


							if($row->out_time != "00:00:00")
							{
								$out_time = $row->out_time;
								$out_time = $this->job_card_model->get_formated_out_time_2ot($value->emp_id, $out_time, $schedule);
							}
							else
							{
								$out_time = "00:00:00";
							}


							echo "<tr>";
						
							echo "<td>&nbsp;";
							echo $shift_log_date;
							echo "</td>";
							
							echo "<td>&nbsp;";
							if($in_time == "00:00:00")
							{
								echo "&nbsp;";
							}
							else
							{
								echo $in_time;
							}
							echo "</td>";
									
							echo "<td>&nbsp;";
							if($out_time =="00:00:00")
							{
								echo "&nbsp;";
							}
							else
							{
								echo $out_time;
							}
							echo "</td>";
							
							echo "<td style='text-transform:uppercase;'>&nbsp;";
							echo $att_status;
							echo "</td>";
							
							if($att_status == "P")
							{
								$present_count++;
							}
							elseif($att_status == "A")
							{
								$absent_count++;
							}
							elseif($att_status_count == "Leave")
							{
								$leave_count++;
							}
							elseif($att_status == "P(Error)")
							{
								$perror_count++;
							}
							elseif($att_status == "Work Off")
							{
								$wk_off_count++;
							}
							elseif($att_status == "Holiday")
							{
								$holiday_count++;
							}

							if($row->late_status == 1)
							{
								$remark = "Late";
								$late_count++;
							}
							else
							{
								$remark = "";
							}
							

							echo "<td>&nbsp;";
							if($row->ot_hour == 0)
							{
								echo "&nbsp;";
							}
							else
							{
								echo $row->ot_hour;
							}
							echo "</td>";
							
							$total_ot = $total_ot + $row->ot_hour;
							
							echo "<td>&nbsp;";
							echo $schedule->sh_type;
							echo "</td>";							

							echo "<td>&nbsp;";
							echo $remark;
							echo "</td>";
							
							echo "</tr>";

						}

					echo "</table>";

					
					echo "<br>";
					echo "<table border='0' style='font-size:13px;'>";
						echo "<tr align='center'>";
							echo "<td width='75' style='border-bottom:#000000 1px solid;'>";
							echo "PRESENT";
							echo "</td>";
									
							echo "<td width='75' style='border-bottom:#000000 1px solid;'>";
							echo "ABSENT";
							echo "</td>";
									
							echo "<td width='75' style='border-bottom:#000000 1px solid;'>";
							echo "LEAVE";
							echo "</td>";
									
							echo "<td width='75' style='border-bottom:#000000 1px solid;'>";
							echo "WORK OFF";
							echo "</td>";
									
							echo "<td width='75' style='border-bottom:#000000 1px solid;'>";
							echo "HOLIDAY";
							echo "</td>";
							
							echo "<td width='75' style='border-bottom:#000000 1px solid;'>";
							echo "PRESENT ERROR";
							echo "</td>";
								
							echo "<td width='75' style='border-bottom:#000000 1px solid;'>";
							echo "LATE COUNT";
							echo "</td>";
							
							echo "<td width='75' style='border-bottom:#000000 1px solid;'>";
							echo "OVERTIME";
							echo "</td>";
						echo "</tr>";
								
						echo "<tr align='center'>";
							echo "<td>";
							echo $present_count;
							echo "</td>";
								
							echo "<td>";
							echo $absent_count;
							echo "</td>";
							
							echo "<td>";
							echo $leave_count;
							echo "</td>";
									
							echo "<td>";
							echo $wk_off_count;
							echo "</td>";

							echo "<td>";
							echo $holiday_count;
							echo "</td>";
							
							echo "<td>";
							echo $perror_count;
							echo "</td>";
							
							echo "<td>";
							echo $late_count;
							echo "</td>";

							
							echo "<td>";
							echo $total_ot;
							echo "</td>";
						echo "</tr>";
					echo "</table>";

					echo "<br /><br />";
				echo "</div>";
				echo "<br>";
			} ?>
		</div>
	</body>
</html>
