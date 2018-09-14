<?php
session_start();
if($_SESSION['user']!='admin') {
    header('location:../checklogin/error.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>BUAT</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../css/coin-slider.css" />
        <link rel="stylesheet" type="text/css" href="../css/superfish.css" media="screen" />
        <style type="text/css">
            td {
                line-height: 2em;
                border: 1px solid black;
            }
        </style>
        <script type="text/javascript" src="../js/menu.js"></script>
        <script type="text/javascript" src="../js/footer.js"></script>
        <link href="tablecloth/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />
        <script type="text/javascript" src="tablecloth/tablecloth.js"></script>
        <script type="text/javascript" src="../js/sidebar.js"></script>
        <script type="text/javascript" src="../js/cufon-yui.js"></script>
        <script type="text/javascript" src="../js/cufon-quicksand.js"></script>
        <script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../js/coin-slider.min.js"></script>
        <script type="text/javascript" src="../js/hoverIntent.js"></script>
        <script type="text/javascript" src="../js/superfish.js"></script>
        <script type="text/javascript">

            // initialise plugins
            jQuery(function(){
                jQuery('ul.sf-menu').superfish();
            });

        </script>
    </head>
    <body>
        <div class="main">
            <div class="header">
                <div class="header_resize">
                    <div class="logo">
                        <h1><a href="adminhome.php"></a></h1>
                    </div>

                    <div class="clr"></div>
                    <script type="text/javascript">menue();</script>
                    <br/>
                    <div class="clr"></div>

                </div>
                <div class="content">
                    <div class="content_resize">
                        <div class="mainbar">
                            <div class="article">
                                <br />
                                <span style="float: left;"><a href="javascript:history.go(-1)"><img src="../images/back.png" width="30px" height="30px" alt="BACK" title="Back"></img></a></span>
                                <span style="float: right;"><a href="adminhome.php">Home<img src="../images/home.png" width="30px" height="30px"></img></a></span>
                                <br />
                                <h2><span>Final Salary Sheet</span></h2>
                                <form method="post" action="odtsheet.php">
                                    <input type="hidden" name="op" value="up"/>
                                    <table width="70%" cellpadding="0" cellspacing="0" style="text-align: center; border: 0.5px solid black;">
                                        <tr style="background:#003456;">
                                            <th>
                                                Sr. No
                                            </th>
                                            <th>
                                            Name
                                            </th>
                                            <th>
                                                Total Salary
                                            </th>
											 <th>
                                                DA
                                            </th>
											 <th>
                                               HRA
                                            </th>
                                            <th>
                                                Rate/Day
                                            </th>
                                            <th>
                                                Work Days
                                            </th>
                                            <th>
                                                Cal Salary
                                            </th>
                                            <th>
                                               CC
                                            </th>
											
                                            <th>
                                              NPS
											-c
                                            </th>
                                            <th>
                                                NPS(previous)
                                            </th>
                                            <th>
                                              Gross Pay
                                            </th>
                                           <th>
                                              HRAD
                                            </th>
											 <th>
                                             Watercharges
                                            </th>
											 <th>
                                             Electricity
                                            </th>
											 <th>
                                            GPF
                                            </th>
											 <th>
                                            GIS
                                            </th>
											 <th>
                                            NPS-EC
											(current)
                                            </th>
											 <th>
                                             NPS-EC
											(previous)
                                            </th>
											 <th>
                                            TDS
                                            </th>
											<th>
                                            Miscellaneous
                                            </th>
											 <th>
                                            Special Allowance
                                            </th>
											 <th>
                                           Pension Deduction
                                            </th>
											 <th>
                                           Total Deduction
                                            </th>
											<th>
                                          Net Salary
                                            </th>
											
                                        </tr>
                                        <?php
                                        include "../dbfiles/config.php";
                                        class finalsheet {
                                            private $query= array();
                                            private $result= array();
                                            private $total= array();
                                            private $calsal;
                                            private $ded;
                                            private $totwages;
                                            private $netpay;
                                            private $month;
                                            private $DA;
											 private $mac;
                                            public function seedata() {
                                              
                                                $this->total[2]=0;
                                                $this->total[3]=0;
                                                $this->total[4]=0;
                                                $this->total[5]=0;
                                                $this->total[6]=0;
                                                $this->total[7]=0;
                                                $this->total[8]=0;
                                                $this->total[9]=0;
                                                $this->total[10]=0;
                                                $this->total[11]=0;
                                                $this->month= date('n')-1;
                                                $this->year= date('Y');
                                                $this->query[0]=mysql_query("Select id from worker_varys where month='$this->month'");
                                                $count= mysql_num_rows($this->query[0]);
                                                if($count==0) {
                                                    echo "<script>var check= confirm('No data for updation');
                               if(check==true){
                               window.location='newsheet.php';}
                               else{
                               window.location='adminhome.php';}
                                </script>";
                                                }
                                                else {
                                                    $this->query[1]= mysql_query("Select workers.id as id, worker_fname, worker_lname, gross, hra, rate, workdays, CC, npscurrent, dac,npsprevious,hrad,watercharges,electricity,gpf,gis,NPSEC1,NPSEC0,TDS,Miscellaneous,Special,Pension from workers, worker_fixeds, worker_varys where workers.id=worker_fixeds.worker_id and workers.id=worker_varys.id and month='$this->month' and year='$this->year'");
                                                    if(!$this->query[1]) {
                                                        header('location:qerror.php?op='.mysql_error());
                                                    }
                                                    $this->i=1;
                                                    while($this->result[2]=mysql_fetch_array($this->query[1])) {
                                                        if(($this->i)%2==0) {
                                                            echo "<tr>";
                                                        }
                                                        else {
                                                            echo "<tr>";
                                                        }
														  $this->mac=0;
                                                        echo "<input type='hidden' name=id[] value=".$this->result[2]['id']." />";
														$this->f=$this->result[2]['id'];
                                                        echo "<td>".$this->i."</td>";
                                                        echo "<td style='width:70px;'>".$this->result[2]['worker_fname'].' '.$this->result[2]['worker_lname']."</td>";
                                                        echo "<td>".$this->result[2]['gross']."</td>";
														
														
														 echo "<td>".$this->result[2]['dac']."</td>";
														echo "<td>".$this->result[2]['hra']."</td>";
                                                        echo "<td>".$this->result[2]['rate']."</td>";
                                                        echo "<td>".$this->result[2]['workdays']."</td>";
                                                        $this->calsal= sprintf('%.2f',($this->result[2]['rate'])*($this->result[2]['workdays']));
                                                        echo "<td>".$this->calsal."</td>";
                                                         echo "<td>".$this->result[2]['CC']."</td>";
														
														echo "<td>".$this->result[2]['npscurrent']."</td>";
														echo "<td style='width:50px;'>".$this->result[2]['npsprevious']."</td>";
														  
														
														 $this->mac= $this->result[2]['CC']+$this->result[2]['npscurrent']+$this->result[2]['npsprevious']+  $this->calsal;
														echo "<td>".$this->mac."</td>";
														
														echo "<td>".$this->result[2]['hrad']."</td>";
														echo "<td>".$this->result[2]['watercharges']."</td>";
														echo "<td>".$this->result[2]['electricity']."</td>";
														echo "<td>".$this->result[2]['gpf']."</td>";
														echo "<td>".$this->result[2]['gis']."</td>";
														echo "<td>".$this->result[2]['NPSEC1']."</td>";
														echo "<td>".$this->result[2]['NPSEC0']."</td>";
														echo "<td>".$this->result[2]['TDS']."</td>";
														echo "<td>".$this->result[2]['Miscellaneous']."</td>";
														echo "<td>".$this->result[2]['Special']."</td>";
														echo "<td>".$this->result[2]['Pension']."</td>";
														 $this->total[3]= sprintf('%.2f', ($this->result[2]['hrad']) + ( $this->result[2]['watercharges'])+($this->result[2]['electricity'])+($this->result[2]['gpf'])+($this->result[2]['gis'])+($this->result[2]['NPSEC1'])+($this->result[2]['NPSEC0'])+($this->result[2]['TDS'])+($this->result[2]['Miscellaneous'])+($this->result[2]['Special'])+($this->result[2]['Pension']));
														echo "<td>".$this->total[3]."</td>";
														$this->total[4]= sprintf('%.2f', $this->mac - ( $this->total[3]));
														echo "<td>".$this->total[4]."</td>";
														$this->f2=$this->total[4];
                                                        echo "</tr>";
														
														
														 
														
														
														
														
														
                                                        $this->i=$this->i+1;
														
                                                    }
                                                   
                                                }
                                            }
                                        }
                                        $sh= new finalsheet();
$sh->seedata();
?>
                                        <tr>
                                            <td colspan="12">
                                                <center><input type="submit" value="Go for Salary sheet Generation"/></center>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                                <br/>
                            </div>


                        </div>
                    </div><br />
                    <div id="disclaimer" style="margin-bottom: 20px;">
                        <script type="text/javascript">footere();</script>
                    </div>
                </div>
            </div>
    </body>
</html>
