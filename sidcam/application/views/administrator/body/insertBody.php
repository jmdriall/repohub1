<h1><?php echo lang('backend_insert_body'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/body/index/'.$user_id, lang('backend_list_bodys'));?></li>
</ul>
<hr />

<?php echo form_open_multipart('administrator/body/insertBody', array('class'=>'cmxform', 'id'=>'insertform')); ?>
<table width="70%" align="center" border="0" cellspacing="6" cellpadding="0">
  <tr>
    <td align="right" valign="top"><strong>*<?php echo lang('backend_nombre'); ?>:</strong></td>
    <td><?php echo form_input('nombre', $this->input->post('nombre', TRUE),'size=70'); ?>
    	<?php echo form_error('nombre'); ?>
    </td>
  </tr>
      
  <tr>
   <td>&nbsp;</td>
   <td align="left">
<?php
	echo br();
    echo form_hidden('user_id',$user_id);
    echo form_submit(array('id' => 'submit_button', 'name' => 'insert', 'value' => lang('backend_save'), 'class' => 'input-submit'));
    echo ' ';
    echo form_button(array('id' => 'cancel_button', 'name' => 'cancel', 'content' => lang('backend_cancel'), 'onclick' => "javascript: window.location.href='".site_url('administrator/body/index/'.$user_id)."'"));
?>
   </td>
  </tr>
</table>
<?php form_close(); ?>
<!-- [Content] end -->