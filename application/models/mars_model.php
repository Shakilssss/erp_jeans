<?php

class Mars_model extends CI_Model{

	

	

	function __construct(){
		parent::__construct();
		/* Standard Libraries */
	}

	function aliTest($date = ''){
		$date = '2021-06-20';
		$lines = $this->db->get('pr_line_num')->result_array();
		foreach ($lines as $key => $value) {
			$line = $value['line_id'];
			$this->db->select("count('pr_emp_shift_log.emp_id') as totalemp, SUM(pr_emp_shift_log.ot_hour) as ot_hour,sum(pr_emp_shift_log.extra_ot_hour) as extra_ot_hour");
			$this->db->from('pr_emp_shift_log');
			$this->db->join('pr_emp_com_info', 'pr_emp_com_info.emp_id = pr_emp_shift_log.emp_id');
			$this->db->where('pr_emp_com_info.emp_line_id',$line);
			$this->db->where('pr_emp_shift_log.shift_log_date',$date);
			$lines[$key]['totalemp']=$this->db->get()->result_array();
		}
		echo "<pre>";
		print_r($lines);exit();
	}
	function designation_ids(){
		$emp_desig = array( 
			0 => array(1,94,95,96,97,116),//operator,gen. operator,jr. operator,input man,Sr. Operator, operator
			1 => array(4,8,9,10,72),//helper
			2 => array(98,115),//ironman
			3 => array(6,117),//Jr.FoldingMan
			4 => array(3), //Jr.Iron*/
			5 => array(5,114), //Jr.Pack*/
			6 => array(82), //Poly Man*/
			7 => array(33,70), //Loader*/
			8 => array(26,35,38,45,102,106), //Supervisor*/
			9 => array(18,19,21,34,37,39,44,57,58,92),//All Staff
			/*8 => array(29), //Drive
			9 => array(26,57,35,44,102,58,38,37,39,45,106,34,18,19,92,21),//All Staff*/
			10 => array(11,14,16,15,113),//Q.C
			11 => array(13)//CLEANER
		);
		return $emp_desig;
	}

	

	function department_attendance_summary($report_date)
	{
		$male = 1;
		$female = 2;
		$query = $this->db->select()->order_by('dept_name')->get('pr_dept');

		$data = array();

		foreach($query->result() as $rows)
		{
			$data['cat_name'][] = $rows->dept_name;

			 $all_emp_id_male = $this->get_department_emp_by_id($rows->dept_id,$male);
			$all_emp_id_female = $this->get_department_emp_by_id($rows->dept_id,$female);

			if(!empty($all_emp_id_male))
			{
				$data['daily_att_sum_male'][] = $this->daily_attendance_summary($report_date, $all_emp_id_male);
			}
			else
			{
				$data['daily_att_sum_male'][] = 0;
			}
			
			if(!empty($all_emp_id_female))
			{
				$data['daily_att_sum_female'][] = $this->daily_attendance_summary($report_date, $all_emp_id_female);
			}
			else
			{
				$data['daily_att_sum_female'][] = 0;
			}
			
			$emp_desig = $this->designation_ids();
			for($i=0; $i<=11; $i++)
			{				
				//print_r($emp_desig);
				$all_desig_emp_id_by_dept_male 		= $this->desig_emp_id_by_dept($rows->dept_id,$emp_desig[$i],$male);
				$all_desig_emp_id_by_dept_female 	= $this->desig_emp_id_by_dept($rows->dept_id,$emp_desig[$i],$female);
				//echo "<br>".$count_all_desig_emp_id_by_dept = count($all_desig_emp_id_by_dept_female);
				//echo  $all_desig_emp_id_by_line."---";
				//print_r($all_desig_emp_id_by_dept_male);
				if(!empty($all_desig_emp_id_by_dept_male))
				{
					//echo "hello1";
					$data['remarks_daily_att_sum_male'][$i][] = $this->daily_attendance_summary($report_date, $all_desig_emp_id_by_dept_male);
				}
				else
				{
					//echo "hello2";
					$data['remarks_daily_att_sum_male'][$i][] = 0;
				}
				
				if(!empty($all_desig_emp_id_by_dept_female))
				{
					$data['remarks_daily_att_sum_female'][$i][] = $this->daily_attendance_summary($report_date, $all_desig_emp_id_by_dept_female);
				}
				else
				{
					$data['remarks_daily_att_sum_female'][$i][] = 0;
				}
				//echo $i;
			}	
			
		}
		//print_r($data);
		return $data;
	}

	function desig_emp_id_by_dept($dept_id,$emp_desig,$marital_status)
	{
		$emp_cat = array(1,2);
		$data = array();
		$this->db->select('pr_emp_com_info.emp_id');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where("pr_emp_com_info.emp_dept_id = '$dept_id'");
		//$this->db->where("pr_emp_com_info.emp_desi_id = '$emp_desig'");
		$this->db->where_in('emp_desi_id',$emp_desig);
		$this->db->where("pr_emp_per_info.emp_sex = '$marital_status'");
		$query = $this->db->get();
		foreach($query->result() as $rows)
		{
			$data[] = $rows->emp_id;
		}
		return $data;
	}

	function get_department_emp_by_id($dept_id,$marital_status)
	{

		$emp_cat = array(1,2);

		//$query = $this->db->select('emp_id')->where('emp_dept_id', $dept_id)->where_in('emp_cat_id',$emp_cat)->get('pr_emp_com_info');

			$this->db->select('pr_emp_com_info.emp_id');
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
			$this->db->where("pr_emp_com_info.emp_dept_id = '$dept_id'");
			$this->db->where("pr_emp_per_info.emp_sex = '$marital_status'");
			$query = $this->db->get();

		$data = array();
		foreach($query->result() as $rows)
		{
			$data[] = $rows->emp_id;
		}
		return $data;
	}

	

	function section_attendance_summary($report_date)
	{
		$query = $this->db->select()->order_by('sec_name')->get('pr_section');
		$male = 1;
		$female = 2;
		$data = array();

		foreach($query->result() as $rows)
		{
			$data['cat_name'][] = $rows->sec_name;
			$all_emp_id_male = $this->get_section_emp_by_id($rows->sec_id,$male);
			$all_emp_id_female = $this->get_section_emp_by_id($rows->sec_id,$female);
			
			if(!empty($all_emp_id_male))
			{
				$data['daily_att_sum_male'][] = $this->daily_attendance_summary($report_date, $all_emp_id_male);
			}
			else
			{
				$data['daily_att_sum_male'][] = 0;
			}
			
			if(!empty($all_emp_id_female))
			{
				$data['daily_att_sum_female'][] = $this->daily_attendance_summary($report_date, $all_emp_id_female);
			}
			else
			{
				$data['daily_att_sum_female'][] = 0;
			}

			$emp_desig = $this->designation_ids();
			for($i=0; $i<=11; $i++)
			{				
				//print_r($emp_desig);
				$all_desig_emp_id_by_sec_male = $this->desig_emp_id_by_sec($rows->sec_id,$emp_desig[$i],$male);
				$all_desig_emp_id_by_sec_female = $this->desig_emp_id_by_sec($rows->sec_id,$emp_desig[$i],$female);
			
				if(!empty($all_desig_emp_id_by_sec_male))
				{
					$data['remarks_daily_att_sum_male'][$i][] = $this->daily_attendance_summary($report_date, $all_desig_emp_id_by_sec_male);
				}
				else
				{
					$data['remarks_daily_att_sum_male'][$i][] = 0;
				}
				
				if(!empty($all_desig_emp_id_by_sec_female))
				{
					$data['remarks_daily_att_sum_female'][$i][] = $this->daily_attendance_summary($report_date, $all_desig_emp_id_by_sec_female);
				}
				else
				{
					$data['remarks_daily_att_sum_female'][$i][] = 0;
				}
				//echo $i;
			}	
		}
		return $data;
	}
	function desig_emp_id_by_sec($sec_id,$emp_desig,$marital_status)
	{
		
		$emp_cat = array(1,2);
		$data = array();
		$this->db->select('pr_emp_com_info.emp_id');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where("pr_emp_com_info.emp_sec_id = '$sec_id'");
		//$this->db->where("pr_emp_com_info.emp_desi_id = '$emp_desig'");
		$this->db->where_in('emp_desi_id',$emp_desig);
		$this->db->where("pr_emp_per_info.emp_sex = '$marital_status'");
		$query = $this->db->get();
		foreach($query->result() as $rows)
		{
			$data[] = $rows->emp_id;
		}
		return $data;
	}
	

	function get_section_emp_by_id($sec_id,$marital_status)
	{

		$emp_cat = array(1,2);

		//$query = $this->db->select('emp_id')->where('emp_sec_id', $sec_id)->where_in('emp_cat_id',$emp_cat)->get('pr_emp_com_info');
		
		$this->db->select('pr_emp_com_info.emp_id');
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
			$this->db->where("pr_emp_com_info.emp_sec_id = '$sec_id'");
			$this->db->where("pr_emp_per_info.emp_sex = '$marital_status'");
			$query = $this->db->get();

		$data = array();

		foreach($query->result() as $rows)

		{

			$data[] = $rows->emp_id;

		}

		return $data;

	}

	function line_leave_summary($report_date)
	{
		$query = $this->db->select()->order_by('line_name')->get('pr_line_num');
		$data = array();
		foreach($query->result() as $rows)
		{
			$data['cat_name'][] = $rows->line_name;
			
			$all_emp_id = $this->get_by_line_emp_id($rows->line_id);
			
			if(!empty($all_emp_id))
			{
				$data['daily_att_sum'][] = $this->daily_leave_summary($report_date, $all_emp_id);
			}
			else
			{
				$data['daily_att_sum'][] = '';
			}
		}
		return $data;
		
	}


	function daily_ot_eot_summary_report($report_date){
		$this->db->select("
					line.line_id,
					line.line_name,
					SUM(CASE WHEN log.in_time != '00:00:00' AND log.out_time != '00:00:00' THEN 1 ELSE 0 END ) AS total_emp,
					SUM(CASE WHEN log.in_time != '00:00:00' AND log.out_time != '00:00:00' THEN com.gross_sal ELSE 0 END ) AS total_salary,
					SUM(CASE WHEN log.ot_hour != '0.0' THEN 1 ELSE 0 END ) AS ot_emp,
					SUM(CASE WHEN log.extra_ot_hour != '0.0' THEN 1 ELSE 0 END ) AS eot_emp,
					SUM(log.ot_hour) AS total_ot,
					SUM(log.extra_ot_hour) AS total_eot,
					SUM(CASE WHEN log.ot_hour != '0.0' THEN com.gross_sal ELSE 0 END ) AS ot_salary,
					SUM(CASE WHEN log.extra_ot_hour != '0.0' THEN com.gross_sal ELSE 0 END ) AS eot_salary,
				");
		$this->db->from('pr_emp_shift_log log');
		$this->db->join('pr_emp_com_info com', 'com.emp_id = log.emp_id', 'left');
		$this->db->join('pr_line_num line', 'line.line_id = com.emp_line_id', 'left');

		$this->db->where('log.shift_log_date',$report_date);
		$this->db->order_by('line.line_name');
		$this->db->group_by('line.line_id');

		$data = $this->db->get()->result();
		
		return $data;
	}

	function sal_summary_with_ot_eot_date_between($first_date,$second_date,$line_id){
		$first_day = date('Y-m-d', strtotime($first_date));
		$second_day = date('Y-m-d', strtotime($second_date));

		$this->db->select("
					line.line_id,
					line.line_name,
					SUM(CASE WHEN log.in_time != '00:00:00' AND log.out_time != '00:00:00' THEN 1 ELSE 0 END ) AS t_emp,
					SUM(com.gross_sal) AS t_wages,
					SUM(log.ot_hour) AS t_ot,
					SUM(log.extra_ot_hour) AS t_eot,
				");
		$this->db->from('pr_emp_shift_log log');
		$this->db->join('pr_emp_com_info com', 'com.emp_id = log.emp_id', 'left');
		$this->db->join('pr_line_num line', 'line.line_id = com.emp_line_id', 'left');
		$this->db->where('log.shift_log_date >=' ,$first_day);
		$this->db->where('log.shift_log_date >=' ,$first_day);
		$this->db->where('com.emp_line_id'       ,$line_id);
		// $this->db->order_by('com.emp_id','ASC');
		// $this->db->group_by('com.emp_id');
		$data = $this->db->get()->result();
		// echo "<pre>";print_r($data);exit;
		return $data;
	}


	function line_ot_eot_summary($report_date)
	{
		$data = array();
		$lines = $this->db->order_by('line_name')->get('pr_line_num')->result_array();
		foreach ($lines as $key => $value) {
			$line = $value['line_id'];
			$lineName = $value['line_name'];
			$data[$key]['line_id'] = $line;
			$data[$key]['line_name'] = $lineName;
			$this->db->select("count('pr_emp_shift_log.emp_id') as totalemp, SUM(pr_emp_shift_log.ot_hour) as ot_hour, sum(pr_emp_shift_log.extra_ot_hour) as extra_ot_hour");/*
			$this->db->select("pr_emp_shift_log.*");*/
			$this->db->from('pr_emp_shift_log');
			$this->db->join('pr_emp_com_info', 'pr_emp_com_info.emp_id = pr_emp_shift_log.emp_id');
			$this->db->where('pr_emp_com_info.emp_line_id',$line);
			$this->db->where('pr_emp_shift_log.shift_log_date',$report_date);
			$data[$key]['daily_ot_eot']=$this->db->get()->result_array();
		}

		
		return $data;
		
	}



	function line_ot_man_power($report_date)
	{
		$data = array();
		$data = $this->db->order_by('line_name')->get('pr_line_num')->result_array();
		foreach ($data as $key => $value) {
			$line = $value['line_id'];
			$lineName = $value['line_name'];
			$this->db->select("count('pr_emp_shift_log.emp_id') as ot_mp");
			$this->db->from('pr_emp_shift_log');
			$this->db->join('pr_emp_com_info', 'pr_emp_com_info.emp_id = pr_emp_shift_log.emp_id');
			$this->db->where('pr_emp_com_info.emp_line_id',$line);
			$this->db->where('pr_emp_shift_log.shift_log_date',$report_date);
			$this->db->where('pr_emp_shift_log.ot_hour > ', 0);
			$data[$key]['ot_mp']=$this->db->get()->result_array();
		}

		
		return $data;
		
	}



	function line_eot_man_power($report_date)
	{
		$data = array();
		$data = $this->db->order_by('line_name')->get('pr_line_num')->result_array();
		foreach ($data as $key => $value) {
			$line = $value['line_id'];
			$lineName = $value['line_name'];
			$this->db->select("count('pr_emp_shift_log.emp_id') as eot_mp");
			$this->db->from('pr_emp_shift_log');
			$this->db->join('pr_emp_com_info', 'pr_emp_com_info.emp_id = pr_emp_shift_log.emp_id');
			$this->db->where('pr_emp_com_info.emp_line_id',$line);
			$this->db->where('pr_emp_shift_log.shift_log_date',$report_date);
			$this->db->where('pr_emp_shift_log.extra_ot_hour > ', 0);
			$data[$key]['eot_mp']=$this->db->get()->result_array();
		}

		
		return $data;
		
	}

	function line_attendance_summary($report_date)
	{

		$male = 1;
		$female = 2;
		$query = $this->db->select()->order_by('line_name')->get('pr_line_num');

		$data = array();

		foreach($query->result() as $rows)
		{
			$data['cat_name'][] = $rows->line_name;
			//$all_emp_id = $this->get_line_emp_by_id($rows->line_id);
			$all_emp_id_male = $this->get_line_emp_by_id($rows->line_id,$male);
			$all_emp_id_female = $this->get_line_emp_by_id($rows->line_id,$female);

			if(!empty($all_emp_id_male))
			{
				$data['daily_att_sum_male'][] = $this->daily_attendance_summary($report_date, $all_emp_id_male);
			}
			else
			{
				$data['daily_att_sum_male'][] = 0;
			}
			
			if(!empty($all_emp_id_female))
			{
				$data['daily_att_sum_female'][] = $this->daily_attendance_summary($report_date, $all_emp_id_female);
			}
			else
			{
				$data['daily_att_sum_female'][] = 0;
			}
			$emp_desig = $this->designation_ids();
			for($i=0; $i<=11; $i++)
			{				
				//print_r($emp_desig);
				$all_desig_emp_id_by_line_male = $this->desig_emp_id_by_line($rows->line_id,$emp_desig[$i],$male);
				$all_desig_emp_id_by_line_female = $this->desig_emp_id_by_line($rows->line_id,$emp_desig[$i],$female);
			
				if(!empty($all_desig_emp_id_by_line_male))
				{
					$data['remarks_daily_att_sum_male'][$i][] = $this->daily_attendance_summary($report_date, $all_desig_emp_id_by_line_male);
				}
				else
				{
					$data['remarks_daily_att_sum_male'][$i][] = 0;
				}
				
				if(!empty($all_desig_emp_id_by_line_female))
				{
					$data['remarks_daily_att_sum_female'][$i][] = $this->daily_attendance_summary($report_date, $all_desig_emp_id_by_line_female);
				}
				else
				{
					$data['remarks_daily_att_sum_female'][$i][] = 0;
				}
				//echo $i;
			}	

			
		}
		return $data;
	}

	function desig_emp_id_by_line($line_id,$emp_desig,$marital_status)
	{
		$emp_cat = array(1,2);
		$data = array();
		$this->db->select('pr_emp_com_info.emp_id');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where("pr_emp_com_info.emp_line_id = '$line_id'");
		//$this->db->where("pr_emp_com_info.emp_desi_id = '$emp_desig'");
		$this->db->where_in('emp_desi_id',$emp_desig);
		$this->db->where("pr_emp_per_info.emp_sex = '$marital_status'");
		$query = $this->db->get();
		foreach($query->result() as $rows)
		{
			$data[] = $rows->emp_id;
		}
		return $data;
	}

	function get_line_emp_by_id($line_id,$marital_status)
	{

		$emp_cat = array(1,2);

		//$query = $this->db->select('emp_id')->where('emp_line_id', $line_id)->where_in('emp_cat_id',$emp_cat)->get('pr_emp_com_info');

		$data = array();

		$this->db->select('pr_emp_com_info.emp_id');
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
			$this->db->where("pr_emp_com_info.emp_line_id = '$line_id'");
			$this->db->where("pr_emp_per_info.emp_sex = '$marital_status'");
			//echo $this->db->last_query();
			$query = $this->db->get();

		$data = array();

		foreach($query->result() as $rows)

		{

			$data[] = $rows->emp_id;

		}

		return $data;
	}

	function get_by_line_emp_id($line_id)
	{
		$emp_cat = array(1,2);
		$query = $this->db->select('emp_id')->where('emp_line_id', $line_id)->where_in('emp_cat_id',$emp_cat)->get('pr_emp_com_info');
		$data = array();
		foreach($query->result() as $rows)
		{
			$data[] = $rows->emp_id;
		}
		return $data;
	}	

	function daily_attendance_summary($report_date, $all_emp_id)
	{

		$data =array();

						

		$this->db->select('emp_id');

		$this->db->from("pr_emp_shift_log");

		$this->db->where_in("emp_id", $all_emp_id);

		$this->db->where("shift_log_date", $report_date);

		$this->db->group_by('emp_id');

		$data['all_emp'] = $this->db->get()->num_rows();
		
		//print_r($data['all_emp']."\n");
		
		//echo $this->db->last_query();

				

		$this->db->select("pr_emp_shift_log.emp_id");

		$this->db->from("pr_emp_shift_log");

		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_id);

		$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);

		$this->db->where("pr_emp_shift_log.in_time !=", "00:00:00");

		$this->db->group_by('pr_emp_shift_log.emp_id');

		$data['all_present'] = $this->db->get()->num_rows();

		

		$this->db->select("emp_id");

		$this->db->from("pr_leave_trans");

		$this->db->where_in("emp_id", $all_emp_id);

		$this->db->where("start_date", $report_date);

		$this->db->group_by('emp_id');

		$data['all_leave'] = $this->db->get()->num_rows();

				

		$this->db->select("pr_emp_shift_log.emp_id");

		$this->db->from("pr_emp_shift_log");

		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_id);

		$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);

		$this->db->where("pr_emp_shift_log.in_time", "00:00:00");

		$this->db->group_by('pr_emp_shift_log.emp_id');

		$all_absent = $this->db->get()->num_rows();

		$all_absent = $all_absent - $data['all_leave'];

		$data['all_absent'] = $all_absent;

		

		

		

		$this->db->select("pr_emp_shift_log.emp_id");

		$this->db->from("pr_emp_shift_log");

		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_id);

		$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);

		$this->db->where("pr_emp_shift_log.late_status",1);

		$this->db->group_by('pr_emp_shift_log.emp_id');

	 	$data['all_late'] = $this->db->get()->num_rows();

		

		return $data;

	}
	
		

	function daily_leave_summary($report_date, $all_emp_id)
	{

		$data =array();

						

		$this->db->select('emp_id');

		$this->db->from("pr_emp_shift_log");

		$this->db->where_in("emp_id", $all_emp_id);

		$this->db->where("shift_log_date", $report_date);

		$this->db->group_by('emp_id');

		$data['all_emp'] = $this->db->get()->num_rows();
		
		//print_r($data['all_emp']."\n");
		
		//echo $this->db->last_query();

				
		$this->db->select("emp_id");

		$this->db->from("pr_leave_trans");

		$this->db->where_in("emp_id", $all_emp_id);

		$this->db->where("start_date", $report_date);

		$this->db->group_by('emp_id');

		$data['all_leave'] = $this->db->get()->num_rows();

		

		return $data;

	}
	
	
		

	function daily_ot_eot_summary($report_date, $all_emp_id)
	{

		$data =array();

						

		$this->db->select('emp_id');

		$this->db->from("pr_emp_shift_log");

		$this->db->where_in("emp_id", $all_emp_id);

		$this->db->where("shift_log_date", $report_date);

		$this->db->group_by('emp_id');

		$data['all_emp'] = $this->db->get()->num_rows();


		// $this->db->select('pr_emp_shift_log.ot_hour');
		
		$this->db->select('SUM(pr_emp_shift_log.ot_hour) as ot_hour');

		$this->db->from("pr_emp_shift_log");

		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_id);

		$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);

		$this->db->where("pr_emp_shift_log.ot_hour >=", "0");

		$this->db->group_by('pr_emp_shift_log.emp_id');

		$all_ot_hour = $this->db->get()->num_rows();
		$data['ot_hour'] = $all_ot_hour;
		

		$this->db->select("emp_id");

		$this->db->from("pr_leave_trans");

		$this->db->where_in("emp_id", $all_emp_id);

		$this->db->where("start_date", $report_date);

		$this->db->group_by('emp_id');

		$data['all_leave'] = $this->db->get()->num_rows();

		
		// $this->db->select('pr_emp_shift_log.extra_ot_hour');

		$this->db->select('SUM(pr_emp_shift_log.extra_ot_hour) as extra_ot_hour');

		$this->db->from("pr_emp_shift_log");

		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_id);

		$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);

		$this->db->where("pr_emp_shift_log.extra_ot_hour >=", "0");

		$this->db->group_by('pr_emp_shift_log.emp_id');

		$all_eot_hour = $this->db->get()->num_rows();
		$data['extra_ot_hour'] = $all_eot_hour;
		
		//print_r($data['all_emp']."\n");
		
		//echo $this->db->last_query();

		return $data;

	}
	
	function get_lines()
	{
		$this->db->select('*');
		$this->db->from('pr_line_num');
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function get_maternity_info($report_date,$line_no)
	{
		$this->db->select('COUNT(emp_id) as emp, line_no as line, line_name');
		$this->db->from('pr_emp_meternity_history');
		$this->db->where('line_no',$line_no);
		$this->db->where('start_date <=', $report_date);
		$this->db->where('end_date >=', $report_date);
		$this->db->join('pr_line_num', 'pr_line_num.line_id = pr_emp_meternity_history.line_no');
		$query = $this->db->get();
		// /echo $this->db->last_query();
		return $query;
	}

	// 22-05-2022 modify others reports
	function new_line_attendance_summary($report_date)
	{
		$data = array();
		$query = $this->db->select()->order_by('line_name')->get('pr_line_num');

		foreach($query->result() as $rows)
		{
			// skip 21, 32 & 35 number line
			$line_array = array(21, 32, 35, 28, 29);
			if (in_array($rows->line_id, $line_array)) {
				continue;
			}

			// get all empployee by line id
			$line_id = $rows->line_id;
			$line_name = $rows->line_name;
			$all_emp_id =  $this->get_emp_by_line($line_id);

			if(!empty($all_emp_id))
			{
				$data[] = $this->new_daily_attendance_summary($report_date, $all_emp_id, $line_id, $line_name);
			}
		}
			// echo "<pre>"; print_r($data); die();
		return $data;
	}

	public function get_emp_by_line($line_id)
	{
		$data = array();
		$emp_cat = array(1,2);
		$query = $this->db->select('emp_id')->where('emp_line_id', $line_id)->where_in('emp_cat_id',$emp_cat)->get('pr_emp_com_info');

		foreach($query->result() as $rows)
		{
			$data[] = $rows->emp_id;
		}
		return $data;
	}

	function new_daily_attendance_summary($report_date, $all_emp_id, $line_id, $line_name)
	{
		$data = array();
		$ironman_array   = array(3,98,115);
		$finishinf_array = array(114,117,181,186, 78, 6, 5);

		$staff   			= 0;
		$helper  			= 0;
		$operator  			= 0;
		$qc 				= 0;
		$ironman 			= 0;
		$designer 			= 0;
		$finishing_packing  = 0;

		$staff_p   			 = 0;
		$helper_p  			 = 0;
		$operator_p  		 = 0;
		$qc_p 				 = 0;
		$ironman_p 			 = 0;
		$designer_p 		 = 0;
		$finishing_packing_p = 0;

		$staff_l   			 = 0;
		$helper_l  			 = 0;
		$operator_l  		 = 0;
		$qc_l 				 = 0;
		$ironman_l 			 = 0;
		$designer_l 		 = 0;
		$finishing_packing_l = 0;

		$late_emp 			 = 0;
		$data['line_id'] = $line_id; 
		$data['line_name'] = $line_name; 

		$this->db->select('log.emp_id, log.in_time, log.late_status, info.emp_desi_id');
		$this->db->from("pr_emp_shift_log as log");
		$this->db->join('pr_emp_com_info as info', "info.emp_id = log.emp_id", "left");
		$this->db->where_in("log.emp_id", $all_emp_id);
		$this->db->where("log.shift_log_date", $report_date);
		$query = $this->db->get();
		$data['total_emp'] = $query->num_rows();

		// presend and late emp count 
		foreach ($query->result() as $key => $row) { 
			$emp_id = strtoupper(substr($row->emp_id, 0, 2));

			if ($emp_id == "OS" or $emp_id == "PS") 
			{
				$staff = $staff + 1;
				if ($row->in_time != "00:00:00") {
					$staff_p = $staff_p + 1;
				}
			} 
			else if (($emp_id == "CU")||($emp_id == "SH")||($emp_id == "WS")||($emp_id == "FI" && ($row->emp_desi_id == 4 || $row->emp_desi_id==165))) 
			{
				$helper = $helper + 1;
				if ($row->in_time != "00:00:00") {
					$helper_p = $helper_p + 1;
				}
			} 
			else if ($emp_id == "SO") 
			{
				$operator = $operator + 1;
				if ($row->in_time != "00:00:00") {
					$operator_p = $operator_p + 1;
				}
			} 
			else if ($emp_id == "QC") 
			{
				$qc = $qc + 1;
				if ($row->in_time != "00:00:00") {
					$qc_p = $qc_p + 1;
				}
			} 
			else if (($emp_id == "IR") || ($emp_id == "FI" && in_array($row->emp_desi_id, $ironman_array))) 
			{
				$ironman = $ironman + 1;
				if ($row->in_time != "00:00:00") {
					$ironman_p = $ironman_p + 1;
				}
			} 
			else if ($emp_id == "SP") 
			{
				$designer = $designer + 1;
				if ($row->in_time != "00:00:00") {
					$designer_p = $designer_p + 1;
				}
			} 
			else if ($emp_id == "FI" && in_array($row->emp_desi_id, $finishinf_array)) 
			{
				$finishing_packing = $finishing_packing + 1;
				if ($row->in_time != "00:00:00") {
					$finishing_packing_p = $finishing_packing_p + 1;
				}
			}

			// late count
			if ($row->late_status == "1") {
				$late_emp = $late_emp + 1;
			}
		}
		// total present
		$data['total_late'] = $late_emp;
		$data['total_present'] = $staff_p + $helper_p + $operator_p + $qc_p + $ironman_p + $designer_p + $finishing_packing_p;

		$data['staff'] 			 	= $staff;
		$data['helper'] 			= $helper;
		$data['operator'] 		 	= $operator;
		$data['qc'] 				= $qc;
		$data['ironman'] 			= $ironman;
		$data['designer']          	= $designer;
		$data['finishing_packing'] 	= $finishing_packing;

		$data['staff_p'] 			 = $staff_p;
		$data['helper_p'] 			 = $helper_p;
		$data['operator_p'] 		 = $operator_p;
		$data['qc_p'] 				 = $qc_p;
		$data['ironman_p'] 			 = $ironman_p;
		$data['designer_p']          = $designer_p;
		$data['finishing_packing_p'] = $finishing_packing_p;
				
		// leave count		
		$this->db->select("trans.emp_id, info.emp_desi_id");
		$this->db->from("pr_leave_trans as trans");
		$this->db->join('pr_emp_com_info as info', "info.emp_id = trans.emp_id", "left");
		$this->db->where_in("trans.emp_id", $all_emp_id);
		$this->db->where("trans.start_date", $report_date);
		$this->db->group_by('trans.emp_id');
		$leave = $this->db->get();
		$data['total_leave'] = $leave->num_rows();  

		foreach ($leave->result() as $key => $row) { 
			$emp_id = strtoupper(substr($row->emp_id, 0, 2));

			if ($emp_id == "OS" or $emp_id == "PS") 
			{
				$staff_l = $staff_l + 1;
			} 
			else if (($emp_id == "CU")||($emp_id == "SH")||($emp_id == "WS")||($emp_id == "FI" && $row->emp_desi_id == 4)) 
			{
				$helper_l = $helper_l + 1;
			} 
			else if ($emp_id == "SO") 
			{
				$operator_l = $operator_l + 1;
			} 
			else if ($emp_id == "QC") 
			{
				$qc_l = $qc_l + 1;
			} 
			else if (($emp_id == "IR") || ($emp_id == "FI" && in_array($row->emp_desi_id, $ironman_array))) 
			{
				$ironman_l = $ironman_l + 1;
			} 
			else if ($emp_id == "SP") 
			{
				$designer_l = $designer_l+ 1;
			} 
			else if ($emp_id == "FI" && in_array($row->emp_desi_id, $finishinf_array)) 
			{
				$finishing_packing_l = $finishing_packing_l + 1;
			}
		}

		$data['staff_l'] 			 = $staff_l;
		$data['helper_l'] 			 = $helper_l;
		$data['operator_l'] 		 = $operator_l;
		$data['qc_l'] 				 = $qc_l;
		$data['ironman_l'] 			 = $ironman_l;
		$data['designer_l']          = $designer_l;
		$data['finishing_packing_l'] = $finishing_packing_l;

		$data['total_absent'] = $data['total_emp'] - $data['total_present'] - $data['total_leave'];

		return $data;
	}

	public function prev_day_attendance($report_date)
	{
		$data = array();
		$line_array = array(21, 32, 35, 28, 29);

		$this->db->select('log.emp_id, log.in_time');
		$this->db->from("pr_emp_shift_log as log");
		$this->db->join("pr_emp_com_info as com", 'log.emp_id = com.emp_id', 'left');
		$this->db->where("log.shift_log_date", $report_date);
		$this->db->where_not_in('com.emp_line_id', $line_array);
		$this->db->group_by('com.emp_id');
		// $this->db->group_by('log.emp_id');
		$query = $this->db->get();
		$data['total_prev_emp'] = $query->num_rows();

		// presend and late emp count 
		$total_prev_p = 0;
		foreach ($query->result() as $key => $row) { 
			if ($row->in_time != "00:00:00") {
				$total_prev_p = $total_prev_p + 1;
			}
		}
		$data['total_prev_p'] = $total_prev_p;


		$this->db->select("trans.emp_id");
		$this->db->from("pr_leave_trans as trans");
		$this->db->where("trans.start_date", $report_date);
		$this->db->group_by('trans.emp_id');
		$leave = $this->db->get();
		$data['total_leave'] = $leave->num_rows(); 

		$data['total_prev_a'] = $data['total_prev_emp'] - $data['total_prev_p'] - $data['total_leave'];
		return $data;
	}

	// 05-03-2023 daily ot cal 
	function new_daily_ot_summary($report_date)
	{
		$data = array();
		$query = $this->db->select()->order_by('line_name')->get('pr_line_num');

		foreach($query->result() as $rows)
		{
			// skip 21, 32 & 35 number line
			$line_array = array(21, 32, 35, 28, 29, 4, 14);
			if (in_array($rows->line_id, $line_array)) {
				continue;
			}

			// get all empployee by line id
			$line_id = $rows->line_id;
			$line_name = $rows->line_name;
			$all_emp_id =  $this->get_emp_by_line($line_id);

			if(!empty($all_emp_id))
			{
				$data[] = $this->new_daily_ot_cal($report_date, $all_emp_id, $line_id, $line_name);
			}
		}

		return $data;
	}


	function new_daily_ot_cal($report_date, $all_emp_id, $line_id, $line_name)
	{
		$data = array();
		$sh_array   = array(4,198,10,177,164);
		$ironman_array   = array(3,98,115);

		$helper  			= 0;
		$operator  			= 0;
		$qc 				= 0;
		$ironman 			= 0;
		$packingman 		= 0;
		$Foldingman 		= 0;
		$handtagman   		= 0;
		$layman			    = 0;
		$numberman		    = 0;
		$bundlingman		= 0;

		$helper_ot  		  = 0;
		$operator_ot  		  = 0;
		$qc_ot 				  = 0;
		$ironman_ot 		  = 0;
		$packingman_ot 		  = 0;
		$Foldingman_ot 		  = 0;
		$handtagman_ot   	  = 0;
		$layman_ot			  = 0;
		$numberman_ot		  = 0;
		$bundlingman_ot		  = 0;


		$data['line_id'] = $line_id; 
		$data['line_name'] = $line_name; 

		$this->db->select('log.emp_id, log.ot_hour, log.extra_ot_hour, info.emp_desi_id');

		$this->db->from("pr_emp_shift_log as log");
		$this->db->join('pr_emp_com_info as info', "info.emp_id = log.emp_id", "left");

		$this->db->where_in("log.emp_id", $all_emp_id);
		$this->db->where("log.shift_log_date", $report_date);
		$query = $this->db->get();
		// $data['total_emp'] = $query->num_rows();

		// presend and late emp count 
		foreach ($query->result() as $key => $row) { 
			$emp_id = strtoupper(substr($row->emp_id, 0, 2));

			if (($row->emp_desi_id == 78 || $row->emp_desi_id == 114)) 
			{
				if ($row->ot_hour != "0.0") {
					$packingman = $packingman + 1;
					$packingman_ot = $packingman_ot + $row->ot_hour + $row->extra_ot_hour;
				}
			} 
			else if ($row->emp_desi_id == 117) 
			{
				if ($row->ot_hour != "0.0") {
					$Foldingman = $Foldingman + 1;
					$Foldingman_ot = $Foldingman_ot + $row->ot_hour + $row->extra_ot_hour;
				}
			} 
			else if ($row->emp_desi_id == 186 || $row->emp_desi_id == 181) 
			{
				if ($row->ot_hour != "0.0") {
					$handtagman = $handtagman + 1;
					$handtagman_ot = $handtagman_ot + $row->ot_hour + $row->extra_ot_hour;
				}
			}
			else if ($row->emp_desi_id == 172) 
			{
				if ($row->ot_hour != "0.0") {
					$layman = $layman + 1;
					$layman_ot = $layman_ot + $row->ot_hour + $row->extra_ot_hour;
				}
			} 
			else if ($row->emp_desi_id == 171) 
			{
				if ($row->ot_hour != "0.0") {
					$numberman = $numberman + 1;
					$numberman_ot = $numberman_ot + $row->ot_hour + $row->extra_ot_hour;
				}
			} 
			else if ($row->emp_desi_id == 169) 
			{
				if ($row->ot_hour != "0.0") {
					$bundlingman = $bundlingman + 1;
					$bundlingman_ot = $bundlingman_ot + $row->ot_hour + $row->extra_ot_hour;
				}
			} 
			else if (($emp_id == "SH")||($emp_id == "WS")||(in_array($row->emp_desi_id, $sh_array))) 
			{
				if ($row->ot_hour != "0.0") {
					$helper = $helper + 1;
					$helper_ot = $helper_ot + $row->ot_hour + $row->extra_ot_hour;
				}
			} 
			else if ($emp_id == "SO") 
			{
				if ($row->ot_hour != "0.0") {
					$operator = $operator + 1;
					$operator_ot = $operator_ot + $row->ot_hour + $row->extra_ot_hour;
				}
			} 
			else if ($emp_id == "QC") 
			{
				if ($row->ot_hour != "0.0") {
					$qc = $qc + 1;
					$qc_ot = $qc_ot + $row->ot_hour + $row->extra_ot_hour;
				}
			} 
			else if (($emp_id == "IR") || ($emp_id == "FI" && in_array($row->emp_desi_id, $ironman_array))) 
			{
				if ($row->ot_hour != "0.0") {
					$ironman = $ironman + 1;
					$ironman_ot = $ironman_ot + $row->ot_hour + $row->extra_ot_hour;
				}
			} 

		}
		// total present

		$data['total_ot'] = $helper_ot + $operator_ot + $qc_ot + $ironman_ot + $packingman_ot + $Foldingman_ot + $handtagman_ot + $layman_ot + $numberman_ot + $bundlingman_ot;

		$data['total_emp'] = $helper + $operator+ $qc + $ironman + $packingman + $Foldingman + $handtagman + $layman + $numberman + $bundlingman;

		$data['helper'] 			= $helper;
		$data['operator'] 		 	= $operator;
		$data['qc'] 				= $qc;
		$data['ironman'] 			= $ironman;
		$data['packingman'] 		= $packingman;
		$data['Foldingman'] 		= $Foldingman;
		$data['handtagman'] 		= $handtagman;
		$data['layman'] 			= $layman;
		$data['numberman'] 			= $numberman;
		$data['bundlingman'] 		= $bundlingman;

		$data['helper_ot'] 			 = $helper_ot;
		$data['operator_ot'] 		 = $operator_ot;
		$data['qc_ot'] 				 = $qc_ot;
		$data['ironman_ot'] 		 = $ironman_ot;
		$data['packingman_ot'] 		 = $packingman_ot;
		$data['Foldingman_ot'] 		 = $Foldingman_ot;
		$data['handtagman_ot'] 		 = $handtagman_ot;
		$data['layman_ot'] 			 = $layman_ot;
		$data['numberman_ot'] 		 = $numberman_ot;
		$data['bundlingman_ot'] 	 = $bundlingman_ot;

		return $data;
	}

}

?>