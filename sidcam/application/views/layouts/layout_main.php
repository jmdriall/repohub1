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
<title>Pagina vacia</title>
<?php
echo link_tag(array('href' => base_url('resources/images/favico.ico'), 'rel' => 'shortcut icon', 'type' => 'image/x-icon'));
echo link_tag(array('href' => base_url('resources/css/style.css'), 'rel' => 'stylesheet', 'type' => 'text/css'));
?>
</head>
<body>
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
</body>
</html>