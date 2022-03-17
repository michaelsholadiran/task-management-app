<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $list=Task::orderBy('created_at', 'desc')->get();
        } catch (\Exception $e) {
            $list=[];
        }
        return view('index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
        'name' => 'required',
        'project' => 'required',
      ]);

        $task=new Task();
        $task->name= $request->name;
        $task->project= $request->project;

        $task->save();
         return response()->json(['status'=>1,'notification'=>"Task Added Successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     try {
            $task= Task::findOrFail($id);
        } catch (\Exception $e) {
            $task=[];
        }

        return  $task;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $this->validate($request, [
        'name' => 'required',
        'project' => 'required',
      ]);

        $task = Task::find($id);
        $task->name= $request->name;
        $task->project= $request->project;
        $task->save();
      
        return response()->json(['status'=>1,'notification'=>"Task Updated Successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task=Task::findOrFail($id);
        $task->delete();

        return response()->json(['status'=>1,'notification'=>"Task deleted successfully"]);
    }

     public function list()
    {
        try {
            $list=Task::orderBy('created_at', 'desc')->get();
        } catch (\Exception $e) {
            $list=[];
        }
        return view('components.tasks', compact('list'));
    }

       public function filter($id)
    {
        
        try {
          
         $list=($id == -1) ? Task::orderBy('created_at', 'desc')->get(): Task::where('project',$id)->orderBy('created_at', 'desc')->get();
           
        } catch (\Exception $e) {
            $list=[];
        }
        return view('components.filter', compact('list'));
    }

}
