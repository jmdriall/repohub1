<div id="box_top"><img src="<?php echo base_url(); ?>system/application/resources/images/login/login_top.jpg" border="0" alt="top" /></div>

<div id="box_content">
    <?php echo form_open('administrator/login/forgotPassword',array('class'=>'login')); ?>
        <table width="100%" border="0">
          <tr>
            <td>
                <h1><?php echo lang('backend_forgot'); ?></h1>
            </td>
          </tr>
          <tr>
            <td>
                <div id="fields_form">
                    <table width="100%" border="0" cellpadding="4">
                      <tr>
                        <td width="34%"><p class="label_form"><?php echo lang('backend_user'); ?>:</p></td>
                      </tr>
                      <tr>
                        <td width="66%" align="center">
                        	<input name="login" style="width:70%;" type="text" />
                            <?php echo $this->validation->error_string; ?>
                        </td>
                      </tr>
                      <tr>
                      	<td align="center">
                                <?php
                                if( isset($no_user) ){
                                    echo '<span class="warning">The email couldn\'t be send it for some reason..</span>';
                                }
                                ?>
                		</td>
                      </tr>
                      <tr height="55">
                      	<td valign="top">
                        	<?php echo anchor('administrator/login/index', lang('backend_go_back'), array("class" =>"link_login" ) ); ?>
                        </td>
                      </tr>
                    </table>

                </div>
                <div id="button_form">
                    <input name="submit" id="submit_button" type="submit" value="<?php echo lang('backend_send'); ?>" />
                </div>
                
            </td>
          </tr>
        </table>
        <input type="hidden" name="submit_form" value="1" />
    </form>
</div>

<div id="box_bottom"><img src="<?php echo base_url(); ?>system/application/resources/images/login/login_botom.jpg" border="0" alt="bottom" /></div>
