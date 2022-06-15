
<?php
/*/
require_once dirname(dirname(__DIR__))._DS_.'config/Db.php';
$Connect = new Db;
$base = dirname(getcwd());

$indexesSql = 'SELECT `index`, district FROM indexes WHERE mark=' . $mark_id . ' ORDER BY `index` DESC';
$indexes = $Connect->getAll($indexesSql);
//*/
?>

<div class="rating sub-block-margin-top">

    <div class="rating__regions block-box sub-block-margin-right">

        <ul>

            <?php if ($indexes) { ?>

                <?php foreach ($indexes as $key => $index) { ?>
                    <li><b><?= $key + 1 ?>.</b> <?= $index['district'] ?></li>
                <?php } ?>

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
            <h3><?= $title ?></h3>

            <a id="districtsRating" class="custom-anchor"></a>

            <div class="dropdown">
                <div class="current"><?php if (isset($_GET['ratingYear'])) { ?><?= $_GET['ratingYear'] ?><?php } else { ?>2020<?php } ?></div>

                <div class="options">
                    <span class="option"><a href="<?=$GLOBALS['path']['use']['in'];?>?ratingYear=2020#districtsRating">2020</a></span>
                </div>
            </div>
        </div>

        <div class="rating__diagram block-box sub-block-margin-top">

            <div class="rating__bars-diagram">

                <style>
                    .regions-list__bars {
                        height: calc(100% - 29px);
                    }
                    @media only screen and (max-width: 880px) {
                        .regions-list__bars {
                            height: calc(100% - 19px);
                        }
                    }
                </style>

                <ul class="rating-list">
                    <li><span>0.9</span></li>
                    <li><span>0.8</span></li>
                    <li><span>0.7</span></li>
                    <li><span>0.6</span></li>
                    <li><span>0.5</span></li>
                    <li><span>0.4</span></li>
                    <li><span>0.3</span></li>
                    <li><span>0.2</span></li>
                    <li><span>0.1</span></li>
                    <li><span>0</span></li>
                </ul>

                <div class="regions-list">
                    <div class="regions-list__bars">

                        <?php if ($indexes) { ?>

                            <?php foreach ($indexes as $key => $index) { ?>
                                <div class="regions-list__bar" style="height: calc(<?= $index['index'] ?> * 100% / 1)"><div class="regions-list__bar-gradient"><?php if ($_GET['district'] == translate($index['district'])) { ?><div class="current-district"><?= $index['district'] ?></div><?php } ?> <div class="regions-list__bar_info"><?= number_format((float)$index['index'], 2, '.', '') ?></div><span><?= $key + 1 ?></span></div></div>
                            <?php } ?>

                        <?php } else { ?>

                            <div class="regions-list__bar" style="height: calc(0.68 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.68</div><span>1</span></div></div>
                            <div class="regions-list__bar" style="height: calc(0.64 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.64</div><span>2</span></div></div>
                            <div class="regions-list__bar" style="height: calc(0.62 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.62</div><span>3</span></div></div>
                            <div class="regions-list__bar" style="height: calc(0.62 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.62</div><span>4</span></div></div>
                            <div class="regions-list__bar" style="height: calc(0.60 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.60</div><span>5</span></div></div>
                            <div class="regions-list__bar" style="height: calc(0.60 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.60</div><span>6</span></div></div>
                            <div class="regions-list__bar" style="height: calc(0.59 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.59</div><span>7</span></div></div>
                            <div class="regions-list__bar" style="height: calc(0.58 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.58</div><span>8</span></div></div>
                            <div class="regions-list__bar" style="height: calc(0.56 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.56</div><span>9</span></div></div>
                            <div class="regions-list__bar" style="height: calc(0.56 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.56</div><span>10</span></div></div>
                            <div class="regions-list__bar" style="height: calc(0.55 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.55</div><span>11</span></div></div>
                            <div class="regions-list__bar" style="height: calc(0.55 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.55</div><span>12</span></div></div>
                            <div class="regions-list__bar" style="height: calc(0.55 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.55</div><span>13</span></div></div>
                            <div class="regions-list__bar" style="height: calc(0.55 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.55</div><span>14</span></div></div>
                            <div class="regions-list__bar" style="height: calc(0.54 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.54</div><span>15</span></div></div>
                            <div class="regions-list__bar" style="height: calc(0.54 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.54</div><span>16</span></div></div>
                            <div class="regions-list__bar" style="height: calc(0.49 * 100% / 0.8)"><div class="regions-list__bar-gradient"><div class="regions-list__bar_info">0.49</div><span>17</span></div></div>

                        <?php } ?>

                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
