<?php

namespace App\Controllers;

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
    $iP;

    public function __construct(){
        $this->model        = new \App\Models\CalculateModel;
        $this->memcached    = (object) $this->connMCD();

        $this->setParametrs()?->CalculateIP()?->writeData()?->printWeb();
    }

    public function index(){ // */ 
    $this->memcached->flush(1);  // */
        //*/ pa($this->iP); // */ pa($this->isO); 
        /*// pa($this->isT, 10); 
        $minmaxO = $this->arrayMinMax($this->O);
        $minmaxT = $this->arrayMinMax($this->T);
        $sql = '';
        foreach($this->O as $mark => $districts){foreach($districts as $district => $sop_o){
            $sql .= "<nobr>INSERT INTO `count` VALUES (NULL, '".$mark."', '".$district."', NULL, NULL, NULL, NULL, '".$this->O[$mark][$district]."', '".$minmaxO["max"][$mark]."', '".$minmaxO["min"][$mark]."', '".$this->isO[$mark][$district]."',  ".
                                                                "'".$this->T[$mark][$district]."', '".$minmaxT["max"][$mark]."', '".$minmaxT["min"][$mark]."', '".$this->isT[$mark][$district]."', '".$this->iP[$mark][$district]."');</nobr><br><br>".PHP_EOL;
            
        }}        

        /// * / echo $sql; //*/ 
        /// * / pa($this); // */
        //
        /*/
        var_dump($this->index[1]['8.2']['idx'][0]['index']);
        pa($this->index[15]['8.2']['idx']);
        pa($this->O[1]['8.2']);
        pa($this->T[1]['8.2']); 
        pa($this->O); ///*/
    }
    
    public function setParametrs(){///*/
        $this->districts = $this->memcached->get('districts'); 
        $this->marks = $this->memcached->get('marks'); 
        $this->reports = $this->memcached->get('reports');
        
        if(empty($this->districts)){$d = [];  
            array_walk_recursive($this->model->getQuery("SELECT * FROM uin WHERE `type`='district' ORDER BY `id` ASC;"), function($v, $k) use (&$d){if('id' == $k){$d[] = $v;}});
            $this->districts = $d = (!empty($d) && is_array($d)) ? $d : [];
            $this->memcached->set('districts', $d, $GLOBALS['lifeMemcache']);
        }
        if(empty($this->marks)){$m = [];
            array_walk_recursive($this->model->getQuery("SELECT num FROM marks;"), function($v, $k) use (&$m){if('num' == $k){$m[] = $v;}});
            $this->marks = (!empty($m) && is_array($m)) ? $m : [];
            $this->memcached->set('marks', $this->marks, $GLOBALS['lifeMemcache']);
        }
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
        if(empty($this->index) && !empty($this->reports) && is_array($this->reports)
                           && !empty($this->marks) && is_array($this->marks)){
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
        
        return (!empty($this->districts) && is_array($this->districts) && 
                !empty($this->marks) && is_array($this->marks) && 
                !empty($this->reports) && is_array($this->reports) && 
                !empty($this->index) && is_array($this->index)) ? $this : null;
    }///*/
      
    public function CalculateIP(){///*/
        $O = $this->memcached->get('O');
        $T = $this->memcached->get('T');
        $isO = $this->memcached->get('isO'); 
        $isT = $this->memcached->get('isT'); 
        $iP = $this->memcached->get('iP');          
 
        if(!is_array($O) && !is_array($T)){
            if(empty($this->index) && !is_array($this->index)){return null;}
            
            foreach($this->index as $_d => $marks){
                foreach($marks as $_m => $_4_indexa){
                    //
                    /*/
                    $this->index[$vm][$i] []= array('id'=>$_4_indexa[0]['id'], 'index' => number_format((float) $_4_indexa[0]['index'], 5,'.',''));
                    $this->index[$vm][$i] []= array('id'=>$_4_indexa[1]['id'], 'index' => number_format((float) $_4_indexa[1]['index'], 5,'.',''));
                    $this->index[$vm][$i] []= array('id'=>$_4_indexa[2]['id'], 'index' => number_format((float) $_4_indexa[2]['index'], 5,'.',''));
                    $this->index[$vm][$i] []= array('id'=>$_4_indexa[3]['id'], 'index' => number_format((float) $_4_indexa[3]['index'], 5,'.',''));
                    ///*/
                    if(4 == count($_4_indexa['idx'])){
                        $O[$_d][$_m] = $sopO = $this->sopOstrT($_4_indexa['idx'], 'O');                                                
                        $T[$_d][$_m] = $strT = $this->sopOstrT($_4_indexa['idx'], 'T');
                        
                        ///*/ if(5 == $_d && '39.3' ==$_m){pa($_4_indexa['idx']);} ///*/
                        
                        if('' != $sopO && is_numeric($sopO)){$Om[$_m][$_d] =  $sopO;} 
                        if('' != $strT && is_numeric($strT)){$Tm[$_m][$_d] =  $strT;} 
                        
                    }else{///*/ pa($_4_indexa); ///*/
                        return null;
                    }    
            }} 
        }
 
        $mO = $this->arrayMinMax($Om);
        $mT = $this->arrayMinMax($Tm);

        if(empty($isO)){                                         
            $isO =  $this->isOisT($O, $mO);
        }
        if(empty($isT)){
            $isT =  $this->isOisT($T, $mT);
        }
        if(empty($iP)){
            $iP =  $this->iP($isT, $isO);
        }
        pa($isO[5]);
        pa($isT[5]);
        echo 'isO '.$isO[5]['39.3'].'  isT '.$isT[5]['39.3'].'<br>';
        echo 'O '.$O[5]['39.3'].'  '.$T[5]['39.3'].'<br>';
        echo 'mO  min '.$mO['min']['39.3'].'  mT min '.$mT['min']['39.3'].'<br>';
        echo 'mO  max '.$mO['max']['39.3'].'  mT max '.$mT['max']['39.3'].'<br>';
 
        $this->memcached->set('O', $O, $GLOBALS['lifeMemcache']); 
        $this->memcached->set('T', $T, $GLOBALS['lifeMemcache']);
        $this->memcached->set('isO', $isO, $GLOBALS['lifeMemcache']);
        $this->memcached->set('isT', $isT, $GLOBALS['lifeMemcache']);
        $this->memcached->set('iP', $iP, $GLOBALS['lifeMemcache']);
        
        $this->O = $O;
        $this->minO = $mO['min'];
        $this->maxO = $mO['max'];
        $this->T = $T;
        $this->minT = $mT['min'];
        $this->maxT = $mT['max'];
        $this->isO = $isO;
        $this->isT = $isT;
        $this->iP = $iP; 

        return (!empty($this->index) && !empty($this->O) && !empty($this->T) && !empty($this->isO) &&  !empty($this->isT) &&  !empty($this->iP)) ? $this : null; 
    }///*/    
    
    public function sopOstrT(array $_4_indexa, string $type = 'sop'){
        (int) $m =  $GLOBALS['mantisa']; bcscale($m); (float) $return = 0.00; 
        
        if(empty($_4_indexa) && !is_array($_4_indexa)){return null;}
        
        for($i=0;$i<4; $i++){
            $dateCreatingReport = $this->is_date($_4_indexa[$i]['id_report']['creating'])?->getTimestamp();
            $dateSubmittingReport = $this->is_date($_4_indexa[$i]['id_report']['submitting'])?->getTimestamp();
            $dateCreatingIndex = $this->is_date($_4_indexa[$i]['date'])?->getTimestamp();
            
            if(empty($_4_indexa[$i])){var_dump($_4_indexa[$i]);}
            
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
            
        if('T' == $type){$pow = bcdiv(1, 3);
        
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
                if($_3){return number_format(bcmul(bcmul(bcdiv($i0,$i1),bcdiv($i1,$i2)), bcdiv($i2,$i3))**$pow, $m);}
                return number_format(bcdiv($i1,$i2)**$pow, $m);
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
                return number_format($i1**$pow, $m);
            }
            return $return;}
        return false;}
    
    public function isOisT(array $OT, array $minmax){bcscale($GLOBALS['mantisa']);
        if(!is_array($OT) && empty($OT) && !is_array(current($OT)) && !is_array($minmax) && empty($minmax) && !is_array(current($minmax))){return false;}
///*/ pa($OT); ///*/ pa($minmax); ///*/
        foreach($OT as $district => $marks){
            foreach($marks as $mark => $OorT){
                $temp = $this->model->getWhere('marks',['num' => $mark])[0]['temp'];
///*/                echo $district.' : '.$mark.'<br>'.$temp.'<br>'; echo (($temp) ? " bcsub($OorT,0 ".$minmax['min'][$mark].")" : "bcsub(".$minmax['max'][$mark].", $OorT)")." = ".(($temp) ? bcsub($OorT, $minmax['min'][$mark]) : bcsub($minmax['max'][$mark], $OorT)).'<br>';

                if(is_numeric($OorT)){
                    $delimoe = ($temp) ? bcsub($OorT, $minmax['min'][$mark]) : bcsub($minmax['max'][$mark], $OorT);
                    $delitel = bcsub($minmax['max'][$mark], $minmax['min'][$mark]);
                    
                    // if(5 == $district && '39.3' ==$mark){echo 'bcsub('.$minmax['max'][$mark].', '.$OorT.')';echo 'bcsub('.$minmax['max'][$mark].', '.$minmax['min'][$mark].')<br>';}  if(5 == $district && '39.3' ==$mark){echo $proizvedenie;}
                    (float) $proizvedenie = (0 != $delitel && '' != $delitel && !empty($delitel)) ?  bcdiv($delimoe, $delitel) : '';
                    (float) $proizvedenie = ('' != $proizvedenie && is_numeric($proizvedenie)) ? number_format($proizvedenie, $GLOBALS['mantisa'], '.', '') : 0.00;
                }                
                $return[$district][$mark] = (is_numeric($OorT)) ? $proizvedenie : '';   
        }}
        return (is_array($return) && !empty($return)) ?$return : false;}
        
    public function iP(array $isT, array $isO){
        if(!is_array($isT) && empty($isT)){return false;} if(!is_array($isO) && empty($isO)){return false;} if(count($isT, COUNT_RECURSIVE) != count($isO, COUNT_RECURSIVE)){return false;}
        
        foreach($isT as $district => $marks){ foreach($marks as $mark => $T){
            $return[$district][$mark] = ('' == $T && '' == $isO[$district][$mark]) ? '' : bcadd(bcmul(0.6, $T), bcmul(0.4, $isO[$district][$mark]));
        }}
        
    return (is_array($return) && !empty($return)) ?$return : false;}

    public function writeData(){///*/
        if(empty($this->index) && empty($this->O) && empty($this->T) && empty($this->isO) && empty($this->isT) && empty($this->iP)){return null;}
        $sql = '';
        foreach($this->index as $mark => $uins){foreach($uins as $uin => $idx){
            for($i=0; $i<4; $i++){
        
///*/ 
$sql .= '<nobr>'; ///*/

            $idx[$i]['index'] = (empty($idx[$i]['index'])) ? 'NULL' : $idx[$i]['index'];
 
            $sql .= $setSql = "INSERT INTO `".$this->model->table."` VALUES ('".
            $idx[$i]['id']."', '".
            $mark."', '".
            $uin."',".
            $uin."',".
                ((0 == $i) ? " NULL, NULL, NULL, '".$idx[$i]['index']."', '" : 
                ((1 == $i) ? " NULL, NULL, '".$idx[$i]['index']."', NULL, '" : 
                ((2 == $i) ? " NULL, '".$idx[$i]['index']."', NULL, NULL, '" : " '".$idx[$i]['index']."', NULL, NULL, NULL, '") ) ).
            $this->O[$mark][$uin]."', '".
            $this->maxO[$mark]."', '".
            $this->minO[$mark]."', '".
            $this->isO[$mark][$uin]."', '".
            $this->T[$mark][$uin]."', '".
            $this->maxT[$mark]."', '".
            $this->minT[$mark]."', '".
            $this->isT[$mark][$uin]."', '".
            $this->iP[$mark][$uin]."') ON DUPLICATE KEY UPDATE `date_".($i+1)."`='".$idx[$i]['index']."', `o_sop`='".
            
            $this->O[$mark][$uin]."', `max_sop`='".
            $this->maxO[$mark]."', `min_sop`='".
            $this->minO[$mark]."', `isop`='".
            $this->isO[$mark][$uin]."', `t_str`='".
            $this->T[$mark][$uin]."', `max_str`='".
            $this->maxT[$mark]."', `min_str`='".
            $this->minT[$mark]."', `istr_t`='".
            $this->isT[$mark][$uin]."', `index_final`='".
            $this->iP[$mark][$uin]."';";
            
            //$this->model->getQuery($setSql, false);
            
///*/ 
$sql .="</nobr><br>"; 
            }
///*/ 
$sql .= '<br>'.PHP_EOL; ///*/
        }}
///*/ echo $sql; ///*/
 
    return $this;}///*/
    
    public function printWeb($round = 3, $roundIndex = 3){///*/
        if(empty($this->index) && 
            empty($this->O) && 
            empty($this->maxO) && 
            empty($this->minO) && 
            empty($this->isO) && 
            empty($this->T) && 
            empty($this->maxT) && 
            empty($this->minT) && 
            empty($this->isT) && 
            empty($this->iP)){return null;}
            
        $table = '<tr>';

        foreach($this->marks as $vm){
        ///*/ 
        $table .= '</tr><tr class="textCenter"><td>Номер показателя:<b>'.$vm.'</b></td><td>
        2018</td><td>
        2019</td><td>
        2020</td><td>
        2021</td><td>
        О</td><td>
        Мак О</td><td>
        Мин О</td><td>        
        ИсО</td><td>
        
        Т</td><td>
        Мак Т</td><td>
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
            number_format(round((float)$this->index[$i][$vm]['idx'][3]['index'], $roundIndex), $roundIndex, ' , ', ' ') : '-' ).'</b></td> <td><b>'.((is_numeric($this->index[$i][$vm]['idx'][2]['index'])) ?
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
    
    public function kp(){
        
        //pa($this-)
    }  
           
}