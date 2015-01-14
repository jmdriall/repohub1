<!-- [Content] start -->
<h1><?php echo lang('backend_update_body'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/body/index/'.$user_id, lang('backend_list_bodys'));?></li>
</ul>
<hr/>

<?php echo form_open_multipart('administrator/body/updateBody', array('class'=>'cmxform', 'id'=>'updateform')); ?>
<table align="center" width="80%" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td align="right" valign="top"><strong>*<?php echo lang('backend_nombre'); ?>:</strong></td>
    <td><?php echo form_input('nombre', $nombre,'size=70'); ?>
    	<?php echo form_error('nombre'); ?>
    </td>
  </tr>
  <tr>
   <td>&nbsp;</td>
   <td align="left">
   <?php
      echo br();
      echo form_hidden('body_id', $body_id);
      echo form_hidden('user_id', $user_id);
      echo form_hidden('update_form', '1');
	  echo form_submit(array('name'=>'edit', 'value'=>lang('backend_save'), 'id'=>'submit_button', 'class'=>'input-submit'));
	  echo ' ';
	  echo form_button(array('name'=>'cancel', 'content'=>lang('backend_cancel'), 'id'=>'cancel_button', 'class'=>'input-submit', 'onclick'=>"javascript: window.location.href='".site_url('administrator/body/index/'.$user_id)."'"));
   ?>
   </td>
  </tr>
</table>
<?php form_close(); ?>
<!-- [Content] end -->