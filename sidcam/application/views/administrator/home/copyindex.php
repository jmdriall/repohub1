<div id="content_left">     
    <table width="100%" border="0" cellpadding="10">
      <tr>
        <td style="display: none;">
            <p align="center">
            	<?php
                echo anchor('administrator/user/index', img(array('src'=>'resources/images/backend/options/22.png', 'alt'=>'Users', 'class'=>'pic_link')));
				?>
            </p>
            <p align="center">
            	<?php echo anchor('administrator/user/index', lang('backend_users'), array('class' => 'admin_link') ); ?>
            </p>
        </td>
        <td>
            <p align="center">
                <?php
                echo anchor('administrator/seguimiento/index/'.$user_id, img(array('src'=>'resources/images/backend/options/22.png', 'alt'=>'Users', 'class'=>'pic_link')));
                ?>
            </p>
            <p align="center">
                <?php echo anchor('administrator/seguimiento/index/'.$user_id, lang('backend_seguimiento'), array('class' => 'admin_link') ); ?>
            </p>
        </td>
          <td>
              <p align="center">
                  <?php
                  echo anchor('administrator/cargo/index/'.$user_id, img(array('src'=>'resources/images/backend/options/22.png', 'alt'=>'Users', 'class'=>'pic_link')));
                  ?>
              </p>
              <p align="center">
                  <?php echo anchor('administrator/cargo/index/'.$user_id, lang('backend_cargo'), array('class' => 'admin_link') ); ?>
              </p>
          </td>
          <td>
              <p align="center">
                  <?php
                  echo anchor('administrator/area/index/'.$user_id, img(array('src'=>'resources/images/backend/options/22.png', 'alt'=>'Users', 'class'=>'pic_link')));
                  ?>
              </p>
              <p align="center">
                  <?php echo anchor('administrator/area/index/'.$user_id, lang('backend_area_administrator'), array('class' => 'admin_link') ); ?>
              </p>
          </td>
      </tr>
        <tr>
            <td>
                <p align="center">
                    <?php
                    echo anchor('administrator/trabajador/index/'.$user_id, img(array('src'=>'resources/images/backend/options/22.png', 'alt'=>'Users', 'class'=>'pic_link')));
                    ?>
                </p>
                <p align="center">
                    <?php echo anchor('administrator/trabajador/index/'.$user_id, lang('backend_trabajador'), array('class' => 'admin_link') ); ?>
                </p>
            </td>
            <td>
                <p align="center">
                    <?php
                    echo anchor('administrator/objetivo/index/'.$user_id, img(array('src'=>'resources/images/backend/options/22.png', 'alt'=>'Users', 'class'=>'pic_link')));
                    ?>
                </p>
                <p align="center">
                    <?php echo anchor('administrator/objetivo/index/'.$user_id, lang('backend_objetivo'), array('class' => 'admin_link') ); ?>
                </p>
            </td>
            <td>
                <p align="center">
                    <?php
                    echo anchor('administrator/inspeccion/index/'.$user_id, img(array('src'=>'resources/images/backend/options/22.png', 'alt'=>'Users', 'class'=>'pic_link')));
                    ?>
                </p>
                <p align="center">
                    <?php echo anchor('administrator/inspeccion/index/'.$user_id, lang('backend_inspeccion'), array('class' => 'admin_link') ); ?>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p align="center">
                    <?php
                    echo anchor('administrator/accidente/index/'.$user_id, img(array('src'=>'resources/images/backend/options/22.png', 'alt'=>'Users', 'class'=>'pic_link')));
                    ?>
                </p>
                <p align="center">
                    <?php echo anchor('administrator/accidente/index/'.$user_id, lang('backend_accidente'), array('class' => 'admin_link') ); ?>
                </p>
            </td>
            <td>
                <p align="center">
                    <?php
                    echo anchor('administrator/capacitacion/index/'.$user_id, img(array('src'=>'resources/images/backend/options/22.png', 'alt'=>'Users', 'class'=>'pic_link')));
                    ?>
                </p>
                <p align="center">
                    <?php echo anchor('administrator/capacitacion/index/'.$user_id, lang('backend_capacitacion'), array('class' => 'admin_link') ); ?>
                </p>
            </td>
            <td>
                <p align="center">
                    <?php
                    echo anchor('administrator/epp/index/'.$user_id, img(array('src'=>'resources/images/backend/options/22.png', 'alt'=>'Users', 'class'=>'pic_link')));
                    ?>
                </p>
                <p align="center">
                    <?php echo anchor('administrator/epp/index/'.$user_id, lang('backend_epp'), array('class' => 'admin_link') ); ?>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p align="center">
                    <?php
                    echo anchor('administrator/tipo/index/'.$user_id, img(array('src'=>'resources/images/backend/options/22.png', 'alt'=>'Users', 'class'=>'pic_link')));
                    ?>
                </p>
                <p align="center">
                    <?php echo anchor('administrator/tipo/index/'.$user_id, lang('backend_tipo'), array('class' => 'admin_link') ); ?>
                </p>
            </td>
            <td>
                <p align="center">
                    <?php
                    echo anchor('administrator/archivo/index/'.$user_id, img(array('src'=>'resources/images/backend/options/22.png', 'alt'=>'Users', 'class'=>'pic_link')));
                    ?>
                </p>
                <p align="center">
                    <?php echo anchor('administrator/archivo/index/'.$user_id, lang('backend_archivo'), array('class' => 'admin_link') ); ?>
                </p>
            </td>
            <td>
                <p align="center">
                    <?php
                    echo anchor('administrator/body/index/'.$user_id, img(array('src'=>'resources/images/backend/options/22.png', 'alt'=>'Users', 'class'=>'pic_link')));
                    ?>
                </p>
                <p align="center">
                    <?php echo anchor('administrator/body/index/'.$user_id, lang('backend_body'), array('class' => 'admin_link') ); ?>
                </p>
            </td>
        </tr>
    </table>
</div>
<div id="content_right">
    <div class="basic" style="float:left;"  id="presentation">
        <h3><a href="#"><?php echo lang('backend_accordion_welcome_title'); ?></a></h3>
        <div>
            <?php echo lang('backend_accordion_welcome_text'); ?>
        </div>
        <h3><a href="#"><?php echo lang('backend_accordion_beginner_title'); ?></a></h3>
      <div>
          <?php echo lang('backend_accordion_beginner_text'); ?>
      </div>
        <h3><a href="#"><?php echo lang('backend_accordion_logged_title'); ?></a></h3>
        <div>
            <p>
                <?php
				foreach( $log_result->result() as $log_row ){
					echo '<strong>' . $log_row->login . '</strong> - ' . $log_row->log_date_time . '<br />';
				}
				?>
            </p>
        </div>
        <h3><a href="#"><?php echo lang('backend_accordion_stucked_title'); ?></a></h3>
        <div>
             <?php echo lang('backend_accordion_stucked_text'); ?>
        </div>
    </div>
</div>