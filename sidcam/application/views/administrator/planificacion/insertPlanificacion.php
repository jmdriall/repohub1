<script language="javascript" type="text/javascript" src="<?php echo base_url('resources/plugins/tiny_mce/tiny_mce.js'); ?>"></script>
<script language="javascript" type="text/javascript">

    tinymce.init({
        plugins: "textcolor",
        toolbar: "forecolor backcolor"
    });
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
<h1><?php echo lang('backend_insert_planificacion'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/planificacion/index/'.$actividad_id,lang('backend_list_planificacions'));?></li>
</ul>
<hr />

<?php echo form_open_multipart('administrator/planificacion/insertPlanificacion/'.$actividad_id, array('class'=>'cmxform', 'id'=>'insertform')); ?>
<table width="80%" align="center" border="0" cellspacing="0" cellpadding="6">
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_fecha_ini'); ?>:</strong></td>
        <td>
            <input type="date" name="fecha_ini" value="<?php echo  $this->input->post('fecha_ini', TRUE); ?>"/>
            <?php echo form_error('fecha_ini'); ?>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_fecha_fin'); ?>:</strong></td>
        <td>
            <input type="date" name="fecha_fin" value="<?php echo  $this->input->post('backend_fecha_fin', TRUE); ?>"/>
            <?php echo form_error('fecha_fin'); ?>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_responsable'); ?>:</strong></td>
        <td><?php echo form_input('responsable', $this->input->post('responsable', TRUE), 'size=80'); ?>
            <?php echo form_error('responsable'); ?>
        </td>
    </tr>

    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_evidencia'); ?>:</strong></td>
        <td><textarea name="evidencia" style="width:600px;height:100px;" ></textarea>

            <?php echo form_error('evidencia'); ?>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td align="left">
<?php
    echo form_hidden('actividad_id',$actividad_id);
	echo br();
    echo form_submit(array('id' => 'submit_button', 'name' => 'insert', 'value' => lang('backend_save'), 'class' => 'input-submit'));
    echo ' ';
    echo form_button(array('id' => 'cancel_button', 'name' => 'cancel', 'content' => lang('backend_cancel'), 'onclick' => "javascript: window.location.href='".site_url('administrator/planificacion/index/'.$actividad_id)."'"));
?>
        </td>
    </tr>
</table>
<?php form_close(); ?>
<!-- [Content] end -->