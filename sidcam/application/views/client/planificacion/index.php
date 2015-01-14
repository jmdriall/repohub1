<br/><br/>
<div class="body">
    <div class="container">

        <div class="row planificacion border" id="reportando" style="font-size: 17px">
            <div class="col-xs-12">
                <h1 class="padding_article_left" style="text-align: center">PLANIFICACI&Oacute;N</h1>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3 text-center indices"><strong>Objetivos Generales</strong></div>
            <div class="col-sm-3 col-md-3 col-lg-3 text-center indices"><strong>Objetivos Especificos</strong></div>
            <div class="col-sm-3 col-md-3 col-lg-3 text-center indices"><strong>Actividades</strong></div>
            <div class="col-sm-3 col-md-3 col-lg-3 text-center indices"><strong>Planificacion</strong></div>
            <?php $bg_color = true; ?>
            <?php if($objetivos){ ?>
               <?php foreach($objetivos as $objetivo){ ?>
                    <div class="col-sm-12" <?php if($bg_color){echo 'style="background-color:#ccccfe"'; $bg_color = false;}else{echo 'style="background-color:#a8b3ec"'; $bg_color = true;}?> >
                        <div class="row general">
                            <div class="col-xs-3 text-center"><?php echo $objetivo->nombre; ?></div>
                            <?php if($especificos) { ?>
                                <div class="col-xs-9 text-center">
                                    <?php foreach($especificos as $especifico) { ?>
                                        <?php if($objetivo->objetivo_id == $especifico->objetivo_id){ ?>
                                            <div class="row border-especificos">
                                                <div class="col-xs-4 text-center"><?php echo $especifico->nombre; ?></div>
                                                <?php if($actividades) { ?>
                                                    <div class="col-xs-8 text-center">
                                                        <?php foreach($actividades as $actividad) { ?>
                                                            <?php if($especifico->especifico_id == $actividad->especifico_id){ ?>
                                                                <div class="row border-actividad">
                                                                    <div class="col-xs-6 text-center"><?php echo $actividad->nombre; ?></div>
                                                                    <div class="col-xs-6 text-center border-planificacion">
                                                                        <?php if($planificaciones){ ?>
                                                                            <?php
                                                                            foreach($planificaciones as $planificacion){ ?>
                                                                                <?php if($actividad->actividad_id == $planificacion->actividad_id){ ?>
                                                                                    <div class="col-xs-8 text-center"><?php echo $planificacion->fecha_ini ?></div>
                                                                                    <div class="col-xs-4 text-center">
                                                                                        <?php
                                                                                        if($planificacion->evidencia == '')
                                                                                            echo anchor('client/planificacion/updatePlanificacion/'.$planificacion->planificacion_id, 'Evidencia', array('style' => 'color:red'));
                                                                                        else
                                                                                            echo anchor('client/planificacion/updatePlanificacion/'.$planificacion->planificacion_id, 'Evidencia', array('style' => 'color:darkgreen'));
                                                                                        ?>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php }  ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            <br/><br/><br/>


        </div>
       <!-- <input type="button" class="form-control" id="printer" value="Imprimir" style="width: 70px!important;margin-top: 20px"/> -->
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#printer').click(function(){

            //$('#titulo-report').css({'display':'block'});
            //$('.botones').css({'display':'none'});
/*
            var ficha=document.getElementById('reportando');
            var ventimp=window.open(' ','popimpr');
            ventimp.document.write(ficha.innerHTML);
            ventimp.document.close();
            var css = ventimp.document.createElement("link");
            css.setAttribute("href", "<?php echo base_url().'resources/css/'; ?>stylec.css");
            css.setAttribute("rel", "stylesheet");
            css.setAttribute("type", "text/css");
            ventimp.document.head.appendChild(css);*/

            var ficha = document.getElementById('reportando');
            var ventimp = window.open(' ', '_blank');
            ventimp.document.write( ficha.innerHTML );
            ventimp.document.close();
            var css = ventimp.document.createElement("link");
            css.setAttribute("href", "<?php echo base_url('resources/css/stylec.css');?>");
            css.setAttribute("rel", "stylesheet");
            css.setAttribute("type", "text/css");
            ventimp.document.head.appendChild(css);
            ventimp.print( );
            ventimp.close();

            var css2 = ventimp.document.createElement("link");
            css2.setAttribute("href", "<?php echo base_url('resources/css/bootstrap-theme.min.css');?>");
            css2.setAttribute("rel", "stylesheet");
            css2.setAttribute("type", "text/css");
            ventimp.document.head.appendChild(css2);


            ventimp.print();
            ventimp.close();

        });
    });
</script>