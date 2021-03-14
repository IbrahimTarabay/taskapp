<?php
namespace App\Controllers;

class Password extends BaseController{
  public function forgot(){
     return view('Password/forgot');
  }

  public function processForgot(){
    $model = new \App\Models\UserModel;
    $user = $model->findByEmail($this->request->getPost('email'));

    if($user && $user->is_active){
      $user->startPasswordReset();
      $model->save($user);
    }else{
      return redirect()->back()
      ->with('warning','No active user found with that email address')
      ->withInput();
    }
  }
}