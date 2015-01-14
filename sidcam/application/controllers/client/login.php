<?php
/**
 * Classname: Login
 * Summary: Controller for Login objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Login extends CI_Controller
{

	/**
	 * Method: __construct
	 * Summary: Method construct
	 * @access public
	 */
	function __construct() 
	{
		parent::__construct();
		
		$params = array('layout' => 'layouts/layout_login');
		$this->load->helper('cookie');
		$this->load->library('layout', $params);
        $this->load->model('user_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index() 
	{
		if ( !$this->uri->segment(5)) 
		{
			$action = 'client/home/index';
			if (get_cookie('cookie_remember', TRUE) AND get_cookie('cookie_remember', TRUE) == 1) 
			{
				$this->session->set_userdata('login', get_cookie('cookie_login', TRUE));
			}
		} 
		else
		{
			$action = $this->uri->segment(5) . '/' . $this->uri->segment(6);
		}
		$data['action'] = $action;
		$this->layout->view('administrator/login/index', $data);
	}

	/**
	 * Method: verify
	 * Summary: Verify login 
	 * @access public
	 */
	function verify() 
	{
		/*Filter post data with xss function*/
		$result = $this->authentication->login($this->input->post('login', TRUE), $this->input->post('password', TRUE));

		if ($result)
		{
            $log = $this->input->post('login', TRUE);
            $pass = $this->input->post('password', TRUE);
            $user_type = $this->user_model->getUserTypeByLogPass($log, $pass );
			//Verify if user checked option remember
			if ($this->input->post('remember') == 1)
			{
				
				$cookie_remember = array(
                   'name'   => 'cookie_remember',
                   'value'  => $this->input->post('remember', TRUE),
                   'expire' => time()+14*24*60*60,
                   'domain' => '',
                   'path'   => '/',
                   'prefix' => '',
               );
			   set_cookie($cookie_remember);
			   
			   $cookie_login  = array(
                   'name'   => 'cookie_login',
                   'value'  => $this->input->post('login', TRUE),
                   'expire' => time()+14*24*60*60,
                   'domain' => '',
                   'path'   => '/',
                   'prefix' => '',
               );
			   set_cookie($cookie_login);  
			} 
			
			$loggin_date = getdate();
			
			//Insert the logged user
			$log = array('login' => $this->input->post('login', TRUE), 
						 'log_date_time' => $loggin_date['year'] . '-' . $loggin_date['mon'] . '-' . $loggin_date['mday'] . ' ' . $loggin_date['hours'] . ':' . $loggin_date['minutes'] . ':' . $loggin_date['seconds'] );
						 
			$this->user_model->insertLogged($log);
			if($user_type == 1){
                redirect('administrator/home/index');
            }
            else{
                redirect('client/home');
            }

			
		} else {
			$data['action'] = 'administrator/home/index';
			$data['error'] = 'Login or password incorrect, please try again';
			
			$this->layout->view('administrator/login/index', $data);
		}
	}

	/**
	 * Method: forgotPassword
	 * Summary: Remember the password 
	 * @access public
	 */
	function forgotPassword() 
	{
		//The form has been send it
		$rulesT['login'] = 'required';
		$this->validation->set_rules($rulesT); 
		$fieldsT['login'] = lang('backend_login');
		$this->validation->set_fields($fieldsT);
		
		$this->validation->set_error_delimiters('<p class="warning">', '</p>');
			
		if ($this->input->post('submit_form', TRUE) != NULL)
		{
			
			if ( !$this->validation->run())
			{
				$data['login'] = $this->input->post('login', TRUE);
				$this->layout->view('administrator/login/forgot');
				
			} 
			else 
			{
				//Send the email
				$email_row = $this->user_model->getUserByLogin($this->input->post('login', TRUE));
				if ($email_row != FALSE) 
				{
					
					$this->load->library('email');
					$this->email->from('admin@hosting.com', 'Webmaster');
					$this->email->to($email_row->email);
					$this->email->subject('Password request');
					$this->email->message('You have submitted a password request <br /> here\'s the data: <strong>' . $email_row->email . '</strong>');
					$this->email->send();
					
					$this->layout->view('administrator/login/confirmation');
				} 
				else 
				{
					$data['no_user'] = 1;
					$this->layout->view('administrator/login/forgot', $data);
				}
			}
		} 
		else 
		{
			//First time that loads the page
			$this->layout->view('administrator/login/forgot');
		}
		
	}

	/**
	 * Method: logout
	 * Summary:
	 * @access public
	 */
	function logout() 
	{
		$this->authentication->logout();
		
		delete_cookie('cookie_remember');
		delete_cookie('cookie_login');
		
		redirect('administrator/login/index');
	}
}

/* End of file login.php */
/* Location: ./system/application/controllers/administrator/login.php */