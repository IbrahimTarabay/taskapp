<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		//echo view("header"); 
		return view("Home/index");
	}

	public function testEmail(){
	  /*$email = service('email');
	  $email->setTo('ibrahimesalah69@gmail.com.com');
	  $email->setSubject('A test email');
	  $email->setMessage('<h1>Hi Hema</h1>');*/

	  $sub = "A test email";
	  $msg = "<h1>Hi Hema</h1>";
	  $rec = "ibrahimesalah69@gmail.com";
    
	  if(mail($rec,$sub,$msg)){
        echo "Message Sent";
	  }else{
		 echo $email->printDebugger();
	  }
	}
}
