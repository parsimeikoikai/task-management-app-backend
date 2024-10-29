<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller {
    // Create a Task
    public function store(Request $request) {
        try {
          
            $task = Task::create($request->all());

            return response()->json($task, 201);
        } catch (\Exception $e) {
         
            return response()->json(['error' => 'Task creation failed: ' . $e->getMessage()], 400);
        }
    }
    
    
    // Get All Tasks with Pagination and Filtering
    public function index(Request $request) {
     
        $query = Task::query();
        // Optional Filtering by Status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        // Optional Filtering by Due Date
        if ($request->has('due_date')) {
            $query->whereDate('due_date', $request->due_date);
        }
        // Optional Search by Title
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        // Pagination
        $tasks = $query->paginate(10);
        return response()->json($tasks);
    }
    // Get a Specific Task
    public function show($id) {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        return response()->json($task);
    }
    // Update a Task
    public function update(Request $request, $id) {
     
        $task = Task::find($id);
        
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $task->update($request->all());
    
        return response()->json($task);
    }
    // Delete a Task
    public function destroy($id) {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
   
}
