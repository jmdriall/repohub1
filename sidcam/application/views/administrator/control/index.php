<script type="text/javascript">
$(document).ready(function()
{
	$("#select_all").click(function()
	{
		var checked_status = this.checked;
		if ( checked_status )
		{
			$("input[name='control_id[]']").attr('checked', true);
		}
		else
		{
			$("input[name='control_id[]']").attr('checked', false);
		}
	});
});

function confirm_delete(control_id)
{
	var answer = '<?php echo lang('backend_delete_control_confirm_selected'); ?>';
    if ( confirm(answer) == true ){
        document.messages.submit();
    }
    return false;
}
</script>

<!-- [Content] start -->
<h1><?php echo lang('backend_control_administrator'); ?></h1>
<?php ?><ul class="general_option">
    <li class="add_button"><?php echo anchor('administrator/control/insertControl/'.$seguimiento_id, lang('backend_insert_control'));?></li>
</ul>

<hr />
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/seguimiento/index/'.$user_id, 'Volver Seguimiento');?></li>
</ul>
<?php echo form_open('administrator/control/deleteControl'); ?>

<table id="myTable" width="100%" class="main_table" border="0" cellpadding="0" cellspacing="0">
    <thead>
    <tr class="table_header">
        <th><strong><?php echo lang('backend_titulo'); ?></strong></th>
        <!-- <th align="center"><strong>Art&iacute;culos</strong></th> -->
        <th align="center"><strong><?php echo lang('backend_edit'); ?></strong></th>
        <?php ?><th><strong><?php echo lang('backend_delete'); ?></strong></th><?php ?>
        <?php ?><th><strong><?php echo lang('backend_estado'); ?></strong></th><?php ?>
    </tr>
    </thead>
    <?php
    if( $controls )
    {
        $counter = 0;
        foreach($controls as $row)
        {

            $background = 'style="background:#FFFFFF; height:30px; "';
            if( ($counter % 2) == 0 )
            {
                $background = 'style="background:#E5E5E5; height:30px; "';
            }
            //$total_slide = $this->sub_control_model->getTotalSub_controlsBy_controlId($row->control_id);
            ?>
            <tr <?php echo $background; ?>>
                <td><?php echo $row->responsable; ?></td>
                <td align="center"><?php echo anchor('administrator/control/updateControl/' . $row->control_id.'/'.$seguimiento_id, lang('backend_edit')) ?></td>
                <td align="center"><?php echo anchor('administrator/control/deleteControl/' . $row->control_id.'/'.$seguimiento_id, lang('backend_delete')) ?></td>
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