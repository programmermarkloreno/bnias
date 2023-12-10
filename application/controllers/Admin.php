<?php   
defined('BASEPATH') OR exit('No direct script access allowed');

 // require __DIR__ .'/autoload.php';
// require("./vendor/dompdf/dompdf/autoload.inc.php");
// use Dompdf\Dompdf;
// use Dompdf\Options; 

class Admin extends CI_Controller
{
	 public function __construct(){
		parent::__construct(); 
    	// $this->load->library('email');
    	// date_default_timezone_set('Asia/Manila');
    	// if($this->session->userdata('user_type') != 1 && $this->session->userdata('user_type') != 2){
        //     redirect('login/logout');
        // }
        if(!$this->session->islogged){
    		redirect('Security');
    	}
	}

	public function index(){

		$data['title'] = "BNIAS | Dashboard";

		$this->load->view('admin/template/head', $data);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/side', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/template/footer');
	}

	public function records(){

		$data = $this->datainfo($title='BNIAS | Records');

		$data['resdata'] = $this->load_records('tblrecord', '');

		$this->load->view('admin/template/head', $data);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/side', $data);
		$this->load->view('admin/data/records', $data);
		$this->load->view('admin/template/footer');
	}

	public function addrecord(){

		$data = $this->datainfo($title='BNIAS | Add Record');

		$this->load->view('admin/template/head', $data);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/side', $data);
		$this->load->view('admin/data/add-record', $data);
		$this->load->view('admin/template/footer');
	}

	public function editrecord(){

		$data = $this->datainfo($title='BNIAS | Edit Record');
        
        $whereId = 'id_record='.$this->uri->segment(3);
		$data['resdata'] = $this->load_records('tblrecord', $whereId);

		$this->load->view('admin/template/head', $data);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/side', $data);
		$this->load->view('admin/data/edit-record', $data);
		$this->load->view('admin/template/footer');
	}

	public function record($mode=""){

		$mode = $this->uri->segment(3);
		switch ($mode) {
			case 'submit':
				$inputChildName = $this->input->post('inputChildName');
				$inputGuardianName = $this->input->post('inputGuardianName');
				$inputAddress = $this->input->post('inputAddress');
				$inputSex = $this->input->post('inputSex');
				$inputDate = $this->input->post('inputDate');
				$inputWeight = $this->input->post('inputWeight');
				$inputHeight = $this->input->post('inputHeight');
				$inputAge = $this->input->post('inputAge');

				$inputA = $this->input->post('inputA');
				$inputB = $this->input->post('inputB');
				$inputC = $this->input->post('inputC');
				$inputD = $this->input->post('inputD');

				$data = array(
					'child_name' => $inputChildName,
					'guardian_name' => $inputGuardianName,
					'address' => $inputAddress,
					'sex' => $inputSex,
					'birthdate' => $inputDate,
					'weight' => $inputWeight,
					'height' => $inputHeight,
					'age' => $inputAge,
					'age_in_months' => $inputA,
					'weight_for_age_stat' => $inputB,
					'height_for_age_stat' => $inputC,
					'weight_for_ltht_stat' => $inputD,
					'responsible_user' => $this->session->user_name
				);

				$result = $this->Admin_model->insert_record('tblrecord', $data);
				if($result){
					$success = $this->response('scs', 'scsmsg', TRUE, 'Successfully added record!');
					redirect('Admin/addrecord');
				}else {
					$error = $this->response('err', 'errmsg', TRUE, 'Failed to add record! Please try again!');
					redirect('Admin/addrecord');
				}
				
				break;
			
			default:
				// code...
				break;
		}

	}

	public function load_records($table='', $where=''){

		$result = $this->Admin_model->load_record($table,$where);
		if($result){
			return $result; 
		}else
		{
			$error = $this->response('err', 'errmsg', TRUE, 'No Record Found! Please try again!');
		}
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
			],
			'resdata' => array()
		];
	}

	public function users_profile(){

		$mode = $this->uri->segment(3);
		switch ($mode) {
			case 'edit':
			    $userId = $this->session->user_id;
				$where = "userId = '".$userId."'";
				$data = array('name' => $this->input->post('fullName'));
				$result = $this->Admin_model->update($where, 'tbluser', $data);
				 if($result){
					$success = $this->response('scs', 'scsmsg', TRUE, 'Successfully updated record!');

					$session_array = array('islogged','user_name','user_id','name', 'lastUpdate');
		            $this->session->unset_userdata($session_array);
		            $this->set_user($userId);

					redirect('Admin/users_profile');
			     }else {
			     	$error = $this->response('err', 'errmsg', TRUE, 'Failed to update record! Please try again!');
					redirect('Admin/users_profile');
			     }
				
				break;
			
			default:
				$data = $this->datainfo($title='BNIAS | User Profile');

				$this->load->view('admin/template/head', $data);
				$this->load->view('admin/template/header', $data);
				$this->load->view('admin/template/side', $data);
				$this->load->view('admin/users-profile', $data);
				$this->load->view('admin/template/footer');
				break;
		}
	}

	public function set_user($userId = ""){

		$adminCurrentInfo = $this->Admin_model->get('tbluser', array('userId'=> $userId), array(), '');
		$username = $adminCurrentInfo[0]->username;
		$name = $adminCurrentInfo[0]->name;
		$userId = $adminCurrentInfo[0]->userId;
		$lastUpdate = $adminCurrentInfo[0]->update_date;

		$sessionArray = array(
		 	'user_name' => $username,
			'user_id' => $userId,
			'name' => $name,
			'islogged' => true,
			'lastUpdate' =>$lastUpdate
		);

		$this->session->set_userdata($sessionArray);
	}

}

?>