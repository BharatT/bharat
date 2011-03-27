<?php
class books_model extends CI_Model {
  function __construct(){
    parent::__construct();
  }

  function get_books($num, $offset) {
  	$this->db->select('id,title');
  	
    $query = $this->db->get('christian_books', $num, $offset);	
    return $query;
  }
}
?>