
<h1 style="text-align: center; margin-top: 20px;"><?php echo 'Controles Inspeccion' ?></h1>
<br />


<div class="container">
    <h2><?php echo anchor('client/indicadores/insertC_inspeccion/'.$inspeccion_id,'Ingresar Control') ?></h2>
    <div class="row">

        <div class="col-xs-12">
            <div class="row indices">
                <div class="col-xs-3">
                    <h3><strong>Responsable</strong></h3>
                </div>
                <div class="col-xs-3">
                    <h3><strong>Fecha</strong></h3>
                </div>
                <div class="col-xs-1">
                    <h3><strong>Editar</strong></h3>
                </div>
                <div class="col-xs-1">
                    <h3><strong>Eliminar</strong></h3>
                </div>
                <div class="col-xs-4">
                    <h3><strong>Evidencias</strong></h3>
                </div>
            </div>
        </div>
        <?php if($c_inspecciones){ $aux = true; ?>
            <div class="col-xs-12">
                <?php foreach($c_inspecciones as $c_inspeccion){ ?>

                     <div class="row" style="background-color: <?php if($aux){echo '#dad8d8';$aux = false;} else {echo '#c7c3c3'; $aux = true;} ?>">
                         <div class="col-xs-3">
                             <?php echo $c_inspeccion->responsable; ?>
                         </div>
                         <div class="col-xs-3">
                             <?php echo $c_inspeccion->fecha_c_inspeccion; ?>
                         </div>
                         <div class="col-xs-1">
                             <?php echo anchor('client/indicadores/updateC_inspeccion/'.$c_inspeccion->c_inspeccion_id, 'Editar') ?>
                         </div>
                         <div class="col-xs-1">
                             <?php echo anchor('client/indicadores/deleteC_inspeccion/'.$c_inspeccion->c_inspeccion_id, 'Eliminar') ?>
                         </div>
                         <div class="col-xs-4">
                             <?php echo anchor('client/indicadores/evidenciaControlInspeccion/'.$c_inspeccion->c_inspeccion_id, 'Evidencia') ?>
                         </div>
                     </div>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="col-xs-12 mar-top-15">
            <div class="row">
                <div class="col-xs-12" style="margin-left: -15px;">
                    <input type="button" class="form-control" onclick="javascript: window.location.href='<?php echo site_url('client/indicadores/inspecciones/')?>'" value="Cancelar" style="width: 70px!important;margin-top: 20px"/>
                </div>
            </div>
        </div>


    </div>
</div>




<!-- [Content] end -->
