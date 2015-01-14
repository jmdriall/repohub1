
<h1 style="text-align: center; margin-top: 20px;"><?php echo 'Inspecciones' ?></h1>
<br />


<div class="container">
    <h2><?php echo anchor('client/indicadores/insertInspeccion','Crear Inspecci&oacute;n') ?></h2>
    <div class="row">

        <div class="col-xs-12">
            <div class="row indices">
                <div class="col-xs-3">
                    <h3><strong>T&iacute;tulo</strong></h3>
                </div>
                <div class="col-xs-1">
                    <h3><strong>Fecha</strong></h3>
                </div>
                <div class="col-xs-1">
                    <h3><strong>Editar</strong></h3>
                </div>
                <div class="col-xs-1">
                    <h3><strong>Eliminar</strong></h3>
                </div>
                <div class="col-xs-3">
                    <h3><strong>Observaciones</strong></h3>
                </div>
                <div class="col-xs-3">
                    <h3><strong>Controles</strong></h3>
                </div>
            </div>
        </div>
        <?php if($inspecciones){ $aux = true; ?>
            <div class="col-xs-12">
                <?php foreach($inspecciones as $inspeccion){ ?>

                     <div class="row" style="background-color: <?php if($aux){echo '#dad8d8';$aux = false;} else {echo '#c7c3c3'; $aux = true;} ?>">
                         <div class="col-xs-3">
                             <?php echo $inspeccion->titulo; ?>
                         </div>
                         <div class="col-xs-1">
                             <?php echo $inspeccion->fecha_ocurrida; ?>
                         </div>
                         <div class="col-xs-1">
                             <?php echo anchor('client/indicadores/updateInspeccion/'.$inspeccion->inspeccion_id, 'Editar') ?>
                         </div>
                         <div class="col-xs-1">
                             <?php echo anchor('client/indicadores/deleteInspeccion/'.$inspeccion->inspeccion_id, 'Eliminar') ?>
                         </div>
                         <div class="col-xs-3">
                             <?php echo anchor('client/indicadores/observacionInspeccion/'.$inspeccion->inspeccion_id, 'Onservaciones') ?>
                         </div>
                         <div class="col-xs-3">

                             <?php if($inspeccion->observacion != ''){
                                 echo anchor('client/indicadores/controlInspecciones/'.$inspeccion->inspeccion_id, 'Controles');
                              }
                             else{
                                 echo 'No existen Observaciones de Auditoria';
                             }
                             ?>
                         </div>
                     </div>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="col-xs-12 mar-top-15">
            <div class="row">
                <div class="col-xs-12" style="margin-left: -15px;">
                    <input type="button" class="form-control" onclick="javascript: window.location.href='<?php echo site_url('client/indicadores/index/')?>'" value="Cancelar" style="width: 70px!important;margin-top: 20px"/>
                </div>
            </div>
        </div>


    </div>
</div>




<!-- [Content] end -->
