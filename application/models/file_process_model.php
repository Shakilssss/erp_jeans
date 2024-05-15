<?php
class File_process_model extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		
	}
	
	function file_process_for_attendance($att_date)
	{
		
		// $otherdb = $this->load->database('sqlDB', TRUE);
		// $otherdb->select('*');
		// // $this->db->where('proxi_id', $proxi_id);
		// $otherdb->limit(5);
		// $query = $otherdb->get('Tran_MachineRawPunch')->result();
		// -----------------------
		
		date_default_timezone_set('Asia/Dhaka');
		
		$date  = $att_date;
		$year  = trim(substr($date,0,4));
		$month = trim(substr($date,5,2));
		$day   = trim(substr($date,8,2));
		
		$att_table = "att_".$year."_".$month;
		// $date = date("d-m-Y", mktime(0, 0, 0, $month, $day, $year));
		$date = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));
		$file_name = "data/$date.TXT";
		
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
				list($device_id,$d_name,$date_time,$acc,$prox_no) = explode("\t", trim($line) );
				//echo $prox_no.'=';
				
				//$device_id = substr($line,0,1);
				//$prox_no = substr($line,39,5);
				$prox_no = trim($prox_no);
				//$prox_no = ltrim($prox_no);
				$prox_no 	= sprintf("%05s", $prox_no);				
				//$conferm_date=substr($line,7,8);
				//$confer_year=substr($conferm_date,0,4);
				//$confer_month=substr($conferm_date,4,2);
				//$confer_day=substr($conferm_date,6,2);
				//$final_day=$confer_year.'-'.$confer_month.'-'.$confer_day;
				
				//$final_day_time = substr($line,6,19);
				$final_day_time = date("Y-m-d H:i:s", strtotime($date_time));
				//$minute=substr($line,27,2);
				//$second=substr($line,29,2);
				//$final_time=$hour.':'.$minute.':'.$second;
				
				//$final_day_time= $final_day.' '.$final_time;
				
				$result = mysql_query("SELECT * FROM pr_id_proxi where proxi_id='$prox_no'");
				$num_rows=mysql_num_rows($result);
				
				/*$this->db->select("");
				$this->db->where("proxi_id", $prox_no);
				$query = $this->db->get("pr_id_proxi");
				echo $num_rows = $query->num_rows();*/
						 
				$result1 = mysql_query("SELECT * FROM $att_table where proxi_id= '$prox_no' and date_time='$final_day_time'");
				$num_rows1=mysql_num_rows($result1);
				
				/*$this->db->select("");
				$this->db->where("proxi_id", $prox_no);
				$this->db->where("date_time", $final_day_time);
				$query1 = $this->db->get($att_table);
				echo $num_rows1 = $query1->num_rows();*/
				
				if($num_rows>0)
				{
					if($num_rows1 == 0 )
					{
						$data = array(
										'device_id' => $device_id,
										'proxi_id' 	=> $prox_no,
										'date_time'	=> $final_day_time
									);
						$this->db->insert($att_table , $data);
						
						//$result="insert into $att_table(att_id, device_id, proxi_id, date_time) values('','$device_id','$prox_no','$final_day_time') ";
						//mysql_query($result) or die(mysql_error());
					}
				}
			}
		}
	}

	
	function manual_entry_Delete($grid_firstdate, $grid_seconddate, $grid_emp_id)
	{
		
		$data = array();
		
		$query = $this->all_emp_for_manual_delete($grid_emp_id);
		//print_r($query->result_array());
		
		foreach($query->result() as $row)
		{
			$id = $row->emp_id;
			
			$startdate = $grid_firstdate; 
			$temp_table = "temp_$id";
			
			$proxi = $this->prox($id);
			
			$days = $this->GetDays($grid_firstdate, $grid_seconddate);
			//print_r($days);
			//return "Test";
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
				echo $temp_table = "temp_$id";
						
				
				$where ="trim(substr(date_time ,1,10)) = '$perday'";
				$this->db->where($where);
				$data=$this->db->delete($temp_table);
				//echo $this->db->last_query();
				//return "Test";
				$where ="trim(substr(date_time ,1,10)) = '$perday' and proxi_id='$proxi'";
				$this->db->where($where);
				$data=$this->db->delete($att_table);
				//$this->db->last_query();	
				//return "Test";	
				if ($data)
				{
					if( file_exists($file_name) )
					{ 
						
						$data = file($file_name);
						
						$out = array();
						
						foreach($data as $line) {
							list($device_id,$d_name,$date_time,$acc,$prox_no) = explode("\t", trim($line) );
							$match_line =  sprintf("%05s", $prox_no);
							 
							if(trim($match_line) != "$proxi") {
								$out[] = $line;
							}
							
						}
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
	
	// delete manual entry 04/10/21
	function delete_manual_entry($grid_firstdate, $grid_seconddate, $grid_emp_id)
	{
		
		$data = array();
		
		$query = $this->all_emp_for_manual_delete($grid_emp_id);
		//print_r($query->result_array());
		
		foreach($query->result() as $row)
		{
			$id = $row->emp_id;
			$startdate = $grid_firstdate; 
			$temp_table = "temp_$id";
			
			$proxi = $this->prox($id);			
			$days = $this->GetDays($grid_firstdate, $grid_seconddate);
			// print_r($days); exit('ok omg');
			//return "Test";
			foreach($days as $perday)
			{
				$year  = trim(substr($perday,0,4));
				$month = trim(substr($perday,5,2));
				$day   = trim(substr($perday,8,2));
	

				$att_table = "att_".$year."_".$month;
				$temp_table = "temp_$id";
				
				$where ="trim(substr(date_time ,1,10)) = '$perday'";
				$this->db->where($where);
				$data=$this->db->delete($temp_table);
				//echo $this->db->last_query();
				//return "Test";
				$where ="trim(substr(date_time ,1,10)) = '$perday' and proxi_id='$proxi'";
				$this->db->where($where);
				$data = $this->db->delete($att_table);
				//$this->db->last_query();	
				//return "Test";	
				if ($data)
				{
					$file_name = "data/$perday.TXT";
					if(file_exists($file_name))
					{ 
						$out = array();
						$lines = file($file_name);

						foreach (array_values($lines) AS $line)
						{
							$match_line = substr($line,18,10);
							if(trim($match_line) != "$proxi") {
								$out[] = $line;
							}
						}
						
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
   
    function all_emp_for_manual_delete($grid_emp_id)
	{
		$emp_cat_id = array( '0'=>1, '1'=>2, '2'=> 3, '3'=>4);
		
		$this->db->select('emp_id');
		$this->db->from('pr_emp_com_info');
		$this->db->where_in('emp_id', $grid_emp_id);
		$this->db->where_in('emp_cat_id', $emp_cat_id);
		$this->db->order_by("emp_id");
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query;
	}

	//-------------------------------------------------------------------------------------------------------
	// Manual lunch leave Entry
	//-------------------------------------------------------------------------------------------------------
	function manual_lunch_leave_entry($grid_firstdate, $grid_seconddate, $manual_time, $grid_emp_id, $leave_type)
	{
		$data = array();

		$query = $this->all_reguler_emp($grid_emp_id);

		foreach($query->result() as $row)
		{
			$empid = $row->emp_id;
			$emp_table="temp_".$empid;

			$deviceid = 1;
			list($hour, $minute,$sec) = explode(':', trim($manual_time) );


			$min_start = $minute-2;
			$min_end = $minute+3;
			$sec_start = 0;
			$sec_end = 60;

			$proxid = $this->prox($empid);

			$days = $this->GetDays($grid_firstdate, $grid_seconddate);
			foreach($days as $day) {
				// echo $day; exit();
				$this->leave_duplicate_entry_check($empid, $day);
				$data = array(
						'emp_id'		=> $empid,
						'start_date'    => $day ,
						'leave_type'	=> $leave_type);
				$this->db->insert('pr_lunch_leave', $data);


				$rand_minutes = rand($min_start,$min_end);
				$rand_sec = rand($sec_start,$sec_end);

				$year = trim(substr($day,0,4));
				$month = trim(substr($day,5,2));
				$day = trim(substr($day,8,2));
				$intime_entry = date("Y-m-d H:i:s", mktime($hour, $rand_minutes, $rand_sec, $month, $day, $year));

				$data = array( 'device_id' => $deviceid	, 'proxi_id' => $proxid, 'date_time' => $intime_entry );
				$this->db->insert($emp_table, $data);
				//print_r($data);
			}
		}
		return "Insert Successfully";
	}

	function leave_duplicate_entry_check($empid, $day)
	{
		$this->db->select('leave_type');
		$where="emp_id = '$empid' and  start_date = '$day' ";
		$this->db->where($where);
		$query = $this->db->get('pr_lunch_leave');
		$num_rows = $query->num_rows();
		if ($num_rows > 0 )
		{
			echo "Duplicate date not allow";
			exit();
		}
		else
		{
			return true;
		}
	}

	// delete manual lunch entry 04/11/21
	function manual_lunch_leave_entry_delete($grid_firstdate, $grid_seconddate, $grid_emp_id)
	{
		$data = array();
		
		$query = $this->all_emp_for_manual_delete($grid_emp_id);
		
		foreach($query->result() as $row)
		{
			$id = $row->emp_id;
			$temp_table = "temp_$id";
			
			$proxi = $this->prox($id);			
			$days = $this->GetDays($grid_firstdate, $grid_seconddate);

			foreach($days as $perday)
			{
				$year  = trim(substr($perday,0,4));
				$month = trim(substr($perday,5,2));


				$att_table = "att_".$year."_".$month;
				$temp_table = "temp_$id";
					// echo "string"; exit;
				
				$where ="trim(substr(date_time ,1,10)) = '$perday'";
				$this->db->where($where);
				$data = $this->db->delete($temp_table);

				if ($this->db->table_exists($att_table))
				{
					$where ="trim(substr(date_time ,1,10)) = '$perday' and proxi_id='$proxi'";
					$this->db->where($where);
					$data = $this->db->delete($att_table);
				}

				$this->db->where('emp_id', $id);
				$this->db->where('start_date', $perday);
				$this->db->delete('pr_lunch_leave');
			}
		}
		return "Delete successfully";
	}
}