<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>EOT Summary||MSHL</title>
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
		Monthly Salary Summary with OT and EOT of 
		<?php 
			$date = $salary_month;
			$year=trim(substr($date,0,4));
			$month=trim(substr($date,5,2));
			$date_format = date("F-Y", mktime(0, 0, 0, $month, 1, $year));
			echo $date_format;
		?>
	</div>
	<br/>
<table class="sal" border="1" cellspacing="0" cellpadding="0" style="font-size:12px; width: 900px; margin: 0 auto;">
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
    <td>Wages</td>
    <td>Attn. Bonus</td>
    <td>5 to 7 OT Hours</td>
    <td>5 to 7 OT Amount</td>
    <td>7 to Above EOT Hours</td>
    <td>7 to Above EOT Amount</td>
    <td>Total OT and EOT Amount</td>
    <td>Total Deduct</td>
    <td>Grand Total</td>
  </tr>
 	<?php
		$s_total = 0;
		$g_total_emp = 0;
		$g_total_wgs = 0;
		$g_total_bns = 0;
		$g_total_ot_hr = 0;
		$g_total_ot_amt = 0;
		$g_total_eot_hr = 0;
		$g_total_eot_amt = 0;
		$g_total_ot_eot_amt = 0;
		$g_total_deduct_amt = 0;
		$g_total_amt = 0;
		$i = 0;
		foreach ($values as $row){
			if ($row["line_manPower"][0]['t_emp'] !=0) {
				echo "<tr>";
				
				echo "<td align='center'>";
				echo $i=$i+1;
				echo "</td>";
				 
				echo "<td align='center'>";
				echo $row["line_name"];
				echo "</td>";
				 
				echo "<td align='center'>";
				echo number_format($row["line_manPower"][0]['t_emp']);
				echo "</td>";
				
				echo "<td align='center'>";
				echo number_format($row["line_manPower"][0]['t_wages']);
				echo "</td>";
				
				echo "<td align='right'>";
				echo number_format($row["line_manPower"][0]['t_bonus']);
				echo "</td>";
				
				echo "<td align='right'>";
				echo number_format($row["line_manPower"][0]['t_ot']);
				echo "</td>";
				
				echo "<td align='right'>";
				echo number_format($row["line_manPower"][0]['t_ot_amt']);
				echo "</td>";
				
				echo "<td align='right'>";
				echo number_format($row["line_manPower"][0]['t_eot']);
				echo "</td>";
				
				echo "<td align='right'>";
				echo number_format($row["line_manPower"][0]['t_eot_amt']);
				echo "</td>";
				
				echo "<td align='right'>";
				$ot_eot_amt=$row["line_manPower"][0]['t_ot_amt']+$row["line_manPower"][0]['t_eot_amt'];
				echo number_format($ot_eot_amt);
				echo "</td>";

				echo "<td align='right'>";
				$t_deduct_amt=$row["line_manPower"][0]['t_deduct_amt'];
				echo number_format($t_deduct_amt);
				echo "</td>";
				
				echo "<td align='right'>";
				$s_total=$row["line_manPower"][0]['t_wages']+$row["line_manPower"][0]['t_bonus']+$ot_eot_amt-$row["line_manPower"][0]['t_deduct_amt'];
				echo number_format($s_total);
				echo "</td>";
				
				echo "</tr>";

				$g_total_emp = $g_total_emp+$row["line_manPower"][0]['t_emp'];
				$g_total_wgs = $g_total_wgs+$row["line_manPower"][0]['t_wages'];
				$g_total_bns = $g_total_bns+$row["line_manPower"][0]['t_bonus'];
				$g_total_ot_hr = $g_total_ot_hr+$row["line_manPower"][0]['t_ot'];
				$g_total_ot_amt = $g_total_ot_amt+$row["line_manPower"][0]['t_ot_amt'];
				$g_total_eot_hr = $g_total_eot_hr+$row["line_manPower"][0]['t_eot'];
				$g_total_eot_amt = $g_total_eot_amt+$row["line_manPower"][0]['t_eot_amt'];
				$g_total_deduct_amt = $g_total_deduct_amt+$row["line_manPower"][0]['t_deduct_amt'];
				$g_total_ot_eot_amt=$g_total_ot_eot_amt+$ot_eot_amt;
				$g_total_amt = $g_total_amt + $s_total;
			}
		}
		echo "<tr style='font-weight:bold;'>";
		
		echo "<td colspan='2' align='center'>";
		echo "Total";
		echo "</td>";
		
		echo "<td align='center'>";
		echo number_format($g_total_emp);
		echo "</td>";
		
		echo "<td align='center'>";
		echo number_format($g_total_wgs);
		echo "</td>";
		
		echo "<td align='right'>";
		echo number_format($g_total_bns);
		echo "</td>";
		
		echo "<td align='right'>";
		echo number_format($g_total_ot_hr);
		echo "</td>";
		
		echo "<td align='right'>";
		echo number_format($g_total_ot_amt);
		echo "</td>";

		echo "<td align='right'>";
		echo number_format($g_total_eot_hr);
		echo "</td>";
		
		echo "<td align='right'>";
		echo number_format($g_total_eot_amt);
		echo "</td>";
		
		echo "<td align='right'>";
		echo number_format($g_total_ot_eot_amt);
		echo "</td>";
		
		echo "<td align='right'>";
		echo number_format($g_total_deduct_amt);
		echo "</td>";

		echo "<td align='right'>";
		echo number_format($g_total_amt );
		echo "</td>";

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