<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/print.css" media="print" />

            <style type="text/css">
                .sal {
                border: 2px solid #CCCCCC;
                border-collapse: collapse;
                }
                .sal td, .sal th {
                    border: 1px solid #CCC;
                }
                .sal tr:nth-of-type(odd) {
                    background-color: #FBFDFF;
                }
                .sal tr.line td {
                    text-align:  center;
                }
                .total_style1
                {
                    background:#C1E0FF;
                    width: 85px;
                }
                .total_style2
                {
                    background:white;
                    width: 85px;
                }
            </style>
    </head>

    <body>
        <div style=" margin:0 auto;  width:1300px;">
            <div id="no_print" style="float:right;"> </div>
            <?php  $this->load->view("head_english");  ?>

            <div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
                <span style="font-size:13px; font-weight:bold;"> <?php echo $title; ?> of <?php echo $report_date; ?></span>
                <br />
                <br />
                <table class="sal" border="1" cellpadding="1" cellspacing="0" align="center" style="font-size:12px; width:99%;">
                    <tr style="font-weight:bold;text-align:center; background:#C1E0FF;">
                        <td rowspan="2" style="width: 30px">SL</td>
                        <td rowspan="2" style="width: 120px"><?php echo $category; ?> Name</td>
                        <td rowspan="2" style="width: 70px">Employee</td>
                        <td rowspan="2" style="width: 70px">Total OT</td>

                        <td colspan="2">Operator</td>
                        <td colspan="2">Helper</td>
                        <td colspan="2">QC</td>
                        <td colspan="2">Ironman</td>
                        <td colspan="2">Packingman</td>
                        <td colspan="2">Foldingman</td>
                        <td colspan="2">Handtagman</td>
                        <td colspan="2">Layman</td>
                        <td colspan="2">Numberman</td>
                        <td colspan="2">Bundlingman</td>
                    
                    </tr>
                    <tr style="font-weight:bold; text-align:center;background:#e6ccf1;">
                        <td style="width:40px;background:#C1E0FF">Emp.</td>
                        <td style="width:40px;background:#C1E0FF">OT</td>
                        
                        <td style="width:40px">Emp.</td>
                        <td style="width:40px">OT</td>
                        
                        <td style="width:40px; background:#C1E0FF">Emp.</td>
                        <td style="width:40px; background:#C1E0FF">OT</td>
                        
                        <td style="width:40px">Emp.</td>
                        <td style="width:40px">OT</td>
                        
                        <td style="width:40px; background:#C1E0FF">Emp.</td>
                        <td style="width:40px; background:#C1E0FF">OT</td>
                        
                        <td style="width:40px">Emp.</td>
                        <td style="width:40px">OT</td>
                        
                        <td style="width:40px; background:#C1E0FF">Emp.</td>
                        <td style="width:40px; background:#C1E0FF">OT</td>

                        
                        <td style="width:40px">Emp.</td>
                        <td style="width:40px">OT</td>
                        
                        <td style="width:40px; background:#C1E0FF">Emp.</td>
                        <td style="width:40px; background:#C1E0FF">OT</td>

                        <td style="width:40px">Emp.</td>
                        <td style="width:40px">OT</td>                        
                    </tr>
                    <?php
                        $total_emp   = 0;
                        $total_ot   = 0;

                        $helper             = 0;
                        $operator           = 0;
                        $qc                 = 0;
                        $ironman            = 0;
                        $packingman         = 0;
                        $Foldingman         = 0;
                        $handtagman         = 0;
                        $layman             = 0;
                        $numberman          = 0;
                        $bundlingman        = 0;

                        $helper_ot            = 0;
                        $operator_ot          = 0;
                        $qc_ot                = 0;
                        $ironman_ot           = 0;
                        $packingman_ot        = 0;
                        $Foldingman_ot        = 0;
                        $handtagman_ot        = 0;
                        $layman_ot            = 0;
                        $numberman_ot         = 0;
                        $bundlingman_ot       = 0;                      

                    ?>
                    <?php foreach ($values as $key => $row) {  $row = (object) $row; ?>

                        <tr class="line">
                            <td style="background:#C1E0FF"><?php echo $key + 1; ?></td>
                            <td>
                                <?php echo $row->line_name; ?>
                            </td>

                            <td style="background:#C1E0FF">
                                <?php 
                                    echo $row->total_emp; 
                                    $total_emp = $total_emp + $row->total_emp;
                                ?>
                            </td>
                            <td>
                                <?php 
                                    echo $row->total_ot; 
                                    $total_ot = $total_ot + $row->total_ot;
                                ?>
                            </td>

                            <td style="background:#C1E0FF">
                                <?php 
                                    echo $row->operator;
                                    $operator = $row->operator + $operator; 
                                ?>
                            </td>
                            <td style="background:#C1E0FF">
                                <?php 
                                    echo $row->operator_ot; 
                                    $operator_ot = $row->operator_ot + $operator_ot;
                                ?>
                            </td>

                            <td>
                                <?php 
                                    echo $row->helper; 
                                    $helper = $row->helper + $helper;
                                ?>
                            </td>
                            <td>
                                <?php 
                                    echo $row->helper_ot; 
                                    $helper_ot = $row->helper_ot + $helper_ot;
                                ?>
                            </td>

                            <td style="background:#C1E0FF">
                                <?php 
                                    echo $row->qc; 
                                    $qc = $row->qc + $qc; 
                                ?>
                            </td>
                            <td style="background:#C1E0FF">
                                <?php 
                                    echo $row->qc_ot; 
                                    $qc_ot = $row->qc_ot + $qc_ot;
                                ?>
                            </td>

                            <td>
                                <?php 
                                    echo $row->ironman; 
                                    $ironman = $row->ironman + $ironman; 
                                ?>
                            </td>
                            <td>
                                <?php 
                                    echo $row->ironman_ot; 
                                    $ironman_ot = $row->ironman_ot + $ironman_ot;
                                ?>
                            </td>


                            <td style="background:#C1E0FF">
                                <?php 
                                    echo $row->packingman; 
                                    $packingman = $row->packingman + $packingman; 
                                ?>
                            </td>
                            <td style="background:#C1E0FF">
                                <?php 
                                    echo $row->packingman_ot; 
                                    $packingman_ot = $row->packingman_ot + $packingman_ot;
                                ?>
                            </td>


                            <td >
                                <?php 
                                    echo $row->Foldingman; 
                                    $Foldingman = $row->Foldingman + $Foldingman; 
                                ?>
                            </td>
                            <td>
                                <?php 
                                    echo $row->Foldingman_ot; 
                                    $Foldingman_ot = $row->Foldingman_ot + $Foldingman_ot;
                                ?>
                            </td>


                            <td style="background:#C1E0FF">
                                <?php 
                                    echo $row->handtagman; 
                                    $handtagman = $row->handtagman + $handtagman; 
                                ?>
                            </td>
                            <td style="background:#C1E0FF">
                                <?php 
                                    echo $row->handtagman_ot; 
                                    $handtagman_ot = $row->handtagman_ot + $handtagman_ot;
                                ?>
                            </td>


                            <td >
                                <?php 
                                    echo $row->layman; 
                                    $layman = $row->layman + $layman; 
                                ?>
                            </td>
                            <td>
                                <?php 
                                    echo $row->layman_ot; 
                                    $layman_ot = $row->layman_ot + $layman_ot;
                                ?>
                            </td>


                            <td style="background:#C1E0FF">
                                <?php 
                                    echo $row->numberman; 
                                    $numberman = $row->numberman + $numberman; 
                                ?>
                            </td>
                            <td style="background:#C1E0FF">
                                <?php 
                                    echo $row->numberman_ot; 
                                    $numberman_ot = $row->numberman_ot + $numberman_ot;
                                ?>
                            </td>


                            <td >
                                <?php 
                                    echo $row->bundlingman; 
                                    $bundlingman = $row->bundlingman + $bundlingman; 
                                ?>
                            </td>
                            <td>
                                <?php 
                                    echo $row->bundlingman_ot; 
                                    $bundlingman_ot = $row->bundlingman_ot + $bundlingman_ot;
                                ?>
                            </td>                

                        </tr>
                    <?php } ?>
                    <tr style="font-weight:bold;text-align:center;">
                        <td colspan="2">Total</td>
                        <td style="background:#C1E0FF;"><?php echo $total_emp; ?></td>
                        <td><?php echo $total_ot; ?></td>

                        <td style="background:#C1E0FF;"><?php echo $operator; ?></td>
                        <td style="background:#C1E0FF;"><?php echo $operator_ot; ?></td>

                        <td><?php echo $helper; ?></td>
                        <td><?php echo $helper_ot; ?></td>

                        <td style="background:#C1E0FF;"><?php echo $qc; ?></td>
                        <td style="background:#C1E0FF;"><?php echo $qc_ot; ?></td>

                        <td><?php echo $ironman; ?></td>
                        <td><?php echo $ironman_ot; ?></td>

                        <td style="background:#C1E0FF;"><?php echo $packingman; ?></td>
                        <td style="background:#C1E0FF;"><?php echo $packingman_ot; ?></td>

                        <td><?php echo $Foldingman; ?></td>
                        <td><?php echo $Foldingman_ot; ?></td>

                        <td style="background:#C1E0FF;"><?php echo $handtagman; ?></td>
                        <td style="background:#C1E0FF;"><?php echo $handtagman_ot; ?></td>

                        <td><?php echo $layman; ?></td>
                        <td><?php echo $layman_ot; ?></td>

                        <td style="background:#C1E0FF;"><?php echo $numberman; ?></td>
                        <td style="background:#C1E0FF;"><?php echo $numberman_ot; ?></td>

                        <td><?php echo $bundlingman; ?></td>
                        <td><?php echo $bundlingman_ot; ?></td>

                    </tr>
                </table>
            </div>
            <?php //echo "<pre>"; print_r($prev_values); die; ?>

            <br>
            <div style="">

            </div>
            <br><br>
            <br><br>
        </div>
        <br><br>
        <br><br>
        <br><br>
    </body>
</html>
