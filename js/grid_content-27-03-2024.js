
function grid_noc_letter(i){
	ajaxRequest = new XMLHttpRequest();
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate ==''){
		alert("Please select First Date");
		return;
	}

	var seconddate = document.getElementById('seconddate').value;
	if(seconddate ==''){
		alert("Please select Second Date");
		return;
	}


	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	var grid_status = document.getElementById('grid_status').value;
	if(grid_status != 3)
	{
		alert("Please select Left options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
	
	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
    


	// var seconddate = document.getElementById('seconddate').value;
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_noc_letter/";

	var queryString="spl="+spl+"&firstdate="+firstdate+"&seconddate="+seconddate+"&sts="+i;

    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
    // $(".clearfix").dialog("open");
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;
			// $(".clearfix").dialog("close");
			continuous_leave_report_old = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			continuous_leave_report_old.document.write(resp);
			continuous_leave_report_old.stop();
		}
	}
}



function grid_age_estimation(){
var ajaxRequest;  // The variable that makes Ajax possible!
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	}catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		}catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			}catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	var unit_id = document.getElementById('grid_start').value;
	if(unit_id =='Select'){alert("Please select Category !");return;}
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
	if(spl ==''){alert("Please select Employee ID");return;}
	
	hostname = window.location.href; 
	hostname = hostname.substring(0, (hostname.indexOf("index.php") == -1) ? hostname.length :   	hostname.indexOf("index.php"));
	
	var queryString="spl="+spl+"&unit_id="+unit_id;
	url =  hostname+"index.php/grid_con/grid_age_estimation/";
	$(".clearfix").dialog("open");
	ajaxRequest.open("POST", url, true);
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;
			$(".clearfix").dialog("close");		
			service_book = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			service_book.document.write(resp);
			service_book.stop();			
		}
	}

}



function grid_application(){
	var ajaxRequest;  // The variable that makes Ajax possible!
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	}catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		}catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			}catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}       
	}
	var unit_id = document.getElementById('grid_start').value;
	if(unit_id =='Select'){alert("Please select unit !");return;}
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
	if(spl ==''){alert("Please select Employee ID");return;}
	
	hostname = window.location.href; 
	hostname = hostname.substring(0, (hostname.indexOf("index.php") == -1) ? hostname.length :   	hostname.indexOf("index.php"));
	
	var queryString="spl="+spl;
	url =  hostname+"index.php/grid_con/grid_application/";
	$(".clearfix").dialog("open");
	ajaxRequest.open("POST", url, true);
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;
			$(".clearfix").dialog("close");		
			service_book = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			service_book.document.write(resp);
			service_book.stop();			
		}
	}
}



function grid_nominee_form(){
	var ajaxRequest;  // The variable that makes Ajax possible!
	try{
	   // Opera 8.0+, Firefox, Safari
	   ajaxRequest = new XMLHttpRequest();
	}catch (e){
	   // Internet Explorer Browsers
	   try{
	      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	   }catch (e) {
	      try{
	         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	      }catch (e){
	         // Something went wrong
	         alert("Your browser broke!");
	         return false;
	      }
	   }
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
	
	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}


	hostname = window.location.href; 
	hostname = hostname.substring(0, (hostname.indexOf("index.php") == -1) ? hostname.length :   	hostname.indexOf("index.php"));
	var queryString="spl="+spl;
   
   url =  hostname+"index.php/grid_con/grid_nominee_form/";
   $(".clearfix").dialog("open");
   ajaxRequest.open("POST", url, true);
   ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
   ajaxRequest.send(queryString);
	
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;
			$(".clearfix").dialog("close");		
			nominee = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			nominee.document.write(resp);
		}
	}
}










function grid_get_all_data_for_salary()
{

	var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
 var start = document.getElementById('grid_start').value;
 if(start == "Select" || start == '')
 {
	 alert("Please select ALL");
	 return;
 }
var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

	var year_month = report_year_sal+"-"+report_month_sal;
	//alert(year_month);
 	//var queryString="year_month="+year_month;
 hostname = window.location.hostname;
 url =  "http://"+hostname+"/erp_jeans/index.php/payroll_con/manual_atten_co/";
 ajaxRequest.open("POST", url, true);
 ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 ajaxRequest.send();


ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		var resp = ajaxRequest.responseText;
		//alert(resp);
		alldata = resp.split("$$$");

		dept_idname = alldata[0].split("===");
		var dept_id = dept_idname[0].split("***");
	    var dept_name = dept_idname[1].split("***");

		document.grid.grid_dept.options.length=0;
		document.grid.grid_dept.options[0]=new Option("Select","Select", true, false);
		for (i=0; i<dept_id.length; i++){
			document.grid.grid_dept.options[i+1]=new Option(dept_name[i],dept_id[i], false, false);
		}

		sec_idname = alldata[1].split("===");
		sec_id = sec_idname[0].split("***");
		sec_name = sec_idname[1].split("***");

		document.grid.grid_section.options.length=0;
		document.grid.grid_section.options[0]=new Option("Select","Select", true, false);
		for (i=0; i<sec_id.length; i++){
			//alert(sec_name[i]);
			document.grid.grid_section.options[i+1]=new Option(sec_name[i],sec_id[i], false, false);

		}


		line_idname = alldata[2].split("===");
		line_id = line_idname[0].split("***");
		line_name = line_idname[1].split("***");

		document.grid.grid_line.options.length=0;
		document.grid.grid_line.options[0]=new Option("Select","Select", true, false);
		for (i=0; i<line_id.length; i++){
			document.grid.grid_line.options[i+1]=new Option(line_name[i],line_id[i], false, false);

		}


		desig_idname = alldata[3].split("===");
		desig_id = desig_idname[0].split("***");
		desig_name = desig_idname[1].split("***");

		document.grid.grid_desig.options.length=0;
		document.grid.grid_desig.options[0]=new Option("Select","Select", true, false);
		for (i=0; i<desig_id.length; i++){
			document.grid.grid_desig.options[i+1]=new Option(desig_name[i],desig_id[i], false, false);

		}

		var sex_id = ["1","2"];
		var sex_name = ["Male","Female"];

		document.grid.grid_sex.options.length=0;
		document.grid.grid_sex.options[0]=new Option("Select","Select", true, false);
		for (i=0; i<sex_id.length; i++){
			document.grid.grid_sex.options[i+1]=new Option(sex_name[i],sex_id[i], false, false);

		}

		status_idname = alldata[4].split("===");
		status_id = status_idname[0].split("***");
		status_name = status_idname[1].split("***");

		document.grid.grid_status.options.length=0;
		//document.grid.grid_status.options[0]=new Option("Select","Select", true, false);
		for (i=0; i<status_id.length; i++){
			document.grid.grid_status.options[i]=new Option(status_name[i],status_id[i], false, false);

		}
		document.grid.grid_status.options[i]=new Option("ALL","ALL", true, true);

	$('#list1').jqGrid('GridUnload');

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_get_all_data_for_salary/"+year_month;
	//var url = "http://localhost/payroll/index.php/grid_con/grid_get_all_data";
	/*alert(url);
	exit;*/
	main_grid(url)
	}
	}
}

//Zuel Ali 15-01-19
function grid_earn_leave_report_new(){
	var ajaxRequest;
	try{
		ajaxRequest = new XMLHttpRequest();
	}catch (e){
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		}catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			}catch (e){
				alert("Your browser broke!");
				return false;
			}
		}
	}

	var report_month_sal = document.getElementById('report_month_sal').value;
	var report_year_sal = document.getElementById('report_year_sal').value;

	if(report_month_sal =='' || report_year_sal ==''){
		alert("Please select month & year!");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select'){
		alert("Please select Category options");
		return;
	}
	var grid_status = document.getElementById('grid_status').value;
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl ==''){
		alert("Please select Employee ID");
		return;
	}

	var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/grid_earn_leave_report_new/";

	var queryString="sal_year_month="+sal_year_month+"&spl="+spl;

    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);

   $(".clearfix").dialog("open");

	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;
			$(".clearfix").dialog("close");
			continuous_leave_report_old = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			continuous_leave_report_old.document.write(resp);
			continuous_leave_report_old.stop();
		}
	}
}

//Zuel Ali 10-01-19

function grid_get_all_data()
{

	var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
 var start = document.getElementById('grid_start').value;
 if(start == "Select" || start == '')
 {
	 alert("Please select ALL");
	 return;
 }

 //var queryString="desig="+desig+"&dept="+dept;
 hostname = window.location.hostname;
 url =  "http://"+hostname+"/erp_jeans/index.php/payroll_con/manual_atten_co/";
 ajaxRequest.open("POST", url, true);
 ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 ajaxRequest.send();


ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		var resp = ajaxRequest.responseText;
		//alert(resp);
		alldata = resp.split("$$$");

		dept_idname = alldata[0].split("===");
		var dept_id = dept_idname[0].split("***");
	    var dept_name = dept_idname[1].split("***");

		document.grid.grid_dept.options.length=0;
		document.grid.grid_dept.options[0]=new Option("Select","Select", true, false);
		for (i=0; i<dept_id.length; i++){
			document.grid.grid_dept.options[i+1]=new Option(dept_name[i],dept_id[i], false, false);

		}

		sec_idname = alldata[1].split("===");
		sec_id = sec_idname[0].split("***");
		sec_name = sec_idname[1].split("***");

		document.grid.grid_section.options.length=0;
		document.grid.grid_section.options[0]=new Option("Select","Select", true, false);
		for (i=0; i<sec_id.length; i++){
			//alert(sec_name[i]);
			document.grid.grid_section.options[i+1]=new Option(sec_name[i],sec_id[i], false, false);

		}


		line_idname = alldata[2].split("===");
		line_id = line_idname[0].split("***");
		line_name = line_idname[1].split("***");

		document.grid.grid_line.options.length=0;
		document.grid.grid_line.options[0]=new Option("Select","Select", true, false);
		for (i=0; i<line_id.length; i++){
			document.grid.grid_line.options[i+1]=new Option(line_name[i],line_id[i], false, false);

		}


		desig_idname = alldata[3].split("===");
		desig_id = desig_idname[0].split("***");
		desig_name = desig_idname[1].split("***");

		document.grid.grid_desig.options.length=0;
		document.grid.grid_desig.options[0]=new Option("Select","Select", true, false);
		for (i=0; i<desig_id.length; i++){
			document.grid.grid_desig.options[i+1]=new Option(desig_name[i],desig_id[i], false, false);

		}

		var sex_id = ["1","2"];
		var sex_name = ["Male","Female"];

		document.grid.grid_sex.options.length=0;
		document.grid.grid_sex.options[0]=new Option("Select","Select", true, false);
		for (i=0; i<sex_id.length; i++){
			document.grid.grid_sex.options[i+1]=new Option(sex_name[i],sex_id[i], false, false);

		}

		status_idname = alldata[4].split("===");
		status_id = status_idname[0].split("***");
		status_name = status_idname[1].split("***");

		document.grid.grid_status.options.length=0;
		//document.grid.grid_status.options[0]=new Option("Select","Select", true, false);
		for (i=0; i<status_id.length; i++){
			document.grid.grid_status.options[i]=new Option(status_name[i],status_id[i], false, false);

		}
		document.grid.grid_status.options[i]=new Option("ALL","ALL", true, true);

	$('#list1').jqGrid('GridUnload');

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_get_all_data";
	//var url = "http://localhost/payroll/index.php/grid_con/grid_get_all_data";
	main_grid(url)


	}
	}
}
function grid_all_search_for_salary()
{

	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

	var year_month = report_year_sal+"-"+report_month_sal;
	//alert(year_month);

	var dept 		= document.getElementById('grid_dept').value;
	var section 	= document.getElementById('grid_section').value;
	var line 		= document.getElementById('grid_line').value;
	var designation = document.getElementById('grid_desig').value;
	var sex = document.getElementById('grid_sex').value;
	var status = document.getElementById('grid_status').value;

	$('#list1').jqGrid('GridUnload');

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_all_search_for_salary/"+dept+"/"+section+"/"+line+"/"+designation+"/"+sex+"/"+status+"/"+year_month;
	//var url = "http://localhost/payroll/index.php/grid_con/grid_all_search/"+dept+"/"+section+"/"+line+"/"+designation;
	main_grid(url)
}
function grid_all_search()
{
	var dept 		= document.getElementById('grid_dept').value;
	var section 	= document.getElementById('grid_section').value;
	var line 		= document.getElementById('grid_line').value;
	var designation = document.getElementById('grid_desig').value;
	var sex = document.getElementById('grid_sex').value;
	var status = document.getElementById('grid_status').value;
	var start 		= document.getElementById('grid_start').value;
	$('#list1').jqGrid('GridUnload');

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_all_search/"+dept+"/"+section+"/"+line+"/"+designation+"/"+sex+"/"+status;
	//var url = "http://localhost/payroll/index.php/grid_con/grid_all_search/"+dept+"/"+section+"/"+line+"/"+designation;
	main_grid(url)
}

function grid_daily_present_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
	var status = "P";

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_daily_report/";

	// daily_present_report = window.open(url,'daily_present_report',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	// daily_present_report.moveTo(0,0);

	var ajaxRequest; 
    ajaxRequest = new XMLHttpRequest();	
	var queryString="firstdate="+firstdate+"&status="+status+"&spl="+spl;
    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			// var resp = ajaxRequest.responseText;
			var resp = ajaxRequest.responseText;	
			daily_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_report.document.write(resp);
			daily_report.stop();	
		}
	}
}
function eot_summary_report()
{
var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}
	var grid_status = document.getElementById('grid_status').value;
	//alert(grid_status);
	var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/eot_summary_report/"+sal_year_month+"/"+grid_status;

	eot_summary = window.open(url,'eot_summary',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	eot_summary.moveTo(0,0);
}

function grid_actual_present_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
	var status = "P";

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_actual_present_report/";

	// actual_present_report = window.open(url,'actual_present_report',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	// actual_present_report.moveTo(0,0);


	var ajaxRequest; 
    ajaxRequest = new XMLHttpRequest();	
	var queryString="firstdate="+firstdate+"&status="+status+"&spl="+spl;
    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			// var resp = ajaxRequest.responseText;
			var resp = ajaxRequest.responseText;	
			daily_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_report.document.write(resp);
			daily_report.stop();	
		}
	}
}

function grid_daily_absent_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));
	var status = "A";
	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_daily_report/";

	// daily_absent_report = window.open(url,'daily_absent_report',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	// daily_absent_report.moveTo(0,0);

	var ajaxRequest; 
    ajaxRequest = new XMLHttpRequest();	
	var queryString="firstdate="+firstdate+"&status="+status+"&spl="+spl;
    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			// var resp = ajaxRequest.responseText;
			var resp = ajaxRequest.responseText;	
			daily_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_report.document.write(resp);
			daily_report.stop();	
		}
	}
}

function grid_daily_leave_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	var status = "L";

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_daily_report/";

	// daily_leave_report = window.open(url,'daily_leave_report',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	// daily_leave_report.moveTo(0,0);



	var ajaxRequest; 
    ajaxRequest = new XMLHttpRequest();	
	var queryString="firstdate="+firstdate+"&status="+status+"&spl="+spl;
    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			// var resp = ajaxRequest.responseText;
			var resp = ajaxRequest.responseText;	
			daily_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_report.document.write(resp);
			daily_report.stop();	
		}
	}
}

function grid_daily_late_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_daily_late_report/";

	// daily_late_report = window.open(url,'daily_late_report',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	// daily_late_report.moveTo(0,0);


	var ajaxRequest; 
    ajaxRequest = new XMLHttpRequest();	
	var queryString="firstdate="+firstdate+"&spl="+spl;
    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			// var resp = ajaxRequest.responseText;
			var resp = ajaxRequest.responseText;	
			daily_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_report.document.write(resp);
			daily_report.stop();	
		}
	}
}

function grid_daily_out_punch_miss_report()
{	
	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
 
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_daily_out_punch_miss_report/";
	var queryString="firstdate="+firstdate+"&spl="+spl;
    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			// var resp = ajaxRequest.responseText;
			var resp = ajaxRequest.responseText;	
			daily_tiffin_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_tiffin_report.document.write(resp);
			daily_tiffin_report.stop();	
		}
	}

}

function grid_daily_out_in_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_daily_out_in_report/";

	// daily_out_punch = window.open(url,'daily_out_punch',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	// daily_out_punch.moveTo(0,0);

	var ajaxRequest; 
    ajaxRequest = new XMLHttpRequest();	
	var queryString="firstdate="+firstdate+"&spl="+spl;
    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			// var resp = ajaxRequest.responseText;
			var resp = ajaxRequest.responseText;	
			daily_tiffin_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_tiffin_report.document.write(resp);
			daily_tiffin_report.stop();	
		}
	}


}

function grid_daily_punch_report()
{
	alert('ok')
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}

	var f_time = document.getElementById('f_time').value;
	if(f_time =='')
	{
		alert("Please select First time");
		return;
	}

	var s_time = document.getElementById('s_time').value;
	if(s_time =='')
	{
		alert("Please select Second time");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_daily_punch_report/";

	// daily_out_punch = window.open(url,'daily_out_punch',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	// daily_out_punch.moveTo(0,0);

	var ajaxRequest; 
    ajaxRequest = new XMLHttpRequest();	
	var queryString="firstdate="+firstdate+"&f_time"+f_time+"&s_time"+s_time+"&spl="+spl;
    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			// var resp = ajaxRequest.responseText;
			var resp = ajaxRequest.responseText;	
			daily_tiffin_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_tiffin_report.document.write(resp);
			daily_tiffin_report.stop();	
		}
	}
}

function grid_continuous_present_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	var status = "P";
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_continuous_report/"+firstdate+"/"+seconddate+"/"+status+"/"+spl;

	contin_present = window.open(url,'contin_present',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	contin_present.moveTo(0,0);
}

function grid_continuous_absent_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	var status = "A";
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_continuous_report/"+firstdate+"/"+seconddate+"/"+status+"/"+spl;

	contin_absent = window.open(url,'contin_absent',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	contin_absent.moveTo(0,0);
}

function grid_continuous_leave_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	var status = "L";
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_continuous_report/"+firstdate+"/"+seconddate+"/"+status+"/"+spl;

	contin_absent = window.open(url,'contin_absent',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	contin_absent.moveTo(0,0);
}


function grid_yearly_leave_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	/*var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}*/

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	var status = "L";
	hostname = window.location.hostname;
	// url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_continuous_report/"+firstdate+"/"+seconddate+"/"+status+"/"+spl;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_yearly_report/"+firstdate+"/"+status+"/"+spl;

	contin_absent = window.open(url,'contin_absent',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	contin_absent.moveTo(0,0);
}

function grid_continuous_late_report()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	var status = "L";
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_continuous_late_report/"+firstdate+"/"+seconddate+"/"+spl;

	contin_absent = window.open(url,'contin_absent',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	contin_absent.moveTo(0,0);
}


function grid_continuous_incre_report()
{
	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}


	
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/continuous_incre_report/";
	var queryString="firstdate="+firstdate+"&seconddate="+seconddate+"&spl="+spl;
    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			// var resp = ajaxRequest.responseText;
			var resp = ajaxRequest.responseText;	
			daily_tiffin_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_tiffin_report.document.write(resp);
			daily_tiffin_report.stop();	
		}
	}

}

function grid_continuous_prom_report()
{
	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/continuous_prom_report/";
	var queryString="firstdate="+firstdate+"&seconddate="+seconddate+"&spl="+spl;
    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			// var resp = ajaxRequest.responseText;
			var resp = ajaxRequest.responseText;	
			daily_tiffin_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_tiffin_report.document.write(resp);
			daily_tiffin_report.stop();	
		}
	}





}



function grid_app_letter()
{
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	var status = "L";
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_app_letter/"+spl;

	app_letter = window.open(url,'app_letter',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	app_letter.moveTo(0,0);
}


function grid_pay_slip()
{
		var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

var year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/grid_pay_slip"+"/"+year_month+"/"+spl;

	pay_slip = window.open(url,'pay_slip',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	pay_slip.moveTo(0,0);
}
function grid_pay_slip_without_ot()
{
		var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

var year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/grid_pay_slip_without_ot"+"/"+year_month+"/"+spl;

	pay_slip = window.open(url,'pay_slip',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	pay_slip.moveTo(0,0);
}
function grid_advance_pay_slip()
{
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

var year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/advance_pay_slip"+"/"+year_month+"/"+spl;

	advance_pay_slip = window.open(url,'advance_pay_slip',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	advance_pay_slip.moveTo(0,0);
}
function grid_provident_fund()
{
		var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

var year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/grid_provident_fund"+"/"+year_month+"/"+spl;

	provident_fund = window.open(url,'provident_fund',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	provident_fund.moveTo(0,0);
}

function grid_id_card()
{
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_id_card/"+spl;

	id_card = window.open(url,'id_card',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	id_card.moveTo(0,0);
}

function grid_id_card_english()
{
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_id_card_english/"+spl;

	id_card_english = window.open(url,'id_card_english',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	id_card_english.moveTo(0,0);
}

function grid_job_card()
{

    var ajaxRequest;  // The variable that makes Ajax possible!
    ajaxRequest = new XMLHttpRequest();

	// alert("KO");return false;
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;

	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_job_card/";
	var queryString="firstdate="+firstdate+"&seconddate="+seconddate+"&spl="+spl;
	ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;	
			job_card = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			job_card.document.write(resp);
			job_card.stop();	
		}
	}




}
function grid_job_card_without_ot()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_job_card_without_ot/"+firstdate+"/"+seconddate+"/"+spl;

	job_card = window.open(url,'job_card',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	job_card.moveTo(0,0);
}
function grid_advance_job_card()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/advance_job_card/"+firstdate+"/"+seconddate+"/"+spl;

	advance_job_card = window.open(url,'advance_job_card',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	advance_job_card.moveTo(0,0);
}
function grid_pf_statement()
{
	var year  = document.getElementById('report_year_sal').value;
	var month = document.getElementById('report_month_sal').value;

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_pf_statement/"+year+"/"+month+"/"+spl;

	pf_statement = window.open(url,'pf_statement',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	pf_statement.moveTo(0,0);
}


function grid_monthly_att_register()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date for month and year selection");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_monthly_att_register/"+firstdate+"/"+spl;

	monthly_att_register = window.open(url,'monthly_att_register',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	monthly_att_register.moveTo(0,0);
}

function grid_extra_ot()
{
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_extra_ot/"+firstdate+"/"+seconddate+"/"+spl;

	extra_ot = window.open(url,'extra_ot',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	extra_ot.moveTo(0,0);
}

function grid_earn_leave(){
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl ==''){
		alert("Please select Employee ID");
		return;
	}
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_earn_leave_report/"+spl;

	grid_earn_leave_report = window.open(url,'grid_earn_leave_report',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	grid_earn_leave_report.moveTo(0,0);
}


function manual_attendance_entry()
{

	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	var manual_time = document.getElementById('manual_time').value;
	if(manual_time =='')
	{
		alert("Please select Time");
		return;
	}

	var okyes;
 okyes=confirm('Are you sure you want to insert attendance?');
if(okyes==false) return;

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/entry_system_con/manual_attendance_entry/";

	/*extra_ot = window.open(url,'extra_ot',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	extra_ot.moveTo(0,0);*/

	var queryString="firstdate="+firstdate+"&seconddate="+seconddate+"&manual_time="+manual_time+"&spl="+spl;

    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);

ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		var resp = ajaxRequest.responseText;
		alert(resp);
	}
}
}

function manual_entry_Delete()
{

	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}

	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	var okyes;
 okyes=confirm('Are you sure you want to delete?');
if(okyes==false) return;

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/entry_system_con/manual_entry_Delete/";

	/*extra_ot = window.open(url,'extra_ot',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	extra_ot.moveTo(0,0);*/

	var queryString="firstdate="+firstdate+"&seconddate="+seconddate+"&spl="+spl;

    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);

ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		var resp = ajaxRequest.responseText;
		alert(resp);
	}
}
}

function save_work_off()
{

	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	var okyes;
 okyes=confirm('Are you sure you want to insert weekend?');
if(okyes==false) return;

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/entry_system_con/save_work_off/";

	/*extra_ot = window.open(url,'extra_ot',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	extra_ot.moveTo(0,0);*/

	var queryString="firstdate="+firstdate+"&spl="+spl;

    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);

ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		var resp = ajaxRequest.responseText;
		alert(resp);
	}
}
}

function save_holiday()
{

	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
	var holiday_description = document.getElementById('holiday_description').value;
	if(holiday_description =='')
	{
		alert("Please insert holiday description");
		return;
	}

	var okyes;
 okyes=confirm('Are you sure you want to insert holiday?');
if(okyes==false) return;

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/entry_system_con/save_holiday/";

	/*extra_ot = window.open(url,'extra_ot',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	extra_ot.moveTo(0,0);
	*/

	var queryString="firstdate="+firstdate+"&seconddate="+seconddate+"&holiday_description="+holiday_description+"&spl="+spl;

    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);

ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		var resp = ajaxRequest.responseText;
		alert(resp);
	}
}
}

function grid_monthly_salary_sheet()
{
	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}
	var grid_section = document.getElementById('grid_section').value;
	var grid_status = document.getElementById('grid_status').value;
	var grid_line = document.getElementById('grid_line').value;

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}


var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/grid_monthly_salary_sheet/"+sal_year_month+"/"+grid_status+"/"+spl+"/"+grid_section+"/"+grid_line;

	sal_sheet = window.open(url,'sal_sheet',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	sal_sheet.moveTo(0,0);


}

function grid_staff_salary_sheet()
{
	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}
	var grid_section = document.getElementById('grid_section').value;
	var grid_status = document.getElementById('grid_status').value;

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}


var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/grid_staff_salary_sheet/"+sal_year_month+"/"+grid_status+"/"+spl+"/"+grid_section;

	staff_salary_sheet = window.open(url,'staff_salary_sheet',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	staff_salary_sheet.moveTo(0,0);


}


function grid_monthly_eot_sheet()
{
	var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	var grid_line = document.getElementById('grid_line').value;
	var grid_status = document.getElementById('grid_status').value;
	var grid_section = document.getElementById('grid_section').value;

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}


var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/grid_monthly_eot_sheet/"+sal_year_month+"/"+grid_status+"/"+spl+"/"+grid_section+"/"+grid_line;

	eot_sheet = window.open(url,'eot_sheet',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	eot_sheet.moveTo(0,0);


}

function grid_actual_monthly_salary_sheet()
{
	// alert('ok')
	 var ajaxRequest;  // The variable that makes Ajax possible!

	 try{
	   // Opera 8.0+, Firefox, Safari
	   ajaxRequest = new XMLHttpRequest();
	 }catch (e){
	   // Internet Explorer Browsers
	   try{
	      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	   }catch (e) {
	      try{
	         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	      }catch (e){
	         // Something went wrong
	         alert("Your browser broke!");
	         return false;
	      }
	   }
	 }
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	var grid_status = document.getElementById('grid_status').value;
	var grid_section = document.getElementById('grid_section').value;
	var grid_line = document.getElementById('grid_line').value;

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}


	var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/grid_actual_monthly_salary_sheet/"+sal_year_month+"/"+grid_status+"/"+spl+"/"+grid_section+"/"+grid_line;

	sal_sheet_actual = window.open(url,'sal_sheet_actual',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	sal_sheet_actual.moveTo(0,0);
}

function grid_actual_monthly_salary_sheet_without_ot()
{
	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	var grid_status = document.getElementById('grid_status').value;
	var grid_section = document.getElementById('grid_section').value;
	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}


var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/grid_actual_monthly_salary_sheet_without_ot/"+sal_year_month+"/"+grid_status+"/"+spl+"/"+grid_section;

	sal_sheet_actual = window.open(url,'sal_sheet_actual',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	sal_sheet_actual.moveTo(0,0);


}


function grid_actual_monthly_salary_sheet_with_eot()
{
	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	var grid_status = document.getElementById('grid_status').value;

	var grid_section = document.getElementById('grid_section').value;

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}


	var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/grid_actual_monthly_salary_sheet_with_eot/"+sal_year_month+"/"+grid_status+"/"+spl+"/"+grid_section;

	sal_sheet_actual_with_eot = window.open(url,'sal_sheet_actual_with_eot',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	sal_sheet_actual_with_eot.moveTo(0,0);


}

function grid_festival_bonus()
{
	var ajaxRequest;  // The variable that makes Ajax possible!

	try{
	   // Opera 8.0+, Firefox, Safari
	   ajaxRequest = new XMLHttpRequest();
	}catch (e){
	   // Internet Explorer Browsers
	   try{
	      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	   }catch (e) {
	      try{
	         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	      }catch (e){
	         // Something went wrong
	         alert("Your browser broke!");
	         return false;
	      }
	   }
	}
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	var grid_status = document.getElementById('grid_status').value;
	var grid_section = document.getElementById('grid_section').value;
	var grid_line = document.getElementById('grid_line').value;

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}


	var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/grid_festival_bonus/"+sal_year_month+"/"+grid_status+"/"+spl+"/"+grid_line+"/"+grid_section;

	festival_bonus = window.open(url,'festival_bonus',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	festival_bonus.moveTo(0,0);
}

function grid_festival_bonus_bank()
{
	var ajaxRequest;  // The variable that makes Ajax possible!

	try{
	   // Opera 8.0+, Firefox, Safari
	   ajaxRequest = new XMLHttpRequest();
	}catch (e){
	   // Internet Explorer Browsers
	   try{
	      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	   }catch (e) {
	      try{
	         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	      }catch (e){
	         // Something went wrong
	         alert("Your browser broke!");
	         return false;
	      }
	   }
	}
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	var grid_status = document.getElementById('grid_status').value;
	var grid_section = document.getElementById('grid_section').value;
	var grid_line = document.getElementById('grid_line').value;

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}


	var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";


	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/grid_festival_bonus_bank/";
	var queryString="salary_year="+sal_year_month+"&status="+grid_status+"&spl="+spl+"&line="+grid_line+"&section="+grid_section;

    // $(".clearfix").dialog("open");
    ajaxRequest.open("POST", url, true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
    ajaxRequest.send(queryString);
	
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;
			// $(".clearfix").dialog("close");		
			festival_bonus = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			festival_bonus.document.write(resp);
			festival_bonus.stop();			
		}
	}





}


function grid_advance_salary_sheet()
{
	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	var grid_status = document.getElementById('grid_status').value;

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}


var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/grid_advance_salary_sheet/"+sal_year_month+"/"+grid_status+"/"+spl;

	advance_salary_sheet = window.open(url,'advance_salary_sheet',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	advance_salary_sheet.moveTo(0,0);
}
function grid_advance_monthly_salary_sheet()
{
	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	var grid_section = document.getElementById('grid_section').value;
	var grid_status = document.getElementById('grid_status').value;
	var grid_line = document.getElementById('grid_line').value;

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}


	var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/advance_monthly_salary_sheet/"+sal_year_month+"/"+grid_status+"/"+spl+"/"+grid_section+"/"+grid_line;

	advance_monthly_salary_sheet = window.open(url,'advance_monthly_salary_sheet',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	advance_monthly_salary_sheet.moveTo(0,0);
}

function grid_range_salary_sheet()
{
	var ajaxRequest;  // The variable that makes Ajax possible!
	try{
	   // Opera 8.0+, Firefox, Safari
	   ajaxRequest = new XMLHttpRequest();
	}catch (e){
	   // Internet Explorer Browsers
	   try{
	      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	   }catch (e) {
	      try{
	         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	      }catch (e){
	         // Something went wrong
	         alert("Your browser broke!");
	         return false;
	      }
	   }
	}
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	var grid_section = document.getElementById('grid_section').value;
	var grid_status = document.getElementById('grid_status').value;
	var grid_line = document.getElementById('grid_line').value;

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}


	var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/range_salary_sheet/"+sal_year_month+"/"+grid_status+"/"+spl+"/"+grid_section+"/"+grid_line;

	range_salary_sheet = window.open(url,'range_salary_sheet',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	range_salary_sheet.moveTo(0,0);
}
function grid_range_salary_sheet_bank()
{
	var ajaxRequest;  // The variable that makes Ajax possible!
	try{
	   // Opera 8.0+, Firefox, Safari
	   ajaxRequest = new XMLHttpRequest();
	}catch (e){
	   // Internet Explorer Browsers
	   try{
	      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	   }catch (e) {
	      try{
	         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	      }catch (e){
	         // Something went wrong
	         alert("Your browser broke!");
	         return false;
	      }
	   }
	}
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	var grid_section = document.getElementById('grid_section').value;
	var grid_status = document.getElementById('grid_status').value;
	var grid_line = document.getElementById('grid_line').value;

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/bank_advanced_salary_sheet/";
	var queryString="salary_year="+sal_year_month+"&status="+grid_status+"&spl="+spl+"&line="+grid_line+"&section="+grid_section;
    ajaxRequest.open("POST", url, true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
    ajaxRequest.send(queryString);
	
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;
			// $(".clearfix").dialog("close");		
			   advanced_bonus = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			   advanced_bonus.document.write(resp);
		   	   advanced_bonus.stop();			
		}
	}







}


function sal_summary_report(){
	var ajaxRequest;  // The variable that makes Ajax possible!
 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select'){
		alert("Please select Category");
		return;
	}
	var grid_status = document.getElementById('grid_status').value;

	var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/salary_summary/"+sal_year_month+"/"+grid_status;

	sal_sheet = window.open(url,'sal_sheet',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	sal_sheet.moveTo(0,0);


}
function sal_summary_with_ot_eot(i){
	var ajaxRequest;  // The variable that makes Ajax possible!
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	}catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		}catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			}catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal ==''){
		alert("Please select month");
		return;
	}
	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal ==''){
		alert("Please select year");
		return;
	}
	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select'){
		alert("Please select Category");
		return;
	}
	var grid_status = document.getElementById('grid_status').value;
	var ot_eot = i;// 'ot_sum' for OT || 'eot_sum' for EOT

	var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";
	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/sal_summary_with_ot_eot/"+sal_year_month+"/"+grid_status+"/"+ot_eot;

	sal_sheet = window.open(url,'sal_sheet',"menubar=0,resizable=1,scrollbars=1,width=1600,height=800");
	sal_sheet.moveTo(0,0);
}

function grid_general_info()
{

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}


	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_general_info/";

	/*gen_info = window.open(url,'gen_info',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	gen_info.moveTo(0,0);*/

	var ajaxRequest; 
    ajaxRequest = new XMLHttpRequest();	
	var queryString="&spl="+spl;
    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			// var resp = ajaxRequest.responseText;
			var resp = ajaxRequest.responseText;	
			daily_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_report.document.write(resp);
			daily_report.stop();	
		}
	}
}



function grid_new_join_report()
{


	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }


	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}

	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	var grid_status = document.getElementById('grid_status').value;
	if(grid_status != 1)
	{
		alert("Please select category status to Regular");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_new_join_report/";
	var queryString="firstdate="+firstdate+"&seconddate="+seconddate+"&spl="+spl;
    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;	
			daily_tiffin_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_tiffin_report.document.write(resp);
			daily_tiffin_report.stop();	
		}
	}

}

function grid_resign_report()
{


	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }


	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}

	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	var grid_status = document.getElementById('grid_status').value;
	if(grid_status != 4)
	{
		alert("Please select category status to Resign");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}



	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_resign_report/";
	var queryString="firstdate="+firstdate+"&seconddate="+seconddate+"&spl="+spl;
    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;	
			daily_tiffin_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_tiffin_report.document.write(resp);
			daily_tiffin_report.stop();	
		}
	}


}

function grid_left_report()
{


	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }


	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}

	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	var grid_status = document.getElementById('grid_status').value;
	if(grid_status != 3)
	{
		alert("Please select category status to Left");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}



	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_left_report/";
	var queryString="firstdate="+firstdate+"&seconddate="+seconddate+"&spl="+spl;
    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			// var resp = ajaxRequest.responseText;
			var resp = ajaxRequest.responseText;	
			daily_tiffin_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_tiffin_report.document.write(resp);
			daily_tiffin_report.stop();		
			// alert(resp);
		}
	}



}

function grid_daily_eot()
{		 
	var ajaxRequest;  // The variable that makes Ajax possible!

	 try{
	   // Opera 8.0+, Firefox, Safari
	   ajaxRequest = new XMLHttpRequest();
	 }catch (e){
	   // Internet Explorer Browsers
	   try{
	      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	   }catch (e) {
	      try{
	         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	      }catch (e){
	         // Something went wrong
	         alert("Your browser broke!");
	         return false;
	      }
	   }
	 }


		var firstdate = document.getElementById('firstdate').value;
		if(firstdate =='')
		{
			alert("Please select First date");
			return;
		}

		var grid_start = document.getElementById('grid_start').value;
		if(grid_start =='Select')
		{
			alert("Please select Category options");
			return;
		}

		$grid  = $("#list1");
		var id_array = $grid.getGridParam('selarrrow');
		var selected_id_list = new Array();
		var spl = (id_array.join('xxx'));

		if(spl =='')
		{
			alert("Please select Employee ID");
			return;
		}

		hostname = window.location.hostname;
		url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_daily_eot/";

		// daily_eot = window.open(url,'daily_eot',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
		// daily_eot.moveTo(0,0);


	var queryString="firstdate="+firstdate+"&spl="+spl;
    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			// var resp = ajaxRequest.responseText;
			var resp = ajaxRequest.responseText;	
			daily_tiffin_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_tiffin_report.document.write(resp);
			daily_tiffin_report.stop();	
		}
	}


}


function grid_daily_eot_after_12_am()
{


	var ajaxRequest;  // The variable that makes Ajax possible!

	try{
	   // Opera 8.0+, Firefox, Safari
	   ajaxRequest = new XMLHttpRequest();
	}catch (e){
	    // Internet Explorer Browsers
	    try{
	      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	    }catch (e) {
	      try{
	         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	      }catch (e){
	         // Something went wrong
	         alert("Your browser broke!");
	         return false;
	      }
	    }
	}


		var firstdate = document.getElementById('firstdate').value;
		if(firstdate =='')
		{
			alert("Please select First date");
			return;
		}		
		var seconddate = document.getElementById('seconddate').value;


		var grid_start = document.getElementById('grid_start').value;
		if(grid_start =='Select')
		{
			alert("Please select Category options");
			return;
		}

		$grid  = $("#list1");
		var id_array = $grid.getGridParam('selarrrow');
		var selected_id_list = new Array();
		var spl = (id_array.join('xxx'));

		if(spl =='')
		{
			alert("Please select Employee ID");
			return;
		}

		hostname = window.location.hostname;
		url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_daily_eot_after_12_am/";

		// daily_eot = window.open(url,'daily_eot',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
		// daily_eot.moveTo(0,0);
		var queryString="firstdate="+firstdate+"&seconddate="+seconddate+"&spl="+spl;
	    ajaxRequest.open("POST", url, true);
	 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	 	ajaxRequest.send(queryString);
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				// var resp = ajaxRequest.responseText;
				var resp = ajaxRequest.responseText;	
				daily_tiffin_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
				daily_tiffin_report.document.write(resp);
				daily_tiffin_report.stop();	
			}
		}

}

function tiffin_bill_after_12_am()
{
	// console.log('KO');
	// return false;
	var ajaxRequest;  // The variable that makes Ajax possible!

	try{
	   // Opera 8.0+, Firefox, Safari
	   ajaxRequest = new XMLHttpRequest();
	}catch (e){
	    // Internet Explorer Browsers
	    try{
	      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	    }catch (e) {
	        try{
	           ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	        }catch (e){
	           // Something went wrong
	           alert("Your browser broke!");
	           return false;
	        }
	    }
	}


	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}

	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/tiffin_bill_after_12_am/";

	// tiffin_bill = window.open(url,'tiffin_bill',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	// tiffin_bill.moveTo(0,0);

	// hostname = window.location.href; hostname = hostname.substring(0, (hostname.indexOf("index.php") == -1)?hostname.length:hostname.indexOf("index.php"));
 //    url =  hostname+"index.php/grid_con/tiffin_bill_after_12_am/";
	var queryString="firstdate="+firstdate+"&seconddate="+seconddate+"&spl="+spl;
    // $(".clearfix").dialog("open");
    ajaxRequest.open("POST", url, true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
    ajaxRequest.send(queryString);
	
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;	
			daily_tiffin_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_tiffin_report.document.write(resp);
			daily_tiffin_report.stop();			
		}
	}
}



function tiffin_bill_10pm_to_12am()
{
	// console.log('KO');
	// return false;
	var ajaxRequest;  // The variable that makes Ajax possible!

	try{
	   // Opera 8.0+, Firefox, Safari
	   ajaxRequest = new XMLHttpRequest();
	}catch (e){
	    // Internet Explorer Browsers
	    try{
	      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	    }catch (e) {
	        try{
	           ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	        }catch (e){
	           // Something went wrong
	           alert("Your browser broke!");
	           return false;
	        }
	    }
	}


	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}

	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/tiffin_bill_10pm_to_12am/";

	// tiffin_bill = window.open(url,'tiffin_bill',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	// tiffin_bill.moveTo(0,0);

	// hostname = window.location.href; hostname = hostname.substring(0, (hostname.indexOf("index.php") == -1)?hostname.length:hostname.indexOf("index.php"));
 //    url =  hostname+"index.php/grid_con/tiffin_bill_after_12_am/";
	var queryString="firstdate="+firstdate+"&seconddate="+seconddate+"&spl="+spl;
    // $(".clearfix").dialog("open");
    ajaxRequest.open("POST", url, true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
    ajaxRequest.send(queryString);
	
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;	
			daily_tiffin_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_tiffin_report.document.write(resp);
			daily_tiffin_report.stop();			
		}
	}
}







function grid_extra_ot_10pm()
{

	var ajaxRequest;  // The variable that makes Ajax possible!

	try{
	   // Opera 8.0+, Firefox, Safari
	   ajaxRequest = new XMLHttpRequest();
	}catch (e){
	    // Internet Explorer Browsers
	    try{
	      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	    }catch (e) {
	        try{
	           ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	        }catch (e){
	           // Something went wrong
	           alert("Your browser broke!");
	           return false;
	        }
	    }
	}
		
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.href; hostname = hostname.substring(0, (hostname.indexOf("index.php") == -1)?hostname.length:hostname.indexOf("index.php"));
	var queryString="firstdate="+firstdate+"&seconddate="+seconddate+"&spl="+spl;
    url =  hostname+"index.php/grid_con/grid_extra_ot_10pm/";

    $(".clearfix").dialog("open");
    ajaxRequest.open("POST", url, true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
    ajaxRequest.send(queryString);
	
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;
			$(".clearfix").dialog("close");
			daily_present_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_present_report.document.write(resp);
			daily_present_report.stop();			
		}
	}
}

function grid_monthly_eot_sheet_10pm()
{
	var ajaxRequest;  // The variable that makes Ajax possible!

	try{
	   // Opera 8.0+, Firefox, Safari
	   ajaxRequest = new XMLHttpRequest();
	}catch (e){
	    // Internet Explorer Browsers
	    try{
	      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	    }catch (e) {
	        try{
	           ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	        }catch (e){
	           // Something went wrong
	           alert("Your browser broke!");
	           return false;
	        }
	    }
	}

	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	var grid_line = document.getElementById('grid_line').value;
	var grid_status = document.getElementById('grid_status').value;
	var grid_section = document.getElementById('grid_section').value;

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}


	var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";
	// hostname = window.location.hostname;
	// url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/grid_monthly_eot_sheet/"+sal_year_month+"/"+grid_status+"/"+spl+"/"+grid_section+"/"+grid_line;
	// eot_sheet = window.open(url,'eot_sheet',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	// eot_sheet.moveTo(0,0);

	hostname = window.location.href; hostname = hostname.substring(0, (hostname.indexOf("index.php") == -1)?hostname.length:hostname.indexOf("index.php"));
	var queryString="sal_year_month="+sal_year_month+"&spl="+spl+"&grid_status="+grid_status+"&grid_section="+grid_section+"&grid_line="+grid_line;
    url =  hostname+"index.php/salary_report_con/grid_monthly_eot_sheet_10pm/";

    $(".clearfix").dialog("open");
    ajaxRequest.open("POST", url, true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
    ajaxRequest.send(queryString);
	
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;
			$(".clearfix").dialog("close");
			daily_present_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_present_report.document.write(resp);
			daily_present_report.stop();			
		}
	}
}

function grid_daily_ot()
{


	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }


	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_daily_ot/";

	// daily_ot = window.open(url,'daily_ot',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	// daily_ot.moveTo(0,0);

	var queryString="firstdate="+firstdate+"&spl="+spl;
    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			// var resp = ajaxRequest.responseText;
			var resp = ajaxRequest.responseText;	
			daily_tiffin_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_tiffin_report.document.write(resp);
			daily_tiffin_report.stop();	
		}
	}


}
function grid_daily_allowance_bills()
{


	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }


	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_daily_allowance_bills/";

	daily_allowance = window.open(url,'daily_allowance',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	daily_allowance.moveTo(0,0);
	var queryString="firstdate="+firstdate+"&spl="+spl;
    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			// var resp = ajaxRequest.responseText;
			var resp = ajaxRequest.responseText;	
			daily_tiffin_report = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			daily_tiffin_report.document.write(resp);
			daily_tiffin_report.stop();	
		}
	}

}

function grid_monthly_ot_register()
{


	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }


	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date for month selection");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_monthly_ot_register/"+firstdate+"/"+spl;

	monthly_ot = window.open(url,'monthly_ot',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	monthly_ot.moveTo(0,0);


}

function grid_monthly_eot_register()
{


	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }


	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date for month selection");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_monthly_eot_register/"+firstdate+"/"+spl;

	monthly_eot = window.open(url,'monthly_eot',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	monthly_eot.moveTo(0,0);


}

function grid_maternity_benefit()
{


	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
    //var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/grid_maternity_benefit/"+spl;

	maternity_sheet = window.open(url,'maternity_sheet',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	maternity_sheet.moveTo(0,0);


}

function grid_out_time_summary_report()
{
	var ajaxRequest;  // The variable that makes Ajax possible!
	 try{
	   // Opera 8.0+, Firefox, Safari
	   ajaxRequest = new XMLHttpRequest();
	 }catch (e){
	   // Internet Explorer Browsers
	   try{
	      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	   }catch (e) {
	      try{
	         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	      }catch (e){
	         // Something went wrong
	         alert("Your browser broke!");
	         return false;
	      }
	   }
	 }
	 	var firstdate = document.getElementById('firstdate').value;
		if(firstdate =='')
		{
			alert("Please select First date");
			return;
		}

		var grid_start = document.getElementById('grid_start').value;
		if(grid_start =='Select'){
			alert("Please select Category");
			return;
		}
		var grid_status = document.getElementById('grid_status').value;

		// var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

		hostname = window.location.hostname;
		url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_out_time_summary/"+firstdate+"/"+grid_status;

		out_time_summary = window.open(url,'out_time_summary',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
		out_time_summary.moveTo(0,0);


}



function grid_monthly_allowance_register()
{


	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }


	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date for month selection");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/grid_con/grid_monthly_allowance_register/"+firstdate+"/"+spl;

	monthly_allowance = window.open(url,'monthly_allowance',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	monthly_allowance.moveTo(0,0);


}



function grid_maternity_benefit()
{


	 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal =='')
	{
		alert("Please select year");
		return;
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}
    //var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans_me/index.php/salary_report_con/grid_maternity_benefit/"+spl;

	maternity_sheet = window.open(url,'maternity_sheet',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	maternity_sheet.moveTo(0,0);


}

function main_grid(url)
{

jQuery("#list1").jqGrid({
url: url,
datatype: "json",
//width:'600px',
colModel: [
	{name:'id',index:'id', width:100, label: 'EMP ID', hidden: false},
	{name:'emp_full_name',index:'emp_full_name', width:200, label: 'Full Name'}
	<!--{name:'emp_dob',index:'emp_dob', width:100, label: 'DOB'}-->

],
  rowNum:20000, rowList:[10,20,30],
 //imgpath: gridimgpath,
 pager: jQuery('#pager1'),
 sortname: 'emp_id',
 viewrecords: true,
 sortorder: "asc",
 multiselect:true
 }).navGrid('#pager1',{ edit:false, add:false, del: false });

}


// manual lunch leave antry to new customization 04-11-21
function manual_lunch_leave_entry()
{
	var ajaxRequest;  // The variable that makes Ajax possible!

	try{
	   // Opera 8.0+, Firefox, Safari
	   ajaxRequest = new XMLHttpRequest();
	}catch (e){
	   // Internet Explorer Browsers
	   try{
	      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	   }catch (e) {
	      try{
	         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	      }catch (e){
	         // Something went wrong
	         alert("Your browser broke!");
	         return false;
	      }
	   }
	}

	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}
	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	var manual_time = document.getElementById('lunch_leave').value;
	if(manual_time =='')
	{
		alert("Please select Time");
		return;
	}

	var okyes;
	 okyes=confirm('Are you sure you want to insert attendance?');
	if(okyes==false) return;

	// alert(manual_time +", "+ spl +", "+ firstdate +", "+ seconddate)
	

	hostname = window.location.href;
	hostname = hostname.substring(0, (hostname.indexOf("index.php") == -1) ? hostname.length:hostname.indexOf("index.php"));
	url = hostname+"index.php/entry_system_con/manual_lunch_leave_entry/";


	var queryString="firstdate="+firstdate+"&seconddate="+seconddate+"&manual_time="+manual_time+"&spl="+spl;

    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);

	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;
			alert(resp);
		}
	}
}

// manual lunch leave entry delete to new customization 04-11-21
function manual_lunch_leave_entry_delete()
{

	var ajaxRequest;  // The variable that makes Ajax possible!

	try{
	   // Opera 8.0+, Firefox, Safari
	   ajaxRequest = new XMLHttpRequest();
	}catch (e){
	   // Internet Explorer Browsers
	   try{
	      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	   }catch (e) {
	      try{
	         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	      }catch (e){
	         // Something went wrong
	         alert("Your browser broke!");
	         return false;
	      }
	   }
	}
	var firstdate = document.getElementById('firstdate').value;
	if(firstdate =='')
	{
		alert("Please select First date");
		return;
	}

	var seconddate = document.getElementById('seconddate').value;
	if(seconddate =='')
	{
		alert("Please select Second date");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	var okyes;
 	okyes=confirm('Are you sure you want to delete?');
	if(okyes==false) return;

	hostname = window.location.href;
	hostname = hostname.substring(0, (hostname.indexOf("index.php") == -1) ? hostname.length:hostname.indexOf("index.php"));
	url = hostname+"index.php/entry_system_con/manual_lunch_leave_entry_delete/";

	var queryString="firstdate="+firstdate+"&seconddate="+seconddate+"&spl="+spl;

    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);

	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;
			alert(resp);
		}
	}
}

//ZuelAli, 211109
function grid_half_ot_sheet(){
	var ajaxRequest;  // The variable that makes Ajax possible!

	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	}catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		}catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			}catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal ==''){alert("Please select month");return;}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal ==''){alert("Please select year");return;}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select'){alert("Please select Category options");return;}

	var grid_line = document.getElementById('grid_line').value;
	var grid_status = document.getElementById('grid_status').value;
	var grid_section = document.getElementById('grid_section').value;

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl ==''){alert("Please select Employee ID");return;}


	var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	hostname = window.location.hostname;
	// url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/grid_monthly_eot_sheet/"+sal_year_month+"/"+grid_status+"/"+spl+"/"+grid_section+"/"+grid_line;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/grid_half_ot_sheet/"+sal_year_month+"/"+grid_status+"/"+spl+"/"+grid_section+"/"+grid_line;

	eot_sheet = window.open(url,'eot_sheet',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	eot_sheet.moveTo(0,0);
}

function grid_absent_basic_amt(){
	var ajaxRequest;  // The variable that makes Ajax possible!

	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	}catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		}catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			}catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	var report_month_sal = document.getElementById('report_month_sal').value;
	if(report_month_sal ==''){alert("Please select month");return;}

	var report_year_sal = document.getElementById('report_year_sal').value;
	if(report_year_sal ==''){alert("Please select year");return;}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select'){alert("Please select Category options");return;}
	
	var grid_line = document.getElementById('grid_line').value;

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl ==''){alert("Please select Employee ID");return;}

	var sal_year_month = report_year_sal+"-"+report_month_sal+"-"+"01";

	hostname = window.location.hostname;
	url =  "http://"+hostname+"/erp_jeans/index.php/salary_report_con/grid_absent_basic_amt/"+sal_year_month+"/"+spl+"/"+grid_line;

	eot_sheet = window.open(url,'eot_sheet',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	eot_sheet.moveTo(0,0);
}


// new customization of 2022-07-27
function bank_salary_report()
{

	var ajaxRequest;  // The variable that makes Ajax possible!

	try{
	   // Opera 8.0+, Firefox, Safari
	   ajaxRequest = new XMLHttpRequest();
	}catch (e){
	    // Internet Explorer Browsers
	    try{
	      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	    }catch (e) {
	        try{
	           ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	        }catch (e){
	           // Something went wrong
	           alert("Your browser broke!");
	           return false;
	        }
	    }
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	var month_sal = document.getElementById('report_month_sal').value;
	if(month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var year_sal = document.getElementById('report_year_sal').value;
	if(year_sal =='')
	{
		alert("Please select year");
		return;
	}

	var grid_status = document.getElementById('grid_status').value;
	if(grid_status =='Select')
	{
		alert("Please select Status options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	var sal_year_month = year_sal+"-"+month_sal+"-"+"01";
	hostname = window.location.href; hostname = hostname.substring(0, (hostname.indexOf("index.php") == -1)?hostname.length:hostname.indexOf("index.php"));
	
	var queryString="sal_year_month="+sal_year_month+"&grid_status="+grid_status+"&spl="+spl;
	// alert(queryString);

   url =  hostname+"index.php/salary_report_con/bank_salary_report/";
    // $(".clearfix").dialog("open");
   ajaxRequest.open("POST", url, true);
   ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
   ajaxRequest.send(queryString);
	
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;
			// $(".clearfix").dialog("close");		
			bank_salary = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1200,height=800');
			bank_salary.document.write(resp);
			bank_salary.stop();			
		}
	}
}

function bank_eot_sheet()
{

	var ajaxRequest;  // The variable that makes Ajax possible!

	try{
	   // Opera 8.0+, Firefox, Safari
	   ajaxRequest = new XMLHttpRequest();
	}catch (e){
	    // Internet Explorer Browsers
	    try{
	      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	    }catch (e) {
	        try{
	           ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	        }catch (e){
	           // Something went wrong
	           alert("Your browser broke!");
	           return false;
	        }
	    }
	}

	var grid_start = document.getElementById('grid_start').value;
	if(grid_start =='Select')
	{
		alert("Please select Category options");
		return;
	}

	var month_sal = document.getElementById('report_month_sal').value;
	if(month_sal =='')
	{
		alert("Please select month");
		return;
	}

	var year_sal = document.getElementById('report_year_sal').value;
	if(year_sal =='')
	{
		alert("Please select year");
		return;
	}

	var grid_status = document.getElementById('grid_status').value;
	if(grid_status =='Select')
	{
		alert("Please select Status options");
		return;
	}

	$grid  = $("#list1");
	var id_array = $grid.getGridParam('selarrrow');
	var selected_id_list = new Array();
	var spl = (id_array.join('xxx'));

	if(spl =='')
	{
		alert("Please select Employee ID");
		return;
	}

	var sal_year_month = year_sal+"-"+month_sal+"-"+"01";
	hostname = window.location.href; hostname = hostname.substring(0, (hostname.indexOf("index.php") == -1)?hostname.length:hostname.indexOf("index.php"));
	
	var queryString="sal_year_month="+sal_year_month+"&grid_status="+grid_status+"&spl="+spl;
	// alert(queryString);

   url =  hostname+"index.php/salary_report_con/bank_eot_sheet/";
    // $(".clearfix").dialog("open");
   ajaxRequest.open("POST", url, true);
   ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
   ajaxRequest.send(queryString);
	
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;
			// $(".clearfix").dialog("close");		
			bank_eot = window.open('', '_blank', 'menubar=1,resizable=1,scrollbars=1,width=1600,height=800');
			bank_eot.document.write(resp);
			bank_eot.stop();			
		}
	}
}
