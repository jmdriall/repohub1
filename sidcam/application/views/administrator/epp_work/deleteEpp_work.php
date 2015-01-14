<script language="JavaScript">
    function confirm_delete(epp_work_id)
    {
        var answer = '<?php echo lang('backend_delete_confirm'); ?>';
        if ( confirm(answer) == true ){
            document.messages.submit();
        }
        return false;
    }
</script>
<!-- [Content] start -->
<h1><?php echo lang('backend_delete_epp_work'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/epp_work/index/'.$trabajador_id, lang('backend_list_epp_works'));?></li>
</ul>
<hr />

<p class="warning"><?php echo lang('backend_warning_message'); ?></p>
<?php echo form_open('administrator/epp_work/deleteEpp_work', array('class'=>'login')); ?>
<table width="80%" align="center" border="0" cellspacing="0" cellpadding="6">
    <tr>
        <td align="right"><strong><?php echo lang('backend_title'); ?>:</strong></td>
        <td>
            <?php
            echo $title;
            if ($title === '')
            {
                echo '---';
            }
            ?>
        </td>
    </tr>


    <tr>
        <td colspan="2" align="center">
            <?php
            echo form_hidden('trabajador_id',$trabajador_id);

            ?>

            <input type="hidden" name="subm_form" value="1"  />
            <input type="hidden" name="epp_work_id" value="<?php echo $epp_work_id; ?>"  />
            <input type="submit" name="submit" value="<?php echo lang('backend_delete'); ?>" id="submit_button" class="input-submit" onclick="return confirm_delete(<?php echo $epp_work_id; ?>);"/>
            <input name="cancel" type="button" value="<?php echo lang('backend_cancel'); ?>" id="cancel_button" class="input-submit" onClick="javascript: window.location.href='<?php echo site_url('administrator/epp_work/index/'.$trabajador_id); ?>'"/>   </td>
    </tr>
</table>
</form>

<!-- [Content] end -->
