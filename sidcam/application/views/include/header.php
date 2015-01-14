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
<div class="navbar navbar-inverse header" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php echo anchor('client/home', img(array('src' => 'resources/images/logosid.png','height'=>'70','style'=>'margin-top:10px')), array('style'=>'position:relative;z-index:1;')); ?>
    </div>
    <div class="navbar-collapse collapse" style="position: relative">
        <ul class="nav navbar-nav">
            <li<?php if($num==1){ echo ' class="active"'; } ?>><?php echo anchor('client/home/index', 'Inicio'); ?></li>
            <li<?php if($num==5){ echo ' class="active"'; } ?>><?php echo anchor('client/politica/index', 'Pol&iacute;tica'); ?></li>
            <!--<li<?php if($num==6){ echo ' class="active"'; } ?>><?php echo anchor('client/evaluacion/index', 'Evaluaci&oacute;n'); ?></li> -->
            <li<?php if($num==2){ echo ' class="active"'; } ?>><?php echo anchor('client/operacion/index', 'Operaci&oacute;n'); ?></li>
            <li<?php if($num==3){ echo ' class="active"'; } ?>><?php echo anchor('client/planificacion/index', 'Planificaci&oacute;n'); ?></li>
            <li<?php if($num==4){ echo ' class="active"'; } ?>><?php echo anchor('client/indicadores/index', 'Indicadores de Gesti&oacute;n'); ?></li>
            <!-- <li<?php// if($num==5){ echo ' class="active"'; } ?>><?php //echo anchor('contact', 'Contacto'); ?></li>-->
        </ul>
        <a href="../login/logout" style="float: right;position: absolute;right: 15px; top:10px">Cerrar Session</a>
    </div>
  </div>
</div>
<?php 

 ?>