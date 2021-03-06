<?php
session_start();
if($_SESSION['user']!='admin') {
    header('location:../checklogin/error.php');
}
require_once('../library/odf.php');
include '../dbfiles/config.php';
class bankslip {
    private $op;
    private $query= array();
	 private $total=array();
    public function download_slip() {
		$total[0]=0;
        $odf = new odf("bankslip.odt");
        if($_POST['month']!='' && $_POST['year']=='') {
            echo "<script>alert('You forgot to submit year'); window.location='bankslip.php';</script>";
        }
        elseif ($_POST['month']=='' && $_POST['year']!='') {
            echo "<script>alert('You forgot to enter month'); window.location='bankslip.php';</script>";
        }
        elseif (($_POST['month']!='' && $_POST['year']!='') && $_POST['current']!='') {
            echo "<script>alert('Hello!! I didnt told you to select all options'); window.location='bankslip.php';</script>";
        }
        elseif (($_POST['month']=='' && $_POST['year']=='') && $_POST['current']=='') {
            echo "<script>alert('Hello!! I told you to select one option'); window.location='bankslip.php';</script>";
        }
        elseif ($_POST['month']!=''&& $_POST['year']!='') {
            $this->op= 'defined';
            $month= $_POST['month'];
            $year= $_POST['year'];

        }
        elseif ($_POST['current']!='') {
            $this->op= 'current';
            $month= date('n')-1;
            $year= date('Y');
        }
		
        switch ($month) {
            case 1:
                $monthname= 'January';
                break;
            case 2:
                $monthname= 'February';
                break;
            case 3:
                $monthname= 'March';
                break;
            case 4:
                $monthname= 'April';
                break;
            case 5:
                $monthname= 'May';
                break;
            case 6:
                $monthname= 'June';
                break;
            case 7:
                $monthname= 'July';
                break;
            case 8:
                $monthname= 'August';
                break;
            case 9:
                $monthname= 'September';
                break;
            case 10:
                $monthname= 'October';
                break;
            case 11:
                $monthname= 'November';
                break;
            case 12:
                $monthname= 'December';
                break;
        }
        $odf->setVars('month', $monthname);
        $odf->setVars('year', $year);
		
        $this->query[0]= mysql_query("Select workers.id as id, worker_fname, worker_lname, gross, hra, rate, workdays, accno,nett from workers, worker_fixeds, worker_varys, worker_acc where workers.id=worker_fixeds.worker_id and workers.id=worker_varys.id and workers.id=worker_acc.id and month='$month' and year='$year'");
        $bank = $odf->setSegment('emp');
		 
        $s=1;
        while($result= mysql_fetch_array($this->query[0])) {
            if(!$result) {
                header('location:qerror.php?op='.mysql_error());
            }
            $cal= sprintf('%.2f',($result['rate'])*($result['workdays']));
           
           
                $wages= $result['nett'];
                
               $bank->name($result['worker_fname'].' '.$result['worker_lname']); 
              
              $total[0]=$total[0]+$wages;
      
            $bank->s($s);
            $bank->accno($result['accno']);
           
            $bank->amount($wages);
            $bank->merge();
            $s=$s+1;
			
        }
        $odf->mergeSegment($bank);
         $odf->setVars('total', $total[0]);
        $odf->exportAsAttachedFile('Bankslip.odt');
    }
}
$bank_slip= new bankslip();
$bank_slip->download_slip();
?>