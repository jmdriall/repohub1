<script type="text/javascript">
$(document).ready(function()
{
	$("#select_all").click(function()
	{
		var checked_status = this.checked;
		if ( checked_status )
		{
			$("input[name='archivo_id[]']").attr('checked', true);
		}
		else
		{
			$("input[name='archivo_id[]']").attr('checked', false);
		}
	});
});

function confirm_delete(archivo_id)
{
	var answer = '<?php echo lang('backend_delete_archivo_confirm_selected'); ?>';
    if ( confirm(answer) == true ){
        document.messages.submit();
    }
    return false;
}
</script>

<!-- [Content] start -->
    <h1><?php echo lang('backend_archivo_administrator');?></h1>

    <ul class="general_option">
        <li class="add_button"> <?php echo anchor('administrator/home/copyindex/'.$user_id, 'Volver Principal'); ?></li>
        <li class="add_button"><?php echo anchor('administrator/archivo/insertArchivo/'.$user_id, lang('backend_insert_archivo'));?></li>
    </ul>
    <hr />
<?php echo form_open('administrator/archivo/deleteArchivo'); ?>
<table id="myTable" width="100%" class="main_table" border="0" cellpadding="0" cellspacing="0">
    <thead>
    <tr class="table_header">
        <th align="center" width="6%"><strong><input name="select_all" id="select_all" type="checkbox" value="1" />#</strong></th>
        <th><strong><?php echo lang('backend_title'); ?></strong></th>
        <th align="center"><strong><?php echo "Nombre File"; ?></strong></th>
        <th align="center" width="10%"><strong><?php echo lang('backend_edit'); ?></strong></th>
        <th align="center" width="10%"><strong><?php echo lang('backend_delete'); ?></strong></th>
    </tr>
    </thead>
    <?php
    if( $archivos )
    {
        $counter = 0;
        foreach($archivos as $row)
        {

            $background = 'style="background:#FFFFFF; height:30px; "';
            if( ($counter % 2) == 0 )
            {
                $background = 'style="background:#E5E5E5; height:30px; "';
            }
            ?>
            <tr <?php echo $background; ?>>
            	<td align="center"><?php echo form_checkbox(array('name'=>'archivo_id[]', 'value'=>$row->archivo_id));?></td>
                <td><?php echo $row->title; ?></td>
                <td align="center"><?php
				if($row->picture!=''){
					echo $row->picture;
				}else{
					echo "----";
				}?></td>
                <td align="center"><?php echo anchor('administrator/archivo/updateArchivo/' . $row->archivo_id, lang('backend_edit')) ?></td>
                <td align="center"><?php echo anchor('administrator/archivo/deleteArchivo/' . $row->archivo_id, lang( 'backend_delete' )); ?></td>
            </tr>
        <?php
        }
    }
    else
    { ?>
        <tr align="center">
            <td colspan="6"> <?php echo lang('backend_no_registries'); ?></td>
        </tr>
    <?php
    }?>
</table>
<?php
	echo form_submit(array('name'=>'submit','value'=>lang('backend_delete'),'id'=>'submit_button','class'=>'input-submit'));
	echo form_hidden('subm_form', 'batch');
    echo form_hidden('user_id', $user_id);
echo form_close();
?>
<!-- [Content] end -->