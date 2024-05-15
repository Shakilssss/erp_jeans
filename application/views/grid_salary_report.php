<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>MSH Payroll Reports</title>
  <?php $base_url = base_url();   
    $base_url = base_url();
	
	?>
	
	<script type="text/javascript" src="<?php echo $base_url; ?>js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.8.2.custom.min.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url; ?>themes/redmond/jquery-ui-1.8.2.custom.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url; ?>themes/ui.jqgrid.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url; ?>css/calendar.css" />
		
	<script src="<?php echo $base_url; ?>js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="<?php echo $base_url; ?>js/jquery.jqGrid.min.js" type="text/javascript"></script>
	<script src="<?php echo $base_url; ?>js/grid_content.js" type="text/javascript"></script>
	<script src="<?php echo $base_url; ?>js/calendar_eu.js" type="text/javascript"></script>
	<script>
    	jQuery(function() {
            $( ".clearfix" ).dialog({
                autoOpen: false,
                height: 370,
                width: 300,
                resizable: false,
                modal: true
            });
            $(".ui-dialog-titlebar").hide();   
        });
    </script>
	

</head>
<body bgcolor="#ECE9D8">
<div align="center" style=" margin:0 auto; width:1000px; min-height:555px; overflow:hidden;">
<div style="float:left; overflow:hidden; width:65%; height:auto; padding:10px;">
<form name="grid">
	<div>

			<fieldset style='width:95%;'><legend><font size='+1'><b>Month & Year</b></font></legend>
			<?php $this->load->view('month_year_salary_report'); ?>
			<br /><br /> 
			</fieldset>
	</div>
<br />
<div>
<fieldset style='width:95%;'><legend><font size='+1'><b>Category Options</b></font></legend>
<table>
<tr>
<td>Start</td><td>:</td><td><select name='grid_start' id='grid_start' style="width:250px;" onchange='grid_get_all_data_for_salary()' /><option value='Select'>Select</option><option value='all'>ALL</option></select></td>
<td>Dept. </td><td>:</td><td><select id='grid_dept' name='grid_dept' style="width:250px;" onChange="grid_all_search_for_salary()"><option value=''></option></select></td>
</tr>
<tr><td>Section </td><td>:</td><td><select id='grid_section' name='grid_section' style="width:250px;" onChange="grid_all_search_for_salary()"><option value=''></option></select></td>
<td>Line </td><td>:</td><td><select id='grid_line' name='grid_line' style="width:250px;" onChange="grid_all_search_for_salary()"><option value=''></option></select></td>
</tr>
<tr><td>Desig. </td><td>:</td><td><select id='grid_desig' name='grid_desig' style="width:250px;" onChange="grid_all_search_for_salary()"><option value=''></option></select></td>
<td>Sex </td><td>:</td><td><select id='grid_sex' name='grid_sex' style="width:250px;" onChange="grid_all_search_for_salary()"><option value=''></option></select></select></td>
</tr>
<tr><td>Status</td><td>:</td><td><select id='grid_status' name='grid_status' style="width:250px;" onChange="grid_all_search_for_salary()"><option value=''></option></select></td>
</tr>
</table>
</fieldset>
</div>
<div>
<br />
<?php
$user_id = $this->acl_model->get_user_id($this->session->userdata('username'));
$acl     = $this->acl_model->get_acl_list($user_id);
if(!in_array(10,$acl))
{
?>
<fieldset style='width:95%;'><legend><font size='+1'><b>Salary Reports</b></font></legend>
<table width="100%"  style="font-size:11px; ">


<tr>
<td style="width:20%; background-color: #666666;"><input type="button" style=" width:100%; font-size:100%;"  value="Actual Montly Salary Sheet" onClick="grid_actual_monthly_salary_sheet()"></td>
<td style="width:27%; background-color: #666666;"><input type="button" style=" width:100%; font-size:100%;"  value="Actual Montly Salary Sheet with EOT" onClick="grid_actual_monthly_salary_sheet_with_eot()"></td>
<td style="width:20%; background-color:#666666;"><input type="button" style="width:100%; font-size:100%;" value="Monthly EOT Sheets" onClick="grid_monthly_eot_sheet()"></td>
<td style="width:20%; background-color: #666666;"><input type="button" style=" width:100%; font-size:100%;" name='view' onclick='eot_summary_report()' value='EOT Summary Report'/></td>
</tr>

<tr>
	<td style="width:20%; background-color: #666666;"><input type="button" style=" width:100%; font-size:100%;"  value="Salary Sheet Without OT" onClick="grid_actual_monthly_salary_sheet_without_ot()"></td>
	<td style="width:20%; background-color: #666666;"><input type="button" style=" width:100%; font-size:100%;"  value="Salary Summary With OT" onClick="sal_summary_with_ot_eot('ot_sum')"></td>
	<td style="width:20%; background-color: #666666;"><input type="button" style=" width:100%; font-size:100%;"  value="Salary Summary With EOT" onClick="sal_summary_with_ot_eot('eot_sum')"></td>
	<td style="width:20%; background-color: #666666;"><input type="button" style=" width:100%; font-size:100%;" value="Pay Slip Without OT" onClick="grid_pay_slip_without_ot()"></td>
</tr>

<tr>
<td style="width:20%; background-color: #666666;"><input type="button" style=" width:100%; font-size:100%;"  value="Montly Salary Sheet" onClick="grid_monthly_salary_sheet()"></td>
<td style="width:20%; background-color: #666666;"><input type="button" style=" width:100%; font-size:100%;" name='view' onclick='sal_summary_report()' value='Salary Summary Report'/></td>
<td style="width:20%; background-color: #666666;"><input type="button" style=" width:100%; font-size:100%;" value="Pay Slip" onClick="grid_pay_slip()"></td>
<td style="width:20%; background-color: #666666;"><input type="button" style=" width:100%; font-size:100%;" value="Staff Salary Sheet" onClick="grid_staff_salary_sheet()"></td>
</tr>
	<?php
	// $user_id = $this->acl_model->get_user_id($this->session->userdata('username'));
	// $acl     = $this->acl_model->get_acl_list($user_id);
	if(!in_array(10,$acl)) { ?>
	<tr>
		<td style="width:20%; background-color:#666666;"><input type="button" style="width:100%; font-size:100%;" value="Half (0.5)OT Sheets" onClick="grid_half_ot_sheet()"></td>
		<td style="width:20%; background-color:#666666;"><input type="button" style="width:100%; font-size:100%;" value="Absent (Basic) Amt." onClick="grid_absent_basic_amt()"></td>
		<td style="width:20%; background-color:#666666;"><input type="button" style="width:100%; font-size:100%;" value="Monthly EOT Sheet 10pm" onClick="grid_monthly_eot_sheet_10pm()"></td>
		<td style="width:20%; background-color:#666666;"><input type="button" style="width:100%; font-size:100%;" value="Sal Summary EOT Date" onClick="sal_summary_with_ot_eot_date_between()"></td>
	</tr>
	<?php } ?>
</table>

</fieldset>
<?php } ?>

	<br />
	<fieldset style='width:95%;'><legend><font size='+1'><b>Banking Payment Report</b></font></legend>
		<table width="100%"  style="font-size:11px; ">
			<tr>
				<td style="width:20%;">
					<input type="button" style=" width:100%;"  value="Salary Sheet" onClick="bank_salary_report()">
				</td>
				<td style="width:20%;">
					<input type="button" style=" width:100%;"  value="EOT Sheet" onClick="bank_eot_sheet()">
				</td>
				<td style="width:20%;">
					<input type="button" style=" width:100%;"  value="Night Bill Sheet" onClick="grid_festival_bonus()">
				</td>
				<td style="width:20%;">
					<input type="button" style=" width:100%;"  value="Bonus Sheet" onClick="grid_festival_bonus()">
				</td>
				<td style="width:20%;">
					<input type="button" style=" width:100%;"  value="Bank Bonus Sheet" onClick="grid_festival_bonus_bank()">
				</td>
			</tr>
		</table>
	</fieldset>

<br />
<fieldset style='width:95%;'><legend><font size='+1'><b>Others Benefit Report</b></font></legend>
	<table width="100%"  style="font-size:11px; ">
	<tr>
	<!--<td style="width:20%;"><input type="button" style=" width:100%; font-size:100%;"  value="Maternity Benefit Report" onClick="grid_maternity_benefit()"></td>-->

	<td style="width:20%;"><input type="button" style=" width:100%; font-size:100%;"  value="Festival Bonus" onClick="grid_festival_bonus()"></td>
	<td style="width:20%;"><input type="button" style=" width:100%; font-size:100%;"  value="Advance Salary Sheet" onClick="grid_range_salary_sheet()"></td>

	<td style="width:20%;"><input type="button" style=" width:100%; font-size:100%;"  value="Bank Advance Salary Sheet" onClick="grid_range_salary_sheet_bank()"></td>
	
	<td style="width:20%;"><input type="button" style=" width:100%; font-size:100%;" name='view' onclick='sal_summary_report()' value='Salary Summary Report'/></td>
	<td style="width:20%;"><input type="button" style=" width:100%; font-size:100%;"  value="Monthly Salary Sheet" onClick="grid_advance_monthly_salary_sheet()"></td>
	</tr>

	<tr>
	<td style="width:20%;"><input type="button" style=" width:100%; font-size:100%;"  value="Pay Slip" onClick="grid_advance_pay_slip()"></td>
	<td style="width:20%;"><input type="button" style=" width:100%; font-size:100%;"  value="Earn Leave Report" onClick="grid_earn_leave_report_new()"></td>
	</tr>
	</table>
</fieldset>
</div>

</form>

</div>
<div style="float:right;">
<table id="list1" style="font-family: 'Times New Roman', Times, serif; font-size:15px;"><tr><td></td></tr></table>
</div>
<!--<div id="pager1"></div>-->

<div id="viewid"></div>
<div class="clearfix" style="display:none;">
    <div class="loading"><img src="<?php echo base_url() ?>img/load.gif"  alt="Load"/></div>
    <div style="margin-top:50px;"> Processing Please Wait..... </div>
</div>
</div>
</body>
</html>