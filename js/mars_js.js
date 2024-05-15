function daily_attendance_summary()
{
	var firstdate = document.getElementById('firstdate').value;	
	if(firstdate =='')
	{
		alert("Please select date");
		return;
	}
	
	var category = document.getElementById('category').value;
	if(category =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/mars_con/daily_attendance_summary/"+firstdate+"/"+category;
	
	daily_att_sum = window.open(url,'daily_att_sum',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	daily_att_sum.moveTo(0,0);
}


function daily_leave_summary()
{
	var firstdate = document.getElementById('firstdate').value;	
	if(firstdate =='')
	{
		alert("Please select date");
		return;
	}
	
	var category = document.getElementById('category').value;
	if(category =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/mars_con/daily_leave_summary/"+firstdate+"/"+category;
	
	daily_att_sum = window.open(url,'daily_att_sum',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	daily_att_sum.moveTo(0,0);
}



function daily_ot_eot_summary()
{
	var firstdate = document.getElementById('firstdate').value;	
	if(firstdate =='')
	{
		alert("Please select date");
		return;
	}
	
	var category = document.getElementById('category').value;
	if(category =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/mars_con/daily_ot_eot_summary/"+firstdate+"/"+category;
	
	daily_att_sum = window.open(url,'daily_att_sum',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	daily_att_sum.moveTo(0,0);
}

function daily_line_cost_summary()
{
	var firstdate = document.getElementById('firstdate').value;	
	if(firstdate =='')
	{
		alert("Please select date");
		return;
	}
	
	var category = document.getElementById('category').value;
	if(category =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/mars_con/daily_line_cost_summary/"+firstdate+"/"+category;
	
	daily_att_sum = window.open(url,'daily_att_sum',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	daily_att_sum.moveTo(0,0);
}

function incomplate_month_salary()
{
	var firstdate = document.getElementById('firstdate').value;	
	if(firstdate =='')
	{
		alert("Please select date");
		return;
	}
	
	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='Select')
	{
		alert("Please select select date");
		return;
	}
	
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/mars_con/incomplate_month_salary/"+firstdate+"/"+seconddate;
	
	daily_att_sum = window.open(url,'daily_att_sum',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	daily_att_sum.moveTo(0,0);
}

function new_daily_attendance_summary()
{
	var firstdate = document.getElementById('firstdate').value;	
	if(firstdate =='')
	{
		alert("Please select date");
		return;
	}
	
	var category = document.getElementById('category').value;
	if(category =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/mars_con/new_daily_attendance_summary/"+firstdate+"/"+category;
	
	daily_att_sum = window.open(url,'daily_att_sum',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	daily_att_sum.moveTo(0,0);
}


function new_daily_ot_summary()
{
	var firstdate = document.getElementById('firstdate').value;	
	if(firstdate =='')
	{
		alert("Please select date");
		return;
	}
	
	var category = document.getElementById('category').value;
	if(category =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/mars_con/new_daily_ot_summary/"+firstdate+"/"+category;
	
	daily_att_sum = window.open(url,'daily_att_sum',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	daily_att_sum.moveTo(0,0);
}