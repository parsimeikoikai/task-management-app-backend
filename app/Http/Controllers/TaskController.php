<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller {
    // Create a Task
    public function store(Request $request) {
        try {
            $validatedData = $this->validate($request, [
                'title' => 'required|unique:tasks|max:255',
                'description' => 'nullable|string',
                'status' => 'in:pending,completed',
                'due_date' => 'required|date|after:today'
            ]);

            $task = Task::create($validatedData);
            return response()->json($task, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Validation failed', 'messages' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Task creation failed: ' . $e->getMessage()], 400);
        }
    }
    
    // Get All Tasks with Pagination and Filtering
    public function index(Request $request) {
        try {
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
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve tasks: ' . $e->getMessage()], 400);
        }
    }
    // Get a Specific Task
    public function show($id) {
        try {
            $task = Task::find($id);
            if (!$task) {
                return response()->json(['error' => 'Task not found'], 404);
            }
            return response()->json($task);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve task: ' . $e->getMessage()], 400);
        }
    }
    // Update a Task
    public function update(Request $request, $id) {
        try {
            $task = Task::find($id);
            if (!$task) {
                return response()->json(['error' => 'Task not found'], 404);
            }

            $validatedData = $this->validate($request, [
                'title' => 'sometimes|required|unique:tasks,title,' . $id . '|max:255',
                'description' => 'nullable|string',
                'status' => 'in:pending,completed',
                'due_date' => 'sometimes|required|date|after:today'
            ]);

            $task->update($validatedData);
            return response()->json($task);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Validation failed', 'messages' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Task update failed: ' . $e->getMessage()], 400);
        }
    }
    // Delete a Task
    public function destroy($id) {
        try {
            $task = Task::find($id);
            if (!$task) {
                return response()->json(['error' => 'Task not found'], 404);
            }

            $task->delete();
            return response()->json(['message' => 'Task deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Task deletion failed: ' . $e->getMessage()], 400);
        }
    }
   
}
