<?php
/**
 * Classname: Epp_work
 * Summary: Epp_workler for Epp_work objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Epp_work extends CI_controller
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

            $this->load->model('epp_work_model');
            $this->load->model('trabajador_model');
            $this->load->model('epp_model');
            $this->load->model('user_model');
        //$this->load->model('sub_epp_work_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($trabajador_id = 0)
	{
		$this->verify_session->verify_login('administrator/epp_work/index');



		//load and config pagination
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/epp_work/index/');
		$config['total_rows'] 		= $this->epp_work_model->getTotalEpp_work();
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

        $trabajador = $picture = $this->trabajador_model->getTrabajadorByTrabajadorId($trabajador_id);
        foreach($trabajador as $key=>$value){
            $data[$key] = $value;
        }
        $trab_id = $data['user_id'];
        $data['eppes'] = $this->epp_model->getAll($trab_id);
		$data['epp_works']	 = $this->epp_work_model->getAllEpp_work($per_p, $off_set, $trabajador_id);
        $data['trabajador_id'] = $trabajador_id;
		$this->layout->view('administrator/epp_work/index',$data);
	}
	
	/**
	 * Method: insertEpp_work
	 * Summary: insert a new trabajador
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertEpp_work($trabajador_id = 0)
    {
        $this->verify_session->verify_login('administrator/epp_work/insertEpp_work');

        //validation
        //$this->form_validation->set_rules('title', lang('backend_title'), 'required');
        //$this->form_validation->set_rules('epp_id', lang('backend_epp'));
        //$this->form_validation->set_rules('fecha_epp_work', lang('backend_fecha_epp_work'));
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {

                $title = $this->input->post('epp_id');
                $picture = $this->epp_model->getEppByEppId($title);
                if ( $picture == FALSE )
                {
                    redirect('administrator/epp_work/index/'.$trabajador_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $epp = $this->epp_model->getEppByEppId($this->input->post('epp_id'));

                $values = array('title' => $data['title'],
                    'user_id' => $epp->user_id,
                    'epp_id' => $this->input->post('epp_id'),
                    //'fecha_epp_work' => $this->input->post('fecha_epp_work', TRUE),
                    'trabajador_id' =>$this->input->post('trabajador_id', TRUE)
                    //'description' => $this->input->post('description'),
                    //'sub_title' => $this->input->post('sub_title', TRUE)
                );




            $this->epp_work_model->insertEpp_work($values);
                $trabajador_id = $this->input->post('trabajador_id', TRUE);
				redirect('administrator/epp_work/index/'.$trabajador_id);
        }
        else
        {
            $trabajador = $picture = $this->trabajador_model->getTrabajadorByTrabajadorId($trabajador_id);
            foreach($trabajador as $key=>$value){
                $data[$key] = $value;
            }
            $trab_id = $data['user_id'];
            $data['eppes'] = $this->epp_model->getAll($trab_id);
            $data['trabajador_id'] = $trabajador_id;
            $data['epp_workes']	 = $this->epp_work_model->getAll($trabajador_id);
            $this->layout->view('administrator/epp_work/insertEpp_work',$data);
        }
    }
	
	/**
	 * Method: updateEpp_work
	 * Summary: edit the trabajador data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateEpp_work($epp_work_id=0, $trabajador_id = 0)
	{

        $this->verify_session->verify_login('administrator/epp_work/updateEpp_work');

        //validation
        //$this->form_validation->set_rules('title', lang('backend_title'), 'required');
        //$this->form_validation->set_rules('epp_id', lang('backend_epp_id'), 'required');
        //$this->form_validation->set_rules('fecha_epp_work', lang('backend_epp_work'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($epp_work_id) AND is_numeric($epp_work_id))
            {

                $trabajador = $picture = $this->trabajador_model->getTrabajadorByTrabajadorId($trabajador_id);
                foreach($trabajador as $key=>$value){
                    $data[$key] = $value;
                }
                $trab_id = $data['user_id'];
                $data['eppes'] = $this->epp_model->getAll($trab_id);
                $data['trabajador_id'] = $trabajador_id;
                $data['epp_work_id'] = $epp_work_id;
                $picture = $this->epp_work_model->getEpp_workByEpp_workId($epp_work_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/epp_work/index/'.$trabajador_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['epp_workes']	 = $this->epp_work_model->getAll($trabajador_id);
                $this->layout->view('administrator/epp_work/updateEpp_work', $data);
            }
            else
            {
                redirect('administrator/epp_work/index/'.$trabajador_id);
            }
        }
        else
        {


                $epp_id =  $this->input->post('epp_id');
                $title = $this->epp_model->getEppByEppId($epp_id);
                foreach($title as $key=>$value){
                    $data[$key] = $value;
                }

                $values = array( 'title' => $data['title'],
								'epp_id' => $this->input->post('epp_id')

								//'fecha_epp_work'=> $this->input->post('fecha_epp_work')
							);
                $epp_work_id = $this->input->post('epp_work_id', TRUE);
                $this->epp_work_model->updateEpp_work( $epp_work_id, $values );
				$trabajador = $this->input->post('trabajador_id', TRUE);
                redirect('administrator/epp_work/index/'.$trabajador);

        }
	}
	
	/**
	 * Method: deleteEpp_work
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteEpp_work($epp_work_id=0, $trabajador_id)
	{
        $this->verify_session->verify_login('administrator/epp_work/deleteEpp_work');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->epp_work_model->getEpp_workByEpp_workId($epp_work_id);

            if ( !empty($epp_work_id) AND is_numeric($epp_work_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/epp_work/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['trabajador_id'] = $trabajador_id;
                $this->layout->view('administrator/epp_work/deleteEpp_work', $data);
            }
            else
            {
                redirect('administrator/epp_work/index/'.$trabajador_id);
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('epp_work_id', TRUE) as $epp_work_id )
                {
                    $data = $this->epp_work_model->getEpp_workByEpp_workId($epp_work_id);
                    $this->epp_work_model->deleteEpp_work($epp_work_id);
                }
            }
            else
            {
                $epp_work_id = $this->input->post('epp_work_id', TRUE);

                $data = $this->epp_work_model->getEpp_workByEpp_workId($epp_work_id);
                $this->epp_work_model->deleteEpp_work($epp_work_id);
            }

            redirect('administrator/epp_work/index/'.$this->input->post('trabajador_id', TRUE));
        }
	}
}

/* End of file epp_work_lang.php */
/* Location: ./system/application/epp_worklers/administrator/epp_work_lang.php */
?>