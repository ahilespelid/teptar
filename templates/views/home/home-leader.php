<?php include $this->layout('base/head.php'); ?>

    <body>

        <?php include $this->layout('navbar.php'); ?>

        <div class="container">

            <div class="main">
                <?php include $this->layout('navbar-responsive.php'); ?>
                <?php include $this->layout('welcome.php'); ?>
                <?php include $this->layout('districts.php'); ?>
                <?php include $this->layout('rating/rating.php'); ?>
<!--                --><?php //include $this->layout('comparison/comparison.php'); ?>
                <?php include $this->layout('actions.php'); ?>
            </div>

        </div>

        <?php include $this->layout('footer.php'); ?>

    </body>

<?php include $this->layout('base/foot.php'); ?>
