<?php
class Grid_con extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->model('grid_model');
		$this->load->model('acl_model');
		$this->load->model('common_model');
		$access_level = 5;
		$acl = $this->acl_model->acl_check($access_level);
	}

	// function testConnection(){
	// 	echo phpinfo();
	// 	if($sqlDB = $this->load->database('sqlDB',TRUE)){
	// 		exit('Hi');
	// 	}else{
	// 		exit('Nai');
	// 	}
	// 	$query = $sqlDB->get('GprReportRowData');
	// 	print_r($query);
	// }


	// Zuel Ali, 29-02-2020
	function tempTableDeleteForResignAndLeft(){
		exit('Do not run this Script! It is Danger (X)!26-02-2020--> 3189');
		$this->load->dbforge();
		$currentDate=date('Y-m');
		$previus2MonthDate=date('Y-m-01',strtotime('-12 months',strtotime($currentDate)));
		$query=$this->db->select('emp_id')->where('resign_date < ', $previus2MonthDate)->get('pr_emp_resign_history');
		if ($query->num_rows()>0) {
			foreach ($query->result() as $value) {
				$table_name="temp_$value->emp_id";
				$this->dbforge->drop_table($table_name);
			}
			echo $query->num_rows();
			echo " Table Delete ";
		}
		exit('Done!!!');
	}


	function grid_noc_letter(){

		$mod = $this->input->post('sts');
		$firstdate = $this->input->post('firstdate');
		$seconddate= $this->input->post('seconddate');
		$grid_emp_id = explode('xxx', trim($this->input->post('spl')));

		$query['values'] = $this->grid_model->grid_noc_letter($grid_emp_id,$firstdate,$seconddate,$mod);

		// echo "<pre>";print_r(	$query['values']);exit;

		if(is_string($query['values'])){
			echo $query['values'];
		}else{
			if ($mod==1) {
				$this->load->view('left_letter',$query);
			}elseif ($mod==2) {
				$this->load->view('left_letter2',$query);
			}elseif ($mod==3) {
				$this->load->view('left_letter3',$query);
			}
		}
	}

	public function grid_age_estimation(){
		
		$firstdate= $this->input->post('firstdate');
		$seconddate = $this->input->post('seconddate');
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));

		$data["values"] = $this->grid_model->get_common_emp_info($grid_emp_id);
		// echo count($data['values']);
		// exit;
		if(is_string($data["values"]))
		{
			echo $data["values"];
		}
		else
		{
			$this->load->view('age_estimation',$data);
		}
		
	}

	public function grid_application(){
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		// echo "<pre>";print_r($grid_data);
		// exit;
     
		$data["values"] = $this->grid_model->grid_application($grid_emp_id);
        // print_r($data);
		// exit;
		if(is_string($data["values"]))
		{
			echo $data["values"];
		}
		else
		{
			$this->load->view('application',$data);
		}
	}



		function grid_nominee_form()
	{
		$grid_emp_id = explode('xxx', trim($this->input->post('spl')));
		
		$query['values'] = $this->grid_model->grid_nominee_form($grid_emp_id);
		if(is_string($query['values']))
		{
			echo $query['values'];
		}
		else
		{
			$this->load->view('nominee_form',$query);
		}
	}


	
	function grid_window()
	{
		if($this->session->userdata('level')== 0 || $this->session->userdata('level')== 1)
		{
			$this->load->view('grid');
		}
		elseif($this->session->userdata('level')==2)
		{
			$this->load->view('grid_for_user');
		}
	}
	
	function test_a(){
		$this->salary_process_model->earn_process_new($year='2018', $month='12');
	}

	function grid_salary_report()
	{
		$this->load->view('grid_salary_report');
	}
	
	function grid_get_all_data(){
				$emp_cat_id = array ('0' => 1, '1' => 2, '2' => 5);
				
				$this->db->select('pr_emp_per_info.*');
				$this->db->from('pr_emp_per_info');
				$this->db->from('pr_emp_com_info');
				$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
				$this->db->where_in('pr_emp_com_info.emp_cat_id', $emp_cat_id);
				$this->db->order_by("pr_emp_com_info.emp_id");
				
				$query = $this->db->get();
		
				$i = 0;
				foreach($query->result_array() as $row)
				{
					$responce->rows[$i]['id']=$row['emp_id'];
					$responce->rows[$i]['cell']=array($row['emp_id'],$row['emp_full_name'],$row['emp_dob']);
					$i++;
				}
				echo json_encode($responce);
		  exit;
	}
	
	function grid_all_search()
	{
		$dept 	= $this->uri->segment(3);
		$section= $this->uri->segment(4);
		$line	= $this->uri->segment(5);
		$desig	= $this->uri->segment(6);
		$sex	= $this->uri->segment(7);
		$status	= $this->uri->segment(8);
		
		$this->db->select('pr_emp_per_info.*');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
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
		if($status !="Select")
		{
			if($status != 'ALL')
			{
				$this->db->where("pr_emp_com_info.emp_cat_id", $status);
			}
		}
		$this->db->order_by("pr_emp_com_info.emp_id");
		$query = $this->db->get();
		//echo $this->db->last_query();
		$i = 0;
		foreach($query->result_array() as $row)
		{
			$responce->rows[$i]['id']=$row['emp_id'];
			$responce->rows[$i]['cell']=array($row['emp_id'],$row['emp_full_name'],$row['emp_dob']);
			$i++;
		}
		echo json_encode($responce);
		exit;
		
	}
	function grid_get_all_data_for_salary(){
		$salary_month	= $this->uri->segment(3);
		$i = 0;
		//$salary_month = "2013-05";
		$data = $this->common_model->get_all_employee($salary_month);	
		foreach($data->result_array() as $row)
		{
			$responce->rows[$i]['id']=$row['emp_id'];
			$responce->rows[$i]['cell']=array($row['emp_id'],$row['emp_full_name'],$row['emp_dob']);
			$i++;
		}
		echo json_encode($responce);
		exit;
	}
	
	function grid_all_search_for_salary(){
		$dept 	= $this->uri->segment(3);
		$section= $this->uri->segment(4);
		$line	= $this->uri->segment(5);
		$desig	= $this->uri->segment(6);
		$sex	= $this->uri->segment(7);
		$status	= $this->uri->segment(8);
		$salary_month	= $this->uri->segment(9);
		
		if($status == 1 ){
			$data = $this->common_model->get_regular_employee_for_selection($dept,$section,$line,$desig,$sex,$status,$salary_month);
		}else if($status == 2){
			$data = $this->common_model->get_new_employee_for_selection($dept,$section,$line,$desig,$sex,$status,$salary_month);
		}else if($status == 3){
			$data = $this->common_model->get_left_employee_for_selection($dept,$section,$line,$desig,$sex,$status,$salary_month);
		}else if($status == 4){
			$data = $this->common_model->get_resign_employee_for_selection($dept,$section,$line,$desig,$sex,$status,$salary_month);
		}else if($status == "ALL"){
			$data = $this->common_model->get_all_employee_for_selection($dept,$section,$line,$desig,$sex,$status,$salary_month);
		}
		
		$i = 0;
		foreach($data->result_array() as $row){
			$responce->rows[$i]['id']=$row['emp_id'];
			$responce->rows[$i]['cell']=array($row['emp_id'],$row['emp_full_name'],$row['emp_dob']);
			$i++;
		}
		echo json_encode($responce);
		exit;
	}
	
	function grid_daily_report()
	{


		// echo "<pre>";print($_POST['status']);exit;
		//$year = "2011";
		//$month= "04";
		//$date = "18";
		//$status = "P";
		$grid_date = $this->input->post('firstdate');
		list($date, $month, $year) = explode('-', trim($grid_date));
		//echo "$date, $month, $year";
		$status = $this->input->post('status');
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		//print_r($grid_emp_id);
		$data["values"] = $this->grid_model->grid_daily_report($year, $month, $date, $status, $grid_emp_id);	
		
		$data["year"]			= $year;
		$data["month"]			= $month;
		$data["date"]			= $date;
		$data["daily_status"]	= $status;
		$data["col_desig"] 		= "";
		$data["col_line"] 		= "";
		$data["col_section"] 	= "";
		$data["col_dept"] 		= "";
		$data["col_all"] 		= "";
		if(is_string($data["values"]))
		{
			echo $data["values"];
		}
		else
		{
			$this->load->view('daily_report',$data);
		}
	}
	
	function grid_actual_present_report()
	{
		//$year = "2011";
		//$month= "04";
		//$date = "18";
		//$status = "P";
		$grid_date = $this->input->post('firstdate');
		list($date, $month, $year) = explode('-', trim($grid_date));
		//echo "$date, $month, $year";
		$status = $this->input->post('status');
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		//print_r($grid_emp_id);
		$data["values"] = $this->grid_model->grid_actual_present_report($year, $month, $date, $status, $grid_emp_id);	
		
		$data["year"]			= $year;
		$data["month"]			= $month;
		$data["date"]			= $date;
		$data["daily_status"]	= $status;
		$data["col_desig"] 		= "";
		$data["col_line"] 		= "";
		$data["col_section"] 	= "";
		$data["col_dept"] 		= "";
		$data["col_all"] 		= "";
		if(is_string($data["values"]))
		{
			echo $data["values"];
		}
		else
		{
			$this->load->view('daily_report',$data);
		}
	}
	
	
	function grid_out_time_summary()
	{

		$grid_date = date("Y-m-d", strtotime($this->uri->segment(3)));
		$grid_status = $this->uri->segment(4);
		// $grid_data = $this->uri->segment(5);
		// $grid_emp_id = explode('xxx', trim($grid_data));
		//print_r($grid_emp_id);
		// $data["values"] = $this->grid_model->sal_summary_with_ot_eot($grid_date,$grid_status);
		if (strtotime($grid_date) >= strtotime('2024-03-12') && strtotime($grid_date) <= strtotime('2024-04-12')) {
			$data["values"] = $this->grid_model->grid_out_time_summary_ramadan($grid_date,$grid_status);	
		} else {
			$data["values"] = $this->grid_model->grid_out_time_summary($grid_date,$grid_status);	
		}
		$data["date"]			= $grid_date;
		
		// echo "<pre>";
		// print_r($data["values"]);exit();
		
		if(is_string($data["values"]))
		{
			echo $data["values"];
		}
		else
		{
			if (strtotime($grid_date) >= strtotime('2024-03-12') && strtotime($grid_date) <= strtotime('2024-04-12')) {
				$this->load->view('out_time_summary_ramadan',$data);
			} else {
				$this->load->view('out_time_summary',$data);
			}
		}
	}
	
	function grid_daily_late_report()
	{
		$grid_date = $this->input->post('firstdate');
		list($date, $month, $year) = explode('-', trim($grid_date));
		//echo "$date, $month, $year";
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
				
		$data["values"] = $this->grid_model->grid_daily_late_report($year, $month, $date, $grid_emp_id);
		$data["year"]			= $year;
		$data["month"]			= $month;
		$data["date"]			= $date;
		$data["col_desig"] 		= "";
		$data["col_line"] 		= "";
		$data["col_section"] 	= "";
		$data["col_dept"] 		= "";
		$data["col_all"] 		= "";
		if(is_string($data["values"]))
		{
			echo $data["values"];
		}
		else
		{
			$this->load->view('daily_late_report',$data);
		}		
		//print_r($data);
	}
	
	function grid_daily_out_punch_miss_report()
	{
		$grid_date = $this->input->post('firstdate');
		list($date, $month, $year) = explode('-', trim($grid_date));
		//echo "$date, $month, $year";
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));		
		$data["values"] = $this->grid_model->grid_daily_out_punch_miss_report($year, $month, $date, $grid_emp_id);
		$data["year"]			= $year;
		$data["month"]			= $month;
		$data["date"]			= $date;
		$data["col_desig"] 		= "";
		$data["col_line"] 		= "";
		$data["col_section"] 	= "";
		$data["col_dept"] 		= "";
		$data["col_all"] 		= "";
		if(is_string($data["values"]))
		{
			echo $data["values"];
		}
		else
		{
			$this->load->view('out_punch_miss',$data);
		}		
		//print_r($data);
	}
	
	function grid_daily_out_in_report()
	{
		//$year = "2011";
		//$month= "04";
		//$date = "18";
		//$status = "P";
		$grid_date = $this->input->post('firstdate');
		list($date, $month, $year) = explode('-', trim($grid_date));
		//echo "$date, $month, $year";
		$status = 'P';
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		//print_r($grid_emp_id);
		$data["values"] = $this->grid_model->grid_daily_out_in_report($year, $month, $date, $status, $grid_emp_id);	
		
		$data["year"]			= $year;
		$data["month"]			= $month;
		$data["date"]			= $date;
		$data["daily_status"]	= $status;
		$data["col_desig"] 		= "";
		$data["col_line"] 		= "";
		$data["col_section"] 	= "";
		$data["col_dept"] 		= "";
		$data["col_all"] 		= "";
		if(is_string($data["values"]))
		{
			echo $data["values"];
		}
		else
		{
			$this->load->view('daily_out_in_report',$data);
		}
	}
		
	function grid_continuous_report()
	{
		$grid_firstdate = $this->uri->segment(3);
		$grid_seconddate = $this->uri->segment(4);
		$status = $this->uri->segment(5);
		//echo "$date, $month, $year";
		$grid_data = $this->uri->segment(6);
		$grid_emp_id = explode('xxx', trim($grid_data));
				
		//$status="Present Report from date $start_date to date  $end_date";
	
		$data["values"] = $this->grid_model->continuous_report($grid_firstdate, $grid_seconddate, $status, $grid_emp_id);
		
		if($status =="A")
		{
			$status = "Absent";
		}
		elseif($status =="P")
		{
			$status = "Present";
		}
		elseif($status =="L")
		{
			$status = "Leave";
		}
		
		$sStartDate = date("Y-m-d", strtotime($grid_firstdate)); 
		$sEndDate = date("Y-m-d", strtotime($grid_seconddate)); 
		
		$data["status"] = $status;
		$data["start_date"] = $sStartDate;
		$data["end_date"] = $sEndDate;
		//print_r($data);
		if(is_string($data["values"]))
		{
			echo $data["values"];
		}
		else
		{
			$this->load->view('continuous_report',$data);
		}
		
		
		
	}
	
		
	function grid_yearly_report()
	{
		$grid_firstdate = $this->uri->segment(3);
		$status = $this->uri->segment(4);
		//echo "$date, $month, $year";
		$grid_data = $this->uri->segment(5);
		$grid_emp_id = explode('xxx', trim($grid_data));	
		
		//$status="Present Report from date $start_date to date  $end_date";
	
		$data["values"] = $this->grid_model->yearly_leave_report($grid_firstdate, $status, $grid_emp_id);
		
		if($status =="A")
		{
			$status = "Absent";
		}
		elseif($status =="P")
		{
			$status = "Present";
		}
		elseif($status =="L")
		{
			$status = "Leave";
		}
		
		/*$sStartDate = date("Y-m-d", strtotime($firstdate)); 
		$sEndDate = date("Y-m-d", strtotime($secondtdate)); 
		*/
		$data["status"] = $status;
		// $data["start_date"] = $sStartDate;
		// $data["end_date"] = $sEndDate;
		//print_r($data);
		if(is_string($data["values"]))
		{
			echo $data["values"];
		}
		else
		{
			$this->load->view('yearly_report',$data);
		}
		
		
		
	}
	
	function grid_continuous_late_report()
	{
		$grid_firstdate = $this->uri->segment(3);
		$grid_seconddate = $this->uri->segment(4);
		
		$grid_data = $this->uri->segment(5);
		$grid_emp_id = explode('xxx', trim($grid_data));
				
		//$status="Present Report from date $start_date to date  $end_date";
	
		$data["values"] = $this->grid_model->continuous_late_report($grid_firstdate, $grid_seconddate, $grid_emp_id);
		
		$sStartDate = date("Y-m-d", strtotime($grid_firstdate)); 
		$sEndDate = date("Y-m-d", strtotime($grid_seconddate)); 
		
		$data["start_date"] = $sStartDate;
		$data["end_date"] = $sEndDate;
		//print_r($data);
		if(is_string($data["values"]))
		{
			echo $data["values"];
		}
		else
		{
			$this->load->view('continuous_late_report',$data);
		}
	}
	
	function continuous_incre_report()
	{
		$grid_firstdate = $this->input->post('firstdate');
		$grid_seconddate = $this->input->post('seconddate');
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));

		$sStartDate = date("Y-m-d", strtotime($grid_firstdate)); 
		$sEndDate = date("Y-m-d", strtotime($grid_seconddate));
		$data["values"] = $this->grid_model->continuous_incre_report($sStartDate,$sEndDate,$grid_emp_id);
		
		$data["start_date"] = $sStartDate;
		$data["end_date"] = $sEndDate;
		//print_r($data);
		if(is_string($data["values"]))
		{
			echo $data["values"];
		}
		else
		{
			$this->load->view('continuous_increment_report',$data);
		}
		
	}
	
	function continuous_prom_report()
	{
		$grid_firstdate = $this->input->post('firstdate');
		$grid_seconddate = $this->input->post('seconddate');
		$grid_data = $this->input->post('spl');

		$sStartDate = date("Y-m-d", strtotime($grid_firstdate)); 
		$sEndDate = date("Y-m-d", strtotime($grid_seconddate));
		
		// $grid_data = $this->uri->segment(5);
		$grid_emp_id = explode('xxx', trim($grid_data));
		$data["values"] = $this->grid_model->continuous_prom_report($sStartDate,$sEndDate,$grid_emp_id);
		
		$data["start_date"] = $sStartDate;
		$data["end_date"] = $sEndDate;
		//print_r($data);
		if(is_string($data["values"]))
		{
			echo $data["values"];
		}
		else
		{
			$this->load->view('continuous_promotion_report',$data);
		}
		
	}
	
	function grid_app_letter()
	{
		$grid_data = $this->uri->segment(3);
		$grid_emp_id = explode('xxx', trim($grid_data));
		
		$query['values'] = $this->grid_model->grid_app_letter($grid_emp_id);
		if(is_string($query['values']))
		{
			echo $query['values'];
		}
		else
		{
			$this->load->view('appointment_letter',$query);
		}
	}
	
	function grid_pay_slip()
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
			$this->load->view('pay_slip',$query);
		}
	}
	
	function grid_id_card()
	{
		$grid_data = $this->uri->segment(3);
		$grid_emp_id = explode('xxx', trim($grid_data));
			
		$query['values'] = $this->grid_model->grid_id_card($grid_emp_id);
		if(is_string($query['values']))
		{
			echo $query['values'];
		}
		else
		{
			$this->load->view('id_card',$query);
		}
	}
	
	function grid_id_card_english()
	{
		$grid_data = $this->uri->segment(3);
		$grid_emp_id = explode('xxx', trim($grid_data));
			
		$query['values'] = $this->grid_model->grid_id_card_english($grid_emp_id);
		if(is_string($query['values']))
		{
			echo $query['values'];
		}
		else
		{
			$this->load->view('id_card_english',$query);
		}
	}
	

	function grid_job_card_without_ot()
	{
		$grid_firstdate = $this->uri->segment(3);
		$grid_seconddate = $this->uri->segment(4);
		
		$grid_data = $this->uri->segment(5);
		$grid_emp_id = explode('xxx', trim($grid_data));
			
		$query['values'] = $this->grid_model->grid_job_card_without_ot($grid_firstdate, $grid_seconddate, $grid_emp_id);
		
		$query['grid_firstdate'] = $grid_firstdate;
		$query['grid_seconddate'] = $grid_seconddate;
		
		if(is_string($query['values']))
		{
			echo $query['values'];
		}
		else
		{
			$this->load->view('job_card_without_ot',$query);
		}
	}
	function advance_job_card()
	{
		$grid_firstdate = $this->uri->segment(3);
		$grid_seconddate = $this->uri->segment(4);
		
		$grid_data = $this->uri->segment(5);
		$grid_emp_id = explode('xxx', trim($grid_data));
			
		$query['values'] = $this->grid_model->advance_job_card($grid_firstdate, $grid_seconddate, $grid_emp_id);
		
		$query['grid_firstdate'] = $grid_firstdate;
		$query['grid_seconddate'] = $grid_seconddate;
		
		if(is_string($query['values']))
		{
			echo $query['values'];
		}
		else
		{
			$this->load->view('advance_job_card',$query);
		}
	}
	function grid_pf_statement()
	{
		$year  = $this->uri->segment(3);
		$month = $this->uri->segment(4);
		
		$grid_data = $this->uri->segment(5);
		$grid_emp_id = explode('xxx', trim($grid_data));
			
		$query['values'] = $this->grid_model->grid_pf_statement($year, $month, $grid_emp_id);
		
		$query['year'] = $year;
		$query['month'] = $month;
		
		if(is_string($query['values']))
		{
			echo $query['values'];
		}
		else
		{
			$this->load->view('provident_fund_statement',$query);
		}
	}
	
	function grid_monthly_att_register()
	{
		$grid_firstdate = $this->uri->segment(3);
		$grid_data = $this->uri->segment(4);
		$grid_emp_id = explode('xxx', trim($grid_data));
		
		$year_month = date("Y-m", strtotime($grid_firstdate)); 
		
		$query=$this->grid_model->grid_monthly_att_register($year_month, $grid_emp_id);
		if(is_string($query))
		{
			echo $query;
		}
		else
		{
			$year_month = date("M-Y", strtotime($grid_firstdate)); 
			$data["value"]=$query;
			//$data2["value2"]=$query->num_fields(); 
			$data["year_month"] = $year_month;
			$this->load->view('monthly_report',$data);
		}
	}
	
	function grid_extra_ot()
	{
		$grid_firstdate = $this->uri->segment(3);
		$grid_seconddate = $this->uri->segment(4);
		
		$data['grid_firstdate'] = $grid_firstdate;
		$data['grid_seconddate'] = $grid_seconddate;
		
		$grid_data = $this->uri->segment(5);
		$grid_emp_id = explode('xxx', trim($grid_data));
		
		$grid_firstdate  = date("Y-m-d", strtotime($grid_firstdate)); 
		$grid_seconddate = date("Y-m-d", strtotime($grid_seconddate)); 
		
		$data['values'] = $this->grid_model->grid_extra_ot($grid_firstdate, $grid_seconddate, $grid_emp_id);
		
		
		
		$this->load->view('ot_job_card',$data);
		
	}
	
	function manual_attendance_entry()
	{
		$grid_firstdate = $this->input->post('firstdate');
		$grid_seconddate = $this->input->post('seconddate');
		
		$manual_time = $this->input->post('manual_time');
		
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		
		$grid_firstdate  = date("Y-m-d", strtotime($grid_firstdate)); 
		$grid_seconddate = date("Y-m-d", strtotime($grid_seconddate)); 
		
		/*$grid_firstdate = "2011-07-02";
		$grid_seconddate = "2011-07-08";
		
		$manual_time = "08:00:00";
		
		$grid_data = "100005xxx100009xxx440004";
		$grid_emp_id = explode('xxx', trim($grid_data));*/
		
		$data = $this->grid_model->manual_attendance_entry($grid_firstdate, $grid_seconddate, $manual_time, $grid_emp_id);
		echo $data;
				
	}
	
	function manual_entry_Delete()
	{
		$grid_firstdate = $this->input->post('firstdate');
		$grid_seconddate = $this->input->post('seconddate');
		
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		//print_r($grid_emp_id);
		$grid_firstdate  = date("Y-m-d", strtotime($grid_firstdate)); 
		$grid_seconddate  = date("Y-m-d", strtotime($grid_seconddate)); 
		
		$data = $this->grid_model->manual_entry_Delete($grid_firstdate, $grid_seconddate, $grid_emp_id);
		echo $data;
				
	}
	
	function save_work_off()
	{
		$grid_firstdate = $this->input->post('firstdate');
				
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		//print_r($grid_emp_id);
		$grid_firstdate  = date("Y-m-d", strtotime($grid_firstdate)); 
				
		$data = $this->grid_model->save_work_off($grid_firstdate, $grid_emp_id);
		echo $data;
				
	}
	
	function save_holiday()
	{
		$grid_firstdate = $this->input->post('firstdate');
		$holiday_description = $this->input->post('holiday_description');
		
		$grid_firstdate  = date("Y-m-d", strtotime($grid_firstdate));
				
		$data = $this->grid_model->save_holiday($grid_firstdate, $holiday_description);
		echo $data;
				
	}
	
	function grid_monthly_salary_sheet()
	{
		$sal_year_month = $this->uri->segment(3);
		$grid_status 	= $this->uri->segment(4);		
		$grid_data 		= $this->uri->segment(5);
		$grid_emp_id = explode('xxx', trim($grid_data));
		//print_r($grid_emp_id);
						
		$data["value"] = $this->grid_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;
		
		$this->load->view('salary_sheet',$data);
	}
	
	function grid_general_info()
	{
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
						
		$data["value"] = $this->grid_model->grid_general_info($grid_emp_id);
				
		$this->load->view('general_info',$data);
	}
	
	function salary_summary()
	{
		$salary_month = $this->uri->segment(3);
		$data["values"] = $this->grid_model->salary_summary($salary_month);
		$data["salary_month"] = $salary_month; 
		//print_r($data);
		$this->load->view('salary_summary',$data);
	}
	
	function grid_new_join_report()
	{
		$grid_firstdate = $this->input->post('firstdate');
		$grid_seconddate = $this->input->post('seconddate');
		
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		
		$grid_firstdate  = date("Y-m-d", strtotime($grid_firstdate));
		$grid_seconddate  = date("Y-m-d", strtotime($grid_seconddate));
			
		$data['values'] = $this->grid_model->grid_new_join_report($grid_firstdate, $grid_seconddate, $grid_emp_id);
		
		$data['start_date']= $grid_firstdate;
		$data['end_date'] 	= $grid_seconddate;
		
		if(is_string($data['values']))
		{
			echo $data['values'];
		}
		else
		{
			$this->load->view('new_join_emp_report',$data);
		}
	}
	
	function grid_resign_report()
	{
		$grid_firstdate = $this->input->post('firstdate');
		$grid_seconddate = $this->input->post('seconddate');
		
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		
		$grid_firstdate  = date("Y-m-d", strtotime($grid_firstdate));
		$grid_seconddate  = date("Y-m-d", strtotime($grid_seconddate));
			
		$data['values'] = $this->grid_model->grid_resign_report($grid_firstdate, $grid_seconddate, $grid_emp_id);
		
		$data['start_date']= $grid_firstdate;
		$data['end_date'] 	= $grid_seconddate;
		
		if(is_string($data['values']))
		{
			echo $data['values'];
		}
		else
		{
			$this->load->view('resign_emp_report',$data);
		}
	}
	
	function grid_left_report()
	{
		$grid_firstdate = $this->input->post('firstdate');
		$grid_seconddate = $this->input->post('seconddate');
		
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		
		$grid_firstdate  = date("Y-m-d", strtotime($grid_firstdate));
		$grid_seconddate  = date("Y-m-d", strtotime($grid_seconddate));
			
		$data['values'] = $this->grid_model->grid_left_report($grid_firstdate, $grid_seconddate, $grid_emp_id);
		
		$data['start_date']= $grid_firstdate;
		$data['end_date'] 	= $grid_seconddate;
		
		if(is_string($data['values']))
		{
			echo $data['values'];
		}
		else
		{
			$this->load->view('left_emp_report',$data);
		}
	}
	
	function grid_daily_eot()
	{
		$this->load->model('common_model');
		$grid_firstdate = $this->input->post('firstdate');
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$grid_firstdate  = date("Y-m-d", strtotime($grid_firstdate));
		
		$data['values'] = $this->grid_model->grid_daily_eot($grid_firstdate, $grid_emp_id);
		
		$data['start_date']= $this->uri->segment(3);
				
		if(is_string($data['values']))
		{
			echo $data['values'];
		}
		else
		{
			$this->load->view('daily_eot',$data);
		}
	}
	
	
	function grid_daily_eot_after_12_am()
	{
		$this->load->model('common_model');
		$grid_firstdate = $this->input->post('firstdate');
		$grid_seconddate = $this->input->post('seconddate');
		// echo $grid_seconddate;exit;
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$grid_firstdate  = date("Y-m-d", strtotime($grid_firstdate));
		$grid_seconddate  = date("Y-m-d", strtotime($grid_seconddate));
		
		$data['values'] = $this->grid_model->grid_daily_eot_after_12_am($grid_firstdate,$grid_seconddate, $grid_emp_id);
		
		// $data['start_date']= $this->uri->segment(3);
		$data['first_date']=$grid_firstdate;
		$data['second_date']=$grid_seconddate;
				// echo "<pre>";print_r($grid_firstdate.'=='.$grid_seconddate);exit;
		if(is_string($data['values']))
		{
			echo $data['values'];
		}
		// else
		{
			$this->load->view('daily_eot_after_12_am',$data);
		}
	}	
	
	function tiffin_bill_after_12_am()
	{
		$this->load->model('common_model');
		$grid_firstdate  = $this->input->post('firstdate');
		$grid_seconddate = $this->input->post('seconddate');
		$grid_data       = $this->input->post('spl');
		$grid_emp_id     = explode('xxx', trim($grid_data));
		$grid_firstdate  = date("Y-m-d", strtotime($grid_firstdate));
		$grid_seconddate  = date("Y-m-d", strtotime($grid_seconddate));
		
		$data['values'] = $this->grid_model->tiffin_bill_after_12_am($grid_firstdate, $grid_seconddate, $grid_emp_id);
		
		$data['start_date']= $this->input->post('firstdate');
		$data['end_date']= $this->input->post('seconddate');
				
		if(is_string($data['values']))
		{
			echo $data['values'];
		}
		else
		{
			$this->load->view('tiffin_bill_after_12_am',$data);
		}
	}

	function tiffin_bill_10pm_to_12am()
	{
		$this->load->model('common_model');
		$grid_firstdate  = $this->input->post('firstdate');
		$grid_seconddate = $this->input->post('seconddate');
		$grid_data       = $this->input->post('spl');
		$grid_emp_id     = explode('xxx', trim($grid_data));
		$grid_firstdate  = date("Y-m-d", strtotime($grid_firstdate));
		$grid_seconddate  = date("Y-m-d", strtotime($grid_seconddate));
		
		$data['values'] = $this->grid_model->tiffin_bill_10pm_to_12am($grid_firstdate, $grid_seconddate, $grid_emp_id);
		
		$data['start_date']= $this->input->post('firstdate');
		$data['end_date']= $this->input->post('seconddate');
				
		if(is_string($data['values']))
		{
			echo $data['values'];
		}
		else
		{
			$this->load->view('tiffin_bill_after_12_am',$data);
		}
	}


	function grid_job_card()
	{
		$grid_firstdate  = $this->input->post('firstdate');
		$grid_seconddate = $this->input->post('seconddate');
		$grid_data       = $this->input->post('spl');

		$grid_emp_id = explode('xxx', trim($grid_data));
		$grid_firstdate  = date("Y-m-d", strtotime($grid_firstdate)); 
		$grid_seconddate = date("Y-m-d", strtotime($grid_seconddate)); 
		
		$data['values'] = $this->grid_model->grid_job_card($grid_firstdate, $grid_seconddate, $grid_emp_id);
		$data['grid_firstdate'] = $grid_firstdate;
		$data['grid_seconddate'] = $grid_seconddate;
		
		if(is_string($data['values']))
		{
			echo $data['values'];
		}
		else
		{
			$this->load->view('grid_job_card',$data);
		}		
	}

	function grid_extra_ot_10pm()
	{
		$grid_firstdate  = $this->input->post('firstdate');
		$grid_seconddate = $this->input->post('seconddate');
		$grid_data       = $this->input->post('spl');

		$grid_emp_id = explode('xxx', trim($grid_data));
		$grid_firstdate  = date("Y-m-d", strtotime($grid_firstdate)); 
		$grid_seconddate = date("Y-m-d", strtotime($grid_seconddate)); 
		
		$data['values'] = $this->grid_model->grid_extra_ot_10pm($grid_firstdate, $grid_seconddate, $grid_emp_id);
		$data['grid_firstdate'] = $grid_firstdate;
		$data['grid_seconddate'] = $grid_seconddate;
		
		if(is_string($data['values']))
		{
			echo $data['values'];
		}
		else
		{
			$this->load->view('grid_extra_ot_10pm',$data);
		}		
	}

	
	function grid_daily_ot()
	{
		$this->load->model('common_model');
		$grid_firstdate = $this->input->post('firstdate');
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$grid_firstdate  = date("Y-m-d", strtotime($grid_firstdate));
		
		$data['values'] = $this->grid_model->grid_daily_ot($grid_firstdate, $grid_emp_id);
		
		$data['start_date']= $this->uri->segment(3);
				
		if(is_string($data['values']))
		{
			echo $data['values'];
		}
		else
		{
			$this->load->view('daily_ot',$data);
		}
	}
	
	function grid_daily_allowance_bills()
	{
		$this->load->model('common_model');
		$grid_firstdate = $this->input->post('firstdate');
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$grid_firstdate  = date("Y-m-d", strtotime($grid_firstdate));
		
		$data['values'] = $this->grid_model->grid_daily_allowance_bills($grid_firstdate, $grid_emp_id);
		
		$data['start_date']= $this->uri->segment(3);
				
		if(is_string($data['values']))
		{
			echo $data['values'];
		}
		else
		{
			$this->load->view('daily_allowance_bills',$data);
		}
	}
	function grid_monthly_ot_register()
	{
		$grid_firstdate = $this->uri->segment(3);
		
		$grid_data = $this->uri->segment(4);
		$grid_emp_id = explode('xxx', trim($grid_data));
		
		$grid_firstdate  = date("Y-m", strtotime($grid_firstdate));
		
		$data['values'] = $this->grid_model->grid_monthly_ot_register($grid_firstdate, $grid_emp_id);
		
		$data['start_date']= $grid_firstdate;
				
		if(is_string($data['values']))
		{
			echo $data['values'];
		}
		else
		{
			$this->load->view('monthly_ot_register',$data);
		}
	}
	
	function grid_monthly_eot_register()
	{
		$grid_firstdate = $this->uri->segment(3);
		
		$grid_data = $this->uri->segment(4);
		$grid_emp_id = explode('xxx', trim($grid_data));
		
		$grid_firstdate  = date("Y-m", strtotime($grid_firstdate));
		
		$data['values'] = $this->grid_model->grid_monthly_eot_register($grid_firstdate, $grid_emp_id);
		
		$data['start_date']= $grid_firstdate;
				
		if(is_string($data['values']))
		{
			echo $data['values'];
		}
		else
		{
			$this->load->view('monthly_eot_register',$data);
		}
	}
	
	function grid_monthly_allowance_register()
	{
		$grid_firstdate = $this->uri->segment(3);
		
		$grid_data = $this->uri->segment(4);
		$grid_emp_id = explode('xxx', trim($grid_data));
		
		$grid_firstdate  = date("Y-m", strtotime($grid_firstdate));
		
		$data['values'] = $this->grid_model->grid_monthly_allowance_register($grid_firstdate, $grid_emp_id);
		
		$data['start_date']= $grid_firstdate;
				
		if(is_string($data['values']))
		{
			echo $data['values'];
		}
		else
		{
			$this->load->view('monthly_allowance_register',$data);
		}
	}
	
	function grid_daily_punch_report()
	{
		$grid_firstdate = $this->input->post('firstdate');
		
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		
		$grid_firstdate  = date("Y-m", strtotime($grid_firstdate));
		
		$data['values'] = $this->grid_model->grid_time_search_report($grid_firstdate, $grid_emp_id);
		
		$data['start_date']= $grid_firstdate;
				
		if(is_string($data['values']))
		{
			echo $data['values'];
		}
		else
		{
			$this->load->view('monthly_ot_register',$data);
		}
		
		$f_date = '2012-04-10';
		$s_date = '2012-04-10';
		$f_time = '17:00:00';
		$s_time = '20:00:00';
		$grid_emp_id = array('001414','001635','001744','001750','001773','002070','002090','002110','002113','002178');
		
		$this->grid_model->grid_time_search_report();
		
	}
	
	function test()
	{
		$sStartDate = '2012-04-01';
		$emp_id = '003915';
		$sEndDate = '2012-04-30';
		echo $this->grid_model->get_resign_date($emp_id, $sStartDate, $sEndDate);
	}
	
	function grid_earn_leave_report()
	{
		$grid_data = $this->uri->segment(3);
		$grid_emp_id = explode('xxx', trim($grid_data));
		$data['values'] = $this->grid_model->grid_earn_leave_report($grid_emp_id);
		if(is_string($data['values']))
		{
			echo $data['values'];
		}
		else
		{
			$this->load->view('earn_leave_report',$data);
		}
	}

	public function leave_register(){

		$grid_firstdate = $this->input->post('firstdate');
		$grid_seconddate = $this->input->post('seconddate');
		$grid_data = $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$unit_id = $this->input->post('unit_id');
		$query=$this->grid_model->leave_register($grid_firstdate, $grid_seconddate,$grid_emp_id);
	    // echo "<pre>";print_r($query);exit;
		if(is_string($query)){
			echo $query;
		}
		else{
			$data["values"]		 = $query;
			$data['unit_id']	 = $unit_id ;
			$data["first_date"]  = $grid_firstdate;
			$data["second_date"] = $grid_seconddate;
			$this->load->view('leave_register',$data);
		}
	}
	
}
?>