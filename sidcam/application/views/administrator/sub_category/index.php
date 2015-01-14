<script type="text/javascript">
$(document).ready(function()
{
	$("#select_all").click(function()
	{
		var checked_status = this.checked;
		if ( checked_status )
		{
			$("input[name='sub_category_id[]']").attr('checked', true);
		}
		else
		{
			$("input[name='sub_category_id[]']").attr('checked', false);
		}
	});
});

function confirm_delete(sub_category_id)
{
	var answer = '<?php echo lang('backend_delete_sub_category_confirm_selected'); ?>';
    if ( confirm(answer) == true ){
        document.messages.submit();
    }
    return false;
}
</script>

<!-- [Content] start -->
    <h1><?php echo lang('backend_sub_category_administrator');?></h1>
    <ul class="general_option">
        <li class="add_button"> <?php echo anchor('administrator/category/index/', lang('backend_list_categorys')); ?></li>
        <?php
            $cat_cant = 0;
            if($sub_categorys){
                foreach($sub_categorys as $row){
                    $cat_cant++;
                }
            }
            if ($cat_cant == 0){
         ?>
            <li class="add_button"><?php echo anchor('administrator/sub_category/insertSub_category/'.$category_id, lang('backend_insert_sub_category'));?></li>
        <?php } ?>
    </ul>
    <hr />
<?php echo form_open('administrator/sub_category/deleteSub_category'); ?>
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
    if( $sub_categorys )
    {
        $counter = 0;
        foreach($sub_categorys as $row)
        {

            $background = 'style="background:#FFFFFF; height:30px; "';
            if( ($counter % 2) == 0 )
            {
                $background = 'style="background:#E5E5E5; height:30px; "';
            }
            ?>
            <tr <?php echo $background; ?>>
            	<td align="center"><?php echo form_checkbox(array('name'=>'sub_category_id[]', 'value'=>$row->sub_category_id));?></td>
                <td><?php echo $row->title; ?></td>
                <td align="center"><?php
				if($row->picture!=''){
					echo $row->picture;
				}else{
					echo "----";
				}?></td>
                <td align="center"><?php echo anchor('administrator/sub_category/updateSub_category/' . $row->sub_category_id, lang('backend_edit')) ?></td>
                <td align="center"><?php echo anchor('administrator/sub_category/deleteSub_category/' . $row->sub_category_id, lang( 'backend_delete' )); ?></td>
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
echo form_close();
?>
<!-- [Content] end -->