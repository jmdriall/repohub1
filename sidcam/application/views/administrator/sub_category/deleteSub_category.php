<script language="JavaScript">
    function confirm_delete(sub_category_id)
    {
        var answer = '<?php echo lang('backend_delete_confirm'); ?>';
        if ( confirm(answer) == true ){
            document.messages.submit();
        }
        return false;
    }
</script>
<!-- [Content] start -->
<h1><?php echo lang('backend_delete_sub_category'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/sub_category/index/', lang('backend_list_sub_categorys'));?></li>
</ul>
<hr />

<p class="warning"><?php echo lang('backend_warning_message'); ?></p>
<?php echo form_open('administrator/sub_category/deleteSub_category', array('class'=>'login')); ?>
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
        <td valign="top" align="right"><strong><?php echo lang('backend_sub_category'); ?>:</strong></td>
        <td valign="top">
            <?php

            if ($picture != '' ) //and is_file($path)
            {
               echo $picture;
            }
            else
            {
                echo lang('backend_without_sub_category');
            }
            ?>	</td>
    </tr>
    <tr>
        <td colspan="2" align="center">
    <?php
      echo form_hidden('subm_form', '1');
	  echo form_hidden('sub_category_id', $sub_category_id);
	  echo form_hidden('category_id', $category_id);
	  echo form_submit(array('id'=>'submit_button', 'name'=>'submit', 'value'=>lang('backend_delete'), 'onclick'=>"return confirm_delete('".$sub_category_id."');"));
	  echo ' ';
	  echo form_button(array('name'=>'cancel', 'content'=>lang('backend_cancel'), 'id'=>'cancel_button','onclick'=>"javascript: window.location.href='".site_url('administrator/sub_category/index/'.$category_id)."'"));
    ?>
    	</td>
    </tr>
</table>
<?php form_close(); ?>
<!-- [Content] end -->