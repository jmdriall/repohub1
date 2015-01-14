
<div class="container">
    <h1 style="text-align: center; margin-top: 20px;"><?php echo 'Medidas Correctivas' ?></h1>
    <h2 class="text-center"><?php $accidente_nombre = $this->accidente_model->getAccidenteByAccidenteId($accidente_id); echo $accidente_nombre->fecha_ocurrida; ?></h2>
    <h3><?php echo anchor('client/indicadores/insertMedida_correctiva/'.$accidente_id,'Insert Medida Correctiva') ?></h3>
</div>
<br />


<div class="container">
    <div class="row">

        <div class="col-xs-12">
            <div class="row indices">
                <div class="col-xs-3">
                    <h3><strong>Responsable</strong></h3>
                </div>
                <div class="col-xs-3">
                    <h3><strong>Fecha</strong></h3>
                </div>
                <div class="col-xs-2">
                    <h3><strong>Editar</strong></h3>
                </div>
                <div class="col-xs-1">
                    <h3><strong>Eliminar</strong></h3>
                </div>
                <div class="col-xs-3">
                    <h3><strong>Evidencias</strong></h3>
                </div>
            </div>
        </div>
        <?php if($medida_correctivas){ $aux = true; ?>
            <div class="col-xs-12">
                <?php foreach($medida_correctivas as $medida_correctiva){ ?>

                     <div class="row" style="background-color: <?php if($aux){echo '#dad8d8';$aux = false;} else {echo '#c7c3c3'; $aux = true;} ?>">
                         <div class="col-xs-3">
                             <?php echo $medida_correctiva->responsable; ?>
                         </div>
                         <div class="col-xs-3">
                             <?php echo $medida_correctiva->fecha_medida_correctiva; ?>
                         </div>
                         <div class="col-xs-2">
                             <?php echo anchor('client/indicadores/updateMedida_correctiva/'.$medida_correctiva->medida_correctiva_id, 'Editar') ?>
                         </div>
                         <div class="col-xs-1">
                             <?php echo anchor('client/indicadores/deleteMedida_correctiva/'.$medida_correctiva->medida_correctiva_id.'/'.$medida_correctiva->accidente_id, 'Eliminar') ?>
                         </div>
                         <div class="col-xs-3">
                             <?php echo $medida_correctiva->evidencia; ?>
                             <br/>
                             <?php echo anchor('client/indicadores/evidenciaMedidaCorrectiva/'.$medida_correctiva->medida_correctiva_id, 'Evidencia') ?>
                         </div>
                     </div>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="col-xs-12 mar-top-15">
            <div class="row">
                <div class="col-xs-12" style="margin-left: -15px;">
                    <input type="button" class="form-control" onclick="javascript: window.location.href='<?php echo site_url('client/indicadores/accidentes/')?>'" value="Cancelar" style="width: 70px!important;margin-top: 20px"/>
                </div>
            </div>
        </div>


    </div>
</div>




<!-- [Content] end -->
