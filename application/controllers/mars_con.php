<?php
class Mars_con extends CI_Controller {

	


	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->model('mars_model');
		$this->load->model('acl_model');
		$this->load->model('common_model');
		$access_level = 6;
		$acl = $this->acl_model->acl_check($access_level);
		
	}
	function aliTest(){
		$info = $this->mars_model->aliTest();
		/*$lines = $this->db->get('pr_line_num')->result_array();
		foreach ($lines as $key => $value) {
			$line = $value['line_id'];
			$this->db->select("count('emp_id') as totalemp");
			$this->db->where('');
		}
		echo "<pre>";
		print_r($lines);exit();*/
	}

	function others_report_front_end()
	{
		$this->load->view('others_report/others_report_front_end');
	}
	
	function daily_attendance_summary()
	{
		$grid_date = $this->uri->segment(3);
		list($date, $month, $year) = explode('-', trim($grid_date));
		$report_date = date("Y-m-d", mktime(0, 0, 0, $month, $date, $year));
		
		$report_prev_date = date('Y-m-d',strtotime("-1 days", strtotime($report_date)));
		
		$category = $this->uri->segment(4);
		
		if($category =='Department')
		{
			$data['values'] = $this->mars_model->department_attendance_summary($report_date);
			$data['prev_values'] = $this->mars_model->department_attendance_summary($report_prev_date);
		}
		elseif($category =='Section')
		{
			$data['values'] = $this->mars_model->section_attendance_summary($report_date);
			$data['prev_values'] = $this->mars_model->section_attendance_summary($report_prev_date);
		}
		elseif($category =='Line')
		{
			$data['values'] = $this->mars_model->line_attendance_summary($report_date);
			$data['prev_values'] = $this->mars_model->line_attendance_summary($report_prev_date);
		}
		
		$data['title'] 		 = 'Daily Attendance Summary';
		$data['report_date'] = $report_date;
		$data['category']    = $category;
		
		$this->load->view('others_report/attendance_summary', $data);
	}
	
	function daily_leave_summary()
	{
		$grid_date = $this->uri->segment(3);
		list($date, $month, $year) = explode('-', trim($grid_date));
		$report_date = date("Y-m-d", mktime(0, 0, 0, $month, $date, $year));
		
		$report_prev_date = date('Y-m-d',strtotime("-1 days", strtotime($report_date)));
		
		$category = $this->uri->segment(4);
		
		/*if($category =='Department')
		{
			$data['values'] = $this->mars_model->department_attendance_summary($report_date);
			$data['prev_values'] = $this->mars_model->department_attendance_summary($report_prev_date);
		}
		elseif($category =='Section')
		{
			$data['values'] = $this->mars_model->section_attendance_summary($report_date);
			$data['prev_values'] = $this->mars_model->section_attendance_summary($report_prev_date);
		}
		else*/if($category =='Line')
		{
			$data['values'] = $this->mars_model->line_leave_summary($report_date);
			$data['prev_values'] = $this->mars_model->line_leave_summary($report_prev_date);
		}
		
		$data['title'] 		 = 'Daily Leave Summary';
		$data['report_date'] = $report_date;
		$data['category']    = $category;
		
		$this->load->view('others_report/leave_summary', $data);
		
	}
	
	function daily_ot_eot_summary()
	{
		$grid_date = $this->uri->segment(3);
		list($date, $month, $year) = explode('-', trim($grid_date));
		$report_date = date("Y-m-d", mktime(0, 0, 0, $month, $date, $year));
		
		$report_prev_date = date('Y-m-d',strtotime("-1 days", strtotime($report_date)));
		
		$category = $this->uri->segment(4);
		
		$data['values'] = $this->mars_model->daily_ot_eot_summary_report($report_date);
		// $data['values'] = $this->mars_model->line_ot_eot_summary($report_date);
		// $data['ot_mp'] = $this->mars_model->line_ot_man_power($report_date);
		// $data['eot_mp'] = $this->mars_model->line_eot_man_power($report_date);
		
		
		$data['title'] 		 = 'Daily Ot & EOT Summary';
		$data['report_date'] = $report_date;
		$data['category']    = $category;
		
		// echo "<pre>";
		// print_r($data);exit('ali');
		
		$this->load->view('others_report/daily_ot_eot_summary', $data);
		// $this->load->view('others_report/ot_eot_summary', $data);
		
	}	
	
	function daily_line_cost_summary()
	{
		$grid_date = $this->uri->segment(3);
		list($date, $month, $year) = explode('-', trim($grid_date));
		$report_date = date("Y-m-d", mktime(0, 0, 0, $month, $date, $year));
		
		$report_prev_date = date('Y-m-d',strtotime("-1 days", strtotime($report_date)));
		
		$category = $this->uri->segment(4);
		
		$data['values'] = $this->mars_model->daily_ot_eot_summary_report($report_date);
		
		$data['title'] 		 = 'Daily Line Cost Summary';
		$data['report_date'] = $report_date;
		$data['category']    = $category;
		
		$this->load->view('others_report/daily_line_cost_summary', $data);
		
	}	

	function incomplate_month_salary()
	{
		$first_date  = $this->uri->segment(3);
		$second_date = $this->uri->segment(4);
		
		$first_date  = date('Y-m-d',strtotime($grid_date));
		$second_date = date('Y-m-d',strtotime($second_date));
		
		$data['values'] = $this->mars_model->daily_ot_eot_summary_report($first_date, $second_date);
	
		$data['title'] 		 = 'Incomplate Month Salary';
		$data['first_date']  = $first_date;
		$data['second_date'] = $second_date;
		
		$this->load->view('others_report/incomplate_month_salary', $data);
	}
	
	function test()
	{
		$grid_date = "2012-04-07";
		list($year, $month, $date) = explode('-', trim($grid_date));
		
		$report_date = date("Y-m-d", mktime(0, 0, 0, $month, $date, $year));
		$this->mars_model->department_attendance_summary($report_date);
	}

	function new_daily_attendance_summary()
	{
		$grid_date = $this->uri->segment(3);
		$report_prev_date = date('Y-m-d',strtotime("-1 days", strtotime($grid_date)));
		$report_date = date('Y-m-d',strtotime($grid_date));
		$category = $this->uri->segment(4);
		
		$data['values'] = $this->mars_model->new_line_attendance_summary($report_date);
		$data['prev_values'] = $this->mars_model->prev_day_attendance($report_prev_date);
		$data['title'] 		 = 'Daily Attendance Summary';
		$data['report_date'] = $report_date;
		$data['category']    = $category;
		
		$this->load->view('others_report/new_attendance_summary', $data);
	}

	function new_daily_ot_summary()
	{
		$grid_date = $this->uri->segment(3);
		list($date, $month, $year) = explode('-', trim($grid_date));
		$report_date = date("Y-m-d", mktime(0, 0, 0, $month, $date, $year));
		
		$category = $this->uri->segment(4);
		$data['values'] = $this->mars_model->new_daily_ot_summary($report_date);
		
		$data['title'] 		 = 'Daily OT Summary';
		$data['report_date'] = $report_date;
		$data['category']    = $category;
		
		$this->load->view('others_report/new_daily_ot_summary', $data);
	}


}
?>