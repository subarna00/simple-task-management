<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\TaskStoreRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index($slug){
        $project = Project::where("slug",$slug)->first();
        $tasks = Task::where("project_id",$project->id)->orderBy('priority', 'ASC')->paginate(5);
        return view("task.task", compact("project","tasks"));
    }
    public function store(TaskStoreRequest $request){

        $max_priority = Task::max('priority') ?? 1;
        $priority = $max_priority + 1;
        $task = new Task();
        $task->name = $request->name;
        $task->priority = $priority;
        $task->project_id = $request->project_id;
        $task->save();
        return redirect()->route('task.index', $task->project->slug)->with('success', 'Task Added Successfully');
    }
    public function edit($id){
        $task = Task::find($id);
        return view("task.edit", compact("task"));
    }
    public function update(Request $request, $id){
        $task = Task::find($id);
        $task->name = $request->name;
        $task->save();
        return redirect()->route('task.index', $task->project->slug)->with('success', 'Task Updated Successfully');
    }
    public function delete($id){
        $task = Task::find($id);
        $task->delete();
        return redirect()->back()->with('success', 'Task Deleted Successfully');
    }
    public function reorder(Request $request){
        $sortedIds = $request->sortedIds;
        foreach ($sortedIds ?? [] as $index => $taskId) {
            Task::where('id', $taskId)->update(['priority' => $index + 1]);
        }
        return response()->json(['success' => true]);
    }
}
