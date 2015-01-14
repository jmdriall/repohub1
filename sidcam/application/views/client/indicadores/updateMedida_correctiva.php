<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>resources/plugins/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
    tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
        relative_urls : false,
        remove_script_host : false,
        document_base_url : "<?php echo base_url()?>",
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,updatedatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,updatedate,updatetime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablemedida_correctivas,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "updatelayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,updatefile,updateimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
        // Skin options
        skin : "o2k7",
        skin_variant : "silver"
    });
</script>
<div class="container">
    <h1 class="mar-top-15 text-center"><?php echo lang('backend_update_medida_correctiva'); ?></h1>

    <?php echo form_open_multipart('client/indicadores/updateMedida_correctiva', array('class'=>'cmxform', 'id'=>'updateform')); ?>
    <div class="row">

        <div class="col-xs-2 mar-top-15"><strong>*<?php echo lang('backend_responsable'); ?>:</strong></div>
        <div class="col-xs-10 mar-top-15">
            <?php echo form_input(array('name'=>'responsable','value'=> $responsable, 'size'=>'80','class'=>'form-control')); ?>
            <?php echo form_error('responsable'); ?>
        </div>

        <div class="col-xs-2 mar-top-15"><strong>*<?php echo lang('backend_medida'); ?>:</strong></div>
        <div class="col-xs-10 mar-top-15">
            <?php echo form_input(array('name'=>'medida','value'=> $medida, 'size'=>'80','class'=>'form-control')); ?>
            <?php echo form_error('medida'); ?>
        </div>

        <div class="col-xs-2 mar-top-15" style="display: none"><strong>*<?php echo lang('backend_evidencia'); ?>:</strong></div>
        <div class="col-xs-10 mar-top-15" style="display: none">
            <?php echo form_textarea(array('id' => 'evidencia', 'name' => 'evidencia', 'rows' => '12', 'cols' => '52', 'value' => $evidencia)); ?>
            <?php echo form_error('evidencia'); ?>
        </div>

        <div class="col-xs-2 mar-top-15"><strong></strong></div>
        <div class="col-xs-10 mar-top-15">
            <?php echo form_input(array('name'=>'fecha_medida_correctiva', 'value' => $fecha_medida_correctiva, 'size'=>'80', 'type'=>'date')); ?>
            <?php echo form_error('fecha_medida_correctiva'); ?>
        </div>

        <div class="col-xs-2"></div>
        <div class="col-xs-10">
            <?php
            echo form_hidden('medida_correctiva_id', $medida_correctiva_id);
            echo form_hidden('accidente_id',$accidente_id);
            echo br();
            echo form_hidden('updateform',1);
            echo form_submit(array('id' => 'submit_button', 'name' => 'update', 'value' => lang('backend_save'), 'class' => 'input-submit form-control','style'=>'width:auto!important;float:left; margin-right:10px'));

            echo form_button(array('style'=>'float:left;margin-top:0','class'=>'form-control','id' => 'cancel_button', 'name' => 'cancel', 'content' => lang('backend_cancel'), 'onclick' => "javascript: window.location.href='".site_url('client/indicadores/medidaCorrectiva/'.$accidente_id)."'"));

            ?>
        </div>



    </div>
    <?php form_close(); ?>
</div>
<!-- [Content] end -->