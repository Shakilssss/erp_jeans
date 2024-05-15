Select Month and Year :


<select id='report_month_sal' name="report_month_sal" onchange="grid_all_search_for_salary()">
		<?php 
			$year = date('Y');
			for($i=1; $i<=12;$i++)
			{
				$month = date( 'F', mktime(0, 0, 0, $i, 1, $year) );
				$month_numeric =  date( 'm', mktime(0, 0, 0, $i, 1, $year) );
				$current_month = date('m');
				if($current_month == $month_numeric){
				?>
					<option value="<?php echo $month_numeric;?>" selected="selected"><?php echo $month;?></option>
				<?php
				}else{
				?>
					<option value="<?php echo $month_numeric;?>" ><?php echo $month;?></option>
				<?php
				}
			}
		?>
	</select>
	<select id='report_year_sal' name="report_year_sal" onchange="grid_all_search_for_salary()">
		<?php
			$current_year = date('Y');
			for($i = $current_year-10; $i <= $current_year + 10; $i++)
			{
				if($current_year == $i){
				?>
					<option value="<?php echo $i;?>" selected="selected"><?php echo $i;?></option>
				<?php
				}else{
				?>
					<option value="<?php echo $i;?>" ><?php echo $i;?></option>
				<?php
				}
			}
		?>
	</select>

	<!-- <fieldset style='width:95%;display: flex; justify-content:space-between;'> -->
		<!-- <legend><font size='+1'><b>Date</b></font></legend> --><br><br>
		From Date: <input type="text"  id="from_date" style="width:100px;"/>
		<script language="JavaScript">
		var o_cal = new tcal ({
			// form name
			'formname': 'grid',
			// input name
			'controlname': 'from_date'
		});
		
		// individual template parameters can be modified via the calendar variable
		o_cal.a_tpl.yearscroll = false;
		o_cal.a_tpl.weekstart = 6;
		
		</script>
		To Date: <input type="text"  id="to_date" style="width:100px;"/>
		<script language="JavaScript">
		var o_cal = new tcal ({
			// form name
			'formname': 'grid',
			// input name
			'controlname': 'to_date'
		});
		
		// individual template parameters can be modified via the calendar variable
		o_cal.a_tpl.yearscroll = false;
		o_cal.a_tpl.weekstart = 6;
		
		</script>
		<!-- </fieldset> -->