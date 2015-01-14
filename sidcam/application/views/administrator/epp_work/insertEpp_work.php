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
        theme_advanced_buttons3 : "tableepp_works,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
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
<h1><?php echo lang('backend_insert_epp_work'); ?></h1>
<ul class="general_option">
    <li class="list_button"><?php echo anchor('administrator/epp_work/index/'.$trabajador_id, lang('backend_list_epp_works'));?></li>
</ul>
<hr />

<?php echo form_open_multipart('administrator/epp_work/insertEpp_work/'.$trabajador_id, array('class'=>'cmxform', 'id'=>'insertform')); ?>
<table width="80%" align="center" border="0" cellspacing="0" cellpadding="6">

    <tr style="display: none">
        <td align="right" valign="top"><strong>*<?php echo 'Trabajador Externo'; ?>:</strong></td>

        <td><?php echo form_checkbox(array('name'=>'tipo', 'value'=>'1', 'size'=>'80', 'id'=>'tipo')); ?>
            <?php echo form_error('tipo'); ?>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top"><strong>*<?php echo lang('backend_epp'); ?>:</strong></td>

        <td id="i">
            <select name="epp_id" id="epp_id">
                <?php if($eppes){

                    foreach($eppes as $row){
                        $key = 0;
                        foreach($epp_workes as $accidentados){
                            if($accidentados->epp_id == $row->epp_id){
                                $key = 1;
                            }
                        }
                        if($key == 0){
                            echo "<option id='$row->epp_id' value='$row->epp_id'> $row->title </option>";
                        }

                    }
                } ?>
            </select>
        </td>
        <td id="e"><?php echo form_input(array('name'=>'title', 'id'=>'title', 'value'=>$this->input->post('title', TRUE),'size'=>'80')); ?>
    </tr>

    <tr>
        <td>&nbsp;</td>
        <td align="left">
<?php
    echo form_hidden('trabajador_id',$trabajador_id);
	echo br();
    echo form_submit(array('id' => 'submit_button', 'name' => 'insert', 'value' => lang('backend_save'), 'class' => 'input-submit'));
    echo ' ';
    echo form_button(array('id' => 'cancel_button', 'name' => 'cancel', 'content' => lang('backend_cancel'), 'onclick' => "javascript: window.location.href='".site_url('administrator/epp_work/index/'.$trabajador_id)."'"));
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