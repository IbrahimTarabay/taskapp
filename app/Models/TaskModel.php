<?php

namespace App\Models;

class TaskModel extends \CodeIgniter\Model{
  protected $table = 'task';
  protected $allowedFields = ['description'];
  //fields that you can insert a value from form
  protected $validationRules = ['description'=>'required'];
  protected $validationMessages = [
    'description' => [
      'required' => 'Please enter a description'
    ]
  ]; 
}