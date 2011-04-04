<?php
class calculation_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	
	function get($id,$companyName,$user){
		
		
		$this->load->database();

		if($user=='administrator'){
			$query = $this->db->get_where('break_even_data',array('be_seq'=>$id));			
		}
		else{
			$query = $this->db->get_where('break_even_data',array('be_seq'=>$id,'be_company'=>$companyName));
		}
		return $query->row_array();

	}

	
}
?>