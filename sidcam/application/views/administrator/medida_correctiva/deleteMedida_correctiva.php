<script language="JavaScript">
    function confirm_delete(medida_correctiva_id)
    {
        var answer = '<?php echo lang('backend_delete_confirm'); ?>';
        if ( confirm(answer) == true ){
            document.messages.submit();
        }
        return false;
    }
</script>
<!-- [Content] start -->
<h1><?php echo lang('backend_delete_medida_correctiva'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/medida_correctiva/index/'.$accidente_id, lang('backend_list_medida_correctivas'));?></li>
</ul>
<hr />

<p class="warning"><?php echo lang('backend_warning_message'); ?></p>
<?php echo form_open('administrator/medida_correctiva/deleteMedida_correctiva', array('class'=>'login')); ?>
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
        <td align="right"><strong><?php echo lang('backend_fecha_medida_correctiva'); ?>:</strong></td>
        <td>
            <?php
            echo $fecha_medida_correctiva;
            if ($fecha_medida_correctiva === '')
            {
                echo '---';
            }
            ?>
        </td>
    </tr>

    <tr>
        <td colspan="2" align="center">
            <?php
            echo form_hidden('accidente_id',$accidente_id);

            ?>

            <input type="hidden" name="subm_form" value="1"  />
            <input type="hidden" name="medida_correctiva_id" value="<?php echo $medida_correctiva_id; ?>"  />
            <input type="submit" name="submit" value="<?php echo lang('backend_delete'); ?>" id="submit_button" class="input-submit" onclick="return confirm_delete(<?php echo $medida_correctiva_id; ?>);"/>
            <input name="cancel" type="button" value="<?php echo lang('backend_cancel'); ?>" id="cancel_button" class="input-submit" onClick="javascript: window.location.href='<?php echo site_url('administrator/medida_correctiva/index/'.$accidente_id); ?>'"/>   </td>
    </tr>
</table>
</form>

<!-- [Content] end -->
