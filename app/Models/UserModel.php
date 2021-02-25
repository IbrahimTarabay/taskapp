<?php

namespace App\Models;

class UserModel extends \CodeIgniter\Model{
  protected $table = 'user';
  protected $allowedFields = ['name','email','password'];
  protected $returnType = 'App\Entities\User';
  protected $useTimestamps = true;
  protected $beforeInsert = ['hashPassword'];
  //This function will be called before the insert method is called
  protected function hashPassword(array $data){
    if(isset($data['data']['password'])){
       $data['data']['password_hash']=password_hash($data['data']['password'],PASSWORD_DEFAULT);
       unset($data['data']['password']);
    }
    return $data;
  }
}