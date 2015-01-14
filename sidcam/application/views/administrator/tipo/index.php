<script type="text/javascript">
$(document).ready(function()
{
	$("#select_all").click(function()
	{
		var checked_status = this.checked;
		if ( checked_status )
		{
			$("input[name='tipo_id[]']").attr('checked', true);
		}
		else
		{
			$("input[name='tipo_id[]']").attr('checked', false);
		}
	});
});

function confirm_delete(tipo_id)
{
	var answer = '<?php echo lang('backend_delete_tipo_confirm_selected'); ?>';
    if ( confirm(answer) == true ){
        document.messages.submit();
    }
    return false;
}
</script>

<!-- [Content] start -->
<h1><?php echo lang('backend_tipo_administrator'); ?></h1>
<?php ?><ul class="general_option" style="display: none">
    <li class="add_button"><?php echo anchor('administrator/tipo/insertTipo/'.$user_id, lang('backend_insert_tipo'));?></li>
</ul>

<hr />
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/home/copyindex/'.$user_id, 'Volver Principal');?></li>
</ul>
<?php echo form_open('administrator/tipo/deleteTipo'); ?>

<table id="myTable" width="100%" class="main_table" border="0" cellpadding="0" cellspacing="0">
    <thead>
    <tr class="table_header">
        <th><strong><?php echo lang('backend_nombre'); ?></strong></th>
        <!-- <th align="center"><strong>Art&iacute;culos</strong></th> -->
        <th align="center" style="display: none"><strong><?php echo lang('backend_edit'); ?></strong></th>
        <?php ?><th style="display: none"><strong><?php echo lang('backend_delete'); ?></strong></th><?php ?>
    </tr>
    </thead>
    <?php
    if( $tipos )
    {
        $counter = 0;
        foreach($tipos as $row)
        {

            $background = 'style="background:#FFFFFF; height:30px; "';
            if( ($counter % 2) == 0 )
            {
                $background = 'style="background:#E5E5E5; height:30px; "';
            }
            //$total_slide = $this->sub_tipo_model->getTotalSub_tiposBy_tipoId($row->tipo_id);
            ?>
            <tr <?php echo $background; ?>>
                <td><?php echo $row->nombre; ?></td>
                <!-- <td align="center"><?php //echo anchor('administrator/sub_tipo/index/' . $row->tipo_id, ' Total ( ' . $total_slide . ' ) ') ?></td> -->
                <td align="center" style="display: none"><?php echo anchor('administrator/tipo/updateTipo/' . $row->tipo_id.'/'.$user_id, lang('backend_edit')) ?></td>
                <td align="center" style="display: none"><?php echo anchor('administrator/tipo/deleteTipo/' . $row->tipo_id.'/'.$user_id, lang('backend_delete')) ?></td>
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