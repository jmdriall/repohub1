<script type="text/javascript">
$(document).ready(function()
{
	$("#select_all").click(function()
	{
		var checked_status = this.checked;
		if ( checked_status )
		{
			$("input[name='trabajador_id[]']").attr('checked', true);
		}
		else
		{
			$("input[name='trabajador_id[]']").attr('checked', false);
		}
	});
});

function confirm_delete(trabajador_id)
{
	var answer = '<?php echo lang('backend_delete_trabajador_confirm_selected'); ?>';
    if ( confirm(answer) == true ){
        document.messages.submit();
    }
    return false;
}
</script>

<!-- [Content] start -->
<h1><?php echo lang('backend_trabajador_administrator'); ?></h1>
<?php ?><ul class="general_option">
    <li class="add_button"><?php echo anchor('administrator/trabajador/insertTrabajador/'.$user_id, lang('backend_insert_trabajador'));?></li>
</ul>

<hr />
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/home/copyindex/'.$user_id, 'Volver Principal');?></li>
</ul>
<?php echo form_open('administrator/trabajador/deleteTrabajador'); ?>

<table id="myTable" width="100%" class="main_table" border="0" cellpadding="0" cellspacing="0">
    <thead>
    <tr class="table_header">
        <th><strong><?php echo lang('backend_nombre'); ?></strong></th>
        <th><strong><?php echo lang('backend_apellidos'); ?></strong></th>
        <th><strong><?php echo lang('backend_capacitacion'); ?></strong></th>
        <th><strong><?php echo lang('backend_regla_recomendaciones'); ?></strong></th>
        <th><strong><?php echo lang('backend_epp'); ?></strong></th>
        <th><strong><?php echo lang('backend_examen_medico'); ?></strong></th>
        <!-- <th align="center"><strong>Art&iacute;culos</strong></th> -->
        <th align="center"><strong><?php echo lang('backend_edit'); ?></strong></th>
        <?php ?><th align="center"><strong><?php echo lang('backend_delete'); ?></strong></th><?php ?>
    </tr>
    </thead>
    <?php
    if( $trabajadors )
    {
        $counter = 0;
        foreach($trabajadors as $row)
        {

            $background = 'style="background:#FFFFFF; height:30px; "';
            if( ($counter % 2) == 0 )
            {
                $background = 'style="background:#E5E5E5; height:30px; "';
            }
            //$total_slide = $this->sub_trabajador_model->getTotalSub_trabajadorsBy_trabajadorId($row->trabajador_id);
            ?>
            <tr <?php echo $background; ?>>
                <td><?php echo $row->nombre; ?></td>
                <td><?php echo $row->apellidos; ?></td>
                <td>
                    <?php


                    echo anchor('administrator/capacitacion_work/index/' . $row->trabajador_id, 'Capacitaciones');
                    ?>
                </td>
                <td>
                    <?php
                    if($row->regla_recomendaciones == 0){
                        echo "No tiene";
                        echo br();

                    }
                    else{
                        echo "<strong>Cumplido</strong>";
                        echo br();
                    }
                    echo anchor('administrator/trabajador/UpRegla_recomendacionesTrabajador/' . $row->trabajador_id."/0/".$user_id, 'subir'); echo '&nbsp;&nbsp;&nbsp;&nbsp;';
                    echo anchor('administrator/trabajador/UpRegla_recomendacionesTrabajador/' . $row->trabajador_id."/1/".$user_id, 'quitar');
                    ?>
                </td>
                <td>
                    <?php
                    echo anchor('administrator/epp_work/index/'.$row->trabajador_id, 'Epps');
                    ?>
                </td>
                <td>
                    <?php
                    if($row->examen_medico == 0){
                        echo "No tiene";
                        echo br();

                    }
                    else{
                        echo "<strong>Cumplido</strong>";
                        echo br();
                    }
                    echo anchor('administrator/trabajador/UpExamen_medicoTrabajador/' . $row->trabajador_id."/0/".$user_id, 'subir'); echo '&nbsp;&nbsp;&nbsp;&nbsp;';
                    echo anchor('administrator/trabajador/UpExamen_medicoTrabajador/' . $row->trabajador_id."/1/".$user_id, 'quitar');
                    ?>
                </td>

                <!-- <td align="center"><?php //echo anchor('administrator/sub_trabajador/index/' . $row->trabajador_id, ' Total ( ' . $total_slide . ' ) ') ?></td> -->
                <td align="center"><?php echo anchor('administrator/trabajador/updateTrabajador/' . $row->trabajador_id."/".$user_id, lang('backend_edit')) ?></td>
                <td align="center"><?php echo anchor('administrator/trabajador/deleteTrabajador/' . $row->trabajador_id."/".$user_id, lang('backend_delete')) ?></td>
            </tr>
        <?php
        }
    }
    else
    { ?>
        <tr align="center">
            <td colspan="3"> <?php echo lang('backend_no_registries'); ?></td>
        </tr>
    <?php
    }?>
</table>
<?php ?> <!--     <input name="select_all" id="select_all" type="checkbox" value="1" />
      <input type="submit" name="submit" value="<?php echo lang('backend_delete'); ?>" id="submit_button" class="input-submit"/> -->
      <input name="subm_form" type="hidden" value="batch" />
</form><?php ?>
<?php echo $this->pagination->create_links(); ?>
<!-- [Content] end -->