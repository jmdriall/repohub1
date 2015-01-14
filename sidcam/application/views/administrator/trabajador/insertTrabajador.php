
<h1><?php echo lang('backend_insert_trabajador'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/trabajador/index/'.$user_id,lang('backend_list_trabajadors'));?></li>
</ul>
<hr />

<?php echo form_open_multipart('administrator/trabajador/insertTrabajador', array('class'=>'cmxform', 'id'=>'insertform')); ?>
<table width="80%" align="center" border="0" cellspacing="0" cellpadding="6">
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_nombre'); ?>:</strong></td>
        <td><?php echo form_input('nombre', $this->input->post('nombre', TRUE), 'size=80'); ?>
            <?php echo form_error('nombre'); ?>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_apellidos'); ?>:</strong></td>
        <td><?php echo form_input('apellidos', $this->input->post('apellidos', TRUE), 'size=80'); ?>
            <?php echo form_error('apellidos'); ?>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_cargo'); ?>:</strong></td>
        <?php
        if($cargos){
             ?>
        <td>
            <select name="cargo_id" id="constrain">
            <?php foreach($cargos as $row){  ?>
                <option value="<?php echo $row->cargo_id; ?>"><?php echo $row->nombre; ?></option>
            <?php } ?>
            </select>
        </td>
        <?php } ?>
    </tr>
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_dni'); ?>:</strong></td>
        <td><?php echo form_input('dni', $this->input->post('dni', TRUE), 'size=80'); ?>
            <?php echo form_error('dni'); ?>
        </td>
    </tr>

    <tr>
        <td>&nbsp;</td>
        <td align="left">
<?php
    echo form_hidden('user_id', $user_id);
	echo br();
    echo form_submit(array('id' => 'submit_button', 'name' => 'insert', 'value' => lang('backend_save'), 'class' => 'input-submit'));
    echo ' ';
    echo form_button(array('id' => 'cancel_button', 'name' => 'cancel', 'content' => lang('backend_cancel'), 'onclick' => "javascript: window.location.href='".site_url('administrator/trabajador/index/'.$user_id)."'"));
?>
        </td>
    </tr>
</table>
<?php form_close(); ?>
<!-- [Content] end -->