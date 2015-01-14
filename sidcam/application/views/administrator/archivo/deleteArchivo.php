<script language="JavaScript">
    function confirm_delete(archivo_id)
    {
        var answer = '<?php echo lang('backend_delete_confirm'); ?>';
        if ( confirm(answer) == true ){
            document.messages.submit();
        }
        return false;
    }
</script>
<!-- [Content] start -->
<h1><?php echo lang('backend_delete_archivo'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/archivo/index/'.$user_id, lang('backend_list_archivos'));?></li>
</ul>
<hr />

<p class="warning"><?php echo lang('backend_warning_message'); ?></p>
<?php echo form_open('administrator/archivo/deleteArchivo', array('class'=>'login')); ?>
<table width="80%" align="center" border="0" cellspacing="0" cellpadding="6">
    <tr>
        <td align="right"><strong><?php echo lang('backend_title'); ?>:</strong></td>
        <td>
            <?php
            echo $title;
            if ($title === '')
            {
                echo '---';
            }
            ?>
        </td>
    </tr>
    <tr>
        <td valign="top" align="right"><strong><?php echo lang('backend_archivo'); ?>:</strong></td>
        <td valign="top">
            <?php

            if ($picture != '' ) //and is_file($path)
            {
               echo $picture;
            }
            else
            {
                echo lang('backend_without_archivo');
            }
            ?>	</td>
    </tr>
    <tr>
        <td colspan="2" align="center">
    <?php
      echo form_hidden('subm_form', '1');
	  echo form_hidden('archivo_id', $archivo_id);
	  echo form_hidden('user_id', $user_id);
	  echo form_submit(array('id'=>'submit_button', 'name'=>'submit', 'value'=>lang('backend_delete'), 'onclick'=>"return confirm_delete('".$archivo_id."');"));
	  echo ' ';
	  echo form_button(array('name'=>'cancel', 'content'=>lang('backend_cancel'), 'id'=>'cancel_button','onclick'=>"javascript: window.location.href='".site_url('administrator/archivo/index/'.$user_id)."'"));
    ?>
    	</td>
    </tr>
</table>
<?php form_close(); ?>
<!-- [Content] end -->