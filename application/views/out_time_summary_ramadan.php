<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Out Time Summary||MSHL</title>
<link rel="stylesheet" type="text/css" href="../../../../../../css/print.css" media="print" />

<style type="text/css">
.sal tr td{
border:1px #000000 solid;
border-top-style:none;
border-left-style:none;
padding-right:2px;

}
.sal{
border:1px #000000 solid;
   border-bottom-style: none;
   border-right-style: none;
   }
   
.det tr td{
border:1px #000000 solid;
border-top-style:none;
border-left-style:none;

}
.det{
border:1px #000000 solid;
   border-bottom-style: none;
   border-right-style: none;
   }
</style>
</head>

<body>
<div style="width:auto; ">
<?php 
$this->load->view("head_english"); 
?>
<div style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif; width:100%; ">
	<div  style="font-size:13px; font-weight:bold; text-align:center; width:100%;">
		Daily Out Time Summary of 
		<?php 
			$date = $date;
			echo $date;
		?>
	</div>
	<br/>
<table class="sal" border="1" cellspacing="0" cellpadding="0" style="font-size:12px; width: 1000px; margin: 0 auto;">
  <!-- <tr align="center" style="font-weight:bold;">
    <td width="50">SI</td>
    <td width="150">Line No</td>
    <td width="85">M.Power</td>
    <td width="370">Wages</td>
    <td width="299">Attn. Bonus</td>
    <td width="155">5 to 7 OT Hours</td>
    <td width="155">5 to 7 OT Amount</td>
    <td width="155">Grand Total</td>
  </tr> -->
  <tr align="center" style="font-weight:bold;">
    <td>SI</td>
    <td>Line No</td>
    <td>M.Power</td>
    <td>3  PM</td>
    <td>4  PM</td>
    <td>5  PM</td>
    <td>6 PM</td>
    <td>7 PM</td>
    <td>8 PM</td>
    <td>9 PM</td>
    <td>10 PM</td>
    <td>11 PM</td>
    <td>12 AM</td>
    <td>1 AM</td>
    <td>2 AM</td>
    <td>3 AM</td>
    <td>4 AM</td>
    <td>5 AM</td>
    <!-- <td>6 AM</td> -->
  </tr>
 	<?php
		$s_total = 0;
		$g_total_emp = 0;
		$g_total_wgs = 0;
		$g_total_bns = 0;
		$g_total_ot_hr = 0;
		$g_total_ot_amt = 0;
		$g_total_amt = 0;
		$i = 0;

		$threep = 0;
		$fourp = 0;
		$fivep = 0;
		$sixp = 0;
		$sevenp = 0;
		$eightp = 0;
		$ninep = 0;
		$tenp = 0;
		$elevenp = 0;
		$twelvep = 0;
		$onea = 0;
		$twoa = 0;
		$threea = 0;
		$foura = 0;
		$fivea = 0;
		$sixa = 0;

		foreach ($values as $row){
			// echo "<pre>";
			// print_r($row);
			// exit;
			if ($row["daily_out_time"][0]['totalemp'] !=0) {
				echo "<tr>";
				
				echo "<td align='center'>";
				echo $i=$i+1;
				echo "</td>";
				 
				echo "<td align='center'>";
				echo $row["line_name"];
				echo "</td>";
				 
				echo "<td align='center'>";
				echo number_format($row["daily_out_time"][0]['totalemp']);
				echo "</td>";
				
				echo "<td align='center'>";
				echo number_format($row["daily_out_time"][0]['slot_3']);
				$threep = $threep + number_format($row["daily_out_time"][0]['slot_3']);
				echo "</td>";
				
				echo "<td align='center'>";
				echo number_format($row["daily_out_time"][0]['slot_4']);
				$fourp = $fourp + number_format($row["daily_out_time"][0]['slot_4']);
				echo "</td>";
				
				echo "<td align='center'>";
				echo number_format($row["daily_out_time"][0]['slot_5']);
				$fivep = $fivep + number_format($row["daily_out_time"][0]['slot_5']);
				echo "</td>";
				
				echo "<td align='center'>";
				echo number_format($row["daily_out_time"][0]['slot_6']);
				$sixp = $sixp + number_format($row["daily_out_time"][0]['slot_6']);
				echo "</td>";
				
				echo "<td align='center'>";
				echo number_format($row["daily_out_time"][0]['slot_7']);
				$sevenp = $sevenp + number_format($row["daily_out_time"][0]['slot_7']);
				echo "</td>";
				
				echo "<td align='center'>";
				echo number_format($row["daily_out_time"][0]['slot_8']);
				$eightp = $eightp + number_format($row["daily_out_time"][0]['slot_8']);
				echo "</td>";
				
				
				echo "<td align='center'>";
				echo number_format($row["daily_out_time"][0]['slot_9']);
				$ninep = $ninep + number_format($row["daily_out_time"][0]['slot_9']);
				echo "</td>";
				
				
				echo "<td align='center'>";
				echo number_format($row["daily_out_time"][0]['slot_10']);
				$tenp = $tenp + number_format($row["daily_out_time"][0]['slot_10']);
				echo "</td>";
				
				echo "<td align='center'>";
				echo number_format($row["daily_out_time"][0]['slot_11']) + number_format($row["daily_out_time"][0]['slot_11e']);
				$elevenp = $elevenp + $row["daily_out_time"][0]['slot_11'] + $row["daily_out_time"][0]['slot_11e'];
				echo "</td>";

				echo "<td align='center'>";
				echo number_format($row["daily_out_time"][0]['slot_12']);
				$twelvep = $twelvep + $row["daily_out_time"][0]['slot_12'];

				echo "</td>";

				
				echo "<td align='center'>";
				echo number_format($row["daily_out_time"][0]['slot_12e1']);
				$onea = $onea + number_format($row["daily_out_time"][0]['slot_12e1']);
				echo "</td>";

				echo "<td align='center'>";
				echo number_format($row["daily_out_time"][0]['slot_12e2']);
				$twoa = $twoa + number_format($row["daily_out_time"][0]['slot_12e2']);
				echo "</td>";

				echo "<td align='center'>";
				echo number_format($row["daily_out_time"][0]['slot_12e3']);
				$threea = $threea + number_format($row["daily_out_time"][0]['slot_12e3']);
				echo "</td>";

				echo "<td align='center'>";
				echo number_format($row["daily_out_time"][0]['slot_12e4']);
				$foura = $foura + number_format($row["daily_out_time"][0]['slot_12e4']);
				echo "</td>";

				echo "<td align='center'>";
				echo number_format($row["daily_out_time"][0]['slot_12e5']);
				$fivea = $fivea + number_format($row["daily_out_time"][0]['slot_12e5']);
				echo "</td>";

				/*echo "<td align='center'>";
				echo number_format($row["daily_out_time"][0]['slot_12e6']);
				$sixa = $sixa + number_format($row["daily_out_time"][0]['slot_12e6']);
				echo "</td>";*/


				echo "</tr>";

				$g_total_emp = $g_total_emp+$row["daily_out_time"][0]['totalemp'];
				/*$g_total_wgs = $g_total_wgs+$row["daily_out_time"][0]['t_wages'];
				$g_total_bns = $g_total_bns+$row["daily_out_time"][0]['t_bonus'];
				$g_total_ot_hr = $g_total_ot_hr+$row["daily_out_time"][0]['t_ot'];
				$g_total_ot_amt = $g_total_ot_amt+$row["daily_out_time"][0]['t_ot_amt'];
				$g_total_amt = $g_total_amt + $s_total;*/
			}
		}
		/*//----------------
		echo "<tr>";
				
		echo "<td align='center'>";
		echo $i=$i+1;
		echo "</td>";
		 
		echo "<td align='center'>";
		echo "Left & Resign";
		echo "</td>";
		 
		echo "<td align='center'>";
		echo number_format($values[1]["left_rgn"][0]['t_emp']);
		echo "</td>";
		
		echo "<td align='center'>";
		echo number_format($row["left_rgn"][1]['t_wages']);
		echo "</td>";
		
		echo "<td align='right'>";
		echo number_format($row["left_rgn"][1]['t_bonus']);
		echo "</td>";
		
		echo "<td align='right'>";
		echo number_format($row["left_rgn"][1]['t_ot']);
		echo "</td>";
		
		echo "<td align='right'>";
		echo number_format($row["left_rgn"][1]['t_ot_amt']);
		echo "</td>";
		
		echo "<td align='right'>";
		$s_total=$row["left_rgn"][1]['t_wages']+$row["left_rgn"][1]['t_bonus']+$row["left_rgn"][1]['t_ot_amt'];
		echo number_format($s_total);
		echo "</td>";
		echo "</tr>";
		//---------------------*/
		echo "<tr style='font-weight:bold;'>";
		
		echo "<td colspan='2' align='center'>";
		echo "Total";
		echo "</td>";
		
		echo "<td align='center'>";
		echo number_format($g_total_emp);
		echo "</td>";
		
		echo "<td align='center'>";
		echo $threep;
		// echo number_format($g_total_wgs);
		echo "</td>";

		echo "<td align='center'>";
		echo $fourp;
		// echo number_format($g_total_wgs);
		echo "</td>";

		echo "<td align='center'>";
		echo $fivep;
		// echo number_format($g_total_wgs);
		echo "</td>";
		
		echo "<td align='center'>";
		echo $sixp;
		// echo number_format($g_total_bns);
		echo "</td>";
		
		echo "<td align='center'>";
		echo $sevenp;
		// echo number_format($g_total_ot_hr);
		echo "</td>";
		
		echo "<td align='center'>";
		echo $eightp;
		// echo number_format($g_total_ot_amt);
		echo "</td>";
		
		
		echo "<td align='center'>";
		echo $ninep;
		// echo number_format($g_total_ot_amt);
		echo "</td>";
		
		
		echo "<td align='center'>";
		echo $tenp;
		// echo number_format($g_total_ot_amt);
		echo "</td>";
		
		
		echo "<td align='center'>";
		echo $elevenp;
		// echo number_format($g_total_ot_amt);
		echo "</td>";
		
		
		echo "<td align='center'>";
		echo $twelvep;
		// echo number_format($g_total_ot_amt);
		echo "</td>";
		
		echo "<td align='center'>";
		echo $onea;
		// echo number_format($g_total_ot_amt);
		echo "</td>";
		
		echo "<td align='center'>";
		echo $twoa;
		// echo number_format($g_total_ot_amt);
		echo "</td>";
		
		echo "<td align='center'>";
		echo $threea;
		// echo number_format($g_total_ot_amt);
		echo "</td>";
		
		echo "<td align='center'>";
		echo $foura;
		// echo number_format($g_total_ot_amt);
		echo "</td>";
		
		echo "<td align='center'>";
		echo $fivea;
		// echo number_format($g_total_ot_amt);
		echo "</td>";
		
		/*echo "<td align='center'>";
		echo $sixa;
		echo "</td>";*/

		echo "</tr>";
	?>
	</table>
	<br>
	<!-- <div style="margin:0 auto; width:100%; padding-top: 40px;  ">
	<table class="det" border="1" cellspacing="0" cellpadding="0" style="font-weight:bold; font-size:12px; width: 800px; margin: 0 auto;">
		<tr height="56" align="center">
			<td height="56">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="31" align="center">
			<td height="31">Director</td>
			<td>Managing Director Name <br /> Managing Director</td>
			<td>Chairman</td>
		</tr>
	</table>
	</div> -->
</div>
</div>
</body>
</html>