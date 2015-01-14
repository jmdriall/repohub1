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
<div class="container">
    <h1 class="text-center mar-top-15"><?php echo "Trabajadores"; ?></h1>
    <h3><?php echo anchor('client/indicadores/insertTrabajador/', lang('backend_insert_trabajador'));?></h3>
    <h3><?php echo anchor('client/indicadores/index/', 'Volver Indicadores');?></h3>
    <?php echo form_open('client/indicadores/deleteTrabajador'); ?>
    <div class="row">
        <div class="col-xs-12 indices">
            <div class="row">
                <div class="col-xs-2"><strong><?php echo lang('backend_nombre'); ?></strong></div>
                <div class="col-xs-8"><strong><?php echo lang('backend_apellidos'); ?></strong></div>
                <div class="col-xs-1"><strong><?php echo lang('backend_edit'); ?></strong></div>
                <div class="col-xs-1"><strong><?php echo lang('backend_delete'); ?></strong></div>
            </div>
        </div>
         <?php
            if( $trabajadors )
            {
                $counter = 0;
                foreach($trabajadors as $row)
                {

                    $background = 'style="background:#FFFFFF;"';
                    if( ($counter % 2) == 0 )
                    {
                        $background = 'style="background:#E5E5E5;"';
                    }
                    $counter++;
                    //$total_slide = $this->sub_trabajador_model->getTotalSub_trabajadorsBy_trabajadorId($row->trabajador_id);
                    ?>
                    <div class="col-xs-12" <?php echo $background; ?> >
                        <div class="row">
                            <div class="col-xs-2"><p><?php echo $row->nombre; ?></p></div>
                            <div class="col-xs-8"><p><?php echo $row->apellidos; ?></p></div>
                            <div class="col-xs-1"><p><?php echo anchor('client/indicadores/updateTrabajador/' . $row->trabajador_id, lang('backend_edit')) ?></p></div>
                            <div class="col-xs-1"><p><?php echo anchor('client/indicadores/deleteTrabajador/' . $row->trabajador_id, lang('backend_delete')) ?></p></div>
                        </div>
                    </div>

                <?php
                }
            }
            else
            { ?>
                <div class="col-xs-12">
                    <p><?php echo lang('backend_no_registries'); ?></p>
                </div>
            <?php
            }?>
    </div>
    <?php ?> <!--     <input name="select_all" id="select_all" type="checkbox" value="1" />
      <input type="submit" name="submit" value="<?php echo lang('backend_delete'); ?>" id="submit_button" class="input-submit"/> -->
    <input name="subm_form" type="hidden" value="batch" />
    </form><?php ?>
    <?php echo $this->pagination->create_links(); ?>
</div>
<!-- [Content] end -->