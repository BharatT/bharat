<?php
class Breakeven extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		
	}

	function index() {
//		$this->load->library('session');
if(($this->session->userdata('username')==''))redirect('login');
		
//		echo $this->session->userdata('username');
		//redirect('blog/index');
		$this->load->database();
		// load pagination class
		$this->load->library('pagination');
		$config['base_url'] = base_url().'index.php/breakeven/index';
		$config['total_rows'] = $this->db->count_all('break_even_data');
		$config['per_page'] = '10';
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';

		$this->pagination->initialize($config);

		//load the model and get results
		$this->load->model('breakeven_model');
	if(($this->session->userdata('username')=='administrator')){
		$data['addURL']="";
		$data['results'] = $this->breakeven_model->get_books($config['per_page'],$this->uri->segment(3));}
	else 
	{
		if($this->uri->segment(3)=='')
		{
			$data['addURL']="calculation";
		}
		else 
		{
			$data['addURL']="../../calculation";			
		}
		
		
		$companyId=$this->session->userdata('companyName');
		$data['results'] = $this->breakeven_model->get_filter_breakeven($companyId,$config['per_page'],$this->uri->segment(3));
	}
//echo $this->uri->segment(3);
if($this->uri->segment(3)=='')
{
	$data['logoutUrl']="login/logout";
}
else 
{
	$data['logoutUrl']="../../login/logout";
	
}
		// load the HTML Table Class
		$this->load->library('table');

		$tmpl = array ( 'table_open'  => '<table bgcolor="#F1F1F1" border="10" cellpadding="5" cellspacing="3" frame="hsides" width="50%" style="width: 70%; right: 80% width=475px height: auto; width: auto; border-bottom-style: none; border-bottom-width: thick; border-top-style: none; border-left-style: none; border-right-width: thick; border-right-style: none; border-left-width: thick; border-top-width: thick; border-left-color: #400040; border-top-color: #400040; border-right-color: #400040; border-bottom-color: #400040; background-attachment: fixed; background-color: #ebf3fd; background-position: center center" class="tableStyle">' );

		$this->table->set_template($tmpl);

		foreach($data['results']->result_array()as $row)
		{
			//				echo $row['be_seq'];
			//$row['be_seq']=redirect('welcome/test');
			$this->table->add_row(anchor('calculation/input/'.$row['be_seq'],$row['be_seq'], 'Link ' .$row['be_seq']), $row['be_total_sale'], $row['be_cost_sale'], $row['be_fix_cost'],
			$row['be_avg_sale'],$row['be_conv_rate'],date('d-m-Y', strtotime($row['be_date'])),$row['be_create_by'],$row['be_time_period'],$row['be_company']); //Add each result row into table, 
					
		}

		$this->table->set_heading('RecordID',	'Total Sale',	'Cost of Sale',	'Fix Cost',	'Average Sale',	'Conversion Rate',	'Date',	'Create By','Time Period','Company');
		//	$this->table->set_heading('ID', 'Title', 'Author', 'Description');

		//To remove existing data
		$data['results']="";
		//redirect('welcome/test');
		// load the view
		$this->load->view('breakeven_view', $data);
		
	}

	
}
?>