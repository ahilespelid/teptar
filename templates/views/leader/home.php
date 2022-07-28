<?php include $this->layout('leader/base/head.php'); ?>

    <body>

        <?php include $this->layout('leader/navbar.php'); ?>

        <div class="container">

            <div class="main">
                <?php include $this->layout('leader/navbar-responsive.php'); ?>
                <?php include $this->layout('leader/welcome.php'); ?>
                <?php include $this->layout('leader/districts.php'); ?>
                <?php include $this->layout('leader/rating.php'); ?>
                <?php include $this->layout('leader/comparison/home.php'); ?>
                <?php include $this->layout('leader/actions.php'); ?>
            </div>

        </div>

        <?php include $this->layout('leader/footer.php'); ?>

    </body>

<?php include $this->layout('leader/base/foot.php'); ?>
