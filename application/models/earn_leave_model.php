<?php
class Earn_leave_model extends CI_Model{
	function __construct()
	{
		parent::__construct();
		$this->load->dbforge();
		/* Standard Libraries */
		ini_set('memory_limit', '-1');
	}
	//UPDATED ON 23-04-2015 BY MD. KAMRUL HASAN TAREQ
	//========================Earn Leave Model (2014-01-17)=================================
	//======================================================================================
	function earn_leave_process_db($year,$process_check)
	{
		$process_year = $year;
		$system_year = date("Y");
		if($process_year > $system_year)
		{
			return "Failed ! You Are In $system_year";
		}
		//Earn Leave Lock Service
		$unit_id = 0;//$this->common_model->get_session_unit_id_name();
		$next_year = date("Y",strtotime("-1 year",strtotime($process_year)));
		$num_row_year = $this->db->like('block_year',$next_year)->get('pr_earn_leave_block')->num_rows();
		//$num_row_year = $this->db->like('block_year',$next_year)->where('unit_id',$unit_id)->get('pr_earn_leave_block')->num_rows();
		if($num_row_year < 1)
		{
			//return "Previous Year is not finally Process";
		}

		//if($unit_id == 0){return "Please Login As an Unit User.";}
		$num_row 	= $this->db->like('block_year',$process_year)->get('pr_earn_leave_block')->num_rows();
		//$num_row 	= $this->db->like('block_year',$process_year)->where('unit_id',$unit_id)->get('pr_earn_leave_block')->num_rows();
		if($num_row > 0)
		{
			return "This Month Already Finally Processed.";
		}
		
		//INSERT BLOCK RECORD
		if($process_check == "2")
		{
		  $block_year 		= "$process_year";
		  $data_1['block_year'] 	= $block_year;
		  //$data_1['unit_id'] 		= $unit_id;
		  $data_1['username'] 		= $this->session->userdata('username');
		  $data_1['date_time'] 		= date("Y-m-d H:i:s");
		  $this->db->insert('pr_earn_leave_block', $data_1); 
		  //echo $this->db->last_query();
		}
		
		$process_start_date = $process_year."-01-01";
		$process_end_date 	= $process_year."-12-31";
		
		//================================Table Manuppulation========================
		$table_name = "pr_earn_$process_year";
		$table_maupulation = $this->yearly_earn_leave_table_maupulation($table_name);
		
		$earn_leave_text = $this->get_earn_leave_text();
		
		
		$this->db->select('*');
		$this->db->from('pr_emp_shift_log');
		$this->db->from('pr_emp_com_info');
		$this->db->where('pr_emp_com_info.emp_id = pr_emp_shift_log.emp_id');
		//$this->db->where('pr_emp_com_info.unit_id',$unit_id);
		$this->db->like('shift_log_date',$process_year);
		//$this->db->where('pr_emp_com_info.emp_id',"10000004");
		$this->db->group_by('pr_emp_shift_log.emp_id');
		$query_earn_emp = $this->db->get();
		$query_earn_emp_no = $query_earn_emp->num_rows();
		if($query_earn_emp_no == 0)
		{
			return "There are no employee to have earn leave!";
		}
		
		foreach($query_earn_emp->result() as $rows)
		{
			$earn_data = array();
			$emp_id 				= $rows->emp_id;
			$salary_process_eligibility = $this->salary_process_eligibility($emp_id, $process_year);
				
			if($salary_process_eligibility == true)
			{
				//$earn_data['unit_id'] 	= $unit_id;
				$earn_data['emp_id'] 	= $emp_id;
				$earn_data['dept_id']	= $rows->emp_dept_id;
				$earn_data['sec_id'] 	= $rows->emp_sec_id;
				$earn_data['line_id'] 	= $rows->emp_line_id;
				$earn_data['desig_id']	= $rows->emp_desi_id;
				
				$gross_sal = $rows->gross_sal;
				$salary_structure = $this->common_model->salary_structure($gross_sal);
				$basic_sal = $salary_structure['basic_sal'];
				
				$earn_data['gross_sal'] 	= $gross_sal;
				$earn_data['basic_sal'] 	= $basic_sal;
				$earn_data['ttl_wk_days'] 	= date("z", mktime(0,0,0,12,31,$process_year)) + 1;
				
				$doj = $this->db->where("emp_id",$emp_id)->get('pr_emp_com_info')->row()->emp_join_date;
	
				$earn_data = $this->get_leave_record($emp_id, $process_year, $earn_data);
				
				$total_earn_leave_count = 0;
				foreach($earn_leave_text as $earn_status)
				{
					$earn_leave_count = $this->earn_leave_count($emp_id,$process_year,$earn_status);
					$total_earn_leave_count = $total_earn_leave_count + $earn_leave_count ;
					$earn_data[$earn_status] = $earn_leave_count;
				}
				$earn_leave_day_count = $this->db->where("id",2)->get('pr_earn_setup')->row()->value;
				$total_earn_leave = floor($total_earn_leave_count /$earn_leave_day_count);
				
				$insert_update_earn_leave = $this->insert_update_earn_leave($emp_id,$earn_data,$table_name);
		}
		}
		return "Earn Leave Process Completed Succesfully !";
	}
	
	function get_earn_leave_start_date($emp_id,$doj,$process_start_date,$process_end_date)
	{
		$dateOneYearAdded = strtotime(date("Y-m-d", strtotime($doj)) . " +1 year");
		$doj_one_year = date('Y-m-d', $dateOneYearAdded);
		
		if($doj_one_year < $process_start_date)
		{
			return $process_start_date;
		}
		else if($doj_one_year > $process_end_date)
		{
			return "False";
		}
		else
		{
			return $doj_one_year;
		}
		//return $doj_one_year;
	}
	
	function insert_update_earn_leave($emp_id,$earn_data,$table_name)
	{
		$stamp = 10;
		$num_row = $this->db->where('emp_id',$emp_id)->get($table_name)->num_rows();
		$earn_data['pay_days'] 		= $earn_data['P'] ;
		$earn_data['pay_days_com']	= $earn_data['P'];
		
		$earn_data['earn_leave'] 	=  round(($earn_data['pay_days']/18),2)- $earn_data['el'];
		$earn_data['earn_leave_com']=  round(($earn_data['pay_days_com']/18),2)- $earn_data['el'];
		$earn_data['stamp'] 		= $stamp;
		$earn_data['net_pay'] 		=  round($earn_data['earn_leave']* ($earn_data['gross_sal']/26)- $stamp);
		$earn_data['net_pay_com']	=  round($earn_data['earn_leave_com']* ($earn_data['gross_sal']/26) - $stamp);
		//print_r($earn_data);
		if($num_row == 0)
		{
			$this->db->insert($table_name, $earn_data);
		}
		else
		{			
			$this->db->where('emp_id', $emp_id);
			$this->db->update($table_name, $earn_data);
		}
		return;
	}
	
	function earn_leave_count($emp_id,$process_year,$earn_status)
	{
		//$num_row = $this->db->like('shift_log_date',$process_year)->where('emp_id',$emp_id)->where('present_status',$earn_status)->get('pr_emp_shift_log')->num_rows();
		$query = $this->db->like('shift_log_date',$process_year)->where('emp_id',$emp_id)->where('present_status',$earn_status)->get('pr_emp_shift_log');
		//echo $this->db->last_query();
		if($query->num_rows() == 0)
		{
			return $num_row = 0;
		}
		else{ return $query->num_rows();}
	}
	
	function get_present_status($emp_id,$shift_log_date)
	{
		$year_month 	= date("Y-m",strtotime($shift_log_date));
		$day 			= date("d",strtotime($shift_log_date));
		$select_column 	= "date_$day";
		$present_status = $this->db->like("att_month",$year_month)->where("emp_id",$emp_id)->get('pr_attn_monthly')->row()->$select_column;
		return $present_status;
	}
	
	function update_shift_log($emp_id,$shift_log_date,$present_status)
	{
		$data = array(
               'present_status' 		=> $present_status
            );
		$this->db->where('emp_id', $emp_id);
		$this->db->where('shift_log_date', $shift_log_date);
		$this->db->update('pr_emp_shift_log', $data); 
		return;
		
	}
	
	function get_earn_leave_text()
	{
		$earn_leave = $this->db->where("id",1)->get('pr_earn_setup')->row()->value;
		$earn_leave_text = str_split($earn_leave);
		return $earn_leave_text;
		
	}
	
	function yearly_earn_leave_table_maupulation($table_name)
	{
		if (!$this->db->table_exists($table_name))
		{
		   	$this->load->dbforge();	
			$fields = array(
			'id' 				=> array( 'type' => 'INT','constraint'=>'11','auto_increment'=>TRUE),
			//'unit_id' 			=> array( 'type' => 'INT'),
			'emp_id' 			=> array( 'type' => 'VARCHAR','constraint' => '200'),
			'dept_id' 			=> array( 'type' => 'INT','constraint' => '11'),
			'sec_id' 			=> array( 'type' => 'INT','constraint' => '11'),
			'line_id' 			=> array( 'type' => 'INT','constraint' => '11'),
			'desig_id' 			=> array( 'type' => 'INT','constraint' => '11'),
			'gross_sal' 		=> array( 'type' => 'INT','constraint' => '11'),
			'basic_sal' 		=> array( 'type' => 'INT','constraint' => '11'),
			'P' 				=> array( 'type' => 'INT','constraint' => '11'),
			'A' 				=> array( 'type' => 'INT','constraint' => '11'),
			'W' 				=> array( 'type' => 'INT','constraint' => '11'),
			'H' 				=> array( 'type' => 'INT','constraint' => '11'),
			'L' 				=> array( 'type' => 'INT','constraint' => '11'),
			'el' 				=> array( 'type' => 'INT','constraint' => '11'),
			'cl' 				=> array( 'type' => 'INT','constraint' => '11'),
			'sl' 				=> array( 'type' => 'INT','constraint' => '11'),
			'ml' 				=> array( 'type' => 'INT','constraint' => '11'),
			'ttl_wk_days' 		=> array( 'type' => 'INT','constraint' => '11'),
			'pay_days' 			=> array( 'type' => 'INT','constraint' => '11'),
			'pay_days_com' 		=> array( 'type' => 'INT','constraint' => '11'),
			'earn_leave'  		=> array( 'type' => 'double','constraint' => '10,2'),
			'earn_leave_com'  	=> array( 'type' => 'double','constraint' => '10,2'),
			'stamp'  			=> array( 'type' => 'float'),
			'net_pay'  			=> array( 'type' => 'float'),
			'net_pay_com'  		=> array( 'type' => 'float'),

 								);
				$this->dbforge->add_field($fields);
				$this->dbforge->add_key('id', TRUE);
				$this->dbforge->create_table($table_name);		
		}
		return;
	}
	
	//===================Earn Leave Report============================
	//================================================================
	function grid_earn_leave_general_info($sal_year_month, $grid_status, $grid_emp_id)
	{
		
		//echo $sal_year_month;
		$year  = date("Y",strtotime($sal_year_month));
		$table_name = "pr_earn_$year";
		
		$this->db->select("pr_emp_per_info.emp_full_name,pr_designation.desig_name, pr_section.sec_name, pr_line_num.line_name,pr_floor.floor_name, pr_emp_com_info.emp_join_date, pr_grade.gr_name,$table_name.*");
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_grade');
		$this->db->from("$table_name");
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_designation');
		$this->db->from('pr_floor');
		$this->db->where_in("$table_name.emp_id", $grid_emp_id);
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_com_info.emp_floor_id = pr_floor.floor_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_sal_gra_id = pr_grade.gr_id');
		$this->db->where("pr_emp_per_info.emp_id = $table_name.emp_id");
		
		
		$this->db->order_by("pr_emp_com_info.emp_id");
		$this->db->group_by("$table_name.emp_id");
		$query = $this->db->get();	
		$num_rows = $query->num_rows();
		if($num_rows < 1)
		{
			
		 return "empty";	
		}
		
		//echo $query->num_rows();
		foreach($query->result() as $rows)
		{
			$data['emp_id'][] 			= $rows->emp_id;
			$data['emp_name'][] 		= $rows->emp_full_name;
			$data['desig_name'][] 		= $rows->desig_name;
			$data['sec_name'] []		= $rows->sec_name;
			$data['floor_name'][] 		= $rows->floor_name;
			$data['line_name'][]		= $rows->line_name;
			$data['emp_join_date'][] 	= $rows->emp_join_date;
			$data['gr_name'] []			= $rows->gr_name;
			$data['gross_sal'] []		= $rows->gross_sal;
			$data['basic_sal'][] 		= $rows->basic_sal;
			$data['P'][] 				= $rows->P;
			$data['A'][] 				= $rows->A;
			$data['W'] 					= $rows->W;
			$data['H'][]				= $rows->H;
			$data['L'][] 				= $rows->L;
			$data['cl'] []				= $rows->cl;
			$data['el'] []				= $rows->el;
			$data['sl'] []				= $rows->sl;
			$data['ml'][] 				= $rows->ml;
			$data['ttl_wk_days'][] 		= $rows->ttl_wk_days;
			$data['pay_days'][] 		= $rows->pay_days;
			$data['pay_days_com'][]		= $rows->pay_days_com;
			$data['earn_leave'][]		= $rows->earn_leave;
			$data['earn_leave_com'][] 	= $rows->earn_leave_com;
			$data['net_pay'] []			= $rows->net_pay;
			$data['stamp'] []			= $rows->stamp;
			$data['net_pay_com'] []		= $rows->net_pay_com;		
		}
		return $data;
	}
	
	function grid_earn_leave_payment_buyer($sal_year_month, $grid_status, $grid_emp_id)
	{
		
		//echo $sal_year_month;
		$year  = date("Y",strtotime($sal_year_month));
		$table_name = "pr_earn_$year";
		
		$this->db->select("pr_emp_per_info.emp_full_name,pr_designation.desig_name, pr_section.sec_name, pr_line_num.line_name,pr_floor.floor_name, pr_emp_com_info.emp_join_date, pr_grade.gr_name,$table_name.*");
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_grade');
		$this->db->from("$table_name");
		$this->db->from('pr_dept');
		$this->db->from('pr_section');
		$this->db->from('pr_line_num');
		$this->db->from('pr_designation');
		$this->db->from('pr_floor');
		$this->db->where_in("$table_name.emp_id", $grid_emp_id);
		$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
		$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
		$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
		$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_com_info.emp_floor_id = pr_floor.floor_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.emp_sal_gra_id = pr_grade.gr_id');
		$this->db->where("pr_emp_per_info.emp_id = $table_name.emp_id");
		
		
		$this->db->order_by("pr_emp_com_info.emp_id");
		$this->db->group_by("$table_name.emp_id");
		$query = $this->db->get();	
		$num_rows = $query->num_rows();
		if($num_rows < 1)
		{
			
		 return "empty";	
		}
		
		//echo $query->num_rows();
		foreach($query->result() as $rows)
		{
			$data['emp_id'][] 			= $rows->emp_id;
			$data['emp_name'][] 		= $rows->emp_full_name;
			$data['desig_name'][] 		= $rows->desig_name;
			$data['sec_name'][] 		= $rows->sec_name;
			$data['line_name'][]		= $rows->line_name;
			$data['floor_name'][] 		= $rows->floor_name;
			$data['emp_join_date'][] 	= $rows->emp_join_date;
			$data['gr_name'][]			= $rows->gr_name;
			$data['gross_sal'][]		= $rows->gross_sal;
			$data['basic_sal'][] 		= $rows->basic_sal;
			$data['P'][] 				= $rows->P;
			$data['A'][] 				= $rows->A;
			$data['W'][] 				= $rows->W;
			$data['H'][]				= $rows->H;
			$data['L'][] 				= $rows->L;
			$data['cl'][]				= $rows->cl;
			$data['el'][]				= $rows->el;
			$data['sl'][]				= $rows->sl;
			$data['ml'][] 				= $rows->ml;
			$data['ttl_wk_days'][] 		= $rows->ttl_wk_days;
			$data['pay_days'][] 		= $rows->pay_days;
			$data['pay_days_com'][] 	= $rows->pay_days_com;
			$data['earn_leave'][]		= $rows->earn_leave;
			$data['earn_leave_com'][] 	= $rows->earn_leave_com;
			$data['net_pay'][]			= $rows->net_pay;
			$data['stamp'] []			= $rows->stamp;
			$data['net_pay_com'][]		= $rows->net_pay_com;		
		}
		return $data;
	}
	
	function get_earn_leave_entitle($emp_id,$year)
	{
		$num_row = $this->db->like('start_date',$year)->where('emp_id',$emp_id)->where('leave_type','el')->get('pr_leave_trans')->num_rows();
		return $num_row;
	}
	
	function get_earn_leave_paid_amount($emp_id,$year)
	{
		$this->db->select_sum('paid_amount');
		$this->db->from("pr_earn_leave_paid");
		$this->db->where('emp_id', $emp_id);
		$this->db->like("year", $year);
		$query = $this->db->get();
		$row = $query->row();
		$result = $row->paid_amount;
		if($result =='')
		{
			$result = 0;
		}
		return $result;
	}
	
	function get_earn_leave_paid($emp_id,$year)
	{
		$this->db->select_sum('paid_leave');
		$this->db->from("pr_earn_leave_paid");
		$this->db->where('emp_id', $emp_id);
		$this->db->like("year", $year);
		$query = $this->db->get();
		$row = $query->row();
		$result = $row->paid_leave;
		if($result =='')
		{
			$result = 0;
		}
		return $result;
	}
	function get_yearly_earn_leave($emp_id,$table_name)
	{
		
		if (!$this->db->table_exists($table_name))
		{
		   		return 0;
		}
		$this->db->select('*');
		$this->db->where("emp_id",$emp_id);
		$query = $this->db->get($table_name);
		if($query->num_rows < 1)
		{
			return 0;
		}
		$row = $query->row();
		$earn_leave = $row->earn_leave;
		return $earn_leave;
	}	
	
	function earn_leave_payment_db()
	{
		
		$count 	= $this->input->post('count');
		$year 	= $this->input->post('year');
		$unit_id 	= $this->input->post('unit_id');
		$data['year'] = $year;
		
		for($i=0;$i<$count;$i++)
		{
			$emp_id_name 	= "emp_id$i";
			$emp_id 		= $this->input->post($emp_id_name);
			
			$yearly_earn_name 	= "yearly_earn$i";
			$yearly_earn 		= $this->input->post($yearly_earn_name);
			
			$earn_balance_name 	= "earn_balance$i";
			$earn_balance		= $this->input->post($earn_balance_name);
			
			$earn_pay_name 		= "earn_pay$i";
			$earn_pay			= $this->input->post($earn_pay_name);
			
			$paid_amount_name 	= "paid_amount$i";
			$paid_amount		= $this->input->post($paid_amount_name);
			if($earn_pay == "")
			{
				continue;
			}
			if($earn_pay > $earn_balance)
			{
				continue;
			}
			
			$data['unit_id'] 	= $unit_id;
			$data['emp_id'] 	= $emp_id;
			$data['paid_leave'] = $earn_pay;
			$data['paid_amount'] = $paid_amount;
			
			$this->db->insert("pr_earn_leave_paid",$data);
			
		}
	}
	
	function grid_earn_leave_payment_at_atime_db()
	{
		
		$count 	= $this->input->post('count');
		$year 	= $this->input->post('year');
		$unit_id 	= $this->input->post('unit_id');
		$data['year'] = $year;
		
		for($i=0;$i<$count;$i++)
		{
			$emp_id_name 	= "emp_id$i";
			$emp_id 		= $this->input->post($emp_id_name);
			
			$yearly_earn_name 	= "yearly_earn$i";
			$yearly_earn 		= $this->input->post($yearly_earn_name);
			
			$earn_balance_name 	= "earn_balance$i";
			$earn_balance		= $this->input->post($earn_balance_name);
			
			$earn_pay_name 		= "earn_pay$i";
			$earn_pay			= $this->input->post($earn_pay_name);
			
			$paid_amount_name 	= "paid_amount$i";
			$paid_amount		= $this->input->post($paid_amount_name);
			if($earn_pay == "")
			{
				continue;
			}
			if($earn_pay > $earn_balance)
			{
				continue;
			}
			$data['unit_id'] 	= $unit_id;
			$data['emp_id'] 	= $emp_id;
			$data['paid_leave'] = $earn_pay;
			$data['paid_amount'] = $paid_amount;
			
			$this->db->insert("pr_earn_leave_paid",$data);
		}
	}
	
	function get_leave_record($emp_id, $process_year, $earn_data)
	{
		$leave_types = array('cl','sl','el','ml');
		foreach($leave_types as $leave_type)
		{
			$this->db->select('emp_id');	
			$this->db->where('emp_id', $emp_id);
			$this->db->where('leave_type', $leave_type);
			$this->db->like('start_date', $process_year);
			$query = $this->db->get('pr_leave_trans');
			$earn_data[$leave_type] =  $query->num_rows();
		}
		return $earn_data;
	}
	
	function salary_process_eligibility($emp_id, $process_year)
	{
		$join_check 	= $this->join_range_check($emp_id, $process_year);
		$resign_check 	= $this->resign_range_check($emp_id, $process_year);
		$left_check 	= $this->left_range_check($emp_id, $process_year);
		$zero_gross_check 	= $this->zero_gross_check($emp_id);
		
		
		if($join_check != false and $resign_check != false and $left_check != false and $zero_gross_check != false )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function zero_gross_check($emp_id)
	{
		$this->db->select('gross_sal');
		$this->db->where('emp_id', $emp_id);
		$this->db->where("gross_sal !=","0");
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
	
	function join_range_check($emp_id, $process_year)
	{
		$this->db->select('emp_join_date');
		$this->db->where('emp_id', $emp_id);
		$this->db->where("trim(substr(emp_join_date,1,4)) <= '$process_year'");
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
	
	function resign_range_check($emp_id, $process_year)
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
			$this->db->where("trim(substr(resign_date,1,4)) >= '$process_year'");
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
	
	function left_range_check($emp_id, $process_year)
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
			$this->db->where("trim(substr(left_date,1,4)) >= '$process_year'");
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