<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>resources/plugins/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
    mode : "textareas",
    theme : "advanced",
    relative_urls : false,
    remove_script_host : false,
    document_base_url : "<?php echo base_url()?>",
    plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",

    // Theme options
    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
    theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : true,
    // Skin options
    skin : "o2k7",
    skin_variant : "silver"
});
</script>
<h1><?php echo lang('backend_update_seguimiento'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/seguimiento/index/'.$user_id, lang('backend_list_seguimientos'));?></li>
</ul>
<br />
<hr />

<?php echo form_open_multipart('administrator/seguimiento/updateSeguimiento', array('class'=>'cmxform', 'id'=>'updateform')); ?>
<table width="80%" align="center" border="0" cellspacing="0" cellpadding="6">
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_titulo'); ?>:</strong></td>
        <td align="left"><?php echo form_input('titulo', $titulo, 'size=80'); ?>
            <?php echo form_error('titulo'); ?>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top"><strong><?php echo lang('backend_fecha_ocurrida'); ?>:</strong></td>
        <td align="left"><?php echo form_input(array('name'=>'fecha_ocurrida','value'=>$fecha_ocurrida,'type'=>'date')); ?>
            <?php echo form_error('fecha_ocurrida'); ?>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_observacion'); ?>:</strong></td>
        <td align="left"><?php echo form_textarea(array('id' => 'observacion', 'name' => 'observacion', 'rows' => '12', 'cols' => '52', 'value' => $observacion)); ?>
            <?php echo form_error('observacion'); ?>
        </td>
    </tr>

    <tr>
        <td>&nbsp;</td>
        <td align="left">
<?php
	echo br();
	echo form_hidden('seguimiento_id', $seguimiento_id);
echo form_hidden('user_id', $user_id);
	echo Form_hidden('update_form', '1');
    echo form_submit(array('id' => 'submit_button', 'name' => 'edit', 'value' => lang('backend_save'), 'class' => 'input-submit'));
    echo ' ';
    echo form_button(array('id' => 'cancel_button', 'name' => 'cancel', 'content' => lang('backend_cancel'), 'onclick' => "javascript: window.location.href='".site_url('administrator/seguimiento/index/'.$user_id)."'"));
?>
        </td>
    </tr>
</table>
<?php form_close(); ?>
<!-- [Content] end -->
