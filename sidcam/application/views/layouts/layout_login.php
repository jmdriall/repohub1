<?php echo doctype('xhtml1-trans');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php
	echo meta('Content-type', 'text/html; charset=utf-8', 'equiv');
    echo link_tag('resources/css/style.css');
	?>
    <title> :: <?php echo SITE_NAME; ?> | Login :: </title>
    <style>
        body, .login-submit, .login-submit:before, .login-submit:after {
            background: #373737 url("<?php echo base_url() ?>resources/images/bg.png") 0 0 repeat;
        }
        .login-button:after {
            content: '';
            position: absolute;
            top: 15px;
            left: 12px;
            width: 25px;
            height: 19px;
            background: url("<?php echo base_url() ?>resources/images/arrow.png") 0 0 no-repeat;
        }
    </style>
</head>
<body>
	<div id="margin_content">
    	<div id="content">
            <div id="content_left">

            </div>
            <div id="content_right">
                <?php echo $content_for_layout; ?>
            </div>
            
        </div>
    </div>
    <div id="margin_footer">
        <div id="footer">
            <div id="footer_left">
            	<p> Administrator</p>
            </div>
            <div id="footer_right">
            	<p><?php echo anchor('http://www.google.com', 'JMDRIALL all rights reserved 2014');?></p>
            </div>
        </div>
    </div>
</body>
</html>
