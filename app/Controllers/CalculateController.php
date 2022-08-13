<?php

namespace App\Controllers;
/// */ Юзаем PhpOffice 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; /// */

/// */ Убираем вывод ошибок, устанавливаем необходимое количество памяти
ini_set('display_errors', 0); ini_set('display_startup_errors', 0); error_reporting(E_ALL); ini_set('memory_limit','0'); /// */
/// */ Берём разрядность из конфига, если не получается, устанавливаем в 16
$GLOBALS['mantisa'] = is_int($GLOBALS['mantisa']) ? $GLOBALS['mantisa'] : 16; /// */ 

class CalculateController extends AbstractController{
    public $model, $memcached,                                  /// */ Ресурсы /// */
    $districts, $marks, $reports, $index, $vector,          /// */ Объекты БД /// */
    $O, $minO, $maxO,                                                  /// */ Объём /// */
    $T, $minT, $maxT,                                                    /// */ Темп /// */
    $isO, $isT,                                                                 /// */ Индексы объёма и темпа /// */
    $iP, $KO;                                                                    /// */ Итоговые показатели и коэффиценты /// */

    public function __construct(){
        /// */ Открываем ресурсы доступа к базе, оперативке
        $this->model = new \App\Models\CalculateModel; $this->memcached = (object) $this->connMCD(); /// */
        /// */ Устанавливаем параметры объекта методом 
        /// */ (установка параметров вынесена из __construc для возможности убеждения наличия необходимых входных данных средствами php 8, например так $this->setParametrs()?->CalculateIP()?->writeData()?->genExel()?->printWeb();)
        $this->setParametrs(); /// */ 
        
        
    }
/// */ Метод устанавки параметров обьекта /// */
    public function setParametrs(){
        /// */ Берём данные из оперативки
        $this->districts = $this->memcached->get('districts'); 
        $this->marks = $this->memcached->get('marks'); 
        $this->reports = $this->memcached->get('reports');
        $this->index = $this->memcached->get('index'); 
        $this->vector = $this->memcached->get('vector'); /// */
        /// */ Проверяем актуальность данных, перезаписываем в оперативку
        if(empty($this->districts)){$d = [];  
            array_walk_recursive($this->model->getQuery("SELECT * FROM uin WHERE `type`='district' ORDER BY `id` ASC;"), function($v, $k) use (&$d){if('id' == $k){$d[] = $v;}});
            $this->districts = $d = (!empty($d) && is_array($d)) ? $d : [];
            $this->memcached->set('districts', $d, $GLOBALS['lifeMemcache']);
        }///*/ pa($this->districts, 10); ///*/         
        if(empty($this->marks)){$m = []; $v = [];
            $getMarks = $this->model->getQuery("SELECT * FROM marks WHERE `type`<>'description';"); ///*/ echo json_encode($getMarks); ///*/
            array_walk_recursive($getMarks, function($v, $k) use (&$m){if('num' == $k){$m[] = $v;}});
            foreach($getMarks as $item => $marks){$v[$marks['num']]  = $marks['vector'];}
             $this->marks = (!empty($m) && is_array($m)) ? $m : [];
             $this->vector = (!empty($v) && is_array($v)) ? $v : [];
             $this->memcached->set('marks', $this->marks, $GLOBALS['lifeMemcache']);
             $this->memcached->set('vector', $this->vector, $GLOBALS['lifeMemcache']);
        } ///*/ pa($this->marks, 10); ///*/         
        if(empty($this->reports) && !empty($this->districts) && is_array($this->districts)){
            for($i=0,$c=count($this->districts); $i<$c; $i++){
                (int)$uin = $this->districts[$i];
                $d = $this->model->getQuery("SELECT r.`id`, (SELECT `date` FROM `deadline` d WHERE d.`id`=r.`id_deadline`) AS `deadline` FROM `reports` r WHERE r.`id_uin`='".($uin)."' AND r.`status` IN ('1','9')".
                ///*/ " AND YEAR((SELECT `date` FROM `deadline` d WHERE d.`id`=r.`id_deadline`))<>'2022'". ///*/ Смещение отчётов для подсчётов
                " ORDER BY r.`id` DESC LIMIT 4;");
                if(is_array($d) && !empty($d) && 4 != count($d)){return null;}
            for($l=0,$s=count($d); $l<$s; $l++){$r[$uin]['deadline'] = $d[0]['deadline']; $r[$uin][] = $d[$l]['id'];
            }}
            if(!empty($r) && is_array($r)){$this->reports = $r;
            $this->memcached->set('reports', $this->reports, $GLOBALS['lifeMemcache']);
        }} ///*/ pa($this->reports, 10); ///*/        
        if(empty($this->index) && !empty($this->reports) && is_array($this->reports) && !empty($this->marks) && is_array($this->marks)){
        for($i_r=1, $c_r=count($_r = $this->reports); $i_r <= $c_r; $i_r++){
            $deadline = $_r[$i_r]['deadline']; unset($this->reports[$i_r]['deadline'], $_r[$i_r]['deadline']);                    
            for($i_m=0, $c_m=count($_m = $this->marks); $i_m < $c_m; $i_m++){
                $_4_inxdexa = $this->model->getIndexes([$_m[$i_m]],[$i_r],$_r[$i_r]); ///*/ Бывает и пустым, например 8, там где есть .1,.2 и т.д., но нет ведущего числа, например 20.1, 20.2, но нет 20 ///*/
                if(!empty($_4_inxdexa) && 4 == count($_4_inxdexa)){
                    for($i=0; $i<4; $i++){$_4_inxdexa[$i]['index'] = ('' == $_4_inxdexa[$i]['index']) ? '' : number_format((float) $_4_inxdexa[$i]['index'], 3, '.', '');}
                    $this->index[$i_r][$_m[$i_m]]['reports'] = json_encode($_r[$i_r]);
                    $this->index[$i_r][$_m[$i_m]]['deadline'] = $deadline;
                    $this->index[$i_r][$_m[$i_m]]['idx'] = $_4_inxdexa;
                }
            }unset($deadline);
        }} ///*/ pa($this->index, 10); ///*/  /// */
        /// */ Отдаём текущий объект, если данные актуальны, в противном случае null (null не менять на false, необходим для терного оператора методов обьекта)
        return (!empty($this->districts) && is_array($this->districts) && 
        !empty($this->marks) && is_array($this->marks) && 
        !empty($this->vector) && is_array($this->vector) && 
        !empty($this->reports) && is_array($this->reports) && 
        !empty($this->index) && is_array($this->index)) ? $this : null;
    }
/// */ Метод точки входа /// */
    public function index($set){
        /// */ Если пришёл массив set с индексами, обнови их в базе, перезапусти страницу
        if(!empty($set['cftvgyYBUNercftvgbyhun'])){
            foreach($set['cftvgyYBUNercftvgbyhun'] as $id => $index){
                $this->model->getQuery("UPDATE `index` SET `index`='$index' WHERE `id`='$id';",false);} header("Location: /" . $_SERVER['REQUEST_URI']);}/// */ 
        /// */ Готовим очистку оперативки перед подсчётом
        $this->memcached->flush(1);/// */ 
        ///*/ Логическая цепочка методов расчёта, записи в базу, генерации exel, вывода на экран
        $this->CalculateIP()?->writeData()?->genExel()?->printWeb(); ///*/
        ///*/ pa($this); ///*/ pa($this->iP); $this->genExelFromInAnyIndex();     
    }
/// */ Метод инициатор расчёта формул /// */     
    public function CalculateIP(){
        ///*/ Берём данные из оперативки, если есть
        $O = $this->memcached->get('O');
        $T = $this->memcached->get('T');
        $isO = $this->memcached->get('isO'); 
        $isT = $this->memcached->get('isT'); 
        $iP = $this->memcached->get('iP');          
        $KO = $this->memcached->get('KO');///*/          
        ///*/ Если нет, производим расчёты формул
        if(!is_array($O) && !is_array($T)){if(empty($this->index) && !is_array($this->index)){return null;}
            foreach($this->index as $_d => $marks){
                foreach($marks as $_m => $_4_indexa){
                    if(4 == count($_4_indexa['idx'])){
                        $O[$_d][$_m] = $sopO = $this->sopOstrT($_4_indexa['idx'], 'O');                                                
                        $T[$_d][$_m] = $strT = $this->sopOstrT($_4_indexa['idx'], 'T'); 
                        if('' != $sopO && is_numeric($sopO)){$Om[$_m][$_d] =  $sopO;} 
                        if('' != $strT && is_numeric($strT)){$Tm[$_m][$_d] =  $strT;} 
                    }else{///*/ pa($_4_indexa); ///*/
                        return null;
        }}}}
        
        if(is_array($Om) && is_array($Tm) && !empty($Om) && !empty($Tm)){$mO = $this->arrayMinMax($Om); $mT = $this->arrayMinMax($Tm);}else{return null;}

        if(empty($isO) && !empty($O) && !empty($mO)){$isO =  $this->isOisT($O, $mO);}
        if(empty($isT)){$isT =  $this->isOisT($T, $mT);}
        if(empty($iP)){$iP =  $this->iP($isT, $isO);}
        if(empty($KO)){$KO =  $this->iK($iP);}///*/ pa($isO[5]); pa($isT[5]); sort($KO); pa($KO); ///*/ 
        ///*/  Пишем данные в оперативку
        $this->memcached->set('O', $O, $GLOBALS['lifeMemcache']); 
        $this->memcached->set('T', $T, $GLOBALS['lifeMemcache']);
        $this->memcached->set('isO', $isO, $GLOBALS['lifeMemcache']);
        $this->memcached->set('isT', $isT, $GLOBALS['lifeMemcache']);
        $this->memcached->set('iP', $iP, $GLOBALS['lifeMemcache']);
        $this->memcached->set('KO', $KO, $GLOBALS['lifeMemcache']);///*/
        ///*/ Пишем в объект
        $this->O = $O;
        $this->minO = $mO['min'];
        $this->maxO = $mO['max'];
        $this->T = $T;
        $this->minT = $mT['min'];
        $this->maxT = $mT['max'];
        $this->isO = $isO;
        $this->isT = $isT;
        $this->iP = $iP; 
        $this->KO = $KO;///*/
        ///*/ Возвращаем текущий объект для следующего метода, если объект наполнен данными, в противном случае null
        return (!empty($this->index) && !empty($this->O) && !empty($this->T) && !empty($this->isO) &&  !empty($this->isT) &&  !empty($this->iP) &&  !empty($this->KO)) ? $this : null; ///*/ 
    }    
/// */ Метод расчёта объёма и темпа  sopOstrT(array $_4_indexa => массив из 4 индексов из базы, string $type => тип рассчёта О или Т ) /// */    
    public function sopOstrT(array $_4_indexa, string $type){
        /// */ Проверяем входные данные на корректность. Устанавливаем типы и разрядности вычеслений
        if(empty($_4_indexa) && !is_array($_4_indexa) && !(4 == count($_4_indexa))){return '';}
        bcscale(((!empty($GLOBALS['mantisa'])) ? (int) $GLOBALS['mantisa'] : 16)); (float) $return = 0.00;/// */
        /// */ Выбираем индексы из массивов с индексами, проверяем статус и корректность дат
        for($i=0;$i<4; $i++){
            $dateCreatingReport = $this->is_date($_4_indexa[$i]['id_report']['creating'])?->getTimestamp();
            $dateSubmittingReport = $this->is_date($_4_indexa[$i]['id_report']['submitting'])?->getTimestamp();
            $dateCreatingIndex = $this->is_date($_4_indexa[$i]['date'])?->getTimestamp();
            
            if((5 == $_4_indexa[$i]['id_status']['id']) && ($dateCreatingReport<$dateCreatingIndex || $dateSubmittingReport > $dateCreatingIndex)){
                $indexes[$i] = (!empty($_4_indexa[$i]['index'])) ? $_4_indexa[$i]['index'] : '';
                $mark = (!empty($_4_indexa[$i]['id_mark']['id'])) ? $_4_indexa[$i]['id_mark']['id'] : '';
        }} //*/ pa($indexes); echo $indexes[$i].'<br>'; //*/
        /// */  Если тип рассчёта объём то применяем формулу СУММ(индекс 2021, индекс 2020, индекс 2019)/3
        if('O' == $type){
            if('' == $indexes[0]){return '';} ///*/ Правки от Шамиля : если индекс 2021 пуст останови расчёт верни в О пустую строку
            if('' == $indexes[1]){return '';} ///*/ если индекс 2021 не пуст, а индекс 2020 пуст останови расчёт верни в О пустую строку 
            if('' == $indexes[2]){return '';} ///*/ если индекс 2021 не пуст и индекс 2020 не пуст, а индекс 2019 пуст останови расчёт верни в О пустую строку ///*/
            (float) $sum_1 = (is_numeric($indexes[0])) ? $indexes[0] : 0; ///*/ Если в один из трех индексов 2020, 2021, 2019 
            (float) $sum_2 = (is_numeric($indexes[1])) ? $indexes[1] : 0; ///*/ случайно попало не число, останови расчёт
            (float) $sum_3 = (is_numeric($indexes[2])) ? $indexes[2] : 0; ///*/ верни 0 ///*/ 
        $return = bcdiv(bcadd(bcadd($sum_1, $sum_2), $sum_3), 3);
        return $return;}
        /// */  Если тип рассчёта темп то применяем формулу ((индекс 2021/индекс 2020)*(индекс 2020/индекс 2019)*(индекс 2019/индекс 2018))^(1/3)    
        if('T' == $type){$pow = bcdiv(1, 3); $vector = $this->vector[$mark];
            if('' == $indexes[0]){return '';} ///*/ Правки от Шамиля : если индекс 2021 пуст останови расчёт верни в Т пустую строку
            if('' == $indexes[1]){return '';} ///*/ если индекс 2021 не пуст, а индекс 2020 пуст останови расчёт верни в Т пустую строку
            if('' == $indexes[2]){return '';} ///*/ если индекс 2021 не пуст и индекс 2020 не пуст
            if('' == $indexes[3]){return '';} ///*/ если индекс 2021 не пуст и индекс 2020 не пуст, и индекс 2019 не пуст, а индекс 2018 пуст останови расчёт верни в Т пустую строку ///*/
            $i0 = (is_numeric($indexes[0]) && !empty(round($indexes[0], $GLOBALS['mantisa']))) ? number_format((float) $indexes[0], $GLOBALS['mantisa'], '.', '') : '';  ///*/ Преоразование строк индексов 2020, 2021, 2019, 2018
            $i1 = (is_numeric($indexes[1]) && !empty(round($indexes[1], $GLOBALS['mantisa']))) ? number_format((float) $indexes[1], $GLOBALS['mantisa'], '.', '') : '';  ///*/ в число
            $i2 = (is_numeric($indexes[2]) && !empty(round($indexes[2], $GLOBALS['mantisa']))) ? number_format((float) $indexes[2], $GLOBALS['mantisa'], '.', '') : '';  ///*/ с разрядностью необходимой точности
            $i3 = (is_numeric($indexes[3]) && !empty(round($indexes[3], $GLOBALS['mantisa']))) ? number_format((float) $indexes[3], $GLOBALS['mantisa'], '.', '') : '';  ///*/ для высокоточных расчётов ///*/ 
            $_0 = (!empty($i0) && '' != $i0); ///*/ Возьми условия для 2021
            $_1 = (!empty($i1) && '' != $i1); ///*/ Возьми условия для 2020
            $_2 = (!empty($i2) && '' != $i2); ///*/ Возьми условия для 2019
            $_3 = (!empty($i3) && '' != $i3); ///*/ Возьми условия для 2018 ///*/
             ///*/ Правки от Шамиля : человеческий подход
            if($_0 && $_1 && $_2 && $_3){return number_format(bcmul(bcmul(bcdiv($i0,$i1),bcdiv($i1,$i2)), bcdiv($i2,$i3))**$pow, $GLOBALS['mantisa']);}
            if($_1 && $_2){
                if($_0){return number_format(bcmul(bcdiv($i0,$i1),bcdiv($i1,$i2))**$pow, $GLOBALS['mantisa']);}
                if($_3){///*/ echo $i1.' '.$i2.' '.$i3.'<br>'.$vector.'<br><br>'; ///*/
                    if($vector){return number_format(bcmul(bcdiv($i1,$i2), bcdiv($i2,$i3))**$pow, $GLOBALS['mantisa']); //*/ Правки от Шамиля 11 строка exel ///*/
                    }else{return number_format(bcmul(bcmul(bcdiv($i0,$i1),bcdiv($i1,$i2)), bcdiv($i2,$i3))**$pow, $GLOBALS['mantisa']); ///*/ Правки от Шамиля
                }}
                if($vector){return number_format(bcdiv($i1,$i2)**$pow, $GLOBALS['mantisa']);} ///*/ Правки от Шамиля
                return number_format(bcmul(bcdiv($i0,$i1),bcdiv($i1,$i2))**$pow, $GLOBALS['mantisa']); ///*/ Правки от Шамиля 21 строка exel ///*/  number_format(bcdiv($i1,$i2)**$pow, $GLOBALS['mantisa']);
            }
            if($_0 && $_1){
                if($_3){return number_format(bcmul(bcdiv($i0,$i1),bcdiv($i1,$i3))**$pow, $GLOBALS['mantisa']);} ///*/ Правки от Шамиля
                return number_format(bcdiv($i0,$i1)**$pow, $GLOBALS['mantisa']); 
            }
            if($_0){
                if($_2 && $_3){return number_format(bcmul(bcdiv($i0,$i2),bcdiv($i2,$i3))**$pow, $GLOBALS['mantisa']);} ///*/ Правки от Шамиля
                if($_2){return number_format(bcdiv($i0,$i2)**$pow, $GLOBALS['mantisa']);} ///*/ Правки от Шамиля
                if($_3){return number_format(bcdiv($i0,$i3)**$pow, $GLOBALS['mantisa']);} ///*/ Правки от Шамиля
                return number_format($i0**$pow, $GLOBALS['mantisa']);
            }
            if($_1){
                if($_3){return number_format(bcdiv($i1,$i3)**$pow, $GLOBALS['mantisa']);} ///*/ Правки от Шамиля
                return ($vector) ? 0.00 : number_format(bcdiv($i0,$i1)**$pow, $GLOBALS['mantisa']); ///*/ Правки от Шамиля 4 строка exel ///*/ number_format($i1**$pow, $GLOBALS['mantisa']);
            }
             ///*/
            return $return;}
        return false;}
/// */ Метод расчёта индексов объёма и темпа  (МАКС(OT) - OT) / (OT - МИН(OT)) ИЛИ (OT - МАКС(OT)) / (МАКС(OT) - МИН(OT)) зависит от вектора показателя /// */ 
    public function isOisT(array $OT, array $minmax){if(!is_array($OT) && empty($OT) && !is_array(current($OT)) && !is_array($minmax) && empty($minmax) && !is_array(current($minmax))){return false;}
        bcscale($GLOBALS['mantisa']); ///*/ pa($OT); ///*/ pa($minmax); ///*/
        foreach($OT as $district => $marks){
            foreach($marks as $mark => $OorT){
                $vector = $this->vector[$mark];
                if(is_numeric($OorT)){
                    $delimoe = ($vector) ? bcsub($OorT, $minmax['min'][$mark]) : bcsub($minmax['max'][$mark], $OorT);
                    $delitel = bcsub($minmax['max'][$mark], $minmax['min'][$mark]);
                    (float) $proizvedenie = (0 != $delitel && '' != $delitel && !empty($delitel)) ?  bcdiv($delimoe, $delitel) : '';
                    (float) $proizvedenie = ('' != $proizvedenie && is_numeric($proizvedenie)) ? number_format($proizvedenie, $GLOBALS['mantisa'], '.', '') : 0.00;
                }                
                $return[$district][$mark] = (is_numeric($OorT)) ? $proizvedenie : '';   
        }}return (is_array($return) && !empty($return)) ?$return : false;}
/// */ Метод расчёта индексов паказателей /// */        
    public function iP(array $ist, array $iso){bcscale($GLOBALS['mantisa']);if(!is_array($ist) && empty($ist)){return false;} if(!is_array($iso) && empty($iso)){return false;} if(count($ist, COUNT_RECURSIVE) != count($iso, COUNT_RECURSIVE)){return false;}
        foreach($ist as $district => $marks){ foreach($marks as $mark => $isT){
            $isO =$iso[$district][$mark]; $vector = $this->vector[$mark];///*/echo '<br>'."---------------[$district][$mark]".'<br>' .$this->index[$district][$mark]['idx'][0]['index'].'<br>' .$this->index[$district][$mark]['idx'][1]['index'].'<br>' .$this->index[$district][$mark]['idx'][2]['index'].'<br>' .$this->index[$district][$mark]['idx'][3]['index']; ///*/
            ///*/ Правки от Шамиля : человеческий подход
            if (0 == $this->index[$district][$mark]['idx'][0]['index']  &&
                0 == $this->index[$district][$mark]['idx'][1]['index']  &&
                0 == $this->index[$district][$mark]['idx'][2]['index']  &&
                0 == $this->index[$district][$mark]['idx'][3]['index']){$return[$district][$mark] = ($vector) ? 0 : 1; 
            }elseif(!$vector && 
                0 == $this->index[$district][$mark]['idx'][0]['index']  && (
                0 < $this->index[$district][$mark]['idx'][1]['index']  ||
                0 < $this->index[$district][$mark]['idx'][2]['index']  ||
                0 < $this->index[$district][$mark]['idx'][3]['index'])){$return[$district][$mark] = 1; 
            }elseif('36' == $mark &&
                0 < $this->index[$district][$mark]['idx'][0]['index']  && (
                0 < $this->index[$district][$mark]['idx'][1]['index']  ||
                0 < $this->index[$district][$mark]['idx'][2]['index']  ||
                0 < $this->index[$district][$mark]['idx'][3]['index'])){$return[$district][$mark] = 1; 
            }else{
                $return[$district][$mark] = ('' == $isT && '' == $isO) ? '' : bcadd(bcmul(0.6, $isT), bcmul(0.4, $isO));
            }///*/
        }}///*/ pa($return);  ///*/
        ///*/ Расчёт среднего значения для показателей с разрядами
        foreach($return as $district=>$marks){foreach($marks as $mark=>$iP){
            if(str_contains($mark, '8.')){$iPsSV[$district]['8_SV'] [$mark]= $marks[$mark];}
            if(str_contains($mark, '20.')){$iPsSV[$district]['20_SV'] [$mark]= $marks[$mark];}
            if(('23' == $mark) || str_contains($mark, '23.')){$iPsSV[$district]['23_SV'] [$mark]= $marks[$mark];}
            if(('24' == $mark) || str_contains($mark, '24.')){$iPsSV[$district]['24_SV'] [$mark]= $marks[$mark];}
            if(('25' == $mark) || str_contains($mark, '25.')){$iPsSV[$district]['25_SV'] [$mark]= $marks[$mark];}
            if(str_contains($mark, '26.')){$iPsSV[$district]['26_SV'] [$mark]= $marks[$mark];}
            if(str_contains($mark, '39.')){$iPsSV[$district]['39_SV'] [$mark]= $marks[$mark];}
            if(str_contains($mark, '40.')){$iPsSV[$district]['40_SV'] [$mark]= $marks[$mark];}
            if(str_contains($mark, '41.')){$iPsSV[$district]['41_SV'] [$mark]= $marks[$mark];}
        }}///*/ pa($return);  ///*/
          
        foreach($iPsSV as $district=>$marksSV){foreach($marksSV as $markSV=>$SV){
            $delitel = 0; (float) $sum = '';
            foreach($SV as $iP){if(is_numeric($iP)){
                $sum = bcadd($sum,$iP);
                $delitel++;}} $res = (is_numeric($sum)) ? bcdiv($sum,((0 == $delitel) ? 1 : $delitel)) : ''; unset($sum, $delitel); ///*/ (array_sum($SV)/$delitel); ///*/ echo $res.'<br>';
            
            if('8_SV' == $markSV){$return[$district]['8.1']  =  [$return[$district]['8.1'], 'SV' => $res];}
            if('20_SV' == $markSV){$return[$district]['20.1']  =  [$return[$district]['20.1'], 'SV' => $res];}
            if('23_SV' == $markSV){$return[$district]['23.1']  =  [$return[$district]['23.1'], 'SV' => $res];}
            if('24_SV' == $markSV){$return[$district]['24.1']  =  [$return[$district]['24.1'], 'SV' => $res];}
            if('25_SV' == $markSV){$return[$district]['25.1']  =  [$return[$district]['25.1'], 'SV' => $res];}
            if('26_SV' == $markSV){$return[$district]['26.1']  =  [$return[$district]['26.1'], 'SV' => $res];}
            if('39_SV' == $markSV){$return[$district]['39.1']  =  [$return[$district]['39.1'], 'SV' => $res];}
            if('40_SV' == $markSV){$return[$district]['40.1']  =  [$return[$district]['40.1'], 'SV' => $res];}
            if('41_SV' == $markSV){$return[$district]['41.1']  =  [$return[$district]['41.1'], 'SV' => $res];}

            $return[$district][$markSV] = $res;
        }}///*/ pa($return);  ///*/
        ///*/ 
    return (is_array($return) && !empty($return)) ?$return : false;}
/// */ Метод расчёта коэффицентов индексов паказателей 0,8*СУММ(1...8_SV...40 индексов отчёта, кроме 37 индекса)/КОЛИЧ(индексов)+0,2*37 индексс /// */      
    public function iK($iP){if(!is_array($iP) && empty($iP)){return false;} bcscale($GLOBALS['mantisa']);///*/ pa($iP); ///*/
        foreach($iP as $district=>$marks){foreach($marks as $mark=>$IP){
            if(str_contains($mark, '.')){unset($iP[$district][$mark]);}
            if(str_contains($mark, 'SV')){$dontSVmark = preg_replace('/[^0-9]+/', '', $mark); unset($iP[$district][$mark]); $iP[$district][$dontSVmark] =$IP; }
            if(str_contains($mark, '37')){$iP_37[$district] = $IP; unset($iP[$district][$mark]);
            }
        }ksort($iP[$district]);}///*/ pa($iP); ///*/
        
        foreach($iP as $district=>$marks){foreach($marks as $mark=>$IP){
            if(str_contains($mark, '41')){unset($iP[$district][$mark]);}
            if(!is_numeric($IP)){unset($iP[$district][$mark]);}
        }}///*/ pa($iP); ///*/ pa($iP_37); ///*/
        
        foreach($iP as $district=>$marks){///*/ $kol = count($iP[$district]); $delitel = (0 == $kol) ? 1 :  $kol; $CYMM = array_sum($iP[$district]); ///*/
            //$sum[$district]['delitel'] = 0; (float) $sum[$district]['sum'] = '';  
            $delitel= 0; (float) $sum = '';  $s = 0;  
            foreach($marks as $mark=>$IP){///*/ echo  $delitel. ' '.$s.' + '. $IP. ' = ' ; $s += $IP;  echo $s.'<br>'; ///*/
                $sum = bcadd($sum, $IP);
                $delitel++;}
            ///*/ echo "$district=>  ($sum/" . $delitel.')== <br>';
            //$KO[$district] = bcadd(bcmul(0.8,bcdiv($sum,((0 == $delitel) ? 1 :  $delitel))),bcmul(0.2,$iP_37[$district])); unset($sum, $delitel);
            $KO[$district] = bcadd(
                                                 bcdiv(
                                                            bcmul(0.8, $sum),((0 == $delitel) ? 1 :  $delitel)),
                                                 bcmul(0.2,$iP_37[$district])); /// */ echo "$district=>  0.8 * ($sum/" . $delitel.') + (0.2 * '.$iP_37[$district].') == '.$KO[$district].'<br>------------------------------------------------------------------------------<br><br><br>';/// */ 
            unset($sum, $delitel);
        }///*/ pa($iP_37);  pa($KO); ///*/
        return $KO;
    } 
/// */ Метод записи и обновления базы данными расчётов /// */  
    public function writeData(){
        if(empty($this->index) && empty($this->O) && empty($this->T) && empty($this->isO) && empty($this->isT) && empty($this->iP)){return null;}
        $sql = '';  $kpReport = [];
        foreach($this->index as $district => $marks){//$marks += ['8_SV' =>[],'20_SV'=>[],'23_SV'=>[],'24_SV'=>[],'25_SV'=>[],'26_SV'=>[],'39_SV'=>[],'40_SV'=>[],'41_SV'=>[]]; --           
            foreach($marks as $mark => $indexes){//$checkSV = str_ends_with($mark,'SV');//if($checkSV){$reportSV = $this->model->getQuery("SELECT * FROM reports WHERE `id_uin`='".$district."' AND `status`='1' AND deadline IN (SELECT max(deadline) FROM reports WHERE `id_uin`='".$district."'  AND `status`='1') LIMIT 1;");}
                $reports =  (!empty($indexes['reports'])) ? $indexes['reports'] : '[,]';
                $id_report = ('[,]' != $reports) ?  str_replace(array('[', ',', ']'), '', explode(',',$reports)[0]) : '';
                $deadline = (!empty($indexes['deadline'])) ? $indexes['deadline'] : "0000-00-00 00:00:00";
                $idx = $indexes['idx'];

                $kpReport [$district]=  $id_report;
///*/ 
$sql .= '<nobr>'; 
            $idx[0]['index'] = (empty($idx[0]['index'])) ? '' : $idx[0]['index'];
            $idx[1]['index'] = (empty($idx[1]['index'])) ? '' : $idx[1]['index'];
            $idx[2]['index'] = (empty($idx[2]['index'])) ? '' : $idx[2]['index'];
            $idx[3]['index'] = (empty($idx[3]['index'])) ? '' : $idx[3]['index'];
 
            $sql .= $setSql = "INSERT INTO `".$this->model->table."` VALUES ('".
            ((!empty($idx[0]['id']) ? $idx[0]['id'] : (
             (!empty($idx[1]['id']) ? $idx[1]['id'] : (
             (!empty($idx[2]['id']) ? $idx[2]['id'] : (
             (!empty($idx[3]['id']) ? $idx[3]['id'] : 'CONCAT()'))))))))."', '".
            $mark."', '".
            $district."','".
            $reports."','".
            $deadline."','".
            $idx[3]['index']."','".
            $idx[2]['index']."','".
            $idx[1]['index']."','".
            $idx[0]['index']."','".
            $this->O[$district][$mark]."', '".
            $this->maxO[$mark]."', '".
            $this->minO[$mark]."', '".
            $this->isO[$district][$mark]."', '".
            $this->T[$district][$mark]."', '".
            $this->maxT[$mark]."', '".
            $this->minT[$mark]."', '".
            $this->isT[$district][$mark]."', ".((str_contains($mark, '.') && !str_ends_with($mark, '1')) ? "'".$this->iP[$district][$mark]."', ''" : 
                                                                ((is_array($this->iP[$district][$mark])) ? "'".$this->iP[$district][$mark][0]."', '".$this->iP[$district][$mark]['SV']."'" : "'".$this->iP[$district][$mark]."', '".$this->iP[$district][$mark]."'")).") 
            ON DUPLICATE KEY UPDATE `deadline`='".
            $deadline."', `date_0`='".
            $idx[0]['index']."', `date_1`='".
            $idx[1]['index']."', `date_2`='".
            $idx[2]['index']."', `date_3`='".
            $idx[3]['index']."', `o_sop`='".
            $this->O[$district][$mark]."', `max_sop`='".
            $this->maxO[$mark]."', `min_sop`='".
            $this->minO[$mark]."', `isop`='".
            $this->isO[$district][$mark]."', `t_str`='".
            $this->T[$district][$mark]."', `max_str`='".
            $this->maxT[$mark]."', `min_str`='".
            $this->minT[$mark]."', `istr_t`='".
            $this->isT[$district][$mark]."', ".((str_contains($mark, '.') && !str_ends_with($mark, '1')) ? "`index_final`='".$this->iP[$district][$mark]."'" : ((is_array($this->iP[$district][$mark])) ?  "`index_final`='".
            $this->iP[$district][$mark][0]."', `index_sv`='".$this->iP[$district][$mark]['SV']."'" : "`index_final`='".$this->iP[$district][$mark]."', `index_sv`='".$this->iP[$district][$mark]."'" )).";";
           ///*/ 
           $this->model->getQuery($setSql, false); ///*/ 
           $sql .='</nobr><br><br>'.PHP_EOL; ///*/
           if(is_array($this->iP[$district][$mark])){$this->iP[$district][$mark] = $this->iP[$district][$mark][0];}}}
 ///*/ echo $sql; ///*/

            $sql = '';
            foreach($this->iP as $district => $marks){ /// */ echo $district.'<br>'; /// */
            $sql .= '<nobr>'; $setSql =  "INSERT INTO `kp` "; 
            $k ="`id_report`,"; $v = "'".$kpReport[$district]."',";
            $u = "`mark_ko` = '".$this->KO[$district]."',"; 
            $k .="`mark_ko`,"; $v .= "'".$this->KO[$district]."',";
            foreach($marks as $mark => $iP){
                $u .= "`mark_".$mark."` = '".$iP."',";
                $k .="`mark_".$mark."`,"; $v .= "'".$iP."',";
            } $k = rtrim($k, ','); $v = rtrim($v, ','); $u = rtrim($u, ','); 
            
            
            $setSql .= '('.$k.') VALUES ('.$v.')  ON DUPLICATE KEY UPDATE '.$u.';';
           ///*/ 
           $this->model->getQuery($setSql, false); ///*/ 
           $sql .= $setSql .'</nobr><br><br>'.PHP_EOL; ///*/
           }
///*/ echo $sql; ///*/  

    return $this;}
/// */ Метод вывода данных расчётов в браузер /// */     
    public function printWeb($round = 3, $roundIndex = 4){if(empty($this->index) && empty($this->O) && empty($this->maxO) && empty($this->minO) && empty($this->isO) && empty($this->T) && empty($this->maxT) && empty($this->minT) && empty($this->isT) && empty($this->iP)){return null;}
        $table = "<style>td, input{cursor:pointer;}input[type=text]{width: 70px;height: 17px;}</style>
 <script type='text/javascript'>
document.addEventListener('DOMContentLoaded', ()=>{

let TB = document.querySelector('table');
if(TB){TB.addEventListener('click', (event)=>{
    let cell = event.target; 
    let TD = cell.parentElement;
    let txt = TD.textContent || TD.innerText;
        
    if('td' == TD.tagName.toLowerCase() && TD.classList.contains('up')){
    let newTag = document.createElement('input');
    newTag.setAttribute('id', TD.getAttribute('id'));
    newTag.setAttribute('class', 'set');
    newTag.setAttribute('type', 'text');
    newTag.setAttribute('name', 'cftvgyYBUNercftvgbyhun['+TD.getAttribute('id')+']');
    newTag.setAttribute('value', txt);
    
    if('b' == cell.tagName.toLowerCase()){
        TD.innerHTML = '';
        TD.appendChild(newTag);}
    console.log(cell);
return;}   
});} 
});
 </script>       
        ";  
        $table .= '<tr>';  
        $date1 = (new \DateTime)->modify( '-1 year' )->format('Y'); 
        $date2 = (new \DateTime)->modify( '-2 year' )->format('Y'); 
        $date3 = (new \DateTime)->modify( '-3 year' )->format('Y'); 
        $date4 = (new \DateTime)->modify( '-4 year' )->format('Y');
        foreach($this->marks as $vm){///*/ 
        $vector = $this->vector[$vm];
        $table .= '</tr><tr class="textCenter"><td>'.(($vector) ? 'Р' : 'С').'</td><td>Номер показателя:<b>'.$vm.'</b></td><td>'.
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
        $table .= '<tr class="textRight"><td></td><td>-------------------------</td> <td><small>'.
            $this->index[$i][$vm]['idx'][3]['id'].'</small></td> <td><small>'.
            $this->index[$i][$vm]['idx'][2]['id'].'</small></td> <td><small>'.
            $this->index[$i][$vm]['idx'][1]['id'].'</small></td> <td><small>'.
            $this->index[$i][$vm]['idx'][0]['id'].'</small></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr>'; ///*/
        $table .= '<tr><td>'.$i.'</td><td>'.
            $this->model->getQuery("SELECT owner FROM uin WHERE `id`='".$i."' ORDER BY `id` ASC;")[0]['owner'].'</td> <td class="up" id="'.$this->index[$i][$vm]['idx'][3]['id'].'"><b>'.((is_numeric($this->index[$i][$vm]['idx'][3]['index'])) ?
            number_format(round((float)$this->index[$i][$vm]['idx'][3]['index'], $roundIndex), $roundIndex, '.', '') : '-' ).'</b></td> <td class="up" id="'.$this->index[$i][$vm]['idx'][2]['id'].'"><b>'.((is_numeric($this->index[$i][$vm]['idx'][2]['index'])) ?
            number_format(round((float)$this->index[$i][$vm]['idx'][2]['index'], $roundIndex), $roundIndex, '.', '') : '-' ).'</b></td> <td class="up" id="'.$this->index[$i][$vm]['idx'][1]['id'].'"><b>'.((is_numeric($this->index[$i][$vm]['idx'][1]['index'])) ?
            number_format(round((float)$this->index[$i][$vm]['idx'][1]['index'], $roundIndex), $roundIndex, '.', '') : '-' ).'</b></td> <td class="up" id="'.$this->index[$i][$vm]['idx'][0]['id'].'"><b>'.((is_numeric($this->index[$i][$vm]['idx'][0]['index'])) ?
            number_format(round((float)$this->index[$i][$vm]['idx'][0]['index'], $roundIndex), $roundIndex, '.', '') : '-' ).'</b></td> <td><b>'.((is_numeric($this->O[$i][$vm])) ?
            number_format(round($this->O[$i][$vm], $round), $round, ' , ', ' ') : '-' ).'</b></td> <td><b>'. ((is_numeric($this->maxO[$vm])) ?
            number_format(round($this->maxO[$vm], $round), $round, ' , ', ' ') : '-' ).'</b></td> <td><b>'.((is_numeric($this->minO[$vm])) ?
            number_format(round($this->minO[$vm], $round), $round, ' , ', ' ') : '-' ).'</b></td> <td><b>'.((is_numeric($this->isO[$i][$vm])) ?
            number_format(round($this->isO[$i][$vm], $round), $round, ' , ', ' ') : '-' ).'</b></td> <td><b>'.((is_numeric($this->T[$i][$vm])) ?
            number_format(round($this->T[$i][$vm], $round), $round, ' , ', ' ') : '-' ).'</b></td> <td><b>'.((is_numeric($this->maxT[$vm])) ?
            number_format(round($this->maxT[$vm], $round), $round, ' , ', ' ') : '-' ).'</b></td> <td><b>'.((is_numeric($this->minT[$vm])) ?
            number_format(round($this->minT[$vm], $round), $round, ' , ', ' ') : '-' ).'</b></td> <td><b>'.((is_numeric($this->isT[$i][$vm])) ?
            number_format(round($this->isT[$i][$vm], $round), $round, ' , ', ' ') : '-' ).'</b></td> <td><b>'.((is_numeric($this->iP[$i][$vm])) ?
            number_format(round($this->iP[$i][$vm], $round), $round, ' , ', ' ') : '-' ).'</b></td></tr><tr>'; ///*/
                }///*/ 
        $table .= '</tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr><tr><td>&#160;</td></tr>'; ///*/
        }///*/ 
        echo '<a href="https://yandex.ru/images/search?text=сиськи"> （•ㅅ•） сиськи</a><br><br><form method="post" action=""><table>'.$table.'</table><br><input type="submit" value="СОХРАНИТЬ ЗНАЧЕНИЯ"></form><style>td{border-right:2px solid #000; padding: 0 5px}.textCenter{text-align: center;}.textRight{text-align: right;}</style>'; ///*/ 
    }
/// */ Метод генерации exel с данными расчётов и записью файла в каталог /public/ftp /// */     
    public function genExel($round = 16, $roundIndex = 3, $dirname = _DS_.'var'._DS_.'www'._DS_.'disk'._DS_.'exel'){///*/
        $date1 = (new \DateTime)->modify( '-1 year' )->format('Y'); 
        $date2 = (new \DateTime)->modify( '-2 year' )->format('Y'); 
        $date3 = (new \DateTime)->modify( '-3 year' )->format('Y'); 
        $date4 = (new \DateTime)->modify( '-4 year' )->format('Y');
    
         $exel = []; $i=1;
         $spreadsheet = new Spreadsheet();
   
        for($l=0,$s=count($this->marks);$l<$s;$l++){///*/ echo $vm.'<br>'; 
            $vm = $this->marks[$l];
            $vector = $this->vector[$vm];
            $sheet = $spreadsheet->createSheet($i); 
            ///*/ pa($pa); exit(); $spreadsheet->setActiveSheetIndex($i); $sheet = $spreadsheet->getActiveSheet($i); ///*/ 
            $i++;
            $sheet->setTitle($vm);
            $exel []= array((($vector) ? 'РОСТ' : 'СНИЖЕНИЕ'),  $date4, $date3, $date2, $date1,'О','Макc О','Мин О','ИсО','Т','Макc Т','Мин Т','ИсТ','Ип'); 
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
         $spreadsheet->removeSheetByIndex(0); $spreadsheet->setActiveSheetIndex(1);
        if(file_exists($dirname)){$filename = $dirname._DS_.(new \DateTime)->format('Y-m-d-his').'.xlsx'; (new Xlsx($spreadsheet))->save($filename);}
       
         return $this;
    }          

    public function genExelFromInAnyIndex($dirname = _DS_.'var'._DS_.'www'._DS_.'disk'){///*/
        $spreadsheet = new Spreadsheet();
        pa($index = $this->model->getQuery("SELECT * FROM `index` ORDER BY `id` ASC;"));

        $sheet = $spreadsheet->createSheet(1); $sheet->fromArray($index, NULL, 'A1');
        $spreadsheet->removeSheetByIndex(0); //$spreadsheet->setActiveSheetIndex(2);
        if(file_exists($dirname)){$filename = $dirname._DS_.'idx'.(new \DateTime)->format('Y-m-d-his').'.xlsx'; (new Xlsx($spreadsheet))->save($filename);}
    }          
}