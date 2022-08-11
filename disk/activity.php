<div class="actions__info block-box sub-block-margin-top">  <style type="text/css">.red{background: #f00;}</style>
    <?php 
$roles = ($roles = $this->model->getAll('roles')) ? array_combine(range(1, count($roles)), $roles) : null;
$NA = 'n|a'; $readMarks =''; $uid = ($_GET['uid']) ?? false; $mid= ($_GET['mid']) ?? false;

//$markForUser = $marks;

foreach ($marks as $user => $activMarks){ ///* / pa($activMarks); ///* /
    $ava = (empty($ava = $marks[$user][0]['avatar'])) ? $this->security->setEmptyAvatar() : $ava; $fname = (empty($fname = $marks[$user][0]['firstname'])) ? $NA : $fname; 
    $sname = (empty($sname = $marks[$user][0]['secondname'])) ? $NA : $sname; $lname = (empty($lname = $marks[$user][0]['lastname'])) ? $NA : $lname;
    $role = (empty($marks[$user][0]['id_role']['post'])) ? $roles[8]['post'] : $marks[$user][0]['id_role']['post']; 
    
    $markForUser = $activMarks;   
    if(reset($markForUser)){next($markForUser); $currMark = current($markForUser);}
    $currMark = ($mid && $uid && $uid == $user && $mid != $currMark[1]['id_mark']) ? $marks[$user][$mid] : $currMark;
    
     
    $checkReadIndex = ($currMark[2]) ?? false;
    
    //pa($currMark); 
     
    $status = (empty($currMark[1]['id_status'])) ? $NA : $currMark[1]['id_status']; 
    $date = (empty($currMark[1]['date'])) ? (new DateTime('0000-00-00')) : $this->is_date($currMark[1]['date']);
    $IntlDate = new IntlDateFormatter('ru_RU', IntlDateFormatter::MEDIUM , IntlDateFormatter::MEDIUM );
    $IntlDate->setPattern('d F Y, G:i:s');
    
    $listItem = '<a name="'.$currMark[1]['id'].'" >';  foreach((array_keys($activMarks)) as $m){if(0 != $m){
            $listItem .= '<div class="item'.((!$mid && $m == $currMark[1]['id_mark']) ? ' red' : 
                                                             ((($user != $uid && $m == $currMark[1]['id_mark']) || ($user == $uid && $m == $mid)) ? ' red' : '')).'"><a href="/'.$_GET['q'].'?id='.$_GET['id'].'&uid='.$user.'&mid='.$m.'#'.$currMark[1]['id'].'">'.$m.'</a></div>';
    }} 

?>

                <div class="actions__info-item">
                    <div class="actions__activity-info">
                        <div class="actions__activity-user">
                            <div class="avatar">
                                <img src="<?=$ava;?>" alt="Avatar">
                            </div>
                            <div class="info">
                                <span class="name"><?=$fname.' '.$sname.' '.$lname;?></span>
                                <span class="post">
                                    <?=$role;?>
                                    <br>
                                    <?=$IntlDate->formatObject($date); ?>
                                </span>
                            </div>
                        </div>
                        <div class="status second-status">
<?php if($checkReadIndex){?>
                            <span class="active">
                                <i class="icon-document-update"></i> Изменено
                            </span>
<?php } else { ?>
                            <span class="active">
                                <i class="icon-document-add"></i> Данные введены
                            </span>
<?php } ?>

                            <span<?=('5' == $status || '6' == $status) ? ' class="active"' : ''?>>
                                <i class="icon-document-check"></i> <?=('5' == $status) ? 'Согласовано' : 'Не согласовано'?>
                            </span>
                        </div>
                    </div>             
             
<?php
?>
                
                    <div class="actions__activity-indicators">
                        <div class="indicators-list">
                          <div class="title">Изменены показатели:</div>
                          <div class="list">
                              <?=$listItem;?>
                          </div>
                        </div>
                        <div class="indicator-description">
                          <?=(!empty($currMark[0])) ? '<b>'.$currMark[0]['num'].'</b> '.$currMark[0]['name'] : '';?>
                        </div>
                        <div class="indicator-comparison">
<?php if($checkReadIndex){?>
                          <div>Было: <b><?=$currMark[2]['index'];?></b></div>
<?php } ?>
                          <div>Стало: <b><?=$currMark[1]['index'];?></b></div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    <?php } ?>

<!--    <div class="actions__info-item">-->
<!---->
<!--        <div class="actions__activity-info">-->
<!--            <div class="actions__activity-user">-->
<!--                <div class="avatar">-->
<!--                    <img src="--><?php //echo $this->security->setEmptyAvatar() ?><!--" alt="Avatar">-->
<!--                </div>-->
<!--                <div class="info">-->
<!--                    <span class="name">Ибрагим Грозный</span>-->
<!--                    <span class="post">-->
<!--                        Районный сотрудник-->
<!--                        <br>-->
<!--                        Сегодня, 19:30-->
<!--                    </span>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="status second-status">-->
<!--                <span>-->
<!--                    <i class="icon-document-add"></i> Данные введены-->
<!--                </span>-->
<!--                <span>-->
<!--                    <i class="icon-document-update"></i> Изменено-->
<!--                </span>-->
<!--                <span  class="active">-->
<!--                    <i class="icon-document-check"></i> Согласовано-->
<!--                </span>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="actions__activity-indicators">-->
<!--            <div class="indicators-list">-->
<!--              <div class="title">Изменены показатели:</div>-->
<!--              <div class="list">-->
<!--                  <div class="item">2</div>-->
<!--                  <div class="item">7</div>-->
<!--                  <div class="item">8</div>-->
<!--                  <div class="item">11</div>-->
<!--                  <div class="item">12</div>-->
<!--                  <div class="item">13</div>-->
<!--                  <div class="item">14</div>-->
<!--                  <div class="item">16</div>-->
<!--                  <div class="item">17</div>-->
<!--                  <div class="item">18</div>-->
<!--                  <div class="item">24</div>-->
<!--                  <div class="item">25</div>-->
<!--                  <div class="item">26</div>-->
<!--                  <div class="item active">28</div>-->
<!--                  <div class="item">31</div>-->
<!--                  <div class="item">32</div>-->
<!--                  <div class="item">35</div>-->
<!--                  <div class="item">36</div>-->
<!--                  <div class="item">38</div>-->
<!--                  <div class="item">40</div>-->
<!--              </div>-->
<!--            </div>-->
<!--            <div class="indicator-description">-->
<!--              <b>28.</b> Доля организаций коммунального комплекса, осуществляющих производство товаров, оказание услуг по водо-, тепло-, газо-, электроснабжению, водоотведению, очистке сточных вод, утилизации (захоронению) твердых бытовых отходов и использующих объекты коммунальной инфраструктуры на праве частной собственности, по договору аренды или концессии, участие республики и (или) городского округа (муниципального района) в уставном капитале которых составляет не более 25,0%, в общем числе организаций коммунального комплекса, осуществляющих свою деятельность на территории городского округа (муниципального района)-->
<!--            </div>-->
<!--            <div class="indicator-comparison">-->
<!--              <div>Было: <b>17.2</b></div>-->
<!--              <div>Стало: <b>19.5</b></div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </div>-->

</div>

<div id="marksForJS" style="display: none">
    <?php foreach ($marks as $mark) { ?>
        <span class="mark">
            <span class="num"><?= $mark['num'] ?></span>
            <span id="description<?= $mark['num'] ?>"><?= $mark['name'] ?></span>
        </span>
    <?php } ?>
</div>

<script>
    let activities = document.querySelectorAll('.actions__info-item');

    activities.forEach((activity) => {
        activity.querySelectorAll('.indicators-list .item').forEach((mark) => {
            let num = mark.querySelector('.mark').innerHTML;
            let before = mark.querySelector('.before').innerHTML;
            let now = mark.querySelector('.now').innerHTML;
            mark.addEventListener('click', () => {
                activity.querySelector('.indicator-description').innerHTML = '<b>' + num + '.</b> ' + document.getElementById('description' + num).innerHTML;
                activity.querySelector('.indicator-comparison .before').innerHTML = before;
                activity.querySelector('.indicator-comparison .now').innerHTML = now;
            })
        })
    })
</script>