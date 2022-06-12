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

function translate($district) {

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

    return $districts[$district];
}

?>

<div class="comparison">

    <div class="block-box block-title-box break-title-dropdown">
        <h3>Сравнение показателей по Региону</h3>

        <div class="dropdown">
            <div class="current"><span class="title">Сравнение:</span> за предыдущий год</div>

            <div class="options">
                <span class="option">за предыдущий год</span>
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

            <div class="collapsible<?=$type;?>">

                <div class="collapsible-button block-background">
                    <?=$indicator['num'];?>. <?=$indicator['name'];?>
                    <div class="chevron">
                        <i class="icon-chevron-down"></i>
                    </div>
                </div>

                <div class="collapsible-content">
                    <div class="line-diagram-block">

                        <?php includeBlock($base . '/blocks/rating/district-rating.php', [
                                'title' => 'Показатель ' . $indicator['num'],
                                'mark_id' => $indicator['id']
                        ]) ?>

                        <div class="block-box block-title-box sub-block-margin-top">
                            <h3>График показателя</h3>
                        </div>

                        <div class="block-box sub-block-margin-top sub-block-margin-bottom block-padding">
                            <canvas id="DistrictLineChart<?=$indicator['id'];?>" style="max-height: 500px"></canvas>

                            <script>
                                let ctx<?=$indicator['id'];?> = document.getElementById('DistrictLineChart' + <?=$indicator['id'];?>).getContext('2d');

                                const DATA_COUNT<?=$indicator['id'];?> = 9;
                                const labels<?=$indicator['id'];?> = [];

                                for (let i = 0; i < DATA_COUNT<?=$indicator['id'];?>; ++i) {
                                    labels<?=$indicator['id'];?>.push(2014 + i);
                                }

                                const dataPoints<?=$indicator['id'];?> = [0.817, 0.854, 0.881, 0.892, 0.879, 0.882, 0.893, 0.899, 0.915];

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
                                                suggestedMin: 0.700,
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
