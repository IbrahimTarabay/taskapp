<?php namespace App\Controllers;

class Tasks extends BaseController
{
	public function index()
	{
        /*$data = [
			['id'=> 1, 'description' => 'First task'],
			['id' => 2, 'description' => 'Second task']
           //tasks become variable in the view
		];*/

		$model = new \App\Models\TaskModel;
		$data = $model->findAll();
		//dd($data);
        
		//echo view("header"); 
		return view("Tasks/index", ['tasks' => $data]);
	}

	public function show($id){
      $model = new \App\Models\TaskModel;
	  $task = $model->find($id);
	  //dd($task);
	  return view('Tasks/show',['task'=>$task]);
	}

	public function new(){
	  return view('Tasks/new');
	}

	public function create(){
	  $model = new \App\Models\TaskModel;

	  $result = $model->insert(['description'=>$this->request->getPost("description")]);

	  if($result===false){
		return redirect()->back()
		->with('errors',$model->errors())
		->with('warning', 'Invalid data');
	  }else{
	    return redirect()->to("/tasks/show/$result")
		->with('info','Task created successfully');
	}
  }

  public function edit($id){
	$model = new \App\Models\TaskModel;
	$task = $model->find($id);
	
	return view('Tasks/show',['task'=>$task]);
  }
}
