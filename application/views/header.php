<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>JMCL Payroll</title>
</head>

<body style="margin:0px;" >

<div style="margin:0 auto; width:100%; height:50px;; overflow:hidden; background: url(<?php echo base_url(); ?>uploads/company_photo/header_image.jpg)  no-repeat;">
<div style=" width:60%; font-weight: 900; text-align:center; font-family:'Comic Sans MS';float:left;">
	<div style=" height:auto; width:35%; overflow:hidden; float:left; text-align:left; padding-left:10px;">
	<img width="170" height="45" src="<?php echo base_url(); ?>images/logo.gif" />
	</div>
	<div style=" height:auto; width:60%; overflow:hidden; font-size:25px; float:right; text-align:right;">
	Jeans Manufacturing co. ltd.
	</div>
</div>
<div style="padding:10px; width:30%; float:right;"> 
<?php
if($this->session->userdata('logged_in')==true)
	{
		?>
		<div style="text-align:right; color: #CC0000;">
		<?php
		echo "Welcome, ";
		echo "<b>".$this->session->userdata('username')." ! "."</b> ";
		$url = base_url().'index.php/logout_FE';
		echo " <a  href='$url'  target='_top' style='text-decoration:none; color:black;'>";
		?>
		<img src="<?php echo base_url(); ?>/images/exit.png" alt="Exit" />
		<?php
		echo "</a>";
		?>
		</div>
		<?php
	}
?>
</div>
</div>


</body>
</html>
