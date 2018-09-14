<?php
session_start();
if($_SESSION['user']!='admin'){header('location:../checklogin/error.php');}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Sidhu ERP</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../css/coin-slider.css" />
<link rel="stylesheet" type="text/css" href="../css/superfish.css" media="screen" />
<script type="text/javascript" src="../js/menu.js"></script>
<script type="text/javascript" src="../js/footer.js"></script>
<link href="tablecloth/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="tablecloth/tablecloth.js"></script>
<script type="text/javascript" src="../js/sidebar.js"></script>
<script type="text/javascript" src="../js/cufon-yui.js"></script>
<script type="text/javascript" src="../js/cufon-quicksand.js"></script>
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/script.js"></script>
<script type="text/javascript">
    function confirmit(){
        var workdays= document.forms["updatedetail"]["workday"];
        if(workdays.value==''||workdays.value==null){
            alert('You forgot to enter workdays');
            workdays.focus();
            return false;
        }
        var hra= document.forms["updatedetail"]["hra"];
        if(hra.value==''||hra.value==null){
            alert('You forgot to enter hra');
            hra.focus();
            return false;
        }
        var pf= document.forms["updatedetail"]["pf"];
        if(pf.value==''||pf.value==null){
            alert('You forgot to enter PF');
            pf.focus();
            return false;
        }
        var esi= document.forms["updatedetail"]["esi"];
        if(esi.value==''||esi.value==null){
            alert('You forgot to enter esi');
            esi.focus();
            return false;
        }
        var advance= document.forms["updatedetail"]["adv"];
        if(advance.value==''||advance.value==null){
            alert('You forgot to enter Advance');
            advance.focus();
            return false;
        }
        
    }
    </script>
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
        <h1><a href="adminhome.php"></h1>
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
        <span style="float: left;"><a href="javascript:history.go(-1)">Back</a></span>
        <span style="float: right;"><a href="punjabi/barnala.html">?????? ??? ???? </a></span>
        <br />
          <h2><span>Edit Employee Details for Salary Sheet</span></h2>
          <form method="post" name="updatedetail" action="updatedetail.php">
              <input type="hidden" name="op" value="new"/>
                  <?php
                  include "../dbfiles/config.php";
                  class editsaldetail{
                      private $empdet= array();
                      private $result;
                      private $month;
                      private $year;
                      private $query= array();
                      public function editdet($id){
                          $this->empdet[0]= $id;
                      $this->month= date('n')-1;
                      $this->year= date('Y');
                      $this->query[0]= mysql_query("Select workers.id as id, worker_fname, worker_lname, gross, hra, rate, workdays, CC,npscurrent,npsprevious,hrad,watercharges,electricity,gpf,gis,NPSEC1,NPSEC0,TDS,Miscellaneous,Special,Pension from workers, worker_fixeds, worker_varys where workers.id=worker_fixeds.worker_id and workers.id=worker_varys.id and month='$this->month' and year='$this->year' and workers.id='$id'");
                      if(!$this->query[0]){
                          header('location:qerror.php?op=editsalerror');
                      }
                     else{
                     while($this->result= mysql_fetch_array($this->query[0])){
                         echo '<table align="center" style="margin-right:auto; margin-left:auto; margin-top: 50px; width:50%;"><tr>';
                         echo '<th>EMP ID</th>';
                         echo '<td>'.$this->result['id'].'</td>';
                         echo '</tr>';
                         echo '<input type="hidden" name="id" value="'.$this->result['id'].'"';
                         echo '<tr>';
                         echo '<th>Name of Employee:</th>';
                         echo '<td>'.$this->result['worker_fname'].' '.$this->result['worker_lname'].'</td>';
                         echo '</tr>';
                        
                         echo '<th>Rate/Day:</th>';
                         echo '<td><input readonly="value" size="8px" name="rate" value="'.$this->result['rate'].'"</td>';
                         echo '</tr>';

                         echo '<th>Work Days:</th>';
                         echo '<td><input type="text" size="8px" name="workday" value="'.$this->result['workdays'].'"</td>';
                         echo '</tr>';
                         echo '<th>HRA:</th>';
                         echo '<td><input type="text" size="8px" name="hra" value="'.$this->result['hra'].'"</td>';
                         echo '</tr>';
                         echo '<th>CC:</th>';
                         echo '<td><input type="text" size="8px" name="CC" value="'.$this->result['CC'].'"</td>';
                         echo '</tr>';
                         echo '<th>NPS(Current):</th>';
                         echo '<td><input type="text" size="8px" name="npscurrent" value="'.$this->result['npscurrent'].'"</td>';
                         echo '</tr>';
echo '<th>NPS(Previous):</th>';
                         echo '<td><input type="text" size="8px" name="npsprevious" value="'.$this->result['npsprevious'].'"</td>';
                         echo '</tr>';
                         
						 echo '<th>HRAD</th>';
                         echo '<td><input type="text" size="8px" name="hrad" value="'.$this->result['hrad'].'"</td>';
                         echo '</tr>';
                        
						  echo '<th>WaterCharges</th>';
                         echo '<td><input type="text" size="8px" name="watercharges" value="'.$this->result['watercharges'].'"</td>';
                         echo '</tr>';
						  echo '<th>Electricity</th>';
                         echo '<td><input type="text" size="8px" name="electricity" value="'.$this->result['electricity'].'"</td>';
                         echo '</tr>';
						   echo '<th>GPF</th>';
                         echo '<td><input type="text" size="8px" name="gpf" value="'.$this->result['gpf'].'"</td>';
                         echo '</tr>';
						   echo '<th>GIS</th>';
                         echo '<td><input type="text" size="8px" name="gis" value="'.$this->result['gis'].'"</td>';
                         echo '</tr>';
						   echo '<th>nps-current(ec)</th>';
                         echo '<td><input type="text" size="8px" name="npsec1" value="'.$this->result['NPSEC1'].'"</td>';
                         echo '</tr>';
						   echo '<th>nps-previous(ec)</th>';
                         echo '<td><input type="text" size="8px" name="npsec0" value="'.$this->result['NPSEC0'].'"</td>';
                         echo '</tr>';
						   echo '<th>TDS</th>';
                         echo '<td><input type="text" size="8px" name="tds" value="'.$this->result['TDS'].'"</td>';
                         echo '</tr>';
						 echo '<th>Miscellaneous</th>';
                         echo '<td><input type="text" size="8px" name="miscellaneous" value="'.$this->result['Miscellaneous'].'"</td>';
                         echo '</tr>';
						 echo '<th>Special Allowance</th>';
                         echo '<td><input type="text" size="8px" name="special" value="'.$this->result['Special'].'"</td>';
                         echo '</tr>';
						 
						 echo '<th>Pension Deduction</th>';
                         echo '<td><input type="text" size="8px" name="pension" value="'.$this->result['Pension'].'"</td>';
                         echo '</tr>';
                         echo '<tr><td colspan="2"><input type="submit" value="Enter the Edited Data" onclick="return confirmit()"/></td></tr>';
                         echo '</table>';
                     }
                     }
                      }
                  }
                  $id= base64_decode($_GET['id']);
                  $edsal= new editsaldetail();
                  $edsal->editdet($id);
                  
                  ?>
          </form>
          <br/>
        </div>


      </div>

      <div class="clr"></div>
    </div>
  </div><br />
  <div id="disclaimer">
    <script type="text/javascript">footere();</script>
    </div>
  </div>
</div>
</body>
</html>
