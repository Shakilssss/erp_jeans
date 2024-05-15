<?php 
$comInfo = $this->common_model->company_all_information();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ID Card</title>
</head>

<body>

<div style="font-size:20px; font-weight:bold; text-align:center; font-family:SolaimanLipi; padding-top:5px;">
	<?=$comInfo->company_name_bangla?> 
</div>
<div class="style1" style="font-size:14px; font-weight:bold; text-align:center;">
	<?=$comInfo->company_add_bangla?>
</div>
</body>
</html>
