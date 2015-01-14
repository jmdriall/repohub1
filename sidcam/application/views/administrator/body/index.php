<script type="text/javascript">
$(document).ready(function() 
{ 
	$("#select_all").click(function() 
	{ 
		var checked_status = this.checked; 
		if ( checked_status )
		{
			$("input[name='body_id[]']").attr('checked', true);
		}
		else
		{
			$("input[name='body_id[]']").attr('checked', false);
		}
	}); 
});

function confirm_delete()
{
	var answer = '<?php echo lang('backend_delete_body_confirm_selected'); ?>';
    if ( confirm(answer) == true ){
        document.messages.submit();
    }    
    return false;  
}
</script>

<!-- [Content] start -->
    <h1><?php echo lang('backend_body_administration'); ?></h1>
    <ul class="general_option">
        <li class="list_button"><?php echo anchor('administrator/home/copyindex/'.$user_id, 'volver');?></li>
        <li class="add_button"><?php echo anchor('administrator/body/insertBody/'.$user_id, lang('backend_insert_body')); ?></li>
    </ul>
    <hr />
<?php echo form_open('administrator/body/deleteBody'); ?>
    <table id="myTable" width="100%" class="main_table" border="0" cellpadding="0" cellspacing="0">
        <thead>
            <tr class="table_header">
                <th align="center"><strong><input name="select_all" id="select_all" type="checkbox" value="1" />#</strong></th>
                <th align="center"><strong><?php echo lang('backend_nombre'); ?></strong></th>
                <th align="center"><strong><?php echo lang('backend_edit'); ?></strong></th>
                <th align="center"><strong><?php echo lang('backend_delete'); ?></strong></th>
            </tr>
        </thead>
		<?php
        if( $bodys )
				{
					$counter = 0;
					foreach($bodys as $row)
					{
						$counter++;
						$background = 'style="background:#FFFFFF; height:30px; "';
						if( ($counter % 2) == 0 )
						{
							$background = 'style="background:#E5E5E5; height:30px; "';
						}
						?>
						<tr <?php echo $background; ?>>
                <td align="center"><input name="body_id[]" type="checkbox" value="<?php echo $row->body_id; ?>" /></td>
                <td align="center"><?php echo $row->nombre; ?></td>

								<td align="center"><?php echo anchor('administrator/body/updateBody/' . $row->body_id.'/'.$user_id, lang('backend_edit')) ?></td>
                <td align="center"><?php echo anchor('administrator/body/deleteBody/' . $row->body_id.'/'.$user_id, lang('backend_delete')) ?></td>
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
	echo br();
	echo form_hidden('subm_form', 'batch');
	echo form_submit(array('name'=>'submit', 'value'=>lang('backend_delete'), 'id'=>'submit_button', 'class'=>'input-submit', 'onclick'=>'return confirm_delete();'));
?>
<?php echo form_close(); ?>
<!-- [Content] end -->