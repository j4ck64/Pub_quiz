<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PubQuiz</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>assets/script.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- https://stackoverflow.com/questions/12387392/on-click-of-same-button-open-model-and-then-submit-form -->
</head>

<body data-base="http://localhost/pub_quiz/">
    <!-- if the user is logged in the signout button will display -->
    <header>
        <div class="logo">LOGO</div>
        <nav>
            <ul class="navbar">
                <?php if ($this->session->userdata('logged_in')) : ?>
                    <li><a href="<?php echo base_url(); ?>users/logout">Sign Out</a></li>
                <?php endif; ?>
                <?php if (!$this->session->userdata('logged_in')) : ?>
                    <!-- <?php echo $this->session->userdata('logged_in') ?> -->
                    <li><a href="<?php echo base_url(); ?>users/login">Login</a></li>
                <?php endif; ?>
                <li><a href="<?php echo base_url() ?>Questions/index">Questions</a></li>
                <?php if ($this->session->userdata('admin')) : ?>
                    <li><a href="<?php echo base_url(); ?>Questions/browse">Admin</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="menu-toggle">
            <i class="fa fa-align-justify" aria-hidden="true"></i>
        </div>
    </header>
    </nav>


    <!-- Code for the hamburger activation -->
    <script type="text/javascript">
        $(document).ready(function() {
            $(".menu-toggle").click(function() {
                $("nav").toggleClass("active");
            })
            // my code for selecting all 
            // $("nav ul li a").click(function () {
            //   $("nav ul li a").toggleClass("active");
            // })
            ;

        });
    </script>

    </div>
    <div class="container">
        <!-- flash messages -->
        <?php if ($this->session->flashdata('login_failed')) : ?>
            <?php echo '<p class="alert alert-success">' . $this->session
                ->flashdata('login_failed') . '</p>'; ?>
        <?php endif; ?>
        <?php if ($this->session->flashdata('user_registered')) : ?>
            <?php echo '<p class="alert alert-success">' . $this->session
                ->flashdata('user_registered') . '</p>'; ?>
        <?php endif; ?>
        <?php if ($this->session->flashdata('user_loggedout')) : ?>
            <?php echo '<p class="alert alert-success">' . $this->session
                ->flashdata('user_loggedout') . '</p>'; ?>
        <?php endif; ?>
    </div>