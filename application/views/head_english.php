<?php 
$comInfo = $this->common_model->company_all_information();
// print_r($comInfo);
?>

<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
	<span style="font-size:18px; font-weight:bold;"><?=$comInfo->company_name_english?></span><br/>
	<span class="style1" style="font-size:13px; font-weight:bold;"><?=$comInfo->company_add_english?></span><br/>
	<span class="style1" style="font-size:13px; font-weight:bold;">Phone : <?=$comInfo->company_phone?>, 88-02-9007742</span>
</div>
 
