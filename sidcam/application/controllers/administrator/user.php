<?php
/**
 * Classname: User
 * Summary: Controller for User objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class User extends CI_Controller
{
	/**
	 * Method: __construct
	 * Summary: Method construct
	 * @access public
	 */
	function __construct()
	{
		parent::__construct();
		
		//Lets load our own library to handle layouts
		$params = array('layout' => 'layouts/layout_admin');
		$this->load->library('layout', $params);

        $this->load->model('tipo_model');
        $this->load->model('seguimiento_model');
        $this->load->model('trabajador_model');
        $this->load->model('objetivo_model');
        $this->load->model('inspeccion_model');
        $this->load->model('accidente_model');
        $this->load->model('capacitacion_model');
        $this->load->model('archivo_model');
        $this->load->model('body_model');
        $this->load->model('cargo_model');
        $this->load->model('area_model');
        $this->load->model('epp_model');
        $this->load->model('epp_work_model');
        $this->load->model('capacitacion_work_model');
        $this->load->model('especifico_model');
        $this->load->model('actividad_model');
        $this->load->model('planificacion_model');
        $this->load->model('c_inspeccion_model');
        $this->load->model('accidente_trabajador_model');
        $this->load->model('medida_correctiva_model');
        $this->load->model('control_model');
        $this->load->model('c_inspeccion_model');


    }
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
    function cliente()
    {
        $this->verify_session->verify_login('administrator/user/index');
        $data['users'] = $this->user_model->getAllUsers();
        $this->layout->view('administrator/user/cliente', $data);
    }

    /**
     * Method: userCheckInsert
     * Summary: validates if the login provided by the user its unique
     * @access public
     * @param string $str
     * @return
     */
	function index()
	{
		$this->verify_session->verify_login('administrator/user/index');
		$data['users'] = $this->user_model->getAllUsers();
		$this->layout->view('administrator/user/index', $data);
	}

	/**
	 * Method: userCheckInsert
	 * Summary: validates if the login provided by the user its unique
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function userCheckInsert($str)
	{
		$result = $this->user_model->searchUserInsert($str);
		if ($result === FALSE)
		{
			$this->form_validation->set_message('userCheckInsert', lang('backend_unique_message'));
		}
		return $result;
	}
	
	/**
	 * Method: userCheckEdit
	 * Summary: validates if the login provided by the user its unique
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function userCheckEdit($str)
	{
		$user_id = $this->input->post('user_id', TRUE);
		$result = $this->user_model->searchUserEdit($str, $user_id);
		if ($result === FALSE) 
		{
			$this->form_validation->set_message('userCheckEdit', lang('backend_unique_message'));
		}
		return $result;
	}
	
	/**
	 * Method: insertUser
	 * Summary: insert a new user
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function insertUser()
	{
		$this->verify_session->verify_login('administrator/user/insertUser');
		
		//validation
		$this->form_validation->set_rules('firstname', lang('backend_firstname'), 'required');
		$this->form_validation->set_rules('lastname', lang('backend_lastname'), 'required');
		$this->form_validation->set_rules('email', lang('backend_email'), 'required|valid_email');
		$this->form_validation->set_rules('login', lang('backend_login'), 'required|callback_userCheckInsert');
		$this->form_validation->set_rules('password', lang('backend_password'), 'required');
		
		$this->form_validation->set_error_delimiters('<p class="warning">', '</p>');
		
		if ( !$this->form_validation->run())
		{
			$this->layout->view('administrator/user/insertUser');
		}
		else
		{
			$values = array('firstname' => $this->input->post('firstname', TRUE),
							'lastname' => $this->input->post('lastname', TRUE),
							'email' => $this->input->post('email', TRUE),
							'login' => $this->input->post('login', TRUE),
							'password' => $this->input->post('password', TRUE),
                            'user_level_id' => 2
							);
							
			$this->user_model->insertUser($values);
            $data = $this->user_model->getUserByLogin($this->input->post('login', TRUE));
            $politica = array('nombre'=>'politica','user_id'=>$data->user_id);
            $operacion = array('nombre'=>'operacion','user_id'=>$data->user_id);
            $evaluacion = array('nombre'=>'evaluacion','user_id'=>$data->user_id);
            $planificacion = array('nombre'=>'planificacion','user_id'=>$data->user_id);
            $indicadores = array('nombre'=>'indicadores de gestion','user_id'=>$data->user_id);

            $bodies = array(array('nombre'=>'Cabeza','user_id'=>$data->user_id),
                            array('nombre'=>'Cuello','user_id'=>$data->user_id),
                            array('nombre'=>'Brazos','user_id'=>$data->user_id),
                            array('nombre'=>'Manos','user_id'=>$data->user_id),
                            array('nombre'=>'Espalda','user_id'=>$data->user_id),
                            array('nombre'=>'Abdomen','user_id'=>$data->user_id),
                            array('nombre'=>'Muslo','user_id'=>$data->user_id),
                            array('nombre'=>'Piernas','user_id'=>$data->user_id),
                            array('nombre'=>'Pies','user_id'=>$data->user_id)
            );

            foreach($bodies as $body){
                $this->body_model->insertBody($body);
            }

            $this->tipo_model->insertTipo($politica);
            $this->tipo_model->insertTipo($operacion);
            $this->tipo_model->insertTipo($evaluacion);
            $this->tipo_model->insertTipo($planificacion);
            $this->tipo_model->insertTipo($indicadores);


			redirect('administrator/');
		}
	}
	
	/**
	 * Method: updateUser
	 * Summary: edit the user data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateUser($user_id = 0)
	{
		$this->verify_session->verify_login('administrator/user/updateUser');
		
		//validation
		$this->form_validation->set_rules('firstname', lang('backend_firstname'), 'required');
		$this->form_validation->set_rules('lastname', lang('backend_lastname'), 'required');
		$this->form_validation->set_rules('email', lang('backend_email'), 'required|valid_email');
		$this->form_validation->set_rules('login', lang('backend_login'), 'required|callback_userCheckEdit');
		$this->form_validation->set_rules('password', lang('backend_password'), 'required');
		
		$this->form_validation->set_error_delimiters('<p class="warning">', '</p>');
		
		if ( $this->input->post('subm_form', TRUE) == NULL)
		{
			if ( !empty($user_id) AND is_numeric($user_id))
			{
				$admin = $this->user_model->getUserByUserId($user_id);
				if ( $admin === FALSE )
				{
					redirect('administrator/user/index');
				}
				else
				{
					foreach($admin as $key=>$value){
						$data[$key] = $value;
					}
				}
				$this->layout->view('administrator/user/updateUser', $data);
			}
			else
			{
				redirect('administrator/');
			}
		}
		else
		{
			if ( !$this->form_validation->run())
			{
				foreach($_POST as $key=>$value){
					$data[$key]  = $this->input->post($key, TRUE);
				}
				
				$this->layout->view('administrator/user/updateUser', $data);
			}
			else
			{
				$user_id = $this->input->post('user_id', TRUE);
				$values = array('firstname'=> $this->input->post('firstname', TRUE),
								'lastname'=> $this->input->post('lastname', TRUE),
								'email'=> $this->input->post('email', TRUE),
								'login'=> $this->input->post('login', TRUE),
								'password'=> $this->input->post('password', TRUE)
								);
								
				$this->user_model->updateUser($user_id, $values);
				
				redirect('administrator/');
			}
		}
	}
	
	/**
	 * Method: deleteUser
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteUser($user_id = 0)
	{
		$this->verify_session->verify_login('administrator/user/deleteUser');
		
		if ( $this->input->post('subm_form') == NULL)
		{
			if ( !empty($user_id) AND is_numeric($user_id) )
			{
				$admin = $this->user_model->getUserByUserId($user_id);
				if ( $admin === FALSE )
				{
					redirect('administrator/user/index');
				}
				else
				{
					foreach($admin as $key=>$value){
						$data[$key] = $value;
					}
				}
				$this->layout->view('administrator/user/deleteUser', $data);
			}
			else
			{
				redirect('administrator/user/index');
			}
		}
		else
		{
			if ( $this->input->post('subm_form') == 'batch' )
			{
				foreach ( $this->input->post('user_id', TRUE) as $user_id )
				{
					$this->user_model->deleteUser($user_id);
				}
			}
			else
			{
				$user_id = $this->input->post('user_id', TRUE);

                $seguimientos = $this->seguimiento_model->getAll($user_id);
                $cargos = $this->cargo_model->getAll($user_id);
                $areas = $this->area_model->getAll($user_id);
                $trabajadores = $this->trabajador_model->getAll($user_id);
                $objetivos = $this->objetivo_model->getAll($user_id);
                $inspecciones = $this->inspeccion_model->getAll($user_id);
                $accidentes = $this->accidente_model->getAll($user_id);
                $capacitaciones = $this->capacitacion_model->getAll($user_id);
                $epps = $this->epp_model->getAll($user_id);
                $tipos = $this->tipo_model->getAll($user_id);
                $archivos = $this->archivo_model->getAll($user_id);
                $bodys = $this->body_model->getAllBody($user_id);

                if($seguimientos){
                    foreach($seguimientos as $seguimiento){
                        $seguimiento_id = $seguimiento->seguimiento_id;
                        $controles = $this->control_model->getAll($seguimiento_id);
                        if($controles){
                            foreach($controles as $control){
                                $this->control_model->deleteControl($control->control_id);
                            }
                        }
                        $this->seguimiento_model->deleteSeguimiento($seguimiento_id);
                    }
                }

                if($trabajadores){
                    foreach($trabajadores as $trabajador){
                        $trabajador_id = $trabajador->trabajador_id;
                        $capacitaciones = $this->capacitacion_work_model->getAll($trabajador_id);
                        $epps = $this->epp_work_model->getAll($trabajador_id);
                        if($capacitaciones){
                            foreach($capacitaciones as $capacitacion_work){
                                $this->capacitacion_work_model->deleteCapacitacion_work($capacitacion_work->capacitacion_work_id);
                            }
                        }
                        if($epps){
                            foreach($epps as $epp_work){
                                $this->epp_work_model->deleteEpp_work($epp_work->epp_work_id);
                            }
                        }
                        $this->trabajador_model->deleteTrabajador($trabajador_id);
                    }
                }
                if($objetivos){
                    foreach($objetivos as $objetivo){
                        $objetivo_id = $objetivo->objetivo_id;
                        $especificos = $this->especifico_model->getEspecificoByObjetivoId($objetivo_id);
                        if($especificos){
                            foreach($especificos as $especifico){
                                $actividades = $this->actividad_model->getByEspecificoId($especifico->especifico_id);
                                if($actividades){
                                    foreach($actividades as $actividad){
                                        $planificaciones = $this->planificacion_model->getAll($actividad->actividad_id);
                                        if($planificaciones){
                                            foreach($planificaciones as $planificacion){
                                                $this->planificacion_model->deletePlanificacion($planificacion->planificacion_id);
                                            }
                                        }
                                        $this->actividad_model->deleteActividad($actividad->actividad_id);
                                    }
                                }
                                $this->especifico_model->deleteEspecifico($especifico->especifico_id);
                            }
                        }
                        $this->objetivo_model->deleteObjetivo($objetivo_id);
                    }
                }
                if($inspecciones){
                    foreach($inspecciones as $inspeccion){
                        $inspeccion_id = $inspeccion->inspeccion_id;
                        $c_inspecciones = $this->c_inspeccion_model->getAll($inspeccion_id);
                        if($c_inspecciones){
                            foreach($c_inspecciones as $c_inspeccion){
                                $this->c_inspeccion_model->deleteC_inspeccion($c_inspeccion->c_inspeccion_id);
                            }
                        }

                        $this->inspeccion_model->deleteInspeccion($inspeccion_id);
                    }
                }
                if($accidentes){
                    foreach($accidentes as $accidente){
                        $accidente_id = $accidente->accidente_id;
                        $medidas_correctivas = $this->medida_correctiva_model->getAll($accidente_id);
                        $accidentes_trabajadores = $this->accidente_trabajador_model->getAll($accidente_id);

                        if($medidas_correctivas){
                            foreach($medidas_correctivas as $medida_correctiva){
                                $this->medida_correctiva_model->deleteMedida_correctiva($medida_correctiva->medida_correctiva_id);
                            }
                        }
                        if($accidentes_trabajadores){
                            foreach($accidentes_trabajadores as $accidente_trabajador){
                                $this->accidente_trabajador_model->deleteAccidente_trabajador($accidente_trabajador->accidente_trabajador_id);
                            }
                        }
                        $this->accidente_model->deleteAccidente($accidente_id);
                    }
                }
                if($capacitaciones){
                    foreach($capacitaciones as $capacitacion){
                        $this->capacitacion_model->deleteCapacitacion($capacitacion->capacitacion_id);
                    }
                }
                if($epps){
                    foreach($epps as $epp){
                        $this->epp_model->deleteEpp($epp->epp_id);
                    }
                }
                if($bodys){
                    foreach($bodys as $body){
                        $this->body_model->deleteBody($body->body_id);
                    }
                }
                if($cargos){
                    foreach($cargos as $cargo){
                        $this->cargo_model->deleteCargo($cargo->cargo_id);
                    }
                }
                if($areas){
                    foreach($areas as $area){
                        $this->area_model->deleteArea($area->area_id);
                    }
                }
                if($archivos){
                    foreach($archivos as $archivo){
                        $path = "./resources/media/archivo/doc/";

                        $name_user = $this->user_model->getUserByUserId($user_id);
                        $data = $this->archivo_model->getArchivoByArchivoId($archivo->archivo_id);
                        $tipoId = $this->tipo_model->getTipoByTipoId($data['tipo_id']);
                        $path = $path.$name_user->login.'/'.$tipoId->nombre.'/';
                        $archivo_id = $archivo->archivo_id;

                        $data = $this->archivo_model->getArchivoByArchivoId($archivo_id);
                        $this->archivo_model->deleteArchivo($archivo_id);

                        //remove files
                        @unlink($path . $data["picture"]);
                    }


                }

                if($tipos){
                    foreach($tipos as $tipo){
                        $name_user = $this->user_model->getUserByUserId($user_id);
                        $path = "./resources/media/archivo/doc/";
                        $path = $path.$name_user->login.'/'.$tipo->nombre.'/';
                        if(is_dir($path))
                            rmdir($path);
                    }
                    $name_user = $this->user_model->getUserByUserId($user_id);
                    $path = "./resources/media/archivo/doc/";
                    $path = $path.$name_user->login;
                    rmdir($path);
                    foreach($tipos as $tipo){
                        $this->tipo_model->deleteTipo($tipo->tipo_id);
                    }
                }
				$this->user_model->deleteUser($user_id);
			}
			redirect('administrator/home/index');
		}
	}
}
/* End of file user.php */
/* Location: ./system/application/controllers/administrator/user.php */