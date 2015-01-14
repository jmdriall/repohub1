<div class="body">
    <div class="container">
        <div id="carousel" class="carousel slide carousel-fade my_overflowh" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                if($sliders){
                    $count_slider_ = 0;
                    foreach($sliders as $row){
                        ?>
                        <li data-target="#carousel" data-slide-to="<?php echo $count_slider_; ?>"<?php if($count_slider_==0){ echo ' class="active"'; } ?>></li>
                        <?php $count_slider_++;
                    } ?>
                <?php }else{ ?>
                    <li data-target="#carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel" data-slide-to="1"></li>
                    <li data-target="#carousel" data-slide-to="2"></li>
                <?php } ?>
            </ol>
            <!-- Carousel items -->
            <div class="carousel-inner">
                <?php
                if($sliders){
                    $count_slider_ = 0;
                    foreach($sliders as $row){
                        ?>
                        <div class="item<?php if($count_slider_==0){ echo " active"; } ?>">
                            <?php echo img(array('src' => 'resources/media/slider/original/'.$row->slider_image)); ?>
                        </div>
                        <?php $count_slider_++;
                    } ?>
                <?php }else{ ?>
                    <div class="active item">
                        <?php echo img(array('src' => 'resources/images/slider1.jpg')); ?>
                    </div>
                    <div class="item">
                        <?php echo img(array('src' => 'resources/images/slider1.jpg')); ?>
                    </div>
                    <div class="item">
                        <?php echo img(array('src' => 'resources/images/slider1.jpg')); ?>
                    </div>
                <?php } ?>
            </div>
            <!-- Carousel nav -->
            <!--<a class="carousel-control left" href="#carousel" data-slide="prev">&lsaquo;</a>
            <a class="carousel-control right" href="#carousel" data-slide="next">&rsaquo;</a>-->
        </div>
        <div class="row">
            <div class="col-xs-12 mar-top-15">
                <h1 class="padding_article_left text-center">SICAMB</h1>
            </div>
            <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
                <div class="row" style="text-align: left; margin: 0!important;">
                    <div class="col-lg-12">
                        <div class="col-xs-6" style="text-align:left; margin: 15px 0;">
                            <input type="text" placeholder="Introduzca partes del Nombre" class="form-control" id="txt_buscar"/>
                        </div>
                        <div class="col-xs-6">
                            <button class="form-control" id="buscar" style="text-align:left; margin: 15px 0;">Buscar</button>
                        </div>
                    </div>
                    <div class="col-xs-12 hr">
                        <div class="row">
                            <div class="col-xs-6 col-sm-2">
                                <strong>Codigo</strong>
                            </div>
                            <div class="hidden-xs col-sm-8">
                                <strong>Nombre</strong>
                            </div>
                            <div class="col-xs-6 col-sm-2"> <strong>Descargar</strong></div>
                        </div>

                    </div>
                    <?php $comodin = true;
                    if($archivos){
                        foreach($archivos as $archivo){
                            ?>
                            <div class="archivo col-xs-12" id="<?php echo $archivo->title;?>" style="display:none;background-color: #<?php if($comodin){echo 'dad8d8';$comodin=false;}else{echo 'c7c3c3';$comodin=true;} ?>;">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-2">
                                        <?php echo $archivo->codigo; ?>
                                    </div>
                                    <div class="hidden-xs col-sm-8">
                                        <?php echo $archivo->title; ?>
                                    </div>
                                    <?php foreach($tipos as $tipo){ ?>
                                        <?php if($tipo->tipo_id == $archivo->tipo_id){ ?>
                                            <div class="col-xs-6 col-sm-2">
                                                <a href="<?php echo base_url().'resources/media/archivo/doc/' . $login . '/'.$tipo->nombre.'/' . $archivo->picture ?>" download="<?php echo $archivo->picture ?>">descargar</a>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 borde_center_vertical" style="text-align:center; margin-top: 64px!important;">
               <?php
                    if($actividades){ ?>
                        <?php date_default_timezone_set('America/Argentina/Buenos_Aires'); ?>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="row indices">
                                    <div class="col-xs-8">Actividades para este Mes</div>
                                    <div class="col-xs-4">Fecha</div>
                                </div>
                            </div>
                            <?php

                            foreach($actividades as $actividad){

                                 ?>
                                <?php if($planificaciones_mes){
                                    $aux = 0;
                                    $pivot = true; $aux2 = 0;
                                    foreach($planificaciones_mes as $planificacion){
                                        if($aux2 == 0){
                                            $bg = '#989898';
                                            $aux2++;
                                        }
                                        else{
                                            $bg = '#808080';
                                            $aux2--;
                                        }
                                            if($planificacion->evidencia == ''){
                                                if($planificacion->actividad_id == $actividad->actividad_id){ ?>
                                                    <?php if($pivot){
                                                       echo
                                                           '<div class="col-xs-12">
                                                               <div class="row" style = "background-color:'.$bg.';">
                                                                   <div class="col-xs-6">'.
                                                                       $actividad->nombre.
                                                                   '</div>
                                                                    <div class="col-xs-6">
                                                                       <div class="row">
                                                                           <div class="col-xs-12">'.
                                                                               $planificacion->fecha_ini.'
                                                                               <a href="updatePlanificacion/'.$planificacion->planificacion_id.' " class="class="new-button""><span class="new-button"></span></a>
                                                                               </div>
                                                                 '; $pivot = false;
                                                    }
                                                    else{
                                                        echo '             <div class="col-xs-12">'
                                                                               .$planificacion->fecha_ini.'
                                                                               <a href="updatePlanificacion/'.$planificacion->planificacion_id.' " class="class="new-button""><span class="new-button"></span></a>
                                                                           </div>';
                                                    }
                                                 }
                                            }

                                           $aux++;
                                    }
                                    if(!$pivot){
                                        echo '               </div>
                                                                     </div>
                                                                 </div>
                                                             </div>';
                                        $pivot = true;
                                    }
                                }
                            }

                            ?>

                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="row indices">
                                    <div class="col-xs-8">Actividades no cumplidas Mes Anterior</div>
                                    <div class="col-xs-4">Fecha</div>
                                </div>
                            </div>
                            <?php
                            foreach($actividades as $actividad){

                                ?>
                                <?php if($planificaciones_mes_anterior){
                                    $aux = 0;
                                    $pivot = true; $aux2 = 0;
                                    foreach($planificaciones_mes_anterior as $planificacion){
                                        if($aux2 == 0){
                                            $bg = '#989898';
                                            $aux2++;
                                        }
                                        else{
                                            $bg = '#808080';
                                            $aux2--;
                                        }
                                        if($planificacion->evidencia == ''){
                                            if($planificacion->actividad_id == $actividad->actividad_id){ ?>
                                                <?php if($pivot){
                                                    echo
                                                        '<div class="col-xs-12">
                                                            <div class="row" style = "background-color:'.$bg.';">
                                                                   <div class="col-xs-6">'.
                                                        $actividad->nombre.
                                                        '</div>
                                                         <div class="col-xs-6">
                                                            <div class="row">
                                                                <div class="col-xs-12">'.
                                                                    $planificacion->fecha_ini.'
                                                                    <a href="updatePlanificacion/'.$planificacion->planificacion_id.' " class="class="new-button""><span class="new-button"></span></a>
                                                                </div>
                                               '; $pivot = false;
                                                }
                                                else{
                                                    echo '
                                                                <div class="col-xs-12">'
                                                                     .$planificacion->fecha_ini.'
                                                                     <a href="updatePlanificacion/'.$planificacion->planificacion_id.' " class="class="new-button""><span class="new-button"></span></a> </div>
                                                                </div>';
                                                }
                                            }
                                        }
                                        $aux++;
                                    }
                                    if(!$pivot){
                                        echo '               </div>
                                                                     </div>
                                                                 </div>
                                                             </div>';
                                        $pivot = true;
                                    }
                                }
                            }
                            ?>
                        </div>
                    <?php } ?>
            </div>
        </div>
        <div class="container" style="display: none">
            <hr class="line_hr" />
            <div class="row" style="text-align: left">
                <div class="col-lg-12">
                    <div class="col-xs-6" style="text-align:left; margin: 15px 0;">
                        <input type="text" placeholder="Introduzca partes del Nombre" class="form-control" id="txt_buscar"/>
                    </div>
                    <div class="col-xs-6">
                        <button class="form-control" id="buscar" style="text-align:left; margin: 15px 0;">Buscar</button>
                    </div>
                </div>
                <div class="col-xs-12 hr">
                    <div class="row">
                        <div class="col-xs-6 col-sm-2">
                            <strong>Codigo</strong>
                        </div>
                        <div class="hidden-xs col-sm-8">
                            <strong>Nombre</strong>
                        </div>
                        <div class="col-xs-6 col-sm-2"> <strong>Descargar</strong></div>
                    </div>

                </div>
                <?php $comodin = true;
                if($archivos){
                    foreach($archivos as $archivo){
                        ?>
                        <div class="archivo col-xs-12" id="<?php echo $archivo->title;?>" style="display:none;background-color: #<?php if($comodin){echo 'dad8d8';$comodin=false;}else{echo 'c7c3c3';$comodin=true;} ?>;">
                            <div class="row">
                                <div class="col-xs-6 col-sm-2">
                                    <?php echo $archivo->codigo; ?>
                                </div>
                                <div class="hidden-xs col-sm-8">
                                    <?php echo $archivo->title; ?>
                                </div>
                                <?php foreach($tipos as $tipo){ ?>
                                    <?php if($tipo->tipo_id == $archivo->tipo_id){ ?>
                                        <div class="col-xs-6 col-sm-2">
                                            <a href="<?php echo base_url().'resources/media/archivo/doc/' . $login . '/'.$tipo->nombre.'/' . $archivo->picture ?>" download="<?php echo $archivo->picture ?>">descargar</a>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $('#buscar').click(function(){
                    var sd = $('div.archivo');
                    var c = sd.length;
                    var txt = $('#txt_buscar').val();

                    //alert(txt);
                    while(c>0){
                        var db = sd[c-1].id;
                        var texto = db.match(txt);
                        if(txt != ""){
                            if(texto == txt){
                                //alert(sd[c-1].id);
                                $('#'+sd[c-1].id).css({display:"block"});

                                //document.getElementById('#kjhndfg').style.display = 'none';
                                //sd[c-1].css('display','block');
                            }
                            else{
                                //alert(sd[c-1].id);
                                $('#'+sd[c-1].id).css({display:"none"});
                                //document.getElementById('#kjhndfg').style.display = 'none';
                                //sd[c-1].css('display','none');
                            }
                        }
                        else{
                            $('#'+sd[c-1].id).css({display:"none"});
                        }
                        //alert(texto);
                        c--;
                    }

                });
                //print(sd.length);
                /* while( c>0 ){
                 alert(sd[c-1].id);
                 c--;
                 }*/
                //alert(sd[0].id);
            });
        </script>
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
