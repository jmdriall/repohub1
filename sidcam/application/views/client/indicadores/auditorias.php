
<h1 style="text-align: center; margin-top: 20px;"><?php echo 'Auditorias' ?></h1>

<br />


<div class="container">
    <h2><?php echo anchor('client/indicadores/insertAuditoria','Crear Auditoria') ?></h2>
    <div class="row">

        <div class="col-xs-12">
            <div class="row indices">
                <div class="col-xs-3">
                    <h3><strong>Titulo</strong></h3>
                </div>
                <div class="col-xs-1">
                    <h3><strong>Fecha</strong></h3>
                </div>
                <div class="col-xs-3">
                    <h3><strong>Observaciones</strong></h3>
                </div>
                <div class="col-xs-1">
                    <h3><strong>Editar</strong></h3>
                </div>
                <div class="col-xs-1">
                    <h3><strong>Eliminar</strong></h3>
                </div>
                <div class="col-xs-3">
                    <h3><strong>Controles</strong></h3>
                </div>
            </div>
        </div>
        <?php if($auditorias){ $aux = true; ?>
            <div class="col-xs-12">
                <?php foreach($auditorias as $auditoria){ ?>

                     <div class="row" style="background-color: <?php if($aux){echo '#dad8d8';$aux = false;} else {echo '#c7c3c3'; $aux = true;} ?>">
                         <div class="col-xs-3">
                             <p><?php echo $auditoria->titulo; ?></p>
                         </div>
                         <div class="col-xs-1">
                             <p><?php echo $auditoria->fecha_ocurrida; ?></p>
                         </div>
                         <div class="col-xs-3">
                             <p><?php echo anchor('client/indicadores/observacionAuditoria/'.$auditoria->seguimiento_id, 'Onservaciones'); ?></p>
                         </div>
                         <div class="col-xs-1">
                             <p><?php echo anchor('client/indicadores/updateAuditoria/'.$auditoria->seguimiento_id, 'Editar'); ?></p>
                         </div>
                         <div class="col-xs-1">
                             <p><?php echo anchor('client/indicadores/deleteAuditoria/'.$auditoria->seguimiento_id, 'Eliminar'); ?></p>
                         </div>
                         <div class="col-xs-3">
                             <p>
                                 <?php if($auditoria->observacion != ''){
                                     echo anchor('client/indicadores/controlAuditorias/'.$auditoria->seguimiento_id, 'Controles');
                                 }
                                 else{
                                     echo 'No existen Observaciones de Auditoria';
                                 }
                                 ?>
                             </p>
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
