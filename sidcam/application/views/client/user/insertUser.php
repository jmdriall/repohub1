<h1><?php echo lang('backend_insert_user'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/user/index', lang('backend_list_users'));?></li>
</ul>
<hr />
<?php echo form_open('administrator/user/insertUser', array('class'=>'cmxform', 'id'=>'insertform')); ?>
<table width="80%" align="center" border="0" cellspacing="0" cellpadding="6">
    <tr>
        <td width="150" align="right" valign="top"><strong>*<?php echo lang('backend_firstname'); ?>:</strong></td>
        <td align="left">
            <?php echo form_input('firstname', $this->input->post('firstname'),'size=40');?>
            <?php echo form_error('firstname'); ?>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_lastname'); ?>:</strong></td>
        <td align="left">
            <?php echo form_input('lastname', $this->input->post('lastname'),'size=40');?>
            <?php echo form_error('lastname'); ?>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_email'); ?>:</strong></td>
        <td align="left">
            <?php echo form_input('email', $this->input->post('email'),'size=40');?>
            <?php echo form_error('email'); ?>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_login'); ?>:</strong></td>
        <td align="left">
            <?php echo form_input('login', $this->input->post('login'),'size=40');?>
            <?php echo form_error('login'); ?>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_password'); ?>:</strong></td>
        <td align="left">
            <?php echo form_input('password', $this->input->post('password'),'size=40');?>
            <?php echo form_error('password'); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
          <br />
          <?php
          echo form_hidden('subm_form', '1');
          echo form_submit(array('name'=>'submit', 'value'=>lang('backend_save'), 'id'=>'submit_button'));
          echo ' ';
          echo form_button(array('name'=>'cancel', 'content'=>lang('backend_cancel'), 'id'=>'cancel_button','onclick'=>"javascript: window.location.href='".site_url('administrator/user/index')."'"));
          ?>
        </td>
    </tr>
</table>
<?php echo form_close(); ?>
<!-- [Content] end -->