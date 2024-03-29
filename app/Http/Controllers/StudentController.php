<?php

namespace App\Http\Controllers;

use App\Models\Student;
use domain\Facades\StudentFacades;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller
{

    public function view(){
        //$response['students'] = StudentFacades::view();
        // // dd($response);
        return Inertia::render('Dashboard/index');
    }

    public function store(Request $request){
        //dd($request->all());
        return StudentFacades::store($request->all());
        // $data = StudentFacades::view();
        // return response()->json($response);
    }
    public function list(){
        $data = StudentFacades::view();
        return response()->json($data);
    }

    public function status($data){
        return StudentFacades::status($data);
    }
    public function get($data){
        $data = StudentFacades::edit($data);
        return response()->json($data);
    }

    public function delete($data){
        return StudentFacades::delete($data);
    }

    public function edit($data){
        
        $response['students'] = StudentFacades::edit($data);
        $status['check'] = 1;
        dd($status);
        return Inertia::render('Dashboard/index' , $response ,$status);
    }

    public function update(Request $request,$image){
        // dd($task_id);
        return StudentFacades::update($request->all() ,$image);
    }
}
