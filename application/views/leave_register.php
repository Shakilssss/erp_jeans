<?php  
    // echo "<pre>";print_r($values);exit;
    $this->db->select('*')->where_in('leave_type',['cl','sl','el'])->where('emp_id', $values['emp_info']->emp_id)->order_by('start_date','ASC')->group_by('start_date');
    if( $first_date == '' && $second_date == ''){
        $this->db->where('start_date >',date('d/m/Y',strtotime($values['emp_info']->emp_join_date)));
    }else if( !$first_date == '' && $second_date == ''){
        $this->db->where('start_date >',date('Y-01-01',strtotime($first_date)))->where('start_date <',date('Y-12-31',strtotime($first_date)));
    }else{
        $this->db->where('start_date >',date('Y-01-01',strtotime($first_date)))->where('start_date <',date('Y-m-d',strtotime($second_date)));
    }
    $take_leaves =$this->db->get('pr_leave_trans')->result();
    // echo "<pre>";print_r($take_leaves);exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
        }
    
        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }
    
        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }
    
        .tg .tg-8jvv {
            border-color: inherit;
            font-size: 14px;
            text-align: left;
            vertical-align: top
        }

        /* td{
            font-family:sutonnyMJ;
        } */
    </style>
</head>
<body>
<div class="container" style="width:80%;margin:0 auto" id="leave_register_table">
<button class="btn btn-primary" onclick="download_excel()">Download as Excel Sheet</button>
        <div style="text-align:center" style="line-height: 10px;margin-top:20px">
            <!-- <p>বাংলাদেশ গেজেট,অতিরিক্ত,সেপ্টেম্বর ১৫,২০১৫</p> -->
            <p>ফরম-৯</p>
            <p>[ধারা ১০,১১৫,১১৬ ও ১১৭ এবং বিধি ২৪ ও ১০৮(১) দ্রষ্টব্য]</p>
            <p>ছুটির রেজিস্টার ও ছুটির বহি</p>
        </div>
        <div class="mt-5" style="line-height: 10px;">
            <p class="h5">কারখানা/প্রতিষ্ঠানের নামঃ জিন্স ম্যানুফ্যাকচারিং কোম্পানি লিঃ</p>
            <p>কারখানা/প্রতিষ্ঠানের নাম ঠিকানাঃ ৭৯৯, (পুরাতন প্লট নং- ১০১০/১০১১), আমবাগ, মৌজা বাঘিয়া, কোনাবাড়ী, গাজীপুর -১৭০০।</p>
            <p>শ্রমকিরে নামঃ <?php echo $values['emp_info']->bangla_nam?> <span style="margin-left: 20px">কার্ড নংঃ <?php echo $values['emp_info']->emp_id?></span> <span style="margin-left: 20px">পদবীঃ <?php echo $values['emp_info']->desig_bangla?></span></p>
            <p>শ্রমিক রেজিস্টারের ক্রমিক নংঃ <?php echo $values['emp_info']->emp_id?></p>
            <p>বিভাগ বা শাখার নামঃ <?php echo $values['emp_info']->dept_name?> <span style="margin-left: 20px">নিয়োগের তারিখঃ <?php echo date('d/m/Y',strtotime($values['emp_info']->emp_join_date))?></span></p>
        </div>
        <table class="tg">
            <thead>
                <tr>
                    <th class="tg-8jvv text-center" rowspan="2">বৎসরের প্রারম্ভে জমাকৃত বার্ষিক ছুটি</th>
                    <th class="tg-8jvv text-center" colspan="3">কি ধরনের ছুটি চাওয়া হইয়াছে</th>
                    <th class="tg-8jvv text-center" rowspan="2">প্রত্যাখ্যান বা মুলতবি রাখা হইলে প্রত্যাখ্যানের বা মুলতবীর কারণ</th>
                    <th class="tg-8jvv text-center" rowspan="2">ছুটি মঞ্জুরের তারিখ</th>
                    <th class="tg-8jvv text-center" rowspan="2">কত দিন মঞ্জুর করা হইল</th>
                    <th class="tg-8jvv text-center" rowspan="2">বার্ষিক ছুটি নগদায়নের সংখ্যা ও অর্থ প্রদানের তারিখ</th>
                    <th class="tg-8jvv text-center" colspan="3">অবশিষ্ট পাওনা ছুটির পরিমাণ</th>
                    <th class="tg-8jvv text-center" rowspan="2">শ্রমিকের স্বাক্ষর</th>
                    <th class="tg-8jvv text-center" rowspan="2">মালিক/ব্যবস্থাপকের স্বাক্ষর</th>
                </tr>
                <tr>
                    <th class="tg-8jvv">বার্ষিক</th>
                    <th class="tg-8jvv">নৈমিত্তিক</th>
                    <th class="tg-8jvv">পীড়া</th>
                    <th class="tg-8jvv">বার্ষিক</th>
                    <th class="tg-8jvv">নৈমিত্তিক</th>
                    <th class="tg-8jvv">পীড়া</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="tg-8jvv" style="text-align:center;font-family:sutonnymj;font-size:17px">1</td>
                    <td class="tg-8jvv" style="text-align:center;font-family:sutonnymj;font-size:17px">2</td>
                    <td class="tg-8jvv" style="text-align:center;font-family:sutonnymj;font-size:17px">3</td>
                    <td class="tg-8jvv" style="text-align:center;font-family:sutonnymj;font-size:17px">4</td>
                    <td class="tg-8jvv" style="text-align:center;font-family:sutonnymj;font-size:17px">5</td>
                    <td class="tg-8jvv" style="text-align:center;font-family:sutonnymj;font-size:17px">6</td>
                    <td class="tg-8jvv" style="text-align:center;font-family:sutonnymj;font-size:17px">7</td>
                    <td class="tg-8jvv" style="text-align:center;font-family:sutonnymj;font-size:17px">8</td>
                    <td class="tg-8jvv" style="text-align:center;font-family:sutonnymj;font-size:17px">9</td>
                    <td class="tg-8jvv" style="text-align:center;font-family:sutonnymj;font-size:17px">10</td>
                    <td class="tg-8jvv" style="text-align:center;font-family:sutonnymj;font-size:17px">11</td>
                    <td class="tg-8jvv" style="text-align:center;font-family:sutonnymj;font-size:17px">12</td>
                    <td class="tg-8jvv" style="text-align:center;font-family:sutonnymj;font-size:17px">13</td>
                </tr>
				<?php 
					// dd($take_leaves); 
					$separated_data = [];
					foreach ($take_leaves as $object) {
						$year = date('Y', strtotime($object->start_date));
						$separated_data[$year][] = $object;
					}
                    // dd($year);
                    ?>
				<tr>
				<?php $leave_year='';	foreach ($separated_data as $year => $objects) {

                    $total_cl_leave = $values['leave_balance']->lv_cl;
                    $total_sl_leave = $values['leave_balance']->lv_sl;
                    $total_el_leave = '';
                    $total_cl_use =0;
                    $total_sl_use =0;
                    $total_el_use =0;  
					echo "<td colspan='13'>বছর: <sapn style='font-family:sutonnymj;font-size:17px'>$year</span></td>";
                ?>
                </tr>

              

				<?php
                    $count = count($objects) - 1;
                    foreach ($objects as $key => $object) {
                ?>
                    <tr>
                        <td class="text-center">
                            <?php 
                                $array = $values['yearly_total_info'];
                                if (isset($array[$year]["P"])) {
                                    $total_el_leave = round($array[$year]["P"]/18);
                                } else {
                                    $total_el_leave = 0; // or any other default value
                                }
                            ?>
                        </td>
						<td style="text-align:center"><?php echo $object->leave_type == 'el' ? "বার্ষিক":""?></td>
						<td style="text-align:center"><?php echo $object->leave_type == 'cl' ? "নৈমিত্তিক":""?></td>
						<td style="text-align:center"><?php echo $object->leave_type == 'sl' ? "পীড়া":""?></td>
						<td><?php echo " "?></td>
						<td style="text-align:center"><sapn style='font-family:sutonnymj;font-size:17px'><?php echo date('d/m/Y', strtotime($object->start_date))?></sapn></td>
						<td style="text-align:center" style='font-family:sutonnymj;font-size:17px'>
							<?php 
								$use =  date_diff(date_create($object->start_date), date_create($object->start_date))->format('%a')+1;
								echo '<span style="font-family:sutonnymj;font-size:17px">'.$use.'</span>';
                                 $object->leave_type == 'cl'?($total_cl_use += $use):($object->leave_type == 'sl'?($total_sl_use += $use):($total_el_use += $use) );
                        	?>
						</td>
						<td><?php echo " "?></td>
						<td style="text-align:center;font-family:sutonnymj;font-size:17px"><?php   echo  $object->leave_type == 'el' ? ($total_el_leave - $total_el_use):'';?></td>
						<td style="text-align:center;font-family:sutonnymj;font-size:17px"><?php   echo  $object->leave_type == 'cl' ? ($total_cl_leave - $total_cl_use):'';?></td>
						<td style="text-align:center;font-family:sutonnymj;font-size:17px"><?php   echo  $object->leave_type == 'sl' ? ($total_sl_leave - $total_sl_use):'';?></td>
						<td><?php echo ""?></td>
						<td><?php echo ""?></td>
					</tr>
                    
					<!-- < ?php 
                       if($count == $key){ ?>
                            <tr>
                                <-- <td style="text-align:center">
                                    < ?php dd($array[$year]["P"]) ?> 
                                    -- < ?php echo isset($array[$year]) ? round($array[$year]["P"]/18) : ''?> --
                                </td> -->
                                <!-- <td>< ?php echo ""?></td>
                                <td>< ?php echo ""?></td>
                                <td>< ?php echo ""?></td>
                                <td>< ?php echo ""?></td>
                                <td>< ?php echo ""?></td>
                                <td>< ?php echo ""?></td> -->
                                <!-- < ?php  -->
                            <!-- < @$paid_date = $this->db->select('paid_date')->where('year',$year)->where('emp_id',$object->emp_id)->get('pr_earn_leave_paid')->row()->paid_date; 
                                 ?> 
                                 <td style="text-align:center;">< ?php echo isset($paid_date)? $paid_date:''?></td> 
                                <- <td>< ?php echo ""?></td>
                                <td>< ?php echo ""?></td>
                                <td>< ?php echo ""?></td>
                                <td>< ?php echo ""?></td>
                                <td>< ?php echo ""?></td> 
                            </tr>
                     < ?php } } }?> --> 
                     <?php }}?>
            </tbody>
        </table>
</div>
    <script>
    function download_excel(){
        var table = document.getElementById("leave_register_table");
        var html = table.outerHTML;
        var url = 'data:application/vnd.ms-excel,' + escape(html);
        var a = document.createElement('A');
        a.href = url;
        a.download = 'Leave_Register.xls';
        document.body.appendChild(a);
        a.click();
    }
    </script>
  

</body>
</html>