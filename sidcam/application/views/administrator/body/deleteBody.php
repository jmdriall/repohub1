<script language="JavaScript">
function confirm_delete(body_id)
{
	var answer = '<?php echo lang('backend_delete_confirm'); ?>';
    if ( confirm(answer) == true ){
        document.messages.submit();
    }
    return false;  
}
</script>

<!-- [Content] start -->
<h1><?php echo lang('backend_delete_body'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/body/index/'.$user_id, lang('backend_list_bodys'));?></li>
</ul>
<hr/>

<p class="warning"><?php echo lang('backend_warning_message'); ?></p>
<?php echo form_open('administrator/body/deleteBody', array('class'=>'login')); ?>
<table width="80%" align="center" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td align="right"><strong><?php echo lang('backend_nombre'); ?>:</strong></td>
    <td>
    <?php
      echo $nombre;
      if ($nombre === '')
      {
        echo '---';
      }
    ?>
    </td>
  </tr>
  

  

  
  <tr>
  	<td>&nbsp;</td>
    <td align="left">
    <?php
      echo form_hidden('subm_form', '1');
	  echo form_hidden('body_id', $body_id);
      echo form_hidden('user_id', $user_id);
	  echo form_submit(array('name'=>'submit', 'value'=>lang('backend_delete'), 'id'=>'submit_button'));
	  echo ' ';
	  echo form_button(array('name'=>'cancel', 'content'=>lang('backend_cancel'), 'id'=>'cancel_button','onclick'=>"javascript: window.location.href='".site_url('administrator/body/index/'.$user_id)."'"));
    ?>
   </td>
  </tr>
</table>
<?php form_close(); ?>
<!-- [Content] end -->