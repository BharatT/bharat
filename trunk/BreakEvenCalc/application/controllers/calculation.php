<?php
class Calculation extends CI_Controller{

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');

	}
	
	function index()
	{
				
		$this->load->library('session');
		$user=$this->session->userdata('username');
//		echo $user;
		if($user=='')redirect('login');
		if($user=='administrator')return;
		$totalSale= 0;
			$costSale=0;
			$fixCost=0;
			$avarageSale=0;
			$converisonRate=0;
			$timePeriod = 0;
			$jobName="";
			$data['companyName']=$this->session->userdata('companyName');						
			$data['totalSale']=$totalSale;
			$data['costSale']=$costSale;
			$data['fixCost']=$fixCost;
			$data['avarageSale']=$avarageSale;
			$data['converisonRate']=$converisonRate;
			$data['jobName']=$jobName;
			$data['logoutUrl']='login/logout';
			$data['userName']=$user;
			$data['companyName']=$this->session->userdata('companyName');			
			
		$_REQUEST['FixedCost']=0;
		$_REQUEST['breakeven']="10";

		$_REQUEST['requestFrom']="test";
		$_REQUEST['formsubmit']="true";
		
		$_REQUEST['TotalSale']=0;
		$_REQUEST['CostofSale']=0;
		$_REQUEST['AverageSale']=0;
		$_REQUEST['ConversionRate']=0;
		$_REQUEST['jobName']="";
		$_REQUEST['timePeriod']=0;
		
		$data['viewOnly']=false;
		if($user=='administrator')
			$data['viewOnly']=false;
		$data['expenseUrl']="expense/calcExpense";
		$data['cancelUrl'] = "breakeven";
						
			
		$_REQUEST['urlValue']="calculation/formSubmit";
		$_REQUEST['logoutUrl']="index.php/login/logout";
		$_REQUEST['expenseUrl']="index.php/expense/calcExpense";
		$this->load->view('CalculationForm',$data);
		
	}

	function input($id = 0){
		
		$this->load->library('session');
		$user=$this->session->userdata('username');
		$loggedIn=$this->session->userdata('logged_in');
		$companyName=$this->session->userdata('companyName');
//		echo $user;
		if($loggedIn!=TRUE)redirect('login/logout');
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->model('calculation_model');
	//$config['base_url'] = base_url().'index.php/calculation/input/';
		//if($this->input->post('mysubmit')){
		///	$this->books_model->entry_insert();
		//}
		//	$data = $this->books_model->general();
		
		if((int)$id > 0){
						
			$query = $this->calculation_model->get($id,$companyName,$user);
			if(count($query)==0)return;
			if($query['be_seq']=='')
			{				
				$_REQUEST['errorMessage']="Invalid Record";
				redirect('error');
			}
			$data['fid']['value'] = $query['be_seq'];
			
			$totalSale= $query['be_total_sale'];
			$costSale=$query['be_cost_sale'];
			$fixCost=$query['be_fix_cost'];
			$avarageSale=$query['be_avg_sale'];
			$converisonRate=$query['be_conv_rate'];
			$timePeriod = $query['be_time_period'];
			$jobName = $query['be_job_name'];
			$data['userName']=$query['be_create_by'];
			$data['companyName']=$query['be_company'];
			$data['totalSale']=$totalSale;
			$data['costSale']=$costSale;
			$data['fixCost']=$fixCost;
			$data['avarageSale']=$avarageSale;
			$data['converisonRate']=$converisonRate;
			$data['viewOnly']=true;
			$data['jobName']=$jobName;//   add  alpesh
			$_REQUEST['FixedCost']=$fixCost;
			$_REQUEST['breakeven']="10";

		$_REQUEST['requestFrom']="test";
		$_REQUEST['formsubmit']="true";
		
		$_REQUEST['TotalSale']=$totalSale;
		$_REQUEST['CostofSale']=$costSale;
		$_REQUEST['AverageSale']=$avarageSale;
		$_REQUEST['ConversionRate']=$converisonRate;
		$_REQUEST['timePeriod']=$timePeriod;
		$_REQUEST['jobName']=$jobName;  // add alpesh
		//$_REQUEST['logoutUrl']="/login/logout";
		$data['logoutUrl']='../../login/logout';
		$data['expenseUrl']='expense/calcExpense';

		$_REQUEST['urlValue']="../../calculation/formSubmit";
		$data['expenseUrl']="expense/calcExpense";
		$data['cancelUrl'] = "../../breakeven";
		
		$this->load->view('CalculationForm',$data);
		
		}
		
	}
	
	function formSubmit()
	{
		$this->load->library('session');
		$user=$this->session->userdata('username');
//		echo $user;
		if($user=='')redirect('login');
		
		$this->load->helper('form');
		$this->load->helper('html');
		
//		echo $_REQUEST['FixedCost'];
		
//		$_REQUEST['requestFrom']='fromForm';
		$data="";
		$data['viewOnly']=false;
		if($user=='administrator')
			$data['viewOnly']=true;
		$data['logoutUrl']='../login/logout';
		$data['companyName']=$this->session->userdata('companyName');			
		
		$data['userName']=$user;			
		$_REQUEST['urlValue']=base_url()."index.php/calculation/formSubmit";
		$_REQUEST['logoutUrl']=base_url()."index.php/login/logout";
		$data['expenseUrl']="../expense/calcExpense";
		$data['cancelUrl'] = "../breakeven";
		
		$this->load->view('CalculationForm',$data);
	}
	

	
}
?>