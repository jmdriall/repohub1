<?php

/**
 * Method: upload_image
 * Summary: Sube la imagen al path asignado
 * @access public
 * @param: $data_image, array() con todos los valores por definir
 * @return: $data valor del objeto upload, FALSE en caso de error
 */
function upload_image($data_image)
{
	$ci	=& get_instance();

	$config['upload_path'] = $data_image['temp_path'];
	$config['allowed_types'] = $data_image['allowed_types'];
	$config['max_size']	= $data_image['max_size']; //2MB
	$config['encrypt_name'] = FALSE;
	
	$ci->load->library('upload', $config);
	
	$ci->upload->initialize($config);
	
	$image = $ci->upload->do_upload($data_image["field_name"]);
	//echo $ci->upload->display_errors();die();
	if(!$image)
	{
		return FALSE;
	}
	else
	{
		$data = $ci->upload->data();
		//llamada a la funcion de creacion e thumbs
		if(resize_images($data_image, $data)){
			return $data;
		}else{
			return FALSE;
		}
	}	
}

/**
 * Method: resize_images
 * Summary: Genera los thumbs de las imagenes segun tama�o definido
 * @access public
 * @param: $values, $data; $values valores definidos; $data valor del objeto upload.
 * @return: TRUE en caso de exito, FALSE en caso de error
 */
function resize_images($values, $data)
{
	$ci	=& get_instance();
	
	//do full
	$config['image_library'] = 'gd2';
	$config['source_image'] = $values['temp_path'].$data['file_name'];
	$config['new_image'] = $values['full_path'].$data['file_name'];
	$config['maintain_ratio'] = TRUE;
	$config['width'] = $values['width_full'];
	$config['height'] = $values['height_full'];

	$ci->load->library('image_lib', $config);
	
	$ci->image_lib->initialize($config);
	
	if (!$ci->image_lib->resize())
	{
		//echo $thiss->image_lib->display_errors();die();
		return FALSE;
	}
	$ci->image_lib->clear();
	
	//do thumb
	if($values['width_thumbs']!=0)
	{
		$config_t['image_library'] = 'gd2';
		$config_t['source_image'] = $values['temp_path'].$data['file_name'];
		$config_t['new_image'] = $values['thumb_path'].$data['file_name'];
		$config_t['maintain_ratio'] = TRUE;
		$config_t['width'] = $values['width_thumbs'];
		$config_t['height'] = $values['height_thumbs'];
		
		$ci->image_lib->initialize($config_t);

		if (!$ci->image_lib->resize())
		{
			//echo $thiss->image_lib->display_errors();die();
			return FALSE;
		}
		$ci->image_lib->clear();
	}	
	return TRUE; 
} 

?>