<?php
class calculation_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	
	function get($id){

		$this->load->database();

		$query = $this->db->get_where('break_even_data',array('be_seq'=>$id));

		return $query->row_array();

	}

	
}
?>