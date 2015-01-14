
<div class="container">
    <div class="row">
        <div class="col-xs-12 text-center mar-top-15">
            <h1><?php echo 'Editar Trabajadores Afectados'; ?></h1>
        </div>
        <div class="col-xs-12">
            <?php echo form_open_multipart('client/indicadores/updateAccidente_trabajador/'.$accidente_trabajador_id, array('class'=>'cmxform', 'id'=>'updateform')); ?>
            <div class="row">
                <div class="col-xs-2">
                    <strong>Trabajador:</strong>
                </div>
                <div class="col-xs-10">
                    <select name="trabajador_id" id="trabajador_id" class="form-control" style="width: auto">
                        <?php if($trabajadores){
                            foreach($trabajadores as $row){
                                $key = 0;
                                foreach($accidente_trabajadores as $accidentados){
                                    if($accidentados->trabajador_id == $row->trabajador_id && $trabajador_id != $accidentados->trabajador_id){
                                        $key = 1;
                                    }
                                }
                                if($key == 0){
                                    if($row->trabajador_id == $trabajador_id){
                                        echo "<option id='$row->trabajador_id' selected value='$row->trabajador_id'> $row->nombre </option>";
                                    }
                                    else{
                                        echo "<option id='$row->trabajador_id' value='$row->trabajador_id'> $row->nombre </option>";
                                    }
                                }
                            }
                        } ?>
                    </select>
                </div>
            </div>
            <div class="row mar-top-15">
                <div class="col-xs-2">
                    <strong>Parte de cuerpo afectado:</strong>
                </div>
                <div class="col-xs-10">
                    <select name="body_id" id="body_id" class="form-control" style="width: auto">
                        <?php if($bodies){
                            foreach($bodies as $row){
                                if($row->body_id == $body_id){
                                    echo "<option id='$row->body_id' selected value='$row->body_id'> $row->nombre </option>";
                                }
                                else{
                                    echo "<option id='$row->body_id' value='$row->body_id'> $row->nombre </option>";
                                }
                            }
                        } ?>
                    </select>
                </div>
            </div>




                        <?php
                        echo form_hidden('accidente_trabajador_id', $accidente_trabajador_id);
                        echo form_hidden('accidente_id', $accidente_id);
                        echo Form_hidden('update_form', '1');
                        echo form_submit(array('id' => 'submit_button', 'name' => 'insert', 'value' => lang('backend_save'), 'class' => 'input-submit form-control mar-top-15','style'=>'width:auto!important;float:left!important;margin-right:15px!important;'));
                        echo ' ';
                        echo form_button(array('class'=> 'form-control','style'=>'width:auto!important;float:left!importat;','id' => 'cancel_button', 'name' => 'cancel', 'content' => lang('backend_cancel'), 'onclick' => "javascript: window.location.href='".site_url('client/indicadores/trabajadoresAfectados/'.$accidente_id)."'"));
                        ?>

            <?php form_close(); ?>

        </div>
        <div class="col-xs-12">

            <h2><?php //echo anchor('client/indicadores/trabajadoresAfectados/'.$accidente_id, lang('backend_list_accidente_trabajadors'));?></h2>
        </div>

    </div>
</div>
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