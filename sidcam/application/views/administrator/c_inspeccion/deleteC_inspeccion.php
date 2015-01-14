<script language="JavaScript">
    function confirm_delete(c_inspeccion_id)
    {
        var answer = '<?php echo lang('backend_delete_confirm'); ?>';
        if ( confirm(answer) == true ){
            document.messages.submit();
        }
        return false;
    }
</script>
<!-- [Content] start -->
<h1><?php echo lang('backend_delete_c_inspeccion'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/c_inspeccion/index/'.$inspeccion_id, lang('backend_list_c_inspeccions'));?></li>
</ul>
<hr />

<p class="warning"><?php echo lang('backend_warning_message'); ?></p>
<?php echo form_open('administrator/c_inspeccion/deleteC_inspeccion', array('class'=>'login')); ?>
<table width="80%" align="center" border="0" cellspacing="0" cellpadding="6">
    <tr>
        <td align="right"><strong><?php echo lang('backend_nombre'); ?>:</strong></td>
        <td>
            <?php
            echo $responsable;
            if ($responsable === '')
            {
                echo '---';
            }
            ?>
        </td>
    </tr>
    <tr>
        <td align="right"><strong><?php echo lang('backend_evidencia'); ?>:</strong></td>
        <td>
            <?php
            echo $evidencia;
            if ($evidencia === '')
            {
                echo '---';
            }
            ?>
        </td>
    </tr>
    <tr>
        <td align="right"><strong><?php echo lang('backend_fecha_c_inspeccion'); ?>:</strong></td>
        <td>
            <?php
            echo $fecha_c_inspeccion;
            if ($fecha_c_inspeccion === '')
            {
                echo '---';
            }
            ?>
        </td>
    </tr>

    <tr>
        <td colspan="2" align="center">
            <?php
            echo form_hidden('inspeccion_id',$inspeccion_id);

            ?>

            <input type="hidden" name="subm_form" value="1"  />
            <input type="hidden" name="c_inspeccion_id" value="<?php echo $c_inspeccion_id; ?>"  />
            <input type="submit" name="submit" value="<?php echo lang('backend_delete'); ?>" id="submit_button" class="input-submit" onclick="return confirm_delete(<?php echo $c_inspeccion_id; ?>);"/>
            <input name="cancel" type="button" value="<?php echo lang('backend_cancel'); ?>" id="cancel_button" class="input-submit" onClick="javascript: window.location.href='<?php echo site_url('administrator/c_inspeccion/index/'.$inspeccion_id); ?>'"/>   </td>
    </tr>
</table>
</form>

<!-- [Content] end -->
