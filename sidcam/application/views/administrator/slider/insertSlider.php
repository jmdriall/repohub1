<h1><?php echo lang('backend_insert_slider'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/slider/index', lang('backend_list_sliders'));?></li>
</ul>
<hr />

<?php echo form_open_multipart('administrator/slider/insertSlider', array('class'=>'cmxform', 'id'=>'insertform')); ?>
<table width="70%" align="center" border="0" cellspacing="6" cellpadding="0">
  <tr>
    <td align="right" valign="top"><strong>*<?php echo lang('backend_title'); ?>:</strong></td>
    <td><?php echo form_input('slider_title', $this->input->post('slider_title', TRUE),'size=70'); ?>
    	<?php echo form_error('slider_title'); ?>
    </td>
  </tr> 
  
  <tr>
    <td valign="top" align="right"><strong>*<?php echo lang('backend_picture'); ?>:</strong></td>
    <td><?php echo form_upload('slider_image', 'size=80'); ?>
    	<div class="warning">
			<?php echo $this->image_lib->display_errors(); ?>
	        <?php echo $this->upload->display_errors(); ?>
      </div>
    </td>
  </tr>
  
  <tr style="display:none;">
    <td align="right" valign="top"><strong>*<?php echo lang('backend_description'); ?>:</strong></td>
    <td><?php echo form_textarea(array('id' => 'slider_description', 'name' => 'slider_description', 'rows' => '12', 'cols' => '48', 'value' => $this->input->post('slider_description'))); ?>
    	<?php echo form_error('slider_description'); ?>
    </td>
  </tr>
      
  <tr>
   <td>&nbsp;</td>
   <td align="left">
<?php
	echo br();
    echo form_submit(array('id' => 'submit_button', 'name' => 'insert', 'value' => lang('backend_save'), 'class' => 'input-submit'));
    echo ' ';
    echo form_button(array('id' => 'cancel_button', 'name' => 'cancel', 'content' => lang('backend_cancel'), 'onclick' => "javascript: window.location.href='".site_url('administrator/slider/index')."'"));
?>
   </td>
  </tr>
</table>
<?php form_close(); ?>
<!-- [Content] end -->