<?php
/**
 * Classname: Sub_category
 * Summary: Controller for Sub_category objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Sub_category extends CI_Controller
{
	var	$_temp_path		= "./resources/media/sub_category/original/";
	var	$_full_path		= "./resources/media/sub_category/full/";
	var	$_thumb_path	= "./resources/media/sub_category/thumbs/";
	var	$_allowed_types	= "gif|jpg|png|bmp|jpeg";
	var	$_max_size		= "20Mb";
	var	$_field_name	= "picture";
	var	$_width_full	= "150";
	var	$_height_full	= "150";
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
		
		$this->load->model('sub_category_model');
		$this->load->library('form_validation');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($category_id=0, $offset=0)
	{
		$this->verify_session->verify_login('administrator/sub_category/index');
		
		if( empty($category_id) OR !is_numeric($category_id))
		{
			redirect('administrator/category/index');
		}
		
		//load and config pagination
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/subfaq/index/' . $category_id);
		$config['total_rows'] 		= $this->sub_category_model->getTotalSub_categorys($category_id);
		$config['per_page'] 		= 15;
		$config['uri_segment']		= 5;
		$config['full_tag_open'] 	= '<p align="center" id="pagination">';
		$config['full_tag_close'] 	= '</p>';
		
		$config['first_link'] = lang('backend_first');
		$config['last_link'] = lang('backend_last');
		$config['next_link'] = lang('backend_next');
		$config['prev_link'] = lang('backend_previous');
		$this->pagination->initialize($config);	
		
		//get with limit
		$per_p 		= $config['per_page'];
		$off_set 	= $offset;

		$data['sub_categorys'] = $this->sub_category_model->getAllSub_categorys($category_id, $per_p, $off_set);
        $data['category_id'] = $category_id;
		$this->layout->view('administrator/sub_category/index',$data);
	}
	
	/**
	 * Method: insertSub_category
	 * Summary: insert a new user
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertSub_category($category_id)
    {
        $this->verify_session->verify_login('administrator/sub_category/insertSub_category');

        //validation
        $this->form_validation->set_rules('title', lang('backend_title'), 'required');
        $this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        $this->form_validation->set_rules('description', lang('backend_description'));
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
                $data['title'] = $this->input->post('title', TRUE);
                $data['sub_title'] = $this->input->post('sub_title', TRUE);
                $data['description'] = $this->input->post('description', TRUE);
                $data['category_id'] = $this->input->post('category_id', TRUE);
                $this->layout->view('administrator/sub_category/insertSub_category', $data);
            }
            else
            {
                $dominio = $_SERVER['HTTP_HOST'];
                $session = $_SERVER['REQUEST_URI'];
                $url = "http://" . $dominio . $session;
                $uploadDir = "./resources/media/sub_category/doc/";
                $uploadFile = $uploadDir.$_FILES['picture']['name'];
                $ext = $_FILES['picture']['name'];
                $asd = explode(".", $ext);
                $ext = $asd[1];
                //if($ext == "pdf" || $ext == "doc" || $ext == "jpg" || $ext == "jpeg" || $ext == "png"){
                if($ext == "pdf"){
                    if ($_FILES['picture']['size'] == 0 )
                    {
                        $values = array('title' => $this->input->post('title', TRUE),
                            'description' => $this->input->post('description'),
                            'sub_title' => $this->input->post('sub_title', TRUE),
                            'category_id' => $category_id
                        );
                        $this->sub_category_model->insertSub_category($values);

                        redirect('administrator/sub_category/index/'.$category_id);
                    }
                    else
                    {
                        if(!$this->sub_category_model->getSub_categoryBySub_categoryPicture($_FILES['picture']['name'])){
                            $values = array('title' => $this->input->post('title', TRUE),
                                'description' => $this->input->post('description'),
                                'sub_title' => $this->input->post('sub_title', TRUE),
                                'category_id' => $category_id,
                                'picture' => $_FILES['picture']['name']
                            );
                            $this->sub_category_model->insertSub_category($values);
                            move_uploaded_file($_FILES['picture']['tmp_name'],$uploadFile);
                            redirect('administrator/sub_category/index/'.$category_id);
                        }
                        else{
                            redirect('administrator/sub_category/insertSub_category/'.$category_id);
                        }
                    }
                    redirect('administrator/sub_category/index/'.$category_id);
                }
                else{
                    echo $_FILES['picture']['type'];
                    redirect('administrator/sub_category/insertSub_category/'.$category_id);
                }


            }
        }
        else
        {
            $data['category_id'] = $category_id;

            $this->layout->view('administrator/sub_category/insertSub_category',$data);
        }
    }
	
	/**
	 * Method: updateSub_category
	 * Summary: edit the user data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateSub_category($sub_category_id=0)
	{
        $this->verify_session->verify_login('administrator/sub_category/updateSub_category');

        //validation
        $this->form_validation->set_rules('title', lang('backend_name'), 'required');
        $this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        $this->form_validation->set_rules('description', lang('backend_description'));

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
            if ( !empty($sub_category_id) AND is_numeric($sub_category_id))
            {
                $picture = $this->sub_category_model->getSub_categoryBySub_categoryId($sub_category_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/sub_category/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
					
                	$this->layout->view('administrator/sub_category/updateSub_category', $data);
                }
            }
            else
            {
                redirect('administrator/sub_category/index');
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('administrator/sub_category/updateSub_category', $data);
            }
            else
            {
                $values = array('title' => $this->input->post('title', TRUE),
								'sub_title'=> $this->input->post('sub_title'),
								'description' => $this->input->post('description')
								);
                $sub_category_id = $this->input->post('sub_category_id', TRUE);
                $category_id = $this->input->post('category_id', TRUE);
                $this->sub_category_model->updateSub_category( $sub_category_id, $values );

                if ($_FILES['picture']['size'] >0)
                {
                    if(!$this->sub_category_model->getSub_categoryBySub_categoryPicture($_FILES['picture']['name'])){
                        $dominio = $_SERVER['HTTP_HOST'];
                        $session = $_SERVER['REQUEST_URI'];
                        $url = "http://" . $dominio . $session;
                        $uploadDir = "./resources/media/sub_category/doc/";
                        $uploadFile = $uploadDir.$_FILES['picture']['name'];
                        $ext = $_FILES['picture']['name'];
                        $asd = explode(".", $ext);
                        $ext = $asd[1];
                        //if($ext == "pdf" || $ext == "doc" || $ext == "jpg" || $ext == "jpeg" || $ext == "png"){
                        $copy = $this->sub_category_model->getSub_categoryBySub_categoryId($sub_category_id);

                        $this->sub_category_model->updateSub_category($sub_category_id, array('picture' => $_FILES['picture']['name']));
                        move_uploaded_file($_FILES['picture']['tmp_name'],$uploadFile);

                        //eliminar el temporal
                        @unlink("./resources/media/sub_category/doc/" . $copy["picture"]);
                    }
                    else{
                        redirect('administrator/sub_category/updateSub_category/'.$sub_category_id);
                    }
                }
                redirect('administrator/sub_category/index/'.$category_id);
            }
        }
	}
	
	/**
	 * Method: deleteSub_category
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteSub_category($sub_category_id=0)
	{
        $this->verify_session->verify_login('administrator/sub_category/deleteSub_category');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->sub_category_model->getSub_categoryBySub_categoryId($sub_category_id);

            if ( !empty($sub_category_id) AND is_numeric($sub_category_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/sub_category/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $this->layout->view('administrator/sub_category/deleteSub_category', $data);
            }
            else
            {
                redirect('administrator/sub_category/index/');
            }
        }
        else
        {
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

            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('sub_category_id', TRUE) as $sub_category_id )
                {
                    $data = $this->sub_category_model->getSub_categoryBySub_categoryId($sub_category_id);
                    $this->sub_category_model->deleteSub_category($sub_category_id);
                    //remove files
                    @unlink("./resources/media/sub_category/doc/" . $data["picture"]);
                }
            }
            else
            {
                $sub_category_id = $this->input->post('sub_category_id', TRUE);

                $data = $this->sub_category_model->getSub_categoryBySub_categoryId($sub_category_id);
                $this->sub_category_model->deleteSub_category($sub_category_id);

                //remove files
				@unlink("./resources/media/sub_category/doc/" . $data["picture"]);
            }
			$category_id = $this->input->post('category_id');
            redirect('administrator/sub_category/index/'.$category_id);
        }
	}
}

/* End of file sub_category_lang.php */
/* Location: ./system/application/controllers/administrator/sub_category_lang.php */
?>