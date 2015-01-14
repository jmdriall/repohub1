<script language="JavaScript">
	function confirm_delete()
	{
		var answer = '<?php echo lang('backend_delete_confirm'); ?>';
		if ( confirm(answer) == true ){
			return true;
		}
		return false;  
	}
</script> 
<!-- [Content] start -->
<h1><?php echo lang('backend_delete_user'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/user/index', lang('backend_list_users'));?></li>
</ul>
<hr />
 <p class="warning"><?php echo lang('backend_warning_message'); ?></p>
<?php echo form_open('administrator/user/deleteUser',array('id'=>'form1', 'class'=>'login')); ?>
<table width="60%" align="center" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td align="right" valign="top"><strong><?php echo lang('backend_firstname'); ?>:</strong></td>
    <td align="left">
	<?php
    echo $firstname;
	if ($firstname === '')
	{
		echo '---';
	}
	?>
    </td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong><?php echo lang('backend_lastname'); ?>:</strong></td>
    <td align="left">
	<?php
    echo $lastname;
	if ($lastname === '')
	{
		echo '---';
	}
	?>
    </td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong><?php echo lang('backend_email'); ?>:</strong></td>
    <td align="left">
	<?php
    echo $email;
	if ($email === '')
	{
		echo '---';
	}
	?>
    </td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong><?php echo lang('backend_login'); ?>:</strong></td>
    <td align="left">
	<?php
    echo $login;
	if ($login === '')
	{
		echo '---';
	}
	?>
    </td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong><?php echo lang('backend_password'); ?>:</strong></td>
    <td align="left">
	<?php
    echo $password;
	if ($password === '')
	{
		echo '---';
	}
	?>
    </td>
  </tr>
	<tr>
		<td colspan="2" align="center">
        	<br />
            <?php
			echo form_hidden('subm_form', '1');
			echo form_hidden('user_id', $user_id);
			echo form_submit(array('name'=>'submit', 'value'=>lang('backend_delete'), 'id'=>'submit_button','onclick'=>'return confirm_delete()'));
			echo ' ';
			echo form_button(array('name'=>'cancel', 'content'=>lang('backend_cancel'), 'id'=>'cancel_button','onclick'=>"javascript: window.location.href='".site_url('administrator/user/index')."'"));
			?>
		</td>
    </tr>
</table>
<?php echo form_close();?>

<!-- [Content] end -->
