
<h1 style="text-align: center; margin-top: 20px;"><?php echo 'Trabajadores' ?></h1>
<br />


    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row indices">
                    <div class="col-xs-3">
                        <h3><strong>Nombre</strong></h3>
                    </div>
                    <div class="col-xs-2">
                        <h3><strong>DNI</strong></h3>
                    </div>
                    <div class="col-xs-7">
                        <h3><strong>Actualizar Capacitaciones</strong></h3>
                    </div>
                </div>
            </div>
            <?php if($trabajadores){ $aux = true; ?>
            <div class="col-xs-12">
                <?php foreach($trabajadores as $trabajador){ ?>
                        <div class="row" style="background-color: <?php if($aux){echo '#dad8d8';$aux = false;} else {echo '#c7c3c3'; $aux = true;} ?>">
                            <div class="col-xs-3">
                                <?php echo $trabajador->nombre.' '.$trabajador->apellidos; ?>
                            </div>
                            <div class="col-xs-2">
                                <?php echo $trabajador->dni; ?>
                            </div>
                            <div class="col-xs-7">
                                <?php echo anchor('client/indicadores/eppWork/'.$trabajador->trabajador_id, 'Actualizar') ?>
                                <?php if($this->epp_work_model->getAll($trabajador->trabajador_id)){ if(count($this->epp_work_model->getAll($trabajador->trabajador_id)) == $count_epp){ ?>
                                    <span style="color: #2b542c;font-size: 17px;font-weight: bold;">Completo</span>
                                <?php }} ?>
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
