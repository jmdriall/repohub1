<script type="text/javascript">
$(document).ready(function()
{
	$("#select_all").click(function()
	{
		var checked_status = this.checked;
		if ( checked_status )
		{
			$("input[name='seguimiento_id[]']").attr('checked', true);
		}
		else
		{
			$("input[name='seguimiento_id[]']").attr('checked', false);
		}
	});
});

function confirm_delete(seguimiento_id)
{
	var answer = '<?php echo lang('backend_delete_seguimiento_confirm_selected'); ?>';
    if ( confirm(answer) == true ){
        document.messages.submit();
    }
    return false;
}
</script>

<!-- [Content] start -->
<h1><?php echo lang('backend_seguimiento_administrator'); ?></h1>
<?php ?><ul class="general_option">
    <li class="add_button"><?php echo anchor('administrator/seguimiento/insertSeguimiento/'.$user_id, lang('backend_insert_seguimiento'));?></li>
</ul>

<hr />
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/home/copyindex/'.$user_id, 'Volver Principal');?></li>
</ul>
<?php echo form_open('administrator/seguimiento/deleteSeguimiento'); ?>

<table id="myTable" width="100%" class="main_table" border="0" cellpadding="0" cellspacing="0">
    <thead>
    <tr class="table_header">
        <th><strong><?php echo lang('backend_titulo'); ?></strong></th>
        <!-- <th align="center"><strong>Art&iacute;culos</strong></th> -->
        <th align="center"><strong><?php echo lang('backend_edit'); ?></strong></th>
        <?php ?><th><strong><?php echo lang('backend_delete'); ?></strong></th><?php ?>
        <?php ?><th><strong><?php echo lang('backend_control'); ?></strong></th><?php ?>
    </tr>
    </thead>
    <?php
    if( $seguimientos )
    {
        $counter = 0;
        foreach($seguimientos as $row)
        {

            $background = 'style="background:#FFFFFF; height:30px; "';
            if( ($counter % 2) == 0 )
            {
                $background = 'style="background:#E5E5E5; height:30px; "';
            }
            //$total_slide = $this->sub_seguimiento_model->getTotalSub_seguimientosBy_seguimientoId($row->seguimiento_id);
            ?>
            <tr <?php echo $background; ?>>
                <td><?php echo $row->titulo; ?></td>
                <!-- <td align="center"><?php //echo anchor('administrator/sub_seguimiento/index/' . $row->seguimiento_id, ' Total ( ' . $total_slide . ' ) ') ?></td> -->
                <td align="center"><?php echo anchor('administrator/seguimiento/updateSeguimiento/' . $row->seguimiento_id.'/'.$user_id, lang('backend_edit')) ?></td>
                <td align="center"><?php echo anchor('administrator/seguimiento/deleteSeguimiento/' . $row->seguimiento_id.'/'.$user_id, lang('backend_delete')) ?></td>
                <td align="center"><?php echo anchor('administrator/control/index/' . $row->seguimiento_id, lang('backend_control')) ?></td>
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