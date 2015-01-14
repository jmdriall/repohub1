<div class="container mar-top-15">
    <h1 class="text-center"><?php echo lang('backend_insert_trabajador'); ?></h1>
    <?php echo form_open_multipart('client/indicadores/updateTrabajador', array('class'=>'cmxform', 'id'=>'updateform')); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-2"><p><strong>*<?php echo lang('backend_nombre'); ?>:</strong></p></div>
                <div class="col-xs-6"><p><?php echo form_input(array('name'=>'nombre', 'value'=>$nombre, 'size'=>'80', 'class'=>'form-control')); ?>
                        <span class="alerta"><?php echo form_error('nombre'); ?></span></p></div>
                <div class="col-xs-4"></div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-2"><p><strong>*Apellidos:</strong></p></div>
                <div class="col-xs-6"><p><?php echo form_input(array('name'=>'apellidos', 'value'=>$apellidos, 'size'=>'80', 'class'=>'form-control')); ?>
                        <span class="alerta"><?php echo form_error('apellidos'); ?></span></p></div>
                <div class="col-xs-4"></div>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-2"><p><strong>*<?php echo lang('backend_cargo'); ?>:</strong></p></div>
                <div class="col-xs-6">
                    <?php
                    if($cargos){
                        ?>
                        <td>
                            <select name="cargo_id" id="constrain" class="form-control" style="width: auto">
                                <?php foreach($cargos as $row){  ?>
                                    <option value="<?php echo $row->cargo_id; ?>" <?php if($row->cargo_id == $cargo_id){echo "selected";} ?>><?php echo $row->nombre; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    <?php } ?>
                </div>
                <div class="col-xs-4"></div>
            </div>
        </div>


        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-2"><p><strong>*<?php echo lang('backend_dni'); ?>:</strong></p></div>
                <div class="col-xs-6"><p><?php echo form_input(array('name'=>'dni', 'value'=>$dni, 'size'=>'80', 'class'=>'form-control')); ?>
                        <span class="alerta"><?php echo form_error('dni'); ?></span></p></div>
                <div class="col-xs-4"></div>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-2"><p></p></div>
                <div class="col-xs-1"><p><?php echo form_submit(array('style'=>'width:auto!important; margin-right:10px;float:left;','id' => 'submit_button', 'name' => 'insert', 'value' => lang('backend_save'), 'class' => 'input-submit form-control')); ?></p></div>
                <div class="col-xs-1"><p><?php echo form_button(array('style'=>'width:auto!important;','class'=>'form-control','id' => 'cancel_button', 'name' => 'cancel', 'content' => lang('backend_cancel'), 'onclick' => "javascript: window.location.href='".site_url('client/indicadores/trabajadores/')."'")); ?></p></div>
                <div class="col-xs-4"></div>
            </div>
        </div>


        <?php
        echo br();
        echo form_hidden('trabajador_id', $trabajador_id);
        echo Form_hidden('update_form', '1');
        ?>



    </div>
</div>

<?php form_close(); ?>

<!-- [Content] end -->
