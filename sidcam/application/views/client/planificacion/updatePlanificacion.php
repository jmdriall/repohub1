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
<h1 style="text-align: center; margin-top: 20px;"><?php echo 'Escribir Evidencia' ?></h1>
<br />

<?php echo form_open_multipart('client/planificacion/updatePlanificacion/'.$planificacion_id, array('class'=>'cmxform', 'id'=>'updateform')); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <textarea name="evidencia" cols="30" rows="10"><?php echo $evidencia; ?></textarea>

                <?php echo form_error('evidencia'); ?>
                <input type="submit" class="form-control" value="Guardar" style="width: 70px!important;margin-top: 20px;float: left; margin-right: 15px;"/>
                <input type="button" class="form-control" onclick="javascript: window.location.href='<?php echo site_url('client/planificacion/index/')?>'" value="Cancelar" style="width: 70px!important;margin-top: 20px"/>
            </div>
        </div>
    </div>



<?php
	echo br();
	echo form_hidden('planificacion_id', $planificacion_id);
    //echo form_hidden('actividad_id', $actividad_id);
	echo Form_hidden('update_form', '1');
    //echo form_submit(array('id' => 'submit_button', 'name' => 'edit', 'value' => lang('backend_save'), 'class' => 'input-submit'));

    //echo form_button(array('id' => 'cancel_button', 'name' => 'cancel', 'content' => lang('backend_cancel'), 'onclick' => "javascript: window.location.href='".site_url('client/planificacion/index/')."'"));
?>
        </td>
    </tr>
</table>
<?php form_close(); ?>
<!-- [Content] end -->
