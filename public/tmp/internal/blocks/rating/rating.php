<div class="rating">

    <div class="rating__regions block-box sub-block-margin-right">

        <ul>
            <?php if (isset($_GET['ratingYear']) && $_GET['ratingYear'] == '2019') { ?>

                <li><b>1.</b> Итум-Калинский</li>
                <li><b>2.</b> Урус-Мартановский</li>
                <li><b>3.</b> Аргун</li>
                <li><b>4.</b> Серноводский</li>
                <li><b>5.</b> Веденский</li>
                <li><b>6.</b> Курчалоевский</li>
                <li><b>7.</b> Грозный</li>
                <li><b>8.</b> Гудермесский</li>
                <li><b>9.</b> Шалинский</li>
                <li><b>10.</b> Грозненский</li>
                <li><b>11.</b> Наурский</li>
                <li><b>12.</b> Надтеречный</li>
                <li><b>13.</b> Шелковской</li>
                <li><b>14.</b> Ачхой-Мартановский</li>
                <li><b>15.</b> Ножай-Юртовский</li>
                <li><b>16.</b> Шаройский</li>
                <li><b>17.</b> Шатойский</li>

            <?php } else { ?>

                <li><b>1.</b> Аргун</li>
                <li><b>2.</b> Грозный</li>
                <li><b>3.</b> Шелковской</li>
                <li><b>4.</b> Серноводский</li>
                <li><b>5.</b> Итум-Калинский</li>
                <li><b>6.</b> Наурский</li>
                <li><b>7.</b> Курчалоевский</li>
                <li><b>8.</b> Надтеречный</li>
                <li><b>9.</b> Веденский</li>
                <li><b>10.</b> Грозненский</li>
                <li><b>11.</b> Гудермесский</li>
                <li><b>12.</b> Ачхой-Мартановский</li>
                <li><b>13.</b> Урус-Мартановский</li>
                <li><b>14.</b> Шалинский</li>
                <li><b>15.</b> Шаройский</li>
                <li><b>16.</b> Шатойский</li>
                <li><b>17.</b> Ножай-Юртовский</li>

            <?php } ?>
        </ul>
    </div>

    <div class="rating__info">

        <div class="block-box block-title-box">
            <h3>Общий рейтинг</h3>

            <a id="districtsRating" class="custom-anchor"></a>

            <div class="dropdown interactive rounded right dark chevron">
                <div class="current button button-dropdown rounded"><?php if (isset($_GET['ratingYear'])) { ?><?= $_GET['ratingYear'] ?><?php } else { ?>2020<?php } ?></div>

                <div class="options">
                    <a class="option" href="?ratingYear=2020#districtsRating">2020</a>
                    <a class="option" href="?ratingYear=2019#districtsRating">2019</a>
                </div>
            </div>

        </div>

        <div class="rating__diagram block-box sub-block-margin-top">

            <canvas id="overallRating" style="max-height: 420px"></canvas>

            <?php if (isset($_GET['ratingYear']) && $_GET['ratingYear'] == '2019') { ?>
                <script>
                    const overallRatingDataPoints = [0.65, 0.62, 0.61, 0.61, 0.58, 0.56, 0.55, 0.55, 0.55, 0.54, 0.54, 0.53, 0.53, 0.52, 0.52, 0.52, 0.49];
                </script>
            <?php } else { ?>
                <script>
                    const overallRatingDataPoints = [0.68, 0.64, 0.62, 0.62, 0.60, 0.60, 0.59, 0.58, 0.56, 0.56, 0.55, 0.55, 0.55, 0.55, 0.54, 0.54, 0.48];
                </script>
            <?php } ?>

            <script>
                let overallRatingCtx = document.getElementById('overallRating').getContext('2d');

                const OVERALL_RATING_DATA_COUNT = 17;
                const overallRatingLabels = [];

                for (let i = 0; i < OVERALL_RATING_DATA_COUNT; ++i) {
                    overallRatingLabels.push(1 + i);
                }

                let overallRatingBackgroundColors = [];
                let i = 100;

                function hslOverallRatingColor(percent, start, end) {
                    var a = percent / 100,
                        b = (end - start) * a,
                        c = b + start;

                    return 'hsl('+c+', 60%, 56%)';
                }

                overallRatingDataPoints.forEach(function () {
                    overallRatingBackgroundColors.push(hslOverallRatingColor(i,0,120));
                    i = i - 6;
                });

                const overallRatingData = {
                    labels: overallRatingLabels,
                    datasets: [
                        {
                            label: 'Значение',
                            data: overallRatingDataPoints,
                            borderColor: '#60B251',
                            pointBackgroundColor: '#60B251',
                            backgroundColor: overallRatingBackgroundColors,
                            fill: true,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.4,
                            borderRadius: 12,
                        }
                    ]
                }

                const overallRatingStackedLine = new Chart(overallRatingCtx, {
                    type: 'bar',
                    data: overallRatingData,
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
                                suggestedMin: 0.4,
                                suggestedMax: 0.8,
                                grid: {
                                    color: 'rgba(255,255,255,0.1)',
                                    borderDash: [8, 6]
                                }
                            }
                        }
                    },
                });
            </script>

<!--            <div class="rating__bars-diagram">-->
<!---->
<!--                <style>-->
<!--                    .regions-list__bars {-->
<!--                        height: calc(100% - 41px);-->
<!--                    }-->
<!--                </style>-->
<!---->
<!--                <ul class="rating-list">-->
<!--                    <li><span>0.7</span></li>-->
<!--                    <li><span>0.6</span></li>-->
<!--                    <li><span>0.5</span></li>-->
<!--                    <li><span>0.4</span></li>-->
<!--                    <li><span>0.3</span></li>-->
<!--                    <li><span>0.2</span></li>-->
<!--                    <li><span>0.1</span></li>-->
<!--                    <li><span>0</span></li>-->
<!--                </ul>-->
<!---->
<!--                --><?php //if (isset($_GET['ratingYear']) && $_GET['ratingYear'] == '2019') { ?>
<!---->
<!--                    <div class="regions-list">-->
<!--                        <div class="regions-list__bars">-->
<!---->
<!--                            <div class="regions-list__bar" style="height: calc(0.65 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.65</div><span>1</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.62 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.62</div><span>2</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.61 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.61</div><span>3</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.61 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.61</div><span>4</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.58 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.58</div><span>5</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.56 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.56</div><span>6</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.55 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.55</div><span>7</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.55 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.55</div><span>8</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.55 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.55</div><span>9</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.54 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.54</div><span>10</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.54 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.54</div><span>11</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.53 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.53</div><span>12</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.53 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.53</div><span>13</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.52 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.52</div><span>14</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.52 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.52</div><span>15</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.52 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.52</div><span>16</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.49 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.49</div><span>17</span></div></div>-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                --><?php //} else { ?>
<!---->
<!--                    <div class="regions-list">-->
<!--                        <div class="regions-list__bars">-->
<!---->
<!--                            <div class="regions-list__bar" style="height: calc(0.68 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.68</div><span>1</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.64 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.64</div><span>2</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.62 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.62</div><span>3</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.62 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.62</div><span>4</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.60 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.60</div><span>5</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.60 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.60</div><span>6</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.59 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.59</div><span>7</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.58 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.58</div><span>8</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.56 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.56</div><span>9</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.56 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.56</div><span>10</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.55 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.55</div><span>11</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.55 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.55</div><span>12</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.55 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.55</div><span>13</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.55 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.55</div><span>14</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.54 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.54</div><span>15</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.54 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.54</div><span>16</span></div></div>-->
<!--                            <div class="regions-list__bar" style="height: calc(0.49 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.49</div><span>17</span></div></div>-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                --><?php //} ?>
<!---->
<!--            </div>-->

        </div>

    </div>

</div>
