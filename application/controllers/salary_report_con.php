<?php
class Salary_report_con extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->model('grid_model');
		$this->load->model('mars_model');
		$this->load->model('leave_model');
		$this->load->model('acl_model');
		$access_level = 8;
		$acl = $this->acl_model->acl_check($access_level);
	}
	
	function grid_salary_report()
	{
		$this->load->view('grid_salary_report');
	}
	
	function grid_earn_leave_report_new(){
		$sal_year_month = $this->input->post('sal_year_month');
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$data["value"] = $this->grid_model->grid_earn_leave_report_new($sal_year_month, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		
		$this->load->view('earn_leave_report',$data);
	}
	
	function sal_summary_with_ot_eot(){
		$salary_month = $this->uri->segment(3);
		$grid_status = $this->uri->segment(4);
		$ot_eot = $this->uri->segment(5);
		$data["values"] = $this->grid_model->sal_summary_with_ot_eot($salary_month,$grid_status);
		$data["salary_month"] = $salary_month;
		if ($ot_eot=='ot_sum') {
			$this->load->view('sal_summary_with_ot',$data);
		}elseif($ot_eot=='eot_sum'){
			$this->load->view('sal_summary_with_eot',$data);
		}
	}
	function sal_summary_with_ot_eot_date_between(){
		// $salary_month = $this->uri->segment(3);
		// $grid_status = $this->uri->segment(4);
		$first_date = $this->uri->segment(5);
		$second_date = $this->uri->segment(6);
		$data["values"] = $this->grid_model->sal_summary_with_ot_eot_date_between($first_date, $second_date);
		$data["first_date"] =  date('Y-m-d',strtotime($first_date));
		$data["second_date"] = date('Y-m-d',strtotime($second_date));
		$this->load->view('sal_summary_with_ot_eot_date_between',$data);
		
	}
	
	function grid_monthly_salary_sheet()
	{
		$sal_year_month = $this->uri->segment(3);
		$grid_status 	= $this->uri->segment(4);		
		$grid_data 		= $this->uri->segment(5);
		$grid_section 	= $this->uri->segment(6);
		$grid_line 		= $this->uri->segment(7);
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
						
		$data["value"] = $this->grid_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;
		$data["grid_section"] = $grid_section;
		$data["grid_line"] = $grid_line;
		// print_r($data);exit();
		$this->load->view('salary_sheet',$data);
	}
	
	function grid_staff_salary_sheet()
	{
		$sal_year_month = $this->uri->segment(3);
		$grid_status 	= $this->uri->segment(4);		
		$grid_data 		= $this->uri->segment(5);
		$grid_section 		= $this->uri->segment(6);
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
						
		$data["value"] = $this->grid_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;
		$data["grid_section"] = $grid_section;
		
		$this->load->view('salary_sheet_for_staff',$data);
	}
	
	function grid_monthly_eot_sheet()
	{
		$sal_year_month = $this->uri->segment(3);
		$grid_status 	= $this->uri->segment(4);		
		$grid_data 		= $this->uri->segment(5);
		$grid_section 		= $this->uri->segment(6);
		$grid_line 		= $this->uri->segment(7);
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		// print_r($grid_line);exit('alissss');
		
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
						
		$data["value"] = $this->grid_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_section"] = $grid_section;
		$data["grid_line"] = $grid_line;
		$data["grid_status"]  = $grid_status;
		
		$this->load->view('salary_sheet_for_eot',$data);
	}
	
	function grid_monthly_eot_sheet_10pm()
	{
		$sal_year_month  = $this->input->post('sal_year_month');
		$grid_section = $this->input->post('grid_section');
		$grid_line = $this->input->post('grid_line');
		$grid_status = $this->input->post('grid_status');
		$grid_data       = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
						
		$data["value"] = $this->grid_model->grid_monthly_eot_sheet_10pm($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_section"] = $grid_section;
		$data["grid_line"] = $grid_line;
		$data["grid_status"]  = $grid_status;
		
		$this->load->view('grid_monthly_eot_sheet_10pm',$data);
	}
	
	function grid_actual_monthly_salary_sheet()
	{
		$sal_year_month = $this->uri->segment(3);
		$grid_status 	= $this->uri->segment(4);		
		$grid_data 		= $this->uri->segment(5);
		$grid_section 		= $this->uri->segment(6);
		$grid_line 		= $this->uri->segment(7);
		// print_r($grid_line);exit('alissss');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
						
		$data["value"] = $this->grid_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_section"] = $grid_section;
		$data["grid_status"]  = $grid_status;
		$data["grid_line"]  = $grid_line;
	/*echo "<pre>";		
		print_r($data);exit('ali');*/
		$this->load->view('salary_sheet_actual',$data);
	}

	function grid_actual_monthly_salary_sheet_without_ot()
	{
		$sal_year_month = $this->uri->segment(3);
		$grid_status 	= $this->uri->segment(4);		
		$grid_data 		= $this->uri->segment(5);
		$grid_section 		= $this->uri->segment(6);
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
						
		$data["value"] = $this->grid_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_section"] = $grid_section;
		$data["grid_status"]  = $grid_status;
	 // exit('ali');
		
		$this->load->view('salary_sheet_without_ot',$data);
	}
	
	function grid_actual_monthly_salary_sheet_with_eot()
	{
		$sal_year_month = $this->uri->segment(3);
		$grid_status 	= $this->uri->segment(4);		
		$grid_data 		= $this->uri->segment(5);
		$grid_section 		= $this->uri->segment(6);
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
						
		$data["value"] = $this->grid_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;
		$data["grid_section"]  = $grid_section;
		
		$this->load->view('salary_sheet_actual_with_eot',$data);
	}
	
	function grid_festival_bonus()
	{
		$sal_year_month = $this->uri->segment(3);
		$grid_status 	= $this->uri->segment(4);		
		$grid_data 		= $this->uri->segment(5);
		$grid_line 		= $this->uri->segment(6);
		$grid_section 		= $this->uri->segment(7);
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
		$data["value"] = $this->grid_model->grid_festival_bonus($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;
		$data["grid_line"] 	  = $grid_line;
		
		$this->load->view('festival_bonus_report',$data);
	}	

	function grid_festival_bonus_bank()
	{
		$sal_year_month = $_POST['salary_year'];
		$grid_status 	= $_POST['status'];		
		$grid_data 		= $_POST['spl'];
		$grid_line 		= $_POST['line'];
		$grid_section 	= $_POST['section'];
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
		// $data["value"] = $this->grid_model->bank_salary_report($sal_year_month, $grid_status, $grid_emp_id);
		$data["value"] = $this->grid_model->grid_festival_bonus($sal_year_month, $grid_status, $grid_emp_id);

		$data["salary_month"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;
		$data["grid_line"] 	  = $grid_line;
		
		$this->load->view('bank_festival_bonus_report',$data);
	}
	
	function grid_advance_salary_sheet()
	{

		$sal_year_month = $this->uri->segment(3);
		$grid_status 	= $this->uri->segment(4);		
		$grid_data 		= $this->uri->segment(5);
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
		$data["value"] = $this->grid_model->grid_general_info($grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;
		
		$this->load->view('advance_salary_sheet_report_compliance',$data);
	}

	function range_salary_sheet()
	{
		$sal_year_month = $this->uri->segment(3);
		$grid_status 	= $this->uri->segment(4);		
		$grid_data 		= $this->uri->segment(5);
		$grid_section 	= $this->uri->segment(6);
		$grid_line 		= $this->uri->segment(7);
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
		$data["value"] = $this->grid_model->grid_general_info($grid_emp_id);
		
		$data["salary_date1"] = "2023-06-01";
		$data["salary_date2"] = "2023-06-15";
		$data["salary_date"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;
		$data["grid_line"] 	  = $grid_line;
		$data["grid_section"] = $grid_section;



		
		$this->load->view('range_salary_sheet_report',$data);
	}

	function bank_advanced_salary_sheet()
	{
		$sal_year_month = $_POST['salary_year'];
		$grid_status 	= $_POST['status'];		
		$grid_data 		= $_POST['spl'];
		$grid_line 		= $_POST['line'];
		$grid_section 	= $_POST['section'];
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
		$data["value"] = $this->grid_model->grid_general_info($grid_emp_id);
		$data["salary_date1"] = "2023-06-01";
		$data["salary_date2"] = "2023-06-15";
		$data["salary_date"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;
		$data["grid_line"] 	  = $grid_line;
		$data["grid_section"] = $grid_section;
		$this->load->view('bank_advanced_salary_sheet',$data);
	}



	function advance_monthly_salary_sheet()
	{
		$sal_year_month = $this->uri->segment(3);
		$grid_status 	= $this->uri->segment(4);		
		$grid_data 		= $this->uri->segment(5);
		$grid_section 		= $this->uri->segment(6);
		$grid_line 		= $this->uri->segment(7);
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		
						
		$data["value"] = $this->grid_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;
		$data["grid_section"] = $grid_section;
		$data["grid_line"] 	  = $grid_line;
		
		$this->load->view('advance_monthly_salary_sheet',$data);
	}
	
	function get_deduct_status()
	{
		$this->db->select('deduct_status');
		$this->db->where("id",1);
		$query_ded = $this->db->get('pr_deduct_status');
		$rows_deduct = $query_ded->row();
		$deduct_status = $rows_deduct ->deduct_status;
		return $deduct_status;
	}
	
	function salary_summary()
	{
		$salary_month = $this->uri->segment(3);
		$grid_status = $this->uri->segment(4);
		$data["values"] = $this->grid_model->salary_summary($salary_month,$grid_status);
		$data["salary_month"] = $salary_month; 
		//print_r($data);
		$this->load->view('salary_summary',$data);
	}
	
	function grid_pay_slip()
	{
		$grid_firstdate = $this->uri->segment(3);
		$grid_data = $this->uri->segment(4);
		$grid_emp_id = explode('xxx', trim($grid_data));
		
		$year_month = date("Y-m", strtotime($grid_firstdate)); 
		
		$query['values'] = $this->grid_model->grid_pay_slip($year_month, $grid_emp_id);
		/*echo"<pre>";
		print_r($query);exit('ali');*/
		if(is_string($query['values']))
		{
			echo $query['values'];
		}
		else
		{
			$this->load->view('pay_slip',$query);
		}
	}	
	function grid_pay_slip_without_ot()
	{
		$grid_firstdate = $this->uri->segment(3);
		$grid_data = $this->uri->segment(4);
		$grid_emp_id = explode('xxx', trim($grid_data));
		
		$year_month = date("Y-m", strtotime($grid_firstdate)); 
		
		$query['values'] = $this->grid_model->grid_pay_slip($year_month, $grid_emp_id);
		if(is_string($query['values']))
		{
			echo $query['values'];
		}
		else
		{
			$this->load->view('pay_slip_without_ot',$query);
		}
	}
	function advance_pay_slip()
	{
		$grid_firstdate = $this->uri->segment(3);
		$grid_data = $this->uri->segment(4);
		$grid_emp_id = explode('xxx', trim($grid_data));
		
		$year_month = date("Y-m", strtotime($grid_firstdate)); 
		
		$query['values'] = $this->grid_model->grid_pay_slip($year_month, $grid_emp_id);
		if(is_string($query['values']))
		{
			echo $query['values'];
		}
		else
		{
			$this->load->view('pay_slip_advance',$query);
		}
	}
	function grid_provident_fund()
	{
		$this->load->model('salary_process_model');
		$grid_firstdate = $this->uri->segment(3);
		$grid_data = $this->uri->segment(4);
		$grid_emp_id = explode('xxx', trim($grid_data));
		
		$year_month = date("Y-m", strtotime($grid_firstdate)); 
		$query["salary_month"] = $grid_firstdate;
		$query['values'] = $this->grid_model->grid_provident_fund($year_month, $grid_emp_id);
		if(is_string($query['values']))
		{
			echo $query['values'];
		}
		else
		{
			$this->load->view('provident_fund',$query);
		}
	}
	
	function grid_maternity_benefit()
	{
		$grid_data = $this->uri->segment(3);
		$grid_emp_id = explode('xxx', trim($grid_data));
						
		$data["values"] = $this->leave_model->grid_maternity_benefit($grid_emp_id);
			
		$this->load->view('maternity_benefit',$data);
	}
	
	function grid_earn_leave()
	{
		$sal_year_month = $this->uri->segment(3);
		$grid_status 	= $this->uri->segment(4);		
		$grid_data 		= $this->uri->segment(5);
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
						
		$data["value"] = $this->grid_model->grid_earn_leave($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;
		
		//$this->load->view('salary_sheet_actual_with_eot',$data);
	}	
	
	function eot_summary_report()
	{
		$salary_month = $this->uri->segment(3);
		$grid_status = $this->uri->segment(4);
		$data["values"] = $this->grid_model->eot_summary_report($salary_month,$grid_status);
		$data["salary_month"] = $salary_month; 
		$data["grid_status"] = $grid_status; 
		//print_r($data);
		$this->load->view('eot_summary',$data);
	}
	/*ZuelAli,211109*/
	function grid_half_ot_sheet(){
		$sal_year_month = $this->uri->segment(3);
		$salDate = date('Y-m-d',strtotime($sal_year_month));
		if($salDate > '2021-01-01' && $salDate <= '2021-10-01'){
			/*ZuelAli, This calculation implement in Salary Process that's whay this conditions*/
			$grid_status 	= $this->uri->segment(4);		
			$grid_data 		= $this->uri->segment(5);
			$grid_section 		= $this->uri->segment(6);
			$grid_line 		= $this->uri->segment(7);
			$grid_emp_id = explode('xxx', trim($grid_data));
			$this->load->model('common_model');
			//print_r($grid_emp_id);
			$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
							
			// $data["value"] = $this->grid_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);
			$data["value"] = $this->grid_model->grid_half_ot_sheet($sal_year_month, $grid_status, $grid_emp_id);
			$data["salary_month"] = $sal_year_month;
			$data["grid_section"] = $grid_section;
			$data["grid_line"] = $grid_line;
			$data["grid_status"]  = $grid_status;
			// echo "<pre>";
			// print_r($data);exit();
			$this->load->view('salary_half_ot_sheet',$data);
		}else{
			exit('Data Not Found!');
		}
	}

	function grid_absent_basic_amt(){
		$sal_year_month = $this->uri->segment(3);
		$grid_data 		= $this->uri->segment(4);
		$grid_line 		= $this->uri->segment(5);
		$grid_emp_id = explode('xxx', trim($grid_data));
		$salDate = date('Y-m-d',strtotime($sal_year_month));
		if($salDate > '2021-01-01' && $salDate <= '2021-10-01'){
			/*ZuelAli, This calculation implement in Salary Process that's whay this conditions*/
			$this->load->model('common_model');
							
			$data["value"] = $this->grid_model->grid_absent_basic_amt($sal_year_month,$grid_emp_id);
			$data["salary_month"] = $sal_year_month;
			$data["grid_line"] = $grid_line;
			// echo "<pre>";
			// print_r($data);exit();
			$this->load->view('salary_absent_basic_amt',$data);
		}else{
			exit('Data Not Found!');
		}
	}

	// new customization of 2022-07-27
	function bank_salary_report(){
		$sal_year_month  = $this->input->post('sal_year_month');
		$grid_status      = $this->input->post('grid_status');
		$grid_data       = $this->input->post('spl');
		$grid_emp_id     = explode('xxx', trim($grid_data));

		$this->load->model('common_model');
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
						
		$data["value"] = $this->grid_model->bank_salary_report($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;
		// echo(count($data["value"])); die;

		$this->load->view('bank_salary_report',$data);
	}

	function bank_eot_sheet()
	{
		$sal_year_month  = $this->input->post('sal_year_month');
		$grid_status      = $this->input->post('grid_status');
		$grid_data       = $this->input->post('spl');
		$grid_emp_id     = explode('xxx', trim($grid_data));

		$this->load->model('common_model');
		
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
						
		$data["value"] = $this->grid_model->bank_eot_sheet($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;
		
		$this->load->view('bank_eot_sheet',$data);
	}
	
}

