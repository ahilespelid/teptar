<div class="actions">

    <div class="actions__reports">

        <div class="block-box block-title-box">
            <h3>Последние отчеты</h3>

            <div class="dropdowns-list">

                <?php if (isset($reportsType) && $reportsType == 'home') { ?>

                    <div class="dropdown interactive rounded right dark chevron district-reports">
                        <div class="current button button-dropdown rounded"><span class="title">Район:</span> <?= $district['owner'] ?></div>

                        <?php
                            $districtUrlParameters = $_GET;
                            unset($districtUrlParameters['district']);
                            $districtUrl = '';

                            if ($districtUrlParameters) {
                                foreach ($districtUrlParameters as $name => $value) {
                                    $districtUrl .= '&' . $name . '=' . $value;
                                }
                            } else {
                                $districtUrl = '&year=' . (new DateTime('now'))->format('Y');
                            }
                        ?>

                        <div class="options">
                            <?php foreach ($districts as $value) { ?>
                                <a href="<?= 'districtReports' . '?district=' . $value['slug'] . $districtUrl ?>" class="option"><?= $value['owner'] ?></a>
                            <?php } ?>
                        </div>
                    </div>

                <?php } ?>

                <div class="dropdown interactive rounded right dark chevron district-year-reports">
                    <div class="current button button-dropdown rounded"><?php echo (isset($_GET['year'])) ? $_GET['year'] : (new DateTime('now'))->format('Y'); ?></div>

                    <?php
                        $yearUrlParameters = $_GET;
                        unset($yearUrlParameters['year']);
                        $yearUrl = '/districtReports' . '?';

                        $i = 1;

                        if ($yearUrlParameters) {
                            foreach ($yearUrlParameters as $name => $value) {
                                $yearUrl .= $name . '=' . $value . '&';
                                $i += 1;
                            }
                        } else {
                            $yearUrl .= 'district=Grozny&';
                        }
                    ?>

                    <div class="options">
                        <a href="<?= $yearUrl . 'year=2022' ?>" class="option">2022</a>
                        <a href="<?= $yearUrl . 'year=2021' ?>" class="option">2021</a>
                        <a href="<?= $yearUrl . 'year=2020' ?>" class="option">2020</a>
                        <a href="<?= $yearUrl . 'year=2019' ?>" class="option">2019</a>
                        <a href="<?= $yearUrl . 'year=2018' ?>" class="option">2018</a>
                    </div>
                </div>
            </div>

        </div>

        <script>
            let districtReportsLinks = document.querySelectorAll('.district-reports .option');
            let districtYearReportsLinks = document.querySelectorAll('.district-year-reports .option');

            function updateData(event, link) {
                event.preventDefault();
                let contentBlock = document.querySelector('.actions__reports .actions__info');
                contentBlock.innerHTML = '<div class="actions_empty"><i class="spin icon-refresh"></i></div>';

                $.getJSON(link.href, (reports) => {
                    if (reports.length > 0) {
                        contentBlock.innerHTML = '';
                        reports.forEach((report) => {
                            let rating = '';

                            for (let i = 1; i <= 5; i++) {
                                if (i <= report.grade) {
                                    rating += '<i class="icon-star-fill"></i>';
                                } else {
                                    rating += '<i class="icon-star"></i>';
                                }
                            }

                            let block = `
                                    <div class="actions__info-item">
                                        <div class="actions__info-item-title">
                                            ${report.name}
                                            <div class="actions__reports-date"><i class="icon-document-check"></i> Отчет завершен: </div>
                                        </div>
                                        <div class="actions__reports-text">${report.description}</div>
                                        <div class="actions__reports-rating">
                                            ${rating}
                                        </div>
                                    </div>
                                `;

                            contentBlock.innerHTML += block;
                        });
                    } else {
                        contentBlock.innerHTML = '<div class="actions_empty">Отчетов по указанной дате пока нет</div>';
                    }
                });
            }

            districtReportsLinks.forEach((districtLink) => {
                districtLink.addEventListener('click', (event) => {
                    updateData(event, districtLink);

                    let districtURL = new URL(districtLink.href);
                    let newDistrict = districtURL.searchParams.get("district");
                    districtYearReportsLinks.forEach((yearLink) => {
                        let yearURL = new URL(yearLink.href);
                        let currentDistrict = yearURL.searchParams.get("district");
                        yearLink.href = yearLink.href.replace('district=' + currentDistrict, 'district=' + newDistrict)
                    });
                })
            });

            districtYearReportsLinks.forEach((yearLink) => {
                yearLink.addEventListener('click', (event) => {
                    updateData(event, yearLink);

                    let currentYear = document.querySelector('.district-year-reports .current').innerHTML;
                    districtReportsLinks.forEach((districtLink) => {
                        districtLink.href = districtLink.href.replace('year=' + currentYear, 'year=' + yearLink.innerHTML)
                    });
                })
            });
        </script>

        <div class="actions__info scrollable-box block-box sub-block-margin-top">

            <?php if (!$reports) { ?>
                <div class="actions_empty">Отчетов по указанной дате пока нет</div>
            <?php } ?>

            <?php foreach ($reports as $report) { ?>

                <div class="actions__info-item">
                    <div class="actions__info-item-title">
                        <?= $report['name'] ?>
                        <div class="actions__reports-date"><i class="icon-document-check"></i> Отчет завершен: <?= (new DateTime($report['submitting']))->format('d.m.o') ?></div>
                    </div>
                    <div class="actions__reports-text"><?= $report['description'] ?></div>
                    <div class="actions__reports-rating">
                        Оценка:
                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                            <?php if ($i <= $report['grade']) { ?>
                                <i class="icon-star-fill"></i>
                            <?php } else { ?>
                                <i class="icon-star"></i>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>

            <?php } ?>

        </div>

    </div>

    <div class="actions__activity">

        <div class="block-box block-title-box">
            <h3>Активность</h3>
        </div>

        <div class="actions__info scrollable-box block-box sub-block-margin-top">

            <div class="actions__info-item">

                <div class="actions__activity-info">
                    <div class="actions__activity-user">
                        <div class="avatar">
                            <img src="/assets/images/avatar.jpg" alt="Avatar">
                        </div>
                        <div class="info">
                            <span class="name">Ибрагим Грозный</span>
                            <span class="post">
                                Районный сотрудник
                                <br>
                                Сегодня, 19:30
                            </span>
                        </div>
                    </div>
                    <div class="status">
                        <span class="active">
                            <i class="icon-document-add"></i> Данные введены
                        </span>
                        <span>
                            <i class="icon-document-update"></i> Изменено
                        </span>
                        <span>
                            <i class="icon-document-check"></i> Не согласовано
                        </span>
                    </div>
                </div>

                <div class="actions__activity-content">
                    <div class="item">Сводная таблица заполнена</div>
                    <div class="item">Изминения: Введены 12 показателей</div>
                </div>

            </div>

            <div class="actions__info-item">

                <div class="actions__activity-info">
                    <div class="actions__activity-user">
                        <div class="avatar">
                            <img src="/assets/images/avatar.jpg" alt="Avatar">
                        </div>
                        <div class="info">
                            <span class="name">Ибрагим Грозный</span>
                            <span class="post">
                                Районный сотрудник
                                <br>
                                Сегодня, 19:30
                            </span>
                        </div>
                    </div>
                    <div class="status">
                        <span>
                            <i class="icon-document-add"></i> Данные введены
                        </span>
                        <span class="active">
                            <i class="icon-document-update"></i> Изменено
                        </span>
                        <span>
                            <i class="icon-document-check"></i> Не согласовано
                        </span>
                    </div>
                </div>

                <div class="actions__activity-indicators">
                    <div class="indicators-list">
                        <div class="title">Изменены показатели:</div>
                        <div class="list">
                            <div class="item">2</div>
                            <div class="item">7</div>
                            <div class="item">8</div>
                            <div class="item">11</div>
                            <div class="item">12</div>
                            <div class="item">13</div>
                            <div class="item">14</div>
                            <div class="item">16</div>
                            <div class="item">17</div>
                            <div class="item">18</div>
                            <div class="item">24</div>
                            <div class="item">25</div>
                            <div class="item">26</div>
                            <div class="item active">28</div>
                            <div class="item">31</div>
                            <div class="item">32</div>
                            <div class="item">35</div>
                            <div class="item">36</div>
                            <div class="item">38</div>
                            <div class="item">40</div>
                        </div>
                    </div>
                    <div class="indicator-description">
                        <b>28.</b> Доля организаций коммунального комплекса, осуществляющих производство товаров, оказание услуг по водо-, тепло-, газо-, электроснабжению, водоотведению, очистке сточных вод, утилизации (захоронению) твердых бытовых отходов и использующих объекты коммунальной инфраструктуры на праве частной собственности, по договору аренды или концессии, участие республики и (или) городского округа (муниципального района) в уставном капитале которых составляет не более 25,0%, в общем числе организаций коммунального комплекса, осуществляющих свою деятельность на территории городского округа (муниципального района)
                    </div>
                    <div class="indicator-comparison">
                        <div>Было: <b>17.2</b></div>
                        <div>Стало: <b>19.5</b></div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
