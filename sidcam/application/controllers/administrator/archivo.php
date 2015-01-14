<?php
/**
 * Classname: Archivo
 * Summary: Controller for Archivo objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Archivo extends CI_Controller
{
	var	$_temp_path		= "./resources/media/archivo/original/";
	var	$_full_path		= "./resources/media/archivo/full/";
	var	$_thumb_path	= "./resources/media/archivo/thumbs/";
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
        $this->load->library('ftp');
		$this->load->library('image_lib');
		
		$this->load->model('archivo_model');
		$this->load->library('form_validation');
        $this->load->model('tipo_model');
        $this->load->model('user_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($user_id=0, $offset=0)
	{
		$this->verify_session->verify_login('administrator/archivo/index');
		
		if( empty($user_id) OR !is_numeric($user_id))
		{
			redirect('administrator/user/index');
		}
		
		//load and config pagination
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/subfaq/index/' . $user_id);
		$config['total_rows'] 		= $this->archivo_model->getTotalArchivos($user_id);
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

		$data['archivos'] = $this->archivo_model->getAllArchivos($user_id, $per_p, $off_set);
        $data['user_id'] = $user_id;
		$this->layout->view('administrator/archivo/index',$data);
	}
	
	/**
	 * Method: insertArchivo
	 * Summary: insert a new user
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertArchivo($user_id)
    {
        $this->verify_session->verify_login('administrator/archivo/insertArchivo');

        //validation
        $this->form_validation->set_rules('title', lang('backend_title'), 'required');
        $this->form_validation->set_rules('codigo', lang('backend_archivo_codigo'), '');
        $this->form_validation->set_rules('revision', lang('backend_archivo_revision'));
        $this->form_validation->set_rules('fecha_aprobacion', lang('backend_archivo_fecha_aprobacion'));
        $this->form_validation->set_rules('picture', lang('backend_archivo'));

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
                $data['codigo'] = $this->input->post('codigo', TRUE);
                $data['revision'] = $this->input->post('revision', TRUE);
                $data['fecha_aprobacion'] = $this->input->post('fecha_aprobacion');
                $data['picture'] = $this->input->post('picture', TRUE);
                $data['user_id'] = $this->input->post('user_id', TRUE);
                $data['user_id'] = $user_id;
                $data['tipos'] = $this->tipo_model->getAll($user_id);
                $this->layout->view('administrator/archivo/insertArchivo', $data);
            }
            else
            {
                $dominio = $_SERVER['HTTP_HOST'];
                $session = $_SERVER['REQUEST_URI'];
                $url = "http://" . $dominio . $session;
                $uploadDir = "./resources/media/archivo/doc/";
                $name_user = $this->user_model->getUserByUserId($user_id);
                foreach($name_user as $key=>$value){
                    $data[$key] = $value;
                }
                $tipoId = $this->input->post('tipo_id', TRUE);
                $tipoId = $this->tipo_model->getTipoByTipoId($tipoId);
                $uploadDir = $uploadDir.$data['login'].'/';
                if(!is_dir($uploadDir)){
                    mkdir($uploadDir, 0777,TRUE);
                }
                $uploadDir = $uploadDir.$tipoId->nombre.'/';
                if(!is_dir($uploadDir)){
                    mkdir($uploadDir, 0777,TRUE);
                }
                $uploadFile = $uploadDir.$_FILES['picture']['name'];
                $ext = $_FILES['picture']['name'];
                $asd = explode(".", $ext);
                $ext = $asd[1];
                //if($ext == "pdf" || $ext == "doc" || $ext == "jpg" || $ext == "jpeg" || $ext == "png"){
                if($ext == "pdf" || $ext == "xls" || $ext == "xlsx"){

                    if ($_FILES['picture']['size'] == 0 )
                    {
                        $values = array('title' => $this->input->post('title', TRUE),
                            'codigo' => $this->input->post('codigo'),
                            'revision' => $this->input->post('revision', TRUE),
                            'fecha_aprobacion' => $this->input->post('fecha_aprobacion', TRUE),
                            'tipo_id' => $this->input->post('tipo_id', TRUE),
                            'user_id' => $user_id
                        );
                        $this->archivo_model->insertArchivo($values);

                        redirect('administrator/archivo/index/'.$user_id);
                    }
                    else
                    {
                        if(!$this->archivo_model->getArchivoByArchivoPicture($_FILES['picture']['name'],$user_id)){
                            $values = array('title' => $this->input->post('title', TRUE),
                                'codigo' => $this->input->post('codigo'),
                                'revision' => $this->input->post('revision', TRUE),
                                'fecha_aprobacion' => $this->input->post('fecha_aprobacion', TRUE),
                                'tipo_id' => $this->input->post('tipo_id', TRUE),
                                'user_id' => $user_id,
                                'picture' => $_FILES['picture']['name']
                            );

                            $this->archivo_model->insertArchivo($values);
                            move_uploaded_file($_FILES['picture']['tmp_name'],$uploadFile);
                            redirect('administrator/archivo/index/'.$user_id);
                        }
                        else{
                            redirect('administrator/archivo/insertArchivo/'.$user_id);
                        }
                    }
                    redirect('administrator/archivo/index/'.$user_id);
                }
                else{
                    echo $_FILES['picture']['type'];
                    redirect('administrator/archivo/insertArchivo/'.$user_id);
                }


            }
        }
        else
        {
            $data['user_id'] = $user_id;
            $data['tipos'] = $this->tipo_model->getAll($user_id);
            $this->layout->view('administrator/archivo/insertArchivo',$data);
        }
    }
	
	/**
	 * Method: updateArchivo
	 * Summary: edit the user data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateArchivo($archivo_id=0)
	{
        $this->verify_session->verify_login('administrator/archivo/updateArchivo');

        //validation
        $this->form_validation->set_rules('title', lang('backend_title'), 'required');
        $this->form_validation->set_rules('codigo', lang('backend_archivo_codigo'), '');
        $this->form_validation->set_rules('revision', lang('backend_archivo_revision'));
        $this->form_validation->set_rules('fecha_aprobacion', lang('backend_archivo_fecha_aprobacion'));
        $this->form_validation->set_rules('picture', lang('backend_archivo'));

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
            if ( !empty($archivo_id) AND is_numeric($archivo_id))
            {
                $picture = $this->archivo_model->getArchivoByArchivoId($archivo_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/archivo/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                    $data['tipos'] = $this->tipo_model->getAll($data['user_id']);
					
                	$this->layout->view('administrator/archivo/updateArchivo', $data);
                }
            }
            else
            {
                redirect('administrator/archivo/index');
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('administrator/archivo/updateArchivo', $data);
            }
            else
            {
                $values = array('title' => $this->input->post('title', TRUE),
                    'codigo' => $this->input->post('codigo'),
                    'revision' => $this->input->post('revision', TRUE),
                    'fecha_aprobacion' => $this->input->post('fecha_aprobacion', TRUE),
                    'tipo_id' => $this->input->post('tipo_id')
								);
                $archivo_id = $this->input->post('archivo_id', TRUE);
                $user_id = $this->input->post('user_id', TRUE);
                $this->archivo_model->updateArchivo( $archivo_id, $values );

                if ($_FILES['picture']['size'] >0)
                {
                    if(!$this->archivo_model->getArchivoByArchivoPicture($_FILES['picture']['name'])){
                       //DELETE     inicio
                        $path = "./resources/media/archivo/doc/";

                        $name_user = $this->user_model->getUserByUserId($user_id);
                        $data = $this->archivo_model->getArchivoByArchivoId($this->input->post('archivo_id'));
                        $tipoId = $this->tipo_model->getTipoByTipoId($data['tipo_id']);
                        $path = $path.$name_user->login.'/'.$tipoId->nombre.'/';
                        $archivo_id = $this->input->post('archivo_id', TRUE);

                        $data = $this->archivo_model->getArchivoByArchivoId($archivo_id);

                        //remove files
                        @unlink($path . $data["picture"]);
//fin DELETE
                        $dominio = $_SERVER['HTTP_HOST'];
                        $session = $_SERVER['REQUEST_URI'];
                        $url = "http://" . $dominio . $session;
                        $uploadDir = "./resources/media/archivo/doc/";
                        $name_user = $this->user_model->getUserByUserId($user_id);
                        foreach($name_user as $key=>$value){
                            $data[$key] = $value;
                        }
                        $tipoId = $this->input->post('tipo_id', TRUE);
                        $tipoId = $this->tipo_model->getTipoByTipoId($tipoId);
                        $uploadDir = $uploadDir.$data['login'].'/';
                        if(!is_dir($uploadDir)){
                            mkdir($uploadDir, 0777,TRUE);
                        }
                        $uploadDir = $uploadDir.$tipoId->nombre.'/';
                        if(!is_dir($uploadDir)){
                            mkdir($uploadDir, 0777,TRUE);
                        }
                        $uploadFile = $uploadDir.$_FILES['picture']['name'];
                        move_uploaded_file($_FILES['picture']['tmp_name'],$uploadFile);
                        $values = array('picture'=> $_FILES['picture']['name']);
                        $this->archivo_model->updateArchivo( $archivo_id, $values );
                    }
                    else{
                        redirect('administrator/archivo/updateArchivo/'.$archivo_id);
                    }
                }
                redirect('administrator/archivo/index/'.$user_id);
            }
        }
	}
	
	/**
	 * Method: deleteArchivo
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteArchivo($archivo_id=0)
	{
        $this->verify_session->verify_login('administrator/archivo/deleteArchivo');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->archivo_model->getArchivoByArchivoId($archivo_id);

            if ( !empty($archivo_id) AND is_numeric($archivo_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/archivo/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $this->layout->view('administrator/archivo/deleteArchivo', $data);
            }
            else
            {
                $data = $this->archivo_model->getArchivoByArchivoId($archivo_id);
                redirect('administrator/archivo/index/'.$data['user_id']);
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

                $name_user = $this->user_model->getUserByUserId($this->input->post('user_id'));
               // echo $name_user->login;
                //echo br();
               // echo count($this->input->post('archivo_id', TRUE));echo br();
                //echo 'id 1:'.$this->input->post('archivo_id', TRUE)[0];

                $cheks = count($this->input->post('archivo_id', TRUE));
                //echo $cheks;
                for ( $cont = 0; $cont < $cheks; $cont++ )
                {
                    //echo 'uno'.br();
                    //Buen dato
                    $archivo_id = $this->input->post('archivo_id', TRUE)[$cont];
                    echo $archivo_id.br();
                    //echo $archivo_id;echo br();
                    //echo $archivo_id.br();
                    $path = "./resources/media/archivo/doc/";
                    //Bueno/////
                    $data = $this->archivo_model->getArchivoByArchivoId($archivo_id);
                    echo 'id:'.$data['tipo_id'].br();
                    $idTipo=$data['tipo_id'];
                    $tipoId = $this->tipo_model->getTipoByTipoId($idTipo);
                    echo $tipoId->nombre;
                    //echo $tipoId['nombre'].br();
                    echo $name_user->login.br();
                    $path = $path.$name_user->login.'/'.$tipoId->nombre.'/';
                    echo $path.br();
                    //$data = $this->archivo_model->getArchivoByArchivoId($archivo_id);
                    $this->archivo_model->deleteArchivo($archivo_id);
                    //remove files
                    @unlink($path . $data["picture"]);
                }

                $user_id = $this->input->post('user_id');
                redirect('administrator/archivo/index/'.$user_id);

            }
            else
            {

                $path = "./resources/media/archivo/doc/";

                $name_user = $this->user_model->getUserByUserId($this->input->post('user_id'));
                $data = $this->archivo_model->getArchivoByArchivoId($this->input->post('archivo_id'));
                $tipoId = $this->tipo_model->getTipoByTipoId($data['tipo_id']);
                $path = $path.$name_user->login.'/'.$tipoId->nombre.'/';
                $archivo_id = $this->input->post('archivo_id', TRUE);

                $data = $this->archivo_model->getArchivoByArchivoId($archivo_id);
                $this->archivo_model->deleteArchivo($archivo_id);

                //remove files
				@unlink($path . $data["picture"]);
            }

			$user_id = $this->input->post('user_id');
            redirect('administrator/archivo/index/'.$user_id);
        }
	}
}

/* End of file archivo_lang.php */
/* Location: ./system/application/controllers/administrator/archivo_lang.php */
?>