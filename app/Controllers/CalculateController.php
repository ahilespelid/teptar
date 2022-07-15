<?php

namespace App\Controllers;

/// */ 
ini_set('display_errors', 0); ini_set('display_startup_errors', 0); error_reporting(E_ALL); /// */

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

        $this->setParametrs()?->CalculateIP()?->writeData()?->printWeb(7);
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
    }
    
    
    
    public function sopOstrT(array $_4_indexa, string $type = 'sop'){bcscale((is_int($GLOBALS['mantisa'])) ? $GLOBALS['mantisa'] : 16);
        (float) $return = 0.00; 
        $_4_indexa = (!empty($_4_indexa) && is_array($_4_indexa)) ? $_4_indexa : false;
        
        if($_4_indexa){for($i=0;$i<4; $i++){
            $dateCreatingReport = $this->is_date($_4_indexa[$i]['id_report']['creating'])?->getTimestamp();
            $dateSubmittingReport = $this->is_date($_4_indexa[$i]['id_report']['submitting'])?->getTimestamp();
            $dateCreatingIndex = $this->is_date($_4_indexa[$i]['date'])?->getTimestamp();
            
            if((5 == $_4_indexa[$i]['id_status']['id']) && ($dateCreatingReport<$dateCreatingIndex || $dateSubmittingReport > $dateCreatingIndex)){
                $indexes[$i] = (!empty($_4_indexa[$i]['index'])) ? $_4_indexa[$i]['index'] : '';
                
            }} //*/ pa($indexes); //*/
            if('O' == $type){//*/ $indexes = $this->arrayDeleteElement($indexes,['', 0.00, 0]);   pa($indexes); //*/
                unset($indexes[3]); //*/ if(isset($indexes[0])){unset($indexes[3]);} pa($indexes); //*/
                
                (float) $sum_1 = (!empty($indexes[0])) ? $indexes[0] : 0.00;
                (float) $sum_2 = (!empty($indexes[1])) ? $indexes[1] : 0.00;
                (float) $sum_3 = (!empty($indexes[2])) ? $indexes[2] : 0.00;
                //*/ (float) $sum_4 = (!empty($indexes[3])) ? $indexes[3] : 0.00; //*/

            $return = bcdiv(bcadd(bcadd($sum_1, $sum_2), $sum_3), 3);
///*/ $return = array_sum($indexes) / $count; echo $sum_1.'<br>';echo $sum_2.'<br>';echo $sum_3.'<br>';echo $sum_4.'<br>';echo $sum.'<br>';echo $count.'<br>';echo $return.'<br>';return (3 <= $count) ? $return :  0.00; ///*/
            return $return;}
            
            if('T' == $type){$pow = bcdiv(1, 3); (float)$return = 0.00; $m = (is_int($GLOBALS['mantisa'])) ? $GLOBALS['mantisa'] : 16;
                                
                $_0 = !empty($i0 = $indexes[0]);
                $_1 = !empty($i1 = $indexes[1]);
                $_2 = !empty($i2 = $indexes[2]);
                $_3 = !empty($i3 = $indexes[3]);
                
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
            return 0.00;}
        }return false;}
    
    public function isOisT(array $OT, array $minmax){bcscale((is_int($GLOBALS['mantisa'])) ? $GLOBALS['mantisa'] : 16);
        if(!is_array($OT) && empty($OT) && !is_array(current($OT)) && !is_array($minmax) && empty($minmax) && !is_array(current($minmax))){return false;}
        //pa($OT);
        $table = ''; 
        foreach($OT as $mark => $districts){
///*/ $table .= '<th>'.$mark.'</th>       <th>'.$minmax['max'][$mark].'</th>     <th>'.$minmax['min'][$mark].'</th><tr>'; ///*/
            
            $temp = $this->model->getWhere('marks',['num' => $mark])[0]['temp'];
            
            foreach($districts as $district => $OorT){
                $delimoe = ($temp) ? bcsub($OorT, $minmax['min'][$mark]) : bcsub($minmax['max'][$mark], $OorT);
                $delitel = bcsub($minmax['max'][$mark], $minmax['min'][$mark]);
            
            (float) $proizvedenie = (0 != $delitel && !empty($delitel) && 0 != $delimoe && !empty($delimoe)) ?  bcdiv($delimoe, $delitel) : 0.00; 
            
/// */ echo $mark.' : '.$district.'<br>'.'('.$delimoe.' / '.$delitel.') = '.$proizvedenie.'<br><br>'; // */
            $table .= '<td>'.$district.'</td></tr><tr>      <td>'.$proizvedenie.'</td></tr><tr>';
            
            (float) $proizvedenie = number_format($proizvedenie, ((is_int($GLOBALS['mantisa'])) ? $GLOBALS['mantisa'] : 16), '.', ''); 
            $return[$mark][$district] = $proizvedenie;   
        }}
/// */ echo'<table border="3">'.$table.'</table>'; /// */
        return (is_array($return) && !empty($return)) ?$return : false;}
        
    public function iP(array $isT, array $isO){
        if(!is_array($isT) && empty($isT)){return false;} if(!is_array($isO) && empty($isO)){return false;} if(count($isT, COUNT_RECURSIVE) != count($isO, COUNT_RECURSIVE)){return false;}
        
        foreach($isT as $mark => $districts){ foreach($districts as $district => $T){
            $return[$mark][$district] = bcadd(bcmul(0.6, $T), bcmul(0.4, $isO[$mark][$district]));
        }}
        
    return (is_array($return) && !empty($return)) ?$return : false;}

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
        return (!empty($this->districts) && is_array($this->districts) && 
                !empty($this->marks) && is_array($this->marks) && 
                !empty($this->reports) && is_array($this->reports)) ? $this : null;
    }///*/
      
    public function CalculateIP(){///*/
        $O = $this->memcached->get('O');
        $T = $this->memcached->get('T');
        $isO = $this->memcached->get('isO'); 
        $isT = $this->memcached->get('isT'); 
        $iP = $this->memcached->get('iP');          

///*/ $round = 7; $table = '<tr>'; ///*/ 
        if(!is_array($O) && !is_array($T)){
            foreach($this->marks as $vm){
///*/ $table .= '</tr><tr><td>Номер показателя:<b>'.$vm.'</b></td><td>2018</td><td>2019</td><td>2020</td><td>2021</td><td>О</td><td>Т</td><td>Ип</td></tr>'; ///*/
            for($i=1, $c=count($this->reports)+1; $i<$c; $i++){
                $r = $this->reports[$i]; $deadline = $r['deadline']; unset($r['deadline']);// echo $i.' - '.$deadline.'<br>';
                if(!empty($_4_indexa = $this->model->getIndexes([$vm],[$i],$r,4))){
                    
                    // pa($_4_indexa);
                    for($i=0, $c=count($_4_indexa); $i<$c; $i++){if(empty($_4_indexa[$i]['index'])){
                        echo $_4_indexa[$i]['id'].' - '.$i.'<br>';
                    }}
                    
                    
                    $this->index[$vm][$i] []= array('id'=>$_4_indexa[0]['id'], 'index' => number_format((float) $_4_indexa[0]['index'], 5,'.',''));
                    $this->index[$vm][$i] []= array('id'=>$_4_indexa[1]['id'], 'index' => number_format((float) $_4_indexa[1]['index'], 5,'.',''));
                    $this->index[$vm][$i] []= array('id'=>$_4_indexa[2]['id'], 'index' => number_format((float) $_4_indexa[2]['index'], 5,'.',''));
                    $this->index[$vm][$i] []= array('id'=>$_4_indexa[3]['id'], 'index' => number_format((float) $_4_indexa[3]['index'], 5,'.',''));
                    
                    if(4 == count($_4_indexa)){
                        $O[$vm][$i] = $this->sopOstrT($_4_indexa, 'O');                                                
                        $T[$vm][$i] = $this->sopOstrT($_4_indexa, 'T');
                    }else{pa($_4_indexa);}

///*/ $table .= '<tr><td>-----------------</td> <td><small>'.$_4_indexa[3]['id'].'</small></td> <td><small>'.$_4_indexa[2]['id'].'</small></td> <td><small>'.$_4_indexa[1]['id'].'</small></td> <td><small>'.$_4_indexa[0]['id'].'</small></td></tr><tr>'; ///*/
///*/ $table .= '<tr><td>'.$this->model->getQuery("SELECT owner FROM uin WHERE `id`='".$i."' ORDER BY `id` ASC;")[0]['owner'].'</td> <td><b>'.$_4_indexa[3]['index'].'</b></td> <td><b>'.$_4_indexa[2]['index'].'</b></td> <td><b>'.$_4_indexa[1]['index'].'</b></td> <td><b>'.$_4_indexa[0]['index'].'</b></td> <td><b>'.
    round($O[$vm][$i], $round).'</b></td> <td><b>'.round($T[$vm][$i], $round).'</b></td> <td><b>'.
    round($this->model->getQuery("SELECT index_final FROM `".$this->model->table."` WHERE `id`='".$_4_indexa[0]['id']."' ORDER BY `id` ASC;")[0]['index_final'], $round).'</b></td></tr><tr>'; ///*/
            }}
///*/ $table .= '</tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr>'; ///*/
            }
        }
///*/ echo '<table>'.$table.'</table>'; ///*/
        
        if(empty($isO)){
            $isO =  $this->isOisT($O, $this->arrayMinMax($O));}
        if(empty($isT)){
            $isT =  $this->isOisT($T, $this->arrayMinMax($T));}
        if(empty($iP)){
            $iP =  $this->iP($isT, $isO);}
 
        $this->memcached->set('O', $O, $GLOBALS['lifeMemcache']); 
        $this->memcached->set('T', $T, $GLOBALS['lifeMemcache']);
        $this->memcached->set('isO', $isO, $GLOBALS['lifeMemcache']);
        $this->memcached->set('isT', $isT, $GLOBALS['lifeMemcache']);
        $this->memcached->set('iP', $iP, $GLOBALS['lifeMemcache']);
        
        $mO = $this->arrayMinMax($O);
        $mT = $this->arrayMinMax($T);
        
        $this->O = $O;
        $this->minO = $mO['min'];
        $this->maxO = $mO['max'];
        $this->T = $T;
        $this->minT = $mT['min'];
        $this->maxT = $mT['max'];
        $this->isO = $isO;
        $this->isT = $isT;
        $this->iP = $iP; 
///*/ $this->memcached->quit() if(!$this->isT = $this->memcached->get('isT')){$this->memcached->set('isT', $this->isOisT($this->T, $this->arrayMinMax($this->T)));} echo'<table border="3">'.$table.'</table>'; ///*/
        return (!empty($this->index) && !empty($this->O) && !empty($this->T) && !empty($this->isO) &&  !empty($this->isT) &&  !empty($this->iP)) ? $this : null; 
    }///*/
    
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
///*/ 
echo $sql; ///*/
 
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
            $this->index[$vm][$i][3]['id'].'</small></td> <td><small>'.
            $this->index[$vm][$i][2]['id'].'</small></td> <td><small>'.
            $this->index[$vm][$i][1]['id'].'</small></td> <td><small>'.
            $this->index[$vm][$i][0]['id'].'</small></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr>'; ///*/
        
        $table .= '<tr><td>'.
            $this->model->getQuery("SELECT owner FROM uin WHERE `id`='".$i."' ORDER BY `id` ASC;")[0]['owner'].'</td> <td><b>'.
            number_format(round((float)$this->index[$vm][$i][3]['index'], $roundIndex), $roundIndex, ' , ', ' ').'</b></td> <td><b>'.
            number_format(round((float)$this->index[$vm][$i][2]['index'], $roundIndex), $roundIndex, ' , ', ' ').'</b></td> <td><b>'.
            number_format(round((float)$this->index[$vm][$i][1]['index'], $roundIndex), $roundIndex, ' , ', ' ').'</b></td> <td><b>'.
            number_format(round((float)$this->index[$vm][$i][0]['index'], $roundIndex), $roundIndex, ' , ', ' ').'</b></td> <td><b>'.
            number_format(round($this->O[$vm][$i], $round), $round, ' , ', ' ').'</b></td> <td><b>'.
            number_format(round($this->maxO[$vm], $round), $round, ' , ', ' ').'</b></td> <td><b>'.
            number_format(round($this->minO[$vm], $round), $round, ' , ', ' ').'</b></td> <td><b>'.
            number_format(round($this->isO[$vm][$i], $round), $round, ' , ', ' ').'</b></td> <td><b>'.
            number_format(round($this->T[$vm][$i], $round), $round, ' , ', ' ').'</b></td> <td><b>'.
            number_format(round($this->maxT[$vm], $round), $round, ' , ', ' ').'</b></td> <td><b>'.
            number_format(round($this->minT[$vm], $round), $round, ' , ', ' ').'</b></td> <td><b>'.
            number_format(round($this->isT[$vm][$i], $round), $round, ' , ', ' ').'</b></td> <td><b>'.
            number_format(round($this->model->getQuery("SELECT index_final FROM `".$this->model->table."` WHERE `id`='".$this->index[$vm][$i][0]['id']."' ORDER BY `id` ASC;")[0]['index_final'], $round), $round, ' , ', ' ').'</b></td></tr><tr>'; ///*/
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