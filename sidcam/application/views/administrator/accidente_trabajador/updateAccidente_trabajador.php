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
<h1><?php echo lang('backend_update_accidente_trabajador'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/accidente_trabajador/index/'.$accidente_id, lang('backend_list_accidente_trabajadors'));?></li>
</ul>
<br />
<hr />

<?php echo form_open_multipart('administrator/accidente_trabajador/updateAccidente_trabajador', array('class'=>'cmxform', 'id'=>'updateform')); ?>
<table width="80%" align="center" border="0" cellspacing="0" cellpadding="6">
    <tr style="display: none">
        <td align="right" valign="top"><strong>*<?php echo 'Trabajador Externo'; ?>:</strong></td>

        <td><?php if($trabajador_id == 0){
                echo form_checkbox(array('name'=>'tipo', 'size'=>'80', 'id'=>'tipo', 'checked'=>'true'));
            }
            else{
                echo form_checkbox(array('name'=>'tipo', 'size'=>'80', 'id'=>'tipo'));
            }?>
            <?php echo form_error('tipo'); ?>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_trabajador'); ?>:</strong></td>
        <td>
            <select name="trabajador_id" id="trabajador_id">
                <?php if($trabajadores){
                    foreach($trabajadores as $row){
                        $key = 0;
                        foreach($accidente_trabajadores as $accidentados){
                            if($accidentados->trabajador_id == $row->trabajador_id && $trabajador_id != $accidentados->trabajador_id){
                                $key = 1;
                            }
                        }
                        if($key == 0){
                            if($row->trabajador_id == $trabajador_id){
                                echo "<option id='$row->trabajador_id' selected value='$row->trabajador_id'> $row->nombre </option>";
                            }
                            else{
                                echo "<option id='$row->trabajador_id' value='$row->trabajador_id'> $row->nombre </option>";
                            }
                        }
                    }
                } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_body'); ?>:</strong></td>
        <td>
            <select name="body_id" id="body_id">
                <?php if($bodies){
                    foreach($bodies as $row){
                        if($row->body_id == $body_id){
                           echo "<option id='$row->body_id' selected value='$row->body_id'> $row->nombre </option>";
                        }
                        else{
                            echo "<option id='$row->body_id' value='$row->body_id'> $row->nombre </option>";
                        }
                    }
                } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td align="left">
<?php
	echo br();
	echo form_hidden('accidente_trabajador_id', $accidente_trabajador_id);
echo form_hidden('accidente_id', $accidente_id);
	echo Form_hidden('update_form', '1');
    echo form_submit(array('id' => 'submit_button', 'name' => 'edit', 'value' => lang('backend_save'), 'class' => 'input-submit'));
    echo ' ';
    echo form_button(array('id' => 'cancel_button', 'name' => 'cancel', 'content' => lang('backend_cancel'), 'onclick' => "javascript: window.location.href='".site_url('administrator/accidente_trabajador/index/'.$accidente_id)."'"));
?>
        </td>
    </tr>
</table>
<?php form_close(); ?>
<script>
    $('document').ready(function(){
        //$('#e').css({"display":"none"});
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
