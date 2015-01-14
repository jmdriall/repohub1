
<h1 style="text-align: center; margin-top: 20px;"><?php echo 'Eppes' ?></h1>
<br />


<div class="container">
    <div class="row">
        <div class="col-xs-12" style="margin-bottom:10px!important">
            <?php echo anchor('client/indicadores/ingresarEpp/'.$trabajador_id, 'Ingresar Epp', array('style'=> 'font-size:25px;')) ?>
        </div>
        <div class="col-xs-12">
            <div class="row indices">
                <div class="col-xs-3">
                    <h3><strong>Nombre</strong></h3>
                </div>
                <div class="col-xs-3">
                    <h3><strong>Editar</strong></h3>
                </div>
                <div class="col-xs-3">
                    <h3><strong>Eliminar</strong></h3>
                </div>
            </div>
        </div>
        <?php if($epps_work){ $aux = true; ?>
            <div class="col-xs-12">
                <?php foreach($epps_work as $epp){ ?>
                    <div class="row" style="background-color: <?php if($aux){echo '#dad8d8';$aux = false;} else {echo '#c7c3c3'; $aux = true;} ?>">
                        <div class="col-xs-3">
                            <?php echo $epp->title; ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo anchor('client/indicadores/editarEpp/'.$epp->epp_work_id.'/'.$trabajador_id.'/', 'Editar') ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo anchor('client/indicadores/eliminarEpp/'.$epp->epp_work_id.'/'.$trabajador_id.'/', 'Eliminar') ?>
                        </div>
                    </div>


                <?php } ?>
            </div>
        <?php } ?>

        <div class="col-xs-12 mar-top-15">
            <div class="row">
                <div class="col-xs-12" style="margin-left: -15px;">
                    <input type="button" class="form-control" onclick="javascript: window.location.href='<?php echo site_url('client/indicadores/epps/')?>'" value="Cancelar" style="width: 70px!important;margin-top: 20px"/>
                </div>
            </div>
        </div>


    </div>
</div>




<!-- [Content] end -->
