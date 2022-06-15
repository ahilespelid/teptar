<?php

function includeBlock($filePath, $variables = array(), $print = true)
{
    $output = NULL;
    if(file_exists($filePath)){
        // Извлеките переменные в локальное пространство имен
        extract($variables);

        // Начать буферизацию вывода
        ob_start();

        // Включить файл шаблона
        include $filePath;

        // Завершить буферизацию и вернуть ее содержимое
        $output = ob_get_clean();
    }
    if ($print) {
        print $output;
    }
    return $output;

}

?>

<?php

$districts = [
    'Грозный' => 'Grozny',
    'Гудермесский' => 'Gudermessky',
    'Надтеречный' => 'Nadterechny',
    'Итум-Калинский' => 'ItumKalinsky',
    'Сунженский' => 'Sernovodsky',
    'Шатойский' => 'Shatoysky',
    'Урус-Мартановский' => 'UrusMartanovsky',
    'Грозненский' => 'Groznensky',
    'Наурский' => 'Naursky',
    'Ачхой-Мартановский' => 'AchkhoyMartanovsky',
    'Шалинский' => 'Shalinsky',
    'Шелковской' => 'Shelkovskoy',
    'Веденский' => 'Vedensky',
    'Аргун' => 'Argun',
    'Ножай-Юртовский' => 'NozhayYurtovsky',
    'Шаройский' => 'Sharoysky',
    'Курчалоевский' => 'Kurchaloevsky',
];

function translate($district) {

    return $GLOBALS['districts'][$district];
}

function getCyrillicDistrict($value) {
    $result = '';

    foreach ($GLOBALS['districts'] as $cyrillic => $latin) {
        if ($latin === $value) {
            $result = $cyrillic;
        }
    }

    return $result;
}

?>

<div class="comparison">

    <div class="block-box block-title-box break-title-dropdown">
        <h3>Сравнение показателей по Региону</h3>

        <div class="dropdown interactive rounded right dark chevron">
            <div class="current button button-dropdown rounded"><span class="title">Сравнение:</span> за предыдущий год</div>

            <div class="options">
                <a class="option">за предыдущий год</a>
            </div>
        </div>
    </div>

    <div class="block-box block-title-box sub-block-margin-top">
        <h3>Общие показатели</h3>
    </div>

    <div class="comparison__info">

        <?php
        $sql = 'SELECT * FROM marks';

        foreach($Connect->getAll($sql) as $indicator) {
        if ($indicator['type'] == 'description') {
            $type = ' muted';
        } elseif ($indicator['type'] == 'subparagraph') {
            $type = ' sub-collapsible';
        } else {
            $type = '';
        }
        ?>

            <div class="collapse-indicator<?=$type;?>">

                <div class="collapse-indicator-button block-background">
                    <?=$indicator['num'];?>. <?=$indicator['name'];?>
                    <div class="chevron">
                        <i class="icon-chevron-down"></i>
                    </div>
                </div>

                <div class="collapse-indicator-content">
                    <div class="line-diagram-block">

                        <?php includeBlock($base . '/blocks/rating/district-rating.php', [
                                'title' => 'Показатель ' . $indicator['num'],
                                'mark_id' => $indicator['id'],
                        ]) ?>

                        <div class="block-box block-title-box sub-block-margin-top">
                            <h3>График показателя</h3>
                        </div>

                        <div class="block-box sub-block-margin-top sub-block-margin-bottom block-padding">
                            <canvas id="DistrictLineChart<?=$indicator['id'];?>" style="max-height: 500px"></canvas>

                            <?php
                                $currentDistrictRating = $Connect->getRow('SELECT `index` FROM `indexes` WHERE mark=' . $indicator['id'] . ' AND district="'. getCyrillicDistrict($_GET['district']) .'"');
                                $districtRating = number_format((float)$currentDistrictRating['index'], 3, '.', '');
                            ?>

                            <script>
                                let ctx<?=$indicator['id'];?> = document.getElementById('DistrictLineChart' + <?=$indicator['id'];?>).getContext('2d');

                                const DATA_COUNT<?=$indicator['id'];?> = 9;
                                const labels<?=$indicator['id'];?> = [2019, 2020];

                                const dataPoints<?=$indicator['id'];?> = [<?= $districtRating ?>, <?= $districtRating ?>];

                                let gradient<?=$indicator['id'];?> = ctx<?=$indicator['id'];?>.createLinearGradient(0, 0, 0, 800);
                                gradient<?=$indicator['id'];?>.addColorStop(0, 'rgba(238, 67, 67,0.1)');
                                gradient<?=$indicator['id'];?>.addColorStop(1, 'rgb(238, 67, 67)');

                                const data<?=$indicator['id'];?> = {
                                    labels: labels<?=$indicator['id'];?>,
                                    datasets: [
                                        {
                                            label: 'Значение',
                                            data: dataPoints<?=$indicator['id'];?>,
                                            borderColor: '#60B251',
                                            pointBackgroundColor: '#60B251',
                                            backgroundColor: gradient<?=$indicator['id'];?>,
                                            fill: true,
                                            cubicInterpolationMode: 'monotone',
                                            tension: 0.4,
                                        }
                                    ]
                                }

                                const stackedLine<?=$indicator['id'];?> = new Chart(ctx<?=$indicator['id'];?>, {
                                    type: 'line',
                                    data: data<?=$indicator['id'];?>,
                                    options: {
                                        plugins: {
                                            legend: {
                                                display: false,
                                            }
                                        },
                                        responsive: true,
                                        interaction: {
                                            intersect: false,
                                        },
                                        scales: {
                                            x: {
                                                ticks: {
                                                    color: '#fff'
                                                }
                                            },
                                            y: {
                                                ticks: {
                                                    color: '#fff'
                                                },
                                                display: true,
                                                suggestedMin: 0.200,
                                                suggestedMax: 0.900,
                                                grid: {
                                                    color: 'rgba(255,255,255,0.1)',
                                                    borderDash: [8, 6]
                                                }
                                            }
                                        }
                                    },
                                });
                            </script>
                        </div>
                    </div>
                </div>

            </div>

        <?php } ?>

    </div>

</div>
