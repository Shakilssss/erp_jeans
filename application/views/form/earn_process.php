<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Earn Process</title>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/style.css" />
<?php if(isset($output)){
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach;} ?>
<style type='text/css'>
a {
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: none;
}

</style>

 
<script type="text/javascript" src="<?php echo base_url();?>js/dynamic.js"></script>
</head>
<body bgcolor="#ECE9D8">
	<div align="center" style="margin:0 auto; width:100%; overflow:hidden; ">
		<fieldset style='width:600px;'><legend><font size='+1'><b>Salary Process</b></font></legend>
			<?php
				$this->load->view('month_year');
			?>
			<input type='button' name='view' onclick='earn_leave_process()' value='Process'/>
		</fieldset>
	</div>
	<div id="loader"  align="center" style="margin:0 auto; width:600px; overflow:hidden; display:none; margin-top:10px;"><img src="<?php echo base_url();?>/images/ajax-loader.gif" /></div>
</body>
</html>