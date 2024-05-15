<!DOCTYPE html>
<html>
	<head>
		<title>Nominee Form</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<style>
			#wrapper {
				width: 1000px;
				margin: 0 auto;
			}
			table, td, th {
			  border: 1px solid black;
			}

		</style>
	</head>
  	<body>
  		<!-- < ?php echo "<pre>";print_r($values);exit;?> -->
		<?php foreach( $values as $row){?>
		    <div id="wrapper">
				<div id="header">
					<!-- < ?php $this->load->view('head_bangla');?> -->
					<h3 style="text-align: center"> জিন্স ম্যানুফ্যাকচারিং কোঃ লিঃ</h3>
					<p  style="text-align: center">ঋষিপাড়া, সিংগাইর রোড, হেমায়েতপুর, সাভার, ঢাকা-১৩৪০</p>
					<hr>
				</div>

			    <div style="font-weight:bold; text-align:center; font-family:SutonnyMJ; margin-top: -5px;">
			        <p style="font-size: 20px;"> নমিনী ফরম নং-41</p>
			        <p style="font-size: 16px;">
			        	[ aviv 19, 131 (1) (K), 155 (2), 234, 264, 265 I 273 Ges wewa 118 (1) 136, 232 (2), 262 (1), 289 (1) I 321 (1) `ªóe¨ 
			        </p> 
			        
			        <p style="font-size: 20px;">Rgv I wewfbœ Lv‡Z cÖvc¨ A_© cwi‡kv‡ai †Nvlbv I g‡bvq‡bi dig|</p> <br>
			    </div>
			    <br>

    	<div style=" font-size: 15px;">
        	<p> ১। কারখানা / প্রতিষ্ঠানের নাম &nbsp;:&nbsp;<span style="font-size: 15px;">জিন্স ম্যানুফ্যাকচারিং কোঃ লিঃ 
        	 		</span>
        	</p> 
		    <p> ২। কারখানা / প্রতিষ্ঠানের ঠিকানা &nbsp;:&nbsp; <span style="font-size: 15px;">ঋষিপাড়া, সিংগাইর রোড, 	
		    	হেমায়েতপুর, সাভার, ঢাকা-১৩৪০  </span> 
		    </p> 
		    <p> ৩। শ্রমিকের নাম &nbsp;:&nbsp;<span style="font-size:15px"><?php echo $row->bangla_nam; ?> </span> <p>
			<p>৪। ঠিকানা (বর্তমান) : &nbsp;
					<span style="font-size:14px;font-family:;">	
						<?php echo $row->pre_add_bn; ?></span> 
						&nbsp;&nbsp; লিঙ্গ :
						<span style="font-family:;font-size:15px;">
						 <?php echo $row->sex_name=="Female"?'মহিলা':'পুরুষ'?> 
						</span>
			</p>
	        <p>৫। পিতা/মাতা/স্বামী/ স্ত্রীর নাম : <span style="font-size:15px;font-family:serif;"><?php echo $row->emp_fname_bn; ?> </span></p>
	    	<p>৬। জন্ম তারিখ : <span style="font-size: 20px;font-family:SutonnyMJ;"><?php echo date('d-m-Y',strtotime($row->emp_dob));?></span></p>
	        <p>৭। সনাক্ত করণ চিহ্ন (যদি থাকে) : _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ </p>
	    	<p>৮। স্থায়ী ঠিকানা : &nbsp; <span style="font-size:15px"><?php echo $row->per_add_bn; ?></span></p>
			<p>৯। চাকরিতে নিযুক্তির তারিখ :  <span style="font-size: 20px;font-family:SutonnyMJ;"><?php echo date("d-m-Y", strtotime($row->emp_join_date)); ?> </span> </p>
	        <p>১০। পদের নাম : <span style="font-size:15px"><?php echo $row->desig_bangla; ?>  </p>
		 </div>

		        <br><br>
			    <div style="font-family:; font-size: 15px;">

			       <p style="text-align: justify;">
			       	    আমি এতদ্বারা ঘোষণা করিতাছি যে, আমার মৃত্যু হইলে বা আমার অবর্তমানে আমার অনুকুলে জমা ও বিভিন্ন খাতে প্রাপ্য	 টাকা গ্রহনের জন্য আমি নিম্নবর্ণিত ব্যক্তিকে / ব্যক্তিগনকে মনোয়ন দান করিতেছি এবং নির্দেশ দিচ্ছি যে, উক্ত টাকা নিম্নবর্ণিত পদ্ধতিতে মনোনীত ব্যক্তিদের মধ্যে বন্টন করিতে হইবে ।
			       	</p> 
			       	<br>

			        <table style="border-collapse: collapse; width: 100%; text-align: center;">
				       	<tr>
				       		<th style="width: 40%;">মনোনীত ব্যক্তি বা ব্যক্তিদের নাম,ঠিকানা ও ছবি(নমিনীর ছবি ও স্বাক্ষর শ্রমিক কর্তৃক সত্যায়িত) এন আই ডি নং</th>
				       		<th style="width: 20%;">সদস্যদের সহিত মনোনীত ব্যক্তিদের সম্পর্ক</th>
				       		<th style="width: 10%;">বয়স</th>
				       		<th style="width: 30%;" colspan="2">প্রত্যেক মনোনীত ব্যক্তিকে দেওয়া অংশ</th>
				       	</tr>
				       	<tr>
				       		<td>(১)</td>
				       		<td>(২)</td>
				       		<td>(৩)</td>
				       		<td style="width: 30px !important;"></td>
				       		<td style="width: 90px !important;">(৪)</td>
				       	</tr>
				       	<tr>
				       		<td></td>
				       		<td></td>
				       		<td></td>
				       		<td style="width: 30px !important;">জমাখাত</td>
				       		<td style="width: 90px !important;"></td>
				       	</tr>
				       	<tr>
				       		<td></td>
				       		<td></td>
				       		<td></td>
				       		<td style="width: 30px !important;">বকেয়াখাত</td>
				       		<td style="width: 90px !important;"></td>
				       	</tr>
				       	<tr>
				       		<td></td>
				       		<td></td>
				       		<td></td>
				       		<td style="width: 30px !important;">প্রভিডেন্ট ফান্ড</td>
				       		<td style="width: 90px !important;"></td>
				       	</tr>
				       	<tr>
				       		<td></td>
				       		<td></td>
				       		<td></td>
				       		<td style="width: 30px !important;">বীমা</td>
				       		<td style="width: 90px !important;"></td>
				       	</tr>
				       	<tr>
				       		<td></td>
				       		<td></td>
				       		<td></td>
				       		<td style="width: 30px !important;">দুর্ঘটনায় ক্ষতিপূরণ</td>
				       		<td style="width: 90px !important;"></td>
				       	</tr>
				       	<tr>
				       		<td></td>
				       		<td></td>
				       		<td></td>
				       		<td style="width: 30px !important;">অন্যান্য</td>
				       		<td style="width: 90px !important;"></td>
				       	</tr>
			        </table>

			        <br><br>
			        <div style="font-family:; font-size: 15px;">
			        	<span>প্রত্যয়ন করিতেছি যে, আমার উপস্থিতিতে জনাব _ _ _ _ _ _ _ _ _ _ _ _ _  _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ লিপিবদ্ধ বিবরণ সমূহ পাঠ করিবার পর উক্ত ঘোষণা স্বাক্ষর করিতেছেন </span>
			        </div>
			        
			        <br><br>
			        <div style="font-family:; font-size: 15px;">
			        	<span> মনোয়ন প্রদানকারীর স্বাক্ষর/টিপসই ও তারিখ: _ _ _ _ _ _ _ _ _ _ _ _ _  _ _ _ </span>
			        </div>
	
					
					<br><br><br><br>
     				<div style="width: 100%; display: inline-block;">
     					<div style="width: 33%; float: left; margin-top: 30px; ">
     						<span style="border-top: 1px solid; text-align: center;padding-top: 10px;">তারিখসহ মনোনীত ব্যক্তিদের</span> <br>  
     						<span style="text-align: center; margin-left: 10px;">স্বাক্ষর অথবা টিপসই</span> <br> 
     						<span style="text-align: center;"> ( শ্রমিক কর্তৃক সত্যায়িত ছবি )</span>
     					</div>

     					<div style="width: 33%; float: left; margin-left: 70px; margin-top: -30px; ">
     						<span style="width: 200px; height: 200px; border: 1px solid; display: block; "></span>

     						<span style="padding: 6px 10px; display: block;">মনোনীত ব্যক্তি বা ব্যক্তিদের ছবি</span><br>
     					</div>

     					<div style="width: 33%; float: right; margin-right: -120px; margin-top: 30px; ">
     						<!-- <span>Abywjwc eywSqv cvBjvg</span><br> -->
     						<span style="border-top: 1px solid;padding-top: 10px;">শ্রমিক বা কর্মচারীর স্বাক্ষর</span>
     						<br>
     						<br>
     						<span> তারিখ : ......................... </span>
     					</div>
     				</div>
			    </div>
		    </div>

		    <br><br>
		    <div style="page-break-after: always;"></div>
		<?php } ?>
  	</body>
</html>