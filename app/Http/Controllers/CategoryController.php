<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $fields = $request->only(['id', 'name', 'photo', 'tagline']);

        $categories = $this->categoryService->getAll($fields);

        return response()->json(CategoryResource::collection($categories));
    }

    public function show($id, Request $request)
    {
        try {
            $fields = $request->only(['id', 'name', 'photo', 'tagline']);

            $category = $this->categoryService->getById($id, $fields);

            return response()->json(new CategoryResource($category));
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        }
    } 

    public function store(CategoryRequest $request)
    {

        $category = $this->categoryService->create($request->validated());

        return response()->json(new CategoryResource($category), 201);
    } 

    public function update(CategoryRequest $request, int $id)
    {
        try {
            $category = $this->categoryService->update($id, $request->validated());

            return response()->json(new CategoryResource($category));
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->categoryService->delete($id);

            return response()->json(['message' => 'Category deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        }
    }
}
