<?php
/**
 * Classname: Home
 * Summary: Controller for Home objects
 * @author 
 * @package /controllers
 * History:
 * 	Created: June 01, 2007
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Indicadores extends CI_Controller {

	/**
	 * Method: __construct
	 * Summary: Method construct
	 * @author 
	 * @access public
	 */
	function __construct()
	{
		parent::__construct();
		
		//Lets load our own library to handle layouts
		$params = array("layout" => "layouts/layout_client");
		$this->load->library( 'layout', $params );
        $this->load->model('trabajador_model');
        $this->load->model('capacitacion_model');
        $this->load->model('capacitacion_work_model');
        $this->load->model('epp_model');
        $this->load->model('epp_work_model');
        $this->load->model('inspeccion_model');
        $this->load->model('slider_model');
        $this->load->model('c_inspeccion_model');
        $this->load->model('seguimiento_model');
        $this->load->model('control_model');
        $this->load->model('accidente_model');
        $this->load->model('medida_correctiva_model');
        $this->load->model('accidente_trabajador_model');
        $this->load->model('body_model');

        $this->load->model('objetivo_model');
        $this->load->model('especifico_model');
        $this->load->model('actividad_model');
        $this->load->model('planificacion_model');
        $this->load->model('area_model');
        $this->load->model('cargo_model');

	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @author 
	 * @access public
	 */
	function index()
	{
        $this->verify_session->verify_login('client/home/index');
       if($this->session->userdata('login')!=''){
           $login = $this->session->userdata('login');
           $user = $this->user_model->getUserByLogin($login);
           $data['trabajadores'] = $this->trabajador_model->getAll($user->user_id);

           if($this->capacitacion_model->getAll($user->user_id)){
               $data['count_capacitacion'] = count($this->capacitacion_model->getAll($user->user_id));
           }
           else{
               $data['count_capacitacion'] = 0;
           }
           $data['bool_capacitaciones']=$this->capacitacion_model->getAll($user->user_id);
           $data['bool_epps']=$this->epp_model->getAll($user->user_id);
           $data['capacitaciones_work'] = $this->capacitacion_work_model->getAllByUserId($user->user_id);

           if($this->epp_model->getAll($user->user_id)){
               $data['count_epp'] = count($this->epp_model->getAll($user->user_id));
           }
           else{
               $data['count_epp'] = 0;
           }
           $data['epps_work'] = $this->epp_work_model->getAllByUserId($user->user_id);

           $data['inspecciones'] = $this->inspeccion_model->getAll($user->user_id);
           $data['c_inspecciones'] = $this->c_inspeccion_model->getAllByUserId($user->user_id);
           $data['auditorias'] = $this->seguimiento_model->getAll($user->user_id);
           $data['c_auditorias'] = $this->control_model->getAllByUserId($user->user_id);
           $data['accidentes'] = $this->accidente_model->getAll($user->user_id);
           $data['medidas_correctiva'] = $this->medida_correctiva_model->getAllByUserID($user->user_id);
           $data['accidentes_trabajador'] = $this->accidente_trabajador_model->getAllByUserID($user->user_id);
           $data['objetivos'] = $this->objetivo_model->getAll($user->user_id);
           $data['planificaciones'] = $this->planificacion_model->getPlanificacionByUserId($user->user_id);


           // echo $data['count_capacitacion'];
           //return;
           $this->layout->view('client/indicadores/index',$data);
       }
        else{
            redirect('./administrator/login');
        }
	}
    function reglamentos(){
        $login = $this->session->userdata('login');
        $user = $this->user_model->getUserByLogin($login);
        $data['trabajadores'] = $this->trabajador_model->getAll($user->user_id);
        $this->layout->view('client/indicadores/reglamentos',$data);
    }
    function subirRegla( $trabajador_id = 0 ){

        if($trabajador_id !=null and is_numeric($trabajador_id)){
            $value = array('regla_recomendaciones' => 1
            );
            $this->trabajador_model->updateTrabajador($trabajador_id, $value);
            redirect('client/indicadores/reglamentos');
        }
        else{
            redirect('client/indicadores/reglamentos');
        }
    }
    function quitarRegla( $trabajador_id = 0 ){

        if($trabajador_id !=null and is_numeric($trabajador_id)){
            $value = array('regla_recomendaciones' => 0
            );
            $this->trabajador_model->updateTrabajador($trabajador_id, $value);
            redirect('client/indicadores/reglamentos');
        }
        else{
            redirect('client/indicadores/reglamentos');
        }
    }
    function examenes(){
        $login = $this->session->userdata('login');
        $user = $this->user_model->getUserByLogin($login);
        $data['trabajadores'] = $this->trabajador_model->getAll($user->user_id);
        $this->layout->view('client/indicadores/examenes',$data);
    }
    function subirExamen( $trabajador_id = 0 ){

        if($trabajador_id !=null and is_numeric($trabajador_id)){
            $value = array('examen_medico' => 1
            );
            $this->trabajador_model->updateTrabajador($trabajador_id, $value);
            redirect('client/indicadores/examenes');
        }
        else{
            redirect('client/indicadores/examenes');
        }
    }
    function quitarExamen( $trabajador_id = 0 ){

        if($trabajador_id !=null and is_numeric($trabajador_id)){
            $value = array('examen_medico' => 0
            );
            $this->trabajador_model->updateTrabajador($trabajador_id, $value);
            redirect('client/indicadores/examenes');
        }
        else{
            redirect('client/indicadores/examenes');
        }
    }
    function capacitaciones(){
        $login = $this->session->userdata('login');
        $user = $this->user_model->getUserByLogin($login);
        $data['trabajadores'] = $this->trabajador_model->getAll($user->user_id);
        $data['count_capacitacion'] = count($this->capacitacion_model->getAll($user->user_id));
        $this->layout->view('client/indicadores/capacitaciones',$data);
    }
    function capacitacionWork($trabajador_id = 0){
        $this->load->library('pagination');
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
        $data['capacitaciones_work']	 = $this->capacitacion_work_model->getAllCapacitacion_work($per_p, $off_set, $trabajador_id);
        $data['trabajador_id'] = $trabajador_id;
        $this->layout->view('client/indicadores/capacitacionWork',$data);
    }
    function ingresarCapacitacion($trabajador_id = 0)
    {
        $this->verify_session->verify_login('client/indicadores/ingresarCapacitacion');

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
                redirect('client/indicadores/capacitacionWork/'.$trabajador_id);
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
            redirect('client/indicadores/capacitacionWork/'.$trabajador_id);
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
            $this->layout->view('client/indicadores/ingresarCapacitacion',$data);
        }
    }
    function eliminarCapacitacion($capacitacion_work_id=0, $trabajador_id)
    {
        $this->verify_session->verify_login('client/indicadores/eliminarCapacitacion');
                $this->capacitacion_work_model->deleteCapacitacion_work($capacitacion_work_id);


            redirect('client/indicadores/capacitacionWork/'.$trabajador_id);

    }

    function editarCapacitacion($capacitacion_work_id=0, $trabajador_id = 0)
    {

        $this->verify_session->verify_login('client/indicadores/editarCapacitacion');

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
                    redirect('client/indicadores/capacitacionWork/'.$trabajador_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['capacitacion_workes']	 = $this->capacitacion_work_model->getAll($trabajador_id);
                $this->layout->view('client/indicadores/editarCapacitacion', $data);
            }
            else
            {
                redirect('client/indicadores/capacitacionWork/'.$trabajador_id);
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
            redirect('client/indicadores/capacitacionWork/'.$trabajador);

        }
    }
    ///////                 EPPS        ///////////////////////////////
    function epps(){
        $login = $this->session->userdata('login');
        $user = $this->user_model->getUserByLogin($login);
        $data['trabajadores'] = $this->trabajador_model->getAll($user->user_id);
        $data['count_epp'] = count($this->epp_model->getAll($user->user_id));
        $this->layout->view('client/indicadores/epps',$data);
    }
    function eppWork($trabajador_id = 0){
        $this->load->library('pagination');
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
        $data['epps_work']	 = $this->epp_work_model->getAllEpp_work($per_p, $off_set, $trabajador_id);
        $data['trabajador_id'] = $trabajador_id;
        $this->layout->view('client/indicadores/eppWork',$data);
    }
    function ingresarEpp($trabajador_id = 0)
    {
        $this->verify_session->verify_login('client/indicadores/ingresarEpp');

        $this->form_validation->set_rules('codigo', lang('backend_epp_id'), 'required');
        $this->form_validation->set_rules('fecha', lang('backend_epp_work'), 'required');
        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {

                $trabajador = $picture = $this->trabajador_model->getTrabajadorByTrabajadorId($this->input->post('trabajador_id'));
                foreach($trabajador as $key=>$value){
                    $data[$key] = $value;
                }
                $trab_id = $data['user_id'];
                $data['epps'] = $this->epp_model->getAll($trab_id);
                $data['trabajador_id'] = $trabajador_id;
                $data['epp_workes']	 = $this->epp_work_model->getAll($trabajador_id);

                $this->layout->view('client/indicadores/ingresarEpp', $data);
            }
            else{
                $title = $this->input->post('epp_id');
                $picture = $this->epp_model->getEppByEppId($title);
                if ( $picture == FALSE )
                {
                    redirect('client/indicadores/eppWork/'.$trabajador_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $epp = $this->epp_model->getEppByEppId($this->input->post('epp_id'));
                $user = $this->user_model->getUserByUserId($epp->user_id);
                $values = array('title' => $data['title'],
                    'epp_id' => $this->input->post('epp_id'),
                    'fecha' => $this->input->post('fecha'),
                    'codigo' => $this->input->post('codigo'),
                    'trabajador_id' =>$this->input->post('trabajador_id', TRUE),
                    'user_id'   => $user->user_id
                    //'description' => $this->input->post('description'),
                    //'sub_title' => $this->input->post('sub_title', TRUE)
                );
                $this->epp_work_model->insertEpp_work($values);
                $trabajador_id = $this->input->post('trabajador_id', TRUE);
                redirect('client/indicadores/eppWork/'.$trabajador_id);
            }


        }
        else
        {
                $trabajador = $picture = $this->trabajador_model->getTrabajadorByTrabajadorId($trabajador_id);
                foreach($trabajador as $key=>$value){
                    $data[$key] = $value;
                }
                $trab_id = $data['user_id'];
                $data['epps'] = $this->epp_model->getAll($trab_id);
                $data['trabajador_id'] = $trabajador_id;
                $data['epp_workes']	 = $this->epp_work_model->getAll($trabajador_id);
                $this->layout->view('client/indicadores/ingresarEpp',$data);

        }
    }
    function eliminarEpp($epp_work_id=0, $trabajador_id)
    {
        $this->verify_session->verify_login('client/indicadores/eliminarEpp');
        $this->epp_work_model->deleteEpp_work($epp_work_id);


        redirect('client/indicadores/eppWork/'.$trabajador_id);

    }
    function editarEpp($epp_work_id=0, $trabajador_id = 0)
    {

        $this->verify_session->verify_login('client/indicadores/editarEpp');

        //validation
        //$this->form_validation->set_rules('title', lang('backend_title'), 'required');
        $this->form_validation->set_rules('codigo', lang('backend_epp_id'), 'required');
        $this->form_validation->set_rules('fecha', lang('backend_epp_work'), 'required');

       $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form') == NULL)
        {
            if ( !empty($epp_work_id) AND is_numeric($epp_work_id))
            {

                $trabajador = $picture = $this->trabajador_model->getTrabajadorByTrabajadorId($trabajador_id);
                foreach($trabajador as $key=>$value){
                    $data[$key] = $value;
                }
                $trab_id = $data['user_id'];
                $data['epps'] = $this->epp_model->getAll($trab_id);
                $data['trabajador_id'] = $trabajador_id;
                $data['epp_work_id'] = $epp_work_id;
                $picture = $this->epp_work_model->getEpp_workByEpp_workId($epp_work_id);
                if ( $picture == FALSE )
                {
                    redirect('client/indicadores/eppWork/'.$trabajador_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['epp_workes']	 = $this->epp_work_model->getAll($trabajador_id);
                $this->layout->view('client/indicadores/editarEpp', $data);
            }
            else
            {
                $trabajador_id = $this->input->post('trabajador_id');
                redirect('client/indicadores/eppWork/'.$trabajador_id);
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                $trabajador = $picture = $this->trabajador_model->getTrabajadorByTrabajadorId($this->input->post('trabajador_id'));
                foreach($trabajador as $key=>$value){
                    $data[$key] = $value;
                }
                $trab_id = $data['user_id'];
                $data['epps'] = $this->epp_model->getAll($trab_id);
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('client/indicadores/editarEpp', $data);
            }
            else{
                $epp_id =  $this->input->post('epp_id');
                $title = $this->epp_model->getEppByEppId($epp_id);
                foreach($title as $key=>$value){
                    $data[$key] = $value;
                }
                $values = array( 'title' => $data['title'],
                    'epp_id' => $this->input->post('epp_id'),
                    'codigo' => $this->input->post('codigo'),
                    'fecha' => $this->input->post('fecha')

                    //'fecha_epp_work'=> $this->input->post('fecha_epp_work')
                );
                $epp_work_id = $this->input->post('epp_work_id', TRUE);
                $this->epp_work_model->updateEpp_work( $epp_work_id, $values );
                $trabajador = $this->input->post('trabajador_id', TRUE);
                redirect('client/indicadores/eppWork/'.$trabajador);
            }
        }
    }
    ///////////////             end             EPPS        /   ////////////////////
    ///////////////             Inspecciones        /   ////////////////////
    function inspecciones(){
        $login = $this->session->userdata('login');
        $user = $this->user_model->getUserByLogin($login);
        $data['inspecciones'] = $this->inspeccion_model->getAll($user->user_id);
        $data['c_inspecciones'] = $this->c_inspeccion_model->getAll($user->user_id);
        $this->layout->view('client/indicadores/inspecciones',$data);
    }
    function insertInspeccion()
    {
        $this->verify_session->verify_login('client/indicadores/insertInspeccion');

        //validation
        $this->form_validation->set_rules('titulo', lang('backend_titulo'), 'required');
        //$this->form_validation->set_rules('dias_perdidos', lang('backend_dias_perdidos'), 'required');
        //$this->form_validation->set_rules('observacion', lang('backend_observacion'));
        $this->form_validation->set_rules('fecha_ocurrida', lang('backend_fecha_ocurrida'));
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        $login = $this->session->userdata('login');
        $user_id = $this->user_model->getUserByLogin($login);
        $user_id = $user_id->user_id;

        if ( $this->input->post('insert_form', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {
                $data['titulo'] = $this->input->post('titulo', TRUE);
                $data['fecha_ocurrida'] = $this->input->post('fecha_ocurrida', TRUE);
                $data['user_id'] = $this->input->post('user_id', TRUE);
                //$data['areas'] = $this->area_model->getAll($user_id);
                $this->layout->view('client/indicadores/insertInspeccion', $data);
            }
            else
            {
                $values = array('titulo' => $this->input->post('titulo', TRUE),
                    'fecha_ocurrida' => $this->input->post('fecha_ocurrida', TRUE),
                    'user_id' =>$user_id,
                    //'dias_perdidos' => $this->input->post('dias_perdidos',TRUE),
                    //'area_id' => $this->input->post('area_id')
                    //'description' => $this->input->post('description'),
                    //'sub_title' => $this->input->post('sub_title', TRUE)
                );
                $this->inspeccion_model->insertInspeccion($values);

                redirect('client/indicadores/inspecciones/');
            }
        }
        else
        {


            //$data['areas'] = $this->area_model->getAll($user_id);
            $this->layout->view('client/indicadores/insertInspeccion');
        }
    }
    function updateInspeccion($inspeccion_id=0)
    {
        $login = $this->session->userdata('login');
        $user_id = $this->user_model->getUserByLogin($login);
        $user_id = $user_id->user_id;
        $this->verify_session->verify_login('client/indicadores/updateAuditoria');

        //validation
        $this->form_validation->set_rules('titulo', lang('backend_titulo'), 'required');
        //$this->form_validation->set_rules('dias_perdidos', lang('backend_dias_perdidos'), 'required');
        //$this->form_validation->set_rules('observacion', lang('backend_observacion'), 'required');
        $this->form_validation->set_rules('fecha_ocurrida', lang('backend_fecha_ocurrida'), 'required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($inspeccion_id) AND is_numeric($inspeccion_id))
            {
                $picture = $this->inspeccion_model->getInspeccionByInspeccionId($inspeccion_id);
                if ( $picture == FALSE )
                {
                    redirect('client/indicadores/inspecciones/');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                //$data['areas'] = $this->area_model->getAll($user_id);
                $this->layout->view('client/indicadores/updateInspeccion',$data);
            }
            else
            {
                redirect('client/indicadores/inspecciones/');
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }
                //$data['areas'] = $this->area_model->getAll($user_id);
                $this->layout->view('client/indicadores/updateInspeccion', $data);
            }
            else
            {
                $values = array( 'titulo' => $this->input->post('titulo', TRUE),
                    //'dias_perdidos' => $this->input->post('dias_perdidos', TRUE),
                    //'area_id' => $this->input->post('area_id'),
                    'fecha_ocurrida'=> $this->input->post('fecha_ocurrida')
                );
                $inspeccion_id = $this->input->post('inspeccion_id', TRUE);
                $this->inspeccion_model->updateInspeccion( $inspeccion_id, $values );
                redirect('client/indicadores/inspecciones/');
            }
        }
    }
    function  deleteInspeccion($inspeccion_id = 0){
        $c_inspecciones = $this->c_inspeccion_model->getAll($inspeccion_id);
        if($c_inspecciones){
            foreach($c_inspecciones as $c_inspeccion){
                $this->c_inspeccion_model->deleteC_inspeccion($c_inspeccion->control_id);
            }
        }
        $this->inspeccion_model->deleteInspeccion($inspeccion_id);
        redirect('client/indicadores/inspecciones');
    }
    function observacionInspeccion($inspeccion_id = 0)
    {
        $this->verify_session->verify_login('client/indicadores/observacionInspeccion');

        if ($this->input->post('update_form') == NULL)
        {
            if ( !empty($inspeccion_id) AND is_numeric($inspeccion_id))
            {
                $trabajador = $picture = $this->inspeccion_model->getInspeccionByInspeccionId($inspeccion_id);
                foreach($trabajador as $key=>$value){
                    $data[$key] = $value;
                }
                if ( $picture == FALSE )
                {
                    redirect('client/indicadores/inspecciones/');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $this->layout->view('client/indicadores/observacionInspeccion', $data);
            }
            else
            {
                redirect('client/indicadores/inspecciones/');
            }
        }
        else
        {
                $inspeccion_id =  $this->input->post('inspeccion_id');
                $values = array( 'observacion' => $this->input->post('observacion')
                );
                $this->inspeccion_model->updateInspeccion( $inspeccion_id, $values );
                redirect('client/indicadores/inspecciones/');
        }
    }
    function controlInspecciones($inspeccion_id = 0){
        $login = $this->session->userdata('login');
        $user = $this->user_model->getUserByLogin($login);
        $data['c_inspecciones'] = $this->c_inspeccion_model->getAll($inspeccion_id);
        $data['inspeccion_id'] = $inspeccion_id;
        $this->layout->view('client/indicadores/controlInspecciones',$data);
    }
    function evidenciaControlInspeccion($c_inspeccion_id = 0)
    {

        $this->verify_session->verify_login('client/indicadores/EvidenciaControlInspeccion');

        if ($this->input->post('update_form') == NULL)
        {

            if ( !empty($c_inspeccion_id) AND is_numeric($c_inspeccion_id))
            {
                $trabajador = $picture = $this->c_inspeccion_model->getC_inspeccionByC_inspeccionId($c_inspeccion_id);
                foreach($trabajador as $key=>$value){
                    $data[$key] = $value;
                }
                if ( $picture == FALSE )
                {
                    redirect('client/indicadores/controlInspecciones/'.$c_inspeccion_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $this->layout->view('client/indicadores/evidenciaControlInspeccion', $data);
            }
            else
            {

                redirect('client/indicadores/controlInspecciones/'.$c_inspeccion_id);
            }
        }
        else
        {
            $c_inspeccion_id =  $this->input->post('c_inspeccion_id');
            $inspeccion = $this->c_inspeccion_model->getC_inspeccionByC_inspeccionId($c_inspeccion_id);
            $values = array( 'evidencia' => $this->input->post('evidencia')
            );
            $this->c_inspeccion_model->updateC_inspeccion( $c_inspeccion_id, $values );
            redirect('client/indicadores/controlInspecciones/'.$inspeccion->inspeccion_id);
        }
    }
    function insertC_inspeccion($inspeccion_id = 0)
    {
        $this->verify_session->verify_login('client/indicadores/insertC_inspeccion');

        //validation
        $this->form_validation->set_rules('responsable', lang('backend_responsable'), 'required');
        //$this->form_validation->set_rules('evidencia', lang('backend_evidencia'));
        $this->form_validation->set_rules('fecha_control', lang('backend_fecha_control'));
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {
                $data['responsable'] = $this->input->post('responsable', TRUE);
                //$data['evidencia'] = $this->input->post('evidencia');
                $data['fecha_control'] = $this->input->post('fecha_control', TRUE);
                $data['inspeccion_id'] = $this->input->post('inspeccion_id', TRUE);
                //$data['description'] = $this->input->post('description', TRUE);
                $this->layout->view('client/indicadores/insertC_inspeccion', $data);
            }
            else
            {
                $user = $this->inspeccion_model->getInspeccionByInspeccionId($this->input->post('inspeccion_id', TRUE));
                $values = array('responsable' => $this->input->post('responsable', TRUE),
                    //'evidencia' => $this->input->post('evidencia'),
                    'fecha_c_inspeccion' => $this->input->post('fecha_c_inspeccion', TRUE),
                    'inspeccion_id' =>$this->input->post('inspeccion_id', TRUE),
                    'medida' => $this->input->post('medida'),
                    'user_id' => $user->user_id
                    //'description' => $this->input->post('description'),
                    //'sub_title' => $this->input->post('sub_title', TRUE)
                );
                $this->c_inspeccion_model->insertC_inspeccion($values);

                redirect('client/indicadores/controlInspecciones/'.$this->input->post('inspeccion_id', TRUE));
            }
        }
        else
        {
            $data['inspeccion_id'] = $inspeccion_id;
            $this->layout->view('client/indicadores/insertC_inspeccion',$data);
        }
    }
    function deleteC_inspeccion($c_inspeccion_id = 0)
    {
        $inspeccion_id = $this->c_inspeccion_model->getC_inspeccionByC_inspeccionId($c_inspeccion_id);
        $this->c_inspeccion_model->deleteC_inspeccion($c_inspeccion_id);

        $inspeccion_id = $inspeccion_id->inspeccion_id;
        redirect('client/indicadores/controlInspecciones/'.$inspeccion_id);
    }
    function updateC_inspeccion($c_inspeccion_id=0)
    {

        $this->verify_session->verify_login('client/indicadores/updateC_inspeccion');

        //validation
        $this->form_validation->set_rules('responsable', lang('backend_responsable'), 'required');
        $this->form_validation->set_rules('medida', lang('backend_medida'), 'required');
        $this->form_validation->set_rules('fecha_c_inspeccion', lang('backend_fecha_c_inspeccion'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('updateform', TRUE) == NULL)
        {
            $picture = $this->c_inspeccion_model->getC_inspeccionByC_inspeccionId($c_inspeccion_id);
            if ( !empty($c_inspeccion_id) AND is_numeric($c_inspeccion_id))
            {
                foreach($picture as $key=>$value){
                    $data[$key] = $value;
                }

                $data['inspeccion_id'] = $picture->inspeccion_id;
                $this->layout->view('client/indicadores/updateC_inspeccion', $data);
            }
            else
            {
                redirect('client/indicadores/controlInspecciones/'.$picture->inspeccion_id);
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('client/indicadores/updateC_inspeccion', $data);
            }
            else
            {
                $values = array( 'responsable' => $this->input->post('responsable', TRUE),
                    'medida' => $this->input->post('medida',TRUE),
                    'fecha_c_inspeccion'=> $this->input->post('fecha_c_inspeccion')
                );
                $c_inspeccion_id = $this->input->post('c_inspeccion_id', TRUE);
                $this->c_inspeccion_model->updateC_inspeccion( $c_inspeccion_id, $values );
                $inspeccion_id = $this->input->post('inspeccion_id');
                redirect('client/indicadores/controlInspecciones/'.$inspeccion_id);
            }
        }
    }
    ///////////////             end             Inspecciones        /   ////////////////////

    ///////////////             Auditorias        /   ////////////////////
    function auditorias(){
        $login = $this->session->userdata('login');
        $user = $this->user_model->getUserByLogin($login);
        $data['auditorias'] = $this->seguimiento_model->getAll($user->user_id);
        $data['c_auditorias'] = $this->control_model->getAll($user->user_id);
        $this->layout->view('client/indicadores/auditorias',$data);
    }
    function observacionAuditoria($seguimiento_id = 0)
    {
        $this->verify_session->verify_login('client/indicadores/observacionAuditoria');

        if ($this->input->post('update_form') == NULL)
        {
            if ( !empty($seguimiento_id) AND is_numeric($seguimiento_id))
            {
                $trabajador = $picture = $this->seguimiento_model->getSeguimientoBySeguimientoId($seguimiento_id);
                foreach($trabajador as $key=>$value){
                    $data[$key] = $value;
                }
                if ( $picture == FALSE )
                {
                    redirect('client/indicadores/auditorias/');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $this->layout->view('client/indicadores/observacionAuditoria', $data);
            }
            else
            {
                redirect('client/indicadores/auditorias/');
            }
        }
        else
        {
            $seguimiento_id =  $this->input->post('seguimiento_id');
            $values = array( 'observacion' => $this->input->post('observacion')
            );
            $this->seguimiento_model->updateSeguimiento( $seguimiento_id, $values );
            redirect('client/indicadores/auditorias/');
        }
    }
    function controlAuditorias($seguimiento_id = 0){
        $login = $this->session->userdata('login');
        $user = $this->user_model->getUserByLogin($login);
        $data['seguimiento_id'] = $seguimiento_id;
        $data['c_auditorias'] = $this->control_model->getAll($seguimiento_id);
        $this->layout->view('client/indicadores/controlAuditorias',$data);
    }
    function evidenciaControlAuditoria($control_id = 0)
    {
        $this->verify_session->verify_login('client/indicadores/EvidenciaControlAuditoria');

        if ($this->input->post('update_form') == NULL)
        {

            if ( !empty($control_id) AND is_numeric($control_id))
            {
                $trabajador = $picture = $this->control_model->getControlByControlId($control_id);
                foreach($trabajador as $key=>$value){
                    $data[$key] = $value;
                }
                if ( $picture == FALSE )
                {
                    redirect('client/indicadores/controlAuditorias/'.$control_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $this->layout->view('client/indicadores/evidenciaControlAuditoria', $data);
            }
            else
            {

                redirect('client/indicadores/controlAuditorias/'.$control_id);
            }
        }
        else
        {
            $control_id =  $this->input->post('control_id');
            $auditoria = $this->control_model->getControlByControlId($control_id);
            $values = array( 'evidencia' => $this->input->post('evidencia')
            );
            $this->control_model->updateControl( $control_id, $values );
            redirect('client/indicadores/controlAuditorias/'.$auditoria->seguimiento_id);
        }
    }
    function insertAuditoria()
    {
        $this->verify_session->verify_login('client/accidente/insertAuditoria');

        //validation
        $this->form_validation->set_rules('titulo', lang('backend_titulo'), 'required');
        //$this->form_validation->set_rules('dias_perdidos', lang('backend_dias_perdidos'), 'required');
        //$this->form_validation->set_rules('observacion', lang('backend_observacion'));
        $this->form_validation->set_rules('fecha_ocurrida', lang('backend_fecha_ocurrida'));
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        $login = $this->session->userdata('login');
        $user_id = $this->user_model->getUserByLogin($login);
        $user_id = $user_id->user_id;

        if ( $this->input->post('insert_form', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {
                $data['titulo'] = $this->input->post('titulo', TRUE);
                $data['fecha_ocurrida'] = $this->input->post('fecha_ocurrida', TRUE);
                $data['user_id'] = $this->input->post('user_id', TRUE);
                //$data['areas'] = $this->area_model->getAll($user_id);
                $this->layout->view('client/indicadores/insertAuditoria', $data);
            }
            else
            {
                $values = array('titulo' => $this->input->post('titulo', TRUE),
                    'fecha_ocurrida' => $this->input->post('fecha_ocurrida', TRUE),
                    'user_id' =>$user_id,
                    //'dias_perdidos' => $this->input->post('dias_perdidos',TRUE),
                    //'area_id' => $this->input->post('area_id')
                    //'description' => $this->input->post('description'),
                    //'sub_title' => $this->input->post('sub_title', TRUE)
                );
                $this->seguimiento_model->insertSeguimiento($values);

                redirect('client/indicadores/auditorias/');
            }
        }
        else
        {


            //$data['areas'] = $this->area_model->getAll($user_id);
            $this->layout->view('client/indicadores/insertAuditoria');
        }
    }
    function updateAuditoria($seguimiento_id=0)
    {
        $login = $this->session->userdata('login');
        $user_id = $this->user_model->getUserByLogin($login);
        $user_id = $user_id->user_id;
        $this->verify_session->verify_login('client/indicadores/updateAuditoria');

        //validation
        $this->form_validation->set_rules('titulo', lang('backend_titulo'), 'required');
        //$this->form_validation->set_rules('dias_perdidos', lang('backend_dias_perdidos'), 'required');
        //$this->form_validation->set_rules('observacion', lang('backend_observacion'), 'required');
        $this->form_validation->set_rules('fecha_ocurrida', lang('backend_fecha_ocurrida'), 'required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($seguimiento_id) AND is_numeric($seguimiento_id))
            {
                $picture = $this->seguimiento_model->getSeguimientoBySeguimientoId($seguimiento_id);
                if ( $picture == FALSE )
                {
                    redirect('client/indicadores/auditorias/');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                //$data['areas'] = $this->area_model->getAll($user_id);
                $this->layout->view('client/indicadores/updateAuditoria',$data);
            }
            else
            {
                redirect('client/indicadores/auditorias/');
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }
                //$data['areas'] = $this->area_model->getAll($user_id);
                $this->layout->view('client/indicadores/updateAuditoria', $data);
            }
            else
            {
                $values = array( 'titulo' => $this->input->post('titulo', TRUE),
                    //'dias_perdidos' => $this->input->post('dias_perdidos', TRUE),
                    //'area_id' => $this->input->post('area_id'),
                    'fecha_ocurrida'=> $this->input->post('fecha_ocurrida')
                );
                $seguimiento_id = $this->input->post('seguimiento_id', TRUE);
                $this->seguimiento_model->updateSeguimiento( $seguimiento_id, $values );
                redirect('client/indicadores/auditorias/');
            }
        }
    }
    function  deleteAuditoria($seguimiento_id = 0){
        $controles = $this->control_model->getAll($seguimiento_id);
        if($controles){
            foreach($controles as $control){
                $this->control_model->deleteControl($control->control_id);
            }
        }
        $this->seguimiento_model->deleteSeguimiento($seguimiento_id);
        redirect('client/indicadores/auditorias');
    }

    function insertControl($seguimiento_id = 0)
    {
        $this->verify_session->verify_login('client/indicadores/insertControl');

        //validation
        $this->form_validation->set_rules('responsable', lang('backend_responsable'), 'required');
        //$this->form_validation->set_rules('evidencia', lang('backend_evidencia'));
        $this->form_validation->set_rules('fecha_control', lang('backend_fecha_control'));
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {
                $data['responsable'] = $this->input->post('responsable', TRUE);
                //$data['evidencia'] = $this->input->post('evidencia');
                $data['fecha_control'] = $this->input->post('fecha_control', TRUE);
                $data['seguimiento_id'] = $this->input->post('seguimiento_id', TRUE);
                //$data['description'] = $this->input->post('description', TRUE);
                $this->layout->view('client/indicadores/insertControl', $data);
            }
            else
            {
                $user = $this->seguimiento_model->getSeguimientoBySeguimientoId($this->input->post('seguimiento_id', TRUE));
                $values = array('responsable' => $this->input->post('responsable', TRUE),
                    //'evidencia' => $this->input->post('evidencia'),
                    'fecha_control' => $this->input->post('fecha_control', TRUE),
                    'seguimiento_id' =>$seguimiento_id,
                    'medida' => $this->input->post('medida'),
                    'user_id' => $user->user_id
                    //'description' => $this->input->post('description'),
                    //'sub_title' => $this->input->post('sub_title', TRUE)
                );
                $this->control_model->insertControl($values);

                redirect('client/indicadores/controlAuditorias/'.$user->seguimiento_id);
            }
        }
        else
        {
            $data['seguimiento_id'] = $seguimiento_id;
            $this->layout->view('client/indicadores/insertControl',$data);
        }
    }
    function deleteControl($control_id = 0)
    {
        $accidente_id = $this->control_model->getControlByControlId($control_id);
        $this->control_model->deleteControl($control_id);

        $accidente_id = $accidente_id->seguimiento_id;
        redirect('client/indicadores/controlAuditorias/'.$accidente_id);
    }
    function updateControl($control_id=0)
    {

        $this->verify_session->verify_login('client/indicadores/updateControl');

        //validation
        $this->form_validation->set_rules('responsable', lang('backend_responsable'), 'required');
        $this->form_validation->set_rules('medida', lang('backend_medida'), 'required');
        $this->form_validation->set_rules('fecha_control', lang('backend_control'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('updateform', TRUE) == NULL)
        {
            $picture = $this->control_model->getControlByControlId($control_id);
            if ( !empty($control_id) AND is_numeric($control_id))
            {


                foreach($picture as $key=>$value){
                    $data[$key] = $value;
                }

                $data['seguimiento_id'] = $picture->seguimiento_id;
                $this->layout->view('client/indicadores/updateControl', $data);
            }
            else
            {
                redirect('client/indicadores/controlAuditorias/'.$picture->seguimiento_id);
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('client/indicadores/updateControl', $data);
            }
            else
            {
                $values = array( 'responsable' => $this->input->post('responsable', TRUE),
                    'medida' => $this->input->post('medida',TRUE),
                    'fecha_control'=> $this->input->post('fecha_control')
                );
                $control_id = $this->input->post('control_id', TRUE);
                $this->control_model->updateControl( $control_id, $values );
                $seguimiento_id = $this->input->post('seguimiento_id');
                redirect('client/indicadores/controlAuditorias/'.$seguimiento_id);
            }
        }
    }
    ///////////////             end             Auditorias        /   ////////////////////
    ///////////////             Accidentes        /   ////////////////////
    function accidentes()
    {

        $login = $this->session->userdata('login');
        $user_id = $this->user_model->getUserByLogin($login);
        $this->verify_session->verify_login('client/indicadores/accidentes');



        //load and config pagination
        $this->load->library('pagination');
        $config['base_url'] 		= site_url('client/indicadores/accidentes/');
        $config['total_rows'] 		= $this->accidente_model->getTotalAccidente();
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
        $data['accidentes']	 = $this->accidente_model->getAllAccidente($per_p, $off_set, $user_id->user_id);
        $anio = date('Y');
        $mes = date('m');
        $data['accidents'] = $this->accidente_model->getAllByMonth($user_id->user_id, $anio, $mes);
        $data['mes'] = $mes;
        $data['meses'] = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
        $data['anio'] = $anio;
        $data['user_id'] = $user_id;
        $this->layout->view('client/indicadores/accidentes',$data);
    }

    /**
     * Method: insertAccidente
     * Summary: insert a new user
     * @access public
     * @param string $str
     * @return
     */
    function insertAccidente()
    {
        $this->verify_session->verify_login('client/accidente/insertAccidente');

        //validation
        $this->form_validation->set_rules('dias_perdidos', lang('backend_dias_perdidos'), 'required');
        //$this->form_validation->set_rules('observacion', lang('backend_observacion'));
        $this->form_validation->set_rules('fecha_ocurrida', lang('backend_titulo'));
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        $login = $this->session->userdata('login');
        $user_id = $this->user_model->getUserByLogin($login);
        $user_id = $user_id->user_id;

        if ( $this->input->post('insert_form', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {
                $data['titulo'] = $this->input->post('titulo', TRUE);
                $data['fecha_ocurrida'] = $this->input->post('fecha_ocurrida', TRUE);
                $data['user_id'] = $this->input->post('user_id', TRUE);
                $data['areas'] = $this->area_model->getAll($user_id);
                $this->layout->view('client/indicadores/insertAccidente', $data);
            }
            else
            {
                $values = array('titulo' => $this->input->post('titulo', TRUE),
                    'fecha_ocurrida' => $this->input->post('fecha_ocurrida', TRUE),
                    'user_id' =>$user_id,
                    'dias_perdidos' => $this->input->post('dias_perdidos',TRUE),
                    'area_id' => $this->input->post('area_id')
                    //'description' => $this->input->post('description'),
                    //'sub_title' => $this->input->post('sub_title', TRUE)
                );
                $this->accidente_model->insertAccidente($values);

                redirect('client/indicadores/accidentes/');
            }
        }
        else
        {


            $data['areas'] = $this->area_model->getAll($user_id);
            $this->layout->view('client/indicadores/insertAccidente',$data);
        }
    }

    /**
     * Method: updateAccidente
     * Summary: edit the user data
     * @access public
     * @param string $str
     * @return
     */
    function updateAccidente($accidente_id=0)
    {
        $login = $this->session->userdata('login');
        $user_id = $this->user_model->getUserByLogin($login);
        $user_id = $user_id->user_id;
        $this->verify_session->verify_login('client/indicadores/updateGallery');

        //validation
        $this->form_validation->set_rules('dias_perdidos', lang('backend_dias_perdidos'), 'required');
        //$this->form_validation->set_rules('observacion', lang('backend_observacion'), 'required');
        $this->form_validation->set_rules('fecha_ocurrida', lang('backend_fecha_ocurrida'), 'required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($accidente_id) AND is_numeric($accidente_id))
            {
                $picture = $this->accidente_model->getAccidenteByAccidenteId($accidente_id);
                if ( $picture == FALSE )
                {
                    redirect('client/indicadores/accidentes/');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['areas'] = $this->area_model->getAll($user_id);
                $this->layout->view('client/indicadores/updateAccidente', $data);
            }
            else
            {
                redirect('client/indicadores/accidentes/');
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }
                $data['areas'] = $this->area_model->getAll($user_id);
                $this->layout->view('client/indicadores/updateAccidente', $data);
            }
            else
            {
                $values = array( 'titulo' => $this->input->post('titulo', TRUE),
                    'dias_perdidos' => $this->input->post('dias_perdidos', TRUE),
                    'area_id' => $this->input->post('area_id'),
                    'fecha_ocurrida'=> $this->input->post('fecha_ocurrida')
                );
                $accidente_id = $this->input->post('accidente_id', TRUE);
                $this->accidente_model->updateAccidente( $accidente_id, $values );
                redirect('client/indicadores/accidentes/');
            }
        }
    }
    function  deleteAccidente($accidente_id = 0){
        $medidas = $this->medida_correctiva_model->getAll($accidente_id);
        if($medidas){
            foreach($medidas as $medida){
                $this->medida_correctiva_model->deleteMedida_correctiva($medida->medida_correctiva_id);
            }
        }
        $trabajadores_afectados = $this->accidente_trabajador_model->getAll($accidente_id);
        if($trabajadores_afectados){
            foreach($trabajadores_afectados as $trabajadorAfectado){
                $this->accidente_trabajador_model->deleteAccidente_trabajador($trabajadorAfectado->accidente_trabajador_id);
            }

        }
        $this->accidente_model->deleteAccidente($accidente_id);
        redirect('client/indicadores/accidentes');
    }
    function observacionAccidente($accidente_id = 0)
    {
        $this->verify_session->verify_login('client/indicadores/observacionAccidente');

        if ($this->input->post('update_form') == NULL)
        {
            if ( !empty($accidente_id) AND is_numeric($accidente_id))
            {
                $trabajador = $picture = $this->accidente_model->getAccidenteByAccidenteId($accidente_id);
                foreach($trabajador as $key=>$value){
                    $data[$key] = $value;
                }
                if ( $picture == FALSE )
                {
                    redirect('client/indicadores/accidentes/');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $this->layout->view('client/indicadores/observacionAccidente', $data);
            }
            else
            {
                redirect('client/indicadores/accidentes/');
            }
        }
        else
        {
            $accidente_id =  $this->input->post('accidente_id');
            $values = array( 'observacion' => $this->input->post('observacion')
            );
            $this->accidente_model->updateAccidente( $accidente_id, $values );
            redirect('client/indicadores/accidentes/');
        }
    }
    function medidaCorrectiva($accidente_id = 0){
        $login = $this->session->userdata('login');
        $data['medida_correctivas'] = $this->medida_correctiva_model->getAll($accidente_id);
        $data['accidente_id'] = $accidente_id;
        $this->layout->view('client/indicadores/medidaCorrectiva',$data);
    }
    function insertMedida_correctiva($accidente_id)
    {
        $this->verify_session->verify_login('client/indicadores/insertMedida_correctiva');

        //validation
        $this->form_validation->set_rules('responsable', lang('backend_responsable'), 'required');
        $this->form_validation->set_rules('evidencia', lang('backend_evidencia'));
        $this->form_validation->set_rules('fecha_medida_correctiva', lang('backend_fecha_medida_correctiva'));
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {
                $data['responsable'] = $this->input->post('responsable', TRUE);
                $data['evidencia'] = $this->input->post('evidencia');
                $data['fecha_medida_correctiva'] = $this->input->post('fecha_medida_correctiva', TRUE);
                $data['accidente_id'] = $this->input->post('accidente_id', TRUE);
                //$data['description'] = $this->input->post('description', TRUE);
                $this->layout->view('client/indicadores/insertMedida_correctiva', $data);
            }
            else
            {
                $user = $this->accidente_model->getAccidenteByAccidenteId($this->input->post('accidente_id', TRUE));
                $values = array('responsable' => $this->input->post('responsable', TRUE),
                    'evidencia' => $this->input->post('evidencia'),
                    'fecha_medida_correctiva' => $this->input->post('fecha_medida_correctiva', TRUE),
                    'accidente_id' =>$accidente_id,
                    'medida' => $this->input->post('medida'),
                    'user_id' => $user->user_id
                    //'description' => $this->input->post('description'),
                    //'sub_title' => $this->input->post('sub_title', TRUE)
                );
                $this->medida_correctiva_model->insertMedida_correctiva($values);

                redirect('client/indicadores/medidaCorrectiva/'.$accidente_id);
            }
        }
        else
        {
            $data['accidente_id'] = $accidente_id;
            $this->layout->view('client/indicadores/insertMedida_correctiva',$data);
        }
    }

    function evidenciaMedidaCorrectiva($medida_correctiva_id = 0)
    {

        $this->verify_session->verify_login('client/indicadores/evidenciaMedidaCorrectiva');

        if ($this->input->post('update_form') == NULL)
        {

            if ( !empty($medida_correctiva_id) AND is_numeric($medida_correctiva_id))
            {
                $trabajador = $picture = $this->medida_correctiva_model->getMedida_correctivaByMedida_correctivaId($medida_correctiva_id);
                foreach($trabajador as $key=>$value){
                    $data[$key] = $value;
                }
                if ( $picture == FALSE )
                {
                    redirect('client/indicadores/medidaCorrectiva/'.$medida_correctiva_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $this->layout->view('client/indicadores/evidenciaMedidaCorrectiva', $data);
            }
            else
            {

                redirect('client/indicadores/medidaCorrectiva/'.$medida_correctiva_id);
            }
        }
        else
        {
            $medida_correctiva =  $this->input->post('medida_correctiva_id');
            $medida_correctiva = $this->medida_correctiva_model->getMedida_correctivaByMedida_correctivaId($medida_correctiva);
            $values = array( 'evidencia' => $this->input->post('evidencia')
            );
            $this->medida_correctiva_model->updateMedida_correctiva( $medida_correctiva->medida_correctiva_id, $values );
            redirect('client/indicadores/medidaCorrectiva/'.$medida_correctiva->accidente_id);
        }
    }

    /////////////////////////     Gestionar  Trabajadores        ///////////////////
    function trabajadores()
    {
        $this->verify_session->verify_login('client/indicadores/index');
        $user = $this->session->userdata('login');
        $user = $this->user_model->getUserByLogin($user);
        $user_id = $user->user_id;


        //load and config pagination
        $this->load->library('pagination');
        $offset=0;
        $config['base_url'] 		= site_url('client/indicadores/trabajadores/');
        $config['total_rows'] 		= $this->trabajador_model->getTotalTrabajadors();
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
        $data['trabajadors']	 = $this->trabajador_model->getAllTrabajadors($per_p, $off_set, $user_id);
        $data['user_id'] = $user_id;
        $this->layout->view('client/indicadores/trabajadores',$data);
    }

    /**
     * Method: insertTrabajador
     * Summary: insert a new user
     * @access public
     * @param string $str
     * @return
     */
    function insertTrabajador()
    {
        $user = $this->session->userdata('login');
        $user = $this->user_model->getUserByLogin($user);
        $user_id = $user->user_id;
        $this->verify_session->verify_login('client/indicadores/insertTrabajador/');

        //validation
        $this->form_validation->set_rules('nombre', lang('backend_nombre'), 'required');
        $this->form_validation->set_rules('apellidos', lang('backend_apellidos'), 'required');
        $this->form_validation->set_rules('cargo_id', lang('backend_cargo_id'), 'required');
        $this->form_validation->set_rules('dni', lang('backend_dni'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {
                $data['nombre'] = $this->input->post('nombre', TRUE);
                $data['apellidos'] = $this->input->post('apellidos', TRUE);
                $data['cargo_id'] = $this->input->post('cargo_id', TRUE);
                $data['dni'] = $this->input->post('dni', TRUE);
                $data['user_id'] = $this->input->post('user_id', TRUE);
                $data['cargos']=$this->cargo_model->getAll($data['user_id']);

                //$data['sub_title'] = $this->input->post('sub_title', TRUE);
                //$data['description'] = $this->input->post('description', TRUE);
                $this->layout->view('client/indicadores/insertTrabajador', $data);
            }
            else
            {


                $values = array('nombre' => $this->input->post('nombre', TRUE),
                    'apellidos' => $this->input->post('apellidos',TRUE),
                    'cargo_id' => $this->input->post('cargo_id', TRUE),
                    'dni' => $this->input->post('dni', TRUE),
                    'user_id' => $this->input->post('user_id', TRUE)
                );
                $this->trabajador_model->insertTrabajador($values);
                $user_id = $this->input->post('user_id', TRUE);
                redirect('client/indicadores/trabajadores/');
            }
        }
        else
        {
            $data['cargos']=$this->cargo_model->getAll($user_id);
            $data['user_id'] = $user_id;
            $this->layout->view('client/indicadores/insertTrabajador',$data);
        }
    }

    /**
     * Method: updateTrabajador
     * Summary: edit the user data
     * @access public
     * @param string $str
     * @return
     */
    function updateTrabajador($trabajador_id=0)
    {
        $this->verify_session->verify_login('client/indicadores/updateTrabajador');

        //validation
        $this->form_validation->set_rules('nombre', lang('backend_name'), 'required');
        $this->form_validation->set_rules('apellidos', lang('backend_apellidos'), 'required');
        $this->form_validation->set_rules('cargo_id', lang('backend_cargo_id'), 'required');
        $this->form_validation->set_rules('dni', lang('backend_dni'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($trabajador_id) AND is_numeric($trabajador_id))
            {
                $picture = $this->trabajador_model->getTrabajadorByTrabajadorId($trabajador_id);
                if ( $picture == FALSE )
                {
                    redirect('client/indicadores/trabajadores');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $user_id = $this->session->userdata('login');
                $user_id = $this->user_model->getUserByLogin($user_id);
                $user_id = $user_id->user_id;
                $data['cargos']=$this->cargo_model->getAll($user_id);
                $this->layout->view('client/indicadores/updateTrabajador', $data);
            }
            else
            {
                redirect('client/indicadores/trabajadores');
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }
                $data['cargos']=$this->cargo_model->getAll();
                $this->layout->view('client/indicadores/updateTrabajador', $data);
            }
            else
            {
                $values = array('nombre' => $this->input->post('nombre', TRUE),
                    'apellidos' => $this->input->post('apellidos',TRUE),
                    'cargo_id' => $this->input->post('cargo_id', TRUE),
                    'dni' => $this->input->post('dni', TRUE)
                );
                $trabajador_id = $this->input->post('trabajador_id', TRUE);
                $this->trabajador_model->updateTrabajador( $trabajador_id, $values );

                redirect('client/indicadores/trabajadores/');
            }
        }
    }
    /**
     * Method: deleteTrabajador
     * Summary:
     * @access public
     * @param string $str
     * @return
     */

    /**
     * Method: deleteTrabajador
     * Summary:
     * @access public
     * @param string $str
     * @return
     */
    function deleteTrabajador($trabajador_id=0, $user_id = 0)
    {
        $this->verify_session->verify_login('administrator/trabajador/deleteTrabajador');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->trabajador_model->getTrabajadorByTrabajadorId($trabajador_id);

            if ( !empty($trabajador_id) AND is_numeric($trabajador_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/trabajador/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $this->layout->view('administrator/trabajador/deleteTrabajador', $data);
            }
            else
            {
                redirect('administrator/trabajador/index/');
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('trabajador_id', TRUE) as $trabajador_id )
                {
                    $data = $this->trabajador_model->getTrabajadorByTrabajadorId($trabajador_id);
                    $this->trabajador_model->deleteTrabajador($trabajador_id);
                }
            }
            else
            {
                $trabajador_id = $this->input->post('trabajador_id', TRUE);

                $data = $this->trabajador_model->getTrabajadorByTrabajadorId($trabajador_id);
                $this->trabajador_model->deleteTrabajador($trabajador_id);
            }
            $user_id = $this->input->post('user_id', TRUE);
            redirect('client/indicadores/trabajadores/');
        }
    }

    function trabajadoresAfectados($accidente_id = 0)
    {
        $this->verify_session->verify_login('client/indicadores/trabajadoresAfectados');



        //load and config pagination
        $this->load->library('pagination');
        $config['base_url'] 		= site_url('client/indicadores/trabajadoresAfectados/');
        $config['total_rows'] 		= $this->accidente_trabajador_model->getTotalAccidente_trabajador();
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

        $accidente = $picture = $this->accidente_model->getAccidenteByAccidenteId($accidente_id);
        foreach($accidente as $key=>$value){
            $data[$key] = $value;
        }
        $trab_id = $data['user_id'];
        $data['trabajadores'] = $this->trabajador_model->getAll($trab_id);
        $data['accidente_trabajadors']	 = $this->accidente_trabajador_model->getAllAccidente_trabajador($per_p, $off_set, $accidente_id);
        $data['accidente_id'] = $accidente_id;
        $this->layout->view('client/indicadores/trabajadoresAfectados',$data);
    }

    ///////////////////// fin Gestionar Trabajadores      ////////////////////
    /**
     * Method: insertAccidente_trabajador
     * Summary: insert a new accidente
     * @access public
     * @param string $str
     * @return
     */
    function insertAccidente_trabajador($accidente_id = 0)
    {
        $this->verify_session->verify_login('client/indicadores/insertAccidente_trabajador');

        //validation
        //$this->form_validation->set_rules('nombre', lang('backend_nombre'), 'required');
        //$this->form_validation->set_rules('trabajador_id', lang('backend_trabajador'));
        //$this->form_validation->set_rules('fecha_accidente_trabajador', lang('backend_fecha_accidente_trabajador'));
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {
            if($this->input->post('tipo', TRUE)){
                $values = array('nombre' => $this->input->post('nombre', TRUE),
                    'trabajador_id' => 0,
                    'accidente_id' =>$this->input->post('accidente_id', TRUE),
                    'body_id' => $this->input->post('body_id')
                );
            }
            else{
                $nombre = $this->input->post('trabajador_id');
                $picture = $this->trabajador_model->getTrabajadorByTrabajadorId($nombre);
                if ( $picture == FALSE )
                {
                    redirect('client/indicadores/index/'.$accidente_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $user = $this->accidente_model->getAccidenteByAccidenteId($this->input->post('accidente_id', TRUE));
                $values = array('nombre' => $data['nombre'].' '.$data['apellidos'],
                    'trabajador_id' => $this->input->post('trabajador_id'),
                    'accidente_id' =>$this->input->post('accidente_id', TRUE),
                    'body_id' => $this->input->post('body_id'),
                    'user_id' => $user->user_id
                );
            }



            $this->accidente_trabajador_model->insertAccidente_trabajador($values);
            $accidente_id = $this->input->post('accidente_id', TRUE);
            redirect('client/indicadores/trabajadoresAfectados/'.$accidente_id);
        }
        else
        {
            $accidente = $picture = $this->accidente_model->getAccidenteByAccidenteId($accidente_id);
            foreach($accidente as $key=>$value){
                $data[$key] = $value;
            }
            $trab_id = $data['user_id'];
            $data['trabajadores'] = $this->trabajador_model->getAll($trab_id);
            $data['bodies'] = $this->body_model->getAllBody($trab_id);
            $data['accidente_id'] = $accidente_id;
            $data['accidente_trabajadores']	 = $this->accidente_trabajador_model->getAll($accidente_id);
            $this->layout->view('client/indicadores/insertAccidente_trabajador',$data);
        }
    }

    /**
     * Method: updateAccidente_trabajador
     * Summary: edit the accidente data
     * @access public
     * @param string $str
     * @return
     */
    function deleteMedida_correctiva($medida_correctiva_id=0, $accidente_id = 0)
    {
        $this->medida_correctiva_model->deleteMedida_correctiva($medida_correctiva_id);
        redirect('client/indicadores/medidaCorrectiva/'.$accidente_id);
    }
    function updateMedida_correctiva($medida_correctiva_id=0)
    {

        $this->verify_session->verify_login('client/indicadores/updateMedida_correctiva');

        //validation
        $this->form_validation->set_rules('responsable', lang('backend_responsable'), 'required');
        $this->form_validation->set_rules('medida', lang('backend_medida'), 'required');
        $this->form_validation->set_rules('fecha_medida_correctiva', lang('backend_medida_correctiva'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('updateform', TRUE) == NULL)
        {
            $picture = $this->medida_correctiva_model->getMedida_correctivaByMedida_correctivaId($medida_correctiva_id);
            if ( !empty($medida_correctiva_id) AND is_numeric($medida_correctiva_id))
            {


                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }

                $data['accidente_id'] = $picture->accidente_id;
                $this->layout->view('client/indicadores/updateMedida_correctiva', $data);
            }
            else
            {
                redirect('client/indicadores/medidaCorrectiva/'.$picture->accidente_id);
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('client/indicadores/updateMedida_correctiva', $data);
            }
            else
            {
                $values = array( 'responsable' => $this->input->post('responsable', TRUE),
                    'medida' => $this->input->post('medida',TRUE),
                    'fecha_medida_correctiva'=> $this->input->post('fecha_medida_correctiva')
                );
                $medida_correctiva_id = $this->input->post('medida_correctiva_id', TRUE);
                $this->medida_correctiva_model->updateMedida_correctiva( $medida_correctiva_id, $values );
                $accidente = $this->input->post('accidente_id');
                redirect('client/indicadores/medidaCorrectiva/'.$accidente);
            }
        }
    }
    function updateAccidente_trabajador($accidente_trabajador_id=0, $accidente_id = 0)
    {

        $this->verify_session->verify_login('client/indicadores/updateAccidente_trabajador');

        //validation
        //$this->form_validation->set_rules('nombre', lang('backend_nombre'), 'required');
        $this->form_validation->set_rules('trabajador_id', lang('backend_trabajador_id'), 'required');
        //$this->form_validation->set_rules('fecha_accidente_trabajador', lang('backend_accidente_trabajador'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($accidente_trabajador_id) AND is_numeric($accidente_trabajador_id))
            {

                $accidente = $picture = $this->accidente_model->getAccidenteByAccidenteId($accidente_id);
                foreach($accidente as $key=>$value){
                    $data[$key] = $value;
                }
                $trab_id = $data['user_id'];
                $data['trabajadores'] = $this->trabajador_model->getAll($trab_id);
                $data['bodies'] = $this->body_model->getAllBody($trab_id);
                $data['accidente_id'] = $accidente_id;
                $picture = $this->accidente_trabajador_model->getAccidente_trabajadorByAccidente_trabajadorId($accidente_trabajador_id);
                if ( $picture == FALSE )
                {
                    redirect('client/indicadores/index/'.$accidente_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['accidente_trabajadores']	 = $this->accidente_trabajador_model->getAll($accidente_id);
                $this->layout->view('client/indicadores/updateAccidente_trabajador', $data);
            }
            else
            {
                redirect('client/indicadores/index/'.$accidente_id);
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }


                $this->layout->view('client/indicadores/updateAccidente_trabajador', $data);
            }
            else
            {
                $trabajador = $this->trabajador_model->getTrabajadorByTrabajadorId($this->input->post('trabajador_id'));
                foreach($trabajador as $key=>$value){
                    $data[$key] = $value;
                }

                $values = array( 'nombre' => $data['nombre'].' '.$data['apellidos'],
                    'trabajador_id' => $this->input->post('trabajador_id'),
                    'body_id' => $this->input->post('body_id')

                    //'fecha_accidente_trabajador'=> $this->input->post('fecha_accidente_trabajador')
                );
                $accidente_trabajador_id = $this->input->post('accidente_trabajador_id', TRUE);
                $this->accidente_trabajador_model->updateAccidente_trabajador( $accidente_trabajador_id, $values );
                $accidente = $this->input->post('accidente_id', TRUE);
                redirect('client/indicadores/trabajadoresAfectados/'.$accidente);
            }
        }
    }

    /**
     * Method: deleteAccidente_trabajador
     * Summary:
     * @access public
     * @param string $str
     * @return
     */
    function deleteAccidente_trabajador($accidente_trabajador_id=0, $accidente_id)
    {
        $this->accidente_trabajador_model->deleteAccidente_trabajador($accidente_trabajador_id);

        redirect('client/indicadores/trabajadoresAfectados/'.$accidente_id);

    }
///////////////             end             Accidentes        /   ////////////////////
}

/* End of file home.php */
/* Location: ./system/application/controllers/client/home.php */