<?php
class Salary_process_model extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->model('pf_model');
		$this->load->model('common_model');
	}
	
	function pay_sheet($year, $month,$process_check)
	{
		$year_v=$year;
		$month_v=$month;
		
		$table_name = "att_".$year_v."_".$month_v;
		
		if(!$this->db->table_exists($table_name))
		{
			return "Process month does not exist, please change your process month";
		}
		
		//==================Salary Block Check==========================
		$year_month = "$year_v-$month_v";
		$num_row = $this->db->like('block_month',$year_month)->get('pr_salary_block')->num_rows();
		if($num_row > 0)
		{
			return "This Month Already Finally Processed.";
		}
		
		
		if($process_check == "2")
		{
		  $block_year_month = "$year_month-01";
		  $data_1['block_month'] 	= $block_year_month;
		  $data_1['username'] 		=  $this->session->userdata('username');
		  $data_1['date_time'] 	= date("Y-m-d H:i:s");
		  $this->db->insert('pr_salary_block', $data_1); 
		  //echo $this->db->last_query();
		}
		//==============================================================
		
		$start_date = date("Y-m-d", mktime(0, 0, 0, $month_v, 1, $year_v));
		$last_date = date("t", mktime(0, 0, 0, $month_v, 1, $year_v));
		
		$end_date = date("Y-m-d", mktime(0, 0, 0, $month_v, $last_date, $year_v));
		
		$year_month = date("Y-m", mktime(0, 0, 0, $month_v, 1, $year_v)); 
		//---5=friday----------------//
		$day_of_week_v=5;   //==== please change this variable $fd = "next Friday"; if you change $day_of_week_v =====//
		
		
		$result=$this-> find_week($year_v,$month_v,$day_of_week_v);
		$no_working_days = $result['no_of_working_days'];
		$num_of_days = $result['num_of_days'];
		
		//$att_register = $this->daily_absent_db($start_date);
		$deduct_id =1;
		$deduct_status = $this->common_model->get_setup_attributes($deduct_id);
		
		//echo $deduct_status ;
		
		
		//print_r($result);
	  
		
		$this->db->select("emp_id,gross_sal,emp_sal_gra_id,emp_desi_id,emp_join_date,salary_type,ot_entitle");
		$this->db->where("emp_id","SO5699");
		$this->db->order_by("emp_id");
		$query = $this->db->get("pr_emp_com_info");
		
		if($query->num_rows() == 0)
		{
			return "Employee information does not exist";
		}
		else
		{
			$serial = 1;
			$data = array();
			foreach($query->result() as $rows)
			{
				set_time_limit(0) ;
				ini_set("memory_limit","512M");
				
				$data["emp_id"] = $rows->emp_id;
				
				$emp_name 	= $this->emp_name($rows->emp_id);
				$emp_id 	= $rows->emp_id; 
				$ot_entitle 	= $rows->ot_entitle;
				//$emp_id="905";
				//echo $rows->emp_id;
				
				$salary_process_eligibility = $this->salary_process_eligibility($emp_id, $start_date);
				if($salary_process_eligibility == true)
				{
				$this->db->select("emp_id");
				// $this->db->where("emp_id",'CU0029');
				$this->db->where("emp_id",$rows->emp_id);
				$query = $this->db->get("pr_pay_scale_sheet");
				
				$emp_desig 	= $this->emp_desig($rows->emp_desi_id);
				$doj 		=  $rows->emp_join_date;
				//==================================LOCAL Salary Rule===================================
				$gross_sal 				= $rows->gross_sal;
				
				//==============================For Increment,promotion,===============================
				$where = "trim(substr(effective_month,1,7)) = '$year_month'";
				$this->db->select("new_salary");
				$this->db->where("new_emp_id",$emp_id);
				$this->db->where($where);
				$inc_prom_entry1 = $this->db->get("pr_incre_prom_pun");
				if($inc_prom_entry1->num_rows() > 0 )
				{
					foreach($inc_prom_entry1->result() as $row)
					{
						$gross_sal = $row->new_salary;
					}
					//echo $gross_sal."---equal to---";
				}
				else
				{
					$where = "trim(substr(effective_month,1,7)) > '$year_month'";
					$this->db->select("prev_salary");
					$this->db->where("new_emp_id",$emp_id);
					$this->db->where($where);
					$this->db->limit(1);
					$inc_prom_entry2 = $this->db->get("pr_incre_prom_pun");
					
					if($inc_prom_entry2->num_rows() > 0 )
					{
						foreach($inc_prom_entry2->result() as $row)
						{
							$gross_sal = $row->prev_salary;
						}
						//echo $gross_sal."---not equal to---";
					}
					else
					{
						echo "";
					}
				
				}
				//============================================End Increment,promotion ======================
				
				//==================================LOCAL Salary Rule===================================
				$salary_structure 		= $this->common_model->salary_structure($gross_sal);
				$conveyance 			= 0;
				$madical_allo 			= $salary_structure['medical_allow'];
				$madical_allo_payable 	= $madical_allo;
				$trans_allow 			= $salary_structure['trans_allow'];
				$food_allow 			= $salary_structure['food_allow'];
				$basic_sal 				= $salary_structure['basic_sal'];
				$basic_sal 				= $basic_sal;
				$basic_sal_payable 		= $basic_sal;
				$house_rent 			= $salary_structure['house_rent'];
				$house_rent 			= $house_rent; 
				$house_rent_payable 	= $house_rent;
							
				//==================================BGMEA Salary Rule===================================
				/*$gross_sal = $rows->gross_sal;
				$basic_sal_payable = ($gross_sal * 60 / 100);
				$house_rent_payable = ($gross_sal * 30 / 100);
				$madical_allo_payable = ($gross_sal * 10 / 100);
				
				
				$basic_sal = round($basic_sal_payable);
				$house_rent = round($house_rent_payable);
				$madical_allo = round($madical_allo_payable);*/
				//==================================BGMEA Salary Rule===================================
				
				$total_sal = $basic_sal + $house_rent + $madical_allo + $food_allow + $trans_allow; 
				
				$data["food_allow"] 	= $food_allow;
				$data["trans_allow"] 	= $trans_allow;
				$data["basic_sal"] = $basic_sal;
				$data["house_r"] = $house_rent;
				$data["medical_a"] = $madical_allo;
				$data["gross_sal"] = $gross_sal;
				$data["total_days"] = $num_of_days;
				$data["num_of_workday"] = $no_working_days;
				
				$salary_month = trim(substr($start_date,0,7));
				$join_month = trim(substr($doj,0,7));
				//echo "==".trim(substr($doj,8,2));
				if($salary_month == $join_month)
				{
					$search_date = $doj;
					$doj_data = $this->get_join_month_dates($doj);
					
					$absent = "A";
					$doj_before_absent = $this->attendance_check($rows->emp_id,$absent,$doj_data['doj_1st_count'], $doj_data['doj_1st_date']);												$doj_after_absent = $this->attendance_check($rows->emp_id,$absent,$doj_data['doj_2nd_count'], $doj_data['doj_3rd_date']);	
					//echo "$emp_id : $doj_before_absent, $doj_after_absent";
					$data["before_after_absent"] = $doj_before_absent;
				}
				else
				{
					$search_date = $start_date;
					$data["before_after_absent"] = 0;
				}
				
				$resign_check = $this->resign_check($emp_id, $salary_month);
				
				if($resign_check != false)
				{
					$total_days = $resign_check;
					
					$resign_data = $this->get_resign_month_dates($resign_check, $salary_month);
										
					$absent = "A";
					//$resign_before_absent = $this->attendance_check($rows->emp_id,$absent,$resign_data['resign_1st_count'], $resign_data['resign_1st_date']);					
					$resign_after_absent = $this->attendance_check($rows->emp_id,$absent,$resign_data['resign_2nd_count'], $resign_data['resign_3rd_date']);	
					//echo "$emp_id : $doj_before_absent, $doj_after_absent";
					$data["before_after_absent"] = 0;//$resign_after_absent;
				}
				else
				{
					$total_days = $num_of_days;
					$data["before_after_absent"] = 0;
				}
				
				$left_check = $this->left_check($emp_id, $salary_month);
				
				if($left_check != false)
				{
					$total_days = $left_check;
				}
				else
				{
					$total_days = $num_of_days;
				}
				
								
				$attend = "P";
				$attend = $this->attendance_check($rows->emp_id,$attend,$total_days, $search_date);
				
				$data["att_days"] = $attend;
				
				$leave_type = "cl";
				$cas_leave = $this->leave_db($rows->emp_id, $search_date, $end_date, $leave_type);
				$data["c_l"] = $cas_leave;
				
				$leave_type = "sl";
				$mad_leave = $this->leave_db($rows->emp_id, $search_date, $end_date, $leave_type);
				$data["s_l"] = $mad_leave;
				
				$leave_type = "el";
				$other_leave = $this->leave_db($rows->emp_id, $search_date, $end_date, $leave_type);
				$data["e_l"] = $other_leave;
				
				$leave_type = "ml";
				$m_leave = $this->leave_db($rows->emp_id, $search_date, $end_date, $leave_type);
				$data["m_l"] = $m_leave;
				
				$total_leave = $cas_leave + $mad_leave + $m_leave + $other_leave;
				
				$weeked = "W";
				$weeked = $this->attendance_check($rows->emp_id,$weeked,$total_days, $search_date);
				
				$holiday = "H";
				$holiday = $this->attendance_check($rows->emp_id,$holiday,$total_days, $search_date);
				
				$data["holidy"] = $holiday;
				
				$data["weeked"] = $weeked;
				
				$total_holiday = $weeked + $holiday;
				$data["holiday_or_weeked"] = $total_holiday;
				
				$absent = "A";
				$absent = $this->attendance_check($rows->emp_id,$absent,$total_days, $search_date);
				
				$data["absent_days"] = $absent;
				
				$pay_days = $attend + $total_holiday + $total_leave;
				
				$data["pay_days"] = $pay_days;
				
				//=====Absent Deduction updated by Kamrul on 22-01-2012====== Start				
				if($salary_month == $join_month or $resign_check != false)
				{
					$before_after_deduct = $gross_sal / $num_of_days * $data["before_after_absent"];
					$deduct = $gross_sal / $num_of_days * $absent;
					$deduct = $deduct + $before_after_deduct;
				}
				else
				{
					//$deduct = $basic_sal / $num_of_days * $absent;
					$deduct = $gross_sal / $num_of_days * $absent;
					$deduct = $deduct;
				}
				
				$data["abs_deduction"] = $deduct;
				//=====Absent Deduction updated by Kamrul on 22-01-2012====== End
				
				$payable_basic_sal_payable 		= ( (($basic_sal_payable / $num_of_days) * ($pay_days + $absent)) -  $deduct);
				//$payable_basic_sal_payable 		= (($basic_sal_payable / $num_of_days) * $pay_days  );
				$payable_house_rent_payable 	= (($house_rent_payable / $num_of_days) * ($pay_days + $absent)  );
				$payable_madical_allo_payable 	= (($madical_allo_payable / $num_of_days) * ($pay_days + $absent)  );
				
				$payable_basic_sal 		= round($payable_basic_sal_payable);
				$payable_house_rent 	= round($payable_house_rent_payable);
				$payable_madical_allo 	= round($payable_madical_allo_payable);
				
				//$payable_total_sal = $payable_basic_sal_payable + $payable_house_rent_payable + $payable_madical_allo_payable; 
				//echo $pay_days;
				if($pay_days != 0)
				{
					if($salary_month == $join_month or $resign_check != false or $left_check != false)
					{
						//echo "first";
						if($num_of_days == $pay_days)
						{
							$payable_total_sal = $gross_sal;
						}
						else
						{
							$payable_total_sal = round($gross_sal / $num_of_days * $pay_days);
						}
					}
					else
					{
						//echo "2nd";
						//$payable_total_sal = round($gross_sal / $num_of_days * $pay_days);
						if($num_of_days == $pay_days)
						{
							$payable_total_sal = $gross_sal;
						}
						else
						{
							$payable_total_sal = $basic_sal_payable + $house_rent_payable + $madical_allo_payable + $food_allow + $trans_allow - $deduct;
						}
					}
				}
				else
				{
					$payable_total_sal = 0;
				}
				
				$data["payable_basic"] = $payable_basic_sal;
				
				$data["payable_house_rent"] = $payable_house_rent;
				
				$data["payable_madical_allo"] = $payable_madical_allo;
				
				$payable_wages 		= $payable_total_sal;		
				$data["pay_wages"]	= $payable_wages;
				 
				$late_count = $this->get_late_count($emp_id,$year,$month);
				$condition_late = $this->common_model->get_setup_attributes('3');
				$att_bouns_present_day = $attend + $total_holiday;				
				if($att_bouns_present_day == $num_of_days)
				{ // echo $late_count;
					if($late_count <= $condition_late)
					{
						$att_bouns = $this->att_bouns_cal($emp_id);
					}
					else
					{
						$att_bouns = 0;
					}
				}
				else
				{
					$att_bouns = 0;
				}
				
				$data["att_bonus"] = $att_bouns;
				
				$transport = $this->transport_cal($emp_id);
				
				if($transport == true)
				{
					$trans_allaw = 0;
				}
				else
				{
					$trans_allaw = 0;
				}
				
				$data["trans_allaw"] = $trans_allaw;
				
				$lunch_allaw = $this->lunch_allaw_cal($emp_id);
				
				if($transport == true)
				{
					$lunch_allaw = 0;
				}
				else
				{
					$lunch_allaw = 0;
				}
				
				$data["lunch_allaw"] = $lunch_allaw;
				
				$others_allaw = $this->others_allaw_cal($emp_id, $salary_month);
				
				$data["others_allaw"] = $others_allaw;
				
				$total_allaw = $att_bouns + $trans_allaw + $lunch_allaw + $others_allaw;
				$data["total_allaw"] = $total_allaw;
				
				
				//========================================= Over Time Calculation ==========================================
				$ot_rate = $salary_structure['ot_rate'];
				$ot_hour = $this->ot_hour($rows->emp_id, $year_month, $ot_rate);
				
				if($ot_hour == '' || $ot_entitle == 1)
				{
					$ot_hour = 0;
				}
				else
				{
					$ot_hour = $ot_hour;
				}
							
				$data["ot_hour"] = $ot_hour;
							
				$data["ot_rate"] = $ot_rate;
				
				$ot_amount = round($ot_hour * $ot_rate);
				
				$data["ot_amount"] = $ot_amount;
				
				//========================================= Extra OT Calculation =============================================
				
				$eot_hour = $this->eot_hour($emp_id, $year_month);
				if($ot_hour == '' || $ot_entitle == 1)
				{
					$eot_hour = 0;
				}
				else
				{
					$eot_hour = $eot_hour;
				}
				$data["eot_hour"] = $eot_hour;
				$eot_amount = round($eot_hour * $ot_rate);
				$data["eot_amount"] = $eot_amount;
				
				$payable_amount = ($payable_wages + $total_allaw + $ot_amount);
				
				$data["gross_pay"] = $payable_amount;
				
				$advance_deduct = $this->advance_loan_deduction($emp_id, $salary_month);
				$data["adv_deduct"] = $advance_deduct;
				
				//PROVIDENT FUNND CALCULATION
				$pf_status = $this->common_model->get_setup_attributes(6);
				if($pf_status == "Yes")
				{
					$check_bank_interest = $this->pf_model->check_bank_interest($start_date);
		
					if($check_bank_interest == false)
					{
						return 'Please insert Bank interest rate of this month for Provident Fund';
					}
					
					$provident_fund = $this->pf_model->provident_fund_calculation($emp_id, $start_date,$doj,$gross_sal,$basic_sal);
					
					$pf 						= $provident_fund["provident_fund"];
					$data["provident_fund"] 	= $provident_fund["provident_fund"];
					$data["pf_bank_interest"] 	= $provident_fund["bank_interest"];
					$data["company_pf"] 		= $provident_fund["company_pf"];
					$data["update_pf"] 			= $provident_fund["update_pf"];
					
				}
				else
				{
					$pf 						= 0;
					$data["provident_fund"] 	= $pf;
					$data["pf_bank_interest"] 	= 0;
					$data["company_pf"] 		= 0;
					$data["update_pf"] 			= 0;
				}
				
				//OTHERS DEDUCTION
				$others_deduct = $this->others_deduct_cal($emp_id, $year_month);
				if($others_deduct == '')
				{
					$others_deduct = 0;
				}
				
				$data["others_deduct"] = $others_deduct;
				
				$total_deduct = $advance_deduct + $pf + $others_deduct;
				$data["total_deduct"] = $total_deduct;
				
				$pbt = $payable_amount - $total_deduct;
				$data["pbt"] = $pbt;
				
				$tax = $this->tax_deduct_cal($emp_id, $year_month);
				if($tax == '')
				{
					$tax = 0;
				}
				$data["tax"] = $tax;
				
				$net_pay = $pbt - $tax;
								
				$data["salary_month"] = $start_date;
				
				//echo $deduct_status;
				if($deduct_status == "Yes")
				{
					//******deduct hour *****************************************************************
					$this->db->select('deduction_hour');
					$this->db->where("trim(substr(shift_log_date,1,7)) = '$salary_month'");
					$this->db->where("emp_id",$rows->emp_id);
					$query_ded = $this->db->get('pr_emp_shift_log');
					$total_deduction_hour = 0;
					foreach ($query_ded->result() as $row)
					{
						$deduction_hour = $row->deduction_hour;
						$total_deduction_hour = $total_deduction_hour + $deduction_hour;
					}
					$data["deduct_hour"] = $total_deduction_hour;
					
					//******End deduct hour ************************************************************************
					
					//************************deduct amount***************************************************** 
					$per_day_salary = $basic_sal/$num_of_days;
					$per_hour_salary = $per_day_salary /8;
					//echo $per_hour_salary;
					$deduct_amount = $per_hour_salary *$total_deduction_hour;
					$data["deduct_amount"] = $deduct_amount;
					//************************end deduct amount***************************************************** 
				}
				
				
				//***************************Festival bonus***********************
				$effective_date = $this->get_bonus_effective_date($salary_month);
				$festival_bonus = 0;
				if($effective_date != false){ 
					$service_month = $this->common_model->get_service_month($effective_date,$doj);
					// 10 is minimum months
					// if($service_month >= 0){
						//echo "$emp_id -'$doj' -  M: ".$service_month; echo '<br>';
					$festival_bonus_rule = $this->get_festival_bonus_rule($service_month,$effective_date);
                       			//print_r($festival_bonus_rule);
					if($festival_bonus_rule){
						$festival_bonus = $this->get_festival_bonus($festival_bonus_rule,$gross_sal,$basic_sal);
					}
				}
				$data["festival_bonus"] = $festival_bonus;
				
				//***************************End of Festival bonus***********************
				//$net_pay = $net_pay + $festival_bonus;
				$data["net_pay"] = $net_pay;
				
				$this->db->select("emp_id");
				$this->db->where("emp_id", $rows->emp_id);
				$this->db->where("salary_month", $start_date);
				$query = $this->db->get("pr_pay_scale_sheet");
				
				if($query->num_rows() > 0 )
				{
					$this->db->where("emp_id", $rows->emp_id);
					$this->db->where("salary_month", $start_date);
					$this->db->update("pr_pay_scale_sheet",$data);
				}
				else
				{
					$this->db->insert("pr_pay_scale_sheet",$data);
				}
			}
			}
			//$data["deduct_status"] = $deduct_status;
			return "Process completed successfully";
		}
	}
		
	function resign_check($emp_id, $salary_month)
	{
		$where = "trim(substr(resign_date,1,7)) = '$salary_month'";
		$this->db->select('resign_date');
		$this->db->where('emp_id', $emp_id);
		$this->db->where($where);
		$query = $this->db->get('pr_emp_resign_history');
		//echo $this->db->last_query();
		if($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			$resign_date = $query->row()->resign_date;
			return $resign_day = substr($resign_date, 8,2);
		}	
	}
	
	function left_check($emp_id, $salary_month)
	{
		$where = "trim(substr(left_date,1,7)) = '$salary_month'";
		$this->db->select('left_date');
		$this->db->where('emp_id', $emp_id);
		$this->db->where($where);
		$query = $this->db->get('pr_emp_left_history');
		//echo $this->db->last_query();
		if($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			$left_date = $query->row()->left_date;
			return $left_day = substr($left_date, 8,2);
		}	
	}
	
	function emp_production($emp_prod)
	{
		$this->db->select("emp_id,salary_type");
		$this->db->where("emp_id",$emp_prod);
		$this->db->where("salary_type",2);
		$query = $this->db->get("pr_emp_com_info");
		if($query->num_rows == 1)
		{
			return $emp_prod;
		}
		else
		{
			return false ;
		}
	}
	
	function others_allaw_cal($emp_id, $salary_month)
	{
		$this->db->select("payment_amount");
		$this->db->where("emp_id", $emp_id);
		$this->db->like("payment_month",$salary_month);
		$query = $this->db->get("pr_payment");
		//echo $this->db->last_query();
		if($query->num_rows > 0)
		{
			$row = $query->row();
			return $row->payment_amount;
		}
		else
		{
			return 0;
		}
	}
	
	function ot_hour($emp_id, $year_month, $ot_rate)
	{
		$this->db->select_sum("ot_hour");
		$this->db->where("emp_id", $emp_id);
		$this->db->like("shift_log_date",$year_month);
		$query = $this->db->get("pr_emp_shift_log");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->ot_hour;
	}
	
	function eot_hour($emp_id, $year_month)
	{
		$this->db->select_sum("extra_ot_hour");
		$this->db->where("emp_id", $emp_id);
		$this->db->like("shift_log_date",$year_month);
		$query = $this->db->get("pr_emp_shift_log");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->extra_ot_hour;
	}
	
	function ot_hour_between_date($emp_id, $start_date, $end_date)
	{
		$this->db->select_sum("ot_hour");
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date BETWEEN '$start_date' AND '$end_date'");
		$query = $this->db->get("pr_emp_shift_log");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->ot_hour;
	}
	
	function eot_hour_between_date($emp_id, $start_date, $end_date)
	{
		$this->db->select_sum("extra_ot_hour");
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date BETWEEN '$start_date' AND '$end_date'");
		$query = $this->db->get("pr_emp_shift_log");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->extra_ot_hour;
	}
	
	function att_bouns_cal($emp_id)
	{
		$this->db->select("pr_attn_bonus.ab_rule");
		$this->db->from("pr_attn_bonus");
		$this->db->from("pr_emp_com_info");
		$this->db->where("pr_emp_com_info.emp_id", $emp_id);
		$this->db->where("pr_emp_com_info.att_bonus = pr_attn_bonus.ab_id");
		$query = $this->db->get();
		$row = $query->row();
		return $row->ab_rule;
	}
	
	function transport_cal($emp_id)
	{
		$this->db->select("transport");
		$this->db->from("pr_emp_com_info");
		$this->db->where("emp_id", $emp_id);
		$query = $this->db->get();
		$row = $query->row();
		if($row->transport == 0 )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function lunch_allaw_cal($emp_id)
	{
		$this->db->select("lunch");
		$this->db->from("pr_emp_com_info");
		$this->db->where("emp_id", $emp_id);
		$query = $this->db->get();
		$row = $query->row();
		if($row->lunch == 0 )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function others_deduct_cal($emp_id, $year_month)
	{
		$this->db->select_sum("others_deduct");
		$this->db->where("emp_id", $emp_id);
		$this->db->like("deduct_month",$year_month);
		$query = $this->db->get("pr_deduct");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->others_deduct;
	}
	
	function tax_deduct_cal($emp_id, $year_month)
	{
		$this->db->select_sum("tax_deduct ");
		$this->db->where("emp_id", $emp_id);
		$this->db->like("deduct_month",$year_month);
		$query = $this->db->get("pr_deduct");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->tax_deduct ;
	}
	
	function emp_name($emp_id)
	{
		$this->db->select("emp_full_name");
		$this->db->where("emp_id",$emp_id);
		$query = $this->db->get("pr_emp_per_info");
		$row = $query->row();
		return $row->emp_full_name;
	}
	
	function emp_desig($desig_id)
	{
		$this->db->select("desig_name");
		$this->db->where("desig_id",$desig_id);
		$query = $this->db->get("pr_designation");
		$row = $query->row();
		return $row->desig_name;
	}
	
	function salary_grade($gr_id)
	{
		$this->db->select("gr_name");
		$this->db->where("gr_id",$gr_id);
		$query = $this->db->get("pr_grade");
		$row = $query->row();
		return $row->gr_name;
	}
	
	function attendance_check($emp_id,$present_status,$num_of_days, $start_date)
	{
		
		$search_date =trim(substr($start_date,0,7));
		$loop_date = trim(substr($start_date,8,2));
		$this->db->select("");
		$this->db->where("emp_id",$emp_id);
		$this->db->like("att_month",$search_date);
		$this->db->group_by('att_month');
		$query = $this->db->get("pr_attn_monthly");
		//echo $this->db->last_query();
		$count = 0;
		foreach($query->result_array() as $rows => $value)
		{
			for($i=$loop_date; $i<= $num_of_days ; $i++)
			{
				$idate = date("d", mktime(0, 0, 0, 0, $i, 0));
				$date="date_$idate";
				
				if($value[$date] == "$present_status")
				{
					$count++;
				}
			}
		}
		return $count;
	}
	
	function find_week($year_v,$month_v,$day_of_week_v)
	{
		//$year_v=2010;
		//$month_v=3;
		//---5=fryday----------------//
		//$day_of_week_v=5;
        $result=array();
		for ($year = $year_v; $year <= $year_v; $year++) 
					{ 
						for ($month = $month_v; $month <= $month_v; $month++) 
							{ 
							$num_of_days = date("t", mktime(0,0,0,$month,1,$year)); 
							$result['num_of_days']=$num_of_days;
						//	echo "Number of days = $num_of_days <BR>"; 
							$firstdayname = date("D", mktime(0, 0, 0, $month, 1, $year)); 
							$firstday = date("w", mktime(0, 0, 0, $month, 1, $year)); 
							$lastday = date("t", mktime(0, 0, 0, $month, 1, $year)); 
				
								for ($day_of_week = $day_of_week_v ; $day_of_week <= $day_of_week_v ; $day_of_week++) 
									{ 
									if ($firstday > $day_of_week) { 
									// means we need to jump to the second week to find the first $day_of_week 
									$d = (7 - ($firstday - $day_of_week)) + 1; 
									} elseif ($firstday < $day_of_week) { 
									// correct week, now move forward to specified day 
									$d = ($day_of_week - $firstday + 1); 
									} else {     
									// my "reversed-engineered" formula 
									if ($lastday==28) // max of 4 occurences each in the month of February with 
					
									$d = ($firstday + 4); 
									elseif ($firstday==4) 
									$d = ($firstday - 2); 
									elseif ($firstday==5 ) 
									$d = ($firstday - 3); 
									elseif ($firstday==6) 
									$d = ($firstday - 4); 
									else 
									$d = ($firstday - 1); 
									if ($lastday==29) // only 1 set of 5 occurences each in the month of 
								   $d -= 1; 
						} 
					
						$d += 28;    // jump to the 5th week and see if the day exists 
						if ($d > $lastday) { 
							$weeks = 4; 
						} else { 
							$weeks = 5; 
						} 
					
					if ($day_of_week==0) ; 
					elseif ($day_of_week==1) ; 
					elseif ($day_of_week==2) ; 
					elseif ($day_of_week==3) ; 
					elseif ($day_of_week==4) ; 
					elseif ($day_of_week==5) ; 
					else echo "Sat "; 
					
					//echo "occurences = $weeks <BR> "; 
					$result['day_of_week']=($day_of_week);
					$result['num_of_days']=$num_of_days;
					$no_of_working_days=$num_of_days-$day_of_week;
					//echo "No of working days  ".$no_of_working_days;
					$result['no_of_working_days']=$no_of_working_days;
					
					} // for $day_of_week loop 
				} // for $mth loop 
		} // for $year loop 

  return $result;

	}
	
	
	function insert_pay_sheet($data)
	{
		$this->db->insert('pr_pay_scale_sheet', $data); 
	}
	
	function update_pay_sheet($data)
	{
		$this->db->where("emp_id",$data['emp_id']);  
		$this->db->update('pr_pay_scale_sheet', $data);
		
	}
	
	function leave_db($emp_id,$start_date,$end_date, $leave_type)
	{
		$where = "trim(substr(start_date,1,10)) BETWEEN '$start_date' and '$end_date'";
		
		$this->db->select('start_date');
		$this->db->where("emp_id",$emp_id);
		$this->db->where("leave_type",$leave_type);
		$this->db->where($where);
		
		$query = $this->db->get('pr_leave_trans');
		
		return $query->num_rows();
	}
	
	function advance_loan_deduction($emp_id, $salary_month)
	{
		$search_year_month = $salary_month;
		$salary_month = "$salary_month-01";
				
		$this->db->select("*");
		$this->db->where("emp_id", $emp_id);
		$this->db->where("loan_status", '1');
		$this->db->like("loan_date",$search_year_month);
		$query = $this->db->get("pr_advance_loan");
		
		if( $query->num_rows() > 0)
		{
			foreach($query->result() as $rows)
			{
				$loan_id	= $rows->loan_id;
				$loan_amt 	= $rows->loan_amt; 	
				$pay_amt  	= $rows->pay_amt;
			}
			
			$this->db->select("emp_id,pay_amount");
			$this->db->where("emp_id", $emp_id);
			$this->db->where("loan_id", $loan_id);
			$this->db->like("pay_month", $salary_month);
			$query1 = $this->db->get("pr_advance_loan_pay_history");
			if( $query1->num_rows() == 0)
			{
				$this->db->select_sum("pay_amount");
				$this->db->where("emp_id", $emp_id);
				$this->db->where("loan_id", $loan_id);
				$query2 = $this->db->get("pr_advance_loan_pay_history");
				//echo $this->db->last_query();
				
				if( $query2->num_rows() > 0)
				{
					$row = $query2->row();
					$total_pay_amount = $row->pay_amount;
				}
				else
				{
					$total_pay_amount = 0;
				}
				
				$rest_loan_amount = $loan_amt - $total_pay_amount;
					
				if($rest_loan_amount > $pay_amt)
				{
					$data = array(
									'pay_id' 	=> '',
									'loan_id' 	=> $loan_id,
									'emp_id'  	=> $emp_id,
									'pay_amount'=> $pay_amt,
									'pay_month' => $salary_month
								);
					if($this->db->insert("pr_advance_loan_pay_history", $data))
					{
						return $pay_amt;
					}
				}
				else
				{
					$data = array(
									'pay_id' 	=> '',
									'loan_id' 	=> $loan_id,
									'emp_id'  	=> $emp_id,
									'pay_amount'=> $rest_loan_amount,
									'pay_month' => $salary_month
								);
					if($this->db->insert("pr_advance_loan_pay_history", $data))
					{
						$this->db->select_sum("pay_amount");
						$this->db->where("emp_id", $emp_id);
						$this->db->where("loan_id", $loan_id);
						$query2 = $this->db->get("pr_advance_loan_pay_history");
						//echo $this->db->last_query();
						
						if( $query2->num_rows() > 0)
						{
							$row = $query2->row();
							$total_pay_amount = $row->pay_amount;
							
							if($total_pay_amount == $loan_amt)
							{
								$data = array(
											'loan_status' => 2
											);
								$this->db->where("emp_id", $emp_id);
								$this->db->where("loan_id", $loan_id);
								$this->db->update("pr_advance_loan", $data);
							}
						}
						return $rest_loan_amount;
					}
				}
				
			}
			else
			{
				$row = $query1->row();
				$pay_amount = $row->pay_amount;
				return $pay_amount;
			}
		}
		else
		{
			$this->db->select("*");
			$this->db->where("emp_id", $emp_id);
			$this->db->where("loan_status", '2');
			$this->db->like("loan_date",$search_year_month);
			$query = $this->db->get("pr_advance_loan");
			
			if( $query->num_rows() > 0)
			{
				foreach($query->result() as $rows)
				{
					$loan_id	= $rows->loan_id;
					$loan_amt 	= $rows->loan_amt; 	
					$pay_amt  	= $rows->pay_amt;
				}
			
				$this->db->select("emp_id,pay_amount");
				$this->db->where("emp_id", $emp_id);
				$this->db->where("loan_id", $loan_id);
				$this->db->like("pay_month", $salary_month);
				$query1 = $this->db->get("pr_advance_loan_pay_history");
				if( $query1->num_rows() == 0)
				{
					return 0;
				}
				else
				{
					$row = $query1->row();
					$pay_amount = $row->pay_amount;
					return $pay_amount;
				}
			}
			else
			{
				return 0;
			}
		}
	}
	
	function get_bonus_status()
	{
		$this->db->select('*');
		$query_fes_bonus = $this->db->get('pr_bonus_rules');
		foreach($query_fes_bonus->result() as $rows)
		{
			$effective_date =  $rows->effective_date;
			list($fes_year, $fes_month, $fes_date) = explode('-', trim($effective_date));
			$fes_bonus_month_table = "att_".$fes_year."_".$fes_month;
		}
		return $fes_bonus_month_table;
	}
	
	function get_bonus_effective_date($salary_month)
	{
		$this->db->select('effective_date');
		$this->db->like('effective_date',$salary_month);
		$query = $this->db->get('pr_bonus_rules');
		//echo $this->db->last_query();
		if($query->num_rows() > 0 ){
			$row = $query->row();
			return $effective_date =  $row->effective_date;
		}else{
			return false;
		}
	}
	
	function get_service_month($effective_date,$doj)
	{
		$date_diff 		= strtotime($effective_date)-strtotime($doj);
		//DATE TO DATE RULE
		//return $month 	= floor(($date_diff)/2592000);
		
		//MONTH TO MONTH RULE
		return $month 	= ceil(($date_diff)/2628000);
	}
	
	function get_festival_bonus_rule($service_month,$effective_date)
	{
		$data = array();
		$this->db->select('*');
		$this->db->where('bonus_first_month <=', $service_month); 
		$this->db->where('bonus_second_month >', $service_month); 
		$this->db->where('effective_date', $effective_date); 
		// $this->db->order_by('effective_date','DESC');
		$this->db->limit(1);
		$query = $this->db->get('pr_bonus_rules');
		//echo $this->db->last_query();
		//echo 'R:'.$num = $query->num_rows().'|';
		if($query->num_rows() > 0){
			$row = $query->row();
			$data['bonus_amount'] 		= $row->bonus_amount;
			$data['amount_fraction'] 	= $row->bonus_amount_fraction;
			$data['bonus_percent'] 		= $row->bonus_percent;
		}
		return $data;
	}
	
	function get_festival_bonus($festival_bonus_rule,$gross_sal,$basic_sal)
	{
		$bonus_amount 		= $festival_bonus_rule['bonus_amount'];
		$amount_fraction 	= $festival_bonus_rule['amount_fraction'];
		$bonus_percent 		= $festival_bonus_rule['bonus_percent']; 
		
		if($bonus_amount == "Gross")
		{
			$salary_for_bonus = $gross_sal;
		}
		else
		{
			$salary_for_bonus = $basic_sal; 
		}
		
		$pre_festival_bonus = $salary_for_bonus * $amount_fraction;
		$festival_bonus = round((($pre_festival_bonus * $bonus_percent)/100));
		return $festival_bonus;
	}
	
	function get_late_count($emp_id,$year,$month)
	{
		$year_month = $year."-".$month;
		$this->db->where("trim(substr(shift_log_date,1,7)) = '$year_month'");
		$this->db->where('emp_id', $emp_id);
		$this->db->where('late_status', '1');
		$this->db->from('pr_emp_shift_log');
		return  $this->db->count_all_results();
	
	}
	
	function get_join_month_dates($doj)
	{
		$data = array();
		$year 		= date('Y', strtotime($doj));
		$month 		= date('m', strtotime($doj));
		$day 		= date('d', strtotime($doj));
		$last_day 	= date('t', strtotime($doj));
		
		$data['doj_1st_date'] 	= date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
		$data['doj_2nd_date'] 	= date("Y-m-d", strtotime("-1 day",strtotime($doj)));
		$data['doj_1st_count'] 	= date("d", strtotime($data['doj_2nd_date']));
		$data['doj_3rd_date'] 	= $doj;
		$data['doj_2nd_count'] 	= $last_day;
		$data['doj_4th_date'] 	= date("Y-m-d", mktime(0, 0, 0, $month, $last_day, $year));
		
		return $data;
	}
	
	function get_resign_month_dates($resign_check, $salary_month)
	{
		$resign_date = "$salary_month-$resign_check";
		$data = array();
		$year 		= date('Y', strtotime($resign_date));
		$month 		= date('m', strtotime($resign_date));
		$day 		= date('d', strtotime($resign_date));
		$last_day 	= date('t', strtotime($resign_date));
		
		$data['resign_1st_date'] 	= date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
		$data['resign_2nd_date'] 	= date("Y-m-d", strtotime("-1 day",strtotime($resign_date)));
		$data['resign_1st_count'] 	= date("d", strtotime($data['resign_2nd_date']));
		$data['resign_3rd_date'] 	= $resign_date;
		$data['resign_2nd_count'] 	= $last_day;
		$data['resign_4th_date'] 	= date("Y-m-d", mktime(0, 0, 0, $month, $last_day, $year));
		
		return $data;
	}
	
	function salary_process_eligibility($emp_id, $salary_month)
	{
		$salary_year_month = date('Y-m', strtotime($salary_month));
		
		$join_check 	= $this->join_range_check($emp_id, $salary_year_month);
		$resign_check 	= $this->resign_range_check($emp_id, $salary_year_month);
		$left_check 	= $this->left_range_check($emp_id, $salary_year_month);
		
		if($join_check != false and $resign_check != false and $left_check != false)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function join_range_check($emp_id, $salary_year_month)
	{
		$this->db->select('emp_join_date');
		$this->db->where('emp_id', $emp_id);
		$this->db->where("trim(substr(emp_join_date,1,7)) <= '$salary_year_month'");
		$query = $this->db->get('pr_emp_com_info');
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
	
	function resign_range_check($emp_id, $salary_year_month)
	{
		$this->db->select('resign_date');
		$this->db->where('emp_id', $emp_id);
		$query = $this->db->get('pr_emp_resign_history');
		//echo $this->db->last_query();
		if($query->num_rows() == 0)
		{
			return true;
		}	
		else
		{
			$this->db->select('resign_date');
			$this->db->where('emp_id', $emp_id);
			$this->db->where("trim(substr(resign_date,1,7)) >= '$salary_year_month'");
			$query = $this->db->get('pr_emp_resign_history');
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
	}
	
	function left_range_check($emp_id, $salary_year_month)
	{
		$this->db->select('left_date');
		$this->db->where('emp_id', $emp_id);
		$query = $this->db->get('pr_emp_left_history');
		//echo $this->db->last_query();
		if($query->num_rows() == 0)
		{
			return true;
		}	
		else
		{
			$this->db->select('left_date');
			$this->db->where('emp_id', $emp_id);
			$this->db->where("trim(substr(left_date,1,7)) >= '$salary_year_month'");
			$query = $this->db->get('pr_emp_left_history');
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
	}
}
?>