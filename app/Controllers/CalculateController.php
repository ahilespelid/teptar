<?php

namespace App\Controllers;

class CalculateController extends AbstractController{
    public $model, $uinModel, $markModel, $memcached,
    $reports,
    $districts,
    $marks,
    $O,
    $T,
    $isO,
    $isT,
    $iP;

    public function __construct(){
        $this->model        = new \App\Models\ReportModel;
        $this->uinModel     = new \App\Models\UINModel;
        $this->markModel    = new \App\Models\MarkModel;
        $this->memcached    = (object) $this->connMCD();

        $this->setCache();
    }

    public function index(){ // */ $this->memcached->flush(10);  // */
        //pa($this->iP); //pa($this->isO); //pa($this->isT, 10);
        $minmaxO = $this->arrayMinMax($this->O);
        $minmaxT = $this->arrayMinMax($this->T);
        $sql = '';
        foreach($this->O as $mark => $districts){foreach($districts as $district => $sop_o){
            $sql .= "<nobr>INSERT INTO `count` VALUES (NULL, '".$mark."', '".$district."', NULL, NULL, NULL, NULL, '".$this->O[$mark][$district]."', '".$minmaxO["max"][$mark]."', '".$minmaxO["min"][$mark]."', '".$this->isO[$mark][$district]."',  ".
                                                                "'".$this->T[$mark][$district]."', '".$minmaxT["max"][$mark]."', '".$minmaxT["min"][$mark]."', '".$this->isT[$mark][$district]."', '".$this->iP[$mark][$district]."');</nobr><br><br>".PHP_EOL;
            
        }}        
        //$sql .= ';';
        //echo $sql;
        pa($this);
    }
    
    public function sopOstrT(array $_4_indexa, string $type = 'sop'){bcscale((is_int($GLOBALS['mantisa'])) ? $GLOBALS['mantisa'] : 16);
        (float) $return = 0.00; 
        $_4_indexa = (!empty($_4_indexa) && is_array($_4_indexa)) ? $_4_indexa : false;
        
        if($_4_indexa){for($i=0;$i<4; $i++){
            $dateCreatingReport = $this->is_date($_4_indexa[$i]['id_report']['creating'])?->getTimestamp();
            $dateSubmittingReport = $this->is_date($_4_indexa[$i]['id_report']['submitting'])?->getTimestamp();
            $dateCreatingIndex = $this->is_date($_4_indexa[$i]['date'])?->getTimestamp();
            
            if((5 == $_4_indexa[$i]['id_status']['id']) && ($dateCreatingReport<$dateCreatingIndex || $dateSubmittingReport > $dateCreatingIndex)){
                $indexes[$i] = (!empty($_4_indexa[$i]['index'])) ? (float) $_4_indexa[$i]['index'] : 0.00;
                //$indexes [] = $_4_indexa[$i]['id_uin']['slug'];
                //$indexes[$_4_indexa[$i]['id_mark']['num']][$_4_indexa[$i]['id_uin']['slug']][] = (!empty($_4_indexa[$i]['index'])) ? (float) $_4_indexa[$i]['index'] : 0.00;
                
            }} // */  pa($indexes); // */
            $indexes = $this->arrayDeleteElement($indexes,['', 0.00, 0]);
            // */  pa($indexes); // */
            if('O' == $type){unset($indexes[3]);
            // */  if(isset($indexes[0])){unset($indexes[3]);} pa($indexes); // */
            $count = (!empty($indexes)) ? count($indexes) : 1; (float) $sum = 0; $count = 3;
            (float) $sum_1 = (!empty($indexes[0])) ? $indexes[0] : 0.00;
            (float) $sum_2 = (!empty($indexes[1])) ? $indexes[1] : 0.00;
            (float) $sum_3 = (!empty($indexes[2])) ? $indexes[2] : 0.00;
            (float) $sum_4 = (!empty($indexes[3])) ? $indexes[3] : 0.00;

            $return = bcdiv(bcadd(bcadd($sum_1, $sum_2), bcadd($sum_3, $sum_4)), $count);
            /* //
            $return = array_sum($indexes) / $count; 
            echo $sum_1.'<br>';echo $sum_2.'<br>';echo $sum_3.'<br>';echo $sum_4.'<br>';echo $sum.'<br>';echo $count.'<br>';echo $return.'<br>';
            return (3 <= $count) ? $return :  0.00;
            // */
            return $return;
            }
            if('T' == $type){$pow = bcdiv(1, 3); // */ 0.333333333333333;  // */
                (float)$return = 0.00;
                if(empty($indexes[0]) && empty($indexes[1])){return $return;}
                if(empty($indexes[3]) && empty($indexes[2])){return (empty($indexes[0])) ? $return :  number_format($indexes[0]**$pow, ((is_int($GLOBALS['mantisa'])) ? $GLOBALS['mantisa'] : 16), '.', '');}

                if(!empty($indexes[0]) && !empty($indexes[1])){$returnA[] = (0 < ($_1 = bcdiv($indexes[0],$indexes[1]))) ? $_1 : 0.00;} // */echo '-4<br>'; // */
                if(!empty($indexes[2])){$returnA[] = (0 < ($_2 = @bcdiv($indexes[1],$indexes[2]))) ? $_2 : 0.00;} // */ echo '-5<br>'; // */
                if(!empty($indexes[3])){$returnA[] = (0 < ($_3 = @bcdiv($indexes[2],$indexes[3]))) ? $_3 : 0.00;} // */ echo '-6<br>'; // */
                $returnA = $this->arrayDeleteElement($returnA,['', 0.00, 0]);

                (float) $mul_1 = (!empty($returnA[0])) ? $returnA[0] : 1;
                (float) $mul_2 = (!empty($returnA[1])) ? $returnA[1] : 1;
                (float) $mul_3 = (!empty($returnA[2])) ? $returnA[2] : 1;

                $mul = bcmul($mul_1, $mul_2); $mul = bcmul($mul, $mul_3);
                $return = $mul**$pow;
                /* // 
                $return = $mul**$pow; $return = array_product($returnA) ** $pow.'<br>';
                pa($indexes); pa($returnA,2);
                echo '<br><br><br>'.$mul_1.'<br>';echo $mul_2.'<br>'; echo $mul_3.'<br><br>';echo $mul.'<br><br>';echo $return.'<br>';
                // */

            return (!empty($return)) ? number_format($return, ((is_int($GLOBALS['mantisa'])) ? $GLOBALS['mantisa'] : 16), '.', '') : 0.00;}
        }
    return false;}
    
    public function isOisT(array $OT, array $minmax){bcscale((is_int($GLOBALS['mantisa'])) ? $GLOBALS['mantisa'] : 16);
        if(!is_array($OT) && empty($OT) && !is_array(current($OT)) && !is_array($minmax) && empty($minmax) && !is_array(current($minmax))){return false;}
        //pa($OT);
        $table = ''; 
        foreach($OT as $mark => $districts){
            $table .= '<th>'.$mark.'</th>       <th>'.$minmax['max'][$mark].'</th>     <th>'.$minmax['min'][$mark].'</th><tr>';
            
            $temp = $this->model->getWhere('marks',['num' => $mark])[0]['temp'];
            
            foreach($districts as $district => $OorT){
                $delimoe = ($temp) ? bcsub($OorT, $minmax['min'][$mark]) : bcsub($minmax['max'][$mark], $OorT);
                $delitel = bcsub($minmax['max'][$mark], $minmax['min'][$mark]);
            
            (float) $proizvedenie = (0 != $delitel && !empty($delitel) && 0 != $delimoe && !empty($delimoe)) ?  bcdiv($delimoe, $delitel) : 0.00; 
            
            // */ echo $mark.' : '.$district.'<br>'.'('.$delimoe.' / '.$delitel.') = '.$proizvedenie.'<br><br>'; // */
            $table .= '<td>'.$district.'</td></tr><tr>      <td>'.$proizvedenie.'</td></tr><tr>';
            
            (float) $proizvedenie = number_format($proizvedenie, ((is_int($GLOBALS['mantisa'])) ? $GLOBALS['mantisa'] : 16), '.', ''); 
            $return[$mark][$district] = $proizvedenie;   
        }}
        // */ echo'<table border="3">'.$table.'</table>'; // */
        return (is_array($return) && !empty($return)) ?$return : false;}
        
    public function iP(array $isT, array $isO){
        if(!is_array($isT) && empty($isT)){return false;} if(!is_array($isO) && empty($isO)){return false;} if(count($isT, COUNT_RECURSIVE) != count($isO, COUNT_RECURSIVE)){return false;}
        
        foreach($isT as $mark => $districts){ foreach($districts as $district => $T){
            $return[$mark][$district] = bcadd(bcmul(0.6, $T), bcmul(0.4, $isO[$mark][$district]));
        }}
        
    return (is_array($return) && !empty($return)) ?$return : false;}

    public function setCache(){
        $districts = $this->memcached->get('districts'); $reports = $this->memcached->get('reports'); $marks = $this->memcached->get('marks');
        if(empty($districts)){  $districts = [];    $districts =  $this->uinModel->findBy(['type' => 'district']);        $this->memcached->set('districts', $districts, 20);}
        if(empty($reports)){    $reports = [];      $reports =  $this->model->getReports();                                     $this->memcached->set('reports', $reports, 20);}
        if(empty($marks)){      $marks = [];        $marks =  $this->markModel->findAll();                                      $this->memcached->set('marks', $marks, 20);}
        // */ if(!$this->reports = $this->memcached->get('reports')){$this->memcached->set('reports', $this->model->getReports());} // */
        $this->districts = $districts; $this->reports = $reports; $this->marks = $marks;
        
        $isO = $this->isO = $this->memcached->get('isO'); $isT = $this->T = $this->memcached->get('isT'); $iP = $this->iP = $this->memcached->get('iP');
        $table = '';           
        if(!$this->O = $this->memcached->get('O') && !$this->T = $this->memcached->get('T')){
         $this->O = []; $this->T = [];  $i=1;
            foreach($this->marks as $vm){$table .= '<th>'.$i.' показатель: '.$vm['num'].'</th>  <th>2018</th>   <th>2019</th>   <th>2020</th>   <th>2021</th>   <th>O</th>  <th>T</th><tr>';                
                foreach($this->districts as $vd){
                if(!empty($_4_indexa = $this->model->getIndexes([$vm['num']],[$vd['id']],[],4))){$i++;
                    $this->O[$vm['num']][$vd['id']] = $this->sopOstrT($_4_indexa, 'O');
                    $this->T[$vm['num']][$vd['id']] = $this->sopOstrT($_4_indexa, 'T');
                    
                    $table .= '<td>'.$vd['slug'].'</td>     <td>'.$_4_indexa[3]['index'].'</td>     <td>'.$_4_indexa[2]['index'].'</td>     <td>'.$_4_indexa[1]['index'].'</td>     <td>'.$_4_indexa[0]['index'].'</td>     <td>'.$this->O[$vm['num']][$vd['id']].'</td>   <td>'.$this->T[$vm['num']][$vd['id']].'</td></tr><tr>';
                }
            }$table .= '</tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr></tr>';}
            $this->memcached->set('O', $this->O); $this->memcached->set('T', $this->T);
        }
        
        if(empty($isO)){$isO = []; $isO =  $this->isOisT($this->O, $this->arrayMinMax($this->O)); $this->memcached->set('isO', $isO, 20);}
        if(empty($isT)){$isT = []; $isT =  $this->isOisT($this->T, $this->arrayMinMax($this->T)); $this->memcached->set('isT', $isT, 20);}
        if(empty($iP)){$iP = []; $iP =  $this->iP($isT, $isO); $this->memcached->set('iP', $iP, 20);}
        
        $this->isO = $isO; $this->isT = $isT; $this->iP = $iP;                  // */ if(!$this->isT = $this->memcached->get('isT')){$this->memcached->set('isT', $this->isOisT($this->T, $this->arrayMinMax($this->T)));} echo'<table border="3">'.$table.'</table>'; // */
        return $this->memcached->quit();}
        
}