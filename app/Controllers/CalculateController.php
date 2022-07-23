<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/// */ 
ini_set('display_errors', 0); ini_set('display_startup_errors', 0); error_reporting(E_ALL); /// */

$GLOBALS['mantisa'] = is_int($GLOBALS['mantisa']) ? $GLOBALS['mantisa'] : 16;

class CalculateController extends AbstractController{
    public $model, $memcached,
    $districts,
    $marks,
    $reports,
    $index,
    $O,
    $minO,
    $maxO,
    $T,
    $minT,
    $maxT,
    $isO,
    $isT,
    $iP,
    $KO;

    public function __construct(){
        $this->model = new \App\Models\CalculateModel; $this->memcached = (object) $this->connMCD();
        $this->setParametrs()?->CalculateIP()?->genExel()?->writeData()?->printWeb(); ///*/ 
    }

    public function index(){ ///*/ 
    $this->memcached->flush(1); ///*/  
       ///*/ pa($this); //
       /*/
        var_dump($this->index[1]['8.2']['idx'][0]['index']); ///* /
        pa($this->index[15]['8.2']['idx']); ///* /
        pa($this->O[1]['8.2']); ///* /
        pa($this->T[1]['8.2']); ///* /
        pa($this->O); ///*/
    }///*/ 
    
    public function setParametrs(){
        $this->districts = $this->memcached->get('districts'); 
        $this->marks = $this->memcached->get('marks'); 
        $this->reports = $this->memcached->get('reports');
        $this->insex = $this->memcached->get('insex');
        
        if(empty($this->districts)){$d = [];  
            array_walk_recursive($this->model->getQuery("SELECT * FROM uin WHERE `type`='district' ORDER BY `id` ASC;"), function($v, $k) use (&$d){if('id' == $k){$d[] = $v;}});
            $this->districts = $d = (!empty($d) && is_array($d)) ? $d : [];
            $this->memcached->set('districts', $d, $GLOBALS['lifeMemcache']);
        }
///*/ pa($this->districts, 10); ///*/         
        if(empty($this->marks)){$m = [];
            array_walk_recursive($this->model->getQuery("SELECT num FROM marks;"), function($v, $k) use (&$m){if('num' == $k){$m[] = $v;}});
            $this->marks = (!empty($m) && is_array($m)) ? $m : [];
            $this->memcached->set('marks', $this->marks, $GLOBALS['lifeMemcache']);
        }
///*/ pa($this->marks, 10); ///*/         
        if(empty($this->reports) && !empty($this->districts) && is_array($this->districts)){
            for($i=0,$c=count($this->districts); $i<$c; $i++){
                (int)$uin = $this->districts[$i];
                $d = $this->model->getQuery("SELECT id,deadline FROM reports WHERE `id_uin`='".($uin)."' AND `status`=1 ORDER BY `id` DESC LIMIT 4;");
                if(is_array($d) && !empty($d) && 4 != count($d)){return null;}
            for($l=0,$s=count($d); $l<$s; $l++){$r[$uin]['deadline'] = $d[0]['deadline']; $r[$uin][] = $d[$l]['id'];
            }}
            if(!empty($r) && is_array($r)){$this->reports = $r;
            $this->memcached->set('reports', $this->reports, $GLOBALS['lifeMemcache']);
        }}
///*/ pa($this->reports, 10); ///*/        
        if(empty($this->index) && !empty($this->reports) && is_array($this->reports) && !empty($this->marks) && is_array($this->marks)){
        for($i_r=1, $c_r=count($_r = $this->reports); $i_r <= $c_r; $i_r++){
            $deadline = $_r[$i_r]['deadline']; unset($this->reports[$i_r]['deadline'], $_r[$i_r]['deadline']);                    
            for($i_m=0, $c_m=count($_m = $this->marks); $i_m < $c_m; $i_m++){
                $_4_inxdexa = $this->model->getIndexes([$_m[$i_m]],[$i_r],$_r[$i_r],4); ///*/ Бывает и пустым, например 8, там где есть .1,.2 и т.д., но нет ведущего числа, например 20.1, 20.2, но нет 20 ///*/
                if(!empty($_4_inxdexa) && 4 == count($_4_inxdexa)){
                    for($i=0; $i<4; $i++){$_4_inxdexa[$i]['index'] = ('' == $_4_inxdexa[$i]['index']) ? '' : number_format((float) $_4_inxdexa[$i]['index'], 3, '.', '');}
                    $this->index[$i_r][$_m[$i_m]]['reports'] = json_encode($_r[$i_r]);
                    $this->index[$i_r][$_m[$i_m]]['deadline'] = $deadline;
                    $this->index[$i_r][$_m[$i_m]]['idx'] = $_4_inxdexa;
                }
            }unset($deadline);
        }}    
///*/ pa($this->index, 10); ///*/ 
        return (!empty($this->districts) && is_array($this->districts) && !empty($this->marks) && is_array($this->marks) && !empty($this->reports) && is_array($this->reports) && !empty($this->index) && is_array($this->index)) ? $this : null;
    }
      
    public function CalculateIP(){///*/
        $O = $this->memcached->get('O');
        $T = $this->memcached->get('T');
        $isO = $this->memcached->get('isO'); 
        $isT = $this->memcached->get('isT'); 
        $iP = $this->memcached->get('iP');          
        $KO = $this->memcached->get('KO');          
 
        if(!is_array($O) && !is_array($T)){if(empty($this->index) && !is_array($this->index)){return null;}
            foreach($this->index as $_d => $marks){
                foreach($marks as $_m => $_4_indexa){
                    if(4 == count($_4_indexa['idx'])){
                        $O[$_d][$_m] = $sopO = $this->sopOstrT($_4_indexa['idx'], 'O');                                                
                        $T[$_d][$_m] = $strT = $this->sopOstrT($_4_indexa['idx'], 'T');
                        ///*/ if(5 == $_d && '39.3' ==$_m){pa($_4_indexa['idx']);} ///*/   
                        if('' != $sopO && is_numeric($sopO)){$Om[$_m][$_d] =  $sopO;} 
                        if('' != $strT && is_numeric($strT)){$Tm[$_m][$_d] =  $strT;} 
                    }else{///*/ pa($_4_indexa); ///*/
                        return null;
        }}}}
        
        if(is_array($Om) && is_array($Tm) && !empty($Om) && !empty($Tm)){$mO = $this->arrayMinMax($Om); $mT = $this->arrayMinMax($Tm);}else{return null;}

        if(empty($isO)){$isO =  $this->isOisT($O, $mO);}
        if(empty($isT)){$isT =  $this->isOisT($T, $mT);}
        if(empty($iP)){$iP =  $this->iP($isT, $isO);}
        if(empty($KO)){$KO =  $this->KO($iP);}
        
        ///*/ pa($isO[5]); pa($isT[5]); ///*/ 
 
        $this->memcached->set('O', $O, $GLOBALS['lifeMemcache']); 
        $this->memcached->set('T', $T, $GLOBALS['lifeMemcache']);
        $this->memcached->set('isO', $isO, $GLOBALS['lifeMemcache']);
        $this->memcached->set('isT', $isT, $GLOBALS['lifeMemcache']);
        $this->memcached->set('iP', $iP, $GLOBALS['lifeMemcache']);
        $this->memcached->set('KO', $iP, $GLOBALS['lifeMemcache']);
        
        $this->O = $O;
        $this->minO = $mO['min'];
        $this->maxO = $mO['max'];
        $this->T = $T;
        $this->minT = $mT['min'];
        $this->maxT = $mT['max'];
        $this->isO = $isO;
        $this->isT = $isT;
        $this->iP = $iP; 
        $this->KO = $KO; 

        return (!empty($this->index) && !empty($this->O) && !empty($this->T) && !empty($this->isO) &&  !empty($this->isT) &&  !empty($this->iP)) ? $this : null; 
    }///*/    
    
    public function sopOstrT(array $_4_indexa, string $type = 'sop'){if(empty($_4_indexa) && !is_array($_4_indexa)){return false;}
        (int) $m =  $GLOBALS['mantisa']; bcscale($m); (float) $return = 0.00;
        for($i=0;$i<4; $i++){
            $dateCreatingReport = $this->is_date($_4_indexa[$i]['id_report']['creating'])?->getTimestamp();
            $dateSubmittingReport = $this->is_date($_4_indexa[$i]['id_report']['submitting'])?->getTimestamp();
            $dateCreatingIndex = $this->is_date($_4_indexa[$i]['date'])?->getTimestamp();
            
            if((5 == $_4_indexa[$i]['id_status']['id']) && ($dateCreatingReport<$dateCreatingIndex || $dateSubmittingReport > $dateCreatingIndex)){
                $indexes[$i] = (!empty($_4_indexa[$i]['index'])) ? $_4_indexa[$i]['index'] : '';
        }} //*/ pa($indexes); echo $indexes[$i].'<br>'; //*/

        if('O' == $type){
            if('' == $indexes[0]){return '';}
            if('' == $indexes[1]){return '';}
            if('' == $indexes[2]){return '';}
            if('' == $indexes[3]){return '';}
            (float) $sum_1 = (is_numeric($indexes[0])) ? $indexes[0] : 0;
            (float) $sum_2 = (is_numeric($indexes[1])) ? $indexes[1] : 0;
            (float) $sum_3 = (is_numeric($indexes[2])) ? $indexes[2] : 0;
        $return = bcdiv(bcadd(bcadd($sum_1, $sum_2), $sum_3), 3);
        return $return;}
            
        if('T' == $type){$pow = bcdiv(1, 3); $vector = $this->model->getWhere('marks',['num' => $mark])[0]['vector'];
            if('' == $indexes[0]){return '';}
            if('' == $indexes[1]){return '';}
            if('' == $indexes[2]){return '';}
            if('' == $indexes[3]){return '';}
            $i0 = (is_numeric($indexes[0]) && !empty(round($indexes[0], $m))) ? number_format((float) $indexes[0], $m, '.', '') : '';
            $i1 = (is_numeric($indexes[1]) && !empty(round($indexes[1], $m))) ? number_format((float) $indexes[1], $m, '.', '') : '';
            $i2 = (is_numeric($indexes[2]) && !empty(round($indexes[2], $m))) ? number_format((float) $indexes[2], $m, '.', '') : '';
            $i3 = (is_numeric($indexes[3]) && !empty(round($indexes[3], $m))) ? number_format((float) $indexes[3], $m, '.', '') : '';
            $_0 = (!empty($i0) && '' != $i0);
            $_1 = (!empty($i1) && '' != $i1);
            $_2 = (!empty($i2) && '' != $i2);
            $_3 = (!empty($i3) && '' != $i3);

            if($_0 && $_1 && $_2 && $_3){return number_format(bcmul(bcmul(bcdiv($i0,$i1),bcdiv($i1,$i2)), bcdiv($i2,$i3))**$pow, $m);}
            if($_1 && $_2){
                if($_0){return number_format(bcmul(bcdiv($i0,$i1),bcdiv($i1,$i2))**$pow, $m);}
                if($_3){
                    if($vector){return number_format(bcmul(bcdiv($i1,$i2), bcdiv($i2,$i3))**$pow, $m); //*/ Правки от Шамиля 11 строка exel ///*/
                    }else{return number_format(bcmul(bcmul(bcdiv($i0,$i1),bcdiv($i1,$i2)), bcdiv($i2,$i3))**$pow, $m);
                }}
                if($vector){return number_format(bcdiv($i1,$i2)**$pow, $m);}
                return number_format(bcmul(bcdiv($i0,$i1),bcdiv($i1,$i2))**$pow, $m); //*/ Правки от Шамиля 21 строка exel ///*/  number_format(bcdiv($i1,$i2)**$pow, $m);
            }
            if($_0 && $_1){
                if($_3){return number_format(bcmul(bcdiv($i0,$i1),bcdiv($i1,$i3))**$pow, $m);}
                return number_format(bcdiv($i0,$i1)**$pow, $m); 
            }
            if($_0){
                if($_2 && $_3){return number_format(bcmul(bcdiv($i0,$i2),bcdiv($i2,$i3))**$pow, $m);}
                if($_2){return number_format(bcdiv($i0,$i2)**$pow, $m);}
                if($_3){return number_format(bcdiv($i0,$i3)**$pow, $m);}
                return number_format($i0**$pow, $m);
            }
            if($_1){
                if($_3){return number_format(bcdiv($i1,$i3)**$pow, $m);}
                return ($vector) ? 0.00 : number_format(bcdiv($i0,$i1)**$pow, $m); ///*/ Правки от Шамиля 4 строка exel ///*/ number_format($i1**$pow, $m);
            }
            return $return;}
        return false;}
    
    public function isOisT(array $OT, array $minmax){if(!is_array($OT) && empty($OT) && !is_array(current($OT)) && !is_array($minmax) && empty($minmax) && !is_array(current($minmax))){return false;}
        bcscale($GLOBALS['mantisa']); ///*/ pa($OT); ///*/ pa($minmax); ///*/
        foreach($OT as $district => $marks){
            foreach($marks as $mark => $OorT){
                $vector = $this->model->getWhere('marks',['num' => $mark])[0]['vector'];
                if(is_numeric($OorT)){
                    $delimoe = ($vector) ? bcsub($OorT, $minmax['min'][$mark]) : bcsub($minmax['max'][$mark], $OorT);
                    $delitel = bcsub($minmax['max'][$mark], $minmax['min'][$mark]);
                    (float) $proizvedenie = (0 != $delitel && '' != $delitel && !empty($delitel)) ?  bcdiv($delimoe, $delitel) : '';
                    (float) $proizvedenie = ('' != $proizvedenie && is_numeric($proizvedenie)) ? number_format($proizvedenie, $GLOBALS['mantisa'], '.', '') : 0.00;
                }                
                $return[$district][$mark] = (is_numeric($OorT)) ? $proizvedenie : '';   
        }}
        return (is_array($return) && !empty($return)) ?$return : false;}
        
    public function iP(array $isT, array $isO){if(!is_array($isT) && empty($isT)){return false;} if(!is_array($isO) && empty($isO)){return false;} if(count($isT, COUNT_RECURSIVE) != count($isO, COUNT_RECURSIVE)){return false;}
        foreach($isT as $district => $marks){ foreach($marks as $mark => $T){
            $return[$district][$mark] = ('' == $T && '' == $isO[$district][$mark]) ? '' : bcadd(bcmul(0.6, $T), bcmul(0.4, $isO[$district][$mark]));
        }}
    return (is_array($return) && !empty($return)) ?$return : false;}
    
     public function KO($iP){
    } 

    public function writeData(){
        if(empty($this->index) && empty($this->O) && empty($this->T) && empty($this->isO) && empty($this->isT) && empty($this->iP)){return null;}
        $sql = '';
        foreach($this->index as $uin => $marks){            
            foreach($marks as $mark => $indexes){
                $reports = $indexes['reports'];
                $deadline = $indexes['deadline'];
                $idx = $indexes['idx'];
 
 ///*/             for($i=0; $i<4; $i++){
$sql .= '<nobr>'; ///*/

            $idx[0]['index'] = (empty($idx[0]['index'])) ? '' : $idx[0]['index'];
            $idx[1]['index'] = (empty($idx[1]['index'])) ? '' : $idx[1]['index'];
            $idx[2]['index'] = (empty($idx[2]['index'])) ? '' : $idx[2]['index'];
            $idx[3]['index'] = (empty($idx[3]['index'])) ? '' : $idx[3]['index'];
 
            $sql .= $setSql = "INSERT INTO `".$this->model->table."` VALUES ('".
            ((!empty($idx[0]['id']) ? $idx[0]['id'] : (
             (!empty($idx[1]['id']) ? $idx[1]['id'] : (
             (!empty($idx[2]['id']) ? $idx[2]['id'] : (
             (!empty($idx[3]['id']) ? $idx[3]['id'] : "NULL"))))))))."', '".
            $mark."', '".
            $uin."','".
            $reports."','".
            $deadline."','".
            $idx[3]['index']."','".
            $idx[2]['index']."','".
            $idx[1]['index']."','".
            $idx[0]['index']."','".
            $this->O[$uin][$mark]."', '".
            $this->maxO[$mark]."', '".
            $this->minO[$mark]."', '".
            $this->isO[$uin][$mark]."', '".
            $this->T[$uin][$mark]."', '".
            $this->maxT[$mark]."', '".
            $this->minT[$mark]."', '".
            $this->isT[$uin][$mark]."', '".
            $this->iP[$uin][$mark]. "') 
            ON DUPLICATE KEY UPDATE `deadline`='".
            $deadline."', `date_0`='".
            $idx[0]['index']."', `date_1`='".
            $idx[1]['index']."', `date_2`='".
            $idx[2]['index']."', `date_3`='".
            $idx[3]['index']."', `o_sop`='".
            $this->O[$uin][$mark]."', `max_sop`='".
            $this->maxO[$mark]."', `min_sop`='".
            $this->minO[$mark]."', `isop`='".
            $this->isO[$uin][$mark]."', `t_str`='".
            $this->T[$uin][$mark]."', `max_str`='".
            $this->maxT[$mark]."', `min_str`='".
            $this->minT[$mark]."', `istr_t`='".
            $this->isT[$uin][$mark]."', `index_final`='".
            $this->iP[$uin][$mark]."';";
            
           $this->model->getQuery($setSql, false);
///*/ 
$sql .="</nobr><br>"; 
 ///*/           }
 
$sql .= '<br>'.PHP_EOL; ///*/
        }}
///*/ echo $sql; ///*/
    return $this;}
    
    public function printWeb($round = 3, $roundIndex = 4){if(empty($this->index) && empty($this->O) && empty($this->maxO) && empty($this->minO) && empty($this->isO) && empty($this->T) && empty($this->maxT) && empty($this->minT) && empty($this->isT) && empty($this->iP)){return null;}
        $table = '<tr>';  
        $date1 = (new \DateTime)->modify( '-1 year' )->format('Y'); 
        $date2 = (new \DateTime)->modify( '-2 year' )->format('Y'); 
        $date3 = (new \DateTime)->modify( '-3 year' )->format('Y'); 
        $date4 = (new \DateTime)->modify( '-4 year' )->format('Y');
        foreach($this->marks as $vm){///*/ 
        $table .= '</tr><tr class="textCenter"><td>Номер показателя:<b>'.$vm.'</b></td><td>'.
        $date4.'</td><td>'.
        $date3.'</td><td>'.
        $date2.'</td><td>'.
        $date1.'</td><td>
        
        О</td><td>
        Макc О</td><td>
        Мин О</td><td>        
        ИсО</td><td>
        
        Т</td><td>
        Макc Т</td><td>
        Мин Т</td><td>
        ИсТ</td><td>

        Ип</td></tr>'; ///*/
                for($i=1, $c=count($this->reports)+1; $i<$c; $i++){
 
       ///*/ 
        $table .= '<tr class="textRight"><td>-------------------------</td> <td><small>'.
            $this->index[$i][$vm]['idx'][3]['id'].'</small></td> <td><small>'.
            $this->index[$i][$vm]['idx'][2]['id'].'</small></td> <td><small>'.
            $this->index[$i][$vm]['idx'][1]['id'].'</small></td> <td><small>'.
            $this->index[$i][$vm]['idx'][0]['id'].'</small></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr>'; ///*/
        
        $table .= '<tr><td>'.
            $this->model->getQuery("SELECT owner FROM uin WHERE `id`='".$i."' ORDER BY `id` ASC;")[0]['owner'].'</td> <td><b>'.((is_numeric($this->index[$i][$vm]['idx'][3]['index'])) ?
            number_format(round((float)$this->index[$i][$vm]['idx'][3]['index'], $roundIndex), $roundIndex, ' . ', ' ') : '-' ).'</b></td> <td><b>'.((is_numeric($this->index[$i][$vm]['idx'][2]['index'])) ?
            number_format(round((float)$this->index[$i][$vm]['idx'][2]['index'], $roundIndex), $roundIndex, ' , ', ' ') : '-' ).'</b></td> <td><b>'.((is_numeric($this->index[$i][$vm]['idx'][1]['index'])) ?
            number_format(round((float)$this->index[$i][$vm]['idx'][1]['index'], $roundIndex), $roundIndex, ' , ', ' ') : '-' ).'</b></td> <td><b>'.((is_numeric($this->index[$i][$vm]['idx'][0]['index'])) ?
            number_format(round((float)$this->index[$i][$vm]['idx'][0]['index'], $roundIndex), $roundIndex, ' , ', ' ') : '-' ).'</b></td> <td><b>'.((is_numeric($this->O[$i][$vm])) ?
            number_format(round($this->O[$i][$vm], $round), $round, ' , ', ' ') : '-' ).'</b></td> <td><b>'. ((is_numeric($this->maxO[$vm])) ?
            number_format(round($this->maxO[$vm], $round), $round, ' , ', ' ') : '-' ).'</b></td> <td><b>'.((is_numeric($this->minO[$vm])) ?
            number_format(round($this->minO[$vm], $round), $round, ' , ', ' ') : '-' ).'</b></td> <td><b>'.((is_numeric($this->isO[$i][$vm])) ?
            number_format(round($this->isO[$i][$vm], $round), $round, ' , ', ' ') : '-' ).'</b></td> <td><b>'.((is_numeric($this->T[$i][$vm])) ?
            number_format(round($this->T[$i][$vm], $round), $round, ' , ', ' ') : '-' ).'</b></td> <td><b>'.((is_numeric($this->maxT[$vm])) ?
            number_format(round($this->maxT[$vm], $round), $round, ' , ', ' ') : '-' ).'</b></td> <td><b>'.((is_numeric($this->minT[$vm])) ?
            number_format(round($this->minT[$vm], $round), $round, ' , ', ' ') : '-' ).'</b></td> <td><b>'.((is_numeric($this->isT[$i][$vm])) ?
            number_format(round($this->isT[$i][$vm], $round), $round, ' , ', ' ') : '-' ).'</b></td> <td><b>'.((is_numeric($this->iP[$i][$vm])) ?
            number_format(round($this->iP[$i][$vm], $round), $round, ' , ', ' ') : '-' ).'</b></td></tr><tr>'; ///*/
                }
        ///*/ 
        $table .= '</tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr>'; ///*/
        }
        ///*/ 
        echo '<table>'.$table.'</table><style>td{border-right:2px solid #000; padding: 0 5px}.textCenter{text-align: center;}.textRight{text-align: right;}</style>'; ///*/     
        
    }///*/ 
    
    public function genExel($round = 16, $roundIndex = 3){///*/
        $date1 = (new \DateTime)->modify( '-1 year' )->format('Y'); 
        $date2 = (new \DateTime)->modify( '-2 year' )->format('Y'); 
        $date3 = (new \DateTime)->modify( '-3 year' )->format('Y'); 
        $date4 = (new \DateTime)->modify( '-4 year' )->format('Y');

    
         $exel = []; $i=1;
         $spreadsheet = new Spreadsheet();
   
        for($l=0,$s=count($this->marks);$l<$s;$l++){///*/ echo $vm.'<br>'; 
            $vm = $this->marks[$l];
            $vector = $this->model->getWhere('marks',['num' => $vm])[0]['vector'];
            $sheet = $spreadsheet->createSheet($i); 
            //
            /*/ pa($pa); exit();
            $spreadsheet->setActiveSheetIndex($i); $sheet = $spreadsheet->getActiveSheet($i); ///*/ 
            $i++;
            $sheet->setTitle($vm);
            $exel []= array((($vector) ? 'РОСТ' : 'СНИЖЕНИЕ'),  $date4, $date3, $date2, $date1,
            
            'О',                                                                                                                                     
            'Макc О',
            'Мин О',        
            'ИсО',
            
            'Т',
            'Макc Т',
            'Мин Т',
            'ИсТ',

            'Ип'); 
            for($i=1, $c=count($this->reports)+1; $i<$c; $i++){
                //
                /*/
                $exel []= array('-------------------------',
                    $this->index[$i][$vm]['idx'][3]['id'],
                    $this->index[$i][$vm]['idx'][2]['id'],
                    $this->index[$i][$vm]['idx'][1]['id'],
                    $this->index[$i][$vm]['idx'][0]['id']); ///*/
                    
                $exel []= array(
                    $this->model->getQuery("SELECT owner FROM uin WHERE `id`='".$i."' ORDER BY `id` ASC;")[0]['owner'],
                    ((is_numeric($this->index[$i][$vm]['idx'][3]['index'])) ?
                    number_format(round((float)$this->index[$i][$vm]['idx'][3]['index'], $roundIndex), $roundIndex, '.', '') : '-' ),
                    ((is_numeric($this->index[$i][$vm]['idx'][2]['index'])) ?
                    number_format(round((float)$this->index[$i][$vm]['idx'][2]['index'], $roundIndex), $roundIndex, '.', '') : '-' ),
                    ((is_numeric($this->index[$i][$vm]['idx'][1]['index'])) ?
                    number_format(round((float)$this->index[$i][$vm]['idx'][1]['index'], $roundIndex), $roundIndex, '.', '') : '-' ),
                    ((is_numeric($this->index[$i][$vm]['idx'][0]['index'])) ?
                    number_format(round((float)$this->index[$i][$vm]['idx'][0]['index'], $roundIndex), $roundIndex, '.', '') : '-' ),
                    ((is_numeric($this->O[$i][$vm])) ?
                    number_format(round($this->O[$i][$vm], $round), $round, '.', '') : '-' ),
                    ((is_numeric($this->maxO[$vm])) ?
                    number_format(round($this->maxO[$vm], $round), $round, '.', '') : '-' ),
                    ((is_numeric($this->minO[$vm])) ?
                    number_format(round($this->minO[$vm], $round), $round, '.', '') : '-' ),
                    ((is_numeric($this->isO[$i][$vm])) ?
                    number_format(round($this->isO[$i][$vm], $round), $round, '.', '') : '-' ),
                    ((is_numeric($this->T[$i][$vm])) ?
                    number_format(round($this->T[$i][$vm], $round), $round, '.', '') : '-' ),
                    ((is_numeric($this->maxT[$vm])) ?
                    number_format(round($this->maxT[$vm], $round), $round, '.', '') : '-' ),
                    ((is_numeric($this->minT[$vm])) ?
                    number_format(round($this->minT[$vm], $round), $round, '.', '') : '-' ),
                    ((is_numeric($this->isT[$i][$vm])) ?
                    number_format(round($this->isT[$i][$vm], $round), $round, '.', '') : '-' ),
                    ((is_numeric($this->iP[$i][$vm])) ?
                    number_format(round($this->iP[$i][$vm], $round), $round, '.', '') : '-' )); ///*/
                }
                $exel []= array('');
                $exel []= array('', '', '', '', '', 'СУММ('.$date1.' '.$date2.' '.$date3.')/3', '', '','','(('.$date1.'/'.$date2.')*('.$date2.'/'.$date3.')*('.$date3.'/'.$date4.'))^(1/3)', '','','','0,6 * ИсТ + 0,4 * ИсО',);
                $exel []= array('', '', '', '', '', '', 'МАКС(О)','МИН(О)','','','МАКС(Т)','МИН(Т)',);
                $exel []= array('', '', '', '','','','','',(($vector) ? '(O-МИН(О))/(МАКС(О)-МИН(О))' : '(МАКС(О)-О)/(МАКС(О)-МИН(О))'),'','','',(($vector) ? '(Т-МИН(Т))/(МАКС(Т)-МИН(Т))' : '(МАКС(Т)-Т)/(МАКС(Т)-МИН(Т))'),);

 
                $sheet->fromArray($exel, NULL, 'A1'); unset($exel);
                $sheet->getColumnDimension('A')->setWidth(25); 
                $sheet->getColumnDimension('B')->setWidth(14); $sheet->getColumnDimension('C')->setWidth(14); $sheet->getColumnDimension('D')->setWidth(14); $sheet->getColumnDimension('E')->setWidth(14); 
                $sheet->getColumnDimension('F')->setWidth(18); $sheet->getColumnDimension('G')->setWidth(18); $sheet->getColumnDimension('H')->setWidth(18); $sheet->getColumnDimension('I')->setWidth(18);
                $sheet->getColumnDimension('J')->setWidth(18); $sheet->getColumnDimension('K')->setWidth(18); $sheet->getColumnDimension('L')->setWidth(18); $sheet->getColumnDimension('M')->setWidth(18);
                $sheet->getColumnDimension('N')->setWidth(20);
                
                $_B1N18 = $sheet->getStyle('B1:N18');
                $_B1N18->getAlignment()->setHorizontal('center');
                $_B1N18->getAlignment()->setVertical('center');
                
                $_A2A18 = $sheet->getStyle('A1:A18'); $_A2A18->getFont()->setBold(true); 
                $_A1N1 = $sheet->getStyle('A1:N1'); $_A1N1->getFont()->setBold(true);
                
                $_B2E18 = $sheet->getStyle('B2:E18');
                $_B2E18->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_YELLOW));
                $_B2E18->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF3737');

                $_F2M18 = $sheet->getStyle('F2:M18');
                $_F2M18->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK));
                $_F2M18->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('25B6FF');
               
                $_N2N18 = $sheet->getStyle('N2:N18');
                $_N2N18->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_DARKRED));
                $_N2N18->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00FF00');
 
                $_F20N20 = $sheet->getStyle('F20:N22');
                $_F20N20->getAlignment()->setHorizontal('center');
                $_F20N20->getAlignment()->setVertical('center');
                $_F20N20->getFont()->setBold(true);

                $_B2N18 = $sheet->getStyle('B2:N18');
                $_B2N18->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
                $_B2N18->getNumberFormat()->setFormatCode('0.0000');
                $styleArray = array(
                    'borders' => array(
                        'inside' => array(
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DASHED,
                            'color' => array('argb' => 'FF000000'),),),);
                $_B2N18->applyFromArray($styleArray);
                
                //pa($sheet->getStyle('A1:A18')->exportArray());
        }
         $spreadsheet->removeSheetByIndex(0);
         $spreadsheet->setActiveSheetIndex(1);
        
        if(file_exists($dirname = $GLOBALS['path']['pub']._DS_.'ftp')){$exel = (new \DateTime)->format('Y-m-d_H-i-s'); (new Xlsx($spreadsheet))->save($dirname._DS_.'ИП_'.$exel.'.xlsx');}
       
         return $this;
        
    }///*/          
}