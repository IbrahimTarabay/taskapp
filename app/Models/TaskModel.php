<?php

namespace App\Models;

class TaskModel extends \CodeIgniter\Model{
  protected $table = 'task';
  protected $allowedFields = ['description'];
  //fields that you can insert a value from form

  protected $useTimestamps = true;

  protected $returnType = 'App\Entities\Task';
  protected $validationRules = ['description'=>'required'];
  protected $validationMessages = [
    'description' => [
      'required' => 'Please enter a description'
    ]
  ]; 

  public function getTasksByUserId($id){
    return $this->where('user_id', $id)
    ->findAll();
  }
}