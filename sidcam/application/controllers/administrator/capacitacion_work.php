<?php
/**
 * Classname: Capacitacion_work
 * Summary: Capacitacion_workler for Capacitacion_work objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Capacitacion_work extends CI_controller
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

            $this->load->model('capacitacion_work_model');
            $this->load->model('user_model');
            $this->load->model('trabajador_model');
            $this->load->model('capacitacion_model');
        //$this->load->model('sub_capacitacion_work_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($trabajador_id = 0)
	{
		$this->verify_session->verify_login('administrator/capacitacion_work/index');



		//load and config pagination
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/capacitacion_work/index/');
		$config['total_rows'] 		= $this->capacitacion_work_model->getTotalCapacitacion_work();
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
        $data['capacitaciones'] = $this->capacitacion_model->getAll($trab_id);
		$data['capacitacion_works']	 = $this->capacitacion_work_model->getAllCapacitacion_work($per_p, $off_set, $trabajador_id);
        $data['trabajador_id'] = $trabajador_id;
		$this->layout->view('administrator/capacitacion_work/index',$data);
	}
	
	/**
	 * Method: insertCapacitacion_work
	 * Summary: insert a new trabajador
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertCapacitacion_work($trabajador_id = 0)
    {
        $this->verify_session->verify_login('administrator/capacitacion_work/insertCapacitacion_work');

        //validation
        //$this->form_validation->set_rules('title', lang('backend_title'), 'required');
        //$this->form_validation->set_rules('capacitacion_id', lang('backend_capacitacion'));
        //$this->form_validation->set_rules('fecha_capacitacion_work', lang('backend_fecha_capacitacion_work'));
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {

                $title = $this->input->post('capacitacion_id');
                $picture = $this->capacitacion_model->getCapacitacionByCapacitacionId($title);
                if ( $picture == FALSE )
                {
                    redirect('administrator/capacitacion_work/index/'.$trabajador_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $capacitacion = $this->capacitacion_model->getCapacitacionByCapacitacionId($this->input->post('capacitacion_id'));
                $user = $this->user_model->getUserByUserId($capacitacion->user_id);
                $values = array('title' => $data['title'],
                    'capacitacion_id' => $this->input->post('capacitacion_id'),
                    'fecha' => $this->input->post('fecha'),
                    'codigo' => $this->input->post('codigo'),
                    'trabajador_id' =>$this->input->post('trabajador_id', TRUE),
                    'user_id'   => $user->user_id
                    //'description' => $this->input->post('description'),
                    //'sub_title' => $this->input->post('sub_title', TRUE)
                );




            $this->capacitacion_work_model->insertCapacitacion_work($values);
                $trabajador_id = $this->input->post('trabajador_id', TRUE);
				redirect('administrator/capacitacion_work/index/'.$trabajador_id);
        }
        else
        {
            $trabajador = $picture = $this->trabajador_model->getTrabajadorByTrabajadorId($trabajador_id);
            foreach($trabajador as $key=>$value){
                $data[$key] = $value;
            }
            $trab_id = $data['user_id'];
            $data['capacitaciones'] = $this->capacitacion_model->getAll($trab_id);
            $data['trabajador_id'] = $trabajador_id;
            $data['capacitacion_workes']	 = $this->capacitacion_work_model->getAll($trabajador_id);
            $this->layout->view('administrator/capacitacion_work/insertCapacitacion_work',$data);
        }
    }
	
	/**
	 * Method: updateCapacitacion_work
	 * Summary: edit the trabajador data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateCapacitacion_work($capacitacion_work_id=0, $trabajador_id = 0)
	{

        $this->verify_session->verify_login('administrator/capacitacion_work/updateCapacitacion_work');

        //validation
        //$this->form_validation->set_rules('title', lang('backend_title'), 'required');
        //$this->form_validation->set_rules('capacitacion_id', lang('backend_capacitacion_id'), 'required');
        //$this->form_validation->set_rules('fecha_capacitacion_work', lang('backend_capacitacion_work'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($capacitacion_work_id) AND is_numeric($capacitacion_work_id))
            {

                $trabajador = $picture = $this->trabajador_model->getTrabajadorByTrabajadorId($trabajador_id);
                foreach($trabajador as $key=>$value){
                    $data[$key] = $value;
                }
                $trab_id = $data['user_id'];
                $data['capacitaciones'] = $this->capacitacion_model->getAll($trab_id);
                $data['trabajador_id'] = $trabajador_id;
                $data['capacitacion_work_id'] = $capacitacion_work_id;
                $picture = $this->capacitacion_work_model->getCapacitacion_workByCapacitacion_workId($capacitacion_work_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/capacitacion_work/index/'.$trabajador_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['capacitacion_workes']	 = $this->capacitacion_work_model->getAll($trabajador_id);
                $this->layout->view('administrator/capacitacion_work/updateCapacitacion_work', $data);
            }
            else
            {
                redirect('administrator/capacitacion_work/index/'.$trabajador_id);
            }
        }
        else
        {


                $capacitacion_id =  $this->input->post('capacitacion_id');
                $title = $this->capacitacion_model->getCapacitacionByCapacitacionId($capacitacion_id);
                foreach($title as $key=>$value){
                    $data[$key] = $value;
                }

                $values = array( 'title' => $data['title'],
                                'fecha' => $this->input->post('fecha'),
                                'codigo' => $this->input->post('codigo'),
								'capacitacion_id' => $this->input->post('capacitacion_id')

								//'fecha_capacitacion_work'=> $this->input->post('fecha_capacitacion_work')
							);
                $capacitacion_work_id = $this->input->post('capacitacion_work_id', TRUE);
                $this->capacitacion_work_model->updateCapacitacion_work( $capacitacion_work_id, $values );
				$trabajador = $this->input->post('trabajador_id', TRUE);
                redirect('administrator/capacitacion_work/index/'.$trabajador);

        }
	}
	
	/**
	 * Method: deleteCapacitacion_work
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteCapacitacion_work($capacitacion_work_id=0, $trabajador_id)
	{
        $this->verify_session->verify_login('administrator/capacitacion_work/deleteCapacitacion_work');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->capacitacion_work_model->getCapacitacion_workByCapacitacion_workId($capacitacion_work_id);

            if ( !empty($capacitacion_work_id) AND is_numeric($capacitacion_work_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/capacitacion_work/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['trabajador_id'] = $trabajador_id;
                $this->layout->view('administrator/capacitacion_work/deleteCapacitacion_work', $data);
            }
            else
            {
                redirect('administrator/capacitacion_work/index/'.$trabajador_id);
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('capacitacion_work_id', TRUE) as $capacitacion_work_id )
                {
                    $data = $this->capacitacion_work_model->getCapacitacion_workByCapacitacion_workId($capacitacion_work_id);
                    $this->capacitacion_work_model->deleteCapacitacion_work($capacitacion_work_id);
                }
            }
            else
            {
                $capacitacion_work_id = $this->input->post('capacitacion_work_id', TRUE);

                $data = $this->capacitacion_work_model->getCapacitacion_workByCapacitacion_workId($capacitacion_work_id);
                $this->capacitacion_work_model->deleteCapacitacion_work($capacitacion_work_id);
            }

            redirect('administrator/capacitacion_work/index/'.$this->input->post('trabajador_id', TRUE));
        }
	}
}

/* End of file capacitacion_work_lang.php */
/* Location: ./system/application/capacitacion_worklers/administrator/capacitacion_work_lang.php */
?>