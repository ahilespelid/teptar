<?php include $this->layout('base/head.php'); ?>

    <body>

        <?php include $this->layout('navbar/navbar.php'); ?>

        <div class="container">

            <div class="main">
                <?php include $this->layout('navbar/responsive-home.php'); ?>
                <?php include $this->layout('welcome/welcome.php'); ?>
                <?php include $this->layout('districts/districts.php'); ?>
                <?php include $this->layout('rating/rating.php'); ?>
<!--                --><?php //include $this->layout('comparison/comparison.php'); ?>
                <?php include $this->layout('actions/actions.php'); ?>
            </div>

        </div>

        <?php include $this->layout('footer/footer.php'); ?>

    </body>

<?php include $this->layout('base/foot.php'); ?>
