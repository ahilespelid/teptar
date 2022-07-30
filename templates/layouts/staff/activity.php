<div class="actions__info block-box sub-block-margin-top">

    <?php foreach ($activities as $activity) { ?>

        <div class="actions__info-item">

            <div class="actions__activity-info">
                <div class="actions__activity-user">
                    <div class="avatar">
                        <img src="<?= $activity['avatar'] ?? $this->security->setEmptyAvatar() ?>" alt="Avatar">
                    </div>
                    <div class="info">
                        <span class="name"><?= $activity['firstname'] ?> <?= $activity['lastname'] ?> <?= $activity['secondname'] ?></span>
                        <span class="post">
                            <?= $activity['post'] ?>
                            <br>
                            <?= $activity['date'] ?>
                        </span>
                    </div>
                </div>
                <div class="status second-status">
                    <span>
                        <i class="icon-document-add"></i> Данные введены
                    </span>
                    <span<?php if ($activity['status'] == 5) { echo 'class=" active"'; } ?>>
                        <i class="icon-document-update"></i> Изменено
                    </span>
                    <span<?php if ($activity['status'] == 6) { echo 'class=" active"'; } ?>>
                        <i class="icon-document-check"></i> Согласовано
                    </span>
                </div>
            </div>

            <div class="actions__activity-indicators">
                <div class="indicators-list">
                    <div class="title">Изменены показатели:</div>
                    <div class="list">
                        <?php foreach ($activity['marks'] as $mark) { ?>
                            <div class="item">
                                <span class="mark"><?= $mark['mark'] ?></span>
                                <span class="id">ID: <?= $mark['test'] ?></span>
                                <span class="before" style="display: none"><?= $mark['before'] ?></span>
                                <span class="now" style="display: none"><?= $mark['now'] ?></span>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="indicator-description">
                  <b><?= $activity['marks'][0]['mark'] ?>.</b> Число субъектов малого и среднего предпринимательства в расчете на 10 тыс. человек населения (ед).
                </div>
                <div class="indicator-comparison">
                  <div>Было: <b class="before"><?= $activity['marks'][0]['before'] ?></b></div>
                  <div>Стало: <b class="now"><?= $activity['marks'][0]['now'] ?></b></div>
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
