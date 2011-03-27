<?php
class breakeven_model extends CI_Model {
  function __construct(){
    parent::__construct();
  }
//
  function get_books($num, $offset) {
  	$this->db->select('be_seq, be_total_sale, be_cost_sale, be_fix_cost, be_avg_sale, be_conv_rate,be_date,be_create_by, be_time_period,be_company');
  	
    $query = $this->db->get('break_even_data', $num, $offset);	
    return $query;
  }
}
?>