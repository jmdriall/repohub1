<?php
$num = 1;
$filas = explode('/',$_SERVER['REQUEST_URI']);
$page = $filas[count($filas)-2];
if( $this->session->userdata('page') == 'inicio' )     { $num = 1;  }
if( $page == 'operacion' )   { $num = 2;  }
if( $page == 'planificacion' ){ $num = 3;  }
if( $page == 'indicadores' )  { $num = 4;  }
if( $page == 'politica' )    { $num = 5;  }
if( $page == 'evaluacion' )    { $num = 6;  }
?>
<footer <?php if($num == 5){echo "style='margin-top: 0px;'";} ?>>
    <div class="container" style="position:relative;">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
                <p>Sicamb @ 2014 | Todos los derechos reservados</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <ul class="text-center">
                    <li<?php if($num==1){ echo ' class="active"'; } ?>><?php echo anchor('client/home/index', 'Inicio'); ?></li>
                    <li<?php if($num==5){ echo ' class="active"'; } ?>><?php echo anchor('client/politica/index', 'Pol&iacute;tica'); ?></li>
                    <li<?php if($num==6){ echo ' class="active"'; } ?>><?php// echo anchor('client/evaluacion/index', 'Evaluaci&oacute;n'); ?></li>
                    <li<?php if($num==2){ echo ' class="active"'; } ?>><?php echo anchor('client/operacion/index', 'Operaci&oacute;n'); ?></li>
                    <li<?php if($num==3){ echo ' class="active"'; } ?>><?php echo anchor('client/planificacion/index', 'Planificaci&oacute;n'); ?></li>
                    <li<?php if($num==4){ echo ' class="active"'; } ?>><?php echo anchor('client/indicadores/index', 'Indicadores de Gesti&oacute;n'); ?></li>

                    
                </ul>
            </div>
        </div>
    	<img src="<?php echo base_url(); ?>resources/images/img_mama_2.png" class="bgb_img hidden-xs hidden-sm" <?php if($num == 5){echo "style='left: -100px;'";} ?> />
    </div>
</footer>