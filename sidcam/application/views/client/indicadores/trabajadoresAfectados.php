<script type="text/javascript">
$(document).ready(function()
{
	$("#select_all").click(function()
	{
		var checked_status = this.checked;
		if ( checked_status )
		{
			$("input[name='accidente_trabajador_id[]']").attr('checked', true);
		}
		else
		{
			$("input[name='accidente_trabajador_id[]']").attr('checked', false);
		}
	});
});

function confirm_delete(accidente_trabajador_id)
{
	var answer = '<?php echo lang('backend_delete_accidente_trabajador_confirm_selected'); ?>';
    if ( confirm(answer) == true ){
        document.messages.submit();
    }
    return false;
}
</script>

<!-- [Content] start -->
<div class="container">
    <div class="row mar-top-15">
        <div class="col-xs-12 text-center">
            <h1><?php echo 'Trabajadores Afectados'; ?></h1>
        </div>
        <div class="col-xs-12">
            <h2><?php echo anchor('client/indicadores/insertAccidente_trabajador/'.$accidente_id, 'Ingresar Trabajadores Afectados');?></li></h2>
        </div>

        <hr/>

        <div class="col-xs-12">
        <?php echo form_open('client/accidente_trabajador/deleteAccidente_trabajador'); ?>

        <table id="myTable" width="100%" class="main_table" border="0" cellpadding="0" cellspacing="0">
            <thead>
            <tr class="indices">
                <th><strong><?php echo lang('backend_nombre'); ?></strong></th>
                <th align="center"><strong><?php echo lang('backend_edit'); ?></strong></th>
                <?php ?><th><strong><?php echo lang('backend_delete'); ?></strong></th>
            </tr>
            </thead>
            <?php
            if( $accidente_trabajadors )
            {
                $counter = 0;
                foreach($accidente_trabajadors as $row)
                {

                    $background = 'style="background:#FFFFFF; height:30px; "';
                    if( ($counter % 2) == 0 )
                    {
                        $background = 'style="background:#E5E5E5; height:30px; "';
                    }
                    $counter++;
                    //$total_slide = $this->sub_accidente_trabajador_model->getTotalSub_accidente_trabajadorsBy_accidente_trabajadorId($row->accidente_trabajador_id);
                    ?>
                    <tr <?php echo $background; ?>>
                        <td class="text-center"><?php echo $row->nombre; ?></td>
                        <td align="center"><?php echo anchor('client/indicadores/updateAccidente_trabajador/' . $row->accidente_trabajador_id.'/'.$accidente_id, lang('backend_edit')) ?></td>
                        <td align="center"><?php echo anchor('client/indicadores/deleteAccidente_trabajador/' . $row->accidente_trabajador_id.'/'.$accidente_id, lang('backend_delete')) ?></td>
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
        </div>
        <div class="col-xs-12">
            <h3><?php echo anchor('client/indicadores/accidentes/'.$accidente_id, 'Volver Accidentes');?></h3>
        </div>
    </div>
</div>
<?php ?>   <!--   <input name="select_all" id="select_all" type="checkbox" value="1" />
      <input type="submit" name="submit" value="<?php echo lang('backend_delete'); ?>" id="submit_button" class="input-submit"/> -->
      <input name="subm_form" type="hidden" value="batch" />
</form><?php ?>
<?php echo $this->pagination->create_links(); ?>
<!-- [Content] end -->