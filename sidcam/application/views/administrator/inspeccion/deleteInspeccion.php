<script language="JavaScript">
    function confirm_delete(inspeccion_id)
    {
        var answer = '<?php echo lang('backend_delete_confirm'); ?>';
        if ( confirm(answer) == true ){
            document.messages.submit();
        }
        return false;
    }
</script>
<!-- [Content] start -->
<h1><?php echo lang('backend_delete_inspeccion'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/inspeccion/index/'.$user_id, lang('backend_list_inspeccions'));?></li>
</ul>
<hr />

<p class="warning"><?php echo lang('backend_warning_message'); ?></p>
<?php echo form_open('administrator/inspeccion/deleteInspeccion', array('class'=>'login')); ?>
<table width="80%" align="center" border="0" cellspacing="0" cellpadding="6">
    <tr>
        <td align="right"><strong><?php echo lang('backend_nombre'); ?>:</strong></td>
        <td>
            <?php
            echo $titulo;
            if ($titulo === '')
            {
                echo '---';
            }
            ?>
        </td>
    </tr>
    <tr style="display: none">
        <td valign="top" align="right"><strong><?php echo lang('backend_inspeccion'); ?>:</strong></td>
        <td valign="top">
            <?php
            $path = base_url() . 'resources/media/inspeccion/thumbs/' . $picture;
            if ($picture != '' ) //and is_file($path)
            {
                ?>
                <img src="<?php echo $path; ?>" /><br />
            <?php
            }
            else
            {
                echo lang('backend_without_inspeccion');
            }
            ?>	</td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <?php
            echo form_hidden('user_id',$user_id);

            ?>

            <input type="hidden" name="subm_form" value="1"  />
            <input type="hidden" name="inspeccion_id" value="<?php echo $inspeccion_id; ?>"  />
            <input type="submit" name="submit" value="<?php echo lang('backend_delete'); ?>" id="submit_button" class="input-submit" onclick="return confirm_delete(<?php echo $inspeccion_id; ?>);"/>
            <input name="cancel" type="button" value="<?php echo lang('backend_cancel'); ?>" id="cancel_button" class="input-submit" onClick="javascript: window.location.href='<?php echo site_url('administrator/inspeccion/index/'.$user_id); ?>'"/>   </td>
    </tr>
</table>
</form>

<!-- [Content] end -->
