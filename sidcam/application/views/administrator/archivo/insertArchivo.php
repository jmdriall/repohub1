
<!--tiny_mce-->
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

<h1><?php echo lang('backend_insert_archivo'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/archivo/index/'.$user_id,lang('backend_list_archivos'));?></li>
</ul>
<hr />


<?php echo form_open_multipart('administrator/archivo/insertArchivo/'.$user_id, array('class'=>'cmxform', 'id'=>'insertform','enctype'=>'multipart/form-data')); ?>
<table width="80%" align="center" border="0" cellspacing="0" cellpadding="6">
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_nombre'); ?>:</strong></td>
        <td><?php echo form_input('title', $this->input->post('title', TRUE), 'size=80'); ?>
            <?php echo form_error('title'); ?>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_archivo_codigo'); ?>:</strong></td>
        <td><?php echo form_input('codigo', $this->input->post('codigo', TRUE), 'size=80'); ?>
            <?php echo form_error('codigo'); ?>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_archivo_revision'); ?>:</strong></td>
        <td><?php echo form_input('revision', $this->input->post('revision', TRUE), 'size=80'); ?>
            <?php echo form_error('revision'); ?>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_archivo_fecha_aprobacion'); ?>:</strong></td>
        <td><?php echo form_input(array('name'=>'fecha_aprobacion', 'value'=>$this->input->post('fecha_aprobacion', TRUE),'size'=>'80','type'=>'date' )); ?>
            <?php echo form_error('fecha_aprobacion'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top" align="right">
            <strong>*<?php echo lang('backend_archivo'); ?>:</strong></td>
        <td>
            <strong>archivos solo de tipo: pdf</strong> <br/>
            <?php echo form_upload('picture', 'size=80'); ?>
            <div class="warning">
                <?php echo $this->image_lib->display_errors(); ?>
                <?php echo $this->upload->display_errors(); ?>
            </div>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_tipo'); ?>:</strong></td>
        <td>
            <select name="tipo_id" id="tipo_id">
                <?php if($tipos){
                    foreach($tipos as $tipo){
                        echo "<option value='$tipo->tipo_id'> $tipo->nombre </option>";
                    }
                } ?>
            </select>

            <?php echo form_error('description'); ?>
        </td>
    </tr>
    <tr style="display: none">
        <td align="right" valign="top"><strong>*<?php echo lang('backend_description'); ?>:</strong></td>
        <td><?php echo form_textarea(array('id' => 'description', 'name' => 'description', 'rows' => '12', 'cols' => '52', 'value' => $this->input->post('description'))); ?>
            <?php echo form_error('description'); ?>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td align="left">
<?php
	echo br();
	echo form_hidden('user_id', $user_id);
    echo form_submit(array('id' => 'submit_button', 'name' => 'insert', 'value' => lang('backend_save'), 'class' => 'input-submit'));
    echo ' ';
    echo form_button(array('id' => 'cancel_button', 'name' => 'cancel', 'content' => lang('backend_cancel'), 'onclick' => "javascript: window.location.href='".site_url('administrator/archivo/index/'.$user_id)."'"));
?>
        </td>
    </tr>
</table>
<?php form_close(); ?>
<!-- [Content] end -->