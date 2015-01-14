<?php
/**
 * Classname: Category
 * Summary: Controller for Category objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Category extends CI_Controller
{
	
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
		$this->load->library('form_validation');
		
		$this->load->model('category_model');
        $this->load->model('sub_category_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($offset=0)
	{
		$this->verify_session->verify_login('administrator/category/index');



		//load and config pagination
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/category/index/');
		$config['total_rows'] 		= $this->category_model->getTotalCategorys();
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
		$data['categorys']	 = $this->category_model->getAllCategorys($per_p, $off_set);
		$this->layout->view('administrator/category/index',$data);
	}
	
	/**
	 * Method: insertCategory
	 * Summary: insert a new user
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertCategory()
    {
        $this->verify_session->verify_login('administrator/category/insertCategory');

        //validation
        $this->form_validation->set_rules('title', lang('backend_title'), 'required');
        $this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        $this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {
                $data['title'] = $this->input->post('title', TRUE);
                $data['sub_title'] = $this->input->post('sub_title', TRUE);
                $data['description'] = $this->input->post('description', TRUE);
                $this->layout->view('administrator/category/insertCategory', $data);
            }
            else
            {
				$values = array('title' => $this->input->post('title', TRUE),
								'description' => $this->input->post('description'),
								'sub_title' => $this->input->post('sub_title', TRUE)
							);
				$this->category_model->insertCategory($values);

				redirect('administrator/category/index/');
            }
        }
        else
        {
            $this->layout->view('administrator/category/insertCategory');
        }
    }
	
	/**
	 * Method: updateCategory
	 * Summary: edit the user data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateCategory($category_id=0)
	{
        $this->verify_session->verify_login('administrator/category/updateGallery');

        //validation
        $this->form_validation->set_rules('title', lang('backend_name'), 'required');
        $this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        $this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($category_id) AND is_numeric($category_id))
            {
                $picture = $this->category_model->getCategoryByCategoryId($category_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/category/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $this->layout->view('administrator/category/updateCategory', $data);
            }
            else
            {
                redirect('administrator/category/index');
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('administrator/category/updateCategory', $data);
            }
            else
            {
                $values = array( 'title' => $this->input->post('title', TRUE),
								'description' => $this->input->post('description'),
								'sub_title'=> $this->input->post('sub_title')
							);
                $category_id = $this->input->post('category_id', TRUE);
                $this->category_model->updateCategory( $category_id, $values );
				
                redirect('administrator/category/index/');
            }
        }
	}
	
	/**
	 * Method: deleteCategory
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteCategory($category_id=0)
	{
        $this->verify_session->verify_login('administrator/category/deleteCategory');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->category_model->getCategoryByCategoryId($category_id);

            if ( !empty($category_id) AND is_numeric($category_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/category/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $this->layout->view('administrator/category/deleteCategory', $data);
            }
            else
            {
                redirect('administrator/category/index/');
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('category_id', TRUE) as $category_id )
                {
                    $data = $this->category_model->getCategoryByCategoryId($category_id);
                    $this->category_model->deleteCategory($category_id);
                }
            }
            else
            {
                $category_id = $this->input->post('category_id', TRUE);

                $data = $this->category_model->getCategoryByCategoryId($category_id);
                $this->category_model->deleteCategory($category_id);
            }
            redirect('administrator/category/index/');
        }
	}
}

/* End of file category_lang.php */
/* Location: ./system/application/controllers/administrator/category_lang.php */
?>