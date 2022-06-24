<?php include $this->layout('base/head.php') ?>

    <body>

        <style>
            body {
                font-family: 'Open Sans', serif;
                background: #ffffff;
            }

            h2 {
                margin: 30px 0;
                color: #000;
                font-weight: 700;
            }

            hr {
                border-bottom: 1px solid rgba(0,0,0,0.1);
                border-top: unset;
                border-right: unset;
                border-left: unset;
                margin: 16px 0;
            }

            .dark hr {
                border-bottom: 1px solid rgba(255,255,255,0.1);
            }

            .container {
                max-width: 1693px;
                margin: calc(100px + 24px) auto 24px;
            }

            .section {
                margin-bottom: 80px;
            }

            .section-block {
                padding: 30px;
                border: 1px solid #162131;
                border-radius: 12px 12px 0 0;
            }

            .section-block.dark {
                background: #162131;
                border-radius: 0 0 12px 12px;
            }

            .section-block h3 {
                margin-top: unset;
            }

            .section-block.dark h3 {
                color: white;
            }

            p.description {
                color: #222;
                font-size: 14px;
                margin: 20px 0;
            }

            p.description b {
                color: #2f2f2f;
            }

            p.description i {
                color: #2d5084;
            }
        </style>

        <div class="container">

            <div class="main">

                <?php include 'framework/collapse.php' ?>
                <?php include 'framework/dropdowns.php' ?>
                <?php include 'framework/buttons.php' ?>

            </div>

        </div>

    </body>

<?php include $this->layout('base/foot.php') ?>
