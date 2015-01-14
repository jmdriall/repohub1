
<div class="container mar-top-15">
    <h1 class="text-center"><?php echo lang('backend_insert_trabajador'); ?></h1>
    <?php echo form_open_multipart('client/indicadores/insertTrabajador', array('class'=>'cmxform', 'id'=>'insertform')); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-2"><p><strong>*<?php echo lang('backend_nombre'); ?>:</strong></p></div>
                <div class="col-xs-6"><p><?php echo form_input(array('name'=>'nombre', 'value'=>$this->input->post('nombre', TRUE), 'size'=>'80', 'class'=>'form-control')); ?>
                        <span class="alerta"><?php echo form_error('nombre'); ?></span></p></div>
                <div class="col-xs-4"></div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-2"><p><strong>*Apellidos:</strong></p></div>
                <div class="col-xs-6"><p><?php echo form_input(array('name'=>'apellidos', 'value'=>$this->input->post('apellidos', TRUE), 'size'=>'80', 'class'=>'form-control')); ?>
                        <span class="alerta"><?php echo form_error('apellidos'); ?></span></p></div>
                <div class="col-xs-4"></div>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-2"><p><strong>*<?php echo lang('backend_cargo'); ?>:</strong></p></div>
                <div class="col-xs-6"><p>
                        <?php if($cargos){
                        ?>
                    <td>
                        <select name="cargo_id" id="constrain" class="form-control" style="width: auto">
                            <?php foreach($cargos as $row){  ?>
                                <option value="<?php echo $row->cargo_id; ?>"><?php echo $row->nombre; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <?php } ?>
                    </p></div>
                <div class="col-xs-4"></div>
            </div>
        </div>


        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-2"><p><strong>*<?php echo lang('backend_dni'); ?>:</strong></p></div>
                <div class="col-xs-6"><p><?php echo form_input(array('name'=>'dni', 'value'=>$this->input->post('dni', TRUE), 'size'=>'80', 'class'=>'form-control')); ?>
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
                    echo form_hidden('user_id', $user_id);
                    echo br();

                    echo ' ';

                    ?>

    </div>
</div>
<?php form_close(); ?>
<!-- [Content] end -->