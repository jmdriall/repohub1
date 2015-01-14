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
        theme_advanced_buttons3 : "tablecapacitacion_works,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
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

<?php echo form_open_multipart('client/indicadores/observacionAccidente', array('class'=>'cmxform', 'id'=>'updateform')); ?>
<h1 style="text-align: center; margin-top: 20px;"><?php echo 'Descripciones Accidente' ?></h1>
<h2 style="text-align: center; margin-top: 20px;"> <?php echo $titulo; ?></h2>
<br />


<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <textarea name="observacion" id="observacion" cols="30" rows="10" class="form-control"><?php echo $observacion; ?></textarea>
                    <?php echo form_error('fecha'); ?>
                 </div>
            </div>
        </div>

        <div class="col-xs-12 mar-top-15">
            <div class="row mar-top-15">
                <div class="col-xs-12" style="margin-left: -15px;">
                    <div class="row">
                        <div class="col-xs-1">
                            <input type="submit" id="submit_button" name="edit" class="form-control input-submit"  value="Guardar" style="width: 70px!important;margin-top: 20px"/>
                        </div>
                        <div class="col-xs-11">
                            <input type="button" class="form-control" onclick="javascript: window.location.href='<?php echo site_url('client/indicadores/accidentes/')?>'" value="Cancelar" style="width: 70px!important;margin-top: 20px"/>
                        </div>
                    </div>


                </div>
            </div>
        </div>


    </div>
</div>








    <tr>
        <td>&nbsp;</td>
        <td align="left">
            <?php
            echo form_hidden('accidente_id', $accidente_id);
            echo Form_hidden('update_form', '1');
            //echo form_submit(array('id' => 'submit_button', 'name' => 'edit', 'value' => lang('backend_save'), 'class' => 'input-submit'));
            echo br();
            //echo form_submit(array('id' => 'submit_button', 'name' => 'insert', 'value' => lang('backend_save'), 'class' => 'input-submit'));
            echo ' ';
            //echo form_button(array('id' => 'cancel_button', 'name' => 'cancel', 'content' => lang('backend_cancel'), 'onclick' => "javascript: window.location.href='".site_url('client/indicadores/eppWork/'.$trabajador_id)."'"));
            ?>
        </td>
    </tr>
</table>
<?php form_close(); ?>

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