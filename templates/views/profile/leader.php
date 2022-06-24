<?php include $this->layout('base/head.php'); ?>

    <body>

    <?php include $this->layout('navbar/navbar.php'); ?>

        <div class="container">

            <div class="main">

<!--                --><?php //include $this->layout('navbar/responsive-pages.php'); ?>

                <div class="grid-block">
                    <div class="grid-block-main">
                        <div class="media">
                            <div class="avatar" style="background-image: url('<?= $this->image('/assets/images/avatar.jpg'); ?>')"></div>
                        </div>
                        <span class="title"><?= $user['full_name']; ?></span>
                        <span class="muted">Глава Чеченской Республики</span>
                        <span class="muted"><i class="icon-pin"></i> Грозный, Российская Федерация</span>
                        <span class="social">
                            <a href=""><i class="icon-instagram"></i></a>
                            <a href="https://t.me/RKadyrov_95"><i class="icon-telegram"></i></a>
                            <a href="https://vk.com/ramzan"><i class="icon-vk"></i></a>
                        </span>
                    </div>
                    <div class="data">
                        <div class="item">
                            <div class="content">
                                <span>Дата рождения</span>
                                <span>5 октября 1976 г.</span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="content">
                                <span>Дата вступления в должность</span>
                                <span>5 апреля 2011 г.</span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="content">
                                <span>Учёная степень</span>
                                <span>Доктор экономических наук</span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="content">
                                <span>Звание</span>
                                <span>Генерал-лейтенант</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="profile-bio block-margin-top">
                    <div class="block-box block-title-box">
                        <h3>Краткая биография</h3>
                    </div>

                    <div class="block-box block-padding content-box sub-block-margin-top">
                        <p>
                            Глава Чеченской Республики с 2011 года (президент ЧР с 2007 года), член бюро высшего совета партии "Единая Россия" с 2007 года. Ранее - исполняющий обязанности президента Чечни (2007 год), премьер-министр правительства Чечни (2006-2007 годы). Долгое время возглавлял службу безопасности своего отца, президента Чечни Ахмада Кадырова (погиб в результате теракта), участвовал в операциях по ликвидации боевиков. Является почетным гражданином Чечни и заслуженным работником физической культуры республики. Мастер спорта по боксу. Имеет специальное звание генерал-майора милиции.
                        </p>
                        <p>
                            После смерти отца сын не смог стать приемником поста. На тот момент ему еще не исполнилось 30 лет (было только 28 лет). Парламент направил просьбу президенту России сократить возраст, но в ответ получен официальный отказ.
                        </p>
                        <p>
                            В 2004 году Кадыров назначен вице-премьером Чечни. Годом позднее Рамзан стал советником президента РФ по ЮФО, отвечал за боевые действия на территории страны. Одновременно возглавил спортивный клуб «Рамзан», ФК «Терек», Лигу КВН Чеченской Республики, Фонд Ахмата Кадырова.
                        </p>
                        <p>
                            В ноябре 2005 года Рамзан стал руководителем республиканского правительства. В 2006 официально назначен секретарем регионального представительства партии «Единая Россия», всецело разделял политику действующего президента РФ Владимира Путина. Продолжает поддерживать его и сегодня.
                        </p>
                    </div>

                </div>

            </div>

        </div>

    <?php include $this->layout('footer/footer.php'); ?>

    </body>

<?php include $this->layout('base/foot.php'); ?>
