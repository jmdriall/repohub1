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
        theme_advanced_buttons3 : "tableaccidente_trabajadors,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
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
<div class="container">
    <div class="row">
        <div class="col-xs-12 text-center mar-top-15">
            <h1><?php echo 'Ingresar Trabajadores Afectados'; ?></h1>
        </div>
        <div class="col-xs-12">
            <?php echo form_open_multipart('client/indicadores/insertAccidente_trabajador/'.$accidente_id, array('class'=>'cmxform', 'id'=>'insertform')); ?>
            <div class="row">
                <div class="col-xs-2">
                    <strong>Trabajador</strong>
                </div>
                <div class="col-xs-10">
                    <select name="trabajador_id" id="trabajador_id" class="form-control" style="width: auto">
                        <?php if($trabajadores){
                            foreach($trabajadores as $row){
                                $key = 0;
                                foreach($accidente_trabajadores as $accidentados){
                                    if($accidentados->trabajador_id == $row->trabajador_id){
                                        $key = 1;
                                    }
                                }
                                if($key == 0){
                                    echo "<option id='$row->trabajador_id' value='$row->trabajador_id'> $row->nombre </option>";
                                }

                            }
                        } ?>
                    </select>
                </div>
            </div>
            <div class="row mar-top-15">
                <div class="col-xs-2">
                    <strong>Parte de cuerpo afectado</strong>
                </div>
                <div class="col-xs-10">
                    <select name="body_id" id="body_id" class="form-control" style="width: auto">
                        <?php if($bodies){

                            foreach($bodies as $row){
                                echo "<option id='$row->body_id' value='$row->body_id'> $row->nombre </option>";
                            }
                        } ?>
                    </select>
                </div>
            </div>




                        <?php
                        echo form_hidden('accidente_id',$accidente_id);
                        echo br();
                        echo form_submit(array('id' => 'submit_button', 'name' => 'insert', 'value' => lang('backend_save'), 'class' => 'input-submit form-control mar-top-15','style'=>'width:auto!important;float:left!important;margin-right:15px!important;'));
                        echo ' ';
                        echo form_button(array('class'=> 'form-control','style'=>'width:auto!important;float:left!importat;','id' => 'cancel_button', 'name' => 'cancel', 'content' => lang('backend_cancel'), 'onclick' => "javascript: window.location.href='".site_url('client/indicadores/trabajadoresAfectados/'.$accidente_id)."'"));
                        ?>

            <?php form_close(); ?>

        </div>
        <div class="col-xs-12">

            <h2><?php //echo anchor('client/indicadores/trabajadoresAfectados/'.$accidente_id, lang('backend_list_accidente_trabajadors'));?></h2>
        </div>

    </div>
</div>
<script>
   $('document').ready(function(){
       $('#e').css({"display":"none"});
       $('#tipo').change(function(){
           if($('#tipo').attr('checked')) {
               $('#e').css({"display":"block"});
               $('#i').css({"display":"none"});
           } else {
               $('#i').css({"display":"block"});
               $('#e').css({"display":"none"});
           }
       });
   });
</script>
<!-- [Content] end -->