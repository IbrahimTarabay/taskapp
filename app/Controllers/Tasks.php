<?php 

namespace App\Controllers;

use App\Entities\Task;

class Tasks extends BaseController
{
	private $model;

	public function __construct(){
	  $this->model = new \App\Models\TaskModel;
	}

	public function index()
	{
        /*$data = [
			['id'=> 1, 'description' => 'First task'],
			['id' => 2, 'description' => 'Second task']
           //tasks become variable in the view
		];*/

		//$model = new \App\Models\TaskModel;
		$data = $this->model->findAll();
		//dd($data);
        
		//echo view("header"); 
		return view("Tasks/index", ['tasks' => $data]);
	}

	public function show($id){
      //$model = new \App\Models\TaskModel;
      $task = $this->getTaskOr404($id);

	  return view('Tasks/show',['task'=>$task]);
	}

	public function new(){
	  $task = new Task;
	  return view('Tasks/new', ['task'=>$task]);
	}

	public function create(){
	  //$model = new \App\Models\TaskModel;

	  $task = new Task($this->request->getPost());

	  if($this->model->insert($task)){
		return redirect()->to("/tasks/show/{$this->model->insertID}")
		->with('info','Task created successfully');
	  }else{
		return redirect()->back()
		->with('errors',$this->model->errors())
		->with('warning', 'Invalid data')
		->withInput();
	}
  }

  public function edit($id){
	//$model = new \App\Models\TaskModel;
	$task = $this->getTaskOr404($id);
	
	return view('Tasks/edit',['task'=>$task]);
  }

  public function update($id){
	 //$model = new \App\Models\TaskModel;

	 $task = $this->getTaskOr404($id);

	 $task->fill($this->request->getPost());
	 /*fill() is fast way to update record
	 it sets all the properties we want to set on
	 the object quickly*/
    
     if(!$task->hasChanged()){
       return redirect()->back()
	   ->with('warning', 'Nothing to update')
	   ->withInput();
	 }

	 //save() it detect if we're inserting new object or updating existing one
	 if($this->model->save($task)){
	  return redirect()->to("/tasks/show/$id")
	  ->with('info', 'Task updated successfully');
    }else{
	   return redirect()->back()
	   ->with('errors', $this->model->errors())
	   ->with('warning', 'Invalid data')
	   ->withInput();
	}
  }

  public function delete($id){
     $task = $this->getTaskOr404($id);

	 if($this->request->getMethod() === 'post'){
       $this->model->delete($id);
	   return redirect()->to('/tasks')
	   ->with('info', 'Task Deleted');
	 }

	 return view('Tasks/delete',['task'=>$task]);
  }

  private function getTaskOr404($id){
	$task = $this->model->find($id);
	//dd($task);
	if(!isset($task)){
	   throw new \CodeIgniter\Exceptions\PageNotFoundException("Task with id $id not found"); 
	}
	return $task;
  }
}
