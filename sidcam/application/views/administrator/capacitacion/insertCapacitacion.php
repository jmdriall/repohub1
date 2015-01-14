
<h1><?php echo lang('backend_insert_capacitacion'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/capacitacion/index/'.$user_id,lang('backend_list_capacitacions'));?></li>
</ul>
<hr />

<?php echo form_open_multipart('administrator/capacitacion/insertCapacitacion/'.$user_id, array('class'=>'cmxform', 'id'=>'insertform')); ?>
<table width="80%" align="center" border="0" cellspacing="0" cellpadding="6">
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_title'); ?>:</strong></td>
        <td><?php echo form_input('title', $this->input->post('title', TRUE), 'size=80'); ?>
            <?php echo form_error('title'); ?>
        </td>
    </tr>
    <tr style="display:none;">
        <td align="right" valign="top"><strong>*<?php echo lang('backend_description'); ?>:</strong></td>
        <td><?php echo form_textarea(array('id' => 'description', 'name' => 'description', 'rows' => '12', 'cols' => '52', 'value' => $this->input->post('description'))); ?>
            <?php echo form_error('description'); ?>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td align="left">
<?php
    echo form_hidden('user_id',$user_id);;
	echo br();
    echo form_submit(array('id' => 'submit_button', 'name' => 'insert', 'value' => lang('backend_save'), 'class' => 'input-submit'));
    echo ' ';
    echo form_button(array('id' => 'cancel_button', 'name' => 'cancel', 'content' => lang('backend_cancel'), 'onclick' => "javascript: window.location.href='".site_url('administrator/capacitacion/index/'.$user_id)."'"));
?>
        </td>
    </tr>
</table>
<?php form_close(); ?>
<!-- [Content] end -->