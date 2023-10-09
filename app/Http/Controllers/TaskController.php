<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function viewTask()
    {
        $tasks = Task::all();
        return view('tasks.task')->with('tasks', $tasks);
    }


    public function saveTask(Request $request)
    {
        $request->validate([
            'task' => 'required|unique:tasks,name',
            'priority' => 'required|unique:tasks,priority',
        ], [
            'priority.unique' => 'This priority has already been set.',
        ]);
        $task           = new Task;
        $task->name     = $request->input('task');
        $task->priority = $request->input('priority');
        $task->save();

        return redirect()->to('view-tasks')->with('success', 'Task Saved Successfully');
    }

    public function editTask($id)
    {
        $task = Task::find($id);
        return view('tasks.edittask')->with('task', $task);
    }

    public function updateTask(Request $request, $id)
    {
        $task           = Task::find($id);
        $task->name     = $request->input('task');
        $task->priority = $request->input('priority');
        $task->save();
        return redirect()->to('view-tasks')->with('success', 'Task Successfully Updated');

    }

    public function deleteTask($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->to('view-tasks')->with('success', 'Task Deleted');
    }

    
    public function updateTaskPriority(Request $request)
    {
        $taskId      = $request->input('taskId');
        $newPriority = $request->input('newPriority');

        
        $task           = Task::find($taskId);
        $task->priority = $newPriority;
        $task->save();

        return response()->json(['message' => 'Task priority updated successfully']);
    }
}