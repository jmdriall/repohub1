

<?php echo form_open_multipart('client/indicadores/ingresarEpp/'.$trabajador_id, array('class'=>'cmxform', 'id'=>'insertform')); ?>
<h1 style="text-align: center; margin-top: 20px;"><?php echo 'Ingresar Eppes' ?></h1>
<br />


<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-2">
                    <h3><strong>*Epp</strong></h3>
                </div>
                <div class="col-xs-10">
                    <select name="epp_id" id="epp_id" class="form-control" style="width: auto">
                        <?php if($epps){

                            foreach($epps as $row){
                                $key = 0;
                                foreach($epp_workes as $accidentados){
                                    if($accidentados->epp_id == $row->epp_id){
                                        $key = 1;
                                    }
                                }
                                if($key == 0){
                                    echo "<option id='$row->epp_id' value='$row->epp_id'> $row->title </option>";
                                }
                            }
                        } ?>
                    </select>
                 </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="row mar-top-15">
                <div class="col-xs-2"><strong>*Fecha</strong></div>
                <div class="col-xs-10">
                    <?php echo form_input(array('style'=>'width:200px!important;','class'=>'form-control', 'name'=>'fecha', 'id'=>'fecha', 'value'=>$this->input->post('fecha', TRUE),'size'=>'80', 'type'=>'date')); ?>
                    <?php form_error('fecha'); ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="row mar-top-15">
                <div class="col-xs-2"><strong>*C&oacute;digo</strong></div>
                <div class="col-xs-10">
                    <?php echo form_input(array('style'=>'width:200px!important;','class'=>'form-control', 'name'=>'codigo', 'id'=>'codigo', 'value'=>$this->input->post('codigo', TRUE),'size'=>'80')); ?>
                    <?php form_error('fecha'); ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 mar-top-15">
            <div class="row mar-top-15">
                <div class="col-xs-12" style="margin-left: -15px;">
                    <div class="row">
                        <div class="col-xs-1">
                            <input type="submit" id="submit_button" name="insert" class="form-control input-submit"  value="Guardar" style="width: 70px!important;margin-top: 20px"/>
                        </div>
                        <div class="col-xs-11">
                            <input type="button" class="form-control" onclick="javascript: window.location.href='<?php echo site_url('client/indicadores/eppWork/'.$trabajador_id)?>'" value="Cancelar" style="width: 70px!important;margin-top: 20px"/>
                        </div>
                    </div>


                </div>
            </div>
        </div>


    </div>
</div>








    <tr>
        <td>&nbsp;</td>
        <td align="left">
            <?php
            echo form_hidden('trabajador_id',$trabajador_id);
            echo br();
            //echo form_submit(array('id' => 'submit_button', 'name' => 'insert', 'value' => lang('backend_save'), 'class' => 'input-submit'));
            echo ' ';
            //echo form_button(array('id' => 'cancel_button', 'name' => 'cancel', 'content' => lang('backend_cancel'), 'onclick' => "javascript: window.location.href='".site_url('client/indicadores/eppWork/'.$trabajador_id)."'"));
            ?>
        </td>
    </tr>
</table>
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