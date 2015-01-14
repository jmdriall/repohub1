
<div class="container">
    <h1 class="mar-top-15 text-center"><?php echo lang('backend_insert_control'); ?></h1>

    <?php echo form_open_multipart('client/indicadores/insertControl/'.$seguimiento_id, array('class'=>'cmxform', 'id'=>'insertform')); ?>
    <div class="row">
        <div class="col-xs-2 mar-top-15"><strong>*<?php echo lang('backend_responsable'); ?>:</strong></div>
        <div class="col-xs-10 mar-top-15">
            <?php echo form_input(array('name'=>'responsable','value'=> $this->input->post('responsable', TRUE), 'size'=>'80','class'=>'form-control')); ?>
            <?php echo form_error('responsable'); ?>
        </div>
        <div class="col-xs-2 mar-top-15"><strong>*<?php echo lang('backend_medida'); ?>:</strong></div>
        <div class="col-xs-10 mar-top-15">
            <?php echo form_input(array('name'=>'medida','value'=> $this->input->post('medida', TRUE), 'size'=>'80','class'=>'form-control')); ?>
            <?php echo form_error('medida'); ?>
        </div>

        <div class="col-xs-2 mar-top-15" style="display: none"><strong>*<?php echo lang('backend_evidencia'); ?>:</strong></div>
        <div class="col-xs-10 mar-top-15" style="display: none">
            <?php echo form_textarea(array('id' => 'evidencia', 'name' => 'evidencia', 'rows' => '12', 'cols' => '52', 'value' => $this->input->post('evidencia'))); ?>
            <?php echo form_error('evidencia'); ?></div>

        <div class="col-xs-2 mar-top-15"><strong>Fecha Control</strong></div>
        <div class="col-xs-10 mar-top-15">
            <?php echo form_input(array('name'=>'fecha_control', 'value' => $this->input->post('fecha_control', TRUE), 'size'=>'80', 'type'=>'date')); ?>
            <?php echo form_error('fecha_control'); ?>
        </div>
        <div class="col-xs-2"></div>
        <div class="col-xs-10">
            <?php

            echo br();
            echo form_submit(array('id' => 'submit_button', 'name' => 'insert', 'value' => lang('backend_save'), 'class' => 'input-submit form-control','style'=>'width:auto!important;float:left; margin-right:10px'));

            echo form_button(array('style'=>'float:left;margin-top:0','class'=>'form-control','id' => 'cancel_button', 'name' => 'cancel', 'content' => lang('backend_cancel'), 'onclick' => "javascript: window.location.href='".site_url('client/indicadores/controlAuditorias/'.$seguimiento_id)."'"));
            echo form_hidden('seguimiento_id',$seguimiento_id);
            ?>
        </div>



    </div>
    <?php form_close(); ?>
</div>
<!-- [Content] end -->