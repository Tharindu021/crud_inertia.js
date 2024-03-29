<?php

namespace domain\Services;
use App\Models\Student;


class StudentService
{
    protected $task;

    public function __construct()
    {
        $this->task = new Student();
    }

    public function view(){
        return $this->task->all();
    }

    public function store($data){
        if(isset($data['image'])){
            
            $name = rand(1,1000) . '_' . $data['image']->getClientoriginalName();
        //dd($name);
            $path = $data['image']->storeAs('uploads',$name);
            $data['image'] = $name;
        }
        $sname = $data['name'];
        $age = $data['age'];
        //dd($data);

        $this->task->create([
            'image' => $name,
            'name' => $sname,
            'age' => $age
        ]);

    }

    public function status($data){
        $task = $this->task->find($data);
        if($task->status == 1 ){
            $task->status = 0;
        }else{
            $task->status = 1;
        }
        
        $task->update();
    }

    public function delete($data){
        $task = $this->task->find($data);
        $task->delete();
    }

    public function edit($data){
        $task = $this->task->find($data);
        return $task;
    }

    public function update(array $data , $task_id){
    
        if(isset($data['image'])){
            
            $name = rand(1,1000) . '_' . $data['image']->getClientoriginalName();
        //dd($name);
            $path = $data['image']->storeAs('uploads',$name);
            $data['image'] = $name;
        }
        $prevData = $this->task->find($task_id);
        $prevData->update($this->combine($prevData , $data));

    }
    protected function combine(Student $prevData , $newData){
        return array_merge($prevData->toArray(),$newData);
    }
}