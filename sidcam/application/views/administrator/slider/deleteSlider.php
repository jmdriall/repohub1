<script language="JavaScript">
function confirm_delete(slider_id)
{
	var answer = '<?php echo lang('backend_delete_confirm'); ?>';
    if ( confirm(answer) == true ){
        document.messages.submit();
    }
    return false;  
}
</script>

<!-- [Content] start -->
<h1><?php echo lang('backend_delete_slider'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/slider/index', lang('backend_list_sliders'));?></li>
</ul>
<hr/>

<p class="warning"><?php echo lang('backend_warning_message'); ?></p>
<?php echo form_open('administrator/slider/deleteSlider', array('class'=>'login')); ?>
<table width="80%" align="center" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td align="right"><strong><?php echo lang('backend_title'); ?>:</strong></td>
    <td>
    <?php
      echo $slider_title;
      if ($slider_title === '')
      {
        echo '---';
      }
    ?>
    </td>
  </tr>
  
  <tr>
    <td valign="top" align="right"><strong><?php echo lang('backend_picture'); ?>:</strong></td>
    <td valign="top">
    <?php
      $path = base_url() . 'resources/media/slider/full/' . $slider_image;
      if ($slider_image != '' ) //and is_file($path)
      {
      ?>
      	<img src="<?php echo $path; ?>" /><br /><br />
      <?php
      }
      else
      {
        echo lang('backend_without_picture');
      }
    ?>
    </td>
  </tr>
  
  <tr style="display:none;">
    <td align="right"><strong><?php echo lang('backend_description'); ?>:</strong></td>
    <td>
    <?php
      echo $slider_description;
      if ($slider_description === '')
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
	  echo form_hidden('slider_id', $slider_id);
	  echo form_submit(array('name'=>'submit', 'value'=>lang('backend_delete'), 'id'=>'submit_button'));
	  echo ' ';
	  echo form_button(array('name'=>'cancel', 'content'=>lang('backend_cancel'), 'id'=>'cancel_button','onclick'=>"javascript: window.location.href='".site_url('administrator/slider/index')."'"));
    ?>
   </td>
  </tr>
</table>
<?php form_close(); ?>
<!-- [Content] end -->