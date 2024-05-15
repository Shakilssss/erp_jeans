<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ID Card Bangla</title>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/id_card_style_english.css" />
<style type="text/css">
p{
	margin: 3px;
	padding: 3px;
}
.bangla{
font-family:SolaimanLipi;
}
.bijoy{
font-family:SutonnyMJ;
font-size:13px;
}

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
 font-family:SutonnyMJ;
 
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
    font-size: 14px;
    height: auto;
    line-height: 16px;
    margin-left: 5px;
   
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
<div style="width:8.4in; height:13.2in; overflow:hidden;">
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
         
         <p style="text-align:left; font-weight:bold; font-size:12px;height:5px;">ব্যক্তিগত তথ্য</p>
         <p style="text-align:left; font-size:14px; font-family:solaimanlipi; height:40px;"><strong>স্থায়ী ঠিকানা:</strong> 
		 <spam><?php echo $data[$i]["per_add_bn"]; ?></spam>
		</p>

         <p style="text-align:left; font-size:12px;height:5px;"><strong>মোবাইল:</strong> <span style="font-size: 14px"><?php echo $data[$i]["mobile"]; ?></span></p>
         <p style="text-align:left; font-size:12px;height:5px;"><strong>রক্তের গ্রুপ: </strong>
		 <span style="font-family: 'Times New Roman';"><?php echo $data[$i]["blood_name"]; ?></span></p>
         
         <p style="text-align:left; font-size:12px;"><strong>জাতীয় পরিচয় পত্রের নং:</strong> <span style="font-size: 14px"><?php echo $data[$i]["nid"]; ?></span>
     	 </p>
		
		 <p style="text-align:left; font-weight:bold; font-size:10px; padding: 1px !important">
				উক্ত পরিচয়পত্র হারাইয়া গেলে তাৎক্ষনিক ব্যবন্থাপনা কর্তৃপক্ষকে জানাইতে হবে।<br />		 
		 </p>

		 <p style="text-align:left; font-weight:bold; font-size:10px;">
 			জিন্স ম্যানুফ্যাকচারিং কোঃ লিমিটেড<br />
			হেড অফিস- ১৩/১৪ মল্লিক টাওয়ার, চিড়িয়াখানা রোড, মিরপুর-০১, ঢাকা-১২১৬<br />
			<span style="margin-top: 5px !important; display: block;"></span>
			ফ্যাক্টরি- ঋষিপাড়া, সিংগাইর রোড, হেমায়েতপুর, <br />
			সাভার, ঢাকা-১৩৪০<br />
			ফোন: 88-02-9007719,
		 </p>

		  <div id="logo"> 
          <div style="float:left; position:relative;"></div>
			
           <div style="font-size:12px; height:35px;width:130x; text-align:justify; padding:3px;"></div>
           
		  </div>
		   </div>
		 </div>

		 <div id="id" align="center">	
		 
		  <div id="logo"> 
          <div style="float:left; position:relative; margin-left: 5px;">
			<img src="<?php  echo base_url();?>images/<?php echo $company_logo = $this->common_model->company_information("company_logo"); ?>" width="48" alt="LOGO" /></div><br />

			<div style=" margin:0 auto; width:100%; height:auto;font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;">
			<?php 
			 echo 'জিন্স ম্যানুফ্যাকচারিং কোঃ লিমিটেড';
			 //$company_name_english = $this->common_model->company_information("company_name_"); 
			?>
			</div>
            <div style="font-size:12px;"></div>
		  </div>
		  <div id="image"  >
			<img border="1" src="<?php echo base_url();?>uploads/photo/<?php echo $data[$i]["img_source"];?>" height="80" width="65"/>
		  </div>
		  
		  <div id="profile" align="left">
		  <table cellpadding="1" cellspacing="0">
		  <tr>
		  <td width="75" valign="top"><b>নাম</b> </td><td width="8" valign="top">:</td><td class="bangla" style="font-size: 15px;"> <?php echo $data[$i]["bangla_nam"]; ?></td></tr>
			<tr>
		  <td><b>কার্ড নং</b> </td><td>:</td><td > <?php echo $data[$i]["emp_id"] ?></td></tr>
		  
		    <tr>
			  <td><b>Line</b> </td><td>:</td><td nowrap="nowrap"> <?php echo $data[$i]["line_name"]; ?></td>
		    </tr>
			 
			<tr>
			  <td><b>পদবী</b> </td><td>:</td><td nowrap="nowrap"> <?php echo $data[$i]["desig_bangla"]; ?></td>
			 </tr>
			<tr>
			  <td><b>ডিপার্টমেন্ট</b> </td><td>:</td><td nowrap="nowrap"> <?php echo $data[$i]["dept_bn"]; ?></td></tr>

			<tr><td><b>যোগদানের তাং </b> </td><td>:</td><td><?php 
					$join_date = $data[$i]["emp_join_date"]; 
					$year=trim(substr($join_date,0,4));
					$month=trim(substr($join_date,5,2));
					$day=trim(substr($join_date,8,2));
					echo " ".$date_format = date("d-m-y", mktime(0, 0, 0, $month, $day, $year));
				?>	</td></tr>

				<br/><br/><br/><br/><br/>
				</table>
		  </div>
		 <table>
		 <tr>
          <td>
          	<div id="sign"  width="85" height="20" style="margin-top: 50px;"> 
			<span><img src="<?php echo base_url();?>images/<?php echo $company_signature = $this->common_model->company_information("company_signature"); ?>" width="85" height="20" /></span>
		
			<span style="right:10px; position:relative;font-size:13px;">স্বাক্ষর&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;কর্তৃপক্ষের স্বাক্ষর</span>
			</div>
		  </td>	
		  </tr>
		 </table> 
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