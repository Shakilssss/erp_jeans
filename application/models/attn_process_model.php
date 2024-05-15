<?php
class Attn_process_model extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
	}

	
	function delete_double_entry($emp_id,$att_date) {
        $this->db->select('*');
        $this->db->from("pr_emp_shift_log");
        $this->db->where("emp_id", $emp_id);
        $this->db->where("shift_log_date", $att_date);
        $query = $this->db->get();
        if($query->num_rows() > 1)
        {
	        $this->db->where('emp_id',$emp_id);
	        $this->db->where('shift_log_date',$att_date);
	        $this->db->order_by("shift_log_id","ASC");
	        $this->db->delete('pr_emp_shift_log');
        }
    }

	
	function attn_process($input_date)
	{

		$result = array();
		//$input_date = "2011-02-1";
		$first= "$input_date";
		$first_y=trim(substr($first,0,4));
		$first_m=trim(substr($first,5,2));
		$first_d=trim(substr($first,8,2));
		

		$last_date = date("t", mktime(0, 0, 0, $first_m, 1, $first_y));
		$second = "$first_y-$first_m-$last_date";
		
		$year_month= "$first_y-$first_m";
		$now = strtotime($first);
		$friday = strtotime("-1 day",$now);
		$first = date("Y-m-d", $friday);
		
		//File process script
		$att_date = date("Y-m-d", mktime(0, 0, 0, $first_m, $first_d, $first_y));
		$this->att_process($att_date);  
			
		//File process script
		if($att_date < "2013-10-01")
		{
			$holiday = $this->holiday_calculation($att_date);
		}
		//print_r($holiday);
		
		
		$att_table="att_".$first_y."_".$first_m;
		$date_field='.date_time';
		$prox_id_field='.proxi_id';
		$select=$att_table.$date_field;
		$w_table_prox_id=$att_table.$prox_id_field;
		
		if (!$this->db->table_exists($att_table) )
		{
		 	return "Selected month does not exist and change your process month";
		}
		else
		{
			  
			$this->db->select('
						pr_emp_per_info.emp_id,
						pr_emp_per_info.emp_full_name,
						pr_designation.desig_name,
						pr_emp_shift.shift_duty
					');
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_designation');
			$this->db->from('pr_emp_shift');
			// $this->db->where_in("pr_emp_per_info.emp_id", array('PS0769','PS007'));
			$this->db->where("pr_emp_per_info.emp_id = pr_emp_com_info.emp_id");
			$this->db->where("pr_emp_com_info.emp_desi_id = pr_designation.desig_id");
			$this->db->where("pr_emp_com_info.emp_shift = pr_emp_shift.shift_id");
			$this->db->order_by("pr_emp_com_info.emp_id");
			$query2 = $this->db->get();
			//echo $this->db->last_query();		
			$year_month = date("Y-m", mktime(0, 0, 0, $first_m, 1, $first_y)); 
			$year_month = $year_month."-00";
			$check = date("Y-m-d", mktime(0, 0, 0, $first_m, $first_d, $first_y));	

			
			foreach ($query2->result() as $rows)
			{	
			
				//echo "<br>";
				$id=$rows->emp_id;


				
				//PROCESS ELIGIBILITY CHECK AFTER JOINING AND BEFORE RESIGN OR LEFT OR Promotion
				//echo $att_date;
				$joining_check 		= $this->check_joining($id, $att_date);
				$resign_check 		= $this->check_resign($id, $att_date);
				$left_check 		= $this->check_left($id, $att_date);
				$promotion_check 	= $this->check_promotion($id);
				$this->delete_double_entry($id,$att_date);
				
				//IF ANY CONDITION IS FALSE THEN ID WILL NOT GO TO THE CORE PROCESS
				if($joining_check == false or $resign_check == false or $left_check == false or $promotion_check == false) {
					//echo "ase";
					$attn_delete = $this->attn_delete_for_eligibility_failed($id, $att_date);
				
				} else {
				
					$weekend = $this->check_weekend($id, $att_date);
					$lunch_leave = $this->check_lunch_leave($id, $att_date);
					if($att_date >= "2013-10-01")
					{
						$holiday = $this->check_holiday($id, $att_date);
					}
					
					$resig_or_left_date = $this->resig_or_left_date($id);

					$result[$id] = 'A';
					if($resig_or_left_date == false)
					{

						//echo  "<td>".$id."</td>";
						$name=$rows->emp_full_name;
						//echo  "<td>".$name."</td>";
						$designation=$rows->desig_name;
						$shift_duty = $rows->shift_duty;
						//echo  "<td>".$designation."</td>";
							
						$temp_table = "temp_$id";
						$temp_table = strtolower($temp_table);
						
						$this->db->select();
						$this->db->from($att_table);
						$this->db->from('pr_id_proxi');
						$this->db->where("$w_table_prox_id = pr_id_proxi.proxi_id");
						$this->db->where("pr_id_proxi.emp_id  = '$id'");
						$query = $this->db->get();
						
						foreach($query->result() as $rows)
						{
							$this->db->select();
							$this->db->where("device_id  = '$rows->device_id'");
							$this->db->where("proxi_id  = '$rows->proxi_id'");
							$this->db->where("date_time  = '$rows->date_time'");
							$this->db->from($temp_table);
							$query = $this->db->get();
							if($query->num_rows == 0)
							{
								$temp_data = array(
													'device_id' => $rows->device_id,
													'proxi_id' => $rows->proxi_id,
													'date_time' => $rows->date_time
													);
								$this->db->insert($temp_table,$temp_data);	
							}				
						}
						
						
						$this->db->select("emp_id");
						$this->db->where("emp_id", $id);
						$this->db->where("att_month",$year_month);
						$query = $this->db->get("pr_attn_monthly");
						if($query->num_rows() ==0)
						{
							$data = array( "emp_id" => $id, 'att_month' =>$year_month );
							$this->db->insert("pr_attn_monthly",$data);
						}
						
						set_time_limit(0) ;
						ini_set("memory_limit","-1M");
						
						$ot_hour = 0;
						
						$date_field='.date_time';
						$prox_id_field='.proxi_id';
						$select=$temp_table.$date_field;
						//========================================================================	

						$emp_shift = $this->emp_shift_check_process($id, $att_date);
						
						// exit('ali');
						//$emp_shift = $this->emp_shift_check($id);
					
						$schedule = $this->schedule_check($emp_shift);
						//print_r($schedule);
						$start_time	=  $schedule[0]["in_start"]; 
						//$late_start =  $schedule[0]["late_start"]; 
						$end_time   =  $schedule[0]["in_end"];
						// echo '<pre>'. $emp_shift; 
						// print_r($schedule); exit();

						$date = "date_$first_d";
						$date1 = date("Y-m-d", mktime(0, 0, 0, $first_m, $first_d, $first_y));
						$this->db->select($select);
						$this->db->from($temp_table);
						$this->db->where("trim(substr($select,1,10)) = '$date1' ");
						$this->db->where("trim(substr($select,11,14)) BETWEEN '$start_time' and '$end_time'");
						$query = $this->db->get();
						//echo $this->db->last_query() ;
						
						$check = date("Y-m-d", mktime(0, 0, 0, $first_m, $first_d, $first_y));	
						// print_r($check);exit('check');			
						if($query->num_rows() == 0)
						{
							
							$this->db->select("leave_type");
							$this->db->where("emp_id",$id);
							$this->db->where("start_date",$check);
							$query = $this->db->get("pr_leave_trans");
								
							if($query->num_rows() > 0)
							{
								$result[$id] = "L";
								$ppp = array( $date => $result[$id]);
								$this->db->where("emp_id",$id);
								
								$this->db->where("att_month",$year_month);
								$this->db->update("pr_attn_monthly",$ppp);
							}
							elseif ($check == $holiday)
							{
								
								//echo "<td>   H   </td>";
								$result[$id] = "H";
								
								$hhh = array( $date => $result[$id]);
								$this->db->where("emp_id",$id);
								$this->db->where("att_month",$year_month);
								$this->db->update("pr_attn_monthly",$hhh);
							}
							elseif ($check == $weekend)
							{
								//echo "<td>   W   </td>";
								$result[$id] = "W"; 
								
								$www = array( $date => $result[$id]);
								$this->db->where("emp_id",$id);
								$this->db->where("att_month",$year_month);
								$this->db->update("pr_attn_monthly",$www);
							}
							// new code add 06-11-21
							elseif ($check == $lunch_leave)  
							{
								$result[$id] = "HF";
								$ppp = array( $date => $result[$id]);
								$this->db->where("emp_id",$id);
								$this->db->where("att_month",$year_month);
								$this->db->update("pr_attn_monthly",$ppp);
							}
							else
							{
								
								//echo "<td>   A   </td>";
								$result[$id] = "A";
								$aaa = array( $date => $result[$id]);
								$this->db->where("emp_id",$id);
								$this->db->where("att_month",$year_month);
								$this->db->update("pr_attn_monthly",$aaa);
								
							}
								
						}
						else
						{
							//echo "<td style='background-color:#00FFCC'>   P   </td>";
							if ($check == $weekend)
							{
								//echo "<td>   W   </td>";
								$result[$id] = "W"; 
								
								$www = array( $date => $result[$id]);
								$this->db->where("emp_id",$id);
								$this->db->where("att_month",$year_month);
								$this->db->update("pr_attn_monthly",$www);
							}
							elseif ($check == $holiday)
							{
								//echo "<td>   H   </td>";
								$result[$id] = "H";
								
								
								$hhh = array( $date => $result[$id]);
								$this->db->where("emp_id",$id);
								$this->db->where("att_month",$year_month);
								$this->db->update("pr_attn_monthly",$hhh);
							}
							// new code add 06-11-21
							elseif ($check == $lunch_leave)  
							{
								$result[$id] = "HF";
								$ppp = array( $date => $result[$id]);
								$this->db->where("emp_id",$id);
								$this->db->where("att_month",$year_month);
								$this->db->update("pr_attn_monthly",$ppp);
							}
							else
							{					
								$this->db->select("leave_type");
								$this->db->where("emp_id",$id);
								$this->db->where("start_date",$check);
								$query = $this->db->get("pr_leave_trans");
								if($query->num_rows() > 0)
								{
									$result[$id] = "L";
									$ppp = array( $date => $result[$id]);
									$this->db->where("emp_id",$id);
									$this->db->where("att_month",$year_month);
									$this->db->update("pr_attn_monthly",$ppp);
								}
								else
								{
									$result[$id] = "P";
									$ppp = array( $date => $result[$id]);
									$this->db->where("emp_id",$id);
									$this->db->where("att_month",$year_month);
									$this->db->update("pr_attn_monthly",$ppp);
								}
							}
						}
					}

					$statusa = array(
						"present_status" => $result[$id],
					);

					$this->db->where("emp_id", $id);
					$this->db->where("shift_log_date", $att_date);
					$this->db->update("pr_emp_shift_log", $statusa);

					// print_r($check);exit($id);
					if ($check == $weekend) {
						// exit("ok");
						//=============================Extra OT Calculation=============================
							$weekend_eot_calculation = $this->weekend_holday_eot_calculation($id, $att_date);
						//=============================Extra OT Calculation=============================
					} elseif ($check == $holiday) {
						// exit("wait");
						//=============================Extra OT Calculation=============================
							$holiday_eot_calculation = $this->weekend_holday_eot_calculation($id, $att_date);
						//=============================Extra OT Calculation=============================
					} elseif ($check == $lunch_leave) {
						// exit("no");
						//=============================Lunch Leave Calculation=============================
							$lunch_leave_calculation = $this->lunch_leave_calculation($id, $att_date);
						//=============================Extra OT Calculation=============================
					} else {
						// exit("stop");
						//===========================OT CALCULATION=============================================
						//echo $id."=>";
						$ot_hour_info = $this->ot_hour_calcultation($id, $att_date);
						// echo "<pre>"; print_r($ot_hour_info); exit;
						
						//echo "<br>";
						if($ot_hour_info["ot_hour"] !='')
						{
							if($ot_hour_info["ot_hour"] > 2)
							{
								$extra_ot_hour = $ot_hour_info["ot_hour"] - 2 ;
								$ot_hour_info["ot_hour"] = 2;
								
								//echo "EMP***EX-OT=$extra_ot_hour----------";
								
							} else {
								$extra_ot_hour = 0;
							}
						}
						else
						{
							$ot_hour_info["ot_hour"] = 0;
							$extra_ot_hour = 0;
						}
						$insert_ot_hour = $this->insert_ot_hour($id, $att_date, $ot_hour_info);
						if($extra_ot_hour >= 0){
							$insert_extra_ot_hour = $this->insert_extra_ot_hour($id, $att_date, $extra_ot_hour);
						}
						$insert_deduction_hour = $this->deduction_hour_process($id,$att_date);
						//===========================OT CALCULATION===============================	
					}
				}		
			}
		
		}
		
		// echo "</table>";
		// echo "</div>";
		// echo "<br><br><br>";
		// print_r($result);
		// exit('ali');
		return $result;
	
	}
	
	function lunch_leave_calculation($emp_id, $date)
	{
		$table = "temp_$emp_id";
		$table = strtolower($table);
		$in_time = '';
		$out_time = '';
		
		$emp_shift = $this->emp_shift_check($emp_id, $date);
				
		$this->db->select("shift_id");
		$this->db->from("pr_emp_shift_schedule");
		$this->db->where("sh_type", $emp_shift);
		$shift_id = $this->db->get()->row()->shift_id;
		
		$this->db->select("shift_id");
		$this->db->from("pr_emp_shift");
		$this->db->where("shift_duty", $shift_id);
		$shift_duty = $this->db->get()->row()->shift_id;
			
		$schedule = $this->schedule_check($emp_shift);
		//print_r($schedule);
		$start_time		=  $schedule[0]["in_start"]; 
		$end_time   	=  $schedule[0]["in_end"];
		$out_start_time	=  $schedule[0]["out_start"];
		$out_end_time	=  $schedule[0]["out_end"];	

		
		$in_time  = $this->time_check_in($date, $start_time, $end_time, $table);
		$out_start_time = "$date $out_start_time";
		$out_date = date('Y-m-d', strtotime($date. ' + 1 days'));
		$out_end_time = "$out_date $out_end_time";
		
		$out_time_date = $this->time_check_out2($out_start_time, $out_end_time, $table);
		$out_time = trim(substr($out_time_date,11,19));				
		// exit($out_time);
		$this->db->select();
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date", $date);
		$query = $this->db->get("pr_emp_shift_log");
		
		if($query->num_rows() > 0)
		{
			$data = array(
				'in_time' => $in_time,
				'out_time' => $out_time,
			);
			$this->db->where('shift_log_date', $date);
			$this->db->where('emp_id', $emp_id);
			$this->db->update('pr_emp_shift_log', $data);
		}
		else
		{
			$data = array(
				'emp_id' => $emp_id,
				'in_time' => $in_time,
				'out_time' => $out_time,
				'shift_id' => $shift_id,
				'shift_duty' => $shift_duty,
				'shift_log_date' => $date,
				'ot_hour' => 0,
				'extra_ot_hour' => 0,
				'late_status' => 0
			);
			$this->db->insert("pr_emp_shift_log", $data);
		}
		return true;
	}


	function resig_or_left_date($emp_id)
	{
		$this->db->select("left_date");
		$this->db->where('emp_id',$emp_id);
		$query = $this->db->get("pr_emp_left_history");
		$row = $query->row();
		if($query->num_rows() > 0)
		{
			return true;
		}
		
		
		$this->db->select("resign_date");
		$this->db->where('emp_id',$emp_id);
		$query = $this->db->get("pr_emp_resign_history");
		$row = $query->row();
		if($query->num_rows() > 0)
		{
			return true;
		}
	}
	
	function insert_extra_ot_hour($emp_id, $att_date, $extra_ot_hour)
	{
		$eot_leasure_hour = $this->get_setup_attributes(2);
		
		/*if($emp_id =='AD0084')
		{
			echo "$emp_id => leasure: $eot_leasure_hour, EOT: $extra_ot_hour ========";
		}*/
		$this->db->select('shift_id,in_time,out_time');
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date", $att_date);
		$query = $this->db->get("pr_emp_shift_log");
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$in_time = $row->in_time;
			$out_time = $row->out_time;
			$shift_id = $row->shift_id;
			//$ot_start = $this->get_shift_out_time($shift_id);
			//echo "$in_time==$out_time##";
			if($in_time != "00:00:00"){	
				$emp_shift = $this->emp_shift_check_process($emp_id, $att_date);
				$schedule = $this->schedule_check($emp_shift);
				
				$ot_start				=  $schedule[0]["ot_start"];
				$ot_minute_to_one_hour	=  $schedule[0]["ot_minute_to_one_hour"]; 
				
				$in_time = $ot_start;
					
				$new_in_time = date("h:i:s A", strtotime($in_time));
				$date_in_time = $att_date." ".$new_in_time;
				//echo $new_shift_out_time;
				$mdm_new_in_time = date("A", strtotime($new_in_time));
				
				
				$new_out_time = date("h:i:s A", strtotime($out_time));
				
				$mdm_new_out_time = date("A", strtotime($new_out_time));
				
				
				if($mdm_new_in_time == $mdm_new_out_time)
				{
					$date_out_time = $att_date." ".$new_out_time;
					
				}
				else
				{
					 $att_date_new = strtotime(date("Y-m-d", strtotime($att_date)) . " +1 day");
					 $newdate = date ('Y-m-d' , $att_date_new );
					 $date_out_time = $newdate." ".$new_out_time;
				}
				
				$date1 = new DateTime($date_out_time);
				$date2 = new DateTime($date_in_time);
				$interval = $date1->diff($date2);
				$hour    =  $interval->h;
				$minutes =  $interval->i;
				//echo "$hour-$minutes";
				//RAMADAN 2014 - 90 MINUTES EOT FOR IFTAR DEDUCTION
				if('2014-06-30' <= $att_date and '2014-07-31' >= $att_date)
				{ 
					$total_ot_minute = ($hour - 2) * 60 + $minutes;
					if($total_ot_minute >= 90)
					{
						$total_ot_minute 	= $total_ot_minute - 90;	
						$hour 				= floor($total_ot_minute / 60);
						$minutes 			= ($total_ot_minute % 60);
						if($ot_minute_to_one_hour <= $minutes)
						{
							$hour = $hour + 1;
						}
						$extra_ot_hour = $hour;
					}
					else{
						$extra_ot_hour = 0;
					}
				}
				else
				{
					
					if($ot_minute_to_one_hour <= $minutes)
					{
						$hour = $hour + 1;
					}
						
					if($hour >= $eot_leasure_hour)
					{
						$extra_ot_hour = $extra_ot_hour - 1;
					}
					else
					{
						$extra_ot_hour = $extra_ot_hour;
					}
		
					//echo $extra_ot_hour;
				}
			}
			else{ $extra_ot_hour = 0;}
			$rep_1 = str_replace(":", "0", $extra_ot_hour);
			$rep_2 = str_replace(";", "0", $extra_ot_hour);
			if($rep_2)
			{
				$extra_ot_hour = $rep_2;
			}
			elseif($rep_1)
			{
			$extra_ot_hour = $rep_1;	
			}
			else {
				$extra_ot_hour =$extra_ot_hour;
			}
			//echo $extra_ot_hour;
			$data = array(
						"extra_ot_hour" => $extra_ot_hour
						);
			$this->db->where("emp_id", $emp_id);
			$this->db->where("shift_log_date", $att_date);
			$this->db->update("pr_emp_shift_log", $data);
			//echo $this->db->last_query();
		}
	}
	
	function weekend_holday_eot_calculation($emp_id, $date)
	{
		
		$table = "temp_$emp_id";
		$table = strtolower($table);
		
		$present_count = 0;
		$absent_count = 0;
		$leave_count = 0;
		$ot_count = 0;
		$late_count = 0;
		
		$this->db->select("pr_emp_com_info.ot_entitle");
		$this->db->from("pr_emp_com_info");
		$this->db->where("pr_emp_com_info.emp_id = '$emp_id'");
		$query1 = $this->db->get();
		$row1 = $query1->row();
		$ot_status  = $row1->ot_entitle;
		
		$in_time = '';
		$out_time = '';
		
		$emp_shift = $this->emp_shift_check($emp_id, $date);
				
		$this->db->select("shift_id, ot_minute_to_one_hour");
		$this->db->from("pr_emp_shift_schedule");
		$this->db->where("sh_type", $emp_shift);
		$query = $this->db->get();
		$row = $query->row();
		$ot_minute_to_one_hour = $row->ot_minute_to_one_hour;
		$shift_id = $row->shift_id;
		
		$this->db->select("shift_id");
		$this->db->from("pr_emp_shift");
		$this->db->where("shift_duty", $shift_id);
		$query = $this->db->get();
		$row = $query->row();
		$shift_duty = $row->shift_id;
			
		$schedule = $this->schedule_check($emp_shift);
		//print_r($schedule);
		$start_time		=  $schedule[0]["in_start"]; 
		$late_time 		=  $schedule[0]["late_start"]; 
		$end_time   	=  $schedule[0]["in_end"];
		$out_start_time	=  $schedule[0]["out_start"];
		$ot_start_time	=  $schedule[0]["ot_start"];
		$out_end_time	=  $schedule[0]["out_end"];	

		$hour = trim(substr($out_start_time,0,2));
		$minute = trim(substr($out_start_time,3,2));
		$sec = trim(substr($out_start_time,6,2));

		$am_pm = date("A", mktime($hour, $minute, $sec, 0, 0, 0));
		$in_date = $date;
		$ot_start_time = "$in_date $ot_start_time";
		if($am_pm == "AM")
		{
			//echo $am_pm;
			$now = strtotime($in_date);
			$datestr = strtotime("+1 day",$now);
			$in_date = date("Y-m-d", $datestr);
			$in_date = $in_date;
		}
		else
		{
			$in_date = $date;
		}
		
		$hour = trim(substr($out_end_time,0,2));
		$minute = trim(substr($out_end_time,3,2));
		$sec = trim(substr($out_end_time,6,2));
		$am_pm = date("A", mktime($hour, $minute, $sec, 0, 0, 0));
		
		$out_date = $date;
		if($am_pm == "AM")
		{
			//echo $am_pm;
			$now = strtotime($out_date);
			$datestr = strtotime("+1 day",$now);
			$out_date = date("Y-m-d", $datestr);
			$out_date = $out_date;
		}
		else
		{
			$out_date = $date;
		}	


		$in_time  = $this->time_check_in($date, $start_time, $end_time, $table);
		$in_time_date=  $date." ".$in_time;
		$out_start_time = "$in_date $out_start_time";
		$out_end_time = "$out_date $out_end_time";

		/*$new_out_start_time = "$in_date 12:00:00";
		if ($in_date == "2022-08-05" || $in_date == "2022-08-12") {
			$out_time_date = $this->time_check_out2($new_out_start_time, $out_end_time, $table);
		} else {
		}*/

		$out_time_date = $this->time_check_out2($out_start_time, $out_end_time, $table);
		$out_time = trim(substr($out_time_date,11,19));

		if($in_time == '' or $out_time == '')
		{
			$weekend_holiday_eot_hour = 0;
		}
		else
		{
			$weekend_holiday_eot_hour = $this->hour_difference($in_time_date, $out_time_date, $ot_minute_to_one_hour, $date);	
		}	

		/*if ($in_date == "2022-08-05" || $in_date == "2022-08-12") { 
			if ("15:00:00" <= $out_time) {
				$weekend_holiday_eot_hour = $weekend_holiday_eot_hour -1;
			}
		} else {
		}*/
		
		if($weekend_holiday_eot_hour > 5)
		{
			$weekend_holiday_eot_hour = $weekend_holiday_eot_hour -1;
		}	

		$this->db->select();
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date", $date);
		$query = $this->db->get("pr_emp_shift_log");
		
		//echo $query->num_rows();
					//print_r($data);
					//echo "LATE: ".$late_time;
		if($query->num_rows() > 0)
		{
			$data = array(
						'in_time' => $in_time,
						'out_time' => $out_time,
						'ot_hour' => 0,
						'extra_ot_hour' => $weekend_holiday_eot_hour,
						'late_status' => 0
						);
			$this->db->where('shift_log_date', $date);
			$this->db->where('emp_id', $emp_id);
			$this->db->update('pr_emp_shift_log', $data);
			//echo $this->db->last_query();
		}
		else
		{
			
			$data = array(
						'emp_id' => $emp_id,
						'in_time' => $in_time,
						'out_time' => $out_time,
						'shift_id' => $shift_id,
						'shift_duty' => $shift_duty,
						'shift_log_date' => $date,
						'ot_hour' => 0,
						'extra_ot_hour' => $weekend_holiday_eot_hour,
						'late_status' => 0
						
						);
			$this->db->insert("pr_emp_shift_log", $data);
		}
		// echo "<pre>"; print_r($data); die;
		return true;
	}
	
	function extra_ot_calculation($id,$check,$schedule)
	{
		$emp_id = $id;
		$date = $check;
		$original_date = $date;
		$schedule = $schedule;
		$table = "temp_$emp_id";
		$table = strtolower($table);
				
		$this->db->select("pr_emp_com_info.ot_entitle");
		$this->db->from("pr_emp_com_info");
		$this->db->where("pr_emp_com_info.emp_id = '$emp_id'");
		$query1 = $this->db->get();
		$row1 = $query1->row();
		$ot_status  = $row1->ot_entitle;
		
		if( $ot_status == 0 )
		{
			if($schedule == "Night")
			{
				//==================NIGHT SHIFT CALCULATION============================				
				$ot_start = "13:45:00";
				$ot_end = "20:15:00";
				
				$in_time = '';
				$out_time = '';
				
				$in_time_original = $this->time_check_in($date, $ot_start, $ot_end, $table);
				if($in_time_original !='')
				{
					$in_time_original = $in_time_original;
				}
				else
				{
					$in_time_original ='';
				}
				$out_time_original = $this->time_check_out($date, $ot_start, $ot_end, $table);
				$out_time = $out_time_original;
				if($out_time !='')
				{
					$hour = trim(substr($out_time,11,2));
					$minute = trim(substr($out_time,14,2));
					$sec = trim(substr($out_time,17,2));
					$out_time_original = date("H:i:s", mktime($hour, $minute, $sec, 0, 0, 0));
				}
				else
				{
					$out_time_original ='';
				}
					
				if($in_time_original == $out_time_original )
				{
					$total_ot_hour = 0;
				}
				elseif($in_time_original =='' or $out_time_original =='')
				{
					$total_ot_hour = 0;
				}
				else
				{
					$in_time = $in_time_original;
					if($in_time > "13:45:00")
					{
						$in_time = "14:00:00";
					}
					elseif($in_time > "14:40:00")
					{
						$in_time = "15:00:00";
					}
									
					
					if($out_time > "19:40:00")
					{
						$out_time = "20:00:00";
					}
					elseif($out_time > "18:40:00")
					{
						$out_time = "19:00:00";
					}
					elseif($out_time > "17:40:00")
					{
						$out_time = "18:00:00";
					}
					
					$ot_hour = round($out_time - $in_time);
					$total_ot_hour = $ot_hour;
				}
				
				$this->db->select("");
				$this->db->where("emp_id", $emp_id);
				$this->db->where("ot_date", $original_date);
				$query = $this->db->get("pr_extra_ot");
				if($query->num_rows() > 0)
				{
					$data = array(
					'ot_hour' 		=> $total_ot_hour,	
					'afternoon_in_time' => $in_time_original,
					'afternoon_out_time'=> $out_time_original
					);
					
					$this->db->where("emp_id", $emp_id);
					$this->db->where("ot_date", $original_date);
					$this->db->update("pr_extra_ot", $data);
				}
				else
				{
					$data = array(
					'emp_id' => $emp_id,
					'ot_date' => $original_date,
					'ot_hour' => $total_ot_hour,
					'afternoon_in_time' => $in_time_original,
					'afternoon_out_time'=> $out_time_original		
					);
					$this->db->insert("pr_extra_ot", $data);
					
				}
			//==================NIGHT SHIFT CALCULATION END============================				
			}
			elseif($schedule == "Day")
			{
				//==================DAY SHIFT CALCULATION============================			
				$ot_start = "07:45:00";
				$ot_end = "14:15:00";
				
				$in_time = '';
				$out_time = '';
				
				$in_time_original_first = $this->time_check_in($date, $ot_start, $ot_end, $table);
				$out_time_original_first = $this->time_check_out($date, $ot_start, $ot_end, $table);
				$in_time = $in_time_original_first;
				if($out_time_original_first != '')
				{
					$hour = trim(substr($out_time_original_first,11,2));
					$minute = trim(substr($out_time_original_first,14,2));
					$sec = trim(substr($out_time_original_first,17,2));
					$out_time_original_first = date("H:i:s", mktime($hour, $minute, $sec, 0, 0, 0));
				}
				else
				{
					$out_time_original_first = '';
				}

				$out_time = $out_time_original_first;
				
				
				if($in_time_original_first == $out_time_original_first)
				{
					$total_ot_hour_first = 0;
				}
				elseif($in_time_original_first =='' or $out_time_original_first =='')
				{
					$total_ot_hour_first = 0;
				}
				else
				{
					if($in_time > "07:45:00")
					{
						$in_time = "08:00:00";
					}
					elseif($in_time < "08:30:00")
					{
						$in_time = "08:00:00";
					}
					//echo $in_time;
					
					
					
					if($out_time > "13:40:00")
					{
						$out_time = "14:00:00";
					}
					
					
					//echo "<br>OUT==".$out_time = "19:50:00";
					$total_ot_hour_first = round($out_time - $in_time);
				}
					
				$ot_start = "19:45:00";
				$ot_end = "20:15:00";
				
				$in_time_original_second = $this->time_check_in($date, $ot_start, $ot_end, $table);
				
				$in_time = $in_time_original_second;
				
				$ot_start = "04:45:00";
				$ot_end = "08:15:00";
				
				$now = strtotime($date);
				$datestr = strtotime("+1 day",$now);
				$out_date = date("Y-m-d", $datestr);
				$out_date = $out_date;
						
				$out_time_original_second = $this->time_check_out($out_date, $ot_start, $ot_end, $table);
				
				if($out_time_original_second !='')
				{
					$hour = trim(substr($out_time_original_second,11,2));
					$minute = trim(substr($out_time_original_second,14,2));
					$sec = trim(substr($out_time_original_second,17,2));
					$out_time_original_second = date("H:i:s", mktime($hour, $minute, $sec, 0, 0, 0));
					$out_time = $out_time_original_second;
				}
				else
				{
					$out_time ='';
				}
				if($in_time_original_second == $out_time_original_second ) 
				{
					$total_ot_hour_second = 0;
				}
				elseif($in_time_original_second =='' or $out_time_original_second =='')
				{
					$total_ot_hour_second = 0;
				}
				else
				{
								
					if($in_time > "19:45:00")
					{
						$in_time = "20:00:00";
					}
					elseif($in_time < "20:15:00")
					{
						$in_time = "20:00:00";
					}
					$in_date_time = "$date $in_time";
					
					
					
					if($out_time > "07:40:00")
					{
						$out_time = "08:00:00";
					}
					elseif($out_time > "06:40:00")
					{
						$out_time = "07:00:00";
					}
					elseif($out_time > "05:40:00")
					{
						$out_time = "06:00:00";
					}
					elseif($out_time > "04:40:00")
					{
						$out_time = "05:00:00";
					}
					
					
					
					$out_date_time = "$out_date $out_time";
					//$total_ot_hour_second = round($in_time - $out_time - 1);
					
					$total_ot_hour_second = $this->hour_difference($in_date_time, $out_date_time,$id, $date);

				}
				
				$total_ot_hour_day = $total_ot_hour_first + $total_ot_hour_second;
				//echo "EMP=$emp_id=>IN=$in_time_original_second=OUT=$out_time_original_second=OT= $total_ot_hour_day****";
				
				$this->db->select("");
				$this->db->where("emp_id", $emp_id);
				$this->db->where("ot_date", $original_date);
				$query = $this->db->get("pr_extra_ot");
				if($query->num_rows() > 0)
				{
					$data = array(
					'ot_hour' 			=> $total_ot_hour_day,
					'morning_in_time' 	=> $in_time_original_first,
					'morning_out_time' 	=> $out_time_original_first,
					'night_in_time' 	=> $in_time_original_second,
					'night_out_time' 	=>	$out_time_original_second	
					);
					
					$this->db->where("emp_id", $emp_id);
					$this->db->where("ot_date", $original_date);
					$this->db->update("pr_extra_ot", $data);
				}
				else
				{
					$data = array(
					'emp_id' 			=> $emp_id,
					'ot_date' 			=> $original_date,
					'ot_hour' 			=> $total_ot_hour_day,
					'morning_in_time' 	=> $in_time_original_first,
					'morning_out_time' 	=> $out_time_original_first,
					'night_in_time' 	=> $in_time_original_second,
					'night_out_time' 	=>	$out_time_original_second				
					);
					$this->db->insert("pr_extra_ot", $data);
				
				}
				//==================DAY SHIFT CALCULATION END============================
			}
			else
			{
				//==================GENERAL SHIFT CALCULATION============================
				$ot_start = "06:00:00";
				$ot_end = "23:59:00";
				$in_time = '';
				$out_time = '';
						
				$in_time_original_general = $this->time_check_in($original_date, $ot_start, $ot_end, $table);
				if($in_time_original_general !='')
				{
					$in_time = $in_time_original_general;
				}
				else
				{
					$in_time ='';
				}
				
				
				$out_time_original_general = $this->time_check_out($original_date, $ot_start, $ot_end, $table);
					
				if($out_time_original_general !='')
				{
					$hour = trim(substr($out_time_original_general,11,2));
					$minute = trim(substr($out_time_original_general,14,2));
					$sec = trim(substr($out_time_original_general,17,2));
					$out_time_original_general = date("H:i:s", mktime($hour, $minute, $sec, 0, 0, 0));
					$out_time = $out_time_original_general;
				}
				else
				{
					$out_time ='';
				}
				
					if($in_time_original_general == $out_time_original_general)
					{
						$total_ot_hour_general = 0;
					}
					elseif($in_time_original_general =='' or $out_time_original_general =='')
					{
					
					}
					else
					{
					
					$out_time = $out_time_original_general;
					
					
					if($in_time > "10:40:00")
					{
						$in_time = "11:00:00";
					}
					elseif($in_time > "09:40:00")
					{
						$in_time = "10:00:00";
					}
					elseif($in_time > "08:40:00")
					{
						$in_time = "09:00:00";
					}
					elseif($in_time > "07:40:00")
					{
						$in_time = "08:00:00";
					}
					elseif($in_time > "06:40:00")
					{
						$in_time = "07:00:00";
					}
					elseif($in_time > "05:40:00")
					{
						$in_time = "06:00:00";
					}
					
					$in_date_time = "$original_date $in_time";
					
					if($out_time > "23:40:00")
					{
						$out_time = "24:00:00";
					}
					elseif($out_time > "22:40:00")
					{
						$out_time = "23:00:00";
					}
					elseif($out_time > "21:40:00")
					{
						$out_time = "22:00:00";
					}
					elseif($out_time > "20:40:00")
					{
						$out_time = "21:00:00";
					}
					elseif($out_time > "19:40:00")
					{
						$out_time = "20:00:00";
					}
					elseif($out_time > "18:40:00")
					{
						$out_time = "19:00:00";
					}
					elseif($out_time > "17:40:00")
					{
						$out_time = "18:00:00";
					}
					elseif($out_time > "16:40:00")
					{
						$out_time = "17:00:00";
					}
					elseif($out_time > "15:40:00")
					{
						$out_time = "16:00:00";
					}
					elseif($out_time > "14:40:00")
					{
						$out_time = "15:00:00";
					}
					elseif($out_time > "13:40:00")
					{
						$out_time = "14:00:00";
					}
					elseif($out_time > "12:40:00")
					{
						$out_time = "13:00:00";
					}
					
					
					
					
					$out_date_time = "$original_date $out_time";
					
					$in_hour = substr($in_date_time, 11, 2);
					$out_hour = substr($out_date_time, 11, 2);
					$total_ot_hour_general = ($out_hour - $in_hour);
					
					
			}
				//echo "emp=$emp_id=".$total_ot_hour_general;
				//echo "=>IN=$in_time<>OUT=$out_time****";
					$this->db->select("");
					$this->db->where("emp_id", $emp_id);
					$this->db->where("ot_date", $original_date);
					$query = $this->db->get("pr_extra_ot");
					if($query->num_rows() > 0)
					{
						$data = array(
						'ot_hour' 			=> $total_ot_hour_general,	
						'morning_in_time' 	=> $in_time_original_general,
						'morning_out_time' 	=> $out_time_original_general
						);
						
						$this->db->where("emp_id", $emp_id);
						$this->db->where("ot_date", $original_date);
						$this->db->update("pr_extra_ot", $data);
					}
					else
					{
						$data = array(
						'emp_id' 			=> $emp_id,
						'ot_date' 			=> $original_date,
						'ot_hour' 			=> $total_ot_hour_general,
						'morning_in_time' 	=> $in_time_original_general,
						'morning_out_time' 	=> $out_time_original_general		
						);
						$this->db->insert("pr_extra_ot", $data);
						
					}		
				//==================GENERAL SHIFT CALCULATION END============================			
			}
		}
		else
		{
			$ot_start = "06:00:00";
			$ot_end = "23:59:00";
			$in_time = '';
			$out_time = '';
						
				$in_time_original_general = $this->time_check_in($original_date, $ot_start, $ot_end, $table);
				if($in_time_original_general !='')
				{
					$in_time = $in_time_original_general;
				}
				else
				{
					$in_time ='';
				}
				
				
				$out_time_original_general = $this->time_check_out($original_date, $ot_start, $ot_end, $table);
					
				if($out_time_original_general !='')
				{
					$hour = trim(substr($out_time_original_general,11,2));
					$minute = trim(substr($out_time_original_general,14,2));
					$sec = trim(substr($out_time_original_general,17,2));
					$out_time_original_general = date("H:i:s", mktime($hour, $minute, $sec, 0, 0, 0));
					$out_time = $out_time_original_general;
				}
				else
				{
					$out_time ='';
				}
				
					if($in_time_original_general == $out_time_original_general )
					{
						$total_ot_hour_general = 0;
					}
					elseif($in_time_original_general =='' or $out_time_original_general =='')
					{
						$total_ot_hour_general = 0;
					}
					else
					{
					
					$out_time = $out_time_original_general;
					
					
					if($in_time > "10:40:00")
					{
						$in_time = "11:00:00";
					}
					elseif($in_time > "09:40:00")
					{
						$in_time = "10:00:00";
					}
					elseif($in_time > "08:40:00")
					{
						$in_time = "09:00:00";
					}
					elseif($in_time > "07:40:00")
					{
						$in_time = "08:00:00";
					}
					elseif($in_time > "06:40:00")
					{
						$in_time = "07:00:00";
					}
					elseif($in_time > "05:40:00")
					{
						$in_time = "06:00:00";
					}
					
					$in_date_time = "$original_date $in_time";
					
					if($out_time > "23:40:00")
					{
						$out_time = "24:00:00";
					}
					elseif($out_time > "22:40:00")
					{
						$out_time = "23:00:00";
					}
					elseif($out_time > "21:40:00")
					{
						$out_time = "22:00:00";
					}
					elseif($out_time > "20:40:00")
					{
						$out_time = "21:00:00";
					}
					elseif($out_time > "19:40:00")
					{
						$out_time = "20:00:00";
					}
					elseif($out_time > "18:40:00")
					{
						$out_time = "19:00:00";
					}
					elseif($out_time > "17:40:00")
					{
						$out_time = "18:00:00";
					}
					elseif($out_time > "16:40:00")
					{
						$out_time = "17:00:00";
					}
					elseif($out_time > "15:40:00")
					{
						$out_time = "16:00:00";
					}
					elseif($out_time > "14:40:00")
					{
						$out_time = "15:00:00";
					}
					elseif($out_time > "13:40:00")
					{
						$out_time = "14:00:00";
					}
					elseif($out_time > "12:40:00")
					{
						$out_time = "13:00:00";
					}
					
					
					
					
					$out_date_time = "$original_date $out_time";
					
					$in_hour = substr($in_date_time, 11, 2);
					$out_hour = substr($out_date_time, 11, 2);
					$total_ot_hour_general = ($out_hour - $in_hour);
			}
			
			$this->db->select("");
			$this->db->where("emp_id", $emp_id);
			$this->db->where("ot_date", $original_date);
			$query = $this->db->get("pr_extra_ot");
			if($query->num_rows() > 0)
			{
				$data = array(
				'ot_hour' 			=> $total_ot_hour_general,	
				'morning_in_time' 	=> $in_time_original_general,
				'morning_out_time' 	=> $out_time_original_general
				);
				
				$this->db->where("emp_id", $emp_id);
				$this->db->where("ot_date", $original_date);
				$this->db->update("pr_extra_ot", $data);
			}
			else
			{
				$data = array(
				'emp_id' 			=> $emp_id,
				'ot_date' 			=> $original_date,
				'ot_hour' 			=> $total_ot_hour_general,
				'morning_in_time' 	=> $in_time_original_general,
				'morning_out_time' 	=> $out_time_original_general		
				);
			$this->db->insert("pr_extra_ot", $data);
			}		
		}		
	
	}
	
	function hour_difference($start_date_time, $end_date_time, $ot_minute_to_one_hour)
	{
		
		// Update by Shahajahan, 2021-11-07 ---------
		$start_date_time = strtotime("$start_date_time");
		$end_date_time 	= strtotime("$end_date_time");
		$elapsed 		= $end_date_time - $start_date_time;
		$elapsed_hour 	= floor($elapsed / 3600);
		$elapsed 		-= 3600 * floor($elapsed / 3600);    
		$elapsed_min 	= floor($elapsed / 60);

		// echo " = ". $elapsed_hour ." = "; print_r($elapsed); echo(" = ". $elapsed_min); die;

		$min_mint = 20; // Minimum Minute to helf (0.5) OT Count

		if($elapsed_min >= $ot_minute_to_one_hour){ // 50 or more Minuts to 1HR
			$elapsed_hour = $elapsed_hour + 1;
		}elseif($elapsed_min >= $min_mint AND $elapsed_min < $ot_minute_to_one_hour){ 
			// 20 more and 50 less Minuts to 0.5 HR
			$elapsed_hour = $elapsed_hour + 0.5;
		}

		return $elapsed_hour;
		// return $elapsed_hour;
	}
	
	function check_holiday($id, $att_date)
	{
		$this->db->select("emp_id");
		$this->db->from("pr_holiday_new");
		$this->db->where("emp_id", $id);
		$this->db->where("holyday_date", $att_date);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function check_weekend($id, $att_date)
	{
		$this->db->select("emp_id");
		$this->db->from("pr_work_off");
		$this->db->where("emp_id", $id);
		$this->db->where("work_off_date", $att_date);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	// check lunch leave 06-11-21 
	function check_lunch_leave($id, $att_date)
	{
		$this->db->select("emp_id");
		$this->db->from("pr_lunch_leave");
		$this->db->where("emp_id", $id);
		$this->db->where("start_date", $att_date);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
		
	function ot_hour_calcultation($emp_id, $date)
	{
		$table = "temp_$emp_id";
		$table = strtolower($table);
		
		$present_count = 0;
		$absent_count = 0;
		$leave_count = 0;
		$ot_count = 0;
		$late_count = 0;
		
		$this->db->select("pr_emp_com_info.ot_entitle");
		$this->db->from("pr_emp_com_info");
		$this->db->where("pr_emp_com_info.emp_id = '$emp_id'");
		$query1 = $this->db->get();
		$row1 = $query1->row();
		$ot_status  = $row1->ot_entitle;
		
		$in_time = '';
		$out_time = '';
		
		$emp_shift = $this->emp_shift_check($emp_id, $date);
				
		$this->db->select("shift_id");
		$this->db->from("pr_emp_shift_schedule");
		$this->db->where("sh_type", $emp_shift);
		$query = $this->db->get();
		$row = $query->row();
			
		$schedule = $this->schedule_check($emp_shift);
		// echo "<pre>"; print_r($schedule); exit;
		$start_time		=  $schedule[0]["in_start"]; 
		$late_time 		=  $schedule[0]["late_start"]; 
		$end_time   	=  $schedule[0]["in_end"];
		$out_start_time	=  $schedule[0]["out_start"];
		$ot_start_time	=  $schedule[0]["ot_start"];
		$out_end_time	=  $schedule[0]["out_end"];			
		$minMintToOneHr	=  $schedule[0]["ot_minute_to_one_hour"];

				
		$hour = trim(substr($out_start_time,0,2));
		$minute = trim(substr($out_start_time,3,2));
		$sec = trim(substr($out_start_time,6,2));

		$am_pm = date("A", mktime($hour, $minute, $sec, 0, 0, 0));
		$in_date = $date;
		$ot_start_time = "$in_date $ot_start_time";
		if($am_pm == "AM")
		{
			//echo $am_pm;
			$now = strtotime($in_date);
			$datestr = strtotime("+1 day",$now);
			$in_date = date("Y-m-d", $datestr);
			$in_date = $in_date;
		}
		else
		{
			$in_date = $date;
		}
		
		$hour = trim(substr($out_end_time,0,2));
		$minute = trim(substr($out_end_time,3,2));
		$sec = trim(substr($out_end_time,6,2));
		$am_pm = date("A", mktime($hour, $minute, $sec, 0, 0, 0));
		
		$out_date = $date;
		if($am_pm == "AM")
		{
			//echo $am_pm;
			$now = strtotime($out_date);
			$datestr = strtotime("+1 day",$now);
			$out_date = date("Y-m-d", $datestr);
			$out_date = $out_date;
		}
		else
		{
			$out_date = $date;
		}	
		
		$present_check = $this->present_check($date, $emp_id);
		if( $present_check == true)
		{	
			$in_time  = $this->time_check_in($date, $start_time, $end_time, $table);
			
			$out_start_time = "$in_date $out_start_time";
			$out_end_time = "$out_date $out_end_time";
			$out_time = $this->time_check_out2($out_start_time, $out_end_time, $table);
		}
		else
		{
			$in_time = '';
			$out_time = '';
		}

		//echo $in_time;
		if($in_time !='')
		{
			$hour = trim(substr($in_time,0,2));
			$minute = trim(substr($in_time,3,2));
			$sec = trim(substr($in_time,6,2));
			$time_format = date("h:i:s A", mktime($hour, $minute, $sec, 0, 0, 0));
			$in_time_format = $time_format;
		}
		else
		{
			$in_time_format='';
		}
		
		if($out_time !='')
		{
			$hour = trim(substr($out_time,11,2));
			$minute = trim(substr($out_time,14,2));
			$sec = trim(substr($out_time,17,2));
			$time_format = date("h:i:s A", mktime($hour, $minute, $sec, 0, 0, 0));
			$out_time_format = $time_format;
		}
		else
		{
			$out_time_format='';
		}

		// 18-03-2024 minus 90 minutes to ramadan
		$check_extra_time = $in_date .' 18:19:01';
		if ((strtotime($out_time) > strtotime($check_extra_time)) && ($date > '2024-03-17' && $date < '2024-04-12')) {
			$out_time = date('Y-m-d H:i:s', strtotime($out_time. ' -90 minutes'));
		}
		else{
			$out_time = $out_time;
		}
		// end 18-03-2024 minus 90 minutes to ramadan

		// echo $out_time;exit;

		$ot_hour='';
		if($in_time !='' and $out_time !='')
		{
			if($ot_status == 0)
			{
				$in_date_time = $out_start_time;
								
				$ot_hour = $this->hour_difference($ot_start_time, $out_time, $minMintToOneHr);
				
				/*if($emp_id =='SO0877')
				{
					echo "empId: $emp_id=IN=>$in_date_time****OUT=>$out_time===$out_date****OT===>$ot_hour";
				}*/
				
			}
			else
			{
				$ot_hour = 0;
			}
		}
			
		if($out_time !='')
		{
			$hour = trim(substr($out_time,11,2));
			$minute = trim(substr($out_time,14,2));
			$sec = trim(substr($out_time,17,2));
			$out_time = date("H:i:s", mktime($hour, $minute, $sec, 0, 0, 0));
		}
				
		$data["in_time"] 	= $in_time;
		$data["out_time"] 	= $out_time;
		$data["ot_hour"] 	= $ot_hour;
		//echo "EMP:$emp_id";
		// print_r($data);exit;
		return $data;
		
	
	}
	
	function insert_ot_hour($emp_id, $date, $ot_hour_calcultation)
	{
		//echo "EMP: $emp_id";
		//print_r($ot_hour_calcultation);
		$emp_shift = $this->emp_shift_check($emp_id, $date);
		
		$schedule = $this->schedule_check($emp_shift);
		//print_r($schedule);
		$start_time		=  $schedule[0]["in_start"]; 
		$late_time 		=  $schedule[0]["late_start"]; 
		$end_time   	=  $schedule[0]["in_end"];
		$out_start_time	=  $schedule[0]["out_start"];
		$out_end_time	=  $schedule[0]["out_end"];	
		
		if($ot_hour_calcultation["in_time"] == '')
		{
			$in_time = '';
		}
		else
		{
			$in_time = $ot_hour_calcultation["in_time"];
		}
		
		if($ot_hour_calcultation["out_time"] == '')
		{
			$out_time = '';
		}
		else
		{
			$out_time = $ot_hour_calcultation["out_time"];
		}
		if($ot_hour_calcultation["ot_hour"] =='' or $ot_hour_calcultation["ot_hour"] <=0)
		{
			$ot_hour = 0;
		}
		else
		{
			$ot_hour = $ot_hour_calcultation["ot_hour"];
		}
		
		$this->db->select();
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date", $date);
		$query = $this->db->get("pr_emp_shift_log");
		if($query->num_rows() > 0)
		{
			if($in_time > $late_time and $in_time !='')
			{
				$late_status = 1;
			}
			else
			{
				$late_status = 0;
			}
			$data = array(
						"in_time" => $in_time,
						"out_time" => $out_time,
						"ot_hour" => $ot_hour,
						"late_status" => $late_status
						);
					//print_r($data);
					//echo "LATE: ".$late_time;
			$this->db->where("emp_id", $emp_id);
			$this->db->where("shift_log_date", $date);
			$this->db->update("pr_emp_shift_log", $data);
		}
	}
	
	function holiday_calculation($date)
	{
		$this->db->select("start_date");
		$this->db->where("start_date = '$date'");
		$query = $this->db->get("pr_holiday");
		if($query->num_rows > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function emp_shift_check_process($emp_id, $att_date)
	{
		$this->db->select("shift_id, shift_duty");
		$this->db->from("pr_emp_shift_log");
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date", $att_date);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 )
		{
			foreach($query->result() as $row)
			{
				$shift_duty = $row->shift_duty;
			}
			
			$this->db->select("sh_type");
			$this->db->from("pr_emp_shift_schedule");
			$this->db->where("shift_id", $shift_duty);
			$query1 = $this->db->get();
			$row = $query1->row();
			return $row->sh_type;
		}
		else
		{
			$this->db->select("pr_emp_shift.shift_id, pr_emp_shift.shift_duty");
			$this->db->from("pr_emp_shift");
			$this->db->from("pr_emp_com_info");
			$this->db->where("pr_emp_com_info.emp_id", $emp_id);
			$this->db->where("pr_emp_shift.shift_id = pr_emp_com_info.emp_shift");
			$query2 = $this->db->get();
			//echo $this->db->last_query();
			foreach($query2->result() as $rows)
			{
				$shift_id = $rows->shift_id;
				$shift_duty = $rows->shift_duty;
			}
			
			$data = array(
							'emp_id' 		 => $emp_id,
							'shift_id' 		 => $shift_id,
							'shift_duty' 	 => $shift_duty,
							'shift_log_date' => $att_date
			
			);
			
			$this->db->insert("pr_emp_shift_log", $data);
			
			
			$this->db->select("pr_emp_shift_schedule.sh_type");
			$this->db->from("pr_emp_shift_schedule");
			$this->db->from("pr_emp_shift");
			$this->db->from("pr_emp_com_info");
			$this->db->where("pr_emp_com_info.emp_id", $emp_id);
			$this->db->where("pr_emp_shift.shift_id = pr_emp_com_info.emp_shift");
			$this->db->where("pr_emp_shift.shift_duty = pr_emp_shift_schedule.shift_id");
			$query = $this->db->get();
			//echo $this->db->last_query();
			$row = $query->row();
			return $row->sh_type;
		
		}
	}
	
	function schedule_check($emp_shift)
	{
		$this->db->where("sh_type", $emp_shift);
		$query = $this->db->get("pr_emp_shift_schedule");
		return $query->result_array();
	}
	
	function emp_shift_check($emp_id, $att_date)
	{
		$this->db->select("shift_id, shift_duty");
		$this->db->from("pr_emp_shift_log");
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date", $att_date);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 )
		{
			foreach($query->result() as $row)
			{
				$shift_duty = $row->shift_duty;
			}
			
			$this->db->select("sh_type");
			$this->db->from("pr_emp_shift_schedule");
			$this->db->where("shift_id", $shift_duty);
			$query1 = $this->db->get();
			//echo "$emp_id=".$this->db->last_query();
			$row = $query1->row();
			return $row->sh_type;
		}
		else
		{
			$this->db->select("pr_emp_shift_schedule.sh_type");
			$this->db->from("pr_emp_shift_schedule");
			$this->db->from("pr_emp_shift");
			$this->db->from("pr_emp_com_info");
			$this->db->where("pr_emp_com_info.emp_id", $emp_id);
			$this->db->where("pr_emp_shift.shift_id = pr_emp_com_info.emp_shift");
			$this->db->where("pr_emp_shift.shift_duty = pr_emp_shift_schedule.shift_id");
			$query = $this->db->get();
			//echo $this->db->last_query();
			$row = $query->row();
			return $row->sh_type;
		
		}
	}
	
	function present_check($date, $emp_id)
	{
		//echo $date;
		$year  = trim(substr($date,0,4));
		$month = trim(substr($date,5,2));
		$day   = trim(substr($date,8,2));
		$date_field = "date_$day";
		$att_month = $year."_".$month."-00";
		
		$this->db->select($date_field);
		$this->db->where("emp_id", $emp_id);
		$this->db->where("att_month", $att_month);
		$this->db->where($date_field, "P");
		$query = $this->db->get("pr_attn_monthly");
		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function time_check_in($date, $start_time, $end_time, $table)
	{
		$this->db->select("date_time");
		$this->db->where("trim(substr(date_time,1,10)) = '$date'");
		$this->db->where("trim(substr(date_time,11,19)) BETWEEN '$start_time' and '$end_time'");
		$this->db->order_by("date_time","ASC");
		$this->db->limit("1");
		$query = $this->db->get($table);
		$time ="";
		foreach ($query->result() as $row)
		{
			$time = $row->date_time;
		}
		$time = trim(substr($time,11,19));
		return $time;
	}
	
	function time_check_out($date, $start_time, $end_time, $table)
	{
		$this->db->select("date_time");
		$this->db->where("trim(substr(date_time,1,10)) = '$date'");
		$this->db->where("trim(substr(date_time,11,19)) BETWEEN '$start_time' and '$end_time'");
		$this->db->order_by("date_time","DESC");
		$this->db->limit("1");
		$query = $this->db->get($table);
		$time ="";
		foreach ($query->result() as $row)
		{
			$time = $row->date_time;
		}
		//$time = trim(substr($time,11,19));
		return $time;
	}
	
	function time_check_out2($start_time, $end_time, $table)
	{
		// print_r($table); exit($start_time .', '. $end_time);
		$this->db->select("date_time");
		//$this->db->where("trim(substr(date_time,1,10)) = '$date'");
		$this->db->where("date_time BETWEEN '$start_time' and '$end_time'");
		$this->db->order_by("date_time","DESC");
		$this->db->limit("1");
		$query = $this->db->get($table);
		//echo $this->db->last_query();
		$time ="";
		foreach ($query->result() as $row)
		{
			$time = $row->date_time;
		}
		//$time = trim(substr($time,11,19));
		return $time;
	}
	
	function att_process($att_date){
		date_default_timezone_set('Asia/Dhaka');
		
		$att_table = "att_".date('Y_m',strtotime($att_date));
		$file_name = "data/$att_date.TXT";
		
		if (file_exists($file_name)) 
		{
			//echo "The file $file_name exists";
		 
			if (!$this->db->table_exists($att_table))
			{
				$this->load->dbforge();	
				$fields = array(
								'att_id' 	=> array( 'type' => 'INT','constraint' => '11',  'auto_increment' => TRUE),
								'device_id' => array( 'type' => 'INT','constraint' => '11'),
								'proxi_id'  => array( 'type' => 'INT','constraint' => '11'),
								'date_time' => array( 'type' => 'datetime')
								);
				$this->dbforge->add_field($fields);
				$this->dbforge->add_key('att_id', TRUE);
				$this->dbforge->create_table($att_table);		
			}
			$lines = file($file_name);
			//print_r($lines);
			foreach (array_values($lines) AS $line)
			{
				//list($device_id ,$date ,$time , $prox_no) = explode(' ', trim($line) );
				$device_id = substr($line,0,1);
				$prox_no = substr($line,18,10);
								
				$conferm_date=substr($line,1,9);
				$confer_year=substr($conferm_date,1,4);
				$confer_month=substr($conferm_date,5,2);
				$confer_day=substr($conferm_date,7,2);
				$final_day=$confer_year.'-'.$confer_month.'-'.$confer_day;
				
				$hour=substr($line,11,2);
				$minute=substr($line,13,2);
				$second=substr($line,15,2);
				$final_time=$hour.':'.$minute.':'.$second;
				
				$final_day_time= $final_day.' '.$final_time;
				
				// $result = mysql_query("SELECT * FROM pr_id_proxi where proxi_id='$prox_no'");

				$this->db->select('*');
				$this->db->from('pr_id_proxi');
				$this->db->where('proxi_id', $prox_no);
				$queryss = $this->db->get();

				// $num_rows=count($result);
						 
				// $result1 = mysql_query("SELECT * FROM $att_table where proxi_id= '$prox_no' and date_time='$final_day_time'");

				$this->db->select('*');
				$this->db->from($att_table);
				$this->db->where('proxi_id', $prox_no);
				$this->db->where('date_time', $final_day_time);
				$querys = $this->db->get();

				// $num_rows1=count($result1);
				
				if($queryss->num_rows() > 0)
				{
					if($querys->num_rows() == 0 )
					{
						$data = array(
										'device_id' => $device_id,
										'proxi_id' 	=> $prox_no,
										'date_time'	=> $final_day_time
									);
						$this->db->insert($att_table , $data);
					}
				}
			}
		}
		
	}
	
	
	function earn_leave_process($input_date)
	{
		// Start Automatic Earn Leave Entry
		// ================================
		$this->earn_automatic_entry();
		// End Automatic Earn Leave Entry
		
		$current_date = date("Y-m-d");
		$date = strtotime(date("Y-m-d", strtotime($current_date)) . " -17 day");
		$newdate = date('Y-m-d', $date);
		
		$where="last_update NOT BETWEEN '$newdate' and '$current_date'" ;
		$this->valid_earn_leave_process($where);
		
		$year = date('Y');
		$end_date_year = $year."-12-31";
		if($current_date == $end_date_year)
		{
			$where1="last_update  BETWEEN '$newdate' and '$current_date'" ;
			$this->valid_earn_leave_process($where1);
		}	
		
		//Start Year change activity
		//===========================
		$this->db->select('emp_id,last_update');
		$query=$this->db->get('pr_leave_earn');
		
		foreach ($query->result() as $row)
		{
			$empid = $row-> emp_id;
			$last_update = $row-> last_update;
			$current_year = date("Y");
			$last_update_year = date("Y", strtotime($last_update));
			if($current_year > $last_update_year)
			{
				$this->year_change($empid);
			}
			$max_earn = $this->get_max_earn();
			$this->max_earn_check($empid,$max_earn);
		
		}
		//End Year change activity
	}
	
	function earn_automatic_entry()
	{
		
		$this->db->select('emp_id,emp_join_date');
		$this->db->where("emp_cat_id","1");
		//$this->db->where("emp_id","01010");
		$query = $this->db->get('pr_emp_com_info');
		foreach($query->result() as $rows)
		{
			$empid = $rows->emp_id;
			$join_date = $rows->emp_join_date;
			//$join_date ="2011-11-30";
			//echo $join_date;
			$earn_join_date =  strtotime(date("Y-m-d", strtotime($join_date)) . " +1 year");
		 
			$earn_current_date = strtotime(date("Y-m-d"));
			if($earn_join_date < $earn_current_date)
			{
				$num_row = $this->db->where('emp_id',$empid)->get('pr_leave_earn')->num_rows();
				if ($num_row < 1)
				{
					//echo "----true";
					$data = array(
					'emp_id' => $empid ,
					'old_earn_balance' => "0",
					'current_earn_balance' =>"0",
					"last_update"  => date("Y-m-d")
					);
					$this->db->insert('pr_leave_earn', $data);	
				}
			}
		}
	}
	
	function valid_earn_leave_process($where)
	{
		
		$current_date = date("Y-m-d");
		$this->db->select('*');
		$this->db->where($where);
		$query=$this->db->get('pr_leave_earn');
		foreach ($query->result() as $row)
		{
			
			$emid = $row-> emp_id;
			//echo $emid."***";
			$last_update = $row-> last_update;
			$data["emp_id"][] = $emid;
			$data["last_update"][] = $last_update;
			if($last_update != $current_date)
			{			
				$result = $this->earn_present_check($emid,$last_update,$current_date);
			}
		}
		
	}
	
	function earn_present_check($empid,$last_update,$current_date)
	{
		//echo "hello";
		//$date1 = new DateTime($last_update);
		//$date2 = new DateTime($current_date);
		//$interval = $date1->diff($date2);
		//$day =  $interval->days;
		$day = $this->get_date_to_date_day_differance($last_update,$current_date);
		//echo "$empid,$last_update,$current_date, $day";
		$count = 0;
		
		for($i=0;$i<=$day;$i++)
		{
			//$last_update= "2012-06-01";
			$date = strtotime(date("Y-m-d", strtotime($last_update)) . " +$i day");
			$newdate = date('Y-m-d', $date);
			
			$result = $this->present_check($newdate, $empid);
			if($result == true)
			{
				$count = $count + 1;
			}
			//echo $newdate."<br/>";
			
		}
		
		//echo $count;
		if ($count!=0)
		{
			
			$count = round(($count/18),2);
			$this->db->select('current_earn_balance,old_earn_balance');
			$this->db->where("emp_id", $empid);
			$query = $this->db->get('pr_leave_earn');
			$rows = $query->row();
			$old_earn_balance = $rows->old_earn_balance;
			$current_earn_balance = $rows->current_earn_balance;
			$current_earn_balance = $current_earn_balance + $count;
			$data = array(
               'current_earn_balance' => $current_earn_balance,
			   'last_update'  => date('Y-m-d')
            );
			$this->db->where("emp_id",$empid);
			$this->db->update('pr_leave_earn', $data); 
		}		
			
	}
	
	function get_date_to_date_day_differance($date1,$date2)
	{
		$date_diff 		= strtotime($date2)-strtotime($date1);
		//DATE TO DATE RULE
		return $month 	= floor(($date_diff)/60/60/24);
	}
	
	function year_change($empid)
	{
		//echo $query ->num_rows();
		
		$this->db->select('*');
		$this->db->where("emp_id", $empid);
		$query = $this->db->get('pr_leave_earn');
		
		foreach ($query->result() as $row)
		{
			$old_earn_lv_balance = $row ->old_earn_balance;
			$current_earn_lv_balance = $row -> current_earn_balance;
		}
		
		$old_earn_lv_balance = $old_earn_lv_balance + $current_earn_lv_balance;
		//echo $old_earn_lv_balance ;
		$data = array(
			'old_earn_balance' => $old_earn_lv_balance,
			'current_earn_balance' => "0.00",
			'last_update'  => date('Y-m-d')
		);
		$this->db->where("emp_id",$empid);
		$this->db->update('pr_leave_earn', $data);
	
	}
	
	function max_earn_check($empid,$max_earn)
	{
		$this->db->select('old_earn_balance');
		$this->db->where("emp_id", $empid);
		$query = $this->db->get('pr_leave_earn');
		foreach ($query->result() as $row)
		{
			$old_earn_balance = $row->old_earn_balance;
		}
		
		if($old_earn_balance > $max_earn)
		{
			$data = array(
				'old_earn_balance' => $max_earn
			);
			$this->db->where("emp_id",$empid);
			$this->db->update('pr_leave_earn', $data);
		}
	}
	
	function get_max_earn()
	{
		$this->db->select('max_earn');
		$query_max_earn = $this->db->get('pr_leave_earn_max');
		$rows = $query_max_earn->row();
		$max_earn  = $rows->max_earn ;
		return $max_earn;
	}
	
	function deduction_hour_process($emp_id,$att_date)
	{
		//echo $emp_id."***".$att_date;
		//$emp_id = "01010";
		$this->db->select('*');
		$this->db->where("shift_log_date",$att_date);
		$this->db->where("emp_id",$emp_id);
		$query = $this->db->get('pr_emp_shift_log');
	
		
		foreach ($query->result() as $row)
		{
			$emp_id = $row->emp_id;
			$shift_id = $row->shift_id;
			$out_time = $row->out_time;
			$shift_out_time = $this->get_shift_out_time($shift_id);
				
			if($out_time !="00:00:00")
			{
				$new_shift_out_time = date("h:i:s A", strtotime($shift_out_time));
				$date_shift_out_time = $att_date." ".$new_shift_out_time;
				//echo $new_shift_out_time;
				$first_shift_out_time=trim(substr($new_shift_out_time,9,2));
				
				$new_out_time = date("h:i:s A", strtotime($out_time));
				
				$first_out_time=trim(substr($new_out_time,9,2));
				
				
				if($first_shift_out_time == $first_out_time)
				{
					$date_out_time = $att_date." ".$new_out_time;
					
				}
				else
				{
					 $att_date_new = strtotime(date("Y-m-d", strtotime($att_date)) . " +1 day");
					 $newdate = date ( 'Y-m-d' , $att_date_new );
					 $date_out_time = $newdate." ".$new_out_time;
				}
				 //echo $date_shift_out_time."---".$date_out_time;
				if(strtotime($date_shift_out_time) > strtotime($date_out_time))
				{
					$date1 = new DateTime($date_shift_out_time);
					$date2 = new DateTime($date_out_time);
					$interval = $date1->diff($date2);
					$hour =  $interval->h;
					$min =  $interval->i;
					if($min > 40)
					{
						$hour = $hour +1;
					}
					
					if($hour > 1) $hour = 3; else $hour = 0;
					
					$data = array(
						'deduction_hour' => $hour
					);
					
					$this->db->where("emp_id",$emp_id);
					$this->db->where("shift_log_date",$att_date);
					$this->db->update('pr_emp_shift_log', $data); 
					//echo $emp_id."**".$shift_id."***".$out_time."***".$shift_out_time."***".$hour."***".$min."</n>";
					//echo "fhello";
				}
				else
				{
					//echo "2hello";
					$hour=0;
					$min = 0;
					$data = array(
						'deduction_hour' => $hour
					);
					$this->db->where("emp_id",$emp_id);
					$this->db->where("shift_log_date",$att_date);
					$this->db->update('pr_emp_shift_log', $data); 
				}
			}
			else
			{
				$hour=0;
				$min = 0;
			}
			//echo $emp_id."***".$att_date;
			//echo $emp_id."**".$shift_id."***".$out_time."***".$shift_out_time."***".$hour."***".$min."</n>";
		}

	}
	
	function get_shift_out_time($shift_id)
	{
		$this->db->select('*');
		$this->db->where("shift_id",$shift_id);
		$query = $this->db->get('pr_emp_shift_schedule');
		$rows = $query->row();
		$end_time = $rows->ot_start;
		return $end_time;
	}
	
	function get_setup_attributes($setup_id)
	{
		$this->db->select('value');
		$this->db->where("id",$setup_id);
		$query = $this->db->get('pr_setup');
		$rows = $query->row();
		$setup_value = $rows ->value;
		return $setup_value;
	}
	
	function check_joining($id, $att_date)
	{
		$this->db->select('emp_id,emp_join_date');
		$this->db->where('emp_id',$id);
		$this->db->where('emp_join_date <=',$att_date);
		$query = $this->db->get('pr_emp_com_info');
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		return true;
		else
		return false;
	}

	function check_resign($id, $att_date)
	{
		$this->db->select('emp_id,resign_date');
		$this->db->where('emp_id',$id);
		$this->db->where('resign_date <',$att_date);
		$query = $this->db->get('pr_emp_resign_history');
		//echo $this->db->last_query();
		if($query->num_rows() == 0)
		return true;
		else
		return false;
	}

	function check_left($id, $att_date)
	{
		$this->db->select('emp_id,left_date');
		$this->db->where('emp_id',$id);
		$this->db->where('left_date <',$att_date);
		$query = $this->db->get('pr_emp_left_history');
		//echo $this->db->last_query();
		if($query->num_rows() == 0)
		return true;
		else
		return false;
	}
	
	function check_promotion($id)
	{
		$this->db->select('prev_emp_id,new_emp_id');
		$this->db->where('prev_emp_id',$id);
		$this->db->where('status',2);
		//$this->db->order_by('id','DESC');
		//$this->db->limit(1);
		$query = $this->db->get('pr_incre_prom_pun');
		//echo $this->db->last_query();
		//var_dump($query->result_array()) ;
		if($query->num_rows() >= 1)
		{
			//echo "ase";
			foreach($query->result() as $row)
			{
				$prev_emp_id = $row->prev_emp_id;
				$new_emp_id = $row->new_emp_id;
				
				if($prev_emp_id != $new_emp_id)
				{
					return false;
				}
				else 
					{
					return true;
					}
			}
		}
		else {
			return true;
			}

	}
	
	function attn_delete_for_eligibility_failed($emp_id, $att_date)
	{
		$this->db->select('emp_id');
		$this->db->where('emp_id',$emp_id);	
		$this->db->where('shift_log_date',$att_date);
		$query = $this->db->get('pr_emp_shift_log');	
		if($query->num_rows() > 0 )
		{
			$this->db->where('emp_id',$emp_id);	
			$this->db->where('shift_log_date',$att_date);
			$this->db->delete('pr_emp_shift_log');		
		}
	}	
}