<?php echo doctype('xhtml1-trans');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
echo meta('Content-type', 'text/html; charset=utf-8', 'equiv');
echo meta('ROBOTS', 'NOFOLLOW, NOINDEX');
echo link_tag('resources/css/backend.css');
echo link_tag('resources/plugins/jquery-ui/css/smoothness/jquery-ui-1.8.18.custom.css');
echo link_tag('resources/plugins/tablesorter/style.css');
?>
<script type="text/javascript" src="<?php echo base_url('resources/js/backend/jquery-1.7.1.min.js'); ?>"></script>   	
<script type="text/javascript" src="<?php echo base_url('resources/plugins/jquery-ui/js/jquery-ui-1.8.18.custom.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('resources/plugins/tablesorter/jquery.tablesorter.min.js'); ?>"></script>

<script type="text/javascript">
	jQuery().ready(function(){
		$("#presentation").accordion({ header: "h3" });
	});
</script>

<title> <?php echo SITE_NAME; ?> | Administrator </title>
</head>
<body>
	<div id="margin_header_top">
    	<div id="header_top">
            <div id="user_welcome">
            	<?php
				$user_name = "Unknow";
				if( $this->session->userdata('login') != '' ){
	                $user_data = $this->user_model->getUserByLogin( $this->session->userdata('login') );
					$user_name = $user_data->lastname . ", " . $user_data->firstname;
				}
				?>
            	 <?php echo lang('backend_welcome'); ?>&nbsp;<?php echo anchor('administrator/user/detailUser/' . $user_data->user_id, $user_name); ?>
            </div>
            <div id="bar_menu">
            	<ul>
                	<li><?php echo anchor('home/index', lang('backend_view_live_site'), array("id" => "live_link", "target" =>"_blank" ) ); ?></li>
                    <li class="separator">&nbsp;</li>
             		<?php 
			 	   	if( false ){
				   	$total_contacts = $this->contact_model->getTotals();
				   	?>   
                    <li><?php echo anchor('administrator/contact/index', $total_contacts, array("id" => "contact_link") ); ?></li>
                    <li class="separator">&nbsp;</li>
            		 <?php } ?>       
                    
                    <?php
                    $total_users = $this->user_model->getTotalUsers();
					?>
                    <li><?php echo anchor('administrator/user/index', $total_users, array("id" => "user_link") ); ?></li>
                    <li class="separator">&nbsp;</li>
                    <li><?php echo anchor('administrator/login/logout', lang('backend_sign_out'), array("id" =>"signout_link" ) );?></li>
                </ul>
            </div>
            
        </div>
    
    </div>
    <div id="margin_header_bottom">
        <div id="header_bottom">
            <div id="logo">
            	<?php echo anchor('administrator/home/index', img('resources/images/backend/logo.jpg')); ?>
            </div>
            
            <div id="header_bottom_right">
            	
                <div id="menu">
                	
                    <div id="menu_left">
                    	<?php echo img(array('src'=>'resources/images/backend/menu_left.jpg'));?>
                    </div>
                    
                    <div id="menu_body">
                    	<ul>
                            <li><?php echo anchor('administrator/home/index', lang('backend_home'), array('class' => 'menu_item') ); ?></li>
                            <li><?php echo anchor('administrator/dbcontact/index', lang('backend_dbox_contact_us'), array('class' => 'menu_item') ); ?></li>
                            <li><a href="http://designboxweb.com/forum/viewforum.php?f=4" target="_blank" class="menu_item"><?php echo lang('backend_dbox_forum'); ?></a></li>
                            <li><?php echo anchor('administrator/help/index', lang('backend_dbox_help'), array('class' => 'menu_item') ); ?></li>
                            <?php
                            $string_second = $this->uri->segment(2);
							$string_third = $this->uri->segment(3);
							$string_fourth = $this->uri->segment(4);
							$string_fith = $this->uri->segment(5);
							$string_sixth = $this->uri->segment(6);
							$address_string = '/administrator/home/index';
							if( $string_second != '' )
							{
								$address_string = '/' . $string_second;
							}
							if( $string_third != '' )
							{
								$address_string .= '/' . $string_third;
							}
							if( $string_fourth != '' )
							{
								$address_string .= '/' . $string_fourth;
							}
							if( $string_fith != '' )
							{
								$address_string .= '/' . $string_fith;
							}
							if( $string_sixth != '' )
							{
								$address_string .= '/' . $string_sixth;
							}
							?>
                            <li>&nbsp;&nbsp; <?php echo anchor('sp/'.$address_string, img('resources/images/backend/lang_sp.gif')); ?></li>
                            <!--
                            <li>&laquo;&raquo;</li>
                            <li>&nbsp;&nbsp; <?php echo anchor('en/'.$address_string, img('resources/images/backend/lang_en.gif')); ?></li>-->
                        </ul>
                    </div>
                    
                    <div id="menu_right">
                    	<?php echo img('resources/images/backend/menu_right.jpg');?>
                    </div>
                </div>
                <div id="beta">
                	JMDRIALL Site Administrator
                </div>
            </div>
        </div>
    </div>
    <div id="margin_content">
        <div id="content">
            <?php echo $content_for_layout; ?>
        </div>
    </div>
    <div id="margin_footer">
        <div id="footer">
            <div id="footer_left">
            	<p><?php echo SITE_NAME; ?> Sites Administrator</p>
            </div>
            <div id="footer_right">
            	<p><?php echo anchor('http://www.google.com', 'JMDRIALL all rights reserved 2014', array('class'=>'link_dbox'));?></p>
            </div>
        </div>
    </div>
</body>
</html>
