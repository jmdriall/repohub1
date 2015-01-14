
<h1><?php echo lang('backend_insert_actividad'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/actividad/index/'.$especifico_id."/".$user_id,lang('backend_list_actividads'));?></li>
</ul>
<hr />

<?php echo form_open_multipart('administrator/actividad/insertActividad/'.$especifico_id."/".$user_id, array('class'=>'cmxform', 'id'=>'insertform')); ?>
<table width="80%" align="center" border="0" cellspacing="0" cellpadding="6">
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_nombre'); ?>:</strong></td>
        <td><?php echo form_input('nombre', $this->input->post('nombre', TRUE), 'size=80'); ?>
            <?php echo form_error('nombre'); ?>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_requisito_legal'); ?>:</strong></td>
        <td><?php echo form_input('requisito_legal', $this->input->post('requisito_legal', TRUE), 'size=80'); ?>
            <?php echo form_error('requisito_legal'); ?>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_prioridad'); ?>:</strong></td>
        <td>
            <?php echo "<strong>valores del 1-3</strong>".br() ?>
            <?php echo form_input('prioridad', $this->input->post('prioridad', TRUE), 'size=80',array('type'=>'number'));
            if($valid == 1){
                echo "<strong style='color: red'> Solo numeros </strong>";
            }
            if($valid == 2){
                echo "<strong style='color: red'> Solo numeros de 1-3 </strong>";
            }
            ?>

            <?php echo form_error('prioridad'); ?>
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
    echo form_hidden('user_id',$user_id);
    echo form_hidden('especifico_id',$especifico_id);
    echo form_hidden('valid', $valid);
	echo br();
    echo form_submit(array('id' => 'submit_button', 'name' => 'insert', 'value' => lang('backend_save'), 'class' => 'input-submit'));
    echo ' ';
    echo form_button(array('id' => 'cancel_button', 'name' => 'cancel', 'content' => lang('backend_cancel'), 'onclick' => "javascript: window.location.href='".site_url('administrator/actividad/index/'.$especifico_id.'/'.$user_id)."'"));
?>
        </td>
    </tr>
</table>
<?php form_close(); ?>
<!-- [Content] end -->