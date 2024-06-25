<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories= Category::all();

        return $this->sendResponse('All category list successfully retrieved.', CategoryResource::collection($categories), 200);    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $createdCategory = Category::create($request->validated());

        return $this->sendResponse(' todo list successfully created.', new CategoryResource($createdCategory), 200);   
     }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        $category->refresh();
        return $this->sendResponse('Category successfully updated.', new CategoryResource($category), 200);  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();    
        return $this->sendResponse('category successfully deleted.', null, 200);    
    }
}
