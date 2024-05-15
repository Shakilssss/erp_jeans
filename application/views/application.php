<!DOCTYPE html>
<html>
  <head>
    <title>Application</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <style>
      td {
        font-family: SutonnyMJ;
      }
      table,
      th,
      td {
        border-collapse: collapse;
        padding-top: 10px;
        padding-left: 5px;
      }
      
      td {
        font-size: 19px;
      }

      @page :left {
        margin: 18px;
      }

      @page :right {
        margin: 18px;
      }

      @media print {
        span{
          text-align: justify;
        }
        .pagebreak {
          clear: both;
          page-break-after: always;
          padding:20px;
        }
      }
    </style>
  
  </head>
  <body>
  <?php foreach( $values as $row){?>
    <div id="wrapper" class="pagebreak">
      <div id="header">
         <?php $this->load->view('head_bangla'); ?>  
         <br>
      </div>
    <div  style="font-family: SutonnyMJ;font-size: 20px;margin: 0 auto;width: 1000px;">
      <span>eivei,</span>
      <br />
      <span>e¨e¯’vcbv cwiPvjK</span>
      <br />
      <span style="font-size:13px">জিন্স ম্যানুফ্যাকচারিং কোঃ লিঃ</span>
      <br />
      <span style="font-size:13px">ঋষিপাড়া, সিংগাইর রোড, হেমায়েতপুর, সাভার, ঢাকা-১৩৪০</span> 
      <br />
      <p>welq t <span style="font-size:15px"><?php echo $row->desig_bangla?></span> c‡` PvKzixi Rb¨ Av‡e`b cÎ|</p>
      <p>
        <span>g‡nv`q,</span>
        <br />
        <span style="text-align:justify">h_vh_ m¤§vb c~e©K webxZ wb‡e`b GB †h, wek¦¯Ím~‡Î AeMZ nBjvg †h Avcbvi kZfvM ißvbxgyLx ‡cvkvK wkí KviLvbvq  <span style="font-size:15px"><?php echo $row->desig_bangla?></span> c‡` wKQz msL¨K †jvK wb‡qvM Kiv n‡e| Avwg D³ c‡`i GKRb cÖv_©x/ cÖv_©xwb wn‡m‡e Avgvi e¨w³MZ Z_¨, wk¶vMZ †hvM¨Zv I Kv‡Ri AwfÁZv BZ¨vw`i weeiY Avcbvi m`q we‡ePbvi Rb¨ wb‡gœ †ck Kwijvg t-</span>
      </p>
      <table class="">
        <tr>
          <td>1| bvg </td>
          <td>t</td>
          <td><span style="font-size:15px"><?php echo $row->bangla_nam?></span></td>
        </tr>
        <tr>
          <td>2| wcZv/ ¯^vgxi bvg
          <td>t</td>
          <td><span style="font-size:15px;font-family:serfi"><?php echo $row->emp_fname_bn?></span></td>
        </tr>
        <tr>
          <td>3| gvZvi bvg
          <td>t</td>
          <td><span style="font-size:15px;font-family:serfi"><?php echo $row->emp_mname_bn?></span></td>
        </tr>
        <tr>
          <td>4| wVKvbv (K) ¯’vqx </td>
          <td>t</td>
          <td>
            <span  style="font-size:15px"><?php echo $row->per_add_bn?></span>
          </td>
        </tr>

        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(L) eZ©gvb </td>
          <td>t </td>
          <td>
              <span  style="font-size:15px"><?php echo $row->pre_add_bn?></span>
          </td>
        </tr>

        <tr>
          <td>5| Rb¥ ZvwiL
          <td>t </td>
          <td><span><?php echo date('d-m-Y', strtotime($row->emp_dob))?></span> eqm t 
         <?php 
            $a= date('Y') - date('Y', strtotime($row->emp_dob));
            echo $a;
         ?> 
         </td>
        </tr>
        <tr>
          <td>6| RvZxqZv
          <td>t</td>
          <td> (bvMwiKZ¡ mb`/ RvZxq cwiPq c‡Îi Kwc mshy³)</td>
        </tr>
        <tr>
          <td>7| ˆeevwnK Ae¯’v
          <td>t</td>
          <td>
            <span>
            <?php echo $row->status == 1 ? "AweevwnZ":"weevwnZ"; ?>
            
            </span>&nbsp;&nbsp;&nbsp;&nbsp; ag© t 
            <?php echo $row->emp_religion == 1 ? "Bmjvg"     : (
                       $row->emp_religion == 2 ? "wn›`y"     : (
                       $row->emp_religion == 3 ? "wLª÷vb" : ($row->emp_religion==4?"‡eŠ×":"") )); ?>
          </td>
        </tr>
        <tr>
          <td>8| mšÍv‡bi msL¨v
          <td>t</td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ‡Q‡j t &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; †g‡qt</td>
        </tr>
        <tr>
          <td>9| wk¶vMZ †hvM¨Zv
          <td>t</td>
          <td><span><?php echo $row->emp_degree==""?"":$row->emp_degree?></span></td>
        </tr>
        <tr>
          <td> 10| AwfÁZv
          <td>t</td>
          <td></td>
        </tr>
        <tr>
          <td> 11| cwiwPZ GKRb e¨w³i bvg I wVKvbv m¤úK© mn </td>
          <td>t</td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td> ‡dvb bs <span style="font-family:SutonnyMJ"> <?php echo $row->mobile;?></span></td>
        </tr>
      </table>
      <br/>
      <div> Avwg GB g‡g© cÖZ¨qb Kwi‡ZwQ †h, Dc‡iv³ Z_¨vw` mZ¨| †ckK…Z Z_¨vw` wg_¨v cÖgvwYZ nB‡j Zvnvi Rb¨ Avwg `vqx _vwKe Ges AvBbvbyM †h †Kvb kvw¯ÍgyjK e¨e¯’v gvwbqv wbe| D‡jL&L¨ †h, Avgv‡K wb‡qvM cÖ`vb Kiv nB‡j †Kv¤úvbxi wbqgKvbyb gvwbq Pwj‡Z eva¨ _vwKe| <br />
        <br />
        <br />
        <span>ZvwiL t</span>
        <span  style="float:right;border-top: 1px solid black;margin-top:5px;margin-right: 20px;">Av‡e`bKvixi ¯^v¶i</span>
        <br />
        <br />
      </div>
    </div>
  </div>
    <?php }?>
  </body>
</html>