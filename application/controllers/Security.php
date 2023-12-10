<?php   
defined('BASEPATH') OR exit('No direct script access allowed');

 // require __DIR__ .'/autoload.php';
// require("./vendor/dompdf/dompdf/autoload.inc.php");
// use Dompdf\Dompdf;
// use Dompdf\Options; 

class Security extends CI_Controller
{
	 public function __construct(){
		parent::__construct(); 
    	// $this->load->library('email');
    	// date_default_timezone_set('Asia/Manila');
    	// if($this->session->userdata('user_type') != 1 && $this->session->userdata('user_type') != 2){
        //     redirect('login/logout');
        // }
	}

	public function index(){

		$data = $this->datainfo($title='BNIAS | Login');

		$this->load->view('admin/template/head', $data);
		$this->load->view('security/pages-login', $data);
		$this->load->view('admin/template/security-footer');
	}

	public function register(){

		$data = $this->datainfo($title='BNIAS | Register');

		$this->load->view('admin/template/head', $data);
		$this->load->view('security/pages-register', $data);
		$this->load->view('admin/template/security-footer');
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$results = $this->Admin_model->check_credentials($username, md5($password));

		if (count($results) === 0) {

			$error = $this->response('err', 'errmsg', TRUE, 'Login Failed! Invalid information');
			redirect('Security');
			
		} else {

			$success = $this->response('scs', 'scsmsg', TRUE, 'Successfully Login!');
			$username = $results[0]->username;
			$name = $results[0]->name;
			$userId = $results[0]->userId;
			$lastUpdate = $results[0]->update_date;

			$sessionArray = array(
			 	'user_name' => $username,
				'user_id' => $userId,
				'name' => $name,
				'islogged' => true,
				'lastUpdate' =>$lastUpdate
			);

			$this->session->set_userdata($sessionArray);
			redirect('Security');
			// echo 'successfully login '.json_encode($sessionArray);
				
	    }
		
	}

	public function signup(){

		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$name = $this->input->post('name');
		$email = $this->input->post('email');

		$isExist = $this->Admin_model->isExist($username);

		if (count($isExist) > 0) {

			$error = $this->response('err', 'errmsg', TRUE, 'Username is exist!');
			redirect('Security/register');
			
		} else { 
			$data = array(
				'username' => $username,
				'pass' => $password,
				'name' => $name,
				'email' => $email,
			);

			$result = $this->Admin_model->create('tbluser', $data);
			if($result){
				$success = $this->response('scs', 'scsmsg', TRUE, 'Succesfully Registered!');
				redirect('Security/register');
			}else {
				$error = $this->response('err', 'errmsg', TRUE, 'Registration Failed! Please try again!');
				redirect('Security/register');
			}
			
		}
		
	}

	public function logout(){
		$session_array = array('islogged','user_name','user_id','name', 'lastUpdate');
		$this->session->unset_userdata($session_array);
		redirect('Security');
	}

	public function response($mode='', $msg ='', $val=FALSE, $res=''){
		return [$mode => $this->session->set_flashdata($mode, $val), $msg => $this->session->set_flashdata($msg, $res)];
	}

	public function datainfo($title=''){
		return [
			"title" => $title,
			"error" => [
				"err" => $this->session->flashdata('err'),
				"errmsg" => $this->session->flashdata('errmsg')
			],
			"success" => [
				"scs" => $this->session->flashdata('scs'),
				"scsmsg" => $this->session->flashdata('scsmsg')
			]
		];
	}

}

?>