<?php   
defined('BASEPATH') OR exit('No direct script access allowed');

// require("./vendor/dompdf/dompdf/autoload.inc.php");
// use Dompdf\Dompdf;
// use Dompdf\Options; 
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\Files\File;

class Admin extends CI_Controller
{
	 public function __construct(){
		parent::__construct(); 
		date_default_timezone_set('Asia/Manila');
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

		$data = $this->datainfo($title='NIAS | Dashboard');

		$table = 'tblrecord';
		$data['totalMale'] = $this->Admin_model->total($table, 'sex=2');
		$data['totalFemale'] = $this->Admin_model->total($table, 'sex=1');
		$data['total'] = $this->Admin_model->total($table, '');

		$this->load->view('admin/template/head', $data);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/side', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/template/footer');
	}

	public function records(){

		$data = $this->datainfo($title='BNIAS | Records');

		$data['resdata'] = $this->load_records('tblrecord', '', 'id_record');

		$this->load->view('admin/template/head', $data);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/side', $data);
		$this->load->view('admin/data/records', $data);
		$this->load->view('admin/template/footer');
	}

	public function logs(){

		$data = $this->datainfo($title='BNIAS | Data Logs');
		$data['logs'] = $this->load_records('tbl_logs', '', 'id');

		$this->load->view('admin/template/head', $data);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/side', $data);
		$this->load->view('admin/logs', $data);
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
		$data['resdata'] = $this->load_records('tblrecord', $whereId, 'id_record');

		$this->load->view('admin/template/head', $data);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/side', $data);
		$this->load->view('admin/data/edit-record', $data);
		$this->load->view('admin/template/footer');
	}

	public function viewrecord(){

		$data = $this->datainfo($title='BNIAS | View Record');
        
        $whereId = 'id_record='.$this->uri->segment(3);
		$data['resdata'] = $this->load_records('tblrecord', $whereId, 'id_record');

		$this->load->view('admin/template/head', $data);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/side', $data);
		$this->load->view('admin/data/view-record', $data);
		$this->load->view('admin/template/footer');
	}

	public function checklist(){

		if($_SESSION['role'] == 'admin'){
			$data = $this->datainfo($title='BNIAS | Admin Checklist');
			$whererole = array('role' => 'user');
			$data['users'] = $this->load_records('tbluser', $whererole, 'userId');
			$data['files'] = $this->load_records('tbl_docs', '', 'id');

			$this->load->view('admin/template/head', $data);
			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/template/side', $data);
			$this->load->view('admin/checklist', $data);
			$this->load->view('admin/template/footer');
		}else{

			$data = $this->datainfo($title='BNIAS | User Checklist');
			$whereUser = array('username' => $_SESSION['user_name']);
			$data['files'] = $this->load_records('tbl_docs', $whereUser, 'id');

			$this->load->view('admin/template/head', $data);
			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/template/side', $data);
			$this->load->view('user/userchecklist', $data);
			$this->load->view('admin/template/footer');
		}
		
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

				if($inputB != NULL && $inputC != NULL && $inputD != NULL){

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
						$this->Admin_model->setlogs($_SESSION['user_id'],$_SESSION['user_name'],$_SESSION['role'],'Added Record');
						redirect('Admin/addrecord');
					}else {
						$error = $this->response('err', 'errmsg', TRUE, 'Failed to add record! Please try again!');
						redirect('Admin/addrecord');
					}
				}else{
					$error = $this->response('err', 'errmsg', TRUE, 'Failed to add record. Because weigth or height status is empty.');
					redirect('Admin/addrecord');
				}
				break;
			case 'update':

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

				$idRecord = $this->input->post('idRecord');
				$where = "id_record = '".$idRecord."'";

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
					'responsible_user' => $this->session->user_name,
					'updated_at' => date('Y-m-d H:i:s')
				);

				$result = $this->Admin_model->update($where, 'tblrecord', $data);
				 if($result){
					$success = $this->response('scs', 'scsmsg', TRUE, 'Successfully updated record!');
					$this->Admin_model->setlogs(
						 $_SESSION['user_id'],
						 $_SESSION['user_name'],
						 $_SESSION['role'],
						 'Update Record - (ID:'.$idRecord.')');
					redirect('Admin/viewrecord/'.$idRecord);
			     }else {
			     	$success = $this->response('err', 'errmsg', TRUE, 'No changes on record!');
					redirect('Admin/viewrecord/'.$idRecord);
			     }

				break;
			default:
				// code...
				break;
		}

	}

	public function load_records($table='', $where='', $orderby=''){

		$result = $this->Admin_model->load_record($table,$where,$orderby);
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
				$data = array(
					'name' => $this->input->post('fullName'),
					'update_date' => date('Y-m-d H:i:s')
				);
				$result = $this->Admin_model->update($where, 'tbluser', $data);
				 if($result){
					$success = $this->response('scs', 'scsmsg', TRUE, 'Successfully updated record!');
					$this->Admin_model->setlogs(
						 $_SESSION['user_id'],
						 $_SESSION['user_name'],
						 $_SESSION['role'],
						 'Update Profile - (ID:'.$userId.')');

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

	public function heightStatus($sex, $age){

		$result = $this->Admin_model->heightStatus($sex, $age);
		$msg = array('success' => false, 'data' => $result);
		if($result){
			$msg = array('success' => true, 'data' => $result);
		}
		echo json_encode($msg);

	}

	public function weightStatus($sex, $age){

		$result = $this->Admin_model->weightStatus($sex, $age);
		$msg = array('success' => false, 'data' => $result);
		if($result){
			$msg = array('success' => true, 'data' => $result);
		}
		echo json_encode($msg);

	}

	public function weightlength($age, $height){

		$height = round($height / 0.5) * 0.5;
		$result = $this->Admin_model->weightlength($age, $height);
		$msg = array('success' => false, 'data' => $result);
		if($result){
			$msg = array('success' => true, 'data' => $result);
		}
		echo json_encode($msg);

	}

	public function userchecklist(){

		$date = date('Y-m-d');
		$date = str_replace( '-', '', $date);
		$path = './docs/'.$_SESSION['user_name'].'/docs/'.$date;
		$config['upload_path'] = $path;
		
		if (!is_dir($path)) {
		    mkdir($path, 0777, TRUE);
		}
		$new_name = $_SESSION['user_name'].'-'.$date.'-'.$_FILES["userfile"]['name'];
		$config['file_name'] = $new_name;
        $config['allowed_types'] = 'xlsx|csv';
        $config['max_size'] = 1000;

        $this->load->library('upload', $config);
        $this->upload->overwrite = true;

        $this->load->helper('directory');
    	$map = directory_map($path);
    	$data = $this->upload->data();
    	$isFileExist = FALSE;

    	foreach ($map as $key => $value) {
    		if(strtolower($value) == strtolower($data["file_name"])){
    			$isFileExist = TRUE;
    		}
    	}

        if (! $this->upload->do_upload("userfile")) {
            $error = array('error' => $this->upload->display_errors());
            $error = $this->response('err', 'errmsg', TRUE, $error["error"]);
			redirect('Admin/checklist');
        } else {
        	
        	if (!$isFileExist) {
	            
	            $newpath = $path.'/'.$new_name;
			   	$datafile = array(
			   		'userId' => $_SESSION['user_id'],
			   		'username'  => $_SESSION['user_name'],
			   		'role'  => $_SESSION['role'],
			   		'filename' => $new_name,
			   		'file_path' => $newpath,
			   		'status' => 'Pending'
			   	);
		    	$result = $this->Admin_model->create('tbl_docs', $datafile);
		    	if($result){
	            	$success = $this->response('scs', 'scsmsg', TRUE, 'Successfully upload.');
	            	redirect('Admin/checklist');
		    	}
		    	
	    	}else{
	    		$where = array('filename' => $new_name);
	    		$data = array('update_date' => date('Y-m-d H:i:s'));
	    		$result = $this->Admin_model->update($where, 'tbl_docs', $data);
		    	if($result){
		    		$error = $this->response('err', 'errmsg', TRUE, 'Filename exists. It will overwrite.');
		    	}
			    //$error = $this->response('err', 'errmsg', TRUE, 'Filename exists. It will overwrite.');
			    redirect('Admin/checklist');
	    	}
	    	

        }

        // in CI-4
		// $this->validate([
        //     'document' => [
        //         'uploaded[document]',
        //         'max_size[document,100]',
        //         'mime_in[document,image/png,image/jpg,image/gif]',
        //         'ext_in[document,png,jpg,gif]',
        //         'max_dims[document,1024,768]',
        //     ],
        // ]);

        // $file = $this->request->getFile('document');

        // if (! $path = $file->store()) {
        //     return view('upload_form', ['error' => 'upload failed']);
        // }
        // $data = ['upload_file_path' => $path];

        // return view('upload_success', $data);
	}

}

?>