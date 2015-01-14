<!DOCTYPE HTML>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en-gb" class="no-js"> <!--<![endif]-->
<head>

    <meta http-equiv="content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SICAMB</title>
    <?php
    echo link_tag(array('href' => base_url('resources/images/favico.ico'), 'rel' => 'shortcut icon', 'type' => 'image/x-icon'));
    echo link_tag(array('href' => base_url('resources/css/bootstrap.min.css'), 'rel' => 'stylesheet', 'type' => 'text/css'));
    echo link_tag(array('href' => base_url('resources/css/bootstrap-theme.min.css'), 'rel' => 'stylesheet', 'type' => 'text/css'));
    echo link_tag(array('href' => base_url('resources/plugins/colorbox/colorbox.css'), 'rel' => 'stylesheet', 'type' => 'text/css'));
    echo link_tag(array('href' => base_url('resources/css/stylec.css'), 'rel' => 'stylesheet', 'type' => 'text/css'));
    echo link_tag(array('href' => base_url('resources/plugins/jquery-ui-1.9.2/css/ui-lightness/jquery-ui-1.9.2.custom.css'), 'rel' => 'stylesheet', 'type' => 'text/css'));
    ?>
    <script src="<?php echo base_url('resources/js/jquery-1.11.1.min.js'); ?>"></script>
</head>
<body>
<div id="main">
    <!--header starts-->
    <?php echo $this->load->view('include/header'); ?>
    <!--header ends-->

    <!--main starts-->
    <div id="main">
        <?php echo $content_for_layout; ?>
    </div>
    <!--main ends-->

    <!--footer starts-->
    <?php echo $this->load->view('include/footer'); ?>
    <!--footer ends-->
</div>
<script src="<?php echo base_url('resources/js/modernizr-2.6.2-respond-1.1.0.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/plugins/jquery-ui-1.9.2/js/jquery-ui-1.9.2.custom.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/main.js'); ?>"></script>
</body>
</html>