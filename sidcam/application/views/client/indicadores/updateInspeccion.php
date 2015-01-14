

<?php echo form_open_multipart('client/indicadores/updateInspeccion', array('class'=>'cmxform', 'id'=>'updateform')); ?>
<h1 style="text-align: center; margin-top: 20px;"><?php echo 'Editar Inspeccion' ?></h1>
<br />


<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-2">
                    <strong>Titulo</strong>
                </div>
                <div class="col-xs-10">
                    <input type="text" name="titulo" value="<?php echo $titulo; ?>" class="form-control" />
                    <?php echo form_error('titulo'); ?>
                 </div>

                <div class="col-xs-2" style="display: none;"><strong>Dias Perdidos</strong></div>
               <!-- <div class="col-xs-10" style="display: none;">
                    <input type="text" name="dias_perdidos" value="<?php echo $dias_perdidos; ?>" class="form-control" />
                    <?php echo form_error('dias_perdidos'); ?>
                </div>-->

                <div class="col-xs-2 mar-top-15" style="display: none"><strong>*<?php echo lang('backend_area'); ?>:</strong></div>
                <div class="col-xs-10 mar-top-15" style="display: none">
                    <?php /*if($areas){ ?>
                        <select name="area_id" id="area_id" class="form-control" style="width: auto">
                            <?php foreach($areas as $area){ ?>
                                <option <?php if($area_id == $area->area_id){echo 'selected';} ?> value="<?php echo $area->area_id ?>"><?php echo $area->nombre; ?></option>
                            <?php } ?>
                        </select>
                    <?php }*/ ?>
                </div>
                <div class="col-xs-2 mar-top-15">
                    <strong>Fecha Ocurrida</strong>
                </div>
                <div class="col-xs-10 mar-top-15">
                    <input type="date" name="fecha_ocurrida" value="<?php echo $fecha_ocurrida; ?>" class="form-control" />
                    <?php echo form_error('fecha_ocurrida'); ?>
                </div>
            </div>
        </div>

        <div class="col-xs-12 mar-top-15">
            <div class="row mar-top-15">
                <div class="col-xs-12" style="margin-left: -15px;">
                    <div class="row">
                        <div class="col-xs-1">
                            <input type="submit" id="submit_button" name="edit" class="form-control input-submit"  value="Guardar" style="width: 70px!important;margin-top: 20px"/>
                        </div>
                        <div class="col-xs-11">
                            <input type="button" class="form-control" onclick="javascript: window.location.href='<?php echo site_url('client/indicadores/inspecciones/')?>'" value="Cancelar" style="width: 70px!important;margin-top: 20px"/>
                        </div>
                    </div>


                </div>
            </div>
        </div>


    </div>
</div>
            <?php
            echo Form_hidden('update_form', '1');
            echo form_hidden('inspeccion_id',$inspeccion_id);
            //echo form_submit(array('id' => 'submit_button', 'name' => 'edit', 'value' => lang('backend_save'), 'class' => 'input-submit'));
            echo br();
            //echo form_submit(array('id' => 'submit_button', 'name' => 'insert', 'value' => lang('backend_save'), 'class' => 'input-submit'));
            echo ' ';
            //echo form_button(array('id' => 'cancel_button', 'name' => 'cancel', 'content' => lang('backend_cancel'), 'onclick' => "javascript: window.location.href='".site_url('client/indicadores/eppWork/'.$trabajador_id)."'"));
            ?>

<?php form_close(); ?>

<script>
    $('document').ready(function(){
        $('#e').css({"display":"none"});
        $('#tipo').change(function(){
            if($('#tipo').attr('checked')) {
                $('#e').css({"display":"block"});
                $('#i').css({"display":"none"});
            } else {
                $('#i').css({"display":"block"});
                $('#e').css({"display":"none"});
            }
        });
    });
</script>
<!-- [Content] end -->