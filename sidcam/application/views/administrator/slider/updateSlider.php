<!-- [Content] start -->
<h1><?php echo lang('backend_update_slider'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/slider/index', lang('backend_list_sliders'));?></li>
</ul>
<hr/>

<?php echo form_open_multipart('administrator/slider/updateSlider', array('class'=>'cmxform', 'id'=>'updateform')); ?>
<table align="center" width="80%" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td align="right" valign="top"><strong>*<?php echo lang('backend_title'); ?>:</strong></td>
    <td><?php echo form_input('slider_title', $slider_title,'size=70'); ?>
    	<?php echo form_error('slider_title'); ?>
    </td>
  </tr> 
  
  <tr>
    <td valign="top" align="right"><strong>*<?php echo lang('backend_picture'); ?>:</strong></td>
    <td valign="top">
		<?php
			$path = 'resources/media/slider/full/' . $slider_image;
			if( $slider_image != '' ) //and is_file($path)
			{
				echo img(array('src' => $path)).br();
			}
			else
			{
				echo lang('backend_without_picture');
			}
			echo form_upload(array('id' => 'slider_image', 'name' => 'slider_image',  'class' => 'input-submit'));
		?>
        <div class="warning">
            <?php echo $this->image_lib->display_errors(); ?>
            <?php echo $this->upload->display_errors(); ?>
        </div>
    </td>
  </tr>
  
  <tr style="display:none;">
    <td align="right" valign="top"><strong>*<?php echo lang('backend_description'); ?>:</strong></td>
    <td><?php echo form_textarea(array('id' => 'slider_description', 'name' => 'slider_description', 'rows' => '12', 'cols' => '48', 'value' => $slider_description)); ?>
    	<?php echo form_error('slider_description'); ?>
    </td>
  </tr>
  
  <tr>
   <td>&nbsp;</td>
   <td align="left">
   <?php
      echo br();
      echo form_hidden('slider_id', $slider_id);
      echo form_hidden('slider_image', $slider_image);
      echo form_hidden('update_form', '1');
	  echo form_submit(array('name'=>'edit', 'value'=>lang('backend_save'), 'id'=>'submit_button', 'class'=>'input-submit'));
	  echo ' ';
	  echo form_button(array('name'=>'cancel', 'content'=>lang('backend_cancel'), 'id'=>'cancel_button', 'class'=>'input-submit', 'onclick'=>"javascript: window.location.href='".site_url('administrator/slider/index')."'"));
   ?>
   </td>
  </tr>
</table>
<?php form_close(); ?>
<!-- [Content] end -->