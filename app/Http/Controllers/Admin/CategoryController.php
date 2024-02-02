<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Store\CategoryStoreRequest;
use App\Http\Requests\Update\CategoryUpdateRequest;
use App\Http\Resources\Category\CategoryResource;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryService->getAllCategory();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $data = $request->validated();
        $category = $this->categoryService->createCategory($data);

        return response()->json([
            'message' => 'Category created successfully.',
            'data' => $category,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $post = $this->categoryService->getCategoryByUuid($uuid);
        return new CategoryResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $uuid)
    {
        $data = $request->validated();
        $this->categoryService->updateCategory($uuid, $data);

        return response()->json([
            'message' => 'Category Updated successfully.',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $post = $this->categoryService->deleteCategory($uuid);

        return response()->json([
            'message' => 'Post Deleted successfully.',
        ], 201);
    }
}
