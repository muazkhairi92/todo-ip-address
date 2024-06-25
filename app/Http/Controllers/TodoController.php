<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoretodoRequest;
use App\Http\Requests\UpdatetodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos= Todo::all()->sortBy('category_id');

        return $this->sendResponse('All todo list successfully retrieved.', TodoResource::collection($todos), 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretodoRequest $request)
    {
        $createdTodo = Todo::create($request->validated());

        return $this->sendResponse(' todo list successfully created.', new TodoResource($createdTodo), 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetodoRequest $request, todo $todo)
    {
        $todo->update($request->validated());
        $todo->refresh();
        return $this->sendResponse('Todo list successfully updated.', new TodoResource($todo), 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(todo $todo)
    {
        $todo->delete();
        
        return $this->sendResponse(' todo list successfully deleted.', null, 200);
    }
}
