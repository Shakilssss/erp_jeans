<!DOCTYPE html>
<html>
<head>
	<title>Appointment Letter</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/appointment_letter.css">	
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> -->	 
	<style type="text/css">
			@media print {
			   body {
			       display: table;
			       table-layout: fixed;
			       padding-top: 0.5cm;
			       padding-bottom: 0.5cm;
			       padding-left: 0.5cm;
			       padding-right: 0.5cm;
			       height: auto;
			   }
			}
	</style>
</head>
		   
<body>
	<?php  foreach($values->result() as $row){ ?>
	<div id="wrapper" style="margin: 0 auto;width: 1000px">
		<div id="header">
			 <?php $this->load->view('head_bangla'); ?>  
			 <br>
		</div>
		<div id="nav" align="center">
			<div id="nav_inner" style="margin-bottom: 25px">
				বিষয়ঃ  নিয়োগ পত্র 
			</div>
		</div>
	<div  style="margin: 0 auto;width: 1000px;">
			<table style="font-family:SutonnyMJ;font-size: 23px;margin-left: -4px;">
				<tr>
					<td>ZvwiL</td>
					<td>t</td> 
					<td style="font-family:SutonnyMJ;font-size: 20px"> <?php echo date("d-m-Y") ?></td> 
				</tr>
				<tr>
					<td>kÖwg‡Ki bvg     
					<td>t</td>
					<td style="font-size:15px"><?php echo $row->bangla_nam; ?></td> 
				</tr>
				<tr>
					<td>wcZv / ¯^vgxi bvg </td>
					<td>t</td>  
					<td style="font-size:17px;font-family: serif;"><?php echo $row->emp_fname_bn; ?></td> 
				</tr>
				<tr>
					<td>gvZvi bvg</td>     
					<td>t</td>
					<td style="font-size:17px;font-family: serif;"><?php echo $row->emp_mname_bn; ?></td> 
				</tr>
		
		      <tr>
		      	<td style="font-family:SutonnyMJ;font-size:22px;"> eZ©gvb wVKvbv</td>    
		      	<td  style="font-family:SutonnyMJ;font-size:22px;">t</td>
		      	<td style="font-family:SutonnyMJ;font-size:15px;"><?php echo $row->pre_add_bn; ?> </td>
		      </tr>
		      <tr>
		      	<td style="font-family:SutonnyMJ;font-size:22px;"> eZ©gvb wVKvbv</td>    
		      	<td  style="font-family:SutonnyMJ;font-size:22px;">t</td>
		      	<td style="font-family:SutonnyMJ;font-size:15px;"><?php echo $row->per_add_bn; ?> </td>
		      </tr>
		    </table>

		<div style="margin: 0 auto;width: 1000px;text-align: justify;">

		<br/>
		আপনার ..........................ইং তারিখের আবেদন ও আপনার সাথে সাক্ষাৎকার এবং পরীক্ষা পর্বের মাধ্যমে আগামী <b style="font-family:SutonnyMJ;font-size: 20px;"><?php echo $doj = date('d-m-Y',strtotime($row->emp_join_date)); ?></b> 
		ইং তারিখ হইতে নিম্নলিখিত শর্ত সাপেক্ষে 
		<b><span style="font-family:SutonnyMJ;font-size: 20px;"><?php echo $row->emp_sal_gra_id ; ?></span></b>গ্রেডে 
		<b><?php echo $row->desig_bangla; ?></b> পদে 
		<b><?php echo $row->sec_bangla; ?></b> সেকশনে 
		<b><?php echo $row->emp_id; ?></b> 
		কার্ড নাম্বারে আপনাকে নিয়োগ প্রদান করা হইল ।
	</div>
 </div> 
<div id="body" style="margin: 0 auto;width: 1000px;">
			<br>
			<p style="text-align: justify;"><u>০১. নিয়োগের কার্যকারিতাঃ</u><br/>
			এই নিয়োগ পত্র চাকুরীতে যোগদানের তারিখ থেকে কার্যকর হবে।সন্তোষজনক ভাবে প্রবেশনকাল অতিবাহিত হলে (কাজের নাম , দক্ষতা ,শৃংখলা এবং উপস্থিতি সাপেক্ষে আপনাকে স্থায়ী কর্মী হিসেবে গন্য করা হবে।</p>

			<p style="text-align: justify;"><u>০২.শিক্ষানবসীকালঃ</u><br/>
			চাকুরীতে যোগদানের তারিখ থেকে ০৩(তিন) মাস পর্যন্ত শিক্ষানবসীকাল 
			হিসেবে বিবেচনা করা হবে। শুধু মাত্র ড্রাইভার (তিন) মাস তবে শর্ত থাকে যে, 
			একজন শ্রমিকের প্রথম ০৩(তিন) মাসের                       মধ্যে কাজের মান 
			নির্ণয় করা সম্ভব না হলে আর (তিন) মাস বাড়ানো যেতে পারে । আপনার 
			শিক্ষানবসীকাল সন্তোষজনকভাবে সমাপ্ত হলে আপনার চাকুরী স্থায়ী বলে বিবেচিত  
			হবে।
			</p>
	
			০৩ . শিক্ষানবসীকাল কোম্পানী যে কোন সময় কোন প্রকার কারণ ছাড়াই আপনাকে চাকুরী থেকে অভ্যহতি দিতে পারেন এবং আপনিও কোন পূর্ব নোটিশ ছাড়া চাকুরী থেকে অভ্যহতি নিতে পারেন এ                        ক্ষেত্রে কোন ক্ষতিপূরণ দিতে হবে না।
			<br/>
			<br/>
			<u>০৪. আপনার মোট বেতন / মজুরী হবে  নিম্নরুপঃ</u><br/>
</div> 
<div id="body" style="margin: 0 auto;width: 1000px;">	
		<table>
			<tr>
			<td>ক. মূল বেতন </td>
			<td>:</td>
		    <td style="font-family:SutonnyMJ;font-size:20px;">
		    
			  		<?php 
						$gross_sal = $row->gross_sal; 
						$medical = 200;
						echo $basic_sal = round((($gross_sal - $medical) /1.4),2); 
					?>


		    </td>
		    <td>টাকা [মোট বেতন-চিকিৎসা ভাতা] /১.৪] </td>
			</tr>


			<tr>
			<td>খ. বাড়ী ভাড়া </td>		
			<td>: </td>		
			<td style="font-family:SutonnyMJ;font-size:20px;"><?php echo $house_rent=round((($basic_sal*40)/100),2);?>
			</td>
			<td>টাকা (মূল বেতনের শতকরা ৪০ ভাগ)</td>		
			</tr>

			<tr>
			<td>গ. চিকিৎসা ভাতা</td>
			<td>:</td>
			<td style="font-family:SutonnyMJ;font-size:20px;"> <?php echo $medical; ?></td>
			<td>টাকা</td>
			</tr>
			<tr>
				<td><hr></td>
				<td><hr></td>
				<td><hr></td>
				<td><hr></td>
			</tr>
			
			<tr>
			<td>সর্বমোট </td>
			<td>:</td> 
			<td style="font-family:SutonnyMJ;font-size: 20px"> 
				<?php echo $gross_sal; ?>
			</td>
			<td>  
					টাকা
			</td>
			</tr>

		</table>



</div>
<div style="margin: 0 auto;width: 1000px;">
			<br/>
			<br/>
			<u>০৫. কাজের সময়ঃ</u>
			দৈনিক ০১ (এক) ঘন্টা বিশ্রাম ও আহারের বিরতিসহ ০৯ (নয়) ঘন্টা।
			<br/>
			<br/>
			<u>০৬. মুজুরী পরিশোধের তারিখঃ</u>
			প্রতি মাসের মুজুরী পরবর্তী মাসের সাত কর্ম দিবসের মধ্যে পরিশোধ করা হবে|
			<br/>
			<br/>
			<u>০৭. অতিরিক্ত সময়ের কাজের হিসাবঃ</u><br/>
			ক. একদিনে আট ঘন্টা অথবা সাপ্তাহে আটচল্লিশ ঘন্টার বেশি কাজ হলে অতিরিক্ত কাজের সময় হিসেবে গন্য হবে। <br/>
			খ.অতিরিক্ত কাজের মুজুরী মূল মুজুরীর দ্বিগুন হারে প্রদান করা হইবে ।<br/>
			গ. অতিরিক্ত  কাজের মজুরী = <b style="font-family:SutonnyMJ;"> <?php echo $ot = round((($basic_sal * 2)/208),2); ?> </b> টাকা ((মূল মজুরী * ২ * মোট অতিরিক্ত কাজের সময় ) /২০৮)।
			<br/>
			<br/>
			<u>০৮. ছুটি এবং অবকাশঃ  </u>
			প্রত্যেক শ্রমিক নিম্নাক্ত হারে ছুটি ভোগ করিবেন :
			<br/>
			ক. সাপ্তাহিক ছুটি : প্রতি সাপ্তাহে একদিন । (দিন পরিবর্তন যোগ্য)<br/>
			খ. নৈমিত্তিক ছুটি : বছরের পূর্ন মুজুরীসহ ১০ দিন । নৈমিত্তিক ছুটি জমা রেখে পরবর্তী  বছর ভোগ করা যাবে না । <br/>
			গ. পীড়া ছুটি : বছরের পূর্ন মজুরী সহ ১৪ দিন । অসুস্থতার ছুটি জমা রেখে পরবর্তী  বছর ভোগ করা যাবে না । <br/>
			ঘ. বাৎসরিক ছুটি : চাকুরীর মেয়াদ নূন্যতম এক বছর পূর্ন হলে প্রতি ১৮ কর্মদিবসে১ দিন সবেতনে ছুটি প্রাপ্য হবে এবং এই ছুটি পরবর্তী বসরে যুক্ত হয়ে সর্বোচ্চ ৪০ দিন পর্যন্ত জমা রাখা যাবে                            ।<br/>
			ঙ. উৎসব ছুটি : বছরে পুর্ন মজুরীসহ ১১ দিন <br/>
			চ. প্রসূতি কল্যান ছুটি : নারী শ্রমিকদের জন্য সবেতনে ১৬ সপ্তাহ । সন্তান প্রসবের পূর্বে ৮ সপ্তাহ । উল্লেখ্য যে অত্র কারখানায় কমপক্ষে ৬ মাস চাকুরী পূর্ণ হতে                            হবে।
			
			<p style="text-align: justify;"><u>৯. হাজিরা / পাঞ্চ কার্ডঃ</u><br/>
			প্রত্যেক শ্রমিকদের জন্য একটি হাজিরা কার্ড / পাঞ্চ কার্ড / টার্চ কার্ড ইস্যু করা হয়ে থাকে । উক্ত হাজিরা কার্ডে কারখানাতে আসা যাওয়া এবং অতিরিক্ত কর্মঘন্টার সময় লিপিবদ্ধ থাকবে এবং পাঞ্চ                         কার্ড / টার্চ কার্ড  যাওয়ার সময় নির্ধারিত মেশিনে পাঞ্চ / টার্চ করতেহবে। 
			আপনার পাঞ্চ কার্ড নাম্বার <b><?php echo $row->proxi_id; ?></b>।</p>
			
			<u>১০. পরিচয় পত্রঃ</u> কোম্পানি কর্তৃক  পরিচয় পত্র প্রদান করা হবে ।
			<br/>
			<br/>
			<p style="text-align: justify;"><u>১১. বদলীঃ</u> একই মালিকের মালিকানাধীন অন্য যে কোন ফ্যাক্টরীতে প্রয়োজনে আপনাকে সমজাতীয় কাজে বদলী করা যাবে এবং আপনি বদলীকৃত ফ্যাক্টরীতে কাজ করতে বাধ্য  থাকবেন ।
			</p>
			<br/>
			<p style="text-align: justify;"><u>১২. চাকরী হতে পদত্যাগঃ</u> প্রত্যেক স্থায়ী শ্রমিক ৬০ দিনের লিখিত নেটিশ প্রদান করে চাকুরী হতে ইস্তফা দিতে পারবেন। বিনা নোটিশে চাকুরী হতে ইস্তফা দিতে চাইলে নোটিশের পরিবর্তে ৬০ দিনের মজুরীর সমপরিমান অর্থ মালিককে প্রদান করতে হবে। 
			</p>
			
			<p style="text-align: justify;"><u>১৩. চাকুরী  হতে বরখাস্তঃ</u> সম্পত্তি চুরি , অভ্যাসগত বিলম্বে উপস্থিত, বিনা ছুটিতে  অভ্যাসগত উপস্থিতি, প্রতিষ্ঠানে উচ্ছৃংখলা বা দাংগা-হাংগামামুলক আচরন, শৃংখলা হানিকর কোন কাজ , কোন আইন বা বিধির অভ্যাসগত লংঘন , কাজে কর্মে অভ্যাসগত গালিরতি, এবং উর্ধ্বতন কর্মকর্তার আইনসংগত বা যুক্তিসংগত আদেশ পালন না করা , সহ অন্যান্য যে কোন অসদাচরনের জন্য বাংলাদেশ শ্রম আইন ২০০৬ অনুসরন করে যে কোন শ্রমিককে করা বরখাস্ত হতে পারে ।
			</p>
			<p style="text-align: justify;"><u>১৪. কোম্পানির নিয়ম-নীতিঃ</u> নিয়োগের ক্ষেত্রে এবং কর্মক্ষেত্রে কখনও জাতি, ধর্ম , বর্ন এবং লিঙ্গ ভেদে কোন রকম পক্ষপাতমূলক আচরন করা হয় না এবং কারও ইচ্ছার বিরুদ্ধে জোর পূর্বক কোন কাজ করানো হয় না । কর্মক্ষেত্রে কোন শ্রমিকের ক্ষোভ হলে তা সুনির্দিষ্ট পন্থায় প্রকাশ করার স্বাধীনতা রয়েছে এবং
				কর্তৃপক্ষ ক্ষোভ নিরসনে উপযুক্ত পন্থা অবলম্বন করে থাকে।
			</p>
			<u>১৫. অন্যান্য সুবিধা ও বিধি নিশেধঃ</u><br/>
			ক. হাজিরা বোনাস : কোন মাসে যদি আপনি একদিনও অনুপস্থিত না থাকেন এবং কাজে দেরী না করেন তাহলে আপনাকে কোম্পানির নিয়ম অনুযায়ী হাজিরা বোনাস দেয়া হবে ।                         <br/>
			খ. উৎসব বোনাস : কোম্পানির নিয়ম অনুযায়ী বছরে দুইটি উৎসব বোনাস দেয়া হবে ।<br/>
			গ. চিকিৎসা সুবিধা : চিকিৎসক কর্তৃক বিনামূল্যে ব্যবস্থাপত্র ও সম্ভাব্য ওষুধপত্র প্রদান করা হবে ।<br/>
			ঘ. বিধি নিষেধ : কারখানার অভ্যন্তরে কোন মোবাইল ফোন আনা এবং ব্যবহার করা , পান , চুইংগাম ও ধুমপান এবং তৈরী পোশাকের ক্ষতিসাধন করতে কারে এরুপ                            কোন বস্তু খাওয়া সম্পূর্ণ  নিষিদ্ধ।
			<br/>
			<br/>
			<p style="text-align: justify;"><u>১৬.আত্মরক্ষামূলক সরাঞ্জমের ব্যবহারঃ</u> কর্ম কালীন সময়ে আত্মরক্ষামূলক সরাঞ্জমাদি অবশ্যই ব্যবহার করতে হবে । যদি উপরোল্লিখিত শর্তে আপনি চাকুরীতে যোগদানে সম্মত                               থাকেন তবে এই নিয়োগ পত্রের অনুলিপিতে স্বাক্ষর করতঃ  মানব সস্পদ / প্রশাসনিক বিভাগে জমা অনুরোধ করা হলো ।
			</p>
			১৭. প্রতি ফ্লোরে জরুরী নির্গম নক্সা রয়েছে , এতে চলাচলের পূর্ন  নক্সা অংকিত আছে ।
			<br/>
			<br/>
			<br/>
			<img src="<?php echo base_url();?>images/signature.png" width="100" height="auto" />
			<br>
			..........................<br/>
			ব্যবস্থাপক <br/>
			(মানব সম্পদ  ও প্রশাশন)
			<br/>
			<br/>
			আমি উপরোক্ত শর্তসমূহ স্বঞ্জানে, স্বেচ্ছায় মেনে অদ্য <b style="font-family:SutonnyMJ;font-size:20px"><?php echo $doj = date('d-m-Y',strtotime($row->emp_join_date)); ?></b> ইং তারিখে চাকুরীতে যোগদান করলাম। এই নিয়োগপত্রের অনুলিপি বুঝে পেয়ে 
			আমি নিম্নাক্ত স্বাক্ষর করছি। 
			<br/>
			<div id="footer">
			  <div style="text-align: left;margin-top: 20px;">
			  স্বাক্ষর ................................
			  </div>
			  <div style="text-align: right;margin-top: -21px;">
			  তারিখঃ................................
			  </div>
			</div>
			<br/>
		</div>
	</div>
	<div style="page-break-after: always;"></div>
	<?php } ?>
</body>
</html>