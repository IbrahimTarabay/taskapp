<?php

namespace App\Libraries;

class Authentication{
    private $user;
    public function login($email,$password,$remember_me){
      $model = new \App\Models\UserModel;
      
      $user = $model->findByEmail($email);

      if(!isset($user)){
        return false;
      }
      if(!$user->verifyPassword($password)){
          return false;
      }
      if(!$user->is_active){
        return false;
      }
        
      $this->logInUser($user);

      if($remember_me){
        $this->rememberLogin($user->id);
      }

      return true;
    }

    private function logInUser($user){
      $session = session();
      $session->regenerate();
      $session->set('user_id',$user->id);
    }

    private function rememberLogin($user_id){
      $model = new \App\Models\RememberedLoginModel;
      list($token,$expiry) = $model->rememberUserLogin($user_id);
      $response = service('response');
      $response->setCookie('remember_me',$token,$expiry);
    }

    public function logout(){
      session()->destroy();
    }

    public function getUserFromSession(){
      if(! session()->has('user_id')){
        return null;
      } 

      $model = new \App\Models\UserModel;
      $user = $model->find(session()->get('user_id'));

      if($user && $user->is_active){
        return $user;
      }
    }

    function getCurrentUser(){
      if($this->user === null){
        $this->user = $this->getUserFromSession();
      }
      return $this->user;
    }

    public function isLoggedIn(){
      return $this->getCurrentUser() !== null;
    }
}