<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index($locale='')
	{
        if($locale === ''){
		 session()->keepFlashdata('info');	
         return redirect()->to($this->locale);
		}
		//echo view("header");
		$this->request->setLocale($locale); 
		session()->set('locale',$locale);
		return view("Home/index");
	}

	public function testEmail(){
	  /*$email = service('email');
	  $email->setTo('ibrahimesalah69@gmail.com.com');
	  $email->setSubject('A test email');
	  $email->setMessage('<h1>Hi Hema</h1>');*/

	  $headers = "MIME-Version: 1.0\r\n";
	  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

	  $sub = "A test email";
	  $msg = "<h1>Hi Hema</h1>";
	  $rec = "ibrahimesalah69@gmail.com";
    
	  if(mail($rec,$sub,$msg,$headers)){
        echo "Message Sent";
	  }else{
		 echo $email->printDebugger();
	  }
	}
}
