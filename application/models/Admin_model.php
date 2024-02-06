<?php  
class Admin_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function check_credentials($username = '', $password = '')
	{
		$query = $this->db->get_where('tbluser', array('username' => $username, 'pass' => $password));
		return $query->result();
	}

	public function isExist($username = '')
	{
		$query = $this->db->get_where('tbluser', array('username' => $username));
		return $query->result();
	}

	public function get($tableName, $whereArray = array(), $limit = array(), $order="")
	{
		if (! empty($limit)) {
			$this->db->limit($limit[0], $limit[1]);
		}

		if(!empty($order))
			$this->db->order_by($order, 'DESC');

		if (empty($whereArray)) {
			$query = $this->db->get($tableName);
		} else {
			$query = $this->db->get_where($tableName, $whereArray);
		}
		
		return $query->result();
	}

	function create($table,$tabledata){

        if(count($tabledata) > 0){
        	$this->db->insert($table, $tabledata);
			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}
        }else{
        	return false;
        }
	}

	function insert_record($table,$tabledata){

        if(count($tabledata) > 0){
        	$this->db->insert($table, $tabledata);
			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}
        }else{
        	return false;
        }
	}

	function load_record($table='', $where='', $orderby=''){

		if(!empty($where)){
			$this->db->where($where);
		}
		$this->db->order_by($orderby, 'DESC');
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	function update($where, $tbl, $data){

		$this->db->where($where);
	 	$this->db->update($tbl, $data);
	 	if($this->db->affected_rows() > 0){
	 		return true;
	 	}else{
	 		return false;
	 	}
	}

	function total($tbl, $where){

		if(!empty($where)){
			$this->db->where($where);
		}
		$query = $this->db->get($tbl);
		if($query->num_rows() > 0){
			return count($query->result());
		}else{
			return 0;
		}
	}

	function heightStatus($sex,$age){

		$this->db->where('age', $age);
		if($sex == 1){
			$query = $this->db->get('tbl_girls_height');
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}else {
			$query = $this->db->get('tbl_boys_height');
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
	}

	function weightStatus($sex,$age){

		$this->db->where('age', $age);
		if($sex == 1){
			$query = $this->db->get('tbl_girls_weight');
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}else {
			$query = $this->db->get('tbl_boys_weight');
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
	}

	function weightlength($age,$length){

		$this->db->where('length', $length);
		if($age <= 23){
			$query = $this->db->get('tbl_weight_for_length');
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}else {
			$query = $this->db->get('tbl_weight_for_length_2');
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
	}

	public function setlogs($userId,$user,$role,$process){

		$res = FALSE;
		$data = array(
				'user_id' => $userId,
				'username' => $user,
				'role' => $role,
				'process' => $process
			);
		$result = $this->create('tbl_logs', $data);
		if($result){
			$res = TRUE;
		}
		return $res;
	}
}

?>