
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ID Card English</title>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/id_card_style_english.css" />
<style type="text/css">

#container {
border:1px solid black;
width:3.75in;
height:3.35in;
overflow:hidden;
margin:0 auto;
}
#container #text{
 float:left;
 width:90px;
 height:100%;
 padding-left:5px;
 
}

.vText {
	-moz-transform: rotate(90deg) translate(0px, 100%);
	font-family: SolaimanLipi;
    font-size: 12px;
	line-height: 13px;
    font-style: italic;
    position: relative;
    top: 80px;
    width: 440px;
}
#container #id {
width:2.2in;
height:auto;
border-left: black 1px solid;
float:right;
position:relative;
font-family: SolaimanLipi;

}

#id #logo{
  float:left; 
 width:100%;
 height:auto;
 margin-top: 10px;
 }
 
 #id #image{
 width:100%;
 text-align:center;
 position:relative;
 float: left;
 height: 88px;
 top:5px;
 }

 #id #profile{
	bottom: 70px;
    float: left;
    font-size: 11px;
    height: auto;
    line-height: 16px;
    margin-left: 19px;
   
    position: relative;
    width: 95%;

  }

#id #sign {
   float: right;
    font-size: 11px;
    font-weight: bold;
    left: 45px;
    margin-top: 35px;
    position: absolute;
    text-align: right;
    top: 227px;
    width: 150px;
	}

</style>
</head>

<body>
<?php
//print_r($values);
$i = 0;
$k = 0;
//for($k=0; $k<=100; $k++)
$count = $values->num_rows();
$div_loop = ceil($count/6);
$data = $values->result_array();

for($j=1; $j<= $div_loop; $j++)
{
?>
<div style="width:8.4in; height:11.2in; overflow:hidden;">
	<table align="left" border="0" cellpadding="0" cellspacing="0">
	<tr>
	<?php
	//echo "Start".$k."<br>";
	//echo "End".$end = $k + 5;
	//echo "<br>";
	$end = $k + 5;
	$l = 0;
	if($j == $div_loop)
	{
		$end = $count - $div_loop;
	}
	
	for($k; $i <= $end; $i++)
	{
		//echo $i." | ";
		//echo $l;
		if($l % 2 == 0)
		{
			?>
			</tr><tr>
			<?php
		}
		?>
		<td style="width:4in; height:3.5in; "valign='top' align='center'>
	  <div id="container">
	  
		 <div id="text">
		 <div style="width:145px;">
         
         <p style="text-align:center; font-weight:bold; font-size:13px;height:5px;">Personal Information</p>
         <p style="text-align:left; font-size:12px; font-family:solaimanlipi; height:55px;"><strong>Address:</strong> 
		 <?php echo $data[$i]["emp_par_add"]; ?></p>
         <p style="text-align:left; font-size:12px;height:5px;"><strong>Mob:</strong> <?php echo $data[$i]["mobile"]; ?></p>
         <p style="text-align:left; font-size:12px;height:5px;"><strong>Blood Group: </strong>
		 <?php echo $data[$i]["blood_name"]; ?></p>
         <p style="text-align:left; font-size:12px;height:5px;"><strong>NID:</strong> <?php echo $data[$i]["nid"]; ?></p>
		
		 <!-- <p style="text-align:left; font-weight:bold; font-size:10px;"><br /><br />

		If Found Please Return To-<br />
	   
		 Jeans Manufacturing Co. Ltd.<br />
		Rishipara, Singair Road, Hemayetpur, Savar, <br />
		Dhaka-1340.<br />
		Phone : 88-02-9007719,
		 
		 </p> -->
		<p style="text-align:left; font-weight:bold; font-size:10px; padding: 1px !important">
				If Found Please Return To-<br />		 
		 </p>

		<p style="text-align:left; font-weight:bold; font-size:10px;">
 			Jeans Manufacturing Co. Ltd.<br />
			Head Office- 13/14 Mollik Tower, Zoo Road, Mirpur-01, Dhaka-1216 <br />
			<span style="margin-top: 5px !important; display: block;"></span>
			Factory- Rishipara, Singair Road, Hemayetpur, <br />
			Savar, Dhaka-1340<br />
			Phone: 88-02-9007719,
		</p>
		 
		  
		  	 <div id="logo"> 
         	 <div style="float:left; position:relative;">
			</div>
						
			
			
            <div style="font-size:12px; height:35px;width:130x; text-align:justify; padding:3px;"></div>
           
		  </div>
		   </div>
		 </div>
	
	
		 
		 <div id="id" align="center">	
		 
		  <div id="logo"> 
          <div style="float:left; position:relative; margin-left: 5px;">
			<img src="<?php  echo base_url();?>images/<?php echo $company_logo = $this->common_model->company_information("company_logo"); ?>" width="48" alt="LOGO" /></div><br />

			<div style=" margin:0 auto; width:100%; height:auto;font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;">
			<?php echo $company_name_english = $this->common_model->company_information("company_name_english"); ?>
			</div>
            <div style="font-size:12px;"></div>
		  </div>
		  <div id="image"  >
			<img border="1" src="<?php echo base_url();?>uploads/photo/<?php echo $data[$i]["img_source"];?>" height="80" width="65"/>
		  </div>
		  
		  <div id="profile" align="left">
		  <table cellpadding="1" cellspacing="0">
		  <tr>
		  <td width="43" valign="top"><b>Name</b> </td><td width="8" valign="top">:</td><td class="bangla"> <?php echo $data[$i]["emp_full_name"]; ?></td></tr>
			<tr>
		  <td><b>ID NO</b> </td><td>:</td><td > <?php echo $data[$i]["emp_id"] ?></td></tr>
		  
		  <tr>
			  <td><b>Line</b> </td><td>:</td><td nowrap="nowrap"> <?php echo $data[$i]["line_name"]; ?></td>
			 </tr>
			 
			<tr>
			  <td><b>Desig</b> </td><td>:</td><td nowrap="nowrap"> <?php echo $data[$i]["desig_name"]; ?></td>
			 </tr>
			<tr>
			  <td><b>Dept</b> </td><td>:</td><td nowrap="nowrap"> <?php echo $data[$i]["dept_name"]; ?></td></tr>
             <!-- <td><b>Line</b> </td><td>:</td><td nowrap="nowrap"> <?php echo $data[$i]["line_name"]; ?></td></tr> -->
			<tr><td><b>DOJ</b> </td><td>:</td><td><?php 
					$join_date = $data[$i]["emp_join_date"]; 
					$year=trim(substr($join_date,0,4));
					$month=trim(substr($join_date,5,2));
					$day=trim(substr($join_date,8,2));
					echo " ".$date_format = date("d-m-y", mktime(0, 0, 0, $month, $day, $year));
				?>	</td></tr>
                <!--<tr><td ><b>DOB</b> </td><td>:</td><td><?php echo $date = date('d-m-y',strtotime($data[$i]["emp_dob"])) ; ?></td></tr>-->
				<br/><br/><br/><br/><br/>
				</table>
		  </div>
		  
		 
          <div id="sign"> 
			<span><img src="<?php echo base_url();?>images/<?php echo $company_signature = $this->common_model->company_information("company_signature"); ?>" width="90" height="40" /></span>
			<br />
			<span style="right:25px; position:relative;">Holder&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Authority</span>
		 
		  </div>
		  
		</div>
	   
	  </div>
	  
	  </td>
	  <?php
	$k =$i+1;
	$l++;
	}
	?>
	</tr>
</table>

</div>
<br />
<?php
}
?>

</body>
</html>