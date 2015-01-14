<div id="box_top"><img src="<?php echo base_url(); ?>system/application/resources/images/login/login_top.jpg" border="0" alt="top" /></div>

<div id="box_content">
    <?php echo form_open('administrator/login/index',array('class'=>'login')); ?>
        <table width="100%" border="0">
          <tr>
            <td>
                <h1><?php echo lang('backend_forgot'); ?></h1>
            </td>
          </tr>
          <tr>
            <td>
                <p>
                	<?php echo lang('backend_thank_you'); ?>
                </p>
                <div id="button_form" style="width:100%;" align="center">
                    <input name="submit" id="submit_button" type="submit" value="<?php echo lang('backend_go_back'); ?>" />
                </div>
                
            </td>
          </tr>
          <tr height="40">
            <td>
            
            </td>
          </tr>
        </table>
        <input type="hidden" name="submit_form" value="1" />
    </form>
</div>

<div id="box_bottom"><img src="<?php echo base_url(); ?>system/application/resources/images/login/login_botom.jpg" border="0" alt="bottom" /></div>
