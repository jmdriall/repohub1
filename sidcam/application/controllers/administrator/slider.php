<?php
/**
 * Classname: Slider
 * Summary: Controller for Service objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Slider extends CI_Controller
{
	var	$_temp_path		= "./resources/media/slider/original/";
	var	$_full_path		= "./resources/media/slider/full/";
	var	$_thumb_path	= "./resources/media/slider/thumbs/";
	var	$_allowed_types	= "gif|jpg|jpeg|png|bmp";
	var	$_max_size		= "20480";
	var	$_field_name	= "slider_image";
	var	$_width_full	= "320";
	var	$_height_full	= "200";
	var	$_width_thumbs	= "50";
	var	$_height_thumbs	= "50";
	
	/**
	 * Method: __construct
	 * Summary: Method construct
	 * @access public
	 */
	function __construct()
	{
		parent::__construct();
		
		//lets load our own library to handle layouts
		$params = array('layout' => 'layouts/layout_admin');
		$this->load->library('layout', $params);
		
		// Cargar librerias
		$this->load->library('upload');
		$this->load->library('image_lib');
		
		$this->load->model('slider_model');
		$this->load->library('form_validation');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($off_set=0)
	{
		$this->verify_session->verify_login('administrator/service/index');
		
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/slider/index/');
		$config['total_rows'] 		= $this->slider_model->getTotalSlider();
		$config['per_page'] 		= 10;
		$config['uri_segment']		= 4;
		$config['full_tag_open'] 	= '<p align="center" id="pagination">';
		$config['full_tag_close'] 	= '</p>';
		
		$config['first_link'] = lang('backend_first');
		$config['last_link'] = lang('backend_last');
		$config['next_link'] = lang('backend_next');
		$config['prev_link'] = lang('backend_previous');
		$this->pagination->initialize($config);
		
		$per_p = $config['per_page'];
		$data['sliders'] = $this->slider_model->getAllSlider($per_p, $off_set);
		
		$this->layout->view('administrator/slider/index', $data);
	}
	
	/**
	 * Method: insertSlider
	 * Summary: insert a new user
	 * @access public
	 * @return 
	 */
	function insertSlider()
	{
		$this->verify_session->verify_login('administrator/slider/insertSlider');
		
		//validation		
		$this->form_validation->set_rules('slider_title', lang('backend_title'), 'required');
		$this->form_validation->set_rules('slider_description', lang('backend_description'), '');
		
		$this->form_validation->set_error_delimiters('<p class="warning">', '</p>');
		
		// Inicio de variables, path, ttype, size, field name para las imagenes en genral
		$value_upload['temp_path'] = $this->_temp_path;
		$value_upload['full_path'] = $this->_full_path;
		$value_upload['thumb_path'] = $this->_thumb_path;		
		$value_upload['allowed_types'] = $this->_allowed_types;		
		$value_upload['max_size'] = $this->_max_size;		
		$value_upload['field_name']	= $this->_field_name;
		$value_upload['width_full'] = $this->_width_full;
		$value_upload['height_full'] = $this->_height_full;
		$value_upload['width_thumbs'] = $this->_width_thumbs;
		$value_upload['height_thumbs'] = $this->_height_thumbs;
		
		if ( $this->input->post('insert', TRUE) != NULL )
		{
			if ( !$this->form_validation->run()) 
			{
				$this->layout->view('administrator/slider/insertSlider');
			} 
			else 
			{
				if ( !$data=upload_image($value_upload))
				{
					foreach($_POST as $key=>$value){
						$data[$key]  = $this->input->post($key, TRUE);
					}
					
					$this->layout->view('administrator/slider/insertSlider', $data );
				}
				else
				{
					$values = array('slider_title' => $this->input->post('slider_title', TRUE),
									'slider_image' => $data['file_name'],
									'slider_description' => $this->input->post('slider_description', TRUE)
								    );
					$this->slider_model->insertSlider($values);
					
					redirect('administrator/slider/index/');
				}
			}
		}
		else
		{
			$this->layout->view('administrator/slider/insertSlider');
		}
	}
	
	/**
	 * Method: updateSlider
	 * Summary: edit the user data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateSlider($slider_id=0)
	{
		$this->verify_session->verify_login('administrator/slider/updateSlider');
		
		//validation	
		$this->form_validation->set_rules('slider_title', lang('backend_title'), 'required');
		$this->form_validation->set_rules('slider_description', lang('slider_description'), '');
		
		$this->form_validation->set_error_delimiters('<p class="warning">', '</p>');
		
		//upload picture
		// Inicio de variables, path, ttype, size, field name para las imagenes en genral
		$value_upload['temp_path'] = $this->_temp_path;
		$value_upload['full_path'] = $this->_full_path;
		$value_upload['thumb_path'] = $this->_thumb_path;		
		$value_upload['allowed_types'] = $this->_allowed_types;		
		$value_upload['max_size'] = $this->_max_size;		
		$value_upload['field_name']	= $this->_field_name;
		$value_upload['width_full'] = $this->_width_full;
		$value_upload['height_full'] = $this->_height_full;
		$value_upload['width_thumbs'] = $this->_width_thumbs;
		$value_upload['height_thumbs'] = $this->_height_thumbs;
		
		if ($this->input->post('update_form', TRUE) == NULL)
		{
			if ( !empty($slider_id) AND is_numeric($slider_id))
			{
				$slider = $this->slider_model->getSliderBySliderId($slider_id);
				if ( $slider == FALSE )
				{
					redirect('administrator/slider/index');
				}
				else
				{
					foreach($slider as $key=>$value){
						$data[$key] = $value;
					}
				}
				$this->layout->view('administrator/slider/updateSlider', $data);
			}
			else
			{
				redirect('administrator/slider/index');
			}
		} 
		else
		{
			if ( !$this->form_validation->run()) 
			{
					foreach($_POST as $key=>$value){
						$data[$key]  = $this->input->post($key, TRUE);
					}
				
				$this->layout->view('administrator/slider/updateSlider', $data);
			} 
			else 
			{
				$values = array('slider_title' => $this->input->post('slider_title', TRUE),
								'slider_description' => $this->input->post('slider_description')
							 	);
				
				$slider_id = $this->input->post('slider_id', TRUE);
				$this->slider_model->updateSlider( $slider_id, $values );
				
				if ($data=upload_image($value_upload))
				{
					$copy = $this->slider_model->getSliderBySliderId($slider_id);
					
					$this->slider_model->updateSlider($slider_id, array('slider_image' => $data['file_name']));
					
					//eliminar el temporal
					@unlink($value_upload['temp_path'] . $copy->slider_image);					
					@unlink($value_upload['full_path'] . $copy->slider_image);
					@unlink($value_upload['thumb_path'] . $copy->slider_image);
				}
				redirect('administrator/slider/index');
			}
		}
	}
	
	/**
	 * Method: deleteSlider
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteSlider($slider_id=0)
	{
		$this->verify_session->verify_login('administrator/slider/deleteSlider');
		
		if ($this->input->post('subm_form', TRUE) == NULL)
		{
			if ( !empty($slider_id) AND is_numeric($slider_id)) //verify id in url
			{
				$slider = $this->slider_model->getSliderBySliderId($slider_id);	
				if ($slider == FALSE)
				{
					redirect('administrator/slider/index');
				}
				else
				{
					foreach($slider as $key=>$value){
						$data[$key] = $value;
					}
				}
				$this->layout->view('administrator/slider/deleteSlider', $data);
			}
			else
			{
				redirect('administrator/slider/index');
			}			
		}
		else
		{
			if ($this->input->post('subm_form', TRUE) == 'batch')
			{
				$slider_id = $this->input->post('slider_id', TRUE);
				
				foreach ($slider_id as $row)
				{		
					$data = $this->slider_model->getSliderBySliderId($row);
				  	$this->slider_model->deleteSlider($row);
					
					//remove files
					$temp_path = $this->_temp_path;
					$full_path = $this->_full_path;
					$thumb_path = $this->_thumb_path;
					@unlink($temp_path . $data->slider_image);
					@unlink($full_path . $data->slider_image);
					@unlink($thumb_path . $data->slider_image);	
				}
			}
			else
			{
				$slider_id = $this->input->post('slider_id', TRUE);
				
				$data = $this->slider_model->getSliderBySliderId($slider_id);
				$this->slider_model->deleteSlider($slider_id);
				
				//remove files
				$temp_path = $this->_temp_path;
				$full_path = $this->_full_path;
				$thumb_path = $this->_thumb_path;
				@unlink($temp_path . $data->slider_image);
				@unlink($full_path . $data->slider_image);
				@unlink($thumb_path . $data->slider_image);	
			}
			
			redirect('administrator/slider/index');
		}
	}
}

/* End of file service.php */
/* Location: ./system/application/controllers/administrator/service.php */
?>