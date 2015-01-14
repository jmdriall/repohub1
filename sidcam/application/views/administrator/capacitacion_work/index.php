<script type="text/javascript">
$(document).ready(function()
{
	$("#select_all").click(function()
	{
		var checked_status = this.checked;
		if ( checked_status )
		{
			$("input[name='capacitacion_work_id[]']").attr('checked', true);
		}
		else
		{
			$("input[name='capacitacion_work_id[]']").attr('checked', false);
		}
	});
});

function confirm_delete(capacitacion_work_id)
{
	var answer = '<?php echo lang('backend_delete_capacitacion_work_confirm_selected'); ?>';
    if ( confirm(answer) == true ){
        document.messages.submit();
    }
    return false;
}
</script>

<!-- [Content] start -->
<h1><?php echo lang('backend_capacitacion_work_administrator'); ?></h1>
<?php ?><ul class="general_option">
    <li class="add_button"><?php echo anchor('administrator/capacitacion_work/insertCapacitacion_work/'.$trabajador_id, lang('backend_insert_capacitacion_work'));?></li>
</ul>

<hr />
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/trabajador/index/'.$user_id, 'Volver Trabajadores');?></li>
</ul>
<?php echo form_open('administrator/capacitacion_work/deleteCapacitacion_work'); ?>

<table id="myTable" width="100%" class="main_table" border="0" cellpadding="0" cellspacing="0">
    <thead>
    <tr class="table_header">
        <th><strong><?php echo lang('backend_title'); ?></strong></th>
        <th align="center"><strong><?php echo lang('backend_edit'); ?></strong></th>
        <?php ?><th><strong><?php echo lang('backend_delete'); ?></strong></th>
    </tr>
    </thead>
    <?php
    if( $capacitacion_works )
    {
        $counter = 0;
        foreach($capacitacion_works as $row)
        {

            $background = 'style="background:#FFFFFF; height:30px; "';
            if( ($counter % 2) == 0 )
            {
                $background = 'style="background:#E5E5E5; height:30px; "';
            }
            //$total_slide = $this->sub_capacitacion_work_model->getTotalSub_capacitacion_worksBy_capacitacion_workId($row->capacitacion_work_id);
            ?>
            <tr <?php echo $background; ?>>
                <td><?php echo $row->title; ?></td>
                <td align="center"><?php echo anchor('administrator/capacitacion_work/updateCapacitacion_work/' . $row->capacitacion_work_id.'/'.$trabajador_id, lang('backend_edit')) ?></td>
                <td align="center"><?php echo anchor('administrator/capacitacion_work/deleteCapacitacion_work/' . $row->capacitacion_work_id.'/'.$trabajador_id, lang('backend_delete')) ?></td>
                <td>  </td>
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