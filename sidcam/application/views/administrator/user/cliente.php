<script type="text/javascript">
    $(document).ready(function()
    {
        $("#select_all").click(function()
        {
            var checked_status = this.checked;
            if ( checked_status )
            {
                $("input[name='user_id[]']").attr('checked', true);
            }
            else
            {
                $("input[name='user_id[]']").attr('checked', false);
            }
        });
    });
</script>
<!-- [Content] start -->
<h1><?php echo lang('backend_user_administrator'); ?></h1>
<ul class="general_option">
    <li class="add_button"><?php echo anchor('administrator/user/insertUser', lang('backend_insert_user'));?></li>
</ul>
<hr />
<?php echo form_open('administrator/user/deleteUser'); ?>
<table id="myTable" width="100%" class="main_table" border="0" cellpadding="0" cellspacing="0" >
    <thead>
    <tr class="table_header">
        <th align="center"><strong><?php echo form_checkbox(array('name'=>'select_all', 'value'=>'1', 'id'=>'select_all'));?>#</strong></th>
        <th align="center"><strong><?php echo lang('backend_firstname'); ?></strong></th>
        <th align="center"><strong><?php echo lang('backend_lastname'); ?></strong></th>
        <th align="center"><strong><?php echo lang('backend_configurar'); ?></strong></th>
    </tr>
    </thead>
    <?php
    $id_usuario;
    if( $this->session->userdata('login') != '' ){
        $user_data = $this->user_model->getUserByLogin( $this->session->userdata('login') );
        $user_name = $user_data->lastname . ", " . $user_data->firstname;
        $id_usuario = $user_data->user_id;
    }
    echo $id_usuario;
    if ($users->num_rows() > 0){
        $counter = 0;
        foreach ($users->result() as $row)
        {



            if($row->user_id != 1)
            {
            $counter++;
            $background = 'style="background:#FFFFFF; height:30px; "';
            if( ($counter % 2) == 0 ){
                $background = 'style="background:#E5E5E5; height:30px; "';
            }

            ?>
            <tr <?php echo $background; ?>>
                <td align="center"><?php echo form_checkbox(array('name'=>'user_id[]', 'value'=>$row->user_id));?></td>
                <td align="center"><?php echo anchor('administrator/user/updateUser/'.$row->user_id , $row->firstname); ?></td>
                <td align="center"><?php echo $row->lastname; ?></td>
                <td align="center"><?php echo anchor('administrator/user/updateUser/'.$row->user_id , lang('backend_configurar')); ?></td>

            </tr>
            <script>
                $(document).ready(function()
                {
                    $("#myTable").tablesorter({headers: { 0:{sorter: false},5:{sorter: false},6:{sorter: false}}});
                });
            </script>
        <?php
            }
        }
    }else{ ?>
        <tr>
            <td colspan="7"><?php echo lang('backend_no_registries'); ?></td>
        </tr>
    <?php
    }?>
</table>
<?php
echo form_submit(array('name'=>'submit','value'=>lang('backend_delete'),'id'=>'submit_button','class'=>'input-submit'));
echo form_hidden('subm_form', 'batch');
echo form_close();
?>
<!-- [Content] end -->
