
<h1 style="text-align: center; margin-top: 20px;"><?php echo 'Accidentes' ?></h1>
<br />


    <div class="container">
        <div class="row">
            <div class="col-xs-12">
               <h2> <?php echo anchor('client/indicadores/insertAccidente/', 'Insertar Accidente') ?></h2>
            </div>
            <div class="col-xs-12">
                <div class="row indices">
                    <div class="col-xs-2" style="display: none">
                        <h3><strong>Titulo</strong></h3>
                    </div>
                    <div class="col-xs-3">
                        <h3><strong>fecha</strong></h3>
                    </div>
                    <div class="col-xs-2">
                        <h3><strong>Medidas Correctivas</strong></h3>
                    </div>
                    <div class="col-xs-3">
                        <h3><strong>Trabajadores Afectados</strong></h3>
                    </div>
                    <div class="col-xs-2">
                        <h3><strong>
                                Descripci&oacute;n</strong></h3>
                    </div>
                    <div class="col-xs-1">
                        <h3><strong>Editar</strong></h3>
                    </div>
                    <div class="col-xs-1">
                        <h3><strong>Eliminar</strong></h3>
                    </div>
                </div>
            </div>
            <?php if($accidentes){ $aux = true; ?>
            <div class="col-xs-12">
                <?php foreach($accidentes as $accidente){ ?>
                        <div class="row" style="background-color: <?php if($aux){echo '#dad8d8';$aux = false;} else {echo '#c7c3c3'; $aux = true;} ?>">
                            <div class="col-xs-2" style="display: none">
                                <?php echo '<p>'.$accidente->titulo.'</p>'; ?>
                            </div>
                            <div class="col-xs-3">
                                <?php echo '<p>'.$accidente->fecha_ocurrida.'</p>'; ?>
                            </div>
                            <div class="col-xs-2">
                                <?php if($accidente->observacion != ''){
                                    echo '<p>'. anchor('client/indicadores/medidaCorrectiva/'.$accidente->accidente_id, 'Medidas Correctivas').'</p>';
                                 } else{
                                echo '<p>Observacion no establecida</p>';
                                } ?>
                            </div>
                            <div class="col-xs-3">
                                <?php echo '<p>'.anchor('client/indicadores/trabajadoresAfectados/'.$accidente->accidente_id, 'Trabajadores Afectados').'</p>'; ?>
                            </div>
                            <div class="col-xs-2">
                                <?php echo '<p>'.anchor('client/indicadores/observacionAccidente/'.$accidente->accidente_id, 'Descripci&oacute;n').'</p>'; ?>
                            </div>
                            <div class="col-xs-1">
                                <?php echo '<p>'.anchor('client/indicadores/updateAccidente/'.$accidente->accidente_id, 'Editar').'</p>'; ?>
                            </div>
                            <div class="col-xs-1">
                                <?php echo '<p>'.anchor('client/indicadores/deleteAccidente/'.$accidente->accidente_id, 'Eliminar').'</p>'; ?>
                            </div>
                        </div>


                <?php } ?>
            </div>
            <?php } ?>
            <div class="col-xs-12">
                <br/>
                <br/>
            </div>
            <div class="col-xs-12 tabla-reportes" id="reportando">
                    <h1 style="text-align: center; display: none" id="titulo-report">Accidentes</h1>
                <table style="width: 100%; text-align: center" name="docimprimir" id="docimprimir">
                    <tr style="background-color: #166191;color: #fff!important;">
                        <td><strong>Fecha</strong></td>
                        <td><strong>&Aacute;rea</strong></td>
                        <td><strong>Trabajadores</strong></td>
                        <td><strong>Descripci&oacute;n</strong></td>
                        <td><strong>Dias Perdidos</strong></td>
                    </tr>
                <?php
                for($i=1; $i <= $mes;$i++){
                    $accidnts = $this->accidente_model->getAllByMonth($user_id->user_id, $anio, $i);
                    if($accidnts){
                        $pi = true;
                        for($e=0; $e<(count($accidnts)); $e++){
                            $area = $this->area_model->getAreaByAreaId($accidnts[$e]->area_id);
                            if(true){
                                if($pi){
                                    $color = "#dad8d8";
                                    $pi = false;
                                }
                                else{
                                    $pi = true;
                                    $color = "#909090";
                                }
                                echo('<tr class="report" style="background-color: '.$color.'">');
                                echo '<td>'.$accidnts[$e]->fecha_ocurrida.'  <strong>'.$meses[$i-1].'</strong></td>
                                      <td>'.$area->nombre.'</td>';
                                $trab = $this->accidente_trabajador_model->getAll($accidnts[$e]->accidente_id);
                                if($trab){
                                    echo '<td>';
                                    foreach($trab as $tra){
                                        echo $tra->nombre.br();
                                    }
                                    echo '</td>';
                                }
                                else{
                                    echo'<td>No existen Trabajadores afectados</td>';
                                }
                                echo'<td>'.$accidnts[$e]->descripcion.'</td>
                                     <td>'.$accidnts[$e]->dias_perdidos.'</td>';
                                echo '</tr>';
                            }


                        }
                        $total =$this->accidente_model->getSumByMonth($user_id->user_id, $anio, $i);
                        $hhrt =$this->accidente_model->getCountByMonth($user_id->user_id, $anio, $i);
                        echo '<tr class="report reporte botones" style="background-color:#000;color:#fff;border-top:2px solid #fff;border-bottom:2px solid #fff;" id="">
                                <td><input type="number" placeholder="Introducir total horas trabajadas" class="form-control text-'.$meses[$i-1].'"></td>
                                <td><button class="form-control '.$meses[$i-1].'">Generar</button></td>
                                <td  colspan="3"><strong></strong></td>
                              </tr>';
                        echo '<tr class="report" style="background-color:#000;color:#fff;border-top:2px solid #fff;border-bottom:2px solid #fff;">
                                <td><strong>'.$meses[$i-1].'  Total Dias Perdidos</strong></td>
                                <td colspan="3"></td>
                                <td><strong class="diasp '.$meses[$i-1].'"> '.$total->totalPerdidosMes.' </strong></td>
                              </tr>';
                        echo '<tr class="report" style="background-color:#000;color:#fff;border-top:2px solid #fff;border-bottom:2px solid #fff;">
                                <td><strong>'.$meses[$i-1].'  Indice de Frecuencia</strong></td>
                                <td colspan="3"><strong style="display:none" class="indicef'.$meses[$i-1].'">'.($hhrt->hhrt*1000000).'</strong></td>
                                <td><span class="indiceft'.$meses[$i-1].'"></span></td>
                              </tr>';
                        echo '<tr class="report" style="background-color:#000;color:#fff;border-top:2px solid #fff;border-bottom:2px solid #fff;">
                                <td><strong>'.$meses[$i-1].'  Indice de Gravedad</strong></td>
                                <td colspan="3"><strong style="display:none" class="indiceg'.$meses[$i-1].'">'.($total->totalPerdidosMes*1000000).'</strong></td>
                                <td><span class="indicegt'.$meses[$i-1].'"></span></td>
                              </tr>';
                        echo '<tr class="report" style="background-color:#000;color:#fff;border-top:2px solid #fff;border-bottom:2px solid #fff;">
                                <td><strong>'.$meses[$i-1].'  Indice de Accidentabilidad</strong></td>
                                <td colspan="3"><strong style="display:none" class="indiceg'.$meses[$i-1].'"></strong></td>
                                <td><span class="indiceat'.$meses[$i-1].'"></span></td>
                              </tr>';
                        echo '<tr class="report" style="background-color:#000;color:#fff;border-top:2px solid #fff;border-bottom:2px solid #fff;">
                                <td><strong>'.$meses[$i-1].'  Indice de Responsabilidad</strong></td>
                                <td colspan="3"><strong style="display:none" class="indiceg'.$meses[$i-1].'"></strong></td>
                                <td><span class="indicert'.$meses[$i-1].'"></span></td>
                              </tr>';
                        echo '<tr class="report" style="background-color:#000;color:#fff;border-top:2px solid #fff;border-bottom:2px solid #fff;">
                                <td><strong>'.$meses[$i-1].'  Porcentajes por &Aacutereas</strong></td>
                                <td colspan="4">';
                                $allAreas = $this->area_model->getAll($user_id->user_id);
                                foreach($allAreas as $ar){
                                    $all = $this->accidente_model->getPorcentajeByMonth($user_id->user_id,$ar->area_id, $anio, $i);

                                    echo $ar->nombre.': '. (round(($all->porcentaje/count($accidnts)*100),2)).'%'.br();
                                }
                                echo '</td>
                              </tr>';
                    }
                    else{
                        echo '<tr style="background-color: #000;color: #fff" class="report"><td colspan="5">'.$meses[$i-1].' sin accidentes</td> </tr>';
                    }
                } ?></table>
            </div>
            <div class="col-xs-12 mar-top-15">
                <div class="row">
                    <div class="col-xs-12" style="margin-left: -15px;">
                        <input type="button" class="form-control" onclick="javascript: window.location.href='<?php echo site_url('client/indicadores/index/')?>'" value="Volver" style="width: 70px!important;margin-top: 20px"/>
                        <input type="button" class="form-control" id="printer" value="Imprimir" style="width: 70px!important;margin-top: 20px"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function(){
        $('#titulo-report').css({'display':'none'});
        var enero = $('button.form-control.Enero');
        var febrero = $('button.form-control.Febrero');
        var marzo = $('button.form-control.Marzo');
        var abril = $('button.form-control.Abril');
        var mayo = $('button.form-control.Mayo');
        var junio = $('button.form-control.Junio');
        var julio = $('button.form-control.Julio');
        var agosto = $('button.form-control.Agosto');
        var septiembre = $('button.form-control.Septiembre');
        var octubre = $('button.form-control.Octubre');
        var noviembre = $('button.form-control.Noviembre');
        var diciembre = $('button.form-control.Diciembre');

        $('#printer').click(function(){

            $('#titulo-report').css({'display':'block'});
            $('.botones').css({'display':'none'});

            var ficha=document.getElementById('reportando');
            var ventimp=window.open(' ','popimpr');
            ventimp.document.write(ficha.innerHTML);
            ventimp.document.close();

            var css = ventimp.document.createElement("link");
            css.setAttribute("href", "estilo.css");
            css.setAttribute("rel", "stylesheet");
            css.setAttribute("type", "text/css");
            ventimp.document.head.appendChild(css);

            ventimp.print();
            ventimp.close();

        });

        enero.click(function(){
            //alert("asdasd");
            var ins =$('input.form-control.text-Enero').val();
            var frecuencia = $('strong.indicefEnero').text();
            var gravedad = $('strong.indicegEnero').text();
            if(ins!=0){
                var accidente = (((frecuencia/ins)*(gravedad/ins))/1000).toFixed(2);
                var respon = (((frecuencia/ins)*(gravedad/ins))/2).toFixed(2);
                $('span.indiceftEnero').text((frecuencia/ins).toFixed(2));
                $('span.indicegtEnero').text((gravedad/ins).toFixed(2));
                $('span.indiceatEnero').text(accidente);
                $('span.indicertEnero').text(respon);
            }
        });
        febrero.click(function(){
            //alert("asdasd");
            var ins =$('input.form-control.text-Febrero').val();
            var frecuencia = $('strong.indicefFebrero').text();
            var gravedad = $('strong.indicegFebrero').text();
            if(ins!=0){
                var accidente = (((frecuencia/ins)*(gravedad/ins))/1000).toFixed(2);
                var respon = (((frecuencia/ins)*(gravedad/ins))/2).toFixed(2);
                $('span.indiceftFebrero').text((frecuencia/ins).toFixed(2));
                $('span.indicegtFebrero').text((gravedad/ins).toFixed(2));
                $('span.indiceatFebrero').text(accidente);
                $('span.indicertFebrero').text(respon);
            }
        });
        marzo.click(function(){
            //alert("asdasd");
            var ins =$('input.form-control.text-Marzo').val();
            var frecuencia = $('strong.indicefMarzo').text();
            var gravedad = $('strong.indicegMarzo').text();
            if(ins!=0){
                var accidente = (((frecuencia/ins)*(gravedad/ins))/1000).toFixed(2);
                var respon = (((frecuencia/ins)*(gravedad/ins))/2).toFixed(2);
                $('span.indiceftMarzo').text((frecuencia/ins).toFixed(2));
                $('span.indicegtMarzo').text((gravedad/ins).toFixed(2));
                $('span.indiceatMarzo').text(accidente);
                $('span.indicertMarzo').text(respon);
            }
        });
        abril.click(function(){
            //alert("asdasd");
            var ins =$('input.form-control.text-Abril').val();
            var frecuencia = $('strong.indicefAbril').text();
            var gravedad = $('strong.indicegAbril').text();
            if(ins!=0){
                var accidente = (((frecuencia/ins)*(gravedad/ins))/1000).toFixed(2);
                var respon = (((frecuencia/ins)*(gravedad/ins))/2).toFixed(2);
                $('span.indiceftAbril').text((frecuencia/ins).toFixed(2));
                $('span.indicegtAbril').text((gravedad/ins).toFixed(2));
                $('span.indiceatAbril').text(accidente);
                $('span.indicertAbril').text(respon);
            }
        });
        mayo.click(function(){
            //alert("asdasd");
            var ins =$('input.form-control.text-Mayo').val();
            var frecuencia = $('strong.indicefMayo').text();
            var gravedad = $('strong.indicegMayo').text();
            if(ins!=0){
                var accidente = (((frecuencia/ins)*(gravedad/ins))/1000).toFixed(2);
                var respon = (((frecuencia/ins)*(gravedad/ins))/2).toFixed(2);
                $('span.indiceftMayo').text((frecuencia/ins).toFixed(2));
                $('span.indicegtMayo').text((gravedad/ins).toFixed(2));
                $('span.indiceatMayo').text(accidente);
                $('span.indicertMayo').text(respon);
            }
        });
        junio.click(function(){
            //alert("asdasd");
            var ins =$('input.form-control.text-Junio').val();
            var frecuencia = $('strong.indicefJunio').text();
            var gravedad = $('strong.indicegJunio').text();
            if(ins!=0){
                var accidente = (((frecuencia/ins)*(gravedad/ins))/1000).toFixed(2);
                var respon = (((frecuencia/ins)*(gravedad/ins))/2).toFixed(2);
                $('span.indiceftJunio').text((frecuencia/ins).toFixed(2));
                $('span.indicegtJunio').text((gravedad/ins).toFixed(2));
                $('span.indiceatJunio').text(accidente);
                $('span.indicertJunio').text(respon);
            }
        });
        julio.click(function(){
            //alert("asdasd");
            var ins =$('input.form-control.text-Julio').val();
            var frecuencia = $('strong.indicefJulio').text();
            var gravedad = $('strong.indicegJulio').text();
            if(ins!=0){
                var accidente = (((frecuencia/ins)*(gravedad/ins))/1000).toFixed(2);
                var respon = (((frecuencia/ins)*(gravedad/ins))/2).toFixed(2);
                $('span.indiceftJulio').text((frecuencia/ins).toFixed(2));
                $('span.indicegtJulio').text((gravedad/ins).toFixed(2));
                $('span.indiceatJulio').text(accidente);
                $('span.indicertJulio').text(respon);
            }
        });
        agosto.click(function(){
            //alert("asdasd");
            var ins =$('input.form-control.text-Agosto').val();
            var frecuencia = $('strong.indicefAgosto').text();
            var gravedad = $('strong.indicegAgosto').text();
            if(ins!=0){
                var accidente = (((frecuencia/ins)*(gravedad/ins))/1000);
                var respon = (((frecuencia/ins)*(gravedad/ins))/2);
                $('span.indiceftAgosto').text((frecuencia/ins));
                $('span.indicegtAgosto').text((gravedad/ins));
                $('span.indiceatAgosto').text(accidente);
                $('span.indicertAgosto').text(respon);
            }
        });
        septiembre.click(function(){
            //alert("asdasd");
            var ins =$('input.form-control.text-Septiembre').val();
            var frecuencia = $('strong.indicefSeptiembre').text();
            var gravedad = $('strong.indicegSeptiembre').text();
            if(ins!=0){
                var accidente = (((frecuencia/ins)*(gravedad/ins))/1000).toFixed(2);
                var respon = (((frecuencia/ins)*(gravedad/ins))/2).toFixed(2);
                $('span.indiceftSeptiembre').text((frecuencia/ins).toFixed(2));
                $('span.indicegtSeptiembre').text((gravedad/ins).toFixed(2));
                $('span.indiceatSeptiembre').text(accidente);
                $('span.indicertSeptiembre').text(respon);
            }
        });
        octubre.click(function(){
            //alert("asdasd");
            var ins =$('input.form-control.text-Octubre').val();
            var frecuencia = $('strong.indicefOctubre').text();
            var gravedad = $('strong.indicegOctubre').text();
            if(ins!=0){
                var accidente = (((frecuencia/ins)*(gravedad/ins))/1000).toFixed(2);
                var respon = (((frecuencia/ins)*(gravedad/ins))/2).toFixed(2);
                $('span.indiceftOctubre').text((frecuencia/ins).toFixed(2));
                $('span.indicegtOctubre').text((gravedad/ins).toFixed(2));
                $('span.indiceatOctubre').text(accidente);
                $('span.indicertOctubre').text(respon);
            }
        });
        noviembre.click(function(){
            //alert("asdasd");
            var ins =$('input.form-control.text-Noviembre').val();
            var frecuencia = $('strong.indicefNoviembre').text();
            var gravedad = $('strong.indicegNoviembre').text();
            if(ins!=0){
                var accidente = (((frecuencia/ins)*(gravedad/ins))/1000).toFixed(2);
                var respon = (((frecuencia/ins)*(gravedad/ins))/2).toFixed(2);
                $('span.indiceftNoviembre').text((frecuencia/ins).toFixed(2));
                $('span.indicegtNoviembre').text((gravedad/ins).toFixed(2));
                $('span.indiceatNoviembre').text(accidente);
                $('span.indicertNoviembre').text(respon);
            }
        });
        diciembre.click(function(){
            //alert("asdasd");
            var ins =$('input.form-control.text-Diciembre').val();
            var frecuencia = $('strong.indicefDiciembre').text();
            var gravedad = $('strong.indicegDiciembre').text();
            if(ins!=0){
                var accidente = (((frecuencia/ins)*(gravedad/ins))/1000).toFixed(2);
                var respon = (((frecuencia/ins)*(gravedad/ins))/2).toFixed(2);
                $('span.indiceftDiciembre').text((frecuencia/ins).toFixed(2));
                $('span.indicegtDiciembre').text((gravedad/ins).toFixed(2));
                $('span.indiceatDiciembre').text(accidente);
                $('span.indicertDiciembre').text(respon);
            }
        });
    });

</script>

<!-- [Content] end -->
