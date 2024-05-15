<?php
class Grid_model extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->model('log_model');
		$this->load->model('pf_model');
		$this->load->model('mars_model');
		$this->load->model('salary_process_model');
	}

	function grid_noc_letter($grid_emp_id, $firstdate,$seconddate,$mod){
		// echo "<pre>";print_r($seconddate);exit;
		$this->db->select('pr_emp_left_history.*,pr_emp_com_info.gross_sal, pr_emp_com_info.emp_join_date, pr_grade.gr_name, pr_emp_per_info.emp_full_name, pr_emp_per_info.bangla_nam, pr_emp_per_info.emp_fname, pr_emp_per_info.emp_mname, pr_designation.desig_name, pr_designation.desig_bangla, pr_dept.dept_name, pr_section.sec_name, pr_section.sec_bangla, pr_emp_add.emp_pre_add, pr_emp_add.emp_par_add');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_emp_add');
		$this->db->from('pr_grade');
		$this->db->from('pr_emp_left_history');


		$this->db->where_in('pr_emp_com_info.emp_id', $grid_emp_id);
		$this->db->where('pr_emp_com_info.emp_id = pr_emp_per_info.emp_id');
		$this->db->where('pr_emp_left_history.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_left_history.emp_id = pr_emp_add.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_sal_gra_id = pr_grade.gr_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->order_by("pr_emp_left_history.emp_id");

		// $query = $this->db->get()->result();	
		// echo "<pre>";print_r($mod);exit;

		if ((int) $mod == 1) {
			$left_date1 = date("Y-m-d", strtotime($seconddate));
			$left_date2 = date("Y-m-d", strtotime($firstdate));
			$this->db->where("pr_emp_left_history.left_date  BETWEEN '$left_date2' AND '$left_date1'");
			// echo $left_date1."  ".$left_date2;exit;
		}
		

		if ((int) $mod == 2) {
			$left_date1 = date("Y-m-d", strtotime("-10 day", strtotime($seconddate)));
			$left_date2 = date("Y-m-d", strtotime("-20 day", strtotime($firstdate)));
			$this->db->where("pr_emp_left_history.left_date  BETWEEN '$left_date2' AND '$left_date1'");
		    // echo "<pre>";print_r($seconddate);exit;

		}


		if ((int) $mod == 3) {

			// $left_date = date("Y-m-d", strtotime("-30 day", strtotime($firstdate)));
			// $this->db->where('pr_emp_left_history.left_date <=', $left_date);

			$left_date1 = date("Y-m-d", strtotime("-20 day", strtotime($seconddate)));
			$left_date2 = date("Y-m-d", strtotime("-30 day", strtotime($firstdate)));
			$this->db->where("pr_emp_left_history.left_date  BETWEEN '$left_date2' AND '$left_date1'");
		}

		// 	$query = $this->db->get()->result();	
		// echo "<pre>";print_r($query);exit;

		$query = $this->db->get()->result();	
		// print_r($query);exit;

		if($query) 
		{
			
			return $query;
		}
		else
		{
			return "Requested list is empty";
		}


	}


	function get_common_emp_info($grid_emp_id){

	$this->db->select('
				pr_emp_com_info.emp_id as emp_id,
				pr_emp_com_info.emp_join_date as emp_join_date,
				pr_emp_com_info.ot_entitle as ot_entitle,

				

				pr_emp_per_info.bangla_nam as bangla_nam,
				pr_emp_per_info.emp_fname as emp_fname_bn,
				pr_emp_per_info.emp_mname as emp_mname_bn,
				pr_emp_per_info.emp_religion as emp_religion,
				pr_emp_per_info.emp_sex as emp_sex,
				pr_emp_per_info.emp_dob as emp_dob,



				pr_emp_per_info.emp_marital_status as status, 
				pr_emp_per_info.mobile as mobile, 
				pr_emp_edu.emp_degree as emp_degree,

				pr_id_proxi.proxi_id as proxi_id,
				pr_dept.dept_name as dept_name,
				
				pr_section.sec_name as sec_name,
				pr_line_num.line_name as line_name,
				pr_designation.desig_name as desig_name,
				pr_designation.desig_bangla as desig_bangla,
				pr_grade.gr_name as gr_name,
				pr_emp_shift.shift_name as shift_name,
				pr_emp_add.pre_add_bn,
				pr_emp_add.per_add_bn

			');
			// pr_religions
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_id_proxi');
		$this->db->from('pr_dept');
		$this->db->from('pr_emp_edu');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_designation');

		// $this->db->from('pr_religions');

		$this->db->from('pr_emp_shift');
		$this->db->from('pr_grade');
		$this->db->from('pr_emp_add');


		$this->db->where_in('pr_emp_com_info.emp_id', $grid_emp_id);
		$this->db->where('pr_emp_com_info.emp_id = pr_emp_per_info.emp_id');
		$this->db->where('pr_id_proxi.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
		$this->db->where('pr_emp_com_info.emp_sal_gra_id = pr_grade.gr_id');
		$this->db->where('pr_emp_com_info.emp_id = pr_emp_add.emp_id');

		$this->db->where('pr_emp_per_info.emp_id = pr_emp_edu.emp_id');
		// $this->db->where('pr_emp_com_info.emp_id = pr_emp_add.emp_id');

	
	
		
		
		$this->db->order_by("pr_emp_com_info.emp_id");
		$query = $this->db->get()->result();	

		
		// dd($query); exit;
		if($query) 
		{
			
			return $query;
		}
		else
		{
			return "Requested list is empty";
		}


	}


	function grid_application($grid_emp_id){
		// echo "<pre>";print_r($grid_emp_id); exit;

			$this->db->select('
				pr_emp_com_info.emp_id as emp_id,
				pr_emp_com_info.emp_join_date as emp_join_date,
				pr_emp_com_info.ot_entitle as ot_entitle,

				

				pr_emp_per_info.bangla_nam as bangla_nam,
				pr_emp_per_info.emp_fname as emp_fname_bn,
				pr_emp_per_info.emp_mname as emp_mname_bn,
				pr_emp_per_info.emp_religion as emp_religion,
				pr_emp_per_info.emp_sex as emp_sex,
				pr_emp_per_info.emp_dob as emp_dob,



				pr_emp_per_info.emp_marital_status as status, 
				pr_emp_per_info.mobile as mobile, 
				pr_emp_edu.emp_degree as emp_degree,

				pr_id_proxi.proxi_id as proxi_id,
				pr_dept.dept_name as dept_name,
				
				pr_section.sec_name as sec_name,
				pr_line_num.line_name as line_name,
				pr_designation.desig_name as desig_name,
				pr_designation.desig_bangla as desig_bangla,
				pr_grade.gr_name as gr_name,
				pr_emp_shift.shift_name as shift_name,
				pr_emp_add.pre_add_bn,
				pr_emp_add.per_add_bn

			');
			// pr_religions
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_id_proxi');
		$this->db->from('pr_dept');
		$this->db->from('pr_emp_edu');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_designation');

		// $this->db->from('pr_religions');

		$this->db->from('pr_emp_shift');
		$this->db->from('pr_grade');
		$this->db->from('pr_emp_add');


		$this->db->where_in('pr_emp_com_info.emp_id', $grid_emp_id);
		$this->db->where('pr_emp_com_info.emp_id = pr_emp_per_info.emp_id');
		$this->db->where('pr_id_proxi.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
		$this->db->where('pr_emp_com_info.emp_sal_gra_id = pr_grade.gr_id');
		$this->db->where('pr_emp_com_info.emp_id = pr_emp_add.emp_id');

		$this->db->where('pr_emp_per_info.emp_id = pr_emp_edu.emp_id');
		// $this->db->where('pr_emp_com_info.emp_id = pr_emp_add.emp_id');

	
	
		
		
		$this->db->order_by("pr_emp_com_info.emp_id");
		$query = $this->db->get()->result();	

		
		if($query) 
		{
			
			return $query;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	
// Zuel Ali 15-01-19
// Earn Leave Report
	function grid_earn_leave_report_new($sal_year_month, $grid_emp_id){
		$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name,pr_designation.desig_name, pr_section.sec_name,pr_line_num.line_name, pr_earn_leave.*');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_earn_leave');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_designation');
		$this->db->where_in('pr_earn_leave.emp_id', $grid_emp_id);
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_earn_leave.emp_id');
		$this->db->where('pr_emp_com_info.emp_id = pr_earn_leave.emp_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where("pr_earn_leave.earn_month",$sal_year_month);
		$this->db->order_by("pr_emp_com_info.emp_id");
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->result_array();
		}else{
			return "Requested list is empty!";
		}
	}
	
	//-------------------------------------------------------------------------------------------------
	// Daily Report for Present, Absent, Leave
	//-------------------------------------------------------------------------------------------------
	function grid_daily_report($year, $month, $date, $status, $grid_emp_id)
	{
		
		$day = $year."-".$month."-".$date;
		$att_month  = $year."-".$month."-00";
		$date_field = "pr_attn_monthly.date_$date";

		$this->db->distinct();
		$this->db->select("pr_attn_monthly.emp_id, pr_attn_monthly.date_$date as present_type");
		$this->db->from("pr_attn_monthly");
		$this->db->where_in("pr_attn_monthly.emp_id", $grid_emp_id);
		$this->db->where($date_field, $status);
		$this->db->where("pr_attn_monthly.att_month", $att_month);
		$this->db->order_by("pr_attn_monthly.emp_id");
		$query = $this->db->get();

		if($query->num_rows() == 0)
		{
			return "Requested list is empty";
		}

		foreach($query->result() as $rows)
		{
			$emp_id = $rows->emp_id;
			$present_type = $rows->present_type;

			$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name,pr_emp_per_info.mobile, pr_designation.desig_name, pr_emp_com_info.emp_join_date, pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_id_proxi.proxi_id, pr_emp_shift.shift_name,pr_emp_com_info.emp_cat_id');
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_designation');
			$this->db->from('pr_dept');
			$this->db->from('pr_section');
			$this->db->from('pr_line_num');
			$this->db->from('pr_id_proxi');
			$this->db->from('pr_emp_shift');
			$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
			$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
			$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
			$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
			$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
			$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
			$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
			$this->db->where("pr_emp_per_info.emp_id = '$emp_id'");
			$query = $this->db->get();

			if($status == "L")
			{
				$this->db->select("leave_type");
				$this->db->where("emp_id", $emp_id);
				$this->db->where("start_date", $day);
				$query1 = $this->db->get("pr_leave_trans");
				$row = $query1->row();
				$status = $row->leave_type;
			}else
			{
				$status = $status;
			}

			foreach($query->result() as $rows)
			{
				$emp_id = $rows->emp_id;
				$emp_shift = $rows->shift_name;

				if($status == "P")
				// if(in_array($status, $where))
				{

					$present_check = $this->present_check($day, $emp_id);
					if($present_check == true)
					{
						$this->db->select('in_time, out_time');
						$this->db->from('pr_emp_shift_log');
						$this->db->where("emp_id", $emp_id);
						$this->db->where("shift_log_date", $day);
						$query1 = $this->db->get();
						foreach($query1->result() as $row)
						{
							$emp_shift_check = $this->emp_shift_check($emp_id, $day);
							$in_time = $row->in_time;
							$in_time = $this->get_formated_in_time($emp_id, $in_time, $emp_shift_check);
							$out_time = $row->out_time;
							$out_time = $this->get_formated_out_time($emp_id, $out_time, $emp_shift_check);

						}

					}
				}

				$data["emp_id"][] 		= $rows->emp_id;
				$data["proxi_id"][] 	= $rows->proxi_id;
				$data["emp_name"][] 	= $rows->emp_full_name;
				$data["desig_name"][] 	= $rows->desig_name;
				$data["doj"][] 			= $rows->emp_join_date;
				$data["dept_name"][] 	= $rows->dept_name;
				$data["sec_name"][] 	= $rows->sec_name;
				$data["line_name"][] 	= $rows->line_name;
				$data["mobile"][] 		= $rows->mobile;
				$data["emp_shift"][] 	= $emp_shift;
				if($status == "P")
				// if(in_array($status, $where))
				{
					$data["in_time"][] = $in_time;
					$data["out_time"][] = $out_time;
				}
				$data["status"][] = $status;

			}
		}

		if($data)
		{

			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	//-------------------------------------------------------------------------------------------------
	// Daily Actual Present Report
	//-------------------------------------------------------------------------------------------------
	function grid_actual_present_report($year, $month, $date, $status, $grid_emp_id)
	{
		$day = $year."-".$month."-".$date;
		$att_month  = $year."-".$month."-00";
		$date_field = "pr_attn_monthly.date_$date";
		
		$this->db->distinct();
		$this->db->select("pr_attn_monthly.emp_id");
		$this->db->from("pr_attn_monthly");
		$this->db->where_in("pr_attn_monthly.emp_id", $grid_emp_id);
		$this->db->where($date_field, $status);
		$this->db->where("pr_attn_monthly.att_month", $att_month);
		$this->db->order_by("pr_attn_monthly.emp_id");
		$query = $this->db->get();
		
		if($query->num_rows() == 0)
		{
			return "Requested list is empty";
		}
				
		foreach($query->result() as $rows)
		{
			$emp_id = $rows->emp_id;
			
			$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name, pr_designation.desig_name, pr_emp_com_info.emp_join_date, pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_id_proxi.proxi_id, pr_emp_shift.shift_name,pr_emp_com_info.emp_cat_id');
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_designation');
			$this->db->from('pr_dept');
			$this->db->from('pr_section');
			$this->db->from('pr_line_num');
			$this->db->from('pr_id_proxi');
			$this->db->from('pr_emp_shift');	
			$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
			$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
			$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
			$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
			$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
			$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
			$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
			$this->db->where("pr_emp_per_info.emp_id = '$emp_id'");
			$query = $this->db->get();
			
			if($status == "L")
			{
				$this->db->select("leave_type");
				$this->db->where("emp_id", $emp_id);
				$this->db->where("start_date", $day);
				$query1 = $this->db->get("pr_leave_trans");
				$row = $query1->row();
				$status = $row->leave_type;
			}
			else
			{
				$status = $status;
			}
			
			foreach($query->result() as $rows)
			{
				$emp_id = $rows->emp_id;
				$emp_shift = $rows->shift_name;
				
				if($status == "P")
				{
					
					
					$present_check = $this->present_check($day, $emp_id);
					if($present_check == true)
					{
						$this->db->select('in_time, out_time');
						$this->db->from('pr_emp_shift_log');	
						$this->db->where("emp_id", $emp_id);
						$this->db->where("shift_log_date", $day);
						$query1 = $this->db->get();
						foreach($query1->result() as $row)
						{
							$emp_shift_check = $this->emp_shift_check($emp_id, $day);
							$in_time = $row->in_time;
							$in_time = $this->time_am_pm_format($in_time);
							//$in_time = $this->get_formated_in_time($emp_id, $in_time, $emp_shift_check);
							$out_time = $row->out_time;
							$out_time = $this->time_am_pm_format($out_time);
							//$out_time = $this->get_formated_out_time($emp_id, $out_time, $emp_shift_check);
							
						}
						
					}
				}
				
				$data["emp_id"][] 		= $rows->emp_id;
				$data["proxi_id"][] 	= $rows->proxi_id;
				$data["emp_name"][] 	= $rows->emp_full_name;
				$data["desig_name"][] 	= $rows->desig_name;
				$data["doj"][] 			= $rows->emp_join_date;
				$data["dept_name"][] 	= $rows->dept_name;
				$data["sec_name"][] 	= $rows->sec_name;
				$data["line_name"][] 	= $rows->line_name;
				$data["emp_shift"][] 	= $emp_shift;
				if($status == "P")
				{
					$data["in_time"][] = $in_time;
					$data["out_time"][] = $out_time;
				}
				$data["status"][] = $status;
				
			}
		}
		if($data)
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	
	//-------------------------------------------------------------------------------------------------
	// In-Time format for Buyer
	//-------------------------------------------------------------------------------------------------
	function get_formated_in_time($emp_id, $in_time, $emp_shift)
	{
		$schedule 				= $this->schedule_check($emp_shift);
		$exact_in_time			= $schedule[0]["in_time"];
		
		$exact_time_15min_back = $this->minus_fifteen_minute_from_time($exact_in_time);
		
		if($exact_time_15min_back > $in_time ) 
		{ 
			return $in_time_format = $this->get_buyer_in_time($exact_time_15min_back ,$in_time); 
		} 
		else 
		{ 
			return $in_time = $this->time_am_pm_format($in_time);
		} 
			
	}
	//-------------------------------------------------------------------------------------------------
	// Minus fifteen minute from given time
	//-------------------------------------------------------------------------------------------------
	function minus_fifteen_minute_from_time($time)
	{
		return $time = date("H:i:s",strtotime('-15 minutes',strtotime($time)));
	}
	//-------------------------------------------------------------------------------------------------
	// In-Time format for Buyer
	//-------------------------------------------------------------------------------------------------
	function get_buyer_in_time($exact_time_15min_back ,$in_time)
	{
		$exact_hour_min_sec = $this->get_hour_min_sec($exact_time_15min_back);
		$exact_hour   		= $exact_hour_min_sec['hour'];
		$exact_minute 		= $exact_hour_min_sec['minute'];
		
		$real_hour_min_sec 	= $this->get_hour_min_sec($in_time);
		$real_minute  		= $real_hour_min_sec['minute'];
		$real_second 		= $real_hour_min_sec['second'];
		
		$buyer_minute = $this->create_buyer_minute($real_minute);
		
		$buyer_minute = $buyer_minute + $exact_minute;
		
		return $time_format = date("h:i:s A", mktime($exact_hour, $buyer_minute, $real_second, 0, 0, 0));
		
	}
	//-------------------------------------------------------------------------------------------------
	// Convert Time to Hour, Minute and Second
	//-------------------------------------------------------------------------------------------------
	function get_hour_min_sec($time)
	{
		$data = array();
		$data['hour']   = substr($time,0,2);
		$data['minute'] = substr($time,3,2);
		$data['second'] = substr($time,6,2);
		return $data;
	}
	//-------------------------------------------------------------------------------------------------
	// Convert real minute to buyer minute(Sum of two digit of minute)
	//-------------------------------------------------------------------------------------------------
	function create_buyer_minute($minute)
	{
		$min_1st_digit = substr($minute,0,1);
		$min_2nd_digit = substr($minute,1,1);
		return $buyer_minute  = $min_1st_digit + $min_2nd_digit;
	}
	//-------------------------------------------------------------------------------------------------
	// Out-Time format for Buyer
	//-------------------------------------------------------------------------------------------------
	function get_formated_out_time($emp_id, $out_time, $emp_shift)
	{
		if($out_time =='00:00:00')
		{
			return $out_time ='';
		}
		$schedule 				= $this->schedule_check($emp_shift);
		$out_start				= $schedule[0]["out_start"];
		$ot_start				= $schedule[0]["ot_start"];
		$one_hour_ot_out_time	= $schedule[0]["one_hour_ot_out_time"];
		$two_hour_ot_out_time	= $schedule[0]["two_hour_ot_out_time"];
		
		if($out_start < $out_time) 
		{ 
			if($ot_start > $out_time) 
			{ 
				return $out_time = $this->time_am_pm_format($out_time);
			} 
			elseif($one_hour_ot_out_time > $out_time ) 
			{ 
				return $out_time = $this->get_buyer_in_time($ot_start ,$out_time); 
			}
			elseif($two_hour_ot_out_time > $out_time ) 
			{ 
				return $out_time = $this->get_buyer_in_time($one_hour_ot_out_time ,$out_time); 
			}
			else
			{ 
				return $out_time = $this->get_buyer_in_time($two_hour_ot_out_time ,$out_time); 
			} 
		} 
		else
		{ 
			return $out_time = $this->get_buyer_in_time($two_hour_ot_out_time ,$out_time); 
		} 
	}

	function get_formated_out_time_without_ot($emp_id, $out_time, $emp_shift)
	{
		if($out_time =='00:00:00')
		{
			return $out_time ='';
		}
		$schedule 				= $this->schedule_check($emp_shift);
		$out_start				= $schedule[0]["out_start"];
		$ot_start				= $schedule[0]["ot_start"];
		
		
		if($out_start < $out_time) 
		{ 
			if($ot_start > $out_time) 
			{ 
				return $out_time = $this->time_am_pm_format($out_time);
			}
			else
			{ 
				return $out_time = $this->get_buyer_in_time($ot_start ,$out_time); 
			} 
		} 
		else
		{ 
			return $out_time = $this->get_buyer_in_time($ot_start ,$out_time); 
		} 
	}
	
	//-------------------------------------------------------------------------------------------------
	// Convert 24 Hour Time to AM or PM format
	//-------------------------------------------------------------------------------------------------
	function time_am_pm_format($out_time)
	{
		$hour_min_sec 	= $this->get_hour_min_sec($out_time);
		$hour  			= $hour_min_sec['hour'];
		$minute  		= $hour_min_sec['minute'];
		$second 		= $hour_min_sec['second'];
		
		return $time_format = date("h:i:s A", mktime($hour, $minute, $second, 0, 0, 0));
	}
	
	function grid_daily_out_in_report($year, $month, $date, $status, $grid_emp_id)
	{
		$day = $year."-".$month."-".$date;
		$att_month  = $year."-".$month."-00";
		$date_field = "pr_attn_monthly.date_$date";
		
		$date_field2 = "date_$date";
		
		$this->db->distinct();
		$this->db->select("pr_attn_monthly.emp_id, $date_field");
		$this->db->from("pr_attn_monthly");
		$this->db->where_in("pr_attn_monthly.emp_id", $grid_emp_id);
		//$this->db->where($date_field, $status);
		$this->db->where("pr_attn_monthly.att_month", $att_month);
		$this->db->order_by("pr_attn_monthly.emp_id");
		/*$this->db->order_by("pr_dept.dept_name");
		$this->db->order_by("pr_section.sec_name");
		$this->db->order_by("pr_line_num.line_name");
		$this->db->order_by("pr_designation.desig_name");
		*/
		
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() == 0)
		{
			return "Requested list is empty";
		}
		
		
		
		foreach($query->result() as $rows)
		{
			$emp_id = $rows->emp_id;
			
			$status = $rows->$date_field2;
			
			$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name, pr_designation.desig_name, pr_emp_com_info.emp_join_date, pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_id_proxi.proxi_id, pr_emp_shift.shift_name,pr_emp_com_info.emp_cat_id');
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_designation');
			$this->db->from('pr_dept');
			$this->db->from('pr_section');
			$this->db->from('pr_line_num');
			$this->db->from('pr_id_proxi');
			$this->db->from('pr_emp_shift');	
			//$this->db->from("pr_emp_status");
			$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
			$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
			$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
			$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
			$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
			$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
			$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
			$this->db->where("pr_emp_per_info.emp_id = '$emp_id'");
			
			//$this->db->order_by("pr_dept.dept_name","ASC");
			//$this->db->order_by("pr_section.sec_name","ASC");
			//$this->db->order_by("pr_line_num.line_name","ASC");
			//$this->db->order_by("pr_emp_com_info.emp_id","ASC");
			$query = $this->db->get();
			//echo $this->db->last_query();
			//$put = $query->result_array();
			//print_r($put);
			
			if($status == "L")
			{
				$this->db->select("leave_type");
				$this->db->where("emp_id", $emp_id);
				$this->db->where("start_date", $day);
				$query1 = $this->db->get("pr_leave_trans");
				$row = $query1->row();
				$status = $row->leave_type;
			}
			else
			{
				$status = $status;
			}
			//$emp_shift = $this->emp_shift_check($emp_id, $day);
			
			foreach($query->result() as $rows)
			{
				$emp_id = $rows->emp_id;
				$emp_shift = $rows->shift_name;
				
				if($status == "P")
				{
					
					
					$present_check = $this->present_check($day, $emp_id);
					if($present_check == true)
					{
						$this->db->select();
						$this->db->from('pr_emp_shift_log');	
						$this->db->where("emp_id", $emp_id);
						$this->db->where("shift_log_date", $day);
						$query1 = $this->db->get();
						foreach($query1->result() as $row)
						{
							$emp_shift = $this->emp_shift_check($emp_id, $day);
							$in_time = $row->in_time;
							$in_time = $this->get_formated_in_time($emp_id, $in_time, $emp_shift);
							$out_time = $row->out_time;
							$out_time = $this->get_formated_out_time($emp_id, $out_time, $emp_shift);
						}
						
					}
				}
				else
				{
					$in_time = $status;
					$out_time = $status;
				}
				
				$previous_day_out = $this->get_previous_day_out_status($year, $month, $date, $emp_id);
				if($previous_day_out =='00:00:00')
				{
					$previous_day_out = 'P(Error)';
				}
				elseif($previous_day_out !='A' and $previous_day_out !='L' and $previous_day_out !='W' and $previous_day_out !='H')
				{
					$current_date  = date("Y-m-d", mktime(0, 0, 0, $month, $date, $year));
					$previous_date = date("Y-m-d", strtotime("-1 day", strtotime($current_date)));
					
					$emp_shift = $this->emp_shift_check($emp_id, $previous_date);
					$previous_day_out  = $this->get_formated_out_time($emp_id, $previous_day_out, $emp_shift);
				}
								
				$emp_cat_id = $rows->emp_cat_id;
				
				if($emp_cat_id == 1 || $emp_cat_id == 2 || $emp_cat_id == 5)
				{
					$data["emp_id"][] = $rows->emp_id;
					$data["proxi_id"][] = $rows->proxi_id;
					$data["emp_name"][] = $rows->emp_full_name;
					$data["desig_name"][] = $rows->desig_name;
					$data["doj"][] = $rows->emp_join_date;
					$data["dept_name"][] = $rows->dept_name;
					$data["sec_name"][] = $rows->sec_name;
					$data["line_name"][] = $rows->line_name;
					$data["emp_shift"][] = $emp_shift;
					$data["in_time"][] = $in_time;
					$data["out_time"][] = $out_time;
					$data["status"][] = $status;
					$data["p_out"][] = $previous_day_out;
				}
			}
			//print_r($data);
		}
		if($data)
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	
	function get_previous_day_out_status($year, $month, $date, $emp_id)
	{
		$current_date  = date("Y-m-d", mktime(0, 0, 0, $month, $date, $year));
		$previous_date = date("Y-m-d", strtotime("-1 day", strtotime($current_date)));
		
		$previous_day = date("d", strtotime($previous_date));
		
		$att_month  = $year."-".$month."-00";
		$date_field = "pr_attn_monthly.date_$previous_day";
		
		$date_field2 = "date_$previous_day";
		
		$this->db->distinct();
		$this->db->select("pr_attn_monthly.emp_id, $date_field");
		$this->db->from("pr_attn_monthly");
		$this->db->where("pr_attn_monthly.emp_id", $emp_id);
		$this->db->where("pr_attn_monthly.att_month", $att_month);
		$query = $this->db->get();	
		$row = $query->row();
		$status = $row->$date_field2;
		if($status =='P')
		{
			return $out_time = $this->get_out_time($emp_id, $previous_date);
		}
		else
		{
			return $status;
		}
	}
	
	function get_out_time($emp_id, $previous_date)
	{
		$this->db->distinct();
		$this->db->select('out_time');
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date", $previous_date);
		$query = $this->db->get('pr_emp_shift_log');
		$row = $query->row();
		return $out_time = $row->out_time;
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
	
	function attendance_check($date, $emp_id, $status)
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
		$this->db->where($date_field, $status);
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
	
	function schedule_check($emp_shift)
	{
		$this->db->where("sh_type", $emp_shift);
		$query = $this->db->get("pr_emp_shift_schedule");
		return $query->result_array();
	}
	
	function time_check_in($date, $start_time, $end_time, $table)
	{
		$this->db->select("date_time");
		$this->db->where("trim(substr(date_time,1,10)) = '$date'");
		$this->db->where("trim(substr(date_time,11,19)) BETWEEN '$start_time' and '$end_time'");
		$this->db->order_by("date_time","ASC");
		$this->db->limit("1");
		$query = $this->db->get($table);
		//echo $this->db->last_query();
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
	function grid_daily_late_report($year, $month, $date, $grid_emp_id)
	{
				
		$date = date("Y-m-d", mktime(0, 0, 0, $month, $date, $year));
		
		$data = $this->late_commer($year, $month, $date, $grid_emp_id);
		
		//print_r($data);
		if(!isset($data["emp_id"]))
		{
			return "Requested list is empty";
		}
		else
		{
			return $data;
		}
		/*$emp_table = "temp_100009";
		$late_id = $this->late_commer($date, 100009, $emp_table);*/
		
	}
	
	function late_commer($year, $month, $date, $grid_emp_id)
	{
		$data =array();
		
		$this->db->select("pr_emp_shift_log.*");
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("pr_emp_shift_log.emp_id", $grid_emp_id);
		$this->db->where("pr_emp_shift_log.shift_log_date", $date);
		$this->db->where("pr_emp_shift_log.late_status", 1);
		$this->db->order_by("pr_emp_shift_log.emp_id");
		$query = $this->db->get();
		//echo $this->db->last_query();
		foreach($query->result() as $rows)
		{
			$emp_id = $rows->emp_id;
			$in_out_time = $rows->in_time;
			
			$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name, pr_designation.desig_name, pr_emp_com_info.emp_join_date, pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_id_proxi.proxi_id, pr_emp_shift.shift_name ,pr_emp_com_info.emp_cat_id');
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_designation');
			$this->db->from('pr_dept');
			$this->db->from('pr_section');
			$this->db->from('pr_line_num');
			$this->db->from('pr_emp_shift');
			$this->db->from('pr_id_proxi');
			$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
			$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
			$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
			$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
			$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
			$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
			$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
			$this->db->where("pr_emp_per_info.emp_id = '$emp_id'");
			
			$query = $this->db->get();
			
			foreach($query->result() as $rows)
			{
				$emp_cat_id = $rows->emp_cat_id;
			
				$data["emp_id"][] = $rows->emp_id;
				$data["proxi_id"][] = $rows->proxi_id;
				$data["emp_name"][] = $rows->emp_full_name;
				$data["desig_name"][] = $rows->desig_name;
				$data["doj"][] = $rows->emp_join_date;
				$data["dept_name"][] = $rows->dept_name;
				$data["sec_name"][] = $rows->sec_name;
				$data["line_name"][] = $rows->line_name;
				$data["shift_name"][] =$rows->shift_name;
				$data["in_time"][] = $in_out_time;
			}
		}
	return $data;
	}
	
	function grid_daily_attendance_summery($year, $month, $date, $grid_emp_id)
	{
		$data =array();
		$report_date = date("Y-m-d", mktime(0, 0, 0, $month, $date, $year));
				
		$this->db->select('emp_id');
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("emp_id", $grid_emp_id);
		$this->db->where("shift_log_date", $report_date);
		$this->db->group_by('emp_id');
		$data['all_emp'] = $this->db->get()->num_rows();
		//echo $this->db->last_query();
				
		$this->db->select("pr_emp_shift_log.emp_id");
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("pr_emp_shift_log.emp_id", $grid_emp_id);
		$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
		$this->db->where("pr_emp_shift_log.in_time !=", "00:00:00");
		$this->db->group_by('pr_emp_shift_log.emp_id');
		$data['all_present'] = $this->db->get()->num_rows();
		
		$this->db->select("emp_id");
		$this->db->from("pr_leave_trans");
		$this->db->where_in("emp_id", $grid_emp_id);
		$this->db->where("start_date", $report_date);
		$this->db->group_by('emp_id');
		$data['all_leave'] = $this->db->get()->num_rows();
				
		$this->db->select("pr_emp_shift_log.emp_id");
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("pr_emp_shift_log.emp_id", $grid_emp_id);
		$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
		$this->db->where("pr_emp_shift_log.in_time", "00:00:00");
		$this->db->group_by('pr_emp_shift_log.emp_id');
		$all_absent = $this->db->get()->num_rows();
		$all_absent = $all_absent - $data['all_leave'];
		$data['all_absent'] = $all_absent;
		
		
		
		$this->db->select("pr_emp_shift_log.emp_id");
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("pr_emp_shift_log.emp_id", $grid_emp_id);
		$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
		$this->db->where("pr_emp_shift_log.late_status",1);
		$this->db->group_by('pr_emp_shift_log.emp_id');
	 	$data['all_late'] = $this->db->get()->num_rows();
		
		print_r($data);
	}
	
	function grid_daily_out_punch_miss_report($year, $month, $date, $grid_emp_id)
	{
		$data = $this->daily_out_punch_miss($year, $month, $date, $grid_emp_id);
		
		//print_r($data);
		if(!isset($data["emp_id"]))
		{
			return "Requested list is empty";
		}
		else
		{
			return $data;
		}
		/*$emp_table = "temp_100009";
		$late_id = $this->late_commer($date, 100009, $emp_table);*/
		
	}	
	function daily_out_punch_miss($year, $month, $date, $grid_emp_id)
	{
		$data =array();
		$day = date("Y-m-d", mktime(0, 0, 0, $month, $date, $year));
		$date = $day;
		
		$this->db->select("pr_emp_shift_log.*");
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("pr_emp_shift_log.emp_id", $grid_emp_id);
		$this->db->where("pr_emp_shift_log.shift_log_date", $date);
		$this->db->order_by("pr_emp_shift_log.emp_id");
		$query = $this->db->get();
		foreach($query->result() as $rows)
		{
			$emp_id = $rows->emp_id;
			
			$in_time = $rows->in_time;
			
			$in_out_time = $rows->out_time;
			
			if( $in_time != "00:00:00" and $in_out_time == "00:00:00")
			{
				//echo "<br>$emp_id=> IN=$in_time#####OUT=$in_out_time";
				
				$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name, pr_designation.desig_name, pr_emp_com_info.emp_join_date, pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_id_proxi.proxi_id, pr_emp_shift.shift_name ,pr_emp_com_info.emp_cat_id');
				$this->db->from('pr_emp_per_info');
				$this->db->from('pr_emp_com_info');
				$this->db->from('pr_designation');
				$this->db->from('pr_dept');
				$this->db->from('pr_section');
				$this->db->from('pr_line_num');
				$this->db->from('pr_emp_shift');
				$this->db->from('pr_id_proxi');
				$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
				$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
				$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
				$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
				$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
				$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
				$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
				$this->db->where("pr_emp_per_info.emp_id = '$emp_id'");
			
				$query = $this->db->get();
				
				$emp_shift = $this->emp_shift_check($emp_id, $day);
				$in_time = $this->get_formated_in_time($emp_id, $in_time, $emp_shift);
				
			
				foreach($query->result() as $rows)
				{
					$data["emp_id"][] = $rows->emp_id;
					$data["proxi_id"][] = $rows->proxi_id;
					$data["emp_name"][] = $rows->emp_full_name;
					$data["desig_name"][] = $rows->desig_name;
					$data["doj"][] = $rows->emp_join_date;
					$data["dept_name"][] = $rows->dept_name;
					$data["sec_name"][] = $rows->sec_name;
					$data["line_name"][] = $rows->line_name;
					$data["shift_name"][] =$rows->shift_name;
					$data["in_time"][] = $in_time;
				}
			}
		}
	return $data;
	}
	
	function yearly_leave_report($grid_firstdate, $status, $grid_emp_id){
		$data = array();
		$this->db->select('com.emp_id, per.emp_full_name, proxi.proxi_id, deg.desig_name, dept.dept_name, sec.sec_name, line.line_name, com.emp_join_date ');
		
		$this->db->from('pr_emp_com_info com');
		$this->db->join('pr_emp_per_info per','per.emp_id = com.emp_id','left');
		$this->db->join('pr_dept dept','dept.dept_id = com.emp_dept_id','left');
		$this->db->join('pr_section sec','sec.sec_id = com.emp_sec_id','left');
		$this->db->join('pr_line_num line','line.line_id = com.emp_line_id','left');
		$this->db->join('pr_designation deg','deg.desig_id = com.emp_desi_id','left');
		$this->db->join('pr_id_proxi proxi','proxi.emp_id = com.emp_id','left');
		$this->db->where_in('com.emp_id',$grid_emp_id);
		$query = $this->db->get();
		if($query->num_rows() == 0){exit('Data not found!');}
		$i = 0;
		foreach ($query->result_array() as $key => $value) {
			$cY 	= date('Y',strtotime($grid_firstdate));
			$jDM 	= date('m-d',strtotime($value['emp_join_date']));
			
			$checkDate 	= $cY .'-'. $jDM;
			if($checkDate > date('Y-m-d',strtotime($grid_firstdate))){
				$fDate = date("Y-m-d", strtotime('-1 year +1 day'.$checkDate));
				$lDate = $checkDate;
			}else{
				$fDate = $checkDate;
				$lDate = date("Y-m-d", strtotime('+1 year -1 day'.$checkDate));
			}
			// echo $value['emp_id'].', '.$fDate.', '.$lDate.'<br>';

			$leaveInfo = $this->db->where('emp_id',$value['emp_id'])
									->where("start_date BETWEEN '$fDate' AND '$lDate'")
									->get('pr_leave_trans')
									->num_rows();
			// echo $this->db->last_query();exit;
			if($leaveInfo > 0){
				$data[$key] = $value;
				$data[$key]['start_date'] = $fDate;
				$data[$key]['end_date'] = $lDate;
				$data[$key]['leave'] = $leaveInfo;
				$i++;
			}
		}

		if(empty($data)){exit('Data not found!');}
/*
		echo "<pre>";
		print_r($data);
		exit;*/		
		return $data;
	}
	
	
	function continuous_report($grid_firstdate, $grid_seconddate, $status, $grid_emp_id)
	{
		$data = array();
		$date_array = $this->GetDays($grid_firstdate, $grid_seconddate);
		// print_r($date_array);exit('ali');
		
		foreach($grid_emp_id as $emp_id)
		{
			if($emp_id != '')
			{
				$count = 0;
				foreach($date_array as $date)
				{
					//echo "$emp_id=>$date<br>";
					
					$present_check = $this->attendance_check($date, $emp_id, $status);
					if($present_check == true)
					{
						 $count++;
					}
				}
				if($count != 0)
				{
					//$data["emp_id"][] = $emp_id;
					//$data["count"][] = $count;
					
					$this->db->select('pr_emp_per_info.emp_full_name, pr_id_proxi.proxi_id, pr_designation.desig_name, pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_emp_com_info.emp_join_date ');
					$this->db->from('pr_emp_per_info');
					$this->db->from('pr_emp_com_info');
					$this->db->from('pr_dept');
					$this->db->from('pr_section');
					$this->db->from('pr_line_num');
					$this->db->from('pr_designation');
					$this->db->from('pr_id_proxi');
					$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
					$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
					$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
					$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
					$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
					$this->db->where("pr_emp_com_info.emp_id = pr_id_proxi.emp_id");
					$this->db->where("pr_emp_com_info.emp_id",$emp_id);
					
					$query1 = $this->db->get();
					foreach($query1->result_array() as $rows)
					{
						$emp_full_name=$rows["emp_full_name"];
						$proxi_id=$rows["proxi_id"];
						$desig_name=$rows["desig_name"];
						$dept_name=$rows["dept_name"];
						$sec_name=$rows["sec_name"];
						$line_name=$rows["line_name"];
						$emp_join_date=$rows["emp_join_date"];
						
						$data['empid'][]=$emp_id ;
						$data['proxid'][]=$proxi_id ;
						$data['fullname'][]=$emp_full_name ;
						$data['jdate'][]=$emp_join_date ;
						$data['dept_name'][]=$dept_name ;
						$data['sec_name'][]=$sec_name ;
						$data['line_name'][]=$line_name ;
						$data['desig'][]=$desig_name ;
						$data['total'][]=$count ;
					}
					
				
				}
			}
		}
		//print_r($data);
		if($data)
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
				
	}
	
	function continuous_late_report($grid_firstdate, $grid_seconddate, $grid_emp_id)
	{
		$days = $this->GetDays($grid_firstdate, $grid_seconddate);
		
		$data =array();
		//$all_emp = $this->all_emp();
		$firstdate = date("Y-m-d",strtotime($grid_firstdate));
		$seconddate = date("Y-m-d",strtotime($grid_seconddate));
		//echo $first_fate;
		$this->db->select("pr_emp_com_info.emp_id");
		$this->db->from("pr_emp_com_info");
		$this->db->or_where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		$this->db->order_by("pr_emp_com_info.emp_id");
		$query = $this->db->get();
		foreach($query->result() as $rows)
		{
			$count = 0;
			$emp_id = $rows->emp_id;
			$emp_table = "temp_$emp_id";
			
			$count = $this->db->where('emp_id',$emp_id)->where('shift_log_date >=',$firstdate)->where('shift_log_date <=',$seconddate)->where('late_status',1)->get('pr_emp_shift_log')->num_rows();
			//echo $this->db->last_query();
			/*foreach($days as $date)
			{			
				$emp_shift = $this->emp_shift_check($emp_id, $date);
			
				$schedule = $this->schedule_check($emp_shift);
				//print_r($schedule);
				$late_start =  $schedule[0]["late_start"]; 
				$intime_end =  $schedule[0]["in_end"];
				$present_check = $this->present_check($date, $emp_id);
				if( $present_check == true)
				{
					$in_out_time = $this->time_check_in($date, $late_start, $intime_end, $emp_table);
								
					if($in_out_time != '')
					{
						$count++;
					}
				}
			}*/
			if($count != 0 )
			{
				//echo "$emp_id=>$count<br>";
				$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name, pr_designation.desig_name, pr_emp_com_info.emp_join_date, pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_id_proxi.proxi_id, pr_emp_shift.shift_name ,pr_emp_com_info.emp_cat_id');
				$this->db->from('pr_emp_per_info');
				$this->db->from('pr_emp_com_info');
				$this->db->from('pr_designation');
				$this->db->from('pr_dept');
				$this->db->from('pr_section');
				$this->db->from('pr_line_num');
				$this->db->from('pr_emp_shift');
				$this->db->from('pr_id_proxi');
				$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
				$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
				$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
				$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
				$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
				$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
				$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
				$this->db->where("pr_emp_per_info.emp_id = '$emp_id'");
				$query = $this->db->get();
				
				foreach($query->result() as $rows)
				{
					$emp_cat_id = $rows->emp_cat_id;
					
					if($emp_cat_id == 1 || $emp_cat_id == 2 || $emp_cat_id == 5)
					{
						$data["emp_id"][] = $rows->emp_id;
						$data["proxi_id"][] = $rows->proxi_id;
						$data["emp_name"][] = $rows->emp_full_name;
						$data["desig_name"][] = $rows->desig_name;
						$data["doj"][] = $rows->emp_join_date;
						$data["dept_name"][] = $rows->dept_name;
						$data["sec_name"][] = $rows->sec_name;
						$data["line_name"][] = $rows->line_name;
						$data["shift_name"][] =$rows->shift_name;
						$data["count"][] = $count;
					}
				}
			}
		}
		
		if($data)
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
				
	}
	
	function continuous_incre_report($grid_firstdate,$grid_seconddate,$grid_emp_id)
	{
		$data = array();
		foreach($grid_emp_id as $emp_id)
		{  

			$this->db->select('
								pr_incre_prom_pun.prev_emp_id,
								pr_incre_prom_pun.new_emp_id,
								pr_incre_prom_pun.prev_dept,
								pr_incre_prom_pun.new_dept,
								pr_incre_prom_pun.prev_section,
								pr_incre_prom_pun.new_section,
								pr_incre_prom_pun.prev_line, 
								pr_incre_prom_pun.new_line, 
								pr_incre_prom_pun.prev_desig,
								pr_incre_prom_pun.new_desig,
								pr_incre_prom_pun.prev_salary,
								pr_incre_prom_pun.new_salary,
								pr_incre_prom_pun.effective_month,
								pr_emp_per_info.emp_full_name
							');
			$this->db->from('pr_incre_prom_pun');
			$this->db->from('pr_emp_per_info');
			$this->db->where('pr_incre_prom_pun.prev_emp_id = pr_emp_per_info.emp_id');
			$this->db->where("ref_id",$emp_id);
			$this->db->where("status","1");
			$where ="effective_month BETWEEN '$grid_firstdate' and '$grid_seconddate'";
			$this->db->where($where);
			$this->db->order_by("effective_month","desc");

			$query = $this->db->get();
				if($query->num_rows() != 0)
			{
				foreach ($query->result() as $rows)	
				{
					$data["prev_emp_id"][] 				= $rows->prev_emp_id;
					$data["new_emp_id"][] 				= $rows->new_emp_id;
					$data["name"][] 				    = $rows->emp_full_name;
					$prev_dept_name = $this->get_dept_name($rows->prev_dept);
					$prev_section_name = $this->get_section_name($rows->prev_section);
					$prev_line_name = $this->get_line_name($rows->prev_line);
					$prev_desig_name = $this->get_desig_name($rows->prev_desig);
					
					$data["prev_dept"][] 				= $prev_dept_name;
					$data["prev_section"][] 			= $prev_section_name;
					$data["prev_line"][] 				= $prev_line_name;
					$data["prev_desig"][]				= $prev_desig_name;
					$data["prev_salary"][] 				= $rows->prev_salary;;
					
					$new_dept_name = $this->get_dept_name($rows->new_dept);
					$new_section_name = $this->get_section_name($rows->new_section);
					$new_line_name = $this->get_line_name($rows->new_line);
					$new_desig_name = $this->get_desig_name($rows->new_desig);
					
					$data["new_dept"][] 				= $new_dept_name;
					$data["new_section"][] 				= $new_section_name;
					$data["new_line"][] 				= $new_line_name;
					$data["new_desig"][] 				= $new_desig_name;
					$data["new_salary"][] 				= $rows->new_salary;;
					$data["effective_month"][] 			= $rows->effective_month;
				

					
				}
			}
		}
		
		// echo "<pre>";print_r($data['name']);exit;
		if($data)
		{  			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	
	function continuous_prom_report($grid_firstdate,$grid_seconddate,$grid_emp_id)
	{ 
		$data = array();
		foreach($grid_emp_id as $emp_id)
		{
			
			//echo $emp_id;
			$this->db->select('prev_emp_id,new_emp_id,prev_dept,new_dept,prev_section,new_section,prev_line, new_line, prev_desig,new_desig,prev_salary,new_salary,effective_month');
			$this->db->where("ref_id",$emp_id);
			$this->db->where("status","2");
			$this->db->where("effective_month BETWEEN '$grid_firstdate' and '$grid_seconddate'");
			$this->db->order_by("effective_month","DESC");
			$query = $this->db->get('pr_incre_prom_pun');
			//echo $query->num_rows();
			if($query->num_rows() != 0)
			{
				foreach ($query->result() as $rows)	
				{
					$data["prev_emp_id"][] 				= $rows->prev_emp_id;
					$data["new_emp_id"][] 				= $rows->new_emp_id;
					//$data["emp_name"][] 				= $rows->emp_full_name;
					$prev_dept_name = $this->get_dept_name($rows->prev_dept);
					$prev_section_name = $this->get_section_name($rows->prev_section);
					$prev_line_name = $this->get_line_name($rows->prev_line);
					$prev_desig_name = $this->get_desig_name($rows->prev_desig);
					
					$data["prev_dept"][] 				= $prev_dept_name;
					$data["prev_section"][] 			= $prev_section_name;
					$data["prev_line"][] 				= $prev_line_name;
					$data["prev_desig"][]				= $prev_desig_name;
					$data["prev_salary"][] 				= $rows->prev_salary;;
					
					$new_dept_name = $this->get_dept_name($rows->new_dept);
					$new_section_name = $this->get_section_name($rows->new_section);
					$new_line_name = $this->get_line_name($rows->new_line);
					$new_desig_name = $this->get_desig_name($rows->new_desig);
					
					$data["new_dept"][] 				= $new_dept_name;
					$data["new_section"][] 				= $new_section_name;
					$data["new_line"][] 				= $new_line_name;
					$data["new_desig"][] 				= $new_desig_name;
					$data["new_salary"][] 				= $rows->new_salary;;
					$data["effective_month"][] 			= $rows->effective_month;
					
				}
			}
		}
		
		//$data["new_emp_id"] = array_unique($data["new_emp_id"]);
		//print_r($data);
		if($data)
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	
	function grid_app_letter($grid_emp_id)
	{
		
		$this->db->select('pr_emp_com_info.emp_id,
			pr_emp_com_info.gross_sal,pr_emp_per_info.emp_full_name, 
			pr_emp_per_info.bangla_nam, 
			pr_emp_per_info.emp_fname,
			pr_emp_per_info.emp_mname, 
			pr_designation.desig_name, 
			pr_designation.desig_bangla, 
			pr_emp_com_info.emp_join_date, 
			pr_emp_com_info.emp_sal_gra_id , 
			pr_dept.dept_name, 
			pr_section.sec_name, 
			pr_section.sec_bangla, 
			pr_id_proxi.proxi_id, 
			pr_emp_per_info.emp_fname as emp_fname_bn,
			pr_emp_per_info.emp_mname as emp_mname_bn,
			pr_emp_add.pre_add_bn,
			pr_emp_add.per_add_bn

			');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_id_proxi');
		$this->db->from('pr_emp_add');
		$this->db->or_where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_id_proxi.emp_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_add.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		
		$this->db->order_by("pr_emp_com_info.emp_id");
		$query = $this->db->get();
		
		if($query->num_rows() == 0)
		{
			return "Employee ID range does not exist!";
			
		}
		else
		{
			return $query;	
		}
		//print_r($query->result_array());
	
	}



	function grid_nominee_form($grid_emp_id)
	{
		
		$this->db->select('pr_emp_com_info.emp_id,
			pr_emp_sex.sex_name,
			pr_emp_per_info.emp_dob,
			pr_emp_com_info.gross_sal,pr_emp_per_info.emp_full_name, 
			pr_emp_per_info.bangla_nam, 
			pr_emp_per_info.emp_fname,
			pr_emp_per_info.emp_mname, 
			pr_designation.desig_name, 
			pr_designation.desig_bangla, 
			pr_emp_com_info.emp_join_date, 
			pr_emp_com_info.emp_sal_gra_id , 
			pr_dept.dept_name, 
			pr_section.sec_name, 
			pr_section.sec_bangla, 
			pr_id_proxi.proxi_id, 
			pr_emp_per_info.emp_fname as emp_fname_bn,
			pr_emp_per_info.emp_mname as emp_mname_bn,
			pr_emp_add.pre_add_bn,
			pr_emp_add.per_add_bn

			');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_id_proxi');
		$this->db->from('pr_emp_add');
		$this->db->from('pr_emp_sex');
		$this->db->where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		$this->db->where('pr_emp_per_info.emp_sex = pr_emp_sex.sex_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_id_proxi.emp_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_add.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		
		$this->db->order_by("pr_emp_com_info.emp_id");
		$query = $this->db->get()->result();
		// echo "<pre>";print_r($query);exit;
		
		if($query)
		{
			return $query;	
			
			
		}
		else
		{
			return "Employee ID range does not exist!";
		}
		//print_r($query->result_array());
	
	}
	
	
	
	function grid_pay_slip($year_month, $grid_emp_id)
	{
		
		$this->db->select('
				pr_emp_com_info.emp_id,
				pr_emp_com_info.gross_sal,
				pr_emp_per_info.emp_full_name,
				pr_emp_per_info.emp_fname,
				pr_emp_per_info.emp_mname, 
				pr_emp_per_info.bank_acc as mobile, 
				pr_designation.desig_name, 
				pr_emp_com_info.emp_join_date, 
				pr_dept.dept_name, 
				pr_section.sec_name, 
				pr_line_num.line_name,
				pr_grade.gr_name, 
				pr_id_proxi.proxi_id, 
				pr_emp_add.emp_pre_add, 
				pr_emp_add.emp_par_add, 
				pr_emp_position.posi_name, 
				pr_pay_scale_sheet.* 
			');
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_designation');
			$this->db->from('pr_dept');
			$this->db->from('pr_section');
			$this->db->from('pr_line_num');
			$this->db->from('pr_id_proxi');
			$this->db->from('pr_emp_add');
			$this->db->from('pr_emp_position');
			$this->db->from('pr_grade');
			$this->db->from('pr_pay_scale_sheet');
			$this->db->or_where_in("pr_emp_com_info.emp_id", $grid_emp_id);
			$this->db->like('pr_pay_scale_sheet.salary_month', $year_month);
			$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
			$this->db->where('pr_emp_per_info.emp_id = pr_id_proxi.emp_id');
			$this->db->where('pr_emp_per_info.emp_id = pr_emp_add.emp_id');
			$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
			$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
			$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
			$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
			$this->db->where('pr_emp_com_info.emp_position_id = pr_emp_position.posi_id');
			$this->db->where('pr_grade.gr_id = pr_emp_com_info.emp_sal_gra_id');
			$this->db->where('pr_emp_com_info.emp_id = pr_pay_scale_sheet.emp_id');
			$this->db->order_by("pr_emp_com_info.emp_id");
		$query = $this->db->get();
		
		if($query->num_rows() == 0)
		{
			return "Employee ID range does not exist!";
			
		}
		else
		{
			return $query->result_array();	
		}
		//print_r($query->result_array());
	
	}
	
	function grid_provident_fund($year_month, $grid_emp_id)
	{
		$pf_status = $this->common_model->get_setup_attributes(6);
		if($pf_status == "Yes")
		{
			$data = array();
			$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name,  pr_designation.desig_name, pr_emp_com_info.emp_join_date, pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_id_proxi.proxi_id, pr_emp_shift.shift_name,pr_emp_com_info.emp_cat_id, pr_pay_scale_sheet.basic_sal, pr_pay_scale_sheet.gross_sal, pr_pay_scale_sheet.provident_fund, pr_pay_scale_sheet.pf_bank_interest, pr_pay_scale_sheet.company_pf, pr_pay_scale_sheet.update_pf');
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_designation');
			$this->db->from('pr_dept');
			$this->db->from('pr_section');
			$this->db->from('pr_line_num');
			$this->db->from('pr_id_proxi');
			$this->db->from('pr_emp_shift');
			$this->db->from('pr_pay_scale_sheet');
			$this->db->where_in("pr_pay_scale_sheet.emp_id", $grid_emp_id);
			$this->db->like('pr_pay_scale_sheet.salary_month', $year_month);
			$this->db->where('pr_emp_per_info.emp_id = pr_pay_scale_sheet.emp_id');
			$this->db->where('pr_pay_scale_sheet.emp_id = pr_emp_com_info.emp_id');
			$this->db->where("pr_emp_com_info.ot_entitle","1");
			$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
			$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
			$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
			$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
			$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
			$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
			$this->db->where("pr_pay_scale_sheet.provident_fund != 0");
			$this->db->order_by("pr_emp_com_info.emp_id","ASC");
			$this->db->group_by("pr_pay_scale_sheet.emp_id");
			$query = $this->db->get();
			
			if($query->num_rows() > 0)
			{
				$search_date = 	$year_month."-"."1";	
				foreach($query->result() as $rows)
				{
					$emp_id = $rows->emp_id;
															
						$data["emp_id"][] 		= $emp_id;
						$data["proxi_id"][] 	= $rows->proxi_id;
						$data["emp_name"][] 	= $rows->emp_full_name;
						$data["doj"][] 			= $rows->emp_join_date;
						$service_month = $this->common_model->get_service_month($search_date,$rows->emp_join_date);
						
						$data["service_month"][]	= $service_month;
						$data["dept_name"][] 		= $rows->dept_name;
						$data["sec_name"][] 		= $rows->sec_name;
						$data["desig_name"][] 		= $rows->desig_name;
						$data["line_name"][]		= $rows->line_name;
						$data["basic_sal"][] 		= $rows->basic_sal;
						$data["gross_sal"][] 		= $rows->gross_sal;
						$data["provident_fund"][] 	= $rows->provident_fund;
						$data["pf_bank_interest"][] = $rows->pf_bank_interest;
						$data["company_pf"][] 		= $rows->company_pf;
						$data["update_pf"][] 		= $rows->update_pf;
						
						/*$this->db->select_sum('provident_fund');
						$this->db->where('emp_id',$emp_id); 
						$this->db->where('salary_month <=',$search_date); 
						$this->db->group_by("salary_month");
						$query = $this->db->get('pr_pay_scale_sheet');*/
						//$query = $this->db->query("select SUM(`provident_fund`) AS provident_fund, COUNT(`provident_fund`) AS deduction_month FROM  (SELECT * FROM  pr_pay_scale_sheet WHERE `emp_id`='$emp_id' GROUP BY `salary_month`) AS pay_sheet WHERE pay_sheet.salary_month <= '$search_date'");
						//$row = $query->row();
						//$sum_pf =  $row->provident_fund;
						//$deduction_month =  $row->deduction_month;
						//echo $this->db->last_query();
						//$data["deduction_month"][] 	= $deduction_month;	
						//$data["sum_pf"][] 	= $sum_pf;		
						
						$provident_fund_rules 		= $this->pf_model->get_provident_fund_rules($service_month);
						$data["pf_percentage"][]	= $provident_fund_rules['pf_percentage'];
						
				}
				
				if($data)
				{
					//print_r($data);
					return $data;
				}
				else
				{
					return "Requested list is empty";
				}
			}
			else
			{
				return "Requested list is empty";
			}
		}
		else
		{
			return "Requested list is empty";
		}
	}
	
	
	function grid_id_card($grid_emp_id)
	{
		$this->db->select('pr_line_num.line_name,pr_emp_com_info.emp_id,pr_emp_per_info.bangla_nam,pr_emp_per_info.img_source, pr_emp_per_info.emp_dob, pr_emp_per_info.mobile, pr_designation.desig_bangla, pr_emp_com_info.emp_join_date, pr_dept.dept_name,pr_dept.dept_bn, pr_section.sec_bangla,pr_emp_blood_groups.*,pr_emp_add.*');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_emp_blood_groups');
		$this->db->from('pr_emp_add');
		
		$this->db->or_where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_com_info.emp_id = pr_emp_add.emp_id');
		$this->db->where('pr_emp_per_info.emp_blood = pr_emp_blood_groups.blood_id');
		
		$this->db->order_by("pr_emp_com_info.emp_id");
		$query = $this->db->get();
		
		if($query->num_rows() == 0)
		{
			return "Employee ID range does not exist!";
			
		}
		else
		{
			return $query;	
		}
		//print_r($query->result_array());
	}
	
	function grid_id_card_english($grid_emp_id)
	{
		$this->db->select('pr_line_num.line_name,pr_emp_blood_groups.*,pr_emp_com_info.emp_id,pr_emp_add.*, pr_emp_per_info.emp_full_name, pr_emp_per_info.img_source, pr_emp_per_info.mobile, pr_emp_per_info.emp_dob, pr_designation.desig_name, pr_emp_com_info.emp_join_date, pr_dept.dept_name, pr_section.sec_name');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_line_num');
		$this->db->from('pr_designation');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_emp_add');
		$this->db->from('pr_emp_blood_groups');
		$this->db->or_where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_id = pr_emp_add.emp_id');
		$this->db->where('pr_emp_per_info.emp_blood = pr_emp_blood_groups.blood_id');
		
		$this->db->order_by("pr_emp_com_info.emp_id");
		$query = $this->db->get();
		
		if($query->num_rows() == 0)
		{
			return "Employee ID range does not exist!";
			
		}
		else
		{
			return $query;	
		}
		//print_r($query->result_array());
	}
	

	function get_formated_out_time_5pm($emp_id, $out_time, $emp_shift)
	{
		if($out_time =='00:00:00')
		{
			return $out_time ='';
		}
		$schedule 				= $this->schedule_check($emp_shift);
		// echo "<pre>";print_r($schedule);exit;
		$shift_id				= $schedule[0]["sh_type"];
		$out_start				= $schedule[0]["out_start"];
		$ot_start				= $schedule[0]["ot_start"];
		$ot_minute				= $schedule[0]["ot_minute_to_one_hour"];
		$one_hour_ot_out_time	= $schedule[0]["one_hour_ot_out_time"];
		$two_hour_ot_out_time	= $schedule[0]["two_hour_ot_out_time"];
		// $time 					= "18:00:00";


		if($out_start < $out_time) { 
			// one hour ot cal and get buyer time
			if ($out_time >= $ot_start AND $out_time <= $one_hour_ot_out_time) {
				if ($out_time >= '17:50:00') {
					// exit('ss 1');
					return $out_time = $this->time_format_ten_plus($out_time);
				} else {
					// exit('ss 2');
					return $out_time = $this->get_buyer_in_time($one_hour_ot_out_time ,$out_time);
				}
			}

			// two hour ot cal and get buyer time
			if ($out_time >= $ot_start AND $out_time <= $two_hour_ot_out_time) {
				if ($out_time >= '18:50:00') {
					// exit('ss 3');
					return $out_time =  $this->time_am_pm_format($out_time);
				} else {
					// exit('ss 4');
					return $out_time = $this->get_buyer_in_time($two_hour_ot_out_time ,$out_time);
				}
			}

			if ($out_time >= $ot_start AND $out_time > $two_hour_ot_out_time) {
					// exit($out_time);
				return  $out_time = $this->time_format_ten_plus($out_time);
			} else {
					// exit('ss 6');
				return $out_time = $this->get_buyer_in_time($two_hour_ot_out_time ,$out_time);
			}
		} 
		else
		{ 
					// exit('ss 7');
			return $out_time = $this->get_buyer_in_time($two_hour_ot_out_time ,$out_time); 
		} 
	}

	function time_format_ten_plus($out_time){
		$time = strtotime($out_time);
		return date("h:i:s A", strtotime('+1minutes', $time));	
	}

	function grid_job_card_without_ot($grid_firstdate, $grid_seconddate, $grid_emp_id)
	{
		$sStartDate = date("Y-m-d", strtotime($grid_firstdate));
		$sEndDate = date("Y-m-d", strtotime($grid_seconddate));

		$data = array();

		$this->db->select('emp_id');
		$this->db->from('pr_emp_com_info');
		$this->db->where_in('emp_id', $grid_emp_id);
		$this->db->order_by("emp_id");
		$query = $this->db->get();
		//echo $this->db->last_query();
		foreach($query->result() as $row)
		{
			$emp_id = $row->emp_id;
			//echo "$emp_id<br>";

			$this->db->distinct();
			$this->db->select('pr_emp_per_info.emp_full_name,pr_designation.desig_name,pr_dept.dept_name,pr_section.sec_name,pr_line_num.line_name,pr_emp_com_info.emp_join_date,pr_id_proxi.proxi_id');
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_attn_monthly');
			$this->db->from('pr_id_proxi');
			$this->db->from('pr_dept');
			$this->db->from('pr_section');
			$this->db->from('pr_line_num');
			$this->db->from('pr_designation');
			$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
			$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
			$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
			$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
			$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
			$this->db->where('pr_id_proxi.emp_id = pr_emp_com_info.emp_id');
			$this->db->where('pr_emp_per_info.emp_id', $emp_id);

			$query = $this->db->get();
			foreach($query->result() as $row)
			{
				$data["emp_id"][] = $emp_id;

				$data["emp_full_name"][] = $row->emp_full_name;

				$data["proxi_id"][] = $row->proxi_id;

				$data["sec_name"][] = $row->sec_name;

				$data["line_name"][] = $row->line_name;

				$data["desig_name"][] = $row->desig_name;

				$emp_join_date = $row->emp_join_date;
				$emp_join_date_year=trim(substr($emp_join_date,0,4));
				$emp_join_date_month=trim(substr($emp_join_date,5,2));
				$emp_join_date_day=trim(substr($emp_join_date,8,2));
				$emp_join_date = date("d-M-y", mktime(0, 0, 0, $emp_join_date_month, $emp_join_date_day, $emp_join_date_year));
				$data["emp_join_date"][] = $emp_join_date;

				$data["dept_name"][] = $row->dept_name;
			}

			$joining_check = $this->get_join_date($emp_id, $sStartDate, $sEndDate);
			if( $joining_check != false)
			{
				$start_date = $joining_check ;
			}
			else
			{
				$start_date = $sStartDate ;
			}

			$resign_check  = $this->get_resign_date($emp_id, $sStartDate, $sEndDate);
			if($resign_check != false)
			{
				$end_date = $resign_check ;
			}
			else
			{
				$end_date = $sEndDate ;
			}

			// 07-11-21 new code add for customization
			$lunch_leave = $this->lunch_leave_per_emp($start_date, $end_date, $emp_id);

			$leave = $this->leave_per_emp($start_date, $end_date, $emp_id);
			//print_r($leave);

			$weekend = $this->check_weekend($start_date, $end_date, $emp_id);
			//print_r($weekend);

			$holiday = $this->holiday_calculation($start_date, $end_date);

			$days = $this->GetDays($start_date, $end_date);

			foreach($days as $day)
			{

				if($day >= "2013-10-01")
				{
					$holiday = $this->check_holiday($emp_id, $day);
				}
				$this->db->select('pr_emp_shift_log.in_time , pr_emp_shift_log.out_time, pr_emp_shift_log.shift_log_date, pr_emp_shift_log.ot_hour, pr_emp_shift_log.extra_ot_hour, pr_emp_shift_log.late_status');
				$this->db->from('pr_emp_shift_log');
				$this->db->where('pr_emp_shift_log.emp_id', $emp_id);
				$this->db->where("pr_emp_shift_log.shift_log_date", $day);
				$this->db->order_by("pr_emp_shift_log.shift_log_date");
				$this->db->limit(1);
				$query = $this->db->get();
				//echo $this->db->last_query();
				foreach($query->result() as $row)
				{



					if(in_array($row->shift_log_date,$leave))
					{
						$leave_type = $this->get_leave_type($row->shift_log_date,$emp_id);
						$att_status_count = "Leave";
						$att_status = $leave_type;
						$row->in_time = "00:00:00";
						$row->out_time = "00:00:00";
					}
					elseif(in_array($row->shift_log_date,$holiday))
					{
						$att_status = "Holiday";
						$att_status_count = "Holiday";
						$row->in_time = "00:00:00";
						$row->out_time = "00:00:00";
						$row->ot_hour ="";

					}
					elseif(in_array($row->shift_log_date,$lunch_leave))
					{
						$att_status = "L Leave";
						$att_status_count = "L Leave";
						$row->ot_hour ="";
					}elseif(in_array($row->shift_log_date,$weekend))
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

					if($att_status !="Leave" and $att_status !="Holiday" and $att_status !="Work Off" and $att_status !="A" )
					{
						$table = "temp_$emp_id";
						$lunch_out_start = "12:55:00";
						$lunch_out_end = "15:00:00";
						$lunch_out = $this->time_check_in($day, $lunch_out_start , $lunch_out_end , $table);

						if($lunch_out !='')
						{
							$lunch_out_hour = trim(substr($lunch_out,0,2));
							$lunch_out_minute = trim(substr($lunch_out,3,2));
							$lunch_out_sec = trim(substr($lunch_out,6,2));
							$lunch_out = date("h:i:s A", mktime($lunch_out_hour, $lunch_out_minute, $lunch_out_sec, 0, 0, 0));
						}
						else
						{
							$lunch_out = "";
						}


						$lunch_in = $this->time_check_out($day, $lunch_out_start , $lunch_out_end , $table);

						if(in_array($row->shift_log_date,$lunch_leave)) {
							$lunch_in = "";	
						}else if($lunch_in !='')
						{
							$lunch_in = trim(substr($lunch_in,11,19));

							$lunch_in_hour = trim(substr($lunch_in,0,2));
							$lunch_in_minute = trim(substr($lunch_in,3,2));
							$lunch_in_sec = trim(substr($lunch_in,6,2));
							$lunch_in = date("h:i:s A", mktime($lunch_in_hour, $lunch_in_minute, $lunch_in_sec, 0, 0, 0));
						}
						else
						{
							$lunch_in = "";
						}
					}
					else
					{
						$lunch_out = "";
						$lunch_in = "";
					}

					$emp_shift = $this->emp_shift_check($emp_id, $day);

					$schedule = $this->schedule_check($emp_shift);
					//print_r($schedule);
					$start_time		=  $schedule[0]["in_start"];
					$late_time 		=  $schedule[0]["late_start"];
					$end_time   	=  $schedule[0]["in_end"];
					$out_start_time	=  $schedule[0]["out_start"];
					$out_end_time	=  $schedule[0]["out_end"];

					if($row->late_status == 1 )
					{
						$remark = "Late";
					}
					else
					{
						$remark = "";
					}

					$shift_log_date = $row->shift_log_date;
					$year=trim(substr($shift_log_date,0,4));
					$month=trim(substr($shift_log_date,5,2));
					$date=trim(substr($shift_log_date,8,2));
					$shift_log_date = date("d-M-y", mktime(0, 0, 0, $month, $date, $year));

					if($row->in_time != "00:00:00")
					{
						$in_time = $row->in_time;
						$in_time =$this->time_am_pm_format($in_time);
						// $in_time = $this->get_formated_in_time($emp_id, $in_time, $emp_shift);
					}
					else
					{
						$in_time = "00:00:00";
					}

					if($row->out_time != "00:00:00")
					{
						$out_time = $row->out_time;
						$out_time = $this->get_formated_out_time_without_ot($emp_id, $out_time, $emp_shift);
					}
					else
					{
						$out_time = "00:00:00";
					}

					$total_ot_hour = $row->ot_hour; // + $row->extra_ot_hour; , This is for extra ot hour add to Job card.

					$data[$emp_id]["shift_log_date"][] 	= $shift_log_date;
					$data[$emp_id]["in_time"][] 		= $in_time;
					$data[$emp_id]["out_time"][] 		= $out_time;
					$data[$emp_id]["ot_hour"][] 		= $total_ot_hour;
					$data[$emp_id]["att_status"][] 		= $att_status;
					$data[$emp_id]["att_status_count"][] = $att_status_count;
					$data[$emp_id]["lunch_out"][] 		= $lunch_out;
					$data[$emp_id]["lunch_in"][] 		= $lunch_in;
					$data[$emp_id]["remark"][] 			= $remark;
				}
			}
		}
		//print_r($data);
		return $data;

	}
	function get_no_days($from, $to)
	{
		 $first_date = strtotime($from);
		 $second_date = strtotime($to);
		 $offset = $second_date-$first_date;
		 return floor($offset/60/60/24);
	}
	function advance_job_card($grid_firstdate, $grid_seconddate, $grid_emp_id)
	{
		$sStartDate = date("Y-m-d", strtotime($grid_firstdate)); 
		$sEndDate = date("Y-m-d", strtotime($grid_seconddate));
				
		$data = array();
		
		$this->db->select('emp_id');
		$this->db->from('pr_emp_com_info');
		$this->db->where_in('emp_id', $grid_emp_id);
		$this->db->order_by("emp_id");
		$query = $this->db->get();
		//echo $this->db->last_query();
		foreach($query->result() as $row)
		{
			$emp_id = $row->emp_id;
			//echo "$emp_id<br>";
			
			$this->db->distinct();
			$this->db->select('pr_emp_per_info.emp_full_name,pr_designation.desig_name,pr_dept.dept_name,pr_section.sec_name,pr_line_num.line_name,pr_emp_com_info.emp_join_date,pr_id_proxi.proxi_id');
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_attn_monthly');
			$this->db->from('pr_id_proxi');
			$this->db->from('pr_dept');
			$this->db->from('pr_section');
			$this->db->from('pr_line_num');
			$this->db->from('pr_designation');
			$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
			$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
			$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
			$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
			$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
			$this->db->where('pr_id_proxi.emp_id = pr_emp_com_info.emp_id');
			$this->db->where('pr_emp_per_info.emp_id', $emp_id);
			
			$query = $this->db->get();
			foreach($query->result() as $row)
			{
				$data["emp_id"][] = $emp_id;
				
				$data["emp_full_name"][] = $row->emp_full_name;
				
				$data["proxi_id"][] = $row->proxi_id;
				
				$data["sec_name"][] = $row->sec_name;
				
				$data["line_name"][] = $row->line_name;
				
				$data["desig_name"][] = $row->desig_name;
				
				$emp_join_date = $row->emp_join_date;
				$emp_join_date_year=trim(substr($emp_join_date,0,4));
				$emp_join_date_month=trim(substr($emp_join_date,5,2));
				$emp_join_date_day=trim(substr($emp_join_date,8,2));
				$emp_join_date = date("d-M-y", mktime(0, 0, 0, $emp_join_date_month, $emp_join_date_day, $emp_join_date_year));
				$data["emp_join_date"][] = $emp_join_date;
				
				$data["dept_name"][] = $row->dept_name;
			}
			
			$joining_check = $this->get_join_date($emp_id, $sStartDate, $sEndDate);
			if( $joining_check != false)
			{
				$start_date = $joining_check ;
			}
			else
			{
				$start_date = $sStartDate ;
			}
			
			$resign_check  = $this->get_resign_date($emp_id, $sStartDate, $sEndDate);
			if($resign_check != false)
			{
				$end_date = $resign_check ;
			}
			else
			{
				$end_date = $sEndDate ;
			}
			
			$leave = $this->leave_per_emp($start_date, $end_date, $emp_id);
			$weekend_actual = $this->check_weekend($start_date, $end_date, $emp_id);
			//print_r($weekend_actual);
			$no_days = $this->get_no_days($start_date, $end_date);
			$weekend_day = "Fri";
			//$weekend = $this->get_weekend_dates($weekend_day, $no_days, $start_date);
			$weekend = $this->check_weekend($start_date, $end_date, $emp_id);
			//print_r($weekend);
			$mismatch_day = array_diff($weekend_actual, $weekend);
			//print_r($mismatch_day);
			$holiday = $this->holiday_calculation($start_date, $end_date);
			
			$days = $this->GetDays($start_date, $end_date);
			
			foreach($days as $day)
			{
			
				if($day >= "2013-10-01")
				{
					$holiday = $this->check_holiday($emp_id, $day);
				}
				$this->db->select('pr_emp_shift_log.in_time , pr_emp_shift_log.out_time, pr_emp_shift_log.shift_log_date, pr_emp_shift_log.ot_hour, pr_emp_shift_log.extra_ot_hour, pr_emp_shift_log.late_status');
				$this->db->from('pr_emp_shift_log');
				$this->db->where('pr_emp_shift_log.emp_id', $emp_id);
				$this->db->where("pr_emp_shift_log.shift_log_date", $day);
				$this->db->order_by("pr_emp_shift_log.shift_log_date");
				$this->db->limit(1);
				$query = $this->db->get();
				//echo $this->db->last_query();
				foreach($query->result() as $row)
				{
					
					
					
					if(in_array($row->shift_log_date,$leave))
					{
						$leave_type = $this->get_leave_type($row->shift_log_date,$emp_id);
						$att_status_count = "Leave";
						$att_status = $leave_type;
						$row->in_time = "00:00:00";
						$row->out_time = "00:00:00";
					}
					elseif(in_array($row->shift_log_date,$holiday))
					{
						$att_status = "Holiday";
						$att_status_count = "Holiday";
						$row->in_time = "00:00:00";
						$row->out_time = "00:00:00";
						$row->ot_hour ="";
						
					}
					elseif(in_array($row->shift_log_date,$weekend))
					{
						$att_status = "Weekend";
						$att_status_count = "Work Off";
						$row->in_time = "00:00:00";
						$row->out_time = "00:00:00";
						$row->ot_hour ="";
						//echo "1==";
					}
					elseif(in_array($row->shift_log_date,$mismatch_day))
					{
						$att_status = "P";
						$att_status_count = "P";
						$row->in_time = "08:00:00";
						$row->out_time = "17:00:00";
						$row->ot_hour ="";
						//echo "1==";
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
					
					if($att_status !="Leave" and $att_status !="Holiday" and $att_status !="Work Off" and $att_status !="A" )
					{
						$table = "temp_$emp_id";
						$lunch_out_start = "12:55:00";
						$lunch_out_end = "15:00:00";
						$lunch_out = $this->time_check_in($day, $lunch_out_start , $lunch_out_end , $table);
						
						if($lunch_out !='')
						{
							$lunch_out_hour = trim(substr($lunch_out,0,2));
							$lunch_out_minute = trim(substr($lunch_out,3,2));
							$lunch_out_sec = trim(substr($lunch_out,6,2));
							$lunch_out = date("h:i:s A", mktime($lunch_out_hour, $lunch_out_minute, $lunch_out_sec, 0, 0, 0));
						}
						else
						{
							$lunch_out = "";
						}
						
						
						$lunch_in = $this->time_check_out($day, $lunch_out_start , $lunch_out_end , $table);
						
						if($lunch_in !='')
						{
							$lunch_in = trim(substr($lunch_in,11,19));	
							
							$lunch_in_hour = trim(substr($lunch_in,0,2));
							$lunch_in_minute = trim(substr($lunch_in,3,2));
							$lunch_in_sec = trim(substr($lunch_in,6,2));
							$lunch_in = date("h:i:s A", mktime($lunch_in_hour, $lunch_in_minute, $lunch_in_sec, 0, 0, 0));
						}
						else
						{
							$lunch_in = "";
						}
					}
					else
					{
						$lunch_out = "";
						$lunch_in = "";
					}
					
					$emp_shift = $this->emp_shift_check($emp_id, $day);
					
					$schedule = $this->schedule_check($emp_shift);
					//print_r($schedule);
					$start_time		=  $schedule[0]["in_start"]; 
					$late_time 		=  $schedule[0]["late_start"]; 
					$end_time   	=  $schedule[0]["in_end"];
					$ot_start		=  $schedule[0]["ot_start"];
					$out_start_time	=  $schedule[0]["out_start"];
					$out_end_time	=  $schedule[0]["out_end"];	
					
					if($row->late_status == 1 )
					{
						$remark = "Late";
					}
					else
					{
						$remark = "";
					}
					
					$shift_log_date = $row->shift_log_date;
					$year=trim(substr($shift_log_date,0,4));
					$month=trim(substr($shift_log_date,5,2));
					$date=trim(substr($shift_log_date,8,2));
					$shift_log_date = date("d-M-y", mktime(0, 0, 0, $month, $date, $year));
					
					if($row->in_time != "00:00:00")
					{
						$in_time = $row->in_time;
						$in_time = $this->get_formated_in_time($emp_id, $in_time, $emp_shift);	
					}
					else
					{
						$in_time = "00:00:00";
					}
					
					if($row->out_time != "00:00:00")
					{
						$out_time = $row->out_time;
						$out_time = $this->get_formated_out_time($emp_id, $out_time, $emp_shift);
					}
					else
					{
						$out_time = "00:00:00";
					}
					
					$total_ot_hour = $row->ot_hour; // + $row->extra_ot_hour; , This is for extra ot hour add to Job card.
					
					if(in_array($row->shift_log_date,$weekend_actual) && !in_array($row->shift_log_date,$weekend))
					{
						$out_time = $this->get_formated_out_time($emp_id, $ot_start, $emp_shift);
					}
					if(in_array($row->shift_log_date,$weekend))
					{
						$lunch_out = "";
						$lunch_in = "";
					}

									
					$data[$emp_id]["shift_log_date"][] 	= $shift_log_date;
					$data[$emp_id]["in_time"][] 		= $in_time;
					$data[$emp_id]["out_time"][] 		= $out_time;
					$data[$emp_id]["ot_hour"][] 		= $total_ot_hour;
					$data[$emp_id]["att_status"][] 		= $att_status;
					$data[$emp_id]["att_status_count"][] = $att_status_count;
					$data[$emp_id]["lunch_out"][] 		= $lunch_out;
					$data[$emp_id]["lunch_in"][] 		= $lunch_in;
					$data[$emp_id]["remark"][] 			= $remark;
					
					//echo "$emp_id=>$row->shift_log_date=>$row->in_time=>$row->out_time=>$row->ot_hour==>$att_status<==Lunch OUT=>$lunch_out==Lunch IN=>$lunch_in==Remark=>$remark<br>";
					
					
				}
			}
		}
		//print_r($data);
		return $data;
		
	}
	function check_holiday($id, $att_date)
	{
		$this->db->select("holyday_date");
		$this->db->from("pr_holiday_new");
		$this->db->where("emp_id", $id);
		$this->db->where("holyday_date", $att_date);
		$query = $this->db->get();
		//echo $this->db->last_query();
		$holiday = array();
		foreach ($query->result() as $row)
		{
			$holiday[] = $row->holyday_date;
		}
		return $holiday;
	}
	function get_join_date($emp_id, $sStartDate, $sEndDate)
	{
		$this->db->select('emp_join_date');
		$this->db->where("emp_join_date BETWEEN '$sStartDate' AND '$sEndDate'");
		$this->db->where("emp_id = '$emp_id'");
		$query = $this->db->get("pr_emp_com_info");
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			return $emp_join_date = $row->emp_join_date;
		}
		else
		{
			return false;
		}
	}
	
	function get_resign_date($emp_id, $sStartDate, $sEndDate)
	{
		$this->db->select('resign_date');
		$this->db->where("resign_date BETWEEN '$sStartDate' AND '$sEndDate'");
		$this->db->where("emp_id = '$emp_id'");
		$query = $this->db->get("pr_emp_resign_history");
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			return $resign_date = $row->resign_date;
		}
		else
		{
			return false;
		}
	}
	
	function leave_per_emp($sStartDate, $sEndDate, $emp_id)
	{
		$this->db->select("start_date");
		$this->db->where("start_date BETWEEN '$sStartDate' AND '$sEndDate'");
		$this->db->where("emp_id = '$emp_id'");
		$query = $this->db->get("pr_leave_trans");
		$leave = array();
		foreach ($query->result() as $row)
		{
			$leave[] = $row->start_date;
		}
		return $leave;
	}
	
	function lunch_leave_per_emp($sStartDate, $sEndDate, $emp_id)
	{
		$this->db->select("start_date");
		$this->db->where("start_date BETWEEN '$sStartDate' AND '$sEndDate'");
		$this->db->where("emp_id = '$emp_id'");
		$query = $this->db->get("pr_lunch_leave");
		$leave = array();
		foreach ($query->result() as $row)
		{
			$leave[] = $row->start_date;
		}
		return $leave;
	}


	function check_weekend($sStartDate, $sEndDate, $emp_id)
	{
		$this->db->select("work_off_date");
		$this->db->where("work_off_date BETWEEN '$sStartDate' AND '$sEndDate'");
		$this->db->where("emp_id = '$emp_id'");
		$query = $this->db->get("pr_work_off");
		$weekend = array();
		foreach ($query->result() as $row)
		{
			$weekend[] = $row->work_off_date;
		}
		return $weekend;
	}
	function get_weekend_dates($weekend_day,$days,$start_date)
	{
		
		 $weekend = array();
		 for($i=0;$i<=$days;$i++)
		 {
				 
				$actual_date = date("Y-m-d", strtotime($start_date. " +$i days"));
				 
				 
				$date = strtotime(date("Y-m-d", strtotime($start_date)) . " +$i day");
				$new_date = date("D",$date);
				
				 if($new_date == $weekend_day)
				 {
					 //echo $actual_date."==";
					 $weekend[] = $actual_date;
				 }
		 }
		 return $weekend;
	}
	function holiday_calculation($sStartDate, $sEndDate)
	{
		$this->db->select("start_date");
		$this->db->where("start_date BETWEEN '$sStartDate' AND '$sEndDate'");
		$query = $this->db->get("pr_holiday");
		$holiday = array();
		foreach ($query->result() as $row)
		{
			$holiday[] = $row->start_date;
		}
		return $holiday;
	}
	
	function grid_monthly_att_register($year_month, $grid_emp_id)
	{
		$year= trim(substr($year_month,0,4));
		$month = trim(substr($year_month,5,2));
		
		
		$att_month = "att_".$year."_".$month;
		
		if(!$this->db->table_exists($att_month))
		{
			return "Report month does not exist!";
		}
		
		$this->db->select('pr_emp_per_info.emp_full_name,pr_designation.desig_name,pr_attn_monthly.*');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_attn_monthly');
			$this->db->from('pr_dept');
			$this->db->from('pr_section');
			$this->db->from('pr_line_num');
			$this->db->from('pr_designation');
			$this->db->or_where_in("pr_emp_per_info.emp_id", $grid_emp_id);
			$this->db->like("pr_attn_monthly.att_month",$year_month);
			$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
			$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
			$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
			$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_attn_monthly.emp_id');
		$this->db->order_by("pr_emp_com_info.emp_id");
		$this->db->group_by('pr_attn_monthly.emp_id');
		$query = $this->db->get();	
		//echo $this->db->last_query();
		if($query->num_rows > 0)
		{	
			return $query;
		}
		else
		{
			return "Soryy! Requested list is empty";
		}
	}
	
	// function grid_extra_ot($grid_firstdate, $grid_seconddate, $grid_emp_id)
	// {
	// 	$data = array();
	// 	$query = $this->all_reguler_emp($grid_emp_id);
	// 	foreach($query->result() as $row)
	// 	{
	// 		$emp_id = $row->emp_id;
	// 		$data["emp_id"][] = $row->emp_id;
					
	// 		$this->db->distinct();
	// 		$this->db->select('pr_emp_per_info.emp_full_name,pr_designation.desig_name,pr_dept.dept_name,pr_section.sec_name,pr_line_num.line_name,pr_emp_com_info.emp_join_date,pr_id_proxi.proxi_id');
	// 		$this->db->from('pr_emp_per_info');
	// 		$this->db->from('pr_emp_com_info');
	// 		$this->db->from('pr_attn_monthly');
	// 		$this->db->from('pr_id_proxi');
	// 		$this->db->from('pr_dept');
	// 		$this->db->from('pr_section');
	// 		$this->db->from('pr_line_num');
	// 		$this->db->from('pr_designation');
	// 		$this->db->where('pr_emp_per_info.emp_id', $emp_id);
	// 		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
	// 		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
	// 		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
	// 		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
	// 		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
	// 		$this->db->where('pr_id_proxi.emp_id = pr_emp_com_info.emp_id');
	// 		$query2 = $this->db->get();
			
	// 		//echo $this->db->last_query();
	// 		foreach($query2->result() as $rows2)
	// 		{
	// 			$data["emp_full_name"][] = $rows2->emp_full_name;
	// 			$data["proxi_id"][] = $rows2->proxi_id;
	// 			$data["sec_name"][] = $rows2->sec_name;
	// 			$data["line_name"][] = $rows2->line_name;
	// 			$data["desig_name"][] = $rows2->desig_name;
	// 			$emp_join_date = $rows2->emp_join_date;
	// 			$emp_join_date_year		= trim(substr($emp_join_date,0,4));
	// 			$emp_join_date_month	= trim(substr($emp_join_date,5,2));
	// 			$emp_join_date_day		= trim(substr($emp_join_date,8,2));
	// 			$emp_join_date 			= date("d-M-y", mktime(0, 0, 0, $emp_join_date_month, $emp_join_date_day, $emp_join_date_year));
				
	// 			$data["emp_join_date"][] = $emp_join_date;
	// 			$data["dept_name"][] = $rows2->dept_name;
	// 		}
			
	// 		$this->db->select();
	// 		$this->db->where("emp_id",$row->emp_id);
	// 		$this->db->where("shift_log_date BETWEEN '$grid_firstdate' AND '$grid_seconddate' ");
	// 		$this->db->order_by("shift_log_date");
	// 		$query1 = $this->db->get("pr_emp_shift_log");
	// 		// echo "<pre>";print_r($query);exit;
	// 		foreach($query1->result() as $rows )
	// 		{
				
	// 			$data[$emp_id]["shift_log_date"][] 	= $rows->shift_log_date;
	// 			$data[$emp_id]["in_time"][] 		= $rows->in_time;
	// 			$data[$emp_id]["out_time"][] 		= $rows->out_time;
	// 			// $data[$emp_id]["status"][] 		    = $rows->status;
	// 			$data[$emp_id]["ot_hour"][] 		= $rows->ot_hour;
	// 			$data[$emp_id]["extra_ot_hour"][] 	= $rows->extra_ot_hour;
	// 		}
	// 	}
		
	// 	return $data;
	// }


	function grid_extra_ot($grid_firstdate, $grid_seconddate, $grid_emp_id)
	{
		$data = array();
		$this->db->distinct();
		$this->db->select('pr_emp_per_info.emp_full_name,pr_designation.desig_id,pr_designation.desig_name,pr_dept.dept_name,pr_section.sec_name,pr_line_num.line_name,pr_emp_com_info.emp_id, pr_emp_com_info.emp_join_date, pr_id_proxi.proxi_id, pr_emp_com_info.emp_desi_id');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_id_proxi');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_designation');
		$this->db->where_in('pr_emp_com_info.emp_id', $grid_emp_id);
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_id_proxi.emp_id = pr_emp_com_info.emp_id');
		$query = $this->db->get();
		return $query->result();
	}
	
	function manual_attendance_entry($grid_firstdate, $grid_seconddate, $manual_time, $grid_emp_id)
	{
		$data = array();
		
		$query = $this->all_reguler_emp($grid_emp_id);
		
		foreach($query->result() as $row)
		{
			$empid = $row->emp_id;
			
			$emp_table="temp_".$empid;
					
			$deviceid=1;	
			list($hour, $minute,$sec) = explode(':', trim($manual_time) );	
			
			
			$min_start = $minute-2;
			$min_end = $minute+3;
			$sec_start = 0;
			$sec_end = 60;
			
			$proxid = $this->prox($empid);
			
			$days = $this->GetDays($grid_firstdate, $grid_seconddate);
			foreach($days as $day)
				{
					//echo $day.'===';
					$rand_minutes=rand($min_start,$min_end);
					$rand_sec=rand($sec_start,$sec_end);
					
					$year=trim(substr($day,0,4));
					$month=trim(substr($day,5,2));
					$day=trim(substr($day,8,2));
					$intime_entry = date("Y-m-d H:i:s", mktime($hour, $rand_minutes, $rand_sec, $month, $day, $year));
					
					$data = array( 'device_id'	=>$deviceid	, 'proxi_id'  =>$proxid, 'date_time'  => $intime_entry);		
					$this->db->insert($emp_table, $data);
					//print_r($data);
						 
				}
		}
		 return "Insert Successfully";
	}
	
	function manual_entry_Delete($grid_firstdate, $grid_seconddate, $grid_emp_id)
	{
		
		$data = array();
		
		$query = $this->all_reguler_emp($grid_emp_id);
		//print_r($query->result_array());
		
		foreach($query->result() as $row)
		{
			$id = $row->emp_id;
			
			$startdate = $grid_firstdate; 
			$temp_table = "temp_$id";
			
			$proxi = $this->prox($id);
			
			$days = $this->GetDays($grid_firstdate, $grid_seconddate);
			//print_r($days);
			foreach($days as $perday)
			{
				$date  = $perday;
				$year  = trim(substr($date,0,4));
				$month = trim(substr($date,5,2));
				$day   = trim(substr($date,8,2));
				
				$att_table = "att_".$year."_".$month;
				$date = date("d-m-Y", mktime(0, 0, 0, $month, $day, $year));
				$search_date = date("Ymd", mktime(0, 0, 0, $month, $day, $year));
				$file_name = "data/$date.TXT";
				$temp_table = "temp_$id";
						
				
				$where ="trim(substr(date_time ,1,10)) = '$perday'";
				$this->db->where($where);
				$data=$this->db->delete($temp_table);
				
				$where ="trim(substr(date_time ,1,10)) = '$perday' and proxi_id='$proxi'";
				$this->db->where($where);
				$data=$this->db->delete($att_table);
				//echo $this->db->last_query();		
				if ($data)
				{
					if( file_exists($file_name) )
					{ 
			
						$data = file($file_name);
						
						$out = array();
						
						foreach($data as $line) {
							$match_line =  substr($line,18,10);
						
							if(trim($match_line) != "$proxi") {
								$out[] = $line;
							}
						}
						//echo "Line".$line;
						//print_r($out);
						$fp = fopen($file_name, "w+");
						flock($fp, LOCK_EX);
						foreach($out as $line) {
							fwrite($fp, $line);
						}
						flock($fp, LOCK_UN);
						fclose($fp);
					}
					
				} 
				else
				{
					return "Delete failed";
				}
			}
		}
		return "Delete successfully";
	
	}
	
	function save_work_off($grid_firstdate, $grid_emp_id)
	{
		$data = array();
		
		$query = $this->all_reguler_emp($grid_emp_id);
		
		foreach($query->result() as $row)
		{
			$work_off_empid = $row->emp_id;
			
			 $year_month = $grid_firstdate ;
			 $this->db->select("*");
			 $this->db->where('work_off_date',$year_month);
			 $this->db->where('emp_id',$work_off_empid);
			 $query = $this->db->get("pr_work_off");
			 $num_row = $query->num_rows();
			 if($num_row == 0 )
			 {
				$data = array(
				'emp_id'		=> $work_off_empid,
				'work_off_date'		=> $year_month
						
				);
				//print_r($data);
				$this->db->insert('pr_work_off', $data) ;
				
			 }
		}
		 return "Insert Successfully";
	}
	
	function save_holiday($grid_firstdate,$grid_seconddate,$holiday_description,$grid_emp_id)
	{
		
		$this->db->select("holyday_date");
		$this->db->where("holyday_date between '$grid_firstdate' and '$grid_seconddate'");
		$this->db->where_in("emp_id", $grid_emp_id);
		$query = $this->db->get("pr_holiday_new");
		//echo $this->db->last_query();
		$num_row = $query->num_rows();
		if($num_row == 0 )
		{			
			
			$date_array = $this->GetDays($grid_firstdate, $grid_seconddate);
			
			foreach($grid_emp_id as $emp_id)
			{
				if($emp_id != '')
				{
					$count = 0;
					foreach($date_array as $date)
					{
						$data = array(
								'emp_id' 		=> $emp_id,
								'holyday_date' 	=> $date,
								'description' 	=> $holiday_description
								
						);
						//print_r($data);
						$this->db->insert('pr_holiday_new', $data);
						
					}
				}
			}
			
			echo "Save successfully";
			
		}
		else
		{
			echo "Already inserted";
		}
	}
	
	function grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id)
	{
		/*$this->db->select("pr_dept.dept_name");
		$this->db->from('pr_dept');
		$this->db->from('pr_emp_com_info');
		$this->db->where_in('pr_emp_com_info.emp_id', $grid_emp_id);
		$this->db->group_by("pr_dept.dept_name"); 
		$this->db->order_by("pr_dept.dept_name");
		$query = $this->db->get();	
		echo $this->db->last_query();	*/
		$year  = substr($sal_year_month,0,4);
		$month = substr($sal_year_month,5,2);
		$last_day = date("t", mktime(0, 0, 0, $month, 1, $year));	
		
		$lastday = date("Y-m-d", mktime(0, 0, 0, $month, $last_day, $year));		
		
		$this->db->select('pr_emp_per_info.emp_full_name,pr_designation.desig_name, pr_section.sec_name, pr_emp_com_info.emp_join_date,pr_grade.gr_name,pr_pay_scale_sheet.*');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_grade');
		$this->db->from('pr_pay_scale_sheet');
			$this->db->from('pr_dept');
			$this->db->from('pr_section');
			$this->db->from('pr_line_num');
			$this->db->from('pr_designation');
			if($grid_status == 4){
				$this->db->from('pr_emp_resign_history');
			}
			$this->db->where_in('pr_emp_com_info.emp_id', $grid_emp_id);
			$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
			$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
			$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
			$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_sal_gra_id = pr_grade.gr_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_pay_scale_sheet.emp_id');
		$this->db->where("pr_pay_scale_sheet.salary_month = '$sal_year_month'");
		if($grid_status == 4){
			$salary_month = substr($sal_year_month,0,7);
			$this->db->where('pr_emp_com_info.emp_id = pr_emp_resign_history.emp_id');
			$this->db->where("trim(substr(pr_emp_resign_history.resign_date,1,7)) LIKE '$salary_month'");
		}
		$this->db->where('pr_emp_com_info.emp_join_date <= ', $lastday);
		

		$this->db->order_by("pr_emp_com_info.emp_id");
		$this->db->group_by("pr_pay_scale_sheet.emp_id");
		$query = $this->db->get();	
		//echo $this->db->last_query();	
		return $query->result();
	}
	
	
	
	function grid_festival_bonus($sal_year_month, $grid_status, $grid_emp_id)
	{
		$year  = substr($sal_year_month,0,4);
		$month = substr($sal_year_month,5,2);
		$lastday = date("t", mktime(0, 0, 0, $month, 1, $year));	
		
		$lastday = date("Y-m-d", mktime(0, 0, 0, $month, $lastday, $year));		
		
		$this->db->select('pr_emp_per_info.emp_full_name,pr_designation.desig_name, pr_section.sec_name, pr_line_num.line_name, pr_emp_com_info.emp_join_date,pr_grade.gr_name,pr_emp_per_info.bank_acc as mobile,pr_pay_scale_sheet.*');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_grade');
		$this->db->from('pr_pay_scale_sheet');
			$this->db->from('pr_dept');
			$this->db->from('pr_section');
			$this->db->from('pr_line_num');
			$this->db->from('pr_designation');
			if($grid_status == 4)
			{
				$this->db->from('pr_emp_resign_history');
			}
			
			
			$this->db->where_in('pr_emp_com_info.emp_id', $grid_emp_id);
			$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
			$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
			$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
			$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_sal_gra_id = pr_grade.gr_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_pay_scale_sheet.emp_id');
		$this->db->where("pr_pay_scale_sheet.salary_month = '$sal_year_month'");
		$this->db->where("pr_pay_scale_sheet.festival_bonus != 0");
		if($grid_status == 4)
		{
			$salary_month = substr($sal_year_month,0,7);
			$this->db->where('pr_emp_com_info.emp_id = pr_emp_resign_history.emp_id');
			$this->db->where("trim(substr(pr_emp_resign_history.resign_date,1,7)) LIKE '$salary_month'");
		}
		$this->db->where('pr_emp_com_info.emp_join_date <= ', $lastday);
		

		$this->db->order_by("pr_emp_com_info.emp_id");
		$this->db->group_by("pr_pay_scale_sheet.emp_id");
		$query = $this->db->get();	
		//echo $this->db->last_query();	
		return $query->result();
		
	}
	
	function grid_earn_leave($sal_year_month, $grid_status, $grid_emp_id)
	{
		/*$this->db->select("pr_dept.dept_name");
		$this->db->from('pr_dept');
		$this->db->from('pr_emp_com_info');
		$this->db->where_in('pr_emp_com_info.emp_id', $grid_emp_id);
		$this->db->group_by("pr_dept.dept_name"); 
		$this->db->order_by("pr_dept.dept_name");
		$query = $this->db->get();	
		echo $this->db->last_query();	*/
		$year  = substr($sal_year_month,0,4);
		$month = substr($sal_year_month,5,2);
		$lastday = date("t", mktime(0, 0, 0, $month, 1, $year));	
		
		$lastday = date("Y-m-d", mktime(0, 0, 0, $month, $lastday, $year));		
		
		$this->db->select('pr_emp_per_info.emp_full_name,pr_designation.desig_name, pr_section.sec_name, pr_emp_com_info.emp_join_date,pr_grade.gr_name,pr_pay_scale_sheet.*');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_grade');
		$this->db->from('pr_pay_scale_sheet');
			$this->db->from('pr_dept');
			$this->db->from('pr_section');
			$this->db->from('pr_line_num');
			$this->db->from('pr_designation');
			if($grid_status == 4)
			{
				$this->db->from('pr_emp_resign_history');
			}
			
			
			$this->db->where_in('pr_emp_com_info.emp_id', $grid_emp_id);
			$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
			$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
			$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
			$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_sal_gra_id = pr_grade.gr_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_pay_scale_sheet.emp_id');
		$this->db->where("pr_pay_scale_sheet.salary_month = '$sal_year_month'");
		if($grid_status == 4)
		{
			$salary_month = substr($sal_year_month,0,7);
			$this->db->where('pr_emp_com_info.emp_id = pr_emp_resign_history.emp_id');
			$this->db->where("trim(substr(pr_emp_resign_history.resign_date,1,7)) LIKE '$salary_month'");
		}
		$this->db->where('pr_emp_com_info.emp_join_date <= ', $lastday);
		

		$this->db->order_by("pr_emp_com_info.emp_id");
		$this->db->group_by("pr_pay_scale_sheet.emp_id");
		$query = $this->db->get();	
		//echo $this->db->last_query();	
		return $query->result();
		
	}
	
	function get_resign_date_by_empid($emp_id)
	{
		$this->db->select('resign_date');
		$this->db->where('emp_id', $emp_id);
		$query = $this->db->get('pr_emp_resign_history');
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			return $resign_date = $row->resign_date;
		}
		else
		{ return false;}
	}
	
	function get_left_date_by_empid($emp_id)
	{
		$this->db->select('left_date');
		$this->db->where('emp_id', $emp_id);
		$query = $this->db->get('pr_emp_left_history');
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			return $resign_date = $row->left_date;
		}
		else
		{ return false;}
	}


	//========================Start Salary Summary=================
	function salary_summary($salary_month,$emp_stat)
	{
		$all_data = array();
		
		$salary_month = $salary_month;
		
		$this->db->select("sec_id,sec_name");
		$this->db->order_by("sec_name");
		$query = $this->db->get("pr_section");
		
		/*$this->db->select("dept_id,dept_name");
		$this->db->order_by("dept_name");
		$query = $this->db->get("pr_dept");*/
		?>
		<!--<table border="1" cellpadding="0" cellspacing="0" style="font-size:10px;">
		<th>Department</th><th>Emp.Cash</th><th>Emp.Bank</th><th>Salary.Cash</th><th>Salary.Bank</th><th>Attn.B.Cash</th><th>Attn.B.Bank</th><th>Over.T.Cash</th><th>Over.T.Bank</th><th>Total.Cash</th><th>Total.Bank</th><th>Cash & Bank</th><th>Cash G. & CMS Adv.</th><th>Bank G. & CMS Adv.</th><th>Abs.Cash</th><th>Abs.Bank</th><th>Stam.Cash</th><th>Stam.Bank</th><th>Tax.Cash</th><th>Tax.Bank</th><th>Cash</th><th>Bank</th><th>Cash+Bank</th>-->
		<?php
		foreach($query->result() as $rows)
		{
			//echo "<tr>";
			//$emp_stat = array('2','3','4','6');
			$data = array();
			$data1 = array();
						
			//echo "<td>";
			//echo $rows->dept_name;
			//echo "</td>";
			$all_data["dept"][] = $rows->sec_name;
			$dept_id = $rows->sec_id;
			
			// For Cash Man Power
			$salary_draw_cash = 1;
			$emp_cash = $this->count_empid_for_salary($dept_id,$emp_stat,$salary_month,$salary_draw_cash,"count");
			$all_data["emp_cash"][] = $emp_cash;
			
			// For Bank Man Power
			$salary_draw_bank = 2;
			$emp_bank = $this->count_empid_for_salary($dept_id,$emp_stat,$salary_month,$salary_draw_bank,"count");
			$all_data["emp_bank"][] = $emp_bank;
			
			// For Cash Emp ID
			$cash_emp_id = $this->count_empid_for_salary($dept_id,$emp_stat,$salary_month,$salary_draw_cash,"emp_id");
			foreach($cash_emp_id as $rows)
			{
				$data[] = $rows->emp_id;
			}
			$data = implode("xxx",$data);
			$emp_id_cash = explode('xxx', trim($data));
			
			// For Bank Emp ID
			$bank_emp_id = $this->count_empid_for_salary($dept_id,$emp_stat,$salary_month,$salary_draw_bank,"emp_id");
			foreach($bank_emp_id as $rows)
			{
				$data1[] = $rows->emp_id;
			}
			$data1 = implode("xxx",$data1);
			$emp_id_bank = explode('xxx', trim($data1));

			//For Cash Pay Wages
			$column_name = "pay_wages" ;
			$net_pay = $this->get_sum_column($column_name,$emp_id_cash,$salary_month);
			$cash_total = $net_pay;
			$all_data["cash_sum"][] = $net_pay;
		
			//For Bank Pay Wages
			$net_pay = $this->get_sum_column($column_name,$emp_id_bank,$salary_month);
			$bank_total = $net_pay;
			$all_data["bank_sum"][] = $net_pay;
			
			//For Cash att_bonus
			$column_name = "att_bonus" ;
			$att_bonus = $this->get_sum_column($column_name,$emp_id_cash,$salary_month);
			$cash_total = $cash_total + $att_bonus;
			$all_data["cash_att_bonus"][] = $att_bonus;	
			
			//For Bank att_bonus
			$column_name = "att_bonus" ;
			$att_bonus = $this->get_sum_column($column_name,$emp_id_bank,$salary_month);
			$bank_total = $bank_total + $att_bonus;
			$all_data["bank_att_bonus"][] = $att_bonus;		
			
			//For Cash ot_amount
			$column_name = "ot_amount" ;
			$ot_amount = $this->get_sum_column($column_name,$emp_id_cash,$salary_month);
			$cash_total = $cash_total + $ot_amount;
			$all_data["cash_ot_amount"][] = $ot_amount;	
			
			//For Bank ot_amount
			$ot_amount = $this->get_sum_column($column_name,$emp_id_bank,$salary_month);
			$bank_total = $bank_total + $ot_amount;
			$all_data["bank_ot_amount"][] = $ot_amount;	
			
			//=================Total Cash Salary calculation===============
			$all_data["cash_total"][] = $cash_total;
			//=================Total Bank Salary calculation===============
			$all_data["bank_total"][] = $bank_total;
			//=================Total Cash & Bank Salary calculation=========
			$total_cash_and_bank = $cash_total + $bank_total;
			$all_data["total_cash_and_bank"][] = $total_cash_and_bank;
			
			//For Cash adv_deduct
			$column_name = "adv_deduct" ;
			$adv_deduct_cash = $this->get_sum_column($column_name,$emp_id_cash,$salary_month);
			$total_cash_deduction = $adv_deduct_cash;
			$all_data["adv_deduct_cash"][] = $adv_deduct_cash;
			
			//For Bank adv_deduct
			$adv_deduct_bank = $this->get_sum_column($column_name,$emp_id_bank,$salary_month);
			$total_bank_deduction = $adv_deduct_bank;
			$all_data["adv_deduct_bank"][] = $adv_deduct_bank;
			
			//For Cash deduct_amount
			$column_name = "deduct_amount" ;
			$deduct_amount_cash = $this->get_sum_column($column_name,$emp_id_cash,$salary_month);
			$total_cash_deduction = $total_cash_deduction + $deduct_amount_cash;
			$all_data["deduct_amount_cash"][] = $deduct_amount_cash;
			
			//For Bank deduct_amount
			$deduct_amount_bank = $this->get_sum_column($column_name,$emp_id_bank,$salary_month);
			$total_bank_deduction = $total_bank_deduction + $deduct_amount_bank;
			$all_data["deduct_amount_bank"][] = $deduct_amount_bank;
									
			
			//For Cash abs_deduction
			$column_name = "abs_deduction" ;
			$abs_deduction_cash = $this->get_sum_column($column_name,$emp_id_cash,$salary_month);
			$total_cash_deduction = $total_cash_deduction;// + $abs_deduction_cash;
			$all_data["abs_deduction_cash"][] = $abs_deduction_cash;
			
			//For Bank abs_deduction
			$abs_deduction_bank = $this->get_sum_column($column_name,$emp_id_bank,$salary_month);
			$total_bank_deduction = $total_bank_deduction;// + $abs_deduction_bank;
			$all_data["abs_deduction_bank"][] = $abs_deduction_bank;
			
			//=================Total Bank Absent Deduction calculation===============<<
			
			//=================Total Cash Stam deduction calculation===============>>
			//$total_cash_stam_deduct = $emp_cash * 10 ;
			$total_cash_stam_deduct = $emp_cash * 0 ;
			//echo "<td>";			
			//echo $total_cash_stam_deduct;
			//echo "</td>";
			
			$total_cash_deduction = $total_cash_deduction + $total_cash_stam_deduct;
			$all_data["total_cash_stam_deduct"][] = $total_cash_stam_deduct;
			
			//=================Total Cash Stam deduction calculation===============<<
			
			//=================Total Bank Stam deduction calculation===============>>
			//$total_bank_stam_deduct = $emp_bank * 10 ;
			$total_bank_stam_deduct = $emp_bank * 0;
			//echo "<td>";			
			//echo $total_bank_stam_deduct;
			//echo "</td>";
			
			$total_bank_deduction = $total_bank_deduction + $total_bank_stam_deduct;
			$all_data["total_bank_stam_deduct"][] = $total_bank_stam_deduct;
			
			//=================Total Bank Stam deduction calculation===============<<
			
			/*//=================Total Cash Tax calculation===============>>
			$this->db->select_sum('tax');
			$this->db->from("pr_pay_scale_sheet");
			$this->db->where_in('pr_pay_scale_sheet.emp_id', $emp_id_cash);
			$this->db->like("salary_month", $salary_month);
			$query = $this->db->get();
			//echo $this->db->last_query();
			$row = $query->row();
			$tax_cash = $row->tax;
			if($tax_cash =='')
			{
				$tax_cash = 0;
			}
			//echo "<td>";
			//echo $tax_cash;
			//echo "</td>";
			
			$total_cash_deduction = $total_cash_deduction + $tax_cash;
			$all_data["tax_cash"][] = $tax_cash;
			
			//=================Total Cash Tax calculation===============<<
			
			//=================Total Bank Tax calculation===============>>
			$this->db->select_sum('tax');
			$this->db->from("pr_pay_scale_sheet");
			$this->db->where_in('pr_pay_scale_sheet.emp_id', $emp_id_bank);
			$this->db->like("salary_month", $salary_month);
			$query = $this->db->get();
			//echo $this->db->last_query();
			$row = $query->row();
			$tax_bank = $row->tax;
			if($tax_bank =='')
			{
				$tax_bank = 0;
			}
			//echo "<td>";
			//echo $tax_bank;
			//echo "</td>";
			$total_bank_deduction = $total_bank_deduction + $tax_bank;
			$all_data["tax_bank"][] = $tax_bank;
			
			//=================Total Bank Tax calculation===============<<
			
*/			//=================Total Cash after deduction calculation===============>>
			$total_cash_after_deduct = $cash_total - $total_cash_deduction;
			//echo "<td>";			
			//echo $total_cash_after_deduct;
			//echo "</td>";
			$all_data["total_cash_after_deduct"][] = $total_cash_after_deduct;
			//=================Total Cash after deduction calculation===============<<
			
			//=================Total Cash after deduction calculation===============>>
			$total_bank_after_deduct = $bank_total - $total_bank_deduction;
			//echo "<td>";			
			//echo $total_bank_after_deduct;
			//echo "</td>";
			$all_data["total_bank_after_deduct"][] = $total_bank_after_deduct;
			//=================Total Cash after deduction calculation===============<<
			
			//=================Total Cash+Bank calculation===============>>
			$sub_total = $total_cash_after_deduct + $total_bank_after_deduct;
			//echo "<td>";			
			//echo $sub_total;
			//echo "</td>";
			$all_data["sub_total"][] = $sub_total;
			//=================Total Cash+Bank calculation===============<<
			
			//echo "<tr>";
		}
		return $all_data;
	}

	//=== Start Salary Summary OT and EOT ======= Zuel Ali ==== 06-01-19 ======
	function sal_summary_with_ot_eot($salary_month,$emp_stat){
		$all_data = array();
		$this->db->select("line_id,line_name");
		$this->db->order_by("line_name");
		$query = $this->db->get("pr_line_num");

		foreach($query->result() as $rows){
			$data = array();
			$data1 = array();
			$line_id = $rows->line_id;

			$all_data[$line_id]["line_name"] = $rows->line_name;
			//New and Regular Emp by line
			$line_manPower = $this->count_emp_by_line($line_id,$emp_stat,$salary_month);
			$all_data[$line_id]["line_manPower"] = $line_manPower;
		}

		/*$all_data["left_rgn"]["line_name"] ='Left & Resign';
		$all_data["left_rgn"]["line_manPower"][] = array('t_emp'=>0);*/

		if ($emp_stat == 'ALL') {
			//All Left and Resign for All Line
			$all_data["left"]["line_name"] ='Left';
			$emp_stat = 'LR';
			$line_manPower = $this->count_emp_by_line(null,$emp_stat,$salary_month, 3);
			$all_data["left"]["line_manPower"] = $line_manPower;

			$all_data["resign"]["line_name"] ='Resign';
			$emp_stat = 'LR';
			$line_manPower = $this->count_emp_by_line(null,$emp_stat,$salary_month, 4);
			$all_data["resign"]["line_manPower"] = $line_manPower;

			$all_data["new"]["line_name"] ='New';
			$emp_stat = 'NW';
			$line_manPower = $this->count_emp_by_line(null,$emp_stat,$salary_month);
			$all_data["new"]["line_manPower"] = $line_manPower;
		}

		// echo "<pre>"; print_r($all_data); exit();

		return $all_data;
	}

	

	
	function count_emp_by_line($line_id,$emp_stat,$salary_month, $lr = null){
		$probation_period 	= $this->common_model->get_setup_attributes(8);
		$prev_prob_month 	= $this->common_model->get_prev_month($probation_period,$salary_month);

		$last_date = date('Y-m-t',strtotime($salary_month));
		$this->db->select('
				count(ps.emp_id) as t_emp, 
				SUM(ps.gross_sal) as t_wages, 
				SUM(ps.att_bonus) as t_bonus, 
				SUM(ps.ot_hour) as t_ot, 
				SUM(ps.ot_amount) as t_ot_amt, 
				SUM(ps.eot_hour) as t_eot, 
				SUM(ps.eot_amount) as t_eot_amt, 
				SUM(ps.total_deduct) as t_deduct_amt
			');
		$this->db->from('pr_emp_com_info as ei');
		$this->db->from('pr_pay_scale_sheet as ps');
		$this->db->where('ps.emp_id = ei.emp_id');
		$this->db->where('ei.emp_join_date <= ', $last_date);
		$this->db->where("ps.salary_month",$salary_month);

		if($emp_stat !='LR' && $emp_stat !='NW'){
			$this->db->where('ei.emp_line_id', $line_id);
		} 

		// $this->db->where("ps.salary_month = '$salary_month'");
		if ($emp_stat =='ALL') {
			$left_rgn_pmt=array(3,4,6);
			$this->db->where_not_in('ei.emp_cat_id', $left_rgn_pmt);
			$this->db->where("trim(substr(ei.emp_join_date,1,7)) != '$prev_prob_month'");
		} elseif($emp_stat =='LR') {
			$left_rgn=array(3,4);
			// $this->db->where_in('ei.emp_cat_id', $left_rgn);
			$this->db->where('ei.emp_cat_id', $lr);
		} else if($emp_stat == 'NW'){
			// exit("wh");
			$left_rgn=array(3,4);
			$this->db->where_not_in('ei.emp_cat_id', $left_rgn);
			$this->db->where("trim(substr(ei.emp_join_date,1,7))", $prev_prob_month);
		} else {
			$this->db->where('ei.emp_cat_id', $emp_stat);
		}
		$query=$this->db->get()->result_array();
		// echo "<pre>"; print_r($query); exit();

		return $query;
	}

	function sal_summary_with_ot_eot_date_between(){
		$this->db->select("line.line_id,line.line_name,SUM(emp.gross_sal) as t_wages,count(DISTINCT emp.emp_id) as t_emp");
		$this->db->from('pr_line_num as line');
		$this->db->join('pr_emp_com_info as emp','emp.emp_line_id = line.line_id');
		$this->db->where('emp.emp_cat_id',1);
		$this->db->order_by('line.line_name');
		$this->db->group_by('line.line_name');
		$query = $this->db->get()->result();
		return $query;
	}

	function summary_date_between($first_date,$second_date,$line_id){
		$first_date = date('Y-m-d',strtotime($first_date));
		$second_date = date('Y-m-d',strtotime($second_date));
			$this->db->select("
				count(DISTINCT case when log.in_time !='00:00:00' and log.out_time !='00:00:00' then log.emp_id end) as p_emps,
				SUM(log.ot_hour) as t_ot,
				SUM(log.extra_ot_hour) as t_eot,
				SUM(log.deduction_hour) as deduction"
			);
			$this->db->from('pr_emp_shift_log as log');
			$this->db->join('pr_emp_com_info as emp','log.emp_id = emp.emp_id');
			$this->db->where('log.shift_log_date >=', $first_date)->where('log.shift_log_date <=', $second_date);
			$this->db->where('emp.emp_line_id', $line_id);
			$this->db->group_by('emp.emp_line_id');
			$data =$this->db->get()->row();
		return $data;
	}


	function grid_out_time_summary_old_13_10_21($grid_date,$emp_stat){
		
		$data = array();
		$lines = $this->db->order_by('line_name')->get('pr_line_num')->result_array();
		foreach ($lines as $key => $value) {
			$line = $value['line_id'];
			$lineName = $value['line_name'];
			$data[$key]['line_id'] = $line;
			$data[$key]['line_name'] = $lineName;
			// $this->db->select("count('pr_emp_shift_log.emp_id') as totalemp");
			// $this->db->from('pr_emp_shift_log');
			// $this->db->join('pr_emp_com_info', 'pr_emp_com_info.emp_id = pr_emp_shift_log.emp_id');
			// $this->db->where('pr_emp_com_info.emp_line_id',$line);
			// $this->db->where('pr_emp_shift_log.shift_log_date',$grid_date);
			// $data[$key]['daily_out_time']=$this->db->get()->result_array();

			$query = $this->db->query("SELECT count('pr_emp_shift_log.emp_id') as totalemp,
			 
				(SELECT count('pr_emp_shift_log.emp_id') FROM `pr_emp_shift_log` JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` WHERE `out_time` BETWEEN '23:50:01' AND '05:59:59' AND `pr_emp_com_info`.`emp_line_id` = '$line' AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' AND `pr_emp_shift_log`.`ot_hour` > '0') AS slot_5 , 
				 (SELECT count('pr_emp_shift_log.emp_id') FROM `pr_emp_shift_log` JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` WHERE `out_time` BETWEEN '17:00:00' AND '17:50:00' AND `pr_emp_com_info`.`emp_line_id` = '$line' AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' AND `pr_emp_shift_log`.`ot_hour` > '0') AS slot_6,
				 (SELECT count('pr_emp_shift_log.emp_id') FROM `pr_emp_shift_log` JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` WHERE `out_time` BETWEEN '17:50:01' AND '18:50:00' AND `pr_emp_com_info`.`emp_line_id` = '$line' AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' AND `pr_emp_shift_log`.`ot_hour` > '0') AS slot_7, 
				 (SELECT count('pr_emp_shift_log.emp_id') FROM `pr_emp_shift_log` JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` WHERE `out_time` BETWEEN '18:50:01' AND '19:50:00' AND `pr_emp_com_info`.`emp_line_id` = '$line' AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' AND `pr_emp_shift_log`.`ot_hour` > '0') AS slot_8 ,
				 (SELECT count('pr_emp_shift_log.emp_id') FROM `pr_emp_shift_log` JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` WHERE `out_time` BETWEEN '19:50:01' AND '20:50:00' AND `pr_emp_com_info`.`emp_line_id` = '$line' AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' AND `pr_emp_shift_log`.`ot_hour` > '0') AS slot_9 , 
				 (SELECT count('pr_emp_shift_log.emp_id') FROM `pr_emp_shift_log` JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` WHERE `out_time` BETWEEN '20:50:01' AND '21:50:50' AND `pr_emp_com_info`.`emp_line_id` = '$line' AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' AND `pr_emp_shift_log`.`ot_hour` > '0') AS slot_10 ,
				 (SELECT count('pr_emp_shift_log.emp_id') FROM `pr_emp_shift_log` JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` WHERE `out_time` BETWEEN '21:50:01' AND '22:50:00' AND `pr_emp_com_info`.`emp_line_id` = '$line' AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' AND `pr_emp_shift_log`.`ot_hour` > '0') AS slot_11 ,
				 (SELECT count('pr_emp_shift_log.emp_id') FROM `pr_emp_shift_log` JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` WHERE `out_time` BETWEEN '22:50:01' AND '23:50:00' AND `pr_emp_com_info`.`emp_line_id` = '$line' AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' AND `pr_emp_shift_log`.`ot_hour` > '0') AS slot_12 
				FROM (`pr_emp_shift_log`) 
				JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				WHERE `pr_emp_com_info`.`emp_line_id` = '$line' AND `pr_emp_shift_log`.`shift_log_date` ='$grid_date'");

			$data[$key]['daily_out_time'] = $query->result_array();
			// echo $this->db->last_query(); exit;

			// print_r($data[$key]['daily_out_time']->result_array()); exit;


		}
		// echo "<pre>";
		// print_r($data);exit();
		return $data;
		
		
		

		/*$all_data = array();
		$this->db->select("line_id,line_name");
		$this->db->order_by("line_name");
		$query = $this->db->get("pr_line_num");

		foreach($query->result() as $rows){
			$data = array();
			$data1 = array();
			$line_id = $rows->line_id;

			$all_data[$line_id]["line_name"] = $rows->line_name;
			//New and Regular Emp by line
			$line_manPower = $this->count_emp_out_time_by_line($line_id,$emp_stat,$grid_date);
			$all_data[$line_id]["line_manPower"] = $line_manPower;
		}

		$all_data["left_rgn"]["line_name"] ='Left & Resign';
		$all_data["left_rgn"]["line_manPower"][] = array('t_emp'=>0);

		if ($emp_stat == 'ALL') {
			//All Left and Resign for All Line
			$emp_stat = 'LR';
			$line_manPower = $this->count_emp_out_time_by_line($line_id='',$emp_stat,$grid_date);
			$all_data["left_rgn"]["line_manPower"] = $line_manPower;
		}
		// exit($line_manPower);
		return $all_data;*/
	}


	function grid_out_time_summary($grid_date,$emp_stat){

		$data = array();
		$year =date('Y',strtotime($grid_date));
		$month =date('m',strtotime($grid_date));
		$day   = date('d',strtotime($grid_date));

		// echo "<pre>";print_r($year);exit;

		$year_month = $year.'-'.$month.'-00';
		$date_day = "date_$day";

		$lines = $this->db->order_by('line_name')->get('pr_line_num')->result_array();
		// echo "<pre>";print_r($lines);exit;
		foreach ($lines as $key => $value) {
			$line = $value['line_id'];
			$lineName = $value['line_name'];
			$data[$key]['line_id'] = $line;
			$data[$key]['line_name'] = $lineName;

			// echo "<pre>";print_r($data[$key]['line_name']);exit;


			$query = $this->db->query("SELECT count('pr_emp_shift_log.emp_id') as totalemp,

				 (SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 WHERE `out_time` BETWEEN '15:00:00' AND '17:49:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_5,

				(SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 WHERE `out_time` BETWEEN '17:50:00' AND '18:49:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_6,

				 (SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `out_time` BETWEEN '18:50:00' AND '19:49:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_7,

				 (SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `out_time` BETWEEN '19:50:00' AND '20:49:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_8,

				 (SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `out_time` BETWEEN '20:50:00' AND '21:49:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_9,

				 (SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `out_time` BETWEEN '21:50:00' AND '22:49:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date'
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_10,

				 (SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 WHERE `out_time` BETWEEN '22:50:00' AND '23:49:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_11,

				 (SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `pr_emp_shift_log`.`out_time` BETWEEN '00:00:01' AND '00:49:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_12,

				(SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `pr_emp_shift_log`.`out_time` BETWEEN '23:50:00' AND '24:00:00' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_12e,

				(SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `pr_emp_shift_log`.`out_time` BETWEEN '00:50:00' AND '01:49:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_12e1,

				(SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `pr_emp_shift_log`.`out_time` BETWEEN '01:50:00' AND '02:49:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_12e2,

				(SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `pr_emp_shift_log`.`out_time` BETWEEN '2:50:00' AND '03:49:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_12e3,

				(SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `pr_emp_shift_log`.`out_time` BETWEEN '3:50:00' AND '04:49:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_12e4,

				(SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `pr_emp_shift_log`.`out_time` BETWEEN '04:50:00' AND '05:49:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_12e5,

				(SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `pr_emp_shift_log`.`out_time` BETWEEN '05:50:00' AND '06:05:01' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_12e6

				FROM (`pr_emp_shift_log`)
				JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`

				WHERE `pr_emp_shift_log`.`shift_log_date` = '$grid_date'
				AND  `pr_emp_shift_log`.`out_time` != '00:00:00'
				AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				AND `pr_emp_com_info`.`ot_entitle` != 1 
				AND `pr_attn_monthly`.`att_month` = '$year_month'
				AND `pr_attn_monthly`.`$date_day` != 'A'
			");

			$data[$key]['daily_out_time'] = $query->result_array();
			// echo $this->db->last_query(); exit;

			// print_r($data[$key]['daily_out_time']->result_array()); exit;


		}
		// echo "<pre>";
		// echo $this->db->last_query(); exit();
		// print_r($data[9]['daily_out_time'][0]['totalemp']);exit();
		// print_r($data);exit();
		return $data;
	}
	

	function grid_out_time_summary_ramadan($grid_date,$emp_stat){

		$data = array();
		$year =date('Y',strtotime($grid_date));
		$month =date('m',strtotime($grid_date));
		$day   = date('d',strtotime($grid_date));

		// echo "<pre>";print_r($year);exit;

		$year_month = $year.'-'.$month.'-00';
		$date_day = "date_$day";

		$lines = $this->db->order_by('line_name')->get('pr_line_num')->result_array();
		// echo "<pre>";print_r($lines);exit;
		foreach ($lines as $key => $value) {
			$line = $value['line_id'];
			$lineName = $value['line_name'];
			$data[$key]['line_id'] = $line;
			$data[$key]['line_name'] = $lineName;

			// echo "<pre>";print_r($data[$key]['line_name']);exit;


			$query = $this->db->query("SELECT count('pr_emp_shift_log.emp_id') as totalemp,

				(SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 WHERE `out_time` BETWEEN '14:00:00' AND '16:19:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_3,

				(SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 WHERE `out_time` BETWEEN '16:20:00' AND '17:19:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_4,

				(SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `out_time` BETWEEN '17:20:00' AND '18:19:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_5,

				 (SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `out_time` BETWEEN '18:20:00' AND '19:19:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_6,

				 (SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `out_time` BETWEEN '19:20:00' AND '20:19:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_7,

				 (SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `out_time` BETWEEN '20:20:00' AND '21:19:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date'
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_8,

				 (SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `out_time` BETWEEN '21:20:00' AND '22:19:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date'
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_9,

				 (SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 WHERE `out_time` BETWEEN '22:20:00' AND '23:19:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_10,

				 (SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `pr_emp_shift_log`.`out_time` BETWEEN '23:20:00' AND '24:00:00' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_11,

				 (SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `pr_emp_shift_log`.`out_time` BETWEEN '00:00:01' AND '00:19:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_11e,

				(SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `pr_emp_shift_log`.`out_time` BETWEEN '00:20:00' AND '01:19:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_12,

				(SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `pr_emp_shift_log`.`out_time` BETWEEN '01:20:00' AND '02:19:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_12e1,

				(SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `pr_emp_shift_log`.`out_time` BETWEEN '02:20:00' AND '03:19:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_12e2,

				(SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `pr_emp_shift_log`.`out_time` BETWEEN '03:20:00' AND '04:19:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_12e3,

				(SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `pr_emp_shift_log`.`out_time` BETWEEN '04:20:00' AND '05:19:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_12e4,

				(SELECT count('pr_emp_shift_log.emp_id')
				 FROM `pr_emp_shift_log` 
				 JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id` 
				 JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				 WHERE `pr_emp_shift_log`.`out_time` BETWEEN '05:20:00' AND '05:39:59' 
				 AND `pr_emp_shift_log`.`shift_log_date` = '$grid_date' 
				 AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				 AND `pr_emp_com_info`.`ot_entitle` != 1 
				 AND `pr_attn_monthly`.`att_month` = '$year_month'
				 AND `pr_attn_monthly`.`$date_day` != 'A'
				) AS slot_12e5

				FROM (`pr_emp_shift_log`)
				JOIN `pr_emp_com_info` ON `pr_emp_com_info`.`emp_id` = `pr_emp_shift_log`.`emp_id`
				JOIN `pr_attn_monthly` ON `pr_attn_monthly`.`emp_id` = `pr_emp_shift_log`.`emp_id`

				WHERE `pr_emp_shift_log`.`shift_log_date` = '$grid_date'
				AND  `pr_emp_shift_log`.`out_time` != '00:00:00'
				AND `pr_emp_com_info`.`emp_line_id` = '$line' 
				AND `pr_emp_com_info`.`ot_entitle` != 1 
				AND `pr_attn_monthly`.`att_month` = '$year_month'
				AND `pr_attn_monthly`.`$date_day` != 'A'
			");

			$data[$key]['daily_out_time'] = $query->result_array();
			// echo $this->db->last_query(); exit;

			// print_r($data[$key]['daily_out_time']); exit;
		}
		// echo "<pre>";
		// echo $this->db->last_query(); exit();
		// print_r($data[9]['daily_out_time'][0]['totalemp']);exit();
		// print_r($data);exit();
		return $data;
	}
	

	
	function count_emp_out_time_by_line($line_id,$emp_stat,$grid_date){
		$last_date = date('Y-m-d',strtotime($grid_date));
		// exit($last_date);
		$this->db->select('count(ps.emp_id) as t_emp');
		// $this->db->select('count(ei.emp_id) as t_emp, ps.shift_log_date, ps.out_time');
		$this->db->from('pr_emp_com_info as ei');
		$this->db->from('pr_emp_shift_log as ps');
		if($emp_stat !='LR'){
			$this->db->where('ei.emp_line_id', $line_id);
		}$this->db->where('ei.emp_join_date <= ', $last_date);
		$this->db->where('ps.emp_id = ei.emp_id');
		// $this->db->where("ps.shift_log_date",$last_date);
		if ($emp_stat =='ALL') {
			$left_rgn_pmt=array(3,4,6);
			$this->db->where_not_in('ei.emp_cat_id', $left_rgn_pmt);
		}elseif($emp_stat =='LR'){
			$left_rgn=array(3,4);
			$this->db->where_in('ei.emp_cat_id', $left_rgn);
		}else{
			$this->db->where('ei.emp_cat_id', $emp_stat);
		}
		$query=$this->db->get()->result_array();
		return $query;
	}
	//--------------------------------------------
	/*
	function grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id){
		$year  = substr($sal_year_month,0,4);
		$month = substr($sal_year_month,5,2);
		$last_day = date("t", mktime(0, 0, 0, $month, 1, $year));	
		
		$lastday = date("Y-m-d", mktime(0, 0, 0, $month, $last_day, $year));		
		
		$this->db->select('pr_emp_per_info.emp_full_name,pr_designation.desig_name, pr_section.sec_name, pr_emp_com_info.emp_join_date,pr_grade.gr_name,pr_pay_scale_sheet.*');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_grade');
		$this->db->from('pr_pay_scale_sheet');
			$this->db->from('pr_dept');
			$this->db->from('pr_section');
			$this->db->from('pr_line_num');
			$this->db->from('pr_designation');
			if($grid_status == 4){
				$this->db->from('pr_emp_resign_history');
			}
			$this->db->where_in('pr_emp_com_info.emp_id', $grid_emp_id);
			$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
			$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
			$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
			$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_sal_gra_id = pr_grade.gr_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_pay_scale_sheet.emp_id');
		$this->db->where("pr_pay_scale_sheet.salary_month = '$sal_year_month'");
		if($grid_status == 4){
			$salary_month = substr($sal_year_month,0,7);
			$this->db->where('pr_emp_com_info.emp_id = pr_emp_resign_history.emp_id');
			$this->db->where("trim(substr(pr_emp_resign_history.resign_date,1,7)) LIKE '$salary_month'");
		}
		$this->db->where('pr_emp_com_info.emp_join_date <= ', $lastday);
		$this->db->order_by("pr_emp_com_info.emp_id");
		$this->db->group_by("pr_pay_scale_sheet.emp_id");
		$query = $this->db->get();	
		//echo $this->db->last_query();	
		return $query->result();
	}*/
	//========================End Salary Summary=================

	/*function count_empid_for_salary($dept_id,$emp_stat,$salary_month,$salary_draw,$check)
	 {
		$this->db->select('pr_emp_com_info.*');
		$this->db->where("emp_sec_id", $dept_id );
		$this->db->where("salary_draw",$salary_draw);
		$this->db->where("emp_cat_id", $emp_stat);
		$this->db->from('pr_emp_com_info');
		if($emp_stat == 4)// For Resign
		{
			$this->db->from('pr_emp_resign_history');
		}
		if($emp_stat == 3)//For left
		{
			$this->db->from('pr_emp_left_history');
		}
		if($emp_stat == 2)
		{
			 $salary_month = substr($salary_month,0,7);
			 $this->db->where("trim(substr(pr_emp_com_info.emp_join_date,1,7)) LIKE '$salary_month'");
		}
		if($emp_stat == 4)
		{
			$salary_month = substr($salary_month,0,7);
			$this->db->where('pr_emp_com_info.emp_id = pr_emp_resign_history.emp_id');
			$this->db->where("trim(substr(pr_emp_resign_history.resign_date,1,7)) LIKE '$salary_month'");
		}
		if($emp_stat == 3)
		{
			$salary_month = substr($salary_month,0,7);
			$this->db->where('pr_emp_com_info.emp_id = pr_emp_left_history.emp_id');
			$this->db->where("trim(substr(pr_emp_left_history.left_date,1,7)) LIKE '$salary_month'");
		}
		//$emp_no = $this->db->count_all_results();
		$emp_no = $this->db->get();
		//echo $this->db->last_query();
		//echo $salary_month."===";
		if($check == "count")
		{
			return $emp_no->num_rows();
		}
		return $emp_no->result();
	 }*/
	
	function get_sum_column($column_name,$emp_id,$salary_month)
	{
		
		$this->db->select_sum($column_name);
		$this->db->from("pr_pay_scale_sheet");
		$this->db->where_in('pr_pay_scale_sheet.emp_id', $emp_id);
		$this->db->like("salary_month", $salary_month);
		$query = $this->db->get();
		//echo $this->db->last_query();
		$row = $query->row();
		$result = $row->$column_name;

			if($result =='')
			{
				$result = 0;
			}
		
		return $result;
	}
	
	//========================End Salary Summary=================
	
	function prox($empid)
	{
		$this->db->select('proxi_id');
		$this->db->where('emp_id',$empid);
		$query = $this->db->get('pr_id_proxi');
		foreach ($query->result() as $rows)
		{
			return $rows->proxi_id;
		}
	}
	
	function all_reguler_emp($grid_emp_id)
	{
		$emp_cat_id = array( '0'=>1, '1'=>2);
				
		$this->db->select('emp_id');
		$this->db->from('pr_emp_com_info');
		$this->db->where_in('emp_id', $grid_emp_id);
		$this->db->where_in('emp_cat_id', $emp_cat_id);
		$this->db->order_by("emp_id");
		$query = $this->db->get();
		return $query;
	}
	
	function grid_general_info($grid_emp_id)
	{
		// exit('pr_emp_add');
		$this->db->select('pr_emp_sex.sex_name,pr_emp_com_info.emp_id, pr_emp_per_info.emp_full_name, pr_emp_per_info.emp_dob,pr_emp_per_info.mobile,pr_emp_per_info.bank_acc as mobile,pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_designation.desig_name,  pr_emp_com_info.emp_join_date,pr_grade.gr_name, pr_emp_com_info.gross_sal, pr_id_proxi.proxi_id, pr_emp_add.nid');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_grade');
			$this->db->from('pr_dept');
			$this->db->from('pr_section');
			$this->db->from('pr_line_num');
			$this->db->from('pr_designation');
			$this->db->from('pr_id_proxi');
			$this->db->from('pr_emp_sex');
			$this->db->from('pr_emp_add');
			$this->db->where_in('pr_emp_com_info.emp_id', $grid_emp_id);
			$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
			$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
			$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
			$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
			$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
			$this->db->where('pr_emp_per_info.emp_sex = pr_emp_sex.sex_id');
			$this->db->where('pr_emp_per_info.emp_id = pr_emp_add.emp_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_sal_gra_id = pr_grade.gr_id');

		$this->db->order_by("pr_emp_com_info.emp_id");
		$query = $this->db->get();	
		//echo $this->db->last_query();	
		return $query->result();
		
	}
	
	function grid_new_join_report($grid_firstdate, $grid_seconddate, $grid_emp_id)
	{
		$data = array();
		$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name,  pr_designation.desig_name, pr_emp_com_info.emp_join_date, pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_id_proxi.proxi_id, pr_emp_shift.shift_name,pr_emp_com_info.emp_cat_id, pr_emp_com_info.emp_sal_gra_id, pr_emp_com_info.gross_sal,pr_emp_per_info.emp_dob');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_id_proxi');
		$this->db->from('pr_emp_shift');
		$this->db->where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
		$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
		$this->db->where("pr_emp_com_info.emp_join_date BETWEEN '$grid_firstdate' and '$grid_seconddate'");
		
		//$this->db->order_by("pr_dept.dept_name","ASC");
		//$this->db->order_by("pr_section.sec_name","ASC");
		//$this->db->order_by("pr_line_num.line_name","ASC");
		$this->db->order_by("pr_emp_com_info.emp_id","ASC");
		$query = $this->db->get();
		//echo $this->db->last_query();
		//$put = $query->result_array();
		//print_r($put);
		foreach($query->result() as $rows)
		{
			$data["emp_id"][] 			= $rows->emp_id;
			$data["emp_name"][] 		= $rows->emp_full_name;
			$data["proxi_id"][] 		= $rows->proxi_id;
			$data["desig_name"][]		= $rows->desig_name;
			$data["gross_sal"][] 		= $rows->gross_sal;
			$data["doj"][] 				= $rows->emp_join_date;
			$data["emp_dob"][] 			= $rows->emp_dob;
			$data["dept_name"][] 		= $rows->dept_name;
			$data["sec_name"][] 		= $rows->sec_name;
			$data["line_name"][] 		= $rows->line_name;
			$data["emp_sal_gra_id"][] 	= $rows->emp_sal_gra_id;
		}
		
		//print_r($data);
		if($data)
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	
	function grid_resign_report($grid_firstdate, $grid_seconddate, $grid_emp_id)
	{
		$data = array();
		$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name,  pr_designation.desig_name, pr_emp_com_info.emp_join_date, pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_id_proxi.proxi_id, pr_emp_shift.shift_name,pr_emp_com_info.emp_cat_id, pr_emp_com_info.gross_sal, pr_emp_resign_history.resign_date as e_date, pr_emp_add.emp_pre_add');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_id_proxi');
		$this->db->from('pr_emp_shift');
		$this->db->from("pr_emp_resign_history");	
		$this->db->from("pr_emp_add");	
		$this->db->where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		$this->db->where("pr_emp_add.emp_id = pr_emp_com_info.emp_id");
		$this->db->where("pr_emp_resign_history.emp_id = pr_emp_com_info.emp_id");
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
		$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
		$this->db->where("pr_emp_resign_history.resign_date BETWEEN '$grid_firstdate' and '$grid_seconddate'");
		$this->db->order_by("pr_emp_com_info.emp_id","ASC");
		$query = $this->db->get();
		
		foreach($query->result() as $rows)
		{
			$data["emp_id"][] = $rows->emp_id;
			$data["proxi_id"][] = $rows->proxi_id;
			$data["emp_name"][] = $rows->emp_full_name;
			$data["doj"][] = $rows->emp_join_date;
			$data["add"][] = $rows->emp_pre_add;
			$data["dept_name"][] = $rows->dept_name;
			$data["sec_name"][] = $rows->sec_name;
			$data["desig_name"][] = $rows->desig_name;
			$data["line_name"][] = $rows->line_name;
			$data["gross_sal"][] = $rows->gross_sal;
			$data["e_date"][] = $rows->e_date;
		}
		
		if($data)
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	
	function grid_left_report($grid_firstdate, $grid_seconddate, $grid_emp_id)
	{

		$data = array();
		$this->db->select(' pr_emp_per_info.emp_dob,
							pr_emp_com_info.emp_id,
							pr_emp_per_info.emp_full_name,  
							pr_designation.desig_name, 
							pr_emp_com_info.emp_join_date, 
							pr_dept.dept_name, 
							pr_section.sec_name, 
							pr_line_num.line_name, 
							pr_id_proxi.proxi_id,
							pr_emp_shift.shift_name,
							pr_emp_com_info.emp_cat_id, 
							pr_emp_com_info.gross_sal, 
							pr_emp_left_history.left_date  as left_date , 
							pr_emp_add.pre_add_bn,
							pr_emp_add.per_add_bn,
					      ');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_id_proxi');
		$this->db->from('pr_emp_shift');
		$this->db->from("pr_emp_left_history");	
		$this->db->from("pr_emp_add");	
		$this->db->where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		$this->db->where("pr_emp_add.emp_id = pr_emp_com_info.emp_id");
		$this->db->where("pr_emp_left_history.emp_id = pr_emp_com_info.emp_id");
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
		$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
		$this->db->where("pr_emp_left_history.left_date BETWEEN '$grid_firstdate' and '$grid_seconddate'");
		$this->db->order_by("pr_emp_com_info.emp_id","ASC");
		$query = $this->db->get();
		
		foreach($query->result() as $rows)
		{
			$data["emp_id"][] 		= $rows->emp_id;
			$data["proxi_id"][] 	= $rows->proxi_id;
			$data["emp_name"][] 	= $rows->emp_full_name;
			$data["emp_dob"][] 		= $rows->emp_dob;
			$data["doj"][] 			= $rows->emp_join_date;
			$data["pre_add_bn"][] 	= $rows->pre_add_bn;
			$data["per_add_bn"][] 	= $rows->per_add_bn;
			$data["dept_name"][] 	= $rows->dept_name;
			$data["sec_name"][] 	= $rows->sec_name;
			$data["desig_name"][] 	= $rows->desig_name;
			$data["line_name"][]	= $rows->line_name;
			$data["gross_sal"][] 	= $rows->gross_sal;
			$data["e_date"][] 		= $rows->left_date;
		}

		

		if($data)
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	
	function grid_daily_eot($grid_firstdate, $grid_emp_id)
	{
		$data = array();
		$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name,  pr_designation.desig_name, pr_emp_com_info.emp_join_date, pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_id_proxi.proxi_id, pr_emp_shift.shift_name,pr_emp_com_info.emp_cat_id, pr_emp_com_info.gross_sal, pr_emp_add.emp_pre_add, pr_emp_shift_log.in_time, pr_emp_shift_log.out_time, pr_emp_shift_log.ot_hour, pr_emp_shift_log.extra_ot_hour');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_id_proxi');
		$this->db->from('pr_emp_shift');
		$this->db->from("pr_emp_add");	
		$this->db->from('pr_emp_shift_log');
		$this->db->where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		$this->db->where("pr_emp_add.emp_id = pr_emp_com_info.emp_id");
		$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
		$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
		$this->db->where("pr_emp_shift_log.shift_log_date", $grid_firstdate);
		$this->db->where("pr_emp_shift_log.extra_ot_hour !=", 0 );
		$this->db->order_by("pr_emp_com_info.emp_id","ASC");
		$query = $this->db->get();
				
		foreach($query->result() as $rows)
		{
			$gross_sal = $rows->gross_sal;
			$salary_structure 		= $this->common_model->salary_structure($gross_sal);	
			$ot_rate = $salary_structure['ot_rate'];
			
			$ot_amount = $rows->ot_hour * $ot_rate;
			$ot_amount = round($ot_amount);
			
			$eot_amount = $rows->extra_ot_hour * $ot_rate;
			$eot_amount = round($eot_amount);
			
			
			$data["emp_id"][] 		= $rows->emp_id;
			$data["proxi_id"][] 	= $rows->proxi_id;
			$data["emp_name"][] 	= $rows->emp_full_name;
			$data["doj"][] 			= $rows->emp_join_date;
			$data["add"][] 			= $rows->emp_pre_add;
			$data["dept_name"][] 	= $rows->dept_name;
			$data["sec_name"][] 	= $rows->sec_name;
			$data["desig_name"][] 	= $rows->desig_name;
			$data["line_name"][]	= $rows->line_name;
			$data["gross_sal"][] 	= $rows->gross_sal;
			$data["emp_shift"][] 	= $rows->shift_name;
			$data["in_time"][] 		= $rows->in_time;
			$data["out_time"][] 	= $rows->out_time;
			$data["ot_hour"][] 		= $rows->ot_hour;
			$data["extra_ot_hour"][]= $rows->extra_ot_hour;
			$data["ot_rate"][]		= $ot_rate;
			$data["ot_amount"][]	= $ot_amount;
			$data["eot_amount"][]	= $eot_amount;
			
		}
		
		if($data)
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	
	function grid_daily_eot_after_12_am($grid_firstdate,$grid_seconddate, $grid_emp_id)
	{
		$data = array();
		$this->db->select("
					pr_emp_com_info.emp_id,
					pr_emp_per_info.emp_full_name,  
					pr_designation.desig_name, 
					pr_emp_com_info.emp_join_date, 
					pr_line_num.line_name, 
					pr_emp_com_info.gross_sal,   
									
					SUM(CASE WHEN log.out_time > '18:20:01' AND log.out_time < '24:00:00' THEN 1 ELSE 0 END ) AS evening,
					SUM(CASE WHEN log.out_time > '00:00:01' AND log.out_time < '06:00:01' THEN 1 ELSE 0 END ) AS night,
				");
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_line_num');
		$this->db->from('pr_emp_shift_log as log');
		$this->db->where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		$this->db->where("log.emp_id = pr_emp_com_info.emp_id");
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where("log.shift_log_date BETWEEN '".$grid_firstdate."' AND '".$grid_seconddate."'");
		$this->db->order_by("pr_emp_com_info.emp_id","ASC");
		$this->db->group_by("pr_emp_com_info.emp_id");
		$query = $this->db->get()->result();
		
		if($query)
		{
			
			return $query;
		}
		else
		{
			return "Requested list is empty";
		}
	}

	function tiffin_bill_after_12_am($grid_firstdate, $grid_seconddate, $grid_emp_id)
	{
		$outTime = "00:00:01"; 
		$inTime = "05:59:59";
		// exit($outTime);
		$data = array();
		$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name,  pr_designation.desig_name, pr_line_num.line_name, COUNT(pr_emp_com_info.emp_id) as total_night');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_line_num');
		$this->db->from('pr_emp_shift_log');
		$this->db->where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where("shift_log_date BETWEEN '$grid_firstdate' AND '$grid_seconddate'");
		$this->db->where("pr_emp_shift_log.out_time >=", $outTime); 
		$this->db->where("pr_emp_shift_log.out_time <", $inTime);
		$this->db->order_by("pr_emp_com_info.emp_id","ASC");
		$this->db->group_by("pr_emp_com_info.emp_id");
		$query1 = $this->db->get()->result();

		$inTime = '23:50:00';
		$outTime = '24:00:00';
		// for ramadan 2022
		if ($grid_firstdate >= '2022-04-03' && $grid_seconddate <= '2022-05-02') {
			$inTime = '22:19:00';
		} //else {
			
		//}

		$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name,  pr_designation.desig_name, pr_line_num.line_name, COUNT(pr_emp_com_info.emp_id) as total_night');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_line_num');
		$this->db->from('pr_emp_shift_log');
		$this->db->where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where("shift_log_date BETWEEN '$grid_firstdate' AND '$grid_seconddate'");
		$this->db->where("pr_emp_shift_log.out_time >", $inTime ); 
		$this->db->where("pr_emp_shift_log.out_time <", $outTime );
		$this->db->order_by("pr_emp_com_info.emp_id","ASC");
		$this->db->group_by("pr_emp_com_info.emp_id");
		$query2 = $this->db->get()->result();

		// echo "<pre>"; print_r($query1); die();

        //  append Total night  set
        // foreach ($query2 as $row2) {
	       //  foreach ($query1 as &$value){
	       //  	if ($value->emp_id == $row2->emp_id) {
        //             $value->total_night = $value->total_night + $row2->total_night;
        //         }
	       //  }
        // }

		
		if($query1)
		{
			
			return $query1;
		}
		else
		{
			return "Requested list is empty";
		}
	}

	function tiffin_bill_10pm_to_12am($grid_firstdate, $grid_seconddate, $grid_emp_id)
	{
		// $inTime = '23:50:00'; 
		$outTime = '24:00:00';
		// for ramadan 2022
		// if ($grid_firstdate >= '2022-04-03' && $grid_seconddate <= '2022-05-02') {
		// } 
		$inTime = '22:19:00';

		$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name,  pr_designation.desig_name, pr_line_num.line_name, COUNT(pr_emp_com_info.emp_id) as total_night');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_line_num');
		$this->db->from('pr_emp_shift_log');
		$this->db->where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where("shift_log_date BETWEEN '$grid_firstdate' AND '$grid_seconddate'");
		$this->db->where("pr_emp_shift_log.out_time >", $inTime); 
		$this->db->where("pr_emp_shift_log.out_time <", $outTime);
		$this->db->order_by("pr_emp_com_info.emp_id","ASC");
		$this->db->group_by("pr_emp_com_info.emp_id");
		$query2 = $this->db->get()->result();

		// echo "<pre>"; print_r($query1); die();

        //  append Total night  set
        // foreach ($query2 as $row2) {
	       //  foreach ($query1 as &$value){
	       //  	if ($value->emp_id == $row2->emp_id) {
        //             $value->total_night = $value->total_night + $row2->total_night;
        //         }
	       //  }
        // }

		
		if($query2)
		{
			
			return $query2;
		}
		else
		{
			return "Requested list is empty";
		}
	}

	function grid_job_card($grid_firstdate, $grid_seconddate, $grid_emp_id)
	{
		$data = array();
		$this->db->distinct();
		$this->db->select('pr_emp_per_info.emp_full_name,pr_designation.desig_id,pr_designation.desig_name,pr_dept.dept_name,pr_section.sec_name,pr_line_num.line_name,pr_emp_com_info.emp_id, pr_emp_com_info.emp_join_date, pr_id_proxi.proxi_id, pr_emp_com_info.emp_desi_id');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_id_proxi');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_designation');
		$this->db->where_in('pr_emp_com_info.emp_id', $grid_emp_id);
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_id_proxi.emp_id = pr_emp_com_info.emp_id');
		$query = $this->db->get();
		return $query->result();
	}	


	function grid_extra_ot_10pm($grid_firstdate, $grid_seconddate, $grid_emp_id)
	{
		$data = array();
		$this->db->distinct();
		$this->db->select('pr_emp_per_info.emp_full_name,pr_designation.desig_id,pr_designation.desig_name,pr_dept.dept_name,pr_section.sec_name,pr_line_num.line_name,pr_emp_com_info.emp_id, pr_emp_com_info.emp_join_date, pr_id_proxi.proxi_id, pr_emp_com_info.emp_desi_id');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_id_proxi');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_designation');
		$this->db->where_in('pr_emp_com_info.emp_id', $grid_emp_id);
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_id_proxi.emp_id = pr_emp_com_info.emp_id');
		$query = $this->db->get();
		return $query->result();
	}


	function grid_monthly_eot_sheet_10pm($sal_year_month, $grid_status, $grid_emp_id)
	{
		$year  = substr($sal_year_month,0,4);
		$month = substr($sal_year_month,5,2);
		$last_day = date("t", mktime(0, 0, 0, $month, 1, $year));	
		
		$lastday = date("Y-m-d", mktime(0, 0, 0, $month, $last_day, $year));		
		
		$this->db->select('pr_emp_per_info.emp_full_name,pr_designation.desig_name, pr_section.sec_name, pr_emp_com_info.emp_join_date,pr_grade.gr_name,pr_pay_scale_sheet.*');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_grade');
		$this->db->from('pr_pay_scale_sheet');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_designation');
		if($grid_status == 4){
			$this->db->from('pr_emp_resign_history');
		}
		$this->db->where_in('pr_emp_com_info.emp_id', $grid_emp_id);
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_sal_gra_id = pr_grade.gr_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_pay_scale_sheet.emp_id');
		$this->db->where("pr_pay_scale_sheet.salary_month = '$sal_year_month'");
		if($grid_status == 4){
			$salary_month = substr($sal_year_month,0,7);
			$this->db->where('pr_emp_com_info.emp_id = pr_emp_resign_history.emp_id');
			$this->db->where("trim(substr(pr_emp_resign_history.resign_date,1,7)) LIKE '$salary_month'");
		}
		$this->db->where('pr_emp_com_info.emp_join_date <= ', $lastday);
		

		$this->db->order_by("pr_emp_com_info.emp_id");
		$this->db->group_by("pr_pay_scale_sheet.emp_id");
		$query = $this->db->get();	
		return $query->result();
	}
	
	function grid_daily_eot_after_12_am_old_14_11_2021($grid_firstdate, $grid_emp_id)
	{
		$outTime = "00:00:01"; 
		$inTime = "05:59:59";
		// exit($outTime);
		$data = array();
		$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name,  pr_designation.desig_name, pr_emp_com_info.emp_join_date, pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_id_proxi.proxi_id, pr_emp_shift.shift_name,pr_emp_com_info.emp_cat_id, pr_emp_com_info.gross_sal, pr_emp_add.emp_pre_add, pr_emp_shift_log.in_time, pr_emp_shift_log.out_time, pr_emp_shift_log.ot_hour, pr_emp_shift_log.extra_ot_hour');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_id_proxi');
		$this->db->from('pr_emp_shift');
		$this->db->from("pr_emp_add");	
		$this->db->from('pr_emp_shift_log');
		$this->db->where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		$this->db->where("pr_emp_add.emp_id = pr_emp_com_info.emp_id");
		$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
		$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
		$this->db->where("pr_emp_shift_log.shift_log_date", $grid_firstdate);
		// $this->db->where("pr_emp_shift_log.out_time BETWEEN '$outTime' and 'inTime' or pr_emp_shift_log.extra_ot_hour > '4'");
	 	//$this->db->where("pr_emp_shift_log.extra_ot_hour > ", 4);  // comment out 10/10/21 shahajahn
		$this->db->where("pr_emp_shift_log.out_time >", $outTime ); // comment 10/10/21 shahajahn
		$this->db->where("pr_emp_shift_log.out_time <", $inTime ); // comment 10/10/21 shahajahn
		$this->db->order_by("pr_emp_com_info.emp_id","ASC");
		$query = $this->db->get();
		// echo($this->db->last_query()); exit();
				
		foreach($query->result() as $rows)
		{
			$gross_sal = $rows->gross_sal;
			$salary_structure 		= $this->common_model->salary_structure($gross_sal);	
			$ot_rate = $salary_structure['ot_rate'];
			
			$ot_amount = $rows->ot_hour * $ot_rate;
			$ot_amount = round($ot_amount);
			
			$eot_amount = $rows->extra_ot_hour * $ot_rate;
			$eot_amount = round($eot_amount);
			
			
			$data["emp_id"][] 		= $rows->emp_id;
			$data["proxi_id"][] 	= $rows->proxi_id;
			$data["emp_name"][] 	= $rows->emp_full_name;
			$data["doj"][] 			= $rows->emp_join_date;
			$data["add"][] 			= $rows->emp_pre_add;
			$data["dept_name"][] 	= $rows->dept_name;
			$data["sec_name"][] 	= $rows->sec_name;
			$data["desig_name"][] 	= $rows->desig_name;
			$data["line_name"][]	= $rows->line_name;
			$data["gross_sal"][] 	= $rows->gross_sal;
			$data["emp_shift"][] 	= $rows->shift_name;
			$data["in_time"][] 		= $rows->in_time;
			$data["out_time"][] 	= $rows->out_time;
			$data["ot_hour"][] 		= $rows->ot_hour;
			$data["extra_ot_hour"][]= $rows->extra_ot_hour;
			$data["ot_rate"][]		= $ot_rate;
			$data["ot_amount"][]	= $ot_amount;
			$data["eot_amount"][]	= $eot_amount;
		}
		
		if($data)
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}

	
	function grid_daily_ot($grid_firstdate, $grid_emp_id)
	{
		$data = array();
		$this->db->distinct();
		$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name,  pr_designation.desig_name, pr_emp_com_info.emp_join_date, pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_id_proxi.proxi_id, pr_emp_shift.shift_name,pr_emp_com_info.emp_cat_id, pr_emp_com_info.gross_sal, pr_emp_add.emp_pre_add, pr_emp_shift_log.in_time, pr_emp_shift_log.out_time, pr_emp_shift_log.ot_hour, pr_emp_shift_log.extra_ot_hour');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_id_proxi');
		$this->db->from('pr_emp_shift');
		$this->db->from("pr_emp_add");	
		$this->db->from('pr_emp_shift_log');
		$this->db->where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		$this->db->where("pr_emp_add.emp_id = pr_emp_com_info.emp_id");
		$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
		$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
		$this->db->where("pr_emp_shift_log.shift_log_date", $grid_firstdate);
		$this->db->where("pr_emp_shift_log.ot_hour !=", 0 );
		$this->db->order_by("pr_emp_com_info.emp_id","ASC");
		$query = $this->db->get();
		//echo $this->db->last_query();
				
		foreach($query->result() as $rows)
		{
			$gross_sal = $rows->gross_sal;
			$salary_structure 		= $this->common_model->salary_structure($gross_sal);	
			// echo "<pre>"; print_r($salary_structure ); die;
			$ot_rate = $salary_structure['ot_rate'];
			$total_ot_hour = $rows->ot_hour ; //+ $rows->extra_ot_hour , This is for Extra OT hour add in Daily ot.
			$ot_amount = $total_ot_hour * $ot_rate;
			$ot_amount = round($ot_amount);
			
			$emp_id = $rows->emp_id;
			$emp_shift = $this->emp_shift_check($emp_id, $grid_firstdate);
			$in_time = $rows->in_time;
			$in_time = $this->get_formated_in_time($emp_id, $in_time, $emp_shift);
			$out_time = $rows->out_time;
			$out_time = $this->get_formated_out_time($emp_id, $out_time, $emp_shift);
			
			$data["emp_id"][] 		= $rows->emp_id;
			$data["proxi_id"][] 	= $rows->proxi_id;
			$data["emp_name"][] 	= $rows->emp_full_name;
			$data["doj"][] 			= $rows->emp_join_date;
			$data["add"][] 			= $rows->emp_pre_add;
			$data["dept_name"][] 	= $rows->dept_name;
			$data["sec_name"][] 	= $rows->sec_name;
			$data["desig_name"][] 	= $rows->desig_name;
			$data["line_name"][]	= $rows->line_name;
			$data["gross_sal"][] 	= $rows->gross_sal;
			$data["emp_shift"][] 	= $rows->shift_name;
			$data["in_time"][] 		= $in_time;
			$data["out_time"][] 	= $out_time;
			$data["ot_hour"][] 		= $total_ot_hour;
			$data["ot_rate"][]		= $ot_rate;
			$data["ot_amount"][]	= $ot_amount;
		}
		
		if($data)
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	
	function grid_daily_allowance_bills($att_date, $grid_emp_id)
	{
		/*$this->db->select('ot_entitle,emp_id');
		$this->db->where_in("emp_id", $grid_emp_id);
		$query = $this->db->get("pr_emp_com_info");*/
		$data = array();
		$this->db->distinct();
		$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name,pr_designation.desig_name, pr_emp_com_info.emp_join_date, pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_id_proxi.proxi_id, pr_emp_shift.shift_name,pr_emp_com_info.emp_cat_id, pr_emp_com_info.gross_sal, pr_emp_com_info.ot_entitle, pr_emp_add.emp_pre_add, pr_emp_shift_log.in_time, pr_emp_shift_log.out_time, pr_emp_shift_log.ot_hour, pr_emp_shift_log.extra_ot_hour');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_id_proxi');
		$this->db->from('pr_emp_shift');
		$this->db->from("pr_emp_add");	
		$this->db->from('pr_emp_shift_log');
		$this->db->where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		$this->db->where("pr_emp_add.emp_id = pr_emp_com_info.emp_id");
		$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
		$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
		$this->db->where("pr_emp_shift_log.shift_log_date", $att_date);
		$this->db->where("pr_emp_shift_log.ot_hour !=", 0 );
		$this->db->order_by("pr_emp_com_info.emp_id","ASC");
		$query = $this->db->get();
		foreach($query->result() as $rows)
		{
			$emp_id = $rows->emp_id;
			$ot_entitle = $rows->ot_entitle;
			$allowance_data = $this->get_allowance_data($emp_id,$ot_entitle,$att_date);
			
			$data["emp_id"][] 					= $emp_id;
			$data["proxi_id"][] 				= $rows->proxi_id;
			$data["emp_name"][] 				= $rows->emp_full_name;
			$data["doj"][] 						= $rows->emp_join_date;
			$data["add"][] 						= $rows->emp_pre_add;
			$data["dept_name"][] 				= $rows->dept_name;
			$data["sec_name"][] 				= $rows->sec_name;
			$data["desig_name"][] 				= $rows->desig_name;
			$data["line_name"][]				= $rows->line_name;
			$data["emp_shift"][] 				= $rows->shift_name;
			$data["out_time"][] 				= $allowance_data["out_time"];
			$data["first_tiffin_allo_min"][] 	= $allowance_data["first_tiffin_allo_min"];
			$data["second_tiffin_allo_min"][] 	= $allowance_data["second_tiffin_allo_min"];
			$data["night_allo_min"][] 			= $allowance_data["night_allo_min"];
			$data["first_tiffin_allo_amount"][] = $allowance_data["first_tiffin_allo_amount"];
			$data["second_tiffin_allo_amount"][] = $allowance_data["second_tiffin_allo_amount"];
			$data["night_allo_amount"][] 		= $allowance_data["night_allo_amount"];
		}
		if($data)
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}	
		
	}
	
	
	
	
	function grid_monthly_ot_register($grid_firstdate, $grid_emp_id)
	{
		$data = array();
		$search_year_month = substr($grid_firstdate,0,7);
		$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name,  pr_designation.desig_name, pr_emp_com_info.emp_join_date, pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_id_proxi.proxi_id, pr_emp_shift.shift_name,pr_emp_com_info.emp_cat_id, pr_emp_com_info.gross_sal');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_id_proxi');
		$this->db->from('pr_emp_shift');
		$this->db->where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
		$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
		$this->db->order_by("pr_emp_com_info.emp_id","ASC");
		$query = $this->db->get();
				
		foreach($query->result() as $rows)
		{
			$emp_id = $rows->emp_id;
			$gross_sal = $rows->gross_sal;
				
			$basic_sal_payable = ($gross_sal * 60 / 100);
			$basic_sal = round($basic_sal_payable);
			$ot_rate = $basic_sal * 2 / 208 ;
			$ot_rate = round($ot_rate,2);
			
			/*$this->db->select_sum("ot_hour");
			$this->db->where("emp_id", $emp_id);
			$this->db->like("shift_log_date", $grid_firstdate);
			$this->db->having("ot_hour >", 0 );
			$query = $this->db->get("pr_emp_shift_log");*/
			
			$query = $this->db->query("SELECT SUM(`ot_hour`) AS ot_hour FROM `pr_emp_shift_log` WHERE `emp_id` = '$emp_id' AND `shift_log_date` LIKE '%$search_year_month%' having SUM(`ot_hour`)>0");
			
			//This is for extra OT hour add to the Monthly OT Register
			/*$query2 = $this->db->query("SELECT SUM(`extra_ot_hour`) AS extra_ot_hour FROM `pr_emp_shift_log` WHERE `emp_id` = '$emp_id' AND `shift_log_date` LIKE '%$search_year_month%' having SUM(`extra_ot_hour`)>0");
			if($query2->num_rows() > 0)
			{
				$row = $query2->row();
				$total_extra_ot_hour = $row->extra_ot_hour;
			}*/
			//echo $this->db->last_query();
			if($query->num_rows() > 0)
			{
				$row = $query->row();
				$total_ot_hour = $row->ot_hour;// + $total_extra_ot_hour; //This is for extra OT hour add to the Monthly OT Register
				$total_ot_amount = round($total_ot_hour * $ot_rate);
									
				$data["emp_id"][] 		= $emp_id;
				$data["proxi_id"][] 	= $rows->proxi_id;
				$data["emp_name"][] 	= $rows->emp_full_name;
				$data["doj"][] 			= $rows->emp_join_date;
				$data["dept_name"][] 	= $rows->dept_name;
				$data["sec_name"][] 	= $rows->sec_name;
				$data["desig_name"][] 	= $rows->desig_name;
				$data["line_name"][]	= $rows->line_name;
				$data["gross_sal"][] 	= $rows->gross_sal;
				$data["ot_rate"][]		= $ot_rate;
				$data["emp_shift"][] 	= $rows->shift_name;
				$data["total_ot_hour"][]= $total_ot_hour;
				$data["total_ot_amount"][]	= $total_ot_amount;
			}
		}
		
		if($data)
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	
	function grid_monthly_eot_register($grid_firstdate, $grid_emp_id)
	{
		$data = array();
		$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name,  pr_designation.desig_name, pr_emp_com_info.emp_join_date, pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_id_proxi.proxi_id, pr_emp_shift.shift_name,pr_emp_com_info.emp_cat_id, pr_emp_com_info.gross_sal');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_id_proxi');
		$this->db->from('pr_emp_shift');
		$this->db->where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
		$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
		$this->db->order_by("pr_emp_com_info.emp_id","ASC");
		$query = $this->db->get();
		
		$search_date = substr($grid_firstdate,0,7);
				
		foreach($query->result() as $rows)
		{
			$emp_id = $rows->emp_id;
			$gross_sal = $rows->gross_sal;
				
			$basic_sal_payable = ($gross_sal * 60 / 100);
			$basic_sal = round($basic_sal_payable);
			$ot_rate = $basic_sal * 2 / 208 ;
			$ot_rate = round($ot_rate,2);
			
			$query = $this->db->query("SELECT SUM(`extra_ot_hour`) AS extra_ot_hour FROM `pr_emp_shift_log` WHERE `emp_id` = '$emp_id' AND `shift_log_date` LIKE '%$search_date%' having SUM(`extra_ot_hour`)>0");
			//echo $this->db->last_query();
			if($query->num_rows() > 0)
			{
				$row = $query->row();
				$total_ot_hour = $row->extra_ot_hour;
				$total_ot_amount = round($total_ot_hour * $ot_rate);
													
				$data["emp_id"][] 		= $emp_id;
				$data["proxi_id"][] 	= $rows->proxi_id;
				$data["emp_name"][] 	= $rows->emp_full_name;
				$data["doj"][] 			= $rows->emp_join_date;
				$data["dept_name"][] 	= $rows->dept_name;
				$data["sec_name"][] 	= $rows->sec_name;
				$data["desig_name"][] 	= $rows->desig_name;
				$data["line_name"][]	= $rows->line_name;
				$data["gross_sal"][] 	= $rows->gross_sal;
				$data["ot_rate"][]		= $ot_rate;
				$data["emp_shift"][] 	= $rows->shift_name;
				$data["total_ot_hour"][]= $total_ot_hour;
				$data["total_ot_amount"][]	= $total_ot_amount;
			}
		}
		
		if($data)
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	
	function grid_monthly_allowance_register($grid_firstdate, $grid_emp_id)
	{
		$data = array();
		$search_date = substr($grid_firstdate,0,7);
		
		//echo $search_date;
		foreach($grid_emp_id as $emp_id)
		{
		//echo $emp_id;
		$first_tiffin_allo_amount = 0;
		$second_tiffin_allo_amount = 0;
		$night_allo_amount = 0;
		$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name,  pr_emp_com_info.ot_entitle, pr_designation.desig_name, pr_emp_com_info.emp_join_date, pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_id_proxi.proxi_id, pr_emp_shift.shift_name, pr_emp_com_info.emp_cat_id, pr_emp_com_info.gross_sal, pr_emp_shift_log.shift_log_date');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_id_proxi');
		$this->db->from('pr_emp_shift');
		$this->db->from('pr_emp_shift_log');
		$this->db->where("pr_emp_com_info.emp_id", $emp_id);
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
		$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
		$this->db->where("pr_emp_shift_log.emp_id", $emp_id);
		$this->db->like("pr_emp_shift_log.shift_log_date",$search_date); 
		$this->db->order_by("pr_emp_com_info.emp_id","ASC");
		$this->db->group_by("pr_emp_shift_log.shift_log_date");
		$query = $this->db->get();
		//echo $query->num_rows();
			if($query->num_rows() != 0)
			{
				foreach ($query->result() as $rows)	
				{
					$att_date = $rows->shift_log_date;
					
					//echo $att_date."-**-";
					$emp_id = $rows->emp_id;
					$ot_entitle = $rows->ot_entitle;
					$allowance_data = $this->get_allowance_data($emp_id,$ot_entitle,$att_date);
					//print_r($allowance_data);
					$first_tiffin_allo_amount = $allowance_data["first_tiffin_allo_amount"] + $first_tiffin_allo_amount;
					$second_tiffin_allo_amount = $allowance_data["second_tiffin_allo_amount"] + $second_tiffin_allo_amount;
					$night_allo_amount = $allowance_data["night_allo_amount"] + $night_allo_amount;
				}
				//echo $emp_id."------".$first_tiffin_allo_amount." -**-";
				
				$data["emp_id"][] 					= $emp_id;
				$data["proxi_id"][] 				= $rows->proxi_id;
				$data["emp_name"][] 				= $rows->emp_full_name;
				$data["doj"][] 						= $rows->emp_join_date;
				$data["dept_name"][] 				= $rows->dept_name;
				$data["sec_name"][] 				= $rows->sec_name;
				$data["desig_name"][] 				= $rows->desig_name;
				$data["line_name"][]				= $rows->line_name;
				$data["emp_shift"][] 				= $rows->shift_name;
				$data["first_tiffin_allo_amount"][] = $first_tiffin_allo_amount;
				$data["second_tiffin_allo_amount"][] = $second_tiffin_allo_amount;
				$data["night_allo_amount"][] = $night_allo_amount;
			}
		}
		
		//print_r($data);
		if($data)
		{
			
			return $data;
		}
		else
		{
			return "Requested list is empty";
		}
	}
	
	
	
	function grid_time_search_report()
	{
		$f_date = '2012-04-01';
		$s_date = '2012-04-10';
		$f_time = '07:00:00';
		$s_time = '22:30:00';
		$grid_emp_id = array('001414','001635','001744','001750','001773','002070','002090','002110','002113','002178');
		$data = array();
		$this->db->select();
		$this->db->where_in("emp_id", $grid_emp_id);
		$this->db->where("shift_log_date BETWEEN '$f_date' AND '$s_date'");
		$this->db->where("in_time BETWEEN '$f_time' AND '$s_time'");
		$query = $this->db->get('pr_emp_shift_log');
		foreach($query->result() as $rows)
		{
			$data['emp_id'][] =  $rows->emp_id;
			$data['time'][]   =  $rows->in_time;
		}
		
		$this->db->select();
		$this->db->where_in("emp_id", $grid_emp_id);
		$this->db->where("shift_log_date BETWEEN '$f_date' AND '$s_date'");
		$this->db->where("out_time BETWEEN '$f_time' AND '$s_time'");
		$query = $this->db->get('pr_emp_shift_log');
		foreach($query->result() as $rows)
		{
			$data['emp_id'][] = $rows->emp_id;
			$data['time'][]   = $rows->out_time;
		}
		
		print_r($data);
	}
		
	function GetDays($sStartDate, $sEndDate)
	{  
       	$sStartDate = date("Y-m-d", strtotime($sStartDate)); 
		$sEndDate = date("Y-m-d", strtotime($sEndDate)); 
		  
        // Start the variable off with the start date  
    	$aDays[] = $sStartDate;  
    
    	// Set a 'temp' variable, sCurrentDate, with  
    	// the start date - before beginning the loop  
    	$sCurrentDate = $sStartDate;  
    
		// While the current date is less than the end date  
    	while($sCurrentDate < $sEndDate)
		{  
       		// Add a day to the current date  
       		$sCurrentDate = date("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));  
     
       		// Add this new day to the aDays array  
        		$aDays[] = $sCurrentDate; 
			//print_r($aDays);
     	}  
     // Once the loop has finished, return the  
     return $aDays;  
   }
   
   //Daily OT hour calculation for Mothly Attendace Register
   function get_daily_total_ot_hour($emp_id, $ot_date)
   {
   		$this->db->select('ot_hour,extra_ot_hour');
		$this->db->where('emp_id', $emp_id);
		$this->db->where('shift_log_date', $ot_date);
		//$this->db->where('ot_hour !=', 0);
		$query = $this->db->get('pr_emp_shift_log');
		//echo $this->db->last_query();
		foreach($query->result() as $row)
		{
			$ot_hour = $row->ot_hour;
			$extra_ot_hour = $row->extra_ot_hour;
			return $total = $ot_hour; 
		}
		// + $extra_ot_hour; This will add if you want to add extra OT to Monthly Attendance Register.
		
   }
   
   function get_daily_total_eot_hour($emp_id, $ot_date)
   {
   		$this->db->select('ot_hour,extra_ot_hour');
		$this->db->where('emp_id', $emp_id);
		$this->db->where('shift_log_date', $ot_date);
		//$this->db->where('ot_hour !=', 0);
		$query = $this->db->get('pr_emp_shift_log');
		//echo $this->db->last_query();
		foreach($query->result() as $row)
		{
			$ot_hour = $row->ot_hour;
			$extra_ot_hour = $row->extra_ot_hour;
			return $total = $extra_ot_hour; 
		}
		// + $extra_ot_hour; This will add if you want to add extra OT to Monthly Attendance Register.
		
   }
   function get_leave_type($shift_log_date,$emp_id)
   {
   		$this->db->select('leave_type');
		$this->db->where('emp_id', $emp_id);
		$this->db->where('start_date', $shift_log_date);
		$query = $this->db->get('pr_leave_trans');
		$row = $query->row();
		$leave_type = $row->leave_type;
		return $leave_type;
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
	
   
   function get_allowance_data($emp_id,$ot_entitle,$att_date)
	{
			$data = array();
			if($ot_entitle == 1) //ot = 'No' for staff
			{
				$id = 1;
			}
			else
			{
				$id = 2;
			}
			
			$allowance_bills 				= $this->common_model->allowance_bills($id);
			$first_tiffin_allo_min 			= $allowance_bills['first_tiffin_allo_min'];
			$second_tiffin_allo_min 		= $allowance_bills['second_tiffin_allo_min'];
			$night_allo_min 				= $allowance_bills['night_allo_min'];
			$first_tiffin_allo_amount 		= $allowance_bills['first_tiffin_allo_amount'];
			$second_tiffin_allo_amount 		= $allowance_bills['second_tiffin_allo_amount'];
			$night_allo_amount 				= $allowance_bills['night_allo_amount'];
			
			$this->db->select('*');
			$this->db->where("shift_log_date",$att_date);
			$this->db->where("emp_id",$emp_id);
			$query1 = $this->db->get('pr_emp_shift_log');
			
			//echo $query1->num_rows();
			
			foreach ($query1->result() as $row)
			{
				$shift_id = $row->shift_id;
				$out_time = $row->out_time;
				//$out_time = "21:01:26";
				//echo "--------".$out_time;
				$shift_out_time = $this->get_shift_out_time($shift_id);
			}
			
		
			
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
				
				
				if(strtotime($date_shift_out_time) < strtotime($date_out_time))
				{
					$date1 = new DateTime($date_out_time);
					$date2 = new DateTime($date_shift_out_time);
					$interval = $date1->diff($date2);
					$hour =  $interval->h;
					$min =  $interval->i;
					//$ss =  $interval->s;
					$total_min = ($hour * 60) + $min;
					//$total_min = 0;
					if($night_allo_min <= $total_min)
					{
						echo "";
						//$tiffin_allo_amount =$tiffin_allo_amount*2;
					}
					else if($second_tiffin_allo_min <= $total_min)
					{
						//echo "2nd";
						$night_allo_amount = 0;
					}
					else if($first_tiffin_allo_min <= $total_min)
					{
						//echo "1st";
						$second_tiffin_allo_amount = 0;
						$night_allo_amount = 0;
					}
					else
					{
						$first_tiffin_allo_amount = 0;
						$second_tiffin_allo_amount = 0;
						$night_allo_amount = 0;
					}
					//echo $total_min."***".$ot_entitle."///////";
				}
				else
				{
					$first_tiffin_allo_amount = 0;
					$second_tiffin_allo_amount = 0;
					$night_allo_amount = 0;
				}
					//echo $emp_id."-----".$date_out_time."------".$date_shift_out_time."-----".$night_allo_amount."****";
			}
			else
			{
				$first_tiffin_allo_amount = 0;
				$second_tiffin_allo_amount = 0;
				$night_allo_amount = 0;
			}
			//echo $tiffin_allo_amount;
			$data['att_date'] = $att_date;
			$data['out_time'] = $out_time;
			$data['first_tiffin_allo_min'] = $first_tiffin_allo_min;
			$data['second_tiffin_allo_min'] = $second_tiffin_allo_min;
			$data['night_allo_min'] = $night_allo_min;
			$data['first_tiffin_allo_amount'] = $first_tiffin_allo_amount;
			$data['second_tiffin_allo_amount'] = $second_tiffin_allo_amount;
			$data['night_allo_amount'] = $night_allo_amount;
			return $data;
	}
	function get_dept_name($dept_id)
	{
		$this->db->select("dept_name");
		$this->db->where("dept_id", $dept_id);
		$query = $this->db->get('pr_dept');
		foreach($query->result() as $rows)
		{
			$dept_name =  $rows->dept_name;
		}
		return $dept_name;
	}
	
	function get_section_name($section_id)
	{
		$this->db->select("sec_name");
		$this->db->where("sec_id", $section_id);
		$query = $this->db->get('pr_section');
		foreach($query->result() as $rows)
		{
			$sec_name =  $rows->sec_name;
		}
		return $sec_name;
	}
	
	function get_line_name($line_id)
	{
		$this->db->select("line_name");
		$this->db->where("line_id", $line_id);
		$query = $this->db->get('pr_line_num');
		foreach($query->result() as $rows)
		{
			$line_name =  $rows->line_name;
		}
		return $line_name;
	}
	
	function get_desig_name($desig_id)
	{
		$this->db->select("desig_name");
		$this->db->where("desig_id", $desig_id);
		$query = $this->db->get('pr_designation');
		foreach($query->result() as $rows)
		{
			$desig_name =  $rows->desig_name;
		}
		return $desig_name;
	}
	//Zuel
	function grid_earn_leave_report_old($grid_emp_id){
		$data = array();
		$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name,pr_designation.desig_name,pr_emp_com_info.emp_join_date, pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_id_proxi.proxi_id, pr_emp_shift.shift_name,pr_emp_com_info.emp_cat_id, pr_emp_com_info.gross_sal,pr_leave_earn.old_earn_balance,pr_leave_earn.current_earn_balance,pr_leave_earn.last_update');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_id_proxi');
		$this->db->from('pr_emp_shift');
		$this->db->from('pr_leave_earn');
		$this->db->where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		//$this->db->where_in("pr_leave_earn.emp_id", $grid_emp_id);
		$this->db->where('pr_emp_com_info.emp_id = pr_leave_earn.emp_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
		$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
		$this->db->order_by("pr_emp_com_info.emp_id","ASC");
		$query = $this->db->get();
		
		foreach($query->result() as $rows){
			$emp_id = $rows->emp_id;
			$gross_sal = $rows->gross_sal;
			$data["emp_id"][] 		= $emp_id;
			$data["proxi_id"][] 	= $rows->proxi_id;
			$data["emp_name"][] 	= $rows->emp_full_name;
			$data["doj"][] 			= $rows->emp_join_date;
			$data["dept_name"][] 	= $rows->dept_name;
			$data["sec_name"][] 	= $rows->sec_name;
			$data["desig_name"][] 	= $rows->desig_name;
			$data["line_name"][]	= $rows->line_name;
			$data["gross_sal"][] 	= $rows->gross_sal;
			$data["emp_shift"][] 	= $rows->shift_name;
			$data["old_earn_balance"][]		= $rows->old_earn_balance;
			$data["current_earn_balance"][] = $rows->current_earn_balance;
			$data["last_update"][] 			= $rows->last_update;
			
			/*$this->db->select("*");
			$this->db->where("emp_id", $emp_id);
			$query1 = $this->db->get('pr_leave_earn');
			foreach($query1->result() as $rows)
			{
				
				$data["old_earn_balance"][]		= $rows->old_earn_balance;
				$data["current_earn_balance"][] = $rows->current_earn_balance;
				$data["last_update"][] 			= $rows->last_update;
			}*/
			
			$prev_month_info = $this->get_prev_month_info($emp_id);
			$prev_month_info_rows = $prev_month_info->num_rows();
			if($prev_month_info_rows !=0)
			{
				foreach($prev_month_info->result() as $rows){
					$data["total_days"][]= $rows->total_days;
					$data["pay_wages"][] = $rows->pay_wages;
					$data["pay_days"][] = $rows->pay_days;
				}
			}else{
				$data["total_days"][]= 0;
				$data["pay_wages"][] = 0;
				$data["pay_days"][] = 0;
			}
		}
		$current_year = date("Y");
		$start_date = "$current_year-01-01";
		$end_date = date("Y-m-d");
		
		// caculate number of days between dates
		$days = $this->get_days($start_date, $end_date);
		
		// calculate number of weekends
		$weekend = $this->common_model->get_setup_attributes(5);
		//echo $weekend;
		//$weekend = "Fri";
		$weekend_days = $this->get_weekend_days($weekend,$days,$start_date);
		
		// calculate number of holyday between dates
		$holy_day = $this->get_holyday($start_date,$end_date);
		$actual_working_days = $days - $weekend_days - $holy_day;
		
		$data["actual_working_days"] = $actual_working_days;
		
		
		//print_r($data);
		if($data){
			return $data;
		}else{
			return "Requested list is empty";
		}
	}
	
	function grid_pf_statement($year, $month, $grid_emp_id)
	{
		$data = array();
		$this->db->select('pr_emp_com_info.emp_id,pr_emp_per_info.emp_full_name,pr_designation.desig_name,pr_emp_com_info.emp_join_date, pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_id_proxi.proxi_id, pr_emp_shift.shift_name,pr_emp_com_info.emp_cat_id, pr_emp_com_info.gross_sal');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_id_proxi');
		$this->db->from('pr_emp_shift');
		$this->db->where_in("pr_emp_com_info.emp_id", $grid_emp_id);
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_com_info.emp_id = pr_id_proxi.emp_id');
		$this->db->where('pr_emp_shift.shift_id = pr_emp_com_info.emp_shift');
		$this->db->order_by("pr_emp_com_info.emp_id","ASC");
		$query = $this->db->get();
		//echo $this->db->last_query();
		foreach($query->result() as $rows)
		{
			$emp_id = $rows->emp_id;
			$gross_sal = $rows->gross_sal;
			$data["emp_id"][] 		= $emp_id;
			$data["proxi_id"][] 	= $rows->proxi_id;
			$data["emp_full_name"][]= $rows->emp_full_name;
			$data["emp_join_date"][]= $rows->emp_join_date;
			$data["dept_name"][] 	= $rows->dept_name;
			$data["sec_name"][] 	= $rows->sec_name;
			$data["desig_name"][] 	= $rows->desig_name;
			$data["line_name"][]	= $rows->line_name;
			$data["gross_sal"][] 	= $rows->gross_sal;
		}
		return $data;
	}
	
	function get_days($from, $to)
	{
		$first_date = strtotime($from);
    	$second_date = strtotime($to);
   		$offset = $second_date-$first_date; 
    	return floor($offset/60/60/24);
	}
	
	function get_weekend_days($weekend,$days,$start_date)
	{
		$no_weekends = 0;
		for($i=0;$i<$days + 1;$i++)
		{
			$date =  strtotime(date("Y-m-d", strtotime($start_date)) . " +$i day");
			
			$new_date = date("D",$date);
			
			if($new_date == $weekend)
			{
				$no_weekends = $no_weekends +1;
			}			
		}
		return $no_weekends;
	}
	
	function get_holyday($from, $to)
	{
		$where="start_date  BETWEEN '$from' and '$to'" ;
		$this->db->select('*');
		$this->db->where($where);
		$query=$this->db->get('pr_holiday');
		
		$num_holyday = $query->num_rows();
		return $num_holyday;
		
	}
	
	function get_prev_month_info($emp_id)
	{
		$prev_month = date("Y-m", strtotime("-1 months"));
		$this->db->select("total_days,pay_wages,pay_days");
		$this->db->where('emp_id',$emp_id);
		$this->db->like('salary_month',$prev_month);
		$query=$this->db->get('pr_pay_scale_sheet');
		return $query;
	}
	function eot_summary_report($salary_month,$emp_stat)
	{	
		$all_data = array();
		
		$salary_month = $salary_month;
		
		$this->db->select("sec_id,sec_name");
		//$this->db->where('sec_id',5);
		$this->db->order_by("sec_name");
		$query = $this->db->get("pr_section");

		foreach($query->result() as $rows)
		{
			//echo "<tr>";
			//$emp_stat = array('2','3','4','6');
			$data = array();
			$data1 = array();
						
			//echo "<td>";
			//echo $rows->dept_name;
			//echo "</td>";
			$all_data["dept"][] = $rows->sec_name;
			$dept_id = $rows->sec_id;
			
			// For Cash Man Power
			$salary_draw_cash = 1;
			$emp_cash = $this->count_empid_for_salary($dept_id,$emp_stat,$salary_month,$salary_draw_cash,"count");
			$all_data["emp_cash"][] = $emp_cash;
			
			// For Bank Man Power
			$salary_draw_bank = 2;
			$emp_bank = $this->count_empid_for_salary($dept_id,$emp_stat,$salary_month,$salary_draw_bank,"count");
			$all_data["emp_bank"][] = $emp_bank;
			
			$all_data["emp_cash_bank"][] =$emp_cash + $emp_bank;
			
			// For Cash Emp ID
			$i = 1;
			$cash_emp_id = $this->count_empid_for_salary($dept_id,$emp_stat,$salary_month,$salary_draw_cash,"emp_id");
			foreach($cash_emp_id as $rows)
			{
				$data[] = $rows->emp_id;
				//echo "$i.==".$rows->emp_id."<br>";
				//$i = $i + 1;
			}
			$data = implode("xxx",$data);
			$emp_id_cash = explode('xxx', trim($data));
			
			// For Bank Emp ID
			
			$bank_emp_id = $this->count_empid_for_salary($dept_id,$emp_stat,$salary_month,$salary_draw_bank,"emp_id");
			foreach($bank_emp_id as $rows)
			{
				$data1[] = $rows->emp_id;
				
			}
			$data1 = implode("xxx",$data1);
			$emp_id_bank = explode('xxx', trim($data1));

			//For Cash EOT HOUR
			$column_name = "eot_hour" ;
			$cash_eot_hour = $this->get_sum_column($column_name,$emp_id_cash,$salary_month);
			//$cash_total = $eot_hour;
			$all_data["eot_cash_sum"][] = $cash_eot_hour;
		
			//For Bank EOT HOUR
			$bank_eot_hour = $this->get_sum_column($column_name,$emp_id_bank,$salary_month);
			//$bank_total = $eot_hour;
			$all_data["eot_bank_sum"][] = $bank_eot_hour;
			
			$all_data["eot_cash_bank_hour"][] = $cash_eot_hour + $bank_eot_hour;
			//For Cash EOT AMOUNT
			$column_name = "eot_amount" ;
			$cash_eot_amount = $this->get_sum_column($column_name,$emp_id_cash,$salary_month);
			//$cash_total = $eot_hour;
			$all_data["eot_amount_cash_sum"][] = $cash_eot_amount;
		
			//For Bank EOT AMOUNT
			$bank_eot_amount = $this->get_sum_column($column_name,$emp_id_bank,$salary_month);
			//$bank_total = $eot_hour;
			$all_data["eot_amount_bank_sum"][] = $bank_eot_amount;
			
			$all_data["eot_cash_bank_amount"][] = $cash_eot_amount + $bank_eot_amount;
		}
		return $all_data;
		
	}
	//========================End Salary Summary=================
	function count_empid_for_salary($sec_id,$status,$salary_month,$salary_draw,$check)
	 {
		
		$salary_month 		= substr($salary_month,0,7);
		$probation_period 	= $this->common_model->get_setup_attributes(8);
		//$prev_prob_month 	= $this->common_model->get_prev_month($probation_period,$salary_month);
		if($status == "ALL")
		{
			$get_left_emp 		= $this->common_model->get_left_emp_all_sts($salary_month);
			$get_resign_emp 	= $this->common_model->get_resign_emp_all_sts($salary_month);
			$get_promote_emp 	= $this->common_model->get_promote_emp_all($salary_month);	
		}
		else
		{
			$get_left_emp = $this->common_model->get_left_emp($salary_month);
			$get_resign_emp = $this->common_model->get_resign_emp($salary_month);
			$get_promote_emp 	= $this->common_model->get_promote_emp_all($salary_month);
		}
		$this->db->select('pr_emp_per_info.*');
		$this->db->where("pr_emp_com_info.emp_sec_id", $sec_id);
		$this->db->where("salary_draw",$salary_draw);
		
		if($status == 1)
		{
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_emp_per_info');
			$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
			$this->db->where("trim(substr(pr_emp_com_info.emp_join_date,1,7)) <= '$salary_month'");
			$this->db->where_not_in('pr_emp_com_info.emp_id',$get_left_emp);
			$this->db->where_not_in('pr_emp_com_info.emp_id',$get_resign_emp);
			$this->db->where_not_in('pr_emp_com_info.emp_id',$get_promote_emp);
			$this->db->order_by("pr_emp_com_info.emp_id");
			//$this->db->where_not_in('pr_emp_com_info.emp_id',$get_promote_emp);
			
		}
		
		if($status == 2)
		{
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_emp_per_info');
			$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
			$this->db->where("trim(substr(pr_emp_com_info.emp_join_date,1,7)) <= '$salary_month'");
			$this->db->where("trim(substr(pr_emp_com_info.emp_join_date,1,7)) >= '$prev_prob_month'");
			$this->db->where_not_in('pr_emp_com_info.emp_id',$get_left_emp);
			$this->db->where_not_in('pr_emp_com_info.emp_id',$get_resign_emp);
			$this->db->where_not_in('pr_emp_com_info.emp_id',$get_promote_emp);
		}
		
		if($status == 3)
		{
			$this->db->from('pr_emp_left_history');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_emp_per_info');
			$this->db->where('pr_emp_com_info.emp_id = pr_emp_per_info.emp_id');
			$this->db->where('pr_emp_per_info.emp_id = pr_emp_left_history.emp_id');
			$this->db->where("trim(substr(pr_emp_left_history.left_date,1,7)) = '$salary_month'");
			
		}
		
		if($status == 4)
		{
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_emp_resign_history');
			$this->db->where('pr_emp_com_info.emp_id = pr_emp_per_info.emp_id');
			$this->db->where('pr_emp_per_info.emp_id = pr_emp_resign_history.emp_id');
			$this->db->where("trim(substr(pr_emp_resign_history.resign_date,1,7)) = '$salary_month'");
		}
		
		if($status == "ALL")
		{
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_emp_per_info');
			$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
			$this->db->where("trim(substr(pr_emp_com_info.emp_join_date,1,7)) <= '$salary_month'");
			$this->db->where_not_in('pr_emp_com_info.emp_id',$get_left_emp);
			$this->db->where_not_in('pr_emp_com_info.emp_id',$get_resign_emp);
			$this->db->where_not_in('pr_emp_com_info.emp_id',$get_promote_emp);
		}
		
		
		$query = $this->db->get();
		//return $query;
		if($check == "count")
		{
			return $query->num_rows();
		}
		//echo $this->db->last_query()."====";
		return $query->result();
	}
	/*ZuelAli, 211109*/
	function grid_half_ot_sheet($sal_year_month, $grid_status, $grid_emp_id){		
		$firstday = date("Y-m-01", strtotime($sal_year_month));
		$lastday = date("Y-m-t", strtotime($sal_year_month));

		$this->db->select('pr_emp_per_info.emp_full_name,pr_designation.desig_name, pr_section.sec_name, pr_emp_com_info.emp_join_date,pr_grade.gr_name,pr_pay_scale_sheet.*');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_grade');
		$this->db->from('pr_pay_scale_sheet');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_designation');
		$this->db->where_in('pr_emp_com_info.emp_id', $grid_emp_id);
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_sal_gra_id = pr_grade.gr_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_pay_scale_sheet.emp_id');
		$this->db->where("pr_pay_scale_sheet.salary_month = '$sal_year_month'");
		$this->db->where('pr_emp_com_info.emp_join_date <= ', $lastday);

		$this->db->order_by("pr_emp_com_info.emp_id");
		// $this->db->limit(10);
		$this->db->group_by("pr_pay_scale_sheet.emp_id");
		$query = $this->db->get()->result();
		foreach ($query as $key => $value) {
			$emp_id = $value->emp_id;
			$h_ot = $h_ot1 = $h_ot2 = 0;
			if($firstday == '2021-04-01'){
				$sday = '2021-04-14';
				$tday = '2021-04-15';
				$lastday == date('Y-m-t',strtotime($firstday));
				$h_ot1 = $this->db->select("COUNT(emp_id)*.5 as hot")
						->where('emp_id' , $emp_id)
						->where("shift_log_date BETWEEN '$firstday' and '$sday'")
						->where("minute(out_time) BETWEEN '20' AND '49'")
						->get('pr_emp_shift_log')->row()->hot;
				$h_ot2 = $this->db->select("COUNT(emp_id)*.5 as hot")
						->where('emp_id' , $emp_id)
						->where("shift_log_date BETWEEN '$tday' and '$lastday'")
						->where("minute(out_time) BETWEEN '50' AND '19'")
						// ->or_where("minute(out_time) BETWEEN '00' AND '19'")
						->get('pr_emp_shift_log')->row()->hot;
				$h_ot = $h_ot1 + $h_ot2;
			}else if($firstday == '2021-05-01'){
				$sday = '2021-05-11';
				$tday = '2021-05-12';
				$lastday == date('Y-m-t',strtotime($firstday));
				$h_ot1 = $this->db->select("COUNT(emp_id)*.5 as hot")
						->where('emp_id' , $emp_id)
						->where("shift_log_date BETWEEN '$firstday' and '$sday'")
						->where("minute(out_time) BETWEEN '50' AND '19'")
						// ->or_where("minute(out_time) BETWEEN '00' AND '19'")
						->get('pr_emp_shift_log')->row()->hot;
				$h_ot2 = $this->db->select("COUNT(emp_id)*.5 as hot")
						->where('emp_id' , $emp_id)
						->where("shift_log_date BETWEEN '$tday' and '$lastday'")
						->where("minute(out_time) BETWEEN '20' AND '49'")
						->get('pr_emp_shift_log')->row()->hot;
				$h_ot = $h_ot1 + $h_ot2;
			}else{
				$h_ot = $this->db->select("COUNT(emp_id)*.5 as hot")
						->where('emp_id' , $emp_id)
						->where("shift_log_date BETWEEN '$firstday' and '$lastday'")
						->where("minute(out_time) BETWEEN '20' AND '49'")
						->get('pr_emp_shift_log')->row()->hot;
			}


			if($h_ot > 0){
				$query[$key]->h_ot = $h_ot;
			}else{
				unset($query[$key]);
			}
		}
		$data = array();
		if($query){
			$i = 0;
			foreach ($query as $key => $value) {
				$data[$i]=$value;
				$i++;
			}
		}
		// echo "<pre>";
		// print_r($data);exit();
		// 	exit($h_ot);
		return $data;
	}

	function grid_absent_basic_amt($sal_year_month,$grid_emp_id){
		$yM = date("Y-m", strtotime($sal_year_month));
		$firstday = date("Y-m-01", strtotime($sal_year_month));
		$lastday = date("Y-m-t", strtotime($sal_year_month));

		$emps = $this->db->select('emp_id,emp_join_date')
			->like('emp_join_date',"$yM",'after')
			->where_in('emp_id',$grid_emp_id)
			->get('pr_emp_com_info')->result_array();
		$empsL = $this->db->select('emp_id,left_date')
			->like('left_date',"$yM",'after')
			->where_in('emp_id',$grid_emp_id)
			->get('pr_emp_left_history')->result_array();
		$empsR = $this->db->select('emp_id,resign_date')
			->like('resign_date',"$yM",'after')
			->where_in('emp_id',$grid_emp_id)
			->get('pr_emp_resign_history')->result_array();
		$allData = array_merge_recursive($emps, $empsL, $empsR);
		$allEmps = array();
		foreach ($allData as $key => $value) {
			$allEmps[] = $value['emp_id'];
		}
		
		if(empty($allEmps)){return NULL;}

		$this->db->select('pr_emp_per_info.emp_full_name,pr_designation.desig_name, pr_section.sec_name, pr_emp_com_info.emp_join_date,pr_grade.gr_name,pr_pay_scale_sheet.*');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_grade');
		$this->db->from('pr_pay_scale_sheet');
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_designation');
		$this->db->where_in('pr_emp_com_info.emp_id', $allEmps);
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_sal_gra_id = pr_grade.gr_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_pay_scale_sheet.emp_id');
		$this->db->where("pr_pay_scale_sheet.salary_month = '$sal_year_month'");
		$this->db->where('pr_emp_com_info.emp_join_date <= ', $lastday);
		$this->db->order_by("pr_emp_com_info.emp_id");
		// $this->db->limit(20);
		$this->db->group_by("pr_pay_scale_sheet.emp_id");
		$query = $this->db->get()->result();
		foreach ($query as $key => $value) {
			if($value->absent_days == 0){
				unset($query[$key]);
			}
		}
		$data = array();
		if($query){
			$i = 0;
			foreach ($query as $key => $value) {
				$data[$i]=$value;
				$i++;
			}
		}
		// echo "<pre>";
		// print_r($data);exit();
		// 	exit($h_ot);
		return $data;
	}

	// // new customization of 2022-07-27
	function bank_salary_report($sal_year_month, $grid_status, $grid_emp_id)
	{

	    $last_day = date("t", strtotime($sal_year_month));	
		$lastday = date("Y-m-$last_day", strtotime($sal_year_month));
		
		$this->db->select('
				pr_emp_per_info.emp_full_name,
				pr_emp_per_info.bank_acc as mobile,
				pr_designation.desig_name, 
				pr_line_num.line_name, 
				pr_emp_com_info.emp_join_date,
				pr_pay_scale_sheet.*'
			);
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_pay_scale_sheet');
		$this->db->from('pr_line_num');
		$this->db->from('pr_designation');
		if($grid_status == 4){
			$this->db->from('pr_emp_resign_history');
		}
		$this->db->where_in('pr_emp_com_info.emp_id', $grid_emp_id);
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_pay_scale_sheet.emp_id');
		$this->db->where("pr_pay_scale_sheet.salary_month = '$sal_year_month'");
		if($grid_status == 4){
			$salary_month = substr($sal_year_month,0,7);
			$this->db->where('pr_emp_com_info.emp_id = pr_emp_resign_history.emp_id');
			$this->db->where("trim(substr(pr_emp_resign_history.resign_date,1,7)) LIKE '$salary_month'");
		}
		$this->db->where('pr_emp_com_info.emp_join_date <= ', $lastday);
		

		$this->db->order_by("pr_emp_com_info.emp_id");
		$this->db->group_by("pr_pay_scale_sheet.emp_id");
		$query = $this->db->get();	
		//echo $this->db->last_query();			

		return $query->result();
	}

	function bank_eot_sheet($sal_year_month, $grid_status, $grid_emp_id)
	{
		$last_day = date("t", strtotime($sal_year_month));	
		$lastday = date("Y-m-$last_day", strtotime($sal_year_month));		
		
		$this->db->select('
				pr_emp_per_info.emp_full_name,
				pr_emp_per_info.bank_acc as mobile,
				pr_designation.desig_name, 
				pr_line_num.line_name, 
				pr_emp_com_info.emp_join_date,
				pr_pay_scale_sheet.*
			');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_pay_scale_sheet');
		$this->db->from('pr_line_num');
		$this->db->from('pr_designation');
		if($grid_status == 4){
			$this->db->from('pr_emp_resign_history');
		}
		$this->db->where_in('pr_emp_com_info.emp_id', $grid_emp_id);
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_pay_scale_sheet.emp_id');
		$this->db->where("pr_pay_scale_sheet.salary_month = '$sal_year_month'");
		if($grid_status == 4){
			$salary_month = substr($sal_year_month,0,7);
			$this->db->where('pr_emp_com_info.emp_id = pr_emp_resign_history.emp_id');
			$this->db->where("trim(substr(pr_emp_resign_history.resign_date,1,7)) LIKE '$salary_month'");
		}
		$this->db->where('pr_emp_com_info.emp_join_date <= ', $lastday);
		$this->db->order_by("pr_emp_com_info.emp_id");
		$this->db->group_by("pr_pay_scale_sheet.emp_id");
		$query = $this->db->get();	
		//echo $this->db->last_query();	
		return $query->result();
	}


	function leave_register($first_date, $second_date, $grid_emp_id){
		$this->db->select('
			pr_emp_com_info.emp_id,
			pr_emp_per_info.emp_full_name,
			pr_emp_per_info.bangla_nam,
			pr_dept.dept_name,
			pr_dept.dept_bangla,
			pr_section.sec_name,
			pr_line_num.line_name,
			pr_designation.desig_name,
			pr_designation.desig_bangla,
			pr_emp_com_info.emp_join_date
		');
		$this->db->from('pr_emp_per_info');
		$this->db->join('pr_emp_com_info', 'pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->join('pr_dept', 'pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->join('pr_section', 'pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->join('pr_line_num', 'pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->join('pr_designation', 'pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where_in('pr_emp_com_info.emp_id', $grid_emp_id);
		$this->db->order_by("pr_emp_com_info.emp_id");
		$query = $this->db->get()->row();
		$data['emp_info']= $query;
		$emp_id = $query->emp_id;
		$data["leave_balance"]  = $this->db->select('lv_sl,lv_cl')->get('pr_leave')->row();
		
		$this->db->select("present_status,shift_log_date")->where('emp_id',$emp_id);
			if( $first_date == '' && $second_date == ''){
				$this->db->where('shift_log_date >',$query->emp_join_date);
			}else if( !$first_date == '' && $second_date == ''){
				$this->db->where('shift_log_date >',date('Y-01-01',strtotime($first_date)));
				$this->db->where('shift_log_date <',date('Y-12-31',strtotime($first_date)));
			}else{
				$this->db->where('shift_log_date >',date('Y-01-01',strtotime($first_date)));
				$this->db->where('shift_log_date <',date('Y-m-d',strtotime($second_date)));
			}
			$office_days = $this->db->get('pr_emp_shift_log')->result();
			// echo "<pre>";print_r($office_days);exit;
			$yearlyStatus = array();
			foreach ($office_days as $entry) {
			$year = date('Y', strtotime($entry->shift_log_date));
			$status = $entry->present_status;
			if (!isset($yearlyStatus[$year])) {
				$yearlyStatus[$year] = array(
					'P' => 0,
					'A' => 0,
					'W' => 0,
					'H' => 0,
				);
			}
			if (isset($yearlyStatus[$year][$status])) {
				$yearlyStatus[$year][$status]++;
			}
	
		}

		$data['yearly_total_info'] = $yearlyStatus;
		// dd($data);
		if($data){
			return $data;
		}
		else{
			return "Requested list is empty";
		}
	}

}
?>