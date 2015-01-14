<?php
/**
 * Classname: Epp
 * Summary: Controller for Epp objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Epp extends CI_Controller
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
		
		$this->load->model('epp_model');
        //$this->load->model('sub_epp_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($user_id = 0)
	{
		$this->verify_session->verify_login('administrator/epp/index');



		//load and config pagination
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/epp/index/');
		$config['total_rows'] 		= $this->epp_model->getTotalEpps();
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
		$off_set 	= 0;
		$data['epps']	 = $this->epp_model->getAllEpps($per_p, $off_set, $user_id);
        $data['user_id'] = $user_id;
		$this->layout->view('administrator/epp/index',$data);
	}
	
	/**
	 * Method: insertEpp
	 * Summary: insert a new user
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertEpp($user_id)
    {
        $this->verify_session->verify_login('administrator/epp/insertEpp');

        //validation
        $this->form_validation->set_rules('title', lang('backend_title'), 'required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {
                $data['title'] = $this->input->post('title', TRUE);

                $data['user_id'] = $this->input->post('user_id', TRUE);
                //$data['description'] = $this->input->post('description', TRUE);
                $this->layout->view('administrator/epp/insertEpp', $data);
            }
            else
            {
				$values = array('title' => $this->input->post('title', TRUE),
                    'user_id' =>$user_id
								//'description' => $this->input->post('description'),
								//'sub_title' => $this->input->post('sub_title', TRUE)
							);
				$this->epp_model->insertEpp($values);

				redirect('administrator/epp/index/'.$user_id);
            }
        }
        else
        {
            $data['user_id'] = $user_id;
            $this->layout->view('administrator/epp/insertEpp',$data);
        }
    }
	
	/**
	 * Method: updateEpp
	 * Summary: edit the user data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateEpp($epp_id=0, $user_id = 0)
	{

        $this->verify_session->verify_login('administrator/epp/updateGallery');

        //validation
        $this->form_validation->set_rules('title', lang('backend_name'), 'required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($epp_id) AND is_numeric($epp_id))
            {
                $picture = $this->epp_model->getEppByEppId($epp_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/epp/index/'.$user_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $this->layout->view('administrator/epp/updateEpp', $data);
            }
            else
            {
                redirect('administrator/epp/index/'.$user_id);
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('administrator/epp/updateEpp', $data);
            }
            else
            {
                $values = array( 'title' => $this->input->post('title', TRUE)
								//'description' => $this->input->post('description'),
								//'sub_title'=> $this->input->post('sub_title')
							);
                $epp_id = $this->input->post('epp_id', TRUE);
                $this->epp_model->updateEpp( $epp_id, $values );
				$user = $this->input->post('user_id', TRUE);
                redirect('administrator/epp/index/'.$user);
            }
        }
	}
	
	/**
	 * Method: deleteEpp
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteEpp($epp_id=0, $user_id)
	{
        $this->verify_session->verify_login('administrator/epp/deleteEpp');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->epp_model->getEppByEppId($epp_id);

            if ( !empty($epp_id) AND is_numeric($epp_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/epp/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $this->layout->view('administrator/epp/deleteEpp', $data);
            }
            else
            {
                redirect('administrator/epp/index/'.$user_id);
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('epp_id', TRUE) as $epp_id )
                {
                    $data = $this->epp_model->getEppByEppId($epp_id);
                    $this->epp_model->deleteEpp($epp_id);
                }
            }
            else
            {
                $epp_id = $this->input->post('epp_id', TRUE);

                $data = $this->epp_model->getEppByEppId($epp_id);
                $this->epp_model->deleteEpp($epp_id);
            }

            redirect('administrator/epp/index/'.$this->input->post('user_id', TRUE));
        }
	}
}

/* End of file epp_lang.php */
/* Location: ./system/application/controllers/administrator/epp_lang.php */
?>