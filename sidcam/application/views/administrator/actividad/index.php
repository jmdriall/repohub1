<script type="text/javascript">
$(document).ready(function()
{
	$("#select_all").click(function()
	{
		var checked_status = this.checked;
		if ( checked_status )
		{
			$("input[name='actividad_id[]']").attr('checked', true);
		}
		else
		{
			$("input[name='actividad_id[]']").attr('checked', false);
		}
	});
});

function confirm_delete(actividad_id)
{
	var answer = '<?php echo lang('backend_delete_actividad_confirm_selected'); ?>';
    if ( confirm(answer) == true ){
        document.messages.submit();
    }
    return false;
}
</script>

<!-- [Content] start -->
<h1><?php echo lang('backend_actividad_administrator'); ?></h1>
<?php ?><ul class="general_option">
    <li class="add_button"><?php echo anchor('administrator/actividad/insertActividad/'.$especifico_id.'/'.$user_id, lang('backend_insert_actividad'));?></li>
</ul>

<hr />
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/especifico/index/'.$objetivo_id, 'Volver Principal');?></li>
</ul>
<?php echo form_open('administrator/actividad/deleteActividad'); ?>

<table id="myTable" width="100%" class="main_table" border="0" cellpadding="0" cellspacing="0">
    <thead>
    <tr class="table_header">
        <th><strong><?php echo lang('backend_nombre'); ?></strong></th>
        <!-- <th align="center"><strong>Art&iacute;culos</strong></th> -->
        <th align="center"><strong><?php echo lang('backend_edit'); ?></strong></th>
        <?php ?><th><strong><?php echo lang('backend_delete'); ?></strong></th><?php ?>
        <th align="center"><strong><?php echo lang('backend_planificacion'); ?></strong></th>
    </tr>
    </thead>
    <?php
    if( $actividads )
    {
        $counter = 0;
        foreach($actividads as $row)
        {

            $background = 'style="background:#FFFFFF; height:30px; "';
            if( ($counter % 2) == 0 )
            {
                $background = 'style="background:#E5E5E5; height:30px; "';
            }
            //$total_slide = $this->sub_actividad_model->getTotalSub_actividadsBy_actividadId($row->actividad_id);
            ?>
            <tr <?php echo $background; ?>>
                <td><?php echo $row->nombre; ?></td>
                <!-- <td align="center"><?php //echo anchor('administrator/sub_actividad/index/' . $row->actividad_id, ' Total ( ' . $total_slide . ' ) ') ?></td> -->
                <td align="center"><?php echo anchor('administrator/actividad/updateActividad/' . $row->actividad_id.'/'.$especifico_id.'/'.$user_id, lang('backend_edit')) ?></td>
                <td align="center"><?php echo anchor('administrator/actividad/deleteActividad/' . $row->actividad_id.'/'.$especifico_id.'/'.$user_id, lang('backend_delete')) ?></td>
                <td align="center"><?php echo anchor('administrator/planificacion/index/' . $row->actividad_id, lang('backend_planificacion')) ?></td>
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
<?php ?>   <!--   <input name="select_all" id="select_all" type="checkbox" value="1" />
      <input type="submit" name="submit" value="<?php echo lang('backend_delete'); ?>" id="submit_button" class="input-submit"/> -->
      <input name="subm_form" type="hidden" value="batch" />
</form><?php ?>
<?php echo $this->pagination->create_links(); ?>
<!-- [Content] end -->