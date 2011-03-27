<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->helper('html');
		$data['errorMessage']="";
		$data['urlValue']="index.php/login/checklogin";
		$this->load->view('loginview',$data);
		//		$this->load->view('Breakeven');
		//		echo img('images/login_button.gif');
	}

	public function test()
	{
		$this->load->helper('url');

		redirect('breakeven/data');

	}

	public function logout()
	{
		$this->load->library('session');
		$this->session->sess_destroy();
		$this->load->helper('url');
		$this->load->helper('html');
		$data['errorMessage']="";
		$data['urlValue']="index.php/login/checklogin";
		$this->load->view('loginview',$data);
	}

	public function checklogin()
	{
		$this->load->helper('url');
		$this->load->database();
		$this->load->helper('html');
		$this->load->library('session');
		//		$host="localhost"; // Host name
		//		$username="root"; // Mysql username
		//		$password=""; // Mysql password
		//		$db_name="mysql"; // Database name
		$tbl_name="break_even_login"; // Table name
		// Connect to server and select databse.
		//mysql_connect("$host", "$username", "$password")or die("cannot connect");
		//mysql_select_db("$db_name")or die("cannot select DB");

		// username and password sent from form
		$myusername=$_POST['myusername'];
		$mypassword=$_POST['mypassword'];
		$mycompany=$_POST['mycompany'];

		// To protect MySQL injection (more detail about MySQL injection)
		$myusername = stripslashes($myusername);
		$mycompany = stripcslashes($mycompany);
		$mypassword = stripslashes($mypassword);
		$myusername = mysql_real_escape_string($myusername);
		$mypassword = mysql_real_escape_string($mypassword);

		$sql="SELECT * FROM $tbl_name WHERE be_username='$myusername' and be_password='$mypassword' and
 be_companyname='$mycompany'";

		$query = $this->db->query($sql);

		//		$result=mysql_query($sql);

		// Mysql_num_row is counting table row
		//		$count=mysql_num_rows($result);
		// If result matched $myusername and $mypassword, table row must be 1 row
		//		echo $query->num_rows();
		if($query->num_rows()==1){
			// Register $myusername, $mypassword and redirect to file "login_success.php"
//			session_register("myusername");
//			session_register("mypassword");
//			session_register("mycompany");
			$data['urlValue']="index.php/breakevn/data";
				
			$newdata = array(
                   'username'  => $myusername,
                   'logged_in' => TRUE
			);

			$this->session->set_userdata($newdata);
			if($myusername=='adminUser')
			{
				//			/$data['urlValue']="index.php/breakeven/data";
				redirect('breakeven');
			}
			else 
			{
				redirect("calculation");
			}
				
		}
		else {
			$data['errorMessage']="Invalid UserId,Password or Company";
			$data['urlValue']="index.php/login/checklogin";
			$this->load->view('loginview',$data);
		}

	}}
