<!DOCTYPE html>
<html>
  <head>
    <title>Age Estimate</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    
    <style>
      td{
        font-family:SutonnyMJ;
      }
      td span{
        font-size:13px;
      }
     
      table,
      th,
      td {
        
        padding-top: 10px;
        font-size: 18px;
      }

      span {
        font-size: 12px;
      }

      @page :left {
        margin: 0.5cm;
      }

      @page :right {
        margin: 0.8cm;
      }
      @media print {
        .pagebreak {
            clear: both;
            page-break-after: always;
        }
    }
    </style>
  </head>
  <body>

     <?php  foreach($values as $row){?>
    <div id="wrapper" class="pagebreak">
      <div id="header" style="text-align: center;font-weight: bolder;">

      <p style="font-family:serif;font-size: 34px">
        <?php $company_info = $this->common_model->company_all_information();
          echo $company_info->company_name_english;
        ?>
      </p>

      <p style="font-family:serif;font-size: 20px">
        <?php echo $company_info->company_add_english;?>
      </>

        <hr>
        <!-- <hr> -->
      </div>
      <div></div>
      <div style="text-align:center; font-family:SutonnyMJ">
        <span style="font-size:26px;">
          <b>eqm I mÿgZvi cÖZ¨qbcÎ</b>
        </span>
        <br>
        <span style="font-size:16px;">dig- 15</span>
        <br />
        <span style="font-size:16px;">evsjv‡`k kÖg AvBb-2006 Bs [aviv 277 wewa 34 (1) I 336 (4) `ªóe¨]</span>
      </div>
      <div>
        <br>
        <table style="margin:0 auto;">
          <tr>
            <td >ZvwiL t <span  style="font-family:SutonnyMJ;font-size:18px;">   <?php echo date('m-d-Y'); ?></span> Bs </td>
          </tr>
          <tr>
            <td >µwgK/KvW© bs t <span style="font-family:serif;font-size:16px;">  <?php echo $row->emp_id;?></span></td>
            <td >†mKkb t <span style="font-family:serif;font-size:16px;">  <?php echo $row->sec_name ?></span> </td>
            <td >c`ex t <span style="font-family:serif;font-size:16px;">  <?php echo $row->desig_name ?></span></td>
          </tr>
          <tr>
            <td  colspan="2">kÖwg‡Ki bvg t  <span style="font-family:SutonnyMJ">  <?php echo $row->bangla_nam?></span></td>  
            <td  >wj½ t  <span>  <?php echo $row->emp_sex==1?'পুরুষ':'মহিলা'?></span></td>
          </tr>
          <tr>
            <td  colspan="2">wcZvi bvg t <span style="font-family:serif;">  <?php echo $row->emp_fname_bn ?></span></td>
            <td  colspan="2">gvZvi bvg t <span style="font-family:serif;">  <?php echo $row->emp_mname_bn ?></span></td>
          </tr>
          <tr>
            <td >¯’vqx wVKvbv t <span>   <?php echo $row->per_add_bn?></span></td>
          </tr>
  <!--         <tr>
            <td >MÖvg t <span>  < ?php echo $row->per_village_name ?></span></td>
            <td >†cv÷ Awdm t <span>  < ?php echo $row->per_post_office ?></span></td>
            <td >_vbv t <span>  < ?php echo $row->per_upazila_name ?></span></td>
            <td >†Rjv t <span>  < ?php echo $row->per_district_name ?></span></td>
          </tr> -->
          <tr>
            <td >eZ©gvb wVKvbv t <span>   <?php echo $row->pre_add_bn?></span></td>
          </tr>
<!--           <tr>
            <td >MÖvg t <span>  < ?php echo $row->pre_village_name ?></span></td>
            <td >†cv÷ Awdm t <span>  <  ?php echo $row->upazila_name_bn?></span></td>
            <td >_vbv t <span>  < ?php echo $row->pre_post_office?></span></td>
            <td >†Rjv t <span>  < ?php echo $row->district_name_bn ?></span></td>
          </tr> -->


          <tr>
            <td  colspan="4">Rb¥ ZvwiL (Rb¥ mb` / wkÿ mb` Abyhvqx) t<span style="font-family:sutonnyMJ;font-size:16px;">  <?php echo date('m-d-Y',strtotime($row->emp_dob)) ?></span> <span>ইং</span></td>
          </tr>
          <tr>
            <td  colspan="4">eqm (Rb¥ mb` / wkÿ mb` Abyhvqx) t
              <?php 
                   $a= date('Y') - date('Y', strtotime($row->emp_dob));
                   echo $a;
              ?> eQi
            </td>
          </tr>
          <tr>
            <td >mbv³KiY wPý t </td>
          </tr>
          <tr>
            <td  colspan="2" style="padding-top:40px;">kÖwg‡Ki ¯^vÿi/wUcmB</td>
            <td  colspan="2" style="padding-top:40px;text-align:center;">†iwR÷vW© wPwKrm‡Ki ¯^vÿi</td>
          </tr>
          <tr>
            <td  colspan="4">Avwg GB g‡g© cÖZqb Kwi‡ZwQ †h, bvg t <span style="font-family:"><?php echo $row->bangla_nam ?></span>
              wcZvi bvg t    <span style="font-family:serif;"><?php echo $row->emp_fname_bn ?>,</span>
              gvZvi bvg t    <span style="font-family:serif;"><?php echo $row->emp_mname_bn ?>,</span>
              ¯’vqx wVKvbv t <span>   <?php echo $row->per_add_bn?></span>
            </td>
          </tr>

          <tr>
            <td  colspan="4">‡K Avwg cixÿv KwiqvwQ|
            wZwb cÖwZôv‡b wbhy³ nB‡Z B”QzK, Ges Avgvi cixÿv nB‡Z GBiæc cvIqv wMqv‡Q †h Zvnvi eqm   ermi Ges wZwb cÖwZôv‡b cÖvß eq¯‹/wK‡kvi wnmv‡e wbhy³ nBevi †hvM¨|
            </td>
          </tr>
          <tr>
            <td >mbv³KiY wPý t </td>
          </tr>
          <tr>
            <td  colspan="2" width="50%" style="padding-top:40px;">kÖwg‡Ki ¯^vÿi/wUcmB</td>
            <td  colspan="2" style="padding-top:40px;text-align:center;">†iwR÷vW© wPwKrm‡Ki ¯^vÿi</td>
          </tr>
        </table>
      </div>

    </div>
   <?php }?></span>

  </body>
</html>