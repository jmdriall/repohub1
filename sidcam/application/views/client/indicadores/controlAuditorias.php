
<h1 style="text-align: center; margin-top: 20px;"><?php echo 'Control Auditorias' ?></h1>
<br />


<div class="container">
    <h2><?php echo anchor('client/indicadores/insertControl/'.$seguimiento_id, 'Crear Control') ?></h2>
    <div class="row">

        <div class="col-xs-12">
            <div class="row indices">
                <div class="col-xs-3">
                    <h3><strong>Responsable</strong></h3>
                </div>
                <div class="col-xs-1">
                    <h3><strong>Fecha</strong></h3>
                </div>
                <div class="col-xs-1">
                    <h3><strong>editar</strong></h3>
                </div>
                <div class="col-xs-1">
                    <h3><strong>eliminar</strong></h3>
                </div>
                <div class="col-xs-6">
                    <h3><strong>Evidencias</strong></h3>
                </div>
            </div>
        </div>
        <?php if($c_auditorias){ $aux = true; ?>
            <div class="col-xs-12">
                <?php foreach($c_auditorias as $c_auditoria){ ?>

                     <div class="row" style="background-color: <?php if($aux){echo '#dad8d8';$aux = false;} else {echo '#c7c3c3'; $aux = true;} ?>">
                         <div class="col-xs-3">
                             <?php echo $c_auditoria->responsable; ?>
                         </div>
                         <div class="col-xs-1">
                             <?php echo $c_auditoria->fecha_control; ?>
                         </div>
                         <div class="col-xs-1">
                             <?php echo anchor('client/indicadores/updateControl/'.$c_auditoria->control_id, 'Editar') ?>
                         </div>
                         <div class="col-xs-1">
                             <?php echo anchor('client/indicadores/deleteControl/'.$c_auditoria->control_id, 'Eliminar') ?>
                         </div>
                         <div class="col-xs-6">
                             <?php echo anchor('client/indicadores/evidenciaControlAuditoria/'.$c_auditoria->control_id, 'Evidencia') ?>
                         </div>
                     </div>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="col-xs-12 mar-top-15">
            <div class="row">
                <div class="col-xs-12" style="margin-left: -15px;">
                    <input type="button" class="form-control" onclick="javascript: window.location.href='<?php echo site_url('client/indicadores/auditorias/')?>'" value="Cancelar" style="width: 70px!important;margin-top: 20px"/>
                </div>
            </div>
        </div>


    </div>
</div>




<!-- [Content] end -->
