<?php
require_once('../library/odf.php');
include_once '../dbfiles/config.php';
class salaryslip {
    private $query= array();
    private $result= array();
    private $calsal;
    private $ded;
    private $totwages;
    private $netpay;
    private $month;
    private $year;
	private $da;
    private $nwords = array(  "", "One", "Two", "Three", "Four", "Five", "Six", 
	      	  "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
	      	  "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", 
	     	  "Nineteen", "Twenty", 30 => "Thirty", 40 => "Fourty",
                     50 => "Fifty", 60 => "Sixty", 70 => "Seventy", 80 => "Eigthy",
                     90 => "Ninety" );

public function number_to_words ($x)
{
     if(!is_numeric($x))
     {
         $w = '#';
     }else if(fmod($x, 1) != 0)
     {
         $w = '#';
     }else{
         if($x < 0)
         {
             $w = '- ';
             $x = -$x;
         }else{
             $w = '';
         }
         if($x < 21)
         {
             $w .= $this->nwords[$x];
         }else if($x < 100)
         {
             $w .= $this->nwords[10 * floor($x/10)];
             $r = fmod($x, 10);
             if($r > 0)
             {
                 $w .= ' '. $this->nwords[$r];
             }
         } else if($x < 1000)
         {
		
             	$w .= $this->nwords[floor($x/100)] .' hundred';
             $r = fmod($x, 100);
             if($r > 0)
             {
                 $w .= ' '. $this->number_to_words($r);
             }
         } else if($x < 1000000)
         {
         	$w .= $this->number_to_words(floor($x/1000)) .' thousand';
             $r = fmod($x, 1000);
             if($r > 0)
             {
                 $w .= ' ';
                 if($r < 100)
                 {
                     $w .= ' ';
                 }
                 $w .= $this->number_to_words($r);
             }
         } else {
             $w .= $this->number_to_words(floor($x/1000000)) .' million';
             $r = fmod($x, 1000000);
             if($r > 0)
             {
                 $w .= ' ';
                 if($r < 100)
                 {
                     $word .= ' ';
                 }
                 $w .= $this->number_to_words($r);
             }
         }
     }
     return $w;
}
    public function slip() {
        $odf = new odf("slip.odt");
        $article = $odf->setSegment('articles');
        if($_POST['empid']!='') {
            $id= $_POST['empid'];
            if($_POST['month']!='' && $_POST['year']!='') {
                $this->month= $_POST['month'];
                $this->year= $_POST['year'];
                $this->query[0]= mysql_query("Select workers.id as id, worker_fname, worker_lname,Special,Pension,hrad, gross,NPSEC1,NPSEC0,TDS,Miscellaneous,dac, hra,electricity,gpf,gis, rate,basic,watercharges, grade,workdays, CC,npscurrent,npsprevious, accno from workers, worker_fixeds, worker_varys, worker_acc where workers.id=worker_fixeds.worker_id and workers.id=worker_varys.id and workers.id=worker_acc.id and workers.id='$id' and month='$this->month' and year='$this->year'");
            }
            elseif ($_POST['current']!='') {
                $this->month= date('n')-1;
                $this->year= date('Y');
                $this->query[0]= mysql_query("Select workers.id as id, worker_fname, worker_lname, dac,hrad,gross,Special,Pension,NPSEC1,NPSEC0,TDS,Miscellaneous,hra,electricity,gpf,gis, rate,basic, grade,workdays,watercharges, CC,npscurrent,npsprevious, accno from workers, worker_fixeds, worker_varys, worker_acc where workers.id=worker_fixeds.worker_id and workers.id=worker_varys.id and workers.id=worker_acc.id and workers.id='$id' and month='$this->month' and year='$this->year'");
            }
        }
        elseif ($_POST['empname']!='') {
            $name= $_POST['empname'];
            $name= explode(" ", $name);
            if($_POST['month']!='' && $_POST['year']!='') {
                $this->month= $_POST['month'];
                $this->year= $_POST['year'];
                $this->query[0]= mysql_query("Select workers.id as id, worker_fname, worker_lname, gross, hra, dac,hrad,NPSEC1,NPSEC0,TDS,Miscellaneous,rate,basic,electricity,gpf,gis, grade,workdays, Special,Pension,CC,npscurrent,npsprevious,watercharges, accno from workers, worker_fixeds, worker_varys, worker_acc where workers.id=worker_fixeds.worker_id and workers.id=worker_varys.id and workers.id=worker_acc.id and worker_fname='$name[0]' and worker_lname='$name[1]' and month='$this->month' and year='$this->year'");
            }
            elseif ($_POST['current']!='') {
                $this->month= date('n')-1;
                $this->year= date('Y');
                $this->query[0]= mysql_query("Select workers.id as id, worker_fname, worker_lname, gross, hra, rate, dac,hrad,NPSEC1,NPSEC0,TDS,Miscellaneous,electricity,gpf,gis,basic,grade,workdays,watercharges,Special,Pension, CC,npscurrent,npsprevious, accno from workers, worker_fixeds, worker_varys, worker_acc where workers.id=worker_fixeds.worker_id and workers.id=worker_varys.id and workers.id=worker_acc.id and worker_fname='$name[0]' and worker_lname='$name[1]' and month='$this->month' and year='$this->year'");
            }
        }
        else {
            if($_POST['month']!='' && $_POST['year']!='') {
                $this->month= $_POST['month'];
                $this->year= $_POST['year'];
                $this->query[0]= mysql_query("Select workers.id as id, worker_fname, worker_lname, gross, hra, dac,hrad,rate,basic,NPSEC1,NPSEC0,TDS,Miscellaneous, electricity,gpf,gis,grade,workdays,Special,Pension, CC,npscurrent,npsprevious,watercharges, accno from workers, worker_fixeds, worker_varys, worker_acc where workers.id=worker_fixeds.worker_id and workers.id=worker_varys.id and workers.id=worker_acc.id and month='$this->month' and year='$this->year'");
            }
            elseif ($_POST['current']!='') {
                $this->month= date('n')-1;
                $this->year= date('Y');
                $this->query[0]= mysql_query("Select workers.id as id, worker_fname, worker_lname, gross, hra,hrad,dac, NPSEC1,NPSEC0,TDS,Miscellaneous,rate,electricity,gpf,gis, basic,grade,workdays,Special,Pension, CC,npscurrent,npsprevious,watercharges, accno from workers, worker_fixeds, worker_varys, worker_acc where workers.id=worker_fixeds.worker_id and workers.id=worker_varys.id and workers.id=worker_acc.id and month='$this->month' and year='$this->year'");
            }
        }
        if(!$this->query[0]) {
            header('location:qerror.php?op='.mysql_error());
        }
        switch ($this->month) {
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
        $s=1;
        while($this->result[0]=mysql_fetch_array($this->query[0])) {
            $comp_name= $this->result[0]['worker_fname'].' '.$this->result[0]['worker_lname'];
           
            $article->name($comp_name);
            $article->accno($this->result[0]['accno']);
            $article->ecode($s);
            $article->basic($this->result[0]['basic']);
			$article->grade($this->result[0]['grade']);
			$article->gross($this->result[0]['gross']);
            $article->days($this->result[0]['workdays']);
			$this->da=sprintf('%.2f',($this->result[0]['gross'])*1.39);
			$article->da($this->result[0]['dac']);
            $this->calsal= sprintf('%.2f',($this->result[0]['rate'])*($this->result[0]['workdays']));
            $article->calsal( $this->calsal);
            $article->npscurrent($this->result[0]['npscurrent']);
			 $article->npsprevious($this->result[0]['npsprevious']);
			 $article->CCA($this->result[0]['CC']);
                $article->hra($this->result[0]['hra']);
			$article->rate($this->result[0]['rate']);
			$article->workdays($this->result[0]['workdays']);
                $this->totwages=sprintf('%.2f',($this->calsal)+$this->result[0]['npscurrent']+$this->result[0]['npsprevious']+$this->result[0]['CC']);
                $article->total($this->totwages);
            
           $article->watercharges($this->result[0]['watercharges']);
           $article->electricity($this->result[0]['electricity']);
			$article->gpf($this->result[0]['gpf']);
			$article->special($this->result[0]['Special']);
			$article->pension($this->result[0]['Pension']);
			$article->npsec1($this->result[0]['NPSEC1']);
			$article->npsec0($this->result[0]['NPSEC0']);
			$article->tds($this->result[0]['TDS']);
			$article->miscellaneous($this->result[0]['Miscellaneous']);
			$article->gis($this->result[0]['gis']);
			$article->hrad($this->result[0]['hrad']);
			 $this->ded=($this->result[0]['watercharges']+$this->result[0]['electricity']+$this->result[0]['gpf']+$this->result[0]['gis']+$this->result[0]['Special']+$this->result[0]['Pension']+$this->result[0]['NPSEC1']+$this->result[0]['NPSEC0']+$this->result[0]['TDS']+$this->result[0]['Miscellaneous']+$this->result[0]['hrad']);
            $article->month($monthname.', '.$this->year);
           
            $article->totalded($this->ded);
            $this->netpay= round(($this->totwages)-($this->ded));
            $article->netpay($this->netpay);
            $word_pay= $this->number_to_words($this->netpay).' only';
            $article->netpaywords($word_pay);
            $article->merge();
            $s=$s+1;
        }
        $odf->mergeSegment($article);
        $odf->exportAsAttachedFile('CompleteSlip.odt');
    }
}
$sh= new salaryslip();
$sh->slip();
?>
