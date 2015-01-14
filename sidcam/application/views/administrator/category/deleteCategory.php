<script language="JavaScript">
    function confirm_delete(category_id)
    {
        var answer = '<?php echo lang('backend_delete_confirm'); ?>';
        if ( confirm(answer) == true ){
            document.messages.submit();
        }
        return false;
    }
</script>
<!-- [Content] start -->
<h1><?php echo lang('backend_delete_category'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/category/index/', lang('backend_list_categorys'));?></li>
</ul>
<hr />

<p class="warning"><?php echo lang('backend_warning_message'); ?></p>
<?php echo form_open('administrator/category/deleteCategory', array('class'=>'login')); ?>
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
        <td valign="top" align="right"><strong><?php echo lang('backend_category'); ?>:</strong></td>
        <td valign="top">
            <?php
            $path = base_url() . 'resources/media/category/thumbs/' . $picture;
            if ($picture != '' ) //and is_file($path)
            {
                ?>
                <img src="<?php echo $path; ?>" /><br />
            <?php
            }
            else
            {
                echo lang('backend_without_category');
            }
            ?>	</td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <input type="hidden" name="subm_form" value="1"  />
            <input type="hidden" name="category_id" value="<?php echo $category_id; ?>"  />
            <input type="submit" name="submit" value="<?php echo lang('backend_delete'); ?>" id="submit_button" class="input-submit" onclick="return confirm_delete(<?php echo $category_id; ?>);"/>
            <input name="cancel" type="button" value="<?php echo lang('backend_cancel'); ?>" id="cancel_button" class="input-submit" onClick="javascript: window.location.href='<?php echo site_url('administrator/category/index/'); ?>'"/>   </td>
    </tr>
</table>
</form>

<!-- [Content] end -->
