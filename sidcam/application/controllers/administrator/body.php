<?php
/**
 * Classname: Body
 * Summary: Controller for Service objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Body extends CI_Controller
{
	var	$_temp_path		= "./resources/media/body/original/";
	var	$_full_path		= "./resources/media/body/full/";
	var	$_thumb_path	= "./resources/media/body/thumbs/";
	var	$_allowed_types	= "gif|jpg|jpeg|png|bmp";
	var	$_max_size		= "20480";
	var	$_field_name	= "body_image";
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
		
		$this->load->model('body_model');
		$this->load->library('form_validation');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($user_id = 0)
	{
		$data['bodys'] = $this->body_model->getAllBody($user_id);
		$data['user_id'] = $user_id;
		$this->layout->view('administrator/body/index', $data);
	}
	
	/**
	 * Method: insertBody
	 * Summary: insert a new user
	 * @access public
	 * @return 
	 */
	function insertBody($user_id = 0)
	{
		$this->verify_session->verify_login('administrator/body/insertBody');
		
		//validation		
		$this->form_validation->set_rules('nombre', lang('backend_nombre'), 'required');
		
		$this->form_validation->set_error_delimiters('<p class="warning">', '</p>');
		
		// Inicio de variables, path, ttype, size, field name para las imagenes en genral
		
		if ( $this->input->post('insert', TRUE) != NULL )
		{
			if ( !$this->form_validation->run()) 
			{
                $data['nombre'] = $this->input->post('nombre',TRUE);
                $data['user_id'] = $this->input->post('user_id');
				$this->layout->view('administrator/body/insertBody',$data);
			} 
			else 
			{
			    $values = array('nombre' => $this->input->post('nombre', TRUE),
                    'user_id' => $this->input->post('user_id')
						    );
				$this->body_model->insertBody($values);
					
				redirect('administrator/body/index/'.$this->input->post('user_id'));

			}
		}
		else
		{
            $data['user_id'] = $user_id;
			$this->layout->view('administrator/body/insertBody',$data);
		}
	}
	
	/**
	 * Method: updateBody
	 * Summary: edit the user data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateBody($body_id=0, $user_id = 0)
	{
		$this->verify_session->verify_login('administrator/body/updateBody');
		
		//validation	
		$this->form_validation->set_rules('nombre', lang('backend_nombre'), 'required');

		
		$this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

		
		if ($this->input->post('update_form', TRUE) == NULL)
		{
			if ( !empty($body_id) AND is_numeric($body_id))
			{
				$body = $this->body_model->getBodyByBodyId($body_id);
				if ( $body == FALSE )
				{
					redirect('administrator/body/index/'.$user_id);
				}
				else
				{
					foreach($body as $key=>$value){
						$data[$key] = $value;
					}
				}
                $data['user_id'] = $user_id;
				$this->layout->view('administrator/body/updateBody', $data);
			}
			else
			{
				redirect('administrator/body/index/'.$user_id);
			}
		} 
		else
		{
			if ( !$this->form_validation->run()) 
			{
					foreach($_POST as $key=>$value){
						$data[$key]  = $this->input->post($key, TRUE);
					}
				
				$this->layout->view('administrator/body/updateBody', $data);
			} 
			else 
			{
				$values = array('nombre' => $this->input->post('nombre', TRUE)
							 	);
				
				$body_id = $this->input->post('body_id', TRUE);
				$this->body_model->updateBody( $body_id, $values );

				redirect('administrator/body/index/'.$this->input->post('user_id'));
			}
		}
	}
	
	/**
	 * Method: deleteBody
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteBody($body_id=0, $user_id = 0)
	{
		$this->verify_session->verify_login('administrator/body/deleteBody');
		
		if ($this->input->post('subm_form', TRUE) == NULL)
		{
			if ( !empty($body_id) AND is_numeric($body_id)) //verify id in url
			{
				$body = $this->body_model->getBodyByBodyId($body_id);	
				if ($body == FALSE)
				{
					redirect('administrator/body/index/'.$user_id);
				}
				else
				{
					foreach($body as $key=>$value){
						$data[$key] = $value;
					}
				}
				$this->layout->view('administrator/body/deleteBody', $data);
			}
			else
			{
				redirect('administrator/body/index/'.$user_id);
			}			
		}
		else
		{
				$body_id = $this->input->post('body_id', TRUE);
				$this->body_model->deleteBody($body_id);

			redirect('administrator/body/index/'.$this->input->post('user_id'));
		}
	}
}

/* End of file service.php */
/* Location: ./system/application/controllers/administrator/service.php */
?>