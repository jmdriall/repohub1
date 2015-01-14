<br/><br/>
<div class="body">
    <div class="container">

        <div class="row">
            <div class="col-xs-12">
                <h1 class="padding_article_left text-center">INDICADORES DE GESTI&Oacute;N</h1>
                    <h2>
                        <?php if($trabajadores){
                           $regla = 0;
                            $examen = 0;
                            $capacitacion_work = 0;
                            $cap = 0;
                            $epp_work = 0;
                            $ep = 0;
                            foreach($trabajadores as $trabajador){
                                if($trabajador->regla_recomendaciones == 1){
                                    $regla++;
                                }
                                if($trabajador->examen_medico){
                                    $examen++;
                                }
                                $capacitaciones = false;
                                if($capacitaciones_work){
                                    if($count_capacitacion > 0){
                                        $capacitacion = 0;
                                        foreach($capacitaciones_work as $workes){
                                            if($workes->trabajador_id == $trabajador->trabajador_id)
                                                $capacitacion++;
                                        }
                                        $capacitaciones = $capacitaciones + ($capacitacion/$count_capacitacion);
                                        $capacitacion_work = $capacitacion_work +$capacitaciones;
                                        $cap =( $capacitacion_work / count($trabajadores)) * 100;
                                    }
                                }

                                $epps = false;
                                if($epps_work){
                                    if($count_epp > 0){
                                        $epp = 0;
                                        foreach($epps_work as $workes){
                                            if($workes->trabajador_id == $trabajador->trabajador_id)
                                                $epp++;
                                        }
                                        $epps = $epps + ($epp/$count_epp);
                                        $epp_work = $epp_work +$epps;
                                        $ep =( $epp_work / count($trabajadores)) * 100;
                                    }
                                }
                            }
                        }

                        else{
                            $regla = 0;
                            $examen = 0;
                        }//echo ($capacitacion_work / count($trabajadores));


                        /////           Inspecciones        //////
                        $inspeccion = 0;
                        if($inspecciones){
                            $inspeccion = 0;
                            foreach($inspecciones as $row){
                                if($row->observacion != ''){
                                    if($c_inspecciones){
                                        $c_inspeccion = 0;
                                        $count_c = 0;
                                        foreach($c_inspecciones as $raw){
                                            if($row->inspeccion_id == $raw->inspeccion_id){
                                                $count_c++;
                                                if($raw->evidencia != ''){
                                                    $c_inspeccion++;
                                                }
                                            }
                                        }
                                        if($c_inspeccion!=0)
                                            $c_inspeccion = $c_inspeccion/$count_c;
                                        $inspeccion = $inspeccion+$c_inspeccion;
                                    }
                                }
                            }
                            $inspeccion = $inspeccion / count($inspecciones);
                            $inspeccion = $inspeccion *100;
                        }
                        /////           Auditorias        //////
                        $auditoria = 0;
                        if($auditorias){
                            $auditoria = 0;
                            foreach($auditorias as $row){
                                if($row->observacion != ''){
                                    if($c_auditorias){
                                        $c_auditoria = 0;
                                        $count_c = 0;
                                        foreach($c_auditorias as $raw){
                                            if($row->seguimiento_id == $raw->seguimiento_id){
                                                $count_c++;
                                                if($raw->evidencia != ''){
                                                    $c_auditoria++;
                                                }
                                            }
                                        }
                                        if($c_auditoria!=0)
                                            $c_auditoria = $c_auditoria/$count_c;
                                        $auditoria = $auditoria+$c_auditoria;
                                    }
                                }
                            }
                            $auditoria = $auditoria / count($auditorias);
                            $auditoria = $auditoria *100;
                        }
                        /////           Accidentes        //////
                        $accidente = 0;
                        if($accidentes){
                            $accidente = 0;
                            foreach($accidentes as $row){
                                if($row->observacion != ''){
                                    if($medidas_correctiva){
                                        $medida_correctiva = 0;
                                        $count_medida = 0;
                                        foreach($medidas_correctiva as $raw){
                                            if($row->accidente_id == $raw->accidente_id){
                                                $count_medida++;
                                                if($raw->evidencia != ''){
                                                    $medida_correctiva++;
                                                }
                                            }
                                        }
                                        if($medida_correctiva !=0)
                                            $medida_correctiva = $medida_correctiva/$count_medida;
                                        $accidente = $accidente+$medida_correctiva;
                                    }
                                }
                            }
                            $accidente = $accidente / count($accidentes);
                            $accidente = $accidente *100;
                        }
                    /*if($objetivos){
                        $objetivo_c = 0;
                        foreach($objetivos as $objetivo){
                            $especificos = $this->especifico_model->getAll($objetivo->objetivo_id);
                            if($especificos){
                                $especifico_c = 0;
                                foreach($especificos as $especifico){
                                    $planificaciones = $this->planificacion_model->getAll($especifico->id);
                                    if($planificaciones){
                                        $planificacion_c = 0;
                                        foreach($planificaciones as $planificacion){
                                            if($planificacion->evidencia!= ''){
                                                $planificacion_c++;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }*/
                        $planificacion_c = 0;
                        if($planificaciones){
                            foreach($planificaciones as $planificacion){
                                if($planificacion->evidencia != ''){
                                    $planificacion_c++;
                                }
                            }
                            $planificacion_c = ($planificacion_c / count($planificaciones))*100;
                        }
                        ?>
                    </h2>
            </div>
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-9"><h2>Trabajadores</h2></div>
                    <div class="col-xs-3"><h3><?php echo anchor('client/indicadores/trabajadores', 'Gestionar Trabajadores',array('style'=>'color:#002963')) ?></h3></div>
                </div>
                <div class="row">

                    <!--//////Reglamentos y Recomendaciones  -->
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-3" style="margin-top: 15px">
                                <strong>Reglamentos y Recomendaciones</strong>
                            </div>
                            <div class="col-xs-5" style="border: 2px solid #000000;height: 20px;padding-left: 0;padding-right: 0; margin-top: 15px">
                                <?php if($trabajadores) { ?>
                                    <div class="porcentaje" style="height: 100%; width: <?php echo ''.(($regla/count($trabajadores)*100)).'%' ?> ;"></div>
                                <?php } else{ ?>
                                    <div style="height: 100%; width: 100% ">VACIO</div>
                                <?php } ?>

                            </div>
                            <div class="col-xs-1" style="margin-top: 15px">
                                <strong> <?php echo ''.round((($regla/count($trabajadores)*100)),2).'%' ?></strong>
                            </div>
                            <div class="col-xs-3" style="margin-top: 15px">
                                <strong> <?php echo anchor('client/indicadores/reglamentos', 'Reglamentos y Recomendaciones') ?></strong>
                            </div>
                        </div>
                    </div>
                    <!--////////////////////////  -->
                    <!--////// Examen Medico///////////  -->
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-3"  style="margin-top: 15px">
                                <strong>Examen M&eacute;dico</strong>
                            </div>
                            <div class="col-xs-5" style="border: 2px solid #000000;height: 20px;padding-left: 0;padding-right: 0; margin-top: 15px">
                                <?php if($trabajadores) { ?>
                                    <div class="porcentaje" style="height: 100%; width: <?php echo ''.(($examen/count($trabajadores)*100)).'%' ?> ;"></div>
                                <?php } else{ ?>
                                    <div style="height: 100%; width: 100% ">VACIO</div>
                                <?php } ?>
                            </div>
                            <div class="col-xs-1" style="margin-top: 15px">
                                <strong><?php echo ''.round(($examen/count($trabajadores)*100),2).'%' ?></strong>
                            </div>
                            <div class="col-xs-3" style="margin-top: 15px">
                                <strong> <?php echo anchor('client/indicadores/examenes', 'Ex&aacute;menes M&eacute;dicos') ?></strong>
                            </div>
                        </div>
                    </div>
                    <!--////////////////////////  -->
                    <!--////// Capacitacion///////////  -->
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-3"  style="margin-top: 15px">
                                <strong>Capacitaci&oacute;n</strong>
                            </div>
                            <div class="col-xs-5" style="border: 2px solid #000000;height: 20px;padding-left: 0;padding-right: 0; margin-top: 15px">
                                <?php if($trabajadores && $bool_capacitaciones) { ?>
                                    <div class="porcentaje" style="height: 100%; width: <?php echo $cap.'%'; ?> ;"></div>
                                <?php } else{ ?>
                                    <div style="height: 100%; width: 100% ">VACIO</div>
                                <?php } ?>
                            </div>
                            <div class="col-xs-1" style="margin-top: 15px">
                                <strong><?php
                                    if($trabajadores && $bool_capacitaciones){
                                    echo ''.round($cap,2).'%';} ?>

                                    </strong>
                            </div>
                            <div class="col-xs-3" style="margin-top: 15px">
                                <strong> <?php echo anchor('client/indicadores/capacitaciones', 'Capacitaciones') ?></strong>
                            </div>
                        </div>
                    </div>
                    <!--////////////////////////  -->

                    <!--////// EPP///////////  -->
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-3"  style="margin-top: 15px">
                                <strong>Epp</strong>
                            </div>
                            <div class="col-xs-5" style="border: 2px solid #000000;height: 20px;padding-left: 0;padding-right: 0; margin-top: 15px">
                                <?php if($trabajadores && $bool_epps) { ?>
                                    <div class="porcentaje" style="height: 100%; width: <?php echo $ep.'%'; ?> ;"></div>
                                <?php } else{ ?>
                                    <div style="height: 100%; width: 100% ">VACIO</div>
                                <?php } ?>
                            </div>
                            <div class="col-xs-1" style="margin-top: 15px">
                                <strong><?php
                                    if($trabajadores && $bool_epps){
                                        echo ''.round($ep,2).'%';
                                    }
                                     ?></strong>
                            </div>
                            <div class="col-xs-3" style="margin-top: 15px">
                                <strong> <?php echo anchor('client/indicadores/epps', 'EPPS') ?></strong>
                            </div>
                        </div>
                    </div>
                    <!--////////////////////////  -->

                    <!--////////////////////////  -->
                </div>
                <h2 class="mar-top-15">Inspecciones</h2>
                <div class="row">
                    <!--////// inspecciones ///////////  -->
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-3"  style="margin-top: 15px">
                                <strong>Inspeccion</strong>
                            </div>
                            <div class="col-xs-5" style="border: 2px solid #000000;height: 20px;padding-left: 0;padding-right: 0; margin-top: 15px">
                                <?php if($inspecciones) { ?>
                                    <div class="porcentaje" style="height: 100%; width: <?php echo $inspeccion.'%'; ?> ;"></div>
                                <?php } else{ ?>
                                    <div style="height: 100%; width: 100%; text-align: center">VACIO</div>
                                <?php } ?>
                            </div>
                            <div class="col-xs-1" style="margin-top: 15px">
                                <strong><?php echo ''.round($inspeccion,2).'%' ?></strong>
                            </div>
                            <div class="col-xs-3" style="margin-top: 15px">
                                <strong> <?php echo anchor('client/indicadores/inspecciones', 'Inspecciones') ?></strong>
                            </div>
                        </div>
                    </div>
                    <!--////////////////////////  -->
                </div>
                <h2 class="mar-top-15">Auditorias</h2>
                <div class="row">
                    <!--////// Auditorias ///////////  -->
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-3"  style="margin-top: 15px">
                                <strong>Auditoria</strong>
                            </div>
                            <div class="col-xs-5" style="border: 2px solid #000000;height: 20px;padding-left: 0;padding-right: 0; margin-top: 15px">
                                <?php if($auditorias) { ?>
                                    <div class="porcentaje" style="height: 100%; width: <?php echo $auditoria.'%'; ?> ;"></div>
                                <?php } else{ ?>
                                    <div style="height: 100%; width: 100%; text-align: center">VACIO</div>
                                <?php } ?>
                            </div>
                            <div class="col-xs-1" style="margin-top: 15px">
                                <strong><?php echo ''.round($auditoria,2).'%' ?></strong>
                            </div>
                            <div class="col-xs-3" style="margin-top: 15px">
                                <strong> <?php echo anchor('client/indicadores/auditorias', 'Auditor&iacute;as') ?></strong>
                            </div>
                        </div>
                    </div>
                    <!--////////////////////////  -->
                </div>
                <h2 class="mar-top-15">Accidentes</h2>
                <div class="row">
                    <!--////// Accidentes ///////////  -->
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-3"  style="margin-top: 15px">
                                <strong>Accidente</strong>
                            </div>
                            <div class="col-xs-5" style="border: 2px solid #000000;height: 20px;padding-left: 0;padding-right: 0; margin-top: 15px">
                                <?php if($accidentes) { ?>
                                    <div class="porcentaje" style="height: 100%; width: <?php echo $accidente.'%'; ?> ;"></div>
                                <?php } else{ ?>
                                    <div style="height: 100%; width: 100%; text-align: center">VACIO</div>
                                <?php } ?>
                            </div>
                            <div class="col-xs-1" style="margin-top: 15px">
                                <strong><?php echo ''.round($accidente,2).'%' ?></strong>
                            </div>
                            <div class="col-xs-3" style="margin-top: 15px">
                                <strong> <?php echo anchor('client/indicadores/accidentes', 'Accidentes') ?></strong>
                            </div>
                        </div>
                    </div>
                    <!--////////////////////////  -->
                </div>
                <h2 class="mar-top-15">Plan</h2>
                <div class="row">
                    <!--////// Planificacion ///////////  -->
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-3"  style="margin-top: 15px">
                                <strong>Planificaci&oacute;n Total</strong>
                            </div>
                            <div class="col-xs-5" style="border: 2px solid #000000;height: 20px;padding-left: 0;padding-right: 0; margin-top: 15px">
                                <?php if($objetivos) { ?>
                                    <div class="porcentaje" style="height: 100%; width: <?php echo $planificacion_c.'%'; ?> ;"></div>
                                <?php } else{ ?>
                                    <div style="height: 100%; width: 100%; text-align: center">VACIO</div>
                                <?php } ?>
                            </div>
                            <div class="col-xs-1" style="margin-top: 15px">
                                <strong><?php echo ''.round($planificacion_c,2).'%' ?></strong>
                            </div>
                            <div class="col-xs-3" style="margin-top: 15px">
                                <!--<strong> <?php echo anchor('client/indicadores/accidentes', 'Accidentes') ?></strong>-->
                            </div>
                        </div>
                    </div>
                    <!--////////////////////////  -->
                </div>
            </div>

        </div>
        <hr class="line_hr" />
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
                <div class="padding_article_left" style="position:relative;">

                    <?php /*
                    <div class="tabs_faq">
                        <?php if($faqs){ ?>
                            <ul class="nav nav-tabs" id="myTab">
                                <?php $count_ = 0;
                                foreach($faqs as $row){ ?>
                                    <li class="<?php if($count_==0){ echo 'active'; } ?>"><h1><a href="#<?php echo strtolower(url_title($row->faq_title, 'dash')); ?>" class="<?php echo strtolower(url_title($row->faq_title, 'dash')); ?>-link"><?php echo $row->faq_title; ?></a></h1></li>
                                    <?php $count_++;
                                } ?>
                            </ul>
                            <div class="tab-content">
                                <?php $count_ = 0;
                                foreach($faqs as $row){ ?>
                                    <?php $list_faq_ = $this->subfaq_model->getAllSubfaqs($row->faq_id, 0, 0); ?>
                                    <div class="tab-pane<?php if($count_==0){ echo ' active'; } ?>" id="<?php echo strtolower(url_title($row->faq_title, 'dash')); ?>">
                                        <?php foreach($list_faq_ as $srow){ ?>

                                            <div class="accordion-group">
                                                <div class="accordion-heading"><a class="accordion-toggle" href="#<?php echo 'tab-'.$srow->subfaq_id; ?>" data-toggle="collapse" data-parent="#accordion2"><?php echo $srow->title; ?></a></div>
                                                <div class="accordion-body collapse" id="<?php echo 'tab-'.$srow->subfaq_id; ?>">
                                                    <div class="accordion-inner"><?php echo $srow->description; ?></div>
                                                </div>
                                            </div>

                                            <?php $count_++;
                                        } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                */ ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 borde_center_vertical" style="text-align:center;">

            </div>
        </div>
    </div>
</div>
