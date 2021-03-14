<?php

namespace App\Controllers;

class Signup extends BaseController{
  public function new(){
    return view("Signup/new");
  }

  public function create(){
     $user = new \App\Entities\User($this->request->getPost());
     $model = new \App\Models\UserModel;

     $user->startActivation();

     if($model->insert($user)){
        $this->sendActivationEmail($user);
        return redirect()->to("/signup/success");
     }else{
        return redirect()->back()
        ->with('errors',$model->errors())
        ->with('warning','Invalid data')
        ->withInput();
     }
     
  }

  public function success(){
    return view('Signup/success');
  }

  public function activate($token){
     $model = new \App\Models\UserModel;
     $model->activateByToken($token);
     return view('Signup/activated');
  }

  public function sendActivationEmail($user){

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $sub = "Account Activation";
    $rec = $user->email;
    $message = view('Signup/activation_email',
    ['token'=>$user->token]);
	  $msg = $message;

    
	  if(mail($rec,$sub,$msg,$headers)){
        echo "Message Sent";
	  }else{
		 echo $email->printDebugger();
	  }
	 }
  }