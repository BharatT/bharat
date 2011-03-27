<?php
class Expense extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		
	}

	function index() {
		
		$this->load->library('session');
		$user=$this->session->userdata('username');
		echo $user;
		if($user=='')redirect('login');
		// load the view
		$data="";
		echo 'test';
		//		$this->load->view('expense_view', $data);
	}

	function calcExpense()
	{
		
		$this->load->library('session');
		$user=$this->session->userdata('username');
		echo $user;
		if($user=='')redirect('login');
				//		echo 'test';
//		echo $_REQUEST['TotalSale'];
//		echo $_REQUEST['CostofSale'];
//		echo $_REQUEST['AverageSale'];
//		echo $_REQUEST['ConversionRate'];
//		echo $_REQUEST['timePeriod'];
		
		$data="";
		$this->load->view('expense_view', $data);
		
		
		
	}
}
?>