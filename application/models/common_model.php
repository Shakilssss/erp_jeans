<?php
class Common_model extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
	}
	
	function salary_structuresssss($gross_salary)
	{
		$data = array();
		
		$data['medical_allow'] 	= 600;
		$data['trans_allow'] 	= 350;
		$data['food_allow'] 	= 900;
		$total_salary_allow 	= $data['medical_allow'] + $data['trans_allow'] + $data['food_allow'];
		$data['gross_salary'] 	= $gross_salary;
		
		$data['basic_sal'] 	   = round(($gross_salary - $total_salary_allow) / 1.5);
		$data['house_rent']    = round($data['basic_sal'] * 50 / 100);
		$data['ot_rate']       = round(($data['basic_sal'] * 2  / 208),2);
		return $data;
	}
	
	function salary_structure($gross_salary, $date = null)
	{
		if (empty($date)) {
			$date = date('Y-m-d');
		}
		
		$data = array();
		if($date < '2023-11-30')
		{
			$data['medical_allow'] 	= 600;
			$data['trans_allow'] 	= 350;
			$data['food_allow'] 	= 900;
			$total_salary_allow 	= $data['medical_allow'] + $data['trans_allow'] + $data['food_allow'];
			$data['gross_salary'] 	= $gross_salary;
			$basic_salary 			= (($gross_salary - $total_salary_allow) / 1.5);
			$data['basic_sal'] 	   = round($basic_salary);
			$data['house_rent']    = round($basic_salary * 50 / 100);
			$data['ot_rate']       = round(($data['basic_sal'] * 2  / 208),2);
			//$data['ot_rate']       = round(($gross_salary - $data['basic_sal']/1.5 * 208),2);
			$data['stamp'] = 0;
			
		}else{
			
			$data['medical_allow'] 	= 750;
			$data['trans_allow'] 	= 450;
			$data['food_allow'] 	= 1250;
			$total_salary_allow 	= $data['medical_allow'] + $data['trans_allow'] + $data['food_allow'];
			$data['gross_salary'] 	= $gross_salary;
			$basic_salary 			= (($gross_salary - $total_salary_allow) / 1.5);
			$data['basic_sal'] 	   = round($basic_salary);
			$data['house_rent']    = round($basic_salary * 50 / 100);
			$data['ot_rate']       = round(($data['basic_sal'] * 2  / 208),2);
			$data['stamp'] = 0;
			
		}
		
		return $data;
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
	
	function allowance_bills($id)
	{
		$data = array();
		$this->db->select('*');
		$this->db->where("id",$id);
		$query = $this->db->get('pr_allowance_bills');
		foreach($query->result() as $rows)
		{
			$data['first_tiffin_allo_min'] = $rows ->first_tiffin_allo_min;
			$data['second_tiffin_allo_min'] = $rows ->second_tiffin_allo_min;
			$data['night_allo_min'] = $rows ->night_allo_min;
			$data['first_tiffin_allo_amount'] = $rows ->tiffin_allo_amount;
			$data['second_tiffin_allo_amount'] = $rows ->tiffin_allo_amount;
			$data['night_allo_amount'] = $rows ->night_allo_amount;
			//echo $rows ->first_tiffin_allo_min;
		}
		
		return $data;
	}
	
	function get_ot_title($emp_id)
	{
		$this->db->select('ot_entitle');
		$this->db->where('emp_id',$emp_id);
		$query = $this->db->get('pr_emp_com_info');
		$row = $query->row();
		return $row->ot_entitle;
	}
	
	function get_service_month($effective_date,$doj)
	{
		$date_diff 		= strtotime($effective_date)-strtotime($doj);
		//DATE TO DATE RULE
		return $month 	= floor(($date_diff)/2592000);
		
		//MONTH TO MONTH RULE
		//return $month 	= ceil(($date_diff)/2628000);
	}
	function  get_prev_month($probation_period,$year_month)
	{	
		$text ="-".$probation_period."month";
		$prev_month = strtotime($text, strtotime($year_month));
		$prev_month = date("Y-m", $prev_month);
		return $prev_month;
	}
	function get_gross_salary($emp_id)
	{
		$this->db->select('gross_sal');
		$this->db->where('emp_id',$emp_id);
		$query = $this->db->get('pr_emp_com_info');
		$row = $query->row();
		return $row->gross_sal;
	}
	
	function company_information($select_value)
	{
		$query 	= $this->db->select($select_value)->get('company_infos');
		$row 	= $query->row();
		return $row->$select_value;
	}
	function company_all_information(){
		$query 	= $this->db->select('*')->get('company_infos')->row();
		return $query;
	}
	
	function get_left_emp($salary_month)
	{
		$i = 1;
		$this->db->select('pr_emp_left_history.emp_id');
		$this->db->from('pr_emp_left_history');
		$this->db->where("trim(substr(pr_emp_left_history.left_date,1,7)) <= '$salary_month'");
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		  foreach ($query->result() as $row)
		  {
			  $emp_id[] = $row->emp_id;
			  //echo "$i .$row->emp_id<br>";
			  //$i = $i + 1;
			  
		  }
		  return $emp_id ;
		}
		else
		{
			return $emp_id[] = '';
		}
	}
	function get_promote_emp($salary_month)
	{
		$status = "2";
		$this->db->select('pr_incre_prom_pun.prev_emp_id');
		$this->db->from('pr_incre_prom_pun');
		$this->db->where("trim(substr(pr_incre_prom_pun.effective_month,1,7)) <= '$salary_month'");
		$this->db->where("pr_incre_prom_pun.status",$status);
		$this->db->where('pr_incre_prom_pun.prev_emp_id != pr_incre_prom_pun.new_emp_id');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		  foreach ($query->result() as $row)
		  {
			  $emp_id[] = $row->prev_emp_id;
			  //echo "$i .$row->emp_id<br>";
			  //$i = $i + 1;
		  }
		  return $emp_id ;
		}
		else
		{
			return $emp_id[] = '';
		}
	}
	function get_resign_emp($salary_month)
	{
		$i = 1;
		$this->db->select('pr_emp_resign_history.*');
		$this->db->from('pr_emp_resign_history');
		$this->db->where("trim(substr(pr_emp_resign_history.resign_date,1,7)) <= '$salary_month'");
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		  foreach ($query->result() as $row)
		  {
			  $emp_id[] = $row->emp_id;
			  //echo "$i .$row->emp_id<br>";
			  //$i = $i + 1;
			  
		  }
		  return $emp_id ;
		}
		else
		{
			return $emp_id[] = '';
		}
	}
	function get_all_employee_for_selection($dept,$section,$line,$desig,$sex,$status,$salary_month){
		$get_left_emp = $this->get_left_emp_all_sts($salary_month);
		$get_resign_emp = $this->get_resign_emp_all_sts($salary_month);
		$get_promote_emp = $this->get_promote_emp_all($salary_month);
		$i = 1;
		$this->db->select('pr_emp_per_info.*');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_emp_per_info');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');

		if($dept !="Select"){$this->db->where("pr_emp_com_info.emp_dept_id", $dept);}
		if($section !="Select"){$this->db->where("pr_emp_com_info.emp_sec_id", $section);}
		if($line !="Select"){$this->db->where("pr_emp_com_info.emp_line_id ", $line);}
		if($desig !="Select"){$this->db->where("pr_emp_com_info.emp_desi_id", $desig);}
		if($sex !="Select"){$this->db->where("pr_emp_per_info.emp_sex", $sex);}

		$this->db->where("trim(substr(pr_emp_com_info.emp_join_date,1,7)) <= '$salary_month'");
		$this->db->where_not_in('pr_emp_com_info.emp_id',$get_left_emp);
		$this->db->where_not_in('pr_emp_com_info.emp_id',$get_resign_emp);
		$this->db->where_not_in('pr_emp_com_info.emp_id',$get_promote_emp);
		$this->db->order_by('pr_emp_com_info.emp_id');
		$query = $this->db->get();
		return $query;
	}
	function get_new_employee_for_selection($dept,$section,$line,$desig,$sex,$status,$salary_month)
	{
		$probation_period 	= $this->get_setup_attributes(8);
		$prev_prob_month 	= $this->get_prev_month($probation_period,$salary_month);
		$get_left_emp 		= $this->get_left_emp($salary_month);
		$get_resign_emp 	= $this->get_resign_emp($salary_month);
		$i = 1;
		$this->db->select('pr_emp_per_info.*');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_emp_per_info');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');

		if($dept !="Select"){$this->db->where("pr_emp_com_info.emp_dept_id", $dept);}
		if($section !="Select"){$this->db->where("pr_emp_com_info.emp_sec_id", $section);}
		if($line !="Select"){$this->db->where("pr_emp_com_info.emp_line_id ", $line);}
		if($desig !="Select"){$this->db->where("pr_emp_com_info.emp_desi_id", $desig);}
		if($sex !="Select"){$this->db->where("pr_emp_per_info.emp_sex", $sex);}
		
		$this->db->where("trim(substr(pr_emp_com_info.emp_join_date,1,7)) <= '$salary_month'");
		$this->db->where("trim(substr(pr_emp_com_info.emp_join_date,1,7)) >= '$prev_prob_month'");
		$this->db->where_not_in('pr_emp_com_info.emp_id',$get_left_emp);
		$this->db->where_not_in('pr_emp_com_info.emp_id',$get_resign_emp);
		$this->db->order_by('pr_emp_com_info.emp_id');
		$query = $this->db->get();
		return $query;
		/*echo $this->db->last_query();
		foreach ($query->result() as $row)
		{
			$emp_id = $row->emp_id;
			echo "$i .$emp_id<br>";
			$i = $i + 1;
		}*/
	}
	function get_regular_employee_for_selection($dept,$section,$line,$desig,$sex,$status,$salary_month)
	{
		$probation_period 	= $this->get_setup_attributes(8);
		$prev_prob_month 	= $this->get_prev_month($probation_period,$salary_month);
		$get_left_emp 		= $this->get_left_emp($salary_month);
		$get_resign_emp 	= $this->get_resign_emp($salary_month);
		$get_promote_emp = $this->get_promote_emp($salary_month);
		$i = 1;
		$this->db->select('pr_emp_per_info.*');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_emp_per_info');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		if($dept !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_dept_id", $dept);
		}
		if($section !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_sec_id", $section);
		}
		if($line !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_line_id ", $line);
		}
		if($desig !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_desi_id", $desig);
		}
		if($sex !="Select")
		{
			$this->db->where("pr_emp_per_info.emp_sex", $sex);
		}
		//$this->db->where("trim(substr(pr_emp_com_info.emp_join_date,1,7)) < '$prev_prob_month'");

		$this->db->where("trim(substr(pr_emp_com_info.emp_join_date,1,7)) != '$prev_prob_month'"); // without new emp this month
		$this->db->where("trim(substr(pr_emp_com_info.emp_join_date,1,7)) <= '$salary_month'");
		$this->db->where_not_in('pr_emp_com_info.emp_id',$get_left_emp);
		$this->db->where_not_in('pr_emp_com_info.emp_id',$get_resign_emp);
		$this->db->where_not_in('pr_emp_com_info.emp_id',$get_promote_emp);
		$this->db->order_by('pr_emp_com_info.emp_id');
		$query = $this->db->get();
		return $query;
		/*foreach ($query->result() as $row)
		{
			$emp_id[] = $row->emp_id;
			//echo "$i .$emp_id<br>";
			//$i = $i + 1;
		}
		return $emp_id;*/
	}
	
	function get_left_employee_for_selection($dept,$section,$line,$desig,$sex,$status,$salary_month){
		//echo $salary_month;
		$this->db->select('pr_emp_per_info.*');
		$this->db->from('pr_emp_left_history');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_emp_per_info');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_left_history.emp_id');

		if($dept !="Select"){$this->db->where("pr_emp_com_info.emp_dept_id", $dept);}
		if($section !="Select"){$this->db->where("pr_emp_com_info.emp_sec_id", $section);}
		if($line !="Select"){$this->db->where("pr_emp_com_info.emp_line_id ", $line);}
		if($desig !="Select"){$this->db->where("pr_emp_com_info.emp_desi_id", $desig);}
		if($sex !="Select"){$this->db->where("pr_emp_per_info.emp_sex", $sex);}
		
		$this->db->where("trim(substr(pr_emp_left_history.left_date,1,7)) = '$salary_month'");
		$this->db->order_by('pr_emp_com_info.emp_id');
		$query = $this->db->get();
		return $query;
		/*echo $this->db->last_query();
		foreach ($query->result() as $row)
		{
			$emp_id = $row->emp_id;
			echo "$i .$emp_id<br>";
			$i = $i + 1;
		}*/
	}
	
	function get_resign_employee_for_selection($dept,$section,$line,$desig,$sex,$status,$salary_month)
	{
		
		$this->db->select('pr_emp_per_info.*');
		$this->db->from('pr_emp_resign_history');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_resign_history.emp_id');
		if($dept !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_dept_id", $dept);
		}
		if($section !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_sec_id", $section);
		}
		if($line !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_line_id ", $line);
		}
		if($desig !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_desi_id", $desig);
		}
		if($sex !="Select")
		{
			$this->db->where("pr_emp_per_info.emp_sex", $sex);
		}
		$this->db->where("trim(substr(pr_emp_resign_history.resign_date,1,7)) = '$salary_month'");
		$this->db->order_by('pr_emp_com_info.emp_id');
		$query = $this->db->get();
		return $query;
		/*echo $this->db->last_query();
		foreach ($query->result() as $row)
		{
			$emp_id = $row->emp_id;
			echo "$i .$emp_id<br>";
			$i = $i + 1;
		}*/
	}
	
	
	
	
	//================================== Below Code Written For ALL Status=============================
	//=================================================================================================
	function get_all_employee($salary_month)
	{
		$get_left_emp = $this->get_left_emp_all_sts($salary_month);
		$get_resign_emp = $this->get_resign_emp_all_sts($salary_month);
		$get_promote_emp = $this->get_promote_emp_all($salary_month);
		//print_r($get_resign_emp);
		$i = 1;
		$this->db->select('pr_emp_per_info.*');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_emp_per_info');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where("trim(substr(pr_emp_com_info.emp_join_date,1,7)) <= '$salary_month'");
		$this->db->where_not_in('pr_emp_com_info.emp_id',$get_left_emp);
		$this->db->where_not_in('pr_emp_com_info.emp_id',$get_resign_emp);
		$this->db->where_not_in('pr_emp_com_info.emp_id',$get_promote_emp);
		
		$this->db->order_by('pr_emp_com_info.emp_id');
		$query = $this->db->get();
		// print_r($query->result());exit();
		return $query;
		/*foreach ($query->result() as $row)
		{
			$emp_id[] = $row->emp_id;
			//echo "$i .$emp_id<br>";
			//$i = $i + 1;
		}
		return $emp_id;*/
	}
	function get_left_emp_all_sts($salary_month)
	{
		$i = 1;
		$this->db->select('pr_emp_left_history.emp_id');
		$this->db->from('pr_emp_left_history');
		$this->db->where("trim(substr(pr_emp_left_history.left_date,1,7)) < '$salary_month'");
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		  foreach ($query->result() as $row)
		  {
			  $emp_id[] = $row->emp_id;
			  //echo "$i .$row->emp_id<br>";
			  //$i = $i + 1;
			  
		  }
		  return $emp_id ;
		}
		else
		{
			return $emp_id[] ='';
		}
	}
	function get_resign_emp_all_sts($salary_month)
	{
		$emp_id = array();
		$i = 1;
		$this->db->select('pr_emp_resign_history.*');
		$this->db->from('pr_emp_resign_history');
		$this->db->where("trim(substr(pr_emp_resign_history.resign_date,1,7)) < '$salary_month'");
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		  foreach ($query->result() as $row)
		  {
			  $emp_id[] = $row->emp_id;
			  //echo "$i .$row->emp_id<br>";
			  //$i = $i + 1;
			  
		  }
		  return $emp_id ;
		}
		else
		{
			return $emp_id[] = '';
		}
		
	}
	function get_promote_emp_all($salary_month)
	{
		$status = "2";
		$this->db->select('pr_incre_prom_pun.prev_emp_id');
		$this->db->from('pr_incre_prom_pun');
		$this->db->where("trim(substr(pr_incre_prom_pun.effective_month,1,7)) <= '$salary_month'");
		$this->db->where("pr_incre_prom_pun.status",$status);
		$this->db->where('pr_incre_prom_pun.prev_emp_id != pr_incre_prom_pun.new_emp_id');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		  foreach ($query->result() as $row)
		  {
			  $emp_id[] = $row->prev_emp_id;
			  //echo "$i .$row->emp_id<br>";
			  //$i = $i + 1;
		  }
		  return $emp_id ;
		}
		else
		{
			return $emp_id[] = '' ;
		}
	}
	function get_weekend_days($weekend_day,$days,$start_date,$emp_id )
	{
		//echo "$weekend==$days==$start_date/////";
		$no_weekends = 0;
		$total_weekend_ot_hour = 0;
		$total_weekend_absent = 0;
		$total_weekend_present = 0;
		$weekend = array();
		for($i=0;$i<$days;$i++)
		{
			$date = strtotime(date("Y-m-d", strtotime($start_date)) . " +$i day");
			$actual_date = date("Y-m-d", strtotime($start_date. " +$i days"));
			$new_date = date("D",$date);

			 if($new_date == $weekend_day)
			 {
				  //echo "$actual_date==";
				  $no_weekends = $no_weekends +1;
				  $weekend['wk_date'][] = $actual_date;
				  
				  $weekend_ot_hour = $this->weekend_ot_hour($emp_id,$actual_date);
				  $total_weekend_ot_hour = $weekend_ot_hour + $total_weekend_ot_hour;
				  
				  $weekend_absent = $this->weekend_present_status($emp_id,"A",$actual_date);
				  $total_weekend_absent = $weekend_absent + $total_weekend_absent;
				  
				  $weekend_present = $this->weekend_present_status($emp_id,"P",$actual_date);
				  $total_weekend_present = $weekend_present + $total_weekend_present;
			 }
			
		}
		//echo $no_weekends;
		 $weekend['no_weekends'] =  $no_weekends;
		 $weekend['total_weekend_ot_hour'] =  $total_weekend_ot_hour;
		 $weekend['total_weekend_absent'] =  $total_weekend_absent;
		 $weekend['total_weekend_present'] =  $total_weekend_present;
		return $weekend;
	}
	function weekend_present_status($emp_id,$present_status,$actual_date)
	{
		
		$search_date =trim(substr($actual_date,0,7));
		$loop_date = trim(substr($actual_date,8,2));
		$idate = "date_$loop_date";
		$this->db->select("");
		$this->db->where("emp_id",$emp_id);
		$this->db->like("att_month",$search_date);
		$query = $this->db->get("pr_attn_monthly");
		//echo $this->db->last_query();
		$count = 0;
		foreach($query->result() as $rows)
		{
			$status = $rows->$idate;
				
				if($status == "$present_status")
				{
					$count++;
				}
		}
		return $count;
	}
	function weekend_ot_hour($emp_id,$actual_date)
	{
		$this->db->select("ot_hour");
		$this->db->where("emp_id", $emp_id);
		$this->db->like("shift_log_date",$actual_date);
		$query = $this->db->get("pr_emp_shift_log");
		//echo $this->db->last_query();
		$num_rows = $query->num_rows();
		if($num_rows == 0)
		{
			$ot_hour = 0;
			
		}
		else
		{
			$row = $query->row();
			$ot_hour = $row->ot_hour;
		}
		return $ot_hour;
	}
	
	function holiday_attendance_check($emp_id,$present_status,$num_of_days, $start_date)
	{
		$holiday = array();
		$count = 0;
		$search_date =trim(substr($start_date,0,7));
		$loop_date = trim(substr($start_date,8,2));
		 
		$this->db->select("");
		$this->db->where("emp_id",$emp_id);
		$this->db->like("att_month",$search_date);
		$query = $this->db->get("pr_attn_monthly");
		//echo $this->db->last_query();
		$count = 0;
		foreach($query->result_array() as $rows => $value)
		{
			for($i=$loop_date; $i<= $num_of_days ; $i++)
			{
				//echo "$i==";
				$idate = date("d", mktime(0, 0, 0, 0, $i, 0));
				$date="date_$idate";
				$actual_date = "$search_date-$i";
				$con_actual_date =  date("Y-m-d", strtotime($actual_date));
				
				if($value[$date] == "$present_status")
				{
					$count = $count +1;
					$holiday['h_date'][] = $con_actual_date;
				}
			}
		}
		$holiday['h_count'] = $count;
		return $holiday;
	}
}


	function get_bangla_month($month)
	{
		switch ($month) {
		    case 1:
		        return "Rvbyqvwi";
		        break;
		    case 2:
		        return "‡deªyqvwi";
		        break;
		    case 3:
		        return "gvP©";
		        break;
		    case 4:
		        return "GwcÖj";
		        break;
		    case 5:
		        return "‡g";
		        break;
		    case 6:
		        return "Ryb";
		        break;
		    case 7:
		        return "RyjvB";
		        break;
		    case 8:
		        return "AvM÷";
		        break;
		    case 9:
		        return "‡m‡Þ¤^i";
		        break;
		    case 10:
		        return "A‡±vei";
		        break;
		    case 11:
		        return "b‡f¤^i";
		        break;
		    default:
		        return "wW‡m¤^i";
		        break;
		}
	}
?>